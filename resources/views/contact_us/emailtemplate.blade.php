
<h2>This is auto generated email from contact us.</h2>

<h3>SENDER INFO:</h3>
<hr>
<p>Name: <strong>  {{ $data["name"]}}  </strong></p>
<p>Email: <strong> {{$data["email"]}}  </strong></p>
<p>Phone Number: <strong> {{$data['phonenumber']}} </strong> </p>
<p>Message: </p>
<h2>{{$data['message']}}</h2>

@php
$generalsetting = \App\GeneralSetting::first();
@endphp
