@extends('layouts.front-end.app')

@section('title', $product['name'])

@push('css')
    <meta name="description" content="{{$product->slug}}">
    <meta name="keywords" content="@foreach(explode(' ',$product['name']) as $keyword) {{$keyword.' , '}} @endforeach">
    @if($product->added_by=='seller')
        <meta name="author" content="{{ $product->seller->shop?$product->seller->shop->name:$product->seller->f_name}}">
    @elseif($product->added_by=='admin')
        <meta name="author" content="{{$web_config['name']->value}}">
    @endif
    <!-- Viewport-->

    @if($product['meta_image']!=null)
        <meta property="og:image" content="{{asset("storage/app/public/product/meta")}}/{{$product->meta_image}}"/>
        <meta property="twitter:card"
              content="{{asset("storage/app/public/product/meta")}}/{{$product->meta_image}}"/>
    @else
        <meta property="og:image" content="{{asset("storage/app/public/product/thumbnail")}}/{{$product->thumbnail}}"/>
        <meta property="twitter:card"
              content="{{asset("storage/app/public/product/thumbnail/")}}/{{$product->thumbnail}}"/>
    @endif

    @if($product['meta_title']!=null)
        <meta property="og:title" content="{{$product->meta_title}}"/>
        <meta property="twitter:title" content="{{$product->meta_title}}"/>
    @else
        <meta property="og:title" content="{{$product->name}}"/>
        <meta property="twitter:title" content="{{$product->name}}"/>
    @endif
    <meta property="og:url" content="{{route('product',[$product->slug])}}">

    @if($product['meta_description']!=null)
        <meta property="twitter:description" content="{!! $product['meta_description'] !!}">
        <meta property="og:description" content="{!! $product['meta_description'] !!}">
    @else
        <meta property="og:description"
              content="@foreach(explode(' ',$product['name']) as $keyword) {{$keyword.' , '}} @endforeach">
        <meta property="twitter:description"
              content="@foreach(explode(' ',$product['name']) as $keyword) {{$keyword.' , '}} @endforeach">
    @endif
    <meta property="twitter:url" content="{{route('product',[$product->slug])}}">

    <link rel="stylesheet" href="{{asset('public/assets/front-end/css/product-details.css')}}"/>
    <style>
        .btn-number:hover {
            color: {{$web_config['secondary_color']}};

        }

        .for-total-price {
            margin-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: -30%;
        }

        .feature_header span {
            padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 15px;
        }

        .flash-deals-background-image{
            background: {{$web_config['primary_color']}}10;
        }

        @media (max-width: 768px) {
            .for-total-price {
                padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 30%;
            }

            .product-quantity {
                padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 4%;
            }

            .for-margin-bnt-mobile {
                margin-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 7px;
            }

        }

        @media (max-width: 375px) {
            .for-margin-bnt-mobile {
                margin-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 3px;
            }

            .for-discount {
                margin-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 10% !important;
            }

            .for-dicount-div {
                margin-top: -5%;
                margin-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}: -7%;
            }

            .product-quantity {
                margin-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 4%;
            }

        }

        @media (max-width: 500px) {
            .for-dicount-div {
                margin-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}: -5%;
            }

            .for-total-price {
                margin-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: -20%;
            }

            .view-btn-div {
                float: {{Session::get('direction') === "rtl" ? 'left' : 'right'}};
            }

            .for-discount {
                margin-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 7%;
            }
            .for-mobile-capacity {
                margin-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 7%;
            }
        }
    </style>
    <style>
       
        /**/
    </style>


<style>
  .breadcrumb-bg::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url("{{asset('public/assets/front-end/img/breadcrumb/breadcrumb-1.png')}}") !important;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: 100% 100%;
    opacity: 1;
    -webkit-transition: opacity 0.3s ease;
    transition: opacity 0.3s ease;
    z-index: -1;
  }
</style>

@endpush

