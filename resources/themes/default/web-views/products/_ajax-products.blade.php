


@php($decimal_point_settings = \App\CPU\Helpers::get_business_settings('decimal_point_settings'))

@foreach($products as $product)
    @if(!empty($product['product_id']))
        @php($product=$product->product)
    @endif
    <div class="col-lg-4 col-sm-6">
        @if(!empty($product))
            @include('web-views.partials._filter-single-product',['p'=>$product,'decimal_point_settings'=>$decimal_point_settings])
        @endif
    </div>
@endforeach

<div class="col-12">

    @if ($products->hasPages())
    <nav class="pagination-nav">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($products->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a class="page-link next" href="javascript:void(0)" aria-label="Previous">
                        <i class="ri-arrow-left-s-line"></i>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link next" href="{{ $products->previousPageUrl() }}" aria-label="@lang('pagination.previous')">
                        <i class="ri-arrow-left-s-line"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($products->links()->elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $products->currentPage())
                            <li class="page-item " aria-current="page"><span class="page-link active">{{ sprintf('%02d', $page) }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ sprintf('%02d', $page) }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($products->hasMorePages())
                <li class="page-item">
                    <a class="page-link next" href="{{ $products->nextPageUrl() }}" aria-label="@lang('pagination.next')">
                        <i class="ri-arrow-right-s-line"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <a class="page-link next" href="javascript:void(0)" aria-label="Next">
                        <i class="ri-arrow-right-s-line"></i>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif


</div>
