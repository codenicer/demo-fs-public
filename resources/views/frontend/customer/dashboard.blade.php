@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
                    @include('frontend.inc.customer_side_nav')
                </div>
                <div class="col-lg-9">
                    <!-- Page title -->
                    <div class="page-title">
                        <div class="row align-items-center">
                            <div class="col-md-6 col-12">
                                <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                    {{__('Dashboard')}}
                                </h2>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="float-md-right">
                                    <ul class="breadcrumb">
                                        <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                        <li class="active"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- dashboard content -->
                    <div class="">
                        <div class="row">
                            <div class="col-md-4">
                                {{-- <div class="dashboard-widget text-center green-widget mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-shopping-cart"></i>
                                        @if(Session::has('cart'))
                                            <span class="d-block title">{{ count(Session::get('cart'))}}
                                                Product(s)</span>
                                        @else
                                            <span class="d-block title">0 Product</span>
                                        @endif
                                        <span class="d-block sub-title">in your cart</span>
                                    </a>
                                </div> --}}
                            </div>
                            <!--
                            <div class="col-md-4">
                                <div class="dashboard-widget text-center red-widget mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-heart"></i>
                                        <span class="d-block title">{{ count(Auth::user()->wishlists)}}
                                            Product(s)</span>
                                        <span class="d-block sub-title">in your wishlist</span>
                                    </a>
                                </div>
                            </div>
                            -->
                            <div class="col-md-4">
                                {{-- <div class="dashboard-widget text-center yellow-widget mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-building"></i>
                                        @php
                                            $orders = get_previous_orders(Auth::user()->id)->get();
                                            $total = 0;
                                            foreach ($orders as $key => $order) {
                                                $total += count($order->orderDetails);
                                            }
                                        @endphp
                                        <span class="d-block title">{{ $total }} Product(s)</span>
                                        <span class="d-block sub-title">you ordered</span>
                                    </a>
                                </div> --}}
                            </div>
                        </div>

                        <div class="text-right mt-4">
                            <a href="{{ route('addAddress') }}">
                                <button type="button" class="btn btn-styled btn-base-1 mb-3">+ Add New Address</button>
                            </a>
                        </div>
                        <div class="row">
                            <div class="card w-100">
                                <div class="card-header">
                                    <span class='text-lg'>{{__('Shipping Address')}}</span>
                                </div>
                                @forelse($shipping_addresses as $shipping_address)
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-8">
                                            <span>{{__('Shipping Info')}}</span>
                                        </div>
                                        <div class="col-4">
                                            <div class='d-flex justify-content-end'>
                                                <a href="{{route('address.edit', encrypt($shipping_address->customer_address_id))}}">
                                                    <button type="button" class="btn btn-info w-35">
                                                        <i class="fa fa-edit"></i></button>
                                                </a>
                                                <button type="button" class="ml-2 btn btn-danger w-35">
                                                    <a onclick="confirm_modal('{{route('address.destroy', encrypt($shipping_address->customer_address_id))}}')">
                                                        <i class="fa fa-trash"></i></button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="text-lg strong">{{$shipping_address->first_name}} {{$shipping_address->last_name}}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <span class=""><em>{{$shipping_address->phone}}</em></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex flex-column">
                                                <span class="">{{$shipping_address->address_1}}</span>
                                                <span class="">{{$shipping_address->address_2}}</span>
                                                <span class="">{{$shipping_address->city}}, {{$shipping_address->province}}</span>
                                                <span class="">{{$shipping_address->country}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <hr>
                                    @empty
                                <h6 class="bg-muted text-center">No Shipping Address Yet</h6>
                                    @endforelse
                            </div>
                            {{-- <div class="card w-100">
                                <div class="card-header">
                                    <span class='text-lg'>{{__('Billing Address')}}</span>
                                </div>
                                @forelse($billing_addresses as $billing_address)
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-8">
                                                <span>{{__('Billing Info')}}</span>
                                            </div>
                                            <div class="col-4">
                                                <div class='d-flex justify-content-end'>
                                                    <a href="{{route('address.edit', encrypt($billing_address->customer_address_id))}}">
                                                        <button type="button" class="btn btn-info w-35">
                                                            <i class="fa fa-edit"></i></button>
                                                    </a>
                                                    <button type="button" class="ml-2 btn btn-danger w-35">
                                                        <a onclick="confirm_modal('{{route('address.destroy', encrypt($billing_address->customer_address_id))}}')">
                                                            <i class="fa fa-trash"></i></button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <span class="text-lg strong">{{$billing_address->first_name}} {{$billing_address->last_name}}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <span class=""><em>{{$billing_address->phone}}</em></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-flex flex-column">
                                                    <span class="">{{$billing_address->address_1}}</span>
                                                    <span class="">{{$billing_address->address_2}}</span>
                                                    <span class="">{{$billing_address->city}}, {{$billing_address->province}}</span>
                                                    <span class="">{{$billing_address->country}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @empty
                                    <h6 class="bg-muted text-center">No Billing Address Yet</h6>
                                @endforelse
                            </div> --}}
                            {{--<div class="col-md-5">--}}
                            {{--<div class="form-box bg-white mt-4">--}}
                            {{--<div class="form-box-title px-3 py-2 clearfix ">--}}
                            {{--{{__('Saved Shipping Info')}}--}}
                            {{--<div class="float-right">--}}
                            {{--<a href="{{ route('profile') }}" class="btn btn-link btn-sm">{{__('Edit')}}</a>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-box-content p-3">--}}
                            {{--<table>--}}
                            {{--<tr>--}}
                            {{--<td>{{__('Address')}}:</td>--}}
                            {{--<td class="p-2">{{ Auth::user()->address }}</td>--}}
                            {{--</tr>--}}
                            {{--<tr>--}}
                            {{--<td>{{__('Country')}}:</td>--}}
                            {{--<td class="p-2">--}}
                            {{--@if (Auth::user()->country != null)--}}
                            {{--{{ \App\Country::where('code', Auth::user()->country)->first()->name }}--}}
                            {{--@endif--}}
                            {{--</td>--}}
                            {{--</tr>--}}
                            {{--<tr>--}}
                            {{--<td>{{__('City')}}:</td>--}}
                            {{--<td class="p-2">{{ Auth::user()->city }}</td>--}}
                            {{--</tr>--}}
                            {{--<tr>--}}
                            {{--<td>{{__('Postal Code')}}:</td>--}}
                            {{--<td class="p-2">{{ Auth::user()->postal_code }}</td>--}}
                            {{--</tr>--}}
                            {{--<tr>--}}
                            {{--<td>{{__('Phone')}}:</td>--}}
                            {{--<td class="p-2">{{ Auth::user()->phone }}</td>--}}
                            {{--</tr>--}}
                            {{--</table>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
