@extends('layouts.app')

@section('content')
    <style>.list-group{
            max-height: 300px;
            min-height: 300px;

            margin-bottom: 10px;
            overflow:scroll;
            -webkit-overflow-scrolling: touch;


        }
        .haha:hover{
            background-color:pink !important;
            cursor:pointer;
        }
    </style>

    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">{{__("Product's Priority Addon")}}</h3>
            </div>

            <!--Horizontal Form-->
            <!--===================================================-->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">{{__('Product Title')}}: <span class="text-dark">{{__($product->title)}}</span></h3>
                </div>
                <div class="panel-heading">
                  <h3 class="panel-title" style="text-decoration: underline; color: 'blue';">  
                    <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                    <a  href="{{route('addons.index', encrypt($product->product_id))}}">{{__('Manage Addons')}}</a>
                  </h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered demo-dt-basic-priority" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th><i class="fa fa-bars"></i></th>
                            <th width="80%">{{__('Name')}}</th>
                            <th width="5%">{{__('Remove')}}</th>

                        </tr>
                        </thead>

                        <tbody id="collectionlist">
                        @foreach($all_products as $key => $prod)
                            <tr id="{{$prod->product_id}}" class="haha">
                                <td><i style="font-size:20px;" class="fa fa-bars"></i></td>
                                <td>{{$prod->title}}</td>
                                <td class="text-center" style="color: red;" onclick="updateCampaign({{$prod->product_id}}, '{{$prod->title}}');"><i class="fa fa-trash" aria-hidden="true"></i></td>
                                <input type="hidden" value="{{$prod->product_id}}" id="item" name="item">
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <!--===================================================-->
                <!--End Horizontal Form-->

            </div>
        </div>
    </div>

        @endsection

        @section('script')
            <script
                    src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
                    integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
                    crossorigin="anonymous"></script>
            {{--<script type="text/javascript">--}}

              {{--function update_featured(el){--}}
                {{--if(el.checked){--}}
                  {{--var status = 1;--}}
                {{--}--}}
                {{--else{--}}
                  {{--var status = 0;--}}
                {{--}--}}
                {{--$.post('{{ route('collections.update_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status,collection_id:{{$flash_deals->id}}}, function(data){--}}
                  {{--if(data == 1){--}}
                    {{--showAlert('success', 'Featured products updated successfully');--}}
                  {{--}--}}
                  {{--else{--}}
                    {{--showAlert('danger', 'Something went wrong');--}}
                  {{--}--}}
                {{--});--}}
              {{--}--}}
            {{--</script>--}}
            <script>

              var $sortableSlider = $("#collectionlist");
              $sortableSlider.sortable({
                stop: function(event, ui){
                  var parameters = $sortableSlider.sortable('toArray');
console.log(parameters);
                  $.post('{{ route("products.addon_priorities") }}',{_token:'{{ csrf_token() }}',value:parameters, product_id: '{{$product->product_id}}'} ,function(result){
                    if(result == 1){
                      showAlert('success','Priority updated successfully');
                    }else{
                      showAlert('danger','Something went wrong');
                    }
                  })
                }
              })


            function updateCampaign(product_id, product_title){

             if(confirm('Are you sure you want to remove ' + product_title + ' in this campaign?')){
                $.post('{{ route('campaigns.update') }}', {_token:'{{ csrf_token() }}', campaign_id:'{{$product->campaign_schedule_id}}', action:0,
                  product_id:product_id}, function(data){
                      if(data == 1){
                          showAlert('success', 'Product Campaign has been updated successfully');
                          location.reload();
                      }
                      else{
                      showAlert('danger', 'Something went wrong');
                      }
                  });
              }
            }


            </script>

@endsection
