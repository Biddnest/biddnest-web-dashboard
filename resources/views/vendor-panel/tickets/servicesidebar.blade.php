<div class="modal-header pb-0 border-none">
    <h3 class="f-18 p-10">
        Service Request Details
    </h3>
    <button type="button" class="close theme-text margin-topneg-10" data-dismiss="modal" aria-label="Close" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
        <!-- <span aria-hidden="true" >&times;</span> -->
        <i class="fa fa-times theme-text" aria-hidden="true"></i>
    </button>
</div>
<div class="modal-body border-top margin-topneg-7">
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active " id="details" role="tabpanel"
             aria-labelledby="zone-tab">
            <!-- form starts -->
            <div class="d-flex  row  p-8">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Service ID
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14 d-flex justify-content-between">
                        {{$ticket->id}}
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-8 pt-0">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Category
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        <div class="status-badge red-bg">
                            @foreach(\App\Enums\TicketEnums::$TYPE as $type=>$key)
                                @if()
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-8">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Title
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14 d-flex justify-content-between">
                        Item not packed
                    </div>
                </div>
            </div>

            <div class="d-flex  row  p-8">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Description
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        <div class="d-flex vertical-center">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quod minus sapiente et dicta omnis itaque dignissimos doloribus modi totam.
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex     p-15 border-top">
                <div class=" row  d-felx">
                    <div class="col-sm-12  p-8">
                        <div class="theme-text f-14 bold">
                            Replies
                        </div>
                    </div>
                    <div class="col-sm-3 p-8">
                        <div class="theme-text f-14 bold">
                            <img src="./assets/images/upload-image.svg" alt="" srcset="">
                        </div>
                    </div>
                    <div class="col-sm-7 p-8">
                        <div class="theme-text f-14 bold">
                            Customer Support
                        </div>
                        <span class="text-muted">2 days ago</span>
                        <p class="p-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui accusamus laudantium alias! Maxime eius esse perspiciatis.</p>
                    </div>
                    <div class="col-sm-3 p-8">
                        <div class="theme-text f-14 bold">
                            <img src="./assets/images/upload-image.svg" alt="" srcset="">
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-input">
                                <textarea type="text" id="fullname"
                                          placeholder="Chandigarh"
                                          class="form-control" rows="3"> </textarea>
                            <button class="btn-1 btn white-bg float-right mt-1 ">Comment</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex   justify-content-center p-10">
                <div class=""><a class="white-text p-10" href="user-role-details.html"><button
                            class="btn theme-bg white-text">View More</button></a></div>
            </div>
        </div>
    </div>
</div>
