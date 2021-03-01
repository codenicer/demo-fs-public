@extends('frontend.layouts.app')


    @php
        $with = ['hubs'];
        $meta_title = config('app.name');
        $meta_description = \App\SeoSetting::first()->description;
    @endphp


@section('meta_title'){{ $collection->title }}@stop
@section('meta_description'){{ $collection->title }}@stop


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
                        <li><a href="#">{{__('Collections')}}</a></li>
                        <li><a href="#">{{ $collection->title }}</a></li>
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
                            {{__('Collections')}}
                        </div>
                        <div class="box-content">
                            <div class="category-accordion">
                                @foreach (\App\Collection::where('status',1)->get() as $key => $col)
                                    <div class="single-category">
                                        <a  class='w-100 sub-category-name' href="{{ route('products.collection', urlencode($col->title)) }}">{{ __($col->title) }}</a>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-xl-9">

                    <form class="" name="form2" id="search-form1" action="{{ route('products.collection1', ['title' => $titles]) }}" method="POST">
                    @csrf
                    </form>
                    <form class="" id="search-form" action="{{ route('search') }}" method="GET">
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
                                        <select  form="search-form1" class="form-control sortSelect" data-minimum-results-for-search="Infinity" name="sort_by" onchange="filter()">
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


                                    <span class="">{{ $collection->title }}</span>

                                </h3>

                            </div>
                        </div>
                        <input type="hidden" name="min_price" value="">
                        <input type="hidden" name="max_price" value="">
                    </form>
                    <!-- <hr class=""> -->
                    <div class="products-box-bar p-3 bg-white">
                        <div class="row sm-no-gutters gutters-5" id="load_more_products">
                            @foreach ($products as $key => $fproduct)
                                <div class="my-2 col-lg-3 col-md-4 col-6">
                                    <div class="product-box-2 h-100 bg-white position-relative" id='product-card'>
                                        @if ($fproduct->current_stock <= 0)
                                            <div class="position-absolute h-100 w-100 d-flex align-items-start justify-content-center" style='z-index: 2; background: rgba(255,255,255,.5)'>
                                                <div class='text-uppercase py-1 px-3 text-white' style='font-size: 1rem; border-radius: 5px; background: #dc3545; transform: rotate(0deg); margin-top: 72px;'>Sold out</div>
                                            </div>
                                        @endif
                                        <a class='position-absolute h-100 w-100' style='z-index: 3' href="{{ $fproduct->type == 'HospitalGiveBack' ? route('product', [urlencode($fproduct->handle), 'hub' => '6']) : route('product', urlencode($fproduct->handle)) }}"></a>
                                        <!-- <img src="https://images.pexels.com/photos/60597/dahlia-red-blossom-bloom-60597.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" style="width: 100%"> -->
                                        <div id='product-image' data-src="{{isset($fproduct->featured_img) ? asset($fproduct->featured_img) : ''}}"></div>
                                        <div class="p-3 border-top">
                                            <h2 class="product-title p-0 text-truncate">
                                                <a class="url_product"  name="collection{{$fproduct->product_id}}" tabindex="0">{{$fproduct->title}}</a>
                                            </h2>
                                            <div>

                                            </div>
                                            @php
                                                //$review = App\Review::where('product_id', $product->product_id)->get();
                                                //$avg_star = App\Review::where('product_id', $product->product_id)->avg('rating');

                                                 $rev = getReview($fproduct->product_id);

                                                if($rev){
                                                    $review = $rev->total_reviews;
                                                    $avg_star = $rev->avg_reviews;
                                                }else{
                                                    $review = 0;
                                                    $avg_star = 0;

                                                }

                                            @endphp
                                            <div class="star-rating mb-1">
                                                {{ renderStarRating($avg_star)}}
                                                <span class='d-inline d-lg-none rating-count text-muted'>({{ $review }})</span>
                                                <div class="d-none d-lg-block rating-count text-muted">({{ $review }} {{__('reviews')}})</div>
                                            </div>
                                            <div class="clearfix">
                                                <div class="price-box float-left">
                                                    <span class="product-price strong-600 d-lg-none d-inline pr-2">{{ format_price($fproduct->unit_price) }}</span>
                                                    <span><del class="old-product-price strong-400 text-md">{{ $fproduct->base_price > $fproduct->unit_price ? format_price($fproduct->base_price) : " " }}</del></span>
                                                    <div class="d-none d-lg-block product-price strong-600">{{ format_price($fproduct->unit_price) }}</div>
                                                </div>
                                                <div class='float-right d-none d-lg-block'>
                                                    <div class="add-to-cart btn url_product" title="Quick view">
                                                        <i class="la la-shopping-cart cartenings"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class='mt-2'>
                                                @if(checkInCamp($fproduct->product_id))
                                                    <span class="text-muted">{{__("Mother's Day Price")}}: </span><br/>
                                                    <span class='strong text-lg'>{{format_price(checkInCamp($fproduct->product_id))}}</span>
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
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        function filter(){
            $('#search-form1').submit();
        }
        function rangefilter(arg){
            $('input[name=min_price]').val(arg[0]);
            $('input[name=max_price]').val(arg[1]);
            filter();
        }
    </script>
     <script>

            $('.url_product').click(function(){

                let id = $(this).attr('name');

                // console.log($(`[url=${id}]`).attr("href"));

                window.location.href = $(`[url=${id}]`).attr("href");
            })
        </script>
        <script>

            var skip = 42
            @if(count($products) > 0)
$( "#load_more_button" ).click(function() {
    $('#load_more_button').attr("disabled", true)
    $('#load_more_button').text('Please wait...');
    $.post('{{ route('loadmore') }}', {_token:'{{ csrf_token() }}',collection_id :'{{$products[0]->collection_id}}',skip : skip, type: "collection"}, function(data){

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
    });
});
@endif
        </script>
@endsection
