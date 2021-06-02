@extends('website.homelayouts.app')
@section('title') Home @endsection
@section('content')
<div class="content-wrapper" data-barba="container" data-barba-namespace="home">
    <div class="d-flex center">
        <div class="container container-top p-50 top-header-card border-top-cards">
            <form action="{{route('add-booking')}}" class="no-ajax">
            <div class="top-cards mt-2">
                <div class="col-lg-4 col-xs-12 d-flex space-between pl-2">
                @foreach($categories as $category)
                    <label class="mr-1">
                        <input type="radio" name="category" class="card-input-element" />
                        <div class="card-header card-methord  bg-turnblue  building-type" style="width: 100%;">
                            <div class="card-body-top">
                                <img class="icon-cards" src="{{$category->image}}" />
                                <p class="building-type-text">{{ucwords($category->name)}}</p>
                            </div>
                        </div>
                    </label>
                    @endforeach

                </div>
            </div>

            <div class="row ml-22 mr-16 mb-2 mt-1 box-item">
                <div class="card top-header-card col-md-4 col-xs-12 pl-8" style="cursor: auto;">
                    <div class="card-body" data-toggle="modal" data-target="#from_location" style="cursor: auto;">
                        <p style="font-size: 13px;">FROM</p>
                        <input class="input-overwrite text-heading book-address mb-0 source" style="cursor: auto;" type="text" placeholder="SMR Apartments " readonly>
                        <input class="input-overwrite small-heading text-heading book-address mb-1 mt-0 source_city" style="cursor: auto;" type="text" placeholder="Mahadevapura, Bangalore" readonly>
                        <input  type="hidden" id="source-lat" name="source_lat" readonly>
                        <input  type="hidden" id="source-lng" name="source_lng" readonly>
                    </div>
                </div>
                <div class="card top-header-card col-md-4 col-xs-12 pl-8" style="cursor: auto;">
                    <div class="card-body" data-toggle="modal" data-target="#to_location" style="cursor: auto;">
                        <p style="font-size: 13px;">TO</p>
                        <input class="input-overwrite text-heading book-address mb-0 destination" style="cursor: auto;" type="text" name="destination" placeholder="Majestic Villas" readonly>
                        <input class="input-overwrite small-heading text-heading book-address mb-1 mt-0" style="cursor: auto;" type="text" placeholder="Gandhinagar, Chennai" readonly>
                        <input  type="hidden" id="dest-lat" name="dest_lat" readonly>
                        <input  type="hidden" id="dest-lng" name="dest_lng" readonly>
                    </div>
                </div>
                <i class="bg-white icon arrow dripicons-chevron-right"></i>

                <div class="card top-header-card col-md-4 col-xs-12">
                    <div class="card-body d-flex justify-content-between h-100">
                        <div>
                            <p style="font-size: 13px;">DATE OF MOVEMENT</p>
                            <input id="dp1" class="input-overwrite bookdate" type="text" name="move_date" placeholder="23 March 21" readonly/>
                        </div>
                        <div class="form-group  mr-1">
                            <button id="dateselect bookdate" class="btn btn-theme-w-bg mt-2 p-choose date" type="button"><i class="fa fa-calendar "></i>Choose
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div style="text-align: center;">
                @if(\Illuminate\Support\Facades\Session::get('account'))
                <a href="#" class="page-scroll btn btn-xl mar-top" style="position: relative!important; right: 0px!important; left: 0px!important;">
                        <button type="submit" class="btn btn-primary view-btn ">Book Now</button>
                </a>

                @else
                <a data-toggle="modal" data-target="#Login-modal" class="page-scroll btn btn-xl" style="position: relative!important; right: 0px!important; left: 0px!important;">
                    <button type="button" class="btn btn-primary view-btn">Book Now</button>
                </a>
                @endif
            </div>
            </form>
        </div>
    </div>
    <!-- section how it works -->
    <section id="how-work" class="how-work mb-5">
        <div class="container">
            <div class="row">
                <div class="card marg-head">
                    <div class="col-lg-12 col-xs-12 mt-1 text-center mb-4 marg-head">
                        <h2 class="section-heading bold" style="font-size: 30px !important;">How does it work?</h2>
                        <p class="section-subheading text-muted" style="font-size:22px !important">
                        With you in every step of the way
                        </p>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-4">
                    <div class="quote  mb-view bg-white quote-container-1">
                        <p class="card-num">1</p>

                        <img class="w-150" src="{{ asset('static/website/images/images/gifs/1.gif')}}" alt="some-picture" />

                        <h5 class="d-flex center theme-text how-work-step" style="font-size: 15px !important;">Step 1</h5>
                        <h3 class="d-flex center theme-text how-work-title">
                            Select Destination
                        </h3>
                        <p class="center mt-2 text-center">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum accusantium minus, sapiente earum quaerat repellat?
                        </p>
                    </div>
                </div>
                <div class="col-md-4 mt-30">
                    <div class="quote mb-view bg-white quote-container-2">
                        <p class="card-num">2</p>

                        <img class="w-150" src="{{ asset('static/website/images/images/gifs/2.gif')}}" alt="some-picture" />
                        <h5 class="d-flex center theme-text how-work-step">Step 2</h5>
                        <h3 class="d-flex center theme-text how-work-title">
                            Share Requirements
                        </h3>
                        <p class="center mt-2 text-center">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum accusantium minus, sapiente earum quaerat repellat?
                        </p>
                    </div>
                </div>
                <div class="col-md-4 mt-30">
                    <div class="quote mb-view bg-white quote-container-3">
                        <p class="card-num">3</p>

                        <img class="w-150" src="{{ asset('static/website/images/images/gifs/3.gif')}}" alt="some-picture" />
                        <h5 class="d-flex center theme-text how-work-step">Step 3</h5>

                        <h3 class="d-flex center theme-text how-work-title">
                            Choose Best Price
                        </h3>
                        <p class="center mt-2 text-center">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum accusantium minus, sapiente earum quaerat repellat?
                        </p>
                    </div>
                </div>
            </div>
            <div class="row center mt-2 mb-4 text-center">
                <div class="col-lg-4 col-xs-12 ml-md-auto ">
                    <div class="quote mb-view bg-white quote-container-4">
                        <p class="card-num">4</p>

                        <img class="w-150" src="{{ asset('static/website/images/images/gifs/4.gif')}}" alt="some-picture" />
                        <h5 class="d-flex center theme-text how-work-step">Step 4</h5>
                        <h3 class="d-flex center theme-text how-work-title">
                            Schedule & Confirm
                        </h3>
                        <p class="center mt-2 text-center">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum accusantium minus, sapiente earum quaerat repellat?
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-12 ml-md-auto mt-20">
                    <div class="quote mb-view bg-white quote-container-5">
                        <p class="card-num">5</p>

                        <img class="w-150" src="{{ asset('static/website/images/images/gifs/truck.gif')}}" alt="some-picture" />
                        <h5 class="d-flex center theme-text how-work-step">Step 5</h5>
                        <h3 class="d-flex center theme-text how-work-title">
                            Get Moving!
                        </h3>
                        <p class="center mt-2 text-center">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum accusantium minus, sapiente earum quaerat repellat?
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="fixed-icon-container d-flex">
        <div class="store mb-1 d-flex">
            <i class="fa fa-apple fa-2x f-28"></i>
        </div>
        <div class="store mb-1 d-flex">
            <img src="{{ asset('static/website/images/icons/google-play-yellow.svg')}}">
        </div>

        <div class="store mb-2 d-flex">
            <img src="{{ asset('static/website/images/icons/bot.svg')}}">
        </div>
    </div>
    <!-- section join vendor -->
    <section id="join-vendor">
        <div class="container pl-3 pr-3">
            <div class="row bg-white br-10 join-view mt-10 mb-10">
                <div class="col-lg-12 pb-10 mb-2 mt-2 text-center">
                    <h2 class="section-heading pb-0 mt-30" style="font-size: 27px !important;">Join us as a Vendor</h2>
                    <p class="section-subheading text-muted" style="font-size: 19px !important;">Lorem ipsum</p>
                </div>
                <div class="col-lg-6 col-xs-12 tab active">
                    <button class="tablinks vendor " onclick="openContent(event, 'content_accurate')" id="defaultOpen">
                        <span class="svg-container ml-2">
                            <svg class="icon-svg" id="XMLID_386_" xmlns="http://www.w3.org/2000/svg" width="57.789" height="55.473" viewBox="0 0 57.789 55.473">
                                <path id="XMLID_389_" d="M57.678,40.668A22.781,22.781,0,0,0,39.962,20.691V17.824a3.837,3.837,0,0,0-.926-7.562H30.91a3.838,3.838,0,0,0-.926,7.562V20.7a22.664,22.664,0,0,0-11.115,6.114,22.908,22.908,0,0,0-1.916,2.175c-.028,0-.057,0-.086,0H8.823a1.129,1.129,0,1,0,0,2.257h6.593a22.627,22.627,0,0,0-2,4.338H1.129a1.129,1.129,0,1,0,0,2.257H12.775a22.949,22.949,0,0,0-.56,4.338H7.224a1.129,1.129,0,0,0,0,2.257h5.027a22.916,22.916,0,0,0,.7,4.338H5.644a1.129,1.129,0,0,0,0,2.257h8.033a22.8,22.8,0,0,0,19.06,14.6q1.118.11,2.237.11a22.855,22.855,0,0,0,12.443-3.677,1.129,1.129,0,1,0-1.232-1.892,20.542,20.542,0,1,1,6.05-6.058,1.129,1.129,0,1,0,1.893,1.229A22.873,22.873,0,0,0,57.678,40.668ZM29.329,14.1a1.582,1.582,0,0,1,1.58-1.58h8.127a1.58,1.58,0,1,1,0,3.16H30.91A1.582,1.582,0,0,1,29.329,14.1Zm2.911,6.212V17.937h5.464v2.37A23,23,0,0,0,32.241,20.311Z" transform="translate(0 -10.262)" />
                                <path id="XMLID_391_" d="M436.9,425.5a1.129,1.129,0,1,0,.8.331A1.135,1.135,0,0,0,436.9,425.5Z" transform="translate(-386.584 -378.632)" />
                                <path id="XMLID_394_" d="M172.382,144.609a17.51,17.51,0,1,0,17.51,17.51A17.529,17.529,0,0,0,172.382,144.609Zm0,32.762a15.252,15.252,0,1,1,15.252-15.252A15.269,15.269,0,0,1,172.382,177.371Z" transform="translate(-137.392 -129.445)" />
                                <path id="XMLID_397_" d="M270.154,219.742l-5.59,5.59a3.5,3.5,0,0,0-3.1,0l-2.5-2.5a1.129,1.129,0,0,0-1.6,1.6l2.5,2.5a3.507,3.507,0,1,0,6.291,0l5.426-5.426h0l.164-.164a1.129,1.129,0,0,0-1.6-1.6Zm-7.14,9.986a1.25,1.25,0,1,1,1.25-1.25A1.251,1.251,0,0,1,263.014,229.728Z" transform="translate(-228.024 -195.804)" />
                                <path id="XMLID_398_" d="M399.829,289.86h-1.046a1.129,1.129,0,0,0,0,2.257h1.046a1.129,1.129,0,1,0,0-2.257Z" transform="translate(-352.771 -258.302)" />
                                <path id="XMLID_399_" d="M195.256,289.616h-1.046a1.129,1.129,0,1,0,0,2.257h1.046a1.129,1.129,0,1,0,0-2.257Z" transform="translate(-171.289 -258.085)" />
                                <path id="XMLID_400_" d="M301.252,186.122a1.129,1.129,0,0,0,1.129-1.129v-1.046a1.129,1.129,0,0,0-2.257,0v1.046A1.129,1.129,0,0,0,301.252,186.122Z" transform="translate(-266.248 -163.342)" />
                                <path id="XMLID_424_" d="M301.008,387.393a1.129,1.129,0,0,0-1.129,1.129v1.046a1.129,1.129,0,0,0,2.257,0v-1.046A1.129,1.129,0,0,0,301.008,387.393Z" transform="translate(-266.031 -344.826)" />
                                <path id="XMLID_425_" d="M1.129,351.44a1.129,1.129,0,1,0,.8,1.927,1.129,1.129,0,0,0-.8-1.927Z" transform="translate(0 -312.931)" />
                            </svg>
                        </span>
                        <span class="ml-2 f-18" style="font-size:24px;"> Accurate report and fast execution</span>
                    </button>
                    <button class="tablinks vendor bg-white border-cards" onclick="openContent(event, 'content_cost')">
                        <span class="svg-container ml-2">
                            <svg class="icon-svg" id="Group_14549" data-name="Group 14549" xmlns="http://www.w3.org/2000/svg" width="55.469" height="55.473" viewBox="0 0 55.469 55.473">
                                <g id="profit">
                                    <path id="Path_9002" data-name="Path 9002" d="M207.583,348.167a1.083,1.083,0,1,0-1.083-1.083A1.084,1.084,0,0,0,207.583,348.167Zm0,0" transform="translate(-184.181 -308.513)" />
                                    <path id="Path_9003" data-name="Path 9003" d="M.817,42.154l13,13a1.083,1.083,0,0,0,1.532,0L22.5,48a1.083,1.083,0,0,0,0-1.532l-.317-.317H37.8a5.405,5.405,0,0,0,3.69-1.451L54.636,32.385a4.183,4.183,0,0,0-5.063-6.612l-2.918,1.915A18.218,18.218,0,0,0,38.2,12.732,3.256,3.256,0,0,0,36.763,7.5c-.053-.018-.107-.033-.16-.05l2.789-5.01A1.083,1.083,0,0,0,38.748.876a22.215,22.215,0,0,0-12.356,0,1.083,1.083,0,0,0-.644,1.568l2.789,5.01-.163.051a3.25,3.25,0,0,0-1.43,5.227c-4.959,2.861-8.459,9.189-8.459,15,0,.159,0,.315.009.471a13.314,13.314,0,0,0-5.262,2.822L9.94,33.91,9.5,33.471a1.083,1.083,0,0,0-1.532,0L.817,40.622a1.083,1.083,0,0,0,0,1.532ZM28.326,2.62a20.094,20.094,0,0,1,8.488,0L34.4,6.957a13.21,13.21,0,0,0-3.659,0Zm.725,6.943a11.211,11.211,0,0,1,7.035,0,1.084,1.084,0,0,1-.271,2.112,10.6,10.6,0,0,0-6.491,0h0a1.083,1.083,0,0,1-.273-2.109Zm.6,4.285a8.454,8.454,0,0,1,5.708-.046c5.034,1.731,9.129,7.982,9.129,13.934a10.428,10.428,0,0,1-.094,1.435l-5.208,3.417a4.308,4.308,0,0,0-3.365-1.6c-2.651-.065-2.331.128-4.694,0-.532,0-.772-.347-1.147-.59A13.292,13.292,0,0,0,20.653,27.8c0-.023,0-.045,0-.069C20.652,21.867,24.689,15.638,29.65,13.848ZM14.659,32.66a11.141,11.141,0,0,1,14.019-.529,3.842,3.842,0,0,0,2.447,1.023H35.82a2.167,2.167,0,1,1,0,4.334H28.236a1.083,1.083,0,0,0,0,2.167H35.82a4.33,4.33,0,0,0,4.27-5.069L50.73,27.605a2.016,2.016,0,0,1,2.428,3.2L40.014,43.119a3.241,3.241,0,0,1-2.212.869H20.017l-8.542-8.542ZM8.734,35.769,20.2,47.238l-5.619,5.619L3.116,41.388Zm0,0" transform="translate(-0.5)" />
                                </g>
                                <path id="Path_12802" data-name="Path 12802" d="M349.64,257.12h-1.22a1.166,1.166,0,0,1-1.165-1.165.68.68,0,1,0-1.36,0,2.528,2.528,0,0,0,2.455,2.523v1.505a.68.68,0,0,0,1.36,0v-1.505a2.528,2.528,0,0,0,2.455-2.523v-.941a2,2,0,0,0-1.389-1.912l-3.072-1a.648.648,0,0,1-.449-.618v-1.348a.947.947,0,0,1,.946-.946h1.658a.947.947,0,0,1,.946.946.68.68,0,0,0,1.36,0,2.309,2.309,0,0,0-2.306-2.306h-.149v-1.5a.68.68,0,1,0-1.36,0v1.5H348.2a2.309,2.309,0,0,0-2.306,2.306v1.348a2,2,0,0,0,1.389,1.911l3.072,1a.648.648,0,0,1,.449.618v.941A1.166,1.166,0,0,1,349.64,257.12Z" transform="translate(-317.236 -230.98)" />
                            </svg>
                        </span>

                        <span class="ml-2 f-18" style="font-size:24px;">
                            Cost Effective
                        </span>
                    </button>
                    <button class="tablinks vendor bg-white border-cards" onclick="openContent(event, 'content_quality')">
                        <span class="svg-container ml-2">
                            <svg class="icon-svg" id="quality-assurance" xmlns="http://www.w3.org/2000/svg" width="56.034" height="55.473" viewBox="0 0 56.034 55.473">
                                <path id="Path_9004" data-name="Path 9004" d="M43.054,25.745l-.634-1.693c-.567.212-1.141.407-1.709.578l.522,1.73C41.838,26.178,42.451,25.971,43.054,25.745Z" transform="translate(-4.821 -3.218)" />
                                <path id="Path_9005" data-name="Path 9005" d="M36.808,29.792V27.363c.671-.108,1.344-.24,2.012-.393l-.408-1.761c-.871.2-1.754.362-2.625.476l-.787.1v4c0,.242.005.484.018.724l1.806-.092c-.011-.211-.016-.42-.016-.633Z" transform="translate(-4.272 -3.33)" />
                                <path id="Path_9006" data-name="Path 9006" d="M18.423,13a5.423,5.423,0,1,0,5.423,5.423A5.428,5.428,0,0,0,18.423,13Zm0,9.038a3.615,3.615,0,1,1,3.615-3.615A3.619,3.619,0,0,1,18.423,22.038Z" transform="translate(-2.155 -2.155)" />
                                <path id="Path_9007" data-name="Path 9007" d="M44.085,18.763l-.431-.234-.431.234a24.155,24.155,0,0,1-11.324,2.9l-.9.005v7.479A18.757,18.757,0,0,0,43.345,46.73l.308.111.308-.111A18.757,18.757,0,0,0,56.306,29.149V21.671l-.9-.005a24.161,24.161,0,0,1-11.322-2.9ZM54.5,29.149A16.944,16.944,0,0,1,43.653,44.916,16.946,16.946,0,0,1,32.808,29.149v-5.7A25.983,25.983,0,0,0,43.654,20.58,25.986,25.986,0,0,0,54.5,23.451Z" transform="translate(-3.887 -2.687)" />
                                <path id="Path_9008" data-name="Path 9008" d="M40.575,31.009,36.586,35l5.8,5.8L53.6,29.575l-3.989-3.989-7.23,7.23Zm10.471-1.433-8.664,8.664L39.142,35l1.433-1.433,1.808,1.808,7.23-7.23Z" transform="translate(-4.424 -3.366)" />
                                <path id="Path_9009" data-name="Path 9009" d="M57.034,16.364H52.67A20.465,20.465,0,0,1,41.262,12.9l-.531-.308-.5.332a20.429,20.429,0,0,1-6.7,2.9v-1.98l-2.381-.56a14.365,14.365,0,0,0-1.248-3.011l1.289-2.081L26.348,3.341,24.267,4.63a14.366,14.366,0,0,0-3.011-1.248L20.695,1H13.841l-.56,2.381A14.366,14.366,0,0,0,10.269,4.63L8.188,3.341,3.341,8.188,4.63,10.269A14.366,14.366,0,0,0,3.381,13.28L1,13.841v6.854l2.381.56A14.366,14.366,0,0,0,4.63,24.267L3.341,26.348l4.847,4.847,2.081-1.289a14.366,14.366,0,0,0,3.011,1.248l.56,2.381h6.854l.56-2.381a14.365,14.365,0,0,0,3.011-1.248l.417.258A22.364,22.364,0,0,0,28.972,40.81l-3.04,11.148,4.463-1.116,3.377,5.63,3.03-9.091a22,22,0,0,0,3.709,1.481l.255.076.255-.075a22,22,0,0,0,3.709-1.481l3.03,9.091,3.377-5.63L55.6,51.959,52.56,40.811a22.291,22.291,0,0,0,4.474-13.349ZM24.287,27.793l-.473.287a12.544,12.544,0,0,1-3.527,1.461l-.539.132-.484,2.054H15.272l-.484-2.054-.539-.132a12.544,12.544,0,0,1-3.527-1.461l-.473-.287L8.455,28.9,5.633,26.081l1.111-1.795-.287-.473a12.544,12.544,0,0,1-1.461-3.527l-.132-.539-2.055-.484V15.272l2.054-.484.132-.539a12.544,12.544,0,0,1,1.461-3.527l.287-.473-1.111-1.8L8.454,5.632l1.795,1.111.473-.287a12.544,12.544,0,0,1,3.527-1.461l.539-.132.484-2.054h3.991l.484,2.054.539.132a12.544,12.544,0,0,1,3.527,1.461l.473.287,1.795-1.111L28.9,8.454l-1.111,1.795.287.473a12.544,12.544,0,0,1,1.461,3.527l.132.539,2.055.484v.888a20.7,20.7,0,0,1-2.866.2h-.8A10.851,10.851,0,1,0,24.5,25.34v2.123c0,.159.016.315.02.474ZM24.5,16.364v6.307a9.025,9.025,0,1,1,1.761-6.307Zm8.8,35.808-2.045-3.408-2.767.691,1.9-6.957A22.393,22.393,0,0,0,35.2,46.483Zm19.745-2.717-2.767-.691-2.045,3.408-1.9-5.689A22.393,22.393,0,0,0,51.148,42.5Zm2.182-21.993a20.617,20.617,0,0,1-14.46,19.59,20.617,20.617,0,0,1-14.46-19.59V18.172h2.557a22.245,22.245,0,0,0,11.9-3.442,22.224,22.224,0,0,0,11.9,3.442h2.557Z" transform="translate(-1 -1)" />
                            </svg>
                        </span>
                        <span class="ml-2 f-18" style="font-size:24px;">Qaulity Work</span>
                    </button>
                </div>
                <div class="col-lg-6 col-xs-12">
                    <div class="card br-10 bg-white p-1 tabcontent" id="content_accurate">
                        <p class="f-18 mb-2 space">
                            Dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer.Dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard
                            dummy text ever since the 1500s, when an unknown printer.Dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy. Dummy text of the printing and typesetting industry. Lorem Ipsum
                            .
                        </p>
                        <a href="{{route('join-vendor')}}" class="page-scroll mb-view btn join-now mt-1">
                            <button type="button" class="btn join-now">
                                <img src="{{ asset('static/website/images/icons/crown.png')}}" />
                                JOIN NOW
                            </button>
                        </a>
                    </div>
                    <div class="card br-10 bg-white p-1 tabcontent" id="content_cost">
                        <p class="f-18 mb-2 space">
                            2. hello world! lets build somethings intresting
                        </p>
                        <a href="{{route('join-vendor')}}" class="page-scroll mb-view btn join-now mt-1">
                            <button type="button" class="btn join-now">
                                <img src="{{ asset('static/website/images/icons/crown.png')}}" />
                                JOIN NOW
                            </button>
                        </a>
                    </div>
                    <div class="card br-10 bg-white p-1 tabcontent" id="content_quality">
                        <p class="f-18 mb-2 space">
                            3. dummy text.
                        </p>
                        <a href="{{route('join-vendor')}}" class="page-scroll mb-view btn join-now mt-1">
                            <button type="button" class="btn join-now">
                                <img src="{{ asset('static/website/images/icons/crown.png')}}" />
                                JOIN NOW
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section testimonials -->
    <section id="testimonials mb-4">
        <div class="container">
            <div class="row">
                <div class="card">
                    <div class="col-lg-12 text-center mb-2 mt-6">
                        <h1 style="font-size: 30;">Testimonials</h1>
                         <p class="section-subheading text-muted mt-2">Lorem Ipsum</p>
                    </div>
                </div>
            </div>
            <div class="container mb-5">
                <div class="slick testimonialslideshow">
                    @foreach($testimonials as $testimonial)
                    <div class="cd-testimonials-wrapper cd-container bg-white">
                        <div class="cd-testimonials">
                            <div>
                                <img class="testi-img mt-1 " src="{{$testimonial->image}}" style="width: 166px; border-radius: 10px;" />
                            </div>
                            <div class="testimonial-content mb-0 ">
                                <div class="" style="display: flex; flex-direction: column; align-items: baseline; text-align: left;">
                                    <img class=" " src="{{ asset('static/website/images/icons/Artboard – 5.svg')}}" />
                                    <p class="text-justify f-15">
                                        {!! $testimonial->desc !!}
                                    </p>
                                    <h5 class="texti-text mt-1 mb-0">{{$testimonial->name}}</h5>
                                    <h5 class="text-initial ">{{$testimonial->designation}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- section refer and earn -->
    <section id="refer-earn" class="refer-earn p-10 mt-3 ">
        <div class="container">
            <div class="row d-flex justify-content-between reverse" >
                <div class="col-md-6" style="width: auto;">
                    <div class="refer-head mt-3 center-align" style="font-size:30px!important;">Refer and Earn</div>
                    <div class="refer-para mb-4 mt-1 center-align" style="font-size:18px!important;">
                        Dummy Text of the printing and typesetting industry. Lorem Ipsum has been the industry's started dummy text
                    </div>
                    <div class="btn-refer" >
                        <a href="#services" class="page-scroll btn join-now">
                            <button type="button" class="btn join-now redem">Refer Now</button>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6" style="display: flex; justify-content: flex-end;" >
                    <div>
                        <img class="img-responsive responive" src="{{ asset('static/website/images/images/refer-earn.png')}}" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="get-app">
        <div class="container  text-view-center">
            <div class="row mt-4 mb-4 reverse" >
                <div class="col-lg-6 col-xs-12 mt-2">
                    <div class="section-app-heading text-gray" style="font-size:30px!important;">
                        <h1 style="    font-weight: 400;">Get <span class="site-app">BIDDNEST</span> App Now!</h1>
                    </div>
                    <p class="section-app-subheading m-0">
                        Dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text.
                    </p>
                    <div>
                        <div class="d-flex mt-1 mb-view view-content-center">
                            <i class="icon dripicons-checkmark"></i>
                            <p class="pl-1 check-text">Easy & Interactive UI.</p>
                        </div>
                        <div class="d-flex mt-1 mb-view view-content-center">
                            <i class="icon dripicons-checkmark"></i>
                            <p class="pl-1 check-text">Easy & Interactive UI.</p>
                        </div>
                        <div class="d-flex mt-1 mb-view view-content-center">
                            <i class="icon dripicons-checkmark"></i>
                            <p class="pl-1 check-text">Easy & Interactive UI.</p>
                        </div>
                        <div class="d-flex mt-1 mb-view view-content-center">
                            <i class="icon dripicons-checkmark"></i>
                            <p class="pl-1 check-text">Easy & Interactive UI.</p>
                        </div>
                    </div>

                    <div class="input-group-get-link mb-3 mt-3 view-content-center" style="width: 82%;">
                        <input type="text" class="form-control -mr-4" style="border: none !important;" placeholder="Enter your mobile number to get link on phone" />
                        <div class="input-group-get">
                            <button class="btn btn-secondary input-button" type="button">
                                <i class="fa fa-paper-plane"><span class="pl-1 f-bolder">GET LINK</span></i>
                            </button>
                        </div>
                    </div>
                    <div class="flex social-btns mt-30">
                        <a class="app-btn blu flex vert mr-2 justify-content-center" href="#services">
                            <i class="fa fa-apple"></i>
                            <p class="text-white mt-1">
                                <span class="fade">Download on</span> <br />
                                <span class="big-txt">Apple Store</span>
                            </p>
                        </a>
                        <a class="app-btn blu flex vert justify-content-center" href="#services">
                            <!-- <i class="fa fa-android"></i> -->
                            <!-- <i class="fab fa-google-play"></i> -->
                            <img class="g-play" src="{{ asset('static/website/images/icons/g-play.svg')}}" />
                            <p class="text-white mt-1">
                                <span class="fade">Get it on</span> <br />
                                <span class="big-txt">Google Play</span>
                            </p>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-xs-12 mt-3 ">
                    <div class="get-app-img" style="width: 106% !important;">
                        <img class="img-responsive responive" src="{{ asset('static/website/images/images/get-app.png')}}" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section get offers -->
    <section>
        <div class="container get-offers">
            <div class="row mt-6 mb-5">
                <div class="col-sm-7 col-xs-12 " style="padding-left: 8px !important;">
                    <p class="theme-text f-bolder text-view-center">
                        Whether you’re new to Packers & movers, just new to BIDDNEST,
                        <br /> We’re glad you’re here! Stay informed of our special offers.
                    </p>
                </div>
                <div class="col-sm-5 col-xs-12 col-sm-12">
                    <div class="input-group-get-link ml-2-0 ml-2 mt-30" style="width: 95%;">
                        <input type="text" class="form-control offer-input -mr-4" placeholder="Enter your email ID here" />
                        <div class="input-group-get">
                            <button class="btn btn-secondary input-button" type="button">
                                <i class="fa fa-paper-plane"><span class="pl-1 f-bolder">GET OFFERS</span></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="Login-modal" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
        <div class="modal-dialog theme-text input-text-blue" role="document">
            <div class="modal-content w-70 m-0-auto w-1000 mt-20 right-25" style="margin-top:20% !important">
                <div class="modal-header p-0 br-5 ">
                    <div>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="color: #FFF !important; transform: translate(-13px, 26px);">
                        <span>                         <i class="dripicons-cross" style="font-size: 25px;"></i></span>
                        <!-- <i class="icon dripiconmeter " style="color: #FFF !important;"></i> -->
                            <!-- <i class="fa fa-times mt-1 mr-1" ></i> -->
                            <!-- <span aria-hidden="true" style="color:#fff !important; font-size:30px !important; margin-right: 7px !important;" >&times;</span> -->
                        </button>
                    </div>
                    <div>
                        <header class="join-as-vendor">
                            <img src="{{ asset('static/website/images/icons/logo.png')}}" class="img-mar" style="margin-left: 104px;display: flex;">
                        </header>

                    </div>


                </div>

                <div class="modal-body  margin-topneg-7">

                    <form action="{{ route('website.login') }}" data-await-input="#otp" method="POST" data-next="refresh" {{--data-url="{{route('home-logged')}}"--}} data-alert="mega" class="form-new-order mt-1 input-text-blue" data-parsley-validate>
                        <div class="d-flex f-direction text-justify center">
                            <h2 class="p-text" style="font-size: 24px !important;">Login</h2>
                            <div class="col-lg-12 col-xs-12 mt-3 hidden-space">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Phone Number</label>
                                    <input type="number" class="form-control" name="phone" id="phone" autocomplete="off" placeholder="9990009990" maxlength="10" minlength="10" required>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-4 col-xs-12 mt-1 otp hidden "   id="otp">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">OTP</label>
                                    <input type="number" class="form-control" name="otp" id="formGroupExampleInput" autocomplete="off" maxlength="6" minlength="6" placeholder="Verify OTP">
                                </div>
                            </div>
                            {{-- <a class="weblogin" data-url="{{ route('website.login') }}">
                            <button type="button" class="btn btn-theme-bg   text-view-center mt-3  padding-btn-res white-bg">
                                Next
                            </button>
                            </a>--}}
                            <div class="col-md-12" style="width: 100%;">
                            <p class="mt-2 mb-0" style="text-align: center; color:#3B4B58; font-size:14px">Waiting for OTP</span> </p>

                            <a class="weblogin" >
                                <button type="submit" class="btn btn-theme-bg  mt-2 text-view-center  padding-btn-res white-bg width-max" style="    width: -webkit-fill-available !important; ">
                                    Submit
                                </button>
                            </a>
                            <p class="mt-2 " style="text-align: center; color:#3B4B58; font-size:14px">Did not receive OTP? <span class="theme-text bold">Resend</span> </p>
                            </div>
                           

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- location from picker -->
    <div class="modal fade" id="from_location" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
        <div class="modal-dialog theme-text input-text-blue" role="document">
            <div class="modal-content w-1000 mt-50 right-25">
                <div class="modal-header  bg-purple">
                    <h5 class="modal-title d-content br-10 m-0-auto -mr-30 f-18 text-white" id="exampleModalLongTitle ">
                        From Location
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-15 margin-topneg-7">
                    <div class="row">
                        <div class="col-sm-12"> 
                        <label>From Location</label>

                        <div class="input-group-get-link mb-2 mt-1 view-content-center" style="width: 100%;">
                        <input type="text" class="form-control -mr-4" style="height: 38px;" placeholder="SVM Complex,indiranagar,Benguluru" id="source-autocomplete"  required />
                        <div class="input-group-get">
                            <button class="btn btn-secondary input-button" type="button">
                                <i class="fa fa-search" style="    font-size: 16px;"><span class="pl-1 f-bolder">Search</span></i>
                            </button>
                        </div>
                    </div>
                    <span class="error-message">Please enter valid</span>
                        </div>
                   
                    </div>
                    <div style="width: 100%; height: 280px;" class="source-map-picker"></div>

                </div>
            </div>
        </div>
    </div>

    <!-- location to picker -->
    <div class="modal fade" id="to_location" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
        <div class="modal-dialog theme-text input-text-blue" role="document">
            <div class="modal-content w-1000 mt-50 right-25">
                <div class="modal-header bg-purple">
                    <h5 class="modal-title d-content br-10 m-0-auto -mr-30 f-18 text-white" id="exampleModalLongTitle ">
                        To Location
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-15 margin-topneg-7">
                <div class="row">
                        <div class="col-sm-12"> 
                        <label>To Location</label>

                        <div class="input-group-get-link mb-2 mt-1 view-content-center" style="width: 100%;">
                        <input type="text" class="form-control -mr-4" style="height: 38px;" placeholder="Koramangala, Hsr Layout" id="source-autocomplete"  required />
                        <div class="input-group-get">
                            <button class="btn btn-secondary input-button" type="button">
                                <i class="fa fa-search" style="    font-size: 16px;"><span class="pl-1 f-bolder">Search</span></i>
                            </button>
                        </div>
                    </div>
                    <span class="error-message">Please enter valid</span>
                        </div>
                   
                    </div>
                    <div style="width: 100%; height: 280px;" class="dest-map-picker"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openContent(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>
</div>
@endsection
