@extends('frontend.layouts.app')


@section('content')
    @php
        $cards = getVcards();
    @endphp

    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                        <li><a href="#">{{__('eCards')}}</a></li>
                        <li><a href="#">{{__('ecard category') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section class='bg-gray py-2'>
        <div class="container">
            {{-- <div class="row">
                <div class='col-3'>
                    <div class="bg-white sidebar-box">
                        <div class="box-title text-center">
                            {{__('Cards')}}
                        </div>
                        <div class="box-content">
                            <div class="category-accordion">
                                    <div class="single-category">
                                        <a href='/' class='w-100 sub-category-name' >category</a>
                                    </div>
                                    <div class="single-category">
                                        <a href='/' class='w-100 sub-category-name' >category</a>
                                    </div>
                                    <div class="single-category">
                                        <a href='/' class='w-100 sub-category-name' >category</a>
                                    </div>
                                    <div class="single-category">
                                        <a href='/' class='w-100 sub-category-name' >category</a>
                                    </div>
                                    <div class="single-category">
                                        <a href='/' class='w-100 sub-category-name' >category</a>
                                    </div>
                                    <div class="single-category">
                                        <a href='/' class='w-100 sub-category-name' >category</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class='col-12 bg-white'>

                    <div class="row px-3 py-2">
                        <div class='section-title-1 col-12'>
                            <h5 class='m-1'>eCards</h5>
                        </div>
                       {{-- <div class="col-12">
                            <div class="sort-by-box">
                                <div class="form-group">
                                    <label>{{__('Search')}}</label>
                                    <div class="search-widget">
                                        <input class="form-control input-lg" type="text" name="q" placeholder="{{__('Search products')}}">
                                        <button type="submit" class="btn-inner">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        {{-- {{ dd($cards) }} --}}

                        <div class="col-2 mb-2">
                            <div class='border'>
                                <img class='d-block m-auto'src="https://images.greetingsisland.com/images/cards/birthday/kids/previews/happy-birthday-confetti.png?auto=format,compress&w=440" alt="" width='150px' height='auto'>
                                <div class="border-top text-center py-2">
                                    <span><strong>Name of the card</strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 mb-2">
                            <div class='border'>
                                <img class='d-block m-auto'src="https://images.greetingsisland.com/images/cards/birthday/kids/previews/happy-birthday-confetti.png?auto=format,compress&w=440" alt="" width='150px' height='auto'>
                                <div class="border-top text-center py-2">
                                    <span><strong>Name of the card</strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 mb-2">
                            <div class='border'>
                                <img class='d-block m-auto'src="https://images.greetingsisland.com/images/cards/birthday/kids/previews/happy-birthday-confetti.png?auto=format,compress&w=440" alt="" width='150px' height='auto'>
                                <div class="border-top text-center py-2">
                                    <span><strong>Name of the card</strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 mb-2">
                            <div class='border'>
                                <img class='d-block m-auto'src="https://images.greetingsisland.com/images/cards/birthday/kids/previews/happy-birthday-confetti.png?auto=format,compress&w=440" alt="" width='150px' height='auto'>
                                <div class="border-top text-center py-2">
                                    <span><strong>Name of the card</strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 mb-2">
                            <div class='border'>
                                <img class='d-block m-auto'src="https://images.greetingsisland.com/images/cards/birthday/kids/previews/happy-birthday-confetti.png?auto=format,compress&w=440" alt="" width='150px' height='auto'>
                                <div class="border-top text-center py-2">
                                    <span><strong>Name of the card</strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 mb-2">
                            <div class='border'>
                                <img class='d-block m-auto'src="https://images.greetingsisland.com/images/cards/birthday/kids/previews/happy-birthday-confetti.png?auto=format,compress&w=440" alt="" width='150px' height='auto'>
                                <div class="border-top text-center py-2">
                                    <span><strong>Name of the card</strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 mb-2">
                            <div class='border'>
                                <img class='d-block m-auto'src="https://images.greetingsisland.com/images/cards/birthday/kids/previews/happy-birthday-confetti.png?auto=format,compress&w=440" alt="" width='150px' height='auto'>
                                <div class="border-top text-center py-2">
                                    <span><strong>Name of the card</strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>          
        </div>
    </section>

@endsection