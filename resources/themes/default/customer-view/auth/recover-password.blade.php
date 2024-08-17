@extends('layouts.front-end.app')

@section('title', translate('forgot_Password'))

@section('content')
@php($verification_by=\App\CPU\Helpers::get_business_settings('forgot_password_verification'))
<!-- Page Content-->
{{-- <div class="container py-4 py-lg-5 my-4 rtl">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 text-start">
                <h2 class="h3 mb-4">{{ translate('forgot_your_password')}}?</h2>
<p class="font-size-md">
  {{ translate('change_your_password_in_three_easy_steps.')}}
  {{ translate('this_helps_to_keep_your_new_password_secure.')}}
</p>
<ol class="list-unstyled font-size-md p-0">
  <li>
    <span class="text-primary mr-2">{{ translate('1')}}.</span>{{ translate('fill_in_your_email_address_below.')}}
  </li>
  <li>
    <span class="text-primary mr-2">{{ translate('2')}}.</span>{{ translate('we_will_email_you_a_temporary_code.')}}
  </li>
  <li>
    <span
      class="text-primary mr-2">{{ translate('3')}}.</span>{{ translate('use_the_code_to_change_your_password_on_our_secure_website.')}}
  </li>
</ol>

@if($verification_by=='email')

<div class="card py-2 mt-4">
  <form class="card-body needs-validation" action="{{route('customer.auth.forgot-password')}}" method="post">
    @csrf
    <div class="form-group">
      <label for="recover-email">{{ translate('enter_your_email_address')}}</label>
      <input class="form-control" type="email" name="identity" id="recover-email" required>
      <div class="invalid-feedback">
        {{ translate('please_provide_valid_email_address.')}}
      </div>
    </div>
    <button class="btn btn--primary" type="submit">
      {{ translate('get_new_password')}}
    </button>
  </form>
</div>
@else
<div class="card py-2 mt-4">
  <form class="card-body needs-validation" action="{{route('customer.auth.forgot-password')}}" method="post">
    @csrf
    <div class="form-group">
      <label for="recover-email">{{ translate('enter_your_phone_number')}}</label>
      <input class="form-control" type="text" name="identity" required>
      <div class="invalid-feedback">
        {{ translate('please_provide_valid_phone_number')}}
      </div>
    </div>
    <button class="btn btn--primary" type="submit">{{ translate('proceed')}}</button>
  </form>
</div>
@endif
</div>
</div>
</div> --}}

<div class="login-area section-padding">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10">
        <div class="login-card">
          <!-- Form -->

          <h2 class="h3 mb-4">{{ translate('forgot_your_password')}}?</h2>
          <p class="font-size-md">
            {{ translate('change_your_password_in_three_easy_steps.')}}
            {{ translate('this_helps_to_keep_your_new_password_secure.')}}
          </p>
          <ol class="list-unstyled font-size-md p-0">
            <li>
              <span
                class="text-primary mr-2">{{ translate('1')}}.</span>{{ translate('fill_in_your_email_address_below.')}}
            </li>
            <li>
              <span
                class="text-primary mr-2">{{ translate('2')}}.</span>{{ translate('we_will_email_you_a_temporary_code.')}}
            </li>
            <li>
              <span
                class="text-primary mr-2">{{ translate('3')}}.</span>{{ translate('use_the_code_to_change_your_password_on_our_secure_website.')}}
            </li>
          </ol>

 
          @if($verification_by=='email')

          <form class="needs-validation" action="{{route('customer.auth.forgot-password')}}" method="post">
            @csrf
            <div class="contact-form mb-24">
              <label for="recover-email" class="contact-label">{{ translate('enter_your_email_address')}}</label>
              <input class="form-control contact-input" type="email" name="identity" id="recover-email" required>
              <div class="invalid-feedback">
                {{ translate('please_provide_valid_email_address.')}}
              </div>
            </div>
            <button class="btn-primary-fill justify-content-center w-100" type="submit">

              <span class="d-flex justify-content-center gap-6">
                <span> {{ translate('get_new_password')}}</span>
              </span>
            </button>
          </form>

          @else

          <form class="needs-validation" action="{{route('customer.auth.forgot-password')}}" method="post">
            @csrf
            <div class="contact-form mb-24">
              <label for="recover-phone">{{ translate('enter_your_phone_number')}}</label>
              <input class="form-control contact-input" type="text" name="identity" id="recover-phone" required>
              <div class="invalid-feedback">
                {{ translate('please_provide_valid_phone_number')}}
              </div>
            </div>

            <button class="btn-primary-fill justify-content-center w-100" type="submit">
              <span class="d-flex justify-content-center gap-6">
                <span> {{ translate('proceed')}}</span>
              </span>
            </button>

          </form>

          @endif

          <div class="login-footer">
            <div class="create-account">
              <p class="mb-0">
                Go back to
                <a href="{{route('customer.auth.login')}}">
                  <span class="text-primary">Login</span>
                </a>
              </p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection