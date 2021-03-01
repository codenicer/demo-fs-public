@extends('layouts.app')

@section('content')

<div class="col-sm-12">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Flash Deal Information')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('flash_deals.update', $flash_deal->id) }}" method="POST" enctype="multipart/form-data">
        	@csrf
            <input type="hidden" name="_method" value="PATCH">
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Title')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('Title')}}" id="name" name="title" value="{{ $flash_deal->title }}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="start_date">{{__('Date')}}</label>
                    <div class="col-sm-9">
                        <div class="d-flex align-items-center">
                            <input type="datetime-local" class="form-control" name="start_date" value="{{ date('Y-m-d\TH:i:s', $flash_deal->start_date) }}">
                            <span style='padding: 5px 10px'>{{__('to')}}</span>
                            <input type="datetime-local" class="form-control" name="end_date" value="{{ date('Y-m-d\TH:i:s', $flash_deal->end_date) }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="products">{{__('Products')}}</label>
                    <div class="col-sm-9">
                        <select name="products[]" id="products" class="form-control demo-select2" multiple required data-placeholder="Choose Products">
                            @foreach(\App\Product::all() as $product)
                                @php
                                    $flash_deal_product = \App\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->product_id)->first();
                                @endphp
                                <option value="{{$product->product_id}}" <?php if($flash_deal_product != null) echo "selected";?> >{{__($product->title)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label class="col-sm-3 control-label" for="products">{{__('Page Size')}}</label>
                    <div class="col-sm-9">
                        <input type="number" value="{{ $flash_deal->page_size}}" name="page_size" required class="form-control">

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
                                    <input type="checkbox" class="form-check-input" id="hub_{{$hub->hub_id}}" value="{{$hub->hub_id}}" name="hub[]" @if(in_array($hub->hub_id, $flash_deal->hubs->pluck('hub_id')->toArray())) checked @endif >
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
                <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
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

            get_flash_deal_discount();

            $('#products').on('change', function(){
                get_flash_deal_discount();
            });

            function get_flash_deal_discount(){
                var product_ids = $('#products').val();
                if(product_ids.length > 0){
                    $.post('{{ route('flash_deals.product_discount_edit') }}', {_token:'{{ csrf_token() }}', product_ids:product_ids, flash_deal_id:{{ $flash_deal->id }}}, function(data){
                        $('#discount_table').html(data);
                        $('.demo-select2').select2();
                    });
                }
                else{
                    $('#discount_table').html(null);
                }
            }
        });
    </script>
@endsection
