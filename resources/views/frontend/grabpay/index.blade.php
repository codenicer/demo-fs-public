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
<script>
    function showFrame() {
            $('#grabframe').show();
            $('#mypreloader').html('<BR/>');
    }
</script>
<div class="container">
    <div  class="d-flex justify-content-center">
        <div   class=" m-auto d-flex align-items-center flex-column">
          <div id="mypreloader">
            <div class="ru-lds-roller "><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            <h2>Please wait...</h2>
          </div>
        </div>
    </div>


@endsection