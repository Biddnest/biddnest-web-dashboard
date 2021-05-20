@extends('vendor-panel.layouts.frame')
@section('title') Branches @endsection
@section('body')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="branch">
        <div class="d-flex  flex-row justify-content-between vertical-center">
            <h3 class="page-head text-left p-4 f-20 theme-text">Branches</h3>
            <div class="mr-20">
                <a href="{{route('vendor.addbranch')}}">
                    <button class="btn theme-bg white-text"><i
                            class="icon dripicons-plus" height="15"></i>Add New Branch</button>
                </a>
            </div>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left  pt-0 pb-0 p-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Branches</a></li>
                    </ol>
                </nav>

            </div>
        </div>
        <div class="d-flex  flex-row justify-content-between Dashboard-lcards ">
            <div class="col-sm-12">
                <div class="card  h-auto  p-8 p-0">
                    <div class="header-wrap border-bottom p-15 pb-1">
                        <h3 class="f-18 mt-1 mb-4 f-weight-500">Your Branch Details</h3>
                    </div>
                    <div class=" d-flex  row p-15 justify-content-start">
                        <div class="col-sm-8 p-1 ml-3">
                            <div class="row pl-3 pb-0">
                                <div class="col-sm-4 branch-card">
                                    <p class="l-cap">Org Name</p>
                                    <p class="f-16 bold" style="font-weight: 500;">{{$home_branch->org_name}} {{$home_branch->org_type}}</p>
                                </div>
                                <div class="col-sm-3 branch-card">
                                    <p class="l-cap">Phone</p>
                                    <p class="f-16 bold" style="font-weight: 500;">+91-{{$home_branch->phone}}</p>
                                </div>
                                <div class="col-sm-3 branch-card">
                                    <p class="l-cap">Address</p>
                                    <p class="f-16 bold" style="font-weight: 500;">{{json_decode($home_branch->meta, true)['address']}}</p>
                                </div>
                                <div class="col-sm-2 branch-card">
                                    <p class="l-cap">City</p>
                                    <p class="f-16 bold" style="font-weight: 500;">{{$home_branch->city}}</p>
                                </div>
                            </div>
                        </div>
                        @if(\App\Helper::is("admin", true))
                            <div class="col-sm-4 p-1 text-right branch-icons">
                                <a href="{{route('vendor.editbranch', ['id'=>$home_branch->id])}}">
                                    <i class="p-1">
                                        <img src="{{asset('static/vendor/images/Icon material-edit.svg')}}">
                                    </i>
                                </a>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        <!-- Dashboard cards -->


        <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
            <div class="col-sm-12">
                <div class="card  h-auto  pt-8 p-0">
                    <div class="header-wrap toal-header">
                        <h3 class="f-18 mt-0 mb-0 ml-1">Branch Details</h3>
                        <div class="header-wrap p-0 ">
                            {{--<a href="#" class="margin-r-20" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                <i class="filter-dropdown "><img class="bg-grey-icon"
                                                                     src="{{asset('static/vendor/images/filter.svg')}}" alt="" srcset=""></i>

                            </a>--}}
                            <div class="search">
                                <input type="text" class="searchTerm table-search" data-url="{{route('vendor.branches')}}" placeholder="Search...">
                                <button type="submit" class="searchButton">
                                        <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="all-vender-details">
                       {{-- <div class="d-flex row  filter-menus diplay-none">
                            <div class="col-lg-4">
                                <div class="form-input">
                                    <select id="" class="form-control f-12">
                                        <option>Branch Name </option>
                                        <option>kolkata </option>
                                        <option>Mumbai</option>
                                    </select>
                                    <span class="error-message">Please enter valid
                                                        Phone number</span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-input">
                                    <span class="select-role">
                                        <select id="select-role" class="form-control">
                                            <option>City</option>
                                            <option>Chennai</option>
                                            <option>Vizag</option>
                                        </select>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-input">
                                    <span class="">
                                        <select id="" class="form-control">
                                            <option>Status</option>
                                            <option>Pending </option>
                                            <option>Awaiting Pickup</option>
                                            <option>Completed</option>
                                        </select>
                                        <span class="error-message">Please enter valid
                                                        Phone number</span>
                                    </span>
                                </div>
                            </div>

                        </div>--}}
                        <table class="table text-left p-0 theme-text mb-0 primary-table">
                            <thead class="secondg-bg p-0">
                            <tr>
                                <th scope="col" style="padding: 14px;">Branch Name</th>
                                <th scope="col" style="padding: 14px;">Phone Number</th>
                                <th scope="col" style="padding: 14px;">City</th>
                                <th scope="col" style="padding: 14px;" class="text-center">Status</th>
                                @if(\App\Helper::is("admin", true))<th scope="col" style="padding: 14px; text-align:center!important">Actions</th>@endif
                            </tr>
                            </thead>
                            <tbody class="mtop-20">
                                @foreach($branches as $branch)
                                    <tr class="tb-border cursor-pointer">
                                        <td style="padding: 16px 0px;">{{$branch->city}} @if(!$branch->parent_org_id) (Parent Branch) @endif</td>
                                        <td style="padding: 16px 0px;">+91-{{$branch->phone}}</td>
                                        <td style="padding: 16px 0px;">{{$branch->city}}</td>
                                        <td style="padding: 10px 0px;"class="text-center">
                                            @switch($branch->status)
                                                @case(\App\Enums\OrganizationEnums::$STATUS['lead'])
                                                <div class="status-badge light-bg light-bg">Lead</div>
                                                @break

                                                @case(\App\Enums\OrganizationEnums::$STATUS['active'])
                                                <div class="status-badge light-bg light-bg">Active</div>
                                                @break

                                                @case(\App\Enums\OrganizationEnums::$STATUS['suspended'])
                                                <div class="status-badge light-bg light-bg">Suspended</div>
                                                @break
                                            @endswitch
                                        </td>
                                        @if(\App\Helper::is("admin", true))
                                        <td style="padding: 16px 0px; text-align:center!important">
                                            <a href="{{route('vendor.editbranch', ['id'=>$branch->id])}}"><i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i></a>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if(count($branches)== 0)
                            <div class="row hide-on-data">
                                <div class="col-md-12 text-center p-20">
                                    <p class="font14"><i>. You don't have any Branches here.</i></p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="pagination mb-3 mt-4">
                    <ul>
                        <li class="p-1">Page</li>
                        <li class="digit">{{$branches->currentPage()}}</li>
                        <li class="f-16 ml-2 mr-2" style="transform: translate(0px, 4px);">Of</li>
                        <li class="digit">{{$branches->lastPage()}}</li>
                        @if(!$branches->onFirstPage())
                            <li class="button"><a href="{{$branches->previousPageUrl()}}"><img src="{{asset('static/images/Backward.svg')}}"></a>
                            </li>
                        @endif
                        @if($branches->currentPage() != $branches->lastPage())
                            <li class="button"><a href="{{$branches->nextPageUrl()}}"><img src="{{asset('static/images/forward.svg')}}"></a>
                            </li>
                        @endif
                    </ul>
                </div>
                </div>
              

            </div>

        </div>




    </div>
@endsection
