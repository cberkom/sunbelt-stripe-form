<?php
  define("STRIPE_PUBLIC_KEY", "pk_test_sDlQTXC2o8ED1hIHjseunSPG");
  define("STRIPE_SECRET_KEY", "sk_test_PTPwfMWhHA8I9VO1Y7lhHBjh");
  Stripe::setApiKey(STRIPE_SECRET_KEY);
?>