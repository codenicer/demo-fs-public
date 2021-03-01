@extends('frontend.layouts.app')

@section('content')

    <div id="page-content">
        <section class="slice-xs sct-color-2 border-bottom">
            <div class="container container-sm">
                <div class="row cols-delimited">
                    <div class="col-4">
                        <div class="icon-block icon-block--style-1-v5 text-center">
                            <div class="block-icon c-gray-light mb-0">
                                <i class="la la-shopping-cart"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">
                                    1. {{__('My Cart')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="icon-block icon-block--style-1-v5 text-center active">
                            <div class="block-icon mb-0">
                                <i class="la la-truck"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">
                                    2. {{__('Shipping info')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="icon-block icon-block--style-1-v5 text-center">
                            <div class="block-icon c-gray-light mb-0">
                                <i class="la la-credit-card"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">
                                    3. {{__('Payment')}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-4 gry-bg">
            <div class="container">
                <div class="row cols-xs-space cols-sm-space cols-md-space">
                    <div class="col-lg-8">
                        <form class="form-default" data-toggle="validator"
                              action="{{ route('checkout.confirm_info') }}" role="form" method="POST">
                            @csrf
                            <div class="card">
                                @if(Auth::check())
                                    @php
                                        $user = Auth::user();
                                    @endphp
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Name')}}</label>
                                                    <input type="text" class="form-control" name="name"
                                                           value="{{ $user->name }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Email')}}</label>
                                                    <input type="email" class="form-control" name="email"
                                                           value="{{ $user->email }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Address')}}</label>
                                                    <input type="text" class="form-control" name="address"
                                                           value="{{ $user->address }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Select your country')}}</label>
                                                    <select class="form-control selectpicker" data-live-search="true"
                                                            name="country">
                                                        @foreach (\App\Country::all() as $key => $country)
                                                            <option value="{{ $country->name }}"
                                                                    @if ($country->code == $user->country) selected @endif>{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{__('City')}}</label>
                                                    <input type="text" class="form-control" value="{{ $user->city }}"
                                                           name="city" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{__('Postal code')}}</label>
                                                    <input type="number" min="0" class="form-control"
                                                           value="{{ $user->postal_code }}" name="postal_code" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{__('Phone')}}</label>
                                                    <input type="number" min="0" class="form-control"
                                                           value="{{ $user->phone }}" name="phone" required>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="checkout_type" value="logged">
                                    </div>
                                @else
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="container">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"><h5>Contact information</h5>
                                                            </label>
                                                            <input type="email" class="form-control"
                                                                   id="email_address" name="email_address" aria-describedby="emailHelp" value="{{old('email_address')}}"
                                                                   placeholder="Enter email">
                                                            <small id="emailHelp" class="form-text text-muted">We'll
                                                                never share your email with anyone else.
                                                            </small>
                                                            <br>
                                                            <input type="checkbox" name="anonymous"
                                                                   value="Make the sender anonymous?"
                                                                   class="text-muted">
                                                            Keep me up to date on news and exclusive offers<br><br>
                                                            <h6>Deliver To? - Delivery is within METRO MANILA, SELECTED
                                                                METRO CEBU AREAS (Cebu City, Lapu-Lapu City,
                                                                Mandaue City, Talisay City, Consolacion, Liloan,
                                                                Minglanilla),selected areas in Antipolo
                                                                (Bagong Nayon, Dela Paz, Mambugan, Mayamot, Muntindilaw,
                                                                San Isidro,
                                                                San Roque, Sta. Cruz), CAINTA, TAYTAY & Davao City
                                                                only.</h6>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{old('first_name')}}"
                                                       placeholder="First Name">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{old('last_name')}}"
                                                       placeholder="Last Name">

                                            </div>
                                        </div>
                                        <div class="container">
                                            <div class="row mt-2">
                                                <input type="text" class="form-control mb-2" id="address1" value="{{old('address1')}}"
                                                       name="address1" placeholder="Address">
                                                <input type="text" class="form-control mb-2" id="address2" value="{{old('address2')}}"
                                                       name="address2" placeholder="Apartment,suite,etc.(optional">
                                                <input type="text" class="form-control mb-2" id='city' name="city" value="{{old('city')}}"
                                                       placeholder="City">
                                                <input type="text" class="form-control mb-2" id='province' name="province" value="{{old('province')}}"
                                                       placeholder="Province">
                                            </div>

                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <select class="form-control mb-3 selectpicker" id="country"
                                                        data-placeholder="Select your country" name="country">
                                                    <option>Philippines</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="postal_code" name="postal_code"  value="{{old('postal_code')}}"
                                                       placeholder="Postal Code">

                                            </div>
                                        </div>
                                        <div class="container">
                                            <div class="row mt-2">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Phone" name="phone" id="phone" value="{{old('phone')}}"
                                                           aria-label="Amount (to the nearest dollar)">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text bg-light"><button type="button"
                                                                                               class="btn btn-default bg-light"
                                                                                               data-toggle="tooltip"
                                                                                               data-placement="top"
                                                                                               title="In case we need to contact you on your order">
                                                                <i class="fa fa-question-circle fa-lg" aria-hidden="true"></i>

                                                            </button></span>
                                                    </div>
                                                </div>


                                            </div>

                                        </div>
                                    </div>

                                    {{--<div class="row">--}}
                                    {{--<div class="col-md-12">--}}
                                    {{--<div class="form-group">--}}
                                    {{--<label class="control-label">{{__('Name')}}</label>--}}
                                    {{--<input type="text" class="form-control" name="name" placeholder="{{__('Name')}}" required>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="row">--}}
                                    {{--<div class="col-md-12">--}}
                                    {{--<div class="form-group">--}}
                                    {{--<label class="control-label">{{__('Email')}}</label>--}}
                                    {{--<input type="text" class="form-control" name="email" placeholder="{{__('Email')}}" required>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="row">--}}
                                    {{--<div class="col-md-12">--}}
                                    {{--<div class="form-group">--}}
                                    {{--<label class="control-label">{{__('Address')}}</label>--}}
                                    {{--<input type="text" class="form-control" name="address" placeholder="{{__('Address')}}" required>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="row">--}}
                                    {{--<div class="col-md-6">--}}
                                    {{--<div class="form-group">--}}
                                    {{--<label class="control-label">{{__('Select your country')}}</label>--}}
                                    {{--<select class="form-control custome-control" data-live-search="true" name="country">--}}
                                    {{--@foreach (\App\Country::all() as $key => $country)--}}
                                    {{--<option value="{{ $country->name }}">{{ $country->name }}</option>--}}
                                    {{--@endforeach--}}
                                    {{--</select>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-6">--}}
                                    {{--<div class="form-group has-feedback">--}}
                                    {{--<label class="control-label">{{__('City')}}</label>--}}
                                    {{--<input type="text" class="form-control" placeholder="{{__('City')}}" name="city" required>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="row">--}}
                                    {{--<div class="col-md-6">--}}
                                    {{--<div class="form-group has-feedback">--}}
                                    {{--<label class="control-label">{{__('Postal code')}}</label>--}}
                                    {{--<input type="number" min="0" class="form-control" placeholder="{{__('Postal code')}}" name="postal_code" required>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-6">--}}
                                    {{--<div class="form-group has-feedback">--}}
                                    {{--<label class="control-label">{{__('Phone')}}</label>--}}
                                    {{--<input type="number" min="0" class="form-control" placeholder="{{__('Phone')}}" name="phone" required>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<input type="hidden" name="checkout_type" value="guest">--}}

                                @endif
                            </div>

                            <div class="row align-items-center pt-4">
                                <div class="col-6">
                                    <a href="{{ route('home') }}" class="link link--style-3">
                                        <i class="ion-android-arrow-back"></i>
                                        {{__('Return to shop')}}
                                    </a>
                                </div>
                                <div class="col-6 text-right">
                                    <button type="submit" class="btn btn-styled btn-base-1" id="submit_button"
                                            disabled>{{__('Continue >>')}}</a>
                                </div>
                    </div>
                        </form>
                    </div>

                    <div class="col-lg-4 ml-lg-auto">
                        @include('frontend.partials.cart_summary')
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>

      $('#email_address, #first_name, #last_name,#address1,#address2,#city,#country,#postal_code,#phone,#province').bind('keyup change', function () {
        if (allFilled()) {
          $('#submit_button').removeAttr('disabled')
        } else {
          $('#submit_button').attr('disabled', true)

        }

      })

      function allFilled () {
        var filled = false
        if (!$('#email_address').val() == '' && !$('#first_name').val() == '' && !$('#last_name').val() == ''
          && !$('#address1').val() == '' && !$('#address2').val() == '' && !$('#city').val() == ''
          && !$('#country').val() == '' && !$('#postal_code').val() == '' && !$('#phone').val() == '' && !$('#province').val() == '') filled = true

        return filled
      }

      </script>

@endsection
