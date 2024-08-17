@php($decimal_point_settings = \App\CPU\Helpers::get_business_settings('decimal_point_settings'))

{{-- <div class="card">

  <div class="card-header">
    <div class="d-flex align-items-center justify-content-between gap-2 mb-3">
      <h5 class="mb-0">{{translate('wishlist')}}</h5>

      <button class="profile-aside-btn btn btn--primary px-2 rounded px-2 py-1 d-lg-none">
        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
          <path fill-rule="evenodd" clip-rule="evenodd"
            d="M7 9.81219C7 9.41419 6.842 9.03269 6.5605 8.75169C6.2795 8.47019 5.898 8.31219 5.5 8.31219C4.507 8.31219 2.993 8.31219 2 8.31219C1.602 8.31219 1.2205 8.47019 0.939499 8.75169C0.657999 9.03269 0.5 9.41419 0.5 9.81219V13.3122C0.5 13.7102 0.657999 14.0917 0.939499 14.3727C1.2205 14.6542 1.602 14.8122 2 14.8122H5.5C5.898 14.8122 6.2795 14.6542 6.5605 14.3727C6.842 14.0917 7 13.7102 7 13.3122V9.81219ZM14.5 9.81219C14.5 9.41419 14.342 9.03269 14.0605 8.75169C13.7795 8.47019 13.398 8.31219 13 8.31219C12.007 8.31219 10.493 8.31219 9.5 8.31219C9.102 8.31219 8.7205 8.47019 8.4395 8.75169C8.158 9.03269 8 9.41419 8 9.81219V13.3122C8 13.7102 8.158 14.0917 8.4395 14.3727C8.7205 14.6542 9.102 14.8122 9.5 14.8122H13C13.398 14.8122 13.7795 14.6542 14.0605 14.3727C14.342 14.0917 14.5 13.7102 14.5 13.3122V9.81219ZM12.3105 7.20869L14.3965 5.12269C14.982 4.53719 14.982 3.58719 14.3965 3.00169L12.3105 0.915687C11.725 0.330188 10.775 0.330188 10.1895 0.915687L8.1035 3.00169C7.518 3.58719 7.518 4.53719 8.1035 5.12269L10.1895 7.20869C10.775 7.79419 11.725 7.79419 12.3105 7.20869ZM7 2.31219C7 1.91419 6.842 1.53269 6.5605 1.25169C6.2795 0.970186 5.898 0.812187 5.5 0.812187C4.507 0.812187 2.993 0.812187 2 0.812187C1.602 0.812187 1.2205 0.970186 0.939499 1.25169C0.657999 1.53269 0.5 1.91419 0.5 2.31219V5.81219C0.5 6.21019 0.657999 6.59169 0.939499 6.87269C1.2205 7.15419 1.602 7.31219 2 7.31219H5.5C5.898 7.31219 6.2795 7.15419 6.5605 6.87269C6.842 6.59169 7 6.21019 7 5.81219V2.31219Z"
            fill="white" />
        </svg>
      </button>
    </div>
  </div>

  <div class="card-body p-2 p-sm-3">
    @if($wishlists->count()>0)

    <div class="d-flex flex-column gap-10px">
      @foreach($wishlists as $key=>$wishlist)
      @php($product = $wishlist->product_full_info)
      @if( $wishlist->product_full_info)
      <div class="wishlist-item" id="row_id{{$product->id}}">
        <div class="wishlist-img position-relative">
          <a href="{{route('product',$product->slug)}}" class="d-block h-100">
            <img class="__img-full"
              src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$product['thumbnail']}}"
              onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'" alt="wishlist">
          </a>

          @if($product->discount > 0)
          <span class="for-discoutn-value px-1">
            @if ($product->discount_type == 'percent')
            {{round($product->discount,(!empty($decimal_point_settings) ? $decimal_point_settings: 0))}}%
            @elseif($product->discount_type =='flat')
            {{\App\CPU\Helpers::currency_converter($product->discount)}}
            @endif
          </span>
          @endif

        </div>
        <div class="wishlist-cont align-items-end align-items-sm-center">
          <div class="wishlist-text">
            <div class="font-name">
              <a href="{{route('product',$product['slug'])}}">{{$product['name']}}</a>
            </div>
            @if($brand_setting)
            <span class="sellerName"> {{translate('brand')}} : <span
                class="text-base">{{$product->brand?$product->brand['name']:''}}</span> </span>
            @endif

            <div class=" mt-sm-1">
              @if($product->discount > 0)
              <strike style="color: #9B9B9B;" class="{{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-3'}}">
                {{\App\CPU\Helpers::currency_converter($product->unit_price)}}
              </strike>
              @endif
              <span class="font-weight-bold amount text-dark">{{\App\CPU\Helpers::get_price_range($product) }}</span>
            </div>
          </div>
          <a href="javascript:" onclick="removeWishlist('{{$product['id']}}', 'remove-wishlist-modal')"
            class="remove--icon">
            <i class="ri-subtract-line"></i>
          </a>

        </div>
      </div>
      @else
      <span class="badge badge-danger">{{translate('item_removed')}}</span>
      @endif
      @endforeach
    </div>

    @else

    <div class="text-center py-3 text-capitalize">
      <img src="{{asset('public/assets/front-end/img/icons/wishlist.png')}}" alt="" class="mb-4" width="70">
      <h5 class="fs-14">{{translate('no_product_found_in_wishlist')}}!</h5>
    </div>

    @endif
  </div>
