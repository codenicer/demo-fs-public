 @extends('frontend.layouts.app')


@section('content')
<style>

.url_product{
    cursor: pointer;
}

.cartenings{
    color:rgba(0, 0, 0, 0.986);;
}

.cartenings:hover{
    color:white;
    transition: 0.03s;
}

.countdown--style-2,
.countdown--style-3 {
    display: flex
}

.countdown--style-3 .countdown-item {
    margin: 0 2px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}
.countdown--style-3 .countdown-item .countdown-digit {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    background: rgba(0, 0, 0, .5);
    color: white;
    font-size: 14px !important;
    text-align: center;
}
.countdown--style-3 .countdown-label {
    display: block;
    padding: 0;
    margin-top: 5px;
    text-align: center;
    font-size: 11px;
    font-weight: bold;
    text-transform: uppercase
}

.countdown--style-2 .countdown-item {
    margin: 0 2px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

.countdown--style-2 .countdown-item .countdown-digit {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
    background: rgba(0, 0, 0, .5);
    color: white;
    font-size: 10px !important;
    text-align: center;
}

.countdown--style-2 .countdown-label {
    display: block;
    padding: 0;
    margin-top: 5px;
    text-align: center;
    font-size: 11px;
    font-weight: bold;
    text-transform: uppercase
}

#below-nav-bar-wrap {
    flex-wrap: nowrap;
    
}

#cat_no_campaign {
    padding: 4px 0;
}

@media (max-width: 991px){
    #below-nav-bar-wrap{
        flex-wrap: wrap
    }

    #cat_no_campaign {
    padding: 0;
}


    #categories-wrap {
        width: 100%;
    }
}


