@extends('layouts.front-end.app')

@section('title', translate('register'))

@section('content')

{{-- <div class="login-area section-padding">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10">
              <div class="login-card">
                  <!-- Form -->
                  <form action="#" method="POST">
                      <div class="contact-form mb-24">
                          <label class="contact-label">Name </label>
                          <input class="form-control contact-input" type="text" placeholder="Enter Your Name">
                      </div>
                      
                      <div class="contact-form mb-24">
                          <label class="contact-label">Email </label>
                          <input class="form-control contact-input" type="email" placeholder="Email">
                      </div>

                      <!-- Password -->
                      <div class="position-relative contact-form mb-24">
                          <label class="contact-label">Enter Password</label>
                          <input type="password" class="form-control contact-input password-input" id="txtPasswordLogin" placeholder="Enter Password">
                          <i class="toggle-password ri-eye-line"></i>
                      </div>
                      <!-- Password -->
                      <div class="position-relative contact-form mb-24">
                          <label class="contact-label">Confirm Password</label>
                          <input type="password" class="form-control contact-input password-input" id="txtPasswordLogin2" placeholder="Confirm Password">
                          <i class="toggle-password ri-eye-line"></i>
                      </div>

                      <a href="javascript:void(0)" class="btn-primary-fill justify-content-center w-100">
                          <span class="d-flex justify-content-center gap-6">
                              <span>Register</span>
                          </span>
                      </a>
                  </form>

                  <div class="login-footer">
                      <div class="create-account">
                          <p>
                              Already have an account?
                              <a href="login.html">
                                  <span class="text-primary">Login</span>
                              </a>
                          </p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div> --}}

