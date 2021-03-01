@extends('frontend.layouts.app')

@section('content')

    <div id="page-content">
        @include('frontend.partials.checkout_header')
        <section class="py-4 gry-bg" id='shipping_info_container'>
            <div class="container">
                <div class="row cols-xs-space cols-sm-space cols-md-space">
                    <div class="col-lg-8">
                        <form class="" id="Form2" action="{{ route('add.new.address') }}" method="POST" enctype="multipart/form-data">@csrf</form>

                        <form id='shipping_form_data_handler' class="form-default" data-toggle="validator" data-session="{{ json_encode(Session::get('user_info')) }}" action="{{ route('checkout.store_shipping_info') }}" role="form" method="POST" >
                            @csrf
                            <div class="card">
                                @if(Auth::check())
                                    @php
                                        $user = Auth::user();
                                    @endphp
                                    <div class="card-body">
                                        <div style="display:flex;justify-content:space-between;">
                                            <div>
                                                <h6>Shipping Address</h6>

                                            </div>
                                            <div>
                                                <a style="cursor:pointer;" id="add_address"><i class="fa fa-plus" style="font-size: 20px;"></i></a>
                                            </div>
                                        </div>
                                        <div id="show-it">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="id_about">{{__('Customer Name')}}</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <textarea class="form-control  textarea-autogrow mb-3" form="Form2" placeholder="First Name" rows="1" name="first_name" required></textarea>
                                                </div>
                                                <div class="col-md-5">
                                                    <textarea class="form-control textarea-autogrow mb-3" form="Form2" placeholder="Last Name" rows="1" name="last_name" required></textarea>
                                                </div>
                                                <input type="hidden" value="shipping" name="address_type" form="Form2">
                                            </div>
                                            <div class="row address-choose">
                                                <div class="col-md-2">
                                                    <label>{{__('Address')}}</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="mb-3">
                                                        <textarea class="form-control textarea-autogrow mb-3" form="Form2" placeholder="Apartment,suite,etc.(optional)" rows="1" name="address2" required></textarea>

                                                    </div>
                                                </div>
                                                {{--<div class="col-md-2">--}}
                                                {{--<label>{{__('')}}</label>--}}
                                                {{--</div>--}}
                                                {{--<div class="col-md-10">--}}
                                                {{--<div class="mb-3">--}}
                                                {{--<select class="form-control mb-3 selectpicker region_id" data-placeholder="Select your country" name="region">--}}
                                                {{--@foreach ($regions as $key => $region)--}}
                                                {{--<option value="{{ $region->regDesc }}">{{ $region->regDesc }}</option>--}}
                                                {{--@endforeach--}}
                                                {{--</select>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="col-md-2">--}}
                                                {{--<label>{{__('')}}</label>--}}
                                                {{--</div>--}}
                                                {{--<div class="col-md-10">--}}
                                                {{--<div class="mb-3">--}}
                                                {{--<select class="form-control mb-3 selectpicker province_id" data-placeholder="Select your province" name="province">--}}

                                                {{--</select>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                <div class="col-md-2">
                                                    <label>{{__('')}}</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="mb-3">
                                                        <select class="form-control mb-3 selectpicker province_id" data-placeholder="Select your province" form="Form2" name="province">
                                                            <option value="" selected disabled hidden>Select Address</option>

                                                            @foreach($provinces as $key => $province)
                                                                <option value="{{ ucwords(strtolower($province->provDesc)) }}">{{ ucwords(strtolower($province->provDesc)) }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>{{__('')}}</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="mb-3">
                                                        <select class="form-control mb-3 selectpicker city_id" form="Form2" data-placeholder="Select your city" name="city">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>{{__('')}}</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="mb-3">
                                                        <select class="form-control mb-3 selectpicker brgy_id" form="Form2" data-placeholder="Select your brgy" name="brgy" required>

                                                        </select>
                                                    </div>
                                                </div>
                                                g
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>{{__('Country')}}</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="mb-3">
                                                        <select class="form-control mb-3 selectpicker" form="Form2" data-placeholder="Select your country" name="country" required>
                                                            <option value="PH">Philippines</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>{{__('Postal Code')}}</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control mb-3" form="Form2" placeholder="Enter Postal Code" name="postal_code" value="" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>{{__('Phone')}}</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control mb-3" form="Form2" placeholder="Enter Phone Number" name="phone" value="" required>
                                                </div>
                                            </div>
                                            <div class="text-right mt-4">
                                                <button type="submit" form="Form2" class="btn btn-styled btn-base-1">{{__('Save Address')}}</button>
                                            </div>
                                        </div>
                                        @forelse($customer_address as $key => $shipping_address)
                                            {{$keysss == $keysss++}}
                                            <div class="card-body border mt-3">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <p>Billing Name:</p>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h6 class="font-weight-bold">{{$shipping_address->first_name}} {{$shipping_address->last_name}}</h6>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div style="display: flex;justify-content: space-around">

                                                            @if($keysss == 1)
                                                                <button type="button" value="{{$shipping_address->customer_address_id}}" onclick="set_address({{$shipping_address->customer_address_id}})"  class="btn btn-light w-35 billing-color border" style="background-color: #F79F1F;">
                                                                    Set </button>
                                                            @else
                                                                <button type="button"value="{{$shipping_address->customer_address_id}}" onclick="set_address({{$shipping_address->customer_address_id}})"  class="btn btn-light w-35 billing-color border">
                                                                    Set </button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <p>Phone:</p>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <p class="">{{$shipping_address->phone}}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <p>Address:</p>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <span class="">{{$shipping_address->address_1}}</span>

                                                        <span class="">{{$shipping_address->address_2}}</span>

                                                        <span class="">{{$shipping_address->city}}, {{$shipping_address->province}}</span>



                                                    </div>
                                                </div>

                                            </div>
                                        @empty
                                            <h6 class="text-center" id="no-billing">No Shipping Address</h6>
                                        @endforelse
                                        @if(count($customer_address) == 0)
                                            <input type="hidden" name="set_required" value="0" id="set_required" required>
                                        @else
                                            <input type="hidden" name="set_required" value="1" id="set_required" required>
                                        @endif
                                        <input type="hidden" name="checkout_type" value="logged">
                                    </div>
                                @else
                                    <div class="card-body">
                                        <div class="card-title d-flex flex-column">
                                            <h6 class='flex-grow-1'>{{__('Recipient Info')}}</h6>
                                            <div class="checkbox py-2 text-left align-self-start" id='same_address_wrap'>
                                                <input id="same_address" class="magic-checkbox" type="checkbox" name="same_address" checked onchange="sameAddress(event)" />
                                                <label for="same_address" class='text-sm strong'>
                                                    {{ __('Ship to my address') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('First Name')}}</label>
                                                    <input id="shipping_info_form" type="text" class="form-control" name="first_name" placeholder="{{__('First Name')}}" required value="{{ Session::get('shipping_info')['first_name'] }}"/>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Last Name')}}</label>
                                                    <input id="shipping_info_form" type="text" class="form-control" name="last_name" placeholder="{{__('Last Name')}}" required value="{{ Session::get('shipping_info')['last_name'] }}"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class='row'>
                                            <div class="col-md-12">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{__('Phone')}}</label>
                                                    <input id="shipping_info_form" type="number" min="0" class="form-control" placeholder="{{__('Phone')}}" name="phone" required value="{{ Session::get('shipping_info')['phone'] }}"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Address 1')}}</label>
                                                    <input id="shipping_info_form" type="text" class="form-control" name="address_1" placeholder="{{__('Street address, P.O. box, company name, c/o')}}" required value="{{ Session::get('shipping_info')['address_1'] }}"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Address 2')}}</label>
                                                    <input id="shipping_info_form" type="text" class="form-control" name="address_2" placeholder="{{__('Aparment, suite, unit, building, floor, etc.')}}" value="{{ Session::get('shipping_info')['address_2'] }}"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{__('City')}}</label>
                                                    <input id="shipping_info_form" type="text" class="form-control" placeholder="{{__('City')}}" name="city" required value="{{ Session::get('shipping_info')['city'] }}"/>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{__('Province')}}</label>
                                                    <input id="shipping_info_form" type="text" class="form-control" placeholder="{{__('Province')}}" name="province" required value="{{ Session::get('shipping_info')['province'] }}" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">{{__('Country')}}</label>
                                                    <select id="shipping_info_form" class="form-control custome-control" name="country">
                                                        <option value="Philippines" selected>Philippines</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{__('Postal code')}}</label>
                                                    <input id="shipping_info_form" type="number" min="0" class="form-control" placeholder="{{__('Postal code')}}" name="postal_code" required value="{{ Session::get('shipping_info')['postal_code'] }}"/>
                                                </div>
                                            </div>

                                        </div>
                                        <input type="hidden" name="checkout_type" value="guest">
                                    </div> 
                                    
                                @endif
                            </div>

                            <div class='row flex-column flex-lg-row flex-md-row no-gutters pt-4'>
                                <a href="{{ route('home') }}" class="link link--style-3 flex-grow-1 mb-3">
                                    <i class="la la-mail-reply"></i>
                                    {{__('Return to shop')}}
                                </a>
                                <button class="btn btn-styled btn-base-1" id="submit_button" type='submit'>{{__('Continue to Payment')}}</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4 ml-lg-auto">
                        @include('frontend.partials.cart_summary')
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script>

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

      $('.region_id').on('change', function() {
        get_region_id(this);
      });

      function get_region_id(el){
        var region_id = $(el).val();
        console.log(region_id);
        $(el).closest('.address-choose').find('.province_id').html(null);
        $.post('{{ route('address.get_region_id') }}',{_token:'{{ csrf_token() }}', region_id:region_id}, function(data){
          for (var i = 0; i < data.length; i++) {

            var select_value = makeLowerCase(data[i].provDesc)
            $(el).closest('.address-choose').find('.province_id').append($('<option>', {
              value: select_value,
              text: select_value
            }));
          }

        });
        $(el).closest('.address-choose').find('.city_id').html(null);
        $(el).closest('.address-choose').find('.brgy_id').html(null);


      }

      $('.province_id').on('change', function() {
        get_province_id(this);
      });

      function get_province_id(el){
        var province_id = $(el).val();
        console.log(province_id);
        $(el).closest('.address-choose').find('.city_id').html(null);
        $.post('{{ route('address.get_province_id') }}',{_token:'{{ csrf_token() }}', province_id:province_id}, function(data){
          for (var i = 0; i < data.length; i++) {




            var select_value = makeLowerCase(data[i].citymunDesc)


            $(el).closest('.address-choose').find('.city_id').append($('<option>', {
              value: select_value,
              text: select_value
            }));
          }
        });
        $(el).closest('.address-choose').find('.brgy_id').html(null);

      }

      $('.city_id').on('change', function() {
        get_city_id(this);
      });

      function get_city_id(el){
        var city_id = $(el).val();
        console.log(city_id);
        $(el).closest('.address-choose').find('.brgy_id').html(null);
        $.post('{{ route('address.get_city_id') }}',{_token:'{{ csrf_token() }}', city_id:city_id}, function(data){
          for (var i = 0; i < data.length; i++) {

            var select_value = makeLowerCase(data[i].brgyDesc)

            $(el).closest('.address-choose').find('.brgy_id').append($('<option>', {
              value: select_value,
              text: select_value
            }));
          }
        });
      }
    </script>
    <script>
        // get session user_info that pass to html data-attribute
        let session = JSON.parse(document.getElementById('shipping_form_data_handler').dataset.session);

        // disable same address checkbox when user info country is not Philippines
        // adding tooltip why checkvox is disabled
        if(session.country !== "Philippines"){
            let checkboxWrap = document.getElementById('same_address_wrap');
            document.getElementById('same_address').disabled=true;
            checkboxWrap.setAttribute('data-toggle', 'tooltip');
            checkboxWrap.setAttribute('title', 'Shipping is only available in the Philippines');
            checkboxWrap.setAttribute('data-placement', "bottom");
        }


        function sameAddress(e){
            // get all shipping info form inputs
            let inputs = document.querySelectorAll('#shipping_info_form');

            if(e.target.checked){

                // set inputs value to session user_info
                inputs.forEach(input => {
                    input.value = session[input.name];
                })

            } else {
                //clear inputs value
                inputs.forEach(input => {
                    input.value = "";
                })
            }

        }

    </script>
    <Script>
      $(document).ready(function() {
        $('#show-it').hide();
        $('#add_address').on('click', function() {
          $('#show-it').toggle(300);
          $('#no-billing').toggle(100);
        });
      });

      $('.billing-color').click(function() {
        $('.billing-color').not($(this)).css('background', 'none');
        $(this).css('background','#F79F1F');
        $('#set_required').val(1)
      });


      function set_address(value){

        var value = value



        $.post('{{ route('information.set_shipping_address')}}', {_token:'{{ csrf_token() }}', id:value}, function(data){

          console.log(data);
        });
      }

      $('#submit_button').click(function(){
        if($('#set_required').val() == 0){
          alert('You need to select shipping address');
          return false;
        }

      })
    </Script>
@endsection
