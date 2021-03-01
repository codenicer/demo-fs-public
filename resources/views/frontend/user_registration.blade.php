@extends('frontend.layouts.app')

@section('meta_title'){{'Registration'}}@stop

@section('meta_description'){{"Registration"}}@stop

@section('meta_keywords'){{"Registration"}}@stop


@section('content')
    <section class="gry-bg py-4">
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 offset-xl-1">
                        <div class="card">
                            <div class="text-center px-35 pt-5">
                                <h3 class="heading heading-4 strong-500">
                                    {{__('Create an account.')}}
                                </h3>
                            </div>
                            @if($errors->all())
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            @endif
                            <div class="px-5 py-3 py-lg-5">
                                <div class="row align-items-center">
                                    <div class="col-12 col-lg">
                                        <form class="form-default" id="registration" role="form" action="{{ route('register') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <!-- <label>{{ __('First Name') }}</label> -->
                                                        <div class="input-group input-group--style-1">
                                                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('first_name') }}" placeholder="{{ __('First Name') }}" name="first_name">
                                                            <span class="input-group-addon">
                                                                <i class="text-md la la-user"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <!-- <label>{{ __('Last Name') }}</label> -->
                                                        <div class="input-group input-group--style-1">
                                                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('last_name') }}" placeholder="{{ __('Last Name') }}" name="last_name">
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
                                                        <!-- <label>{{ __('email') }}</label> -->
                                                        <div class="input-group input-group--style-1">
                                                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ __('Email') }}" name="email">
                                                            <span class="input-group-addon">
                                                                <i class="text-md la la-envelope"></i>
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
                                                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" name="password">
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
                                                        <!-- <label>{{ __('confirm_password') }}</label> -->
                                                        <div class="input-group input-group--style-1">
                                                            <input type="password" class="form-control" placeholder="{{ __('Confirm Password') }}" name="password_confirmation">
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
                                                        <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}">
                                                            @if ($errors->has('g-recaptcha-response'))
                                                                <span class="invalid-feedback" style="display:block">
                                                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="checkbox pad-btm text-left">
                                                        <input class="magic-checkbox" type="checkbox" name="marketing" value="1" id="checkboxExample_1a" checked>
                                                        <label for="checkboxExample_1a" class="text-sm">{{__('Keep me up to date on news and exclusive offers')}}</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row align-items-center">
                                                <div class="col-12 text-right  mt-3">
                                                    <button type="submit" id="submit_button" class="btn btn-styled btn-base-1 w-100 btn-md">{{ __('Create Account') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-1 text-center align-self-stretch">
                                        <div class="border-right h-100 mx-auto" style="width:1px;"></div>
                                    </div>

                                    <div class='d-lg-none d-flex mt-3 col-12 align-items-center'>
                                        <hr class='flex-grow-1'/>
                                        <span class='mx-3'>{{__('or')}}</span>
                                        <hr class='flex-grow-1'/> 
                                    </div>

                                    <div class="col-12 col-lg">
                                        @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
                                            <a href="#" class="btn btn-styled btn-block btn-google btn-icon--2 btn-icon-left px-4 my-4">
                                                <i class="icon fa fa-google"></i> {{__('Login with Google')}}
                                            </a>
                                        @endif
                                        @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
                                            <a href="#" class="btn btn-styled btn-block btn-facebook btn-icon--2 btn-icon-left px-4 my-4">
                                                <i class="icon fa fa-facebook"></i> {{__('Login with Facebook')}}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="text-center px-35 pb-3">
                                <p class="text-md">
                                    {{__('Already have an account? ')}}<a href="{{ route('user.login') }}" class="strong-600">{{__('Log In')}}</a>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
        {{--function autoFillSeller(){--}}
            {{--$('#email').val('seller@example.com');--}}
            {{--$('#password').val('123456');--}}
        {{--}--}}
        {{--function autoFillCustomer(){--}}
            {{--$('#email').val('customer@example.com');--}}
            {{--$('#password').val('123456');--}}
        {{--}--}}

        $(function() {
          $('#submit_button').prop('disabled', false);
          $('#submit_button').on('click',function(){

            $(this).prop('disabled', true);
            $('#registration').submit();

          });

        });
    </script>
@endsection
