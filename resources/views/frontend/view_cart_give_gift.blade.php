@extends('frontend.layouts.app')


@section('meta_title'){{'My Cart'}}@stop

@section('meta_description'){{"My Cart"}}@stop

@section('meta_keywords'){{"My Cart"}}@stop

   
@php
    $delivery_date_for_give_gift = getBusinessSettings('give_back_delivery_date');
    $delivery_date_for_give_gift_converted_format = \Carbon\Carbon::parse($delivery_date_for_give_gift)->format('M d, Y');
    $c_route = Route::current();
    $c_loc = $c_route->action['as'];
    $product_list = [];
    $total = 0;
    $dataLayer = [];
    $currDate = date('M d');
    $currDateFormat = date('Y-m-d');
    $currDay = date('D');
    $tomDate = new DateTime('tomorrow');
    $tomDateFormat = date('Y-m-d', strtotime(' +1 day'));
    $currTime = date("G");

    $user_info = Session::get('user_info');
@endphp

   @section('content')


       <section class="slice-xs sct-color-2 border-bottom">
        <div class="container container-sm">
            <div class="row cols-delimited">
                <div class="col-6">
                    <div class="icon-block icon-block--style-1-v5 text-center {{Request::is('cart') ? 'active' : 'c-gray-light'}}">
                        <div class="block-icon mb-0">
                            <i class="la la-shopping-cart"></i>
                        </div>
                        <div class="block-content d-none d-md-block">
                            <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">1. {{__('My Cart')}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="icon-block icon-block--style-1-v5 text-center {{Request::is('checkout/payment_method') ? 'active' : 'c-gray-light'}}">
                        <div class="block-icon mb-0">
                            <i class="la la-credit-card"></i>
                        </div>
                        <div class="block-content d-none d-md-block">
                            <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">3. {{__('Payment')}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
       <section class="py-4 gry-bg" id="cart-summary">
           <div class="container">
               @php
                    $products = array();
                    $cart = [];
                    $orderDetails = Session::has('order_details');
                    $loggedIn = Auth::check();
                    $hub_name = Session::get('hub_name');
            @endphp
            @if(Session::has('cart'))
                <div class="row cols-xs-space cols-sm-space cols-md-space" style="display:block;">
                    <div class="{{ $c_loc == 'cart'? 'col-xl-12':'col-xl-8'}}">
                        <!-- <form class="form-default bg-white p-4" data-toggle="validator" role="form"> -->
                        <div class="d-flex flex-column justify-content-start form-default bg-white px-4 py-2" id='view_cart_container'>
                            <div class='d-none d-lg-flex d-md-flex d-sm-flex py-2' style='border-bottom: 1px solid #e6e6e6; border-top: 1px solid #e6e6e6; font-size: .6rem !important'>
                                <div style='width: 88px; min-width: 88px; max-width: 88px'></div>
                                <div class='text-uppercase text-center strong cart_items_title'>{{__('Product')}}</div>
                                <div class='d-flex flex-grow-1'>
                                    <div class='text-uppercase strong flex-grow-1'>{{__('Quantity')}}</div>
                                    <div class='text-uppercase strong flex-grow-1'>{{__('Total')}}</div>
                                </div>
                                <div style='width: 32px; min-width: 32px; max-width: 32px'></div>
                            </div>
                            @php
                                $total = 0;
                                $products = array();
                                $disableTwotoSeven = false;
                                $cart = Session::get('cart');
                            @endphp
                            @foreach ($cart as $key => $cartItem)
                                @php
                                    // if ($cartItem['id'] === 279 || $cartItem['id'] === 404 || $cartItem['id'] === 406 || $cartItem['id'] === 411 || $cartItem['id'] === 407 || $cartItem['id'] === 405 || $cartItem['id'] === 409 || $cartItem['id'] === 408 || $cartItem['id'] === 410){
                                    //     $disableTwotoSeven = true;
                                    // }

                                    // if(date('Y/m/d') === "2020/03/18" || date('Y/m/d') === "2020/03/19" 
                                    // || date('Y/m/d') === "2020/03/20" || date('Y/m/d') === "2020/03/21" 
                                    // || date('Y/m/d') === "2020/03/22"){
                                    //     $disableTwotoSeven = true;
                                    // }

                                    $product_list[] = $cartItem['id'];
                                    $total = $total + $cartItem['price']*$cartItem['quantity'];
                                @endphp
                                <div class='d-flex mb-3 pt-2' style='position: relative'>
                                    <img height='80px' width='80px'
                                                class='prouct-cart-image mr-2' src="{{isset($cartItem['thumbnail_img']) ? asset($cartItem['thumbnail_img']) : ''}}" />
                                        <div 
                                            class='flex-grow-1 d-flex flex-column flex-lg-row flex-md-row flex-sm-row align-items-center'>
                                        <div class='cart_items_title strong text-left text-lg-center text-md-center text-sm-center flex-grow-1'>{{ $cartItem['title'] }}</div>
                                        <div class='d-flex flex-grow-1 flex-column flex-lg-row flex-md-row flex-sm-row align-items-center'>
                                            <div class='d-flex flex-grow-1 align-items-center'>
                                                <div class='d-flex'style='border: 1px solid #e6e6e6; border-radius: 15px;'>
                                                    <button
                                                            style='border-radius: 15px 0 0 15px; background-color: white; border: none;'
                                                            class="btn-number" type="button" data-type="minus" data-field="quantity[{{ $key }}]">
                                                        <i class="la la-minus text-sm"></i>
                                                    </button>
                                                    <input type="text" name="quantity[{{ $key }}]" style='width: 25px; border-color: transparent' class="input-number text-center" placeholder="1" value="{{ $cartItem['quantity'] }}" min="1" max="10" onchange="updateQuantity({{ $key }}, this)">
                                                    <button
                                                            style='border-radius: 0px 15px 15px 0px; background-color: white; border: none;'
                                                            class="btn-number" type="button" data-type="plus" data-field="quantity[{{ $key }}]">
                                                        <i class="la la-plus text-sm"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class='flex-grow-1 product-total strong'>{{ single_price($cartItem['price']*$cartItem['quantity']) }}</div>
                                        </div>
                                        @if($cartItem['is_available'] === 0)
                                        <div id='error_cart_text'class='d-flex align-items-center text-center justify-content-center w-100 h-100' style='position: absolute; left: 0; top: 0; background: rgba(255,255,255,.8)'>
                                            <span class='strong'>This product is not available in <br/>{{$hub_name}}. <br/>Please select a different one</span>
                                        </div>
                                        @endif
                                    </div>
                                    <div style='z-index: 5'class='d-flex align-items-center justify-content-center px-2 py-1'>
                                        <a href="#" onclick="removeFromCartView(event, {{ $key }})" class="h4 m-0 text-danger">
                                            <i class="la la-trash"></i>
                                        </a>
                                    </div>
                                    <!-- @if($cartItem['is_available'] === 0)
                                    <div class='d-flex align-items-center w-100 h-100' style='position: absolute; left: 0; top: 0; background: rgba(255,255,255,.8)'>
                                        <hr class='flex-grow-1' style='background: red' />
                                        <span class='strong mx-5' style='transform: rotate(340deg); color: red; text-shadow: 1px 1px #fefefe;'>Not Available</span>
                                        <hr class='flex-grow-1 mr-5' style='background: red' />
                                    </div>
                                    @endif -->

                                </div>
                            @endforeach
                            <hr class='w-100 my-0' />
                            <form class='my-3' id='order_details' action="{{ route('cart.proceedToGiftCheckout') }}" method="POST">
                                @csrf

                              
                                    <div class='col-12 col-lg-12 col-md-12 d-flex justify-content-center'>
                                        <label class='' style='position: relative; {{$disableTwotoSeven ? 'opacity: 0.4;'  : '' }}'>
                                            <input type="radio" name="delivery_date" checked class="card-input-element" value={{$delivery_date_for_give_gift}} id='delivery_date' style='position: absolute; top: 20px; right: 20px'  required>
                                            <div class="card text-center" style='padding: 30px'>
                                                <!-- <i class='fa fa-check-square address_radio' style='position: absolute; top: -3px; right: 0; font-size: 1.2rem'></i> -->
                                                {{-- @if($currTime < 17)
                                                    <span class='h5 strong'>{{__("Get it shipped on ".$currDate)}}</span>
                                                    <span>{{__("(2-7 days depending on location)")}}</span>
                                                @else
                                                    <span class='h5 strong'>{{__("Get it shipped on ". $tomDate->format('M d'))}}</span>
                                                    <span>{{__("(2-7 days depending on location)")}}</span>
                                                @endif --}}
                                                <span class='h5 strong'>{{__("Orders are being delivered regularly to our partner hospitals based on orders received and suppliers availability.")}}</span>
                                            </div>
                                        </label>
                                    </div>
                                    


                                    <div id="billing_card" class="card my-4">
                                        <div id="billing_forms" class="card-body">
                                            <div class='d-flex align-items-center h6 card-title'>
                                                <span>{{__("My Info")}}</span>
                                                <i class='ml-2 la la-user' style='font-size: 1.5rem; background-color: white; color: rgba(0, 0, 0, 0.986);'></i>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label class="control-label">{{__('First Name')}}</label>
                                                        <input type="text"  class="form-control" name="first_name" placeholder="{{__('First Name')}}" required value="{{ @$user_info['first_name'] }}" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label class="control-label">{{__('Last Name')}}</label>
                                                        <input type="text"  class="form-control" name="last_name" placeholder="{{__('Last Name')}}" required value="{{ @$user_info['last_name'] }}" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="checkbox py-2 text-left">
                                                <input type="hidden" class="form-control" name="hospital_id" value="0" />
                                                <input type="hidden" class="form-control" name="billing_phone" value=" " />
                                                <input type="hidden"  class="form-control" name="address_1" value=" "/>
                                                <input id="marketing" class="magic-checkbox" type="checkbox" name="accepts_marketing" value='on' checked />
                                                <label for="marketing" class='text-sm'>
                                                    {{ __('Keep me up to date on news and exclusive offers') }}
                                                </label>
                                            </div>
        
                                            <div class='row'>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label class="control-label">{{__('Email')}}</label>
                                                        <input type="email" id='email'class="form-control" name="email" placeholder="{{__('Email')}}" required value="{{ @$user_info['email'] }}" />
                                                    </div>
                                                </div>
        

                                            </div>
        
                                        </div>
                                    </div>
    
                                <div class="row justify-content-end pr-3 mb-2">
                                    <div>
                                        <span>{{__('Subtotal:')}}</span>
                                        <h1>{{format_price($total)}}</h1>
                                    </div>
                                </div>
                                <div class='row flex-column flex-lg-row flex-md-row no-gutters pt-4'>
                                    <a href="{{ route('home') }}" class="link link--style-3 flex-grow-1 mb-3">
                                        <i class="la la-mail-reply"></i>
                                        {{__('Return to shop')}}
                                    </a>

                                    <button type='submit' form='order_details' class="btn btn-styled btn-base-1" {{Session::get('unavailable') ? 'disabled' : ''}}>{{__('Proceed')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-4 ml-lg-auto">
                        <!-- load clean blades here -->
                        

                    </div>
                </div>
        </div>
        @else
            <div class="dc-header text-center">
                <h3 class="heading heading-6 strong-700">{{__('Your cart is empty')}}</h3>
                <div class='btn btn-base-1 py-2 px-3 hov-bounce hov-shaddow mt-3'>
                    <a href="{{ route('home') }}" class='text-white'>{{__("Back to Shopping")}}</a>
                </div>
            </div>
            @endif
            </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="GuestCheckout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h6 class="modal-title mb-2" id="exampleModalLabel">{{__('Login')}}</h6>
                    <div class="row align-items-center">
                        <div class='col-12 col-lg-6'>
                            <form class="form-default" role="form"  action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group input-group--style-1">
                                        <input type="email" name="email" class="form-control" placeholder="{{__('Email')}}">
                                        <span class="input-group-addon">
                                            <i class="text-md ion-person"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group--style-1">
                                        <input type="password" name="password" class="form-control" placeholder="{{__('Password')}}">
                                        <span class="input-group-addon">
                                            <i class="text-md ion-locked"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="checkbox text-left">
                                        <input id="demo-form-checkbox" class="magic-checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="demo-form-checkbox" class="text-sm">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>

                                <div class='row flex-column flex-lg-row flex-md-row no-gutters'>
                                    <a href="{{ route('home') }}" class="link link-xs link--style-3 flex-grow-1 mb-3">
                                        {{__('Forgot password?')}}
                                    </a>
                                    <button class="btn btn-styled btn-base-1" id="submit_button" type='submit' >{{__('Login')}}</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 col-lg-6">
                            @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
                                <a href="{{ route('social.login', ['provider' => 'google']) }}" onclick="set_link('information')" class="btn btn-styled btn-block btn-google btn-icon--2 btn-icon-left px-4 my-4">
                                    <i class="icon fa fa-google"></i> {{__('Login with Google')}}
                                </a>
                            @endif
                            @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
                                <a href="{{ route('social.login', ['provider' => 'facebook']) }}"  onclick="set_link('information')" class="btn btn-styled btn-block btn-facebook btn-icon--2 btn-icon-left px-4 my-4">
                                    <i class="icon fa fa-facebook"></i> {{__('Login with Facebook')}}
                                </a>
                            @endif
                            @if (\App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                                <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="btn btn-styled btn-block btn-twitter btn-icon--2 btn-icon-left px-4 my-4">
                                    <i class="icon fa fa-twitter"></i> {{__('Login with Twitter')}}
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="text-center pt-2">
                        <span class="text-md">
                            {{__('Need an account?')}} <a href="{{ route('user.registration') }}" class="strong-600">{{__('Register Now')}}</a>
                        </span>
                    </div>

                    <div class='d-flex mb-1 col-12 align-items-center'>
                        <hr class='flex-grow-1'/>
                        <span class='mx-3'>{{__('or')}}</span>
                        <hr class='flex-grow-1'/>
                    </div>

                    <div class="text-center">
                        <button data-target="#GuestCheckout" id="guestCheckout" data-toggle="modal" class="btn btn-styled btn-base-1">{{__('Order without registration')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // initCalendar();
        // initPicker();
        // validateTime();

        $('#guestCheckout').on('click', function(){
            $.post('{{ route('cart.setGuestCheckout') }}',{_token:'{{ csrf_token() }}'}, function(data){

                if(data){
                    if(data['error'] === true){
                        location.reload();
                    }
                }
            });

        });


        function validateTime(date = "{{Session::get('order_details')['delivery_date']}}"){
            @if(!Session::get('campaign'))
            var currTime = {{$currTime}};
            var currDate = '{{$currDateFormat}}';
            var currDay = '{{$currDay}}';

            console.log(currTime, 'time now', currDate, 'date now', date)
                if(date === currDate){
                    if(currTime >= 8){
                        $("#delivery_time option[value='9am - 1pm'], #delivery_time option[value='12am - 3am'], #delivery_time option[value='6am - 8am']").remove();
                    }

                    if(currTime >= 12){
                        $("#delivery_time option[value='Anytime'], #delivery_time option[value='9am - 1pm'], #delivery_time option[value='1pm - 5pm']").remove();
                    }

                    if(currDay === 'Sat' || currDay === 'Sun'){
                        if(currTime >= 15){
                            $("#delivery_time option[value='Anytime'], #delivery_time option[value='9am - 1pm'], #delivery_time option[value='1pm - 5pm'], #delivery_time option[value='5pm - 8pm']").remove();
                        }
                    }
                    else{
                        if(currTime >= 17){
                            $("#delivery_time option[value='Anytime'], #delivery_time option[value='9am - 1pm'], #delivery_time option[value='1pm - 5pm'], #delivery_time option[value='5pm - 8pm']").remove();
                        }
                    }

                }
                else{
                    var defaultHtml = '';

                    @if(Session::get('hub_id') === 1)
                        defaultHtml = '<option value="" class="d-none">Choose Delivery Time</option>' +
                                      '<option value="Anytime">Anytime</option>' +
                                    //   '<option value="12am - 3am">12am - 3am</option>' +
                                      '<option value="6am - 8am">6am - 8am</option>' +
                                      '<option value="9am - 1pm">9am - 1pm</option>' +
                                      '<option value="1pm - 5pm">1pm - 5pm</option>' +
                                      '<option value="5pm - 8pm">5pm - 8pm</option>';
                                    //   '<option value="9pm - 12am">9pm - 12am</option>';
                    @else
                        defaultHtml = '<option value="" class="d-none">Choose Delivery Time</option>' +
                                      '<option value="Anytime">Anytime</option>' +
                                      '<option value="9am - 1pm">9am - 1pm</option>' +
                                      '<option value="1pm - 5pm">1pm - 5pm</option>';
                                    //   '<option value="5pm - 8pm">5pm - 8pm</option>';
                    @endif

                    var innerHtml = $("#delivery_time").html();

                    if(innerHtml !== defaultHtml){
                        $("#delivery_time").html(defaultHtml);

                    }
                    $("#delivery_time").val('{{Session::get('order_details')['delivery_time']}}');
                }
            @endif
        }

        function initPicker(){
            var EverlastHack = {!!collect(Session::get('cart'))!!};
            var newDate = '{{$currDateFormat}}';
            var initCurrTime = {{$currTime}};

            if(typeof EverlastHack === 'object'){
                EverlastHack = Object.values(EverlastHack);
                console.log(EverlastHack);
            }
            
            if(EverlastHack.length > 0){
                EverlastHack.forEach(function(item){
                    if(item.id === 324 || item.id === 325 || item.id === 391 || item.id === 279 || item.id === 408 || item.id === 409){
                        console.log(item.id, 'item id')
                        newDate = '2020-02-12';
                    }
                })
             } 
            
            if(initCurrTime >= 21){
                    newDate = '{{$tomDateFormat}}';
            }

             var bangag_campaign = {!!collect(Session::get('bangag_campaign'))!!};
             var cart = {!!collect(Session::get('cart'))!!} || null;
             var hubId = {!!collect(Session::get('hub_id'))!!}

             let tempArr
             if(hubId[0] === 2 || hubId[0] === 3){
                tempArr = ['2020-02-13', '2020-02-12', '2020-02-14', '2020-02-15','2021-02-15','2022-02-15','2023-02-15','2024-02-15', '2025-02-15', '2026-02-15'];
             } else {
                tempArr = ['2020-03-17','2020-03-18','2020-03-19','2020-03-20','2020-03-21','2020-03-22','2020-02-13', '2020-02-14', '2020-02-12', '2020-02-15', '2021-02-15','2022-02-15','2023-02-15','2024-02-15', '2025-02-15', '2026-02-15'];
             }
             let newTempArr = tempArr.concat(bangag_campaign);
             let willOpen = false;

             var removeItemFromArray = function(array, item){
                /* assign a empty array */
                var tmp = [];
                /* loop over all array items */
                for(var index in array){
                    if(array[index] !== item){
                    /* push to temporary array if not like item */
                    tmp.push(array[index]);
                    }
                }
                /* return the temporary array */
                return tmp;
            }

             if(cart){
                Object.keys(cart).filter(function(key) {
                        if(cart[key].id === 451){
                            willOpen = true;
                        }
                });
             }

             if(willOpen){
                newTempArr = removeItemFromArray(newTempArr, '2020-02-14');
             }

          if($('#deldatepicker').datepicker('getDate') == null){
            $('#delivery_time').attr('disabled', 'disabled');

          }
          $('#deldatepicker').datepicker().on('changeDate', function(e){
                      if($('#deldatepicker').datepicker('getDate') == null){
                        $('#delivery_time').attr('disabled', 'disabled');

                      }else{
                        $('#delivery_time').removeAttr("disabled", false)

                      }


          });

            $('#deldatepicker').datepicker('changeMonth', false);

            $('#deldatepicker').datepicker('setDatesDisabled', newTempArr);

            $('#deldatepicker').datepicker('setStartDate', newDate);

            $('#deldatepicker').on('changeDate', function(e){
                  
                    var isoDate = new Date(e.date.getTime() - (e.date.getTimezoneOffset() * 60000)).toISOString().slice(0,10);

                    $('#delivery_date').val(
                        isoDate
                    );

                    var date = $('#delivery_date').val();
                    validateTime(date);

                    var products = {!!collect($cart)!!};


                    if(products){
                        $.post('{{ route('cart.campaignValidator') }}',{_token:'{{ csrf_token() }}', date: date, products:products}, function(data){
                            if(data){
                                if(data['error'] === true){
                                    location.reload();
                                }

                                if(data['message'] === "Revert the time"){
                                    var date = $('#delivery_date').val();
                                    validateTime(date);
                                }
                            }
                        });
                    }
                });
        }
        
        function removeFromCartView(e, key){
            e.preventDefault();
            removeFromCart(key);
        }

        function updateQuantity(key, element){
            $.post('{{ route('cart.updateQuantity') }}', { _token:'{{ csrf_token() }}', key:key, quantity: element.value}, function(data){
                updateNavCart();
                $('#cart-summary').html(data);
            });
        }

        function showCheckoutModal(){
            $.post('{{ route('cart.removeCoupon') }}', { _token:'{{ csrf_token() }}'}, function(data){
                $('#GuestCheckout').modal();
            });
        }


        function initCalendar() {
            $('#delivery_date').change(function() {
                var date = $(this).val();

                var products = {!!collect($cart)!!};

                if(products.length > 0){
                    $.post('{{ route('cart.campaignValidator') }}',{_token:'{{ csrf_token() }}', date: date, products:products}, function(data){
                        if(data){
                            if(data['error'] === true){
                                location.reload();
                            }
                        }
                    });
                }

            });
        }

        function showCheckoutModal(){

                @if(!Session::get('guest_checkout'))
                 //   $('#GuestCheckout').modal();
                @endif

        }



        function set_link(value){

            var value = value;
            var delivery_date = $( "input[name='delivery_date']").val();
            var delivery_time = $( "input[name='delivery_time']").val();
            var message = $( "input[name='delivery_message']").val();
            var anonymous = $( "input[name='anonymous']").val();
            var instruction = $( "input[name='instruction']").val();

            $.post('{{ route('cart.set_link')}}', {_token:'{{ csrf_token() }}',
                id:value,
                delivery_date :delivery_date,
                delivery_time :delivery_time,
                message: message,
                instruction: instruction

            }, function(data){
            });
        }


        $('#order_details').on('submit', function(){
            if(!$('#delivery_date').val()){

                @if(Session::get('hub_id') !== 5)
                    alert('Please select delivery date.');
                    return false;
                @else
                    return true;
                @endif
            }else{
                return true;
            }
            return false;
        });




    </script>
       <!-- Facebook Pixel Code -->
       @if(!$dataLayer)
       <script>
           var dataLayer  = window.dataLayer || [];
           @if(Session::has('cart'))
           dataLayer.push({
               'event': 'Cart',
             'total_cart' : '{{$total}}',
             'products': [
                           @php
                               $dataLayer =  Session::get('cart');
                                $hub_id =  Session::get('hub_id');
                           @endphp
                           @foreach($dataLayer as $key => $product)
                           @php

                               $vp = \App\ViewProduct::where('product_id', $product['id'])->where('hub_id', $hub_id)
                                ->first();

                               if($vp){

                                   $category = $vp->category_name;
                               }else{
                                   $category = null;
                               }
                           @endphp
                       {
                           'name':" @php echo $product['title'];
                            @endphp ,
                           'id': '{{$product['id'] ? $product['id'] : ''}}',
                           'price': '{{$product['price']}}',
                           'quantity': '{{$product['quantity']}}',
                           'brand': 'Demo Ecommerce',
                           'category': '@php echo $category;
                           @endphp'
                       },
                       @endforeach
                   ]
           });
           @endif
       </script>
       @endif


@endsection