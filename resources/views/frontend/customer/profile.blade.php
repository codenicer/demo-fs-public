@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
                    @if(Auth::user()->user_type == 'seller')
                        @include('frontend.inc.seller_side_nav')
                    @elseif(Auth::user()->user_type == 'customer')
                        @include('frontend.inc.customer_side_nav')
                    @endif
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Manage Profile')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('profile') }}">{{__('Manage Profile')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form class="" action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('Basic info')}}
                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Your Name')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="{{__('First Name')}}" name="first_name" value="{{ Auth::user()->first_name }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="{{__('Last Name')}}" name="last_name" value="{{ Auth::user()->last_name }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Your Email')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="email" class="form-control mb-3" placeholder="{{__('Your Email')}}" name="email" value="{{ Auth::user()->email }}" disabled>
                                        </div>
                                    </div>
                                    {{--<div class="row">--}}
                                        {{--<div class="col-md-2">--}}
                                            {{--<label>{{__('Photo')}}</label>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-10">--}}
                                            {{--<input type="file" name="photo" id="file-3" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" />--}}
                                            {{--<label for="file-3" class="mw-100 mb-3">--}}
                                                {{--<strong>--}}
                                                    {{--<i class="fa fa-upload"></i>--}}
                                                    {{--{{__('Choose image')}}--}}
                                                {{--</strong>--}}
                                            {{--</label>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Your Password')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="password" class="form-control mb-3" placeholder="{{__('New Password')}}" name="new_password">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Confirm Password')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="password" class="form-control mb-3" placeholder="{{__('Confirm Password')}}" name="confirm_password">
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="text-right mt-4">
                                <button type="submit" class="btn btn-styled btn-base-1">{{__('Update Profile')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
