@extends('layouts.app')

@section('css')
<link href="https://fonts.googleapis.com/css?family=Acme&display=swap" rel="stylesheet">
@endsection

<style>
    #edit-coupon{
        font-family: 'Acme', sans-serif;
    }
</style>

@section('content')

    <div class="col-lg-8 col-lg-offset-2" id="edit-coupon">
        <div class="panel" style="box-shadow: -1px 2px 20px -4px rgba(0,0,0,0.75) !important;">
            <div class="panel-heading">
                <h3 class="panel-title">{{__('Coupon Information Update')}}</h3>
            </div>

            <form class="form-horizontal" action="{{ route('coupon.update', $coupon->id) }}" method="POST" id="coupon_edit_form" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PATCH">
            	@csrf
                <div class="panel-body">
                    <input type="hidden" name="id" value="{{ $coupon->id }}" id="id">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="name">{{__('Coupon Type')}}</label>
                        <div class="col-lg-9">
                            <select name="coupon_type" id="coupon_type" class="form-control demo-select2-placeholder" onchange="coupon_form()" required>
                                @if ($coupon->type == "product_base"))
                                    <option value="product_base" selected>{{__('For Products')}}</option>
                                @elseif ($coupon->type == "cart_base")
                                    <option value="cart_base">{{__('For Total Orders')}}</option>
                                @elseif ($coupon->type == "hub_base")
                                    <option value="hub_base">{{__('For Specific Hubs')}}</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div id="coupon_form">

                    </div>

                <div class="panel-footer text-right">
                    <a class="btn btn-primary" href="{{route('coupon.index')}}">{{__('Cancel')}}</a>
                    <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
                </div>
            </form>

        </div>
        <br>
    </div>


@endsection
@section('script')

<script type="text/javascript">

    function coupon_form(){
        var coupon_type = $('#coupon_type').val();
        var id = $('#id').val();
		$.post('{{ route('coupon.get_coupon_form_edit') }}',{_token:'{{ csrf_token() }}', coupon_type:coupon_type, id:id}, function(data){
            $('#coupon_form').html(data);

            $('#demo-dp-range .input-daterange').datepicker({
                startDate: '-0d',
                todayBtn: "linked",
                autoclose: true,
                todayHighlight: true
        	});
		});
    }

    $(document).ready(function(){
        coupon_form();
    });


</script>

@endsection
