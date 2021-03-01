@extends('layouts.app')

@section('content')
    <style>.list-group{
            max-height: 300px;
            min-height: 300px;

            margin-bottom: 10px;
            overflow:scroll;
            -webkit-overflow-scrolling: touch;
        }</style>

    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">{{__('Flash Deal Information')}}</h3>
            </div>

            <!--Horizontal Form-->
            <!--===================================================-->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">{{__('Collections')}}</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th width="20%">{{__('Name')}}</th>
                            <th>{{__('Photo')}}</th>
                            <th>{{__('Type')}}</th>
                            <th>{{__('Exclusive Campaigns')}}</th>
                            <th>{{__('Prices')}}</th>
                            <th>{{__('Featured')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($all_products as $key => $product)
                            <tr>
                                <td>{{$product->product_id}}</td>
                                <td><a href="{{ route('product', urlencode($product->handle)) }}" target="_blank">{{ __($product->title) }}</a></td>
                                <td><img class="img-md" src="{{ asset($product->thumbnail_img)}}" alt="Image"></td>
                                <td>{{$product->type}}</td>
                                <td>
                                    @php
                                        //echo print_r(count($hub_prices),1);
                                         // $qty = 0;
                                         foreach ($product->campaign_products->where('is_active',1)->where('is_enabled') as $campaign) {
                                             echo '<BR/>'.$campaign->title;
                                          }
                                         // echo $qty;
                                    @endphp
                                </td>
                                <td>Base price: {{ number_format($product->unit_price,2) }}

                                    @php

                                        //echo print_r(count($hub_prices),1);
                                        // $qty = 0;
                                        foreach ($product->hubs as $hub_prices) {
                                            echo '<BR/>'.$hub_prices->address.":".number_format($hub_prices->pivot->unit_price,2);
                                         }
                                        // echo $qty;
                                    @endphp


                                </td>
                                <td><label class="switch">
                                        <input onchange="update_featured(this)" value="{{ $product->product_id }}" type="checkbox" <?php if(in_array($product->product_id, $product_id) ) echo "checked";?> >
                                        <span class="slider round"></span></label></td>
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
            <script type="text/javascript">

              function update_featured(el){

                if(el.checked){
                  var status = 1;
                }
                else{
                  var status = 0;
                }
                $.post('{{ route('collections.edit_addOn') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status,collection_id:{{$flash_deals->id}}}, function(data){

                  if(data == 1){
                    showAlert('success', 'Featured products updated successfully');
                  }
                  else{
                    showAlert('danger', 'Something went wrong');
                  }
                });
              }
            </script>

@endsection
