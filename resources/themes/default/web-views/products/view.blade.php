@extends('layouts.front-end.app')

@section('title',translate($data['data_from']).' '.translate('products'))

@push('css')
    <meta property="og:image" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']}}"/>
    <meta property="og:title" content="Products of {{$web_config['name']}} "/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description" content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)),0,160) }}">

    <meta property="twitter:card" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']}}"/>
    <meta property="twitter:title" content="Products of {{$web_config['name']}}"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description" content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)),0,160) }}">

    <style>
        .for-count-value {

        {{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 0.6875 rem;;
        }

        .for-count-value {

        {{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 0.6875 rem;
        }

        .for-brand-hover:hover {
            color: {{$web_config['primary_color']}};
        }

        .for-hover-lable:hover {
            color: {{$web_config['primary_color']}}       !important;
        }

        .page-item.active .page-link {
            background-color: {{$web_config['primary_color']}}      !important;
        }

        .for-shoting {
            padding- {{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 9px;
        }

        .sidepanel {
        {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 0;
        }
        .sidepanel .closebtn {
        {{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 25 px;
        }
        @media (max-width: 360px) {
            .for-shoting-mobile {
                margin- {{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 0% !important;
            }

            .for-mobile {

                margin- {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 10% !important;
            }

        }

        @media (max-width: 500px) {
            .for-mobile {

                margin- {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 27%;
            }
        }
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

@php($decimal_point_settings = \App\CPU\Helpers::get_business_settings('decimal_point_settings'))
 

    <main>
      <!-- Breadcrumbs S t a r t -->
      <section class="breadcrumb-section breadcrumb-bg">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="breadcrumb-text">
                <h1 class="title wow fadeInUp" data-wow-delay="0.1s">All Products</h1>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End-of Breadcrumbs-->
      <!-- product area S t a r t -->
      <section class="product-area section-padding">
        <div class="container">
          <div class="row g-4">
            <div class="col-xxl-9 col-xl-8">
              <div class="expand-icon hamburger block d-xl-none" id="hamburger">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <path
                    d="M3 7H10M10 7C10 8.65685 11.3431 10 13 10H14C15.6569 10 17 8.65685 17 7C17 5.34315 15.6569 4 14 4H13C11.3431 4 10 5.34315 10 7ZM16 17H21M20 7H21M3 17H6M6 17C6 18.6569 7.34315 20 9 20H10C11.6569 20 13 18.6569 13 17C13 15.3431 11.6569 14 10 14H9C7.34315 14 6 15.3431 6 17Z"
                    stroke="#071516" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </div>
         
             
                @if (count($products) > 0)

                  <div class="row g-4" id="ajax-products">
                    @include('web-views.products._ajax-products',['products'=>$products,'decimal_point_settings'=>$decimal_point_settings])
                  </div>

                @else

                  <div class="text-center pt-5 text-capitalize">

                    <img src="{{asset('public/assets/front-end/img/media/product.svg')}}" alt="Product">

                    <h5>{{translate('no_product_found')}}!</h5>

                    <p class="text-center text-muted">{{translate('sorry_no_data_found_related_to_your_search')}}</p>

                  </div>

                @endif

            </div>

            <div class="col-xxl-3 col-xl-4">
              <div class="search-filter-section">
                <div class="expand-icon close-btn block d-xl-none">
                  <i class="ri-arrow-left-double-line"></i>
                </div>

                <div class="search-box">

                  <form action="{{route('products')}}" class="search_form">

                  <input class="search-input" type="search" name="name" id="searchField" placeholder="Search Products">

                  <div class="icon cursor-pointer" onclick="$('.search_form').submit()">
                    <i class="ri-search-line"></i>
                  </div>

                  <input name="data_from" value="search" hidden>
                  <input name="page" value="1" hidden>
                  </form>

                </div>

                <div class="search-section">
                  <div class="heading">
                    <h4 class="title">Categories</h4>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="10" viewBox="0 0 20 10" fill="none">
                      <path
                        d="M20 1.05636C19.9113 0.744994 19.7615 0.47255 19.4676 0.263351C18.9685 -0.0820697 18.2475 -0.0917998 17.7484 0.258486C17.6541 0.326597 17.5598 0.399573 17.4711 0.477415C15.042 2.60832 12.6073 4.74409 10.1782 6.875C10.1228 6.92365 10.0784 6.98203 9.94531 7.0696C9.90649 7.01122 9.88431 6.93824 9.82885 6.88959C7.37757 4.73436 4.92074 2.58399 2.46946 0.428762C2.03688 0.0492861 1.53775 -0.0966664 0.938797 0.0687463C0.0680942 0.312 -0.286842 1.29475 0.262201 1.93694C0.323206 2.00991 0.395302 2.07802 0.467398 2.14614C3.2958 4.62733 6.11865 7.10852 8.94705 9.58485C9.46282 10.0373 10.1172 10.1249 10.7106 9.82323C10.8548 9.75026 10.9824 9.64323 11.0989 9.54106C13.8441 7.13285 16.5837 4.72463 19.3345 2.32128C19.6395 2.0537 19.9113 1.78126 20 1.39692C20 1.28502 20 1.17312 20 1.05636Z"
                        fill="currentColor" />
                    </svg>
                  </div>

                  <div class="offer-list">

                    @php($categories=\App\CPU\CategoryManager::parents())

                      @foreach($categories as $category)

                      <div class="d-flex">
                        
                        <div class="content  d-flex justify-content-between w-100">

                          <a class="pera cursor-hover cursor-pointer" href="javascript:void(0)" onclick="location.href='{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}'"> {{$category['name']}} </a>
                          <p class="pera">({{ \App\CPU\CategoryManager::products($category['id'])->count() }})</p>

                        </div>

                      </div>

                      @endforeach
                    
                  </div>
                </div>

      
              
                <div class="search-section">
                  <div class="heading">
                    <h4 class="title">Manufactures</h4>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="10" viewBox="0 0 20 10" fill="none">
                      <path
                        d="M20 1.05636C19.9113 0.744994 19.7615 0.47255 19.4676 0.263351C18.9685 -0.0820697 18.2475 -0.0917998 17.7484 0.258486C17.6541 0.326597 17.5598 0.399573 17.4711 0.477415C15.042 2.60832 12.6073 4.74409 10.1782 6.875C10.1228 6.92365 10.0784 6.98203 9.94531 7.0696C9.90649 7.01122 9.88431 6.93824 9.82885 6.88959C7.37757 4.73436 4.92074 2.58399 2.46946 0.428762C2.03688 0.0492861 1.53775 -0.0966664 0.938797 0.0687463C0.0680942 0.312 -0.286842 1.29475 0.262201 1.93694C0.323206 2.00991 0.395302 2.07802 0.467398 2.14614C3.2958 4.62733 6.11865 7.10852 8.94705 9.58485C9.46282 10.0373 10.1172 10.1249 10.7106 9.82323C10.8548 9.75026 10.9824 9.64323 11.0989 9.54106C13.8441 7.13285 16.5837 4.72463 19.3345 2.32128C19.6395 2.0537 19.9113 1.78126 20 1.39692C20 1.28502 20 1.17312 20 1.05636Z"
                        fill="currentColor" />
                    </svg>
                  </div>
                  <div class="offer-list">
                    
                    @foreach(\App\CPU\BrandManager::get_active_brands() as $brand)
                    <div class="d-flex">
                    
                      <div class="content d-flex justify-content-between w-100">

                        <a class="pera cursor-pointer" href="javascript:void(0)" onclick="location.href='{{route('products',['id'=> $brand['id'],'data_from'=>'brand','page'=>1])}}'">{{ $brand['name'] }}</a>

                        <p class="pera">  

                          @if($brand['brand_products_count'] > 0 )

                          ({{ $brand['brand_products_count'] }})

                          @else
                          (0)
                          @endif

                        </p>

                      </div>
                    </div>
                    @endforeach

                  </div>
                </div>

              </div>
              <div class="cover"></div>
            </div>

          </div>
    
        </div>
      </section>
      <!-- End-of goal-->

    </main>


@endsection

@push('script')
    <script>
      
        function openNav() {
            document.getElementById("mySidepanel").style.width = "70%";
            document.getElementById("mySidepanel").style.height = "100vh";
        }

        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
        }

        function filter(value) {
            $.get({
                url: '{{url('/')}}/products',
                data: {
                    id: '{{$data['id']}}',
                    name: '{{$data['name']}}',
                    data_from: '{{$data['data_from']}}',
                    min_price: '{{$data['min_price']}}',
                    max_price: '{{$data['max_price']}}',
                    sort_by: value
                },
                dataType: 'json',
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (response) {
                    $('#ajax-products').html(response.view);
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        }

        function searchByPrice() {
            let min = $('#min_price').val();
            let max = $('#max_price').val();
            $.get({
                url: '{{url('/')}}/products',
                data: {
                    id: '{{$data['id']}}',
                    name: '{{$data['name']}}',
                    data_from: '{{$data['data_from']}}',
                    sort_by: '{{$data['sort_by']}}',
                    min_price: min,
                    max_price: max,
                },
                dataType: 'json',
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (response) {
                    $('#ajax-products').html(response.view);
                    $('#paginator-ajax').html(response.paginator);
                    console.log(response.view);
                    $('#price-filter-count').text(response.total_product + ' {{translate('items_found')}}')
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        }

        $('#searchByFilterValue, #searchByFilterValue-m').change(function () {
            var url = $(this).val();
            if (url) {
                window.location = url;
            }
            return false;
        });

        $("#search-brand").on("keyup", function () {
            var value = this.value.toLowerCase().trim();
            $("#lista1 div>li").show().filter(function () {
                return $(this).text().toLowerCase().trim().indexOf(value) == -1;
            }).hide();
        });

		$(".menu--caret").on("click", function (e) {
			var element = $(this).closest(".menu--caret-accordion");
			if (element.hasClass("open")) {
				element.removeClass("open");
				element.find(".menu--caret-accordion").removeClass("open");
				element.find(".card-body").slideUp(300, "swing");
			} else {
				element.addClass("open");
				element.children(".card-body").slideDown(300, "swing");
				element.siblings(".menu--caret-accordion").children(".card-body").slideUp(300, "swing");
				element.siblings(".menu--caret-accordion").removeClass("open");
				element.siblings(".menu--caret-accordion").find(".menu--caret-accordion").removeClass("open");
				element.siblings(".menu--caret-accordion").find(".card-body").slideUp(300, "swing");
			}
		});


    </script>


@endpush
