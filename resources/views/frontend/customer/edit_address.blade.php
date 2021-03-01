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
                                        {{__('Edit Address')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('addAddress') }}">{{__('Edit Address')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form class="" action="{{ route('address.edit.update') }}" method="POST" enctype="multipart/form-data">

                        @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @csrf
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    {{__('Address info')}}
                                </div>
                                @method('patch')

                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Address Type')}}</label>
                                        </div>
                                        <input type="hidden" value="{{$edit_address->customer_address_id}}" name="address_id">
                                        <div class="col-md-10">
                                            <div class="mb-3">
                                                <select class="form-control mb-3 selectpicker address" data-placeholder="Select Address Type" name="address_type" required>
                                                    <option value="shipping" <?php if($edit_address->type == 'shipping') echo "selected";?>>Shipping Address</option>


                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="id_about">{{__('Customer Name')}}</label>
                                        </div>
                                        <div class="col-md-5">
                                            <textarea value="" class="form-control textarea-autogrow mb-3" placeholder="First Name" rows="1" name="first_name" required>{{$edit_address->first_name}}</textarea>
                                        </div>
                                        <div class="col-md-5">
                                            <textarea class="form-control textarea-autogrow mb-3" placeholder="Last Name" rows="1" name="last_name" required>{{$edit_address->last_name}}</textarea>
                                        </div>
                                    </div>
                                    <div class="row address-choose">
                                        <div class="col-md-2">
                                            <label>{{__('Address')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="mb-3">
                                                <textarea class="form-control textarea-autogrow mb-3" placeholder="Apartment,suite,etc.(optional)" rows="1" name="address2" required>{{$edit_address->last_name}}</textarea>

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

                                                <select class="form-control mb-3 selectpicker province_id" data-placeholder="Select your province" id="province" name="province">
                                                    <option value="" selected disabled hidden>Select Address</option>

                                                    @foreach($provinces as $key => $province)
                                                        <option value="{{ ucwords(strtolower($province->provDesc)) }}" <?php if(ucwords(strtolower($edit_address->province)) == ucwords(strtolower($province->provDesc))) echo "selected";?>>{{ ucwords(strtolower($province->provDesc)) }}</option>

                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label>{{__('')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="mb-3">
                                                <select class="form-control mb-3 selectpicker city_id" id="city_id" data-placeholder="Select your city" name="city">
                                                    @if($cities != null)
                                                    @foreach($cities as $key => $city)
                                                        <option value="{{ ucwords(strtolower($city->citymunDesc)) }}"
                                                        <?php if($edit_address->city == $city->citymunDesc) echo "selected";?>
                                                        >{{ ucwords(strtolower($city->citymunDesc)) }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label>{{__('')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="mb-3">
                                                <select class="form-control mb-3 selectpicker brgy_id" id="brgy_id" data-placeholder="Select your brgy" name="brgy" required>
                                                    @if($brgys != null)
                                                    @foreach($brgys as $key => $brgy)
                                                        <option value="{{ ucwords(strtolower($brgy->brgyDesc)) }}"
                                                        <?php if($edit_address->address_2 == $brgy->brgyDesc) echo "selected";?>
                                                        >{{ ucwords(strtolower($brgy->brgyDesc)) }}</option>
                                                    @endforeach
                                                    @endif
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
                                                <select class="form-control mb-3 selectpicker" data-placeholder="Select your country" name="country" required>
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
                                            <input type="text" class="form-control mb-3" placeholder="Enter Postal Code" name="postal_code" value="{{$edit_address->zip}}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>{{__('Phone')}}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="Enter Phone Number" name="phone" value="{{$edit_address->phone}}" required>
                                        </div>
                                    </div>
                                    <div class="text-right mt-4">
                                        <button type="submit" class="btn btn-styled btn-base-1">{{__('Save Address')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>

      $(document).ready(function(){
        $("select.address").change(function(){
          var selectedCountry = $(this).children("option:selected").val();
          if(selectedCountry == 'billing'){

            document.querySelector("label[for=id_about]").innerHTML = "Billing Name"



          }else if (selectedCountry == 'shipping') {
            document.querySelector("label[for=id_about]").innerHTML = "Shipping Name"

          }
        });
      });

    </script>
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

        $('#province').on('change', function(e){
          // return alert(e.target.value);
          get_province_id(e.target.value);
        });


        $('#city_id').on('change', function(e){
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
              $('#city_id').children().remove();
              for (var i = 0; i < data.length; i++) {

                var select_value = makeLowerCase(data[i].citymunDesc)

                $("#city_id").append($('<option>', {
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
              $('#brgy_id').children().remove();

              for (var i = 0; i < data.length; i++) {

                var select_value = makeLowerCase(data[i].brgyDesc)
                console.log(select_value)
                $('#brgy_id').append($('<option>', {
                  value: select_value,
                  text: select_value
                }));
              }
            });
        }
      </script>

@endsection

