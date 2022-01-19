/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */
$.delete = function(url, data, callback, type) {
    if ($.isFunction(data)) {
        type = type || callback,
            callback = data,
            data = {}
    }
    return $.ajax({
        url: url,
        type: 'DELETE',
        success: callback,
        data: data,
        contentType: type
    });
}

$.update = function(url, data, callback, type) {
    if ($.isFunction(data)) {
        type = type || callback,
            callback = data,
            data = {}
    }
    return $.ajax({
        url: url,
        type: 'PUT',
        success: callback,
        data: data,
        contentType: type
    });
}

$.add = function(url, data, callback, type) {
    if ($.isFunction(data)) {
        type = type || callback,
            callback = data,
            data = {}
    }
    return $.ajax({
        url: url,
        type: 'POST',
        success: callback,
        data: data,
        contentType: type
    });
}


Logger.useDefaults();

// const helper = import("./helpers.js");
import { getLocationPermission, redirectTo, redirectHard, tinySuccessAlert, inlineAlert, megaAlert, tinyAlert, revertFormAnim, triggerFormAnim } from "./helpers.js";
import { initRangeSlider, initRevenueChart, initBarChart, initDateBookPicker, initSlick } from "./initFunctions.js";
// require("./helpers");
const env = "development";

/* Initializations */
// const logger = $.Logger();

if (env != "development")
    Logger.setLevel(Logger.OFF);

// getLocationPermission();

/*Callback for hero form submit - always keep at top (has conflict issue)*/
$("body").on("submit", ".hero-booking-form", function(event) {

    let proceed = true;
    var data = $(this).serializeJSON();
    Logger.info(data);

    if (!data.service || data.service == "") {
        tinyAlert("Incomplete form", "Please Choose Service");
        proceed = false;
    }

    if (!data.source_lat || data.source_lat == "" || $("input.book-address").eq(0).attr("placeholder") == "Choose") {
        tinyAlert("Incomplete form", "Please choose pickup location");
        proceed = false;
    }

    if (!data.dest_lat || data.dest_lat == "" || $("input.book-address").eq(2).attr("placeholder") == "Choose") {
        tinyAlert("Incomplete form", "Please choose destination location");
        proceed = false;
    }

    if (!data.move_date || data.move_date == "") {
        tinyAlert("Incomplete form", "Please choose movement dates");
        proceed = false;
    }

    Logger.info(`${$(this).attr("action")}?${$(this).serialize}`);

    if (!proceed)
        return false;

    if (LOGGED_STATE)
        location.assign(`${$(this).attr("action")}?${$(this).serialize()}`);
    else {

        $("#Login-modal").modal();
        $("#Login-modal form").attr("data-url", `${$(this).attr("action")}?${$(this).serialize()}`);

        $("#Signup-modal form").attr("data-url", `${$(this).attr("action")}?${$(this).serialize()}`);
    }

    return false;

});

/* AJAX Universal */
$("body").on('submit', "form:not(.no-ajax)", function() {
    let form = $(this);
    let requestData = form.serializeJSON();
    let button = form.find("button[type=submit]");
    Logger.info(button);
    let buttonPretext = button.html();
    Logger.info("Loggin request payload", requestData);

    $.ajax({
        url: form.attr("action"),
        method: form.attr("method"),
        data: JSON.stringify(requestData),
        contentType: "application/json",
        beforeSend: () => {
            triggerFormAnim(button);
        },
        success: (response) => {

            // Logger.info("Response ",response);
            Logger.info("Response ", response);
            if (response.status == "success") {

                tinySuccessAlert("Success", response.message);
                if (form.data("next")) { //   data-next="redirect"
                    if (form.data("next") == "nothing") {
                        revertFormAnim(button, buttonPretext);
                        return false;
                    }
                    if (form.data("next") == "redirect") {
                        if (form.hasClass("add-slider")) {
                            var url = form.data('url');
                            url = url.replace(':id', response.data.slider.id);
                            redirectTo(url);
                            return false;
                        }
                        if (form.hasClass("vendor-pass-reset")) {
                            var url = form.data('url');
                            // Logger.info(url);
                            url = url.replace(':phone', response.data.vendor.phone);
                            // Logger.info(url);
                            redirectTo(url);
                            return false;
                        }
                        if (form.hasClass("onboard-vendor-form")) {
                            var url = form.data('url');
                            url = url.replace(':id', response.data.organization.id);
                            redirectTo(url);
                            return false;
                        }
                        if (form.hasClass("user-form")) {
                            var url = form.data('url');
                            url = url.replace(':id', response.data.admin.id);
                            redirectTo(url);
                            return false;
                        }
                        if (form.hasClass("verify-otp-form")) {
                            var url = form.data('url');
                            url = url.replace(':id', response.data.otp.id);
                            redirectTo(url);
                            return false;
                        }
                        if (form.hasClass("order_create")) {
                            var url = form.data('url');
                            url = url.replace(':id', response.data.booking.id);
                            redirectTo(url);
                            return false;
                        }

                        if (form.hasClass("order_create_web")) {
                            var url = form.data('url');
                            url = url.replace(':id', response.data.booking.public_enquiry_id);
                            redirectHard(url);
                            return false;
                        }
                        if (form.data('redirect-type') == "hard")
                            redirectHard(form.data("url")); // data-url="google.com"
                        else
                            redirectTo(form.data("url"));
                    } else if (form.data("next") == "refresh") {
                        location.reload();
                    } else if (form.data("next") == "modal") {
                        $(form.data(".modal-id")).modal();
                    }
                }
                if (form.hasClass("order_track_web")) {
                    var enq_id = response.data.booking.public_booking_id;
                    Logger.info(enq_id);
                    $('.enq-id').val(enq_id);
                }

                if (form.hasClass("track_next1")) {
                    revertFormAnim(button, "NEXT");
                    Logger.info('entered');
                    $('.step-1').css('display', 'none');
                    $('.step-2').css('display', 'block');
                    $(".completed-step-2").addClass("turntheme");
                    $(".completed-step-1").removeClass("turntheme");
                    $(".steps-step-2").addClass("color-purple");
                    $(".steps-step-1").removeClass("color-purple");
                }

                if (form.hasClass("track_next2")) {
                    revertFormAnim(button, "NEXT");
                    $('.step-2').css('display', 'none');
                    $('.step-3').css('display', 'block');
                    $(".completed-step-3").addClass("turntheme");
                    $(".completed-step-2").removeClass("turntheme");
                    $(".steps-step-3").addClass("color-purple");
                    $(".steps-step-2").removeClass("color-purple");
                }

                if (form.hasClass("track_next3")) {
                    revertFormAnim(button, "NEXT");
                    $('.step-3').css('display', 'none');
                    $('.step-4').css('display', 'block');
                    $(".completed-step-4").addClass("turntheme");
                    $(".completed-step-3").removeClass("turntheme");
                    $(".steps-step-4").addClass("color-purple");
                    $(".steps-step-3").removeClass("color-purple");
                }
            } else if (response.status == "fail") {

                if (form.data("alert") == "tiny")
                    tinyAlert("Oops", response.message);
                else if (form.data("alert") == "inline")
                    inlineAlert(form, response.message);
                else
                    megaAlert("Oops", response.message);

                revertFormAnim(button, buttonPretext);
            } else if (response.status == "await") {
                $(form.data('await-input')).toggleClass('hidden');
                revertFormAnim(button, buttonPretext);

                /*remove in prod*/
                if ("otp" in response.data && env == "development")
                    $(form.data('await-input')).find("input").val(response.data.otp);
                /*remove in prod*/
            } else if (response.status == "login") {
                tinySuccessAlert("Success", response.message);
                if (response.data.user.new == false) {
                    if (form.data("next")) { //   data-next="redirect"
                        if (form.data("next") == "redirect") {
                            if (form.data('redirect-type') == "hard")
                                redirectHard(form.data("url")); // data-url="google.com"
                            else
                                redirectTo(form.data("url"));
                        }
                    }
                } else if (response.data.user.new == true) {
                    $('#Login-modal').modal('hide');
                    $('#Signup-modal').modal('show');
                }
            } else {
                Logger.info(response.message);
                revertFormAnim(button, buttonPretext);
            }
        },
        error: (error, ajaxOptions, thrownError) => {
            Logger.info(error.responseText);
            if (error.status === 400)
                megaAlert("Fill all fields", "Please make sure to fill all fields with valid input.");
            else
                megaAlert("Oops", "Something went wrong in server. This action couldn't be processed.");
            revertFormAnim(button, buttonPretext);
        },
    });

    return false;

});

$("body").on('click', ".file-upload button", function() {
    if ($(this).data('action') == "upload") {
        $(this).parent().find("input[type=file]").click();
    } else {
        $(".upload-preview").attr("src", IMAGE_PLACEHOLDER);
        // $(this).html("UPLOAD IMAGE");
    }
});

$("body").on('input', "input[type=file]", function(event) {
    // var thiss = $(this);
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onloadend = () => {
        $(this).closest('.upload-section').find(".upload-preview").attr("src", reader.result);
        $(this).parent().find(".base-holder").val(reader.result);
        $(this).parent().find(".btn").html("CHANGE");
    };
    reader.readAsDataURL(file);

    var fullPath = $(this).val();
    if (fullPath) {
        var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
        var filename = fullPath.substring(startIndex);
        if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
            filename = filename.substring(1);
        }
        $(this).closest(".upload-section").find(".file-name").html(filename);
    }
});

