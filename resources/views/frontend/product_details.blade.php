@extends('frontend.layouts.app')

@section('meta_title'){{ $product->meta_title }}@stop

@section('meta_description'){{ $product->meta_description }}@stop

@section('meta_keywords'){{ $product->tags }}@stop

@section('meta')

    @php
        if(is_array(json_decode($product->photos)) && count(json_decode($product->photos)) > 0){

            $image_data = asset(json_decode($product->photos)[0]);
        }else{
            $image_data ='';
        }
    @endphp

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $product->title }}">
    <meta itemprop="description" content="{{ $product->meta_description }}">
    <meta itemprop="brand" content="{{ "Demo Ecommerce" }}">
    <meta itemprop="productID" content="{{ $product->product_id }}">
    <meta itemprop="url" content="{{ route('product', urlencode($product->handlse)) }}">
    <meta itemprop="image" content="{{ $image_data }}">
    <meta itemprop="price" content="{{ $product->unit_price }}">
    <meta itemprop="priceCurrency" content="PHP">
    <meta itemprop="availablity" content="in-stock">
    <meta itemprop="condition" content="new">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $product->title }}">
    <meta name="twitter:description" content="{{ $product->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ $image_data }}">
    <meta name="twitter:data1" content="{{ $product->unit_price }}">
    <meta name="twitter:label1" content="Price">
    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $product->title }}" >
    <meta property="og:description" content="{{ $product->meta_description }}" >
    <meta property="og:url" content="{{ route('product', urlencode($product->handle)) }}" >
    <meta property="og:image" content="{{ $image_data }}" >
    <meta property="product:brand" content="Demo Ecommerce" >
    <meta property="product:availability" content="in stock" >
    <meta property="product:condition" content="new" >
    <meta property="product:price:amount" content="{{ $product->unit_price }}" >
    <meta property="product:price:currency" content="{{ "PHP" }}" >
    <meta property="product:retailer_item_id" content="product_{{$product->product_id}}" >
@endsection

@section('content')

<style>
    #ru-custom-h2 h2{
            font-size: 1rem;
    }

    .text-red{
        color:rgba(0, 0, 0, 0.986);;
    }
