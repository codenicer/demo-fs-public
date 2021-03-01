@extends('layouts.app')

@section('content')

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Seller Payments')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Date')}}</th>
                    <th>{{__('Seller')}}</th>
                    <th>{{__('Amount')}}</th>
                    <th>{{ __('Payment Method') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $key => $payment)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $payment->created_at }}</td>
                        <td>
                            @if (\App\Seller::find($payment->seller_id) != null)
                                {{ \App\Seller::find($payment->seller_id)->user->name }} ({{ \App\Seller::find($payment->seller_id)->user->shop->name }})
                            @endif
                        </td>
                        <td>
                            {{ single_price($payment->amount) }}
                        </td>
                        <td>{{ ucfirst($payment->payment_method) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
