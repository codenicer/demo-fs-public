@extends('layouts.app')

@section('content')

    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">{{__('Pop up Information')}}</h3>
            </div>

            <!--Horizontal Form-->
            <!--===================================================-->
            <form class="form-horizontal" action="{{ route('popups.updates') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" value="{{$edit_popup->id}}" name="id">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="name">{{__('URL')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{__('Route')}}" id="route" value="{{$edit_popup->route}}" name="route" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="name">{{__('Name')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{__('Name')}}" value="{{$edit_popup->name}}" id="name" name="name" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="col-sm-3 control-label" for="products">{{__('HTML File')}}</label>
                        <div class="col-sm-9">
                            <input type="file" accept=".html" name="blade" />
                        </div>

                    </div>
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
