@extends('layouts.front-end.app')

@section('title',translate('My_Shopping_Cart'))

@push('css')
    <meta property="og:image" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="og:title" content="{{$web_config['name']->value}} "/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description" content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)),0,160) }}">

    <meta property="twitter:card" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="twitter:title" content="{{$web_config['name']->value}}"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description" content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)),0,160) }}">



@endpush

@section('content')
    <div class="container mt-3" id="cart-summary">
        @include(VIEW_FILE_NAMES['products_cart_details_partials'])
    </div>
@endsection

@push('script')
    <script>
        cartQuantityInitialize();
    </script>
@endpush