@section('content')
    {{-- <div class="__inline-23">
        <!-- Page Content-->
        <div class="container mt-4 rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
            <!-- General info tab-->
            <div class="row {{Session::get('direction') === "rtl" ? '__dir-rtl' : ''}}">
                <!-- Product gallery-->
                <div class="col-lg-9 col-12">
                    <div class="row">
                        <div class="col-lg-5 col-md-4 col-12">
                            <div class="cz-product-gallery">
                                <div class="cz-preview">
                                    @if($product->images!=null && json_decode($product->images)>0)
                                        @if(json_decode($product->colors) && $product->color_image)
                                            @foreach (json_decode($product->color_image) as $key => $photo)
                                                @if($photo->color != null)
                                                    <div class="cz-preview-item d-flex align-items-center justify-content-center {{$key==0?'active':''}}"
                                                         id="image{{$photo->color}}">
                                                        <img class="cz-image-zoom img-responsive w-100 __max-h-323px"
                                                             onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                             src="{{asset("storage/app/public/product/$photo->image_name")}}"
                                                             data-zoom="{{asset("storage/app/public/product/$photo->image_name")}}"
                                                             alt="Product image" width="">
                                                        <div class="cz-image-zoom-pane"></div>
                                                    </div>
                                                @else
                                                    <div class="cz-preview-item d-flex align-items-center justify-content-center {{$key==0?'active':''}}"
                                                         id="image{{$key}}">
                                                        <img class="cz-image-zoom img-responsive w-100 __max-h-323px"
                                                             onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                             src="{{asset("storage/app/public/product/$photo->image_name")}}"
                                                             data-zoom="{{asset("storage/app/public/product/$photo->image_name")}}"
                                                             alt="Product image" width="">
                                                        <div class="cz-image-zoom-pane"></div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            @foreach (json_decode($product->images) as $key => $photo)
                                                <div class="cz-preview-item d-flex align-items-center justify-content-center {{$key==0?'active':''}}"
                                                     id="image{{$key}}">
                                                    <img class="cz-image-zoom img-responsive w-100 __max-h-323px"
                                                         onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                         src="{{asset("storage/app/public/product/$photo")}}"
                                                         data-zoom="{{asset("storage/app/public/product/$photo")}}"
                                                         alt="Product image" width="">
                                                    <div class="cz-image-zoom-pane"></div>
                                                </div>
                                            @endforeach
                                        @endif
                                    @endif
                                </div>

                                <div class="d-flex flex-column gap-3">
                                    <button type="button" onclick="addWishlist('{{$product['id']}}')"
                                            class="btn __text-18px border wishlight-pos-btn d-sm-none">
                                        <i class="fa {{($wishlist_status == 1?'fa-heart':'fa-heart-o')}} wishlist_icon_{{$product['id']}}" style="color: {{$web_config['primary_color']}}"
                                        aria-hidden="true"></i>
                                    </button>

                                    <div style="text-align:{{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                                        class="sharethis-inline-share-buttons share--icons">
                                    </div>
                                </div>

                                <div class="cz">
                                    <div class="table-responsive __max-h-515px" data-simplebar>
                                        <div class="d-flex">
                                            @if($product->images!=null && json_decode($product->images)>0)
                                                @if(json_decode($product->colors) && $product->color_image)
                                                    @foreach (json_decode($product->color_image) as $key => $photo)
                                                        @if($photo->color != null)
                                                            <div class="cz-thumblist">
                                                                <a class="cz-thumblist-item  {{$key==0?'active':''}} d-flex align-items-center justify-content-center"
                                                                   id="preview-img{{$photo->color}}" href="#image{{$photo->color}}">
                                                                    <img
                                                                        onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                                        src="{{asset("storage/app/public/product/$photo->image_name")}}"
                                                                        alt="Product thumb">
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="cz-thumblist">
                                                                <a class="cz-thumblist-item  {{$key==0?'active':''}} d-flex align-items-center justify-content-center"
                                                                   id="preview-img{{$key}}" href="#image{{$key}}">
                                                                    <img
                                                                        onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                                        src="{{asset("storage/app/public/product/$photo->image_name")}}"
                                                                        alt="Product thumb">
                                                                </a>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @foreach (json_decode($product->images) as $key => $photo)
                                                        <div class="cz-thumblist">
                                                            <a class="cz-thumblist-item  {{$key==0?'active':''}} d-flex align-items-center justify-content-center"
                                                               id="preview-img{{$key}}" href="#image{{$key}}">
                                                                <img
                                                                    onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                                    src="{{asset("storage/app/public/product/$photo")}}"
                                                                    alt="Product thumb">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product details-->
                        <div class="col-lg-7 col-md-8 col-12 mt-md-0 mt-sm-3" style="direction: {{ Session::get('direction') }}">
                            <div class="details __h-100">
                                <span class="mb-2 __inline-24">{{$product->name}}</span>
                                <div class="d-flex flex-wrap align-items-center mb-2 pro">
                                    <div class="star-rating" style="{{Session::get('direction') === "rtl" ? 'margin-left: 10px;' : 'margin-right: 10px;'}}">
                                        @for($inc=1;$inc<=5;$inc++)
                                            @if ($inc <= (int)$overallRating[0])
                                                <i class="tio-star text-warning"></i>
                                            @elseif ($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0] > ((int)$overallRating[0]))
                                                <i class="tio-star-half text-warning"></i>
                                            @else
                                                <i class="tio-star-outlined text-warning"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <span
                                        class="d-inline-block  align-middle mt-1 {{Session::get('direction') === "rtl" ? 'ml-md-2 ml-sm-0' : 'mr-md-2 mr-sm-0'}} fs-14 text-muted">({{$overallRating[0]}})</span>
                                    <span class="font-regular font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-1 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-1 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'}}"><span style="color: {{$web_config['primary_color']}}">{{$overallRating[1]}}</span> {{translate('reviews')}}</span>
                                    <span class="__inline-25"></span>
                                    <span class="font-regular font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-1 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-1 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'}}"><span style="color: {{$web_config['primary_color']}}">{{$countOrder}}</span> {{translate('orders')}}   </span>
                                    <span class="__inline-25">    </span>
                                    <span class="font-regular font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-0 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-0 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'}} text-capitalize"> <span style="color: {{$web_config['primary_color']}}"> {{$countWishlist}}</span> {{translate('wish_listed')}} </span>

                                </div>
                                <div class="mb-3">
                                    <span class="f-20 font-weight-normal text-accent ">
                                        {!! \App\CPU\Helpers::get_price_range_with_discount($product) !!}
                                    </span>
                                </div>

                                <form id="add-to-cart-form" class="mb-2">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <div class="position-relative {{Session::get('direction') === "rtl" ? 'ml-n4' : 'mr-n4'}} mb-2">
                                        @if (count(json_decode($product->colors)) > 0)
                                            <div class="flex-start align-items-center mb-2">
                                                <div class="product-description-label m-0 text-dark font-bold">{{translate('color')}}:
                                                </div>
                                                <div>
                                                    <ul class="list-inline checkbox-color mb-0 flex-start {{Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'}}"
                                                        style="padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 0;">
                                                        @foreach (json_decode($product->colors) as $key => $color)
                                                            <li>
                                                                <input type="radio"
                                                                    id="{{ $product->id }}-color-{{ str_replace('#','',$color) }}"
                                                                    name="color" value="{{ $color }}"
                                                                    @if($key == 0) checked @endif>
                                                                <label style="background: {{ $color }};"
                                                                    for="{{ $product->id }}-color-{{ str_replace('#','',$color) }}"
                                                                    data-toggle="tooltip" onclick="focus_preview_image_by_color('{{ str_replace('#','',$color) }}')">
                                                                <span class="outline"></span></label>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                        @php
                                            $qty = 0;
                                            if(!empty($product->variation)){
                                            foreach (json_decode($product->variation) as $key => $variation) {
                                                    $qty += $variation->qty;
                                                }
                                            }
                                        @endphp
                                    </div>
                                    @foreach (json_decode($product->choice_options) as $key => $choice)
                                        <div class="row flex-start mx-0 align-items-center">
                                            <div
                                                class="product-description-label text-dark font-bold {{Session::get('direction') === "rtl" ? 'pl-2' : 'pr-2'}} text-capitalize mb-2">{{ $choice->title }}
                                                :
                                            </div>
                                            <div>
                                                <ul class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-0 mx-1 flex-start row"
                                                    style="padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 0;">
                                                    @foreach ($choice->options as $key => $option)
                                                        <div>
                                                            <li class="for-mobile-capacity">
                                                                <input type="radio"
                                                                    id="{{ $choice->name }}-{{ $option }}"
                                                                    name="{{ $choice->name }}" value="{{ $option }}"
                                                                    @if($key == 0) checked @endif >
                                                                <label class="__text-12px"
                                                                    for="{{ $choice->name }}-{{ $option }}">{{ $option }}</label>
                                                            </li>
                                                        </div>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach

                                    <!-- Quantity + Add to cart -->
                                    <div class="mt-3">
                                        <div class="product-quantity d-flex flex-column __gap-15">
                                            <!-- quantity section -->
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="product-description-label text-dark font-bold mt-0">{{translate('quantity')}}:</div>
                                                <div class="d-flex justify-content-center align-items-center quantity-box border rounded border-base"
                                                    style="color: {{$web_config['primary_color']}}">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-number __p-10" type="button"
                                                                data-type="minus" data-field="quantity"
                                                                disabled="disabled" style="color: {{$web_config['primary_color']}}">
                                                            -
                                                        </button>
                                                    </span>
                                                    <input type="text" name="quantity"
                                                        class="form-control input-number text-center cart-qty-field __inline-29 border-0 "
                                                        placeholder="1" value="{{ $product->minimum_order_qty ?? 1 }}" product-type="{{ $product->product_type }}" min="{{ $product->minimum_order_qty ?? 1 }}" max="{{$product['product_type'] == 'physical' ? $product->current_stock : 100}}">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-number __p-10" type="button" product-type="{{ $product->product_type }}" data-type="plus"
                                                                data-field="quantity" style="color: {{$web_config['primary_color']}}">
                                                        +
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div id="chosen_price_div">
                                                <div class="d-none d-sm-flex justify-content-start align-items-center {{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}}">
                                                    <div class="product-description-label text-dark font-bold text-capitalize"><strong>{{translate('total_price')}}</strong> : </div>
                                                    &nbsp; <strong id="chosen_price" class="text-base"></strong>
                                                    <small class="{{Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'}}  font-regular">
                                                        (<small>{{translate('tax')}} : </small>
                                                        <small id="set-tax-amount"></small>)
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row no-gutters d-none mt-2 flex-start d-flex">
                                        <div class="col-12">
                                            @if(($product['product_type'] == 'physical') && ($product['current_stock']<=0))
                                                <h5 class="mt-3 text-danger">{{translate('out_of_stock')}}</h5>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="__btn-grp mt-2 mb-3 d-none d-sm-flex">
                                        @if(($product->added_by == 'seller' && ($seller_temporary_close || (isset($product->seller->shop) && $product->seller->shop->vacation_status && $current_date >= $seller_vacation_start_date && $current_date <= $seller_vacation_end_date))) ||
                                         ($product->added_by == 'admin' && ($inhouse_temporary_close || ($inhouse_vacation_status && $current_date >= $inhouse_vacation_start_date && $current_date <= $inhouse_vacation_end_date))))
                                            <button class="btn btn-secondary" type="button" disabled>
                                                {{translate('buy_now')}}
                                            </button>
                                            <button class="btn btn--primary string-limit" type="button" disabled>
                                                {{translate('add_to_cart')}}
                                            </button>
                                        @else
                                            <button class="btn btn-secondary element-center __iniline-26 btn-gap-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}" onclick="buy_now()" type="button">
                                                <span class="string-limit">{{translate('buy_now')}}</span>
                                            </button>
                                            <button
                                                class="btn btn--primary element-center btn-gap-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}"
                                                onclick="addToCart()" type="button">
                                                <span class="string-limit">{{translate('add_to_cart')}}</span>
                                            </button>
                                        @endif
                                        <button type="button" onclick="addWishlist('{{$product['id']}}')"
                                                class="btn __text-18px border d-none d-sm-block">
                                            <i class="fa {{($wishlist_status == 1?'fa-heart':'fa-heart-o')}} wishlist_icon_{{$product['id']}}" style="color: {{$web_config['primary_color']}}"
                                            aria-hidden="true"></i>
                                            <span class="fs-14 text-muted align-bottom countWishlist-{{$product['id']}}">{{$countWishlist}}</span>
                                        </button>
                                        @if(($product->added_by == 'seller' && ($seller_temporary_close || (isset($product->seller->shop) && $product->seller->shop->vacation_status && $current_date >= $seller_vacation_start_date && $current_date <= $seller_vacation_end_date))) ||
                                         ($product->added_by == 'admin' && ($inhouse_temporary_close || ($inhouse_vacation_status && $current_date >= $inhouse_vacation_start_date && $current_date <= $inhouse_vacation_end_date))))
                                            <div class="alert alert-danger" role="alert">
                                                {{translate('this_shop_is_temporary_closed_or_on_vacation._You_cannot_add_product_to_cart_from_this_shop_for_now')}}
                                        </div>
                                        @endif
                                    </div>
                                    
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mt-4 rtl col-12" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                            <div class="row" >
                                <div class="col-12">
                                    <div>
                                        <div class="px-4 pb-3 mb-3 mr-0 mr-md-2 bg-white __review-overview __rounded-10 pt-3">
                                            <!-- Tabs-->
                                            <ul class="nav nav-tabs nav--tabs d-flex justify-content-center mt-3" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link __inline-27 active " href="#overview" data-toggle="tab" role="tab">
                                                        {{translate('overview')}}
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link __inline-27" href="#reviews" data-toggle="tab" role="tab">
                                                        {{translate('reviews')}}
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content px-lg-3">
                                                <!-- Tech specs tab-->
                                                <div class="tab-pane fade show active text-justify" id="overview" role="tabpanel">
                                                    <div class="row pt-2 specification">

                                                        @if($product->video_url != null && (str_contains($product->video_url, "youtube.com/embed/")))
                                                            <div class="col-12 mb-4">
                                                                <iframe width="420" height="315"
                                                                        src="{{$product->video_url}}">
                                                                </iframe>
                                                            </div>
                                                        @endif
                                                        @if ($product['details'])
                                                            <div class="text-body col-lg-12 col-md-12 overflow-scroll fs-13 text-justify">
                                                                {!! $product['details'] !!}
                                                            </div>
                                                        @endif

                                                    </div>
                                                    @if (!$product['details'] && ($product->video_url == null || !(str_contains($product->video_url, "youtube.com/embed/"))))
                                                        <div>
                                                            <div class="text-center text-capitalize">
                                                                <img class="mw-90" src="{{asset('/public/assets/front-end/img/icons/nodata.svg')}}" alt="">
                                                                <p class="text-capitalize mt-2">
                                                                    <small>{{translate('product_details_not_found')}}!</small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Reviews tab-->
                                                <div class="tab-pane fade" id="reviews" role="tabpanel">
                                                    @if(count($product->reviews)==0 && $reviews_of_product->total() == 0)
                                                        <div>
                                                            <div class="text-center text-capitalize">
                                                                <img class="mw-100" src="{{asset('/public/assets/front-end/img/icons/empty-review.svg')}}" alt="">
                                                                <p class="text-capitalize">
                                                                    <small>{{translate('No_review_given_yet')}}!</small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row pt-2 pb-3">
                                                            <div class="col-lg-4 col-md-5 ">
                                                                <div class=" row d-flex justify-content-center align-items-center">
                                                                    <div class="col-12 d-flex justify-content-center align-items-center">
                                                                        <h2 class="overall_review mb-2 __inline-28">
                                                                            {{$overallRating[0]}}
                                                                        </h2>
                                                                    </div>
                                                                    <div  class="d-flex justify-content-center align-items-center star-rating ">
                                                                        @for($inc=1;$inc<=5;$inc++)
                                                                            @if ($inc <= (int)$overallRating[0])
                                                                                <i class="tio-star text-warning"></i>
                                                                            @elseif ($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0] > ((int)$overallRating[0]))
                                                                                <i class="tio-star-half text-warning"></i>
                                                                            @else
                                                                                <i class="tio-star-outlined text-warning"></i>
                                                                            @endif
                                                                        @endfor
                                                                    </div>
                                                                    <div class="col-12 d-flex justify-content-center align-items-center mt-2">
                                                                        <span class="text-center">
                                                                            {{$reviews_of_product->total()}} {{translate('ratings')}}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 pt-sm-3 pt-md-0" >
                                                                <div class="d-flex align-items-center mb-2 font-size-sm">
                                                                    <div
                                                                        class="__rev-txt"><span
                                                                            class="d-inline-block align-middle text-body">{{translate('excellent')}}</span>
                                                                    </div>
                                                                    <div class="w-0 flex-grow">
                                                                        <div class="progress text-body __h-5px">
                                                                            <div class="progress-bar " role="progressbar"
                                                                                style="background-color: {{$web_config['primary_color']}} !important;width: <?php echo $widthRating = ($rating[0] != 0) ? ($rating[0] / $overallRating[1]) * 100 : (0); ?>%;"
                                                                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1 text-body">
                                                                        <span
                                                                            class=" {{Session::get('direction') === "rtl" ? 'mr-3 float-left' : 'ml-3 float-right'}} ">
                                                                            {{$rating[0]}}
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <div class="d-flex align-items-center mb-2 text-body font-size-sm">
                                                                    <div
                                                                        class="__rev-txt"><span
                                                                            class="d-inline-block align-middle ">{{translate('good')}}</span>
                                                                    </div>
                                                                    <div class="w-0 flex-grow">
                                                                        <div class="progress __h-5px">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                style="background-color: {{$web_config['primary_color']}} !important;width: <?php echo $widthRating = ($rating[1] != 0) ? ($rating[1] / $overallRating[1]) * 100 : (0); ?>%; background-color: #a7e453;"
                                                                                aria-valuenow="27" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <span
                                                                            class="{{Session::get('direction') === "rtl" ? 'mr-3 float-left' : 'ml-3 float-right'}}">
                                                                                {{$rating[1]}}
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <div class="d-flex align-items-center mb-2 text-body font-size-sm">
                                                                    <div
                                                                        class="__rev-txt"><span
                                                                            class="d-inline-block align-middle ">{{translate('average')}}</span>
                                                                    </div>
                                                                    <div class="w-0 flex-grow">
                                                                        <div class="progress __h-5px">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                style="background-color: {{$web_config['primary_color']}} !important;width: <?php echo $widthRating = ($rating[2] != 0) ? ($rating[2] / $overallRating[1]) * 100 : (0); ?>%; background-color: #ffda75;"
                                                                                aria-valuenow="17" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <span
                                                                            class="{{Session::get('direction') === "rtl" ? 'mr-3 float-left' : 'ml-3 float-right'}}">
                                                                            {{$rating[2]}}
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <div class="d-flex align-items-center mb-2 text-body font-size-sm">
                                                                    <div
                                                                        class="__rev-txt "><span
                                                                            class="d-inline-block align-middle">{{translate('below_Average')}}</span>
                                                                    </div>
                                                                    <div class="w-0 flex-grow">
                                                                        <div class="progress __h-5px">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                style="background-color: {{$web_config['primary_color']}} !important;width: <?php echo $widthRating = ($rating[3] != 0) ? ($rating[3] / $overallRating[1]) * 100 : (0); ?>%; background-color: #fea569;"
                                                                                aria-valuenow="9" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <span
                                                                                class="{{Session::get('direction') === "rtl" ? 'mr-3 float-left' : 'ml-3 float-right'}}">
                                                                            {{$rating[3]}}
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <div class="d-flex align-items-center text-body font-size-sm">
                                                                    <div
                                                                        class="__rev-txt"><span
                                                                            class="d-inline-block align-middle ">{{translate('poor')}}</span>
                                                                    </div>
                                                                    <div class="w-0 flex-grow">
                                                                        <div class="progress __h-5px">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                style="background-color: {{$web_config['primary_color']}} !important;backbround-color:{{$web_config['primary_color']}};width: <?php echo $widthRating = ($rating[4] != 0) ? ($rating[4] / $overallRating[1]) * 100 : (0); ?>%;"
                                                                                aria-valuenow="4" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <span
                                                                            class="{{Session::get('direction') === "rtl" ? 'mr-3 float-left' : 'ml-3 float-right'}}">
                                                                                {{$rating[4]}}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row pb-4 mb-3">
                                                            <div class="__inline-30">
                                                                <span class="text-capitalize">{{ translate('Product_review') }}</span>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <div class="row pb-4">
                                                        <div class="col-12" id="product-review-list">
                                                            @include('web-views.partials.product-reviews')
                                                        </div>

                                                        @if(count($product->reviews) > 2)
                                                        <div class="col-12">
                                                            <div class="card-footer d-flex justify-content-center align-items-center">
                                                                <button class="btn text-white view_more_button" style="background: {{$web_config['primary_color']}};" onclick="load_review()">{{translate('view_more')}}</button>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3">
                    <!-- company reliability -->
                    @php($company_reliability = \App\CPU\Helpers::get_business_settings('company_reliability'))
                    @if($company_reliability != null)
                        <div class="product-details-shipping-details">
                            @foreach ($company_reliability as $key=>$value)
                            @if ($value['status'] == 1 && !empty($value['title']))
                                    <div class="shipping-details-bottom-border">
                                        <div class="px-3 py-3">
                                            <img class="{{Session::get('direction') === "rtl" ? 'float-right ml-2' : 'mr-2'}} __img-20"  src="{{asset("/storage/app/public/company-reliability").'/'.$value['image']}}"
                                            onerror="this.src='{{asset('/public/assets/front-end/img').'/'.$value['item'].'.png'}}'"
                                                    alt="">
                                            <span>{{translate($value['title'] ?? 'title_not_found')}}</span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    <!-- end -->
                    <div class="__inline-31">
                        <!--seller section-->
                        @if($product->added_by=='seller')
                            @if(isset($product->seller->shop))
                                <div class="row position-relative">
                                    <div class="col-12 position-relative">
                                        <a href="{{route('shopView',['id'=>$product->seller->id])}}" class="d-block">
                                            <div class="d-flex __seller-author align-items-center">
                                                <div>
                                                    <img class="__img-60 img-circle" src="{{asset('storage/app/public/shop')}}/{{$product->seller->shop->image}}"
                                                        onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                        alt="">
                                                </div>
                                                <div class="{{Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'}} w-0 flex-grow">
                                                    <h6 >
                                                        {{$product->seller->shop->name}}
                                                    </h6>
                                                    <span>{{translate('seller_info')}}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">

                                                @if(($product->added_by == 'seller' && ($seller_temporary_close || ($product->seller->shop->vacation_status && $current_date >= $seller_vacation_start_date && $current_date <= $seller_vacation_end_date))))
                                                    <span class="chat-seller-info" style="position: absolute; inset-inline-end: 24px; inset-block-start: -4px" data-toggle="tooltip" title="{{translate('this_shop_is_temporary_closed_or_on_vacation._You_cannot_add_product_to_cart_from_this_shop_for_now')}}">
                                                        <img src="{{asset('/public/assets/front-end/img/info.png')}}" alt="i">
                                                    </span>
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="row d-flex justify-content-between">
                                            <div class="col-6 ">
                                                <div class="d-flex justify-content-center align-items-center rounded __h-79px hr-right-before">
                                                    <div class="text-center">
                                                        <img src="{{asset('/public/assets/front-end/img/rating.svg')}}" class="mb-2" alt="">
                                                        <div class="__text-12px text-base">
                                                            <strong>{{$total_reviews}}</strong> {{translate('reviews')}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex justify-content-center align-items-center rounded __h-79px">
                                                    <div class="text-center">
                                                    <img src="{{asset('/public/assets/front-end/img/products.svg')}}" class="mb-2" alt="">
                                                        <div class="__text-12px text-base">
                                                            <strong>{{$products_for_review->count()}}</strong> {{translate('products')}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 position-static mt-3">
                                        <div class="chat_with_seller-btns">
                                            @if (auth('customer')->id())
                                                <button class="btn w-100 d-block text-center" style="background: {{$web_config['primary_color']}};color:#ffffff" data-toggle="modal"
                                                data-target="#chatting_modal" {{ ($product->seller->shop->temporary_close || ($product->seller->shop->vacation_status && date('Y-m-d') >= date('Y-m-d', strtotime($product->seller->shop->vacation_start_date)) && date('Y-m-d') <= date('Y-m-d', strtotime($product->seller->shop->vacation_end_date)))) ? 'disabled' : '' }}>
                                                <img src="{{asset('/public/assets/front-end/img/chat-16-filled-icon.png')}}" class="mb-1" alt="">
                                                    <span class="d-none d-sm-inline-block">{{translate('chat_with_seller')}}</span>
                                                </button>
                                            @else
                                                <a href="{{route('customer.auth.login')}}" class="btn w-100 d-block text-center" style="background: {{$web_config['primary_color']}};color:#ffffff" >
                                                    <img src="{{asset('/public/assets/front-end/img/chat-16-filled-icon.png')}}" class="mb-1" alt="">
                                                        <span class="d-none d-sm-inline-block">{{translate('chat_with_seller')}}</span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="row d-flex justify-content-between">
                                <div class="col-9 ">
                                    <a href="{{route('shopView',[0])}}" class="row d-flex ">
                                        <div>
                                            <img class="__inline-32"
                                                src="{{asset("storage/app/public/company")}}/{{$web_config['fav_icon']->value}}"
                                                onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                alt="">
                                        </div>
                                        <div class="{{Session::get('direction') === "rtl" ? 'right' : 'mt-3 ml-2'}}" onclick="location.href='{{route('shopView',[0])}}'">
                                            <span class="font-bold __text-16px">
                                                {{$web_config['name']->value}}
                                            </span><br>
                                        </div>

                                        @if($product->added_by == 'admin' && ($inhouse_temporary_close || ($inhouse_vacation_status && $current_date >= $inhouse_vacation_start_date && $current_date <= $inhouse_vacation_end_date)))
                                            <div class="{{Session::get('direction') === "rtl" ? 'right' : 'ml-3'}}">
                                                <span class="chat-seller-info" data-toggle="tooltip" title="{{translate('this_shop_is_temporary_closed_or_on_vacation._You_cannot_add_product_to_cart_from_this_shop_for_now')}}">
                                                    <img src="{{asset('/public/assets/front-end/img/info.png')}}" alt="i">
                                                </span>
                                            </div>
                                        @endif
                                    </a>
                                </div>

                                <div class="col-12 mt-2">
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-6 ">
                                            <div class="d-flex justify-content-center align-items-center rounded __h-79px hr-right-before">
                                                <div class="text-center">
                                                    <img src="{{asset('/public/assets/front-end/img/rating.svg')}}" class="mb-2" alt="">
                                                    <div class="__text-12px text-base">
                                                        <strong>{{$total_reviews}}</strong> {{translate('reviews')}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex justify-content-center align-items-center rounded __h-79px">
                                                <div class="text-center">
                                                   <img src="{{asset('/public/assets/front-end/img/products.svg')}}" class="mb-2" alt="">
                                                    <div class="__text-12px text-base">
                                                        <strong>{{$products_for_review->count()}}</strong> {{translate('products')}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <a href="{{ route('shopView',[0]) }}" class="text-center d-block w-100">
                                        <button class="btn text-center d-block w-100" style="background: {{$web_config['primary_color']}};color:#ffffff" >
                                            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                            {{translate('visit_Store')}}
                                        </button>
                                    </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="pt-4 pb-3">
                        <span class=" __text-16px font-bold text-capitalize">
                            {{ translate('more_from_the_store')}}
                        </span>
                    </div>
                    <div>
                        @foreach($more_product_from_seller as $item)
                            @include('web-views.partials.seller-products-product-details',['product'=>$item,'decimal_point_settings'=>$decimal_point_settings])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- for mobile -->
        <div class="bottom-sticky bg-white d-sm-none">
            <div class="d-flex flex-column gap-1 py-2">
                <div class="d-flex justify-content-center align-items-center fs-13">
                    <div class="product-description-label text-dark font-bold"><strong class="text-capitalize">{{translate('total_price')}}</strong> : </div>
                    &nbsp; <strong id="chosen_price_mobile" class="text-base"></strong>
                    <small class="ml-2  font-regular">
                        (<small>{{translate('tax')}} : </small>
                        <small id="set-tax-amount-mobile"></small>)
                    </small>
                </div>
                <div class="d-flex gap-3 justify-content-center">
                    @if(($product->added_by == 'seller' && ($seller_temporary_close || (isset($product->seller->shop) && $product->seller->shop->vacation_status && $current_date >= $seller_vacation_start_date && $current_date <= $seller_vacation_end_date))) ||
                        ($product->added_by == 'admin' && ($inhouse_temporary_close || ($inhouse_vacation_status && $current_date >= $inhouse_vacation_start_date && $current_date <= $inhouse_vacation_end_date))))
                        <button class="btn btn-secondary btn-sm btn-gap-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}" type="button" disabled>
                            {{translate('buy_now')}}
                        </button>
                        <button class="btn btn--primary btn-sm string-limit btn-gap-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}" type="button" disabled>
                            {{translate('add_to_cart')}}
                        </button>
                   @else
                       <button class="btn btn-secondary btn-sm btn-gap-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}" onclick="buy_now()" type="button">
                           <span class="string-limit">{{translate('buy_now')}}</span>
                       </button>
                       <button
                           class="btn btn--primary btn-sm string-limit btn-gap-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}"
                           onclick="addToCart()" type="button">
                           <span class="string-limit">{{translate('add_to_cart')}}</span>
                       </button>
                   @endif
                </div>
            </div>
        </div>
        <!-- end -->

        @if (count($relatedProducts)>0)
            <div class="container rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                <div class="card __card border-0">
                    <div class="card-body">
                        <div class="row flex-between">
                            <div style="{{Session::get('direction') === "rtl" ? 'margin-right: 5px;' : 'margin-left: 5px;'}}">
                                <h4 class="text-capitalize font-bold">{{ translate('similar_products')}}</h4>
                            </div>
                            <div class="view_all d-flex justify-content-center align-items-center">
                                <div>
                                    @php($category=json_decode($product['category_ids']))
                                    @if($category)
                                        <a class="text-capitalize view-all-text" style="color:{{$web_config['primary_color']}} !important;{{Session::get('direction') === "rtl" ? 'margin-left:10px;' : 'margin-right: 8px;'}}"
                                        href="{{route('products',['id'=> $category[0]->id,'data_from'=>'category','page'=>1])}}">{{ translate('view_all')}}
                                        <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left mr-1 ml-n1 mt-1 ' : 'right ml-1 mr-n1'}}"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Grid-->

                        <!-- Product-->
                        <div class="row g-3 mt-1">
                            @foreach($relatedProducts as $key => $relatedProduct)
                                <div class="col-xl-2 col-sm-3 col-6">
                                    @include('web-views.partials._single-product',['product'=>$relatedProduct,'decimal_point_settings'=>$decimal_point_settings])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="modal fade rtl" id="show-modal-view" tabindex="-1" role="dialog" aria-labelledby="show-modal-image"
            aria-hidden="true" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body flex justify-content-center">
                        <button class="btn btn-default __inline-33" style="{{Session::get('direction') === "rtl" ? 'left' : 'right'}}: -7px;"
                                data-dismiss="modal">
                            <i class="fa fa-close"></i>
                        </button>
                        <img class="element-center" id="attachment-view" src="">
                    </div>
                </div>
            </div>
        </div>
    </div> --}}



    <main>
      <!-- Breadcrumbs S t a r t -->
      <section class="breadcrumb-section breadcrumb-bg">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="breadcrumb-text">
                <h1 class="title wow fadeInUp" data-wow-delay="0.1s">Shop Details</h1>
                <nav aria-label="breadcrumb" class="breadcrumb-nav wow fadeInUp" data-wow-delay="0.0s">
                  <ul class="breadcrumb listing">
                    <li class="breadcrumb-item single-list"><a href="index-2.html" class="single">Home</a></li>
                    <li class="breadcrumb-item single-list" aria-current="page"><a href="javascript:void(0)"
                        class="single active">Shop Details</a></li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End-of Breadcrumbs-->
      <!-- product area S t a r t -->
      <section class="product-details-area top-padding">
        <div class="container">
          <div class="row g-4">
            <div class="col-xxl-6 col-lg-6">
              <div class="product-image-container">
                <div class="xzoom-box">
                  <img class="xzoom" src="assets/images/product/main-img-01.png"
                    xoriginal="assets/images/product/main-img-01.png" data-fancybox="gallery" alt="img">
                  <div class="shape-01">
                    <img src="assets/images/product/preview-shape-01.png" alt="img">
                  </div>
                  <div class="shape-02">
                    <img src="assets/images/product/preview-shape-02.png" alt="img">
                  </div>
                </div>

                <div class="xzoom-thumbs">
                  <div class="xzoom-gallery-box">
                    <a href="assets/images/product/main-img-01.png">
                      <img class="xzoom-gallery" width="80" src="assets/images/product/main-img-01.png"
                        xpreview="assets/images/product/main-img-01.png" data-fancybox="gallery" alt="img">
                    </a>
                  </div>
                  <div class="xzoom-gallery-box">
                    <a href="assets/images/product/main-img-02.png">
                      <img class="xzoom-gallery" width="80" src="assets/images/product/main-img-02.png"
                        data-fancybox="gallery" alt="img">
                    </a>
                  </div>
                  <div class="xzoom-gallery-box">
                    <a href="assets/images/product/main-img-03.png">
                      <img class="xzoom-gallery" width="80" src="assets/images/product/main-img-03.png"
                        data-fancybox="gallery" alt="img">
                    </a>
                  </div>
                  <div class="xzoom-gallery-box">
                    <a href="assets/images/product/main-img-04.png">
                      <img class="xzoom-gallery" width="80" src="assets/images/product/main-img-04.png"
                        data-fancybox="gallery" alt="img">
                    </a>
                  </div>
                  <div class="xzoom-gallery-box">
                    <a href="assets/images/product/main-img-02.png">
                      <img class="xzoom-gallery" width="80" src="assets/images/product/main-img-02.png"
                        data-fancybox="gallery" alt="img">
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xxl-6 col-lg-6">
              <div class="product-details-content">
                <div class="first-section">
                  <div class="category-name">
                    <p class="pera"><span class="highlight">Category: </span>Furniture, Armchairs</p>
                  </div>
                  <h4 class="product-name">Bracelet Armchair Fendi Casa</h4>
                  <div class="product-price-section">
                    <div class="price-section">
                      <h4 class="price discounted">$800</h4>
                      <h4 class="price">$600</h4>
                    </div>
                    <div class="ratting-section">
                      <div class="all-ratting">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                          <path
                            d="M14 5.39116V5.70526C13.9143 5.90196 13.7892 6.07722 13.6332 6.21924C12.687 7.07588 11.7485 7.94194 10.8032 8.80001C10.7159 8.87939 10.6937 8.94735 10.7189 9.06471C11.0086 10.3759 11.2933 11.6883 11.5789 13.0004C11.6132 13.139 11.6138 13.2843 11.5808 13.4233C11.4492 13.9298 10.9112 14.1514 10.4678 13.8761C9.3554 13.1846 8.2441 12.4897 7.1339 11.7917C7.03433 11.7291 6.9643 11.7311 6.86583 11.7917C5.75982 12.4865 4.65208 13.1783 3.5426 13.867C3.25238 14.0475 2.96079 14.0509 2.68807 13.8365C2.41945 13.6252 2.34806 13.3339 2.42082 12.9981C2.70776 11.6792 2.99416 10.3571 3.28493 9.03729C3.30736 8.93593 3.28493 8.88281 3.21655 8.82056C2.43751 8.1107 1.65382 7.40569 0.885446 6.6844C0.566226 6.38458 0.170415 6.15328 0 5.70526V5.36261L0.0202418 5.33405H0V5.27694C0.00481165 5.28329 0.0100202 5.2893 0.0155917 5.29493C0.0265333 5.28722 0.0410307 5.27951 0.0454074 5.26809C0.187921 4.87918 0.489361 4.76125 0.854809 4.73469C1.30861 4.70157 1.76159 4.65645 2.21457 4.61391C2.99826 4.54024 3.78168 4.46257 4.56564 4.39232C4.67314 4.3829 4.73277 4.34806 4.77681 4.23927C5.27739 3.00514 5.78371 1.77387 6.28702 0.540886C6.34173 0.408107 6.40628 0.283895 6.51242 0.189951C6.90741 -0.164411 7.49907 -0.00850327 7.71599 0.537174C8.20836 1.77473 8.72179 3.00286 9.22237 4.2367C9.26586 4.3435 9.32221 4.38433 9.4319 4.39261C9.88543 4.42688 10.3387 4.46971 10.7917 4.51225C11.5758 4.58592 12.3594 4.66074 13.1425 4.73669C13.314 4.75354 13.4857 4.76782 13.6406 4.86405C13.8364 4.9854 13.9275 5.18043 14 5.39116Z"
                            fill="#FCC013" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                          <path
                            d="M14 5.39116V5.70526C13.9143 5.90196 13.7892 6.07722 13.6332 6.21924C12.687 7.07588 11.7485 7.94194 10.8032 8.80001C10.7159 8.87939 10.6937 8.94735 10.7189 9.06471C11.0086 10.3759 11.2933 11.6883 11.5789 13.0004C11.6132 13.139 11.6138 13.2843 11.5808 13.4233C11.4492 13.9298 10.9112 14.1514 10.4678 13.8761C9.3554 13.1846 8.2441 12.4897 7.1339 11.7917C7.03433 11.7291 6.9643 11.7311 6.86583 11.7917C5.75982 12.4865 4.65208 13.1783 3.5426 13.867C3.25238 14.0475 2.96079 14.0509 2.68807 13.8365C2.41945 13.6252 2.34806 13.3339 2.42082 12.9981C2.70776 11.6792 2.99416 10.3571 3.28493 9.03729C3.30736 8.93593 3.28493 8.88281 3.21655 8.82056C2.43751 8.1107 1.65382 7.40569 0.885446 6.6844C0.566226 6.38458 0.170415 6.15328 0 5.70526V5.36261L0.0202418 5.33405H0V5.27694C0.00481165 5.28329 0.0100202 5.2893 0.0155917 5.29493C0.0265333 5.28722 0.0410307 5.27951 0.0454074 5.26809C0.187921 4.87918 0.489361 4.76125 0.854809 4.73469C1.30861 4.70157 1.76159 4.65645 2.21457 4.61391C2.99826 4.54024 3.78168 4.46257 4.56564 4.39232C4.67314 4.3829 4.73277 4.34806 4.77681 4.23927C5.27739 3.00514 5.78371 1.77387 6.28702 0.540886C6.34173 0.408107 6.40628 0.283895 6.51242 0.189951C6.90741 -0.164411 7.49907 -0.00850327 7.71599 0.537174C8.20836 1.77473 8.72179 3.00286 9.22237 4.2367C9.26586 4.3435 9.32221 4.38433 9.4319 4.39261C9.88543 4.42688 10.3387 4.46971 10.7917 4.51225C11.5758 4.58592 12.3594 4.66074 13.1425 4.73669C13.314 4.75354 13.4857 4.76782 13.6406 4.86405C13.8364 4.9854 13.9275 5.18043 14 5.39116Z"
                            fill="#FCC013" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                          <path
                            d="M14 5.39116V5.70526C13.9143 5.90196 13.7892 6.07722 13.6332 6.21924C12.687 7.07588 11.7485 7.94194 10.8032 8.80001C10.7159 8.87939 10.6937 8.94735 10.7189 9.06471C11.0086 10.3759 11.2933 11.6883 11.5789 13.0004C11.6132 13.139 11.6138 13.2843 11.5808 13.4233C11.4492 13.9298 10.9112 14.1514 10.4678 13.8761C9.3554 13.1846 8.2441 12.4897 7.1339 11.7917C7.03433 11.7291 6.9643 11.7311 6.86583 11.7917C5.75982 12.4865 4.65208 13.1783 3.5426 13.867C3.25238 14.0475 2.96079 14.0509 2.68807 13.8365C2.41945 13.6252 2.34806 13.3339 2.42082 12.9981C2.70776 11.6792 2.99416 10.3571 3.28493 9.03729C3.30736 8.93593 3.28493 8.88281 3.21655 8.82056C2.43751 8.1107 1.65382 7.40569 0.885446 6.6844C0.566226 6.38458 0.170415 6.15328 0 5.70526V5.36261L0.0202418 5.33405H0V5.27694C0.00481165 5.28329 0.0100202 5.2893 0.0155917 5.29493C0.0265333 5.28722 0.0410307 5.27951 0.0454074 5.26809C0.187921 4.87918 0.489361 4.76125 0.854809 4.73469C1.30861 4.70157 1.76159 4.65645 2.21457 4.61391C2.99826 4.54024 3.78168 4.46257 4.56564 4.39232C4.67314 4.3829 4.73277 4.34806 4.77681 4.23927C5.27739 3.00514 5.78371 1.77387 6.28702 0.540886C6.34173 0.408107 6.40628 0.283895 6.51242 0.189951C6.90741 -0.164411 7.49907 -0.00850327 7.71599 0.537174C8.20836 1.77473 8.72179 3.00286 9.22237 4.2367C9.26586 4.3435 9.32221 4.38433 9.4319 4.39261C9.88543 4.42688 10.3387 4.46971 10.7917 4.51225C11.5758 4.58592 12.3594 4.66074 13.1425 4.73669C13.314 4.75354 13.4857 4.76782 13.6406 4.86405C13.8364 4.9854 13.9275 5.18043 14 5.39116Z"
                            fill="#FCC013" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                          <path
                            d="M14 5.39116V5.70526C13.9143 5.90196 13.7892 6.07722 13.6332 6.21924C12.687 7.07588 11.7485 7.94194 10.8032 8.80001C10.7159 8.87939 10.6937 8.94735 10.7189 9.06471C11.0086 10.3759 11.2933 11.6883 11.5789 13.0004C11.6132 13.139 11.6138 13.2843 11.5808 13.4233C11.4492 13.9298 10.9112 14.1514 10.4678 13.8761C9.3554 13.1846 8.2441 12.4897 7.1339 11.7917C7.03433 11.7291 6.9643 11.7311 6.86583 11.7917C5.75982 12.4865 4.65208 13.1783 3.5426 13.867C3.25238 14.0475 2.96079 14.0509 2.68807 13.8365C2.41945 13.6252 2.34806 13.3339 2.42082 12.9981C2.70776 11.6792 2.99416 10.3571 3.28493 9.03729C3.30736 8.93593 3.28493 8.88281 3.21655 8.82056C2.43751 8.1107 1.65382 7.40569 0.885446 6.6844C0.566226 6.38458 0.170415 6.15328 0 5.70526V5.36261L0.0202418 5.33405H0V5.27694C0.00481165 5.28329 0.0100202 5.2893 0.0155917 5.29493C0.0265333 5.28722 0.0410307 5.27951 0.0454074 5.26809C0.187921 4.87918 0.489361 4.76125 0.854809 4.73469C1.30861 4.70157 1.76159 4.65645 2.21457 4.61391C2.99826 4.54024 3.78168 4.46257 4.56564 4.39232C4.67314 4.3829 4.73277 4.34806 4.77681 4.23927C5.27739 3.00514 5.78371 1.77387 6.28702 0.540886C6.34173 0.408107 6.40628 0.283895 6.51242 0.189951C6.90741 -0.164411 7.49907 -0.00850327 7.71599 0.537174C8.20836 1.77473 8.72179 3.00286 9.22237 4.2367C9.26586 4.3435 9.32221 4.38433 9.4319 4.39261C9.88543 4.42688 10.3387 4.46971 10.7917 4.51225C11.5758 4.58592 12.3594 4.66074 13.1425 4.73669C13.314 4.75354 13.4857 4.76782 13.6406 4.86405C13.8364 4.9854 13.9275 5.18043 14 5.39116Z"
                            fill="#FCC013" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                          <path
                            d="M14 5.39116V5.70526C13.9143 5.90196 13.7892 6.07722 13.6332 6.21924C12.687 7.07588 11.7485 7.94194 10.8032 8.80001C10.7159 8.87939 10.6937 8.94735 10.7189 9.06471C11.0086 10.3759 11.2933 11.6883 11.5789 13.0004C11.6132 13.139 11.6138 13.2843 11.5808 13.4233C11.4492 13.9298 10.9112 14.1514 10.4678 13.8761C9.3554 13.1846 8.2441 12.4897 7.1339 11.7917C7.03433 11.7291 6.9643 11.7311 6.86583 11.7917C5.75982 12.4865 4.65208 13.1783 3.5426 13.867C3.25238 14.0475 2.96079 14.0509 2.68807 13.8365C2.41945 13.6252 2.34806 13.3339 2.42082 12.9981C2.70776 11.6792 2.99416 10.3571 3.28493 9.03729C3.30736 8.93593 3.28493 8.88281 3.21655 8.82056C2.43751 8.1107 1.65382 7.40569 0.885446 6.6844C0.566226 6.38458 0.170415 6.15328 0 5.70526V5.36261L0.0202418 5.33405H0V5.27694C0.00481165 5.28329 0.0100202 5.2893 0.0155917 5.29493C0.0265333 5.28722 0.0410307 5.27951 0.0454074 5.26809C0.187921 4.87918 0.489361 4.76125 0.854809 4.73469C1.30861 4.70157 1.76159 4.65645 2.21457 4.61391C2.99826 4.54024 3.78168 4.46257 4.56564 4.39232C4.67314 4.3829 4.73277 4.34806 4.77681 4.23927C5.27739 3.00514 5.78371 1.77387 6.28702 0.540886C6.34173 0.408107 6.40628 0.283895 6.51242 0.189951C6.90741 -0.164411 7.49907 -0.00850327 7.71599 0.537174C8.20836 1.77473 8.72179 3.00286 9.22237 4.2367C9.26586 4.3435 9.32221 4.38433 9.4319 4.39261C9.88543 4.42688 10.3387 4.46971 10.7917 4.51225C11.5758 4.58592 12.3594 4.66074 13.1425 4.73669C13.314 4.75354 13.4857 4.76782 13.6406 4.86405C13.8364 4.9854 13.9275 5.18043 14 5.39116Z"
                            fill="#FCC013" />
                        </svg>
                      </div>
                      <div class="ratting-count">
                        <p class="pera">6 Reviews</p>
                      </div>
                    </div>
                  </div>
                  <div class="stock-section">
                    <p class="stock-count highlight">45 In stock</p>
                    <p class="stock-count">( Sold 21 Products in last
                      10 Hours )</p>
                  </div>
                  <div class="divider"></div>
                </div>
                <div class="second-section">
                  <div class="product-desc">
                    <p class="desc">There are many variations of passages of Lorem Ipsum available but
                      the majority our
                      have
                      suffered alteration in some form, by injected humour, or randomised words which
                      don't kia
                      look even slightly believable. If you are going to use</p>
                    <div class="color-palatte">
                      <h4 class="title">Color:</h4>
                      <div class="color-section">
                        <div class="color-checkbox">
                          <input class="check-color" type="checkbox" id="checkbox1">
                          <div></div>
                        </div>
                        <div class="color-checkbox">
                          <input class="check-color" type="checkbox" id="checkbox2">
                          <div></div>
                        </div>
                        <div class="color-checkbox">
                          <input class="check-color" type="checkbox" id="checkbox3">
                          <div></div>
                        </div>
                        <div class="color-checkbox">
                          <input class="check-color" type="checkbox" id="checkbox4">
                          <div></div>
                        </div>
                      </div>
                    </div>
                    <div class="d-flex gap-16 flex-wrap">
                      <div class="wish-list">
                        <i class="ri-heart-line"></i>
                        <a href="javascript:void(0)">
                          <p class="pera">add to wishlist</p>
                        </a>
                      </div>
                      <div class="compare-section">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="16" viewBox="0 0 14 16" fill="none">
                          <path
                            d="M5.68489 2.89048V2.60747C5.27851 2.68422 4.69545 2.88428 4.27377 3.0951C3.42519 3.52224 2.64932 4.21893 2.14045 5.01332C1.73332 5.65236 1.46158 6.38236 1.34546 7.15539C1.2922 7.51719 1.29209 8.28523 1.34556 8.66821C1.49543 9.70853 1.95921 10.6989 2.68404 11.5115C3.06646 11.9393 3.63064 12.3922 4.05911 12.6162L4.05911 12.6162L4.05984 12.6166C4.10481 12.6406 4.14674 12.6649 4.17819 12.685C4.19363 12.6948 4.20821 12.7047 4.21977 12.7136C4.22523 12.7178 4.23252 12.7237 4.23935 12.7307C4.24262 12.734 4.24822 12.74 4.25365 12.7482L4.25367 12.7482C4.25702 12.7532 4.27126 12.7746 4.27126 12.8057C4.27126 12.8331 4.25987 12.8528 4.25748 12.8569L4.25731 12.8572C4.25325 12.8642 4.24909 12.8695 4.24675 12.8724C4.24183 12.8785 4.23664 12.8837 4.23291 12.8874C4.22497 12.8952 4.21485 12.9042 4.20395 12.9135C4.18171 12.9325 4.15053 12.9577 4.11332 12.9871C4.03861 13.0462 3.93634 13.1245 3.82513 13.2083L3.82506 13.2083L3.41877 13.5138L3.36362 13.5552L3.30528 13.5184L3.14104 13.4147L3.14103 13.4147L3.14057 13.4144C1.71186 12.5009 0.632698 10.9422 0.284252 9.27917C0.146554 8.62869 0.108497 7.66044 0.199513 7.02015C0.58578 4.2291 2.66049 2.0318 5.43878 1.47C5.51861 1.45259 5.59402 1.43736 5.65075 1.42645C5.65992 1.42469 5.66863 1.42303 5.67681 1.42149C5.67777 1.40372 5.67869 1.38288 5.67955 1.35929C5.68274 1.27179 5.68489 1.15057 5.68489 1.01751C5.68489 0.881526 5.68633 0.758046 5.68889 0.668166C5.69017 0.623445 5.69174 0.585932 5.69365 0.559033C5.69457 0.546001 5.69573 0.533198 5.69732 0.522653C5.69801 0.518088 5.69939 0.509624 5.70218 0.500607C5.70335 0.496827 5.70665 0.486557 5.71372 0.475251L5.71378 0.47516C5.7172 0.469683 5.74349 0.427656 5.7993 0.427656C5.81801 0.427656 5.83234 0.433104 5.83518 0.434184L5.83544 0.434285C5.84054 0.436197 5.8446 0.43817 5.84689 0.439319C5.85163 0.441708 5.85594 0.444242 5.85894 0.446066C5.86531 0.449928 5.87279 0.454841 5.8806 0.460123C5.89655 0.470905 5.91827 0.486203 5.94448 0.505008C5.99712 0.542767 6.07032 0.596447 6.15688 0.660582C6.33013 0.788941 6.55824 0.960155 6.7853 1.13189C7.01236 1.30363 7.23865 1.4761 7.40828 1.60698C7.49304 1.67237 7.56396 1.72762 7.61384 1.76727C7.63867 1.78702 7.65888 1.80337 7.67314 1.81536C7.6801 1.8212 7.68669 1.82689 7.69198 1.83181C7.69439 1.83405 7.6982 1.83767 7.70201 1.8419C7.70373 1.84381 7.70746 1.84803 7.71136 1.85375C7.71329 1.85658 7.71667 1.86182 7.71989 1.86885C7.7224 1.87435 7.72904 1.88977 7.72904 1.91077C7.72904 1.93177 7.7224 1.94719 7.71989 1.95269C7.71667 1.95972 7.71329 1.96496 7.71136 1.96779C7.70746 1.97351 7.70373 1.97773 7.70201 1.97964C7.6982 1.98387 7.69439 1.98749 7.69198 1.98973C7.68669 1.99465 7.6801 2.00034 7.67314 2.00618C7.65888 2.01817 7.63867 2.03452 7.61384 2.05427C7.56396 2.09393 7.49304 2.14917 7.40828 2.21457C7.23865 2.34544 7.01236 2.51791 6.7853 2.68965C6.55824 2.86139 6.33013 3.0326 6.15688 3.16096C6.07032 3.22509 5.99712 3.27877 5.94448 3.31653C5.91827 3.33534 5.89655 3.35064 5.8806 3.36142C5.87279 3.3667 5.86531 3.37161 5.85894 3.37547C5.85803 3.37603 5.857 3.37665 5.85587 3.37731C5.85328 3.37882 5.85019 3.38056 5.84689 3.38222C5.8446 3.38337 5.84054 3.38534 5.83544 3.38726C5.83338 3.38803 5.8187 3.39388 5.7993 3.39388C5.7519 3.39388 5.72573 3.36294 5.71869 3.35361C5.70993 3.34202 5.70566 3.33113 5.70404 3.32679C5.70036 3.31696 5.69861 3.30793 5.69782 3.3036C5.69596 3.2934 5.69471 3.28163 5.69376 3.27059C5.69179 3.24754 5.69019 3.2159 5.68891 3.17883C5.68634 3.10417 5.68489 3.00209 5.68489 2.89048ZM5.7676 1.40736C5.76348 1.40736 5.75953 1.40759 5.75574 1.40802C5.75951 1.40765 5.76368 1.40736 5.7676 1.40736Z"
                            fill="#AD8C5C" stroke="#AD8C5C" stroke-width="0.2" />
                          <path
                            d="M9.59004 2.60027L9.59012 2.60021L9.9964 2.29478L10.0516 2.25331L10.1099 2.29016L10.2741 2.39389L10.2746 2.39419C11.7033 3.30762 12.7825 4.86632 13.1309 6.52931C13.2658 7.16263 13.3038 8.13066 13.2186 8.75326C12.8939 11.1639 11.3309 13.1421 9.04999 14.0341C8.92022 14.0853 8.66396 14.1622 8.4103 14.2309C8.15631 14.2997 7.89538 14.363 7.7557 14.3855L7.75538 14.3855L7.73028 14.3895V14.791C7.73028 14.927 7.72884 15.0505 7.72628 15.1404C7.72501 15.1851 7.72343 15.2226 7.72152 15.2495C7.7206 15.2625 7.71945 15.2753 7.71785 15.2859C7.71716 15.2905 7.71578 15.2989 7.71299 15.3079C7.71182 15.3117 7.70853 15.322 7.70145 15.3333L7.7014 15.3334C7.69797 15.3389 7.67169 15.3809 7.61588 15.3809C7.59716 15.3809 7.58284 15.3754 7.58 15.3744C7.57989 15.3743 7.5798 15.3743 7.57973 15.3743C7.57464 15.3723 7.57057 15.3704 7.56829 15.3692C7.56354 15.3668 7.55924 15.3643 7.55623 15.3625C7.54986 15.3586 7.54239 15.3537 7.53457 15.3484C7.51862 15.3376 7.4969 15.3223 7.47069 15.3035C7.41806 15.2658 7.34486 15.2121 7.25829 15.148C7.08504 15.0196 6.85694 14.8484 6.62988 14.6766C6.40281 14.5049 6.17652 14.3324 6.00689 14.2016C5.92214 14.1362 5.85122 14.0809 5.80134 14.0413C5.7765 14.0215 5.75629 14.0052 5.74203 13.9932C5.73508 13.9873 5.72848 13.9817 5.72319 13.9767C5.72078 13.9745 5.71697 13.9709 5.71316 13.9666C5.71144 13.9647 5.70771 13.9605 5.70382 13.9548C5.70189 13.952 5.69851 13.9467 5.69529 13.9397C5.69277 13.9342 5.68613 13.9188 5.68613 13.8978C5.68613 13.8768 5.69277 13.8614 5.69529 13.8559C5.69851 13.8488 5.70189 13.8436 5.70382 13.8408C5.70771 13.835 5.71144 13.8308 5.71316 13.8289C5.71697 13.8247 5.72078 13.821 5.72319 13.8188C5.72848 13.8139 5.73508 13.8082 5.74203 13.8024C5.75629 13.7904 5.7765 13.774 5.80134 13.7543C5.85122 13.7146 5.92214 13.6594 6.00689 13.594C6.17652 13.4631 6.40281 13.2906 6.62988 13.1189C6.85694 12.9472 7.08504 12.7759 7.25829 12.6476C7.34486 12.5834 7.41806 12.5298 7.47069 12.492C7.4969 12.4732 7.51862 12.4579 7.53457 12.4471C7.54239 12.4418 7.54986 12.4369 7.55623 12.4331C7.55924 12.4312 7.56354 12.4287 7.56829 12.4263C7.57057 12.4252 7.57464 12.4232 7.57973 12.4213L7.58 12.4212C7.58284 12.4201 7.59716 12.4147 7.61588 12.4147C7.66327 12.4147 7.68945 12.4456 7.69649 12.4549C7.70524 12.4665 7.70952 12.4774 7.71114 12.4817C7.71481 12.4916 7.71656 12.5006 7.71735 12.5049C7.71921 12.5151 7.72046 12.5269 7.72141 12.5379C7.72339 12.561 7.72498 12.5926 7.72626 12.6297C7.72884 12.7044 7.73028 12.8065 7.73028 12.9181C7.73028 13.0621 7.73197 13.153 7.73597 13.2095C7.7531 13.2058 7.77258 13.2014 7.7941 13.1963C7.86528 13.1794 7.95583 13.1559 8.0515 13.1296C8.24363 13.0768 8.45118 13.0144 8.56091 12.9741C10.3384 12.3117 11.6255 10.8207 12.016 8.97C12.1059 8.5432 12.1401 7.72721 12.0837 7.25631L12.0837 7.25567C12.016 6.65765 11.7721 5.88632 11.4844 5.35883L11.4843 5.35869C11.006 4.4786 10.2328 3.6859 9.40573 3.2171C9.35408 3.18903 9.30559 3.16071 9.26825 3.13709C9.24962 3.1253 9.23269 3.114 9.21915 3.10405C9.21247 3.09913 9.20543 3.09368 9.19901 3.08803L9.19887 3.08791C9.19516 3.08464 9.18449 3.07525 9.17537 3.06162C9.15647 3.03369 9.15688 3.00498 9.15912 2.98974C9.16142 2.97407 9.16685 2.96239 9.16968 2.9568C9.17558 2.94517 9.1827 2.93621 9.18642 2.9317C9.19491 2.9214 9.20564 2.91068 9.21591 2.90094C9.23736 2.88061 9.26785 2.85426 9.30403 2.82429C9.37692 2.76392 9.47835 2.6844 9.59004 2.60027Z"
                            fill="#AD8C5C" stroke="#AD8C5C" stroke-width="0.2" />
                        </svg>
                        <a href="javascript:void(0)">
                          <p class="pera">Compare</p>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="divider"></div>
                </div>
                <div class="third-section">
                  <div class="row g-4">
                    <div class="col-md-3">
                      <h4 class="label">Quantity</h4>
                    </div>
                    <div class="col-md-9">
                      <div class="quantity-section">
                        <div class="quantity-btn position-relative">
                          <input type="text" name="qty" value="01" class="num-count">

                          <button class="increase-num">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="6" viewBox="0 0 12 6"
                              fill="none">
                              <path
                                d="M0 5.36618C0.0532405 5.553 0.143084 5.71647 0.319443 5.84199C0.618921 6.04924 1.0515 6.05508 1.35098 5.84491C1.40755 5.80404 1.46411 5.76026 1.51735 5.71355C2.97481 4.43501 4.4356 3.15355 5.89306 1.875C5.92633 1.84581 5.95295 1.81078 6.03281 1.75824C6.0561 1.79327 6.06941 1.83705 6.10269 1.86625C7.57346 3.15938 9.04755 4.4496 10.5183 5.74274C10.7779 5.97043 11.0773 6.058 11.4367 5.95875C11.9591 5.8128 12.1721 5.22315 11.8427 4.83784C11.8061 4.79405 11.7628 4.75318 11.7196 4.71232C10.0225 3.2236 8.32881 1.73489 6.63177 0.249093C6.32231 -0.0223789 5.92966 -0.0749219 5.57361 0.106059C5.4871 0.149845 5.41056 0.214063 5.34069 0.275363C3.69356 1.72029 2.04976 3.16522 0.399304 4.60723C0.216289 4.76778 0.0532405 4.93125 0 5.16185C0 5.22899 0 5.29613 0 5.36618Z"
                                fill="currentColor" />
                            </svg>
                          </button>
                          <button class="decrease-num">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="6" viewBox="0 0 12 6"
                              fill="none">
                              <path
                                d="M12 0.633816C11.9468 0.446997 11.8569 0.28353 11.6806 0.158011C11.3811 -0.0492418 10.9485 -0.0550799 10.649 0.155092C10.5925 0.195958 10.5359 0.239744 10.4826 0.286449C9.02519 1.56499 7.5644 2.84645 6.10694 4.125C6.07367 4.15419 6.04705 4.18922 5.96719 4.24176C5.9439 4.20673 5.93059 4.16294 5.89731 4.13375C4.42654 2.84062 2.95245 1.5504 1.48168 0.257257C1.22213 0.0295717 0.922652 -0.0579998 0.563279 0.0412478C0.0408569 0.1872 -0.172105 0.776848 0.157321 1.16216C0.193924 1.20595 0.237181 1.24681 0.280439 1.28768C1.97748 2.7764 3.67119 4.26511 5.36823 5.75091C5.67769 6.02238 6.07034 6.07492 6.42639 5.89394C6.5129 5.85015 6.58944 5.78594 6.65931 5.72464C8.30644 4.27971 9.95024 2.83478 11.6007 1.39277C11.7837 1.23222 11.9468 1.06875 12 0.838149C12 0.771011 12 0.703873 12 0.633816Z"
                                fill="currentColor" />
                            </svg>
                          </button>
                        </div>
                        <a href="javascript:void(0)" class=" cart-btn">Add to Cart</a>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <h4 class="label">Size</h4>
                    </div>
                    <div class="col-md-9">
                      <div class="size-dropdown">
                        <select name="size" class="select2">
                          <option value="1">30 Fit by 12 Fit</option>
                          <option value="2">20 Fit by 10 Fit</option>
                          <option value="3">10 Fit by 08 Fit</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <h4 class="label">SKU</h4>
                    </div>
                    <div class="col-md-9">
                      <p class="info">KE-91039</p>
                    </div>
                    <div class="col-md-3">
                      <h4 class="label">Tags</h4>
                    </div>
                    <div class="col-md-9">
                      <p class="info mb-19">Chairs, Sofa, Single Sofa</p>
                      <p class="info highlighter d-flex align-items-center"><svg class="mr-10"
                          xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 14 15" fill="none">
                          <path
                            d="M0.0114032 0C0.306313 0 0.601223 0 0.896132 0C0.900064 0.141012 0.910681 0.282415 0.905569 0.423426C0.900458 0.55897 0.94843 0.569907 1.06167 0.521471C1.39119 0.380068 1.73171 0.270305 2.0797 0.182417C2.46623 0.0847634 2.86023 0.0402333 3.25541 0C3.46185 0 3.66828 0 3.87472 0C4.17631 0.0359366 4.47909 0.0613265 4.77793 0.121872C5.56121 0.280852 6.28118 0.593344 6.97835 0.974975C8.5048 1.81011 10.0902 1.96479 11.7331 1.33981C12.2218 1.15388 12.6701 0.890211 13.1215 0.632796C13.2788 0.543345 13.293 0.551158 13.293 0.725372C13.2933 3.61006 13.2926 6.49475 13.2949 9.37944C13.2949 9.48569 13.2587 9.54858 13.1659 9.60092C12.7633 9.82748 12.3508 10.0314 11.9151 10.1884C11.0056 10.5161 10.0706 10.6525 9.10642 10.5482C8.14973 10.4447 7.26225 10.1306 6.42864 9.65951C5.52818 9.15054 4.56677 8.85289 3.52397 8.86032C2.66009 8.86657 1.84574 9.08687 1.06915 9.45835C0.942925 9.5185 0.903997 9.59428 0.90439 9.72943C0.908715 11.4134 0.907142 13.0973 0.906749 14.7813C0.906749 14.8543 0.899671 14.927 0.895739 15C0.600829 15 0.30592 15 0.01101 15C0.00707783 14.932 0 14.8641 0 14.7961C0 9.93177 0 5.06784 0.000393213 0.203901C0.000393213 0.135934 0.00747105 0.067967 0.0114032 0Z"
                            fill="#FD0202" />
                        </svg> Report This Item</p>
                    </div>
                    <div class="col-md-3">
                      <h4 class="label">Share</h4>
                    </div>
                    <div class="col-md-9">
                      <div class="all-social-icon">
                        <a href="javascript:void(0)" class="social-icon">
                          <svg xmlns="http://www.w3.org/2000/svg" width="10" height="16" viewBox="0 0 10 16"
                            fill="none">
                            <path
                              d="M3 15.9761V8.98656H0V5.99104H3V3.99403C3 1.29806 4.7 0 7.1 0C8.3 0 9.2 0.0998507 9.5 0.0998507V2.89567H7.8C6.5 2.89567 6.2 3.49477 6.2 4.39343V5.99104H10L9 8.98656H6.3V15.9761H3Z"
                              fill="#3E75B2" />
                          </svg>
                        </a>
                        <a href="javascript:void(0)" class="social-icon">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                            fill="none">
                            <path
                              d="M8 0C3.6 0 0 3.59463 0 7.98806C0 11.383 2.1 14.2787 5.1 15.377C5 14.7779 5 13.7794 5.1 13.0804C5.2 12.4813 6 9.08641 6 9.08641C6 9.08641 5.8 8.68701 5.8 7.98806C5.8 6.8897 6.5 5.99104 7.3 5.99104C8 5.99104 8.3 6.4903 8.3 7.0894C8.3 7.78835 7.9 8.78686 7.6 9.78537C7.4 10.5842 8 11.1833 8.8 11.1833C10.2 11.1833 11.3 9.68552 11.3 7.4888C11.3 5.59164 9.9 4.19373 8 4.19373C5.7 4.19373 4.4 5.89119 4.4 7.6885C4.4 8.38746 4.7 9.08641 5 9.48582C5 9.68552 5 9.78537 5 9.88522C4.9 10.1848 4.8 10.684 4.8 10.7839C4.8 10.8837 4.7 10.9836 4.5 10.8837C3.5 10.3845 2.9 8.98656 2.9 7.78835C2.9 5.29209 4.7 2.99552 8.2 2.99552C11 2.99552 13.1 4.99254 13.1 7.58865C13.1 10.3845 11.4 12.5812 8.9 12.5812C8.1 12.5812 7.3 12.1818 7.1 11.6825C7.1 11.6825 6.7 13.1803 6.6 13.5797C6.4 14.2787 5.9 15.1773 5.6 15.6766C6.4 15.8763 7.2 15.9761 8 15.9761C12.4 15.9761 16 12.3815 16 7.98806C16 3.59463 12.4 0 8 0Z"
                              fill="#E12828" />
                          </svg>
                        </a>
                        <a href="javascript:void(0)" class="social-icon">
                          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14"
                            fill="none">
                            <path
                              d="M17.0722 1.59813C16.432 1.88224 15.7562 2.05981 15.0448 2.16635C15.7562 1.74018 16.3253 1.06542 16.5742 0.248597C15.8985 0.639251 15.1515 0.923362 14.3335 1.10093C13.6933 0.426167 12.7686 0 11.7727 0C9.85206 0 8.28711 1.56261 8.28711 3.48036C8.28711 3.76447 8.32268 4.01307 8.39382 4.26167C5.51289 4.11961 2.9165 2.73457 1.17371 0.603737C0.889175 1.13645 0.71134 1.70467 0.71134 2.34392C0.71134 3.55139 1.31598 4.61681 2.27629 5.25606C1.70722 5.22055 1.17371 5.07849 0.675773 4.82989V4.86541C0.675773 6.57007 1.88505 7.99063 3.48557 8.31026C3.20103 8.38128 2.88093 8.4168 2.56082 8.4168C2.34742 8.4168 2.09845 8.38128 1.88505 8.34577C2.34742 9.73081 3.62784 10.7607 5.15722 10.7607C3.94794 11.6841 2.45412 12.2523 0.818041 12.2523C0.533505 12.2523 0.248969 12.2523 0 12.2168C1.56495 13.2112 3.37887 13.7794 5.37062 13.7794C11.8082 13.7794 15.3294 8.45231 15.3294 3.8355C15.3294 3.69345 15.3294 3.51588 15.3294 3.37382C16.0052 2.91214 16.6098 2.3084 17.0722 1.59813Z"
                              fill="#3FD1FF" />
                          </svg>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End-of product area-->

      <!-- More details area S t a r t -->
      <div class="more-details-area">
        <div class="container">
          <div class="more-details-section">
            <div class="row g-4">
              <div class="col-xl-5">

                <div class="all-outline-btn">
                  <ul class="nav all-outline-btn" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link outline-pill-btn active" id="pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                        aria-selected="true">

                        Description
                        <svg xmlns="http://www.w3.org/2000/svg" width="78" height="19" viewBox="0 0 78 19" fill="none">
                          <path
                            d="M66.918 10.9147C66.8987 10.9909 66.8754 11.0659 66.8482 11.1394C66.3343 12.5191 65.8568 13.9149 65.3832 15.3094C65.2835 15.6007 65.0431 15.8908 65.3278 16.3278C68.9295 13.4161 73.0932 11.4878 77.3487 9.65131C72.9717 7.73141 68.8104 5.59576 65.0804 2.61703C64.8556 3.06744 65.0978 3.36045 65.2072 3.6577C65.7259 5.06223 66.2433 6.47061 66.7965 7.85894C67.1854 8.84516 67.2283 9.92384 66.918 10.9147Z"
                            fill="currentColor" />
                          <rect y="8.90649" width="68" height="1" rx="0.5" fill="currentColor" />
                        </svg>

                      </button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link outline-pill-btn " id="pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                        aria-selected="false">

                        Additional information
                        <svg xmlns="http://www.w3.org/2000/svg" width="78" height="19" viewBox="0 0 78 19" fill="none">
                          <path
                            d="M66.918 10.9147C66.8987 10.9909 66.8754 11.0659 66.8482 11.1394C66.3343 12.5191 65.8568 13.9149 65.3832 15.3094C65.2835 15.6007 65.0431 15.8908 65.3278 16.3278C68.9295 13.4161 73.0932 11.4878 77.3487 9.65131C72.9717 7.73141 68.8104 5.59576 65.0804 2.61703C64.8556 3.06744 65.0978 3.36045 65.2072 3.6577C65.7259 5.06223 66.2433 6.47061 66.7965 7.85894C67.1854 8.84516 67.2283 9.92384 66.918 10.9147Z"
                            fill="currentColor" />
                          <rect y="8.90649" width="68" height="1" rx="0.5" fill="currentColor" />
                        </svg>

                      </button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link outline-pill-btn " id="pills-contact-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                        aria-selected="false">

                        Reviews 03
                        <svg xmlns="http://www.w3.org/2000/svg" width="78" height="19" viewBox="0 0 78 19" fill="none">
                          <path
                            d="M66.918 10.9147C66.8987 10.9909 66.8754 11.0659 66.8482 11.1394C66.3343 12.5191 65.8568 13.9149 65.3832 15.3094C65.2835 15.6007 65.0431 15.8908 65.3278 16.3278C68.9295 13.4161 73.0932 11.4878 77.3487 9.65131C72.9717 7.73141 68.8104 5.59576 65.0804 2.61703C64.8556 3.06744 65.0978 3.36045 65.2072 3.6577C65.7259 5.06223 66.2433 6.47061 66.7965 7.85894C67.1854 8.84516 67.2283 9.92384 66.918 10.9147Z"
                            fill="currentColor" />
                          <rect y="8.90649" width="68" height="1" rx="0.5" fill="currentColor" />
                        </svg>

                      </button>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-xl-7">

                <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                    aria-labelledby="pills-home-tab">

                    <!-- Tab Content -->
                    <div class="addition-desc">
                      <p class="pera">
                        Curabitur egestas malesuada volutpat. Nunc vel vestibulum odio, ac pellentesque
                        lacus. Pellentesque dapibus nunc nec est as
                        erdiet, a malesuada sem rutrum. Sed quam odio, porta a finibus quis, sagittis
                        aliquet leo. Nunc ornare asmetus urna, eu luctusi
                        velit placerat ut. Cras at porttitor lectus. Ut dapibus aliquam nibh, in imperdiet
                        libero tincidunt sit amet. Morbi sodales fermeni nibh nec facilisis. Morbi pharetra varius
                        velit, eget varius libero finibus quis. ut ornare.
                      </p>
                      <ul class="listings">
                        <li class="list">
                          <p class="points">Aenean auctor sem ac ex efficitur</p>
                        </li>
                        <li class="list">
                          <p class="points"> Non mattis odio bibendum</p>
                        </li>
                        <li class="list">
                          <p class="points"> Sed vitae enim at tortor finibus</p>
                        </li>
                        <li class="list">
                          <p class="points"> Integer facilisis eleifend vehicula</p>
                        </li>
                        <li class="list">
                          <p class="points"> In hac habitasse platea dictumst</p>
                        </li>
                      </ul>
                      <p class="pera">
                        Sed molestie orci sem, at semper est molestie ac. Suspendisse cursus feugiat erat,
                        eu posuere massa.
                        Nullam posuere nibh as
                        endisse at dui euismod, rhoncus eros non, imperdiet ipsum.
                      </p>
                    </div>
                    <!-- End Tab contents -->

                  </div>
                  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                    <!-- Tab Content -->
                    <div class="addition-desc">
                      <div class="table-responsive mb-20">
                        <table class="table custom-table table-striped">
                          <tbody>
                            <tr>
                              <th class="thead">HEIGHT</th>
                              <td class="tdata">Inches (34.6)</td>
                              <td class="tdata">CM (88)</td>
                            </tr>
                            <tr>
                              <th class="thead">WIDTH</th>
                              <td class="tdata">Inches (71.7 X 89.4)</td>
                              <td class="tdata">CM (182 X 227)</td>
                            </tr>
                            <tr>
                              <th class="thead">DEPTH</th>
                              <td class="tdata">Inches (35.8)</td>
                              <td class="tdata">CM (91)</td>
                            </tr>
                            <tr>
                              <th class="thead">INTERNAL</th>
                              <td class="tdata">Inches (57.1 X 68.1)</td>
                              <td class="tdata">CM (145 X 173)</td>
                            </tr>
                            <tr>
                              <th class="thead">COLOR</th>
                              <td colspan="2">
                                <div class="color-section">
                                  <div class="color-checkbox">
                                    <input class="check-color" type="checkbox" id="checkbox1">
                                    <div></div>
                                  </div>
                                  <div class="color-checkbox">
                                    <input class="check-color" type="checkbox" id="checkbox2">
                                    <div></div>
                                  </div>
                                  <div class="color-checkbox">
                                    <input class="check-color" type="checkbox" id="checkbox3">
                                    <div></div>
                                  </div>
                                  <div class="color-checkbox">
                                    <input class="check-color" type="checkbox" id="checkbox4">
                                    <div></div>
                                  </div>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <p class="pera">
                        Curabitur egestas malesuada volutpat. Nunc vel vestibulum odio, ac pellentesque
                        lacus. Pellentesque
                        dapibus nunc nec est as
                        erdiet, a malesuada sem rutrum. Sed quam odio, porta a finibus quis, sagittis
                        aliquet leo. Nunc ornare
                        asmetus urna, eu luctusi
                        velit placerat ut. Cras at porttitor lectus. Ut dapibus aliquam nibh, in imperdiet
                        libero tincidunt
                        sit
                        amet. Morbi sodales fermeni
                        nibh nec facilisis. Morbi pharetra varius velit, eget varius libero finibus quis. ut
                        ornare.
                      </p>
                      <ul class="listings">
                        <li class="list">
                          <p class="points">Aenean auctor sem ac ex efficitur</p>
                        </li>
                        <li class="list">
                          <p class="points"> Non mattis odio bibendum</p>
                        </li>
                        <li class="list">
                          <p class="points"> Sed vitae enim at tortor finibus</p>
                        </li>
                        <li class="list">
                          <p class="points"> Integer facilisis eleifend vehicula</p>
                        </li>
                        <li class="list">
                          <p class="points"> In hac habitasse platea dictumst</p>
                        </li>
                      </ul>
                      <p class="pera">
                        Sed molestie orci sem, at semper est molestie ac. Suspendisse cursus feugiat erat,
                        eu posuere massa.
                        Nullam posuere nibh as
                        endisse at dui euismod, rhoncus eros non, imperdiet ipsum.
                      </p>
                    </div>
                    <!-- End Tab contents -->

                  </div>
                  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">.

                    <!-- Tab Content -->
                    <div class="review-list">
                      <div class="review-card">
                        <div class="wrap-user">
                          <div class="user-img">
                            <img src="assets/images/product/user-1.png" alt="img">
                          </div>
                          <div class="wrap-info">
                            <div class="user-info">
                              <div class="name-ratting">
                                <div class="name-wrapper">
                                  <h4 class="name">Abubokkor Siddik</h4>
                                  <div class="ratting">
                                    <div class="all-ratting">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                          d="M14 5.39116V5.70526C13.9143 5.90196 13.7892 6.07722 13.6332 6.21924C12.687 7.07588 11.7485 7.94194 10.8032 8.80001C10.7159 8.87939 10.6937 8.94735 10.7189 9.06471C11.0086 10.3759 11.2933 11.6883 11.5789 13.0004C11.6132 13.139 11.6138 13.2843 11.5808 13.4233C11.4492 13.9298 10.9112 14.1514 10.4678 13.8761C9.3554 13.1846 8.2441 12.4897 7.1339 11.7917C7.03433 11.7291 6.9643 11.7311 6.86583 11.7917C5.75982 12.4865 4.65208 13.1783 3.5426 13.867C3.25238 14.0475 2.96079 14.0509 2.68807 13.8365C2.41945 13.6252 2.34806 13.3339 2.42082 12.9981C2.70776 11.6792 2.99416 10.3571 3.28493 9.03729C3.30736 8.93593 3.28493 8.88281 3.21655 8.82056C2.43751 8.1107 1.65382 7.40569 0.885446 6.6844C0.566226 6.38458 0.170415 6.15328 0 5.70526V5.36261L0.0202418 5.33405H0V5.27694C0.00481165 5.28329 0.0100202 5.2893 0.0155917 5.29493C0.0265333 5.28722 0.0410307 5.27951 0.0454074 5.26809C0.187921 4.87918 0.489361 4.76125 0.854809 4.73469C1.30861 4.70157 1.76159 4.65645 2.21457 4.61391C2.99826 4.54024 3.78168 4.46257 4.56564 4.39232C4.67314 4.3829 4.73277 4.34806 4.77681 4.23927C5.27739 3.00514 5.78371 1.77387 6.28702 0.540886C6.34173 0.408107 6.40628 0.283895 6.51242 0.189951C6.90741 -0.164411 7.49907 -0.00850327 7.71599 0.537174C8.20836 1.77473 8.72179 3.00286 9.22237 4.2367C9.26586 4.3435 9.32221 4.38433 9.4319 4.39261C9.88543 4.42688 10.3387 4.46971 10.7917 4.51225C11.5758 4.58592 12.3594 4.66074 13.1425 4.73669C13.314 4.75354 13.4857 4.76782 13.6406 4.86405C13.8364 4.9854 13.9275 5.18043 14 5.39116Z"
                                          fill="#FCC013" />
                                      </svg>
                                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                          d="M14 5.39116V5.70526C13.9143 5.90196 13.7892 6.07722 13.6332 6.21924C12.687 7.07588 11.7485 7.94194 10.8032 8.80001C10.7159 8.87939 10.6937 8.94735 10.7189 9.06471C11.0086 10.3759 11.2933 11.6883 11.5789 13.0004C11.6132 13.139 11.6138 13.2843 11.5808 13.4233C11.4492 13.9298 10.9112 14.1514 10.4678 13.8761C9.3554 13.1846 8.2441 12.4897 7.1339 11.7917C7.03433 11.7291 6.9643 11.7311 6.86583 11.7917C5.75982 12.4865 4.65208 13.1783 3.5426 13.867C3.25238 14.0475 2.96079 14.0509 2.68807 13.8365C2.41945 13.6252 2.34806 13.3339 2.42082 12.9981C2.70776 11.6792 2.99416 10.3571 3.28493 9.03729C3.30736 8.93593 3.28493 8.88281 3.21655 8.82056C2.43751 8.1107 1.65382 7.40569 0.885446 6.6844C0.566226 6.38458 0.170415 6.15328 0 5.70526V5.36261L0.0202418 5.33405H0V5.27694C0.00481165 5.28329 0.0100202 5.2893 0.0155917 5.29493C0.0265333 5.28722 0.0410307 5.27951 0.0454074 5.26809C0.187921 4.87918 0.489361 4.76125 0.854809 4.73469C1.30861 4.70157 1.76159 4.65645 2.21457 4.61391C2.99826 4.54024 3.78168 4.46257 4.56564 4.39232C4.67314 4.3829 4.73277 4.34806 4.77681 4.23927C5.27739 3.00514 5.78371 1.77387 6.28702 0.540886C6.34173 0.408107 6.40628 0.283895 6.51242 0.189951C6.90741 -0.164411 7.49907 -0.00850327 7.71599 0.537174C8.20836 1.77473 8.72179 3.00286 9.22237 4.2367C9.26586 4.3435 9.32221 4.38433 9.4319 4.39261C9.88543 4.42688 10.3387 4.46971 10.7917 4.51225C11.5758 4.58592 12.3594 4.66074 13.1425 4.73669C13.314 4.75354 13.4857 4.76782 13.6406 4.86405C13.8364 4.9854 13.9275 5.18043 14 5.39116Z"
                                          fill="#FCC013" />
                                      </svg>
                                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                          d="M14 5.39116V5.70526C13.9143 5.90196 13.7892 6.07722 13.6332 6.21924C12.687 7.07588 11.7485 7.94194 10.8032 8.80001C10.7159 8.87939 10.6937 8.94735 10.7189 9.06471C11.0086 10.3759 11.2933 11.6883 11.5789 13.0004C11.6132 13.139 11.6138 13.2843 11.5808 13.4233C11.4492 13.9298 10.9112 14.1514 10.4678 13.8761C9.3554 13.1846 8.2441 12.4897 7.1339 11.7917C7.03433 11.7291 6.9643 11.7311 6.86583 11.7917C5.75982 12.4865 4.65208 13.1783 3.5426 13.867C3.25238 14.0475 2.96079 14.0509 2.68807 13.8365C2.41945 13.6252 2.34806 13.3339 2.42082 12.9981C2.70776 11.6792 2.99416 10.3571 3.28493 9.03729C3.30736 8.93593 3.28493 8.88281 3.21655 8.82056C2.43751 8.1107 1.65382 7.40569 0.885446 6.6844C0.566226 6.38458 0.170415 6.15328 0 5.70526V5.36261L0.0202418 5.33405H0V5.27694C0.00481165 5.28329 0.0100202 5.2893 0.0155917 5.29493C0.0265333 5.28722 0.0410307 5.27951 0.0454074 5.26809C0.187921 4.87918 0.489361 4.76125 0.854809 4.73469C1.30861 4.70157 1.76159 4.65645 2.21457 4.61391C2.99826 4.54024 3.78168 4.46257 4.56564 4.39232C4.67314 4.3829 4.73277 4.34806 4.77681 4.23927C5.27739 3.00514 5.78371 1.77387 6.28702 0.540886C6.34173 0.408107 6.40628 0.283895 6.51242 0.189951C6.90741 -0.164411 7.49907 -0.00850327 7.71599 0.537174C8.20836 1.77473 8.72179 3.00286 9.22237 4.2367C9.26586 4.3435 9.32221 4.38433 9.4319 4.39261C9.88543 4.42688 10.3387 4.46971 10.7917 4.51225C11.5758 4.58592 12.3594 4.66074 13.1425 4.73669C13.314 4.75354 13.4857 4.76782 13.6406 4.86405C13.8364 4.9854 13.9275 5.18043 14 5.39116Z"
                                          fill="#FCC013" />
                                      </svg>
                                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                          d="M14 5.39116V5.70526C13.9143 5.90196 13.7892 6.07722 13.6332 6.21924C12.687 7.07588 11.7485 7.94194 10.8032 8.80001C10.7159 8.87939 10.6937 8.94735 10.7189 9.06471C11.0086 10.3759 11.2933 11.6883 11.5789 13.0004C11.6132 13.139 11.6138 13.2843 11.5808 13.4233C11.4492 13.9298 10.9112 14.1514 10.4678 13.8761C9.3554 13.1846 8.2441 12.4897 7.1339 11.7917C7.03433 11.7291 6.9643 11.7311 6.86583 11.7917C5.75982 12.4865 4.65208 13.1783 3.5426 13.867C3.25238 14.0475 2.96079 14.0509 2.68807 13.8365C2.41945 13.6252 2.34806 13.3339 2.42082 12.9981C2.70776 11.6792 2.99416 10.3571 3.28493 9.03729C3.30736 8.93593 3.28493 8.88281 3.21655 8.82056C2.43751 8.1107 1.65382 7.40569 0.885446 6.6844C0.566226 6.38458 0.170415 6.15328 0 5.70526V5.36261L0.0202418 5.33405H0V5.27694C0.00481165 5.28329 0.0100202 5.2893 0.0155917 5.29493C0.0265333 5.28722 0.0410307 5.27951 0.0454074 5.26809C0.187921 4.87918 0.489361 4.76125 0.854809 4.73469C1.30861 4.70157 1.76159 4.65645 2.21457 4.61391C2.99826 4.54024 3.78168 4.46257 4.56564 4.39232C4.67314 4.3829 4.73277 4.34806 4.77681 4.23927C5.27739 3.00514 5.78371 1.77387 6.28702 0.540886C6.34173 0.408107 6.40628 0.283895 6.51242 0.189951C6.90741 -0.164411 7.49907 -0.00850327 7.71599 0.537174C8.20836 1.77473 8.72179 3.00286 9.22237 4.2367C9.26586 4.3435 9.32221 4.38433 9.4319 4.39261C9.88543 4.42688 10.3387 4.46971 10.7917 4.51225C11.5758 4.58592 12.3594 4.66074 13.1425 4.73669C13.314 4.75354 13.4857 4.76782 13.6406 4.86405C13.8364 4.9854 13.9275 5.18043 14 5.39116Z"
                                          fill="#FCC013" />
                                      </svg>
                                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                          d="M14 5.39116V5.70526C13.9143 5.90196 13.7892 6.07722 13.6332 6.21924C12.687 7.07588 11.7485 7.94194 10.8032 8.80001C10.7159 8.87939 10.6937 8.94735 10.7189 9.06471C11.0086 10.3759 11.2933 11.6883 11.5789 13.0004C11.6132 13.139 11.6138 13.2843 11.5808 13.4233C11.4492 13.9298 10.9112 14.1514 10.4678 13.8761C9.3554 13.1846 8.2441 12.4897 7.1339 11.7917C7.03433 11.7291 6.9643 11.7311 6.86583 11.7917C5.75982 12.4865 4.65208 13.1783 3.5426 13.867C3.25238 14.0475 2.96079 14.0509 2.68807 13.8365C2.41945 13.6252 2.34806 13.3339 2.42082 12.9981C2.70776 11.6792 2.99416 10.3571 3.28493 9.03729C3.30736 8.93593 3.28493 8.88281 3.21655 8.82056C2.43751 8.1107 1.65382 7.40569 0.885446 6.6844C0.566226 6.38458 0.170415 6.15328 0 5.70526V5.36261L0.0202418 5.33405H0V5.27694C0.00481165 5.28329 0.0100202 5.2893 0.0155917 5.29493C0.0265333 5.28722 0.0410307 5.27951 0.0454074 5.26809C0.187921 4.87918 0.489361 4.76125 0.854809 4.73469C1.30861 4.70157 1.76159 4.65645 2.21457 4.61391C2.99826 4.54024 3.78168 4.46257 4.56564 4.39232C4.67314 4.3829 4.73277 4.34806 4.77681 4.23927C5.27739 3.00514 5.78371 1.77387 6.28702 0.540886C6.34173 0.408107 6.40628 0.283895 6.51242 0.189951C6.90741 -0.164411 7.49907 -0.00850327 7.71599 0.537174C8.20836 1.77473 8.72179 3.00286 9.22237 4.2367C9.26586 4.3435 9.32221 4.38433 9.4319 4.39261C9.88543 4.42688 10.3387 4.46971 10.7917 4.51225C11.5758 4.58592 12.3594 4.66074 13.1425 4.73669C13.314 4.75354 13.4857 4.76782 13.6406 4.86405C13.8364 4.9854 13.9275 5.18043 14 5.39116Z"
                                          fill="#FCC013" />
                                      </svg>
                                    </div>
                                    <p class="pera-sm">(5.0)</p>
                                  </div>
                                </div>
                                <div class="date">
                                  <p class="pera-sm">
                                    April 14, 2023
                                  </p>
                                </div>

                              </div>
                              <div class="reply">
                                <a href="javascript:void(0)" class="reply-btn">Reply</a>
                              </div>
                            </div>
                            <div class="user-comment">
                              <p class="pera">Simply dummy text of the printing and typesetting
                                industry. Lorem Ipsium has
                                ashobeen the industry's
                                standards dummy repeat predefined chunks as</p>
                            </div>

                          </div>
                        </div>
                      </div>
                      <div class="review-card">
                        <div class="wrap-user">
                          <div class="user-img">
                            <img src="assets/images/product/user-2.png" alt="img">
                          </div>
                          <div class="wrap-info">
                            <div class="user-info">
                              <div class="name-ratting">
                                <div class="name-wrapper">
                                  <h4 class="name">Davidthy Phillips</h4>
                                  <div class="ratting">
                                    <div class="all-ratting">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                          d="M14 5.39116V5.70526C13.9143 5.90196 13.7892 6.07722 13.6332 6.21924C12.687 7.07588 11.7485 7.94194 10.8032 8.80001C10.7159 8.87939 10.6937 8.94735 10.7189 9.06471C11.0086 10.3759 11.2933 11.6883 11.5789 13.0004C11.6132 13.139 11.6138 13.2843 11.5808 13.4233C11.4492 13.9298 10.9112 14.1514 10.4678 13.8761C9.3554 13.1846 8.2441 12.4897 7.1339 11.7917C7.03433 11.7291 6.9643 11.7311 6.86583 11.7917C5.75982 12.4865 4.65208 13.1783 3.5426 13.867C3.25238 14.0475 2.96079 14.0509 2.68807 13.8365C2.41945 13.6252 2.34806 13.3339 2.42082 12.9981C2.70776 11.6792 2.99416 10.3571 3.28493 9.03729C3.30736 8.93593 3.28493 8.88281 3.21655 8.82056C2.43751 8.1107 1.65382 7.40569 0.885446 6.6844C0.566226 6.38458 0.170415 6.15328 0 5.70526V5.36261L0.0202418 5.33405H0V5.27694C0.00481165 5.28329 0.0100202 5.2893 0.0155917 5.29493C0.0265333 5.28722 0.0410307 5.27951 0.0454074 5.26809C0.187921 4.87918 0.489361 4.76125 0.854809 4.73469C1.30861 4.70157 1.76159 4.65645 2.21457 4.61391C2.99826 4.54024 3.78168 4.46257 4.56564 4.39232C4.67314 4.3829 4.73277 4.34806 4.77681 4.23927C5.27739 3.00514 5.78371 1.77387 6.28702 0.540886C6.34173 0.408107 6.40628 0.283895 6.51242 0.189951C6.90741 -0.164411 7.49907 -0.00850327 7.71599 0.537174C8.20836 1.77473 8.72179 3.00286 9.22237 4.2367C9.26586 4.3435 9.32221 4.38433 9.4319 4.39261C9.88543 4.42688 10.3387 4.46971 10.7917 4.51225C11.5758 4.58592 12.3594 4.66074 13.1425 4.73669C13.314 4.75354 13.4857 4.76782 13.6406 4.86405C13.8364 4.9854 13.9275 5.18043 14 5.39116Z"
                                          fill="#FCC013" />
                                      </svg>
                                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                          d="M14 5.39116V5.70526C13.9143 5.90196 13.7892 6.07722 13.6332 6.21924C12.687 7.07588 11.7485 7.94194 10.8032 8.80001C10.7159 8.87939 10.6937 8.94735 10.7189 9.06471C11.0086 10.3759 11.2933 11.6883 11.5789 13.0004C11.6132 13.139 11.6138 13.2843 11.5808 13.4233C11.4492 13.9298 10.9112 14.1514 10.4678 13.8761C9.3554 13.1846 8.2441 12.4897 7.1339 11.7917C7.03433 11.7291 6.9643 11.7311 6.86583 11.7917C5.75982 12.4865 4.65208 13.1783 3.5426 13.867C3.25238 14.0475 2.96079 14.0509 2.68807 13.8365C2.41945 13.6252 2.34806 13.3339 2.42082 12.9981C2.70776 11.6792 2.99416 10.3571 3.28493 9.03729C3.30736 8.93593 3.28493 8.88281 3.21655 8.82056C2.43751 8.1107 1.65382 7.40569 0.885446 6.6844C0.566226 6.38458 0.170415 6.15328 0 5.70526V5.36261L0.0202418 5.33405H0V5.27694C0.00481165 5.28329 0.0100202 5.2893 0.0155917 5.29493C0.0265333 5.28722 0.0410307 5.27951 0.0454074 5.26809C0.187921 4.87918 0.489361 4.76125 0.854809 4.73469C1.30861 4.70157 1.76159 4.65645 2.21457 4.61391C2.99826 4.54024 3.78168 4.46257 4.56564 4.39232C4.67314 4.3829 4.73277 4.34806 4.77681 4.23927C5.27739 3.00514 5.78371 1.77387 6.28702 0.540886C6.34173 0.408107 6.40628 0.283895 6.51242 0.189951C6.90741 -0.164411 7.49907 -0.00850327 7.71599 0.537174C8.20836 1.77473 8.72179 3.00286 9.22237 4.2367C9.26586 4.3435 9.32221 4.38433 9.4319 4.39261C9.88543 4.42688 10.3387 4.46971 10.7917 4.51225C11.5758 4.58592 12.3594 4.66074 13.1425 4.73669C13.314 4.75354 13.4857 4.76782 13.6406 4.86405C13.8364 4.9854 13.9275 5.18043 14 5.39116Z"
                                          fill="#FCC013" />
                                      </svg>
                                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                          d="M14 5.39116V5.70526C13.9143 5.90196 13.7892 6.07722 13.6332 6.21924C12.687 7.07588 11.7485 7.94194 10.8032 8.80001C10.7159 8.87939 10.6937 8.94735 10.7189 9.06471C11.0086 10.3759 11.2933 11.6883 11.5789 13.0004C11.6132 13.139 11.6138 13.2843 11.5808 13.4233C11.4492 13.9298 10.9112 14.1514 10.4678 13.8761C9.3554 13.1846 8.2441 12.4897 7.1339 11.7917C7.03433 11.7291 6.9643 11.7311 6.86583 11.7917C5.75982 12.4865 4.65208 13.1783 3.5426 13.867C3.25238 14.0475 2.96079 14.0509 2.68807 13.8365C2.41945 13.6252 2.34806 13.3339 2.42082 12.9981C2.70776 11.6792 2.99416 10.3571 3.28493 9.03729C3.30736 8.93593 3.28493 8.88281 3.21655 8.82056C2.43751 8.1107 1.65382 7.40569 0.885446 6.6844C0.566226 6.38458 0.170415 6.15328 0 5.70526V5.36261L0.0202418 5.33405H0V5.27694C0.00481165 5.28329 0.0100202 5.2893 0.0155917 5.29493C0.0265333 5.28722 0.0410307 5.27951 0.0454074 5.26809C0.187921 4.87918 0.489361 4.76125 0.854809 4.73469C1.30861 4.70157 1.76159 4.65645 2.21457 4.61391C2.99826 4.54024 3.78168 4.46257 4.56564 4.39232C4.67314 4.3829 4.73277 4.34806 4.77681 4.23927C5.27739 3.00514 5.78371 1.77387 6.28702 0.540886C6.34173 0.408107 6.40628 0.283895 6.51242 0.189951C6.90741 -0.164411 7.49907 -0.00850327 7.71599 0.537174C8.20836 1.77473 8.72179 3.00286 9.22237 4.2367C9.26586 4.3435 9.32221 4.38433 9.4319 4.39261C9.88543 4.42688 10.3387 4.46971 10.7917 4.51225C11.5758 4.58592 12.3594 4.66074 13.1425 4.73669C13.314 4.75354 13.4857 4.76782 13.6406 4.86405C13.8364 4.9854 13.9275 5.18043 14 5.39116Z"
                                          fill="#FCC013" />
                                      </svg>
                                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                          d="M14 5.39116V5.70526C13.9143 5.90196 13.7892 6.07722 13.6332 6.21924C12.687 7.07588 11.7485 7.94194 10.8032 8.80001C10.7159 8.87939 10.6937 8.94735 10.7189 9.06471C11.0086 10.3759 11.2933 11.6883 11.5789 13.0004C11.6132 13.139 11.6138 13.2843 11.5808 13.4233C11.4492 13.9298 10.9112 14.1514 10.4678 13.8761C9.3554 13.1846 8.2441 12.4897 7.1339 11.7917C7.03433 11.7291 6.9643 11.7311 6.86583 11.7917C5.75982 12.4865 4.65208 13.1783 3.5426 13.867C3.25238 14.0475 2.96079 14.0509 2.68807 13.8365C2.41945 13.6252 2.34806 13.3339 2.42082 12.9981C2.70776 11.6792 2.99416 10.3571 3.28493 9.03729C3.30736 8.93593 3.28493 8.88281 3.21655 8.82056C2.43751 8.1107 1.65382 7.40569 0.885446 6.6844C0.566226 6.38458 0.170415 6.15328 0 5.70526V5.36261L0.0202418 5.33405H0V5.27694C0.00481165 5.28329 0.0100202 5.2893 0.0155917 5.29493C0.0265333 5.28722 0.0410307 5.27951 0.0454074 5.26809C0.187921 4.87918 0.489361 4.76125 0.854809 4.73469C1.30861 4.70157 1.76159 4.65645 2.21457 4.61391C2.99826 4.54024 3.78168 4.46257 4.56564 4.39232C4.67314 4.3829 4.73277 4.34806 4.77681 4.23927C5.27739 3.00514 5.78371 1.77387 6.28702 0.540886C6.34173 0.408107 6.40628 0.283895 6.51242 0.189951C6.90741 -0.164411 7.49907 -0.00850327 7.71599 0.537174C8.20836 1.77473 8.72179 3.00286 9.22237 4.2367C9.26586 4.3435 9.32221 4.38433 9.4319 4.39261C9.88543 4.42688 10.3387 4.46971 10.7917 4.51225C11.5758 4.58592 12.3594 4.66074 13.1425 4.73669C13.314 4.75354 13.4857 4.76782 13.6406 4.86405C13.8364 4.9854 13.9275 5.18043 14 5.39116Z"
                                          fill="#FCC013" />
                                      </svg>
                                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                          d="M14 5.39116V5.70526C13.9143 5.90196 13.7892 6.07722 13.6332 6.21924C12.687 7.07588 11.7485 7.94194 10.8032 8.80001C10.7159 8.87939 10.6937 8.94735 10.7189 9.06471C11.0086 10.3759 11.2933 11.6883 11.5789 13.0004C11.6132 13.139 11.6138 13.2843 11.5808 13.4233C11.4492 13.9298 10.9112 14.1514 10.4678 13.8761C9.3554 13.1846 8.2441 12.4897 7.1339 11.7917C7.03433 11.7291 6.9643 11.7311 6.86583 11.7917C5.75982 12.4865 4.65208 13.1783 3.5426 13.867C3.25238 14.0475 2.96079 14.0509 2.68807 13.8365C2.41945 13.6252 2.34806 13.3339 2.42082 12.9981C2.70776 11.6792 2.99416 10.3571 3.28493 9.03729C3.30736 8.93593 3.28493 8.88281 3.21655 8.82056C2.43751 8.1107 1.65382 7.40569 0.885446 6.6844C0.566226 6.38458 0.170415 6.15328 0 5.70526V5.36261L0.0202418 5.33405H0V5.27694C0.00481165 5.28329 0.0100202 5.2893 0.0155917 5.29493C0.0265333 5.28722 0.0410307 5.27951 0.0454074 5.26809C0.187921 4.87918 0.489361 4.76125 0.854809 4.73469C1.30861 4.70157 1.76159 4.65645 2.21457 4.61391C2.99826 4.54024 3.78168 4.46257 4.56564 4.39232C4.67314 4.3829 4.73277 4.34806 4.77681 4.23927C5.27739 3.00514 5.78371 1.77387 6.28702 0.540886C6.34173 0.408107 6.40628 0.283895 6.51242 0.189951C6.90741 -0.164411 7.49907 -0.00850327 7.71599 0.537174C8.20836 1.77473 8.72179 3.00286 9.22237 4.2367C9.26586 4.3435 9.32221 4.38433 9.4319 4.39261C9.88543 4.42688 10.3387 4.46971 10.7917 4.51225C11.5758 4.58592 12.3594 4.66074 13.1425 4.73669C13.314 4.75354 13.4857 4.76782 13.6406 4.86405C13.8364 4.9854 13.9275 5.18043 14 5.39116Z"
                                          fill="#FCC013" />
                                      </svg>
                                    </div>
                                    <p class="pera-sm">(5.0)</p>
                                  </div>
                                </div>
                                <div class="date">
                                  <p class="pera-sm">
                                    April 14, 2023
                                  </p>
                                </div>

                              </div>
                              <div class="reply">
                                <a href="javascript:void(0)" class="reply-btn">Reply</a>
                              </div>
                            </div>
                            <div class="user-comment">
                              <p class="pera">Simply dummy text of the printing and typesetting
                                industry. Lorem Ipsium has
                                ashobeen the industry's
                                standards dummy repeat predefined chunks as</p>
                            </div>

                          </div>
                        </div>
                      </div>
                      <div class="review-card">
                        <div class="wrap-user">
                          <div class="user-img">
                            <img src="assets/images/product/user-3.png" alt="img">
                          </div>
                          <div class="wrap-info">
                            <div class="user-info">
                              <div class="name-ratting">
                                <div class="name-wrapper">
                                  <h4 class="name">Elliot Alderson</h4>
                                  <div class="ratting">
                                    <div class="all-ratting">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                          d="M14 5.39116V5.70526C13.9143 5.90196 13.7892 6.07722 13.6332 6.21924C12.687 7.07588 11.7485 7.94194 10.8032 8.80001C10.7159 8.87939 10.6937 8.94735 10.7189 9.06471C11.0086 10.3759 11.2933 11.6883 11.5789 13.0004C11.6132 13.139 11.6138 13.2843 11.5808 13.4233C11.4492 13.9298 10.9112 14.1514 10.4678 13.8761C9.3554 13.1846 8.2441 12.4897 7.1339 11.7917C7.03433 11.7291 6.9643 11.7311 6.86583 11.7917C5.75982 12.4865 4.65208 13.1783 3.5426 13.867C3.25238 14.0475 2.96079 14.0509 2.68807 13.8365C2.41945 13.6252 2.34806 13.3339 2.42082 12.9981C2.70776 11.6792 2.99416 10.3571 3.28493 9.03729C3.30736 8.93593 3.28493 8.88281 3.21655 8.82056C2.43751 8.1107 1.65382 7.40569 0.885446 6.6844C0.566226 6.38458 0.170415 6.15328 0 5.70526V5.36261L0.0202418 5.33405H0V5.27694C0.00481165 5.28329 0.0100202 5.2893 0.0155917 5.29493C0.0265333 5.28722 0.0410307 5.27951 0.0454074 5.26809C0.187921 4.87918 0.489361 4.76125 0.854809 4.73469C1.30861 4.70157 1.76159 4.65645 2.21457 4.61391C2.99826 4.54024 3.78168 4.46257 4.56564 4.39232C4.67314 4.3829 4.73277 4.34806 4.77681 4.23927C5.27739 3.00514 5.78371 1.77387 6.28702 0.540886C6.34173 0.408107 6.40628 0.283895 6.51242 0.189951C6.90741 -0.164411 7.49907 -0.00850327 7.71599 0.537174C8.20836 1.77473 8.72179 3.00286 9.22237 4.2367C9.26586 4.3435 9.32221 4.38433 9.4319 4.39261C9.88543 4.42688 10.3387 4.46971 10.7917 4.51225C11.5758 4.58592 12.3594 4.66074 13.1425 4.73669C13.314 4.75354 13.4857 4.76782 13.6406 4.86405C13.8364 4.9854 13.9275 5.18043 14 5.39116Z"
                                          fill="#FCC013" />
                                      </svg>
                                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                          d="M14 5.39116V5.70526C13.9143 5.90196 13.7892 6.07722 13.6332 6.21924C12.687 7.07588 11.7485 7.94194 10.8032 8.80001C10.7159 8.87939 10.6937 8.94735 10.7189 9.06471C11.0086 10.3759 11.2933 11.6883 11.5789 13.0004C11.6132 13.139 11.6138 13.2843 11.5808 13.4233C11.4492 13.9298 10.9112 14.1514 10.4678 13.8761C9.3554 13.1846 8.2441 12.4897 7.1339 11.7917C7.03433 11.7291 6.9643 11.7311 6.86583 11.7917C5.75982 12.4865 4.65208 13.1783 3.5426 13.867C3.25238 14.0475 2.96079 14.0509 2.68807 13.8365C2.41945 13.6252 2.34806 13.3339 2.42082 12.9981C2.70776 11.6792 2.99416 10.3571 3.28493 9.03729C3.30736 8.93593 3.28493 8.88281 3.21655 8.82056C2.43751 8.1107 1.65382 7.40569 0.885446 6.6844C0.566226 6.38458 0.170415 6.15328 0 5.70526V5.36261L0.0202418 5.33405H0V5.27694C0.00481165 5.28329 0.0100202 5.2893 0.0155917 5.29493C0.0265333 5.28722 0.0410307 5.27951 0.0454074 5.26809C0.187921 4.87918 0.489361 4.76125 0.854809 4.73469C1.30861 4.70157 1.76159 4.65645 2.21457 4.61391C2.99826 4.54024 3.78168 4.46257 4.56564 4.39232C4.67314 4.3829 4.73277 4.34806 4.77681 4.23927C5.27739 3.00514 5.78371 1.77387 6.28702 0.540886C6.34173 0.408107 6.40628 0.283895 6.51242 0.189951C6.90741 -0.164411 7.49907 -0.00850327 7.71599 0.537174C8.20836 1.77473 8.72179 3.00286 9.22237 4.2367C9.26586 4.3435 9.32221 4.38433 9.4319 4.39261C9.88543 4.42688 10.3387 4.46971 10.7917 4.51225C11.5758 4.58592 12.3594 4.66074 13.1425 4.73669C13.314 4.75354 13.4857 4.76782 13.6406 4.86405C13.8364 4.9854 13.9275 5.18043 14 5.39116Z"
                                          fill="#FCC013" />
                                      </svg>
                                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                          d="M14 5.39116V5.70526C13.9143 5.90196 13.7892 6.07722 13.6332 6.21924C12.687 7.07588 11.7485 7.94194 10.8032 8.80001C10.7159 8.87939 10.6937 8.94735 10.7189 9.06471C11.0086 10.3759 11.2933 11.6883 11.5789 13.0004C11.6132 13.139 11.6138 13.2843 11.5808 13.4233C11.4492 13.9298 10.9112 14.1514 10.4678 13.8761C9.3554 13.1846 8.2441 12.4897 7.1339 11.7917C7.03433 11.7291 6.9643 11.7311 6.86583 11.7917C5.75982 12.4865 4.65208 13.1783 3.5426 13.867C3.25238 14.0475 2.96079 14.0509 2.68807 13.8365C2.41945 13.6252 2.34806 13.3339 2.42082 12.9981C2.70776 11.6792 2.99416 10.3571 3.28493 9.03729C3.30736 8.93593 3.28493 8.88281 3.21655 8.82056C2.43751 8.1107 1.65382 7.40569 0.885446 6.6844C0.566226 6.38458 0.170415 6.15328 0 5.70526V5.36261L0.0202418 5.33405H0V5.27694C0.00481165 5.28329 0.0100202 5.2893 0.0155917 5.29493C0.0265333 5.28722 0.0410307 5.27951 0.0454074 5.26809C0.187921 4.87918 0.489361 4.76125 0.854809 4.73469C1.30861 4.70157 1.76159 4.65645 2.21457 4.61391C2.99826 4.54024 3.78168 4.46257 4.56564 4.39232C4.67314 4.3829 4.73277 4.34806 4.77681 4.23927C5.27739 3.00514 5.78371 1.77387 6.28702 0.540886C6.34173 0.408107 6.40628 0.283895 6.51242 0.189951C6.90741 -0.164411 7.49907 -0.00850327 7.71599 0.537174C8.20836 1.77473 8.72179 3.00286 9.22237 4.2367C9.26586 4.3435 9.32221 4.38433 9.4319 4.39261C9.88543 4.42688 10.3387 4.46971 10.7917 4.51225C11.5758 4.58592 12.3594 4.66074 13.1425 4.73669C13.314 4.75354 13.4857 4.76782 13.6406 4.86405C13.8364 4.9854 13.9275 5.18043 14 5.39116Z"
                                          fill="#FCC013" />
                                      </svg>
                                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                          d="M14 5.39116V5.70526C13.9143 5.90196 13.7892 6.07722 13.6332 6.21924C12.687 7.07588 11.7485 7.94194 10.8032 8.80001C10.7159 8.87939 10.6937 8.94735 10.7189 9.06471C11.0086 10.3759 11.2933 11.6883 11.5789 13.0004C11.6132 13.139 11.6138 13.2843 11.5808 13.4233C11.4492 13.9298 10.9112 14.1514 10.4678 13.8761C9.3554 13.1846 8.2441 12.4897 7.1339 11.7917C7.03433 11.7291 6.9643 11.7311 6.86583 11.7917C5.75982 12.4865 4.65208 13.1783 3.5426 13.867C3.25238 14.0475 2.96079 14.0509 2.68807 13.8365C2.41945 13.6252 2.34806 13.3339 2.42082 12.9981C2.70776 11.6792 2.99416 10.3571 3.28493 9.03729C3.30736 8.93593 3.28493 8.88281 3.21655 8.82056C2.43751 8.1107 1.65382 7.40569 0.885446 6.6844C0.566226 6.38458 0.170415 6.15328 0 5.70526V5.36261L0.0202418 5.33405H0V5.27694C0.00481165 5.28329 0.0100202 5.2893 0.0155917 5.29493C0.0265333 5.28722 0.0410307 5.27951 0.0454074 5.26809C0.187921 4.87918 0.489361 4.76125 0.854809 4.73469C1.30861 4.70157 1.76159 4.65645 2.21457 4.61391C2.99826 4.54024 3.78168 4.46257 4.56564 4.39232C4.67314 4.3829 4.73277 4.34806 4.77681 4.23927C5.27739 3.00514 5.78371 1.77387 6.28702 0.540886C6.34173 0.408107 6.40628 0.283895 6.51242 0.189951C6.90741 -0.164411 7.49907 -0.00850327 7.71599 0.537174C8.20836 1.77473 8.72179 3.00286 9.22237 4.2367C9.26586 4.3435 9.32221 4.38433 9.4319 4.39261C9.88543 4.42688 10.3387 4.46971 10.7917 4.51225C11.5758 4.58592 12.3594 4.66074 13.1425 4.73669C13.314 4.75354 13.4857 4.76782 13.6406 4.86405C13.8364 4.9854 13.9275 5.18043 14 5.39116Z"
                                          fill="#FCC013" />
                                      </svg>
                                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                          d="M14 5.39116V5.70526C13.9143 5.90196 13.7892 6.07722 13.6332 6.21924C12.687 7.07588 11.7485 7.94194 10.8032 8.80001C10.7159 8.87939 10.6937 8.94735 10.7189 9.06471C11.0086 10.3759 11.2933 11.6883 11.5789 13.0004C11.6132 13.139 11.6138 13.2843 11.5808 13.4233C11.4492 13.9298 10.9112 14.1514 10.4678 13.8761C9.3554 13.1846 8.2441 12.4897 7.1339 11.7917C7.03433 11.7291 6.9643 11.7311 6.86583 11.7917C5.75982 12.4865 4.65208 13.1783 3.5426 13.867C3.25238 14.0475 2.96079 14.0509 2.68807 13.8365C2.41945 13.6252 2.34806 13.3339 2.42082 12.9981C2.70776 11.6792 2.99416 10.3571 3.28493 9.03729C3.30736 8.93593 3.28493 8.88281 3.21655 8.82056C2.43751 8.1107 1.65382 7.40569 0.885446 6.6844C0.566226 6.38458 0.170415 6.15328 0 5.70526V5.36261L0.0202418 5.33405H0V5.27694C0.00481165 5.28329 0.0100202 5.2893 0.0155917 5.29493C0.0265333 5.28722 0.0410307 5.27951 0.0454074 5.26809C0.187921 4.87918 0.489361 4.76125 0.854809 4.73469C1.30861 4.70157 1.76159 4.65645 2.21457 4.61391C2.99826 4.54024 3.78168 4.46257 4.56564 4.39232C4.67314 4.3829 4.73277 4.34806 4.77681 4.23927C5.27739 3.00514 5.78371 1.77387 6.28702 0.540886C6.34173 0.408107 6.40628 0.283895 6.51242 0.189951C6.90741 -0.164411 7.49907 -0.00850327 7.71599 0.537174C8.20836 1.77473 8.72179 3.00286 9.22237 4.2367C9.26586 4.3435 9.32221 4.38433 9.4319 4.39261C9.88543 4.42688 10.3387 4.46971 10.7917 4.51225C11.5758 4.58592 12.3594 4.66074 13.1425 4.73669C13.314 4.75354 13.4857 4.76782 13.6406 4.86405C13.8364 4.9854 13.9275 5.18043 14 5.39116Z"
                                          fill="#FCC013" />
                                      </svg>
                                    </div>
                                    <p class="pera-sm">(5.0)</p>
                                  </div>
                                </div>
                                <div class="date">
                                  <p class="pera-sm">
                                    April 14, 2023
                                  </p>
                                </div>

                              </div>
                              <div class="reply">
                                <a href="javascript:void(0)" class="reply-btn">Reply</a>
                              </div>
                            </div>
                            <div class="user-comment">
                              <p class="pera">Simply dummy text of the printing and typesetting
                                industry. Lorem Ipsium has
                                ashobeen the industry's
                                standards dummy repeat predefined chunks as</p>
                            </div>

                          </div>
                        </div>
                      </div>

                    </div>
                    <!-- End Tab contents -->

                  </div>
                </div>

              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- End-of more details area-->
      <!-- Related Product S t a r t -->
      <section class="related-product feature-area section-padding2">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="section-title">
                <h4 class="title">Related Products</h4>
              </div>
              <div class="swiper featureSwiper-active">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <div class="product-card best-product-card">
                      <div class="top-card">
                        <div class="price-section">
                          <h4 class="price text-color-primary">$320</h4>
                        </div>
                        <button class="wishlist-icon">
                          <img src="assets/images/icon/wish-icon-2.png" alt="img">
                        </button>
                      </div>
                      <div class="product-img-card best-product-img-card">
                        <a href="shop-details.html">
                          <img src="assets/images/product/product-5.png" alt="img">
                        </a>
                        <div class="special-icon">
                          <button class="icon-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="19" viewBox="0 0 21 19"
                              fill="none">
                              <path
                                d="M0.978546 2.56816V5.13649H1.65442H2.33029V3.71701V2.292L5.45619 5.35743L8.58209 8.42285L9.07209 7.9368L9.56773 7.45628L6.44183 4.39085L3.31593 1.32542H4.76905H6.21654V0.662629V-0.000165939H3.59754H0.978546V2.56816Z"
                                fill="#111111" />
                              <path
                                d="M15.1167 0.662629V1.32542H16.5642H18.0173L14.8914 4.39085L11.7655 7.45628L12.2611 7.9368L12.7511 8.42285L15.877 5.35743L19.0029 2.292V3.71701V5.13649H19.6788H20.3547V2.56816V-0.000165939H17.7357H15.1167V0.662629Z"
                                fill="#111111" />
                              <path
                                d="M5.43926 13.6535L2.33026 16.7078V15.2828V13.8633H1.65439H0.978516V16.4317V19H3.59751H6.21651V18.3372V17.6744H4.76902H3.3159L6.4418 14.609L9.5677 11.5436L9.08896 11.0741C8.82988 10.8145 8.59895 10.6046 8.58206 10.6046C8.56516 10.6046 7.15146 11.9799 5.43926 13.6535Z"
                                fill="#111111" />
                              <path
                                d="M12.2442 11.0741L11.7655 11.5436L14.8914 14.609L18.0173 17.6744H16.5641H15.1167V18.3372V19H17.7356H20.3546V16.4317V13.8633H19.6788H19.0029V15.2828V16.7078L15.8883 13.6535C14.1817 11.9799 12.768 10.6046 12.7511 10.6046C12.7342 10.6046 12.5033 10.8145 12.2442 11.0741Z"
                                fill="#111111" />
                            </svg>
                          </button>
                          <button class="icon-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="25" viewBox="0 0 22 25"
                              fill="none">
                              <path
                                d="M9.4304 0.827005C9.4304 1.27952 9.41567 1.65419 9.40094 1.65419C9.38622 1.65419 9.14565 1.69798 8.87563 1.75637C4.21162 2.6906 0.73079 6.34481 0.0827378 10.9868C-0.0694564 12.0475 -0.00563302 13.663 0.225113 14.7432C0.809342 17.5069 2.62094 20.1004 5.01677 21.6185L5.29661 21.7937L5.98885 21.2779C6.36688 20.9957 6.68109 20.7524 6.68109 20.733C6.68109 20.7184 6.55835 20.6405 6.41107 20.5627C5.65992 20.1734 4.68293 19.3949 4.02015 18.6601C2.76332 17.2636 1.95816 15.5606 1.69796 13.77C1.60468 13.1083 1.60468 11.7945 1.69796 11.1668C1.89925 9.83845 2.37056 8.58308 3.07753 7.48341C3.96123 6.11612 5.30643 4.91914 6.77928 4.1844C7.52552 3.8146 8.56142 3.46426 9.2733 3.33775L9.4304 3.30856V3.98977C9.4304 4.36444 9.44022 4.67098 9.45495 4.67098C9.50404 4.67098 12.5725 2.36946 12.5725 2.3354C12.5725 2.30134 9.50404 -0.000179291 9.45495 -0.000179291C9.44022 -0.000179291 9.4304 0.369621 9.4304 0.827005Z"
                                fill="#111111" />
                              <path
                                d="M16.0134 3.6345C15.6354 3.91672 15.331 4.16487 15.3457 4.18434C15.3604 4.20867 15.5077 4.30112 15.6795 4.39357C17.118 5.20129 18.4583 6.56371 19.288 8.07697C19.7888 8.98687 20.211 10.3104 20.3288 11.3419C20.427 12.1545 20.3681 13.551 20.211 14.2906C19.5335 17.4728 17.2997 20.0371 14.2165 21.1757C13.8287 21.3168 12.778 21.6039 12.6406 21.6039C12.5866 21.6039 12.5718 21.4822 12.5718 20.9227C12.5718 20.548 12.562 20.2414 12.5473 20.2414C12.4982 20.2414 9.42976 22.543 9.42976 22.577C9.42976 22.6111 12.4982 24.9126 12.5473 24.9126C12.562 24.9126 12.5718 24.5428 12.5718 24.0854V23.2631L12.7584 23.2339C13.215 23.1609 14.5062 22.8154 14.9284 22.65C18.7578 21.1659 21.3795 17.8767 21.9244 13.8673C22.0668 12.8357 22.003 11.2203 21.7771 10.1693C21.1929 7.40549 19.3813 4.81202 16.9855 3.2939L16.7056 3.11873L16.0134 3.6345Z"
                                fill="#111111" />
                            </svg>
                          </button>
                        </div>
                      </div>
                      <a href="shop-details.html">
                        <h4 class="product-title line-clamp-1">Rift Gogan Sofa Large</h4>
                      </a>
                      <div class="product-review">
                        <div class="product-ratting">
                          <i class="ri-star-s-fill"></i>
                          <i class="ri-star-s-fill"></i>
                          <i class="ri-star-s-fill"></i>
                          <i class="ri-star-s-fill"></i>
                          <i class="ri-star-s-fill"></i>
                        </div>
                        <p class="count-ratting">(11)</p>
                      </div>
                      <div class="cart-card best-product-cart-card d-none d-md-block">
                        <a href="shop-details.html">
                          <h4 class="product-title line-clamp-1">Rift Gogan Sofa Large</h4>
                        </a>
                        <div class="product-review">
                          <div class="product-ratting">
                            <i class="ri-star-s-fill"></i>
                            <i class="ri-star-s-fill"></i>
                            <i class="ri-star-s-fill"></i>
                            <i class="ri-star-s-fill"></i>
                            <i class="ri-star-s-fill"></i>
                          </div>
                          <p class="count-ratting">(11)</p>
                        </div>
                        <div class="button-section">
                          <a href="javascript:void(0)" class=" cart-btn">Add to Cart</a>
                          <div class="fill-pill-btn qty-btn">
                            <div class="qty-container best-product-qty-container">
                              <div class="qty-btn-minus qty-btn mr-1">
                                <i class="ri-subtract-fill"></i>
                              </div>
                              <input type="text" name="qty" value="0" class="input-qty input-rounded">
                              <div class="qty-btn-plus qty-btn ml-1">
                                <i class="ri-add-fill"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="button-section d-block d-md-none">
                        <a href="javascript:void(0)" class=" cart-btn">Add to Cart</a>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="product-card best-product-card">
                      <div class="top-card">
                        <div class="price-section">
                          <h4 class="price discounted">$700</h4>
                          <h4 class="price text-color-primary">$600</h4>
                        </div>
                        <button class="wishlist-icon">
                          <img src="assets/images/icon/wish-icon-2.png" alt="img">
                        </button>
                      </div>
                      <div class="product-img-card best-product-img-card">
                        <a href="shop-details.html">
                          <img src="assets/images/product/product-6.png" alt="img">
                        </a>
                        <div class="discount-badge">
                          <span class="percentage">- 35%</span>
                        </div>
                        <div class="special-icon">
                          <button class="icon-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="19" viewBox="0 0 21 19"
                              fill="none">
                              <path
                                d="M0.978546 2.56816V5.13649H1.65442H2.33029V3.71701V2.292L5.45619 5.35743L8.58209 8.42285L9.07209 7.9368L9.56773 7.45628L6.44183 4.39085L3.31593 1.32542H4.76905H6.21654V0.662629V-0.000165939H3.59754H0.978546V2.56816Z"
                                fill="#111111" />
                              <path
                                d="M15.1167 0.662629V1.32542H16.5642H18.0173L14.8914 4.39085L11.7655 7.45628L12.2611 7.9368L12.7511 8.42285L15.877 5.35743L19.0029 2.292V3.71701V5.13649H19.6788H20.3547V2.56816V-0.000165939H17.7357H15.1167V0.662629Z"
                                fill="#111111" />
                              <path
                                d="M5.43926 13.6535L2.33026 16.7078V15.2828V13.8633H1.65439H0.978516V16.4317V19H3.59751H6.21651V18.3372V17.6744H4.76902H3.3159L6.4418 14.609L9.5677 11.5436L9.08896 11.0741C8.82988 10.8145 8.59895 10.6046 8.58206 10.6046C8.56516 10.6046 7.15146 11.9799 5.43926 13.6535Z"
                                fill="#111111" />
                              <path
                                d="M12.2442 11.0741L11.7655 11.5436L14.8914 14.609L18.0173 17.6744H16.5641H15.1167V18.3372V19H17.7356H20.3546V16.4317V13.8633H19.6788H19.0029V15.2828V16.7078L15.8883 13.6535C14.1817 11.9799 12.768 10.6046 12.7511 10.6046C12.7342 10.6046 12.5033 10.8145 12.2442 11.0741Z"
                                fill="#111111" />
                            </svg>
                          </button>
                          <button class="icon-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="25" viewBox="0 0 22 25"
                              fill="none">
                              <path
                                d="M9.4304 0.827005C9.4304 1.27952 9.41567 1.65419 9.40094 1.65419C9.38622 1.65419 9.14565 1.69798 8.87563 1.75637C4.21162 2.6906 0.73079 6.34481 0.0827378 10.9868C-0.0694564 12.0475 -0.00563302 13.663 0.225113 14.7432C0.809342 17.5069 2.62094 20.1004 5.01677 21.6185L5.29661 21.7937L5.98885 21.2779C6.36688 20.9957 6.68109 20.7524 6.68109 20.733C6.68109 20.7184 6.55835 20.6405 6.41107 20.5627C5.65992 20.1734 4.68293 19.3949 4.02015 18.6601C2.76332 17.2636 1.95816 15.5606 1.69796 13.77C1.60468 13.1083 1.60468 11.7945 1.69796 11.1668C1.89925 9.83845 2.37056 8.58308 3.07753 7.48341C3.96123 6.11612 5.30643 4.91914 6.77928 4.1844C7.52552 3.8146 8.56142 3.46426 9.2733 3.33775L9.4304 3.30856V3.98977C9.4304 4.36444 9.44022 4.67098 9.45495 4.67098C9.50404 4.67098 12.5725 2.36946 12.5725 2.3354C12.5725 2.30134 9.50404 -0.000179291 9.45495 -0.000179291C9.44022 -0.000179291 9.4304 0.369621 9.4304 0.827005Z"
                                fill="#111111" />
                              <path
                                d="M16.0134 3.6345C15.6354 3.91672 15.331 4.16487 15.3457 4.18434C15.3604 4.20867 15.5077 4.30112 15.6795 4.39357C17.118 5.20129 18.4583 6.56371 19.288 8.07697C19.7888 8.98687 20.211 10.3104 20.3288 11.3419C20.427 12.1545 20.3681 13.551 20.211 14.2906C19.5335 17.4728 17.2997 20.0371 14.2165 21.1757C13.8287 21.3168 12.778 21.6039 12.6406 21.6039C12.5866 21.6039 12.5718 21.4822 12.5718 20.9227C12.5718 20.548 12.562 20.2414 12.5473 20.2414C12.4982 20.2414 9.42976 22.543 9.42976 22.577C9.42976 22.6111 12.4982 24.9126 12.5473 24.9126C12.562 24.9126 12.5718 24.5428 12.5718 24.0854V23.2631L12.7584 23.2339C13.215 23.1609 14.5062 22.8154 14.9284 22.65C18.7578 21.1659 21.3795 17.8767 21.9244 13.8673C22.0668 12.8357 22.003 11.2203 21.7771 10.1693C21.1929 7.40549 19.3813 4.81202 16.9855 3.2939L16.7056 3.11873L16.0134 3.6345Z"
                                fill="#111111" />
                            </svg>
                          </button>
                        </div>
                      </div>
                      <a href="shop-details.html">
                        <h4 class="product-title line-clamp-1">Candelaria Fabric Sofa</h4>
                      </a>
                      <div class="product-review">
                        <div class="product-ratting">
                          <i class="ri-star-s-fill"></i>
                          <i class="ri-star-s-fill"></i>
                          <i class="ri-star-s-fill"></i>
                          <i class="ri-star-s-fill"></i>
                          <i class="ri-star-s-fill"></i>
                        </div>
                        <p class="count-ratting">(36)</p>
                      </div>
                      <div class="cart-card best-product-cart-card d-none d-md-block">
                        <a href="shop-details.html">
                          <h4 class="product-title line-clamp-1">Candelaria Fabric Sofa</h4>
                        </a>
                        <div class="product-review">
                          <div class="product-ratting">
                            <i class="ri-star-s-fill"></i>
                            <i class="ri-star-s-fill"></i>
                            <i class="ri-star-s-fill"></i>
                            <i class="ri-star-s-fill"></i>
                            <i class="ri-star-s-fill"></i>
                          </div>
                          <p class="count-ratting">(36)</p>
                        </div>
                        <div class="button-section">
                          <a href="javascript:void(0)" class=" cart-btn">Add to Cart</a>
                          <div class="fill-pill-btn qty-btn">
                            <div class="qty-container best-product-qty-container">
                              <div class="qty-btn-minus qty-btn mr-1">
                                <i class="ri-subtract-fill"></i>
                              </div>
                              <input type="text" name="qty" value="0" class="input-qty input-rounded">
                              <div class="qty-btn-plus qty-btn ml-1">
                                <i class="ri-add-fill"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="button-section d-block d-md-none">
                        <a href="javascript:void(0)" class=" cart-btn">Add to Cart</a>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="product-card best-product-card">
                      <div class="top-card">
                        <div class="price-section">
                          <h4 class="price text-color-primary">$110</h4>
                        </div>
                        <button class="wishlist-icon">
                          <img src="assets/images/icon/wish-icon-2.png" alt="img">
                        </button>
                      </div>
                      <div class="product-img-card best-product-img-card">
                        <a href="shop-details.html">
                          <img src="assets/images/product/product-7.png" alt="img">
                        </a>
                        <div class="special-icon">
                          <button class="icon-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="19" viewBox="0 0 21 19"
                              fill="none">
                              <path
                                d="M0.978546 2.56816V5.13649H1.65442H2.33029V3.71701V2.292L5.45619 5.35743L8.58209 8.42285L9.07209 7.9368L9.56773 7.45628L6.44183 4.39085L3.31593 1.32542H4.76905H6.21654V0.662629V-0.000165939H3.59754H0.978546V2.56816Z"
                                fill="#111111" />
                              <path
                                d="M15.1167 0.662629V1.32542H16.5642H18.0173L14.8914 4.39085L11.7655 7.45628L12.2611 7.9368L12.7511 8.42285L15.877 5.35743L19.0029 2.292V3.71701V5.13649H19.6788H20.3547V2.56816V-0.000165939H17.7357H15.1167V0.662629Z"
                                fill="#111111" />
                              <path
                                d="M5.43926 13.6535L2.33026 16.7078V15.2828V13.8633H1.65439H0.978516V16.4317V19H3.59751H6.21651V18.3372V17.6744H4.76902H3.3159L6.4418 14.609L9.5677 11.5436L9.08896 11.0741C8.82988 10.8145 8.59895 10.6046 8.58206 10.6046C8.56516 10.6046 7.15146 11.9799 5.43926 13.6535Z"
                                fill="#111111" />
                              <path
                                d="M12.2442 11.0741L11.7655 11.5436L14.8914 14.609L18.0173 17.6744H16.5641H15.1167V18.3372V19H17.7356H20.3546V16.4317V13.8633H19.6788H19.0029V15.2828V16.7078L15.8883 13.6535C14.1817 11.9799 12.768 10.6046 12.7511 10.6046C12.7342 10.6046 12.5033 10.8145 12.2442 11.0741Z"
                                fill="#111111" />
                            </svg>
                          </button>
                          <button class="icon-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="25" viewBox="0 0 22 25"
                              fill="none">
                              <path
                                d="M9.4304 0.827005C9.4304 1.27952 9.41567 1.65419 9.40094 1.65419C9.38622 1.65419 9.14565 1.69798 8.87563 1.75637C4.21162 2.6906 0.73079 6.34481 0.0827378 10.9868C-0.0694564 12.0475 -0.00563302 13.663 0.225113 14.7432C0.809342 17.5069 2.62094 20.1004 5.01677 21.6185L5.29661 21.7937L5.98885 21.2779C6.36688 20.9957 6.68109 20.7524 6.68109 20.733C6.68109 20.7184 6.55835 20.6405 6.41107 20.5627C5.65992 20.1734 4.68293 19.3949 4.02015 18.6601C2.76332 17.2636 1.95816 15.5606 1.69796 13.77C1.60468 13.1083 1.60468 11.7945 1.69796 11.1668C1.89925 9.83845 2.37056 8.58308 3.07753 7.48341C3.96123 6.11612 5.30643 4.91914 6.77928 4.1844C7.52552 3.8146 8.56142 3.46426 9.2733 3.33775L9.4304 3.30856V3.98977C9.4304 4.36444 9.44022 4.67098 9.45495 4.67098C9.50404 4.67098 12.5725 2.36946 12.5725 2.3354C12.5725 2.30134 9.50404 -0.000179291 9.45495 -0.000179291C9.44022 -0.000179291 9.4304 0.369621 9.4304 0.827005Z"
                                fill="#111111" />
                              <path
                                d="M16.0134 3.6345C15.6354 3.91672 15.331 4.16487 15.3457 4.18434C15.3604 4.20867 15.5077 4.30112 15.6795 4.39357C17.118 5.20129 18.4583 6.56371 19.288 8.07697C19.7888 8.98687 20.211 10.3104 20.3288 11.3419C20.427 12.1545 20.3681 13.551 20.211 14.2906C19.5335 17.4728 17.2997 20.0371 14.2165 21.1757C13.8287 21.3168 12.778 21.6039 12.6406 21.6039C12.5866 21.6039 12.5718 21.4822 12.5718 20.9227C12.5718 20.548 12.562 20.2414 12.5473 20.2414C12.4982 20.2414 9.42976 22.543 9.42976 22.577C9.42976 22.6111 12.4982 24.9126 12.5473 24.9126C12.562 24.9126 12.5718 24.5428 12.5718 24.0854V23.2631L12.7584 23.2339C13.215 23.1609 14.5062 22.8154 14.9284 22.65C18.7578 21.1659 21.3795 17.8767 21.9244 13.8673C22.0668 12.8357 22.003 11.2203 21.7771 10.1693C21.1929 7.40549 19.3813 4.81202 16.9855 3.2939L16.7056 3.11873L16.0134 3.6345Z"
                                fill="#111111" />
                            </svg>
                          </button>
                        </div>
                      </div>
                      <a href="shop-details.html">
                        <h4 class="product-title line-clamp-1">Envole Pendant Light</h4>
                      </a>
                      <div class="product-review">
                        <div class="product-ratting">
                          <i class="ri-star-s-fill"></i>
                          <i class="ri-star-s-fill"></i>
                          <i class="ri-star-s-fill"></i>
                          <i class="ri-star-s-fill"></i>
                          <i class="ri-star-s-fill"></i>
                        </div>
                        <p class="count-ratting">(20)</p>
                      </div>
                      <div class="cart-card best-product-cart-card d-none d-md-block">
                        <a href="shop-details.html">
                          <h4 class="product-title line-clamp-1">Envole Pendant Light</h4>
                        </a>
                        <div class="product-review">
                          <div class="product-ratting">
                            <i class="ri-star-s-fill"></i>
                            <i class="ri-star-s-fill"></i>
                            <i class="ri-star-s-fill"></i>
                            <i class="ri-star-s-fill"></i>
                            <i class="ri-star-s-fill"></i>
                          </div>
                          <p class="count-ratting">(20)</p>
                        </div>
                        <div class="button-section">
                          <a href="javascript:void(0)" class=" cart-btn">Add to Cart</a>
                          <div class="fill-pill-btn qty-btn">
                            <div class="qty-container best-product-qty-container">
                              <div class="qty-btn-minus qty-btn mr-1">
                                <i class="ri-subtract-fill"></i>
                              </div>
                              <input type="text" name="qty" value="0" class="input-qty input-rounded">
                              <div class="qty-btn-plus qty-btn ml-1">
                                <i class="ri-add-fill"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="button-section d-block d-md-none">
                        <a href="javascript:void(0)" class=" cart-btn">Add to Cart</a>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="product-card best-product-card">
                      <div class="top-card">
                        <div class="price-section">
                          <h4 class="price discounted">$500</h4>
                          <h4 class="price text-color-primary">$460</h4>
                        </div>
                        <button class="wishlist-icon">
                          <img src="assets/images/icon/wish-icon-2.png" alt="img">
                        </button>
                      </div>
                      <div class="product-img-card best-product-img-card">
                        <a href="shop-details.html">
                          <img src="assets/images/product/product-8.png" alt="img">
                        </a>
                        <div class="discount-badge">
                          <span class="percentage">- 45%</span>
                        </div>
                        <div class="special-icon">
                          <button class="icon-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="19" viewBox="0 0 21 19"
                              fill="none">
                              <path
                                d="M0.978546 2.56816V5.13649H1.65442H2.33029V3.71701V2.292L5.45619 5.35743L8.58209 8.42285L9.07209 7.9368L9.56773 7.45628L6.44183 4.39085L3.31593 1.32542H4.76905H6.21654V0.662629V-0.000165939H3.59754H0.978546V2.56816Z"
                                fill="#111111" />
                              <path
                                d="M15.1167 0.662629V1.32542H16.5642H18.0173L14.8914 4.39085L11.7655 7.45628L12.2611 7.9368L12.7511 8.42285L15.877 5.35743L19.0029 2.292V3.71701V5.13649H19.6788H20.3547V2.56816V-0.000165939H17.7357H15.1167V0.662629Z"
                                fill="#111111" />
                              <path
                                d="M5.43926 13.6535L2.33026 16.7078V15.2828V13.8633H1.65439H0.978516V16.4317V19H3.59751H6.21651V18.3372V17.6744H4.76902H3.3159L6.4418 14.609L9.5677 11.5436L9.08896 11.0741C8.82988 10.8145 8.59895 10.6046 8.58206 10.6046C8.56516 10.6046 7.15146 11.9799 5.43926 13.6535Z"
                                fill="#111111" />
                              <path
                                d="M12.2442 11.0741L11.7655 11.5436L14.8914 14.609L18.0173 17.6744H16.5641H15.1167V18.3372V19H17.7356H20.3546V16.4317V13.8633H19.6788H19.0029V15.2828V16.7078L15.8883 13.6535C14.1817 11.9799 12.768 10.6046 12.7511 10.6046C12.7342 10.6046 12.5033 10.8145 12.2442 11.0741Z"
                                fill="#111111" />
                            </svg>
                          </button>
                          <button class="icon-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="25" viewBox="0 0 22 25"
                              fill="none">
                              <path
                                d="M9.4304 0.827005C9.4304 1.27952 9.41567 1.65419 9.40094 1.65419C9.38622 1.65419 9.14565 1.69798 8.87563 1.75637C4.21162 2.6906 0.73079 6.34481 0.0827378 10.9868C-0.0694564 12.0475 -0.00563302 13.663 0.225113 14.7432C0.809342 17.5069 2.62094 20.1004 5.01677 21.6185L5.29661 21.7937L5.98885 21.2779C6.36688 20.9957 6.68109 20.7524 6.68109 20.733C6.68109 20.7184 6.55835 20.6405 6.41107 20.5627C5.65992 20.1734 4.68293 19.3949 4.02015 18.6601C2.76332 17.2636 1.95816 15.5606 1.69796 13.77C1.60468 13.1083 1.60468 11.7945 1.69796 11.1668C1.89925 9.83845 2.37056 8.58308 3.07753 7.48341C3.96123 6.11612 5.30643 4.91914 6.77928 4.1844C7.52552 3.8146 8.56142 3.46426 9.2733 3.33775L9.4304 3.30856V3.98977C9.4304 4.36444 9.44022 4.67098 9.45495 4.67098C9.50404 4.67098 12.5725 2.36946 12.5725 2.3354C12.5725 2.30134 9.50404 -0.000179291 9.45495 -0.000179291C9.44022 -0.000179291 9.4304 0.369621 9.4304 0.827005Z"
                                fill="#111111" />
                              <path
                                d="M16.0134 3.6345C15.6354 3.91672 15.331 4.16487 15.3457 4.18434C15.3604 4.20867 15.5077 4.30112 15.6795 4.39357C17.118 5.20129 18.4583 6.56371 19.288 8.07697C19.7888 8.98687 20.211 10.3104 20.3288 11.3419C20.427 12.1545 20.3681 13.551 20.211 14.2906C19.5335 17.4728 17.2997 20.0371 14.2165 21.1757C13.8287 21.3168 12.778 21.6039 12.6406 21.6039C12.5866 21.6039 12.5718 21.4822 12.5718 20.9227C12.5718 20.548 12.562 20.2414 12.5473 20.2414C12.4982 20.2414 9.42976 22.543 9.42976 22.577C9.42976 22.6111 12.4982 24.9126 12.5473 24.9126C12.562 24.9126 12.5718 24.5428 12.5718 24.0854V23.2631L12.7584 23.2339C13.215 23.1609 14.5062 22.8154 14.9284 22.65C18.7578 21.1659 21.3795 17.8767 21.9244 13.8673C22.0668 12.8357 22.003 11.2203 21.7771 10.1693C21.1929 7.40549 19.3813 4.81202 16.9855 3.2939L16.7056 3.11873L16.0134 3.6345Z"
                                fill="#111111" />
                            </svg>
                          </button>
                        </div>
                      </div>
                      <a href="shop-details.html">
                        <h4 class="product-title line-clamp-1">Otello Armchair Ghini</h4>
                      </a>
                      <div class="product-review">
                        <div class="product-ratting">
                          <i class="ri-star-s-fill"></i>
                          <i class="ri-star-s-fill"></i>
                          <i class="ri-star-s-fill"></i>
                          <i class="ri-star-s-fill"></i>
                          <i class="ri-star-s-fill"></i>
                        </div>
                        <p class="count-ratting">(41)</p>
                      </div>
                      <div class="cart-card best-product-cart-card d-none d-md-block">
                        <a href="shop-details.html">
                          <h4 class="product-title line-clamp-1">Otello Armchair Ghini</h4>
                        </a>
                        <div class="product-review">
                          <div class="product-ratting">
                            <i class="ri-star-s-fill"></i>
                            <i class="ri-star-s-fill"></i>
                            <i class="ri-star-s-fill"></i>
                            <i class="ri-star-s-fill"></i>
                            <i class="ri-star-s-fill"></i>
                          </div>
                          <p class="count-ratting">(41)</p>
                        </div>
                        <div class="button-section">
                          <a href="javascript:void(0)" class=" cart-btn">Add to Cart</a>
                          <div class="fill-pill-btn qty-btn">
                            <div class="qty-container best-product-qty-container">
                              <div class="qty-btn-minus qty-btn mr-1">
                                <i class="ri-subtract-fill"></i>
                              </div>
                              <input type="text" name="qty" value="0" class="input-qty input-rounded">
                              <div class="qty-btn-plus qty-btn ml-1">
                                <i class="ri-add-fill"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="button-section d-block d-md-none">
                        <a href="javascript:void(0)" class=" cart-btn">Add to Cart</a>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="product-card best-product-card">
                      <div class="top-card">
                        <div class="price-section">
                          <h4 class="price text-color-primary">$300</h4>
                        </div>
                        <button class="wishlist-icon">
                          <img src="assets/images/icon/wish-icon-2.png" alt="img">
                        </button>
                      </div>
                      <div class="product-img-card best-product-img-card">
                        <a href="shop-details.html">
                          <img src="assets/images/product/product-9.png" alt="img">
                        </a>
                        <div class="special-icon">
                          <button class="icon-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="19" viewBox="0 0 21 19"
                              fill="none">
                              <path
                                d="M0.978546 2.56816V5.13649H1.65442H2.33029V3.71701V2.292L5.45619 5.35743L8.58209 8.42285L9.07209 7.9368L9.56773 7.45628L6.44183 4.39085L3.31593 1.32542H4.76905H6.21654V0.662629V-0.000165939H3.59754H0.978546V2.56816Z"
                                fill="#111111" />
                              <path
                                d="M15.1167 0.662629V1.32542H16.5642H18.0173L14.8914 4.39085L11.7655 7.45628L12.2611 7.9368L12.7511 8.42285L15.877 5.35743L19.0029 2.292V3.71701V5.13649H19.6788H20.3547V2.56816V-0.000165939H17.7357H15.1167V0.662629Z"
                                fill="#111111" />
                              <path
                                d="M5.43926 13.6535L2.33026 16.7078V15.2828V13.8633H1.65439H0.978516V16.4317V19H3.59751H6.21651V18.3372V17.6744H4.76902H3.3159L6.4418 14.609L9.5677 11.5436L9.08896 11.0741C8.82988 10.8145 8.59895 10.6046 8.58206 10.6046C8.56516 10.6046 7.15146 11.9799 5.43926 13.6535Z"
                                fill="#111111" />
                              <path
                                d="M12.2442 11.0741L11.7655 11.5436L14.8914 14.609L18.0173 17.6744H16.5641H15.1167V18.3372V19H17.7356H20.3546V16.4317V13.8633H19.6788H19.0029V15.2828V16.7078L15.8883 13.6535C14.1817 11.9799 12.768 10.6046 12.7511 10.6046C12.7342 10.6046 12.5033 10.8145 12.2442 11.0741Z"
                                fill="#111111" />
                            </svg>
                          </button>
                          <button class="icon-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="25" viewBox="0 0 22 25"
                              fill="none">
                              <path
                                d="M9.4304 0.827005C9.4304 1.27952 9.41567 1.65419 9.40094 1.65419C9.38622 1.65419 9.14565 1.69798 8.87563 1.75637C4.21162 2.6906 0.73079 6.34481 0.0827378 10.9868C-0.0694564 12.0475 -0.00563302 13.663 0.225113 14.7432C0.809342 17.5069 2.62094 20.1004 5.01677 21.6185L5.29661 21.7937L5.98885 21.2779C6.36688 20.9957 6.68109 20.7524 6.68109 20.733C6.68109 20.7184 6.55835 20.6405 6.41107 20.5627C5.65992 20.1734 4.68293 19.3949 4.02015 18.6601C2.76332 17.2636 1.95816 15.5606 1.69796 13.77C1.60468 13.1083 1.60468 11.7945 1.69796 11.1668C1.89925 9.83845 2.37056 8.58308 3.07753 7.48341C3.96123 6.11612 5.30643 4.91914 6.77928 4.1844C7.52552 3.8146 8.56142 3.46426 9.2733 3.33775L9.4304 3.30856V3.98977C9.4304 4.36444 9.44022 4.67098 9.45495 4.67098C9.50404 4.67098 12.5725 2.36946 12.5725 2.3354C12.5725 2.30134 9.50404 -0.000179291 9.45495 -0.000179291C9.44022 -0.000179291 9.4304 0.369621 9.4304 0.827005Z"
                                fill="#111111" />
                              <path
                                d="M16.0134 3.6345C15.6354 3.91672 15.331 4.16487 15.3457 4.18434C15.3604 4.20867 15.5077 4.30112 15.6795 4.39357C17.118 5.20129 18.4583 6.56371 19.288 8.07697C19.7888 8.98687 20.211 10.3104 20.3288 11.3419C20.427 12.1545 20.3681 13.551 20.211 14.2906C19.5335 17.4728 17.2997 20.0371 14.2165 21.1757C13.8287 21.3168 12.778 21.6039 12.6406 21.6039C12.5866 21.6039 12.5718 21.4822 12.5718 20.9227C12.5718 20.548 12.562 20.2414 12.5473 20.2414C12.4982 20.2414 9.42976 22.543 9.42976 22.577C9.42976 22.6111 12.4982 24.9126 12.5473 24.9126C12.562 24.9126 12.5718 24.5428 12.5718 24.0854V23.2631L12.7584 23.2339C13.215 23.1609 14.5062 22.8154 14.9284 22.65C18.7578 21.1659 21.3795 17.8767 21.9244 13.8673C22.0668 12.8357 22.003 11.2203 21.7771 10.1693C21.1929 7.40549 19.3813 4.81202 16.9855 3.2939L16.7056 3.11873L16.0134 3.6345Z"
                                fill="#111111" />
                            </svg>
                          </button>
                        </div>
                      </div>
                      <a href="shop-details.html">
                        <h4 class="product-title line-clamp-1">Orca is an Armchair</h4>
                      </a>
                      <div class="product-review">
                        <div class="product-ratting">
                          <i class="ri-star-s-fill"></i>
                          <i class="ri-star-s-fill"></i>
                          <i class="ri-star-s-fill"></i>
                          <i class="ri-star-s-fill"></i>
                          <i class="ri-star-s-fill"></i>
                        </div>
                        <p class="count-ratting">(25)</p>
                      </div>
                      <div class="cart-card best-product-cart-card d-none d-md-block">
                        <a href="shop-details.html">
                          <h4 class="product-title line-clamp-1">Orca is an Armchair</h4>
                        </a>
                        <div class="product-review">
                          <div class="product-ratting">
                            <i class="ri-star-s-fill"></i>
                            <i class="ri-star-s-fill"></i>
                            <i class="ri-star-s-fill"></i>
                            <i class="ri-star-s-fill"></i>
                            <i class="ri-star-s-fill"></i>
                          </div>
                          <p class="count-ratting">(25)</p>
                        </div>
                        <div class="button-section">
                          <a href="javascript:void(0)" class=" cart-btn">Add to Cart</a>
                          <div class="fill-pill-btn qty-btn">
                            <div class="qty-container best-product-qty-container">
                              <div class="qty-btn-minus qty-btn mr-1">
                                <i class="ri-subtract-fill"></i>
                              </div>
                              <input type="text" name="qty" value="0" class="input-qty input-rounded">
                              <div class="qty-btn-plus qty-btn ml-1">
                                <i class="ri-add-fill"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="button-section d-block d-md-none">
                        <a href="javascript:void(0)" class=" cart-btn">Add to Cart</a>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="product-card best-product-card">
                      <div class="top-card">
                        <div class="price-section">
                          <h4 class="price text-color-primary">$500</h4>
                        </div>
                        <button class="wishlist-icon">
                          <img src="assets/images/icon/wish-icon-2.png" alt="img">
                        </button>
                      </div>
                      <div class="product-img-card best-product-img-card">
                        <a href="shop-details.html">
                          <img src="assets/images/product/product-10.png" alt="img">
                        </a>
                        <div class="special-icon">
                          <button class="icon-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="19" viewBox="0 0 21 19"
                              fill="none">
                              <path
                                d="M0.978546 2.56816V5.13649H1.65442H2.33029V3.71701V2.292L5.45619 5.35743L8.58209 8.42285L9.07209 7.9368L9.56773 7.45628L6.44183 4.39085L3.31593 1.32542H4.76905H6.21654V0.662629V-0.000165939H3.59754H0.978546V2.56816Z"
                                fill="#111111" />
                              <path
                                d="M15.1167 0.662629V1.32542H16.5642H18.0173L14.8914 4.39085L11.7655 7.45628L12.2611 7.9368L12.7511 8.42285L15.877 5.35743L19.0029 2.292V3.71701V5.13649H19.6788H20.3547V2.56816V-0.000165939H17.7357H15.1167V0.662629Z"
                                fill="#111111" />
                              <path
                                d="M5.43926 13.6535L2.33026 16.7078V15.2828V13.8633H1.65439H0.978516V16.4317V19H3.59751H6.21651V18.3372V17.6744H4.76902H3.3159L6.4418 14.609L9.5677 11.5436L9.08896 11.0741C8.82988 10.8145 8.59895 10.6046 8.58206 10.6046C8.56516 10.6046 7.15146 11.9799 5.43926 13.6535Z"
                                fill="#111111" />
                              <path
                                d="M12.2442 11.0741L11.7655 11.5436L14.8914 14.609L18.0173 17.6744H16.5641H15.1167V18.3372V19H17.7356H20.3546V16.4317V13.8633H19.6788H19.0029V15.2828V16.7078L15.8883 13.6535C14.1817 11.9799 12.768 10.6046 12.7511 10.6046C12.7342 10.6046 12.5033 10.8145 12.2442 11.0741Z"
                                fill="#111111" />
                            </svg>
                          </button>
                          <button class="icon-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="25" viewBox="0 0 22 25"
                              fill="none">
                              <path
                                d="M9.4304 0.827005C9.4304 1.27952 9.41567 1.65419 9.40094 1.65419C9.38622 1.65419 9.14565 1.69798 8.87563 1.75637C4.21162 2.6906 0.73079 6.34481 0.0827378 10.9868C-0.0694564 12.0475 -0.00563302 13.663 0.225113 14.7432C0.809342 17.5069 2.62094 20.1004 5.01677 21.6185L5.29661 21.7937L5.98885 21.2779C6.36688 20.9957 6.68109 20.7524 6.68109 20.733C6.68109 20.7184 6.55835 20.6405 6.41107 20.5627C5.65992 20.1734 4.68293 19.3949 4.02015 18.6601C2.76332 17.2636 1.95816 15.5606 1.69796 13.77C1.60468 13.1083 1.60468 11.7945 1.69796 11.1668C1.89925 9.83845 2.37056 8.58308 3.07753 7.48341C3.96123 6.11612 5.30643 4.91914 6.77928 4.1844C7.52552 3.8146 8.56142 3.46426 9.2733 3.33775L9.4304 3.30856V3.98977C9.4304 4.36444 9.44022 4.67098 9.45495 4.67098C9.50404 4.67098 12.5725 2.36946 12.5725 2.3354C12.5725 2.30134 9.50404 -0.000179291 9.45495 -0.000179291C9.44022 -0.000179291 9.4304 0.369621 9.4304 0.827005Z"
                                fill="#111111" />
                              <path
                                d="M16.0134 3.6345C15.6354 3.91672 15.331 4.16487 15.3457 4.18434C15.3604 4.20867 15.5077 4.30112 15.6795 4.39357C17.118 5.20129 18.4583 6.56371 19.288 8.07697C19.7888 8.98687 20.211 10.3104 20.3288 11.3419C20.427 12.1545 20.3681 13.551 20.211 14.2906C19.5335 17.4728 17.2997 20.0371 14.2165 21.1757C13.8287 21.3168 12.778 21.6039 12.6406 21.6039C12.5866 21.6039 12.5718 21.4822 12.5718 20.9227C12.5718 20.548 12.562 20.2414 12.5473 20.2414C12.4982 20.2414 9.42976 22.543 9.42976 22.577C9.42976 22.6111 12.4982 24.9126 12.5473 24.9126C12.562 24.9126 12.5718 24.5428 12.5718 24.0854V23.2631L12.7584 23.2339C13.215 23.1609 14.5062 22.8154 14.9284 22.65C18.7578 21.1659 21.3795 17.8767 21.9244 13.8673C22.0668 12.8357 22.003 11.2203 21.7771 10.1693C21.1929 7.40549 19.3813 4.81202 16.9855 3.2939L16.7056 3.11873L16.0134 3.6345Z"
                                fill="#111111" />
                            </svg>
                          </button>
                        </div>
                      </div>
                      <a href="shop-details.html">
                        <h4 class="product-title line-clamp-1">Kelly Bracelet Amchair</h4>
                      </a>
                      <div class="product-review">
                        <div class="product-ratting">
                          <i class="ri-star-s-fill"></i>
                          <i class="ri-star-s-fill"></i>
                          <i class="ri-star-s-fill"></i>
                          <i class="ri-star-s-fill"></i>
                          <i class="ri-star-s-fill"></i>
                        </div>
                        <p class="count-ratting">(22)</p>
                      </div>
                      <div class="cart-card best-product-cart-card d-none d-md-block">
                        <a href="shop-details.html">
                          <h4 class="product-title line-clamp-1">Kelly Bracelet Amchair</h4>
                        </a>
                        <div class="product-review">
                          <div class="product-ratting">
                            <i class="ri-star-s-fill"></i>
                            <i class="ri-star-s-fill"></i>
                            <i class="ri-star-s-fill"></i>
                            <i class="ri-star-s-fill"></i>
                            <i class="ri-star-s-fill"></i>
                          </div>
                          <p class="count-ratting">(22)</p>
                        </div>
                        <div class="button-section">
                          <a href="javascript:void(0)" class=" cart-btn">Add to Cart</a>
                          <div class="fill-pill-btn qty-btn">
                            <div class="qty-container best-product-qty-container">
                              <div class="qty-btn-minus qty-btn mr-1">
                                <i class="ri-subtract-fill"></i>
                              </div>
                              <input type="text" name="qty" value="0" class="input-qty input-rounded">
                              <div class="qty-btn-plus qty-btn ml-1">
                                <i class="ri-add-fill"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="button-section d-block d-md-none">
                        <a href="javascript:void(0)" class=" cart-btn">Add to Cart</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="swiper-button-next swiper-common-btn"><i class="ri-arrow-right-s-line"></i></div>
                <div class="swiper-button-prev swiper-common-btn"><i class="ri-arrow-left-s-line"></i></div>
              </div>
            </div>
          </div>
        </div>

      </section>
      <!-- End-of Related Product -->
      <!-- subscription area S t a r t -->
      <section class="subscription-area subscription-bg">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="subscription-wrapper">
                <div class="left-wrapper">
                  <div class="subscription-content">
                    <h4 class="title">Get a surprise discount</h4>
                    <p class="pera">Join our email subscription now</p>
                  </div>
                  <div class="subscription-input-section">
                    <input type="text" class="subscription-input" placeholder="Enter your email address">
                    <button type="submit" class="subscribe-btn"><span class="btn-text">Subscribe</span><span
                        class="icon"><i class="ri-arrow-right-line"></i></span></button>
                  </div>
                </div>
                <div class="right-wrapper">
                  <div class="subscription-content">
                    <h4 class="title">Download App</h4>
                    <p class="pera">Save $3 With App & New User only</p>
                  </div>
                  <div class="download-app">
                    <a href="javascript:void(0)" target="_blank">
                      <img src="assets/images/icon/google-play.png" alt="img">
                    </a>
                    <a href="javascript:void(0)" target="_blank">
                      <img src="assets/images/icon/app-store.png" alt="img">
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    </main>



    <!-- Modal -->
    @include('layouts.front-end.partials.modal._chatting',['seller'=>$product->seller])

    <div class="modal fade" id="remove-wishlist-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-5">
                    <div class="text-center">
                        <img src="{{asset('/public/assets/front-end/img/icons/remove-wishlist.png')}}" alt="">
                        <h6 class="font-semibold mt-3 mb-4 mx-auto __max-w-220">{{translate('Product_has_been_removed_from_wishlist')}}?</h6>
                    </div>
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="javascript:" class="btn btn--primary __rounded-10" data-dismiss="modal">
                            {{translate('Okay')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            const $stickyElement = $('.bottom-sticky');
            const $offsetElement = $('.product-details-shipping-details');

            $(window).on('scroll', function() {
                const elementOffset = $offsetElement.offset().top;
                const scrollTop = $(window).scrollTop();

                if (scrollTop >= elementOffset) {
                    $stickyElement.addClass('stick');
                } else {
                    $stickyElement.removeClass('stick');
                }
            });
        });
    </script>

    <script type="text/javascript">
        cartQuantityInitialize();
        getVariantPrice();
        $('#add-to-cart-form input').on('change', function () {
            getVariantPrice();
        });

        function showInstaImage(link) {
            $("#attachment-view").attr("src", link);
            $('#show-modal-view').modal('toggle')
        }

        function focus_preview_image_by_color(key){
            $('a[href="#image'+key+'"]')[0].click();
        }
    </script>
    <script>
        let load_review_count = 1;
        function load_review()
        {

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
            $.ajax({
                    type: "post",
                    url: '{{route('review-list-product')}}',
                    data:{
                        product_id:{{$product->id}},
                        offset:load_review_count
                    },
                    success: function (data) {
                        $('#product-review-list').append(data.productReview)
                        if(data.checkReviews == 0){
                            $('.view_more_button').removeClass('d-none').addClass('d-none')
                        }else{
                            $('.view_more_button').addClass('d-none').removeClass('d-none')
                        }
                    }
                });
                load_review_count++
        }
    </script>

    {{-- Messaging with shop seller --}}
    <script>
         $('#chat-form').on('submit', function (e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: '{{route('messages_store')}}',
                data: $('#chat-form').serialize(),
                success: function (respons) {

                    toastr.success('{{translate("message_send_successfully")}}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    $('#chat-form').trigger('reset');
                }
            });

        });
    </script>

    <script type="text/javascript"
            src="https://platform-api.sharethis.com/js/sharethis.js#property=5f55f75bde227f0012147049&product=sticky-share-buttons"
            async="async"></script>
@endpush
