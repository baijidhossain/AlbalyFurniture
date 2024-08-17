@extends('layouts.front-end.app')
@section('title', translate('login'))
@push('css')
<style>
  .password-toggle-btn .custom-control-input:checked~.password-toggle-indicator {
    color: {
        {
        $web_config['primary_color']
      }
    }

    ;
  }
</style>
@endpush
@section('content')


<div class="login-area section-padding">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10">
        <div class="login-card">
          <!-- Form -->
          <form action="#" method="POST" autocomplete="off" action="{{route('customer.auth.login')}}" method="post"
            id="form-id">
            @csrf

            <div class="position-relative contact-form mb-24">

              <label class="contact-label">Email </label>
              <input class="form-control contact-input" type="text" name="user_id" id="si-email"
                value="{{old('user_id')}}" placeholder="{{ translate('enter_email_address_or_phone_number') }}"
                required>

            </div>

            <div class="contact-form ">
              <div class="position-relative ">

                <div class="d-flex justify-content-between aligin-items-center">
                  <label class="contact-label">Password</label>

                  <a class="font-size-sm text-primary text-underline"
                    href="{{route('customer.auth.recover-password')}}">
                    <span class="text-primary text-15"> {{ translate('forgot_password') }}? </span>
                  </a>

                </div>

                <input class="form-control contact-input password-input" name="password" type="password"
                  id="si-password" placeholder="{{translate('password must be 7+ Character')}}" required>

                <i class="toggle-password ri-eye-line"></i>

              </div>
            </div>

            <div class="form-group mb-24 mt-2">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="remember" id="remember"
                  {{ old('remember') ? 'checked' : '' }}>
                <label class="custom-control-label text-primary" for="remember">{{ translate('remember_me') }}</label>
              </div>
            </div>






            @php($recaptcha = \App\CPU\Helpers::get_business_settings('recaptcha'))
            @if(isset($recaptcha) && $recaptcha['status'] == 1)
            <div id="recaptcha_element" class="w-100" data-type="image"></div>
            <br />
            @else
            <div class="row my-4 ">
              <div class="col-5 position-relative">
                <input type="text" class="form-control contact-input" name="default_recaptcha_id_customer_login"
                  value="" placeholder="{{ translate('enter_captcha_value') }}" autocomplete="off">
              </div>

              <div class="col-3 input-icons">
                <a onclick="re_captcha();" class="d-flex align-items-center align-items-center gap-2">
                  <img
                    src="{{ URL('/customer/auth/code/captcha/1?captcha_session_id=default_recaptcha_id_customer_login') }}"
                    class="input-field rounded m-0" id="customer_login_recaptcha_id">
               
                    <button type="button" class="bg-white border-0 btn-sm fs-5"><i class="ri-refresh-line icon cursor-pointer "></i></button>

                </a>
              </div>

            </div>
            @endif

            <button type="submit" class="btn-primary-fill justify-content-center w-100">
              <span class="d-flex justify-content-center gap-6">
                {{ translate('log_in') }}
              </span>
            </button>

          </form>

          <div class="login-footer">


            <div class="create-account">

              <p>
                Don’t have an account?
                <a class="text-primary text-underline" href="{{route('customer.auth.sign-up')}}">
                  <span class="text-primary">{{ translate('sign_up') }}</span>
                </a>
              </p>

            </div>

            @foreach (\App\CPU\Helpers::get_business_settings('social_login') as $socialLoginService)
            @if (isset($socialLoginService) && $socialLoginService['status']==true)

            <a href="{{route('customer.auth.service-login', $socialLoginService['login_medium'])}}"
              class="login-btn d-flex align-items-center justify-content-center gap-10 mt-4">
              <img src="{{asset('/public/assets/front-end/img/icons/'.$socialLoginService['login_medium'].'.png')}}" alt="img" class="m-0 rounded" width="25">
              <span> login with {{ $socialLoginService['login_medium'] }}</span>
            </a>

            @endif
            @endforeach

          </div>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('script')

{{-- recaptcha scripts start --}}
@if(isset($recaptcha) && $recaptcha['status'] == 1)
<script type="text/javascript">
  var onloadCallback = function() {
    grecaptcha.render('recaptcha_element', {
      'sitekey': '{{ \App\CPU\Helpers::get_business_settings('
      recaptcha ')['
      site_key '] }}'
    });
  };
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
<script>
  $("#form-id").on('submit', function(e) {
    var response = grecaptcha.getResponse();
    if (response.length === 0) {
      e.preventDefault();
      toastr.error("{{ translate('please_check_the_recaptcha') }}");
    }
  });
</script>
@else
<script type="text/javascript">
  function re_captcha() {
    $url = "{{ URL('/customer/auth/code/captcha') }}";
    $url = $url + "/" + Math.random() + '?captcha_session_id=default_recaptcha_id_customer_login';
    document.getElementById('customer_login_recaptcha_id').src = $url;
    console.log('url: ' + $url);
  }
</script>
@endif
{{-- recaptcha scripts end --}}
@endpush