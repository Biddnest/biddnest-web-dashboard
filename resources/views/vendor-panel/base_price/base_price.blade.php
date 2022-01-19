@extends('vendor-panel.layouts.frame')
@section('title') Base Prices @endsection
@section('body')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="branch">
        <div class="d-flex  flex-row justify-content-between vertical-center">
            <h3 class="page-head text-left p-4 f-20 theme-text">Base Prices</h3>
            <div class="mr-20">
                <!-- <a href="{{route('vendor.addbranch')}}">
                    <button class="btn theme-bg white-text"><i
                            class="icon dripicons-plus" height="15"></i>Add New Branch</button>
                </a> -->
            </div>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left  pt-0 pb-0 p-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Base Prices</a></li>
                    </ol>
                </nav>

            </div>
        </div>
        <div class="d-flex  flex-row justify-content-between Dashboard-lcards ">
            <div class="col-sm-12">
                <div class="card  h-auto  p-8 p-0">
                    <div class="header-wrap border-bottom p-15 pb-1">
                        <h3 class="f-18 mt-1 mb-4 f-weight-500">Your Base Prices</h3>
                    </div>
                    <div class=" d-flex  row p-15 justify-content-start">
                        <div class="col-sm-12 p-1 ml-3">
                          <div class="tab-pane show" style="min-height: 50vh">

                              @foreach($prices as $price)
                              <div class="branch-wrapper price_{{$price->id}}">
                                  <div class="branch-snip d-flex flex-row justify-content-around">
                                      <div class="data-group border-right" style="min-width: 18%">
                                          <h1 style="font-size: 18px;text-align: center">{{$price->subservice->name}}</h1>
                                          <!-- <p style="text-align: center; color: #2E0789"><i class="icon dripicons-document-edit" style="font-size: 10px"></i><span class="cursor-pointer modal-toggle" data-target="#price_{{$price->id}}" style="color: #2E0789"> change</span></p> -->
                                      </div>
                                      <div class="data-group">
                                          <h5 style="font-size: 14px;">Market Price Economic</h5>
                                          <p>&#8377; {{ $price->mp_economic  }}</p>

                                          <br />
                                          <h5 style="font-size: 14px;">Biddnest Price Economic</h5>
                                          <p>&#8377; {{ $price->bp_economic  }}</p>
                                      </div>
                                      <div class="data-group">
                                          <h5 style="font-size: 14px;">Market Price Premium</h5>
                                          <p>&#8377; {{ $price->mp_premium }}</p>

                                          <br />
                                          <h5 style="font-size: 14px;">Biddest Price Premium</h5>
                                          <p>&#8377; {{ $price->bp_premium }}</p>
                                      </div>
                                      <div class="data-group">
                                          <h5 style="font-size: 14px;">Add. Market Price Economic</h5>
                                          <p>&#8377; {{ $price->mp_additional_distance_economic_price }}</p>

                                          <br />
                                          <h5 style="font-size: 14px;">Add. Biddnest Price Economic</h5>
                                          <p>&#8377; {{ $price->bp_additional_distance_economic_price }}</p>
                                      </div>
                                      <div class="data-group">

                                          <h5 style="font-size: 14px;">Add. Market Price Premium</h5>
                                          <p>&#8377; {{ $price->mp_additional_distance_premium_price }}</p>

                                          <br />
                                          <h5 style="font-size: 14px;">Add. Biddnest Price Premium</h5>
                                          <p>&#8377; {{ $price->bp_additional_distance_premium_price }}</p>

                                      </div>
                                  </div>
                              </div>
                              @endforeach
                          </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>



    </div>
@endsection
