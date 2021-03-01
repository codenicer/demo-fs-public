@extends('layouts.app')

@section('content')

@if($type != 'Seller')
    <div class="row">
        <div class="col-lg-12">
            <a href="{{ route('products.create')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New Product')}}</a>
        </div>
    </div>
@endif

<br>

<div class="col-lg-12">
    <div class="panel">
        <!--Panel heading-->
        <div class="panel-heading">
            <h3 class="panel-title">{{ __($type.' Products') }}</h3>
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
                        <th>{{__('Addon')}}</th>
                        <th>{{__('Todays Deal')}}</th>
                        <th>{{__('Published')}}</th>
                        <th>{{__('Featured')}}</th>
                        <th>{{__('Options')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $key => $product)
                        <tr>
                            <td>{{$product->product_id}}</td>
                            <td><a href="{{ route('product', $product->title?$product->title:'_') }}" target="_blank">{{ __($product->title) }}</a></td>
                            <td><img class="img-md"
                                src="{{isset($product->thumbnail_img) ? asset($product->thumbnail_img) : 'http://www.4motiondarlington.org/wp-content/uploads/2013/06/No-image-found.jpg'}}"
                                    alt="Image"></td>
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
                            <td>
                                @if ($product->type === "addon")
                                      Addon
                                @endif
                            </td>
                            <td><label class="switch">
                                <input onchange="update_todays_deal(this)" value="{{ $product->product_id }}" type="checkbox" <?php if($product->todays_deal == 1) echo "checked";?> >
                                <span class="slider round"></span></label></td>
                            <td><label class="switch">
                                <input onchange="update_published(this)" value="{{ $product->product_id }}" type="checkbox" <?php if($product->published == 1) echo "checked";?> >
                                <span class="slider round"></span></label></td>
                            <td><label class="switch">
                                <input onchange="update_featured(this)" value="{{ $product->product_id }}" type="checkbox" <?php if($product->featured == 1) echo "checked";?> >
                                <span class="slider round"></span></label></td>
                            <td>
                                <div class="btn-group dropdown">
                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                        {{__('Actions')}} <i class="dropdown-caret"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        @if ($type == 'Seller')
                                            <li><a href="{{route('products.seller.edit', encrypt($product->product_id))}}">{{__('Edit')}}</a></li>
                                        @else
                                            <li><a href="{{route('products.admin.edit', encrypt($product->product_id))}}">{{__('Edit')}}</a></li>
                                        @endif
                                        @if ($product->type !== "addon")
                                            <li><a href="{{route('addons.index', encrypt($product->product_id))}}">{{__('Manage Addons')}}</a></li>
                                            <li><a href="{{route('products.priority_addon', encrypt($product->product_id))}}">{{__('Manage Priority Addons')}}</a></li>
                                        @endif
                                        <li><a href="{{route('products.duplicate', $product->product_id)}}">{{__('Duplicate')}}</a></li>
                                        <li><a href='{{route('products.destroy', $product->product_id)}}' onclick="return confirm('All products that assigned in this product will also be deleted including category,subcategory and collection. Do you want to continue?');">{{__('Delete')}}</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection


@section('script')
    <script type="text/javascript">

        $(document).ready(function(){
            //$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
        });

        function update_todays_deal(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.todays_deal') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Todays Deal updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        function update_published(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.published') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Published products updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        function update_featured(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.featured') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
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
