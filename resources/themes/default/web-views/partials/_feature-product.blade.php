{{-- <div class="product-single-hover shadow-none rtl">
    <div class="overflow-hidden position-relative">
        <div class="inline_product clickable">
            @if($product->discount > 0)
                <span class="for-discoutn-value p-1 pl-2 pr-2">
                @if ($product->discount_type == 'percent')
                        {{round($product->discount,(!empty($decimal_point_settings) ? $decimal_point_settings: 0))}}%
@elseif($product->discount_type =='flat')
{{\App\CPU\Helpers::currency_converter($product->discount)}}
@endif
{{translate('off')}}
</span>
@else
<span class="for-discoutn-value-null"></span>
@endif
<a href="{{route('product',$product->slug)}}">
  <img src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$product['thumbnail']}}"
    onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'">
</a>

<div class="quick-view">
  <a class="btn-circle stopPropagation" href="javascript:" onclick="quickView('{{$product->id}}')">
    <i class="czi-eye align-middle"></i>
  </a>
</div>
@if($product->product_type == 'physical' && $product->current_stock <= 0) <span class="out_fo_stock">
  {{translate('out_of_stock')}}</span>
  @endif
  </div>
  <div class="single-product-details">
    @if($overallRating[0] != 0 )
    <div class="rating-show justify-content-between">
      <span class="d-inline-block font-size-sm text-body">
        @for($inc=1;$inc<=5;$inc++) @if ($inc <=(int)$overallRating[0]) <i class="tio-star text-warning"></i>
          @elseif ($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0]>
            ((int)$overallRating[0]))
            <i class="tio-star-half text-warning"></i>
            @else
            <i class="tio-star-outlined text-warning"></i>
            @endif
            @endfor
            <label class="badge-style">( {{$product->reviews_count}} )</label>
      </span>
    </div>
    @endif
    <div>
      <a href="{{route('product',$product->slug)}}" class="text-capitalize fw-semibold">
        {{ Str::limit($product['name'], 23) }}
      </a>
    </div>
    <div class="justify-content-between">
      <div class="product-price">
        @if($product->discount > 0)
        <strike style="font-size: 12px!important;color: #9B9B9B!important;margin-inline-end:5px">
          {{\App\CPU\Helpers::currency_converter($product->unit_price)}}
        </strike>
        @endif
        <span class="text-accent text-dark">
          {{\App\CPU\Helpers::currency_converter(
                            $product->unit_price-(\App\CPU\Helpers::get_product_discount($product,$product->unit_price))
                        )}}
        </span>
      </div>
    </div>
  </div>
  </div>
  </div> --}}

  @php
      $temporary_close = \App\CPU\Helpers::get_business_settings('temporary_close');
      $inhouse_vacation = \App\CPU\Helpers::get_business_settings('vacation_add');

      $inhouse_vacation_status = $product->added_by == 'admin' ? $inhouse_vacation['status'] : false;
      $inhouse_temporary_close = $product->added_by == 'admin' ? $temporary_close['status'] : false;

      $countWishlist = \App\Model\Wishlist::where('product_id', $product->id)->count();
      $overallRating = \App\CPU\ProductManager::get_overall_rating($product->reviews);

  @endphp

  <div class="swiper-slide">
    <div class="product-card feature-card h-calc">
      <div class="top-card">
        <div class="price-section">

          @if($product->discount > 0)
          <h4 class="price discounted">{{\App\CPU\Helpers::currency_converter($product->unit_price)}}</h4>
          @endif

          <h4 class="price text-color-primary">
            {{\App\CPU\Helpers::currency_converter($product->unit_price-(\App\CPU\Helpers::get_product_discount($product,$product->unit_price)))}}
          </h4>

        </div>

        <style>
          .wish-lish-icon {
            font-size: 28px !important;
            font-weight: normal !important;
            color: #9b9b9b !important;
          }
        </style>
        <button class="wishlist-icon" onclick="addWishlist('{{$product['id']}}')">

          @php( $wishlist_status = \App\Model\Wishlist::where(['product_id'=>$product->id,
          'customer_id'=>auth('customer')->id()])->count())

          <i
            class="{{($wishlist_status == 1 ? 'ri-heart-3-fill':'ri-heart-3-line')}}  wish-lish-icon   wishlist_icon_{{$product['id']}}"></i>

        </button>

      </div>

      <div class="product-img-card feature-img-card">

        <a class="zoomImg" href="{{route('product',$product->slug)}}">
          <img src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$product['thumbnail']}}"
            onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'">
        </a>

      </div>
      <a href="{{route('product',$product->slug)}}">
        <h4 class="product-title line-clamp-1">{{ Str::limit($product['name'], 23) }}</h4>
      </a>
      <div class="product-review">

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

        <p class="count-ratting">Ratting ({{$product->reviews_count}})</p>

      </div>

      <div class="cart-card feature-cart-card d-none d-md-block">
        <a href="{{route('product',$product->slug)}}">
          <h4 class="product-title line-clamp-1">{{ Str::limit($product['name'], 23) }}</h4>
        </a>

        <div class="product-review">

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

          <p class="count-ratting"> Ratting ({{$product->reviews_count}})</p>
        </div>

        <form id="add-to-cart-form-{{ $product->id }}" class="mb-2 add-to-cart-form">
          @csrf
          <input type="hidden" name="id" value="{{ $product->id }}">
          <div class="button-section">

            @if(($product->added_by == 'seller' && ($seller_temporary_close || (isset($product->seller->shop) &&
            $product->seller->shop->vacation_status && $current_date >= $seller_vacation_start_date && $current_date
            <= $seller_vacation_end_date))) || ($product->added_by == 'admin' && ($inhouse_temporary_close ||
              ($inhouse_vacation_status && $current_date >= $inhouse_vacation_start_date && $current_date <=
                $inhouse_vacation_end_date)))) <a href="javascript:void(0)" class="cart-btn" type="button" disabled>
                {{translate('add_to_cart')}} </a>
                @else

                <a href="javascript:void(0)" class="cart-btn" onclick="addToCart('add-to-cart-form-{{ $product->id }}')"
                  type="button">
                  {{translate('add_to_cart')}}
                </a>

                @endif

                <div class="fill-pill-btn qty-btn">
                  <div class="qty-container featury-qty-container">

                    <div class=" btn-number qty-btn mr-1 text-primary" type="button" data-type="minus"
                      data-field="quantity" disabled="disabled"> <i class="ri-subtract-fill"></i>
                    </div>

                    <input type="text" name="quantity" class="input-qty input-rounded  input-number  cart-qty-field"
                      placeholder="1" value="{{ $product->minimum_order_qty ?? 1 }}"
                      product-type="{{ $product->product_type }}" min="{{ $product->minimum_order_qty ?? 1 }}"
                      max="{{$product['product_type'] == 'physical' ? $product->current_stock : 100}}">

                    <div class="btn-number  qty-btn ml-1 text-primary" type="button"
                      product-type="{{ $product->product_type }}" data-type="plus" data-field="quantity"> <i
                        class="ri-add-fill"></i>
                    </div>

                  </div>

                </div>

        </form>

      </div>

    </div>

    <div class="button-section d-block d-md-none">

      @if(($product->added_by == 'seller' && ($seller_temporary_close || (isset($product->seller->shop) &&
      $product->seller->shop->vacation_status && $current_date >= $seller_vacation_start_date && $current_date
      <= $seller_vacation_end_date))) || ($product->added_by == 'admin' && ($inhouse_temporary_close ||
        ($inhouse_vacation_status && $current_date >= $inhouse_vacation_start_date && $current_date <=
          $inhouse_vacation_end_date)))) <a href="javascript:void(0)" class="cart-btn" type="button" disabled>
          {{translate('add_to_cart3')}} </a>
          @else

          <a href="javascript:void(0)" class="cart-btn" onclick="addToCart('add-to-cart-form-{{ $product->id }}')"
            type="button">
            {{translate('add_to_cart3')}}
          </a>
          @endif

    </div>

  </div>
  </div>