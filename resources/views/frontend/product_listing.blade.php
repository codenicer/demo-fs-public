@extends('frontend.layouts.app')
@php
    $product_list = [];;
    $catlabel = '';
    $dataLayer = $products;
    $subCat='';
    $rname = '';
    $mCat = null;
    $mSCat = null;
    $meta_description = '';
@endphp

{{-- {{ dd(count($products)) }} --}}

@if(isset($subcategory_id))
    @php
        $with = ['hubs','subcategories'];
        $meta_title = \App\SubCategory::find($subcategory_id)->name;
        $mSCat = \App\SubCategory::find($subcategory_id);
        if($mSCat){
            $subCat = $mSCat->name;
            $meta_description = $mSCat->meta_description;
        }

        $meta_title .= " – ".config('app.name');


        if(isset($category_id)){

             $mCat = \App\Category::find($category_id);
             if($mCat){
                $catlabel = $mCat->name;
             }

        }
    @endphp
@elseif (isset($category_id))
    @php
            $with = ['hubs','categories'];
             $mCat = \App\Category::find($category_id);
             if($mCat){
                $meta_title = $mCat->name;
                $meta_title .= " – ".config('app.name');
                $meta_description = $mCat->meta_description;
             }


    @endphp
@else
    @php
            $with = ['hubs'];
            $meta_title = config('app.name');
            $meta_description = \App\SeoSetting::first()->description;
    @endphp
@endif


@section('meta_title'){{ $meta_title }}@stop
@section('meta_description'){{ $meta_description }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $meta_title }}">
    <meta itemprop="description" content="{{ $meta_description }}">

    <!-- Twitter Card data -->
    <meta name="twitter:title" content="{{ $meta_title }}">
    <meta name="twitter:description" content="{{ $meta_description }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $meta_title }}" />
    <meta property="og:description" content="{{ $meta_description }}" />
@endsection

@section('content')

