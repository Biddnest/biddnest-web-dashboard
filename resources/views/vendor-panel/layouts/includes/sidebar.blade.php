<div class="menu-sidebar">
    <div class="side-nav-bar">
        <div class="Brand-logo">
            <div class="brand-logo">
                <img src="{{ asset('static/images/192PX.png')}}"/>
            </div>
        </div>
        <br>

        <div class="nav-links" style="overflow-x: hidden;">
            <ul class="menu p-1">
                <li class="menu-item active-menu-item">
                    <a class="regular-nav" href="{{route('vendor.dashboard')}}">
                            <span class="side-nac-icon"><span class="icon-sidebar">
                                    <i class="">
                                        <img src="{{asset('static/vendor/images/Active.svg')}}" alt="">
                                    </i>
                                </span>
                            </span> Dashboard
                    </a>
                </li>

                @if(in_array(\App\Enums\RoleGroupEnums::$MODUlES['manage_bookings'], json_decode(\Illuminate\Support\Facades\Session::get("assign_module"))))
                    <li class="menu-item b-purple" data-toggle="#booking" href="#booking" role="button"
                        aria-expanded="false" aria-controls="Booking">
                        <a class="">
                            <span class="side-nac-icon">
                                <span class="icon-sidebar">
                                    <i class="">
                                        <img src="{{asset('static/vendor/images/Active 1.svg')}}" alt="">
                                    </i>
                                </span>
                            </span>Manage Bookings
                        </a>
                    </li>

                    <ul class="sub-menu booking" id="booking">
                        <li class="sub-menu-item  ">
                            <a href="{{route('vendor.bookings', ['type'=>"live"])}}">
                                <i class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i>
                                Manage Bookings
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="{{route('vendor.pastbookings', ['type'=>"past"])}}">
                                <i class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i>
                                Past Orders
                            </a>
                        </li>
                    </ul>
                @endif
                @if(in_array(\App\Enums\RoleGroupEnums::$MODUlES['manage_user_roles'], json_decode(\Illuminate\Support\Facades\Session::get("assign_module"))))
                    <li class="menu-item b-purple" data-toggle="#roles" href="#Roles" role="button" aria-expanded="false"
                        aria-controls="Vendors">
                        <a class="" href="{{route('vendor.managerusermgt', ['type'=>"admin"])}}">
                            <span class="side-nac-icon"><span class="icon-sidebar">
                                    <i class="">
                                        <img src="{{asset('static/vendor/images/Active 2.svg')}}" alt="">
                                    </i>
                                </span>
                            </span>Manage User Roles
                        </a>
                    </li>
                @endif
                @if(in_array(\App\Enums\RoleGroupEnums::$MODUlES['inventory_management'], json_decode(\Illuminate\Support\Facades\Session::get("assign_module"))))
                    <li class="menu-item b-purple" data-toggle="#inventory" href="#Inventory" role="button"
                        aria-expanded="false" aria-controls="Vendors">
                        <a class="" href="{{route('vendor.inventorymgt')}}">
                            <span class="side-nac-icon">
                                <span class="icon-sidebar">
                                    <i class="">
                                        <img src="{{asset('static/vendor/images/Active 3.svg')}}" alt="">
                                    </i>
                                </span>
                            </span>Inventory Management
                        </a>
                    </li>
                @endif
                @if(in_array(\App\Enums\RoleGroupEnums::$MODUlES['branches'], json_decode(\Illuminate\Support\Facades\Session::get("assign_module"))))
                    <li class="menu-item" data-toggle="" href="#Branches" role="button" aria-expanded="false"
                        aria-controls="Customer">
                        <a class="" href="{{route('vendor.branches')}}">
                            <span class="side-nac-icon">
                                <span class="icon-sidebar">
                                    <i class="">
                                        <img src="{{asset('static/vendor/images/Active 4.svg')}}" alt="">
                                    </i>
                                </span>
                            </span>Branches
                        </a>
                    </li>
                @endif
                @if(in_array(\App\Enums\RoleGroupEnums::$MODUlES['vehicle_management'], json_decode(\Illuminate\Support\Facades\Session::get("assign_module"))))
                    <li class="menu-item" data-toggle="" href="#VehicleManagement" role="button" aria-expanded="false"
                        aria-controls="Customer">
                        <a class="" href="{{route('vendor.vehicle')}}">
                            <span class="side-nac-icon">
                                <span class="icon-sidebar">
                                    <i class="">
                                        <img src="{{asset('static/vendor/images/Active 5.svg')}}" alt="">
                                    </i>
                                </span>
                            </span>Vehicle Management
                        </a>
                    </li>
                @endif
                @if(in_array(\App\Enums\RoleGroupEnums::$MODUlES['vendors_payout'], json_decode(\Illuminate\Support\Facades\Session::get("assign_module"))))
                    <li class="menu-item" data-toggle="" href="#VendorsPayout" role="button" aria-expanded="false"
                        aria-controls="Customer">
                        <a class="" href="{{route('vendor.payout')}}">
                            <span class="side-nac-icon">
                                <span class="icon-sidebar">
                                    <i class="">
                                        <img src="{{asset('static/vendor/images/Active 6.svg')}}" alt="">
                                    </i>
                                </span>
                            </span>Vendors Payout
                        </a>
                    </li>
                @endif
                @if(in_array(\App\Enums\RoleGroupEnums::$MODUlES['service_request'], json_decode(\Illuminate\Support\Facades\Session::get("assign_module"))))
                    <li class="menu-item" data-toggle="" href="#ServiceRequests" role="button" aria-expanded="false"
                        aria-controls="Customer">
                        <a class="" href="{{route('vendor.service_request')}}">
                            <span class="side-nac-icon">
                                <span class="icon-sidebar">
                                    <i class="">
                                        <img src="{{asset('static/vendor/images/Active 7.svg')}}" alt="">
                                    </i>
                                </span>
                            </span>Service Requests
                        </a>
                    </li>
                @endif
                @if(in_array(\App\Enums\RoleGroupEnums::$MODUlES['reports'], json_decode(\Illuminate\Support\Facades\Session::get("assign_module"))))
                    <li class="menu-item" data-toggle="" href="#Reports" role="button" aria-expanded="false"
                        aria-controls="Customer">
                        <a class="" href="{{route('vendor.reports')}}">
                            <span class="side-nac-icon">
                                <span class="icon-sidebar">
                                    <i class="">
                                        <img src="{{asset('static/vendor/images/Active 8.svg')}}" alt="">
                                    </i>
                                </span>
                            </span>Reports
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>











