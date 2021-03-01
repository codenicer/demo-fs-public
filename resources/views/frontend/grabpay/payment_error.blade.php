@extends('frontend.layouts.app')

@section('content')

{{-- {{ dd($order_details->customer) }} --}}
    <section class="gry-bg py-2">
        <div class="card mx-auto" style="max-width: 650px;">
            <div class="card-body">
                <div class="text-center d-flex flex-column align-items-center justify-content-center">
                    <div class='bg-red rounded-circle' style='height: 65px; width: 65px'>
                        <i class='fa fa-close text-white' style='font-size: 60px;'></i>
                    </div>
                    <h4 class='strong my-4'>{{ $error_title }}</h4>
                </div>
                <div align="center">
                    <div class="dc-header text-center">
                        <h3 class="heading heading-6 strong-700">{{ $message }}</h3>
                        <div class='btn btn-base-1 py-2 px-3 hov-bounce hov-shaddow mt-3'>
                            <a href="{{ route('checkout.select_payment_method') }}" class='text-white'>{{__("Back to Payment")}}</a>
                        </div>
                    </div>

                </div>




                </div>
            </div>
        </div>
    </section>




@endsection
