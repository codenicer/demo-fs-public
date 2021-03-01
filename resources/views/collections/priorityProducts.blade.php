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
                <h3 class="panel-title">{{__("Collection's Priority Product")}}</h3>
            </div>

            <!--Horizontal Form-->
            <!--===================================================-->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">{{__('Collection Name')}}: <span class="text-dark">{{__($collection->title)}}</span></h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered demo-dt-basic-priority" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th><i class="fa fa-bars"></i></th>
                            <th width="80%">{{__('Name')}}</th>

                        </tr>
                        </thead>
                        <tbody id="collectionlist">
                        @foreach($all_products as $key => $product)
                            <tr id="{{$product->id}}" class="haha">
                                <td><i style="font-size:20px;" class="fa fa-bars"></i></td>
                                <td>{{$product->products[0]->title}}</td>
                                <input type="hidden" value="{{$product->id}}" id="item" name="item">

                                {{--<td><a href="{{ route('product', $product->title) }}" target="_blank">{{ __($product->title) }}</a></td>--}}
                                {{--<td><img class="img-md" src="{{ asset($product->thumbnail_img)}}" alt="Image"></td>--}}
                                {{--<td>{{$product->type}}</td>--}}
                                {{--<td>--}}
                                    {{--@php--}}
                                        {{--//echo print_r(count($hub_prices),1);--}}
                                         {{--// $qty = 0;--}}
                                         {{--foreach ($product->campaign_products->where('is_active',1)->where('is_enabled') as $campaign) {--}}
                                             {{--echo '<BR/>'.$campaign->title;--}}
                                          {{--}--}}
                                         {{--// echo $qty;--}}
                                    {{--@endphp--}}
                                {{--</td>--}}
                                {{--<td>Base price: {{ number_format($product->unit_price,2) }}--}}

                                    {{--@php--}}

                                        {{--//echo print_r(count($hub_prices),1);--}}
                                        {{--// $qty = 0;--}}
                                        {{--foreach ($product->hubs as $hub_prices) {--}}
                                            {{--echo '<BR/>'.$hub_prices->address.":".number_format($hub_prices->pivot->unit_price,2);--}}
                                         {{--}--}}
                                        {{--// echo $qty;--}}
                                    {{--@endphp--}}


                                {{--</td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <!--===================================================-->
                <!--End Horizontal Form-->

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
                  $.post('{{ route("collections.product_priorities") }}',{_token:'{{ csrf_token() }}',value:parameters} ,function(result){
                    if(result == 1){
                      showAlert('success','Priority updated successfully');
                    }else{
                      showAlert('danger','Something went wrong');
                    }
                  })
                }
              })


            </script>

@endsection
