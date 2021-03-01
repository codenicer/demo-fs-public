@php
    $condition = [
        'is_active' => 1,
        'web_enabled' => 1,

    ];
    $hubs = (new \App\WebHubs)->getCacheWebHub();
    $current_w_hub = Session::get('web_hub_id');
    $current_hub = Session::get('hub_id');
@endphp
<style>
.mobile-select-nav{
    -webkit-appearance: none;
    -moz-appearance: none;
}

@media (max-width: 768px) {
    #navbar_container{
        margin: 0 !important;
        max-width: none;
        width: 100%;
    }
}
</style>
<div class="header bg-white">
    <!-- Top Bar -->
    <div class="top-navbar d-none d-lg-block">
        <div class="text-right container">
            <ul class="inline-links">

                @auth
                <li>
                    <a href="{{ route('dashboard') }}" class="top-bar-item">{{__('My Panel')}}</a>
                </li>
                {{-- <li>
                    <a href="{{ route('myreview') }}" class="top-bar-item">{{__('My Reviews')}}</a>
                </li> --}}
                <li>
                    <a href="{{ route('logout') }}" class="top-bar-item">{{__('Logout')}}</a>
                </li>
                @else
                <li>
                    <a href="{{ route('user.login') }}" class="top-bar-item">{{__('Login')}}</a>
                </li>
                <li>
                    <a href="{{ route('user.registration') }}" class="top-bar-item">{{__('Registration')}}</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
    <!-- END Top Bar -->

    <!-- mobile menu -->
    <div class="mobile-side-menu d-lg-none">
        <div class="side-menu-overlay opacity-0" onclick="sideMenuClose()"></div>
        <div class="side-menu-wrap opacity-0">
            <div class="side-menu closed">
                <div class="side-menu-header ">
                    <div class="side-menu-close" onclick="sideMenuClose()">
                        <i class="la la-close"></i>
                    </div>

                    @auth
                        <div class="widget-profile-box px-3 py-4 d-flex align-items-center">
                            <div class="image" style="background-image:url('{{ Auth::user()->avatar_original ? asset(Auth::user()->avatar_original) : 'https://images.pexels.com/photos/736230/pexels-photo-736230.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500' }}')"></div>
                                <div class="name">{{ Auth::user()->name }}</div>
                        </div>
                        <div class="side-login px-3 pb-3">
                            <a href="{{ route('logout') }}">{{__('Sign Out')}}</a>
                        </div>
                    @else
                        <div class="widget-profile-box px-3 py-4 d-flex align-items-center">
                                <div class="image " style="background-image:url('{{ asset('frontend/images/icons/user-placeholder.jpg') }}')"></div>
                        </div>
                        <div class="side-login px-3 pb-3">
                            <a href="{{ route('user.login') }}">{{__('Sign In')}}</a>
                            <a href="{{ route('user.registration') }}">{{__('Registration')}}</a>
                        </div>
                    @endauth
                </div>
                <div class="side-menu-list px-3">
                    <ul class="side-user-menu">
                        <li>
                            <a href="{{ route('home') }}">
                                <i class="la la-home"></i>
                                <span>{{__('Home')}}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('dashboard') }}">
                                <i class="la la-dashboard"></i>
                                <span>{{__('Dashboard')}}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('purchase_history.index') }}">
                                <i class="la la-file-text"></i>
                                <span>{{__('Purchase History')}}</span>
                            </a>
                        </li>

                        <!-- <li>
                            <a href="{{ route('compare') }}">
                                <i class="la la-refresh"></i>
                                <span>{{__('Compare')}}</span>
                                @if(Session::has('compare'))
                                    <span class="badge" id="compare_items_sidenav">{{ count(Session::get('compare'))}}</span>
                                @else
                                    <span class="badge" id="compare_items_sidenav">0</span>
                                @endif
                            </a>
                        </li> -->
                        <li>
                            <a href="{{ route('cart') }}">
                                <i class="la la-shopping-cart"></i>
                                <span>{{__('Cart')}}</span>
                                @if(Session::has('cart'))
                                    <span class="badge" id="cart_items_sidenav">{{ count(Session::get('cart'))}}</span>
                                @else
                                    <span class="badge" id="cart_items_sidenav"></span>
                                @endif
                            </a>
                        </li>


                        <li>
                            <a href="{{ route('profile') }}">
                                <i class="la la-user"></i>
                                <span>{{__('Manage Profile')}}</span>
                            </a>
                        </li>



                    </ul>
                    @if ($current_hub == 6)
                    
                    @else
                    <div class="sidebar-widget-title py-0">
                        <span>Categories</span>
                    </div>
                    <ul class="side-seller-menu">
                        @foreach ((new \App\Category)->getCacheCategory() as $key => $category)
                            <li>
                            <a href="{{ route('categories.all', urlencode($category->name)) }}" class="text-truncate">
                                <i class='{{$category->icon}} cat-new-icon align-middle'></i>
                                <span>{{ __($category->name) }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- end mobile menu -->
    <div class='navbar_wrap container' id='navbar_container'> 
        <div class='d-flex py-2 col-xs-12 align-items-center' style='max-width: none !important'>
            {{-- menu bar on smaller screen--}}
            <div class="d-lg-none d-xl-none mobile-menu-icon-box ml-3">
                <a href="" onclick="sideMenuOpen(this)">
                    <div class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
            </div>
            
            {{-- brand logo --}}
                @php
                    $generalsetting = (new \App\GeneralSetting)->getCacheGeneralSettings();
                @endphp
                @if($generalsetting->logo != null)
                    @if($current_w_hub == 3)
                    <a class='flowerstore-logo mr-3' href="{{ route('home') }}" >
                        <img src="{{ asset('frontend/images/logo/new-demo-logo.svg') }}" alt='demo-log' height='40px'/>
                    </a>
                    <a class='flowerstore-logo-mobile w-100' href="{{ route('home') }}" >
                        <img class='mx-auto d-block' src="{{ asset('frontend/images/logo/new-demo-logo.svg') }}" alt='demo-log' height='23px' />
                    </a>
                    @elseif($current_w_hub == 4)
                    <a class='flowerstore-logo mr-3' href="{{ route('home') }}" >
                        <img src="{{ asset('frontend/images/logo/new-demo-logo.svg') }}" alt='demo-log' height='40px'/>
                    </a>
                    <a class='flowerstore-logo-mobile w-100' href="{{ route('home') }}" >
                        <img class='mx-auto d-block' src="{{ asset('frontend/images/logo/new-demo-logo.svg') }}" alt='demo-log' height='23px' />
                    </a>
                    @else
                    <a class='flowerstore-logo mr-3' href="{{ route('home') }}" >
                        <img src="{{ asset('frontend/images/logo/new-demo-logo.svg') }}" alt='demo-log' height='40px'/>
                    </a>
                    <a class='flowerstore-logo-mobile w-100' href="{{ route('home') }}" >
                        <img class='mx-auto d-block' src="{{ asset('frontend/images/logo/new-demo-logo.svg') }}" alt='demo-log' height='23px' />
                    </a>
                    @endif
                @else
                    <img src="{{ asset('frontend/images/logo/logo.png') }}" alt="active shop">
                @endif
            </a>

            <div class='d-none d-lg-flex d-xl-flex align-items-center pr-3'>
                <div>
                    <i class='fa fa-map-marker align-middle pr-2' style='font-size: 19px; color: rgb(119, 179, 43)'></i>
                    <label class='strong col-form-label align-middle pr-2' for="hub_id"><span style='white-space: nowrap'>DELIVER TO</span></label>
                </div>
                <div>
                    <select class='form-control' id="deliver_to_2" name="deliver_to_2"

                        @if (Request::path() === "checkout/payment_method" || Request::path() === "checkout/gift_payment_method")
                            disabled
                        @endif
                    
                    >
                        @foreach($hubs as $key => $hub)
                            <option value="{{$hub->id}}" {{$current_w_hub == $hub->id ? 'selected': ''}}>{{$hub->name}}</option>

                        @endforeach
                    </select>
                </div>
            </div>

            {{-- search bar--}}
            <div class="searchbar-wrap d-flex">
                    <div class="search-box flex-grow-1 px-1">
                        <form action="{{ route('search') }}" method="GET">
                            <div class="d-flex position-relative">
                                
                                <!-- searchbar for mobile -->
                                <div class="d-lg-none search-box-back">
                                    <button class="" type="button"><i class="la la-long-arrow-left"></i></button>
                                </div>
                                <div class="w-100">
                                    <input type="text" aria-label="Search" id="search-nav" name="q" class="w-100" placeholder="I'm shopping for..." autocomplete="off">
                                </div>
    
                                <div class="category-select d-none  d-xl-block ">
                                    <select class="form-control selectpicker" name="category" style='border: 1px solid #cbcbcb'>
                                        <option value="">{{__('All Categories')}}</option>
                                        @foreach ( (new \App\Category)->getCacheCategory() as $key => $category)
                                        <option value="{{ $category->name }}"
                                            @isset($category_id)
                                                @if ($category_id == $category->id)
                                                    selected
                                                @endif
                                            @endisset
                                            >{{ __($category->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
    
                                <button id='btn-submit-nav' class="d-none d-lg-block" type="submit" disabled='disabled'>
                                    <i class="la la-search la-flip-horizontal"></i>
                                </button>
                            </div>
                        </form>
                    </div>
    
                    <div class="logo-bar-icons d-flex ml-auto">
    
                        <!-- icon for mobile search box -->
                        <div class="d-inline-block d-lg-none">
                            <div class="nav-search-box">
                                <a href="#" class="nav-box-link">
                                    <i class="la la-search la-flip-horizontal d-inline-block nav-box-icon"></i>
                                </a>
                            </div>
                        </div>
    
    
                        <div class="d-inline-block" data-hover="dropdown">
                            <div class="nav-cart-box dropdown" id="cart_items">
                                <a href="" class="nav-box-link mr-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="la la-shopping-cart d-inline-block nav-box-icon"></i>
                                    <span class="nav-box-text d-none d-xl-inline-block">{{__('Cart')}}</span>
                                    @if(Session::has('cart'))
                                        <span class="nav-box-number">{{ count(Session::get('cart'))}}</span>
                                    @else
                                        <span class="nav-box-number">0</span>
                                    @endif
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right px-0">
                                    <li>
                                        <div class="dropdown-cart px-0">
                                            @if(Session::has('cart'))
                                                @if(count($cart = Session::get('cart')) > 0)
                                                    <div class="dc-header">
                                                        <h3 class="heading heading-6 strong-700">{{__('Cart Items')}}</h3>
                                                    </div>
                                                    <div class="dropdown-cart-items c-scrollbar">
                                                        @php
                                                            $total = 0;
                                                            $product_list = (new \App\Product)->getCachedProductList();
                                                        @endphp

                                                        @foreach($cart as $key => $cartItem)
                                                            @if($cartItem)

                                                            @php

                                                                       $product = $product_list->where('product_id',$cartItem['id'] )->first();
                                                                       $total = $total + $cartItem['price']*$cartItem['quantity'];
                                                            @endphp
                                                                @if($product)
                                                                <div class="dc-item">
                                                                    <div class="d-flex align-items-center position-relative" >
                                                                        <div class="w-100 h-100 position-absolute overflow-hidden" style='top: 0; left: 0; z-index: 3'>
                                                                            <a href="{{ route('product', urlencode($product->handle)) }}" class='d-block h-100 w-100'></a>
                                                                        </div>
                                                                        <div class="dc-image">
                                                                            <img src="{{ asset($product->thumbnail_img) }}" class="img-fluid" alt="">
                                                                        </div>
                                                                        <div class="dc-content">
                                                                            <span class="d-block dc-product-name text-capitalize strong-600 mb-1">
                                                                                    {{ __($product->title) }}
                                                                            </span>

                                                                            <span class="dc-quantity">x{{ $cartItem['quantity'] }}</span>
                                                                            <span class="dc-price">{{ format_price($cartItem['price']*$cartItem['quantity']) }}</span>
                                                                        </div>
                                                                        <div class="dc-actions" style='z-index: 5'>
                                                                            <button onclick="removeFromCart({{ $key }})">
                                                                                <i class="la la-close"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <div class="dc-item py-3">
                                                        <span class="subtotal-text">{{__('Subtotal')}}</span>
                                                        <span class="subtotal-amount">{{ format_price($total) }}</span>
                                                    </div>
                                                    <div class="py-2 text-center dc-btn">
                                                        <ul class="inline-links inline-links--style-3">
                                                            <li class="px-1">
                                                                <a href="{{ route('cart') }}" class="link link--style-1 text-capitalize btn btn-base-1 px-3 py-1 hov-bounce hov-shaddow">
                                                                    <i class="la la-shopping-cart"></i> {{__('View cart')}}
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @else
                                                    <div class="dc-header">
                                                        <h3 class="heading heading-6 strong-700">{{__('Your Cart is empty')}}</h3>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="dc-header">
                                                    <h3 class="heading heading-6 strong-700">{{__('Your Cart is empty')}}</h3>
                                                </div>
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <div class="d-flex col-xs-12 align-items-center d-lg-none d-xl-none">
            <div class='flex-grow-1 ml-3 d-flex align-items-center'>
                <i class='fa fa-map-marker align-middle pr-2' style='font-size: 19px; color: rgb(119, 179, 43)'></i>
                <label for='deliver_to_1' class='strong col-form-label align-middle' for="hub_id"><span style='white-space: nowrap'>DELIVER TO</span></label>
            </div>
            <div class='d-flex align-items-center mr-2'>
                <select class='form-control mobile-select-nav' dir='rtl' id="deliver_to_1" style='border: 1px solid transparent !important' name="deliver_to_2" 
                
                @if (Request::path() === "checkout/payment_method")
                            disabled
                @endif
                
                >
                    @foreach($hubs as $key => $hub)
                        <option value="{{$hub->id}}" {{$current_w_hub == $hub->id ? 'selected': ''}}>{{$hub->name}}</option>

                    @endforeach
                </select>
                <i class='fa fa-chevron-down' style='color: var(--gray)'></i>
            </div>
        </div>
    </div>
    </div>
    <!-- Navbar -->
</div>

<script type="text/javascript">
    $('#deliver_to_1').change(function(){
        $.get('{{ route('hub.change') }}',{ hub_id:$(this).val(), pathName:"{{Request::path()}}"}, function(data){
            location.reload();
        });
    });

    $('#deliver_to_2').change(function(){
        $.get('{{ route('hub.change') }}',{ hub_id:$(this).val(), pathName:"{{Request::path()}}"}, function(data){
            location.reload();
        });
    });
</script>
