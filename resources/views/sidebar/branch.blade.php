<div class="modal-header">
    <div class="theme-text heading f-18">Branch Details</div>
    <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close"
            onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
        <!-- <span aria-hidden="true" >&times;</span> -->
        <i class="fa fa-times theme-text" aria-hidden="true"></i>
    </button>
</div>
<div class="modal-body">
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active margin-topneg-15" id="customer" role="tabpanel"
             aria-labelledby="new-order-tab">
            <!-- form starts -->
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Branch Name
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="theme-text f-14">
                        {{$branch->city}}
                    </div>
                </div>

            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Organization Name
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14 d-flex justify-content-between">
                       {{$branch->org_name}} {{$branch->org_type}}
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                       Zone
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14 d-flex justify-content-between">
                        {{$branch->zone->name}}
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
                        {{json_decode($branch->meta, true)['address']}}
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Service Type
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        @foreach(\App\Enums\OrganizationEnums::$SERVICES as $type=>$key)
                            @if($branch->service_type == $key)
                                {{$type}}
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Services
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        @foreach($branch->services as $service)
                            {{$service->name}},
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
