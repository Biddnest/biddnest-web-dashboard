<div class="modal-header pb-0 pt-0">
    <h3 class=" p-2 f-18"> Sliders and Banners</h3>
    <button type="button" class="close theme-text mt-2 pt-3" data-dismiss="modal" aria-label="Close" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
        <i class="fa fa-times theme-text" aria-hidden="true"></i>
    </button>
</div>
<div class="modal-body">
    <div class="row d-flex  pb-4 pl-3 ">
        <!-- <div class="col-lg-12">
            <div class="profile-section span3">
                <div class="d-flex justify-content-center">
                    <img class="p-2" onclick="$('.slick-container_{{$sliders->id}}').slick('slickPrev')" src="{{asset('static/images/Backward.svg')}}">
                    <div class="slick-container slick-container_{{$sliders->id}}">
                        @foreach($sliders->banners as $banner)
                            <img class="slick-image" src="{{$banner->image}}" alt="">
                        @endforeach
                    </div>
                    <img class="p-2" onclick="$('.slick-container_{{$sliders->id}}').slick('slickNext')" src="{{asset('static/images/forward.svg')}}">
                </div>
            </div>
        </div> -->

        
        <div class="col-lg-12  pl-0 ">
            <div class="profile-section">
                <div class="profile-details-side-pop">
                    <ul class="">
                        <li>
                            <h1>{{$sliders->name}}</h1>
                            <a href="{{route('edit-slider', ['id'=>$sliders->id])}}"><i class="icon dripicons-pencil pr-1 mr-1 " style="color: #3BA3FB;" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <h2> <span>
                                {{date('d M y', strtotime($sliders->from_date))}} To {{date('d M y', strtotime($sliders->to_date))}}
                                </span></h2>
                            <label class="switch mb-0" style="transform: scale(0.7);">
                                <input type="checkbox" id="switch" {{($sliders->status == \App\Enums\CommonEnums::$YES) ? 'checked' : ''}}  class="change_status cursor-pointer mt-2" data-url="{{route('slider_status_update',['id'=>$sliders->id])}}">
                                <span class="slider"></span>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex  pb-4 pl-3">
        <div class="col-lg-6 align-items-center">
            <h1 class="side-popup-heading">Slider Type:</h1>
        </div>
        <div class="col-lg-6 d-flex justify-content-between align-items-center">
            <h1 class="side-popup-content">
                @switch($sliders->type)
                    @case(\App\Enums\SliderEnum::$TYPE['promo'])
                        Promo
                    @break;

                    @case(\App\Enums\SliderEnum::$TYPE['info'])
                        Info
                    @break;
                @endswitch
            </h1>
        </div>
    </div>
    <div class="row d-flex pb-4 pl-3">
        <div class="col-lg-6 align-items-center">
            <h1 class="side-popup-heading">Position</h1>
        </div>
        <div class="col-lg-6 d-flex justify-content-between align-items-center">
            <h1 class="side-popup-content">
                @switch($sliders->position)
                    @case(\App\Enums\SliderEnum::$POSITION['main'])
                        Main
                    @break;

                    @case(\App\Enums\SliderEnum::$POSITION['secondary'])
                        Secondary
                    @break;
                @endswitch
            </h1>
        </div>
    </div>
    <div class="row d-flex pb-4 pl-3">
        <div class="col-lg-6 align-items-center">
            <h1 class="side-popup-heading">Platform</h1>
        </div>
        <div class="col-lg-6 d-flex justify-content-between align-items-center">
            <h1 class="side-popup-content">
                @switch($sliders->platform)
                    @case(\App\Enums\SliderEnum::$PLATFORM['web'])
                        Web
                    @break;

                    @case(\App\Enums\SliderEnum::$PLATFORM['app'])
                        App
                    @break;
                @endswitch
            </h1>
        </div>
    </div>
    <div class="row d-flex pb-4 pl-3">
        <div class="col-lg-6 align-items-center">
            <h1 class="side-popup-heading">size</h1>
        </div>
        <div class="col-lg-6 d-flex justify-content-between align-items-center">
            <h1 class="side-popup-content">
                @switch($sliders->size)
                    @case(\App\Enums\SliderEnum::$SIZE['wide'])
                        Wid
                    @break;

                    @case(\App\Enums\SliderEnum::$SIZE['square'])
                        Square
                    @break;
                @endswitch
            </h1>
        </div>
    </div>

    <div class="d-flex justify-content-center p-20">
                        <!-- <div class="">
                            <a class="white-text p-10" href="#">
                                <button class="btn theme-bg white-text my-0" style="width: 127px;
                                border-radius: 6px;">View More</button>
                            </a>
                        </div> -->
    </div>
</div>