<div class="login-area section-padding">

  <div class="row justify-content-center">
    <div class="col-xl-4 col-lg-6 col-md-8 col-sm-10">

      <div class="login-card">

        <h2 class="text-center mb-50">{{ translate('sign_up')}}</h2>

        <form class="needs-validation_" id="form-id" action="{{route('customer.auth.sign-up')}}" method="post"
          id="sign-up-form">
          @csrf

          <div class="position-relative contact-form mb-24">
            <label class="form-label font-semibold">{{ translate('first_name')}}</label>
            <input class="form-control contact-input " value="{{old('f_name')}}" type="text" name="f_name"
              placeholder="{{ translate('Ex') }}: Jhone" required>
            <div class="invalid-feedback">{{ translate('please_enter_your_first_name')}}!</div>
          </div>

          <div class="position-relative contact-form mb-24">
            <label class="form-label font-semibold">{{ translate('last_name')}}</label>
            <input class="form-control contact-input " type="text" value="{{old('l_name')}}" name="l_name"
              placeholder="{{ translate('Ex') }}: Doe" required>
            <div class="invalid-feedback">{{ translate('please_enter_your_last_name')}}!</div>
          </div>

          <div class="position-relative contact-form mb-24">
            <label class="form-label font-semibold">{{ translate('email_address')}}</label>
            <input class="form-control contact-input " type="email" value="{{old('email')}}" name="email"
              placeholder="{{ translate('enter_email_address') }}" autocomplete="off" required>
            <div class="invalid-feedback">{{ translate('please_enter_valid_email_address')}}!</div>
          </div>

          <div class="position-relative contact-form mb-24">
            <label class="form-label font-semibold">{{ translate('phone_number')}}
              <small class="text-primary">( * {{ translate('country_code_is_must_like_for_BD')}} 880
                )</small></label>
            <input class="form-control contact-input " type="number" value="{{old('phone')}}" name="phone"
              placeholder="{{ translate('enter_phone_number') }}" required>
            <div class="invalid-feedback">{{ translate('please_enter_your_phone_number')}}!</div>
          </div>

          <div class="position-relative contact-form mb-24">
            <label class="contact-label" for="si-password">{{ translate('password')}}</label>
            <input type="password" class="form-control contact-input password-input" name="password" type="password"
              id="si-password" placeholder="{{ translate('minimum_8_characters_long')}}" required>
            <i class="toggle-password ri-eye-line"></i>
          </div>

          <div class="position-relative contact-form mb-24">
            <label class="contact-label" for="si-password">{{ translate('confirm_password')}}</label>
            <input type="password" class="form-control contact-input password-input" name="con_password" type="password"
              id="si-password" placeholder="{{ translate('minimum_8_characters_long')}}" required>
            <i class="toggle-password ri-eye-line"></i>
          </div>

          @if ($web_config['ref_earning_status'])
          <div class="position-relative contact-form mb-24">
            <label class="form-label font-semibold">{{ translate('refer_code') }} <small
                class="text-muted">({{ translate('optional') }})</small></label>
            <input type="text" id="referral_code" class="form-control contact-input" name="referral_code"
              placeholder="{{ translate('use_referral_code') }}">
          </div>
          @endif

          <div class="position-relative contact-form mb-24">
            <label class="custom-control custom-checkbox m-0 d-flex gap-2">
              <input type="checkbox" class="custom-control-input" name="remember" id="inputCheckd">
              <span class="custom-control-label">
                <span>{{ translate('i_agree_to_Your')}}</span> <a class="font-size-sm text-decoration-underline"
                  target="_blank" href="{{route('terms')}}">{{ translate('terms_and_condition')}}</a>
              </span>
            </label>
          </div>

          @php($recaptcha = \App\CPU\Helpers::get_business_settings('recaptcha'))
          @if(isset($recaptcha) && $recaptcha['status'] == 1)
          <div id="recaptcha_element" class="w-100" data-type="image"></div>
          @else
          <div class="row my-4">

            <div class="col-6 ">
              <input type="text" class="form-control contact-input  border __h-40"
                name="default_recaptcha_value_customer_regi" value=""
                placeholder="{{ translate('enter_captcha_value')}}" autocomplete="off">
            </div>

            <div class="col-6 input-icons">

              <a onclick="re_captcha();" class="d-flex align-items-center align-items-center">
                <img
                  src="{{ URL('/customer/auth/code/captcha/1?captcha_session_id=default_recaptcha_id_customer_regi') }}"
                  class="input-field  m-0 rounded" id="default_recaptcha_id">
                <button type="button" class="bg-white border-0 btn-sm fs-5"><i
                    class="ri-refresh-line icon cursor-pointer "></i></button>
              </a>

            </div>

          </div>
          @endif

          <button class="btn-primary-fill justify-content-center w-100" id="sign-up" type="submit" disabled>
            {{ translate('sign_up')}}
          </button>

          @foreach (\App\CPU\Helpers::get_business_settings('social_login') as $socialLoginService)
          @if (isset($socialLoginService) && $socialLoginService['status']==true)

          <a href="{{route('customer.auth.service-login', $socialLoginService['login_medium'])}}"
            class="login-btn d-flex align-items-center justify-content-center gap-10 mt-4">
            <img src="{{asset('/public/assets/front-end/img/icons/'.$socialLoginService['login_medium'].'.png')}}"
              alt="img" class="m-0 rounded" width="25">
            <span> login with {{ $socialLoginService['login_medium'] }}</span>
          </a>

          @endif
          @endforeach

          <div class="text-black-50 mt-3 text-center">

            <small> {{ translate('Already_have_account ') }}?
              <a class="text-primary text-underline" href="{{route('customer.auth.login')}}"> {{ translate('sign_in') }}
              </a>
            </small>

          </div>

        </form>

      </div>

    </div>
  </div>

</div>
@endsection

@push('script')
<script>
  $('#inputCheckd').change(function() {
    // console.log('jell');
    if ($(this).is(':checked')) {
      $('#sign-up').removeAttr('disabled');
    } else {
      $('#sign-up').attr('disabled', 'disabled');
    }
  });
</script>

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
      toastr.error("{{ translate('please_check_the_recaptcha')}}");
    }
  });
</script>
@else
<script type="text/javascript">
  function re_captcha() {
    $url = "{{ URL('/customer/auth/code/captcha') }}";
    $url = $url + "/" + Math.random() + '?captcha_session_id=default_recaptcha_id_customer_regi';
    document.getElementById('default_recaptcha_id').src = $url;
    console.log('url: ' + $url);
  }
</script>
@endif
{{-- recaptcha scripts end --}}
@endpush