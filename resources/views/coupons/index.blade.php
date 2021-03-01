@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <a href="{{ route('coupon.create')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New Coupon')}}</a>
        </div>
    </div><br>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Coupon Information')}}</h3>
        </div>
        <div class="panel-body">
            <h4>Search</h4>
            <form method="POST" action="{{ route('coupon.search') }}">
                @csrf
                <div class="d-flex">
            <input class="form-control mb-3" style="width: 20%" name="search" type="text" placeholder="Search Here">
            </form>
            @if($see_all == 2)
            <a href="{{ route('coupon.index') }}" class="btn btn-primary">See all coupon</a>
                @endif
                </div>

            <br>

            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('Code')}}</th>
                        <th>{{__('Type')}}</th>
                        <th>{{__('Start Date')}}</th>
                        <th>{{__('End Date')}}</th>
                        <th width="10%">{{__('Options')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coupons as $key => $coupon)
                        <tr>
                            <td>{{$coupon->id}}</td>
                            <td>{{$coupon->code}}</td>
                            <td>@if ($coupon->type == 'cart_base')
                                    {{ __('Cart Base') }}
                                @elseif ($coupon->type == 'product_base')
                                    {{ __('Product Base') }}
                                @elseif ($coupon->type == 'hub_base')
                                    {{ __('Hub Base') }}
                            @endif</td>
                            <td>{{ date('Y-m-d', $coupon->start_date) }}</td>
                            <td>{{ date('Y-m-d', $coupon->end_date) }}</td>
                            <td>
                                <div class="btn-group dropdown">
                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                        {{__('Actions')}} <i class="dropdown-caret"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="{{route('coupon.edit', encrypt($coupon->id))}}">{{__('Edit')}}</a></li>
                                        <li><a onclick="confirm_modal('{{route('coupon.destroy', $coupon->id)}}');">{{__('Delete')}}</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            <div style="display: flex;
    justify-content: flex-end;margin-top: -30px"><div>{{ $coupons->links() }}</div></div>
        </div>

    </div>



@endsection