$("body").on('change', ".field-toggle", function(event) {
    Logger.info($(this).val());
    if ($(this).val() == $(this).data("value")) {
        $($(this).data("target")).removeClass("hidden");
        $($(this).data("target")).find(".form-control").attr("required", "required");
    } else {
        $($(this).data("target")).addClass("hidden");
        $($(this).data("target")).find(".form-control").removeAttr("required");
    }
});

$("body").on('click', ".repeater", function(event) {
    if ($(this).hasClass("load-extra-inventories") && $(".subservices").val()) {
        let max_extra_inv_count = parseInt($(".subservices option:selected").data('max-items'));
        if ($(".is_custom").length == max_extra_inv_count) {
            megaAlert("Limit Reached", `You can only add upto ${max_extra_inv_count} inventories to this subcategory.`);
            return false;
        }
    }

    $($(this).data("container")).slideDown(200).append($($(this).data('content')).html());
    Logger.info('show');
    $(".hide-on-data").fadeOut(100);
    initRangeSlider();
    var id = $(".category-select").val();
    var type = $("#sub_" + id).data("type");

    if (type == 0) {
        $(".fixed").removeClass("hidden");
        $(".range").parent().addClass("hidden");
        $(".fixed").attr("required", "required");
        $(".fixed").attr("name", "inventory_items[][quantity]");
        $(".range").removeAttr("name");
    }
    if (type == 1) {
        $(".fixed").addClass("hidden");
        $(".range").parent().removeClass("hidden");
        $(".range").attr("required", "required");
        $(".range").attr("name", "inventory_items[][quantity]");
        $(".fixed").removeAttr("name");
    }

    if ($(this).hasClass("load-extra-inventories") && $(".subservices").val()) {
        $.get(`${$(this).data('url')}?subservice_id=${$(".subservices").val()}`, function(response) {
            Logger.info(response);
            let options = `<option value="">--Select--</option>`;
            let inventory;

            for (let i = 0; i < response.data.extra_inventories.length; i++) {
                inventory = response.data.extra_inventories[i];
                options += `<option id='inventory_${inventory.id}' value="${inventory.id}" data-size='${inventory.size}' data-material='${inventory.material}'>${inventory.name}</option>`;
            }

            $(".inventory-snip:last-child").find(".inventory-select").html(options);
            $(`.inventory-snip:last-child`).closest(".inventory-snip").addClass("is_custom");
        });
    }
    initDateBookPicker();
});

$("body").on('click', ".closer", function(event) {
    Swal.fire({
        title: 'Are sure want to remove this?',
        text: "If you proceed, you may need to use the save button to save changes permanently.",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonColor: '#FDC403',
        confirmButtonText: 'Yes!',

    }).then((result) => {
        if (result.isConfirmed) {
            $(this).closest($(this).data("parent")).fadeOut(100).remove();
        } else {
            return false;
        }
    });
    /* if(confirm('Are sure want to remove this? If you proceed, you may need to use the save button to save changes permanently.')) {
         $(this).closest($(this).data("parent")).fadeOut(100).remove();
     }*/

});

$("body").on('click', ".modal-toggle", function(event) {
    Logger.info("sda");
    $($(this).data("target")).fadeIn(100).show();
    // $($(this).data("modal")).toggleClass("show");
    return false;
});

$("body").on('click', ".fullscreen-modal-body .close", function(event) {
    Logger.info("close");
    $($(this).closest(".fullscreen-modal")).fadeOut(100).hide();
    return false;
});

$("body").on('click', ".fullscreen-modal-body .cancel", function(event) {
    Logger.info("close");
    $($(this).closest(".fullscreen-modal")).fadeOut(100).hide();
    return false;
});

$("body").on('change', ".inventory-select", function(event) {
    Logger.info("change");
    var id = $(this).val();

    $(this).closest(".inventory-snip").find(".material").html('<option value="">--Select--</option>');
    $(this).closest(".inventory-snip").find(".size").html('<option value="">--Select--</option>');

    var materal = $("#inventory_" + id).data("material");
    var size = $("#inventory_" + id).data("size");

    materal.map((value) => {
        $(this).closest(".inventory-snip").find(".material").append('<option value="' + value + '">' + value + '</option>')
    });
    size.map((value) => {
        $(this).closest(".inventory-snip").find(".size").append('<option value="' + value + '">' + value + '</option>')
    });
    return false;
});

$("body").on('change', ".notification", function(event) {
    Logger.info("change");
    var id = $(this).val();
    Logger.info(id);
    if (id == "1") {
        $(this).closest(".d-flex").find(".vendor").addClass("hidden");
        $(this).closest(".d-flex").find(".user").removeClass("hidden");
        $(this).closest(".d-flex").find(".userselect").attr("required", "required");
        $(this).closest(".d-flex").find(".vendorselect").removeAttr("required", "required");
    }
    if (id == "2") {
        $(this).closest(".d-flex").find(".user").addClass("hidden");
        $(this).closest(".d-flex").find(".vendor").removeClass("hidden");
        $(this).closest(".d-flex").find(".vendorselect").attr("required", "required");
        $(this).closest(".d-flex").find(".userselect").removeAttr("required", "required");
    }
    if (id == 3 || id == 4) {
        $(this).closest(".d-flex").find(".vendor").addClass("hidden");
        $(this).closest(".d-flex").find(".user").addClass("hidden");
        $(this).closest(".d-flex").find(".vendorselect").removeAttr("required", "required");
        $(this).closest(".d-flex").find(".userselect").removeAttr("required", "required");
    }

    return false;
});

$("body").on('change', ".category-select", function(event) {

    var id = $(this).val();

    $(this).closest(".d-flex").find(".subservices").html('<option value="">--Select--</option>');

    var materal = $("#sub_" + id).data("subcategory");

    materal.map((value) => {
        var name = value['name'].replace(" ", "_");
        $(this).closest(".d-flex").find(".subservices").append('<option data-max-items="' + value['max_extra_items'] + '" data-service="' + id + '" id="item_' + name + '" data-id="' + value['id'] + '" value="' + value['name'] + '">' + value['name'] + '</option>')
    });

    var type = $("#sub_" + id).data("type");
    if (type == 0) {
        $(this).closest(".d-flex").find(".fixed").removeClass("hidden");
        $(this).closest(".d-flex").find(".range").parent().addClass("hidden");
        $(this).closest(".d-flex").find(".fixed").attr("required", "required");
        $(this).closest(".d-flex").find(".fixed").attr("name", "inventory_items[][quantity]");
        $(this).closest(".d-flex").find(".range").removeAttr("required");
        $(this).closest(".d-flex").find(".range").removeAttr("name");
    }
    if (type == 1) {
        $(this).closest(".d-flex").find(".fixed").addClass("hidden");
        $(this).closest(".d-flex").find(".range").parent().removeClass("hidden");
        $(this).closest(".d-flex").find(".range").attr("required", "required");
        $(this).closest(".d-flex").find(".range").attr("name", "inventory_items[][quantity]");
        $(this).closest(".d-flex").find(".fixed").removeAttr("required");
        $(this).closest(".d-flex").find(".fixed").removeAttr("name");
    }
    return false;
});

$("body").on('change', ".subservices", function(event) {

    var subcategory = $(this).val()
    var name = subcategory.replace(" ", "_");
    var id = $("#item_" + name).data("id");
    var service = $("#item_" + name).data("service");
    var url = $(this).data("url");

    // $('.item-subservice').html("");

    $.ajax({
        url: url + "?id=" + id + "&service=" + service,
        type: 'GET',
        contentType: "application/json",
        success: function(response) {
            if (response.status == "success") {
                Logger.info(response.data.items);
                if (response.data.items.length > 0) {
                    for (var i = 0; i < response.data.items.length; i++) {
                        response.data.items[i].meta.material = JSON.parse(response.data.items[i].meta.material);
                        response.data.items[i].meta.size = JSON.parse(response.data.items[i].meta.size);
                    }

                    let source = $("#default_item").html();

                    let template = Handlebars.compile(source);
                    let html = template(response.data);

                    $('.item-subservice').html(html);
                    /* $('.item-subservice').find("tr").not(".is_custom").remove();
                     $('.item-subservice').prepend(html);

                     let max_extra_inv_count = parseInt($(".subservices option:selected").data('max-items'));
                         let custom_items_count = $(".is_custom").length;
                     if(custom_items_count > max_extra_inv_count){

                         let diff = custom_items_count - max_extra_inv_count;
                         $(".is_custom").slice(-diff).remove();

                         megaAlert(`${diff} items removed.`, `You can only add upto ${max_extra_inv_count} items to this subcategory but you had ${custom_items_count} items added. Last ${diff} items have been removed.`);
                         return false;
                     }*/
                }
            }
        }
    });


    return false;
});

