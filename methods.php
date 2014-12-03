<?php
  require_once('./require_all.php');

  // Function: create_and_charge_customer
  //
  // 1. Take a stripe token and other form input
  // 2. Create a reusable Stripe Customer object
  // 3. Create a one-time Charge for this Customer
  //
  // param Array ($_POST)
  // returns Array (error/success details)
  function create_and_charge_customer($post) {
    try {
      validate_post_request($post);

      $customer = Stripe_Customer::create(array(
        "email" => $post['email'],
        "description" => $post['company_name'],
        "card" => $post['stripe_token'] // obtained with Stripe.js
      ));

      $description = ($post['order_number']) ? "Payment for order ".$post['order_number'] : "Payment for quote ".$post['quote_number'];

      $charge = Stripe_Charge::create(array(
        "amount" => intval($post['amount'] * 100), // Stripe wants this value in cents
        "currency" => "usd",
        "customer" => $customer->id,
        "description" => $description,
        "metadata" => array(
          "order_number" => $post['order_number'],
          "quote_number" => $post['quote_number']
        )
      ));

      return array('success' => true, 'message' => 'Thanks for your payment! Check your email for a receipt.');
      
    } catch(Stripe_CardError $e) {
      // Since it's a decline, Stripe_CardError will be caught
      $body = $e->getJsonBody();
      $err  = $body['error'];
      return array('success' => false, 'message' => 'Sorry, your bank declined this charge: ' . $err['message']);

    } catch (Stripe_InvalidRequestError $e) {
      // Invalid parameters were supplied to Stripe's API
      return array('success' => false, 'message' => 'Sorry, there was an error submitting your request. Please check your input and try again.');

    } catch (Stripe_AuthenticationError $e) {
      // Authentication with Stripe's API failed
      return array('success' => false, 'message' => 'Sorry, authentication failed. Please contact support.');

    } catch (Stripe_ApiConnectionError $e) {
      // Network communication with Stripe failed
      return array('success' => false, 'message' => 'Sorry, we\'re having trouble connecting to our API. Please wait a moment and try again.');

    } catch (Stripe_Error $e) {
      // Display a very generic error to the user, and maybe send yourself an email
      return array('success' => false, 'message' => 'Sorry, we encountered an error and couldn\'t process your payment. Please try again shortly, or contact support.');

    } catch (Exception $e) {
      // Something else happened, completely unrelated to Stripe
      return array('success' => false, 'message' => $e->getMessage());
    }
  }


  // Helper Methods
  function validate_post_request($post) {
    expect_all(array('amount', 'company_name', 'email_address', 'stripe_token'), $post);
    expect_one(array('order_number', 'quote_number'), $post);
  }

  function expect_all($keys, $params) {
    foreach ($keys as $k) {
      if (!array_key_exists($k, $params) || $params[$k] == "") {
        throw new Exception("Please enter a value for $k");
      }
    }
  }

  function expect_one($keys, $params) {
    foreach ($keys as $k) {
      if (array_key_exists($k, $params) && $params[$k] > "") {
        return;
      }
    }
    throw new Exception("Please enter a value for either " . implode(', ', $keys));
  }

?>