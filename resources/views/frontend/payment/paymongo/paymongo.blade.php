@extends('frontend.layouts.app')

@section('content')
<img src="https://d33wubrfki0l68.cloudfront.net/3d8ac274ce079d7f644f695d6c7cd27354850cd4/1423f/assets/images/logos/logo-green.png"
    class="d-block" style="width: 30%; margin: 5% auto;">


<div class="row">
    <div class="col-lg-7 mx-auto">
        {{-- <a href="" class="btn btn-outline-primary mb-3">Payments</a> --}}
        <div class="bg-white rounded-lg shadow-sm p-5 pb-100 shadow p-3 mb-5 bg-white rounded">
            <!-- Credit card form tabs -->
            <ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
                <li class="nav-item">
                    <a data-toggle="pill" href="#nav-tab-card" class="nav-link active rounded-pill">
                        <i class="fa fa-credit-card"></i>
                        Credit Card
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="pill" href="#nav-tab-paypal" class="nav-link rounded-pill">
                        <i class="fa fa-paypal"></i>
                        Paypal
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="pill" href="#nav-tab-bank" class="nav-link rounded-pill">
                        <i class="fa fa-university"></i>
                        Bank Transfer
                    </a>
                </li>
            </ul>
            <!-- End -->


            <!-- Credit card form content -->
            <div class="tab-content">

                <!-- credit card info-->
                <div id="nav-tab-card" class="tab-pane fade show active">
                    <div id="errorPanel" style="display:none;">
                        
                    </div>
                    @if(session('error'))
                    <p class="alert alert-danger" id="errorText">{{session('error')}}</p>
                    @endif
                    <form role="form" action="{{route('paymongo.store')}}" method="POST" class="require-validation" id="payment-form">
                        @csrf

                        <input type="hidden" name="token" id="hiddenToken">
                        <div class="form-group">
                            <label for="username">Full name (on the card)</label>
                            <input type="text" name="name" id="name" placeholder="Jason Doe" required
                                class="form-control" value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="cardNumber">Card number</label>
                            <div class="input-group">
                                <input type="text" name="card_number" id="card_number" placeholder="Your card number"
                                    class="form-control" value="{{old('card_number')}}" required>
                                <div class="input-group-append">
                                    <span class="input-group-text text-muted">
                                        <i class="fa fa-cc-visa mx-1"></i>
                                        <i class="fa fa-cc-amex mx-1"></i>
                                        <i class="fa fa-cc-mastercard mx-1"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label><span class="hidden-xs">Expiration</span></label>
                                    <div class="input-group">
                                        <input type="number" placeholder="MM" name="exp_month" id="exp_month"
                                            class="form-control" value="{{old('exp_month')}}" required>
                                        <input type="number" placeholder="YY" name="exp_year" id="exp_year"
                                            class="form-control" value="{{old('exp_year')}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group mb-4">
                                    <label data-toggle="tooltip" title="Three-digits code on the back of your card">CVC
                                        <i class="fa fa-question-circle"></i>
                                    </label>
                                    <input type="text" name="cvc" id="cvc" required value="{{old('cvc')}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cardNumber">Amount</label>
                            <div class="input-group">
                                <input type="text" name="amount" id="amount" placeholder="Your amount here"
                                    class="form-control" value="{{old('amount')}}" required>
                            </div>
                        </div>
                        <button type="button" id="submitz"
                            class="subscribe btn btn-primary btn-block rounded-pill shadow-sm">
                            Confirm </button>
                    </form>
                </div>
                <!-- End -->

                <!-- Paypal info -->
                <div id="nav-tab-paypal" class="tab-pane fade">
                    <p>Paypal is easiest way to pay online</p>
                    <p>
                        <button type="button" class="btn btn-primary rounded-pill"><i class="fa fa-paypal mr-2"></i> Log
                            into my Paypal</button>
                    </p>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                </div>
                <!-- End -->

                <!-- bank transfer info -->
                <div id="nav-tab-bank" class="tab-pane fade">
                    <h6>Bank account details</h6>
                    <dl>
                        <dt>Bank</dt>
                        <dd> THE WORLD BANK</dd>
                    </dl>
                    <dl>
                        <dt>Account number</dt>
                        <dd>7775877975</dd>
                    </dl>
                    <dl>
                        <dt>IBAN</dt>
                        <dd>CZ7775877975656</dd>
                    </dl>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                </div>
                <!-- End -->
            </div>

        </div>
    </div>
</div>

@endsection

@section('script')

<script type="text/javascript">
    $(function() {
    var $form         = $(".require-validation");
  $('form.require-validation').bind('submit', function(e) {
    var $form         = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;
        $errorMessage.addClass('hide');

        $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorMessage.removeClass('hide');
        e.preventDefault();
      }
    });
  });

  $( "#submitz" ).bind('click', function(){
  event.preventDefault();

  var baseUrl = 'https://api.paymongo.com/v1/tokens';

  var name = $( "#name" ).val();
  var card_number = $( "#card_number" ).val();
  var cvc = $( "#cvc" ).val();
  var exp_month = $( "#exp_month" ).val();
  var exp_year = $( "#exp_year" ).val();

axios.post(
        "https://api.paymongo.com/v1/tokens",
        {
          data: {
            attributes: {
              number: card_number,
              exp_month: parseInt(exp_month),
              exp_year: parseInt(exp_year),
              cvc,
              billing: {
                address: {
                  line1: "111",
                  line2: "Wanchan St",
                  city: "Furview",
                  state: "Metro Manila",
                  postal_code: "11111",
                  country: "PH"
                },
                name,
                phone: "111-111-1111",
                email: "zdoge@zoey.paymongo.net"
              }
            }
          }
        },
        {
          headers: {
            Authorization: "Basic " + btoa("pk_test_KPjA8wrY5oihSxpfmy3zLefd")
          }
        }
      )
      .then(res => {
        console.log(res.data.data.id);

        $('#hiddenToken').val(res.data.data.id);

        $("#payment-form").submit();

      })
      .catch(err => {
          console.log(err.response);

          $("#errorPanel").html('<p class="alert alert-danger" id="errorText"></p>');

          $("#errorText").text(err.response.data.errors[0].detail);
          $("#errorPanel").css("display", "block");

          disappear();
      })

  });

  //DISAPPEARING SHIT
  function disappear(){
    window.setTimeout(function () {
    $(".alert-danger").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 1400);
  }

  disappear();
  
});
</script>
@endsection

@section('css')
<style>
    body {
        background: #f5f5f5;
    }

    .rounded-lg {
        border-radius: 1rem;
    }

    .nav-pills .nav-link {
        color: #1fb57f;
    }

    .nav-pills .nav-link.active {
        color: #fff;
    }

    .nav-pills>li.active>a {
        background: #1fb57f !important;
    }

    a.nav-link.active.rounded-pill{
        background: #1fb57f !important;
        color: white;
    }

    a.nav-link.rounded-pill:hover{
        background: #1fb57f !important;
        color: white;
    }

</style>
@endsection