$("body").on('click', ".delete", function(event) {

    Swal.fire({
        title: 'Delete?',
        text: $(this).data('confirm'),
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#4D34B8',
        confirmButtonColor: '#CA1F1F',
        confirmButtonText: 'Yes!',

    }).then((result) => {
        if (result.isConfirmed) {
            var target = $(this).closest($(this).data("parent"));
            $.delete($(this).data("url"), {}, function(response) {
                Logger.info(response);
                if (response.status == "success") {
                    tinySuccessAlert("Deleted Successfully", response.message);
                    target.hide();
                } else {
                    tinyAlert("Failed", response.message);
                }

            });
        } else {
            return false;
        }
    });
    /* if(confirm($(this).data('confirm'))) {
         // $(this).closest($(this).data("parent")).fadeOut(100).remove();
         var target =  $(this).closest($(this).data("parent"));
         $.delete($(this).data("url"), {}, function (response){
             Logger.info(response);
             if(response.status == "success")
             {
                 tinySuccessAlert("Deleted Successfully", response.message);
                 target.hide();
             }
             else
             {
                 tinyAlert("Failed", response.message);
             }

         });
     }
     return false;*/
});

$("body").on('click', ".impersonate", function(event) {

    Swal.fire({
        title: 'Proceed?',
        text: $(this).data('confirm'),
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#4D34B8',
        confirmButtonColor: '#CA1F1F',
        confirmButtonText: 'Yes!',

    }).then((result) => {
        if (result.isConfirmed) {
            let vendorpanel = window.open($(this).data("url"), "vendor-panel", "height=640,width=720,resizable=yes,scrollbars=yes,status=yes");
            vendorpanel.focus();
            return false;
        } else {
            return false;
        }
    });
});

$("body").on('click', ".sidebar-toggle td:not(:last-child), .sidebar-toggle-link", function(event) {
    var $this = $(this);

    // if($(this).hasClass('no-toggle'))
    // return false;

    $(".side-bar-pop-up").html('<div class="pop-up-preloader">\n' +
        '                    <svg class="circular" height="50" width="50">\n' +
        '                        <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="6" stroke-miterlimit="10" />\n' +
        '                    </svg>\n' +
        '                </div>');

    $('.side-bar-pop-up').addClass('display-pop-up');

    let url;
    if ($(this).hasClass("sidebar-toggle-link"))
        url = $(this).data("sidebar");
    else
        url = $(this).parent().data("sidebar");
    $.get(url, {}, function(response) {

        $(".side-bar-pop-up").html(response);
    });
    initRevenueChart(
        Logger.info('graph')
    );
});

$("body").on('click', ".sidebar-toggle_slider td:not(:first-child, :last-child)", function(event) {
    var $this = $(this);

    // if($(this).hasClass('no-toggle'))
    // return false;

    $(".side-bar-pop-up").html('<div class="pop-up-preloader">\n' +
        '                    <svg class="circular" height="50" width="50">\n' +
        '                        <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="6" stroke-miterlimit="10" />\n' +
        '                    </svg>\n' +
        '                </div>');

    $('.side-bar-pop-up').addClass('display-pop-up');
    $.get($(this).parent().data("sidebar"), {}, function(response) {

        $(".side-bar-pop-up").html(response);
    });
    initSlick();
    initRevenueChart(
        Logger.info('graph')
    );
});

$("body").on('click', ".invsidebar", function(event) {
    var $this = $(this);

    $(".side-bar-pop-up").html('<div class="pop-up-preloader">\n' +
        '                    <svg class="circular" height="50" width="50">\n' +
        '                        <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="6" stroke-miterlimit="10" />\n' +
        '                    </svg>\n' +
        '                </div>');

    $('.side-bar-pop-up').addClass('display-pop-up');
    $.get($(this).data("sidebar"), {}, function(response) {

        $(".side-bar-pop-up").html(response);
    });


});

$("body").on('click', ".category-sidebar-toggle td:not(:nth-last-child(-n+2))", function(event) {
    var $this = $(this);

    // if($(this).hasClass('no-toggle'))
    // return false;

    $(".side-bar-pop-up").html('<div class="pop-up-preloader">\n' +
        '                    <svg class="circular" height="50" width="50">\n' +
        '                        <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="6" stroke-miterlimit="10" />\n' +
        '                    </svg>\n' +
        '                </div>');

    $('.side-bar-pop-up').addClass('display-pop-up');
    $.get($(this).parent().data("sidebar"), {}, function(response) {

        $(".side-bar-pop-up").html(response);
    });

});

$("body").on('change', ".vendor-select", function(event) {
    var id = $(this).val();
    var commision = $("#org_" + id).data("comission");
    if (commision > 0) {
        document.getElementById("commission").value = commision;
    }
    return false;
});

$("body").on('keyup', "#amount", function(event) {
    var id = $(this).val();

    var org_id = document.getElementById("orgnizations").value;
    var commision = $("#org_" + org_id).data("comission");
    var discount = (id * commision) / 100;
    var afterDiscount = id - discount;
    document.getElementById("payout_amount").value = afterDiscount;
    document.getElementById("commission_amount").value = discount;
    return false;
});

$("body").on('change', ".change_status", function(event) {
    let el = $(this);
    if (el.hasClass('change-click')) {
        return false;
    }
    Swal.fire({
        title: 'Are you sure want to change status?',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#4D34B8',
        confirmButtonColor: '#CA1F1F',
        confirmButtonText: 'Yes!',

    }).then((result) => {
        if (result.isConfirmed) {
            var target = $(this).closest($(this).data("parent"));
            $.update($(this).data("url"), {}, function(response) {
                Logger.info(response);
                if (response.status == "success") {
                    tinySuccessAlert("Status changed Successfully", response.message);
                    target.hide();
                } else {
                    tinyAlert("Failed", response.message);
                }
            });
        } else {
            el.addClass('change-click');
            el.click();
            el.removeClass('change-click');
            return false;
        }
    });
});

$("body").on('change', ".status-change", function(event) {
    Swal.fire({
        title: 'Are you sure want to change status?',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#4D34B8',
        confirmButtonColor: '#CA1F1F',
        confirmButtonText: 'Yes!',

    }).then((result) => {
        if (result.isConfirmed) {
            $.update($(this).data("url"), {}, function(response) {
                Logger.info(response);
                if (response.status == "success") {
                    tinySuccessAlert("Status changed Successfully", response.message);
                } else {
                    tinyAlert("Failed", response.message);
                }
            });
        } else {
            return false;
        }
    });
});

$("body").on('click', ".vendor-status-change", function(event) {
    Swal.fire({
        title: 'Are you sure want to change status?',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#4D34B8',
        confirmButtonColor: '#CA1F1F',
        confirmButtonText: 'Yes!',

    }).then((result) => {
        if (result.isConfirmed) {
            $.update($(this).data("url"), {}, function(response) {
                Logger.info(response);
                if (response.status == "success") {
                    tinySuccessAlert("Status changed Successfully", response.message);
                    location.reload();
                } else {
                    tinyAlert("Failed", response.message);
                }
            });
        } else {
            return false;
        }
    });
});

$("body").on('click', ".booking-status-change", function(event) {
    Swal.fire({
        title: 'Are you sure want to confirm this amount?',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#4D34B8',
        confirmButtonColor: '#CA1F1F',
        confirmButtonText: 'Yes!',

    }).then((result) => {
        if (result.isConfirmed) {
            $.update($(this).data("url"), {}, function(response) {
                Logger.info(response);
                if (response.status == "success") {
                    tinySuccessAlert("Confirmed Successfully", response.message);
                    location.reload();
                } else {
                    tinyAlert("Failed", response.message);
                }
            });
        } else {
            return false;
        }
    });
});

$("body").on('change', ".reply_status", function(event) {
    var data = $(this).val();
    Logger.info(data);
    if (confirm('Are you sure want to change status?')) {
        $.update($(this).data("url"), { data }, function(response) {
            Logger.info(response);
            if (response.status == "success") {
                tinySuccessAlert("Status changed Successfully", response.message);
            } else {
                tinyAlert("Failed", response.message);
            }

        });
    }
    return false;
});

$("body").on('click', ".reschedule", function(event) {
    var data = document.getElementById("movement_dates").value;
    if (confirm('Are you sure want to reschedule this order?')) {
        $.update($(this).data("url"), { data }, function(response) {
            Logger.info(response);
            if (response.status == "success") {
                tinySuccessAlert("Reschedule Order Successfully", response.message);
            } else {
                tinyAlert("Failed", response.message);
            }
        });
    }
    return false;
});

$("body").on('click', ".cancel-booking", function(event) {
    if (confirm('Are you sure want to Cancel this order?')) {
        $.update($(this).data("url"), { data }, function(response) {
            Logger.info(response);
            if (response.status == "success") {
                tinySuccessAlert("Cancelde Order Successfully", response.message);
            } else {
                tinyAlert("Failed", response.message);
            }
        });
    }
    return false;
});

$("body").on('keydown', ".table-search", function(event) {
    if (event.keyCode == 13) {
        var query = $(this).val();
        if (query.length >= 3) {
            var url = window.location.href.split("?")[0];
            redirectTo(url + "?search=" + query);
        }
    }
});

$("body").on('click', ".searchButton", function(event) {
    var query = $(this).closest("div").find("input").val();
    if (query.length >= 3) {
        var url = window.location.href.split("?")[0];
        redirectTo(url + "?search=" + query);
    }
});

$("body").on('keydown', ".table-search1", function(event) {
    if (event.keyCode == 13) {
        var query = $(this).val();
        if (query.length >= 15) {
            var url = window.location.href.split("?")[0];
            redirectTo(url + "?search=" + query);
        }
    }
});

