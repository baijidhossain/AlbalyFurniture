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
  .quantity-section .quantity-btn .qty-minus {
    position: absolute;
    top: 12px;
    right: 16px;
    cursor: pointer;
    background-color: transparent;
    border: none;
    height: 0;
}
.quantity-section .quantity-btn .qty-plus {
    position: absolute;
    right: 16px;
    top: -3px;
    cursor: pointer;
    background-color: transparent;
    border: none;
    height: 0;
}

.quantity-section .quantity-btn .qty-count {
    border: none;
    background-color: transparent;
    min-width: 20px;
}
</style>

@endpush

@section('content')
  
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
                      
                        <img class="xzoom" src="https://wodmart.vercel.app/assets/images/product/main-img-02.png"
                            xoriginal="https://wodmart.vercel.app/assets/images/product/main-img-02.png" data-fancybox="gallery" alt="img">


                        <div class="shape-01">
                            <img src="https://wodmart.vercel.app/assets/images/product/preview-shape-01.png" alt="img">
                        </div>

                        <div class="shape-02">
                            <img src="https://wodmart.vercel.app/assets/images/product/preview-shape-02.png" alt="img">
                        </div>

                    </div>

                    <div class="xzoom-thumbs">

                      <div class="xzoom-gallery-box">
                          <a href="https://wodmart.vercel.app/assets/images/product/main-img-01.png">
                              <img class="xzoom-gallery xactive" width="80" src="https://wodmart.vercel.app/assets/images/product/main-img-01.png" xpreview="https://wodmart.vercel.app/assets/images/product/main-img-01.png" data-fancybox="gallery" alt="img">
                          </a>
                      </div>

                      <div class="xzoom-gallery-box">
                          <a href="https://wodmart.vercel.app/assets/images/product/main-img-02.png">
                              <img class="xzoom-gallery" width="80" src="https://wodmart.vercel.app/assets/images/product/main-img-02.png" data-fancybox="gallery" alt="img">
                          </a>
                      </div>

                      <div class="xzoom-gallery-box">
                          <a href="https://wodmart.vercel.app/assets/images/product/main-img-03.png">
                              <img class="xzoom-gallery" width="80" src="https://wodmart.vercel.app/assets/images/product/main-img-03.png" data-fancybox="gallery" alt="img">
                          </a>
                      </div>

                      <div class="xzoom-gallery-box">
                          <a href="https://wodmart.vercel.app/assets/images/product/main-img-04.png">
                              <img class="xzoom-gallery" width="80" src="https://wodmart.vercel.app/assets/images/product/main-img-04.png" data-fancybox="gallery" alt="img">
                          </a>
                      </div>

                      <div class="xzoom-gallery-box">
                          <a href="https://wodmart.vercel.app/assets/images/product/main-img-02.png">
                              <img class="xzoom-gallery" width="80" src="https://wodmart.vercel.app/assets/images/product/main-img-02.png" data-fancybox="gallery" alt="img">
                          </a>
                      </div>

                  </div>

                </div>
            </div>

            <div class="col-xxl-6 col-lg-6">
              <div class="product-details-content">
                <div class="first-section">
                  <div class="category-name">

                    <p class="pera"><span class="highlight">Category: </span>

                      {{ implode(', ', $categories->pluck('name')->toArray()) }}

                    </p>

                  </div>

                  <h4 class="product-name">{{ $product->name }}</h4>

                  <div class="product-price-section">

                    <div class="price-section">

                    @if($product->discount > 0)
                    <h4 class="price discounted">{{\App\CPU\Helpers::currency_converter($product->unit_price)}}</h4>
                    @endif

                      <h4 class="price">
                        {{\App\CPU\Helpers::currency_converter($product->unit_price-(\App\CPU\Helpers::get_product_discount($product,$product->unit_price)))}}
                      </h4>

                    </div>


                    <div class="ratting-section">

                      @if($overallRating[0] != 0 )
                      <div class="product-ratting">
                        @for($inc=1;$inc<=5;$inc++) @if ($inc <=(int)$overallRating[0]) <i class="ri-star-s-fill text-warning"></i>
                          @elseif ($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0]>
                            ((int)$overallRating[0]))
                            <i class="ri-star-s-fill-half text-warning"></i>
                            @else
                            <i class="ri-star-s-half-fill text-warning"></i>
                            @endif
                            @endfor
                      </div>
                      @endif
                
                      <p class="count-ratting"> {{$product->reviews_count}} Reviews</p>
                
                    </div>

                  </div>


                  <div class="stock-section">
                    <p class="stock-count highlight">{{ $product->current_stock }} In stock</p>
                    <p class="stock-count">( Sold {{ $countOrder }} Products )</p>
                  </div>
                  <div class="divider"></div>
                </div>

                <form id="add-to-cart-form" class="mb-2">
                  @csrf
                  <input type="hidden" name="id" value="{{ $product->id }}">

                  <div class="second-section">
                    <div class="product-desc">

                      {{-- <div class="color-palatte">
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
                      </div> --}}
                      <div class="d-flex gap-16 flex-wrap">

                        <div class="wish-list">

                          <i class="{{($wishlist_status == 1 ? 'ri-heart-3-fill':'ri-heart-3-line')}}  wish-lish-icon   wishlist_icon_{{$product['id']}}"></i>

                          <a href="javascript:void(0)" onclick="addWishlist('{{$product['id']}}')">
                            <p class="pera">add to wishlist</p>
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

                            <input type="text" name="quantity" class="input-number text-center cart-qty-field qty-count" placeholder="1"
                              value="{{ $product->minimum_order_qty ?? 1 }}" product-type="{{ $product->product_type }}"
                              min="{{ $product->minimum_order_qty ?? 1 }}"
                              max="{{$product['product_type'] == 'physical' ? $product->current_stock : 100}}">

                            <button class="increase-num btn-number" type="button" product-type="{{ $product->product_type }}" data-type="plus"
                              data-field="quantity">
                              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="6" viewBox="0 0 12 6" fill="none">
                                <path
                                  d="M0 5.36618C0.0532405 5.553 0.143084 5.71647 0.319443 5.84199C0.618921 6.04924 1.0515 6.05508 1.35098 5.84491C1.40755 5.80404 1.46411 5.76026 1.51735 5.71355C2.97481 4.43501 4.4356 3.15355 5.89306 1.875C5.92633 1.84581 5.95295 1.81078 6.03281 1.75824C6.0561 1.79327 6.06941 1.83705 6.10269 1.86625C7.57346 3.15938 9.04755 4.4496 10.5183 5.74274C10.7779 5.97043 11.0773 6.058 11.4367 5.95875C11.9591 5.8128 12.1721 5.22315 11.8427 4.83784C11.8061 4.79405 11.7628 4.75318 11.7196 4.71232C10.0225 3.2236 8.32881 1.73489 6.63177 0.249093C6.32231 -0.0223789 5.92966 -0.0749219 5.57361 0.106059C5.4871 0.149845 5.41056 0.214063 5.34069 0.275363C3.69356 1.72029 2.04976 3.16522 0.399304 4.60723C0.216289 4.76778 0.0532405 4.93125 0 5.16185C0 5.22899 0 5.29613 0 5.36618Z"
                                  fill="currentColor"></path>
                              </svg>
                            </button>

                            <button class="decrease-num btn-number" type="button" product-type="{{ $product->product_type }}"
                              data-type="minus" data-field="quantity">
                              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="6" viewBox="0 0 12 6" fill="none">
                                <path
                                  d="M12 0.633816C11.9468 0.446997 11.8569 0.28353 11.6806 0.158011C11.3811 -0.0492418 10.9485 -0.0550799 10.649 0.155092C10.5925 0.195958 10.5359 0.239744 10.4826 0.286449C9.02519 1.56499 7.5644 2.84645 6.10694 4.125C6.07367 4.15419 6.04705 4.18922 5.96719 4.24176C5.9439 4.20673 5.93059 4.16294 5.89731 4.13375C4.42654 2.84062 2.95245 1.5504 1.48168 0.257257C1.22213 0.0295717 0.922652 -0.0579998 0.563279 0.0412478C0.0408569 0.1872 -0.172105 0.776848 0.157321 1.16216C0.193924 1.20595 0.237181 1.24681 0.280439 1.28768C1.97748 2.7764 3.67119 4.26511 5.36823 5.75091C5.67769 6.02238 6.07034 6.07492 6.42639 5.89394C6.5129 5.85015 6.58944 5.78594 6.65931 5.72464C8.30644 4.27971 9.95024 2.83478 11.6007 1.39277C11.7837 1.23222 11.9468 1.06875 12 0.838149C12 0.771011 12 0.703873 12 0.633816Z"
                                  fill="currentColor"></path>
                              </svg>
                            </button>

                          </div>

                          <a href="javascript:void(0)" onclick="addToCart()" class=" cart-btn">{{translate('add_to_cart')}}</a>

                        </div>

                      </div>

                    <div class="col-md-3">
                        <h4 class="label">Total Price</h4>
                    </div>

                    <div class="col-md-9">
                      {{-- <p class="info">100</p> --}}

                      <div id="chosen_price_div" class="d-flex align-items-center gap-2">

                        <p id="chosen_price" class="info"></p>
                     
                        <p>({{translate('tax')}} : <span id="set-tax-amount"></span> )</p>
                          
                    </div>

                   </div>


                  
                    </div>

                  </div>

                </form>

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
                      <button class="nav-link outline-pill-btn " id="pills-contact-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                        aria-selected="false">

                        Reviews {{ $overallRating[1]}}

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
                      <div class="pera">
                       {{ $product->details }}
                      </div>
                    
                    </div>
                    <!-- End Tab contents -->

                  </div>

                  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">.
                    <!-- Tab Content -->
                    <div class="review-list">

                          @foreach ($reviews_of_product as $productReview)
                          <div class="review-card">
                            <div class="wrap-user">

                              <div class="user-img">
                                <img class="rounded-circle __img-64 object-cover"
                                onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                src="{{asset("storage/app/public/profile")}}/{{(isset($productReview->user)?$productReview->user->image:'')}}"
                                alt="{{isset($productReview->user)?$productReview->user->f_name:'not exist'}}" />
                              </div>

                              <div class="wrap-info">
                                <div class="user-info">
                                  <div class="name-ratting">
                                    <div class="name-wrapper">
                                      <h4 class="name">{{isset( $productReview->user )? $productReview->user->f_name:translate('User_Not_Exist')}}</h4>

                                      <div class="ratting">

                                        @if($overallRating[0] != 0 )
                                        <div class="all-ratting">
                                          @for($inc=1;$inc<=5;$inc++)
                                          
                                          @if ($inc <=(int)$overallRating[0]) 
                                          <i class="ri-star-s-fill text-warning"></i>
                                            @elseif ($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0]>
                                              ((int)$overallRating[0]))
                                              <i class="ri-star-half-s-line text-warning"></i>
                                              @else
                                              <i class="ri-star-s-line text-warning"></i>
                                          @endif
                                          @endfor
                                        </div>
                                        @endif

                                        <p class="pera-sm">( {{ $overallRating[0] ? $overallRating[0] : 0 }} / 5  )</p>

                                      </div>


                                    </div>
                                    <div class="date">
                                      <p class="pera-sm">
                                        {{isset($productReview->updated_at) ? $productReview->updated_at->format('M-d-Y') : ''}}
                                      </p>
                                    </div>

                                  </div>
                                 
                                </div>
                                <div class="user-comment">
                                  <p class="pera"> {{$productReview->comment }} </p>
                                </div>

                              </div>
                            </div>
                          </div>
                          @endforeach


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
          <section class="feature-area feature-bg position-relative">
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <div class="section-title">
                    <h4 class="title">Related Products</h4>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="swiper featureSwiper-active">
                    <div class="swiper-wrapper">

                      @foreach($relatedProducts as $product)

                      @include('web-views.partials._feature-product',['product'=>$product, 'decimal_point_settings'=>$decimal_point_settings])

                      @endforeach
                
                    </div>
                    <div class="swiper-button-next swiper-common-btn"><i class="ri-arrow-right-s-line"></i></div>
                    <div class="swiper-button-prev swiper-common-btn"><i class="ri-arrow-left-s-line"></i></div>
                  </div>
                </div>
              </div>
            </div>
          </section>
      <!-- End-of Related Product -->

    </main>

    <!-- Modal -->
    @include('layouts.front-end.partials.modal._chatting',['seller'=>$product->seller])


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
