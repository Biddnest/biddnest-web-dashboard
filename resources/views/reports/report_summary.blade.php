@extends('layouts.app')
@section('title') Reports - Summary @endsection
@section('content')


<div class="main-content grey-bg" data-barba="container" data-barba-namespace="complaints">
    <div class="d-flex  flex-row justify-content-between vertical-center">
        <h3 class="page-head text-left p-4 f-20 theme-text">Report Summary</h3>
        <div class="mr-20">
            <span>Updated {{\Carbon\Carbon::parse($report->created_at)->diffForHumans()}}</span>
        </div>
    </div>
    <div class="d-flex  flex-row justify-content-between">
        <div class="page-head text-left p-2 pt-0 pb-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('report.summary')}}">Report</a></li>
                    <li class="breadcrumb-item">Summary</li>
                </ol>
            </nav>
        </div>
    </div>


    <div class="vender-all-details">
        <div class="simple-card min-width-30">
            <p>LEAD TO OPPORTUNITY</p>
            <h1>{{number_format($report->avg_lead_to_opportunity,2)}}%</h1>
        </div>
        <div class="simple-card min-width-30">
            <p>OPPORTUNITY TO ORDER</p>
            <h1>{{number_format($report->avg_opportunity_to_order, 2)}}%</h1>
        </div>
        <div class="simple-card min-width-30">
            <p>AVG ORDER VALUE</p>
            <h1>&#8377;{{number_format($report->avg_order_value,2)}}</h1>
        </div>
    </div>

    <div class="vender-all-details">
        <div class="simple-card min-width-30">
            <p>AVG REVENUE PER CUSTOMER</p>
            <h1>&#8377;{{number_format($report->avg_revenue_per_customer,2 )}}</h1>
        </div>
        <div class="simple-card min-width-30">
            <p>AVG FRT IN MINS</p>
            <h1>{{number_format($report->avg_opportunity_to_order,2)}}</h1>
        </div>
        <div class="simple-card min-width-30">
            <p>AVG CSAT</p>
            <h1>{{number_format($report->avg_order_value,2)}}</h1>
        </div>
    </div>

</div>

@endsection
