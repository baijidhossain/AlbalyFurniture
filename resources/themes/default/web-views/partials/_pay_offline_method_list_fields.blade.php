@if ($method)
        <?php
            $product_price_total=0;
            $total_tax=0;
            $total_shipping_cost=0;
            $order_wise_shipping_discount=\App\CPU\CartManager::order_wise_shipping_discount();
            $total_discount_on_product=0;
            $cart=\App\CPU\CartManager::get_cart();
            $cart_group_ids=\App\CPU\CartManager::get_cart_group_ids();
            $shipping_cost=\App\CPU\CartManager::get_shipping_cost();
            $get_shipping_cost_saved_for_free_delivery=\App\CPU\CartManager::get_shipping_cost_saved_for_free_delivery();
            $coupon_discount = session()->has('coupon_discount')?session('coupon_discount'):0;
            $coupon_dis=session()->has('coupon_discount')?session('coupon_discount'):0;
            if($cart->count() > 0){
                foreach($cart as $key => $cartItem){
                    $product_price_total+=$cartItem['price']*$cartItem['quantity'];
                    $total_tax+=$cartItem['tax_model']=='exclude' ? ($cartItem['tax']*$cartItem['quantity']):0;
                    $total_discount_on_product+=$cartItem['discount']*$cartItem['quantity'];
                }

                if(session()->missing('coupon_type') || session('coupon_type') !='free_delivery'){
                    $total_shipping_cost=$shipping_cost - $get_shipping_cost_saved_for_free_delivery;
                }else{
                    $total_shipping_cost=$shipping_cost;
                }

                $total_offline_amount = $product_price_total+$total_tax+$total_shipping_cost-$coupon_dis-$total_discount_on_product-$order_wise_shipping_discount;
            }
        ?>

    <!-- dynamic payment modal field section -->
    <div class="payment-list-area">

      <h4 class="my-3 font-weight-bold text-center">{{translate('amount')}} : {{ \App\CPU\Helpers::currency_converter($total_offline_amount) }}</h4>
        
        <div class="bg-primary-light rounded mb-4">
            <h4 class="text-capitalize mb-2">{{ $method->method_name }} {{translate('payment')}}</h4>

            <div class="row g-2 fs-12">
                @foreach ($method->method_fields as $method_field)
                    <div class="col-md-12">
                        <div class="d-flex gap-2">
                            <span class="text-muted text-nowrap">{{ translate($method_field['input_name']) }} : </span>      <span >{!! translate($method_field['input_data']) !!}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <h4 class="text-capitalize ">{{translate('customer_info')}}</h4>
        
        <div class="mt-2">
            <div class="row">
                <input type="hidden" value="offline_payment" name="payment_method">
                <input type="hidden" value="{{ $method->id }}" name="method_id">
                <?php
                    $count =  count($method->method_informations);
                    $count_status = $count%2 == 1 ? 'odd' : 'even';
                ?>
                @foreach ($method->method_informations as $key=>$informations)
                    <div class="col-sm-{{$key == 0 && $count_status==="odd" ? 12 : 6}} mb-3">
                        <div class="form-group">
                            <label for="payment_by">{{ translate($informations['customer_input']) }}
                                <span class="text-danger">{{ $informations['is_required'] == 1?'*':''}}</span>
                            </label>
                            <input type="text" name="{{ $informations['customer_input'] }}" class="form-control" placeholder="{{ translate($informations['customer_placeholder']) }}" {{ $informations['is_required'] == 1?'required':''}}>
                        </div>
                    </div>
                @endforeach

                <div class="col-12 mb-3">
                    <div class="form-group ">
                        <label for="account_no">{{translate('payment_note')}}</label>
                        <textarea class="form-control" name="payment_note" rows="4" placeholder="{{translate('insert_note')}}"></textarea>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex justify-content-end gap-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{translate('close')}}</button>
                        <button type="submit" class="btn btn--primary">{{translate('submit')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of dynamic payment modal field section -->
@endif
