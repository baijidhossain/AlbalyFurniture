  <!-- Subscription area S t a r t -->
  

  
  <section class="subscription-area subscription-bg">

    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="subscription-wrapper">
            <div class="left-wrapper">
              <div class="subscription-content">
                <h4 class="title">Stay Updated with Our Latest News</h4>
                <p class="pera">Join our email subscription now</p>
              </div>
              <div class="subscription-input-section">

                <form action="{{ route('subscription') }}" method="post">
                  @csrf

                  <input type="text" class="subscription-input" placeholder="Enter your email address"
                    name="subscription_email">
                  <button type="submit" class="subscribe-btn subscribe-button"><span class="btn-text">Subscribe</span>
                    <span class="icon">
                      <i class="ri-arrow-right-line"></i>
                    </span>
                  </button>

                </form>

              </div>
            </div>
            <div class="right-wrapper">
              <div class="subscription-content">
                <h4 class="title">Download App</h4>
                <p class="pera">Mobile app available</p>
              </div>
              <div class="download-app">

                @if($web_config['ios']['status'])

                <a href="{{ $web_config['ios']['link'] }}" target="_blank" class="  wow fadeInUp" data-wow-delay="0.0s">
                  <img src="{{theme_asset(path: "img/apple-app.png")}}" alt="img">
                </a>

                @endif

                @if($web_config['android']['status'])

                <a href="{{ $web_config['android']['link'] }}" target="_blank" class="  wow fadeInUp"
                  data-wow-delay="0.0s">
                  <img src="{{theme_asset(path: "img/google-app.png")}}" alt="img">
                </a>

                @endif

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End-of subscription-->

  <!-- Footer S t a r t -->
  <footer>
    <div class="footer-wrapper footer-bg-one">
      <div class="container">
        <div class="footer-area position-relative">
          <div class="row g-4">
            <div class="col-xl-3 col-lg-4 col-sm-6">
              <div class="single-footer-caption">
                <div class="footer-tittle">
                  <h4 class="title">About Us</h4>
                  <p class="pera">
                    Albaly Furniture is your go-to destination for transforming any space into a
                    stylish and comfortable haven. Our dedication to quality, craftsmanship, and
                    customer service makes us a trusted choice for all your furniture needs.
                  </p>
                  <ul class="info-listing">
                    <li class="footer-info-list">
                      <a href="#" class="single">
                        <i class="ri-mail-fill"></i>
                        <p class="pera">{{ $web_config['email']->value }}</p>
                      </a>
                    </li>
                    <li class="footer-info-list">
                      <a href="#" class="single">
                        <div class="d-flex gap-6">
                          <i class="ri-phone-fill"></i>
                          <p class="pera">{{ $web_config['phone']->value }}</p>
                        </div>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-xl-6">
              <div class="footer-menu-section">
                <div class="logo logo-large light-logo">
                  <a href="index.html">

                    <img class="{{ Session::get('direction') === 'rtl' ? 'rightalign' : '' }}"
                      src="{{ asset('storage/app/public/company/') }}/{{ $web_config['footer_logo']->value }}"
                      onerror="this.src='{{ asset('public/assets/front-end/img/image-place-holder.png') }}'"
                      alt="{{ $web_config['name']->value }}" />

                  </a>
                </div>
                <div class="footer-social-section">
                  <h4 class="title">Follow Us</h4>
                  <ul class="footer-social-lists">

                    @if ($web_config['social_media'])
                    @foreach ($web_config['social_media'] as $item)
                    <span class="social-media ">

                      @if ($item->name == 'twitter')
                      <li class="list-icon">
                        <a href="{{ $item->link }}" class="list">
                          <i class="ri-twitter-fill"></i>
                        </a>
                      </li>
                      @elseif($item->name == 'facebook')
                      <li class="list-icon">
                        <a href="{{ $item->link }}" class="list">
                          <i class="ri-facebook-fill"></i>
                        </a>
                      </li>
                      @elseif($item->name == 'instagram')
                      <li class="list-icon">
                        <a href="{{ $item->link }}" class="list">
                          <i class="ri-instagram-fill"></i>
                        </a>
                      </li>
                      @elseif($item->name == 'pinterest')
                      <li class="list-icon">
                        <a href="{{ $item->link }}" class="list">
                          <i class="ri-pinterest-fill"></i>
                        </a>
                      </li>
                      @elseif($item->name == 'google-plus')
                      <li class="list-icon">
                        <a href="{{ $item->link }}" class="list">
                          <i class="ri-google-fill"></i>
                        </a>
                      </li>
                      @else
                      <li class="list-icon">
                        <a href="{{ $item->link }}" class="list">
                          <i class="ri-linkedin-fill"></i>
                        </a>
                      </li>
                      @endif

                    </span>
                    @endforeach
                    @endif

                  </ul>
                </div>
                <div class="footer-menu">
                  <ul class="menu-lists">
                    <li class="list">
                      <a href="/" class="menu-list">Home</a>
                    </li>
                    <li class="list">
                      <a href="{{ route('about-us') }}" class="menu-list">{{ translate('about_us') }}</a>
                    </li>
                    <li class="list">
                      <a href="{{ route('wishlists') }}" class="menu-list">{{ translate('Wishlist') }}</a>
                    </li>

                    <li class="list">
                      <a href="{{ route('contacts') }}" class="menu-list">{{ translate('contacts') }}</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-xl-2 offset-xl-1 col-lg-4 col-sm-6">
              <div class="single-footer-caption">
                <div class="footer-tittle">
                  <h4 class="title">My Accounts</h4>
                  <ul class="listing">

                    <li class="single-list">
                      <a href="{{ route('refund-policy') }}" class="single">{{ translate('refund_policy') }}</a>
                    </li>

                    <li class="single-list">
                      <a href="{{ route('return-policy') }}" class="single">{{ translate('return_policy') }}</a>
                    </li>

                    <li class="single-list">
                      <a href="{{ route('cancellation-policy') }}"
                        class="single">{{ translate('cancellation_policy') }}</a>
                    </li>

                    <li class="single-list">
                      <a href="{{ route('contacts') }}" class="single">{{ translate('contacts') }}</a>
                    </li>

                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- footer-bottom area -->
      <div class="footer-bottom-area position-relative">
        <div class="container">
          <div class="d-flex justify-content-between gap-14 flex-wrap">
            <div class="privacy-section d-flex">
              <a href="{{ route('privacy-policy') }}">
                <p class="pera mr-25">{{ translate('privacy_policy') }}</p>
              </a>
              <span>|</span>
              <a href="{{ route('terms') }}">
                <p class="pera ml-25">{{ translate('terms_&_conditions') }}</p>
              </a>
            </div>
            <div class="payment-list">
              <img src="https://wodmart.vercel.app/assets/images/logo/payment-list.png" alt="img">
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- End-of Footer -->