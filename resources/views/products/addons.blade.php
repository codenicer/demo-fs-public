@extends('layouts.app')

@section('content')

<br>

<div class="col-lg-12">
    <div class="panel">
        <!--Panel heading-->
        <div class="panel-heading">
            <h3 class="panel-title">{{ __('Addons') }}</h3>
        </div>
        <div class="panel-heading">
            <h3 class="panel-title">{{ __('Product:') }} {{$myProduct->title}}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th width="20%">{{__('Name')}}</th>
                        <th>{{__('Photo')}}</th>
                        <th>{{__('Type')}}</th>
                        <th>{{__('Prices')}}</th>
                        <th></th>
                        <th>{{__('Options')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $key => $product)

                        <tr>
                            <td>{{$product->product_id}}</td>
                            <td><a href="{{ route('product',urlencode($product->handle))  }}" target="_blank">{{ __($product->title) }}</a></td>
                            <td><img class="img-md" src="http://www.4motiondarlington.org/wp-content/uploads/2013/06/No-image-found.jpg" alt="Image"></td>
                            <td>{{$product->type}}</td>
                            <td>Base price: {{ number_format($product->unit_price,2) }}

                                @php

                                    foreach ($product->hubs as $hub_prices) {
                                        echo '<BR/>'.$hub_prices->address.":".number_format($hub_prices->pivot->unit_price,2);
                                     }

                                @endphp

                            </td>
                            <td><label class="switch">
                                <input onchange="update_addon(this)" value="{{ $product->product_id }}" type="checkbox" <?php if($myProduct->hasAddon($product->product_id)) echo "checked";?> >
                                <span class="slider round"></span></label>
                            </td>
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
                                        <li><a onclick="confirm_modal('{{route('products.destroy', $product->product_id)}}');">{{__('Delete')}}</a></li>
                                        <li><a href="{{route('products.duplicate', $product->product_id)}}">{{__('Duplicate')}}</a></li>
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

        function update_addon(el){
            if(el.checked){
                var action = 1;
            }
            else{
                var action = 0;
            }
            $.post('{{ route('addons.update') }}', {_token:'{{ csrf_token() }}', id:'{{$id}}', action:action, addon_product_id: el.value}, function(data){
                console.log(data);
                if(data == 1){
                    showAlert('success', 'Todays Deal updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endsection
