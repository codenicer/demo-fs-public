@extends('frontend.layouts.app')


@section('content')
@php
$cards= getVcards();
$cid = $card_id ?$card_id : 1;
$card_image =$cards[$cid];

@endphp
<style>
    .step-circle {
        height: 25px; 
        width: 25px; 
        border: 2px solid rgba(0, 0, 0, 0.986);;
        color: rgba(0, 0, 0, 0.986);;
    }

    .step-circle-active,
    .step-circle-done {
        background: rgba(0, 0, 0, 0.986); !important;
        color: white !important;
    }

    .step-circle-done strong:first-child {
        display: none
    }

    .step-circle-done strong:last-child {
        display: block !important;
    }

    .step-container-close {
        height: 20px;
    }

    .step-container-close > div {
        display: none; !important
    }

    .step-container-close:last-child {
        height: 0;
    }
    @keyframes ru-lds-roller {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

</style>

<section class='bg-gray py-2'>
    <div class='container'>
        <div id="vcardform" class="row">
            <div class='col-12 col-lg-6 p-0'>
                <div class='px-3 bg-white m-1'>
                    <div class='py-3'>
                        <h6><strong>{{__('Card Details')}}</strong></h6>
                    </div>
                    <div class='d-flex flex-column'>
    
                        <div class='ml-1 d-flex align-items-center' id='sender-step'>
                            <div class='step-circle rounded-circle step-circle-active d-flex align-items-center justify-content-center mr-2'>
                                <strong>1</strong>
                                <strong class='d-none'><i class="fa fa-check"></i></strong>
                            </div>
                            <strong>{{__('Sender Information')}}</strong>
                        </div>
    
                        {{-- sender info --}}
                        <div class='border-left ml-3 my-3 px-3'>
                            <div class="row py-2">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">{{__('First Name')}}</label>
                                        <input id="sender_first_name" type="text" class="form-control" name="sender_first_name"
                                            {{-- placeholder="{{__( 'First Name')}}" --}}
                                            value="{{isset($creds['recipient_first_name']) ? $creds['recipient_first_name'] : ''}}"
                                            required/>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">{{__('Last Name')}}</label>
                                        <input id="sender_last_name" type="text" class="form-control" name="sender_last_name"
                                            {{-- placeholder="{{__( 'Last Name')}}" --}}
                                            value="{{isset($creds['recipient_last_name']) ? $creds['recipient_last_name'] : ''}}"
                                            required/>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="control-label">{{__('Email')}}</label>
                                        <input id="sender_email" type="text" class="form-control" name="sender_email"
                                            {{-- placeholder="{{__( 'Email')}}" --}}
                                            value="{{isset($creds['recipient_email']) ? $creds['recipient_email'] : ''}}"
                                            required/>
                                    </div>
                                </div>
        
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="message">{{__('Message') }}</label>
                                        <textarea
                                                {{-- placeholder="{{__('Remember to tell who you are (if you want your recipient to know)')}}" --}}
                                                name='message'
                                                class="form-control"
                                                id="message"
                                                rows="5"
                                                maxlength='200'></textarea>
                                    </div>
                                </div>
                                
                                <div class="col-12 d-flex justify-content-end">
                                    <button class="btn btn-base-1 py-1 px-3" onclick='doneStepHandler("sender-step", "recipient-step")'>{{__('Next')}}</button>
                                </div>
                            </div>
                        </div>
    
                        <div class='ml-1 d-flex align-items-center' id='recipient-step'>
                            <div class='step-circle rounded-circle d-flex align-items-center justify-content-center mr-2'>
                                <strong>2</strong>
                                <strong class='d-none'><i class="fa fa-check"></i></strong>
                            </div>
                            <strong>{{__('Recipient Information')}}</strong>
    
                        </div>
    
                        {{-- recipeient form --}}
                        <div class='border-left ml-3 my-3 px-3 step-container-close'>
                            <div class="row py-2">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">{{__('First Name')}}</label>
                                        <input
                                        id="recipient_first_name" 
                                        type="text" class="form-control" name="recipient_first_name"
                                            {{-- placeholder="{{__( 'First Name')}}" --}}
                                            value="{{isset($creds['sender_first_name']) ? $creds['sender_first_name'] : ''}}"
                                            required/>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">{{__('Last Name')}}</label>
                                        <input 
                                        id="recipient_last_name"
                                        type="text" class="form-control" name="recipient_last_name"
                                            {{-- placeholder="{{__( 'Last Name')}}" --}}
                                            value="{{isset($creds['sender_last_name']) ? $creds['sender_last_name'] : ''}}"
                                            required/>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="control-label">{{__('Email')}}</label>
                                        <input
                                         id="recipient_email"
                                         type="text" class="form-control" name="recipient_email"
                                            {{-- placeholder="{{__( 'Email')}}" --}}
                                            value="{{isset($creds['sender_email']) ? $creds['sender_email'] : ''}}"
                                            required/>
                                    </div>
                                </div>
                                <div class="col-6 d-flex justify-content-start">
                                    <button class="btn btn-base-1 py-1 px-3" onclick='doneStepHandler("recipient-step", "sender-step")'>{{__('Back')}}</button>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <button class="btn btn-base-1 py-1 px-3" onclick='doneStepHandler("recipient-step", "final-step")'>{{__('Next')}}</button>
                                </div>
                            </div>
                        </div>
    
                        <div class='ml-1 d-flex align-items-center' id='final-step'>
                            <div class='step-circle rounded-circle d-flex align-items-center justify-content-center mr-2'>
                                <strong>3</strong>
                            </div>
                            <strong  >{{__('Send')}}</strong>
                        </div>
    
                        {{-- overview --}}
                        <div class='border-left ml-3 my-3 px-3 step-container-close'>
                            <div class="row py-2">
                                <div class="col-12">
                                    <div class='mb-2'>
                                        <strong>TO: </strong> <span id="result_recipient_name"></span>
                                    </div>
                                    <div class='mb-2'>
                                        <strong>FROM: </strong> <span id="result_sender_name"></span>
                                    </div>
                                    <div class='mb-2'>
                                        <strong>Message:</strong>
                                        <p id="result_message" ></p>
                                    </div>
                                </div>
                                <div class="col-6 d-flex justify-content-start">
                                    <button class="btn btn-base-1 py-1 px-3" onclick='doneStepHandler("final-step", "recipient-step")'>{{__('Back')}}</button>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <button id="btn_submit_card" class="btn btn-base-1 py-1 px-3">{{__('Send')}}</button>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
            <div class='col-12 col-lg-6'>
                <div class='bg-white d-flex align-items-center justify-content-center m-1 py-2'>
                    <img src="{{asset($card_image)}}" width='300px' height='auto'>
                </div>
            </div>
        </div>
    </div>
</section>

<script>

    function doneStepHandler(elemId, nextElemId) {
        
      
        //creadit:ruther

        var emailreg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;



        if(elemId === "sender-step" && nextElemId ===  "recipient-step"){
            var sender_first_name = $("#sender_first_name").val().replace(/\s/g,'');
            var sender_last_name = $("#sender_last_name").val().replace(/\s/g,'');
            var sender_email = $("#sender_email").val().replace(/\s/g,'');
            var message = $("#message").val().replace(/\s/g,'');

            if(!sender_first_name){
                alert("Please enter your first name");
                return false;
            }
            if(!sender_last_name){
                alert("Please enter your last name");
                return false;
            }



            if(!sender_email) {
                alert("ERROR: Invalid sender email address!");
                return false
            }else{
                    if (!emailreg.test(String(sender_email).toLowerCase())) {
                        alert("ERROR: Invalid sender email address!");
                        return false
                    }

            }
            if(!message){
                alert("Please input your message");
                return false;
            }
            
        }

        if(elemId === "recipient-step" && nextElemId === "final-step"){
            var recipient_first_name = $("#recipient_first_name").val().replace(/\s/g,'');
            var recipient_last_name = $("#recipient_last_name").val().replace(/\s/g,'');
            var recipient_email = $("#recipient_email").val().replace(/\s/g,'');



            if(!recipient_first_name){
                alert("Please enter recipient first name");
                return false;
            }
            if(!recipient_last_name){
                alert("Please enter recipient last name");
                return false;
            }

            if(!recipient_email) {
                alert("ERROR: Invalid recipient email address!");
                return false
            }else{
                if (!emailreg.test(String(recipient_email).toLowerCase())) {
                    alert("ERROR: Invalid recipient email address!");
                    return false
                }

            }
        }

        //end


        var element = document.getElementById(elemId);
        var nextElem = document.getElementById(nextElemId);
       // console.log(element, element.firstElementChild)
        element.firstElementChild.setAttribute('class', 'step-circle rounded-circle d-flex align-items-center justify-content-center mr-2 step-circle-done')
        element.nextElementSibling.setAttribute('class', 'border-left ml-3 my-3 px-3 step-container-close')


        nextElem.firstElementChild.setAttribute('class', 'step-circle rounded-circle step-circle-active d-flex align-items-center justify-content-center mr-2')
        nextElem.nextElementSibling.setAttribute('class', 'border-left ml-3 my-3 px-3')

        //credit: ruther
        if(nextElemId ===  "final-step"){
             
             $("#result_recipient_name")[0].innerText = $("#recipient_first_name").val(); + " "+ $("#recipient_last_name").val();
             $("#result_sender_name")[0].innerText =  $("#sender_first_name").val(); + " " + $("#sender_last_name").val();
             $("#result_message")[0].innerText =  $("#message").val();
        }
        //end

    }

    $("#btn_submit_card").click(function(e){


       $(this).attr('disabled', true);
        //recipient info`s
        var recipient_first_name = $("#recipient_first_name").val();
        var recipient_last_name = $("#recipient_last_name").val();
        var recipient_email = $("#recipient_email").val();

        //sendder info`s
        var sender_first_name = $("#sender_first_name").val();
        var sender_last_name = $("#sender_last_name").val();
        var sender_email = $("#sender_email").val();
        var message = $("#message").val();

        $.ajax({
            type: "POST",
            url: "{{route('vcard.send')}}",
            data: {
                    "data":{
                        recipient_first_name: recipient_first_name,
                        recipient_last_name: recipient_last_name,
                        recipient_email: recipient_email,

                        sender_first_name: sender_first_name,
                        sender_last_name: sender_last_name,
                        sender_email: sender_email,
                        message: message,
                        card_id: '{{$card_id}}'
                    },
                    "_token": "{{ csrf_token() }}"
                },
            success: function (data) {

                $(this).attr('disabled', false);
                location.reload();

            },
            error: function(err){

                console.log('Error:',err);
                $("#btn_submit_card").attr('disabled', false);
                alert('An error has occurred, please try again.');
            }

        });
    })


</script>


@endsection