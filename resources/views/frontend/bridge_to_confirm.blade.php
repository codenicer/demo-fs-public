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
    <meta name="description" content="@yield('meta_description', $seosetting->description)" />
    <meta name="keywords" content="@yield('meta_keywords', $seosetting->keyword)">
    <meta name="author" content="{{ $seosetting->author }}">
    <meta name="sitemap_link" content="{{ $seosetting->sitemap_link }}">
    @yield('meta')
        <link rel="alternate" type="application/atom+xml" title="Demo Ecommerce" href="Demo Ecommerce">
    @php
    /*
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ config('app.name', 'Laravel') }}">
    <meta itemprop="description" content="{{ $seosetting->description }}">
    <meta itemprop="image" content="{{ asset(\App\GeneralSetting::first()->logo) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ config('app.name', 'Laravel') }}">
    <meta name="twitter:description" content="{{ $seosetting->description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ asset(\App\GeneralSetting::first()->logo) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ config('app.name', 'Laravel') }}" />
    <meta property="og:type" content="Ecommerce Site" />
    <meta property="og:url" content="{{ route('home') }}" />
    <meta property="og:image" content="{{ asset(\App\GeneralSetting::first()->logo) }}" />
    <meta property="og:description" content="{{ $seosetting->description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    */
    @endphp

    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <!-- Favicon -->

    <!-- Favicon for iphone -->
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('frontend/images/icons/favicon/apple-touch-icon.png') }}">

    <!-- Favicon for android chrome -->
    <link rel="manifest" href="{{ asset('frontend/images/icons/favicon/site.webmanifest') }}">

    <!-- for microsoft edge and IE -->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-config" href="{{ asset('frontend/images/icons/favicon/browserconfig.xml') }}">

    <!-- for desktop browsers -->
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('frontend/images/icons/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('frontend/images/icons/favicon/favicon-16x16.png') }}">
    <link rel="shortcut icon" href="{{ asset('frontend/images/icons/favicon/favicon.ico') }}">

    <title>@yield('meta_title', config('app.name', 'Demo Ecommerce'))</title>


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
        rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" type="text/css">

    <style>
        p {
            margin: 0;
            padding: 0;
            font-size: 60px;
        }

        .lds-ring {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
            margin-bottom: 5%;
        }

        .lds-ring div {
            box-sizing: border-box;
            display: block;
            position: absolute;
            width: 72px;
            height: 72px;
            margin: 8px;
            border: 2px solid #1990c6;
            border-radius: 50%;
            animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
            border-color: #1990c6 transparent transparent transparent;
        }

        .lds-ring div:nth-child(1) {
            animation-delay: -0.45s;
        }

        .lds-ring div:nth-child(2) {
            animation-delay: -0.3s;
        }

        .lds-ring div:nth-child(3) {
            animation-delay: -0.15s;
        }

        @keyframes lds-ring {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

</head>

<body>

    <div class="container-fluid">
        <div class="row justify-content-center align-items-center" style="height:100vh;">
            <div class="text-center">
                <div class="lds-ring">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <p style="font: 17px 'Open Sans', sans-serif; font-weight:300;">Your order's being processed.</p>
                <p style="font: 17px 'Open Sans', sans-serif; font-weight:300;">If you're not automatically redirected,
                    <a href="">refresh this page</a>.
                </p>

            </div>
        </div>
    </div>

</body>

</html>


<script>
    setTimeout(function(){ 
        window.location.href = "{{route('checkout.order_confirm_page', ['id' => $id])}}";
    }, 3000);
</script>