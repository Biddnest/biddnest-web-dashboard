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
                    <button class="btn theme-bg white-text w-10">Add Branch</button>
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
                                    <a class="nav-link p-15" href="{{route("onboard-edit-vendors", ['id'=>$id])}}">Edit Onboard Vendor</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="quotation" href="{{route("onboard-branch-vendors",['id'=> $id])}}">Add Branch</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="quotation" href="{{route("onboard-bank-vendors", ['id'=>$id])}}"
                                    >Vendor Banking Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active p-15" id="quotation" href="#"
                                    >Actions</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="quotation" href="{{route("onboard-userrole-vendors", ['id'=>$id])}}">Vendor Roles</a>
                                </li>
                            </ul>
                        </h3>
                    </div>
                    <div class="tab-content " id="myTabContent">
                        <!-- form starts -->
                        <div class="w-100">
                            <div class="tab-pane show text-center" style="min-height: 50vh">
                                <a class="white-text p-10" href="{{route("onboard-bank-vendors", ['id'=>$id])}}">
                                    <button type="button" class="btn theme-bg theme-text w-30 white-bg">Next</button></a>
                            </div>
                            <div class="d-flex  justify-content-between flex-row  p-10 py-0"
                                 style="border-top: 1px solid #70707040;">
                            </div>
                            <div class="w-100 text-right">

                            </div>
                        </div>
                    </div>
                    <div class="d-flex  justify-content-between flex-row  p-10 py-0" style="border-top: 1px solid #70707040;">
                        <div class="w-50"><a class="white-text p-10" href="{{route("onboard-edit-vendors", ['id'=>$id])}}">
                                <button class="btn theme-br theme-text w-30 white-bg">Back</button></a>
                        </div>
                        <div class="w-50 text-right">
                            <a class="white-text p-10" href="{{route("onboard-bank-vendors", ['id'=>$id])}}">
                                <button type="button" class="btn theme-bg theme-text w-30 white-bg">Next</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('modal')



@endsection
