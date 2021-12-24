@extends('layouts.app')
@section('title') Vendor Management @endsection
@section('content')

<!-- Main Content -->
<div class="main-content grey-bg" data-barba="container" data-barba-namespace="createbranch">

    <div class="d-flex  flex-row justify-content-between">
        <div class="page-head text-left p-4 pt-0 pb-0">
            <h3 class="page-head text-left p-4 f-20 theme-text">Onboard Vendor</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('vendors')}}"> Vendors Management</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Onboard Vendor</li>
                </ol>
            </nav>
        </div>
        <div class="mr-20">
            <a class="modal-toggle" data-toggle="modal" data-target="#add-branch">
                <button class="btn theme-bg white-text w-10 modal-toggle" data-target="#base_price">Add Price</button>
            </a>
        </div>
    </div>
    <!-- Dashboard cards -->

    <div class="d-flex flex-row justify-content-center Dashboard-lcards " style="min-height: 100vh;">
        <div class="col-lg-10">
            <div class="card  h-auto p-0 pt-10 ">
                <div class="card-head right text-left border-bottom-2 p-10 pt-10 pb-0">
                    <h3 class="f-18 mb-0">
                        <ul class="nav nav-tabs  p-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link p-15" href="{{route("onboard-edit-vendors", ['id'=>$id])}}">Edit Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active p-15" id="quotation" href="#">Pricing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="quotation" href="{{route("onboard-branch-vendors",["id"=>$id])}}">Branch</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="quotation" href="{{route("onboard-bank-vendors", ['id'=>$id])}}"
                                >Banking Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="quotation" href="{{route("onboard-action", ['id'=>$id])}}"
                                >Actions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="quotation" href="{{route("onboard-userrole-vendors", ['id'=>$id])}}">Roles</a>
                            </li>
                        </ul>
                    </h3>
                </div>
                    <div class="tab-content " id="myTabContent">
                        <!-- form starts -->
                        <input type="hidden" name="id" value="{{$id}}">
                        <div class="w-100">
                            <div class="tab-pane show" style="min-height: 50vh">

                                @foreach($prices as $price)
                                <div class="branch-wrapper price_{{$price->id}}">
                                    <div class="branch-snip d-flex flex-row justify-content-around">
                                        <div class="data-group border-right" style="min-width: 18%">
                                            <h1 style="font-size: 18px;text-align: center">{{$price->subservice->name}}</h1>
                                            <p style="text-align: center; color: #2E0789"><i class="icon dripicons-document-edit" style="font-size: 10px"></i><span class="cursor-pointer modal-toggle" data-target="#price_{{$price->id}}" style="color: #2E0789"> change</span></p>
                                        </div>
                                        <div class="data-group">
                                            <h5 style="font-size: 14px;">Market Price Economic</h5>
                                            <p>&#8377; {{ $price->mp_economic  }}</p>

                                            <br />
                                            <h5 style="font-size: 14px;">Biddnest Price Economic</h5>
                                            <p>&#8377; {{ $price->bp_economic  }}</p>
                                        </div>
                                        <div class="data-group">
                                            <h5 style="font-size: 14px;">Market Price Premium</h5>
                                            <p>&#8377; {{ $price->mp_premium }}</p>

                                            <br />
                                            <h5 style="font-size: 14px;">Biddest Price Premium</h5>
                                            <p>&#8377; {{ $price->bp_premium }}</p>
                                        </div>
                                        <div class="data-group">
                                            <h5 style="font-size: 14px;">Add. Market Price Economic</h5>
                                            <p>&#8377; {{ $price->mp_additional_distance_economic_price }}</p>

                                            <br />
                                            <h5 style="font-size: 14px;">Add. Biddnest Price Economic</h5>
                                            <p>&#8377; {{ $price->bp_additional_distance_economic_price }}</p>
                                        </div>
                                        <div class="data-group">

                                            <h5 style="font-size: 14px;">Add. Market Price Premium</h5>
                                            <p>&#8377; {{ $price->mp_additional_distance_premium_price }}</p>

                                            <br />
                                            <h5 style="font-size: 14px;">Add. Biddnest Price Premium</h5>
                                            <p>&#8377; {{ $price->bp_additional_distance_premium_price }}</p>

                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="d-flex  justify-content-between flex-row  p-10 py-0" style="border-top: 1px solid #70707040;">
                        <div class="w-50"><a class="white-text p-10" href="{{route("onboard-edit-vendors", ['id'=>$id])}}">
                            <button type="button" class="btn theme-br theme-text w-30 white-bg">Back</button></a>
                        </div>
                        <div class="w-50 text-right">
                            <a class="white-text p-10" href="{{route("onboard-branch-vendors",["id"=>$id])}}">
                            <button class="btn theme-bg theme-text w-30 white-bg">Next</button></a>
                        </div>
                    </div>

            </div>
        </div>
    </div>
    @foreach($prices as $price)
        <div class="fullscreen-modal" id="price_{{$price->id}}" >
            <div class="fullscreen-modal-body" role="document" style="width: 100% !important;">
                <div class="modal-header">
                    <h5 class="modal-title  ml-4 pl-2" id="exampleModalLongTitle">Edit {{$price->subservice->name}} Price</h5>
                    <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-new-order input-text-blue" action="{{route('update_pricing')}}" data-next="redirect" data-url="{{route("onboard-base-extra-price", ['id'=>$id])}}" data-alert="mega" method="POST"  data-parsley-validate>
                    <div class="modal-body" style="padding: 10px 9px; margin-bottom: 0px !important;">
                        <div class="d-flex match-height row p-15 quotation-main pb-0" >
                            {{--<div class="col-sm-4 secondg-bg margin-topneg-15 pt-10">
                                <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 15px;">
                                    Market Price Economy
                                </div>
                                <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 15px;">
                                    Biddnest Price Economy
                                </div>
                                <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 20px;">
                                    <b>Market Price Premium</b>
                                </div>
                                <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 20px;">
                                    <b>Biddnest Price Premium</b>
                                </div>
                                <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 20px;">
                                    Add. Market Price Economy
                                </div>
                                <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 15px;">
                                    Add. Biddnest Price Economy
                                </div>
                                <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 20px;">
                                    Add. Market Price Premium
                                </div>
                                <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 20px;">
                                    Add. Biddnest Price Premium
                                </div>
                            </div>
                            <div class="col-sm-7 white-bg  margin-topneg-15 pt-10">
                                <div class="theme-text f-14  p-15" style="padding-top: 5px;">
                                    <input type="text" class="form-control bid-amount" value="{{$price->mp_economic}}" name="subservice[market][price][economy]" min="0.00" required>
                                    <input type="hidden" class="form-control" value="{{$price->organization_id}}" name="id" required>
                                    <input type="hidden" class="form-control" value="{{$price->id}}" name="subservice[id]" required>
                                </div>
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;" >
                                    <input type="text" class="form-control" value="{{$price->bp_economic}}" name="subservice[bidnest][price][economy]" min="0.00" required>
                                </div>
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;" >
                                    <input type="number" class="form-control" value="{{$price->mp_premium}}" name="subservice[market][price][premium]" min="0.00" required>
                                </div>
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;" >
                                    <input type="text" class="form-control" value="{{$price->bp_premium}}" name="subservice[bidnest][price][premium]" min="0.00" required>
                                </div>
                                <div class="theme-text f-14 p-15"  style="padding-top: 5px;">
                                    <input type="text" class="form-control " value="{{$price->mp_additional_distance_economic_price }}" name="subservice[mp_additional][price][economy]" min="0.00" required>
                                </div>
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;" >
                                    <input type="text" class="form-control " value="{{$price->bp_additional_distance_economic_price}}" name="subservice[bp_additional][price][economy]" min="0.00" required>
                                </div>
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;" >
                                    <input type="text" class="form-control" value="{{$price->mp_additional_distance_premium_price}}" name="subservice[mp_additional][price][premium]" min="0.00" required>
                                </div>
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;" >
                                    <input type="text" class="form-control " value="{{$price->bp_additional_distance_premium_price}}" name="subservice[bp_additional][price][premium]" min="0.00" required>
                                </div>
                            </div>--}}
                            <div class="row" style="margin-bottom: 30px;">
                                <div class="col-md-3">
                                    <label>Marked Price Economic</label>
                                    <input type="text" class="form-control bid-amount" value="{{$price->mp_economic}}" name="subservice[market][price][economy]" min="0.00" required>
                                    <input type="hidden" class="form-control" value="{{$price->organization_id}}" name="id" required>
                                    <input type="hidden" class="form-control" value="{{$price->id}}" name="subservice[id]" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Market Price Premium</label>
                                    <input type="text" class="form-control" value="{{$price->bp_economic}}" name="subservice[bidnest][price][economy]" min="0.00" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Add. Market Price Economy</label>
                                    <input type="text" class="form-control " value="{{$price->mp_additional_distance_economic_price }}" name="subservice[mp_additional][price][economy]" min="0.00" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Add. Market Price Premium</label>
                                    <input type="text" class="form-control" value="{{$price->mp_additional_distance_premium_price}}" name="subservice[mp_additional][price][premium]" min="0.00" required>
                                </div>
                            </div>
                            <div class="row secondg-bg margin-topneg-15 pt-10" style="margin-right: -9px !important; padding-bottom: 10px;">
                                <div class="col-md-3">
                                    <label>Biddnest Price Economy</label>
                                    <input type="text" class="form-control" value="{{$price->bp_economic}}" name="subservice[bidnest][price][economy]" min="0.00" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Biddnest Price Premium</label>
                                    <input type="text" class="form-control" value="{{$price->bp_premium}}" name="subservice[bidnest][price][premium]" min="0.00" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Add. Biddnest Price Economy</label>
                                    <input type="text" class="form-control " value="{{$price->bp_additional_distance_economic_price}}" name="subservice[bp_additional][price][economy]" min="0.00" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Add. Biddnest Price Premium</label>
                                    <input type="text" class="form-control " value="{{$price->bp_additional_distance_premium_price}}" name="subservice[bp_additional][price][premium]" min="0.00" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p-15 ">
                        <div class="w-50">
                        </div>
                        <div class="w-50 text-right"><a class="white-text p-10" href="#">
                                <button  class="btn theme-bg white-text w-40" style="margin-bottom: 20px;">Update</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <div class="fullscreen-modal" id="base_price" >
        <div class="fullscreen-modal-body" role="document" style="width: 100% !important;">
            <div class="modal-header">
                <h5 class="modal-title  ml-4 pl-2" id="exampleModalLongTitle">Add Prices</h5>
                <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-new-order input-text-blue" action="{{route('add_pricing')}}" data-next="redirect" data-url="{{route("onboard-base-extra-price", ['id'=>$id])}}" data-alert="mega" method="POST"  data-parsley-validate>
                <div class="modal-body" style="padding: 10px 9px; margin-bottom: 0px !important;">
                    <div class="d-flex match-height row p-15 quotation-main pb-0" >
                        <div class="col-sm-4 secondg-bg margin-topneg-15 pt-10">
                            <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 15px;">
                                Sub-Category
                            </div>
                            <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 15px;">
                                Market Price Economy
                            </div>
                            <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 15px;">
                                Biddnest Price Economy
                            </div>
                            <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 20px;">
                                <b>Market Price Premium</b>
                            </div>
                            <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 20px;">
                                <b>Biddnest Price Premium</b>
                            </div>
                            <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 20px;">
                                Add. Market Price Economy
                            </div>
                            <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 15px;">
                                Add. Biddnest Price Economy
                            </div>
                            <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 20px;">
                                Add. Market Price Premium
                            </div>
                            <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 20px;">
                                Add. Biddnest Price Premium
                            </div>
                        </div>
                        <div class="col-sm-7 white-bg  margin-topneg-15 pt-10">
                            <div class="theme-text f-14  p-15" style="padding-top: 5px;">
                                <select name="subservice[id]" class="form-control" required>
                                    <option value="">Select</option>
                                    @foreach($add_subservices as $subservice)
                                        <option value="{{$subservice->id}}">{{ucwords($subservice->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="theme-text f-14  p-15" style="padding-top: 5px;">
                                <input type="text" class="form-control" value="0.00" name="subservice[market][price][economy]" min="0.00" required>
                                <input type="hidden" class="form-control" value="{{$id}}" name="id" min="0.00" required>
                            </div>
                            <div class="theme-text f-14 p-15" style="padding-top: 5px;" >
                                <input type="text" class="form-control " value="0.00" name="subservice[bidnest][price][economy]" min="0.00" required>
                            </div>
                            <div class="theme-text f-14 p-15" style="padding-top: 5px;" >
                                <input type="number" class="form-control" value="0.00" name="subservice[market][price][premium]" min="0.00" required >
                            </div>
                            <div class="theme-text f-14 p-15" style="padding-top: 5px;" >
                                <input type="text" class="form-control " value="0.00" name="subservice[bidnest][price][premium]" min="0.00" required>
                            </div>
                            <div class="theme-text f-14 p-15"  style="padding-top: 5px;">
                                <input type="text" class="form-control " value="0.00" name="subservice[mp_additional][price][economy]" min="0.00" required>
                            </div>
                            <div class="theme-text f-14 p-15" style="padding-top: 5px;" >
                                <input type="text" class="form-control " value="0.00" name="subservice[bp_additional][price][economy]" min="0.00" required >
                            </div>
                            <div class="theme-text f-14 p-15" style="padding-top: 5px;" >
                                <input type="text" class="form-control" value="0.00" name="subservice[mp_additional][price][premium]" min="0.00" required>
                            </div>
                            <div class="theme-text f-14 p-15" style="padding-top: 5px;" >
                                <input type="text" class="form-control " value="0.00" name="subservice[bp_additional][price][premium]" min="0.00" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-15 ">
                    <div class="w-50">
                    </div>
                    <div class="w-50 text-right"><a class="white-text p-10" href="#">
                            <button  class="btn theme-bg white-text w-40" style="margin-bottom: 20px;">Add</button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

