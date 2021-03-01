@extends('frontend.layouts.app')

@section('content')

<div class="container">
    <div >
        <form>
            <div class="d-flex ">   
                <div class="form-group flex-fill">
                    <label for="formGroupExampleInput">First Name</label>
                    <input type="text" class="form-control" id="first_name" placeholder="First Name">
                  </div>
                  <div class="form-group flex-fill ">
                    <label for="formGroupExampleInput2">Last Name</label>
                    <input type="text" class="form-control" id="last_name" placeholder="Last Name">
                  </div>

            </div>
            <div class="form-group flex-fill ">
                <label for="formGroupExampleInput2">Sender Email</label>
                <input type="text" class="form-control" id="sender_email" placeholder="Sender Email">
              </div>
            <div class="form-group flex-fill">
                <label for="formGroupExampleInput">Card Message</label>
                <textarea class="form-control" id="card_message" placeholder="Card Message"></textarea>
            </div>
           
          </form>
          <button  id="btn_submit_card" class="btn btn-primary mb-2">Submit</button>
    </div>
</div>

<script>

    


      $("#btn_submit_card").click(function(e){

        let first_name = $("#first_name")[0].value
        let last_name = $("#last_name")[0].value
        let sender_email = $("#sender_email")[0].value
        let card_message  = $("#card_message")[0].value

          console.log({first_name,last_name,sender_email,card_message})
        $.ajax({
                type: "POST",
                url: "{{route('vcard.send')}}",
                data: {
                        "data":{
                            first_name,
                            last_name,
                            sender_email,
                            card_message
                        },
                        "_token": "{{ csrf_token() }}"
                    },
                success: function (data) {
                       console.log(data);
                }
            });
      })

</script>

@endsection