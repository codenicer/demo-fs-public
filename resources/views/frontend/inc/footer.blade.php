<footer id="footer" class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row cols-lg-space cols-xs-space cols-sm-space cols-md-space">
                @php
                    $generalsetting = (new \App\GeneralSetting)->getCacheGeneralSettings();
                    $current_w_hub = Session::get('web_hub_id');
                @endphp
                <div class="col-lg-12 col-xl-4 col-md-12 text-center text-md-left">
                    <div class="col">
                        <a href="{{ route('home') }}" class="d-block">
                         
                                <img src="{{ asset('frontend/images/logo/new-demo-logo.svg') }}" class="" height="44">
                    
                        </a>
                        <p class="mt-3">{{ $generalsetting->description }}</p>
                        <div class="d-inline-block d-md-block">
                            <form class="form-inline" action="#">
                                @csrf
                                <div class='d-flex'>
                                    <div class="form-group flex-grow-1 mb-0">
                                        <input type="email" class="form-control" placeholder="{{'Your Email Address'}}" name="email" required>
                                    </div>
                                    <button type="submit" class="btn btn-base-1 btn-icon-left">
                                        {{'Subscribe'}}
                                    </button>   
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xl-2 col-md-3">
                    {{-- <div class="col text-center text-md-left">
                        <h4 class="heading heading-xs strong-600 text-uppercase mb-2">
                            {{__('Contact Info')}}
                        </h4>
                        <ul class="footer-links contact-widget">
                            <li>
                               <span class="d-block opacity-5">{{__('Address')}}:</span>
                               <span class="d-block">{{ $generalsetting->address }}</span>
                            </li>
                            <li>
                               <span class="d-block opacity-5">{{__('Phone')}}:</span>
                               <span class="d-block">{{ $generalsetting->phone }}</span>
                            </li>
                            <li>
                               <span class="d-block opacity-5">{{__('Email')}}:</span>
                               <span class="d-block">
                                   <a href="mailto:{{ $generalsetting->email }}">{{ $generalsetting->email  }}</a>
                                </span>
                            </li>
                        </ul>
                    </div> --}}
                    <div class="col text-center text-md-left">
                        <h6 class="text-uppercase mb-3">
                            {{'Site Links'}}
                        </h6>
                            <ul class="footer-links">
                             
                               
                            <li>
                               <a href="#" class="d-block">{{__('About Us')}}</a>
                            </li>
                            <li>
                               <a href="#" class="d-block">{{__('As featured in')}}</a>
                            </li>
                            <li>
                               <a  href="#" class="d-block ">{{__('Testimonials')}}</a>
                            </li>
                            <li>
                                <a  href="/page/propose-with-us-TVDXZ	" class="d-block ">{{__('Propose with Us')}}</a>
                             </li>
                             <li>
                                <a  href="#" class="d-block ">{{__('Secret Admirer')}}</a>
                             </li>
                             <li>
                                <a  href="#" class="d-block ">{{__('Careers')}}</a>
                             </li>
                             <li>
                                <a  href="#" class="d-block ">{{__('Earn money with our')}}</a>
                             </li>
                             <li>
                      
                             <ul/>
                    </div> 
                </div>
                <div class="col-lg-3 col-xl-2 col-md-3">
                    <div class="col text-center text-md-left">
                        <h6 class="text-uppercase mb-3">
                            {{'Customer Care'}}
                        </h6>
                        <ul class="footer-links mb-3">
                            <li>
                                <a href="#" class="d-block">{{'Contact Us'}}</a>
                             </li>
                          
                             <li>
                                 <a  href="#"  class="d-block ">{{'Return & Exchange Policy'}}</a>
                              </li>
                              <li>
                             
                                 <a  href="#"  class="d-block ">{{'Terms & Conditions'}}</a>
                              </li>
                              <li>
                                 <a  href="#" class="d-block ">{{'Privacy Policy'}}</a>
                              </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-xl-2 col-md-6">
                    <div class="col text-center text-md-left">
                        <h6 class="text-uppercase mb-3">
                            {{'Got Questions?'}}
                        </h6>
                        <ul class="footer-links">
                            <li class='mb-2'>
                                <p class="d-block mb-0" ><strong>{{'Phone'}}:</strong></p>
                                @foreach(json_decode($generalsetting->phone) as $value)
                                <span>{{$value}}</span>
                                @endforeach
                            </li>
                         
                        </ul> 
                    </div>
                </div>
                <div class="col-lg-3 col-xl-2 col-md-3">
                    <div class="col text-center text-md-left">
                      
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom py-3">
        <div class="container">
            <div class="row row-cols-xs-spaced flex flex-items-xs-middle">
                <div class="col-md-3">
                    <div class="copyright text-center text-md-left">
                        <ul class="copy-links no-margin">
                            <li>
                                © {{ date('Y') }} {{ $generalsetting->site_name }}
                            </li>
                            <li>
                                {{--<a href="{{ route('terms') }}">{{__('Terms')}}</a>--}}
                            </li>
                            <li>
{{--                                <a href="{{ route('privacypolicy') }}">{{__('Privacy policy')}}</a>--}}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="text-center my-3 my-md-0 social-nav model-2">
                        @if ($generalsetting->facebook != null)
                            <li>
                                <a href="#" class="facebook" target="_blank" data-toggle="tooltip" data-original-title="Facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                        @endif
                        @if ($generalsetting->instagram != null)
                            <li>
                                <a href="#" class="instagram" target="_blank" data-toggle="tooltip" data-original-title="Instagram">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </li>
                        @endif
                        @if ($generalsetting->twitter != null)
                            <li>
                                <a href="#" class="twitter" target="_blank" data-toggle="tooltip" data-original-title="Twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                        @endif
                        @if ($generalsetting->youtube != null)
                            <li>
                                <a href="#" class="youtube" target="_blank" data-toggle="tooltip" data-original-title="Youtube">
                                    <i class="fa fa-youtube"></i>
                                </a>
                            </li>
                        @endif
                        @if ($generalsetting->google_plus != null)
                            <li>
                                <a href="#" class="pinterest" target="_blank" data-toggle="tooltip" data-original-title="Pinterest">
                                    <i class="fa fa-pinterest"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="col-md-5">
                    <div class="text-center">
                        <ul class="inline-links">
                            <li  style='font-size: 9px; color: rgba(0,0,0,.9)'>
                                <span class='strong'>Cash</span><br/>
                                <span class='strong'>Pick-Up</span>
                            </li>
                            <li  style='font-size: 9px; color: rgba(0,0,0,.9)'>
                                <span class='strong'>COD</span><br/>
                                <span class='strong'>Cash on Delivery</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
