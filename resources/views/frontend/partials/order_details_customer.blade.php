<div class="modal-header">
    <h5 class="modal-title strong-600 heading-5">{{__('Order ID')}}: {{ $order->shopify_order_name }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<style>
    @if($order->order_status_id == 11 || $order->order_status_id == 12 || $order->order_status_id == 13 || $order->order_status_id == 14 )

    .process-steps li.active:after {
        background: red !important;
    }
    @endif
</style>

@php
    $status = get_order_status($order->order_status_id);
    $payment = get_mode_of_payment($order->payment_id);
@endphp

<div class="modal-body gry-bg px-3 pt-0">
    <div class="pt-4">
        <ul class="process-steps clearfix style="color: black";">
            @if($order->order_status_id == 11 || $order->order_status_id == 12 || $order->order_status_id == 13 || $order->order_status_id == 14 )
                <li  class="done" >
                    <div class="icon" style="background: red">1</div>
                    <div class="title" style="color: red">{{__('Order placed')}}</div>
                </li>
                <li class="active" >
                    <div class="icon" style="background:red"></div>
                    <div class="title" style="color: red"></div>
                </li>
                <li class="active" >
                    <div class="icon" style="background:red"></div>
                    <div class="title"></div>
                </li>
                <li class="active">
                    <div class="icon bg-danger"><i class="fa fa-times-circle" style="font-size:30px;"></i></div>
                    <div class="title" style="color:red">@if($order->order_status_id == 11 ) failed delivery  @elseif(($order->order_status_id == 12))
                            on hold @elseif(($order->order_status_id == 13 || $order->order_status_id == 14) ) cancelled @endif</div>
                </li>
                @else
            <li @if($order->order_status_id >= 0 && $order->order_status_id < 3) class="active" @else class="done" @endif>
                <div class="icon">1</div>
                <div class="title">{{__('Order placed')}}</div>
            </li>
            <li @if($order->order_status_id >= 3 && $order->order_status_id < 7) class="active" @elseif(($order->order_status_id >= 8)) class="done" @endif>
                <div class="icon">2</div>
                <div class="title">{{__('On production')}}</div>
            </li>
            <li @if($order->order_status_id == 9) class="active" @elseif($order->order_status_id == 10) class="done" @endif>
                <div class="icon">3</div>
                <div class="title">{{__('Shipped')}}</div>
            </li>

                @endif
        </ul>
    </div>
    <div class="card mt-4">
        <div class="card-header py-2 px-3 heading-6 strong-600 clearfix">
            <div class="float-left">{{__('Order Summary')}}</div>
        </div>
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-lg-6">
                    <table class="details-table table">
                        <tr>
                            <td class="w-50 strong-600">{{__('Order ID')}}:</td>
                            <td>{{ $order->shopify_order_name}}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{__('Customer')}}:</td>
                            <td>{{ $order->customer->first_name}} {{ $order->customer->last_name}}</td>

                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{__('Email')}}:</td>
                            <td>{{ $order->contact_email}}</td>
                        </tr>
                        <tr>
                            <td class="strong-600" >{{__('Shipping address')}}:</td>
                            <td >{{ $shipping_address}}</td>

                            <!--  -->
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6">
                    <table class="details-table table">
                        <tr>
                            <td class="w-50 strong-600">{{__('Order date')}}:</td>
                            <td>{{ $order->delivery_date }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{__('Order status')}}:</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $status)) }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{__('Total order amount')}}:</td>
                            <td>{{ single_price($order->total_line_items_price) }}</td>
                        </tr>
                        <!-- <tr>
                            <td class="w-50 strong-600">{{__('Shipping method')}}:</td>
                            <td>{{__('Flat shipping rate')}}</td>
                        </tr> -->
                        <tr>
                            <td class="w-50 strong-600">{{__('Payment method')}}:</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $payment)) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9">
            <div class="card mt-4">
                <div class="card-header py-2 px-3 heading-6 strong-600">{{__('Order Details')}}</div>
                <div class="card-body pb-0">
                    <table class="details-table table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th width="30%">{{__('Product')}}</th>
                                <th >{{__('Quantity')}}</th>
                                <th>{{__('Price')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderDetails as $key => $orderDetail)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        {{ $orderDetail->title }}
                                    </td>
                                    <td class="pl-4">
                                        {{ $orderDetail->quantity }}
                                    </td>
                                    <td>{{ single_price($orderDetail->price) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card mt-4">
                <div class="card-header py-2 px-3 heading-6 strong-600">{{__('Order Amount')}}</div>
                <div class="card-body pb-0">
                    <table class="table details-table">
                        <tbody>
                            <tr>
                                <th>{{__('Subtotal')}}</th>
                                <td class="text-right">
                                    <span class="strong-600">{{ single_price($order->orderDetails->sum('price')) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>{{__('Shipping')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">{{ single_price($order->orderDetails->sum('shipping_cost')) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>{{__('Coupon Discount')}}</th>
                                <td class="text-right">
                                    <span>{{ $order->discount_code }} <em>{{ single_price($order->total_discounts) }}</em> </span>
                                </td>
                            </tr>
                            <tr>
                                <th><span class="strong-600">{{__('Total')}}</span></th>
                                <td class="text-right">
                                    <strong><span>{{ single_price($order->total_price) }}</span></strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
.process-steps li {
    width: 33.33%;
}
</style>
 
<!-- <li @if($order->order_status_id == 10) class="done"  @endif>
                <div class="icon">4</div>
                <div class="title">{{__('Delivered')}}</div>
            </li> -->