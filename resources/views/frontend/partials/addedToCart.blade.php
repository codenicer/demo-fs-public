
<style>
    @media only screen and (max-width: 470px) {
        .shopping {
            width:192px;
        }
    }

    .shopping{
        height: 43px;

    }


</style>


<div class="modal-body p-4 added-to-cart">
    <div class="text-center text-success">
        <i class="fa fa-check"></i>
        <h3>{{__('Item(s) added to your cart!')}}</h3>
    </div>

    <div class="product-box">

        @foreach($addedToCart as $key => $value)
        <div class="block">
            <div class="block-image">
                <img src="{{ isset($value['thumbnail_img']) ? asset($value['thumbnail_img']) :'' }}" class="" alt="{{$value['title']}}">
            </div>
            <div class="block-body">
                <h6 class="strong-600">
                    {{ __($value['title']) }}
                </h6>
                <div class="row no-gutters mt-2 mb-2">
                    <div class="col-4">
                        <div>{{__('Price')}}:</div>
                    </div>
                    <div class="col-8">
                        <div class="heading-6 text-danger">
                            <strong>
                                {{ format_price($value['price']* abs($value['quantity'])) }}
                            </strong>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>


    <div class="text-center">
        <a href="{{ route('home') }}" class="btn btn-styled btn-base-1 btn-outline mb-3 mb-sm-0 hov-bounce hov-shaddow shopping" >{{__('Continue shopping')}}</a>
        <a href="{{ route('cart') }}" class="btn btn-styled btn-base-1 mb-3 mb-sm-0 hov-bounce hov-shaddow">{{__('Proceed to Checkout')}}</a>
    </div>
</div>