// $("body").on('click', ".searchButton", function(event) {
//     var query1 = $('.table-search').val();
//     if (query1.length >= 3) {
//         var url = window.location.href.split("?")[0];
//         redirectTo(url + "?search=" + query1);
//     }
// });

$("body").on('click', ".searchButton1", function(event) {
    var query = $('.table-search1').val();
    if (query.length >= 3) {
        var url = window.location.href.split("?")[0];
        redirectTo(url + "?search=" + query);
    }
});

$("body").on('click', ".searchResultButton", function(event) {
    var query = $('.table-search').val();
    if (query.length >= 3) {
        var url = $('.table-search').data('url');
        redirectTo(url + "?search=" + query);
    }
});


$("body").on('change', ".check-toggle", function(event) {
    Logger.info($(this).val());
    if ($(this).val() == $(this).data("value")) {
        $(this).val("0");
        $($(this).data("target")).removeClass("hidden");
        $($(this).data("target")).find(".form-control").attr("required", "required");
    } else {
        $(this).val("1");
        $($(this).data("target")).addClass("hidden");
        $($(this).data("target")).find(".form-control").removeAttr("required");
    }
});

$("body").on('click', ".bookings", function(event) {
    var target = $(this).closest($(this).data("parent"));
    Swal.fire({
        title: $(this).data('confirm'),
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#4D34B8',
        confirmButtonColor: '#CA1F1F',
        confirmButtonText: 'Yes!',

    }).then((result) => {
        if (result.isConfirmed) {
            $.update($(this).data("url"), {}, function(response) {
                Logger.info(response);
                if (response.status == "success") {
                    tinySuccessAlert($(this).data('success'), response.message);
                    target.hide();
                } else {
                    tinyAlert("Failed", response.message);
                }
            });
        } else {
            return false;
        }
    });
});

$("body").on('click', ".rejected", function(event) {
    Swal.fire({
        title: 'Are you sure you want to Reject this order?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonColor: '#FDC403',
        confirmButtonText: 'Yes!',

    }).then((result) => {
        if (result.isConfirmed) {
            var target = $(this).closest($(this).data("parent"));
            $.update($(this).data("url"), {}, function(response) {
                Logger.info(response);
                if (response.status == "success") {
                    tinySuccessAlert($(this).data('success'), response.message);
                    target.hide();
                } else {
                    tinyAlert("Failed", response.message);
                }

            });
        }
    })

    return false;
});

/*$('.filterdate').datepicker({
    format: 'yyyy-mm-dd'
});*/

$("body").on('change', ".inventory-item-select", function(event) {
    var query = $(this).val();
    redirectTo($(this).data('url') + "?item=" + query);
});

$("body").on('click', ".next-btn-1-admin", function(event) {

    let isValid = true;
    $($(this).closest('form').find('input.validate-input')).each(function() {
        Logger.info(isValid);
        if ($(this).parsley().validate() !== true)
            isValid = false;
    });
    Logger.info(isValid);
    if (isValid) {
        var est = $(".calc-result").data("est-quote");
        var quote = $(".calc-result").val();
        $('.bid-expt').val(quote);
        // est = est.replace(/,/g, "");

        var high = parseInt(est) + parseInt(est / 2);
        var low = parseInt(est) - parseInt(est / 2);

        Logger.info(quote);
        if (quote <= 0) {
            tinyAlert("Warning", "Quote cannot be zero.");
            return false;
        }

        if (low >= quote) {
            tinyAlert("Warning", "This Quote is to low for bidding!");
        } else if (high <= quote) {
            tinyAlert("Warning", "This Quote is to high for bidding!");
        }
        $(this).hide();
        $(this).closest('form').find('.bid-amount-admin').hide();
        $(this).closest('form').find('.bid-amount-3-admin').hide();
        $(this).closest('form').find('.bid-amount-2-admin').show();
        $(this).closest('form').find('.next-btn-2-admin').show();
        $(this).closest('form').find('.next-btn-back-2-admin').removeClass("hidden");
    }
});

$("body").on('click', ".next-btn-back-2-admin", function(event) {
    $(this).addClass("hidden");
    $(this).closest('form').find('.bid-amount-admin').show();
    $(this).closest('form').find('.bid-amount-3-admin').show();
    $(this).closest('form').find('.bid-amount-2-admin').hide();
    $(this).closest('form').find('.next-btn-2-admin').hide();
    $(this).closest('form').find('.next-btn-1-admin').show();
});

$("body").on('click', ".next-btn-2-admin", function(event) {
    var url = $(this).data("url");

    $(".bid-amount-2-admin").wrap("<form id='parsley-form'></form>");
    let isValid = $('#parsley-form').parsley().validate();
    $(".bid-amount-2-admin").unwrap();
    // Logger.info(isValid);
    if (isValid) {
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                Logger.info(response);
                $('.otp-bid').val(response.data.OTP);
            }
        });
        $(this).hide();
        $(this).closest('form').find('.bid-amount-admin').hide();
        $(this).closest('form').find('.bid-amount-2-admin').hide();
        $(this).closest('form').find('.bid-amount-3-admin').show();
        $(this).closest('form').find('.bid-amount-3-admin').removeClass("hidden");
        $(this).closest('form').find('.submitbtn-admin').show();
        $(this).closest('form').find('.next-btn-back-2-admin').addClass("hidden");
    }
});

$("body").on('click', ".next-btn-1", function(event) {
    Logger.info("next");
    let isValid = true;
    $($(this).closest('form').find('input.validate-input')).each(function() {
        if ($(this).parsley().validate() !== true)
            isValid = false;
    });
    if (isValid) {
        var est = $(".calc-result").data("est-quote");
        var quote = $(".calc-result").val();
        $('.bid-expt').val(quote);

        var high = parseInt(est) + parseInt(est / 2);
        var low = parseInt(est) - parseInt(est / 2);
        if (parseFloat(quote) <= 0.00) {
            Swal.fire({
                title: 'Incorrect Quote',
                text: "The quote cannot be zero.",
                icon: 'warning',
                confirmButtonColor: '#FDC403',
                confirmButtonText: 'Ok',

            });
            return false;
        }
        if (low >= quote) {
            // megaAlert("Warning", "This Quote is to low for bidding!");
            // megaAlert("Warning", "This Quote is to low for bidding!");
            Swal.fire({
                title: 'Please Note',
                text: "This quote is to low than the estimated price for this booking. We recommend keeping the quote close to the estimated price to increase the chances of winning this bid.",
                icon: 'warning',
                confirmButtonColor: '#FDC403',
                confirmButtonText: 'PROCEED'
            });
        } else if (high <= quote) {
            Swal.fire({
                title: 'Please Note',
                text: "This quote is to high than the estimated price for this booking. We recommend keeping the quote close to the estimated price to increase the chances of winning this bid.",
                icon: 'warning',
                confirmButtonColor: '#FDC403',
                confirmButtonText: 'PROCEED'
            });
            // megaAlert("Warning", "This Quote is to high for bidding!");
        }
        $(this).hide();
        $(this).closest('form').find('.bid-amount').hide();
        $(this).closest('form').find('.bid-amount-2').show();
        $(this).closest('form').find('.next-btn-2').show();
        $(this).closest('form').find('.next-btn-back-2').removeClass("hidden");

    }
});

$("body").on('click', ".next-btn-back-2", function(event) {
    $(this).addClass("hidden");
    $(this).closest('form').find('.bid-amount').show();
    $(this).closest('form').find('.bid-amount-2').hide();
    $(this).closest('form').find('.next-btn-2').hide();
    $(this).closest('form').find('.next-btn-1').show();
});

$("body").on('click', ".next-btn-2", function(event) {

    $(".bid-amount-2").wrap("<form id='parsley-form'></form>");
    let isValid = $('#parsley-form').parsley().validate();
    $(".bid-amount-2").unwrap();

    if (isValid) {
        $(this).hide();
        $(this).closest('form').find('.bid-amount').hide();
        $(this).closest('form').find('.bid-amount-2').hide();
        $(this).closest('form').find('.submitbtn').show();
        $(this).closest('form').find('.next-btn-back-3').show();
        $(this).closest('form').find('.next-btn-back-3').removeClass('hidden');
        $(this).closest('form').find('.enter-pin').show();
        $(this).closest('form').find('.next-btn-back-2').addClass("hidden");
    }
});

/*$("body").on('click', ".next-btn-back-3", function(event) {
    $(this).addClass("hidden");
    $(this).closest('form').find('.submitbtn').hide();

    $(this).closest('form').find('.bid-amount').show();
    $(this).closest('form').find('.bid-amount-2').show();
});*/


$("body").on('click', ".next-btn-3", function(event) {
    $(this).closest("form").submit();
});



$("body").on('keyup', ".calc-total", function(event) {
    let total = 0.00;

    $(this).find('.calc-total-input').each(function() {

        total += parseInt($(this).val());
    });

    // $($(this).data("result")).val(total);
    $(this).closest("form").find($(this).data("result")).val(parseFloat(total).toFixed(2));
});

