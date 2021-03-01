@extends('frontend.layouts.app')

@section('content')
    <section class="gry-bg py-4">
        <div class="container">
            <div class="row">
                <div class="col bg-white py-2">
                    <div class="px-lg-4 py-lg-2 p-md-1 p-1 border-bottom">
                        <h2 class='font-weight-light'>{{"Contact Us"}}</h2>
                    </div>
                    <div class='p-lg-4 p-md-1 px-1 py-2'>
                        <p class="lead">In case of any issue you can contact us at the following number/s:</p>
                            <ul>
                                @foreach(json_decode($generalsetting->phone) as $value)
                                    <li><h6 class="text-muted" style="text-" ><strong>{{$value}}</strong></h6></li>
                                @endforeach
                            </ul>
                            {{-- <ul >
                                <p class="d-block mb-2" ><strong>{{_('Quezon City')}}</strong></p>
                                <div class='mb-2'>0929 7563 195 - Smart</div>
                                <div class='mb-2'>0995 2569 757 - Globe</div>

                                <p class="d-block mb-2" ><strong>{{_('Makati, Taguig, Mandaluyong, Pasig, and Pasay')}}</strong></p>
                                <div class='mb-2'>0961 0086 944 - Smart</div>
                                <div class='mb-2'>0966 6339 003 - Globe</div>

                                <p class="d-block mb-2" ><strong>{{_('Caloocan, Malabon, Navotas, Valenzuela, Marikina, San Juan City, and Manila')}}</strong></p>
                                <div class='mb-2'>0961 0086 945 - Smart</div>
                                <div class='mb-2'>0966 6339 004 - Globe</div>

                                <p class="d-block mb-2" ><strong>{{_('Parañaque, Las Piñas, Muntinlupa, and Pateros')}}</strong></p>
                                <div class='mb-2'>0961 0086 946 - Smart</div>
                                <div class='mb-2'>0966 6339 005 - Globe</div>

                                <p class="d-block mb-2" ><strong>{{_('Cebu and Davao')}}</strong></p>
                                <div class='mb-2'>0929 7563 195 - Smart</div>
                                <div class='mb-2'>0995 2569 757 - Globe</div>
                            </ul> --}}

                            <p class="lead">or email us at:<strong  class="text-muted" >Demo Ecommerce</strong></p>
                            <p class="lead">You can also send us a message below using the chat.</p>
                            <p class="lead">We are open to serve your concerns from Monday-Friday (9AM-8PM) and Saturday & Sunday (9AM-6PM).</strong></p>
                            <hr class="m-4" >
                            <form  data-toggle="validator"   action="{{ route('contactus.sendmail') }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label col-form-label-lg">Name</label>
                                    <div class="col-lg-10">
                                      <input type="text" class="form-control form-control-lg rounded" id="name" name="name" placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label col-form-label-lg">Email</label>
                                    <div class="col-lg-10">
                                      <input type="email" class="form-control form-control-lg rounded" id="email" name="email" placeholder="Email" required >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone_number" class="col-sm-2 col-form-label col-form-label-lg">Phone #</label>
                                    <div class="col-lg-10">
                                      <input type="number" class="form-control form-control-lg rounded" id="phone_number" name="phonenumber" placeholder="Phone Number" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="message" class="col-sm-2 col-form-label col-form-label-lg">Message</label>
                                    <div class="col-lg-10 ">
                                      <textarea type="email" class="form-control form-control-lg rounded" id="message" name="message" placeholder="Message" required ></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                <label for="captcha" class="col-sm-2 col-form-label col-form-label-lg">{{_('Captcha')}}</label>
                                    <div class="col-lg-10">
                                        <div class="mb-2">
                                            <span id='captcha_img'>{!!captcha_img('math')!!}</span>
                                            <button class="ml-4 btn btn-secondary" id="btn_refresh" type="button">Refresh</button>
                                        </div>
                                      <input
                                          style="max-width:15rem"
                                           type="texxt" class="form-control form-control-lg rounded" id="captcha" name="captcha" placeholder="Captcha" required>
                                        @error('captcha')
                                                <span class="text-danger" >{{"invalid captcha!"}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                </div>
                               
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
   
        $("#btn_refresh").click(function(){
           $.ajax({
               type:"get",
               url:'{{url('/contact-us/refresh_captcha')}}',
               success: function(data){
                  $('#captcha_img').html(data)
              }
           })
        })
     
     </script>
     

@endsection

