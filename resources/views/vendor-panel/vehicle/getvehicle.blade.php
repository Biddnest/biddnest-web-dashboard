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
                        <form action="@if(!$exist_vehicle){{route('api.vehicle.create')}}@else{{route('api.vehicle.update')}}@endif" method="@if(isset($exist_vehicle)){{"PUT"}}@else{{"POST"}}@endif" data-next="redirect" data-redirect-type="hard" data-url="{{route('vendor.vehicle')}}" data-alert="tiny" class="form-new-order pt-1 mt-0 input-text-blue" id="myForm" data-parsley-validate >
                            <div class="d-flex row p-15 pb-0">
                                <div class="" >
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-input">
                                        @if($exist_vehicle)
                                            <input type="hidden" value="{{$exist_vehicle->id}}" name="id">
                                        @endif
                                        <label class="">Name of vehicle</label>
                                        <input type="text" id="fullname" name="name"
                                                   placeholder="Tempo" value="{{$exist_vehicle->name ?? ''}}"
                                                   class="form-control">
                                        <span class="error-message">Please enter valid
                                                Vehicle Name</span>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-input">
                                        <label class="">Vehicle Number</label>
                                        <input type="text" id="fullname" name="number"
                                                   placeholder="XXXXX" value="{{$exist_vehicle->number ?? ''}}"
                                                   class="form-control">
                                        <span class="error-message">Please enter valid
                                                Vehicle Number</span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-input">
                                        <label class="">Vehicle Type</label>
                                        <input type="text" id="fullname" name="type"
                                                   placeholder="XXXXX" value="{{$exist_vehicle->vehicle_type ?? ''}}"
                                                   class="form-control">
                                        <span class="error-message">Please enter valid
                                                        Vehicle Type/span>
                                    </div>
                                </div>
                                <div class="col-lg-2 mt-4">
                                    <button class="btn">
                                        Save
                                    </button>
                                </div>
                            <div class="col-sm-12">
                                <div class="heading p-8 pl-0 ">
                                    List of Vehicle
                                </div>
                                <table class="table text-left p-10 theme-text tb-border2" id="items">

                                    <thead class="secondg-bg bx-shadowg p-0 f-14">
                                    <tr class="">
                                        <th scope="col" style="padding: 14px;">Vehicle Name</th>
                                        <th scope="col" style="padding: 14px;">Vehicle Number</th>
                                        <th scope="col" style="padding: 14px;">Vehicle Type</th>
                                        @if(\App\Helper::is("admin", true))
                                            <th scope="col" style="padding: 14px;" class="text-center">Actions</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody class="mtop-20 f-13">
                                        @foreach($vehicles as $vehicle)
                                            <tr class="vehicle_{{$vehicle->id}}">
                                                <th scope="row" style="padding: 14px;">{{ucwords($vehicle->name)}}</th>
                                                <td class="" style="padding: 14px;">{{strtoupper($vehicle->number)}}</td>
                                                <td class="" style="padding: 14px;">{{ucwords($vehicle->vehicle_type)}}</td>
                                                @if(\App\Helper::is("admin", true))
                                                    <td class="text-center" style="padding: 14px;">
                                                        <a  class = "inline-icon-button"  href="{{route('vendor.edit_vehicle', ['id'=>$vehicle->id])}}"><i class="icon dripicons-pencil  p-1 cursor-pointer" aria-hidden="true"></i></a>
                                                        <a href="#" class="delete inline-icon-button" data-parent=".vehicle_{{$vehicle->id}}" data-confirm="Are you sure, you want delete this Vehicle permenently? You won't be able to undo this." data-url="{{route('api.vehicle.delete',['id'=>$vehicle->id])}}"><i class="icon dripicons-trash p-1 cursor-pointer" aria-hidden="true"></i></a>
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

                        </form>
                    </div>

                </div>

            </div>




        </div>
@endsection
