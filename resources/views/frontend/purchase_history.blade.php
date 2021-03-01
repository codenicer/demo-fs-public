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
                                        {{__('Purchase History')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('purchase_history.index') }}">{{__('Purchase History')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(isset($orders))
                        @if (count($orders) > 0)
                            @foreach ($orders as $key => $order)
                            @php
                                $status = get_order_status($order->order_status_id);
                            @endphp
                            <!-- Order history table -->
                            <div class="card no-border mt-4">
                                <div class="card-title p-3 d-flex">
                                    <div class='flex-grow-1 d-flex flex-column'>
                                        <span class="text-lg strong">{{$order->shopify_order_name}}</span>
                                        <span class="text-sm text-muted"><em>{{$order->created_at}}</em></span>
                                    </div>
                                    @if ($order->payment_status_id == '1')
                                        <span class="badge badge-md badge-warning align-self-start">{{__('Pending')}}</span>
                                    @elseif ($order->payment_status_id == '2')
                                        <span class="badge badge-md badge-success align-self-start">{{__('Paid')}}</span>
                                    @elseif ($order->payment_status_id == '3')
                                        <span class="badge badge-md badge-dark align-self-start">{{__('Refunded')}}</span>
                                    @elseif ($order->payment_status_id == '4')
                                        <span class="badge badge-md badge-danger align-self-start">{{__('Overdue')}}</span>
                                    @endif
                                </div>
                                <div class="p-3">
                                    <div class='row no-gutters'>
                                        <div class="d-flex col-12 col-lg-6 col-md-6 align-items-center p-1">
                                            <div class="mr-2">
                                                <span class='text-muted text-sm'>{{__('Delivery Date')}}:</span>
                                            </div>
                                            <div class="flex-grow-1">{{ date('d-m-Y', strtotime($order->delivery_date)) }}</div>
                                        </div>
                                        <div class="d-flex col-12 col-lg-6 col-md-6 align-items-center p-1">
                                            <div class="mr-2">
                                                <span class='text-muted text-sm'>{{__('Delivery Time')}}:</span>
                                            </div>
                                            <div class="flex-grow-1">{{ $order->delivery_time }}</div>
                                        </div>
                                    </div>
                                    <div class='row no-gutters'>
                                        <div class="d-flex col-12 col-lg-6 col-md-6 align-items-center p-1">
                                            <div class="mr-2">
                                                <span class='text-muted text-sm'>{{__('Mode of Payment')}}:</span>
                                            </div>
                                            <div class="flex-grow-1">{{ ucfirst(get_mode_of_payment($order->payment_id)) }}</div>
                                        </div>
                                        <div class="d-flex col-12 col-lg-6 col-md-6 align-items-center p-1">
                                            <div class="mr-2">
                                                <span class='text-muted text-sm'>{{__('Amount')}}:</span>
                                            </div>
                                            <div class="flex-grow-1">{{ format_price($order->total_price) }}</div>
                                        </div>
                                    </div>
                                    <div class='row no-gutters'>
                                        <div class="d-flex col-12 col-lg-6 col-md-6 align-items-center p-1">
                                            <div class="mr-2">
                                                <span class='text-muted text-sm'>{{__('Status')}}:</span>
                                            </div>
                                            <div class="flex-grow-1">{{ ucfirst(str_replace('_', ' ', $status)) }}</div>
                                        </div>
                                        <div class="d-flex col-12 col-lg-6 col-md-6 align-items-center p-1">
                                            <div class="mr-2">
                                                <span class='text-muted text-sm'>{{__('Options')}}:</span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <button onclick="show_purchase_history_details({{ $order->order_id }})" class="btn btn-base-1">{{__('View Details')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class='w-100 h-100 d-flex align-items-center justify-content-center'>
                                <div class='d-flex align-items'>
                                    <i class="la la-meh-o d-block heading-1 alpha-5"></i>
                                    <span class="d-block">{{ __('No history found.') }}</span>
                                </div>
                            </div>
                            @endif
                            @endif
                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                {{ $orders->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                <div id="order-details-modal-body">

                </div>
            </div>
        </div>
    </div>

@endsection