$("body").on('click', ".move-date", function(event) {
    var id = $(this).data("id");
    // $(this).closest(".select-date").find("input[type=checkbox]").removeAttr("checked");
    $(this).closest(".move-add-date").find(".moving-date_" + id).removeAttr("checked");
    $(this).closest(".move-add-date").find(".moving-date_" + id).attr("checked", "checked");

    // $(".move-date").removeClass("radio-color");
    $(".mdate_" + id).removeClass("radio-color");
    $(this).toggleClass("radio-color");
});


$("body").on('click', ".move-dates", function(event) {
    $(this).closest(".select-date").find("input[type=radio]").removeAttr("checked");
    $(this).closest(".select-date").find(".blue-img").show();
    $(this).closest(".select-date").find(".white-img").hide();
    $(this).closest(".move-add-date").find(".moving-dates").attr("checked", "checked");
    $(this).closest(".move-add-date").find(".blue-img").hide();
    $(this).closest(".move-add-date").find(".white-img").removeClass("hidden");
    $(this).closest(".move-add-date").find(".white-img").show();

    $(".move-dates").removeClass("radio-color");
    $(this).toggleClass("radio-color");
});

$('.filterdate').datepicker({
    // multidateSeparator:",",
    format: 'yyyy-mm-dd',

});



/* Website js code start */
/*$("body").on('click', ".next1", function(event) {
    $(".step-1").wrap("<form id='parsley-form'></form>");
    let isValid = $('#parsley-form').parsley().validate();
    $(".step-1").unwrap();

    if (isValid) {
        $('.step-1').css('display', 'none');
        $('.step-2').css('display', 'block');
        $(".completed-step-2").addClass("turntheme");
        $(".completed-step-1").removeClass("turntheme");
        $(".steps-step-2").addClass("color-purple");
        $(".steps-step-1").removeClass("color-purple");
    }
});

$("body").on('click', ".next2", function(event) {
    $(".step-2").wrap("<form id='parsley-form'></form>");
    let isValid = $('#parsley-form').parsley().validate();
    $(".step-2").unwrap();

    if (isValid) {
        $('.step-2').css('display', 'none');
        $('.step-3').css('display', 'block');
        $(".completed-step-3").addClass("turntheme");
        $(".completed-step-2").removeClass("turntheme");
        $(".steps-step-3").addClass("color-purple");
        $(".steps-step-2").removeClass("color-purple");
    }
});

$("body").on('click', ".next3", function(event) {
    $(".step-3").wrap("<form id='parsley-form'></form>");
    let isValid = $('#parsley-form').parsley().validate();
    var length = $('.inventory').children().length;
    if(length == 1){
        isValid = false;
        if($('.subservices').children().length > 0){
            tinyAlert("Failed", "Select moving type and Add items before proceeding.");
        }else{
            tinyAlert("Failed", "Please add items before proceeding.");
        }
    }
    $(".step-3").unwrap();

    if (isValid) {
        $('.step-3').css('display', 'none');
        $('.step-4').css('display', 'block');
        $(".completed-step-4").addClass("turntheme");
        $(".completed-step-3").removeClass("turntheme");
        $(".steps-step-4").addClass("color-purple");
        $(".steps-step-3").removeClass("color-purple");
    }
});*/

$("body").on('click', ".back2", function(event) {

    $('.step-1').css('display', 'block');
    $('.step-2').css('display', 'none');
    $(".completed-step-1").addClass("turntheme");
    $(".completed-step-2").removeClass("turntheme");
    $(".steps-step-1").addClass("color-purple");
    $(".steps-step-2").removeClass("color-purple");

});

$("body").on('click', ".back3", function(event) {
    $('.step-2').css('display', 'block');
    $('.step-3').css('display', 'none');
    $(".completed-step-2").addClass("turntheme");
    $(".completed-step-3").removeClass("turntheme");
    $(".steps-step-2").addClass("color-purple");
    $(".steps-step-3").removeClass("color-purple");
});

$("body").on('click', ".back4", function(event) {
    $('.step-3').css('display', 'block');
    $('.step-4').css('display', 'none');
    $(".completed-step-3").addClass("turntheme");
    $(".completed-step-4").removeClass("turntheme");
    $(".steps-step-3").addClass("color-purple");
    $(".steps-step-4").removeClass("color-purple");
});

var selectedDates = [];
var dp = $('.bookdate').datepicker({
    multidate: true,
    format: 'dd-mm-yyyy',
    todayHighlight: true,
    'startDate': '+1d',
    'endDate': '+20d',

});
dp.on('changeDate', function(e) {
    if (e.dates.length < 6) {
        selectedDates = e.dates;
    } else {
        dp.data('datepicker').setDates(selectedDates);
        tinyAlert('Please note', 'Can only select upto 5 dates', 'info')
        return false;
    }

});


$("body").on('change', ".switch", function(event) {
    let phone = $(this).data('phone');
    let name = $(this).data('name');
    let email = $(this).data('email');
    if ($(this).val() == $(this).data("value")) {
        $(this).val("1");
        $('#phone').val('');
        $('#fullname').val('');
        $('#email').val('');
    } else {
        $(this).val("0");
        $('#phone').val(phone);
        $('#fullname').val(name);
        $('#email').val(email);
    }
});

$("body").on('click', ".reject", function(event) {
    $('.rejection-message ').toggleClass("display-none");
    $('.order-cards ').toggleClass("display-none");
    $('.reject-btn ').html('Submit ');
});

$("body").on('click', "#backbtn", function(event) {
    $('.rejection-message ').addClass("display-none");
    $('.order-cards ').removeClass("display-none");
});

$("body").on('change', ".economy", function(event) {
    if ($(".economy").is(":checked")) {
        $(".eco").addClass("blue-bg");
        $(".pre").removeClass("blue-bg");
        $('.eco-card ').addClass("border-white");
        $('.pre-card ').removeClass("border-white");
    } else {
        $(".eco").removeClass("blue-bg");
        $('.eco-card ').removeClass("border-white");
    }
});

$("body").on('change', ".premium", function(event) {
    if ($(".premium").is(":checked")) {
        $(".pre").addClass("blue-bg");
        $(".eco").removeClass("blue-bg");
        $('.eco-card ').removeClass("border-white");
        $('.pre-card ').addClass("border-white");
    } else {
        $(".pre").removeClass("blue-bg");
        $('.pre-card ').removeClass("border-white");
    }
});

$("body").on('change', ".eco", function(event) {
    $(".economy").prop("checked", true);
    $(".eco").addClass("blue-bg");
    $(".pre").removeClass("blue-bg");
    $('.eco-card ').addClass("border-white");
    $('.pre-card ').removeClass("border-white");
});

$("body").on('change', ".pre", function(event) {
    $(".premium").prop("checked", true);
    $(".pre").addClass("blue-bg");
    $(".eco").removeClass("blue-bg");
    $('.eco-card ').removeClass("border-white");
    $('.pre-card ').addClass("border-white");
});

$("body").on('change', ".card-block", function(event) {
    $(".card-block").removeClass("turnthemeicon");
    $(this).addClass("turnthemeicon");
});

$("body").on('change', ".card-methord02", function(event) {
    $('.card-methord02').removeClass('turntheme');
    $('.card-methord02').removeClass('check-icon02');
    $(this).addClass('turntheme');
    $(this).addClass('check-icon02');
});

$("body").on('click', ".raised", function(event) {
    // $(this).closest($(this).data("parent")).fadeOut(100).remove();
    var data = $(this).data("booking");
    var href = $(this).data("redirect");
    $.add($(this).data("url"), { data }, function(response) {
        if (response.status == "success") {
            tinySuccessAlert("Ticket Raised Successfully", response.message);
            window.location.href = href;
        } else {
            tinyAlert("Failed", response.message);
        }

    });
    return false;
});

$("body").on('click', ".reshcedule", function(event) {
    // $(this).closest($(this).data("parent")).fadeOut(100).remove();
    var public_booking_id = $(this).data("id");
    var href = $(this).data("next-url");
    $.add($(this).data("url"), { public_booking_id }, function(response) {
        if (response.status == "success") {
            tinySuccessAlert("Ticket Raised Successfully", response.message);
            window.location.href = href;
            // redirectTo(href);
        } else {
            tinyAlert("Failed", response.message);
        }

    });
    return false;
});

$("body").on('click', ".reject-booking", function(event) {
    // $(this).closest($(this).data("parent")).fadeOut(100).remove();
    var public_booking_id = $(this).data("id");
    var href = $(this).data("next-url");
    $.add($(this).data("url"), { public_booking_id }, function(response) {
        if (response.status == "success") {
            tinySuccessAlert("Ticket Raised Successfully", response.message);
            window.location.href = href;
            // redirectTo(href);
        } else {
            tinyAlert("Failed", response.message);
        }

    });
    return false;
});

$("body").on('click', ".copy", function(event) {
    var coupon_code = document.getElementById("coupon").value;
    if (coupon_code == "") {
        var code = $(this).data("code");
        document.getElementById("coupon").value = code;
    } else {
        tinyAlert("Failed", "Coupon already added!");
        return false;
    }

});

$("body").on('click', ".card-method", function(event) {
    var method = $(this).data("method");
    $('.card-method').removeClass('turntheme');
    $('.card-method').removeClass('check-icon02');

    $(this).addClass('turntheme');
    $(this).addClass('check-icon02');
    return false;
});

