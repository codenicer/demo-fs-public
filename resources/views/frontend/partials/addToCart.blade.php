@php
 $product_list[] = $product->product_id;
 $total_price = $product->unit_price;;
@endphp
<div class="modal-body p-4">
    <div class="row no-gutters cols-xs-space cols-sm-space cols-md-space">
        <div class="col-lg-6">
            <div class="product-gal d-flex flex-row-reverse">
                
            </div>
        </div>

        <div class="col-lg-6">
            <!-- Product description -->
            <div class="product-description-wrapper">
                <!-- Product title -->
                <h2 class="product-title">
                    {{ __($product->title) }}
                </h2>

                <div class="row no-gutters mt-4">
                    <div class="col-2">
                        <div class="product-description-label">{{__('Price')}}:</div>
                    </div>
                    <div class="col-10">
                        <div class="product-price-old ">
                            <del>
                                {{ format_price($product->base_price,2) }}
                                <span>/{{ $product->unit }}</span>
                            </del>
                        </div>
                    </div>
                </div>
                <div class="row no-gutters mt-3">
                    <div class="col-2">
                        <div class="product-description-label">{{__('Discount Price')}}:</div>
                    </div>
                    <div class="col-10">
                        <div class="product-price product-price strong-600">
                            <strong>
                                {{ format_price($product->unit_price,2) }}
                            </strong>
                        </div>
                    </div>
                </div>

                <hr>

                <form id="option-choice-form">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->product_id }}">

                    <!-- Quantity + Add to cart -->
                    <div class="row no-gutters">
                        <div class="col-2">
                            <div class="product-description-label mt-2">{{__('Quantity')}}:</div>
                        </div>
                        <div class="col-10">
                            <div class="product-quantity d-flex align-items-center">
                                <div class="input-group input-group--style-2 pr-3" style="width: 160px;">
                                    <span class="input-group-btn">
                                        <button class="btn btn-number" type="button" data-type="minus" data-field="quantity" disabled="disabled">
                                            <i class="la la-minus"></i>
                                        </button>
                                    </span>
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
                    
                    <hr/>
                    
                    <div class="row no-gutters">
                                    <div class="col-2">
                                        <div class="product-description-label">{{__('Add ons')}}:</div>
                                    </div>
                                    <div class="col-10">
                                            <div>
                                                    @forelse ($addons as $addon)
                                                        @php
                                                            $product_list[] = $addon->product_id;
                                                            $total_price += $addon->unit_price;
                                                        @endphp

                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="addon_{{$addon->product_id}}}" value="{{$addon->product_id}}" name="product_addon[{{$product->product_id}}][]">
                                                        <label class="custom-control-label d-flex" for="addon_{{$addon->product_id}}}">
                                                            <img src="https://cdn.shopify.com/s/files/1/2427/2865/products/addon-you-re-my-sunshine-music-box-1_d3f16ca2-8ded-48b5-b9b1-6689ab56ef88_150x150.png?v=1573514308" height='100px' class="mx-2">
                                                            <div>
                                                                <div>{{$addon->title}}</div>
                                                                <div class='strong'>{{ format_price($addon->unit_price,2) }}</div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    @empty
                                                        <p>
                                                            None
                                                        </p>
                                                    @endforelse
                                                </div>
                                    </div>
                                </div>

                    <hr>

                    <div class="row no-gutters pb-3 d-none" id="chosen_price_div">
                        <div class="col-2">
                            <div class="product-description-label">{{__('Total Price')}}:</div>
                        </div>
                        <div class="col-10">
                            <div class="product-price">
                                <strong id="chosen_price">

                                </strong>
                            </div>
                        </div>
                    </div>

                </form>

                <div class="d-table width-100 mt-3">
                    <div class="d-table-cell">
                        <!-- Add to cart button -->
                        <button type="button" class="btn btn-styled btn-alt-base-1 c-white btn-icon-left strong-700 hov-bounce hov-shaddow ml-2" onclick="addToCart()">
                            <i class="la la-shopping-cart"></i>
                            <span class="d-none d-md-inline-block"> {{__('Add to cart')}}</span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    cartQuantityInitialize();
    $('#option-choice-form input').on('change', function(){
        getVariantPrice();
    });
</script>

<!-- Facebook Pixel Code -->
<script>
    var dataLayer  = window.dataLayer || [];
    dataLayer.push({
        'event': 'AddToCart',
            'products': [
                {
                    'name':"@php echo $product->title; @endphp",
                    'id': '{{$product->product_id? $product->product_id : ''}}',
                    'price': '{{$product->unit_price}}',
                    'quantity': '{{$product->quantity}}',
                    'brand': 'Demo Ecommerce',
                }
            ]

    });

</script>
<!-- End Facebook Pixel Code -->
