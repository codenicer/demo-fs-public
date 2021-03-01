<!DOCTYPE html>
@if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
    <html dir="rtl">
@else
    <html>
@endif
<head>

@php
    $seosetting = \App\SeoSetting::first();
@endphp
    <!-- <script src="https://kit.fontawesome.com/f087a100ca.js" crossorigin="anonymous"></script> -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@if(Auth::check())
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex" />
    @else
        <meta name="robots" content="index, follow">
    @endif

@yield('meta')



<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{ config('app.name', 'Laravel') }}">
<meta itemprop="description" content="DEMO-ECOMMERCE">

<!-- Favicon -->

<!-- Favicon for iphone -->
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend/images/icons/favicon/apple-touch-icon.png') }}">

<!-- Favicon for android chrome -->
<link rel="manifest" href="{{ asset('frontend/images/icons/favicon/site.webmanifest') }}">

{{-- <!-- for desktop browsers -->
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('frontend/images/icons/favicon/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('frontend/images/icons/favicon/favicon-16x16.png') }}">
<link rel="shortcut icon" href="{{ asset('frontend/images/icons/favicon/favicon.ico') }}"> --}}

<title>@yield('meta_title', config('app.name', 'Laravel'))</title>


<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

<!-- Bootstrap -->
<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" type="text/css">
<!-- Icons -->
<link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('frontend/css/line-awesome.min.css') }}" type="text/css">
<link type="text/css" href="{{ asset('frontend/css/bootstrap-tagsinput.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('frontend/css/sweetalert2.min.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('frontend/css/slick.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('frontend/css/xzoom.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('frontend/css/jquery.share.css') }}" rel="stylesheet">

<!-- Global style (main) -->
<link type="text/css" href="{{ asset('frontend/css/active-shop.css') }}" rel="stylesheet">

<!--Spectrum Stylesheet [ REQUIRED ]-->

<!-- Custom style -->
<link type="text/css" href="{{ asset('frontend/css/custom-style.css') }}" rel="stylesheet">

@if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
     <!-- RTL -->
    <link type="text/css" href="{{ asset('frontend/css/active.rtl.css') }}" rel="stylesheet">
@endif

<!-- Facebook Chat style -->
<link href="{{ asset('frontend/css/fb-style.css')}}" rel="stylesheet">

<!-- color theme -->
<link href="{{ asset('frontend/css/colors/'.\App\GeneralSetting::first()->frontend_color.'.css')}}" rel="stylesheet">

<link href="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.css') }}" rel='stylesheet'></link>

@yield('css')

<!-- jQuery -->
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

    <style>
    @media (min-width: 1500px){
        .container {
            max-width: 1200px !important;
        }    
    }
    </style>
</head>

<body style='overflow: hidden'>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WJRCS49"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->



@if(Request::path() === '/')
<div class='loading-container d-flex flex-column'>
  <div class='loading-up-child flex-grow-1'>
    <div class='loading-img-container rounded-circle d-flex align-items-center justify-content-center'>
        <div class='loading-progress-indicator rounded-circle loadingSpin'>

        </div>
        <img src='{{ asset("frontend/images/logo/loading-demo.svg") }}' width='60px' class='p-2'/>
    </div>
  </div>
  <div class='loading-down-child flex-grow-1'>
  </div>
</div>
@endif

<!-- MAIN WRAPPER -->
<div class="body-wrap shop-default shop-cards shop-tech gry-bg">

    <!-- Header -->
    @include('frontend.inc.nav')

    @yield('content')

    @include('frontend.inc.footer')

    @include('frontend.partials.modal')

    <div class="modal fade" id="addToCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                <button type="button" class="close absolute-close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div id="addToCart-modal-body">

                </div>
            </div>
        </div>
    </div>

    @if (\App\BusinessSetting::where('type', 'facebook_chat')->first()->value == 1)
        <div id="fb-root"></div>
        <!-- Your customer chat code -->
        <div class="fb-customerchat"
          attribution=setup_tool
          page_id="{{ env('FACEBOOK_PAGE_ID') }}">
        </div>
    @endif

</div><!-- END: body-wrap -->

<!-- SCRIPTS -->
<a href="#" class="back-to-top btn-back-to-top d-none"></a>


<!-- Load Facebook SDK for JavaScript -->
<!--
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v5.0'
    });
  };

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>


<div class="fb-customerchat"
     attribution=setup_tool
     page_id="568116120228173"
     greeting_dialog_display="hide"
>
      </div>
-->

@yield('script-slider')
<script src="{{ asset('frontend/js/sweetalert2.min.js') }}"></script>