$("body").on('click', ".payment", function(event) {
    var method = $('.check-icon02').data("method");
    Logger.info(method);
    var amount = $(this).data("amount");
    var booking_id = $(this).data("booking");
    var coupon_code = document.getElementById("coupon").value;
    var url = $(this).data("url");
    var url_payment = $(this).data("payment");
    var url_status = $(this).data("status");
    var name = $(this).data("user-name");
    var email = $(this).data("user-email");
    var contact = $(this).data("user-contact");
    var moving_date = $('#moving_date').val();
    Logger.info(moving_date);


    $.ajax({
        url: url_payment,
        type: 'post',
        dataType: 'json',
        data: {
            id: booking_id,
            code: coupon_code,
            moving_date: moving_date
        },
        success: function(response) {
            // options.order_id=response.data.payment.rzp_order_id;
            var options = {
                "key": RZP_KEY, // secret key id
                "order_id": response.data.payment.rzp_order_id,
                "amount": (amount * 100), // 2000 paise = INR 20
                "name": "Bidnest",
                "description": "Movement on" + moving_date,
                "image": "https://dashboard-biddnest.dev.diginnovators.com/static/images/favicon.svg",
                "handler": function(resp) {
                    Logger.info({
                        booking_id: booking_id,
                        payment_id: resp.razorpay_payment_id,
                    });
                    $.ajax({
                        url: url_status,
                        type: 'post',
                        dataType: 'json',
                        data: {
                            booking_id: booking_id,
                            payment_id: resp.razorpay_payment_id,
                        },
                        success: function(msg) {
                            redirectTo(url);
                            // window.location.href = url;
                        }
                    });
                },
                "prefill": {
                    "method": method,
                    "name": name,
                    "email": email,
                    "contact": contact
                },

                "theme": {
                    "color": "#4b2b9b"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
            // window.location.href = url;
        }
    });



});

$("body").on('click', ".call-request", function(event) {
    var data = document.getElementById("contact_no").value;
    $.add($(this).data("url"), { data }, function(response) {
        if (response.status == "success") {
            tinySuccessAlert("Request Raised Successfully", response.message);
        } else {
            tinyAlert("Failed", response.message);
        }

    });
    return false;
});

$("body").on('click', ".verify-coupon", function(event) {
    var public_booking_id = document.getElementById("public_booking_id").value;
    var coupon = document.getElementById("coupon").value;
    $.add($(this).data("url"), { public_booking_id, coupon }, function(response) {
        if (response.status == "success") {
            Logger.info(response);
            var grand_total = response.data.grand_total;
            grand_total = grand_total.replace(/\,/g, '');

            tinySuccessAlert("Coupon Verified", response.message);

            $('.discount').html(response.data.discount);
            $('.grand-total').html(grand_total);
            $('.payment').attr("data-amount", grand_total);
            $(".verify-coupon").addClass("remove");
            $(".verify-coupon").text("Remove");
            $(".verify-coupon").attr("data-app", response.data.grand_total);
            $(".verify-coupon").removeClass("verify-coupon");
        } else {
            tinyAlert("Failed", response.message);
        }

    });
    return false;
});

$("body").on('click', ".remove", function(event) {
    var url = $(this).data("remove-url");
    window.location.href = url;
    return false;
});

$("body").on('click', ".web-category", function(event) {
    var url = $(this).data("url");
    var inventory_quantity_type = $(this).data("quantity-type");
    $(".inventory-quantity-type").val(inventory_quantity_type);
    if (inventory_quantity_type == 0) {
        $('.quantity-filed').html('<div class="quantity d-flex justify-content-between quantity-operator">' +
            '            <span class="minus">-</span>' +
            '            <input type="text" name="quantity" readOnly value="1"/>' +
            '            <span class="plus">+</span>' +
            '        </div>');
    } else {
        $('.quantity-filed').html('<div class="quantity-2" style="padding: 5px 2px">' +
            '            <input type="text" class="custom_slider range" name="quantity" value=""' +
            '                   data-type="double"' +
            '                   data-min="1"' +
            '                   data-max="500"' +
            '                   data-from="1"' +
            '                   data-to="500"' +
            '                   data-grid="false"' +
            '        </div>');
    }

    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        success: function(response) {
            // Logger.info(response);

            var source = $("#entry-template").html();
            var template = Handlebars.compile(source);
            var html = template(response.data);
            $('.subservices').html(html);

            if (!response.data.subservices.length) {
                Logger.info("custom");
                $('#subservice_id').val('custom');
                $('.web-inventory').click();
            }
            $('.inventory').html('<div class="col-md-4" data-toggle="modal" data-target="#addItemModal" style="min-height: 40vh !important;">' +
                '                                        <div class="item-single-wrapper add-more" style="height: 100% !important;">' +
                '                                            <i class="icon dripicons-plus" ></i>' +
                '                                        </div>' +
                '                                    </div>');
        }
    });
    initRangeSlider();
    return false;
});

$("body").on('click', ".web-inventory", function(event) {
    var url = $(this).data("inv-url");
    let inventory_quantity_type = $(".inventory-quantity-type").val();
    Logger.info(inventory_quantity_type);
    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        beforeSend: function() {
            $("div.inventory-popup").css({
                "opacity": "0.4"
            });
        },
        success: async function(response) {
            if (!response.data.max_custom.length) {
                $('.max_count').val(0);
            } else {
                Logger.info(response.data.max_custom);
                $('.max_count').val(response.data.max_custom);
                $('.count-max').html(response.data.max_custom + ' Extra');
            }

            Logger.info(response);
            for (var i = 0; i < response.data.extra_inventories.length; i++) {
                response.data.extra_inventories[i].material = JSON.parse(response.data.extra_inventories[i].material);
                response.data.extra_inventories[i].size = JSON.parse(response.data.extra_inventories[i].size);
            }
            var source = $("#extra-templateinventory").html();
            var template = Handlebars.compile(source);
            var html = await template(response.data);
            $('.inventory-popup').html(html);
            $("div.inventory-popup").css({
                "opacity": "1"
            });

            if (inventory_quantity_type == 0) {
                $('.quantity-filed').html('<div class="quantity d-flex justify-content-between quantity-operator">' +
                    '            <span class="minus">-</span>' +
                    '            <input type="text" name="quantity" readOnly value="1"/>' +
                    '            <span class="plus">+</span>' +
                    '        </div>');
            } else {
                $('.quantity-filed').html('<div class="quantity-2" style="padding: 5px 2px">' +
                    '            <input type="text" class="custom_slider range" name="quantity" value=""' +
                    '                   data-type="double"' +
                    '                   data-min="1"' +
                    '                   data-max="500"' +
                    '                   data-from="1"' +
                    '                   data-to="500"' +
                    '                   data-grid="false"' +
                    '        </div>');
                initRangeSlider();
            }
        }
    });

    return false;
});

$("body").on('click', ".web-sub-category", function(event) {
    var url = $(this).data("url");
    let inventory_quantity_type = $(".inventory-quantity-type").val();
    $('#subservice_id').val($(this).val());
    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        beforeSend: function() {
            $("div.inventory").css({
                "opacity": "0.4"
            });
        },
        success: function(response) {
            Logger.info(response);
            for (var i = 0; i < response.data.inventories.length; i++) {
                response.data.inventories[i].meta.material = JSON.parse(response.data.inventories[i].meta.material);
                response.data.inventories[i].meta.size = JSON.parse(response.data.inventories[i].meta.size);

            }
            if (inventory_quantity_type == 0)
                var source = $("#entry-templateinventory").html();
            else {
                item.quantity_min = item.quantity.split(';')[0];
                item.quantity_max = item.quantity.split(';')[1];
                var source = $("#entry-templateinventory_range").html();
            }

            var template = Handlebars.compile(source);
            var html = template(response.data);
            $('.inventory').html(html);
            $("div.inventory").css({
                "opacity": "1"
            });
        }
    });
    initRangeSlider();

    return false;
});

$("body").on('click', ".filter-button", function(event) {
    var value = $(this).attr('data-filter');

    if (value == "all") {
        $('.filter').show('1000');
    } else {
        $(".filter").not('.' + value).hide('3000');
        $('.filter').filter('.' + value).show('3000');

    }

    if ($(".filter-button").removeClass("active")) {
        $(this).removeClass("active");
    }
    $(this).addClass("active");

    return false;
});

