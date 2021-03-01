
@extends('layouts.blank')

@section('content')





<section class="gry-bg py-2">
    <div class="card mx-auto" style="max-width: 650px;">
        <div class="card-body">
            <div class="text-center">
                <i class='la la-check-circle' style='font-size: 60px; color: rgb(247,159,142)'></i>
                <h3 class='strong mt-2' style="text-align: center">Thank you for your order</h3>
            </div>

            <hr />

            <div class='row no-gutters'>
                <span class="text-muted col-5 mb-2">{{__('Order #')}}: </span>
                <span class="col-7 text-right mb-2">{{$order_details->shopify_order_name}}</span>
                <br>
                <span class="text-muted col-5 mb-2">{{__('Delivery date')}}: </span>
                <span class="col-7 text-right mb-2">{{date('F d, Y ',strtotime($order_details->delivery_date))}}</span>
                <br>
                <span class="text-muted col-5 mb-2">{{__('Delivery time')}}: </span>
                <span class="col-7 text-right mb-2">{{$order_details->delivery_time}}</span>
                <br>
                <span class="text-muted col-5 mb-2">{{__('Customer')}}: </span>
                <span class="col-7 text-right mb-2">{{$order_details->customer->first_name }} {{$order_details->customer->last_name }}</span>
                <br>
                <span class="text-muted col-5 mb-2">{{__('Payment')}}: </span>
                <span class="col-7 text-right mb-2">{{ $order_details->shopify_payment_gateway }}</span>
            </div>

            <hr />

            <div class="row no-gutters">
                <div class="col-12 col-lg-6 col-md-6 d-flex flex-column mb-3">
                    <h3 class='strong'>{{__('Shipping Info')}}</h3>
                    <p class='strong'>{{$address->shipping_first_name }} {{$address->shipping_last_name }}</p>
                    <span>{{$address->shipping_phone }}</span>
                    <br>
                    <span>{{$address->shipping_address_1 }}</span>
                    <span>{{$address->shipping_address_2 }}</span>
                    <span>{{$address->shipping_city }} {{$address->shipping_province }}, </span>
                    <span>{{$address->shipping_country }}</span>
                </div>

                <div class="col-12 col-lg-6 col-md-6 d-flex flex-column">
                    <h3 class='strong'>{{__('Billing Info')}}</h3>
                    <p class='strong'>{{$address->billing_first_name }} {{$address->billing_last_name }}</p>
                    <span>{{$address->billing_phone }}</span>
                    <br>
                    <span>{{$address->billing_address_1 }}</span>
                    <span>{{$address->billing_address_2 }}</span>
                    <span>{{$address->billing_city }} {{$address->billing_province }}, </span>
                    <span>{{$address->billing_country }}</span>
                </div>
            </div>

            <hr />

            <div class="row no-gutters flex-column">
                <h4 class="align-self-start strong mb-2">{{__('Order Summary')}}</h4>
                @foreach($order_details->orderDetails as $order_detail)
                    @php
                        $total_item_price = $order_detail->quantity * $order_detail->price

                    @endphp
                    <div class="d-flex">
                        <div class='ml-2 d-flex flex-column flex-grow align-self-center'>
                            <span class="strong">{{$order_detail->title}}</span>
                            <span class="text-muted font-italic">Quantity : {{$order_detail->quantity}}</span>
                            <span class="text-muted font-italic">Price : {{format_price($order_detail->price)}}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <hr />

            <div class="row no-gutters">
                <span class="mb-2 col-8 text-muted initialism text-right">{{__('Subtotal')}}</span>
                <span class="mb-2 col-4 text-right">{{ format_price($order_details->total_line_items_price) }}</span>
                <br>
                <span class="mb-2 col-8 text-muted initialism text-right">Shipping {{isset($order_details->shipping_cost) ? format_price($order_details->shipping_cost) : "FREE"}}</span>
                @if($order_details->total_discounts > 0)
                    <span class="mb-2 col-8 text-muted initialism text-right">{{__('Discount')}}</span>
                    <span class="mb-2 col-4 text-right "><em>-{{ format_price($order_details->total_discounts) }}</em></span>
                @endif
            </div>

            <hr />

            <div class="d-flex">
                <div class="flex-grow-1 mr-3">
                    <h4 class="text-muted text-right strong initialism">{{__('Grand Total')}}</h4>
                </div>
                <h4 class="text-2x">{{format_price( $order_details->total_price)}}</h4>
            </div>

        </div>
    </div>
    </div>
</section>

@endsection


