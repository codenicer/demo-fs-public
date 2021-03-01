@extends('frontend.layouts.app')
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
                    $cartTotal += ($cart['price'] * $cart['quantity']);
                }
            }

            if(Session::has('coupon_discount')){
                $cartTotal -= round(Session::get('coupon_discount'));
                $cartTotal = $cartTotal < 0 ? 0 : $cartTotal;
            }

            $disable_cod = $cartTotal > 3000 ? true : false;

        @endphp

        @include('frontend.partials.checkout_header')
        <section class="py-4 gry-bg">
            <div class="container">
                <div class="row cols-xs-space cols-sm-space cols-md-space">
                    <div class="col-lg-8">
                        <form action="{{ route('payment.give_gift_checkout') }}" id="paymentSelect" class="form-default" data-toggle="validator" role="form" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-title px-4">
                                    <h3 class="heading heading-5 strong-500">
                                        {{__('Select a payment option')}}
                                    </h3>
                                </div>
                                <div class="card-header text-center p-0">
                                    <ul class="d-flex inline-links">
                                        <label class="payment_option" style='width: 20%'>
                                            <li class='flex-grow-1 d-flex align-items-center justify-content-center payment_height position-relative' style='border: 1px solid #fefefe; border-radius: 4px'>
                                                <input type="radio" id="eGHL" name='payment' value="eGHL">
                                                <div id='payment_option_indicator' class='d-none' style='position: absolute; top: 0; height: 2px; width: 100%; background: rgba(0,0,0,.6);'></div>
                                                <span>
                                                    <div class="d-flex flex-column">
                                                        <i class="fa fa-credit-card" style='font-size: 1.5rem'></i>
                                                        <span class="strong payment_option_label my-2">{{__('Credit Card')}}</span>
                                                        <span class="small" >{{__("No Fees")}}</span>
                                                    </div>
                                                </span>
                                            </li>
                                        </label>
                                        <label class="payment_option" style='width: 20%'>
                                            <li class='flex-grow-1 d-flex align-items-center justify-content-center payment_height position-relative' style='border: 1px solid #fefefe; border-radius: 4px;'>
                                                <input type="radio" id="BankBPI" name='payment' value="Bank - BPI">
                                                <div id='payment_option_indicator' class='d-none' style='position: absolute; top: 0; height: 2px; width: 100%; background: rgba(0,0,0,.6);'></div>
                                                <span>
                                                    <div class="d-flex flex-column">
                                                        <i class="fa fa-university" style='font-size: 1.5rem'></i>
                                                        <span class="strong payment_option_label my-2">{{__("Bank Deposit/ Bank Transfer")}}</span>
                                                    </div>
                                                </span>
                                            </li>
                                        </label>
                                        
                                            <label class="payment_option" style='width: 20%'>
                                        <li class='flex-grow-1 d-flex align-items-center justify-content-center payment_height position-relative' style='border: 1px solid #fefefe; border-radius: 4px'>
                                                <input type="radio" id="Paypal" name='payment' value="Paypal">
                                                <div id='payment_option_indicator' class='d-none' style='position: absolute; top: 0; height: 2px; width: 100%; background: rgba(0,0,0,.6);'></div>
                                                <span>
                                                    <div class='d-flex flex-column'>
                                                        <i class="fab fa-paypal" style="font-size: 1.5rem"></i>
                                                        <span class="strong payment_option_label my-2">{{__('Paypal')}}</span>
                                                        <span class="small">{{__('Account required')}}</span>
                                                    </div>
                                                </span>
                                        </li>
                                            </label>
                                            <label class="payment_option " style='width: 20%'>
                                        <li class='flex-grow-1 d-flex align-items-center justify-content-center payment_height position-relative' style='border: 1px solid #fefefe; border-radius: 4px;;
'>
                                                <input type="radio" id="COD" name='payment' value="COD" disabled >
                                                <div id='payment_option_indicator' class='d-none' style='position: absolute; top: 0; height: 2px; width: 100%; background: rgba(0,0,0,.6);'></div>
                                                <span>
                                                    <div class='d-flex flex-column'>
                                                        <i class="fas fa-truck" style="font-size: 1.5rem; opacity:0.3 "></i>
                                                        <span class="strong payment_option_label my-2"  style='opacity:0.5;'>{{__('Cash On Delivery')}}</span>
                                                        <span class="small"> <br></span>

                                                        @if($disable_cod)
                                                        <p style="position:absolute; font-weight:bolder; opacity: 1;">Available only for 3000 and below</p>
                                                        @endif
                                                    </div>
                                                </span>
                                        </li>
                                            </label>
                                            <label class="payment_option" style='width: 20%'>
                                        <li class='flex-grow-1 d-flex align-items-center justify-content-center payment_height position-relative' style='border: 1px solid #fefefe; border-radius: 4px'>
                                                <input type="radio" id="CPU" name='payment' value="CPU" disabled>
                                                <div id='payment_option_indicator' class='d-none' style='position: absolute; top: 0; height: 2px; width: 100%; background: rgba(0,0,0,.6);'></div>
                                                <span>
                                                    <div class='d-flex flex-column'> 
                                                        <i class="fas fa-hand-holding-usd" style="font-size:  1.5rem; opacity:0.5"></i>
                                                        <span class="strong payment_option_label my-2" style='opacity:0.5;'>{{__('Cash Pick-Up')}}</span>
                                                        <span class="small"> <br></span>

                                                    </div>
                                                    
                                                </span>
                                                {{-- <div class='h-100 w-100' style="position:absolute; top: 0; left: 0; background: rgba(200,200,200,.5); z-index: 3"></div> --}}
                                        </li>
                                            </label>
                                    </ul>
                                </div>
                                <div class="card-body" id='checkout_process_body' >
                                    
                                </div>
                            </div>

                            <div class='row flex-column flex-lg-row flex-md-row no-gutters mt-4'>
                                <a href="{{ route('cart') }}" class="link link--style-3 flex-grow-1 mb-3">
                                    <i class="fas fa-mail-reply"></i>
                                    {{__('Return to My Cart')}}
                                </a>
                                <button class="btn btn-styled btn-base-1" id="submit_button" type='submit' >{{__('Complete Order')}}</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-4 ml-lg-auto">
                        @include('frontend.cart_info_summary_for_giveback')
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript">
        $(function() {
            $('#submit_button').prop('disabled', false);
            $('#submit_button').on('click',function(){
              console.log(this);

                $(this).prop('disabled', true);
                $('#paymentSelect').submit();
            });
        });

        function use_wallet(){
            $('input[name=payment_option]').val('wallet');
            $('#checkout-form').submit();
        }

        function paymentSelect(e){
            // if(e.target.value === "CPU"){
            //     $('#checkout_process_body').html( 
            //          ` <div class="cart-title d-flex align-items-center zoomIn" style='min-height: 70px'>
            //                     <h3 style='color:red' class='strong'>Cash Pick-Up</h3>
            //             </div>
            //             <div class="card-text d-flex flex-column align-items-center zoomIn">
            //                 <span style='color:red'>Cash pickup is not available.</span>
            //                </div>
            //         `);
            //   return true;
            // }else if(e.target.value === "COD"){
            //     $('#checkout_process_body').html( 
            //          ` <div class="cart-title d-flex align-items-center zoomIn" style='min-height: 70px'>
            //                     <h3 style='color:red' class='strong'>Cash on delivery</h3>
            //             </div>
            //             <div class="card-text d-flex flex-column align-items-center zoomIn">
            //                 <span style='color:red'>Cash on delivery is not available.</span>
            //                </div>
            //         `);
            //         return true
            // }

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
