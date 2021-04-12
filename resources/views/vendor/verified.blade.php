@extends('layouts.app')
@section('title') Vendor Management @endsection
@section('content')

 <!-- Main Content -->
 <div class="main-content grey-bg" data-barba="container" data-barba-namespace="verify">
                            <div class="d-flex  flex-row justify-content-between vertical-center">
                                <h3 class="page-head text-left p-4 f-20 theme-text">Vendor Management</h3>
                                <div class="mr-20">
                                    <a href="{{ route('create-vendors')}}">
                                        <button class="btn theme-bg white-text"><i class="fa fa-plus p-1"
                                            aria-hidden="true"></i>ONBOARD VENDER</button>
                                       </a>
                                </div>
                            </div>
                            <div class="d-flex  flex-row justify-content-between">
                                <div class="page-head text-left  pt-0 pb-0 p-2">
                                  <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active" aria-current="page">Vendor Management</li>
                                      <li class="breadcrumb-item"><a href="#"> Verified Vendors
                                    </a></li>

                                    </ol>
                                  </nav>


                                </div>

                            </div>


                            <!-- Dashboard cards -->


                            <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
                                <div class="col-lg-12">
                                    <div class="card  h-auto p-0 pt-10 ">
                                        <div class="header-wrap pl-10">
                                            <h3 class="f-18 pl-3">Verified Vendors</h3 >
                                            <div class="p-1 card-head left col-sm-3">
                                                    <div class="search">
                                                       <input type="text" class="searchTerm" placeholder="Search...">
                                                       <button type="submit" class="searchButton">
                                                         <i class="fa fa-search"></i>
                                                      </button>
                                                    </div>
                                            </div>
                                        </div>
                                        <!-- <div class="all-vender-details"> -->
                                            <table class="table text-left p-10 theme-text th-no-border">
                                                <thead class="secondg-bg  p-0">
                                                    <tr>
                                                        <th scope="col">Vendor Name</th>
                                                        <th scope="col">Org Name</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Phone</th>
                                                        <th scope="col">Vendor Type</th>
                                                        <th scope="col">Operations</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="mtop-20 text-left">
                                                @foreach($vendors as $vendor)
                                                    <tr class="tb-border cursor-pointer" >
                                                        <td scope="row">{{ucfirst(trans($vendor->vendor->fname)) ?? "NA"}} {{ucfirst(trans($vendor->vendor->lname)) ?? ""}}</td>
                                                        <td>{{ucfirst(trans($vendor->org_name))}} {{$vendor->org_type}}</td>
                                                        <td>{{$vendor->email}}</td>
                                                        <td class="">+91-{{$vendor->phone}}</td>
                                                        <td>{{ucfirst(trans($vendor->service_type))}}</td>
                                                        <td>
                                                            <a href="{{route('onboard-edit-vendors', ["id"=>$vendor->id])}}"><i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i></a>
                                                            <a href="#" class="delete" data-parent="tb-border" data-url="{{route('vendor_delete',['organization_id'=>$vendor->id])}}"><i class="icon dripicons-trash p-1" aria-hidden="true"></i></a>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>

                                            </table>
                                            <div class="pagination">
                                                <ul>
                                                    <li class="p-1">Page</li>
                                                    <li class="digit">{{$vendors->currentPage()}}</li>
                                                    <li class="label">of</li>
                                                    <li class="digit">{{$vendors->lastPage()}}</li>
                                                    @if(!$vendors->onFirstPage())
                                                        <li class="button"><a href="{{$vendors->previousPageUrl()}}"><img src="{{asset('static/images/Backward.svg')}}"></a>
                                                        </li>
                                                    @endif
                                                    @if($vendors->currentPage() != $vendors->lastPage())
                                                        <li class="button"><a href="{{$vendors->nextPageUrl()}}"><img src="{{asset('static/images/forward.svg')}}"></a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        <!-- </div> -->
                                    </div>

                                </div>

                            </div>




</div>

@endsection
