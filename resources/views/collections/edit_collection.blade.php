@extends('layouts.app')

@section('content')

    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">{{__('Collection Information')}}</h3>
            </div>

            <!--Horizontal Form-->
            <!--===================================================-->
            <form class="form-horizontal" action="{{ route('collections.store_collection') }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="{{$find_collection->id}}">
                @method('patch')
                @csrf
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="name">{{__('Title')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{__('Title')}}" value="{{$find_collection->title}}" id="name" name="title" class="form-control" required>
                        </div>
                    </div>
                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-3 control-label" for="start_date">{{__('Date')}}</label>--}}
                        {{--<div class="col-sm-9">--}}
                            {{--<div id="demo-dp-range">--}}
                                {{--<div class="input-daterange input-group" id="datepicker">--}}
                                    {{--<input type="text" value="{{ date('d-m-Y', $find_collection->start_date) }}" class="form-control" name="start_date">--}}
                                    {{--<span class="input-group-addon">{{__('to')}}</span>--}}
                                    {{--<input type="text" value="{{ date('d-m-Y', $find_collection->end_date) }}"  class="form-control" name="end_date">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <br>
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
