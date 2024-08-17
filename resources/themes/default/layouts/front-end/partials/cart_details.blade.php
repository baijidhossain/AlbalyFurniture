@php($shippingMethod=\App\CPU\Helpers::get_business_settings('shipping_method'))
@php($cart=\App\Model\Cart::where(['customer_id' => (auth('customer')->check() ? auth('customer')->id() : session('guest_id'))])->get()->groupBy('cart_group_id'))

@push('css')
<style>
  input[type=text]:focus,
  input[type=email]:focus,
  input[type=url]:focus,
  input[type=password]:focus,
  input[type=search]:focus,
  input[type=tel]:focus,
  input[type=number]:focus,
  textarea:focus,
  input[type=button]:focus,
  input[type=reset]:focus,
  input[type=submit]:focus,
  select:focus {
    outline: none;
    -webkit-box-shadow: none;
    box-shadow: none;
    border: 0.1rem solid var(--primary-color);
    border-radius: 3px;
  }

  .cursore-pointer {
    cursor: pointer;
  }
</style>
    
@endpush

<div class="row my-5">

  <div class="col-lg-8">

    <div class="card mb-3">

      <div class="card-header py-4">
        <div class="d-flex align-items-center justify-content-between ">
          <h5 class="mb-0">{{translate('Shopping_card')}}</h5>
    
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
    
            <thead >
              <tr class="">
    
                  <th>Product</th>
    
                  <th>Unit price</th>
    
                  <th class="text-center">Qty</th>
    
                  <th>Total</th>
    
              </tr>
    
              </thead>
    
            <tbody>

              @foreach($cart as $group_key=>$group)

                       <?php
                            $physical_product = false;
                            $total_shipping_cost = 0;
                            foreach ($group as $row) {
                                if ($row->product_type == 'physical') {
                                    $physical_product = true;
                                }
                                if ($row->product_type == 'physical' && $row->shipping_type != "order_wise") {
                                    $total_shipping_cost += $row->shipping_cost;
                                }
                            }

                         ?>


                          @foreach($group as $cart_key=>$cartItem)
                          @if ($shippingMethod=='inhouse_shipping')
                                  <?php
                                      $admin_shipping = \App\Model\ShippingType::where('seller_id', 0)->first();
                                      $shipping_type = isset($admin_shipping) == true ? $admin_shipping->shipping_type : 'order_wise';
                                  ?>
                          @else
                                  <?php
                                  if ($cartItem->seller_is == 'admin') {
                                      $admin_shipping = \App\Model\ShippingType::where('seller_id', 0)->first();
                                      $shipping_type = isset($admin_shipping) == true ? $admin_shipping->shipping_type : 'order_wise';
                                  } else {
                                      $seller_shipping = \App\Model\ShippingType::where('seller_id', $cartItem->seller_id)->first();
                                      $shipping_type = isset($seller_shipping) == true ? $seller_shipping->shipping_type : 'order_wise';
                                  }
                                  ?>
                          @endif

                      
                          @endforeach

                        @foreach($group as $cart_key=>$cartItem)

                        @php($product = $cartItem->all_product)

                            
                        <?php
                        $physical_product = false;
                        foreach ($group as $row) {
                            if ($row->product_type == 'physical') {
                                $physical_product = true;
                            }
                        }
                    ?>
                   
                   
                    @php($product_status = $cartItem->all_product->status)
                        <tr>
                            <td class="align-middle">
                                <div class="d-flex gap-3 align-items-center">
                                    <div class="">
                                        <a href="{{ $product_status == 1 ? route('product',$cartItem['slug']) : 'javascript:'}}" class="position-relative overflow-hidden">
                                            <img class="rounded __img-62 {{ $product_status == 0?'blur-section':'' }}"
                                                    onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                    src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$cartItem['thumbnail']}}"
                                                    alt="Product" width="64">
                                            @if ($product_status == 0)
                                                <span class="temporary-closed position-absolute text-center p-2">
                                                    <span>{{ translate('N/A') }}</span>
                                                </span>
                                            @endif
                                        </a>
                                    </div>
                                    <div class="d-flex flex-column gap-1">
                                        <div class="text-break __line-2 __w-18rem {{ $product_status == 0?'blur-section':'' }}">
                                            <a href="{{ $product_status == 1 ? route('product',$cartItem['slug']) : 'javascript:'}}">{{$cartItem['name']}}</a>
                                        </div>

                                        <div class="d-flex flex-wrap gap-2 {{ $product_status == 0?'blur-section':'' }}">
                                            @foreach(json_decode($cartItem['variations'],true) as $key1 =>$variation)
                                                <div class="">
                                                    <span class="__text-12px text-capitalize">
                                                        <span class="text-muted">{{$key1}} </span> : <span class="fw-semibold">{{$variation}}</span>
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                        @if ( $shipping_type != 'order_wise')
                                            <div class="d-flex flex-wrap gap-2 {{ $product_status == 0?'blur-section':'' }}">
                                                <span class="fw-semibold"> {{translate('shipping_cost')}}</span>:<span>{{ \App\CPU\Helpers::currency_converter($cartItem['shipping_cost']) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">
                                
                                    <div class="fw-semibold">{{ \App\CPU\Helpers::currency_converter($cartItem['price']-$cartItem['discount']) }}</div>
                                    <span class="text-nowrap fs-10">
                                        @if ($cartItem->tax_model === "exclude")
                                            ({{translate('tax')}} : {{\App\CPU\Helpers::currency_converter($cartItem['tax']*$cartItem['quantity'])}})
                                        @else
                                            ({{translate('tax_included')}})
                                        @endif
                                     </span>
                              
                            </td>
                            <td class="align-middle">
                                <!-- Qty update -->
                                @php($minimum_order=\App\CPU\ProductManager::get_product($cartItem['product_id']))
                                @if ($product_status == 1)
                                    <div class="qty text-center d-flex align-items-center justify-content-center">
                                        <span class="cursore-pointer qty_minus " onclick="updateCartQuantityList('{{ $product->minimum_order_qty }}', '{{$cartItem['id']}}', '-1', '{{ $cartItem['quantity'] == $product->minimum_order_qty ? 'delete':'minus' }}')">
                                            <i class="{{ $cartItem['quantity'] == (isset($cartItem->product->minimum_order_qty) ? $cartItem->product->minimum_order_qty : 1) ? 'ri-close-line text-danger' : 'ri-subtract-line' }}"></i>
                                        </span>
                                        <input type="text" class="text-center qty_input cartQuantity{{ $cartItem['id'] }}" value="{{$cartItem['quantity']}}" name="quantity[{{ $cartItem['id'] }}]" id="cart_quantity_web{{$cartItem['id']}}"
                                            onchange="updateCartQuantityList('{{ $product->minimum_order_qty }}', '{{$cartItem['id']}}', '0')" data-min="{{ isset($cartItem->product->minimum_order_qty) ? $cartItem->product->minimum_order_qty : 1 }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                        <span class="cursore-pointer qty_plus" onclick="updateCartQuantityList('{{ $product->minimum_order_qty }}', '{{$cartItem['id']}}', '1')">
                                            <i class="ri-add-line"></i>
                                        </span>
                                    </div>
                                @else
                                <div class="qty">
                                    <span onclick="updateCartQuantityList('{{ $product->minimum_order_qty }}', '{{$cartItem['id']}}', '-{{$cartItem['quantity']}}', 'delete')">
                                        <i class="ri-close-line text-danger" data-toggle="tooltip" data-title="{{translate('product_not_available_right_now')}}"></i>
                                    </span>
                                </div>
                                @endif
                            </td>
                            <td class="align-middle">
                                <div>
                                    {{ \App\CPU\Helpers::currency_converter(($cartItem['price']-$cartItem['discount'])*$cartItem['quantity']) }}
                                </div>
                            </td>
                        </tr>
                        @endforeach

              @endforeach
    

              @if( $cart->count() == 0)

              <tr>
                <td colspan="10">
                  <div class="text-center">
                    <img class="mb-3 mw-100" src="{{asset('/public/assets/front-end/img/icons/empty-cart.svg')}}"
                      alt="">
                    <p class="text-capitalize">{{translate('Your_Cart_is_Empty')}}!</p>
                  </div>
                </td>
              </tr>

              @endif
       
            </tbody>
          </table>

        </div>

      </div>

    </div>


    <div class="card">
      <div class="card-body">

        @if($shippingMethod=='inhouse_shipping')
        <div>
 
          <?php
                      $physical_product = false;
                      foreach($cart as $group_key=>$group){
                          foreach ($group as $row) {
                              if ($row->product_type == 'physical') {
                                  $physical_product = true;
                              }
                          }
                      }
                  ?>

          <?php
                      $admin_shipping = \App\Model\ShippingType::where('seller_id', 0)->first();
                      $shipping_type = isset($admin_shipping) == true ? $admin_shipping->shipping_type : 'order_wise';
                  ?>
          @if ($shipping_type == 'order_wise' && $physical_product)
          @php($shippings=\App\CPU\Helpers::get_shipping_methods(1,'admin'))
          @php($choosen_shipping=\App\Model\CartShipping::where(['cart_group_id'=>$cartItem['cart_group_id']])->first())

          @if(isset($choosen_shipping)==false)
          @php($choosen_shipping['shipping_method_id']=0)
          @endif
          <div class="mb-3">
            <div class="row">
              <div class="col-12">
                <select class="form-control border-aliceblue"
                  onchange="set_shipping_id(this.value,'all_cart_group')">
                  <option>{{translate('choose_shipping_method')}}</option>
                  @foreach($shippings as $shipping)
                  <option value="{{$shipping['id']}}"
                    {{$choosen_shipping['shipping_method_id']==$shipping['id']?'selected':''}}>
                    {{translate('shipping_method')}} :
                    {{$shipping['title'].' ( '.$shipping['duration'].' ) '.\App\CPU\Helpers::currency_converter($shipping['cost'])}}
                  </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          @endif
        </div>
        @endif

        <div>
          <form method="get">
            <div class="mb-lg-3">
              <div class="row">
                <div class="col-12">
                  <label for="phoneLabel" class="form-label input-label">{{translate('order_note')}} <span
                      class="input-label-secondary">({{translate('optional')}})</span></label>
                  <textarea class="form-control w-100 border-aliceblue" id="order_note"
                    name="order_note">{{ session('order_note')}}</textarea>
                </div>
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>

  </div>

  <div class="col-lg-4">
        @include('web-views.partials._order-summary')
  </div>
  
</div>


@push('script')
    <script>
         function updateCartQuantityList(minimum_order_qty, key, incr, e) {
            let quantity_id = 'cart_quantity_web';
            updateCartCommon(minimum_order_qty, key,incr,e, quantity_id);
        }

        function updateCartQuantityListMobile(minimum_order_qty, key, incr, e) {
            let quantity_id = 'cart_quantity_mobile';
            updateCartCommon(minimum_order_qty, key,incr,e, quantity_id);
        }

         function updateCartCommon(minimum_order_qty, key,incr,e,quantity_id) {
            let quantity = parseInt($("#"+quantity_id+ key).val())+parseInt(incr);
            let ex_quantity = $("#"+quantity_id+ key);
            if(minimum_order_qty > quantity && e != 'delete' ) {
                toastr.error('{{translate("minimum_order_quantity_cannot_be_less_than_")}}' + minimum_order_qty);
                $(".cartQuantity" + key).val(minimum_order_qty);
                return false;
            }
            if (ex_quantity.val() == ex_quantity.data('min') && e == 'delete') {
                $.post("{{ route('cart.remove') }}", {
                    _token: '{{ csrf_token() }}',
                    key: key
                },
                function (response) {
                    updateNavCart();
                    toastr.info("{{translate('item_has_been_removed_from_cart')}}", {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    let segment_array = window.location.pathname.split('/');
                    let segment = segment_array[segment_array.length - 1];
                    if (segment === 'checkout-payment' || segment === 'checkout-details') {
                        location.reload();
                    }
                    $('#cart-summary').empty().html(response.data);
                });
            }else{
                $.post('{{route('cart.updateQuantity')}}', {
                    _token: '{{csrf_token()}}',
                    key,
                    quantity
                }, function (response) {
                    if (response.status == 0) {
                        toastr.error(response.message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                        $(".cartQuantity" + key).val(response['qty']);
                    } else {
                        updateNavCart();
                        $('#cart-summary').empty().html(response);
                    }
                });
            }
        }
        //Increase/Decrease Product Quantity
        /* Increase */
        $('.qty_plus').on('click', function () {
            var $qty = $(this).parent().find('input');
            var currentVal = parseInt($qty.val());
            if (!isNaN(currentVal)) {
                $qty.val(currentVal + 1);
            }
            quantityListener();
        });

        /* Decrease */
        $('.qty_minus').on('click', function () {
            var $qty = $(this).parent().find('input');
            var currentVal = parseInt($qty.val());
            if (!isNaN(currentVal) && currentVal > 1) {
                $qty.val(currentVal - 1);
            }
            quantityListener();
        });

        /* show hide delete icon */
        function quantityListener() {
            $('.qty_input').each(function () {
                var qty = $(this);
                if (qty.val() == 1) {
                    qty.siblings('.qty_minus').html('<i class="ri-close-line text-danger fs-12"></i>')
                } else {
                    qty.siblings('.qty_minus').html('<i class="ri-subtract-line"></i>')
                }
            });
        }
        quantityListener();
    </script>
    <script>
        cartQuantityInitialize();

        function set_shipping_id(id, cart_group_id) {
            $.get({
                url: '{{url('/')}}/customer/set-shipping-method',
                dataType: 'json',
                data: {
                    id: id,
                    cart_group_id: cart_group_id
                },
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    location.reload();
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        }
    </script>
    <script>
        function checkout() {
            let order_note = $('#order_note').val();
            //console.log(order_note);
            $.post({
                url: "{{route('order_note')}}",
                data: {
                    _token: '{{csrf_token()}}',
                    order_note: order_note,

                },
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    let url = "{{ route('checkout-details') }}";
                    location.href = url;

                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        }

    function minimum_Order_Amount_message(data)
    {
        toastr.error(data, {
            CloseButton: true,
            ProgressBar: true
        });
    }

</script>
@endpush
