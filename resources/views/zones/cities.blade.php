@extends('layouts.app')
@section('title') Zones @endsection
@section('content')

<!-- Main Content -->
<div class="main-content grey-bg" data-barba="container" data-barba-namespace="zones">
                    <div class="d-flex  flex-row justify-content-between vertical-center">
                        <h3 class="page-head text-left p-4 f-20 theme-text">Zone Management</h3>
                        <div class="mr-20">
                            <a href="{{ route('create-cities')}}">
                                <button class="btn theme-bg white-text"><i class="fa fa-plus p-1"
                                        aria-hidden="true"></i>CREATE CITY</button>
                            </a>

                        </div>
                    </div>
                    <div class="d-flex  flex-row justify-content-between">
                        <div class="page-head text-left  pt-0 pb-0 p-2">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page">Zone Management</li>
                                    <li class="breadcrumb-item"><a href="#"> Manage Cities</a></li>

                                </ol>
                            </nav>


                        </div>

                    </div>


                    <div class="vender-all-details flex-row">
                        <div class="simple-card min-width-30">
                            <p>TOTAL NO OF CITIES</p>
                            <h1>{{$total}}</h1>
                        </div>
                        <div class="simple-card min-width-30">
                            <p>ACTIVE CITIES</p>
                            <h1>{{$active}}</h1>
                        </div>
                        <div class="simple-card min-width-30">
                            <p>INACTIVE CITIES</p>
                            <h1>{{$inactive}}</h1>
                        </div>


                    </div>
                    <!-- Dashboard cards -->


                    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
                        <div class="col-sm-12 pl-0 pr-0">
                            <div class="card  h-auto p-0 pt-10">
                                <div class="header-wrap">
                                    <div class="col-sm-8 p-3 ml-3">
                                        <h3 class="f-18 ml-2 mt-4">City Management </h3>

                                    </div>

                                    <div class="header-wrap p-0 col-sm-1"  style="display: flex; justify-content: flex-end;  margin-right: -28px;">
                                        <a href="#" class="margin-r-20 filter-icon" aria-haspopup="true"  aria-expanded="false"  data-toggle="collapse" data-target="#filter-menu">
                                            <i><img class="" src="{{asset('static/images/filter.svg')}}" alt="" srcset=""></i>
                                        </a>
                                    </div>
                                    <div class="card-head   left col-sm-3">
                                        <div class="search">
                                            <input type="text" class="searchTerm table-search" data-url="{{route('zones-city')}}" placeholder="Search...">
                                           <button type="submit" class="searchButton">
                                             <i class="fa fa-search"></i>
                                          </button>
                                        </div>
                                    </div>

                                </div>
                                <div class="all-vender-details">
                                    <div class="collapse" id="filter-menu">
                                        <a href="#" class="btn theme-bg white-text clear-filter" id="clear">Clear</a>
                                        <div class="row f-14">
                                            <div class="col">
                                                <label style="font-weight:500 !important;">State</label>
                                                <select id="state" class="form-control selectfilter" name="state" data-action="state" required>
                                                    <option value="">--select--</option>
                                                    <option value="Andhra Pradesh" >Andhra Pradesh</option>
                                                    <option value="Andaman and Nicobar Islands" >Andaman and Nicobar Islands</option>
                                                    <option value="Arunachal Pradesh" >Arunachal Pradesh</option>
                                                    <option value="Assam" >Assam</option>
                                                    <option value="Bihar" >Bihar</option>
                                                    <option value="Chandigarh" >Chandigarh</option>
                                                    <option value="Chhattisgarh" >Chhattisgarh</option>
                                                    <option value="Dadar and Nagar Haveli" >Dadar and Nagar Haveli</option>
                                                    <option value="Daman and Diu" >Daman and Diu</option>
                                                    <option value="Delhi">Delhi</option>
                                                    <option value="Lakshadweep" >Lakshadweep</option>
                                                    <option value="Puducherry" >Puducherry</option>
                                                    <option value="Goa" >Goa</option>
                                                    <option value="Gujarat" >Gujarat</option>
                                                    <option value="Haryana">Haryana</option>
                                                    <option value="Himachal Pradesh" >Himachal Pradesh</option>
                                                    <option value="Jammu and Kashmir" >Jammu and Kashmir</option>
                                                    <option value="Jharkhand" >Jharkhand</option>
                                                    <option value="Karnataka">Karnataka</option>
                                                    <option value="Kerala" >Kerala</option>
                                                    <option value="Madhya Pradesh" >Madhya Pradesh</option>
                                                    <option value="Maharashtra" >Maharashtra</option>
                                                    <option value="Manipur" >Manipur</option>
                                                    <option value="Meghalaya" >Meghalaya</option>
                                                    <option value="Mizoram" >Mizoram</option>
                                                    <option value="Nagaland" >Nagaland</option>
                                                    <option value="Odisha">Odisha</option>
                                                    <option value="Punjab" >Punjab</option>
                                                    <option value="Rajasthan">Rajasthan</option>
                                                    <option value="Sikkim">Sikkim</option>
                                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                                    <option value="Telangana" >Telangana</option>
                                                    <option value="Tripura" >Tripura</option>
                                                    <option value="Uttar Pradesh" >Uttar Pradesh</option>
                                                    <option value="Uttarakhand" >Uttarakhand</option>
                                                    <option value="West Bengal">West Bengal</option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label style="font-weight:500 !important;">Status</label>
                                                <select class="form-control br-5 selectfilter" name="status" data-action="status">
                                                    <option value="">--Select--</option>
                                                    @foreach(\App\Enums\CommonEnums::$STATUS as $key=>$status)
                                                        <option value="{{$status}}">{{ucfirst(trans($key))}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table text-left p-0 theme-text mb-0 f-14">
                                        <thead class="secondg-bg  p-0">
                                            <tr>
                                                <th scope="col">City Name</th>
                                                <th scope="col">State</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Operations</th>
                                            </tr>
                                        </thead>
                                        <tbody class="mtop-20 f-13">
                                        @foreach($cities as $city)
                                            <tr class="tb-border city_{{$city->id}}">
                                                <td scope="row" >{{$city->name}}</td>
                                                <td>{{$city->state}}</td>
                                                <td>
                                                    <input type="checkbox" {{($city->status == \App\Enums\CommonEnums::$YES) ? 'checked' : ''}}  class="change_status cursor-pointer changeclick" data-url="{{route('city_status_update',['id'=>$city->id])}}">
                                                </td>
                                                <td>
                                                    <a  class = "inline-icon-button mr-4"  href="{{route('edit-cities', ['id'=>$city->id])}}"><i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i></a>
                                                    <a href="#" class="delete inline-icon-button" data-parent=".city_{{$city->id}}" data-confirm="Are you sure, you want delete this City permenently? You won't be able to undo this." data-url="{{route('cities_delete',['id'=>$city->id])}}"><i class="icon dripicons-trash p-1" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                    @if(count($cities)== 0)
                                        <div class="row hide-on-data">
                                            <div class="col-md-12 text-center p-20">
                                                <p class="font14"><i>. You don't have any Cities added here.</i></p>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="pagination">
                                        <ul>
                                            <li class="p-1">Page</li>
                                            <li class="digit">{{$cities->currentPage()}}</li>
                                            <li class="label">of</li>
                                            <li class="digit">{{$cities->lastPage()}}</li>
                                            @if(!$cities->onFirstPage())
                                                <li class="button"><a href="{{$cities->previousPageUrl()}}"><img src="{{asset('static/images/Backward.svg')}}"></a>
                                                </li>
                                            @endif
                                            @if($cities->currentPage() != $cities->lastPage())
                                                <li class="button"><a href="{{$cities->nextPageUrl()}}"><img src="{{asset('static/images/forward.svg')}}"></a>
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
