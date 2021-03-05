
@extends('layouts.app')
@section('title') Categories @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="detail-onventory">
              
              <div class="d-flex  flex-row justify-content-between">
                <h3 class="page-head text-left p-4">Inventory Details
                </h3>
             
            </div>
            <div class="d-flex  flex-row justify-content-between">
              <div class="page-head text-left p-4 pt-0 pb-0">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"> Categories
                    </li>
                    <li class="breadcrumb-item"><a href="categories-subcategories.html"> Manage Categories</a></li>
                    
                    <li class="breadcrumb-item active" aria-current="page"> Categories
                    </li>
                  </ol>
                </nav>
              
              
              </div>
        
          </div>
              <!-- Dashboard cards -->
              <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
                <div class="col-lg-10">
                  <div class="card  h-auto p-0 pt-10">
                    <div class="border-bottom-2 p-10 mb-1">
                      <div class="header-wrap ">
                        <h3 class="f-18">Inventory Details </h3>
                        <div class="float-right">
                          <div class="">
                            <a href="{{route('create-inventories')}}" class="ml-1"> <i
                                class="fa fa-pencil p-1 cursor-pointer theme-text" aria-hidden="true"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="d-flex pt-10  row m-0">
                      <div class="col-sm-4  secondg-bg margin-topneg-15 pt-10">
                        <div class="upload-section p-20 ">
                          <img src="{{ asset('static/images/upload-image.svg')}}" alt="" />
                          <div class="ml-1">
                            <p class="f-14">Cupboard</p>
                            <p>Polycarbonate</p>
                          </div>
                        </div>
                        <div class="theme-text f-14 bold p-20">
                          Item ID
                        </div>
                        <div class="theme-text f-14 bold p-20">
                          Category ID
                        </div>
                        <div class="theme-text f-14 bold p-20">
                          Vendor ID
                        </div>
                        <div class="theme-text f-14 bold p-20">
                          Commission Rate
                        </div>
                        <div class="theme-text f-14 bold p-20">
                          Zone
                        </div>
                        <div class="theme-text f-14 bold p-20">
                          Transport Vehicle
                        </div>
                      </div>
                      <div class="col-sm-5 white-bg  margin-topneg-15 pt-10">
                        <label class="full-name p-20 theme-text">Status</label>
                        <span class="">

                          <div class="d-flex ml-3">
                            <div class="d-flex  flex-row small-switch margin-topneg-35">
                              <input type="checkbox" checked data-toggle="toggle" data-size="xs" data-width="110"
                                data-height="35" data-onstyle="outline-primary" data-offstyle="outline-secondary"
                                data-on="Active" data-off="Inactive" id="switch">
                              <!-- Button -->
                              <!-- <div class="theme-text f-20 mr-20">For me</div>
                  <label class="switch mr-20">
                      <input type="checkbox" id="switch">
                      <span class="slider"></span>
                    </label>
                    <div class="theme-text f-20 ">Book for others</div> -->
    
                            </div>

                        </span>
                      </div>
                      <div class="theme-text f-14 p-20">
                        IT1234445
                      </div>
                      <div class="theme-text f-14 p-20">
                        C1234098
                      </div>
                      <div class="theme-text f-14 p-20">
                        V0912374
                      </div>
                      <div class="theme-text f-14 p-20">
                        Bengaluru Urban
                      </div>
                      <div class="theme-text f-14 p-20">
                        KA03 B 1176
                      </div>
                      <div class="theme-text f-14 p-20">
                        Payment for BLR movers
                      </div>
                    </div>
                  </div>
                  <div class="d-flex border-top justify-content-center p-20">
                    <div class="">
                      <a class="white-text p-10" href="{{ route('inventories')}}">
                        <button class="btn theme-bg white-text my-0" style="width: 127px;
                              border-radius: 6px;">Back</button>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
</div>

@endsection