@media (min-width: 1500px){
   #categories-wrap{
       flex-grow: 1 ;
   }
   
}
</style>
   @php
        $hub_id = session('hub_id');
        $hub_id = $hub_id ? $hub_id : 1;
         
        $c_campaign = (new \App\CampaignSchedule)->getActiveCampaign();

        //$c_campaign = \App\CampaignSchedule::where('is_enabled', 1)->where('is_active',1)->first();

        $current_hub_id =  Session::get('hub_id');

        $current_hub_id =  Session::get('hub_id');
        $shown_products = array();
        $flash_deal = \App\FlashDeal::where('status', 1)
                            ->whereHas('hubs', function($query) use ( $current_hub_id )
                            {
                                $query->where('flash_deal_hub.hub_id', $current_hub_id);

                            })
                            ->where('start_date','<=', strtotime(date('Y-m-d\TH:i:s')))
                            ->where('end_date','>=', strtotime(date('Y-m-d\TH:i:s')))
                            ->orderBy('start_date','asc')->first();


       // $flash_deal = getActiveFlashDeal();

        // $flash_deal = flashSale();
        $flash_products = [];
        if($flash_deal){
            $flash_products = filter_flash_products($flash_deal->flash_deal_products);

            $dateNow = date('Y-m-d\TH:i:s');
            $flashStart = date('Y-m-d\TH:i:s', $flash_deal->start_date);
            $flashEnd = date('Y-m-d\TH:i:s', $flash_deal->end_date);
            $flashEndCountDownFormat = date('m/d/Y H:i:s', $flash_deal->end_date);
        }
    @endphp
    <section class="home-banner-area mb-2">
        <div class='container' id='categories-container'>
            <div class="row no-gutters position-relative" id='below-nav-bar-wrap'>
                @if ($hub_id == 6)
                    
                @else
                <div class="position-static order-2 order-lg-0" id='categories-wrap'>
                    <div class="category-sidebar" style='white-space: no-wrap'>
                        <div class="all-category">
                            <span >{{__('Categories')}}</span>
                        </div>
                        <ul class="categories no-scrollbar" id='category_icons_wrap'>
                            @if($c_campaign!=null)
                            <li>
                                <a 
                                    href="{{ route('products.campaign', urlencode($c_campaign->title)) }}">
                                    <div class='cat-wrap'>
                                        <img class='d-lg-block d-none' src="{{ asset('frontend/images/logo/valentines.svg') }}" alt="valentine's day" width='20px'>
                                        <img class='d-block d-lg-none' style='margin-top: 3px; margin-bottom: 3px'src="{{ asset('frontend/images/logo/valentines.svg') }}" alt="Valentine's Day" height='30px'>
                                        <span class="cat-name">{{ __($c_campaign->title) }}</span>
                                        <i class='la la-angle-right cat-indicator'></i>
                                    </div>
                                </a>
                            </li>
                            @endif
                            @foreach ( (new \App\Category)->getCacheCategory() as $key => $category)
                                <li>
                                    <a href="{{ route('categories.all', urlencode($category->name)) }}">
                                        <div @if($c_campaign == null) id='cat_no_campaign' @endif class='cat-wrap'>
                                            @if($category->id === 6)
                                                <img class='d-lg-block d-none' src="{{ asset('frontend/images/logo/food.svg') }}" alt="valentine's day" width='20px' height='20px'>
                                                <img class='d-block d-lg-none' style='margin-top: 3px; margin-bottom: 3px' src="{{ asset('frontend/images/logo/food.svg') }}" alt="valentine's day" width='30px' height='30px'>
                                            @else
                                                <i class='{{$category->icon}} cat-new-icon'></i>
                                            @endif
                                            <span class="cat-name">{{ __($category->name) }}</span>
                                            <i class='la la-angle-right cat-indicator'></i>
                                        </div>
                                    </a>
                                    @if(count($category->subcategories)>0)
                                        <div class="sub-cat-menu c-scrollbar">
                                            <div class="sub-cat-main row no-gutters">
                                                <div>
                                                    <div class="sub-cat-content">
                                                        <div class="sub-cat-list">
                                                            <div class="card-columns">
                                                                @foreach ($category->subcategories as $subcategory)
                                                                    @if($subcategory->id !== 42)
                                                                    <div class="card">
                                                                        <ul class="sub-cat-items">
                                                                            <li>
                                                                                <a href="{{ route('products.subcategory', urlencode($subcategory->slug)) }}"><strong>{{ __($subcategory->name) }}</strong></a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
                <div class="order-1 order-lg-0 mx-2 @if($hub_id == 6)w-100 @endif" @if(count($flash_products) == 0) style='margin: auto' @endif>
                    <div class='d-flex align-items-center h-100 ' id='slider-wrap'>
                        <div id='slider-image-container'>
                            <div class="home-slide h-100">
                                <div class="home-slide h-100">
                                    <div class="slick-carousel h-100" data-slick-arrows="true" data-slick-dots="true" data-slick-autoplay="true">
                                        <a href="/collection/FOR+SALE+%21%21%21%21" class='h-100' >
                                            <img class="d-block image_slider" src="{{asset('frontend/images/web-img3.jpg') }}" alt="Slider Image" width='100%'>
                                        </a>
                                        <a href="#" class='h-100' >
                                            <img class="d-block image_slider" src="{{ asset('frontend/images/web-img2.jpg') }}" alt="Slider Image" width='100%'>
                                        </a>
                                        <a href="#" class='h-100' >
                                            <img class="d-block image_slider" src="{{ asset('frontend/images/web-img.jpg') }}" alt="Slider Image" width='100%'>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    @if( count($flash_products)
                    && ($flash_deal != null
                    && $dateNow >= $flashStart
                    && $dateNow < $flashEnd))
                    <script src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>
                    <div class='d-none d-xl-flex flex-column justify-content-center' style='max-width: 176px;' id='flash_product_box'>
                        <div class='d-flex h-100'>
                            <div class='d-flex flex-grow-1 align-items-center'>
                                <span style='white-space: nowrap'class='strong'>{{__('Flash Sale')}}</span>
                            </div>
                            <div class="countdown countdown--style-1-v1 countdown--style-2 d-flex align-items-center" data-countdown-date="{{ $flashEndCountDownFormat }}" data-countdown-label="show"></div>
                        </div>
                        <div class='d-flex align-items-end h-100'>

                        @foreach ($flash_products as $key => $fproduct)
                            @if ($fproduct)
                            <div class="d-flex flex-column product-box-2 bg-white position-relative" id='flash_product_wrap'>
                                @if ($fproduct->current_stock <= 0)
                                    <div class="position-absolute h-100 w-100 d-flex align-items-start justify-content-center" style='z-index: 2; background: rgba(255,255,255,.5)'>
                                        <div class='text-uppercase py-1 px-3 text-white' style='font-size: 1rem; border-radius: 5px; background: #dc3545; transform: rotate(0deg); margin-top: 72px;'>Sold out</div>
                                    </div>
                                @endif
                                <a class='position-absolute h-100 w-100' style='z-index: 3' href="{{ $fproduct->type == 'HospitalGiveBack' ? route('product', [urlencode($fproduct->handle), 'hub' => '6']) : route('product', urlencode($fproduct->handle)) }}" ></a>
                                <img id='flash-product-image' src="{{isset($fproduct->featured_img) ? asset($fproduct->featured_img) : ''}}" />
                                <div class="p-2 border-top">
                                    <div class="d-flex" style='flex-wrap: wrap'>
                                        <div class='flex-grow-1'>
                                            <div class='d-flex'>
                                                <span class="strong p-0 text-truncate text-xs" style='height: 27px'>{{$fproduct->title}}</span>
                                            </div>
                                        </div>
                                        <div class='d-flex w-100'>
                                            <div class="flex-grow-1 price-box">
                                                <span><del class="old-product-price strong ">{{ $fproduct->base_price >   $fproduct->unit_price ? format_price($fproduct->base_price) : " " }}</del></span><br/>
                                                <span class="product-price strong ">{{ format_price($fproduct->unit_price) }}</span>
                                            </div>
                                            <div class="add-to-cart btn align-self-center" title="Quick view">
                                                <i class="la la-shopping-cart"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <!-- <div style='flex-basis:100%; width: 0;'></div> -->
                            @endif
                            @endforeach
                        </div>
                    </div>
                    @endif
            </div>
        </div>
    </section>


    @if( count($flash_products)
    && ($flash_deal != null
    && $dateNow >= $flashStart
    && $dateNow < $flashEnd))

        <section class="mb-4 d-block d-xl-none"> 
            <div class="container">
                <div class="px-2 p-md-4 bg-white shadow-sm">
                    <div class="section-title-1 clearfix">
                        <div class="d-flex">
                            <span class='heading-5 strong mb-0 flex-grow-1'>{{__('Flash Sale')}}</span>
                            <div class="countdown countdown--style-3 countdown--style-1-v1" data-countdown-date="{{ $flashEndCountDownFormat }}" data-countdown-label="show"></div>
                        </div>
                    </div>
                    <div class="tab-pane">
                        <div class="row gutters-5 sm-no-gutters">
                            <!-- start product loop -->

                            @foreach ($flash_products as $key => $fproduct)
                                @php
                               // Illuminate\Support\Facades\DB::EnableQueryLog();
                                  //  $fproduct = \App\ViewProduct::where('hub_id', Session::get('hub_id'))->find($flash_deal_product->product_id);
                                //dd(Illuminate\Support\Facades\DB::getQueryLog());
                                //dd($flash_deal_product->product_id);
                               // dd($fproduct);
                                @endphp

                                @php
                                    $rev = getReview($fproduct->product_id);

                                    if($rev){
                                        $flash_review = $rev->total_reviews;
                                        $avg_star_flash = $rev->avg_reviews;
                                    }else{
                                        $flash_review = 0;
                                        $avg_star_flash = 0;

                                    }
                                 //   $flash_review = App\Review::where('product_id', $fproduct->product_id)->get();
                                 //   $avg_star_flash = App\Review::where('product_id', $fproduct->product_id)->avg('rating');
                                @endphp
                                @if ($fproduct)
                                <div class="col-xl-2 my-2 col-lg-4 col-md-6 col-12">
                                        <div class="product-box-2 bg-white d-flex h-100 position-relative">
                                            @if ($fproduct->current_stock <= 0)
                                                <div class="position-absolute h-100 w-100 d-flex align-items-start justify-content-center" style='z-index: 2; background: rgba(255,255,255,.5)'>
                                                    <div class='text-uppercase py-1 px-3 text-white' style='font-size: 1rem; border-radius: 5px; background: #dc3545; transform: rotate(0deg); margin-top: 72px;'>Sold out</div>
                                                </div>
                                            @endif
                                            <a class='position-absolute h-100 w-100' style='z-index: 3' href="{{ $fproduct->type == 'HospitalGiveBack' ? route('product', [urlencode($fproduct->handle), 'hub' => '6']): route('product', urlencode($fproduct->handle)) }}" ></a>
                                            <div class="col-6 p-0 border-right overflow-hidden">
                                                <!-- <img src="https://images.pexels.com/photos/60597/dahlia-red-blossom-bloom-60597.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="{{$fproduct->title}}" height='100%' width='100%' /> -->
                                                <img src="{{isset($fproduct->featured_img) ? asset($fproduct->featured_img) : ''}}" alt="{{$fproduct->title}}" height='100%' width='100%' />
                                            </div>
                                            <div class="p-2 my-auto col-6">
                                                <h2 class="product-title p-0 text-truncate">
                                                    {{$fproduct->title}}
                                                </h2>
                                                <div class="star-rating mb-1">
                                                    {{ renderStarRating($avg_star_flash) }}
                                                    <br/>
                                                    <span class="rating-count text-muted">({{ $flash_review }} {{__('reviews')}})</span>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="price-box flex-grow-1">
                                                        <div class="price-box">
                                                            <span><del class="old-product-price strong-400 text-md">{{ $fproduct->base_price >   $fproduct->unit_price ? format_price($fproduct->base_price) : " " }}</del></span><br/>
                                                            <span class="product-price strong-600">{{ format_price($fproduct->unit_price) }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="add-to-cart btn url_product" title="Quick view" >
                                                        <i class="la la-shopping-cart cartenings"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                        @endforeach
                        <!-- end product loop -->
                        </div>
                    </div>

                </div>


            </div>
        </section>
    @else

    @endif


    @php

        $campaign_products = [];

        if($c_campaign!=null){
            $campaign_products = \App\ViewProductCampaigns::where('campaign_schedule_id', $c_campaign->campaign_schedule_id)->where('hub_id',$hub_id)
            ->whereIn('product_id', function($q) use ($hub_id){
             $q->from('view_products')
            ->select('product_id')
            ->where('hub_id', '=', $hub_id);
            })
            ->where('type','<>','addon')
            ->where('published',1)->whereNotIn('product_id',$shown_products)->orderBy('prioritization', 'asc')->groupBy('product_id')->limit($c_campaign->page_size)->get();
        }
    @endphp
    @if(count($campaign_products))
     <section class="mb-4">
            <div class="container">
                <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
                    <div class="section-title-1 clearfix">
                        <h3 class="heading-5 strong-700 mb-0 float-left">
                            <span class="mr-4">{{ $c_campaign->title }}</span>
                        </h3>
                        <!-- LINK TO CATEGORY -->
                            <a href="{{ route('products.campaign', urlencode($c_campaign->title)) }}" class='float-right'> {{ __('Show more') }} ></a>
                        <!-- END LINK TO CATEGORY -->
                    </div>

                    <div class="tab-pane">
                        <div class="row gutters-5 sm-no-gutters">
                            <!-- start product loop -->
                            @foreach ($campaign_products as $key => $campaignProduct)
                                @php

                                      if(env('SHOW_PRODUCT_DUPLICATE',0)) {
                                        array_push($shown_products,$campaignProduct->product_id);
                                       }
                                @endphp
                                <div class="col-xl-2 my-2 col-lg-3 col-md-4 col-6">
                                    <div class="product-box-2 h-100 bg-white position-relative" id='product-card'>
                                        @if ($campaignProduct->current_stock <= 0)
                                            <div class="position-absolute h-100 w-100 d-flex align-items-start justify-content-center" style='z-index: 2; background: rgba(255,255,255,.5)'>
                                                <div class='text-uppercase py-1 px-3 text-white' style='font-size: 1rem; border-radius: 5px; background: #dc3545; transform: rotate(0deg); margin-top: 72px;'>Sold out</div>
                                            </div>
                                        @endif
                                        <a class='position-absolute h-100 w-100' style='z-index: 3' href="{{ $campaignProduct->type == 'HospitalGiveBack' ? route('product', [urlencode($campaignProduct->handle), 'hub' => '6']) : route('product', urlencode($campaignProduct->handle)) }}"></a>
                                        <!-- <img src="https://images.pexels.com/photos/60597/dahlia-red-blossom-bloom-60597.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" style="width: 100%"> -->
                                        <div id='product-image' data-src="{{isset($campaignProduct->featured_img) ? asset($campaignProduct->featured_img) : ''}}"></div>
                                        <div class="p-3 border-top">
                                            <h2 class="product-title p-0 text-truncate">
                                                {{$campaignProduct->title}}
                                            </h2>
                                            @php
                                                $rev = getReview($campaignProduct->product_id);

                                                  if($rev){
                                                      $review = $rev->total_reviews;
                                                      $avg_star = $rev->avg_reviews;
                                                  }else{
                                                      $review = 0;
                                                      $avg_star = 0;
                
                                                  }
                                              //$review = App\Review::where('product_id', $campaignProduct->product_id)->get();
                                              //$avg_star = App\Review::where('product_id', $campaignProduct->product_id)->avg('rating');
                                            @endphp
                                            <div class="star-rating mb-1">
                                                {{ renderStarRating($avg_star)}}
                                                <span class='d-inline d-lg-none rating-count text-muted'>({{ $review }})</span>
                                                <div class="d-none d-lg-block rating-count text-muted">({{ $review }} {{__('reviews')}})</div>
                                            </div>
        
                                            <div class="clearfix">
                                                <div class="price-box float-left">
                                                    <span class="product-price strong-600 d-lg-none d-inline pr-2">{{ format_price($campaignProduct->unit_price) }}</span>
                                                    <span><del class="old-product-price strong-400 text-md">{{ $campaignProduct->base_price > $campaignProduct->unit_price ? format_price($campaignProduct->base_price) : " " }}</del></span>
                                                    <div class="d-none d-lg-block product-price strong-600">{{ format_price($campaignProduct->unit_price) }}</div>
                                                </div>
                                                <div class='float-right d-none d-lg-block'>
                                                    <div class="add-to-cart btn url_product" title="Quick view">
                                                        <i class="la la-shopping-cart cartenings"></i>
                                                    </div>
                                                </div>
                                            </div>
                                             {{-- <div class='mt-2'>
                                                @if(checkInCamp($campaignProduct->product_id))
                                                <span class="text-muted">{{__("Mother's Day Price")}}: </span><br/>
                                                <span class='strong text-lg'>{{format_price(checkInCamp($campaignProduct->product_id))}}</span>
                                                @else
                                                <span class='strong text-sm'>{{__("Not available for Mother's Day")}}</span>
                                                @endif
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- end product loop -->
                        </div>
                    </div>

                </div>
            </div>

        </section>
    @endif
    @php
        $a_collection = \App\HomeCollection::where('status', '=', 1)->orderBy('status', 'DESC')->orderBy('priority', 'ASC')->with('collection')->get();
         
        $hub = Session::get('hub_id');
    @endphp

    @foreach ($a_collection as $key => $Collection)
        @php
           
            $c_products =[];
            $c_products = \App\ViewProductCollections::where('hub_id', $hub_id)
            ->whereIn('product_id', function($q) use ($hub_id){
             $q->from('view_products')
            ->select('product_id')
            ->where('hub_id', '=', $hub_id);
            })
            ->where('published',1)->where('collection_id', $Collection->collection->id)->whereNotIn('product_id',$shown_products)->orderBy('prioritization','asc')->groupBy('product_id')->limit($Collection->page_size)->get();
        // }

        @endphp
        @if(count($c_products))
        {{-- {{dd(, 1, $hub,$Collection->collection->hubs->pluck('hub_id')->toArray())}} --}}
        @if (in_array($hub, $Collection->collection->hubs->pluck('hub_id')->toArray()))
        <section class="mb-4">
            <div class="container">
                <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
                    <div class="section-title-1 clearfix">
                        <h3 class="heading-5 strong-700 mb-0 float-left">
                            <span class="mr-4">{{ $Collection->collection->title }}</span>
                        </h3>

                        <!-- LINK TO CATEGORY -->
                        <a href="{{ route('products.collection', urlencode($Collection->collection->title)) }}" class='float-right'> {{ __('Show more') }} ></a>
                        <!-- END LINK TO CATEGORY -->

                    </div>

                                <div class="tab-pane">
                                    <div class="row gutters-5 sm-no-gutters">
                                        @foreach ($c_products as $key => $collectionproduct)

                                            @php
                                                if(env('SHOW_PRODUCT_DUPLICATE',0)) {
                                                   array_push($shown_products,$collectionproduct->product_id);
                                                  }
                                            @endphp
                                            <div class="col-xl-2 my-2 col-lg-3 col-md-4 col-6">
                                                <div class="product-box-2 h-100 bg-white position-relative" id='product-card'>
                                                    @if ($collectionproduct->current_stock <= 0)
                                                        <div class="position-absolute h-100 w-100 d-flex align-items-start justify-content-center" style='z-index: 2; background: rgba(255,255,255,.5)'>
                                                            <div class='text-uppercase py-1 px-3 text-white' style='font-size: 1rem; border-radius: 5px; background: #dc3545; transform: rotate(0deg); margin-top: 72px;'>Sold out</div>
                                                        </div>
                                                    @endif
                                                    <a class='position-absolute h-100 w-100' style='z-index: 3' href="{{ $collectionproduct->type == 'HospitalGiveBack' ? route('product', [urlencode($collectionproduct->handle), 'hub' => '6']) : route('product', urlencode($collectionproduct->handle)) }}"></a>
                                                    <div id='product-image' class='position-relative' data-src="{{isset($collectionproduct->featured_img) ? asset($collectionproduct->featured_img) : ''}}">
                                                        <!-- <div class='h-100 w-100 position-absolute d-flex align-items-center justify-content-center' style='z-index; 2;  color: #909090; background: #f1f1f1'><strong>LOADING..</strong></div> -->
                                                    </div>
                                                    <div class="p-3 border-top">
                                                        <h2 class="product-title p-0 text-truncate">
                                                            {{ __($collectionproduct->title) }}
                                                        </h2>
                                                        @php
                                                        //    $reviews = App\Review::where('product_id', $collectionproduct->product_id)->get();
                                                        //    $avg_star_collection = App\Review::where('product_id', $collectionproduct->product_id)->avg('rating');
                                                            
                                                        $rev = getReview($collectionproduct->product_id);
                                                      if($rev){
                                                          $c_review = $rev->total_reviews;
                                                          $avg_star_collection = $rev->avg_reviews;
                                                      }else{
                                                          $c_review = 0;
                                                          $avg_star_collection = 0;
                    
                                                      }
                                                        @endphp
                                                        <div class="star-rating mb-1">
                                                            {{ renderStarRating($avg_star_collection)}}
                                                            <span class='d-inline d-lg-none rating-count text-muted'>({{ $c_review }})</span>
                                                            <div class="d-none d-lg-block rating-count text-muted">({{ $c_review }} {{__('reviews')}})</div>
                                                        </div>
                                                        <div class="clearfix">
                                                            <div class="price-box float-left">
                                                                <span class="product-price strong-600 d-lg-none d-inline pr-2">{{ format_price($collectionproduct->unit_price) }}</span>
                                                                <span><del class="old-product-price strong-400 text-md">{{ $collectionproduct->base_price > $collectionproduct->unit_price ? format_price($collectionproduct->base_price) : " " }}</del></span>
                                                                <div class="d-none d-lg-block product-price strong-600">{{ format_price($collectionproduct->unit_price) }}</div>
                                                            </div>
                                                            <div class='float-right d-none d-lg-block'>
                                                                <div class="add-to-cart btn url_product" title="Quick view">
                                                                    <i class="la la-shopping-cart cartenings"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                         {{-- <div class='mt-2'>
                                                            @if(checkInCamp($collectionproduct->product_id))
                                                            <span class="text-muted">{{__("Mother's Day Price")}}: </span><br/>
                                                            <span class='strong text-lg'>{{format_price(checkInCamp($collectionproduct->product_id))}}</span>
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
        @endif
        @endif
    @endforeach
    @php
        $h_category = \App\HomeCategory::where('status', 1)->orderBy('status', 'DESC')->orderBy('priority', 'ASC')->get()
    @endphp

    @foreach ($h_category as $key => $homeCategory)
        @php
            $hc_products = [];
            $hc_products = \App\ViewProduct::where('category_id', $homeCategory->category->id)->where('published',1)->where('hub_id',$hub_id)->whereNotIn('product_id',$shown_products)->groupBy('product_id')->limit($homeCategory->page_size)->get();
        @endphp
        @if(count($hc_products))
        <section class="mb-4">
            <div class="container">
                <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
                    <div class="section-title-1 clearfix">
                        <h3 class="heading-5 strong-700 mb-0 float-left">
                            <span class="mr-4">{{ $homeCategory->category->name }}</span>
                        </h3>
                        <!-- LINK TO CATEGORY -->
                        <a href="{{ route('products.category', urlencode($category->slug)) }}" class='float-right'> {{ __('Show more')}} ></a>
                        <!-- END LINK TO CATEGORY -->
                    </div>

                    <div class="tab-pane">
                        <div class="row gutters-5 sm-no-gutters">
                            <!-- start product loop -->
                            @foreach ($hc_products as $key => $catProduct)
                                @php

                                    if(env('SHOW_PRODUCT_DUPLICATE',0)) {
                                      array_push($shown_products,$catProduct->product_id);
                                     }
                                
                                      $rev = getReview($catProduct->product_id);
                                                      if($rev){
                                                          $hc_review = $rev->total_reviews;
                                                          $avg_rating_hc = $rev->avg_reviews;
                                                      }else{
                                                          $c_review = 0;
                                                          $avg_rating = 0;
                    
                                                      }
                                
                                @endphp
                                <div class="col-xl-2 my-2 col-lg-3 col-md-4 col-6">
                                    <div class="product-box-2 h-100 bg-white position-relative" id='product-card'>
                                        @if ($catProduct->current_stock <= 0)
                                            <div class="position-absolute h-100 w-100 d-flex align-items-start justify-content-center" style='z-index: 2; background: rgba(255,255,255,.5)'>
                                                <div class='text-uppercase py-1 px-3 text-white' style='font-size: 1rem; border-radius: 5px; background: #dc3545; transform: rotate(0deg); margin-top: 72px;'>Sold out</div>
                                            </div>
                                        @endif
                                        <a class='position-absolute h-100 w-100' style='z-index: 3' href="{{ $catProduct->type == 'HospitalGiveBack' ? route('product', [urlencode($catProduct->handle), 'hub' => '6']) : route('product', urlencode($catProduct->handle)) }}"></a>
                                            <!-- <img src="https://images.pexels.com/photos/60597/dahlia-red-blossom-bloom-60597.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" style="width: 100%"> -->
                                            <div id='product-image'  data-src="{{isset($catProduct->featured_img) ? asset($catProduct->featured_img) : ''}}"
                                            ></div>
                                        <div class="p-3 border-top">
                                            <h2 class="product-title p-0 text-truncate">
                                               {{$catProduct->title}}
                                            </h2>
                                            <div class="star-rating mb-1">
                                                {{ renderStarRating($avg_rating_hc) }}
                                                <span class='d-inline d-lg-none rating-count text-muted'>({{ $hc_review }})</span>
                                                <div class="d-none d-lg-block rating-count text-muted">({{ $hc_review }} {{__('reviews')}})</div>
                                            </div>
                                            <div class="clearfix">
                                                <div class="price-box float-left">
                                                    <span class="product-price strong-600 d-lg-none d-inline pr-2">{{ format_price($catProduct->unit_price) }}</span>
                                                    <span><del class="old-product-price strong-400 text-md">{{ $catProduct->base_price > $catProduct->unit_price ? format_price($catProduct->base_price) : " " }}</del></span>
                                                    <div class="d-none d-lg-block product-price strong-600">{{ format_price($catProduct->unit_price) }}</div>
                                                </div>
                                                <div class='float-right d-none d-lg-block'>
                                                    <div class="add-to-cart btn url_product" title="Quick view">
                                                        <i class="la la-shopping-cart cartenings"></i>
                                                    </div>
                                                </div>
                                            </div>
                                             {{-- <div class='mt-2'>
                                                @if(checkInCamp($catProduct->product_id))
                                                <span class="text-muted">{{__("Mother's Day Price")}}: </span><br/>
                                                <span class='strong text-lg'>{{format_price(checkInCamp($catProduct->product_id))}}</span>
                                                @else
                                                <span class='strong text-sm'>{{__("Not available for Mother's Day")}}</span>
                                                @endif
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                        <!-- end product loop -->
                        </div>
                    </div>

                </div>
            </div>

        </section>
        @endif
    @endforeach

    @if (getBusinessSettings('vendor_system_activation') == 1)
        @php
            $array = array();
            foreach (\App\Seller::all() as $key => $seller) {
                if($seller->user != null && $seller->user->shop != null){
                    $total_sale = 0;
                    foreach ($seller->user->products as $key => $product) {
                        $total_sale += $product->num_of_sale;
                    }
                    $array[$seller->id] = $total_sale;
                }
            }
            asort($array);
        @endphp
        <section  >
            <div class="container">
                <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
                    <div class="section-title-1 clearfix">
                        <h3 class="heading-5 strong-700 mb-0 float-left">
                            <span class="mr-4">{{__('Best Sellers')}}</span>
                        </h3>
                        <ul class="inline-links float-right">
                            <li><a  class="active">{{__('Top 20')}}</a></li>
                        </ul>
                    </div>
                    <div class="carousel-box">
                            @php
                                $count = 0;
                            @endphp
                            @foreach ($array as $key => $value)
                                @if ($count < 20)
                                    @php
                                        $count ++;
                                        $seller = \App\Seller::find($key);
                                        $total = 0;
                                        $rating = 0;
                                        foreach ($seller->user->products as $key => $seller_product) {
                                            $total += $seller_product->reviews->count();
                                            $rating += $seller_product->reviews->sum('rating');
                                        }
                                    @endphp
                                    <div class="p-2">
                                        <div class="row no-gutters box-3 align-items-center border">
                                            <div class="col-4">
                                                <a href="{{ route('shop.visit', $seller->user->shop->slug) }}" class="d-block product-image p-3">
                                                    <img src="{{ asset($seller->user->shop->logo) }}" alt="" class="img-fluid">
                                                </a>
                                            </div>
                                            <div class="col-8 border-left">
                                                <div class="p-3">
                                                    <h2 class="product-title mb-0 p-0 text-truncate">
                                                        <a href="{{ route('shop.visit', $seller->user->shop->slug) }}">{{ __($seller->user->shop->name) }}</a>
                                                    </h2>
                                                    <div class="star-rating star-rating-sm mb-2">
                                                        @if ($total > 0)
                                                            {{ renderStarRating($rating/$total) }}
                                                        @else
                                                            {{ renderStarRating(0) }}
                                                        @endif
                                                    </div>
                                                    <div class="">
                                                        <a href="{{ route('shop.visit', $seller->user->shop->slug) }}" class="icon-anim">
                                                            {{ __('Visit Store') }} <i class="la la-angle-right text-sm"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section style='background: rgba(255,255,255,.6)' @if($hub_id ==6) class='d-none' @endif>
        <div class='container py-3'>
            <h3>Lorem ipsum dolor sit amet</h3>
            <p style="line-height: 28px;">Sed quis ex commodo, sagittis lorem sit amet, lobortis nisi. Duis vehicula consequat volutpat. Donec semper quam sit amet luctus eleifend. Nam sit amet neque urna. Vivamus ex mauris, convallis quis eros vitae,</p>
            <p style="line-height: 28px;">Curabitur vulputate pretium libero quis viverra. Ut sed nulla diam. Nam mattis aliquam porttitor. Nunc interdum diam id tempus eleifend. Suspendisse vulputate auctor eros, ultricies finibus nisl ultricies ut. Morbi malesuada nisl sit amet quam varius elementum.</p>
            <p style="line-height: 28px;">In vestibulum eleifend ante, rhoncus porttitor eros fringilla eu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae.</p>
            <p style="line-height: 28px;">Etiam porta quam molestie ante aliquam mattis. Nam in egestas justo:</p>
            <ul style="column-count: 3;">
                <li>Lorem</li>
                <li>Lorem Lorem</li>
                <li>Lorem</li>
                <li>Lorem</li>
                <li>Lorem</li>
                <li>Lorem Lorem</li>
                <li>Lorem</li>
                <li>Lorem</li>
                <li>Lorem</li>
               
                <li>Lorem</li>
                <li>Lorem Lorem</li>
                <li>Lorem</li>
                <li>Lorem</li>
            </ul>
            <p style="line-height: 28px;">Sed quis ex commodo, sagittis lorem sit amet, lobortis nisi. Duis vehicula consequat volutpat. Donec semper quam sit amet luctus eleifend. Nam sit amet neque urna.</p>
            <p style="line-height: 28px;">Aliquam venenatis lacus id erat dapibus ullamcorper.:</p>
            <ul style="column-count: 2;">
                <li>Lorem Lorem</li>
                <li>Lorem Lorem</li>
                <li>Lorem Lorem</li>
                <li>Lorem Lorem Lorem </li>
            </ul>
           
        
        </div>
    </section>

@endsection

@section('script-slider')
<script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script>

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
     });

    function sliderResizer(){
        var sliderWrapWidth = $('#slider-wrap').width()
        var categoriesWidth = $('.categories').width()
        var categoriesHeight = $('.category-sidebar').outerHeight()


        $('.sub-cat-menu').css({"left": `${categoriesWidth}px`, "width": `calc(100% - ${categoriesWidth}px)`})
        if(sliderWrapWidth >= 741){
            @if($hub_id == 6)
            $('#slider-image-container').attr('style', `max-width: ${sliderWrapWidth}px; height: 100%; min-width: ${sliderWrapWidth}px`)
            @else
            $('#slider-image-container').attr('style', `max-width: ${741}px; height: 100%`)
            @endif
        } else {
            $('#slider-image-container').attr('style', `max-width: ${sliderWrapWidth}px; height: 100%`)
        }
        $('.image_slider').each(function(){
            $(this).attr('height', `${categoriesHeight}px`)
        })
    }


        // console.log(flashContainer.height())

        // $('#flash_product_box').attr('style', `max-width: ${categoriesHeight - 123}px`)

        var flashImage = $('#flash-product-image')

        var flashProductBoxWidth = $('#flash_product_box').width();

        console.log(flashProductBoxWidth)
        
        flashImage.css({"width": flashProductBoxWidth +'px', "height": flashProductBoxWidth +'px', "background": flashImage.attr('data-src') });

        $(document).ready(function(){

            
        sliderResizer()
        console.log('slider resizer')

            var sliderContainer = $('.slick-carousel');

            var slidesRtl = false;

            // var slidesPerViewXs = sliderContainer.data('slick-xs-items');
            // var slidesPerViewSm = sliderContainer.data('slick-sm-items');
            // var slidesPerViewMd = sliderContainer.data('slick-md-items');
            // var slidesPerViewLg = sliderContainer.data('slick-lg-items');
            // var slidesPerViewXl = sliderContainer.data('slick-xl-items');
            // var slidesPerView = sliderContainer.data('slick-items');

            var slidesCenterMode = sliderContainer.data('slick-center');
            var slidesArrows = sliderContainer.data('slick-arrows');
            var slidesDots = sliderContainer.data('slick-dots');
            var slidesRows = sliderContainer.data('slick-rows');
            var slidesAutoplay = sliderContainer.data('slick-autoplay');

            // slidesPerViewXs = !slidesPerViewXs ? slidesPerView : slidesPerViewXs;
            // slidesPerViewSm = !slidesPerViewSm ? slidesPerView : slidesPerViewSm;
            // slidesPerViewMd = !slidesPerViewMd ? slidesPerView : slidesPerViewMd;
            // slidesPerViewLg = !slidesPerViewLg ? slidesPerView : slidesPerViewLg;
            // slidesPerViewXl = !slidesPerViewXl ? slidesPerView : slidesPerViewXl;
            
            // slidesPerView = !slidesPerView ? 1 : slidesPerView;
            slidesCenterMode = !slidesCenterMode ? false : slidesCenterMode;
            slidesArrows = !slidesArrows ? true : slidesArrows;
            slidesDots = !slidesDots ? false : slidesDots;
            slidesRows = !slidesRows ? 1 : slidesRows;
            slidesAutoplay = !slidesAutoplay ? false : slidesAutoplay;

            sliderContainer.slick({
                slidesToShow: 1,
                autoplay: slidesAutoplay,
                dots: slidesDots,
                arrows: slidesArrows,
                infinite: true,
                rtl: slidesRtl,
                rows: slidesRows,
                centerPadding: '0px',
                centerMode: slidesCenterMode,
                speed: 300,
                prevArrow: '<button type="button" class="slick-prev"><span class="prev-icon"></span></button>',
                nextArrow: '<button type="button" class="slick-next"><span class="next-icon"></span></button>',
                responsive: [
                    {
                        breakpoint: 1500,
                        settings: {
                            slidesToShow: 1,
                        }
                    },
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 1,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 1,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            dots: true,
                            arrows: false,
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1,
                            dots: true,
                            arrows: false,
                        }
                    }
                ]
            });

        });

        $(window).resize(function(){
            sliderResizer()
        })
    </script>
    <script>

            $('.url_product').click(function(){
        
                let id = $(this).attr('name');
                
                // console.log($(`[url=${id}]`).attr("href"));
        
                window.location.href = $(`[url=${id}]`).attr("href");
            })
        </script>
@endsection