</style>
    <!-- SHOP GRID WRAPPER -->
    <section class="product-details-area">
        <div class="container">
            <div class="bg-white">
                <!-- Product gallery and Description -->
                <div class="row no-gutters">
                
                        <div class="col-lg-6">
                            <div class="product-gal sticky-top d-flex flex-row-reverse">
                                @if(is_array(json_decode($product->photos)) && count(json_decode($product->photos)) > 0)
                                    <div class="product-gal-img">
                                        <img class="xzoom img-fluid" src="{{ asset(json_decode($product->photos)[0]) }}" xoriginal="{{ asset(json_decode($product->photos)[0]) }}" />
                                    </div>
                                    <div class="product-gal-thumb">
                                        <div class="xzoom-thumbs">
                                            @foreach (json_decode($product->photos) as $key => $photo)
                                                <a href="{{ asset($photo) }}">
                                                    <img class="xzoom-gallery" width="80" src="{{ asset($photo) }}"  @if($key == 0) xpreview="{{ asset($photo) }}" @endif /> 
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-lg-6" style='overflow: hidden'>
                            <!-- Product description -->
                            <div class="product-description-wrapper">
                                <!-- Product title -->
                                <h2 class="product-title">
                                    {{ __($product->title) }}
                                </h2>
                                <ul class="breadcrumb">
                                    <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                    <li>{{$product->title}}</li>
                                </ul>
    
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Rating stars -->
                                        <div class="rating mb-1">
                                            @php
                                                $total = 0;
                                                $total += $product->reviews->count();
                                            @endphp
                                            <span class="star-rating">
                                                {{ renderStarRating($averageInfo['average']) }}
                                            </span>
                                            <span class="rating-count">({{ $total }} {{__('customer reviews')}})</span>
                                        </div>
                                    </div>
                                </div>
    
                                @if($product->base_price > $product->unit_price)
    
                                    <div class="row no-gutters mt-4">
                                        <div class="col-2">
                                            <div class="product-description-label">{{__('Price')}}:</div>
                                        </div>
                                        <div class="col-10">
                                            <div class="product-price-old">
                                                <del>
                                                    {{ format_price($product->base_price) }}
                                                </del>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="row no-gutters mt-3">
                                        <div class="mr-2">
                                            <div class="product-description-label mt-1">{{__('Discount Price')}}:</div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="text-left product-price">
                                                <strong>
                                                    {{ format_price($product->unit_price) }}
                                                </strong>
                                            </div>
                                        </div>
                                    </div> 

                                @else

                                    <div class="row no-gutters mt-3">
                                        <div class="col-2">
                                            <div class="product-description-label">{{__('Price')}}:</div>
                                        </div>
                                        <div class="col-10">
                                            <div class="product-price">
                                                <strong>
                                                    {{ format_price($product->unit_price,2) }}
                                                </strong>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                                {{-- @if(checkInCamp($product->product_id))
                                    <div class="row no-gutters mt-3">
                                        <div class='d-flex align-items-center'>
                                            <span class="text-muted mr-2">{{__("Mother's Day Price")}}: </span><br/>
                                            <span class='strong text-lg'>{{format_price(checkInCamp($product->product_id))}}</span>
                                        </div>
                                    </div>
                                        @else
                                    <div class="row no-gutters mt-3">
                                        <div class='mt-3 text-center'>
                                            <span class='strong'>{{__("Not available for Mother's Day")}}</span>
                                        </div>
                                    </div> 
                                @endif --}}

                                <hr />
                                    <div id='ru-custom-h2' class="row no-gutters mt-3 col-12 ">
                                        {!!html_entity_decode($product->html_body)!!}
                                    </div>
                                <hr />
                                @if ($product['current_stock'] && $product['current_stock'] > 0)
                                <form id="option-choice-form">
                                    @csrf
                                    @if($status == 'N/A')

                                    @else
                                        <div class="row no-gutters">
                                        <div class="col-12 col-lg-2 col-md-2">
                                            <div class="product-description-label my-2">{{__('Quantity')}}:</div>
                                        </div>
                                        <div class="col-12 col-lg-10 col-md-10">
                                            <div class="product-quantity d-flex align-items-center">
                                                <div class="input-group input-group--style-2 pr-3" style="width: 160px;">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-number" type="button" data-type="minus" data-field="quantity" disabled="disabled">
                                                            <i class="la la-minus"></i>
                                                        </button>
                                                    </span>
                                                    <input type="hidden" name="id" value="{{$product->product_id}}">
                                                    <input type="text" name="quantity" class="form-control input-number text-center" placeholder="1" value="1" min="1" max="10">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-number" type="button" data-type="plus" data-field="quantity">
                                                            <i class="la la-plus"></i>
                                                        </button>
                                                    </span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                        <hr />
                                        
                                        @if(count($addons)  )
                                        <div class="row no-gutters">
                                            <div class="col-12">
                                                <div class="product-description-label">{{__('Add ons')}}:</div>
                                            </div>
                                            <div class="col-12 py-1" style='overflow: hidden'>
                                                <div id='css-carousel-outer' class='d-flex align-items-center' style='positon: relative; overflow: hidden; height: 180.85px;'>
                                                    <div id='css-carousel-container' class='d-flex' style='position: absolute; top: 0; left: 0; z-index: 0;'>
                                                        @foreach($addons as $addon)
                                                        <div class="custom-control custom-checkbox css-carousel-item">
                                                            <input type="checkbox" class="custom-control-input" name="product_addon[{{$product->product_id}}][]" value="{{$addon->product_id}}" id="addon_{{$addon->product_id}}" />
                                                            <label class="custom-control-label" for="addon_{{$addon->product_id}}">
                                                                <img src="{{isset($addon->thumbnail_img) ? asset($addon->thumbnail_img) : ''}}"  class="mx-2" id='css-carousel-img' width='100px'/>
                                                                <!-- <img src='http://dummyimage.com/96x96/f0f0f0/626262.png&text=1' class="mx-2" id='css-carousel-img' width='100px'/> -->
                                                                <div>
                                                                    <div>{{$addon->title}}</div>
                                                                    <div class='strong'>{{ format_price($addon->unit_price) }}</div>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <div id='css-carousel-left' class='css-carousel-triggers d-flex align-items-center justify-content-center rounded-circle text-white' style='font-size: 1.1rem; z-index: 1; left: 0; position: absolute; background: rgba(0, 0, 0, 0.986);; width: 30px; height: 30px; cursor:pointer;'>
                                                        <i class='fa fa-angle-left'></i>
                                                    </div>
                                                    <div id='css-carousel-right' class='css-carousel-triggers d-flex align-items-center justify-content-center rounded-circle text-white' style='font-size: 1.1rem; z-index: 2; right: 0; position: absolute; background: rgba(0, 0, 0, 0.986);; width: 30px; height: 30px; cursor:pointer;'>
                                                        <i class='fa fa-angle-right'></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                        @endif
                                    @endif

                                    <div class="row no-gutters pb-3 d-none" id="chosen_price_div">
                                        <div class="col-12 col-lg-2 col-md-2">
                                            <div class="product-description-label">{{__('Total Price')}}:</div>
                                        </div>
                                        <div class="col-12 col-lg-10 col-md-10">
                                            <div class="product-price">
                                                <strong id="chosen_price">
    
                                                </strong>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @endif
                                @if($status == 'N/A')
                                    <div class="d-table width-100 mt-3">
                                        <div class="d-table-cell">
                                                <div class="d-flex align-items-center">

                                                    <span class="text-danger"><h2><strong> {{__('This product is not available in your selected delivery zone.')}}</strong></h2></span>
                                                </div>
                                        </div>
                                    </div>
                                @else
                                <div class="d-table width-100 mt-3">
                                    <div class="d-table-cell">
                                    @if(!$product['current_stock'] || $product['current_stock'] <= 0 )
                                    <div class="d-flex align-items-center">
                                        <span class="text-danger"><h2><strong> This product is out of stock.</strong></h2></span>
                                    </div>
                                    @else
                                    <button type="button" class="btn btn-styled btn-alt-base-1 c-white btn-icon-left strong-700 hov-bounce hov-shaddow ml-2" onclick="addToCart()">
                                            <div class="d-flex align-items-center">
                                                <i class="la la-shopping-cart mr-2" style='font-size: 1.2rem'></i>
                                                <span> {{__('Add to cart')}}</span>
                                           </div>
                                        </button>
                                    @endif
                                    </div>
                                </div>
                                @endif
    
                                <hr class="mt-3 mb-0" />
                               
                                <div class="row no-gutters mt-3">
                                    <div class="col-12 col-lg-2 col-md-2">
                                        <div class="product-description-label alpha-6">{{__('Payment')}}:</div>
                                    </div>
                                    <div class="col-12 col-lg-10 col-md-10">
                                    <ul class="inline-links">
                                     
                                        <li class='py-2 text-left' style='font-size: 9px; color: rgba(0,0,0,.9)'>
                                            <span class='strong'>Cash</span><br/>
                                            <span class='strong'>Pick-Up</span>
                                        </li>
                                        <li class='py-2 text-left' style='font-size: 9px; color: rgba(0,0,0,.9)'>
                                            <span class='strong'>COD</span><br/>
                                            <span class='strong'>Cash on Delivery</span>
                                        </li>
                                    </ul>
                                    </div>
                                </div>

                                <div class="row no-gutters mt-3">
                                    <div class="col-2">
                                        <img src="{{ asset('frontend/images/icons/buyer-protection.png') }}" width="40" class="" />
                                    </div>
                                    <div class="col-10">
                                        <div class="heading-6 strong-700 text-info d-inline-block">Buyer protection</div>
                                        {{--<a href={{url('/page/Terms--Conditions')}} class="ml-2">View details</a>--}}
                                        <ul class="list-symbol--1 pl-4 mb-0 mt-2">
                                            <li><strong>Full Refund</strong> if you don't receive your order</li>
                                            <!-- <li><strong>Full or Partial Refund</strong>, if the item is not as described</li> -->
                                        </ul>
                                    </div>
                                </div>

                                <hr class="mt-3" />

                                <div class="row no-gutters mt-4">
                                    <div class="col-2">
                                        <div class="product-description-label mt-2">{{__('Share')}}:
                                        
                                        </div>
                                    </div>
                                    <div class="col-10">
                                        <div id="share">
                                        
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>

    <section style="background-color: #eee ;     padding: 20px 0;">
        @if($reviews != null)
         @include('frontend.productreview',['reviews'=>$reviews, 'averageInfo'=>$averageInfo ,'reviews_count'=>$reviews_count , "paginatedReview"=>$paginatedReview,"id"=>$product->product_id])
        @endif
    </section>

    <section class="mb-4">
        <div class="container">
            <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
                <div class="section-title-1 clearfix">
                    <h3 class="heading-5 strong-700 mb-0 float-left">
                        <span class="mr-4">{{__('Related Products')}}</span>
                    </h3>
                </div>
                <div class="tab-pane">
                    <div class="row gutters-5 sm-no-gutters">
                        @foreach ((filter_related_products($product->product_id))->limit(6)->get() as $key => $related_product)
                            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
      
                                <div class="product-box-2 h-100 bg-white position-relative" id='product-card'>
                                    @if(!$related_product['current_stock'] || $related_product['current_stock'] <= 0 )
                                        <div class="position-absolute h-100 w-100 d-flex align-items-start justify-content-center" style="z-index: 2; background: rgba(255,255,255,.5)">
                                            <div class="text-uppercase py-1 px-3 text-white" style="font-size: 1rem; border-radius: 5px; background: #dc3545; transform: rotate(0deg); margin-top: 72px;">Sold out</div>
                                        </div>
                                    @endif
                                    <a class='position-absolute h-100 w-100' style='z-index: 3' href="{{ route('product', urlencode($related_product->handle)) }}"></a>
                                    <!-- href="{{ route('product', urlencode($related_product->handle)) }}" -->
                                    <!-- <img src="https://images.pexels.com/photos/60597/dahlia-red-blossom-bloom-60597.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" style="width: 100%"> -->
                                    <div id='product-image' data-src="{{isset($related_product->featured_img) ? asset($related_product->featured_img) : ''}}"></div>
                                    <div class="p-3 border-top">
                                        <h2 class="product-title p-0 text-truncate">
                                             <a href="{{ route('product', urlencode($related_product->handle)) }}" tabindex="0">{{$related_product->title}}</a>
                                        </h2>
                                        <div class="star-rating mb-1">
                                            {{ renderStarRating($related_product->rating) }}
                                        </div>

                                        <div class="clearfix">
                                            <div class="price-box float-left">
                                                <span class="product-price strong-600 d-lg-none d-inline pr-2">{{ format_price($related_product->unit_price) }}</span>
                                                <span><del class="old-product-price strong-400 text-md">{{ $related_product->base_price > $related_product->unit_price ? format_price($related_product->base_price) : " " }}</del></span>
                                                <div class="d-none d-lg-block product-price strong-600">{{ format_price($related_product->unit_price) }}</div>
                                            </div>
                                            <div class='float-right d-none d-lg-block'>
                                                <div class="add-to-cart btn url_product" title="Quick view">
                                                    <i class="la la-shopping-cart cartenings"></i>
                                                </div>
                                            </div>
                                        </div>

                                         {{-- <div class='mt-2'>
                                            @if(checkInCamp($related_product->product_id))
                                            <span class="text-muted">{{__("Mother's Day Price")}}: </span><br/>
                                            <span class='strong text-lg'>{{format_price(checkInCamp($related_product->product_id))}}</span>
                                            @else
                                            <span class='strong text-sm'>{{__("Not available for Mother's Day")}}</span>
                                            @endif
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('frontend/js/xzoom.min.js') }}"></script>
    <script src="{{ asset('frontend/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.share.js') }}"></script>
{{-- <script src="https://affiliates2.findshare.com/FindshareAffiliateScript"></script> --}}
<script>
    const checkProduct = productInfo => {    
        showFrontendAlert("info","Out of stock!")
    }
