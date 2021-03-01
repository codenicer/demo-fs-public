@php
    $coupon_det = json_decode($coupon->details);
@endphp

<div class="panel-heading">
   <h3 class="panel-title">{{__('Edit Your Hub Base Coupon')}}</h3>
</div>
<div class="form-group">
   <label class="col-lg-3 control-label" for="coupon_code">{{__('Coupon code')}}</label>
   <div class="col-lg-9">
       <input type="text" value="{{$coupon->code}}" id="coupon_code" name="coupon_code" class="form-control" required>
   </div>
</div>


<div class="form-group">
  <label class="col-lg-3 control-label">{{__('Minimum Shopping')}}</label>
  <div class="col-lg-9">
     <input type="number" min="0" step="0.01" name="min_buy" class="form-control" value="{{ $coupon_det->min_buy }}" required>
  </div>
</div>
<div class="form-group">
  <label class="col-lg-3 control-label">{{__('Discount')}}</label>
  <div class="col-lg-8">
     <input type="number" min="0" step="0.01" placeholder="{{__('Discount')}}" name="discount" class="form-control" value="{{ $coupon->discount }}" required>
  </div>
  <div class="col-lg-1">
     <select class="demo-select2" name="discount_type">
        <option value="amount" @if ($coupon->discount_type == 'amount') selected  @endif >&#8369;</option>
        <option value="percent" @if ($coupon->discount_type == 'percent') selected  @endif>%</option>
     </select>
  </div>
</div>
<div class="form-group">
  <label class="col-lg-3 control-label">{{__('Maximum Discount Amount')}}</label>
  <div class="col-lg-9">
     <input type="number" min="0" step="0.01" placeholder="{{__('Maximum Discount Amount')}}" name="max_discount" class="form-control" value="{{ $coupon_det->max_discount }}" required>
  </div>
</div>

<div class="form-group">
   <label class="col-lg-3 control-label">{{__('Coupon Quantity')}}</label>
   <div class="col-lg-8">
      <input type="number" min="0" step="1" placeholder="{{__('Quantity')}}" name="coupon_quantity" class="form-control"  value="{{ $coupon->quantity }}" required>
       {{-- <small class="text-muted">Leave blank for unlimited coupons</small> --}}
   </div>
</div>

<div class="form-group">
   <label class="col-lg-3 control-label" for="start_date">{{__('Date')}}</label>
   <div class="col-lg-9">
       <div id="demo-dp-range">
           <div class="input-daterange input-group" id="datepicker">
               <input type="text" class="form-control" name="start_date" value="{{ date('m/d/Y', $coupon->start_date) }}">
               <span class="input-group-addon">{{__('to')}}</span>
               <input type="text" class="form-control" name="end_date" value="{{ date('m/d/Y', $coupon->end_date) }}">
           </div>
       </div>
   </div>
</div>

<div class="form-group">
    <label class="col-lg-3 control-label" for="start_date">{{__('Hubs')}}</label>
    <div class="col-lg-9">
        <div class="checkbox">
            <label><input type="checkbox" name="hubs[]" value="1" @if(in_array(1, $coupon_det->hub_id)) checked @endif>Manila</label>
        </div>
        <div class="checkbox">
            <label><input type="checkbox" name="hubs[]" value="2" @if(in_array(2, $coupon_det->hub_id)) checked @endif>Cebu</label>
        </div>
        <div class="checkbox">
            <label><input type="checkbox" name="hubs[]" value="3" @if(in_array(3, $coupon_det->hub_id)) checked @endif>Davao</label>
        </div>
        <div class="checkbox">
            <label><input type="checkbox" name="hubs[]" value="5" @if(in_array(5, $coupon_det->hub_id)) checked @endif>Rest Of Phil</label>
        </div>
    </div>
</div>

<script type="text/javascript">

   $(document).ready(function(){
       $('.demo-select2').select2();
   });

</script>
