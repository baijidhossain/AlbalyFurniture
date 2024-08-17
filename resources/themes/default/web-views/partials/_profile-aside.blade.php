
<div class="col-lg-3">
    <div class="profile-aside-overlay d-lg-none"></div>
    <div class="__customer-sidebar  user-profile-aside" id="shop-sidebar">
        <div class="d-flex justify-content-end d-lg-none">
            <button class="profile-aside-close-btn btn">
              
              <i class="ri-close-circle-line"></i>
            
            </button>
        </div>
        <div>
            <div>
                <div class="widget-title">
                    <a class="{{Request::is('user-account*')?'active-menu':''}}" href="{{route('user-account')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <g clip-path="url(#clip0_776_10768)">
                                <path d="M10 0.000488281C4.47773 0.000488281 0 4.47734 0 10C0 15.5228 4.47729 19.9996 10 19.9996C15.5231 19.9996 20 15.5228 20 10C20 4.47734 15.5231 0.000488281 10 0.000488281ZM10 2.99047C11.8273 2.99047 13.308 4.47163 13.308 6.29804C13.308 8.12488 11.8273 9.6056 10 9.6056C8.17359 9.6056 6.69288 8.12488 6.69288 6.29804C6.69288 4.47163 8.17359 2.99047 10 2.99047ZM9.9978 17.3852C8.17535 17.3852 6.50619 16.7215 5.21875 15.6229C4.90512 15.3554 4.72415 14.9632 4.72415 14.5516C4.72415 12.6992 6.22332 11.2168 8.07608 11.2168H11.9248C13.778 11.2168 15.2715 12.6992 15.2715 14.5516C15.2715 14.9636 15.0914 15.355 14.7773 15.6225C13.4903 16.7215 11.8207 17.3852 9.9978 17.3852Z" fill="currentColor"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_776_10768">
                                <rect width="20" height="20" fill="currentColor"/>
                                </clipPath>
                            </defs>
                        </svg>
                        <span>
                            {{translate('profile_info')}}
                        </span>
                    </a>
                </div>
            </div>

            <div class="widget-title">
                <a class="{{Request::is('account-oder*') || Request::is('account-order-details*') || Request::is('track-order*') ? 'active-menu' :''}}" href="{{route('account-oder') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.2917 2.49984V18.3332C17.2917 18.5648 17.1633 18.7773 16.9583 18.8857C16.7533 18.994 16.5058 18.9798 16.3142 18.849L14.235 17.4298L12.2692 18.8407C12.0333 19.0107 11.7117 18.9948 11.4933 18.8032L10 17.4973L8.50666 18.8032C8.28833 18.9948 7.96666 19.0107 7.73083 18.8407L5.765 17.4298L3.68583 18.849C3.49416 18.9798 3.24666 18.994 3.04166 18.8857C2.83666 18.7773 2.70833 18.5648 2.70833 18.3332V2.49984C2.70833 1.69484 3.36083 1.0415 4.16666 1.0415H15.8333C16.6392 1.0415 17.2917 1.69484 17.2917 2.49984ZM6.66666 8.95817H13.3333C13.6783 8.95817 13.9583 8.67817 13.9583 8.33317C13.9583 7.98817 13.6783 7.70817 13.3333 7.70817H6.66666C6.32166 7.70817 6.04166 7.98817 6.04166 8.33317C6.04166 8.67817 6.32166 8.95817 6.66666 8.95817ZM6.66666 5.62484H13.3333C13.6783 5.62484 13.9583 5.34484 13.9583 4.99984C13.9583 4.65484 13.6783 4.37484 13.3333 4.37484H6.66666C6.32166 4.37484 6.04166 4.65484 6.04166 4.99984C6.04166 5.34484 6.32166 5.62484 6.66666 5.62484ZM6.66666 12.2915H10C10.345 12.2915 10.625 12.0115 10.625 11.6665C10.625 11.3215 10.345 11.0415 10 11.0415H6.66666C6.32166 11.0415 6.04166 11.3215 6.04166 11.6665C6.04166 12.0115 6.32166 12.2915 6.66666 12.2915Z" fill="currentColor"/>
                    </svg>
                    <span>{{translate('my_order')}}</span>
                </a>
            </div>
        </div>

        <div>
            <div class="widget-title">
                <a class="{{Request::is('wishlists*')?'active-menu':''}}" href="{{route('wishlists')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <g clip-path="url(#clip0_776_10778)">
                        <path d="M10 20C15.5228 20 20 15.5228 20 10C20 4.47715 15.5228 0 10 0C4.47715 0 0 4.47715 0 10C0 15.5228 4.47715 20 10 20Z" fill="currentColor"/>
                        <path d="M15.3906 8.88909C15.243 9.72854 14.9023 10.4907 14.4418 11.2C13.8281 12.1457 13.0445 12.9297 12.1676 13.6293C11.6519 14.037 11.1127 14.414 10.5527 14.7582C10.2012 14.975 9.83984 14.9965 9.48711 14.7817C8.50508 14.1836 7.58594 13.5024 6.7707 12.6871C6.16992 12.086 5.65 11.4227 5.24414 10.6739C4.79883 9.85354 4.52539 8.97932 4.53125 8.03909C4.5375 7.06643 4.93281 6.27112 5.70625 5.67542C6.2832 5.23128 6.94336 5.03518 7.66797 5.07229C8.28008 5.10354 8.81602 5.35081 9.30039 5.70862C9.53125 5.87932 9.9832 6.28675 9.99063 6.29456C10.1859 6.12776 10.3723 5.95745 10.5707 5.80315C11.0215 5.45159 11.5141 5.18557 12.0875 5.10276C12.8895 4.98557 13.6191 5.18089 14.268 5.65823C14.8547 6.08251 15.2601 6.71219 15.4035 7.4219C15.5078 7.91018 15.475 8.4012 15.3906 8.88909Z" fill="white"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_776_10778">
                        <rect width="20" height="20" fill="white"/>
                        </clipPath>
                    </defs>
                    </svg>
                    <span>{{translate('wish_list')}}</span>
                </a>
            </div>
        </div>

        @if ($web_config['wallet_status'] == 1)
            <div>
                <div class="widget-title">
                    <a class="{{Request::is('wallet')?'active-menu':''}}" href="{{route('wallet') }}
                    ">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M19.3167 14V14.0008C19.3153 14.2625 19.2127 14.5136 19.0304 14.7014C18.8821 14.8541 18.6904 14.9554 18.4833 14.9928V16.8998V16.9H18.3333C18.3337 17.1255 18.2895 17.3489 18.2033 17.5573C18.1172 17.7658 17.9907 17.9551 17.8313 18.1146C17.6718 18.2741 17.4824 18.4005 17.274 18.4867C17.0656 18.5728 16.8422 18.617 16.6167 18.6167L19.3167 14ZM19.3167 14L19.3167 9.9L19.3167 9.89922C19.3153 9.63748 19.2127 9.38641 19.0304 9.19861C18.8821 9.04589 18.6904 8.94464 18.4833 8.90726L19.3167 14ZM2.55022 18.7667H16.6164L0.833328 16.9C0.833001 17.1255 0.877179 17.3489 0.963333 17.5573C1.04949 17.7658 1.17592 17.9551 1.3354 18.1146C1.49487 18.2741 1.68424 18.4005 1.89267 18.4867C2.10109 18.5728 2.32447 18.617 2.55 18.6167V18.7667H2.55022ZM0.68333 7.00012V16.8999L2.55 5.28334C2.32447 5.28301 2.10109 5.32719 1.89267 5.41334C1.68424 5.49949 1.49487 5.62593 1.3354 5.7854C1.17592 5.94488 1.04949 6.13425 0.963333 6.34267C0.877179 6.5511 0.833001 6.77447 0.833328 7H0.68333V7.00012ZM5.6226 2.54738L5.62265 2.5474L5.62408 2.54352C5.63688 2.50879 5.65676 2.4771 5.68247 2.45047C5.70788 2.42416 5.73842 2.40336 5.77219 2.38936C5.84366 2.36199 5.92271 2.36196 5.99419 2.38925L12.583 5.13334H11.341L6.43264 3.50001C6.4323 3.49989 6.43195 3.49977 6.4316 3.49964C6.29347 3.45186 6.1422 3.4593 6.0094 3.52043C5.87627 3.58171 5.77205 3.69219 5.71864 3.82868L5.71844 3.82921L5.21386 5.13334H4.58822L5.6226 2.54738ZM6.58096 4.74587L7.75227 5.13334H6.43399L6.58096 4.74587ZM17.35 16.8999C17.3498 17.0943 17.2725 17.2808 17.135 17.4183C16.9975 17.5558 16.811 17.6332 16.6165 17.6333H2.55014C2.35566 17.6332 2.16921 17.5558 2.0317 17.4183C1.89418 17.2808 1.81685 17.0943 1.81666 16.8999L1.81666 7.00052C1.81805 6.80633 1.89581 6.62048 2.03314 6.48315C2.17046 6.34583 2.35631 6.26807 2.55049 6.26667H16.6162C16.8104 6.26807 16.9962 6.34583 17.1335 6.48315C17.2709 6.62052 17.3487 6.80644 17.35 7.0007C17.35 7.0008 17.35 7.00089 17.35 7.00098L17.35 8.88334H13.75C12.9367 8.88334 12.1566 9.20643 11.5815 9.78154C11.0064 10.3567 10.6833 11.1367 10.6833 11.95C10.6833 12.7633 11.0064 13.5434 11.5815 14.1185C12.1566 14.6936 12.9367 15.0167 13.75 15.0167H17.35V16.8999ZM18.1833 13.8833H13.75C13.2372 13.8833 12.7455 13.6796 12.3829 13.3171C12.0204 12.9545 11.8167 12.4628 11.8167 11.95C11.8167 11.4373 12.0204 10.9455 12.3829 10.5829C12.7454 10.2205 13.2369 10.0168 13.7494 10.0167C13.7496 10.0167 13.7498 10.0167 13.75 10.0167L18.1833 10.0489V13.8833Z" fill="currentColor" stroke="currentColor" stroke-width="0.3"/>
                            <path d="M13.75 10.7002C13.5028 10.7002 13.2611 10.7735 13.0555 10.9109C12.85 11.0482 12.6898 11.2434 12.5952 11.4718C12.5005 11.7002 12.4758 11.9516 12.524 12.1941C12.5723 12.4365 12.6913 12.6593 12.8661 12.8341C13.0409 13.0089 13.2637 13.1279 13.5061 13.1762C13.7486 13.2244 13.9999 13.1997 14.2284 13.105C14.4568 13.0104 14.652 12.8502 14.7893 12.6447C14.9267 12.4391 15 12.1974 15 11.9502C15 11.6187 14.8683 11.3007 14.6339 11.0663C14.3995 10.8319 14.0815 10.7002 13.75 10.7002ZM13.75 12.3669C13.6676 12.3669 13.587 12.3424 13.5185 12.2966C13.45 12.2509 13.3966 12.1858 13.3651 12.1096C13.3335 12.0335 13.3253 11.9497 13.3413 11.8689C13.3574 11.7881 13.3971 11.7138 13.4554 11.6556C13.5136 11.5973 13.5879 11.5576 13.6687 11.5415C13.7495 11.5255 13.8333 11.5337 13.9095 11.5652C13.9856 11.5968 14.0507 11.6502 14.0964 11.7187C14.1422 11.7872 14.1667 11.8678 14.1667 11.9502C14.1667 12.0607 14.1228 12.1667 14.0446 12.2448C13.9665 12.323 13.8605 12.3669 13.75 12.3669Z" fill="currentColor"/>
                            <path d="M5.83333 8.19987C5.83333 8.31038 5.78943 8.41636 5.71129 8.4945C5.63315 8.57264 5.52717 8.61654 5.41666 8.61654H3.74999C3.63949 8.61654 3.53351 8.57264 3.45537 8.4945C3.37723 8.41636 3.33333 8.31038 3.33333 8.19987C3.33333 8.08936 3.37723 7.98338 3.45537 7.90524C3.53351 7.8271 3.63949 7.7832 3.74999 7.7832H5.41666C5.52717 7.7832 5.63315 7.8271 5.71129 7.90524C5.78943 7.98338 5.83333 8.08936 5.83333 8.19987Z" fill="currentColor"/>
                            <path d="M7.5 9.86686C7.5 9.97737 7.4561 10.0833 7.37796 10.1615C7.29982 10.2396 7.19384 10.2835 7.08333 10.2835H3.74999C3.63949 10.2835 3.53351 10.2396 3.45537 10.1615C3.37723 10.0833 3.33333 9.97737 3.33333 9.86686C3.33333 9.75636 3.37723 9.65037 3.45537 9.57223C3.53351 9.49409 3.63949 9.4502 3.74999 9.4502H7.08333C7.19384 9.4502 7.29982 9.49409 7.37796 9.57223C7.4561 9.65037 7.5 9.75636 7.5 9.86686Z" fill="currentColor"/>
                            </svg>
                    </span>
                    <span>
                        {{translate('my_wallet')}}
                    </span>

                    </a>
                </div>
            </div>
        @endif
        @if ($web_config['loyalty_point_status'] == 1)
            <div>
                <div class="widget-title">
                    <a class="{{Request::is('loyalty')?'active-menu':''}}" href="{{route('loyalty') }} ">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M8.975 15.1999L6.98333 18.6499C6.875 18.8415 6.66666 18.9665 6.44166 18.9665C6.41666 18.9665 6.38333 18.9665 6.35833 18.9665C6.10833 18.9332 5.9 18.7499 5.83333 18.5082L5.38333 16.8332L3.70833 17.2832C3.46666 17.3499 3.2 17.2582 3.05 17.0582C2.9 16.8582 2.87499 16.5832 3.00833 16.3665L4.80833 13.2499C5.05 13.3999 5.3 13.5332 5.55833 13.6249C6.06666 14.2665 6.75833 14.7582 7.55 15.0165C7.96666 15.1582 8.40833 15.2249 8.85 15.2249H8.96666L8.975 15.1999ZM15.1833 13.2332C14.95 13.3832 14.7 13.5082 14.4333 13.6082C13.9167 14.2582 13.225 14.7415 12.4333 14.9999C12.0167 15.1332 11.5833 15.2082 11.1333 15.2082C11.0917 15.2082 11.0583 15.2082 11.0167 15.2082L13.0083 18.6582C13.1167 18.8499 13.325 18.9749 13.55 18.9749H13.6333C13.8833 18.9415 14.0917 18.7582 14.1583 18.5165L14.6083 16.8415L16.2833 17.2915C16.525 17.3582 16.7833 17.2665 16.9417 17.0665C17.0917 16.8665 17.1167 16.5915 16.9833 16.3749L15.1833 13.2582V13.2332ZM16.6417 7.49987C16.6417 8.2082 16.3833 8.89987 15.9167 9.4332C15.975 10.1582 15.775 10.8415 15.3667 11.3999C14.95 11.9749 14.3417 12.3749 13.6583 12.5332C13.2917 13.1332 12.725 13.5915 12.05 13.8082C11.75 13.9082 11.45 13.9499 11.1417 13.9499C10.75 13.9499 10.3667 13.8749 10 13.7249C9.35 13.9999 8.61666 14.0249 7.95 13.8082C7.27499 13.5915 6.70833 13.1332 6.34166 12.5415C5.675 12.3915 5.05 11.9832 4.63333 11.3999C4.21666 10.8249 4.02499 10.1249 4.07499 9.42487C3.62499 8.89987 3.35833 8.2082 3.35833 7.49987C3.35833 6.79154 3.61666 6.09987 4.08333 5.56654C4.025 4.84154 4.225 4.1582 4.63333 3.59987C5.05 3.02487 5.65833 2.62487 6.34166 2.46654C6.70833 1.86654 7.27499 1.4082 7.95 1.19154C8.625 0.974869 9.35833 1.0082 10 1.27487C10.65 1.0082 11.3833 0.974869 12.05 1.19154C12.725 1.4082 13.2917 1.86654 13.6583 2.4582C14.325 2.6082 14.95 3.01654 15.3667 3.59987C15.7833 4.17487 15.975 4.87487 15.925 5.57487C16.375 6.09987 16.6417 6.79154 16.6417 7.49987ZM12.2583 6.9332C12.1833 6.7082 11.9917 6.54154 11.75 6.5082L10.925 6.39154L10.5583 5.64154C10.35 5.21654 9.64999 5.21654 9.43333 5.64154L9.06666 6.39154L8.24166 6.5082C8.00833 6.54154 7.80833 6.7082 7.73333 6.9332C7.65833 7.1582 7.725 7.4082 7.89166 7.57487L8.49166 8.1582L8.35 8.9832C8.30833 9.21654 8.40833 9.4582 8.59999 9.59154C8.79166 9.7332 9.04999 9.74987 9.25833 9.64154L10 9.24987L10.7417 9.64154C10.8333 9.69154 10.9333 9.71654 11.0333 9.71654C11.1667 9.71654 11.2917 9.67487 11.4 9.59987C11.5917 9.4582 11.6917 9.22487 11.65 8.99154L11.5083 8.16654L12.1083 7.5832C12.275 7.41654 12.3417 7.16654 12.2667 6.94154L12.2583 6.9332Z" fill="currentColor"/>
                                </svg>
                            </span>
                        <span>
                            {{translate('my_loyalty_point')}}
                        </span>

                    </a>
                </div>
            </div>
        @endif

        {{--to do--}}
        @php($business_mode=\App\CPU\Helpers::get_business_settings('business_mode'))
        @if ($business_mode == 'multi')
            <div>
                <div class="widget-title">
                    <a class="{{Request::is('chat/seller')?'active-menu': '' }} {{Request::is('chat/delivery-man')?'active-menu': '' }}" href="{{route('chat', ['type' => 'seller'])}}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <g clip-path="url(#clip0_776_10801)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0032 0.00341797C15.526 0.00341797 20.0032 4.47947 20.0032 10.0048C20.0032 15.5273 15.526 20.0034 10.0032 20.0034C4.48041 20.0034 0.00326538 15.5275 0.00326538 10.0048C0.00326538 4.47947 4.48069 0.00341797 10.0032 0.00341797ZM3.75323 13.7922L8.25713 9.92588L3.75514 6.06123C3.75389 6.07194 3.75324 6.08271 3.75319 6.0935L3.75323 13.7922ZM8.67315 10.2831L4.12803 14.185H15.8787L11.3332 10.2831L10.1794 11.2736C10.1299 11.3159 10.0668 11.339 10.0017 11.3386C9.93653 11.3382 9.8737 11.3144 9.82467 11.2715L8.67315 10.2831ZM11.7494 9.92588L16.2533 13.7922V6.0935C16.2534 6.08271 16.2527 6.07192 16.2512 6.06123L11.7494 9.92596L11.7494 9.92588ZM4.30834 5.82178L10.0032 10.7105L15.698 5.82178H4.30834Z" fill="currentColor"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_776_10801">
                                <rect width="20" height="20" fill="white"/>
                                </clipPath>
                            </defs>
                            </svg>
                        </span>
                        <span>{{translate('inbox')}}</span>
                    </a>
                </div>
            </div>
        @endif

        <div>
            <div class="widget-title">
                <a class="{{Request::is('account-address*')?'active-menu':''}}"
                    href="{{ route('account-address') }}">
                    <span>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1.25C6.90062 1.25 4.375 3.835 4.375 7.03125C4.375 8.74875 5.20937 10.5719 6.2375 12.1325C7.72125 14.3856 9.5775 16.085 9.5775 16.085C9.81688 16.3044 10.1831 16.3044 10.4225 16.085C10.4225 16.085 12.2788 14.3856 13.7625 12.1325C14.7906 10.5719 15.625 8.74875 15.625 7.03125C15.625 3.835 13.0994 1.25 10 1.25ZM10 3.75C11.7244 3.75 13.125 5.15062 13.125 6.875C13.125 8.59938 11.7244 10 10 10C8.27562 10 6.875 8.59938 6.875 6.875C6.875 5.15062 8.27562 3.75 10 3.75ZM10 5C8.965 5 8.125 5.84 8.125 6.875C8.125 7.91 8.965 8.75 10 8.75C11.035 8.75 11.875 7.91 11.875 6.875C11.875 5.84 11.035 5 10 5ZM6.21562 13.5631C6.17437 13.5656 6.13313 13.5731 6.09125 13.5837C5.065 13.8537 4.26375 14.2344 3.78062 14.6569C3.33562 15.0475 3.125 15.4919 3.125 15.9375C3.125 16.4719 3.44 17.0156 4.09938 17.4612C5.20625 18.2081 7.43062 18.75 10 18.75C12.5694 18.75 14.7937 18.2081 15.9006 17.4606C16.56 17.0156 16.875 16.4719 16.875 15.9375C16.875 15.4919 16.6644 15.0475 16.2194 14.6569C15.7363 14.2344 14.935 13.8537 13.9087 13.5837C13.5756 13.4956 13.2331 13.695 13.1456 14.0294C13.0575 14.3631 13.2575 14.705 13.5913 14.7925C14.2675 14.9712 14.8275 15.1944 15.2163 15.46C15.4431 15.6163 15.625 15.7512 15.625 15.9375C15.625 16.0319 15.5594 16.1125 15.4788 16.1975C15.3156 16.3688 15.0731 16.5225 14.7744 16.665C13.6975 17.1794 11.9581 17.5 10 17.5C8.04188 17.5 6.3025 17.1794 5.22563 16.665C4.92688 16.5225 4.68438 16.3688 4.52125 16.1975C4.44063 16.1125 4.375 16.0319 4.375 15.9375C4.375 15.7512 4.55687 15.6163 4.78375 15.46C5.1725 15.1944 5.7325 14.9712 6.40875 14.7925C6.7425 14.705 6.9425 14.3631 6.85438 14.0294C6.7775 13.7369 6.50562 13.5469 6.21562 13.5631Z" fill="currentColor"/>
                        </svg>
                    </span>
                    <span>
                        {{translate('address')}}
                    </span>
                </a>
            </div>
        </div>
        <div>
            <div class="widget-title">
                <a class="{{(Request::is('account-ticket*') || Request::is('support-ticket*'))?'active-menu':''}}"
                    href="{{ route('account-tickets') }}">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.2276 2.69576C8.80626 2.64842 7.37026 3.0362 6.13048 3.86376C4.73803 4.7942 3.76492 6.1682 3.3167 7.7042C3.19292 7.68909 3.0447 7.69576 2.8687 7.74553C2.21159 7.93198 1.71737 8.47042 1.49515 8.94464C1.20692 9.56264 1.08537 10.38 1.21359 11.2238C1.34092 12.0649 1.69626 12.7582 2.1407 13.1886C2.58648 13.6193 3.08981 13.7593 3.58981 13.6542C4.33426 13.4953 4.70337 13.3764 4.59915 12.6829L4.09448 9.32087C4.19626 7.50131 5.13826 5.78842 6.71381 4.73509C8.8227 3.32642 11.5876 3.41664 13.5991 4.96087C14.9985 6.03376 15.8109 7.64131 15.9047 9.32887L15.5518 11.6806C14.7647 13.8346 12.8134 15.3266 10.5554 15.5384H9.05181C8.66381 15.5384 8.35137 15.8509 8.35137 16.2384V16.6078C8.35137 16.9955 8.66381 17.308 9.05181 17.308H10.9476C11.3354 17.308 11.6465 16.9955 11.6465 16.6078V16.4146C13.3491 15.9991 14.8354 14.9526 15.8031 13.4933L16.4105 13.6544C16.9047 13.7826 17.414 13.6193 17.8596 13.1889C18.304 12.7582 18.6591 12.0651 18.7867 11.224C18.9154 10.3802 18.7903 9.5642 18.5054 8.94487C18.2194 8.32553 17.7934 7.9322 17.3016 7.79109C17.0956 7.73176 16.872 7.70998 16.6803 7.7042C16.2749 6.31531 15.4405 5.0522 14.2378 4.12998C13.0554 3.22264 11.6489 2.74242 10.2276 2.69576Z" fill="currentColor"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.4465 8.74397C12.9476 8.74397 13.3538 9.1502 13.3549 9.65264C13.3538 10.1538 12.9476 10.5611 12.4465 10.5611C11.944 10.5611 11.5367 10.1538 11.5367 9.65264C11.5367 9.15042 11.9443 8.74397 12.4465 8.74397ZM9.99982 8.74397C10.502 8.74397 10.9083 9.1502 10.9083 9.65264C10.9083 10.1538 10.502 10.5611 9.99982 10.5611C9.49715 10.5611 9.09093 10.1538 9.09093 9.65264C9.09093 9.15042 9.49715 8.74397 9.99982 8.74397ZM7.55404 8.74397C8.05515 8.74397 8.46249 9.1502 8.46249 9.65264C8.46249 10.1538 8.05515 10.5611 7.55404 10.5611C7.05182 10.5611 6.64537 10.1538 6.64537 9.65264C6.64537 9.15042 7.05182 8.74397 7.55404 8.74397ZM9.99982 4.84131C7.33537 4.84131 5.18826 6.91775 5.18826 9.65264C5.18826 10.9662 5.68493 12.1271 6.49404 12.9789L6.20693 14.266C6.11226 14.6895 6.40604 14.9744 6.78671 14.7624L8.0436 14.0613C8.64093 14.3206 9.3016 14.464 9.99982 14.464C12.6652 14.464 14.8109 12.3889 14.8109 9.65264C14.8109 6.91775 12.6652 4.84131 9.99982 4.84131Z" fill="currentColor"/>
                        </svg>
                    </span>
                    <span>
                        {{translate('support_ticket')}}
                    </span>
                </a>
            </div>
        </div>

        @if ($web_config['ref_earning_status'])
        <div>
            <div class="widget-title">
                <a class="{{(Request::is('refer-earn*') || Request::is('refer-earn*'))?'active-menu':''}}"
                    href="{{ route('refer-earn') }}">
                    <span>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.543 13.2852C18.0118 12.582 16.9532 12.4688 16.2813 13.0898L14.6485 12.1602C14.9337 11.5352 15.0977 10.8164 15.0977 10C15.0977 9.22656 14.9219 8.49219 14.6133 7.83203L16.2774 6.90234C16.9337 7.50781 17.9844 7.43359 18.5469 6.69922C18.9258 6.19531 18.9571 5.52734 18.6524 5C18.3282 4.35156 17.3438 3.97266 16.5509 4.4375C15.9532 4.78125 15.6758 5.46484 15.8165 6.10547L14.1446 7.03516C13.3008 5.85938 11.9727 5.05469 10.461 4.91797V3.01172C11.086 2.81641 11.5391 2.23438 11.5391 1.54297V1.53516C11.5391 0.707031 10.8438 0 10.0001 0C9.14851 0 8.46101 0.691406 8.46101 1.53906C8.46101 2.17188 8.85944 2.78125 9.53913 3.00781V4.91406C7.9571 5.05078 6.63288 5.88672 5.80866 7.07812L4.17976 6.10156C4.40632 5.08203 3.53132 4.33984 3.25007 4.33984C2.54694 4.05469 1.73054 4.32422 1.34382 4.99609C0.949287 5.67969 1.12116 6.62109 1.90632 7.09766C2.50397 7.44141 3.23444 7.33984 3.71882 6.89844L5.35554 7.87891C5.06257 8.53125 4.89851 9.24609 4.89851 9.99219C4.89851 10.793 5.06257 11.5195 5.35163 12.1563L3.71882 13.0859C3.21882 12.6289 2.48835 12.5547 1.91022 12.8867C1.19147 13.3008 0.918037 14.2227 1.34382 14.9883V14.9922C1.81257 15.7734 2.75397 15.957 3.44538 15.5547C4.01569 15.2305 4.32429 14.5508 4.17976 13.8867L5.80866 12.957C6.67976 14.1875 8.07038 14.9414 9.53522 15.0703V16.9766C8.91022 17.1719 8.4571 17.7539 8.4571 18.4453C8.4571 19.207 9.03522 19.8867 9.82429 19.9727C10.4571 20.0977 11.3321 19.6172 11.504 18.7539C11.6407 18.0703 11.2891 17.2383 10.4571 16.9727V15.0664C11.8204 14.9336 13.2735 14.2188 14.1837 12.9492L15.8126 13.8789C15.6954 14.4023 15.8594 14.957 16.2735 15.3477C17.3633 16.2852 18.8243 15.4805 18.8555 14.2578C18.8712 13.9141 18.7579 13.5664 18.543 13.2852ZM10.1016 10.6016C9.46491 10.6016 8.94929 10.0859 8.94929 9.44922V8.23438H11.2579V9.44922C11.2579 10.0859 10.7383 10.6016 10.1016 10.6016ZM13.2735 13.4883V12.4063C13.2735 11.2852 12.4102 10.3594 11.3126 10.2656C11.4727 10.0312 11.5626 9.75 11.5626 9.44922V8.125L12.4532 6.71094C12.4844 6.66406 12.4844 6.60547 12.4571 6.55469C12.4298 6.50391 12.379 6.47656 12.3243 6.47656H9.40632C8.98444 6.47656 8.63679 6.82031 8.63679 7.24609V9.44922C8.63679 9.74609 8.72663 10.0234 8.88288 10.2578H8.86726C7.68366 10.2578 6.71882 11.2227 6.71882 12.4102V13.4922C5.78522 12.6172 5.19929 11.375 5.19929 10C5.19929 7.35547 7.34772 5.20703 9.99226 5.20703C12.6329 5.20703 14.7852 7.35547 14.7852 10C14.793 11.375 14.2071 12.6133 13.2735 13.4883Z" fill="currentColor"/>
                        </svg>
                    </span>
                    <span>
                        {{ translate('refer_&_earn') }}
                    </span>
                </a>
            </div>
        </div>
        @endif

        <div>
            <div class="widget-title">
                <a class="{{(Request::is('/user-coupons') || Request::is('user-coupons*'))?'active-menu':''}}"
                    href="{{ route('user-coupons') }}">
                    <span>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.638021 8.59932C0.639271 8.92557 0.891771 9.19619 1.21677 9.21994C1.38115 9.23244 1.54177 9.30182 1.6674 9.42744C1.94302 9.70244 1.94802 10.1481 1.67427 10.4212C1.55115 10.5443 1.39302 10.6112 1.23177 10.6218C0.902396 10.6437 0.647396 10.9181 0.648021 11.2474L0.656771 13.7856C0.660521 14.8199 1.50115 15.6556 2.53552 15.6537C5.74865 15.6481 14.2811 15.6331 17.4986 15.6274C17.9968 15.6262 18.4736 15.4274 18.8249 15.0743C19.1761 14.7218 19.3724 14.2437 19.3705 13.7456L19.3618 11.2118C19.3605 10.8856 19.1086 10.6149 18.783 10.5912C18.6193 10.5787 18.4586 10.5093 18.333 10.3837C18.0574 10.1087 18.0524 9.66307 18.3255 9.38994C18.4486 9.26682 18.6068 9.19994 18.7686 9.18932C19.098 9.16744 19.353 8.89307 19.3518 8.56369C19.3518 8.56369 19.3468 7.27307 19.343 6.24494C19.3393 5.21119 18.4986 4.37557 17.4649 4.37744C14.2518 4.38307 5.7199 4.39807 2.50115 4.40369C2.00302 4.40494 1.52615 4.60369 1.1749 4.95682C0.824271 5.30994 0.628021 5.78807 0.629896 6.28619C0.633646 7.31307 0.638021 8.59932 0.638021 8.59932ZM5.6249 5.64807L2.50365 5.65369C2.3374 5.65432 2.17865 5.72057 2.06115 5.83807C1.94427 5.95557 1.87927 6.11494 1.8799 6.28119L1.88677 8.10619C2.12865 8.20182 2.35552 8.34744 2.55115 8.54369C3.31615 9.30869 3.3174 10.5462 2.55802 11.3049C2.3649 11.4987 2.1399 11.6431 1.8999 11.7374L1.90677 13.7812C1.90802 14.1256 2.18865 14.4043 2.53302 14.4037L5.62677 14.3981C5.62677 14.3899 5.62615 14.3812 5.62615 14.3731L5.6249 5.64807ZM10.688 12.0762L14.1811 8.58432C14.4249 8.33994 14.4249 7.94432 14.1811 7.69994C13.9374 7.45619 13.5411 7.45619 13.2974 7.69994L9.80427 11.1924C9.5599 11.4362 9.5599 11.8324 9.80365 12.0762C10.048 12.3199 10.4436 12.3199 10.688 12.0762ZM13.9061 10.6249C14.3374 10.6249 14.6874 10.9749 14.6874 11.4062C14.6874 11.8374 14.3374 12.1874 13.9061 12.1874C13.4749 12.1874 13.1249 11.8374 13.1249 11.4062C13.1249 10.9749 13.4749 10.6249 13.9061 10.6249ZM10.1561 7.49994C10.5874 7.49994 10.9374 7.84994 10.9374 8.28119C10.9374 8.71244 10.5874 9.06244 10.1561 9.06244C9.7249 9.06244 9.3749 8.71244 9.3749 8.28119C9.3749 7.84994 9.7249 7.49994 10.1561 7.49994Z" fill="currentColor"/>
                        </svg>
                    </span>
                    <span>{{translate('coupons')}}</span>
                </a>
            </div>
        </div>

        <div>
            <div class="widget-title">
                <a class="" href="{{route('track-order.index') }}">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M4.96896 16.4421C4.2419 16.4421 3.65039 15.8507 3.65039 15.1236C3.65039 14.3965 4.2419 13.8051 4.96896 13.8051H10.0151C11.3237 13.8051 12.3884 12.7404 12.3884 11.4318C12.3884 10.1232 11.3237 9.05859 10.0151 9.05859H6.45639V10.1133H10.0151C10.7422 10.1133 11.3337 10.7048 11.3337 11.4319C11.3337 12.1589 10.7422 12.7504 10.0151 12.7504H4.96896C3.66034 12.7504 2.5957 13.815 2.5957 15.1236C2.5957 16.4322 3.66034 17.4968 4.96896 17.4968H13.5441V16.4421H4.96896Z" fill="currentColor"/>
                            <path d="M5.8857 4.04139C4.76801 2.9237 2.95592 2.9237 1.83827 4.04139C0.720578 5.15908 0.720578 6.97117 1.83827 8.08883L3.862 10.1126L5.8857 8.08883C7.00339 6.97114 7.00339 5.15904 5.8857 4.04139ZM3.84506 6.9311C3.35396 6.9311 2.95585 6.53299 2.95585 6.04189C2.95585 5.55079 3.35396 5.15265 3.84506 5.15265C4.33615 5.15265 4.7343 5.55076 4.7343 6.04189C4.7343 6.53299 4.33619 6.9311 3.84506 6.9311Z" fill="currentColor"/>
                            <path d="M18.1621 11.4242C17.0444 10.3065 15.2323 10.3065 14.1146 11.4242C12.9969 12.5419 12.9969 14.354 14.1146 15.4716L16.1384 17.4954L18.1621 15.4716C19.2798 14.354 19.2798 12.5419 18.1621 11.4242ZM16.1214 14.3139C15.6303 14.3139 15.2322 13.9158 15.2322 13.4247C15.2322 12.9336 15.6303 12.5355 16.1214 12.5355C16.6125 12.5355 17.0107 12.9336 17.0107 13.4247C17.0107 13.9158 16.6126 14.3139 16.1214 14.3139Z" fill="currentColor"/>
                        </svg>
                    </span>
                    <span>{{translate('track_order')}}</span>
                </a>
            </div>
        </div>

        <div class="d-lg-none">
            <div class="widget-title">
                <a class="d-flex align-items-center gap-2" href="javascript:" onclick="delete_account('{{ route('account-delete',[auth('customer')->id()]) }}','{{translate('want_to_delete_this_account')}}?')">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.26053 3.00537C7.26056 2.88415 7.30871 2.76789 7.39441 2.68215C7.48011 2.59641 7.59634 2.54819 7.71757 2.54811L12.2877 2.54785C12.4089 2.54813 12.5251 2.59648 12.6108 2.68229C12.6965 2.7681 12.7446 2.88438 12.7447 3.00563V4.13591H7.26053V3.00537ZM14.7747 18.3723C14.763 18.5506 14.6837 18.7176 14.5529 18.8392C14.4222 18.9609 14.2498 19.0279 14.0712 19.0267H5.88149C5.70294 19.0262 5.53119 18.9582 5.40071 18.8363C5.27024 18.7144 5.19071 18.5477 5.1781 18.3696L4.47728 8.11776H15.5227L14.7749 18.3722L14.7747 18.3723ZM16.5954 7.18926H3.41016V6.12712C3.41035 5.84542 3.52233 5.57531 3.7215 5.3761C3.92067 5.17689 4.19075 5.06486 4.47245 5.0646L15.533 5.06425C15.8146 5.06468 16.0846 5.17681 16.2838 5.37605C16.4829 5.57528 16.5948 5.84535 16.5951 6.12703V7.18916L16.5954 7.18926ZM7.87976 16.5828C7.87976 16.6437 7.89176 16.7041 7.91509 16.7604C7.93842 16.8167 7.97261 16.8679 8.01571 16.911C8.05882 16.9541 8.10999 16.9883 8.1663 17.0116C8.22262 17.0349 8.28298 17.0469 8.34394 17.0469C8.4049 17.0469 8.46526 17.0349 8.52158 17.0116C8.57789 16.9883 8.62907 16.9541 8.67217 16.911C8.71527 16.8679 8.74946 16.8167 8.77279 16.7604C8.79612 16.7041 8.80813 16.6437 8.80813 16.5828V10.0732C8.80715 9.95083 8.75785 9.83375 8.67095 9.74752C8.58405 9.66128 8.4666 9.61287 8.34418 9.61283C8.22176 9.61279 8.10427 9.66112 8.01732 9.74729C7.93036 9.83347 7.88098 9.95051 7.87992 10.0729V16.5828H7.87976ZM11.1917 16.5828C11.1917 16.7059 11.2406 16.824 11.3277 16.911C11.4147 16.9981 11.5328 17.047 11.6559 17.047C11.7791 17.047 11.8972 16.9981 11.9842 16.911C12.0713 16.824 12.1202 16.7059 12.1202 16.5828V10.0732C12.1192 9.95081 12.0699 9.83372 11.983 9.74747C11.8961 9.66122 11.7786 9.61281 11.6562 9.61277C11.5337 9.61272 11.4162 9.66106 11.3293 9.74725C11.2423 9.83343 11.1929 9.95049 11.1919 10.0729L11.1917 16.5828Z" fill="#F62A2E"/>
                        </svg>
                    </span>
                    <span class="text-capitalize">{{translate('delete_account')}}</span>
                </a>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        function delete_account (route, message){
            $('#shop-sidebar').removeClass('active');
            $('.profile-aside-overlay ').removeClass('active');
            route_alert(route, message)
        }
    </script>
@endpush












