@extends('layouts.front-end.app')

@push('css')

  <style>
    .deals-banner .shape .highlight-title {
      margin-top: 32px;
      margin-bottom: 8px;
      font-size: 40px;
      font-weight: 700;
      line-height: 1;
      color: var(--primary-color);
      text-align: center;
      line-height: 1;
      margin-left: -15px;
    }

    .deals-banner .shape .title {
      font-size: 26px;
      font-weight: 400;
      line-height: 1;
      color: var(--primary-title);
      text-align: center;
      margin-left: -10px;

    }

  </style>
@endpush

@section('content')
	<main>
    @php($decimal_point_settings = !empty(\App\CPU\Helpers::get_business_settings('decimal_point_settings')) ? \App\CPU\Helpers::get_business_settings('decimal_point_settings') : 0)
		
    <!-- Hero area S t a r t-->
		<section class="hero-area-bg hero-padding1">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="swiper heroSwiperOne-active">
							<div class="swiper-wrapper">


                @foreach($main_banner as $key=>$banner)
             
              <!-- Single Slider -->
								<div class="swiper-slide">
									<div class="hero-caption-one position-relative mx-auto wow fadeInUp" data-wow-delay="0.0s">
										<h4 class="title">
                      {{$banner['title']}}
										</h4>
									</div>

									<div class="text-center d-block wow fadeInUp" data-wow-delay="0.1s">
										<a href="{{ $banner['url'] }}" class="outline-pill-btn ">
											Explore Products
											<svg xmlns="http://www.w3.org/2000/svg" width="78" height="19"
												viewBox="0 0 78 19" fill="none">
												<path
													d="M66.918 10.9147C66.8987 10.9909 66.8754 11.0659 66.8482 11.1394C66.3343 12.5191 65.8568 13.9149 65.3832 15.3094C65.2835 15.6007 65.0431 15.8908 65.3278 16.3278C68.9295 13.4161 73.0932 11.4878 77.3487 9.65131C72.9717 7.73141 68.8104 5.59576 65.0804 2.61703C64.8556 3.06744 65.0978 3.36045 65.2072 3.6577C65.7259 5.06223 66.2433 6.47061 66.7965 7.85894C67.1854 8.84516 67.2283 9.92384 66.918 10.9147Z"
													fill="currentColor" />
												<rect y="8.90649" width="68" height="1" rx="0.5" fill="currentColor" />
											</svg>
										</a>
									</div>
									<div class="hero-image mx-auto wow fadeInUp" data-wow-delay="0.2s">
                    <img class="w-100 __slide-img"
                    onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                    src="{{asset('storage/app/public/banner')}}/{{$banner['photo']}}"
                    alt="">
									</div>
								</div>

                @endforeach

							</div>

							<div class="swiper-button-next"><i class="ri-arrow-right-s-line"></i></div>
							<div class="swiper-button-prev"><i class="ri-arrow-left-s-line"></i></div>
						</div>
					</div>
				</div>
			</div>
			<!-- shape 01 -->
			<div class="shape-one heartbeat2">
				<img src="{{URL("/")}}/resources/themes/default/public/img/shape/hero-shape.png" alt="img">
			</div>
			<!-- shape 02 -->
			<div class="shape-two routedOne">
				<img src="{{URL("/")}}/resources/themes/default/public/img/shape/hero-shape.png" alt="img">
			</div>
		</section>
		<!-- End-of Hero-->

		<!-- Brand S t a r t -->
		<section class="brand-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<h4 class="title">Brands</h4>
						</div>
						<div class="swiper brandSwiper-active">
							
							<div class="swiper-wrapper">

                @foreach($brands as $key => $brand)

								<div class="swiper-slide">
							
                <img width="89" height="73"
                  onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                  src="{{asset("storage/app/public/brand/$brand->image")}}"
                  alt="{{$brand->name}}">
								</div>
                @endforeach


					
							</div>
							<div class="swiper-button-next swiper-common-btn"><i class="ri-arrow-right-s-line"></i>
							</div>
							<div class="swiper-button-prev swiper-common-btn"><i class="ri-arrow-left-s-line"></i></div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End of Brand -->

		<!-- Goal area S t a r t -->
		<section class="goal-area position-relative">
			<div class="container">
				<div class="row g-4">
					<div class="col-xxl-3 col-md-4 col-sm-6">
						<div class="goal-card wow fadeInUp" data-wow-delay="0.0s">
							<div class="circle-icon">
								<img src="{{ asset('public/assets/front-end/img/shape/default-theme/icon-1.png') }}" alt="img">
							</div>
							<a href="javascript:void(0)">
								<h4 class="title line-clamp-1 text-color-primary">Original Product</h4>
								<p class="pera text-color-tertiary line-clamp-2">Experience unparalleled design and quality with our unique Original Product collection.</p>
							</a>
						</div>
					</div>
					<div class="col-xxl-3 col-md-4 col-sm-6">
						<div class="goal-card wow fadeInUp" data-wow-delay="0.0s">
							<div class="circle-icon">
								<img src="{{ asset('public/assets/front-end/img/shape/default-theme/icon-2.png') }}" alt="img">
							</div>
							<a href="javascript:void(0)">
								<h4 class="title line-clamp-1 text-color-primary">Satisfaction Guarantee</h4>
								<p class="pera text-color-tertiary line-clamp-2">Enjoy peace of mind with our 100% satisfaction guarantee—if you’re not happy, we’re not done.</p>
							</a>
						</div>
					</div>
					<div class="col-xxl-3 col-md-4 col-sm-6">
						<div class="goal-card wow fadeInUp" data-wow-delay="0.1s">
							<div class="circle-icon">
								<img src="{{ asset('public/assets/front-end/img/shape/default-theme/icon-3.png') }}" alt="img">
							</div>
							<a href="javascript:void(0)">
								<h4 class="title line-clamp-1 text-color-primary">New Arrival Everyday</h4>
								<p class="pera text-color-tertiary line-clamp-2">Explore fresh, exciting finds with new products added daily!</p>
							</a>
						</div>
					</div>
					<div class="col-xxl-3 col-md-4 col-sm-6">
						<div class="goal-card wow fadeInUp" data-wow-delay="0.2s">
							<div class="circle-icon">
								<img src="{{ asset('public/assets/front-end/img/shape/default-theme/icon-4.png') }}" alt="img">
							</div>
							<a href="javascript:void(0)">
								<h4 class="title line-clamp-1 text-color-primary">Fast & Free Shipping</h4>
								<p class="pera text-color-tertiary line-clamp-2">Get your orders quickly and at no extra cost with our fast and free shipping service.</p>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="shape routedOne">
				<img src="{{ asset('public/assets/front-end/img/shape/default-theme/shape.png') }}" alt="img">
			</div>
		</section>
		<!-- End-of goal-->

		<!-- Feature area S t a r t -->
		<section class="feature-area feature-bg position-relative">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<h4 class="title">Featured Products</h4>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="swiper featureSwiper-active">
							<div class="swiper-wrapper">

                @foreach($featured_products as $product)

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
		<!-- End-of feature-->


    @php($home_categories=\App\Model\Category::where('position', 0)->where('home_status',1)->priority()->take(6)->get())
		<!-- Categories area S t a r t -->
		<section class="category-area section-padding2">
			<div class="container">

				<div class="row">
					<div class="col-lg-12">
						<div class="section-with-button wow fadeInLeft" data-wow-delay="0.0s">
							<div class="section-title position-relative">
								<h4 class="title">Choose The <span class="outline-text">Categories</span>
									That You Want</h4>
								<div class="shape routedOne">
									<img src="https://wodmart.vercel.app/assets/images/icon/title-shape.png" alt="img">
								</div>
							</div>
							<div class="text-center d-block">
								<a href="{{ route("categories") }}" class="outline-pill-btn ">
									See All Categories
									<svg xmlns="http://www.w3.org/2000/svg" width="78" height="19" viewBox="0 0 78 19"
										fill="none">
										<path
											d="M66.918 10.9147C66.8987 10.9909 66.8754 11.0659 66.8482 11.1394C66.3343 12.5191 65.8568 13.9149 65.3832 15.3094C65.2835 15.6007 65.0431 15.8908 65.3278 16.3278C68.9295 13.4161 73.0932 11.4878 77.3487 9.65131C72.9717 7.73141 68.8104 5.59576 65.0804 2.61703C64.8556 3.06744 65.0978 3.36045 65.2072 3.6577C65.7259 5.06223 66.2433 6.47061 66.7965 7.85894C67.1854 8.84516 67.2283 9.92384 66.918 10.9147Z"
											fill="currentColor" />
										<rect y="8.90649" width="68" height="1" rx="0.5" fill="currentColor" />
									</svg>
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="row g-4 mb-24">

          @if($home_categories->get(0))

          @php($home_category = $home_categories[0])
            <div class="col-xl-6">

              <div class="category-card h-calc gallery-one wow fadeInUp" data-wow-delay="0.0s">

                <a href="{{route('products',['id'=> $home_category->id,'data_from'=>'category','page'=>1])}}"
                  class="zoomImg">
                  <img src="{{asset("storage/app/public/category/$home_category->icon")}}" alt="img">
                </a>

                <div class="collection-card lg">

                  <a href="{{route('products',['id'=> $home_category->id,'data_from'=>'category','page'=>1])}}">
                    <h4 class="title text-color-primary line-clamp-1">{{ $home_category->name }}</h4>
                    <p class="pera text-color-tertiary">{{ $home_category->products()->count() }} Pruducts</p>
                  </a>

                </div>

              </div>

            </div>
          @endif


					<div class="col-xl-6">
					  <div class="row g-4">

					    @foreach([1, 2] as $index)

                  @if($home_categories->get($index))
                  @php( $home_category = $home_categories->get($index))
                  <div class="col-xl-12 col-lg-6">
                    <div class="category-card h-calc gallery-two wow fadeInUp" data-wow-delay="0.1s">
                      <a href="{{ route('products', ['id' => $home_category->id, 'data_from' => 'category', 'page' => 1]) }}"
                        class="zoomImg">
                        <img src="{{ asset("storage/app/public/category/{$home_category->icon}") }}" alt="img">
                      </a>
                      <div class="collection-card">
                        <a href="{{ route('products', ['id' => $home_category->id, 'data_from' => 'category', 'page' => 1]) }}">
                          <h4 class="title text-color-primary">{{ $home_category->name }}</h4>
                          <p class="pera text-color-tertiary">{{ $home_category->products->count() }} Products</p>
                        </a>
                      </div>
                    </div>
                  </div>
                  @endif

					    @endforeach

					  </div>

					</div>
         


				</div>

				<div class="row g-4">

            @foreach([3, 4, 5] as $index)

                @if($home_categories->get($index))
                @php( $home_category = $home_categories->get($index))
            
                <div class="col-xl-4 col-md-6">
                  <div class="category-card h-calc gallery-three wow fadeInUp" data-wow-delay="0.0s">
                    <a href="{{ route('products', ['id' => $home_category->id, 'data_from' => 'category', 'page' => 1]) }}"  class="zoomImg">
                      <img src="{{ asset("storage/app/public/category/{$home_category->icon}") }}" alt="img">
                    </a>
                    <div class="collection-card sm">
                      <a href="{{ route('products', ['id' => $home_category->id, 'data_from' => 'category', 'page' => 1]) }}">
                        <h4 class="title text-color-primary line-clamp-1">{{ $home_category->name }}</h4>
                        <p class="pera text-color-tertiary">{{ $home_category->products->count() }} Products</p>
                      </a>
                    </div>
                  </div>
                </div>

                @endif
                
            @endforeach


				</div>

			</div>

		</section>
		<!-- End-of categories-->


    @if(!empty($flash_deals))
    <!-- Deals area S t a r t -->
    <section class="deals-area section-bg">

      <div class="container">
        <div class="row g-4">
          <div class="col-xl-12">
            <div class="deals-card">
              <div class="row align-items-center g-4">
                <div class="col-xl-6">
                  <div class="deals-banner">
                    <img src="{{ url("/") }}/storage/app/public/deal/{{ $flash_deals->banner }}" alt="img">
                    <div class="shape-container">
                      <div class="shape">
                        <h4 class="highlight-title">Offer</h4>

                        {{-- @if ($flash_deals->end_date < date("Y-m-d") )
                        <h4 class="title text-danger">Expired</h4>
                        @endif --}}

                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-6">
                  <div class="deals-content">
                    <p class="deal-subtitle">Flash Deal</p>
                    <div class="section-title">
                      <h4 class="title">{{ $flash_deals->title }}<span class="outline-text"> Purchase</span> Now</h4>
                    </div>
                    <div class="bottom-content">
                      <a href="{{ route("flash-deals",$flash_deals->id) }}" class="fill-pill-btn shop-btn">Shop Now</a>
        
                    </div>
                    <div class="progress-section">

                      <div class="progress custom-progress-two">
                        <div class="progress-bar" style="width: 100%"></div>
                      </div>

                    </div>
                    <div class="deals-footer">
                      <div class="section-title">
                        <h4 class="title">Hurry Up:</h4>
                        <p class="pera">Offer ends in</p>
                      </div>
                      <div class="count-down">
                        <div class="circle">
                          <h4 class="number days">00</h4>
                          <p class="pera">Days</p>
                        </div>
                        <div class="circle">
                          <h4 class="number hours">00</h4>
                          <p class="pera">Hours</p>
                        </div>
                        <div class="circle">
                          <h4 class="number minutes">00</h4>
                          <p class="pera">Min</p>
                        </div>
                        <div class="circle">
                          <h4 class="number seconds">00</h4>
                          <p class="pera">Sec</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="shape-one heartbeat2">
                <img src="https://wodmart.vercel.app/assets/images/gallery/deal-shape-3.svg" alt="img">
              </div>
              <div class="shape-two routedOne">
                <img src="https://wodmart.vercel.app/assets/images/gallery/deal-shape-4.png" alt="img">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End-of deals-->
    @endif

		<!-- Best product area S t a r t -->
		<section class="best-product-area">
			<div class="container">

				<div class="row g-4 mb-24">

					<div class="col-xxl-6">
						<div class="section-with-button">
							<div class="section-title position-relative  wow fadeInUp" data-wow-delay="0.0s">
								<h4 class="title">Our Best All Products <span class="outline-text">Collections</span>
								</h4>
								<div class="shape routedOne">
									<img src="{{ asset('public/assets/front-end/img/shape/default-theme/title-shape.png') }}" alt="img">
								</div>
							</div>
							<div class="all-button">
								<a href="{{ route("products") }}" class="outline-pill-btn mb-15  wow fadeInUp" data-wow-delay="0.0s">
									See All Products
									<svg xmlns="http://www.w3.org/2000/svg" width="49" height="19" viewBox="0 0 49 19"
										fill="none">
										<path
											d="M38.643 10.9148C38.6239 10.991 38.6007 11.066 38.5737 11.1394C38.0634 12.5191 37.5893 13.9149 37.119 15.3095C37.02 15.6007 36.7814 15.8909 37.064 16.3278C40.6403 13.4161 44.7745 11.4878 49 9.65137C44.6539 7.73147 40.5221 5.59582 36.8184 2.61709C36.5952 3.06751 36.8357 3.36051 36.9443 3.65776C37.4593 5.06229 37.9731 6.47067 38.5224 7.859C38.9085 8.84522 38.9511 9.92391 38.643 10.9148Z"
											fill="currentColor" />
										<rect y="9" width="39.7174" height="1" rx="0.5" fill="currentColor" />
									</svg>
								</a>


                @if (!empty($categories))

                @foreach ([3,4,5] as $key => $index)

                    @if ($categories[$index])

                    <a href="shop.html" class="outline-pill-btn mb-15  wow fadeInUp" data-wow-delay="0.1s">
                     {{ $categories[$index]['name'] }}
                      <svg xmlns="http://www.w3.org/2000/svg" width="49" height="19" viewBox="0 0 49 19" fill="none">
                        <path
                          d="M38.643 10.9148C38.6239 10.991 38.6007 11.066 38.5737 11.1394C38.0634 12.5191 37.5893 13.9149 37.119 15.3095C37.02 15.6007 36.7814 15.8909 37.064 16.3278C40.6403 13.4161 44.7745 11.4878 49 9.65137C44.6539 7.73147 40.5221 5.59582 36.8184 2.61709C36.5952 3.06751 36.8357 3.36051 36.9443 3.65776C37.4593 5.06229 37.9731 6.47067 38.5224 7.859C38.9085 8.84522 38.9511 9.92391 38.643 10.9148Z"
                          fill="currentColor" />
                        <rect y="9" width="39.7174" height="1" rx="0.5" fill="currentColor" />
                      </svg>
                    </a>

                    @endif

                @endforeach

                @endif

						
							</div>
						</div>
					</div>

					<div class="col-xxl-6">

						<div class="row g-4">

            @if($latest_products)

              @foreach([0, 1] as $index)

                @if ($latest_products->get($index))

                   @php( $product = $latest_products->get($index))

                   <div class="col-xxl-6 col-xl-4 col-sm-6">

                    @include('web-views.partials._product-card-2',['product'=>$product,'decimal_point_settings'=>$decimal_point_settings])

                   </div>
           
                @endif
                  
              @endforeach

            @endif

						</div>

					</div>

				</div>

				<div class="row g-4">

          @if($latest_products)

          @foreach([2,3,4,5] as $index)

            @if ($latest_products->get($index))

               @php( $product = $latest_products->get($index))

               <div class="col-xxl-3 col-xl-4 col-sm-6">

                @include('web-views.partials._product-card-2',['product'=>$product,'decimal_point_settings'=>$decimal_point_settings])

               </div>
       
            @endif
              
          @endforeach

        @endif


				</div>

			</div>
		</section>
		<!-- End-of best product-->

		<!-- best area S t a r t -->
		<section class="feature-area feature-bg position-relative">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<h4 class="title">Best Sell Products</h4>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="swiper featureSwiper-active">
							<div class="swiper-wrapper">

                @foreach($bestSellProduct as $product)

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
		<!-- End-of feature-->

	</main>
