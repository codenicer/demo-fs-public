
@extends('frontend.layouts.app')
    <style>
          

           #ru-write-review .starrating > input {display: none;} 

           #ru-write-review .starrating > label:before { 
            content: "\f005"; /* Star */
            margin: 2px;
            font-size: 4em;
            font-family: FontAwesome;
            display: inline-block; 
            }

            #ru-write-review .starrating > label
            {
            color: #222222;
            }

            #ru-write-review .starrating > input:checked ~ label
            { color: #ffca08 ; } 

            #ru-write-review .starrating > input:hover ~ label
            { color: #ffca08 ;  } 


    </style>
@section('content')
    <section class="gry-bg py-4">
        <div id="ru-write-review" class="container">
            <h4 >{{_('Write Review ')}}</h4>
            <div class="row bg-white" style="padding: 2rem 0 2rem">
                    <div class="col-7" style="border-right:2px solid #EFF0F5">
                        <p style="font-size:1rem" class="lead">Delivered on 30 Sep 2019</p>
                        <p>Rate and review purchased product:</p>
                        <div class="row">
                            <img class="col-2"  style="height:5rem" src="https://picsum.photos/200/200" alt="testimg">
                            <div class="col-10">
                                <h6 >[Lucky Piso Dec 13] Chance to win Samsung Galaxy S10+ with FREE</h6>
                                <p  style="opacity: 0.5">Color Family:Pearl White</p>
                            </div>	
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="starrating risingstar d-flex justify-content-center flex-row-reverse">
                            <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 star">5</label>
                            <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 star">4</label>
                            <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 star">3</label>
                            <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 star">2</label>
                            <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star">1</label>
                        </div>
                        <div class="d-flex flex-wrap justify-content-center col-4 m-auto"  >
                            <button style="width:15rem"  type="button" class="btn  btn-lg btn-outline-success ">Sumbit Review</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
