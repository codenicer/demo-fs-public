@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-12 mx-auto">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Track Order')}}
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <form class="" action="{{ route('orders.track') }}" method="GET" enctype="multipart/form-data">
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('Order Info')}}
                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Order Code')}} <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-8 col-xs-8">
                                            <input type="text" class="form-control mb-3" placeholder="{{__('Order Code')}}" name="order_code" required>
                                        </div>
                                        <div class="col-md-2 col-xs-2">
                                            <button type="submit" class="btn  btn-base-1"><span >{{__('Track Order')}}</span></button>
                                        </div>
                                    </div>
                                    @isset($order)
                                        <div class="card mt-4">
                                            <div class="card-header py-2 px-3 heading-6 strong-600 clearfix">
                                                <div class="float-left">{{__('Order Summary')}}</div>
                                            </div>
                                            <div class="card-body pb-0">
                                                <div class="row mb-3">
                                                    <div class="col-lg-6">
                                                        <table class="details-table table">
                                                            <tr>
                                                                <td class="w-50 strong-600">{{__('Order Number')}}:</td>
                                                                <td>{{ $order->shopify_order_name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-50 strong-600">{{__('Order Placed')}}:</td>
                                                                <td>{{ $order->created_at }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-50 strong-600">{{__('Status')}}:</td>
                                                                <td>Shipped</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-50 strong-600">{{__('Order Placed By')}}:</td>
                                                                {{--                                        <td>{{ json_decode($order->shipping_address)->address }}, {{ json_decode($order->shipping_address)->city }}, {{ json_decode($order->shipping_address)->country }}</td>--}}
                                                                <td>{{$order->customer->first_name}} {{$order->customer->last_name}}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div>
                                                            <table class="details-table table">
                                                                <tr>
                                                                    <td class="w-50 strong-600">{{__('Delivery Date')}}:</td>
                                                                    <td>{{ $order->delivery_date }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="w-50 strong-600">{{__('Delivery Time')}}:</td>
                                                                    <td>{{ $order->delivery_time }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="w-50 strong-600">{{__('Contact Email')}}:</td>
                                                                    <td>{{ $order->contact_email }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="w-50 strong-600">{{__('Payment Method')}}:</td>
                                                                    <td>{{$order->shopify_payment_gateway}}</td>
                                                                </tr>

                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                                <h6>Billing Info</h6>
                                                <hr>
                                                <div class="row mb-3">


                                                    <div class="col-lg-4">
                                                        <p>Customer Info</p>
                                                        <p class="font-weight-bold">Name: {{$order->view_order_address[0]->billing_first_name}} {{$order->view_order_address[0]->billing_last_name}}</p>
                                                        <p class="font-weight-bold">Phone: {{$order->view_order_address[0]->billing_phone}} </p>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <p>Billing Info</p>
                                                        <p class="font-weight-bold">{{$order->view_order_address[0]->billing_address_1}} {{$order->view_order_address[0]->billing_address_2}} {{$order->view_order_address[0]->billing_city}}
                                                            {{$order->view_order_address[0]->billing_province}}, {{$order->view_order_address[0]->billing_country}}</p>
                                                    </div>

                                                </div>
                                                <h6>Shipping Info</h6>
                                                <hr>
                                                <div class="row">


                                                    <div class="col-lg-4">
                                                        <p>Recipient Info</p>
                                                        <p class="font-weight-bold">Name: {{$order->view_order_address[0]->shipping_first_name}} {{$order->view_order_address[0]->shipping_last_name}}</p>
                                                        <p class="font-weight-bold">Phone: {{$order->view_order_address[0]->shipping_phone}} </p>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <p>Shipping Info</p>
                                                        <p class="font-weight-bold">{{$order->view_order_address[0]->shipping_address_1}} {{$order->view_order_address[0]->shipping_address_2}} {{$order->view_order_address[0]->shipping_city}}
                                                            {{$order->view_order_address[0]->shipping_province}}, {{$order->view_order_address[0]->shipping_country}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="card mt-4">
                                            <div class="card-header py-2 px-3 heading-6 strong-600 clearfix">
                                                <ul class="process-steps clearfix">
                                                    <li @if($order->order_status_id == '2') class="active" @else class="done" @endif>
                                                        <div class="icon">1</div>
                                                        <div class="title">{{__('Order placed')}}</div>
                                                    </li>
                                                    <li @if($order->order_status_id >= '4') class="active" @elseif($order->order_status_id >= '9') class="done" @endif>
                                                        <div class="icon">2</div>
                                                        <div class="title">{{__('On review')}}</div>
                                                    </li>
                                                    <li @if($order->order_status_id >= '7') class="active" @elseif($order->order_status_id >= '10')  class="done" @endif>
                                                        <div class="icon">3</div>
                                                        <div class="title">{{__('On delivery')}}</div>
                                                    </li>
                                                    <li @if($order->order_status_id >= '10') class="done" @endif>
                                                        <div class="icon">4</div>
                                                        <div class="title">{{__('Delivered')}}</div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-9">
                                                    <div class="card mt-4">
                                                        <div class="card-header py-2 px-3 heading-6 strong-600">{{__('Order Details')}}</div>
                                                        <div class="card-body pb-0">
                                                            <table class="details-table table">
                                                                <thead>
                                                                <tr>
                                                                    <th>Title</th>
                                                                    <th>{{__('Product')}}</th>
                                                                    <th>{{__('Quantity')}}</th>
                                                                    <th>{{__('Price')}}</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach ($order->orderDetails as $key => $orderDetail)
                                                                    <tr>
                                                                        <td>{{$orderDetail->product->title}}</td>
                                                                        <td><img src="" style="height:100px"></td>
                                                                        <td>{{ $orderDetail->quantity }} pcs
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
                                                                    <th>{{__('Tax')}}</th>
                                                                    <td class="text-right">
                                                                        <span class="text-italic">{{ single_price($order->orderDetails->sum('tax')) }}</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>{{__('Coupon Discount')}}</th>
                                                                    <td class="text-right">
                                                                        <span class="text-italic">{{ single_price($order->coupon_discount) }}</span>
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

                                    @endisset
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
