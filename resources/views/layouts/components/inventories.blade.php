<div class="modal-header pb-0">
                    <h3 class="theme-text p-2 mb-2 f-14"> Inventory Details</h3>

                    <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close"
                        onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                        <i class="fa fa-times theme-text" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex  pb-4 pl-3">
                        <div class="col-lg-12 ">
                            <div class="profile-section">
                                <figure>
                                    <img src="assets/images/big-profile.svg" alt="">
                                </figure>
                                <div class="profile-details-side-pop">
                                    <ul>
                                        <li>
                                            <h1>Cupboards</h1>
                                            <i class="icon dripicons-pencil pr-1 mr-1 " style="color: #3BA3FB;"
                                            aria-hidden="true"></i>
                                        </li>
                                        <li>
                                            <h2>Polycarbonate</h2>
                                            <label class="switch mb-0" style="transform: scale(0.7);">
                                                <input type="checkbox" id="switch">
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
                            <h1 class="side-popup-heading">Item ID</h1>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-between align-items-center">
                            <h1 class="side-popup-content">IT1234445</h1>
                        </div>
                    </div>
                    <div class="row d-flex pb-4 pl-3">
                        <div class="col-lg-6 align-items-center">
                            <h1 class="side-popup-heading">Category ID</h1>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-between align-items-center">
                            <h1 class="side-popup-content">C1234098</h1>
                        </div>
                    </div>
                    <div class="row d-flex pb-4 pl-3">
                        <div class="col-lg-6 align-items-center">
                            <h1 class="side-popup-heading">Vendor ID</h1>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-between align-items-center">
                            <h1 class="side-popup-content">V0912374</h1>
                        </div>
                    </div>
                    <div class="row d-flex pb-4 pl-3">
                        <div class="col-lg-6 align-items-center">
                            <h1 class="side-popup-heading">Zone </h1>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-between align-items-center">
                            <h1 class="side-popup-content">Bengaluru Urban</h1>
                        </div>
                    </div>
                    <div class="row d-flex pb-4 pl-3">
                        <div class="col-lg-6 align-items-center">
                            <h1 class="side-popup-heading">Transport Vehicle</h1>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-between align-items-center">
                            <h1 class="side-popup-content">KA03 B 1176</h1>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center p-20">
                        <div class="">
                            <a class="white-text p-10" href="{{ route('details-inventories')}}">
                                <button class="btn theme-bg white-text my-0" style="width: 127px;
                                border-radius: 6px;">View More</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>