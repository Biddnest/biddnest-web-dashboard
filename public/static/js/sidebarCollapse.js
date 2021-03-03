       /* const mainMenuItems = [
            { title: "Dashboard", url: "index.html", type: "None Expandable" },
            { title: "Reports", url: "reports.html", type: "None Expandable" },
            { title: "Booking & Orders", type: "Expandable" },
            { title: "Reviews & Ratings", type: "Expandable" },
            { title: "Vendors Management", type: "Expandable" },
            { title: "Customer Management", type: "Expandable" },
            { title: "Categories", type: "Expandable" },
            { title: "Zone Managment", type: "Expandable" },
            { title: "Sliders & Banners", type: "Expandable" },
            { title: "Vendors Payout", type: "Expandable" },
            { title: "Users & Roles", type: "Expandable" }
        ]

        const subMenuItems = [
            { title: "Booking & Orders", url: "booking-orders.html" },
            { title: "Create New Order", url: "Create-new-order.html" },
            { title: "Edit Order", url: "edit-order.html" },
            { title: "Vendor Management", url: "vendor-management.html" },
            { title: "Onboard Vendor", url: "onboard-vendor.html" },
            { title: "Pending Vendors", url: "pending-vendors.html" },
            { title: "Verified Vendors", url: "verified-vendors.html" },
            { title: "Customers", url: "customers.html" },
            { title: "Create Customer", url: "add-new-customer.html" },
            { title: "Edit Customer Details", url: "Edit-customer.html" },
            { title: "Categories", url: "categories-subcategories.html" },
            { title: "Create Category", url: "create-categories-subcategories.html" },
            { title: "Edit Details", url: "edit-details-category.html" },
            { title: "Coupons", url: "coupons.html" },
            { title: "Create Coupons", url: "create-coupons.html" },
            { title: "Edit Coupons", url: "edit-coupons.html" },
            { title: "Zones", url: "zones.html" },
            { title: "Create Zones", url: "create-zones.html" },
            { title: "Edit Zone", url: "edit-zones.html" },
            { title: "Sliders & Banners", url: "Sliders-Banners.html" },
            { title: "Notifications", url: "Push-Notifications.html" },
            { title: "Testimonials", url: "testimonials.html" },
            { title: "General Settings", url: "general-settings.html" },
            { title: "Reviews", url: "Reviews.html" },
            { title: "Complaints", url: "complaints.html" },
            { title: "Service Requests", url: "service-requests.html" },
            { title: "Vendor Payout", url: "vendor-payout.html" },
            { title: "Create Payout", url: "create-vendors-payout.html" },
            { title: "Edit Payout", url: "edit-payout.html" },
            { title: "Users Roles", url: "users-roles.html" },
            { title: "Add New Users", url: "Add-New-Users.html" },
            { title: "Edit-users", url: "edit-users.html" },
        ]

       $("body").on("click",".menu-item",function (e) {
            var clickedItem = e.currentTarget.innerText.trim()

            for(var i = 0; i < mainMenuItems.length; i++) {
                if (mainMenuItems[i].title === clickedItem && mainMenuItems[i].type === "None Expandable") {
                    // window.location.assign(mainMenuItems[i].url);

                } else {
                    if ($(this).next("ul").hasClass("show")){
                        $(this).next("ul").slideUp(200).toggle();
                    }
                        else{
                            // $(".sub-menu").not("." +$(this).data("menu")).slideUp(200).toggle();
                            // setTimeout(() => {
                                $(this).next("ul").slideDown(200).toggle();

                            // }, 1000);


                        // if(){

                        // }


                        }
                    }
                }
            }
        );*/

        $("body").on("click",".sub-menu-item",function (e) {
            var clickedItem = e.currentTarget.innerText.trim()

            for(var i = 0; i < subMenuItems.length; i++) {
                if (subMenuItems[i].title === clickedItem ) {
                    // window.location.assign(subMenuItems[i].url);
                }
            }
        });