$("body").on('click', ".add-item", function(event) {

    let item = [];
    let inventory_quantity_type = $(".inventory-quantity-type").val();
    $(this).closest(".item-single-wrapper").find("input").each(function() {
        item[$(this).attr('name')] = $(this).val();
    });
    item = Object.assign({}, item);

    let extra_item_count = 0;
    $(".custom-item").each(function() {
        console.log($(this).find(".quantity input").val());
        extra_item_count += parseInt($(this).find(".quantity input").val());
    });
    extra_item_count += parseInt(item.quantity);

    console.log("Total Extra Items:", extra_item_count);
    console.log("Max Inv count:", $(".max-inv-count").val());
    if (extra_item_count > $(".max-inv-count").val()) {
        megaAlert("Oops", `You can only add upto ${$(".max-inv-count").val()} extra items.`);
        return false;
    }


    Logger.info(item);
    if (item.material == '') {
        megaAlert("Oops", "Please select Material");
        return false;
    }
    if (item.size == '') {
        megaAlert("Oops", "Please select Size");
        return false;
    }
    let class_name = item.meta_name + "-" + item.material + "-" + item.size + "-" + item.meta_id + "a";
    class_name = class_name.replace(/[^a-zA-Z0-9]/g, '');

    class_name = class_name.replace(' ', '-');

    Logger.info(class_name);
    if ($("." + class_name).length > 0) {
        megaAlert("Oops", "This item has been already added");
        return false;
    }

    item.meta_material = item.meta_material;
    item.meta_size = item.meta_size;

    if (inventory_quantity_type == 0)
        var source = $("#entry-templateinventory_append").html();
    else {
        item.quantity_min = item.quantity.split(';')[0];
        item.quantity_max = item.quantity.split(';')[1];
        var source = $("#entry-templateinventory_append_range").html();
    }

    var template = Handlebars.compile(source);
    var html = template(item);
    $('.inventory .col-md-4:last').before(html);
    initRangeSlider();
    tinySuccessAlert("success", "This item has been added");
});

$("body").on('click', ".add-search-item", function(event) {
    let item = [];
    let inventory_quantity_type = $(".inventory-quantity-type").val();
    $(this).closest(".item-single-wrapper").find("input").each(function() {
        item[$(this).attr('name')] = $(this).val();
    });
    item = Object.assign({}, item);

    let extra_item_count = 0;
    $(".custom-item").each(function() {
        console.log($(this).find(".quantity input").val());
        extra_item_count += parseInt($(this).find(".quantity input").val());
    });
    extra_item_count += parseInt(item.quantity);

    console.log("Total Extra Items:", extra_item_count);
    console.log("Max Inv count:", $(".max-inv-count").val());
    if (extra_item_count > $(".max-inv-count").val()) {
        megaAlert("Oops", `You can only add upto ${$(".max-inv-count").val()} extra items.`);
        return false;
    }

    Logger.info(item);
    if (item.material == '') {
        tinyAlert("Oops", "Please select Material");
        return false;
    }
    if (item.size == '') {
        tinyAlert("Oops", "Please select Size");
        return false;
    }
    if (item.meta_material != '') {
        item.meta_material = item.meta_material.split(',');
        item.meta_size = item.meta_size.split(',');
    }

    if (inventory_quantity_type == 0)
        var source = $("#entry-templateinventory_append").html();
    else {
        item.quantity_min = item.quantity.split(';')[0];
        item.quantity_max = item.quantity.split(';')[1];
        var source = $("#entry-templateinventory_append_range").html();
    }

    var template = Handlebars.compile(source);
    var html = template(item);
    $('.inventory .col-md-4:last').before(html);
    initRangeSlider();

    Swal.fire({
        icon: "info",
        title: "Success",
        text: "This item has been added.",
    });
    $('.items-display').hide();

});

$("body").on('keyup', ".search-item", function(event) {
    var query = $(this).val();
    var url = $(this).data('url');

    if (query.length >= 3) {

        $.ajax({
            url: url + "?search=" + query,
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
                $(".fade-enable").css({
                    "opacity": "0.4"
                });
            },
            success: function(response) {
                $('.items-display').html('');
                let inventory_quantity_type = $(".inventory-quantity-type").val();
                if (response.data.inventories.length > 0) {
                    for (var i = 0; i < response.data.inventories.length; i++) {
                        response.data.inventories[i].material = JSON.parse(response.data.inventories[i].material);
                        response.data.inventories[i].size = JSON.parse(response.data.inventories[i].size);
                    }

                    let source = inventory_quantity_type == 0 ? $("#search_item").html() : $("#search_item_range").html();

                    let template = Handlebars.compile(source);
                    let html = template(response.data);
                    $('.items-display').html(html);
                } else {
                    let html = inventory_quantity_type == 0 ? $("#search_item_custome").html() : $("#search_item_custome_range").html();
                    $('.items-display').html(html);
                }

                if (inventory_quantity_type != 0)
                    initRangeSlider();

                $(".fade-enable").css({
                    "opacity": "1"
                });
            }
        });
    }
});

$("body").on('input', ".upload-image", function(event) {
    // var thiss = $(this);
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onloadend = () => {
        $(this).closest('.upload-section').find(".upload-preview").css({ "max-width": "120px" });
        $(this).closest('.upload-section').find(".upload-preview").attr("src", reader.result);
        $(this).parent().find(".base-holder").val(reader.result);
        let image = { "image": reader.result };
        var source = $("#image_upload_preview").html();
        var template = Handlebars.compile(source);
        var html = template(image);
        $('.uploaded-image .col-md-2:last').before(html);
    };
    reader.readAsDataURL(file);
});

/*live search input*/
$("body").on('keyup', ".live-search-input", function(event) {

    // Retrieve the input field text and reset the count to zero
    var filter = $(this).val(),
        count = 0;

    $(".live-search-result").css({ "opacity": 0.5 });
    // Loop through the comment list
    $(".live-search-result").each(function() {

        // If the list item does not contain the text phrase fade it out
        if ($(this).text().search(new RegExp(filter, "i")) < 0)
            $(this).fadeOut();
        else {
            $(this).show();
            count++;
        }
    });
    $(".live-search-result").css({ "opacity": 1 });

    // Update the count
    var numberItems = count;
    /*display count*/

    if (numberItems === 0) {
        if ($(".toast:not(.hidden)").length === 0)
            tinyAlert("Oops", "No Results found.");
    }
});

$("body").on('change', ".category-change", function(event) {
    var filter = $(this).val()
    if (filter == 2 || filter == 3) {
        $('.booking-id').attr("required", "required");
    } else {
        $('.booking-id').removeAttr("required", "required");
    }
});

$("body").on('click', ".csv", function(event) {
    Logger.info($(this).data('url'));

    let _url = $(this).data('url');
    let url = $(this).data('dwonload_url');
    var data = JSON.stringify($(this).closest('form').serializeJSON());
    Logger.info(data);
    $.ajax({
        url: _url,
        type: 'POST',
        contentType: "application/json",
        data: data,
        success: function(response) {
            Logger.info(response);
            if (response.status == "success") {
                Logger.info(url);
                window.open(url + '?file=app/' + response.data.file_name, '_blank');
                tinySuccessAlert("Export Successfully", response.message);
            }
        }
    });
});

$("body").on('click', ".calc-result", function(event) {
    if (!$(this).data("confirmed")) {
        if (confirm("Are you sure want to edit the total quote? You wont be able to edit the individual items prices.")) {

            if (true) {
                $(this).attr("data-confirmed", "true");
                $(this).closest("form").find(".calc-total-input").attr("data-confirmed", "true");
                $(this).closest("form").find(".calc-total-input").attr("readonly", true);
            }
        } else {
            $(this).blur();
        }
    }
});

$("body").on('click', ".calc-total-input", function(event) {
    if (!$(this).data("confirmed")) {
        if (confirm("Are you sure want to edit the individual item quote? You wont be able to edit the total quote.")) {
            if (true) {
                $(this).closest("form").find(".calc-total-input").attr("data-confirmed", "true");
                $(this).closest("form").find(".calc-result").attr("data-confirmed", "true");
                $(this).closest("form").find(".calc-result").attr("readonly", true);
            }
        } else {
            $(this).blur();
        }
    }
});

$("body").on('keydown', ".number, .phone", function(event) {
    return (event.ctrlKey || event.altKey ||
        (47 < event.keyCode && event.keyCode < 58 && event.shiftKey == false) ||
        (95 < event.keyCode && event.keyCode < 106) ||
        (event.keyCode == 8) || (event.keyCode == 9) ||
        (event.keyCode > 34 && event.keyCode < 40) ||
        (event.keyCode == 46));
});

$("body").on('keypress', ".alphabet", function(event) {
    var keyCode = (event.which) ? event.which : event.keyCode;
    if ((keyCode <= 65 || keyCode >= 90) && (keyCode <= 97 || keyCode >= 123) && keyCode != 32)
        return false;

    return true;

});

$("body").on('keypress', ".alphanum", function(event) {
    return (event.ctrlKey || event.altKey ||
        (47 <= event.keyCode && event.keyCode <= 58 && event.shiftKey == false) ||
        (95 <= event.keyCode && event.keyCode <= 106) ||
        (event.keyCode == 8) || (event.keyCode == 9) || event.ctrlKey || event.altKey ||
        (65 <= event.keyCode && event.keyCode <= 90 && event.shiftKey == true) ||
        (event.keyCode >= 34 && event.keyCode <= 40) ||
        (event.keyCode == 46));

});


$("body").on('click', ".sidebar-toggle_booking", function(event) {
    var $this = $(this);

    // if($(this).hasClass('no-toggle'))
    // return false;

    $(".side-bar-pop-up").html('<div class="pop-up-preloader">\n' +
        '                    <svg class="circular" height="50" width="50">\n' +
        '                        <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="6" stroke-miterlimit="10" />\n' +
        '                    </svg>\n' +
        '                </div>');

    $('.side-bar-pop-up').addClass('display-pop-up');
    $.get($(this).data("sidebar"), {}, function(response) {

        $(".side-bar-pop-up").html(response);
    });
    initRevenueChart(
        Logger.info('graph')
    );
});

