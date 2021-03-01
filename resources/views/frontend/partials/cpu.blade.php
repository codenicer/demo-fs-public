<div class="cart-title d-flex align-items-center zoomIn" style='min-height: 70px'>
    <h3 class='strong'>CPU</h3>
</div>
<div class="card-text d-flex flex-column align-items-center zoomIn mb-2">
    <span>After your order has been placed our rider will pick up the cash from sender location within the next 3 hours.</span>
    <span class='text-danger text-sm mt-2'>NOTES: If the order is placed after 6pm, cash pick-up will be processed the next day. Please bear in mind that orders will be on hold until payment has been collected, so same day delivery orders might be delivered during the next time slot.</span>
</div>
<div class='zoomIn'>
    <div id="shipping_form">
        <div class='d-flex align-items-center h6 card-title'>
            <span>{{__("Cash Pick-Up Info")}}</span>
            <i class='ml-2 la la-file' style='font-size: 1.5rem; background-color: white; color: rgba(0, 0, 0, 0.986);'></i>
        </div>
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="form-group">
                    <label class="control-label">{{__('First Name')}}</label>
                    <input type="text" id="billing_first_names" class="form-control" name="billing_first_name" placeholder="{{__('First Name')}}"
                           value="{{array_key_exists('first_name', Session::get('billing_info')) ? Session::get('billing_info')['first_name'] : "" }}" required='true'/>
                </div>
            </div>
            <div class="col-lg-6 col-12 ">
                <div class="form-group">
                    <label class="control-label ">{{__('Last Name')}}</label>
                    <input type="text" class="form-control" name="billing_last_name" placeholder="{{__('Last Name')}}"
                           value="{{array_key_exists('last_name', Session::get('billing_info')) ? Session::get('billing_info')['last_name'] : "" }}"  required='true'/>
                </div>
            </div>
            <input type="hidden" value="billing " name="address_type">
        </div>

        <div class='row'>
            <div class="col-lg-6 col-12 ">
                <div class="form-group has-feedback ">
                    <label class="control-label ">{{__('Phone')}}</label>
                    <input type="number"  class="form-control" placeholder="{{__('Phone')}}" name="billing_phone"
                           value="{{array_key_exists('phone', Session::get('billing_info')) ? Session::get('billing_info')['phone'] : "" }}"  required='true'/>
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="col-12 ">
                <div class="form-group ">
                    <label class="control-label">{{__('Address')}} </label>
                    <input type="text" class="form-control" name="billing_address_1" placeholder="{{__( 'Street address, P.O. box, company name, c/o')}}"  value="{{ old('billing_address_1') }}" required/>
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="col-md-6 ">
                <div class="form-group has-feedback ">
                    <label class="control-label ">{{__('Province / Municipality')}}</label>
                    <select id='shipping_select_province' class="form-control selectpicker" data-placeholder="Select province" name="billing_province">
                        <option value="{{ old('billing_province') }}"></option>
                         @foreach($provinces as $key => $province)
                            <option value="{{ $province->provDesc }}"


                            >{{ ucwords(strtolower($province->provDesc)) }}</option>
                        @endforeach
                        <option value=""></option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group has-feedback">
                    <label class="control-label">{{__('City')}}</label>
                    <select id='shipping_select_city' class="form-control selectpicker"    
                            data-placeholder="Select city" name="billing_city">
                        {{-- @if(isset($shipping_info['shipProvCode']))
                            @foreach(\App\CityMunicipality::where('provCode', $shipping_info['shipProvCode'])->get() as $key => $city)
                                <option value="{{$city->citymunDesc}}"

                                        @if (Session::get('shipping_info')['city'] === $city->citymunDesc)
                                        selected
                                        @endif

                                >{{$city->citymunDesc}}</option>
                            @endforeach
                        @endif --}}

                        {{--dinaya ko muna--}}
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group has-feedback">
                    <label class="control-label">{{__('Barangay / District')}}</label>
                    <select id='shipping_select_baranggay' class="form-control selectpicker" data-placeholder="Select Barangay / District" name="billing_brgy" required>
                        {{-- @if(isset($shipping_info['shipCityCode']))
                            @foreach(\App\Barangay::where('citymunCode', $shipping_info['shipCityCode'])->get() as $key => $brgy)
                            <option value="{{$brgy->brgyDesc}}"
                                    @if($shipping_info['address_2'] === $brgy->brgyDesc)
                                    selected
                                    @endif
                            >{{$brgy->brgyDesc}}</option>
                            @endforeach
                        @endif --}}

                        {{--dinaya ko muna--}}
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group has-feedback">
                    <label class="control-label">{{__('Postal code')}}</label>
                    <input type="number" min="0" class="form-control" placeholder="{{__('Postal code')}}" name="billing_postal_code" value="{{old('billing_postal_code') }}" />
                </div>
            </div>
        </div>
        <input type='hidden' name="billing_country" value='Philippines'>
    </div>
</div>

<script>
    $(document).ready(function ()  {

        function makeLowerCase(str) {
        var splitStr = str.toLowerCase().split(' ');
        for (var i = 0; i < splitStr.length; i++) {
          // You do not need to check if i is larger than splitStr length, as your for does that for you
          // Assign it back to the array
          splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
        }
        // Directly return the joined string
        return splitStr.join(' ');
      }

        $('[name=billing_province]').on('change', function(e){
                // return alert(e.target.value);

                get_province_id(e.target.value);
            });


      $('[name=billing_city]').on('change', function(e){
        // return alert(e.target.value);

        get_city_id(e.target.value);
      });

            function get_province_id(el) {
            var province_id = el;

            console.log(province_id);
            $(el).closest('.address-choose').find('.city_id').html(null);
            $.post('{{ route('address.get_province_id') }}', {
                    _token: '{{ csrf_token() }}',
                    value: province_id,
              billing: true,
                    change: true
                },
                function(data) {
                    // console.log(data);
                  $('#shipping_select_city').children().remove();
                    for (var i = 0; i < data.length; i++) {

                        var select_value = makeLowerCase(data[i].citymunDesc)
                        $("#shipping_select_city").append($('<option>', {
                            value: select_value,
                            text: select_value
                        })).attr('selected', true);
                    }
                    get_city_id(makeLowerCase(data[0].citymunDesc));
                });
            $(el).closest('.address-choose').find('.brgy_id').html(null);

        }


        // get value of city in select option
        function get_city_id(el) {
            var city_id = el;
            $(el).closest('.address-choose').find('.brgy_id').html(null);
            $.post('{{ route('address.get_city_id') }}', {
                    _token: '{{ csrf_token() }}',
                    value: city_id
                },
                function(data) {
                  $('#shipping_select_baranggay').children().remove();

                    for (var i = 0; i < data.length; i++) {

                        var select_value = makeLowerCase(data[i].brgyDesc)
                        $('#shipping_select_baranggay').append($('<option>', {
                            value: select_value,
                            text: select_value
                        }));
                    }
                });
        }
    });
</script>