<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="....">
  <meta name="keywords" content="...">
  <meta name="author" content="PointTheme">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Title -->
  <title>Wodmart-Furniture eCommerce HTML Template</title>
  <link rel="icon" type="image/x-icon" sizes="20x20" href="https://wodmart.vercel.app/assets/images/icon/favicon.svg">

  <!-- Bootstrap -->
  <link rel="stylesheet" type="text/css"
    href="{{URL("/")}}/resources/themes/default/public/css/bootstrap-5.3.0.min.css">
  <!-- fonts & icon -->
  <link rel="stylesheet" type="text/css" href="{{URL("/")}}/resources/themes/default/public/css/remixicon.css">
  <!-- Plugin -->
  <link rel="stylesheet" type="text/css" href="{{URL("/")}}/resources/themes/default/public/css/plugin.css">
  <!-- Main CSS -->
  <link rel="stylesheet" href="{{URL("/")}}/resources/themes/default/public/css/main-style.css">

</head>

<body>
  <div class="loading-page" id="preloader-active">
    <div class="counter">
      <img src="https://wodmart.vercel.app/assets/images/logo/logo.png" alt="img">
      <span class="number">0%</span>
      <span class="line"></span>
      <span class="line"></span>
    </div>
  </div>


<!-- Sign in / sign up modal-->
@include('layouts.front-end.partials._modals')
<!-- Navbar-->
<!-- Quick View Modal-->
@include('layouts.front-end.partials._quick-view-modal')
<!-- Navbar Electronics Store-->
@include('layouts.front-end.partials._header')
<!-- Page title-->

 <!-- Page Content-->
@yield('content')

<span id="update_nav_cart_url" data-url="{{route('cart.nav-cart')}}"></span>
<span id="remove_from_cart_url" data-url="{{ route('cart.remove') }}"></span>
<span id="update_quantity_url" data-url="{{route('cart.updateQuantity.guest')}}"></span>
<span id="order_again_url" data-url="{{ route('cart.order-again') }}"></span>
<!-- Footer-->
<!-- Footer-->


@include('layouts.front-end.partials._footer')

@include('layouts.front-end.partials.modal._dynamic-modals')

