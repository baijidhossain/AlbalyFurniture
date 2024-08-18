@extends('layouts.back-end.app')

@section('title', translate('product_List'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3 d-flex flex-column gap-1">
            <h2 class="h1 text-capitalize d-flex gap-2">
                <img src="{{asset('/public/assets/back-end/img/inhouse-product-list.png')}}" class="mb-1 mr-1" alt="">
                {{translate('limited_Stocked_Products_List')}}
                <span class="badge badge-soft-dark radius-50 fz-14 ml-1">{{ $pro->total() }}</span>
            </h2>
            <p class="d-flex">{{ translate('the_products_are_shown_in_this_list,_which_quantity_is_below') }} {{ $stock_limit }}</p>
        </div>
        <!-- End Page Title -->

        <div class="row mt-30">
            <div class="col-md-12">
                <div class="card">
                    <div class="px-3 py-4">
                        <div class="row justify-content-between align-items-center gy-2">
                            <div class="col-auto">
                                <!-- Search -->
                                <form action="{{ url()->current() }}" method="GET">
                                    <div class="input-group input-group-custom input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                               placeholder="{{translate('search_Product_Name')}}"
                                               aria-label="Search orders"
                                               value="{{ $search }}" required>
                                        <input type="hidden" value="{{ $request_status }}" name="status">
                                        <button type="submit"
                                                class="btn btn--primary">{{translate('search')}}</button>
                                    </div>
                                </form>
                                <!-- End Search -->
                            </div>

                            <div class="col-12 mt-1 col-md-6 col-lg-3">
                                <select name="qty_ordr_sort" class="form-control"
                                        onchange="location.href='{{route('admin.product.stock-limit-list',['in_house', ''])}}/?sort_oqrderQty='+this.value">
                                    <option
                                        value="default" {{ $sort_oqrderQty== "default"?'selected':''}}>{{translate('default_sort')}}</option>
                                    <option
                                        value="quantity_asc" {{ $sort_oqrderQty== "quantity_asc"?'selected':''}}>{{translate('quantity_sort_by_(low_to_high)')}}</option>
                                    <option
                                        value="quantity_desc" {{ $sort_oqrderQty== "quantity_desc"?'selected':''}}>{{translate('quantity_sort_by_(high_to_low)')}}</option>
                                    <option
                                        value="order_asc" {{ $sort_oqrderQty== "order_asc"?'selected':''}}>{{translate('order_sort_by_(low_to_high)')}}</option>
                                    <option
                                        value="order_desc" {{ $sort_oqrderQty== "order_desc"?'selected':''}}>{{translate('order_sort_by_(high_to_low)')}}</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="datatable"
                                style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                                class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                            <thead class="thead-light thead-50 text-capitalize">
                            <tr>
                                <th>{{translate('SL')}}</th>
                                <th>{{translate('product_Name')}}</th>
                                <th>{{translate('purchase_price')}}</th>
                                <th>{{translate('selling_price')}}</th>
                                <th>{{translate('quantity')}}</th>
                                <th class="text-center">{{translate('active_status')}}</th>
                                <th class="text-center">{{translate('action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pro as $k=>$p)
                                <tr>
                                    <th scope="row">{{$pro->firstItem()+$k}}</th>
                                    <td>
                                        <a href="{{route('admin.product.view',[$p['id']])}}" class="media align-items-center gap-2">
                                            <img src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$p['thumbnail']}}"
                                                 onerror="this.src='{{asset('/public/assets/back-end/img/brand-logo.png')}}'"class="avatar border" alt="">
                                            <span class="media-body title-color hover-c1">
                                                {{\Illuminate\Support\Str::limit($p['name'],20)}}
                                            </span>
                                        </a>
                                    </td>
                                    <td>
                                        {{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['purchase_price']))}}
                                    </td>
                                    <td>
                                        {{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['unit_price']))}}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center product-quantity">
                                            {{$p['current_stock']}}

                                            <button class="btn py-0 px-2 fz-18" id="{{ $p->id }}"
                                                    onclick="update_quantity({{ $p->id }})" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#update-quantity"
                                                    title="{{ translate('update_quantity') }}">
                                                <i class="ri-add-line-circle c1"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if($p->request_status != 2 )
                                            <form action="{{route('admin.product.status-update')}}" method="post" id="product_status{{$p['id']}}_form" class="product_status_form">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$p['id']}}">
                                                <label class="switcher mx-auto">
                                                    <input type="checkbox" class="switcher_input" id="product_status{{$p['id']}}" name="status" value="1" {{ $p['status'] == 1 ? 'checked':'' }} onclick="toogleStatusModal(event,'product_status{{$p['id']}}','product-status-on.png','product-status-off.png','{{translate('Want_to_Turn_ON')}} {{$p['name']}} {{translate('status')}}','{{translate('Want_to_Turn_OFF')}} {{$p['name']}} {{translate('status')}}',`<p>{{translate('if_enabled_this_product_will_be_available_on_the_website_and_customer_app')}}</p>`,`<p>{{translate('if_disabled_this_product_will_be_hidden_from_the_website_and_customer_app')}}</p>`)">
                                                    <span class="switcher_control"></span>
                                                </label>
                                            </form>

                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a class="btn btn-outline-info btn-sm square-btn" title="{{ translate('barcode') }}"
                                                href="{{ route('admin.product.barcode', [$p['id']]) }}">
                                                <i class="tio-barcode"></i>
                                            </a>
                                            <a class="btn btn-outline--primary btn-sm square-btn"
                                                title="{{translate('edit')}}"
                                                href="{{route('admin.product.edit',[$p['id']])}}">
                                                <i class="tio-edit"></i>
                                            </a>
                                            <a class="btn btn-outline-danger btn-sm square-btn" href="javascript:"
                                                title="{{translate('delete')}}"
                                                onclick="form_alert('product-{{$p['id']}}','{{translate('want_to_delete_this_item?')}}')">
                                                <i class="ri-delete-bin-5-line"></i>
                                            </a>
                                        </div>
                                        <form action="{{route('admin.product.delete',[$p['id']])}}"
                                                method="post" id="product-{{$p['id']}}">
                                            @csrf @method('delete')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive mt-4">
                        <div class="px-4 d-flex justify-content-lg-end">
                            <!-- Pagination -->
                            {{$pro->links()}}
                        </div>
                    </div>

                    @if(count($pro)==0)
                        <div class="text-center p-4">
                            <img class="mb-3 w-160" src="{{asset('public/assets/back-end')}}/svg/illustrations/sorry.svg"
                                 alt="Image Description">
                            <p class="mb-0">{{translate('no_data_to_show')}}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="update-quantity" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('admin.product.update-quantity')}}" method="post" class="row">
                    <div class="modal-body">
                        @csrf
                        <div class="rest-part"></div>
                        <div class="d-flex justify-content-end gap-10 flex-wrap align-items-center">
                            <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal" aria-label="Close">
                                {{translate('close')}}
                            </button>
                            <button class="btn btn--primary" class="btn btn--primary px-4" type="submit">{{translate('submit')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function update_quantity(val) {
            $.get({
                url: '{{url('/')}}/admin/product/get-variations?id='+val,
                dataType: 'json',
                success: function (data) {
                    console.log(data)
                    $('.rest-part').empty().html(data.view);
                },
            });
        }

        function update_qty() {
            var total_qty = 0;
            var qty_elements = $('input[name^="qty_"]');
            for (var i = 0; i < qty_elements.length; i++) {
                total_qty += parseInt(qty_elements.eq(i).val());
            }
            if (qty_elements.length > 0) {

                $('input[name="current_stock"]').attr("readonly", true);
                $('input[name="current_stock"]').val(total_qty);
            } else {
                $('input[name="current_stock"]').attr("readonly", false);
            }
        }
    </script>
     <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });

        $('.product_status_form').on('submit', function(event){
            event.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.product.status-update')}}",
                method: 'POST',
                data: $(this).serialize(),
                success: function (data) {
                    if(data.success == true) {
                        toastr.success('{{translate("status_updated_successfully")}}');
                    }
                    else if(data.success == false) {
                        toastr.error('{{translate("Status_updated_failed.")}} {{translate("Product_must_be_approved")}}');
                        setTimeout(function(){
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });

    </script>
@endpush
