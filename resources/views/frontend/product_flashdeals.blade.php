@extends('frontend.layouts.app')



    @php
            $with = ['hubs'];
            $meta_title = config('app.name');
            $meta_description = \App\SeoSetting::first()->description;
    @endphp

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

    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                        <li><a href="#">{{__('Flash Deals')}}</a></li>


                    </ul>
                </div>
            </div>
        </div>
    </div>


    <section class="gry-bg py-4">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">

                        
                        <form class="" id="search-form" action="{{ route('flashdeals') }}" method="GET">

                            <div class="sort-by-bar row no-gutters bg-white px-3 pt-2">
                                <div class="col-lg-4 col-md-5">
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
                                <div class="col-md-7 offset-lg-1">
                                    <div class="row no-gutters">
                                        <div class="col-4">
                                            <div class="sort-by-box px-1">
                                                <div class="form-group">
                                                    <label>{{__('Sort by')}}</label>
                                                    <select class="form-control sortSelect" data-minimum-results-for-search="Infinity" name="sort_by" onchange="filter()">
                                                        <option value="1" @isset($sort_by) @if ($sort_by == '1') selected @endif @endisset>{{__('Newest')}}</option>
                                                        <option value="2" @isset($sort_by) @if ($sort_by == '2') selected @endif @endisset>{{__('Oldest')}}</option>
                                                        <option value="3" @isset($sort_by) @if ($sort_by == '3') selected @endif @endisset>{{__('Price low to high')}}</option>
                                                        <option value="4" @isset($sort_by) @if ($sort_by == '4') selected @endif @endisset>{{__('Price high to low')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="min_price" value="">
                            <input type="hidden" name="max_price" value="">
                        </form>
                        <!-- <hr class=""> -->
                    @if($products)
                        <div class="products-box-bar p-3 bg-white">

                            <div class="row sm-no-gutters gutters-5">


                                @foreach ($products as $key => $product)
                                    <div class="col-xxl-3 col-xl-4 col-lg-3 col-md-4 col-6">
                                        <div class="product-box-2 bg-white alt-box my-2">
                                            <div class="position-relative overflow-hidden">
                                                <a href="{{ route('product', urlencode($product->handle))  }}" class="d-block product-image h-100" style="background-image:url('{{ asset($product->thumbnail_img) }}');" tabindex="0">
                                                </a>
                                                <div class="product-btns clearfix">

                                                    <button class="btn quick-view" title="Quick view" onclick="showAddToCartModal({{ $product->product_id }})" tabindex="0">
                                                        <i class="la la-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="p-3 border-top">
                                                <h2 class="product-title p-0 text-truncate">
                                                    <a href="{{ route('product', urlencode($product->handle)) }}" tabindex="0">{{ __($product->title) }}</a>
                                                </h2>
                                                <div class="star-rating mb-1">
                                                    {{ renderStarRating($product->rating) }}
                                                </div>
                                                <div class="clearfix">
                                                    <div class="price-box float-left">
                                                        @if($product->base_price > $product->unit_price)
                                                            <del class="old-product-price strong-400">{{ format_price($product->base_price) }}</del>
                                                        @endif
                                                        <span class="product-price strong-600">{{ format_price($product->unit_price) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>
                        <div class="products-pagination bg-white p-3">
                            <nav aria-label="Center aligned pagination">
                                <ul class="pagination justify-content-center">
                                    {{ $products->links() }}
                                </ul>
                            </nav>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
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
@endsection
