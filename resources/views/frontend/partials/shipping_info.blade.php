    <div class="container">
        <div class="row cols-xs-space cols-sm-space cols-md-space">
            <div class="col-lg-8">
                <form class="form-default" data-toggle="validator" action="{{ route('checkout.store_shipping_info') }}" role="form" method="POST" id='shipping_info_form'>
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
                                            <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">{{__('Email')}}</label>
                                            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">{{__('Address')}}</label>
                                            <input type="text" class="form-control" name="address" value="{{ $user->address }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">{{__('Select your country')}}</label>
                                            <select class="form-control selectpicker" data-live-search="true" name="country">
                                                @foreach (\App\Country::all() as $key => $country)
                                                    <option value="{{ $country->name }}" @if ($country->code == $user->country) selected @endif>{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">{{__('City')}}</label>
                                            <input type="text" class="form-control" value="{{ $user->city }}" name="city" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">{{__('Postal code')}}</label>
                                            <input type="number" min="0" class="form-control" value="{{ $user->postal_code }}" name="postal_code" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">{{__('Phone')}}</label>
                                            <input type="number" min="0" class="form-control" value="{{ $user->phone }}" name="phone" required>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="checkout_type" value="logged">
                            </div>
                        @else
                            <div class="card-body">
                                <div class="card-title d-flex flex-column">
                                    <h6 class='flex-grow-1'>{{__('Recipient Info')}}</h6>
                                    <div class="checkbox py-2 text-left">
                                        <input id="same_address" type="checkbox" name="same_address" checked onchange="sameAddress(event)"/>
                                        <label for="same_address" class='text-sm strong'>
                                            {{ __('Ship to my address') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label class="control-label">{{__('First Name')}}</label>
                                            <input type="text" class="form-control" name="first_name" placeholder="{{__('First Name')}}" required value="{{ Session::get('user_info')['first_name'] }}"/>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label class="control-label">{{__('Last Name')}}</label>
                                            <input type="text" class="form-control" name="last_name" placeholder="{{__('Last Name')}}" required value="{{ Session::get('user_info')['last_name'] }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class='row'>
                                    <div class="col-md-12">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">{{__('Phone')}}</label>
                                            <input type="number" min="0" class="form-control" placeholder="{{__('Phone')}}" name="phone" required value="{{ Session::get('user_info')['phone'] }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">{{__('Address 1')}}</label>
                                            <input type="text" class="form-control" name="address_1" placeholder="{{__('Street address, P.O. box, company name, c/o')}}" required value="{{ Session::get('user_info')['address_1'] }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">{{__('Address 2')}}</label>
                                            <input type="text" class="form-control" name="address_2" placeholder="{{__('Aparment, suite, unit, building, floor, etc.')}}" value="{{ Session::get('user_info')['address_2'] }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">{{__('City')}}</label>
                                            <input type="text" class="form-control" placeholder="{{__('City')}}" name="city" required value="{{ Session::get('user_info')['city'] }}"/>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">{{__('Province')}}</label>
                                            <input type="text" class="form-control" placeholder="{{__('Province')}}" name="province" required value="{{ Session::get('user_info')['province'] }}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">{{__('Country')}}</label>
                                            <select class="form-control custome-control" name="country">
                                                <option value="Philippines" selected>Philippines</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">{{__('Postal code')}}</label>
                                            <input type="number" min="0" class="form-control" placeholder="{{__('Postal code')}}" name="postal_code" required value="{{ Session::get('user_info')['postal_code'] }}"/>
                                        </div>
                                    </div>

                                </div>
                                <input type="hidden" name="checkout_type" value="guest">
                            </div> 
                            
                        @endif
                    </div>

                    <div class='row flex-column flex-lg-row flex-md-row no-gutters pt-4'>
                        <a href="{{ route('home') }}" class="link link--style-3 flex-grow-1 mb-3">
                            <i class="la la-mail-reply"></i>
                            {{__('Return to shop')}}
                        </a>
                        <button class="btn btn-styled btn-base-1" id="submit_button" type='submit'>{{__('Continue to Payment')}}</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 ml-lg-auto">
                @include('frontend.partials.cart_summary')
            </div>
        </div>
    </div>