@extends('frontend.layouts.app')
{{-- {{dd( $user['phone'])}} --}}
@section('content')
<style>
    .ru-lds-roller {
  display: inline-block;
  position: relative;
  width: 100px;
  height: 100px;
}
.ru-lds-roller div {
  animation: ru-lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  transform-origin: 40px 40px;
}
.ru-lds-roller div:after {
  content: " ";
  display: block;
  position: absolute;
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: rgba(0, 0, 0, 0.986);;
  margin: -4px 0 0 -4px;
}
.ru-lds-roller div:nth-child(1) {
  animation-delay: -0.036s;
}
.ru-lds-roller div:nth-child(1):after {
  top: 63px;
  left: 63px;
}
.ru-lds-roller div:nth-child(2) {
  animation-delay: -0.072s;
} 
.ru-lds-roller div:nth-child(2):after {
  top: 68px;
  left: 56px;
}
.ru-lds-roller div:nth-child(3) {
  animation-delay: -0.108s;
}
.ru-lds-roller div:nth-child(3):after {
  top: 71px;
  left: 48px;
}
.ru-lds-roller div:nth-child(4) {
  animation-delay: -0.144s;
}
.ru-lds-roller div:nth-child(4):after {
  top: 72px;
  left: 40px;
}
.ru-lds-roller div:nth-child(5) {
  animation-delay: -0.18s;
}
.ru-lds-roller div:nth-child(5):after {
  top: 71px;
  left: 32px;
}
.ru-lds-roller div:nth-child(6) {
  animation-delay: -0.216s;
}
.ru-lds-roller div:nth-child(6):after { 
  top: 68px;
  left: 24px;
}
.ru-lds-roller div:nth-child(7) {
  animation-delay: -0.252s;
}
.ru-lds-roller div:nth-child(7):after {
  top: 63px;
  left: 17px;
}
.ru-lds-roller div:nth-child(8) {
  animation-delay: -0.288s;
}
.ru-lds-roller div:nth-child(8):after {
  top: 56px;
  left: 12px;
}
@keyframes ru-lds-roller {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
{{-- {{dd($cart_to_jsonstring)}} --}}
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="m-auto d-flex align-items-center flex-column ">
            <div class="ru-lds-roller "><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            <h2>Please wait...</h2>
        </div>
    </div>
<script>
    const items  =  '{{$cart_to_jsonstring}}'.replace(/&quot;/g, '\"');
    const data = `{
            "shop_id": "{{env('BILLEASE_TOKEN_ID')}}",
            "amount": {{$order->total_price}},
            "currency": "PHP",
            "merchant_id": "{{env('BILLEASE_MERCHANT_CODE')}}",
            "checkout_type": "standard",
            "items":`+items+`,
            "sellers": [
              {
                "code": "Demo Ecommerce",
                "seller_name": "Blue Aurora Solutions, inc.",
                "url": "Demo Ecommerce",
                "email": "Demo Ecommerce",
                "phone": "+639952569757",
                "country": "PH",
                "province": "NRC",
                "city": "Makati",
                "barangay": "Olympia",
                "street": "9110 Sultana St",
                "address": "9110 Sultana St, Makati, 1207 Metro Manila"
              }
            ],
            "customer": {
              "internal_user_id":"{{$user['customer_id']}}",
              "full_name": "{{$user['first_name'].' '.$user['last_name']}}",
              "email": "{{$user['email']}}",
              "phone": "{{$billing_info['phone']}}",
              "adr_billing": {
                "addr_type": "billing",
                "country": "{{code_to_country($billing_info['country'])}}",
                "province": "{{$billing_info['province']}}",
                "city": "{{$billing_info['city']}}",
                "barangay": "{{$billing_info['address_2']}}",
                "street": "{{$billing_info['address_1']}}",
                "address": "{{$billing_info['address_1']}}"
              },
              "adr_shipping": {
                "addr_type": "shipping",
                "country": "{{code_to_country($shipping_info['country'])}}",
                "province": "{{$shipping_info['province']}}",
                "city": "{{$shipping_info['city']}}",
                "barangay": "{{$shipping_info['address_2']}}",
                "street": "{{$shipping_info['address_1']}}",
                "address": "{{$shipping_info['address_1']}}"
              }
            },
            "shop_code":"{{env('BILLEASE_SHOP_CODE')}}",
            "callbackapi_url": "{{env('BILLEASE_CALLBACK_URL_API').'billease/payment/update'}}",
            "url_redirect": "{{$returnUrl}}",
            "order_id": "{{$order_id}}"
          }`
          // console.log(data)
   $.ajax({
        type: "POST",
        url: '{{$url}}',
        dataType: 'json',
        headers: {
            "Authorization": "Bearer " + '{{$billease_token}}',
            'Content-Type':'application/json'
        },
        data:data ,
        success: function (data){
            $.ajax({
                type: "POST",
                url: "{{route('billease.ajax')}}",
                data: {
                        "data":{...data,order_id:"{{$order_id}}"},
                        "_token": "{{ csrf_token() }}"
                    },
                success: function (data) {
                         window.location.href = data.url;
                }
            });
        },
        error: function (err){
          console.log(err)
          let msg = "."
          if(err.responseText.includes("phone")){
            msg = ",Please check your payment info, number must start at 639********* ."
          }else if(err.responseText.includes("amount")){  
            msg = ",Minimun amount is 500.00 for billease payment."
          }
          alert("Something went wrong upon payment"+msg)
          return  window.location.href ='{{url('/information')}}'

        },
    });
</script>
@endsection