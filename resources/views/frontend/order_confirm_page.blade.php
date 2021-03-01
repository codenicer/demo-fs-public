@extends('frontend.layouts.app')

@section('content')

{{-- {{ dd($order_details->customer) }} --}}
    <section class="gry-bg py-2">
        <div class="card mx-auto" style="max-width: 650px;">
            <div class="card-body">
                <div class="text-center">
                  
                    @if($billease==true && ($order_info['status'] !=='APR' && $order_info['status'] !=='APP'))
                    <i class='la la-exclamation-triangle' style='font-size: 60px; color: rgb(247,159,142)'></i>
                    <h4 class='strong mt-2'>Your order is not approved yet!</h4>
                    @else 
                    <i class='la la-check-circle' style='font-size: 60px; color: rgb(247,159,142)'></i>
                    <h4 class='strong mt-2'>Thank you for your order</h4>
                    @endif
                    @if($billease==true)
                    <p><strong>NOTE: </strong><small>This order was made with billease transaction, please go to </small> <a href="https://billease.ph " target="_blank">Billease</a><small> to check you transaction informations.
                    </small></p>
                    @endif
                </div>
                @if($billease==true)
                    <hr />
                <div class='row no-gutters'>
                    <span class="text-muted col-6 mb-2">{{__('Message From Billease')}}: </span>
                    <span class="col-6   mb-2">{{isset($order_info['message']) ? $order_info['message'] : ''}}</span>
                    <span class="text-muted col-6 mb-2">{{__('Status')}}: </span>
                    <span class="col-6 mb-2">{{isset($order_info['status']) ? $order_info['status'] : ''.'|'.$message}}</span>
                    <span class="text-muted col-6 mb-2">{{__('Billease Transaction ID:')}}: </span>
                    <span class="col-6 mb-2">{{$trx_id}}</span>
                </div>
                @endif
                @if($billease==true)
                    @if($order_info['status']!=='APR' && $order_info['status']!=='APP' )
                    <hr />
                    <div class='row no-gutters'>
                        <span class="text-muted col-6 mb-2">{{__('Message')}}: </span>
                        <span class="col-6   mb-2">{{'Your order payment is not Approved yet. Please check your billease account and contact us immediately!'}}</span>
                    </div>
                    @endif
               @endif
                <hr />
                <div class='row no-gutters'>
                    <span class="text-muted col-6 mb-2">{{__('Order #')}}: </span>
                    <span class="col-6   mb-2">{{$order_details->shopify_order_name}}</span>

                    @if($order_details->hub_id != 6)
                    <span class="text-muted col-6 mb-2">{{__('Delivery date')}}: </span>
                    <span class="col-6 mb-2">{{$order_details->delivery_date != 0 ? date('F d, Y ',strtotime($order_details->delivery_date)) : ""}}</span>
                    <span class="text-muted col-6 mb-2">{{__('Delivery time')}}: </span>
                    <span class="col-6 mb-2">{{$order_details->delivery_time}}</span>
                    @endif

                    <span class="text-muted col-6 mb-2">{{__('Contact Email')}}: </span>
                    <span class="col-6 mb-2">{{$order_details->contact_email}}</span>
                    <span class="text-muted col-6 mb-2">{{__('Customer')}}: </span>

                    <span class="col-6 mb-2">{{$order_details->customer->first_name }} {{$order_details->customer->last_name }}</span>
                    <span class="text-muted col-6 mb-2">{{__('Payment')}}: </span>
                    <span class="col-6 mb-2">{{ $order_details->shopify_payment_gateway }}</span>
                    <span class="text-muted col-6 mb-2">{{__('Message')}}: </span>
                    <span class="col-6 mb-2">{{ $order_details->message ?  $order_details->message : "N/A" }}</span>
                    <span class="text-muted col-6 mb-2">{{__('Instruction')}}: </span>
                    <span class="col-6 mb-2">{{ $order_details->note ? $order_details->note : "N/A" }}</span>

                </div>

                <hr />

                <div class="row no-gutters">
                    <div class="col-12 col-lg-6 col-md-8 d-flex flex-column mb-3">
                        <h6 class='strong'>{{__('Shipping Info')}}</h6>
                        <span class='strong'>{{$address->shipping_first_name }} {{$address->shipping_last_name }}</span>
                        <span>{{$address->shipping_phone }}</span>
                        <span>{{$address->shipping_address_1 }}</span>
                        <span>{{$address->shipping_address_2 }}</span>
                        <span>{{$address->shipping_city }} {{$address->shipping_province }}</span>
                        <span>{{$address->shipping_country }}</span>
                    </div>

                    <div class="col-12 col-lg-6 col-md-4 d-flex flex-column">
                        <h6 class='strong'>{{__('Billing Info')}}</h6>
                        <span class='strong'>{{$address->billing_first_name }} {{$address->billing_last_name }}</span>
                        <span>{{$address->billing_phone }}</span>
                        @if($order_details->payment_id == 3)
                        <span>{{$address->billing_address_1 }}</span>
                        <span>{{$address->billing_address_2 }}</span>
                        <span>{{$address->billing_city }} {{$address->billing_province }}</span>
                        <span>{{$address->billing_country }}</span>
                            @endif
                    </div>
                </div>

                <hr />

                <div class="row no-gutters flex-column">
                    <h6 class="align-self-start strong mb-2">{{__('Order Summary')}}</h6>

                    @php

                    $product_ids = "";
                    @endphp
                    @foreach($order_details->orderDetails as $key => $order_detail)

                        @php
                            $total_item_price = $order_detail->quantity * $order_detail->price;


                           $product_ids .= ($key == 0) ? $order_detail->product_id : ",". $order_detail->product_id;



                        @endphp
                        <div class="d-flex">
                            <div class="">
                                <img style='width: 100px;' src="{{isset($order_detail->product->featured_img) ? asset($order_detail->product->featured_img) : ''}}">
                            </div>
                            <div class='ml-2 d-flex flex-column flex-grow align-self-center'>
                                <span class="strong">{{$order_detail->title}}</span>
                                <span class="text-muted font-italic">Quantity : {{$order_detail->quantity}}</span>
                                <span class="text-muted font-italic">Price : {{format_price($order_detail->price)}}</span>
                            </div>
                            <div class="flex-grow-1 text-right align-self-end">
                                <h6>{{format_price($total_item_price)}}</h6>
                            </div>
                        </div>
                        <hr />
                    @endforeach
                </div>

                <hr />

                <div class="row no-gutters">
                    <span class="mb-2 col-8 text-muted initialism text-right">{{__('Subtotal')}}</span>
                    <span class="mb-2 col-4 text-right">{{ format_price($order_details->total_line_items_price) }}</span>
                    <span class="mb-2 col-8 text-muted initialism text-right">{{__('Shipping')}}</span>
                    <span class="mb-2 col-4 text-right">{{ $order_details->shipping_cost ? format_price($order_details->shipping_cost) : "FREE" }}</span>
                    @if($order_details->total_discounts > 0)
                        <span class="mb-2 col-8 text-muted initialism text-right">{{__('Discount')}}</span>
                        <span class="mb-2 col-4 text-right "><em>-{{ format_price($order_details->total_discounts) }}</em></span>
                    @endif
                </div>

                <hr />

                <div class="d-flex">
                    <div class="flex-grow-1 mr-3">
                        <h6 class="text-muted text-right strong initialism">{{__('Grand Total')}}</h6>
                    </div>
                    <h4 class="text-2x">{{$order_details->total_price < 0 ? format_price(0) : format_price( $order_details->total_price)}}</h4>
                </div>

                </div>
            </div>
        </div>
    </section>
{{-- {{ dd($order_details->customer->created_at) }} --}}
    <script>

    const HOUR = 1000 * 60 * 60;
    const anHourAgo = Date.now() - HOUR;

        let exist_customer = 0

        if(new Date('{{ isset($order_details->customer->created_at) ? $order_details->customer->created_at : "" }}').getTime() > anHourAgo){
            // if new customer
            exist_customer = 1
        }else{
            // if existing customer
            exist_customer = 0

        }

        console.log(exist_customer);


      var dataLayer  = window.dataLayer || [];
    

    </script>
    <script src="https://affiliates2.findshare.com/FindshareAffiliateScript"></script>
    <script src="https://apis.google.com/js/platform.js?onload=renderOptIn" async defer></script>

    <script>
        window.renderOptIn = function() {
            window.gapi.load('surveyoptin', function() {
                window.gapi.surveyoptin.render(
                    {
                        "merchant_id": 123321923,
                        "order_id": '{{$order_details->shopify_order_name ? $order_details->shopify_order_name : null}}',
                        "email": '{{$order_details->contact_email ? $order_details->contact_email : ''}}',
                        "delivery_country": 'PH',
                        "estimated_delivery_date": '{{$order_details->delivery_date ? $order_details->delivery_date : ''}}'

                    });
            });
        }



    </script>
    <script type="text/javascript">
        addOrder('d6MPFEmuu0ZRuU4t',{
      	                      	productIds:'{{$product_ids}}',
        	                    	transactionId:'{{$order_details->shopify_order_name}}',
                                	totalOrder:'{{$order_details->total_price || $order_details->total_price > 0 ? $order_details->total_price : '0.00'}}',
                    	        	currency:'Php'
      	          	});
        	</script>



@endsection