<script type="text/javascript">
    function showFrontendAlert(type, message){
        if(type == 'danger'){
            type = 'error';
        }
        swal({
            position: 'top-end',
            type: type,
            title: message,
            showConfirmButton: false,
            timer: 3000
        });
    }
</script>

@foreach (session('flash_notification', collect())->toArray() as $message)
    <script type="text/javascript">
        showFrontendAlert('{{ $message['level'] }}', '{{ $message['message'] }}');
    </script>
@endforeach

<script>

    $(document).ready(function(){
        
        $('body').attr('style', 'overflow: auto');

        $('.loading-up-child').addClass('slideOutUp');
        $('.loading-down-child').addClass('slideOutDown');

        $('.loading-progress-indicator').addClass('loading-progress-complete');

        $('.loading-progress-indicator').removeClass('loadingSpin');

        setTimeout(function(){
            $('.loading-container').remove()
        }, 1500)

        window.addEventListener('resize', function(){ imageResponsiveness()})
        titleHeightHandler();
        imageResponsiveness();

        $('#search-nav').on('keyup', function(event) {
            let empty = true;

            // let searchText = event.target.value;

            if(event.target.length === 0 ){
                empty = true;
            } else if(event.target.value.trim().length === 0){
                empty = true;
            } else {
                empty = false;
            }

            if(empty)
                $('#btn-submit-nav').attr('disabled', 'disabled');
            else
                $('#btn-submit-nav').attr('disabled', false);
        });

    });

    function updateNavCart(){
        $.post('{{ route('cart.nav_cart') }}', {_token:'{{ csrf_token() }}'}, function(data){
            $('#cart_items').html(data);
        });
    }

    function removeFromCart(key){
        $.post('{{ route('cart.removeFromCart') }}', {_token:'{{ csrf_token() }}', key:key}, function(data){
            updateNavCart();
            $('#cart-summary').html(data);
            showFrontendAlert('success', 'Item has been removed from cart');
            $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())-1);
        });
    }

    function showAddToCartModal(id){
        if(!$('#modal-size').hasClass('modal-lg')){
            $('#modal-size').addClass('modal-lg');
        }
        $('#addToCart-modal-body').html(null);
        $('#addToCart').modal();
        $('.c-preloader').show();
        $.post('{{ route('cart.showCartModal') }}', {_token:'{{ csrf_token() }}', id:id}, function(data){
            $('.c-preloader').hide();
            $('#addToCart-modal-body').html(data);
            $('.xzoom, .xzoom-gallery').xzoom({
                Xoffset: 20,
                bg: true,
                tint: '#000',
                defaultScale: -1
            });
            getVariantPrice();
        });
    }

    function getVariantPrice(){
        if($('#option-choice-form input[name=quantity]').val() > 0 && checkAddToCartValidity()){
            $.ajax({
               type:"POST",
               url: '{{ route('products.variant_price') }}',
               data: $('#option-choice-form').serializeArray(),
               success: function(data){
                   $('#option-choice-form #chosen_price_div').removeClass('d-none');
                   $('#option-choice-form #chosen_price_div #chosen_price').html(data.price);
                   $('#available-quantity').html(data.quantity);
               }
           });
        }
    }

    function checkAddToCartValidity(){
        var names = {};
        $('#option-choice-form input:radio').each(function() { // find unique names
              names[$(this).attr('name')] = true;
        });
        var count = 0;
        $.each(names, function() { // then count them
              count++;
        });
        if($('input:radio:checked').length == count){
            return true;
        }
        return false;
    }

    function addToCart(){
        if(checkAddToCartValidity()) {
            $('#addToCart').modal();
            $('.c-preloader').show();
            $.ajax({
               type:"POST",
               url: '{{ route('cart.addToCart') }}',
               data: $('#option-choice-form').serializeArray(),
               success: function(data){
                   $('#addToCart-modal-body').html(null);
                   $('.c-preloader').hide();
                   $('#modal-size').removeClass('modal-lg');
                   $('#addToCart-modal-body').html(data);
                   updateNavCart();
                   $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())+1);
               }
           });
        }
        else{
            showFrontendAlert('warning', 'Please choose all the options');
        }
    }

    function buyNow(){
        if(checkAddToCartValidity()) {
            $('#addToCart').modal();
            $('.c-preloader').show();
            $.ajax({
               type:"POST",
               url: '{{ route('cart.addToCart') }}',
               data: $('#option-choice-form').serializeArray(),
               success: function(data){
                   updateNavCart();
                   $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())+1);
                   window.location.replace("{{ route('checkout.shipping_info') }}");
               }
           });
        }
        else{
            showFrontendAlert('warning', 'Please choose all the options');
        }
    }

    function show_purchase_history_details(order_id)
    {
        $('#order-details-modal-body').html(null);

        if(!$('#modal-size').hasClass('modal-lg')){
            $('#modal-size').addClass('modal-lg');
        }

        $.post('{{ route('purchase_history.details') }}', { _token : '{{ @csrf_token() }}', order_id : order_id}, function(data){
            $('#order-details-modal-body').html(data);
            $('#order_details').modal();
            $('.c-preloader').hide();
        });
    }

    function show_order_details(order_id)
    {
        $('#order-details-modal-body').html(null);

        if(!$('#modal-size').hasClass('modal-lg')){
            $('#modal-size').addClass('modal-lg');
        }

        $.post('{{ route('orders.details') }}', { _token : '{{ @csrf_token() }}', order_id : order_id}, function(data){
            $('#order-details-modal-body').html(data);
            $('#order_details').modal();
            $('.c-preloader').hide();
        });
    }

    function cartQuantityInitialize(){
        $('.btn-number').click(function(e) {
            e.preventDefault();

            fieldName = $(this).attr('data-field');
            type = $(this).attr('data-type');
            var input = $("input[name='" + fieldName + "']");
            var currentVal = parseInt(input.val());

            if (!isNaN(currentVal)) {
                if (type == 'minus') {

                    if (currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if (type == 'plus') {

                    if (currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        });

        $('.input-number').focusin(function() {
            $(this).data('oldValue', $(this).val());
        });

        $('.input-number').change(function() {

            minValue = parseInt($(this).attr('min'));
            maxValue = parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());

            name = $(this).attr('name');
            if (valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if (valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }


        });


        $(".input-number").keydown(function(e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    }

     function imageInputInitialize(){
         $('.custom-input-file').each(function() {
             var $input = $(this),
                 $label = $input.next('label'),
                 labelVal = $label.html();

             $input.on('change', function(e) {
                 var fileName = '';

                 if (this.files && this.files.length > 1)
                     fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                 else if (e.target.value)
                     fileName = e.target.value.split('\\').pop();

                 if (fileName)
                     $label.find('span').html(fileName);
                 else
                     $label.html(labelVal);
             });

             // Firefox bug fix
             $input
                 .on('focus', function() {
                     $input.addClass('has-focus');
                 })
                 .on('blur', function() {
                     $input.removeClass('has-focus');
                 });
         });
     }

    var images = document.querySelectorAll('#product-image');
    var containers = document.querySelectorAll('#product-card');
    // let highestHeight = 0;

    function titleHeightHandler(){
        var titleContainers = document.querySelectorAll('.product-title');
        titleContainers.forEach(function(title){
        // console.log(title.offsetWidth)
        // console.log(title.offsetWidth)
        title.setAttribute('style', 'max-width: '+title.offsetWidth+'px; overflow-wrap: break-word; white-space: normal; height: 42px')
        // highestHeight = (highestHeight > title.offsetHeight) ? highestHeight : title.offsetHeight; 
     })
    }


    // console.log(highestHeight)

       function imageResponsiveness() {
        var x = [];
        try{
            var containerWidth = document.getElementById('product-card').offsetWidth -2;
            document.querySelectorAll('#product-image').forEach( function(image, index) {
            image.setAttribute('style', 'width: '+containerWidth+'px; height: '+containerWidth+'px;');
                if((image.getBoundingClientRect().bottom - 300) <= window.innerHeight){
                    console.log(image.getBoundingClientRect().bottom, window.innerHeight)
                    x[index] = new Image()
                    x[index].src = image.dataset.src
                    x[index].onload = function(){
                        image.innerHTML = '';
                        // image.firstChild.setAttribute('style', 'display: none')
                        image.setAttribute('style', 'width: '+containerWidth+'px; height: '+containerWidth+'px; background: url('+image.dataset.src+') no-repeat center / cover');
                    }
                    image.id = 'loaded'
                }
            });
        }catch(error){

        }
    }

    document.addEventListener('scroll', imageResponsiveness)
</script>

<script src="{{ asset('frontend/js/bootstrap-tagsinput.min.js') }}"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js" integrity="sha256-wfVTTtJ2oeqlexBsfa3MmUoB77wDNRPqT1Q1WA2MMn4=" crossorigin="anonymous"></script>
<script src="{{ asset('frontend/js/active-shop.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>
<script>

  if(performance.navigation.type == 2)
  {
    location.reload();

  }
</script>

@yield('script')
</body>
</html>
<!--
<?php