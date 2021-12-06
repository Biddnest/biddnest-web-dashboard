@extends('layouts.app')
@section('title') Customer Management @endsection
@section('content')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="createcustomer">
        <div class="d-flex  flex-row justify-content-between ">
            <h3 class="page-head text-left p-4 f-20">Customer Reward Points</h3>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left    pb-0 p-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('customers')}}">Customer Management</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Reward Points</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Dashboard cards -->
        <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
            <div class="col-lg-10">
                <div class="card  h-auto p-0 pt-10 ">
                    <div class="card-head right text-left border-bottom-2 pb-0">
                        <h3 class="f-18 mb-0">
                            <ul class="nav nav-tabs  p-0" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link  p-15" id="new-order-tab" data-toggle="tab"
                                       href="#order" role="tab" aria-controls="home"
                                       aria-selected="true">@if(!$users) Create @else Edit @endif Customer</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active p-15" id="quotation" href="@if(!$users)#@else{{route("rewards-customers", ['id'=>$users->id])}}@endif"
                                    >Reward Points</a>
                                </li>

                            </ul>
                        </h3>
                    </div>
                    <div class="create-customer">
                        <div class="form-wrapper">
                            <div class="view-more">
                                <div class="d-flex row p-15  ">
                                    <div class="col-sm-4 p-10 d-felx justify-content-center">
                                        <div class="text-center ">
                                            <h3 class="f-18 theme-text bold p-10">Point Balance</h3>
                                            <h1><span class="text-center"  style="min-width: 0px !important;">{{$users->wallet->balance}}</span></h1>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 p-10">
                                        <div class=" text-center border-left-blue">
                                            <h3 class="text-center f-18 theme-text bold p-10">Wallet Actions</h3>
                                            <h1>
                                                    <button class="btn theme-text white-bg theme-br modal-toggle"  data-target="#redeem-wallet">Redeem Points</button> &nbsp;
                                                <button class="btn theme-text theme-br modal-toggle" data-target="#deposit-wallet">Add Points</button>
                                                </h1>
                                        </div>
                                    </div>
                                </div>

                                <div class="bidlist-table  border-pop">
                                    <div class="d-flex  row  p-10">
                                        <div class="col-sm-12 ">
                                            <div class="d-flex  p-10  justify-content-between ">
                                                <div class="vertical-center">
                                                    <div class="theme-text f-18 bold">
                                                        Transaction History
                                                    </div>
                                                </div>
                                            </div>
                                            <table class="table text-center p-10 theme-text">
                                                <thead class="secondg-bg  p-0">
                                                <tr>
                                                    <th scope="col" >Date</th>
                                                    <th scope="col">Comment</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col">Type</th>

                                                </tr>
                                                </thead>
                                                <tbody class="mtop-15">
                                                @foreach($users->wallet->transactions as $trans)
                                                    <tr class="tb-border  cursor-pointer">
                                                        <td  class="text-center">{{\Carbon\Carbon::parse($trans->created_at)->format("h:i A, d M Y")}}</td>
                                                        <td class="">
                                                            {{$trans->meta ? $trans->meta['desc'] : "-" }}

                                                        </td>
                                                        <td class="">&#8377;{{str_replace("-","",$trans->amount)}}</td>
                                                        <td class="">
                                                            @switch($trans->type)
                                                                @case(\App\Enums\WalletEnums::$TRANSACTION_TYPE['deposit'])
                                                                <span class="green-bg text-center w-100  td-padding">Deposited</span>
                                                                @break;
                                                                @case(\App\Enums\WalletEnums::$TRANSACTION_TYPE['withdraw'])
                                                                <span class="red-bg text-center w-100  td-padding">Withdrawn</span>
                                                                @break;
                                                            @endswitch
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="fullscreen-modal" id="deposit-wallet" >
            <div class="fullscreen-modal-body" role="document" style="width: 60% !important; transform: translateX(30%) !important;">
                <div class="modal-header">
                    <h5 class="modal-title  ml-4 pl-2" id="exampleModalLongTitle">Add Points To Wallet</h5>
                    <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-new-order pt-4 mt-3 onboard-vendor-branch input-text-blue" action="{{route('admin.add_points')}}" data-next="refresh" data-redirect-type="hard"  data-url="{{route('customers')}}" data-alert="mega" method="POST" data-parsley-validate>
                    <div class="modal-body" style="padding: 10px 9px; margin-bottom: 0px !important;">
                        <div class="d-flex match-height row p-15 quotation-main pb-0" >
                            <div class="col-sm-4 secondg-bg margin-topneg-15 pt-10">
                                <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 15px;">
                                    Points
                                </div>
                                <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 15px;">
                                    Comments
                                </div>
                            </div>
                            <div class="col-sm-7 white-bg  margin-topneg-15 pt-10">
                                <div class="theme-text f-14  p-15" style="padding-top: 5px;">
                                    <input type="text" class="form-control" value="0" name="points" min="1" required placeholder="Enter point to add" data-parsley-type="number">
                                    <input type="hidden"  name="user_id" value="{{$users->id}}">
                                </div>
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;" >
                                    <input type="text" class="form-control " value="" name="comments" required placeholder="Eg: Diwali Bonus">
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer p-15 ">
                        <div class="w-50">
                        </div>
                        <div class="w-50 text-right"><a class="white-text p-10" href="#">
                                <button  class="btn theme-bg white-text w-40" style="margin-bottom: 20px;">Submit</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="fullscreen-modal" id="redeem-wallet" >
            <div class="fullscreen-modal-body" role="document" style="width: 60% !important; transform: translateX(30%) !important;">
                <div class="modal-header">
                    <h5 class="modal-title  ml-4 pl-2" id="exampleModalLongTitle">Redeem Points</h5>
                    <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-new-order pt-4 mt-3 onboard-vendor-branch input-text-blue" action="{{route('admin.redeem_points')}}" data-next="refresh" data-redirect-type="hard"  data-url="{{route('customers')}}" data-alert="mega" method="POST" data-parsley-validate>
                    <div class="modal-body" style="padding: 10px 9px; margin-bottom: 0px !important;">
                        <div class="d-flex match-height row p-15 quotation-main pb-0" >
                            <div class="col-sm-4 secondg-bg margin-topneg-15 pt-10">
                                <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 15px;">
                                    Points
                                </div>
                                <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 15px;">
                                    Select Voucher
                                </div>
                                <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 15px;">
                                    Additional Comments
                                </div>
                            </div>
                            <div class="col-sm-7 white-bg  margin-topneg-15 pt-10">
                                <div class="theme-text f-14  p-15" style="padding-top: 5px;">
                                    <input type="text" class="form-control" value="0" name="points" min="1" required placeholder="Enter point to add" data-parsley-type="number">
                                    <input type="hidden"  name="user_id" value="{{$users->id}}">
                                </div>
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;" >
                                    <select name="voucher_id" class="form-control">
                                        <option value="">--Select--</option>
                                        @foreach($vouchers as $voucher)
                                        <option value="{{$voucher->id}}">{{$voucher->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="theme-text f-14  p-15" style="padding-top: 5px;">
                                    <input type="text" class="form-control" value="" name="comments" min="1" placeholder="Optional">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p-15 ">
                        <div class="w-50">
                        </div>
                        <div class="w-50 text-right"><a class="white-text p-10" href="#">
                                <button  class="btn theme-bg white-text w-40" style="margin-bottom: 20px;">Submit</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
