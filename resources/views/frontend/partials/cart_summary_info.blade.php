<link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">

    <div class="card sticky-top">
    <div class="card-title">
        <div class="row align-items-center">
            <div class="col-6">
                <h3 class="heading heading-3 strong-400 mb-0">
                    <span>{{__('Summary')}}</span>
                </h3>
            </div>

            <div class="col-6 text-right">
                <span class="badge badge-md badge-success">{{ count(Session::get('cart')) }} {{__('Items')}}</span>
            </div>
        </div>
    </div>

    <div class="card-body">
                     {{-- @if (Auth::check() && \App\BusinessSetting::where('type', 'coupon_system')->first()->value == 1) --}}
                     @if (\App\BusinessSetting::where('type', 'coupon_system')->first()->value == 1 && (Request::path() != 'cart' && Request::path() != 'information' ))
                     @if (Session::has('coupon_discount'))
                         <div class="mb-5">
                             <form class="form-inline" action="{{ route('checkout.remove_coupon_code') }}" method="POST" enctype="multipart/form-data">
                                 @csrf
                                 <div class="form-group flex-grow-1">
                                     <div class="form-control bg-gray w-100">{{ \App\Coupon::find(Session::get('coupon_id'))->code }}</div>
                                 </div>
                                 <button type="submit" class="btn btn-base-1">{{__('Change Coupon')}}</button>
                             </form>
                         </div>
                     @else
                         <div class="mb-5">
                             <form class="d-flex" action="{{ route('checkout.apply_coupon_code') }}" method="POST" enctype="multipart/form-data">
                                 @csrf
                                <input type="text" class="form-control w-100" name="code" placeholder="Enter coupon code" required>
                                <button type="submit" class="btn btn-base-1">{{__('Apply')}}</button>
                             </form>
                         </div>
                     @endif
                 @endif
            <table class='table-cart mb-2'>
                <thead>
                    <tr>
                        <th class='text-md product-name ' style='white-space: nowrap'> <span>{{__('Delivery Info')}}</span></th>
                        <th class='text-right'>
                            <a class='text-md' href="{{ route('cart') }}">
                                change
                            </a>
                        </th>
                    </tr>
                    <tbody>
                        <tr>
                            <td class='text-sm align-top'>
                                {{__('Message')}}
                            </td>
                            <td class="text-right text-muted text-sm">
                                <span>{{Session::get('order_details')['message']}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class='text-sm align-top'>
                                {{__('Instructions')}}
                            </td>
                            <td class="text-right text-muted text-sm">
                                <span>{{Session::get('order_details')['instruction']}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class='text-sm strong ' style='white-space: nowrap'>
                                <span>{{__('Delivery Date')}}</span>
                            </td>
                            <td class="text-right text-muted strong">
                                <span>{{Session::get('order_details')['delivery_date']}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class='text-sm strong' style='white-space: nowrap'>
                                <span>{{__('Delivery Time')}}</span>
                            </td>
                            <td class="text-right text-muted strong">
                                <span>{{Session::get('order_details')['delivery_time']}}</span>
                            </td>
                        </tr>
                    </tbody>
                </thead>
            </table>
            @if(Session::has('billing_info') or Session::has('shipping_info'))
            <table class='table-cart mb-2'>
                <thead>
                    <tr>
                        <th class='product-name text-md' style='white-space: nowrap'> <span>{{__('Addresses')}}</span></th>
                        <th class='text-right'>
                            <a class='text-md' href="{{ route('information') }}">
                                change
                            </a>
                        </th>
                    </tr>
                    <tbody>
                        @if(Session::has('billing_info'))
                        <tr>
                            <td class='text-sm strong align-top' style='white-space: nowrap'>
                                <span>{{__('Sender Info')}}<span>
                            </td>
                            <td class="text-right text-muted text-sm">
                                <div class='d-flex flex-column'>
                                    <span class='strong'>{{Session::get('billing_info')['first_name']}} {{Session::get('billing_info')['last_name']}}</span>
                                    <span>{{Session::get('billing_info')['phone']}}</span>
                                    {{--<span>{{Session::get('billing_info')['address_2']}}</span>--}}
                                    {{--<span>{{Session::get('billing_info')['city']}} {{Session::get('billing_info')['province']}}</span>--}}
                                    {{--<span>{{Session::get('billing_info')['country']}}</span>--}}
                                </div>  
                            </td>
                        </tr>
                        @endif
                        @if(Session::has('shipping_info'))
                        <tr>
                            <td class='text-sm strong align-top' style='white-space: nowrap'>
                                <span>{{__('Shipping Info')}}<span>
                            </td>
                            <td class="text-right text-muted text-sm">
                                <div class='d-flex flex-column'>
                                    <span class='strong'>{{Session::get('shipping_info')['first_name']}} {{Session::get('shipping_info')['last_name']}}</span>
                                    <span>{{Session::get('shipping_info')['phone']}}</span>
                                    <span>{{Session::get('shipping_info')['address_1']}}</span>
                                    <span>{{Session::get('shipping_info')['address_2']}}</span>
                                    <span>{{Session::get('shipping_info')['city']}} {{Session::get('shipping_info')['province']}}</span>
                                    <span>{{Session::get('shipping_info')['country']}}</span>
                                </div>  
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </thead>
            </table>
            @endif
        <table class="table-cart table-cart-review">
            <thead>
                <tr>
                    <th class="text-md product-name">{{__('Product')}}</th>
                    <th class="product-total text-right">{{__('Total')}}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $subtotal = 0;
                    $tax = 0;
                    $coupon_discount = null;
                    $shipping = Session::get('shipping_fee') != null ? Session::get('shipping_fee') : 0;

                    //Auto discount coupon
                    if(Session::get('auto_discount') && Session::get('coupon_discount')){
                        $coupon_discount = Session::get('coupon_discount');
                    }
                    else if(!Session::get('auto_discount') && Session::get('coupon_discount')){
                        $coupon_discount = Session::get('coupon_discount');
                    }
                    else if(Session::get('auto_discount') && !Session::get('coupon_discount')){
                        $coupon_discount = Session::get('auto_discount');
                    }
                @endphp
                @if(Session::get('campaign'))
                <tr>
                    <td>
                        {{__('Campaign')}}
                    </td>
                    <td class="text-right text-muted">
                        <span style="color: #f69e8d; font-family: 'Lobster', cursive; font-size: 1.6rem;">{{Session::get('campaign')}}</span>
                    </td>
                </tr>
                @endif
                @foreach (Session::get('cart') as $key => $cartItem)
                    @php
                    $product = \App\Product::find($cartItem['id']);
                    $subtotal += $cartItem['price']*$cartItem['quantity'];
                    //$tax += $cartItem['tax']*$cartItem['quantity'];
                    //$shipping += $cartItem['shipping']*$cartItem['quantity'];
                    // $product_name_with_choice = $product->name;
                    // if(isset($cartItem['color'])){
                    //     $product_name_with_choice .= ' - '.\App\Color::where('code', $cartItem['color'])->first()->name;
                    // }
                    // foreach (json_decode($product->choice_options) as $choice){
                    //     $str = $choice->name; // example $str =  choice_0
                    //     $product_name_with_choice .= ' - '.$cartItem[$str];
                    // }
                    @endphp
                    <tr class="cart_item {{ !$cartItem['is_available'] ? 'bg-danger' : ''}}">
                        <td class="product-name">
                            {{ $cartItem['title'] }}
                            <strong class="product-quantity">× {{ $cartItem['quantity'] }}</strong>
                        </td>
                        <td class="product-total text-right">
                            <span class="pl-4">{{ format_price($cartItem['price']*$cartItem['quantity']) }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @php
        /*
        <table class="table-cart table-cart-review my-4">
            <thead>
                <tr>
                    <th class="product-name">{{__('Product Shipping charge')}}</th>
                    <th class="product-total text-right">{{__('Amount')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach (Session::get('cart') as $key => $cartItem)
                    <tr class="cart_item">
                        <td class="product-name">
                            {{ \App\Product::find($cartItem['id'])->name }}
                            <strong class="product-quantity">× {{ $cartItem['quantity'] }}</strong>
                        </td>
                        <td class="product-total text-right">
                            <span class="pl-4">{{ single_price($cartItem['shipping']*$cartItem['quantity']) }} ({{ ucfirst(str_replace('_', ' ', $cartItem['shipping_type'])) }})</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        */
        @endphp

        <table class="table-cart table-cart-review">

            <tfoot>
                <tr class="cart-subtotal">
                    <th>{{__('Subtotal')}}</th>
                    <td class="text-right">
                        <span class="strong-600">{{ single_price($subtotal) }}</span>
                    </td>
                </tr>

                <tr class="cart-shipping">
                    <th>{{__('Total Shipping')}}</th>
                    <td class="text-right">
                        <span class="text-italic">{{ single_price($shipping) }}</span>
                    </td>
                </tr>

                @if ($coupon_discount != null)
                    <tr class="cart-shipping">
                        <th>{{__('Total Discount')}}</th>
                        <td class="text-right">
                            <span class="text-italic">{{ single_price($coupon_discount) }}</span>
                        </td>
                    </tr>
                @endif

                @php
                    $total = $subtotal+$tax+$shipping;
                    if($coupon_discount){
                        $total -= $coupon_discount;
                        $total = $total < 0 ? 0 : $total;
                    }
                @endphp

                <tr class="cart-total">
                    <th><span class="strong-600">{{__('Grand Total')}}</span></th>
                    <td class="text-right">
                        <strong><span>{{ single_price($total) }}</span></strong>
                    </td>
                </tr>
            </tfoot>
        </table>

    </div>
</div>

