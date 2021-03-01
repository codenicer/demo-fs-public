@extends('frontend.layouts.app')


@section('content')
    <section class="gry-bg py-4">
        <div class="container">
            <div class="row">
                    @include('customer_review.reviewnav')
                    @for ($i = 0; $i < 8; $i++)
                        <div class="row pt-1 pb-3 mb-4 bg-white">

                            <div class="col-8" style="border-right:2px solid #EFF0F5">
                                <p class="font-weight-light">Purchased on 13 Dec 2019</p>
                                <div class="row">
                                    <img class="col-2"  style="height:5rem" src="https://picsum.photos/200/200" alt="testimg">
                                    <h6 class="col-6" >[Lucky Piso Dec 13] Chance to win Samsung Galaxy S10+ with FREE</h6>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-center col-4 m-auto"  >
                                <a href="/myreviews/write-review"> 
                                    <button style="width:15rem"  type="button" class="btn  btn-lg btn-outline-success "> Write Review</button>
                                </a>
                            </div>
                            
                        </div>
                    @endfor
                   
                    
                </div>
            </div>
        </div>
    </section>

@endsection
