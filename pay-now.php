<?php 
  require_once('./stripe/lib/Stripe.php');
  require_once('./api-keys.php');
  if(!empty($_POST)) {
    Stripe::setApiKey(STRIPE_SECRET_KEY);

    // Stripe_Charge::create(array(
    //   "amount" => 400,
    //   "currency" => "usd",
    //   "card" => "tok_5ENe70lZ0EiQII", // obtained with Stripe.js
    //   "description" => "Charge for test@example.com"
    // ));
  }
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <div class='row'>
        <div class='col-md-8 error form-group hide'>
          <div class='alert-danger alert'>
            Please correct the errors and try again.
          </div>
        </div>
      </div>
      <div class='row'>
        <form accept-charset="UTF-8" action="/" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="<?= STRIPE_PUBLIC_KEY ?>" id="payment-form" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="✓" /><input name="_method" type="hidden" value="PUT" /><input name="authenticity_token" type="hidden" value="qLZ9cScer7ZxqulsUWazw4x3cSEzv899SP/7ThPCOV8=" /></div>
          <div class='col-md-4'>
            <div class='form-row'>
              <div class='col-xs-6 form-group'>
                <label class='control-label'>Order Number</label>
                <input name='order_number' class='form-control' size='4' type='text'>
              </div>
              <div class='col-xs-6 form-group'>
                <label class='control-label'>Quote Number</label>
                <input name='quote_number' class='form-control' size='4' type='text'>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-xs-12 form-group required'>
                <label class='control-label'>Payment Amount</label>
                <input name='email_address' class='form-control' size='4' type='text'>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-xs-12 form-group required'>
                <label class='control-label'>Company Name</label>
                <input name='company_name' class='form-control' size='4' type='text'>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-xs-12 form-group required'>
                <label class='control-label'>Email Address</label>
                <input name='email_address' class='form-control' size='4' type='text'>
              </div>
            </div>
          </div>
          <div class='col-md-4'>
            <div class='form-row'>
              <div class='col-xs-12 form-group required'>
                <label class='control-label'>Name on Card</label>
                <input class='form-control' size='4' type='text'>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-xs-12 form-group card required'>
                <label class='control-label'>Card Number</label>
                <input autocomplete='off' class='form-control card-number' size='20' type='text'>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-xs-4 form-group cvc required'>
                <label class='control-label'>CVC</label>
                <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
              </div>
              <div class='col-xs-4 form-group expiration required'>
                <label class='control-label'>Expiration</label>
                <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
              </div>
              <div class='col-xs-4 form-group expiration required'>
                <label class='control-label'> </label>
                <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-md-12 form-group'>
                <button class='btn btn-primary btn-lg btn-block submit-button' type='submit'>Pay »</button>
              </div>
            </div>
          </div>
          <div class='col-md-4'></div>
        </form>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <!-- Stripe.js -->
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <!-- Payment Form JS -->
    <script type="text/javascript" src="/pay-now.js"></script>
  </body>
</html>