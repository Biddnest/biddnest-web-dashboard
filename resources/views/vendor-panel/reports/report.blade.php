@extends('vendor-panel.layouts.frame')
@section('title') Reports @endsection
@section('body')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="reports">
        <div class="d-flex  flex-row justify-content-between vertical-center">
            <h3 class="page-head text-left p-4 f-20 theme-text">Reports</h3>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left p-2 pt-0 pb-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('report.summary')}}">Report</a></li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="vender-all-details">
            <div class="simple-card min-width-30">
                <p>Number of orders won</p>
                <h1>{{$reports['won']}}</h1>
            </div>
            <div class="simple-card min-width-30">
                <p>OPPORTUNITY TO ORDER</p>
                <h1>{{$reports['lost']}}</h1>
            </div>
            <div class="simple-card min-width-30">
                <p>AVG ORDER VALUE</p>
                <h1>{{$reports['participated']}}</h1>
            </div>
        </div>
    </div>

@endsection