@endsection

@push('script')
  <script>
      /*--flash deal Progressbar --*/
      function update_flash_deal_progress_bar(){
          const current_time_stamp = new Date().getTime();
          const start_date = new Date('{{$web_config['flash_deals']['start_date'] ?? ''}}').getTime();
          const countdownElement = document.querySelector('.cz-countdown');
          const get_end_time = countdownElement.getAttribute('data-countdown');
          const end_time = new Date(get_end_time).getTime();
          let time_progress = ((current_time_stamp - start_date) / (end_time - start_date))*100;
          const progress_bar = document.querySelector('.flash-deal-progress-bar');
          progress_bar.style.width = time_progress + '%';
      }
          update_flash_deal_progress_bar();
          setInterval(update_flash_deal_progress_bar, 10000);
      /*-- end flash deal Progressbar --*/
  </script>

  <!-- Owl Carousel -->
  <script src="{{asset('public/assets/front-end')}}/js/owl.carousel.min.js"></script>

  <script>
      $('.flash-deal-slider').owlCarousel({
          loop: false,
          autoplay: true,
          center:false,
          margin: 10,
          nav: true,
          navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
          dots: false,
          autoplayHoverPause: true,
          '{{session('direction')}}': false,
          // center: true,
          responsive: {
              //X-Small
              0: {
                  items: 1.1
              },
              360: {
                  items: 1.2
              },
              375: {
                  items: 1.4
              },
              480: {
                  items: 1.8
              },
              //Small
              576: {
                  items: 2
              },
              //Medium
              768: {
                  items: 3
              },
              //Large
              992: {
                  items: 4
              },
              //Extra large
              1200: {
                  items: 4
              },
          }
      })
      $('.flash-deal-slider-mobile').owlCarousel({
          loop: false,
          autoplay: true,
          center:true,
          margin: 10,
          nav: true,
          navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
          dots: false,
          autoplayHoverPause: true,
          '{{session('direction')}}': false,
          // center: true,
          responsive: {
              //X-Small
              0: {
                  items: 1.1
              },
              360: {
                  items: 1.2
              },
              375: {
                  items: 1.4
              },
              480: {
                  items: 1.8
              },
              //Small
              576: {
                  items: 2
              },
              //Medium
              768: {
                  items: 3
              },
              //Large
              992: {
                  items: 4
              },
              //Extra large
              1200: {
                  items: 4
              },
          }
      })

      $('#web-feature-deal-slider').owlCarousel({
          loop: false,
          autoplay: true,
          margin: 20,
          nav: false,
          //navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
          dots: false,
          autoplayHoverPause: true,
          '{{session('direction')}}': true,
          // center: true,
          responsive: {
              //X-Small
              0: {
                  items: 1
              },
              360: {
                  items: 1
              },
              375: {
                  items: 1
              },
              540: {
                  items: 2
              },
              //Small
              576: {
                  items: 2
              },
              //Medium
              768: {
                  items: 2
              },
              //Large
              992: {
                  items: 2
              },
              //Extra large
              1200: {
                  items: 2
              },
              //Extra extra large
              1400: {
                  items: 2
              }
          }
      })

      $('.new-arrivals-product').owlCarousel({
          loop: true,
          autoplay: true,
          margin: 20,
          nav: true,
          navText: ["<i class='czi-arrow-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}'></i>", "<i class='czi-arrow-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}'></i>"],
          dots: false,
          autoplayHoverPause: true,
          '{{session('direction')}}': true,
          // center: true,
          responsive: {
              //X-Small
              0: {
                  items: 1.1
              },
              360: {
                  items: 1.2
              },
              375: {
                  items: 1.4
              },
              540: {
                  items: 2
              },
              //Small
              576: {
                  items: 2
              },
              //Medium
              768: {
                  items: 2
              },
              //Large
              992: {
                  items: 2
              },
              //Extra large
              1200: {
                  items: 4
              },
              //Extra extra large
              1400: {
                  items: 4
              }
          }
      })

      $('.category-wise-product-slider').owlCarousel({
          loop: true,
          autoplay: true,
          margin: 20,
          nav: true,
          navText: ["<i class='czi-arrow-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}'></i>", "<i class='czi-arrow-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}'></i>"],
          dots: false,
          autoplayHoverPause: true,
          '{{session('direction')}}': true,
          responsive: {
              0: {
                  items: 1.2
              },
              375: {
                  items: 1.4
              },
              425: {
                  items: 2
              },
              576: {
                  items: 3
              },
              768: {
                  items: 4
              },
              992: {
                  items: 5
              },
              1200: {
                  items: 6
              },
          }
      })
  </script>

  <script>
      $('#featured_products_list').owlCarousel({
          loop: true,
          autoplay: true,
          margin: 20,
          nav: true,
          navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
          dots: false,
          autoplayHoverPause: true,
          '{{session('direction')}}': false,
          // center: true,
          responsive: {
              //X-Small
              0: {
                  items: 1
              },
              360: {
                  items: 1
              },
              375: {
                  items: 1
              },
              540: {
                  items: 2
              },
              //Small
              576: {
                  items: 2
              },
              //Medium
              768: {
                  items: 3
              },
              //Large
              992: {
                  items: 4
              },
              //Extra large
              1200: {
                  items: 6
              },
          }
      });
  </script>

  <script>
      $('.hero-slider').owlCarousel({
          loop: false,
          autoplay: true,
          margin: 20,
          nav: true,
          navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
          dots: true,
          autoplayHoverPause: true,
          // '{{session('direction')}}': false,
          // center: true,
          items: 1
      });
  </script>

  <script>
      $('.brands-slider').owlCarousel({
          loop: false,
          autoplay: true,
          margin: 10,
          nav: false,
          '{{session('direction')}}': true,
          autoplayHoverPause: true,
          // center: true,
          responsive: {
              //X-Small
              0: {
                  items: 4,
                  dots: true,
              },
              360: {
                  items: 5,
                  dots: true,
              },
              //Small
              576: {
                  items: 6,
                  dots: false,
              },
              //Medium
              768: {
                  items: 7,
                  dots: false,
              },
              //Large
              992: {
                  items: 9,
                  dots: false,
              },
              //Extra large
              1200: {
                  items: 11,
                  dots: false,
              },
              //Extra extra large
              1400: {
                  items: 12,
                  dots: false,
              }
          }
      })
  </script>

  <script>
      $('#category-slider, #top-seller-slider').owlCarousel({
          loop: false,
          autoplay: true,
          margin: 20,
          nav: false,
          // navText: ["<i class='czi-arrow-left'></i>","<i class='czi-arrow-right'></i>"],
          dots: true,
          autoplayHoverPause: true,
          '{{session('direction')}}': true,
          // center: true,
          responsive: {
              //X-Small
              0: {
                  items: 2
              },
              360: {
                  items: 3
              },
              375: {
                  items: 3
              },
              540: {
                  items: 4
              },
              //Small
              576: {
                  items: 5
              },
              //Medium
              768: {
                  items: 6
              },
              //Large
              992: {
                  items: 8
              },
              //Extra large
              1200: {
                  items: 10
              },
              //Extra extra large
              1400: {
                  items: 11
              }
          }
      })
      $('.categories--slider').owlCarousel({
          loop: false,
          autoplay: true,
          margin: 20,
          nav: false,
          // navText: ["<i class='czi-arrow-left'></i>","<i class='czi-arrow-right'></i>"],
          dots: false,
          autoplayHoverPause: true,
          '{{session('direction')}}': true,
          // center: true,
          responsive: {
              //X-Small
              0: {
                  items: 3
              },
              360: {
                  items: 3.2
              },
              375: {
                  items: 3.5
              },
              540: {
                  items: 4
              },
              //Small
              576: {
                  items: 5
              },
              //Medium
              768: {
                  items: 6
              },
              //Large
              992: {
                  items: 8
              },
              //Extra large
              1200: {
                  items: 10
              },
              //Extra extra large
              1400: {
                  items: 11
              }
          }
      })
  </script>

  <script>
      // Others Store Slider
      const othersStore = $(".others-store-slider").owlCarousel({
          responsiveClass: true,
          nav: false,
          dots: false,
          loop: true,
          autoplay: true,
          autoplayTimeout: 5000,
          autoplayHoverPause: true,
          smartSpeed: 600,
          rtl: {{ session()->get('direction') == 'rtl' ? true : 'false'}},
          responsive: {
              0: {
                  items: 1.3,
                  margin: 10,
              },
              480: {
                  items: 2,
                  margin: 26,
              },
              768: {
                  items: 2,
                  margin: 26,
              },
              992: {
                  items: 3,
                  margin: 26,
              },
              1200: {
                  items: 4,
                  margin: 26,
              },
          },
      });
      $(".store-next").on("click", function () {
          othersStore.trigger("next.owl.carousel", [600]);
      });
      $(".store-prev").on("click", function () {
          othersStore.trigger("prev.owl.carousel", [600]);
      });
  </script>

  {{-- Product Details page scripts --}}

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



  @if (!empty($flash_deals))
  {{-- Flash Deal --}}

  <script>
    $(function() {
      // Set the start and end dates
      var startDate = new Date("{{ $flash_deals->start_date }}").getTime();
      var endDate = new Date("{{ $flash_deals->end_date }}").getTime();
      // Calculate the total duration
      var totalDuration = endDate - startDate;
      // Update the countdown and progress bar every second
      var interval = setInterval(function() {
        var now = new Date().getTime();
        var distance = endDate - now;
        // Calculate time left
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        // Display the countdown
        $(".days").html(days)
        $(".hours").html(hours)
        $(".minutes").html(minutes)
        $(".seconds").html(seconds)
        // Calculate remaining time percentage
        var timeLeftPercentage = Math.max((distance / totalDuration) * 100, 0);
        $(".progress-bar").css("width", timeLeftPercentage + "%");
        // If the countdown is over, write some text and stop the interval
        if (distance < 0) {
          clearInterval(interval);
          $(".progress-bar").css("width", "0%").text("0%");
          $(".days").html('00')
          $(".hours").html('00')
          $(".minutes").html('00')
          $(".seconds").html('00')
        }
      }, 100);
    });
  </script>

@endif


@endpush





