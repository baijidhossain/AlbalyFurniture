




@php
$temporary_close = \App\CPU\Helpers::get_business_settings('temporary_close');
$inhouse_vacation = \App\CPU\Helpers::get_business_settings('vacation_add');

$inhouse_vacation_status = $product->added_by == 'admin' ? $inhouse_vacation['status'] : false;
$inhouse_temporary_close = $product->added_by == 'admin' ? $temporary_close['status'] : false;

$countWishlist = \App\Model\Wishlist::where('product_id', $product->id)->count();
$overallRating = \App\CPU\ProductManager::get_overall_rating($product->reviews);

@endphp

  <div class="product-card best-product-card">
     
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


      <div class="product-img-card best-product-img-card">
        <a href="{{route('product',$product->slug)}}" class="zoomImg">
          <img class="__img-125px"
          src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$product['thumbnail']}}"
          onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"/>
        </a>
          
      </div>

      <a href="{{route('product',$product->slug)}}">
        <h4 class="product-title line-clamp-1">{{ Str::limit($product['name'], 23) }}</h4>
      </a>

    <div class="product-review">

      <div class="product-ratting">

        @if($overallRating[0] != 0 )

        @for($inc=1;$inc<=5;$inc++) @if ($inc <=(int)$overallRating[0]) <i class="ri-star-s-fill text-warning"></i>
          @elseif ($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0]>
            ((int)$overallRating[0]))
            <i class="ri-star-half-s-line text-warning"></i>
            @else
            <i class="ri-star-s-line text-warning"></i>
            @endif
            @endfor

            @else
            <i class="ri-star-s-line text-warning"></i>
            <i class="ri-star-s-line text-warning"></i>
            <i class="ri-star-s-line text-warning"></i>
            <i class="ri-star-s-line text-warning"></i>
            <i class="ri-star-s-line text-warning"></i>
            @endif
      </div>

      <p class="count-ratting">({{ count($product->reviews ?? []) }})</p>

    </div>



    <div class="cart-card best-product-cart-card d-none d-md-block">
      <a href="{{route('product',$product->slug)}}">
        <h4 class="product-title line-clamp-1">{{ Str::limit($product['name'], 23) }}</h4>
      </a>

      <div class="product-review">

        <div class="product-ratting">

          @if($overallRating[0] != 0 )

          @for($inc=1;$inc<=5;$inc++) @if ($inc <=(int)$overallRating[0]) <i class="ri-star-s-fill text-warning"></i>
            @elseif ($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0]>
              ((int)$overallRating[0]))
              <i class="ri-star-half-s-line text-warning"></i>
              @else
              <i class="ri-star-s-line text-warning"></i>
              @endif
              @endfor

              @else
              <i class="ri-star-s-line text-warning"></i>
              <i class="ri-star-s-line text-warning"></i>
              <i class="ri-star-s-line text-warning"></i>
              <i class="ri-star-s-line text-warning"></i>
              <i class="ri-star-s-line text-warning"></i>
              @endif
        </div>

        <p class="count-ratting"> ({{ count($product->reviews ?? []) }})</p>

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
                <div class="qty-container featury-qty-container best-product-qty-container">

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
            </div>
      </form>

    </div>



    <div class="button-section d-block d-md-none">

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

    </div>
      
  </div>
