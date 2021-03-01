<section class="slice-xs sct-color-2 border-bottom">
    <div class="container container-sm">
        <div class="row cols-delimited">
            <div class="col-4">
                <div class="icon-block icon-block--style-1-v5 text-center {{Request::is('cart') ? 'active' : 'c-gray-light'}}">
                    <div class="block-icon mb-0">
                        <i class="la la-shopping-cart"></i>
                    </div>
                    <div class="block-content d-none d-md-block">
                        <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">1. {{__('My Cart')}}</h3>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="icon-block icon-block--style-1-v5 text-center {{Request::is('information') ? 'active' : 'c-gray-light'}}">
                    <div class="block-icon mb-0">
                        <i class="la la-user"></i>
                    </div>
                    <div class="block-content d-none d-md-block">
                        <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">2. {{__('Order Details')}}</h3>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="icon-block icon-block--style-1-v5 text-center {{Request::is('checkout/payment_method') ? 'active' : 'c-gray-light'}}">
                    <div class="block-icon mb-0">
                        <i class="la la-credit-card"></i>
                    </div>
                    <div class="block-content d-none d-md-block">
                        <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">3. {{__('Payment')}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