$("body").on('click', ".sidebar-toggle_details td:not(:last-child)", function(event) {
    var url = $(this).parent().data("url");
    // window.location.href = url;
    redirectTo(url);
});

$("body").on('input', ".bid-amount, .commission, .other_charges, .discount_amount", function(event) {
    var bid_amount = $('.bid-amount').val();
    var commission = $('.commission').val();
    var other_charges = $('.other_charges').val();
    var discount_amount = $('.discount_amount').val();
    var tax = $('.tax').val();

    var sub_total = parseFloat(bid_amount) + parseFloat(commission);
    var grand_amount = parseFloat(sub_total) + parseFloat(other_charges) + parseFloat(tax) - parseFloat(discount_amount);

    $('.sub-total').val(sub_total);
    $('.grand_total').val(grand_amount);
    return false;
});


$("body").on("click", ".side-bar-pop-up a i.dripicons-pencil", function() {
    $(this).closest(".side-bar-pop-up").removeClass("display-pop-up");
});

/*$("body").on("focusout",".main-content form input",function(){
    Logger.info("Validating Input");
    $(this).parsley().validate();
});*/

$("body").on("input change focusout", "form input", function() {
    Logger.info("Validating Input");
    $(this).parsley().validate();
});

$("body").on('change', ".discount_type", function(event) {
    Logger.info($(this).val());
    if ($(this).val() == 0) {
        $(this).closest("form").find(".max-disc-amt").addClass("hidden");
        $(this).closest("form").find(".max-disc-input").removeAttr("required");

    } else {
        $(this).closest("form").find(".max-disc-amt").removeClass("hidden");
        $(this).closest("form").find(".max-disc-input").attr("required", "required");
    }
});

$("body").on('change', ".dateaddbooking", function(event) {
    Logger.info($(this).val());
    let dates = $(this).val();
    dates = dates.split(",");
    dates.every(function(date) {
        return new Date(date);
    });
    dates.sort(function(a, b) {
        if (a > b) {
            return 1;
        }
        if (a < b) {
            return -1;
        }
        return 0;
    });

    Logger.info(dates);

    dates.every(function(date) {
        return new Date(date);
    });

    // Logger.info(e);
    $(this).val(dates.join(","));
});

$("body").on('change', ".enddate", function(event) {
    let enddate = $(this).val();
    let startdate = $('.startdate').val();
    if (enddate < startdate) {
        $(this).val('');
        tinyAlert("Warning", "End date should be grater than start date.");
    } else {
        return false;
    }
});


$("body").on('change', ".selectfilter", function() {
    var query = $(this).val();
    var action = $(this).data("action");
    var url = window.location.href;
    if (url.indexOf(action) > -1) {
        url = window.location.href.split("?")[0];
    }
    if (url.indexOf("?") > -1) {
        redirectTo(url + "&" + action + "=" + query);
    } else {
        redirectTo(url + "?" + action + "=" + query);
    }
});

$("body").on('input', ".searchcity", function() {
    var query = $(this).val();
    var action = $(this).data("action");
    if (query.length >= 3) {
        var url = window.location.href;
        if (url.indexOf(action) > -1) {
            url = window.location.href.split("?")[0];
        }
        if (url.indexOf("?") > -1) {
            redirectTo(url + "&" + action + "=" + query);
        } else {
            redirectTo(url + "?" + action + "=" + query);
        }
    }
});

$("body").on('change', ".todate", function() {
    var from_query = $(this).closest('.collapse').find('.fromdate').val();
    var to_query = $(this).val();
    var url = window.location.href;
    console.log(url);
    if (url.indexOf("from") > -1 && url.indexOf("to") > -1) {
        url = window.location.href.split("?")[0];
    }
    if (url.indexOf("?") > -1) {
        redirectTo(url + "&from=" + from_query + "&to=" + to_query);
    } else {
        redirectTo(url + "?from=" + from_query + "&to=" + to_query);
    }
});

$("body").on('click', ".clear-filter", function() {
    var url = window.location.href.split("?")[0];
    redirectTo(url);
});

$("body").on('click', ".goback", function() {
    var url = window.history.back();
    redirectTo(url);
});

$("body").on('change', ".selectstatus", function() {
    var query = $(this).val();
    var action = $(this).data("action");
    var url = window.location.href;
    if (url.indexOf(action) > -1) {
        url = window.location.href.split("?")[0];
    }
    if (url.indexOf("?") > -1) {
        redirectTo(url + "&" + action + "=" + query);
    } else {
        redirectTo(url + "?" + action + "=" + query);
    }
});

$("body").on('change', ".selectservice", function() {
    var query = $(this).val();
    var action = $(this).data("action");
    var url = window.location.href;
    if (url.indexOf(action) > -1) {
        url = window.location.href.split("?")[0];
    }
    if (url.indexOf("?") > -1) {
        redirectTo(url + "&" + action + "=" + query);
    } else {
        redirectTo(url + "?" + action + "=" + query);
    }
});

$("body").on('click', ".filter-button", function(event) {
    var url = $('.filter-button').data("url");
    var zones = $('.zones').val();
    var status = $('.status').val();
    var category = $('.category').val();
    var booking_type = $('.booking_type').val();
    var booking_form = $('.booking-form').val();
    var booking_to = $('.booking-to').val();

    redirectTo(url + "?zones=" + zones + "&status=" + status + "&category=" + category + "&booking_type=" + booking_type + "&booking_form=" + booking_form + "&booking_to=" + booking_to);
});

$("body").on('input', ".phone-search", function(event) {
    console.log("add");
    if ($(this).val().length >= 10) {
        $.get($(this).data("url") + "?phone=" + $(this).val(), function(response) {
            Logger.info(response);
            if (response.status == "success") {
                $(".autofill-name").val(response.data.user.fname + " " + response.data.user.lname);
                $(".autofill-email").val(response.data.user.email);
                tinySuccessAlert("User is registered.", "Details have been autofilled.");
            } else {
                $(".autofill-name").val('');
                $(".autofill-email").val('');
                // tinySuccessAlert("User is not registered.","An account will be created on booking.");
            }
        });
    }
});

$("body").on('change', ".order-search", function(event) {
    if ($(this).val().length) {
        $.get(API_SEARCH_ORDER + "?q=" + $(this).val(), function(response) {
            Logger.info(response);
            if (response.status == "success") {
                $(".autofill-select").addClass("hidden");
                $(".autofill-name").removeClass("hidden");
                $(".autofill-name").closest(".autofill").find(".select2").addClass("hidden");
                $(".autofill-name").val(response.data.order[0].user.fname + " " + response.data.order[0].user.lname);
                $(".autofill-id").val(response.data.order[0].user_id);
            } else {
                $(".autofill-name").val('');
                $(".autofill-id").val('');
            }
        });
    }
});

$("body").on('click', ".send-otp", function(event) {
    let isValid = true;
    $($(this).closest('form').find('input.validate-input')).each(function() {
        Logger.info(isValid);
        if ($(this).parsley().validate() !== true)
            isValid = false;
    });
    Logger.info(isValid);
    if (isValid) {
        var phone = $("#phone").val();
        var name = $("#fullname").val();
        var email = $("#email").val();
        var url = $(this).data("url");
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            data: {
                phone: phone,
                name: name,
                email: email
            },
            success: function(response) {
                Logger.info(response);
                if (response.status == "success") {
                    $("#add-otp").show();
                    // $('.otp-bid').val(response.data.OTP);
                }
            }
        });
    }
});

$("body").on('input', ".filter-city", function(event) {
    console.log("add");
    if ($(this).val().length >= 3) {
        var query = $(this).val();
        var action = $(this).data("action");
        var url = window.location.href;
        if (url.indexOf(action) > -1) {
            url = window.location.href.split("?")[0];
        }
        if (url.indexOf("?") > -1) {
            redirectTo(url + "&" + action + "=" + query);
        } else {
            redirectTo(url + "?" + action + "=" + query);
        }
    }
});


$("body").on('keydown', ".alpha", function(event) {
    return (event.ctrlKey || event.altKey ||
        (65 <= event.keyCode && event.keyCode <= 90 && event.shiftKey == true) ||
        (65 <= event.keyCode && event.keyCode <= 90) || (event.keyCode == 8) || (event.keyCode == 9) ||
        (event.keyCode >= 34 && event.keyCode <= 40) ||
        (event.keyCode == 46));
});


$("body").on('click', ".pagination a", function(event) {

    let url = window.location.href;

    if (url.indexOf("=") >= 0) {
        Logger.info("Navigating Page");

        let next_url = $(this).attr("href");

        let qs = url.substring(url.indexOf('?') + 1).split('&');
        let ss = next_url.substring(url.indexOf('?') + 1).split('&');

        let result = {},
            result2 = {}
        for (let i = 0; i < qs.length; i++) {
            qs[i] = qs[i].split('=');
            result[qs[i][0]] = decodeURIComponent(qs[i][1]);
        }

        delete result.page;

        for (let j = 0; j < ss.length; j++) {
            ss[j] = ss[j].split('=');
            result2[ss[j][0]] = decodeURIComponent(ss[j][1]);
        }

        let params = {
            ...result,
            ...result2
        };

        redirectTo(`${window.location.origin}${window.location.pathname}?${new URLSearchParams(params).toString()}`);

        return false;
    }
});