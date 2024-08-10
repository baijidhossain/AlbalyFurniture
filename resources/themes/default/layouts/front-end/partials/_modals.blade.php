@if($web_config['popup_banner'])
    <div class="modal fade" id="popup-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0 p-0">
                    <button type="button" class="close __close" data-bs-dismiss="modal" aria-label="Close">
                      
                    </button>
                </div>
                <div class="modal-body cursor-pointer __p-3px" onclick="location.href='{{$web_config['popup_banner']['url']}}'">
                    <img class="d-block w-100"
                         onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                         src="{{asset('storage/app/public/banner')}}/{{$web_config['popup_banner']['photo']}}"
                         alt="">
                </div>
            </div>
        </div>
    </div>
@endif
