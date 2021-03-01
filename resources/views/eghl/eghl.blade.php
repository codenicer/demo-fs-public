@extends('frontend.layouts.app')

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
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="m-auto d-flex align-items-center flex-column ">
            <div class="ru-lds-roller "><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            <h2>Please wait...</h2>
        </div>
    </div>
</div>
<form id="frmPayment" name="frmPayment" method="post" action={{$eghlPaymentLink}}>
    <input type="hidden" name="TransactionType" value="SALE">
    <input type="hidden" name="PymtMethod" value="ANY">
    <input id="service_id" type="hidden" name="ServiceID" value={{$serviceID}}>
    <input id="payment_id" type="hidden" name="PaymentID" value={{$PaymentID}}>
    <input type="hidden" name="OrderNumber" value={{$OrderNumber}}>
    <input type="hidden" name="PaymentDesc" value="Demo Ecommerce Order">
    <input type="hidden" name="MerchantName" value={{"Demo Ecommerce"}}>
    <input id="return_url" type="hidden" name="MerchantReturnURL" value={{$ReturnUrl}}>
    <input id="approval_url" type="hidden" name="MerchantApprovalURL" value={{$ApprovalUrl}}>
    <input id="upapproval_url" type="hidden" name="MerchantUnApprovalURL" value={{$UnApprovalUrl}}>
    <input id="amount" type="hidden" name="Amount" value={{$total}}>
    <input id="currency_code" type="hidden" name="CurrencyCode" value={{$currencyCode}}>
    <input id="ip_address" type="hidden" name="CustIP" value={{$CustIP}}>
    <input type="hidden" name="CustName" value={{(isset(Session::get('user_info')['first_name'])? Session::get('user_info')['first_name'] : "No First Name")."".(isset(Session::get('user_info')['last_name']) ? Session::get('user_info')['last_name'] : "No Last Name")}}>
    <input type="hidden" name="CustEmail" value={{Session::get('user_info')['email']}}>
    <input type="hidden" name="CustPhone" value={{Session::get('user_info')['phone']}}>
    <input id="hash_value" type="hidden" name="HashValue" value={{$sha256}}>
    <input  type="hidden" name="LanguageCode" value="en">
    <input id="page_timeout" type="hidden" name="PageTimeout" value={{$pageTimeout}}>
    </form>
<script type="text/javascript">
    $(document).ready(function(){
            $('#frmPayment').submit()
    });
</script>
@endsection

