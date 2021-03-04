
    <div class="menu-sidebar">
        <div class="side-nav-bar">
            <div class="Brand-logo">
                <div class="brand-logo">
                    <img src="{{ asset('static/images/logo.png')}}" />
                </div>
            </div>
            <br>
            <div class="nav-links">
                <ul class="menu p-1">
                    <li class="menu-item active-menu-item">
                        <a class="regular-nav" href="{{ route('dashboard')}}">
                            <span class="side-nac-icon">
                                <span class="icon-sidebar"><i class="icon dripicons-meter "></i></span>
                            </span> Dashboard
                        </a>
                    </li>
                    <li class="menu-item b-purple" data-toggle="#booking" href="#Booking" role="button"
                            aria-expanded="false" aria-controls="Booking">
                        <a class=""><span class="side-nac-icon">
                            <span class="icon-sidebar"><i class="icon dripicons-to-do "></i></span></span> Booking & Orders
                        </a>
                    </li>
                    <ul class="sub-menu booking" id="booking">
                        <li class="sub-menu-item"><a href="{{ route('orders-booking')}}"><i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i>
                                    Booking & Orders</a></li>
                        <li class="sub-menu-item"><a href="{{ route('orders-booking')}}"><i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i>
                                    Create New Order</a></li>
                        <!-- <li class="sub-menu-item"><a href="edit-order.html"><i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i>
                                    Edit Order</a></li> -->
                    </ul>
                    <li class="menu-item b-purple" data-toggle="#vendors" href="#Vendors" role="button"
                            aria-expanded="false" aria-controls="Vendors"> <a class=""> <span class="side-nac-icon"><span class="icon-sidebar"><i class="icon dripicons-store "></i></span> </span> Vendors Management</a>
                    </li>
                    <!-- vendor sublink -->
                    <ul class="sub-menu vendor" id="vendors">
                        <li class="sub-menu-item"><a href="{{ route('vendors')}}"><i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i>Vendor
                                    Management</a></li>
                        <li class="sub-menu-item"><a href="{{ route('create-vendors')}}"><i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i> Onboard
                                    Vendor</a></li>
                        <li class="sub-menu-item"> <a href="{{ route('lead-vendors')}}"><i class="fa fa-dot-circle-o icons-space mr-2"
                                        aria-hidden="true"></i>
                                    Leads</a></li>
                        <li class="sub-menu-item"> <a href="{{ route('pending-vendors')}}"> <i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i>Pending
                                    Vendors</a></li>
                        <li class="sub-menu-item"> <a href="{{ route('verified-vendors')}}"><i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i> Verified
                                    Vendors</a></li>
                    </ul>
                    <li class="menu-item" data-toggle="" href="#Customer" role="button" aria-expanded="false"
                            aria-controls="Customer"> <a class=""> <span class="side-nac-icon"><span class="icon-sidebar"><i class="icon dripicons-user"></i></span> </span>Customer Management</a>
                    </li>
                    <!-- sublinks -->
                    <ul class="sub-menu" id="Customer">
                        <li class="sub-menu-item"><a href="{{ route('customers')}}"><i class="fa fa-dot-circle-o icons-space mr-2"
                                        aria-hidden="true"></i>Customers</a></li>
                        <li class="sub-menu-item"><a href="{{ route('create-customers')}}"> <i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i> Create
                                    Customer</a></li>
                        <!-- <li class="sub-menu-item"> <a href="Edit-customer.html"> <i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i>Edit Customer
                                    Details</a></li> -->
                    </ul>
                    <li class="menu-item" data-toggle="" href="#Categories" role="button" aria-expanded="false"
                            aria-controls="Categories"><a class=""> <span class="side-nac-icon"><span class="icon-sidebar"><i class="icon dripicons-view-thumb"></i></span> </span> Categories</a>
                    </li>
                    <!-- sublinks -->
                    <ul class="sub-menu" id="Categories">
                        <li class="sub-menu-item"><a href="{{ route('categories')}}"> <i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i>Categories</a>
                        </li>
                        <li class="sub-menu-item"><a href="{{ route('subcateories')}}"> <i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i>Subcategories
                                    </a></li>
                        <li class="sub-menu-item"> <a href="{{ route('inventories')}}"> <i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i>Inventory</a>
                        </li>
                    </ul>
                    <li class="menu-item" data-toggle="" href="#Coupons" role="button" aria-expanded="false"
                            aria-controls="Coupons"><a class=""> <span class="side-nac-icon"><span class="icon-sidebar"><i class="icon dripicons-ticket"></i></span> </span></i> Coupons & offers</a>
                    </li>
                    <!-- sublinks -->
                    <ul class="sub-menu" id="Coupons">
                        <li class="sub-menu-item"><a href="coupons.html"> <i class="fa fa-dot-circle-o icons-space mr-2"
                                        aria-hidden="true"></i>Coupons</a></li>
                        <li class="sub-menu-item"><a href=" create-coupons.html"> <i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i> Create
                                    Coupons</a></li>
                        <li class="sub-menu-item"> <a href="edit-coupons.html"> <i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i>Edit Coupons</a>
                        </li>
                    </ul>
                    <li class="menu-item" data-toggle="" href="#Zone" role="button" aria-expanded="false"
                            aria-controls="Zone"><a class=""> <span class="side-nac-icon"><span class="icon-sidebar"><i class="icon dripicons-location "></i></span> </span> Zone Managment</a>
                    </li>
                    <!-- sublinks -->
                    <ul class="sub-menu" id="Zone">
                        <li class="sub-menu-item"><a href="zones.html"> <i class="fa fa-dot-circle-o icons-space mr-2"
                                        aria-hidden="true"></i>Zones</a></li>
                        <li class="sub-menu-item"><a href=" create-zones.html"> <i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i> Create Zones</a>
                        </li>
                        <li class="sub-menu-item"> <a href="edit-zones.html"> <i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i>Edit Zone</a></li>
                    </ul>
                    <li class="menu-item" data-toggle="" href="#Sliders" role="button" aria-expanded="false"
                            aria-controls="Sliders"><a class=""><span class="side-nac-icon"><span class="icon-sidebar"><i class="icon dripicons-photo-group"></i></span> </span> Sliders & Banners</a>
                    </li>
                    <!-- sublinks -->
                    <ul class="sub-menu" id="Sliders">
                        <li class="sub-menu-item"><a href="Sliders-Banners.html"> <i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i>Sliders &
                                    Banners</a></li>
                        <li class="sub-menu-item"><a href="Push-Notifications.html"> <i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i>PushNotifications & Messages</a>
                        </li>
                        <li class="sub-menu-item"> <a href="testimonials.html"> <i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i>Testimonials</a>
                        </li>
                    </ul>
                    <li class="menu-item"><a class="regular-nav"> <span class="side-nac-icon"><span class="icon-sidebar"><i class="icon dripicons-graph-pie"></i></span> </span> Reports</a></li>

                    <li class="menu-item" data-toggle="" href="#reviews" role="button" aria-expanded="false"
                            aria-controls="Reviews"><a class=""><span class="side-nac-icon"><span class="icon-sidebar"><i class="icon dripicons-star"></i></span> </span>Reviews & Ratings</a>
                    </li>
                    <ul class="sub-menu" id="reviews">
                        <li class="sub-menu-item"><a href="Reviews.html"> <i class="fa fa-dot-circle-o icons-space mr-2"
                                        aria-hidden="true"></i>Reviews</a></li>
                        <li class="sub-menu-item"><a href="complaints.html"> <i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i> Complaints</a>
                        </li>
                        <li class="sub-menu-item"> <a href="service-requests.html"> <i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i>Service
                                    Requests</a></li>
                    </ul>
                    <li class="menu-item" data-toggle="" href="#Payout" role="button" aria-expanded="false"
                            aria-controls="Payout"><a class=""> <span class="side-nac-icon"><span class="icon-sidebar"><i class="icon dripicons-wallet"></i></span> </span> Vendors Payout</a>
                    </li>
                    <!-- sublinks -->
                    <ul class="sub-menu" id="Payout">
                        <li class="sub-menu-item"><a href="vendor-payout.html"> <i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i>Vendor Payout</a>
                        </li>
                        <li class="sub-menu-item"><a href="create-vendors-payout.html"> <i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i> Create Payout</a>
                        </li>
                        <li class="sub-menu-item"> <a href="edit-payout.html"> <i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i>Edit Payout</a>
                        </li>
                    </ul>
                    <li class="menu-item" data-toggle="" href="#Users" role="button" aria-expanded="false"
                            aria-controls=" Users"><a class=""> <span class="side-nac-icon"><span class="icon-sidebar"><i class="icon dripicons-user-group"></i></span> </span> Users & Roles</a>
                    </li>
                    <!-- sublinks -->
                    <ul class="sub-menu" id="Users">
                        <li class="sub-menu-item"><a href="users-roles.html"> <i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i>Users Roles</a>
                        </li>
                        <li class="sub-menu-item"><a href="Add-New-Users.html"> <i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i> Add New Users</a>
                        </li>
                        <li class="sub-menu-item"> <a href="edit-users.html"> <i
                                        class="fa fa-dot-circle-o icons-space mr-2" aria-hidden="true"></i>Edit-users</a>
                        </li>
                    </ul>
                </ul>
            </div>
        </div>
    </div>
