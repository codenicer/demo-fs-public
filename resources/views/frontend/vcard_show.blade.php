@extends('frontend.layouts.app')


@section('content')

    @php
        $cards= getVcards();
        $cid =  1;
        $card_image =$cards[$cid];
    @endphp

<style>

    .card-wrap {
        cursor: pointer;
        width: 400px; 
        height: 600px;  
        -webkit-perspective: 1400;
    }

    
    .card-face {    
        top:0;
        left: 0;
        -webkit-backface-visibility: visible;
        -webkit-transition: all 0.5s ease-out;
        -webkit-transform-origin: 0 0;
    }

    .card-front {
        z-index: 3;
        -webkit-transform: rotateY(-20deg);
        -webkit-backface-visibility: hidden;
    }

    .card-inner-left {
        -webkit-transform: rotateY(-20deg);
        z-index: 2;
    }

    .card-inner-right: {
        -webkit-transform: rotateY(0deg);
        z-index: 1;
    }

    .card-wrap:hover .card-front,
    .card-wrap:hover .card-inner-left {
        -webkit-transform: rotateY(-35deg);
    }

    .card-toggle:checked + .card-wrap .card-front,
    .card-toggle:checked + .card-wrap .card-inner-left {
        -webkit-transform: rotateY(-165deg);
    }

    .card-message {
        line-height: 1.6;
    }

    @media (max-width: 768px) { 
        .card-wrap {
            width: 266.66px;
            height: 400px;
        }
     }

</style>

    <section class='bg-gray py-4'>
        <div class="container">
            <div class='d-flex justify-content-center'>
                <input type="checkbox" id='card-toggle' class='card-toggle d-none'>
                <label for="card-toggle" class='d-block position-relative card-wrap'>
                    <div class='card-face card-front position-absolute shadow h-100 w-100 ' style='background: url({{asset($card_image)}}) no-repeat center / cover'>
                   
                    </div>
                    <div class='card-face card-inner-left position-absolute h-100 w-100 bg-white'>
                    </div>
                    <div class='card-face card-inner-right position-absolute h-100 w-100 bg-white border-right border-left'>

                        <div class="d-flex p-3 flex-column h-100">
                            <div class='mb-3'>
                                <strong>TO:  </strong> <span> {{$content['recipient_first_name']}} {{$content['recipient_last_name']}}  </span>
                            </div>
                            <div class='mb-2 flex-grow-1 text-center'>
                                <div class='card-message p-3 h-100 d-flex align-items-center justify-content-center'>
                                    <p>{{$content['message']}}</p>
                                </div>
                            </div>
                            <div class='mb-2'>
                                <strong>FROM:  </strong> <span> {{$content['sender_first_name']}} {{$content['sender_last_name']}} </span>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a class="btn btn-base-1 py-1 px-3" href="{{ route('vcard.reply', array('content' => $b64content)) }}">{{__('Reply')}}</a>
                            </div>
                        </div>
                    </div>
                </label>
            </div>
           
        </div>
    </section>

    <script>

    </script>

@endsection