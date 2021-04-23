@extends('layouts.app')
@section('title') Vendor Payout @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="createvendorpayout">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head f-28 text-left p-4 theme-text">Create Payout</h3>
    </div>
    <div class="d-flex  flex-row justify-content-between">
      <div class="page-head text-left p-4 pt-0 pb-0">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="vendor-payout.html">Vendor Payout</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create  Payout</li>
          </ol>
        </nav>
      </div>
    </div>
    <!-- Dashboard cards -->
    <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
        <div class="col-sm-10">
            <div class="card  h-auto p-0 pt-10 ">
                <div class="card-head right text-left border-bottom-2 pl-3 ml-1 p-10 pt-20">
                    <h3 class="f-18 theme-text">
                        Create Payout
                    </h3>
                </div>
                <form class="create-payout">
                    <div class="d-flex pl-4 pr-4 row  p-20" >
                        <div class="col-sm-6">
                            <div class="form-input">
                                <label>Vendor Name</label>
                                <input type="text"  placeholder="Pradeep" id="E-mail" class="form-control">
                                <span class="error-message">Please enter  valid</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-input" >
                                <label class="start-date">Payout date</label>
                                <div id="my-modal">
                                    <input type="date" id="dateselect" class="form-control br-5" required="required" placeholder="23/Dec/2020" />
                                    <span class="error-message">please enter valid date</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-input">
                                <label class="coupon-code"> Total Amount</label>
                                <input type="text"  placeholder="₹ 9,300" id="coupon-code" class="form-control">
                                <span class="error-message">Please enter  valid </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-input">
                                <label class="coupon-id">Number Of Orders</label>
                                <input type="text"  placeholder="10" id="coupon-id" class="form-control">
                                <span class="error-message">Please enter  valid </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-input">
                                <label class="coupon-id">Commission Rate</label>
                                <input type="text"  placeholder="10%" id="coupon-id" class="form-control">
                                <span class="error-message">Please enter  valid </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-input">
                                <label class="max-discount">Adjustments</label>
                                <input type="text"  placeholder="5%" id="max-discount" class="form-control">
                                <span class="error-message">Please enter  valid </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-input">
                                <label class="min-order">Payout Amount</label>
                                <input type="text"  placeholder="₹ 9,300" id="min-order" class="form-control">
                                <span class="error-message">Please enter  valid </span>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-input">
                            <label>Description</label>
                            <textarea id="" class = "form-control" rows = "4" placeholder = "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
                            "></textarea>
                            <span class="error-message">Please enter  valid</span>
                        </div>
                    </div>
                    </div>
                    <div class="d-flex  justify-content-between flex-row  p-10 border-top " >
                        <div class="w-50"><a class="white-text p-10" href="#"><button class="btn theme-br theme-text w-30 white-bg">Cancel</button></a></div>
                        <div class="w-50 text-right"><a class="white-text p-10" data-toggle="modal" data-target="#for-friend"><button class="btn theme-bg white-text w-30">Save</button></a></div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>

@endsection
