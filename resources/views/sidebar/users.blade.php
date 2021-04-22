<div class="modal-header pb-0">
    <div class="d-flex justify-content-between">
        <ul class="nav nav-tabs pt-20 justify-content-start p-0 flex-row f-18" id="myTab" role="tablist">
            <li class="nav-item ">
                <a class="nav-link active pb-15" id="customer-details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="home" aria-selected="true">User Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link pb-15" id="vendor-tab" data-toggle="tab" href="#Banking" role="tab" aria-controls="profile" aria-selected="false">Banking Details</a>
            </li>
        </ul>
    </div>
    <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
        <!-- <span aria-hidden="true" >&times;</span> -->
        <i class="fa fa-times theme-text" aria-hidden="true"></i>
    </button>
</div>
<div class="modal-body">
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active " id="details" role="tabpanel" aria-labelledby="zone-tab">
            <!-- form starts -->
            <div class="d-flex  row  p-10">
                <div class="col-sm-12">
                    <div class="theme-text f-14 bold">
                        <div class="d-flex justify-content-around ">
                            <figure>
                                <img src="assets/images/big-profile.svg" alt="">
                            </figure>
                            <div class="profile-details">
                                <p class="profile-name">David jerome</p>
                                <p class="profile-id">davidjerome@gamil.com</p>
                                <p class="profile-num">987456123</p>
                            </div>
                            <div class="profile-switch">
                                <div class="theme-text f-14 p-05">
                                    <i class="icon dripicons-pencil p-1 cursor-pointer " aria-hidden="true"></i>
                                </div>
                                <label class="switch-small">
                                    <input type="checkbox" id="switch">
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Employee ID
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14 d-flex justify-content-between">
                        davidjerome
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Employee Role
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        <div class="status-badge"> Super Admin</div>
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Manager Name
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        <div class="d-flex vertical-center">
                            Rohan Kumar
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Alternate Phone number
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        +91 9783546271
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Gender
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        Male
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Educational Details
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        Master of Business Administration
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Date of Birth
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        30 / 07 / 1995
                    </div>
                </div>
            </div>

            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        PAN Card Number
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        AXKPVXXXX
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Address
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitro
                    </div>
                </div>
            </div>
            <div class="d-flex   justify-content-center p-10">
                <div class="">
                    <a class="white-text p-10" href="{{route('details_user')}}">
                        <button class="btn theme-bg white-text">View More</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="tab-pane fade  " id="Banking" role="tabpanel" aria-labelledby="zone-insight-tab">
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Account Number
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="theme-text f-14">
                        63217485796
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Bank Name
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        ICICI
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Account Holder Name
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        David Jerome
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        IFSC Code
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        ICI00001234
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Branch Name
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        Indiranagar
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Government ID proof
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        PancardDoc.pdf
                    </div>
                </div>
            </div>
            <div class="d-flex   justify-content-center p-10">
                <div class="">
                    <a class="white-text p-10" href="{{route('details_user')}}">
                        <button class="btn theme-bg white-text">View More</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
