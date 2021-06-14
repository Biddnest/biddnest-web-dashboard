@extends('layouts.app')
@section('title') Sales Reports @endsection
@section('content')


<div class="main-content grey-bg" data-barba="container" data-barba-namespace="complaints" style="min-height: 90vh">
    <div class="d-flex  flex-row justify-content-between vertical-center">
        <h3 class="page-head text-left p-4 f-20 theme-text">Sales Report By Interval</h3>

    </div>
    <div class="d-flex  flex-row justify-content-between">
        <div class="page-head text-left p-2 pt-0 pb-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('report.summary')}}">Report</a></li>
                    <li class="breadcrumb-item">Sales Report</li>
                </ol>
            </nav>
        </div>
    </div>


    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
        <div class="col-sm-12 pr-0 pl-0">
            <div class="card  h-auto p-0 pt-10">
                <div class="header-wrap" >
                    <div class="col-sm-8 p-3 ">
                        <h3 class="f-18 ml-2 mt-3 ">Filter Report</h3 >
                    </div>
                </div>

                <form class="no-ajax ">
                    <div class="d-flex pl-1  filter-menus  mt-1">
                        <div class="col-lg-2" style="padding: 5px">
                            <div class="form-input">
                                <label class="">From</label>
                                <input type="text" class="form-control dateselect singledate" name="from" placeholder="Pick">
                            </div>
                        </div>
                        <div class="col-lg-2" style="padding: 5px">
                            <div class="form-input">
                                <label class="">To</label>
                                <input type="text" class="form-control dateselect singledate" name="to" placeholder="Pick">

                            </div>
                        </div>
                        <div class="col-lg-2" style="padding: 5px">
                            <div class="form-input">
                                <label class="">Organization</label>
                                <select id="" class="form-control searchvendor" name="religion[]">
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2" style="padding: 5px">
                            <div class="form-input">
                                <label class="">Zone</label>
                                <select id="" class="form-control " name="zone">
                                    <option value="all">All</option>
                                    @foreach($zones as $zone)
                                        <option value="{{$zone->id}}">{{$zone->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2" style="padding: 5px">
                            <div class="form-input">
                                <label class="">Service</label>
                                <select id="" class="form-control" name="service">
                                    <option value="all">All</option>
                                    @foreach($services as $service)
                                        <option value="{{$service->id}}">{{$service->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2" style="padding: 5px">
                            <div class="form-input">
                                <label class=""></label>
                                <button class="btn theme-bg white-text" type="submit">Filter</button>
                            </div>
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>


</div>

@endsection
