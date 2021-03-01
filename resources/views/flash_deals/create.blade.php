@extends('layouts.app')

@section('content')

<div class="col-sm-12">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Flash Deal Information')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('flash_deals.store') }}" method="POST" enctype="multipart/form-data">
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Title')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('Title')}}" id="name" name="title" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="start_date">{{__('Date')}}</label>
                    <div class="col-sm-9">
                        <div class="d-flex align-items-center" id="datepicker">
                            <input type="datetime-local" class="form-control" name="start_date">
                            <span style='padding: 5px 10px'>{{__('to')}}</span>
                            <input type="datetime-local" class="form-control" name="end_date" >
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="col-sm-3 control-label" for="products">{{__('Products')}}</label>
                    <div class="col-sm-9">
                        <select name="products[]" id="products" class="form-control demo-select2" multiple required data-placeholder="Choose Products">
                            @foreach($products as $product)
                                <option value="{{$product->product_id}}">{{__($product->title)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label class="col-sm-3 control-label" for="products">{{__('Page Size')}}</label>
                    <div class="col-sm-9">
                        <input type="number" name="page_size" required class="form-control">

                    </div>
                </div>
                <div class="form-group mb-3">
                    <label class="col-sm-3 control-label" for="products">{{__('Hubs')}}</label>
                    <div class="col-sm-9">
                        <div class="row" style="margin-top: 10px" >
                            @php
                                $hubs = \App\Hubs::where('web_enabled', 1)->get();

                            @endphp
                            @foreach($hubs as $hub)
                                <div class="col-lg-3">
                                    <input type="checkbox" class="form-check-input" id="hub_{{$hub->hub_id}}" value="{{$hub->hub_id}}" name="hub[]"  >
                                    <label class="form-check-label" for="hub_{{$hub->hub_id}}">{{$hub->address}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group" id="discount_table">

                </div>
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple"  type="submit">{{__('Save')}}</button>
            </div>
        </form>
        <!--===================================================-->
        <!--End Horizontal Form-->

    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#products').on('change', function(){
                var product_ids = $('#products').val();
                if(product_ids.length > 0){
                    $.post('{{ route('flash_deals.product_discount') }}', {_token:'{{ csrf_token() }}', product_ids:product_ids}, function(data){
                        $('#discount_table').html(data);
                        $('.demo-select2').select2();
                    });
                }
                else{
                    $('#discount_table').html(null);
                }
            });
        });



    </script>
@endsection
