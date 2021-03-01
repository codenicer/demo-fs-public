@extends('frontend.layouts.app')
@php
    $c_route = Route::current(); $c_loc = $c_route->action['as'];
    $logged_in = Auth::check();
    if($logged_in){
        $user = Auth::user();
    }else{
        $user = null;
    }
    $citiesOptions = isset($cities) ? $cities : null;
    $user_info = Session::get('user_info');
    $billing_info = Session::get('billing_info');
    $shipping_info = Session::get('shipping_info');
   
  
@endphp @section('content')

    <div id="page-content">
    @include('frontend.partials.checkout_header')
    <section class="pb-4 gry-bg">
        <div class="container">
            <div class="row py-3">
                <div class="col-lg-8">
                    <form class="d-none" id="Form2" action="{{ route('add.new.address') }}" method="POST" enctype="multipart/form-data">@csrf</form>
                    <form class="d-none" id="Form3" action="{{ route('add.new.address') }}" method="POST" enctype="multipart/form-data">@csrf</form>
                    <form class="form-default" id="form_info" data-toggle="validator" action="{{ route('information.saveUserInfo') }}" role="form" method="POST" onsubmit="return upload(this);">
                        @csrf
                        @if($logged_in)
                       
                        <div class="card mb-4">
                            <div class="card-body"  id='shipping_card'>
                                <div class='row card-title '>
                                    <div class='col-12 col-lg-8 col-md-8 d-flex align-items-center pb-1'>
                                        <span id='ship_err_text' class='h6 m-0'>{{__("Send My Flowers to (Shipping Info)")}}</span>
                                        <i class='ml-2 la la-truck' style='font-size: 1.5rem; background-color: white; color: rgba(0, 0, 0, 0.986);'></i>
                                    </div>
                                    {{--@if($shipping_address)--}}
                                    {{--<div class='col-12 col-lg-4 col-md-4 pt-1'>--}}
                                        {{--<button class="btn" id="new_shipping" type="button" ><i class="fa fa-plus"></i> {{__("New Shipping Address")}}</button>--}}
                                    {{--</div>--}}
                                    {{--@endif--}}
                                </div>
                                <div class="mb-3" >
                                    @if($shipping_address)
                               
                                        <div id="s_address_div no" class='d-flex scroll-hidden' style="overflow:hidden; overflow-x:auto ">
                                            @foreach($shipping_address as $key => $shipping)
                                                <label>
                                                    <input type="radio" name="shipping_auth_card" class="card-input-element d-none" value='<?php echo json_encode($shipping); ?>' />
                                                    <div class="card p-2">
                                                        <i class='fa fa-check-square address_radio' style='position: absolute; top: -3px; right: 0; font-size: 1.2rem'></i>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <span style='white-space: nowrap'>
                                                                    <strong class='font-weight-bold'>{{$shipping->first_name}} {{$shipping->last_name}}</strong>
                                                                    <em>({{$shipping->phone}})</em>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12 d-flex flex-column text-sm">
                                                                <span class="">{{$shipping->address_1}}</span>
                                                                <span class="">{{$shipping->address_2}}</span>
                                                                <span class="">{{$shipping->city}}, {{$shipping->province}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>
                                    <hr/>
                                    @endif
                                    <div id='shipping_form' style="display:{{empty($shipping_address) ? 'block' : 'none' }}" >

                                        <div class='row card-title '>
                                            <div class='col-12 col-lg-9 col-md-8 d-flex align-items-center pb-1'>
                                                @if(count($shipping_address) > 0)

                                                <button class="btn" id="new_shipping" type="button" ><i class="fa fa-address-book"></i> {{__("Shipping Address")}}</button>
                                                @endif

                                            </div>
                                        </div>
                                    
                                        <div class="row">
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('First Name')}}</label>
                                                    <input type="text" class="form-control" name="ship_first_name" placeholder="{{__( 'First Name')}}"    required/>
                                                    <input type="hidden" class="form-control" name="ship_customer_address_id" value="0" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12 ">
                                                <div class="form-group ">
                                                    <label class="control-label ">{{__('Last Name')}}</label>
                                                    <input type="text" class="form-control" name="ship_last_name" placeholder="{{__( 'Last Name')}}"   required/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class='row'>
                                            <div class="col-lg-6 col-12 ">
                                                <div class="form-group has-feedback ">
                                                    <label class="control-label ">{{__('Phone')}}</label>  <span name='ship-phone-text-validator' style="color:red;margin-left:2.6rem;display:none;">*Invalid phone number</span>
                                                    <div class="d-flex">
                                                        {{-- <input style="max-width:4rem; margin-right:1rem" type="text"  class="form-control" placeholder="{{__('Prefix')}}" name="ship_phone_prefix"  value={{"+63"}} required='true'/> --}}
                                                        <input type="tel"  class="form-control " placeholder="{{__( 'Phone')}} " name="ship_phone"   required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-12 ">
                                                <div class="form-group ">
                                                    <label class="control-label ">{{__('Address')}} </label>
                                                    <input type="text" class="form-control " name="ship_address_1" placeholder="{{__( 'Street address, P.O. box, company name, c/o')}} "   required/>
                                                </div>
                                            </div>
                                       
                                        </div>
                                        <div class="row ">
                                            <div class="col-md-6 ">
                                                <div class="form-group has-feedback ">
                                                    <label class="control-label ">{{__('Province / Municipality')}}</label>
                                         
                                                   @if(count($provinces) > 1)
                                                
                                                    <select id='shipping_select_province' class="form-control selectpicker" data-placeholder="Select Province / Municipality" name="ship_province" required>
                                                        <option value=""></option>
                                                        @foreach($provinces as $key => $province)
                                                            <option value="{{ $province->provDesc }}">{{ ucwords(strtolower($province->provDesc)) }}</option>
                                                        @endforeach
                                                    </select>
                                                    @else
                                                    <input type="text" class="form-control" name="ship_province" value="{{ucwords(strtolower($provinces[0]->provDesc))}}" readonly/>
                                                    @endif 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{__('City')}}</label>
                                                    <select id='shipping_select_city' class="form-control selectpicker"  data-placeholder="Select City" name="ship_city" required>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                               
                                                    <label class="control-label">{{__('Barangay / District ')}}</label>
                                                    <select id='shipping_select_baranggay' class="form-control selectpicker"  data-placeholder="Select Barangay / District" name="ship_brgy" required>
                                                      
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{__('Postal code')}}</label>
                                                    <input type="number" min="0" class="form-control" placeholder="{{__('Postal code')}}" name="ship_postal_code" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type='hidden' name="ship_country" value='Philippines'>
                                </div>
                                <input type="hidden" name="checkout_type" value="logged">
                            </div>
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
                                                <input type="text" disabled value="{{Auth::user()->first_name}}" class="form-control" name="first_names" placeholder="{{__('First Name')}}"
                                                     required value="@if($billing_info['first_name'])  $billing_info['first_name'] @else '' @endif}}" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label class="control-label">{{__('Last Name')}}</label>
                                                <input type="text" disabled value="{{Auth::user()->last_name}}" class="form-control" name="last_names" 
                                                    placeholder="{{__('Last Name')}}" required value="{{ isset($billing_info['last_name'] ) ? $billing_info['last_name'] : ''}}" />
                                            </div>
                                        </div>
                                        <input type="hidden" value="billing" name="address_type">
                                    </div>
                                    <div class="checkbox py-2 text-left">
                                        <input id="marketing" class="magic-checkbox" type="checkbox" name="accepts_marketing" value='on' checked />
                                        <label for="marketing" class='text-sm'>
                                            {{ __('Keep me up to date on news and exclusive offers') }}
                                        </label>
                                    </div>

                                    <div class='row'>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label class="control-label">{{__('Email')}}</label>
                                                <input type="email" id='email' disabled value="{{Auth::user()->email}}" class="form-control" name="email" placeholder="{{__('Email')}}" 
                                                    required value="{{ isset($user_info['email']) ? $user_info['email'] : '' }}" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label class="control-label">{{__('Phone')}}</label> <span id=bill_err_text' name='phone-text-validator' style="color:red;margin-left:2.6rem;display:none;">Invalid phone number</span>
                                                <span class="d-flex">
                                                    {{-- <input style="max-width:4rem; margin-right:1rem" type="text"  class="form-control" placeholder="{{__('Prefix')}}" name="prefix"  value={{"+63"}} required='true'/> --}}
                                                    <input type="tel" class="form-control" name="phone" id="phone" placeholder="{{__('Phone')}}" required value="{{
                                                      isset($user_info['phone']) ? $user_info['phone']   : ''
                                                   }}" />
                                                   
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <input type='hidden' name="accepts_marketing" value='on'/> --}}
                                </div>
                            </div>
                        @else
                       
                        <div id='shipping_card' class="card">
                            <div id="shipping_form" class='card-body'>
                                <div class='d-flex align-items-center h6 card-title'>
                                    <span id='ship_err_text'>{{__("Send My Flowers to: (Shipping Info)")}}</span>
                                    <i class='ml-2 la la-truck' style='font-size: 1.5rem; background-color: white; color: rgba(0, 0, 0, 0.986);'></i>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label class="control-label">{{__('First Name')}}</label>
                                            <input type="text" class="form-control" name="ship_first_name" placeholder="{{__('First Name')}}"  value="{{ isset($shipping_info['first_name'] ) ? $shipping_info['first_name']  : ''}}" required='true'/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12 ">
                                        <div class="form-group">
                                            <label class="control-label ">{{__('Last Name')}}</label>
                                            <input type="text" class="form-control" name="ship_last_name" placeholder="{{__('Last Name')}}"  value="{{ isset($shipping_info['last_name'] ) ? $shipping_info['last_name']  : ''}}" required='true'/>
                                        </div>
                                    </div>
                                    <input type="hidden" value="billing " name="address_type">
                                </div>

                                <div class='row'>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group has-feedback ">
                                            <label class="control-label ">{{__('Phone')}}</label>  <span name='ship-phone-text-validator' style="color:red;margin-left:2.6rem;display:none;">*Invalid phone number</span>
                                            <div class="d-flex">
                                                {{-- <input style="max-width:4rem; margin-right:1rem" type="text"  class="form-control" placeholder="{{__('Prefix')}}" name="ship_phone_prefix"  value={{"+63"}} required='true'/> --}}
                                                <input type="number"  class="form-control" placeholder="{{__('Phone')}}" name="ship_phone"  value="{{
                                                //   substr($shipping_info['phone'],0,1) == '0' ?    substr($shipping_info['phone'],1)  :
                                                  isset( $shipping_info['phone']) ?  $shipping_info['phone'] : ''
                                            }}" required='true'/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row ">
                                    <div class="col-12 ">
                                        <div class="form-group ">
                                            <label class="control-label">{{__('Address')}} </label>
                                            <input type="text" class="form-control" name="ship_address_1" placeholder="{{__( 'Street address, P.O. box, company name, c/o')}}"  value="{{ isset($shipping_info['address_1']) ? $shipping_info['address_1'] : '' }}" required/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row ">
                                    <div class="col-md-6 ">
                                        <div class="form-group has-feedback ">
                                            <label class="control-label ">{{__('Province / Municipality')}}</label>
                                            <select id='shipping_select_province' class="form-control selectpicker" data-placeholder="Select province" name="ship_province">
                                                <option value=""></option>
                                                @foreach($provinces as $key => $province)
                                                    <option value="{{ $province->provDesc }}"

                                                            @if(isset(Session::get('shipping_info')['shipProvCode']))
                                                                @if (Session::get('shipping_info')['shipProvCode'] === $province->provCode))
                                                                selected
                                                                @endif
                                                            @endif

                                                    >{{ ucwords(strtolower($province->provDesc)) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">{{__('City')}}</label>
                                            <select id='shipping_select_city' autocomplete="off" class="form-control selectpicker"
                                                    data-placeholder="Select city" name="ship_city" required>
                                                @if(isset($shipping_info['shipProvCode']))
                                                    @foreach(\App\CityMunicipality::where('provCode', $shipping_info['shipProvCode'])->get() as $key => $city)
                                                        <option value="{{$city->citymunDesc}}"
                                                                @if ($shipping_info['city'] === strtoupper($city->citymunDesc))
                                                                selected
                                                                @endif

                                                        >{{$city->citymunDesc}}</option>

                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">{{__('Barangay / District')}}</label>
                                            <select id='shipping_select_baranggay' class="form-control selectpicker" data-placeholder="Select Barangay / District" name="ship_brgy" required>
                                               @if(isset($shipping_info['shipCityCode']))
                                                   @foreach(\App\Baranggay::where('citymunCode', $shipping_info['shipCityCode'])->get() as $key => $brgy)
                                                   <option value="{{$brgy->brgyDesc}}"
                                                           @if($shipping_info['address_2'] === strtoupper($brgy->brgyDesc))
                                                           selected
                                                           @endif
                                                   >{{$brgy->brgyDesc}}</option>
                                                   @endforeach
                                               @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">{{__('Postal code')}}</label>
                                            <input type="number" min="0" class="form-control" placeholder="{{__('Postal code')}}" name="ship_postal_code"
                                                 value="{{ isset($shipping_info['postal_code'] ) ? $shipping_info['postal_code']  : ''}}" />
                                        </div>
                                    </div>
                                </div>
                                <input type='hidden' name="ship_country" value='Philippines'>
                            </div>
                            <input type="hidden" name="checkout_type" value="guest">
                        </div>

                        <div id="billing_card" class="card my-4">
                            <div id="billing_form" class="card-body">
                                <div class='d-flex align-items-center h6 card-title'>
                                    <span>{{__("My Info")}}</span>
                                    <i class='ml-2 la la-user' style='font-size: 1.5rem; background-color: white; color: rgba(0, 0, 0, 0.986);'></i>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label class="control-label">{{__('First Name')}}</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="{{__('First Name')}}"
                                                    required value="{{isset( $billing_info['first_name']) ?   $billing_info['first_name'] : '' }}" />
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label class="control-label">{{__('Last Name')}}</label>
                                            <input type="text" class="form-control" name="last_name" placeholder="{{__('Last Name')}}"
                                             required value="{{isset( $billing_info['last_name'] ) ?  $billing_info['last_name']  : ''}}" />
                                        </div>
                                    </div>
                                    <input type="hidden" value="billing" name="address_type">
                                </div>

                                <div class="checkbox py-2 text-left">
                                    <input id="marketing" class="magic-checkbox" type="checkbox" name="accepts_marketing" value='on' checked />
                                    <label for="marketing" class='text-sm'>
                                        {{ __('Keep me up to date on news and exclusive offers') }}
                                    </label>
                                </div>

                                <div class='row'>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label">{{__('Email')}}</label>
                                            <input type="email" id="email" class="form-control" name="email" placeholder="{{__('Email')}}" required value="{{ isset($user_info['email']) ?  $user_info['email'] : '' }}" />
                                        </div>
                                    </div>
                                </div>
                          
                                <div class='row'>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label">{{__('Country')}} {{__('Phone')}}</label> <span id='bill_err_text' name='phone-text-validator' style="color:red;margin-left:2.6rem;display:none;">Invalid phone number</span>
                                            <span class="d-flex">

                                              
                                                <input type="tel" class="form-control" name="phone" id="phone" placeholder="{{__('Phone')}}" required value="{{
                                                   isset($user_info['phone']) ?
                                                         $user_info['phone'] : 
                                                         ''  }}" />
                                            <span/>
                                        </div>
                                    </div>
                                </div>

                                {{-- <input type='hidden' name="accepts_marketing" value='on'/> --}}
                            </div>
                        </div>
                        @endif
                    </form>
                    <div class='row flex-column flex-lg-row flex-md-row  justify-content-between  no-gutters mb-3'>
                        <a href="{{ route('cart') }}" class="link link--style-3 flex-grow-1 mb-3" style="max-width:9rem">
                            <i class="la la-mail-reply"></i> {{__('Return to My Cart')}}
                        </a>
                        <button class="btn btn-styled btn-base-1 " form='form_info' id="submit_button" type='submit'>{{__('Continue')}}</button>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('frontend.partials.cart_summary_info')
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card">
                    <div class="text-center px-5 pt-5">
                        <h3 class="alert alert-danger container">
                                {{__('Email already exist would you like to log in?')}}
                            </h3>
                    </div>
                    <div class="px-5 py-3 py-lg-5">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <form class="form-default" role="form" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <!-- <label>{{ __('email') }}</label> -->
                                                <div class="input-group input-group--style-1">
                                                    <input type="email" class="form-control form-control-sm {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{Session::get('login')}}" placeholder="{{__('Email')}}" name="email" id="email">
                                                    <span class="input-group-addon">
                                                                <i class="text-md la la-user"></i>
                                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <!-- <label>{{ __('password') }}</label> -->
                                                <div class="input-group input-group--style-1">
                                                    <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{__('Password')}}" name="password" id="password">
                                                    <span class="input-group-addon">
                                                        <i class="text-md la la-lock"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="checkbox pad-btm text-left">
                                                    <input id="demo-form-checkbox" class="magic-checkbox" type="checkbox" name="remember" id="remember" {{ old( 'remember') ? 'checked' : '' }}>
                                                    <label for="demo-form-checkbox" class="text-sm">
                                                        {{ __('Remember Me') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        @if(env('MAIL_USERNAME') != null && env('MAIL_PASSWORD') != null)
                                        <div class="col-6 text-right">
                                            <a href="{{ route('password.request') }}" class="link link-xs link--style-3">{{__('Forgot password?')}}</a>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="row">
                                        <div class="col text-center">
                                            <button type="submit" class="btn btn-styled btn-base-1 btn-md w-100">{{ __('Login') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-1 text-center align-self-stretch">
                                <div class="border-right h-100 mx-auto" style="width:1px;"></div>
                            </div>
                            <div class="col-12">
                                @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
                                <a href="#" class="btn btn-styled btn-block btn-google btn-icon--2 btn-icon-left px-4 my-4">
                                    <i class="icon fa fa-google"></i> {{__('Login with Google')}}
                                </a>
                                @endif @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
                                <a href="#" class="btn btn-styled btn-block btn-facebook btn-icon--2 btn-icon-left px-4 my-4">
                                    <i class="icon fa fa-facebook"></i> {{__('Login with Facebook')}}
                                </a>
                                @endif @if (\App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                                <a href="#" class="btn btn-styled btn-block btn-twitter btn-icon--2 btn-icon-left px-4 my-4">
                                    <i class="icon fa fa-twitter"></i> {{__('Login with Twitter')}}
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="text-center px-35 pb-3">
                        <p class="text-md">
                            {{__('Need an account?')}} <a href="{{ route('user.registration') }}" class="strong-600">{{__('Register Now')}}</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
    <link rel="stylesheet" href="{{asset('frontend/css/intlTelInput.css?'.date('His'))}}">
    <script src="{{asset('frontend/js/intlTelInput.min.js?'.date('His'))}}"></script>
<script>
    //provinces options
    var selectedProvince = {!!collect($selected_province)!!}
   
    var provinceOptions = {!!collect($provinces)!!};
    console.log("selectedProvince",selectedProvince,provinceOptions)

    document.addEventListener("DOMContentLoaded", function(){
        if(selectedProvince.length > 0){
            let test = $('#shipping_select_province').select2();
            test.val(selectedProvince[0].provDesc).trigger('change')
        }
    });



    $(document).ready(function() {
        var input = document.querySelector('#phone');
        intlTelInput(input, {
            initialCountry: "PH",
            utilsScript: "{{asset('frontend/js/utils.js')}}",
            formatOnDisplay: true
        });

//        var iti = $('#phone2').intlTelInput({
//            initialCountry: "PH",
//            utilsScript: "/public/frontend/js/utils.js",
//             formatOnDisplay: true
//
//        });

        // INITIALIZATIONS




        var authUser = {!!collect($user)!!};

        ajaxHelper($('[name=ship_province').val(), '{{ route('address.get_province_id') }}', $('[name=ship_city]'), 'citymunDesc', 'citymunCode');
            
        if($('#same_address').prop('checked')=== false){
            return;
        }
        $('[name=province]').val($("[name=ship_province] option:selected").text());

        if(!authUser){
            var billingContainer = document.getElementById('billing_form');
            // all input on shipping container
            var billingInputs = billingContainer.querySelectorAll('input');
            // all select on billing container
            var billingSelects = billingContainer.querySelectorAll('select');
        }

        var newAddress;

        var shippingContainer = document.getElementById('shipping_form');

        // checkbox same address
        var sameAddress = $('#same_address');

        //select on country
        var country = $('#country_select').select2();

        // all input on shipping container
        var shippingInputs = shippingContainer.querySelectorAll('input');

        // all select on shipping container
        var shippingSelects = shippingContainer.querySelectorAll('select');

        //billing input province
        // will be remove and cached
        var billingInputProvince = $('#billing_input_province');

        //billing input city
        // will be remove and cached
        var billingInputCity = $('#billing_input_city');

        //billing input baranggay
        // will be remove and cached
        var billingInputBarangay = $('#billing_input_baranggay');

        //billing container province
        //cached input will be appended back
        var billingContainerProvince = $('#billing_container_province');

        //billing container city
        //cached input will be appended back
        var billingContainerCity = $('#billing_container_city');

        //billing container baranggay
        //cached input will be appended back
        var billingContainerBarangay = $('#billing_container_baranggay');

        // attributes for province select
        var billingSelectProvinceAttributes = {
            "class": 'form-control province_id',
            'id': 'billing_province',
            'name': 'province',
            'required': true,
        }

        // attributes for city select
        var billingSelectCityAttributes = {
            'class': 'form-control city_id',
            'id': 'billing_city',
            'name': 'city',
            'required': true,
            'disabled': false
        }

        // attributes for baranggay select
        var billingSelectBarangayAttributes = {
            'class': 'form-control brgy_id',
            'id': 'billing_baranggay',
            'name': 'brgy',
            'required': true,
            'disabled': false
        }

        // create select province with respective attributes
        var billingSelectProvince = $('<select>').attr(billingSelectProvinceAttributes);

        // create select city with respective attributes
        var billingSelectCity = $('<select>').attr(billingSelectCityAttributes);

        // create select baranggay with respective attributes;
        var billingSelectBarangay = $('<select>').attr(billingSelectBarangayAttributes);

        //provinces options
        var provinceOptions = {!!collect($provinces)!!};

        //FUNCTIONS

        // get value of province in select option
        function get_province_id(el) {
            
            
            var province_id = $(el).val();
            $(el).closest('.address-choose').find('.city_id').html(null);
            $.post('{{ route('address.get_province_id') }}', {
                    _token: '{{ csrf_token() }}',
                    province_id: province_id
                },
                function(data) {
                    for (var i = 0; i < data.length; i++) {

                        var select_value = makeLowerCase(data[i].citymunDesc)

                        $(el).closest('.address-choose').find('.city_id').append($('<option>', {
                            value: select_value,
                            text: select_value
                        })).attr('selected', true);
                    }
                    get_city_id(makeLowerCase(data[0].citymunDesc));
                });
            $(el).closest('.address-choose').find('.brgy_id').html(null);

        }

        // get value of city in select option
        function get_city_id(el) {
            
            var city_id = $(el).val() || String(el);
            $(el).closest('.address-choose').find('.brgy_id').html(null);
            $.post('{{ route('address.get_city_id') }}', {
                    _token: '{{ csrf_token() }}',
                    city_id: city_id
                },
                function(data) {
                    for (var i = 0; i < data.length; i++) {

                        var select_value = makeLowerCase(data[i].brgyDesc)
                        $('.brgy_id').append($('<option>', {
                            value: select_value,
                            text: select_value
                        }));
                    }
                });
        }

        // set shipping_info session when set button was clicked
        function set_shipping_address(value) {


            $.post('{{ route('information.set_shipping_address')}}', {
                    _token: '{{ csrf_token() }}',
                    id: value
                },
                function(data) {
                    console.log(data);
                });
        }

        // set billing_info session when set button was clicked
        function set_address(value) {


            $.post('{{ route('information.set_billing_address')}}', {
                    _token: '{{ csrf_token() }}',
                    id: value
                },
                function(data) {

                    console.log(data);
                });
        }

        //set shipping values
        function setShippingValues(pJson){
            //console.log('called set shipping', pJson);
            try{


                if(typeof pJson === 'string'){

                    
                    $obj = JSON.parse(pJson);
                }else{
                    $obj = pJson;
                }


                if($obj.hasOwnProperty('phone')){
                    if($obj['phone'].startsWith('0',0)){
                        $obj={
                            ...$obj,
                            'phone':$obj['phone'].substring(1),
                            'prefix':'+63'
                        }
                    }else if($obj['phone'].startsWith('+63',0) ){
                        $obj={
                            ...$obj,
                            'phone':$obj['phone'].substring(3),
                            'prefix':'+63'
                        }
                    }else if( $obj['phone'].startsWith('63',0)){
                        $obj={
                            ...$obj,
                            'phone':$obj['phone'].substring(2),
                            'prefix':'+63'
                        }
                    }
                }

               


                $('[name=ship_first_name]').val($obj.hasOwnProperty('first_name') ? $obj['first_name']:'');
                $('[name=ship_last_name]').val($obj.hasOwnProperty('last_name') ? $obj['last_name']:'');
                $('[name=ship_country]').val($obj.hasOwnProperty('country') ? $obj['country']:'');

                if($obj.hasOwnProperty('country')){
                    $("[name=ship_country] option:contains(" + $obj['country'] + ")").attr('selected', 'selected');
                }
                if(!$('[name=ship_country]').val()){
                    $('[name=ship_country]').val('PH');
                }   

               
                $('[name=ship_phone_prefix]').val($obj.hasOwnProperty('prefix') ? $obj['prefix']:'');
                $('[name=ship_phone]').val($obj.hasOwnProperty('phone') ? $obj['phone']:'');




                $('[name=ship_address_1]').val($obj.hasOwnProperty('address_1') ? $obj['address_1']:'');
                $('[name=ship_postal_code]').val($obj.hasOwnProperty('zip') ? $obj['zip'] === null ? $obj.hasOwnProperty('postal_code') ? $obj['postal_code'] :'':$obj['zip']:$obj.hasOwnProperty('postal_code') ? $obj['postal_code'] :'');
                $('[name=ship_city]').val($obj.hasOwnProperty('city') ? $obj['city']:'');

                $('[name=ship_province]').val($obj.hasOwnProperty('province') ? $obj['province']:'');
                $('[name=ship_brgy]').val($obj.hasOwnProperty('address_2') ? $obj['address_2']:'');
                $('[name=ship_customer_address_id]').val($obj.hasOwnProperty('customer_address_id') ? $obj['customer_address_id']:0);



                setAddressValues($('[name=ship_province]'),$('[name=ship_city]'),$('[name=ship_brgy]'), $obj);


                if($obj.hasOwnProperty('customer_address_id')){
                    $("[id^='srow_']").removeClass('active_address');
                    $('#srow_'+$obj['customer_address_id']).addClass('active_address');
                }

            }catch(e){
                console.log('Error Setting Shipping Values', e);
            }


        }

        ///set billing values
        function setBillingValues(pJson){
         
            try{


                if(isString(pJson)){
                    $obj = JSON.parse(pJson);
                }else{
                    $obj = pJson;
                }

                $('[name=first_name]').val($obj.hasOwnProperty('first_name') ? $obj['first_name']:'');
                $('[name=last_name]').val($obj.hasOwnProperty('last_name') ? $obj['last_name']:'');
                $('[name=country]').val($obj.hasOwnProperty('country') ? $obj['country']:'PH');
                $('[name=phone]').val($obj.hasOwnProperty('phone') ? $obj['phone']:'');
                $('[name=address_1]').val($obj.hasOwnProperty('address_1') ? $obj['address_1']:'');
                $('[name=postal_code]').val($obj.hasOwnProperty('zip') ? $obj['zip'] === null ? $obj.hasOwnProperty('postal_code') ? $obj['postal_code'] :'':$obj['zip']:$obj.hasOwnProperty('postal_code') ? $obj['postal_code'] :'');

                $('[name=province]').val($obj.hasOwnProperty('province') ? $obj['province']:'');
                $('[name=brgy]').val($obj.hasOwnProperty('address_2') ? $obj['address_2']:'');
                $('[name=city]').val($obj.hasOwnProperty('city') ? $obj['city']:'');
                $('[name=customer_address_id]').val($obj.hasOwnProperty('customer_address_id') ? $obj['customer_address_id']:0);

                if($('[name=province]').attr('type') === 'select'){
                    setAddressValues($('[name=province]'),$('[name=city]'),$('[name=brgy]'), $obj);
                }



                if($obj.hasOwnProperty('customer_address_id')){
                    $("[id^='brow_']").removeClass('active_address');
                    $('#brow_'+$obj['customer_address_id']).addClass('active_address');
                }

            }catch(e){
                console.log('Error Setting Billing Values');
            }



        }
       

        function setBillingValuesFromShipping(){
            let ship_phone_val = $('[name=ship_phone]').val()
            $('[name=first_name]').val($('[name=ship_first_name]').val());
            $('[name=last_name]').val($('[name=ship_last_name]').val());
            $('[name=country]').val($('[name=ship_country]').val());
            $('[name=prefix]').val($('[name=ship_phone_prefix]').val());
            $('[name=phone]').val( ship_phone_val.substring(0,1)== '0' ?    ship_phone_val.substring(1) : ship_phone_val);
            $('[name=address_1]').val($('[name=ship_address_1]').val());
            $('[name=postal_code]').val($('[name=ship_postal_code]').val());

            $('[name=province]').val($("[name=ship_province] option:selected").text());
            $('[name=brgy]').val($("[name=ship_brgy] option:selected").text());
            $('[name=city]').val($("[name=ship_city] option:selected").text());
            console.log('set values from shipping');
        }

        //set heirarchical valu
        function setAddressValues(objProvince,objCity,objBrgy, objValues){
            // console.log('call started', objValues);

            
            $.extend($.expr[':'], {
                'icontains': function(elem, i, match, array) {
                    return (elem.textContent || elem.innerText || elem.value ).toLowerCase()
                            .indexOf((match[0]).toLowerCase()) >= 0;
                }
            });


            if(objValues.hasOwnProperty('province')){
                
                $("[name="+objProvince.attr('name')+"] option:icontains(" + objValues['province'].toUpperCase() + ")").attr('selected', 'selected');
              
               
               var request =
                $.ajax({
                    type: "POST",
                    url: "{{route('address.get_province_id')}}",
                    data: {'value' : objProvince.val(),
                        "_token": "{{ csrf_token() }}"},
                    dataType: "json",
                    success: function(data){
                        //console.log('data',data);
                        // console.log('city', objValues['city']);
                        optionsHelper($(objCity), data, 'citymunDesc', 'citymunCode', objValues.hasOwnProperty('city')? objValues['city']:null);

                        console.log( $(objCity).val(objValues['city'].toUpperCase()),'hahahahah');

                        // $(objCity).val(objValues['city'].toUpperCase());

                    }
                }), chained = request.then(function(data){
                        $.ajax({
                        type: "POST",
                        url: "{{route('address.get_city_id')}}",
                        data: {'value' : objCity.val(),
                            "_token": "{{ csrf_token() }}"},
                        dataType: "json",
                        success: function(data){

                            //console.log('data',data);
                            // console.log('address2', objValues['address_2']);


                            optionsHelper($(objBrgy), data, 'brgyDesc', 'id', objValues.hasOwnProperty('address_2')? objValues['address_2']:null);
                                // console.log($(objBrgy).val(objValues['brgy'].toUpperCase()))
                            // $(objBrgy).val(objValues['brgy'].toUpperCase());

                            // $("[name="+objBrgy.attr('name')+"] option:contains(" + objValues['address_2'].toUpperCase() + ")").attr('selected', 'selected');

                        }
                    })
                })
            }


        }


        function setInputTypeBilling(){

            if($('#billing_province').attr('type') === 'text'){
                return;
            }

            // and remove select in the dom
            $('#billing_province').select2('destroy');
            billingSelectProvince.remove();

            $('#billing_city').select2('destroy');
            billingSelectCity.remove();

            $('#billing_baranggay').select2('destroy');
            billingSelectBarangay.remove();

            // append the inputs
            billingContainerProvince.append(billingInputProvince);
            billingContainerCity.append(billingInputCity);
            billingContainerBarangay.append(billingInputBarangay);

        }

        function setSelectTypeBilling(){
            // remove billing input and change it to select
            if($('#billing_province').attr('type') === 'select'){
                return;
            }

            billingInputProvince.remove();
            billingInputCity.remove();
            billingInputBarangay.remove();

            // appending the select and init select 2
            billingContainerProvince.append(billingSelectProvince);
            $('#billing_province').select2({
                placeholder: 'Select your Province / Municipality'
            }).on('change', function(e) {
                ajaxHelper(e.target.value, '{{ route('address.get_province_id') }}', $('#billing_city'), 'citymunDesc', 'citymunCode')
            })

            billingContainerCity.append(billingSelectCity);
            $('#billing_city').select2({
                placeholder: 'Select your City'
            }).on('change', function(e) {
                ajaxHelper(e.target.value, '{{ route('address.get_city_id') }}', $('#billing_baranggay'), 'brgyDesc', 'id')
            });

            billingContainerBarangay.append(billingSelectBarangay);
            $('#billing_baranggay').select2({
                placeholder: 'Select your Barangay /District'
            });

        }

        function offEventBind(){
            $("[name^='ship_']").off('change');
        }
        function bindShippingToBilling(){




            //set events
            $('[name=ship_first_name]').on('change', function(){

                if($('#same_address').prop('checked')=== false){
                    return;
                }

                $('[name=first_name]').val($('[name=ship_first_name]').val());
            });

            $('[name=ship_last_name]').on('change', function(){
                if($('#same_address').prop('checked')=== false){
                    return;
                }
                $('[name=last_name]').val($('[name=ship_last_name]').val());
            });

            $('[name=ship_country]').on('change', function(){
                if($('#same_address').prop('checked')=== false){
                    return;
                }
                $('[name=country]').val($('[name=ship_country]').val());
            });

            $('[name=ship_phone]').on('change', function(){
                let ship_phone_val = $('[name=ship_phone]').val()
                if($('#same_address').prop('checked')=== false){
                    return;
                }
                $('[name=phone]').val( ship_phone_val.substring(0,1)== '0' ?  ship_phone_val.substring(1) : ship_phone_val);
            });

            
            // $('[name=ship_phone_prefix]').on('change', function(){
            //     if($('#same_address').prop('checked')=== false){
            //         return;
            //     }
            //     $('[name=prefix]').val($('[name=ship_phone_prefix]').val());
            // });

            
         

            $('[name=ship_address_1]').on('change', function(){
                if($('#same_address').prop('checked')=== false){
                    return;
                }
                $('[name=address_1]').val($('[name=ship_address_1]').val());
            });
            $('[name=ship_postal_code]').on('change', function(){
                if($('#same_address').prop('checked')=== false){
                    return;
                }
                $('[name=postal_code]').val($('[name=ship_postal_code]').val());
            });

            $('[name=ship_brgy]').on('change', function(){
                if($('#same_address').prop('checked')=== false){
                    return;
                }
                $('[name=brgy]').val($("[name=ship_brgy] option:selected").text());
            });
            
            
            $('[name=ship_province]').on('change', function(e){
                ajaxHelper(e.target.value, '{{ route('address.get_province_id') }}', $('[name=ship_city]'), 'citymunDesc', 'citymunCode');
                if($('#same_address').prop('checked')=== false){
                    return;
                }
                $('[name=province]').val($("[name=ship_province] option:selected").text());
            });

                
            $('[name=ship_city]').on('change', function(e) {
                ajaxHelper(e.target.value, '{{ route('address.get_city_id') }}', $('[name=ship_brgy]'), 'brgyDesc', 'id');
                if($('#same_address').prop('checked')=== false){
                    return;
                }
                $('[name=city]').val($("[name=ship_city] option:selected").text());
            });
        }

        function billingReadOnly(state){

            $('[name=first_name]').attr('readonly', state);
            $('[name=last_name]').attr('readonly', state);
            $('[name=country]').attr('disabled', state);
            $('[name=phone]').attr('readonly', state);
            $('[name=address_1]').attr('readonly', state);
            $('[name=postal_code]').attr('readonly', state);

            $('[name=province]').attr('readonly', state);
            $('[name=brgy]').attr('readonly', state);
            $('[name=city]').attr('readonly', state);
        }


        //EVENTS

        $('.city_id').on('change', function() {
            get_city_id(this);
        });




        $('#submit_button').on('click', function(){
            $('#submit_button1').trigger('click');
        });


        function phoneValidatro4Billease(){
            // console.log('tel:',prefix,phone_number);

           //var input = $('#phone2');
            var input = document.querySelector('#phone');
            var iti = window.intlTelInputGlobals.getInstance(input);
            const number = iti.getNumber(intlTelInputUtils.numberFormat.E164)
            // alert('Number: '+number+ 'is valid:'+ iti.isValidNumber() );
            
         
            const isvalid = iti.isValidNumber()
            const country_code = iti.s.iso2
            

            

            return {
                    valid:isvalid,
                    valid_for_billease:country_code == 'ph' && isvalid,
                    number
                }

            
            
        }

         $('[name=phone]').on('change', function(e){
           
              let validation = phoneValidatro4Billease()

              $('[name=phone]').val(validation.number)
              if(validation.valid){
                    $('[name=phone-text-validator]')[0].style.display = 'none'
              }else{
                 $('[name=phone-text-validator]')[0].style.display = ''
              }
        });


        
        $('[ name=billing_phone]').on('change', function(e){
            
               
            let validation = phoneValidatro4Billease()

              if(validation.valid){
                
                    $('[ name=billing_phone]').val(number)
                    $('[name=phone-text-validator]')[0].style.display = 'none'
              }else{
                 $('[name=phone-text-validator]')[0].style.display = ''
              }
        });

        

        // $('[name=prefix]').on('change', function(e){
            
             
        //       let validation = phoneValidatro4Billease()

        //       if(validation.valid){
        //             $('[name=phone-text-validator]')[0].style.display = 'none'
        //       }else{
        //          $('[name=phone-text-validator]')[0].style.display = ''
        //       }
        // });

        
         $("#form_info").submit( function(eventObj) {
            
              let login = '{{$logged_in}}'

                if(!!login){
                 
                  

                    // let ship_phone = $('[name=ship_phone]').val() 
                    // let ship_phone_prefix =  $('[name=ship_phone_prefix]').val() ;
                    
                    
               
                    // let validation_for_shipping_info = phoneValidatro4Billease(ship_phone_prefix,ship_phone)
                    let validation_for_customer_info = phoneValidatro4Billease()

                    $('[name=phone]').val(validation_for_customer_info.number)
                    
                    $("<input />").attr("type", "hidden")
                                .attr("name", "number_valid_for_billease")
                                .attr("value", validation_for_customer_info.valid_for_billease)
                                .appendTo("#form_info");
                                
                    // $("<input />").attr("type", "hidden")
                    //     .attr("name", "shipping_phone_is_valid")
                    //     .attr("value",validation_for_shipping_info.valid )
                    //     .appendTo("#form_info");

                    $("<input />").attr("type", "hidden")
                        .attr("name", "customer_phone_is_valid")
                        .attr("value",validation_for_customer_info.valid )
                        .appendTo("#form_info");

                        
                //   if(validation_for_shipping_info.valid === false){
                //       $('[name=ship-phone-text-validator]')[0].style.display = ''
                //     //   alert('Invalid phone shipping number.')
                //       let elmnt = document.getElementById("ship_err_text");
                //       elmnt.scrollIntoView();
                //       $('[name=billing_phone]').focus()
                //       return false;
                //   }else
                   if (validation_for_customer_info.valid === false){
                      $('[name=phone-text-validator]')[0].style.display = ''
                    //   alert('Invalid billing phone number.')
                 
                      return false;
                  }


                }else{
                  
                 

                    // let ship_phone = $('[name=ship_phone]').val() 
                    // let ship_phone_prefix =  $('[name=ship_phone_prefix]').val() ;
                    
                    
                    // let validation_for_shipping_info = phoneValidatro4Billease(ship_phone_prefix,ship_phone)
                    let validation_for_customer_info = phoneValidatro4Billease()
                    $('[name=phone]').val(validation_for_customer_info.number)

                    //  if(prefix == '+63'){
                    //         $('[name=phone]').val('0'+phone)
                    //   }else{
                    //         $('[name=phone]').val(prefix.replace( /^\D+/g, '')+phone)
                    //  }

                    // if(ship_phone_prefix == '+63'){
                    //     $('[name=ship_phone]').val('0'+ship_phone)
                    // }else{
                    //     $('[name=ship_phone]').val(ship_phone_prefix.replace( /^\D+/g, '')+ship_phone);
                    // }
                    
                    $("<input />").attr("type", "hidden")
                                .attr("name", "number_valid_for_billease")
                                .attr("value", validation_for_customer_info.valid_for_billease)
                                .appendTo("#form_info");
                                
                    // $("<input />").attr("type", "hidden")
                    //     .attr("name", "shipping_phone_is_valid")
                    //     .attr("value",validation_for_shipping_info.valid )
                    //     .appendTo("#form_info");

                    $("<input />").attr("type", "hidden")
                        .attr("name", "customer_phone_is_valid")
                        .attr("value",validation_for_customer_info.valid )
                        .appendTo("#form_info");


                                // if($request->shipping_phone_is_valid == 'false'){
                                //     flash(__('Invalid phone shipping number.'))->warning();
                                //     return redirect()->route('information');
                                // }else if( $request->customer_phone_is_valid == 'false'){
                                //     flash(__('Invalid phone billing number.'))->warning();
                                //     return redirect()->route('information');
                                // }

                //   if(validation_for_shipping_info.valid === false){
                //       $('[name=ship-phone-text-validator]')[0].style.display = ''
                    
                //     //   alert('Invalid shipping phone number.')
                //       let elmnt = document.getElementById("ship_err_text");
                //       elmnt.scrollIntoView();
                //           $('[name=ship_phone]').focus()
                //       return false;
                //   }else
                   if (validation_for_customer_info.valid === false){
                      $('[name=phone-text-validator]')[0].style.display = ''
                      $('[name=phone]').focus()
                    //   alert('Invalid billing phone number.')
                    
                      return false
                  }

             }

             return true;
        });


        


        @if($user && $user->user_type == 'customer')
                $('#shipping_form').show();

            @if($shipping_address)
                $('#new_shipping').on('click', function(){


                $('input[name="shipping_auth_card"]').removeAttr('checked');

                setShippingValues(JSON.stringify(
                    {
                        "customer_address_id":0,
                        "address_1":"",
                        "city":"",
                        "province":"",
                        "country":"PH",
                        "zip":"",
                        "province_code":null,"country_code":null,"latitude":null,"longtitude":null
                    }
                ));
                $("[id^='srow_']").removeClass('active_address');

                if(selectedProvince.length > 0){
                    let test = $('#shipping_select_province').select2();
                    test.val(selectedProvince[0].provDesc).trigger('change')
                }

                newAddress  = true;

            });
            @endif
            @if($user_address)
                $('#new_billing').on('click', function(){

                $('input[name="billing_auth_card"]').removeAttr('checked');
                newAddress  = true;
                $('#billing_form').show();
                $('#b_address_div').show();
                $('#same_address').removeAttr('checked');
                setBillingValues(JSON.stringify(
                    {
                        "customer_address_id":0,
                        "address_1":"",
                        "city":"",
                        "province":"",
                        "country":"PH",
                        "zip":"",
                        "province_code":null,"country_code":null,"latitude":null,"longtitude":null
                    }
                ));
            });
            @endif

            $('input[name="shipping_auth_card"]').on('click', function(e) {

                 
                    shippingContainer.setAttribute('style', 'display:block');


                    setShippingValues(e.target.value);

                    if($('#same_address').prop('checked')){
                        //SHOULD BE INPUT
                        setInputTypeBilling();
                        console.log('shipping data',e.target.value);
                        setBillingValues(e.target.value);
                        billingReadOnly(true);


                    }


            });
            

            function setPrefixWhenLogin(){

            }

            $('input[name="billing_auth_card"]').on('click', function(e) {
                // all input on shipping container
                newAddress  = false;
                billingInputs = billingContainer.querySelectorAll('input');

                // all select on billing container
                billingSelects = billingContainer.querySelectorAll('select');

                sameAddress.checked = false;
                sameAddress.removeAttr('checked');

                // enable the select when checked is false
                country.select2({
                    disabled: false
                });

                // show the billing info form
                billingContainer.setAttribute('style', 'display: block');

                //billing form required will be required
                billingInputs.forEach(function(input) {
                    input.required = true;
                });

                billingSelects.forEach(function(select) {
                    select.required = true;
                });

                setInputTypeBilling();

                setBillingValues(e.target.value);


            });

            sameAddress.on('click', function(e){
                if(e.target.checked){
                    $('#billing_form').show();
                    $('#b_address_div').hide();
                    setInputTypeBilling();
                    setBillingValuesFromShipping();
                    billingReadOnly(true);

                }else{
                    $('#billing_form').show();
                    $('#b_address_div').show();
                    billingReadOnly(false);
                }




            });
         @else
         
            if($('[name=ship_province]').val()){
             $('[name=ship_province]').trigger('click');
            }


            sameAddress.on('click', function(e){
             if(e.target.checked){
                 setBillingValuesFromShipping();
                 setInputTypeBilling();
                 billingReadOnly(true);

             }else{
                 billingReadOnly(false);
             }


            });

         @endif













        //explicit calls
        @if(Session::has('login'))
        $("#loginModal").modal('show');
        @endif

        //if session shipping has info
        @if($shipping_info)

            @if(isset($shipping_info['customer_address_id']) && $shipping_info['customer_address_id'] == 0)
                setShippingValues(
                   <?php echo json_encode($shipping_info); ?>
                );
            @else

            @endif

        @endif
        @if($billing_info)

            @if(isset($billing_info['customer_address_id']) && $billing_info['customer_address_id'] == 0)
                setBillingValues(<?php echo json_encode($billing_info); ?>);
            @else

            @endif

        @endif

        optionsHelper(billingSelectProvince, provinceOptions, 'provDesc', 'provCode');
        bindShippingToBilling();


            @if(isset($billing_info['same_address']) && $billing_info['same_address'] == 'on')
                 $('#billing_form').show();
                 $('#b_address_div').hide();
                 setInputTypeBilling();
                 billingReadOnly(true);
            @endif

    });


</script>

 @endsection @section('script')
<script>

    //helper

    // select opiton helper on ajax
    // adding empty option for placeholder
    function optionsHelper(parent, arr, key, val, initValue) {

        parent.empty();
        parent.append($('<option></option>'));
        if(!arr)return;
        arr.forEach(function(x) {
            
            
           if(key === 'citymunDesc'){
                
                
                if(x['citymunDesc'].toUpperCase() === "{{strtoupper(isset(Session::get('shipping_info')['city']) ? Session::get('shipping_info')['city'] : '')}}"){
                    
                    var option = $('<option selected>').val(x[key].toUpperCase()).html(x[key].toLowerCase().replace(/\b[a-z]/g, function(letter) {
                        return letter.toUpperCase();
                    }));
                }
                else{
                    var option = $('<option>').val(x[key].toUpperCase()).html(x[key].toLowerCase().replace(/\b[a-z]/g, function(letter) {
                        return letter.toUpperCase();
                    }));
                }
           }
            else{
                if(x['brgyDesc']){  
                    if(x['brgyDesc'] == val){
                        var option = $('<option selected>').val(x[key].toUpperCase()).html(x[key].toLowerCase().replace(/\b[a-z]/g, function(letter) {
                            return letter.toUpperCase();
                        }));
                    }else{
                        var option = $('<option>').val(x[key].toUpperCase()).html(x[key].toLowerCase().replace(/\b[a-z]/g, function(letter) {
                            return letter.toUpperCase();
                        }));
                    }
                }else{
                    var option = $('<option>').val(x[key].toUpperCase()).html(x[key].toLowerCase().replace(/\b[a-z]/g, function(letter) {
                        return letter.toUpperCase();
                    }));
                }
            }
           
            parent.append(option);
        });
               
        if(key==='citymunDesc'){
            @if($logged_in && count($shipping_address) > 0){
                ajaxHelper($('[name=ship_city').val(), '{{ route('address.get_city_id') }}', $('[name=ship_brgy]'), 'brgyDesc', '{{$shipping_address[0]->address_2}}');
            }
            @else{
                console.log(1);
                
                ajaxHelper($('[name=ship_city').val(), '{{ route('address.get_city_id') }}', $('[name=ship_brgy]'), 'brgyDesc', '');

            }
            @endif
        }

        return parent
    }
    function ajaxHelper(event, route, element, key, value) {
        element.prop('disabled', false);
        element.empty();
        $.post(route, {
            _token: '{{ csrf_token() }}',
            value: event
        }, function(data) {                        
            optionsHelper(element, data, key, value);
        });
    }


</script>
<script>

    function upload(scope) {
        let email = $('#email').val();
        let first_name = $('#first_name').val();

        try{
            var dataLayer  = window.dataLayer || [];
    dataLayer.push({
        'event': 'customer_information',
        'email': email,
        'first_name': first_name,



    }); //
    console.log('done datalayer')
        }catch(err){
            console.log('error datalayer')
            return true
        }
    }


</script>
@endsection
