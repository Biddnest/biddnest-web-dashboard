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
                                >Vendor Banking Details</a>
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
                <form>
                    <div class="tab-content " id="myTabContent">
                        <!-- form starts -->
                        <div class="w-100">
                            <div class="tab-pane show" style="min-height: 50vh">
                                <table class="table  text-left p-0 theme-text mb-0 primary-table p-15">
                                    <thead class="secondg-bg p-0">
                                    <tr>
                                        <th scope="col" style="padding:14px">Category</th>
                                        <th scope="col" class="text-center" style="padding:14px">BP Economic</th>
                                        <th scope="col" class="text-center" style="padding:14px">BP Premium</th>
                                        <th scope="col" class="text-center" style="padding:14px">MP Economic</th>
                                        <th scope="col" class="text-center" style="padding:14px">MP Premium</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($subservices as $category)
                                            <tr class="tb-border">
                                                <td scope="row">
                                                    <span>{{ucwords($category->name)}}</span>
                                                    <input type="hidden" value="{{$category->id}}" name="subservice[][id]">
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center base-price">
                                                        <div class="currancy text-center">₹</div>
                                                        <div class="form-input table-input"><input type="number" class="form-control border-left" name="subservice[][bidnest][price][economy]" id="" placeholder="500"></div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center base-price">
                                                        <div class="currancy text-center">₹</div>
                                                        <div class="form-input table-input"><input type="number" class="form-control border-left" name="subservice[][bidnest][price][premium]" id="" placeholder="500"></div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center base-price">
                                                        <div class="currancy text-center">₹</div>
                                                        <div class="form-input table-input"><input type="number" class="form-control border-left" name="subservice[][market][price][economy]" id="" placeholder="500"></div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center base-price">
                                                        <div class="currancy text-center">₹</div>
                                                        <div class="form-input table-input"><input type="number" class="form-control border-left" name="subservice[][market][price][premium]" id="" placeholder="500"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    <tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex  justify-content-between flex-row  p-10 py-0" style="border-top: 1px solid #70707040;">
                        <div class="w-50"><a class="white-text p-10" href="{{route("onboard-edit-vendors", ['id'=>$id])}}">
                            <button class="btn theme-br theme-text w-30 white-bg">Back</button></a>
                        </div>
                        <div class="w-50 text-right">
                            <a class="white-text p-10" href="{{route("onboard-branch-vendors", ['id'=>$id])}}">
                            <button type="button" class="btn theme-bg theme-text w-30 white-bg">Next</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

