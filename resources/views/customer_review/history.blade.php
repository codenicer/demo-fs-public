@extends('frontend.layouts.app')


@section('content')

    {{-- {{dd(request()->getRequestUri())}} --}}
    <section class="gry-bg py-4">
        <div class="container">
            <div class="row ">
                    @include('customer_review.reviewnav')
                 
                        @for ($i = 0; $i < 2; $i++)
                            <div class=" mx-auto col-10 pt-1 pb-3 mb-4 bg-white">
                                <div class="py-2">
                                    <p class="font-weight-light">Purchased on 13 Dec 2019</p>
                                    <div class="row py-4"> 
                                        <img class="col-2"  style="height:5rem" src="https://picsum.photos/200/200" alt="testimg">
                                        <h6 class="col-8" >[Lucky Piso Dec 13] Chance to win Samsung Galaxy S10+ with FREE</h6>
                                        <div class="col-2 d flex">
                                            <h6>Your Rating</h6>
                                            <span class="star-rating">
                                                {{ renderStarRating(4) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row py-4"> 
                                        <img class="col-2"  style="height:5rem" src="https://picsum.photos/200/200" alt="testimg">
                                        <h6 class="col-8" >[Lucky Piso Dec 13] Chance to win Samsung Galaxy S10+ with FREE</h6>
                                        <div class="col-2 d flex">
                                            <h6>Your Rating</h6>
                                            <span class="star-rating">
                                                {{ renderStarRating(4) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         @endfor
                </div>
            </div>
        </div>
    </section>

@endsection
