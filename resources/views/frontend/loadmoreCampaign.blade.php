@foreach ($products as $key => $product)
                                    <div class="col-xl-2 my-2 col-lg-3 col-md-4 col-6">
                                        <div class="product-box-2 h-100 bg-white my-2" id='product-card'>
                                            @if ($product->current_stock <= 0)
                                                <div class="position-absolute h-100 w-100 d-flex align-items-start justify-content-center" style='z-index: 2; background: rgba(255,255,255,.5)'>
                                                    <div class='text-uppercase py-1 px-3 text-white' style='font-size: 1rem; border-radius: 5px; background: #dc3545; transform: rotate(0deg); margin-top: 72px;'>Sold out</div>
                                                </div>
                                            @endif
                                            <a class='position-absolute h-100 w-100' style='z-index: 3' href="{{ route('product', urlencode($product->handle)) }}"></a>
                                            <!-- <img src="https://images.pexels.com/photos/60597/dahlia-red-blossom-bloom-60597.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" style="width: 100%"> -->
                                            <img src="{{isset($product->featured_img) ? asset($product->featured_img) : ''}}" height='auto' width='100%' />
                                            <div class="p-3 border-top">
                                                <h2 class="product-title p-0 text-truncate">
                                                    <a class="url_product" name="product{{$key}}" tabindex="0">{{$product->title}}</a>
                                                </h2>
                                                <div>

                                                </div>
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
                                                <div class="star-rating mb-1">
                                                    {{ renderStarRating($avg_star) }}
                                                    <span class="rating-count text-muted">({{ $review }} {{__('reviews')}})</span>

                                                </div>
                                                <div class="clearfix">
                                                    <div class="star-rating mb-1">
                                                        {{ renderStarRating($avg_star_collection)}}
                                                        <span class='d-inline d-lg-none rating-count text-muted'>({{ $c_review }})</span>
                                                        <div class="d-none d-lg-block rating-count text-muted">({{ $c_review }} {{__('reviews')}})</div>
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
                                                </div>
                                                {{-- <div class='mt-2'>
                                                    @if(checkInCamp($fproduct->product_id))
                                                    <span class="text-muted">{{__("Mother's Day Price")}}: </span><br/>
                                                    <span class='strong text-lg'>{{format_price(checkInCamp($fproduct->product_id))}}</span>
                                                    @else
                                                    <span class='strong text-sm'>{{__("Not Available for Mother's Day")}}</span>
                                                    @endif
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
