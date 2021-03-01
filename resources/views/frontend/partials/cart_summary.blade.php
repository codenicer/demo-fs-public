<link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
@php
    $c_route = Route::current();
    $c_loc = $c_route->action['as'];
@endphp
@if($c_route == 'cart')
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

        @if(session::get('user_info') && $c_loc != 'information')
            <table class='table-cart mb-2'>
                <thead>
                    <tr>
                        <th class='product-name'>{{__('Contact Info')}}</th>
                        <th class='text-right'>
                            <a class='text-md' href="{{ route('information') }}">
                                {{__('Change')}}
                            </a>
                        </th>
                    </tr>
                    <tbody>
                        <tr>
                            <td>
                                {{__('Email')}}
                            </td>
                            <td class="text-right text-muted">
                            <span>{{Session::get('user_info')['email'] ? Session::get('user_info')['email'] :''}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{__('Phone #')}}
                            </td>
                            <td class="text-right text-muted">
                                <span>{{Session::get('user_info')['phone'] ? Session::get('user_info')['phone'] :''}}</span>
                            </td>
                        </tr>
                    </tbody>
                    </tbody>
                </thead>
            </table>
        @endif
        @if(Session::get('shipping_info') && $c_loc != 'information')
            <table class="table-cart mb-2">
                <thead>
                    <tr>
                        <th class='product_name'>{{__('Shipping Info')}}</th>
                        <th class='text-right'>
                            <a class='text-md' href="{{ route('checkout.shipping_info') }}">{{__('Change')}}</a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class='product_name'>{{__('Recipient')}}</td>
                        <td>
                            <div class="text-right text-muted">
                                {{Session::get('shipping_info')['first_name'] ? Session::get('shipping_info')['first_name'] :''}}
                                {{Session::get('shipping_info')['last_name'] ? Session::get('shipping_info')['last_name'] :''}}
                            </div>
                        </td>
                    </tr>
                    <tr>
                    <td class='product_name'>{{__('Address')}}</td>
                        <td>
                            <div class="text-right text-muted">
                                <div>{{Session::get('shipping_info')['address_1'] ? Session::get('shipping_info')['address_1']:''}}</div>
                                <div>{{Session::get('shipping_info')['address_2']}}</div>
                                <div>{{Session::get('shipping_info')['city']}} {{Session::get('shipping_info')['province']}}</div>
                                <div>{{Session::get('shipping_info')['country']}} {{Session::get('shipping_info')['postal_code']}}</div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        @endif
        @if(Session::get('order_details'))
            <table class='table-cart mb-2'>
                <thead>
                    <tr>
                        <th class='product-name text-md'>Delivery Info</th>
                        <th class='text-right'>
                            <a class='text-md' href="{{ route('cart') }}">
                                change
                            </a>
                        </th>
                    </tr>
                    <tbody>
                        <tr>
                            <td>
                                {{__('Delivery Date')}}
                            </td>
                            <td class="text-right text-muted">
                                <span>{{Session::get('order_details')['delivery_date']}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{__('Delivery Time')}}
                            </td>
                            <td class="text-right text-muted">
                                <span>{{Session::get('order_details')['delivery_time']}}</span>
                            </td>
                        </tr>
                    </tbody>
                </thead>
            </table>
        @endif
        <table class="table-cart table-cart-review">

            <thead>
                <tr>
                    <th class="product-name">{{__('Product')}}</th>
                    <th class="product-total text-right">{{__('Total')}}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $subtotal = 0;
                    $tax = 0;
                    $shipping = 0;
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

                @if (Session::has('coupon_discount'))
                    <tr class="cart-shipping">
                        <th>{{__('Coupon Discount')}}</th>
                        <td class="text-right">
                            <span class="text-italic">{{ single_price(Session::get('coupon_discount')) }}</span>
                        </td>
                    </tr>
                @endif

                @php
                    $total = $subtotal+$tax+$shipping;
                    if(Session::has('coupon_discount')){
                        $total -= Session::get('coupon_discount');
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

        {{-- @if (Auth::check() && \App\BusinessSetting::where('type', 'coupon_system')->first()->value == 1) --}}
        @if (\App\BusinessSetting::where('type', 'coupon_system')->first()->value == 1 && (Request::path() != 'cart' && Request::path() != 'information' ))
            @if (Session::has('coupon_discount'))
                <div class="mt-3">
                    <form class="form-inline" action="{{ route('checkout.remove_coupon_code') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group flex-grow-1">
                            <div class="form-control bg-gray w-100">{{ \App\Coupon::find(Session::get('coupon_id'))->code }}</div>
                        </div>
                        <button type="submit" class="btn btn-base-1">{{__('Change Coupon')}}</button>
                    </form>
                </div>
            @else
                <div class="mt-3">
                    <form class="form-inline" action="{{ route('checkout.apply_coupon_code') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group flex-grow-1">
                            <input type="text" class="form-control w-100" name="code" placeholder="Have coupon code? Enter here" required>
                        </div>
                        <button type="submit" class="btn btn-base-1">{{__('Apply')}}</button>
                    </form>
                </div>
            @endif
        @endif

    </div>
</div>
@endif
