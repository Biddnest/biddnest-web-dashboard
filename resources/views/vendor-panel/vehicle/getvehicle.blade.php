@extends('vendor-panel.layouts.frame')
@section('title') Vehicle Management @endsection
@section('body')
        <div class="main-content grey-bg" data-barba="container" data-barba-namespace="vehiclemgt">
            <div class="d-flex  flex-row justify-content-between">
                <h3 class="page-head text-left p-4">Vehicle Management </h3>

            </div>
            <div class="d-flex  flex-row justify-content-between">
                <div class="page-head text-left p-2 pt-0 pb-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Vehicle Management
                            </li>


                        </ol>
                    </nav>


                </div>

            </div>

            <!-- Dashboard cards -->


            <div class="d-flex flex-row  Dashboard-lcards  justify-content-center">
                <div class=" col-sm-12" >
                    <!-- <div class="d-flex  flex-row text-left">
                        <a href="zone-details.html" class="text-decoration-none">
                            <h3 class="page-subhead text-left p-4 f-20 theme-text">
                             <i class="p-1"> <img src="assets/images/Icon feather-chevrons-left.svg" alt="" srcset=""></i> Back to Zone Managment</h3></a>

                     </div> -->
                    <div class="card  h-auto p-0 pt-10 pb-0" >

                        <div class="d-flex row p-15 pb-0">
                            <form action="" >
                                <div class="col-lg-2">
                                    <div class="form-input">
                                        <label class="">Name  of vehicle</label>
                                        <span class="">
                                        <input type="text" id="fullname"
                                               placeholder="Tempo"
                                               class="form-control">
                                        <span class="error-message">Please enter valid
                                            First Name</span>
                                    </span>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-input">
                                        <label class="">Vehicle Number</label>
                                        <span class="">
                                        <input type="text" id="fullname"
                                               placeholder="XXXXX"
                                               class="form-control">
                                        <span class="error-message">Please enter valid
                                            First Name</span>
                                    </span>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-input">
                                        <label class="">Vehicle Type</label>
                                        <span class="">
                                        <input type="text" id="fullname"
                                               placeholder="XXXXX"
                                               class="form-control">
                                        <span class="error-message">Please enter valid
                                            First Name</span>
                                    </span>
                                    </div>
                                </div>
                                <div class="col-lg-2 mt-3">
                                <button class="btn">
                                    Save
                                </button>
                            </div>
                            </form>

                            <div class="col-sm-12">
                                <div class="heading p-8  ">
                                    List of Vehicle
                                </div>
                                <table class="table text-left p-10 theme-text tb-border2" id="items">

                                    <thead class="secondg-bg bx-shadowg p-0 f-14">
                                    <tr class="">
                                        <th scope="col">Vehicle Name</th>
                                        <th scope="col">Vehicle Number</th>
                                        <th scope="col">Vehicle Type</th>
                                        @if(\App\Helper::is("admin", true))
                                            <th scope="col" class="text-center">Actions</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody class="mtop-20 f-13">
                                        @foreach($vehicles as $vehicle)
                                            <tr class="">
                                                <th scope="row">{{ucwords($vehicle->name)}}</th>
                                                <td class="">{{strtoupper($vehicle->number)}}</td>
                                                <td class="">{{ucwords($vehicle->vehicle_type)}}</td>
                                                @if(\App\Helper::is("admin", true))
                                                    <td class="text-center"> <i class="icon dripicons-pencil  p-1 cursor-pointer" aria-hidden="true"></i>
                                                        <i class="icon dripicons-trash p-1 cursor-pointer" aria-hidden="true"></i>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    <tr id="addr1"></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-felx justify-content-start p-15 pt-0">
                                <button class="btn white-bg btn-padding">
                                    Cancel
                                </button>
                            </div>

                        </div>


                    </div>

                </div>

            </div>




        </div>
@endsection