</script>
    <script type="text/javascript">
    
        $(document).ready(function() {
            var uri = window.location.toString();
            if (uri.indexOf("?") > 0) {
                var clean_uri = uri.substring(0, uri.indexOf("?hub=")) || uri.substring(0, uri.indexOf("?help="));
                var gclid_uri = "";
                if(uri.indexOf("&") > 0){
                    gclid_uri = uri.substring(uri.lastIndexOf('&') + 1);

                    if(gclid_uri){
                       gclid_uri = "?" + gclid_uri;
                    }
                }
                window.history.replaceState({}, document.title, clean_uri + gclid_uri);
            }

            var zoomXoffset = 20;
            var zoomposition = 'right'
            
            $('.xzoom, .xzoom-gallery').xzoom({
                Xoffset: zoomXoffset,
                bg: true,
                tint: '#000',
                defaultScale: -1,
                position: zoomposition
            });

    		$('#share').share({
    			networks: ['facebook','twitter', 'pinterest'],
    			theme: 'square'
    		});
           // getVariantPrice();

            // add-ons carousel script
            var carouselOuter = document.getElementById('css-carousel-outer');
            var carouselContainer = document.getElementById('css-carousel-container');
            var leftBtn = document.getElementById('css-carousel-left');
            var rightBtn = document.getElementById('css-carousel-right');
            var translate = 0;
            var carouselItems = document.querySelectorAll('.css-carousel-item');
            var numOfItems = Math.floor(carouselOuter.offsetWidth / 100) > 4 ? 4 : Math.floor(carouselOuter.offsetWidth / 100);

            var test = $('.css-carousel-item');
                current = 1;
                itemNum = test.length
                carouselBtn = $('.css-carousel-triggers');
                carouselWrap = $('#css-carousel-container');

            console.log(test.filter(':first'), test.filter(':last'))

            //variable for swipe
            var initialX;

            carouselContainer.addEventListener('touchstart', function(e){
                initialX = e.touches[0].clientX;
            }, false)

            carouselContainer.addEventListener('touchmove', function(e){
                if (initialX === null) {
                    return;
                }

                var currentX = e.touches[0].clientX;

                var diffX = initialX - currentX;

                // sliding horizontally
                if (diffX > 0) {
                    // swiped right
                    triggerHandler('css-carousel-right')
                } else {
                     // swiped left
                    triggerHandler('css-carousel-left')
                }  

                initialX = null;
                initialY = null;

                e.preventDefault();} , false)


            console.log(numOfItems, itemNum, (carouselOuter.offsetWidth / numOfItems));
            carouselItems.forEach(function(item){
                    item.setAttribute('style', `width: ${(carouselOuter.offsetWidth / numOfItems)}px`);
                    item.children[1].setAttribute('style', `width: ${(carouselOuter.offsetWidth / numOfItems) - 30}px;`)
                    item.children[1].children[0].setAttribute('style',  `width: ${(carouselOuter.offsetWidth / numOfItems) - 30}px;`)
            })
            
            // leftBtn.addEventListener('click', slideLeft);

            // rightBtn.addEventListener('click', slideRight);

            if(numOfItems >= itemNum){
                leftBtn.setAttribute('style', "display:none")
                rightBtn.setAttribute('style', "display:none")

            } else {
                carouselContainer.setAttribute('style', `position: absolute; top: 0; left: -${carouselOuter.offsetWidth + (carouselOuter.offsetWidth / numOfItems )}px; z-index: 0;`)
                for(var i = numOfItems; i !== -1; i--){
                    test.filter(':first').before(test.filter((index)=>index==(itemNum-i)).clone(true).prop('id', 'clone'))
                }
                for(var f = numOfItems; f !== -1; f--){
                    test.filter(':last').after(test.filter((index)=>index==(f)).clone(true).prop('id', 'clone'))
                }
            }

                $( window ).resize(function() {
                    let itemAfterClone = $('.css-carousel-item');
                    var carouselOuter = document.getElementById('css-carousel-outer');
                    console.log(itemAfterClone, typeof itemAfterClone, 'CLONE');

                    itemAfterClone.each(function(index, element){
                        if(element.id === 'clone'){
                            element.remove();
                        }
                    })

                    let itemAfterRemove = $('.css-carousel-item');
                    numOfItems = Math.floor(carouselOuter.offsetWidth / 100) > 4 ? 4 : Math.floor(carouselOuter.offsetWidth / 100);
                    itemNum = itemAfterRemove.length
                    current = 1;

                    carouselItems.forEach(function(item){
                        item.setAttribute('style', `width: ${(carouselOuter.offsetWidth / numOfItems)}px;`);
                        item.children[1].setAttribute('style', `width: ${(carouselOuter.offsetWidth / numOfItems) - 30}px;`)
                        item.children[1].children[0].setAttribute('style', `width: ${(carouselOuter.offsetWidth / numOfItems) - 30}px;`)
                    })

                    console.log(numOfItems >= itemNum, numOfItems, itemNum)
                    if(numOfItems >= itemNum){
                        leftBtn.setAttribute('style', "display:none")
                        rightBtn.setAttribute('style', "display:none")
                        carouselContainer.setAttribute('style', 'position: absolute; top: 0; left: 0; z-index: 0;')

                    } else {
                        carouselContainer.setAttribute('style', `position: absolute; top: 0; left: -${carouselOuter.offsetWidth + (carouselOuter.offsetWidth / numOfItems )}px; z-index: 0;`)
                        leftBtn.setAttribute('style', 'font-size: 1.1rem; z-index: 1; left: 0; position: absolute; background: rgba(0, 0, 0, 0.986);; width: 30px; height: 30px; cursor:pointer;')
                        rightBtn.setAttribute('style', 'font-size: 1.1rem; z-index: 1; right: 0; position: absolute; background: rgba(0, 0, 0, 0.986);; width: 30px; height: 30px; cursor:pointer;')
                        carouselContainer.setAttribute('style', `position: absolute; top: 0; left: -${carouselOuter.offsetWidth + (carouselOuter.offsetWidth / numOfItems )}px; z-index: 0;`)
                        for(var i = numOfItems; i !== -1; i--){
                            test.filter(':first').before(test.filter((index)=>index==(itemNum-i)).clone(true).prop('id', 'clone'))
                        }
                        for(var f = numOfItems; f !== -1; f--){
                            test.filter(':last').after(test.filter((index)=>index==(f)).clone(true).prop('id', 'clone'))
                        }
                    }

                    carouselBtn.off('click', triggerHandler)
                    carouselBtn.on('click', triggerHandler)
            });

           $(".custom-control-input").on('change', function(){
                    var id = this.id
                    var checked = this.checked
                    var addCheckboxes = $('.custom-control-input')
                    addCheckboxes.each(function(i, elem){
                        if(elem.id === id){
                            elem.checked = checked;
                        }
                    })
            })

            carouselBtn.on('click', triggerHandler)

            function triggerHandler(id){
                var cycle = false;
                var trigger;

                if(typeof id === 'string'){
                    trigger = (id === 'css-carousel-left') ? -1 : 1;
                } else {
                    trigger = (this.id === 'css-carousel-left') ? -1 : 1;
                }
                carouselWrap.animate({
                    left: '+=' + (-(carouselOuter.offsetWidth / numOfItems) * trigger)
                }, function(){
                    current += trigger
                    cycle = !!(current === 0 || current > itemNum);

                    if(cycle){
                        console.log('cycle')
                        current = (current === 0) ? itemNum : 1;
                        carouselWrap.css({left: -(carouselOuter.offsetWidth / numOfItems) * (current + numOfItems) })
                    }
                })
            }

        });


    </script>
@endsection
    <!-- Facebook Pixel Code -->
    @php

        $vp = \App\ViewProduct::where('product_id', $product->product_id)->where('hub_id', $product->hub_id)
         ->first();

        if($vp){

            $category = $vp->category_name;
        }else{
            $category = null;
        }
    @endphp


@section('script')
    <script>


        var dataLayer  = window.dataLayer || [];
        dataLayer.push({
            'event': 'ViewProduct',
                'products':
                    [{
                        'name':" @php
                            echo $product->title;
                        @endphp ",
                        'id': '{{$product->product_id ? $product->product_id : ''}}',
                        'price': '{{$product->unit_price}}',
                        'brand': 'Demo Ecommerce',
                        'quantity': 1,
                        'category': "@php
                            echo $category;
                        @endphp"
                    }]
        });

    </script>
    <script type="text/javascript">

                    addVisit('d6MPFEmuu0ZRuU4t',{
      	                      	productId:{{$product->product_id}}
      	          	});
     </script>
<!-- End Facebook Pixel Code -->
@endsection
