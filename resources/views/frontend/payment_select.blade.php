@extends('frontend.layouts.app')




@php
    $whitelist =[
        '09177170708','639177170708',
        '09175065874','639175065874',
        '09166085950','639166085950',
        '09984731209','639984731209',
    ];

    $billing_info = Session::get('billing_info');
    $phone = isset($billing_info['phone'] ) ? $billing_info['phone'] : null;
    $r_coupon_discount = Session::get('coupon_discount') ?round( Session::get('coupon_discount')) : 0;
    $r_shipping_fee = Session::get('shipping_fee') ? round(Session::get('shipping_fee') ): 0;
    $array = Session::get('cart')->toArray();

    $r_total = array_reduce($array,function($v1,$v2){

        $price1 =  isset($v1['price'] ) ? $v1['price'] : 0;
        $price2 =     isset($v2['price']) ? $v2['price'] : 0;

        return $price1 + $price2;
          
    });
    
    $amount_valid_for_billease = (($r_total - $r_coupon_discount) + $r_shipping_fee) > 500;
    $number_valid_for_billease = Session::get('valid_mobile_billease');


    
@endphp



@section('content')
    <script src="https://kit.fontawesome.com/1073355d0e.js" crossorigin="anonymous"></script>
    <style>
        .payment_height{
            min-height: 105px;
        }
        @media only screen and (max-width: 768px) {
            .payment_height{
                min-height: 110px;
            }
        }
        @media only screen and (max-width: 493px) {
            .payment_height{
                height: 110px;

            }
        }
        label.payment_option input:checked + div#payment_option_indicator {
            display: block !important;
        }
    </style>
    <div id="page-content" onload="checkedOnLoad()">


        @php
            $cartTotal = 0;

            if(Session::get('cart')){
                foreach(Session::get('cart') as $cart){
                    $price =  isset($cart['price']) ? $cart['price']  : 0 ;
                    $quantity = isset($cart['quantity']) ? $cart['quantity'] : 0;

                    $cartTotal += ($price * $quantity) ;
                }
            }

            if(Session::has('coupon_discount')){
                $cartTotal -= round(Session::get('coupon_discount'));
                $cartTotal = $cartTotal < 0 ? 0 : $cartTotal;
            }

            $disable_cod = $cartTotal > 3000 ? true : false;
            $ac = isset($active_camp['start_date']) ? $active_camp['start_date'] : null ; 
            $ac2 = isset($active_camp['end_date']) ? $active_camp['end_date'] : null;
            $activeCamp = isset($active_camp) ? create_date_range(ac, ac2) : [];
            $dd = null;
            if( Session::has('order_details')) {
                $dd = isset(   Session::get('order_details')['delivery_date'] ) ?    Session::get('order_details')['delivery_date']  : null;
            }
            $del_date = $dd;
        @endphp

        @include('frontend.partials.checkout_header')
        <section class="py-4 gry-bg">
            <div class="container">
                <div class="row cols-xs-space cols-sm-space cols-md-space">
                    <div class="col-lg-8">
                        <form action="{{ route('payment.checkout') }}" id="paymentSelect" class="form-default" data-toggle="validator" role="form" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-title px-4">
                                    <h3 class="heading heading-5 strong-500">
                                        {{__('Select a payment option')}}
                                    </h3>
                                </div>
                                <div class="card-header text-center p-0">

                                    <ul class="d-flex inline-links row no-gutters">

                                        <label class="payment_option col-4 col-lg-3 mb-0">
                                            <li class='flex-grow-1 d-flex align-items-center justify-content-center payment_height position-relative' style='border: 1px solid #fefefe; border-radius: 4px;'>
                                                <input type="radio" id="COD" name='payment' value="COD" >
                                                <div id='payment_option_indicator' class='d-none' style='position: absolute; top: 0; height: 2px; width: 100%; background: rgba(0,0,0,.6); z-index: 2'></div>
                                                <span class='w-100 payment_height'>
                                                    <div class="d-flex flex-column payment_height justify-content-center">
                                                        <div style='height: 35px' class='d-flex align-items-end justify-content-center'>
                                                            <i class="fas fa-truck" style="font-size: 1.7rem"></i>
                                                        </div>

                                                        <div style='height: 33px' class='d-flex align-items-start justify-content-center pt-2' >
                                                            <span class="strong payment_option_label"   >{{__('Cash On Delivery')}}</span>
                                                        </div>
                                                        <div style='height: 20px' class='d-flex align-items-start justify-content-center' >
                                                    </div>
                                                </span>
                                            </li>
                                        </label>
                                        <label class="payment_option col-4 col-lg-3 mb-0">
                                            <li class='flex-grow-1 d-flex align-items-center justify-content-center payment_height position-relative' style='border: 1px solid #fefefe; border-radius: 4px'>
                                                <input type="radio" id="CPU" name='payment' value="CPU" >
                                                <div id='payment_option_indicator' class='d-none' style='position: absolute; top: 0; height: 2px; width: 100%; background: rgba(0,0,0,.6); z-index: 2'></div>
                                                <span class='w-100 payment_height'>
                                                    <div class="d-flex flex-column payment_height justify-content-center">
                                                        <div style='height: 35px' class='d-flex align-items-end justify-content-center'>
                                                            <i class="fa fa-hand-holding-usd" style="font-size: 1.8rem" ></i>
                                                        </div>
                                                        <div style='height: 33px' class='d-flex align-items-start justify-content-center pt-2' >
                                                            <span class="strong payment_option_label" >{{__('Cash Pick-Up')}}</span>
                                                        </div>
                                                        <div style='height: 20px' class='d-flex align-items-start justify-content-center' >

                                                        </div>                                                      
                                                    </div>
                                                   
                                                        <p style="position:absolute; font-weight:bolder; opacity: 1;" class='text-sm payment_height d-flex align-items-center justify-content-center'></p>
                                         

                                                </span>
                                               
                                            </li>
                                        </label>
                                    </ul>
                                </div>
                                <div class="card-body" id='checkout_process_body' >

                                </div>
                            </div>

                            <div class='row flex-column flex-lg-row flex-md-row no-gutters mt-4'>
                                <a href="{{ route('cart') }}" class="link link--style-3 flex-grow-1 mb-3">
                                    <i class="fa fa-mail-reply"></i>
                                    {{__('Return to My Cart')}}
                                </a>
                                <button class="btn btn-styled btn-base-1" id="submit_button" type='submit' >{{__('Complete Order')}}</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-4 ml-lg-auto">
                        @include('frontend.partials.cart_summary_info')
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript">
        // var cpuSelectedProvince = {!!collect($cpu_selected_province)!!}[0]
        // $(function() {
        //     $('#submit_button').prop('disabled', false);
        //     $('#submit_button').on('click',function(){
        //         console.log(this);

        //         $(this).prop('disabled', true);
        //         $('#paymentSelect').submit();
        //     });
        // });

        function use_wallet(){
            $('input[name=payment_option]').val('wallet');
            $('#checkout-form').submit();
        }

        function paymentSelect(e){
            $.post('{{ route('checkout.payment_selected') }}', { _token:'{{ csrf_token() }}', value: e.target.value}, function(data) {
                $('#checkout_process_body').html(data);

                $("input").attr('required',true);
            });
        }

        var radios = document.querySelectorAll('input[type=radio][name="payment"]');

        radios.forEach(function(radio) {
            radio.addEventListener('change', function(event) {
                paymentSelect(event)


            } )
        })

        $("input:radio[name='payment']").click(function(){
            console.log($(this).attr('id'));
            var id = $(this).attr('id');
            $("input:radio[name='payment']").parent().parent().removeClass('trans')
            $('#'+id).parent().parent().addClass('trans')
        })
    </script>
@endsection