<style>
        .url_product{
            cursor: pointer;
        }.cartenings{
            color:rgba(0, 0, 0, 0.986);;
        }.cartenings:hover{
            color:white;
            transition: 0.03s;

        }
        </style>

    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <section class="gry-bg py-4">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 d-none d-xl-block">

                    <div class="bg-white sidebar-box mb-3">
                        <div class="box-title text-center">
                            {{__('Categories')}}
                        </div>
                        <div class="box-content">
                            <div class="category-accordion">
                                @foreach (\App\Category::all() as $key => $category)
                                    <div class="single-category">
                                        <button class="btn w-100 category-name {{Session::get('category_id') == $category->id ? '':'collapsed' }}" type="button" data-toggle="collapse" data-target="#category-{{ $key }}" aria-expanded="{{Session::get('category_id') == $category->id ? 'true':'false' }}">
                                            {{ __($category->name) }}

                                        </button>

                                        <div id="category-{{ $key }}" class="{{Session::get('category_id') == $category->id ? 'collapse show':'collapse' }}">
                                            @foreach ($category->subcategories as $key2 => $subcategory)
                                                <div class="single-sub-category py-1">
                                                    <a  class='w-100 sub-category-name' href="{{ route('products.subcategory', urlencode($subcategory->slug)) }}">{{ __($subcategory->name) }}</a>

                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="bg-white sidebar-box mb-3">
                        <div class="box-title text-center">
                            {{__('Price range')}}
                        </div>
                        <div class="box-content">
                            <div class="range-slider-wrapper mt-3">
                                <!-- Range slider container -->
                                <div id="input-slider-range" data-range-value-min="{{ $products->min('unit_price') }}" data-range-value-max="{{ $products->max('unit_price') }}"></div>

                                <!-- Range slider values -->
                                <div class="row">
                                    <div class="col-6">
                                        <span class="range-slider-value value-low"
                                            @if (isset($min_price))
                                                data-range-value-low="{{ $min_price }}"
                                            @elseif($products->min('unit_price') > 0)
                                                data-range-value-low="{{ $products->min('unit_price') }}"
                                            @else
                                                data-range-value-low="0"
                                            @endif
                                              id="input-slider-range-value-low"></span>
                                    </div>
                                    <div class="col-6 text-right">
                                        <span class="range-slider-value value-high"
                                            @if (isset($max_price))
                                                data-range-value-high="{{ $max_price }}"
                                            @elseif($products->max('unit_price') > 0)
                                                data-range-value-high="{{ $products->max('unit_price') }}"
                                            @else
                                                data-range-value-high="0"
                                            @endif
                                            id="input-slider-range-value-high"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <form class='d-flex justify-content-end' action="">
                            <input type="hidden" name='min_price' value='0'>
                            <button class='btn-xs text-sm btn-base-1 m-2 text-uppercase'>{{__('Clear')}}</button>
                        </form> -->
                    </div>
                </div>
                <div class="col-xl-9">

                        <form class="" id="search-form" action="{{ route('search') }}" method="GET">
                            @isset($category_id)
                                <input type="hidden" name="category" value="{{ \App\Category::find($category_id)->name }}">
                            @endisset
                            @isset($subcategory_id)
                                <input type="hidden" name="subcategory" value="{{ \App\SubCategory::find($subcategory_id)->name }}">
                            @endisset

                            <div class="sort-by-bar row no-gutters bg-white px-3 pt-2">
                                <div class="col-12 col-lg-6 col-md-6 px-1">
                                    <div class="sort-by-box">
                                        <div class="form-group">
                                            <label>{{__('Search')}}</label>
                                            <div class="search-widget">
                                                <input class="form-control input-lg" type="text" name="q" placeholder="{{__('Search products')}}" @isset($query) value="{{ $query }}" @endisset>
                                                <button type="submit" class="btn-inner">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-md-6 px-1">
                                    <div class="sort-by-box px-1">
                                        <div class="form-group">
                                            <label>{{__('Sort by')}}</label>
                                            <select class="form-control sortSelect" data-minimum-results-for-search="Infinity" name="sort_by" onchange="filter()">
                                                <option disabled selected value> Select option </option>
                                                <option value="1" @isset($sort_by) @if ($sort_by == '1') selected @endif @endisset>{{__('Newest')}}</option>
                                                <option value="2" @isset($sort_by) @if ($sort_by == '2') selected @endif @endisset>{{__('Oldest')}}</option>
                                                <option value="3" @isset($sort_by) @if ($sort_by == '3') selected @endif @endisset>{{__('Price low to high')}}</option>
                                                <option value="4" @isset($sort_by) @if ($sort_by == '4') selected @endif @endisset>{{__('Price high to low')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 section-title-1 clearfix" style="margin-bottom: -20px;">
                                    <h3 class="heading-5 strong-700 mb-0 float-left">

                                        {{-- <span class="">{{ $subCat->name }}</span> --}}

                                    </h3>

                                </div>


                            </div>
                            <input type="hidden" name="min_price" value="">
                            <input type="hidden" name="max_price" value="">
                        </form>
                        <!-- <hr class=""> -->
                        <div class="products-box-bar p-3 bg-white">
                            <div class="row sm-no-gutters gutters-5" id="load_more_products">

                                @foreach ($products as $key => $product)
                                    @php
                                        $product_list[]=$product->product_id;
                                    @endphp

                                    @php
                                    //$review = App\Review::where('product_id', $product->product_id)->get();
                                    //$avg_star = App\Review::where('product_id', $product->product_id)->avg('rating');

                                     $rev = getReview($product->product_id);

                                    if($rev){
                                        $review = $rev->total_reviews;
                                        $avg_star = $rev->avg_reviews;
                                    }else{
                                        $review = 0;
                                        $avg_star = 0;

                                    }

                                    @endphp

                                    <div class="my-2 col-lg-3 col-md-4 col-6">
                                        <div class="product-box-2 h-100 bg-white position-relative" id='product-card'>
                                            @if ($product->current_stock <= 0)
                                                <div class="position-absolute h-100 w-100 d-flex align-items-start justify-content-center" style='z-index: 2; background: rgba(255,255,255,.5)'>
                                                    <div class='text-uppercase py-1 px-3 text-white' style='font-size: 1rem; border-radius: 5px; background: #dc3545; transform: rotate(0deg); margin-top: 72px;'>Sold out</div>
                                                </div>
                                            @endif
                                            <a class='position-absolute h-100 w-100' style='z-index: 3' href="{{ $product->type == 'HospitalGiveBack' ? route('product', [urlencode($product->handle), 'hub' => '6']) : route('product', urlencode($product->handle)) }}"></a>
                                            <!-- <img src="https://images.pexels.com/photos/60597/dahlia-red-blossom-bloom-60597.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" style="width: 100%"> -->
                                            <div id='product-image' data-src="{{isset($product->featured_img) ? asset($product->featured_img) : ''}}"></div>
                                            <div class="p-3 border-top">
                                                <h2 class="product-title p-0 text-truncate">{{ __($product->title) }}
                                                </h2>
                                                <div class="star-rating mb-1">
                                                    {{ renderStarRating($avg_star)}}
                                                    <span class='d-inline d-lg-none rating-count text-muted'>({{ $review }})</span>
                                                    <div class="d-none d-lg-block rating-count text-muted">({{ $review }} {{__('reviews')}})</div>
                                                </div>
                                                <div class="clearfix">
                                                    <div class="price-box float-left">
                                                            <span class="product-price strong-600 d-lg-none d-inline pr-2">{{ format_price($product->unit_price) }}</span>
                                                            <span><del class="old-product-price strong-400 text-md">{{ $product->base_price > $product->unit_price ? format_price($product->base_price) : " " }}</del></span>
                                                            <div class="d-none d-lg-block product-price strong-600">{{ format_price($product->unit_price) }}</div>
                                                        </div>
                                                        <div class='float-right d-none d-lg-block'>
                                                            <div class="add-to-cart btn url_product" title="Quick view">
                                                                <i class="la la-shopping-cart cartenings"></i>
                                                            </div>
                                                        </div>
                                                </div>
                                                 {{-- <div class='mt-2'>
                                                    @if(checkInCamp($product->product_id))
                                                    <span class="text-muted">{{__("Mother's Day Price")}}: </span><br/>
                                                    <span class='strong text-lg'>{{format_price(checkInCamp($product->product_id))}}</span>
                                                    @else
                                                    <span class='strong text-sm'>{{__("Not available for Mother's Day")}}</span>
                                                    @endif
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="d-flex ">
                                @if(count($products) == 42)
                                  <button class="m-auto btn" style="cursor: pointer; color:orange" id="load_more_button">show more products</button>
                                @endif
                                </div>
                        </div>
                        <div class="products-pagination bg-white p-3">
                            <nav aria-label="Center aligned pagination">
                                <ul class="pagination justify-content-center">
                                    {{-- {{ $products->links() }} --}}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script src="{{ asset('frontend/js/nouislider.min.js') }}"></script>
    <script type="text/javascript">
        function filter(){
            $('#search-form').submit();
        }
        function rangefilter(arg){
            $('input[name=min_price]').val(arg[0]);
            $('input[name=max_price]').val(arg[1]);
            filter();
        }
    </script>

    <!-- Facebook Pixel Code -->
    @if(!$dataLayer)
    <script>
        var dataLayer  = window.dataLayer || [];
        dataLayer.push({
            'event': 'ProductListing',

                'products': [
                    @foreach($dataLayer as $key => $product)
                        @php

                            $vp = \App\ViewProduct::where('product_id', $product->product_id)->where('hub_id', $product->hub_id)
                             ->first();

                            if($vp){

                                $category = $vp->category_name;
                            }else{
                                $category = null;
                            }
                        @endphp
                    {
                        'name':' @php echo $product->title; @endphp ',
                        'id': '{{$product->product_id ? $product->product_id : ''}}',
                        'price': '{{$product->unit_price}}',
                        'brand': 'Demo Ecommerce',
                        'category': '@php echo $category; @endphp'
                    },
                    @endforeach
                ]
        });

    </script>
    @endif
    <script>

            $('.url_product').click(function(){

                let id = $(this).attr('name');

                console.log($(`[url]`).attr("href"));

                window.location.href = $(`[url=${id}]`).attr("href");


            })
        </script>
        <script>

            var skip = 42
            @if(count($products) > 0)
$( "#load_more_button" ).click(function() {
    $('#load_more_button').attr("disabled", true)
    $('#load_more_button').text('Please wait...');


    $.post('{{ route('loadmore') }}', 
    
    {_token:'{{ csrf_token() }}',

        @if($category_id)
            cat_id :'{{ $category_id }}',
        @endif

        @if($subcategory_id)
            sub_cat_id : '{{$subcategory_id}}',
        @endif

        skip : skip, type: "listing"}, function(data){

        if(data == 0){
            $('#load_more_button').text('no products available');

        }else{
            skip += 21
            $('#load_more_products').append(data);
            
            
        $('#load_more_button').text('show more products');
        $('#load_more_button').attr("disabled", false)
        }
    }).always(function(){
        console.log($('#load-more-wrap'));
        $('#load-more-wrap').ready(function(){
            imageResponsiveness();
            titleHeightHandler();
        })
    })
});
@endif
        </script>
    <!-- End Facebook Pixel Code -->


@endsection
