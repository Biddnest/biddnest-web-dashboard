@extends('layouts.app')
@section('title') Vendor Management @endsection
@section('content')

<!-- Main Content -->
<div class="main-content grey-bg" data-barba="container" data-barba-namespace="lead">
                            <div class="d-flex  flex-row justify-content-between vertical-center">
                                <h3 class="page-head text-left p-4 f-20 theme-text">Vendor Management</h3>
                                <div class="mr-20">
                                    <a  href="{{ route('create-vendors')}}">
                                    <button class="btn theme-bg white-text"><i class="fa fa-plus p-1" aria-hidden="true"></i>ONBOARD VENDER</button>
                                </a>
                                </div>
                            </div>
                            <div class="d-flex  flex-row justify-content-between">
                                <div class="page-head text-left  pt-0 pb-0 p-2">
                                  <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('lead-vendors')}}">Vendor Management</a></li>
                                      <li class="breadcrumb-item">Leads</li>

                                    </ol>
                                  </nav>


                                </div>

                            </div>

                            <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
                                <div class="col-lg-12">
                                    <div class="card  h-auto p-0 pt-10">
                                        <div class="header-wrap ">
                                            <h3 class="f-18  pl-4" style="padding-left: 25px !important;">Leads</h3>
                                            <div class="p-1 card-head left col-sm-3" style="margin: 10px;">
                                                <div class="search ">
                                                    <input type="text" class="searchTerm table-search" data-url="{{route('lead-vendors')}}" placeholder="Search...">
                                                   <button type="submit" class="searchButton">
                                                     <i class="fa fa-search"></i>
                                                  </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="all-vender-details " >
                                            <table class="table text-center p-0 theme-text mb-0 primary-table">
                                                <thead class="secondg-bg  p-0">
                                                <tr>
                                                    <th scope="col" style="font-weight: 700;">Vendor Name</th>
                                                    <th scope="col" style="text-align: left; font-weight: 700;">Org Name</th>
                                                    <th scope="col" style="text-align: left; font-weight: 700;">Phone</th>
                                                    <th scope="col" style="text-align: left; font-weight: 700;">City</th>
                                                    <th scope="col" style="text-align: left; font-weight: 700;">Zone</th>
                                                    <th scope="col" style="font-weight: 700;">Operations</th>
                                                </tr>
                                                </thead>
                                                <tbody class="mtop-20">
                                                @foreach($vendors as $vendor)
                                                    <tr class="tb-border cursor-pointer org_{{$vendor->id}} sidebar-toggle" data-sidebar="{{ route('sidebar.vendors',['id'=>$vendor->id]) }}">
                                                        <td scope="row" style="text-align: left;">
                                                            @if(isset($vendor->vendor))
                                                                {{ucfirst(trans($vendor->vendor->fname))}} {{ucfirst(trans($vendor->vendor->lname))}}
                                                            @else
                                                                {{"NA"}}
                                                            @endif
                                                        </td>
                                                        <td style="text-align: left;">{{ucfirst(trans($vendor->org_name))}} {{$vendor->org_type}}</td>
                                                        <td style="text-align: left;">{{$vendor->phone}}</td>
                                                        <td style="text-align: left;">{{ucfirst(trans($vendor->city))}}</td>
                                                        <td style="text-align: left;">{{ucfirst(trans($vendor->zone_map->name)) ?? ''}}</td>
                                                        <td> <a  class = "inline-icon-button" href="{{route('onboard-edit-vendors', ["id"=>$vendor->id])}}"><i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i></a>
                                                            <a href="#" class="delete inline-icon-button" data-parent=".org_{{$vendor->id}}" data-confirm="Are you sure, you want delete this Organization permenently? You won't be able to undo this." data-url="{{route('vendor_delete',['id'=>$vendor->id])}}"><i class="icon dripicons-trash p-1" aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            @if(count($vendors)== 0)
                                                <div class="row hide-on-data">
                                                    <div class="col-md-12 text-center p-20">
                                                        <p class="font14"><i>. You don't have any Leads here.</i></p>
                                                    </div>
                                                </div>
                                            @endif
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

                                        </div>

                                    </div>

                                </div>

                            </div>




</div>

@endsection
