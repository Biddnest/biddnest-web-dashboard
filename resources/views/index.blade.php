@extends('layouts.app')

@section('content')

 <!-- Main Content -->
 <div class="main-content grey-bg" data-barba="container" data-barba-namespace="dashboard">
    <h3 class="page-head text-left p-4 f-20">Dashboard
        <i class="icon dripiconmeter"></i>
    </h3>
    <div class="d-flex  flex-row justify-content-between">
        <div class="page-head text-left  pt-0 pb-0 p-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Last login at</li>
                    <li class="breadcrumb-item"><a href="#">11:55:02 AM</a></li> 
                </ol>
            </nav> 
        </div>
    </div>
    <!-- Dashboard cards -->
    <div class="vender-all-details dashboard-cards flex-row">
        <div class="simple-card">
            <p>ORDER</p>
            <h1>3,459</h1>
        </div>
        <div class="simple-card">
            <p>VENDORS</p>
            <h1>865</h1>
        </div>
        <div class="simple-card">
            <p>USERS</p>
            <h1>2,594</h1>
        </div>
        <div class="simple-card">
            <p>ZONES</p>
            <h1>2,594</h1>
        </div>
        <div class="simple-card">
            <p>LIVE ORDERS</p>
            <h1>2,248</h1>
        </div>
        <div class="simple-card">
            <p>SALES</p>
            <h1>2,248</h1>
        </div>
    </div>
    <!--  dashboard Columns -->
    <div class="d-flex flex-row justify-content-between Dashboard-lcards">
        <div class="col-sm-8 p-0">
            <div class="card p-10">
                <div class="d-flex flex-row justify-content-between">
                    <div class="p-10 card-head right text-left">
                        <h3 class="f-18">Recent Orders</h3>
                    </div>
                    <div class="p-10 card-head left">
                        <a><i><img src="{{asset('static/images/filter.svg') }}" alt="" srcset=""></i>
                        <div class="dropdown-menu">
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="total-no-orders">
                                    <label class="form-check-label" for="total-no-orders">
                                            Total no of orders
                                    </label>
                                </div>
                            </a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="status">
                                    <label class="form-check-label" for="status">
                                        Status
                                    </label>
                                </div>
                            </a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="city">
                                    <label class="form-check-label" for="city">
                                        City
                                    </label>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <table class="table text-center p-0">
                    <thead class="secondg-bg border-none p-0">
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Order Status</th>
                            <th scope="col">Time Left</th>
                            <th scope="col">Order Amount</th>
                        </tr>
                    </thead>
                    <tbody class="mtop-20">
                        <tr class="tb-border cursor-pointer " onclick="$('#dashboard').toggleClass('display-pop-up');">
                            <th scope="row" style="text-decoration: underline;"> SKU123456</th>
                            <td class=""><span class=" text-center status-badge ">Awaiting Pickup
                                                </span></td>
                            <td class="text-center">0:03:02</td>
                            <td class="text-center">₹2,300</td>
                        </tr>
                        <tr class="tb-border cursor-pointer"   onclick="$('#dashboard').toggleClass('display-pop-up');"  >
                            <th scope="row" style="text-decoration: underline;">SKU123456</th>
                            <td class=""><span class=" text-center status-badge light-bg">Bidding</span>
                            </td>
                            <td>0:03:02</td>
                            <td>₹2,300</td>
                        </tr>
                        <tr class="tb-border cursor-pointer"   onclick="$('#dashboard').toggleClass('display-pop-up');"             >  
                            <th scope="row"  style="text-decoration: underline;">SKU123456</th>
                            <td class=""><span class="  text-center status-badge red-bg ">Bounce Order</span>
                            </td>
                            <td>0:03:02</td>
                            <td>₹2,300</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
         <div class="col-sm-4 p-0">
            <div class="d-flex card ">
                <div class="p-10 ">
                    <h3 class="f-18">Live Orders Distribution</h3>
                </div>
                <div class="canvas-con">
                    <div class="total-user">Orders</div>
                        <div class="canvas-con-inner">
                            <canvas id="mychart" height="150px" width="150px" ></canvas>
                        </div>
                        <div id="my-legend-con" class="legend-con"></div>
                    </div>                            
                </div>
            </div>
        </div>
        <div class="d-flex h-auto  Dashboard-lcards">
            <div class="col-sm-8 h-auto p-0">
                <div class="d-flex  card ">
                    <div class="p-10 d-flex justify-content-between ">
                        <h3 class="f-18">Revenue Trend</h3>
                        <div class="d-flex ">
                            <div class="d-felx flex-column ml-20">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle btn-dropdown mr-0 ml-10 Weekly"
                                                    type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    Weekly
                                    </button>
                                    <div class="dropdown-menu bx-rev" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Monthly</a>
                                        <a class="dropdown-item" href="#">Daily</a>
                                        <a class="dropdown-item" href="#">Weekly</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="revenue-chart">
                        <canvas id="myRevenueChart" height="230px" width="700px"></canvas> 
                    </div>
                </div>
            </div>
            <div class="col-sm-4 p-0">
                <div class="d-flex justify-content-between  card ">
                    <div class="p-10 card-head">
                        <h3 class="f-18">Users by Zones</h3>
                    </div>
                    <!-- <div id="myzonechart" class="chart--container"> -->
                </div>
            </div>
        </div>
    </div>
</div>




@endsection