</div>

<div class="card-footer border-0">{{$wishlists->links()}}</div> --}}




<div class="card ">
        
  <div class="card-header py-4">
    <div class="d-flex align-items-center justify-content-between ">
      <h5 class="mb-0">{{translate('wishlists')}}</h5>

      <button class="profile-aside-btn btn btn--primary px-2 rounded px-2 py-1 d-lg-none">
        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
          <path fill-rule="evenodd" clip-rule="evenodd"
            d="M7 9.81219C7 9.41419 6.842 9.03269 6.5605 8.75169C6.2795 8.47019 5.898 8.31219 5.5 8.31219C4.507 8.31219 2.993 8.31219 2 8.31219C1.602 8.31219 1.2205 8.47019 0.939499 8.75169C0.657999 9.03269 0.5 9.41419 0.5 9.81219V13.3122C0.5 13.7102 0.657999 14.0917 0.939499 14.3727C1.2205 14.6542 1.602 14.8122 2 14.8122H5.5C5.898 14.8122 6.2795 14.6542 6.5605 14.3727C6.842 14.0917 7 13.7102 7 13.3122V9.81219ZM14.5 9.81219C14.5 9.41419 14.342 9.03269 14.0605 8.75169C13.7795 8.47019 13.398 8.31219 13 8.31219C12.007 8.31219 10.493 8.31219 9.5 8.31219C9.102 8.31219 8.7205 8.47019 8.4395 8.75169C8.158 9.03269 8 9.41419 8 9.81219V13.3122C8 13.7102 8.158 14.0917 8.4395 14.3727C8.7205 14.6542 9.102 14.8122 9.5 14.8122H13C13.398 14.8122 13.7795 14.6542 14.0605 14.3727C14.342 14.0917 14.5 13.7102 14.5 13.3122V9.81219ZM12.3105 7.20869L14.3965 5.12269C14.982 4.53719 14.982 3.58719 14.3965 3.00169L12.3105 0.915687C11.725 0.330188 10.775 0.330188 10.1895 0.915687L8.1035 3.00169C7.518 3.58719 7.518 4.53719 8.1035 5.12269L10.1895 7.20869C10.775 7.79419 11.725 7.79419 12.3105 7.20869ZM7 2.31219C7 1.91419 6.842 1.53269 6.5605 1.25169C6.2795 0.970186 5.898 0.812187 5.5 0.812187C4.507 0.812187 2.993 0.812187 2 0.812187C1.602 0.812187 1.2205 0.970186 0.939499 1.25169C0.657999 1.53269 0.5 1.91419 0.5 2.31219V5.81219C0.5 6.21019 0.657999 6.59169 0.939499 6.87269C1.2205 7.15419 1.602 7.31219 2 7.31219H5.5C5.898 7.31219 6.2795 7.15419 6.5605 6.87269C6.842 6.59169 7 6.21019 7 5.81219V2.31219Z"
            fill="white" />
        </svg>
      </button>
    </div>
  </div>

  <div class="card-body p-0">

    <div class="table-responsive">

      <table class="table">

        <thead>
          <tr>
            <td> {{translate('product_image')}} </td>

            <td> {{translate('item_name')}} </td>

            <td> {{translate('brand')}} </td>

            <td> {{translate('price')}} </td>

            <td> {{translate('action')}} </td>

          </tr>
        </thead>

        <tbody>

          @if($wishlists->count()>0)

              @foreach($wishlists as $wishlist)

                  @if( $wishlist->product_full_info)

                  @php($product = $wishlist->product_full_info)

                  <tr class="text-nowrap" id="row_id{{$product->id}}">

                    <td class="align-middle">
                      <a href="{{route('product',$product->slug)}}" class="d-block h-100">
                        <img class="__img-full"
                          src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$product['thumbnail']}}"
                          onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'" alt="wishlist" width="64">
                      </a>
                    </td>

                    <td class="align-middle">
                      <a href="{{route('product',$product['slug'])}}">{{$product['name']}}</a>
                    </td>

                    <td class="align-middle">
                      {{$product->brand ? $product->brand['name']:''}}
                    </td>

                    <td class="align-middle">
                      @if($product->discount > 0)
                      <strike style="color: #9B9B9B;" class="{{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-3'}}">
                        {{\App\CPU\Helpers::currency_converter($product->unit_price)}}
                      </strike>
                      @endif
                      {{\App\CPU\Helpers::get_price_range($product) }}
                    </td>

                    <td class="align-middle">
                      <a href="javascript:" onclick="removeWishlist('{{$product['id']}}', 'remove-wishlist-modal')"
                      class="text-danger">
                      <i class="ri-subtract-line"></i>
                    </a>
                    </td>

                  </tr>

                  @endif

              @endforeach

          @else
          <tr>
            <td colspan="10" class="text-center">
              <img src="{{asset('public/assets/front-end/img/icons/not-wishlist.svg')}}" alt="" width="70">
              <h5 class="fs-14">{{translate('no_product_found_in_wishlist')}}!</h5>
            </td>
          </tr>
          @endif

        </tbody>
      </table>

    </div>

  </div>

  @if($wishlists->hasPages())

  <div class="card-footer border-0">
    {{$wishlists->links()}}
  </div>

  @endif

</div>