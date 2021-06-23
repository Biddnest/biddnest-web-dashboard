/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */
$.delete = function(url, data, callback, type){
    if ( $.isFunction(data) ){
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

$.update = function(url, data, callback, type){
    if ( $.isFunction(data) ){
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

$.add = function(url, data, callback, type){
    if ( $.isFunction(data) ){
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
import { initRangeSlider, initRevenueChart } from "./initFunctions.js";
// require("./helpers");
const env = "development";

/* Initializations */
// const logger = $.Logger();

if (env != "development")
    Logger.setLevel(Logger.OFF);

// getLocationPermission();

/*Callback for hero form submit - always keep at top (has conflict issue)*/
$("body").on("submit",".hero-booking-form",function (event){

    let proceed = true;
    var data = $(this).serializeJSON();
    Logger.info(data);

    if(!data.service || data.service == "") {
        tinyAlert("Incomplete form","Please Choose Service");
        proceed =  false;
    }

    if(!data.source_lat || data.source_lat == "" || $("input.book-address").eq(0).attr("placeholder") == "Choose") {
        tinyAlert("Incomplete form","Please choose pickup location");
        proceed =  false;
    }

    if(!data.dest_lat || data.dest_lat == "" || $("input.book-address").eq(2).attr("placeholder") == "Choose") {
        tinyAlert("Incomplete form","Please choose destination location");
        proceed =  false;
    }

    if(!data.move_date || data.move_date == "") {
        tinyAlert("Incomplete form","Please choose movement dates");
        proceed =  false;
    }

    Logger.info(`${$(this).attr("action")}?${$(this).serialize}`);

    if(!proceed)
        return false;

    if(LOGGED_STATE)
        location.assign(`${$(this).attr("action")}?${$(this).serialize()}`);
    else {
        $("#Login-modal").modal();
        $("#Login-modal form").attr("data-url",`${$(this).attr("action")}?${$(this).serialize()}`)
    }

    return false;

});

/* AJAX Universal */
$("body").on('submit', "form:not(.no-ajax)", function() {
        let form = $(this);
        let requestData = form.serializeJSON();
        let button = form.find("button[type=submit]");
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
                        }else if (form.data("next") == "modal") {
                            $(form.data(".modal-id")).modal();
                        }
                    }
                }

                else if (response.status == "fail") {

                    if (form.data("alert") == "tiny")
                        tinyAlert("Oops", response.message);
                    else if (form.data("alert") == "inline")
                        inlineAlert(form, response.message);
                    else
                        megaAlert("Oops", response.message);

                    revertFormAnim(button, buttonPretext);
                }

                else if(response.status == "await"){
                    $(form.data('await-input')).toggleClass('hidden');
                    revertFormAnim(button, buttonPretext);
                }
                else {
                    Logger.info(response.message);
                    revertFormAnim(button, buttonPretext);
                }
            },
            error: (error, b, c) => {
                Logger.info(error.responseText);
                megaAlert("Oops", "Something went wrong in server. Please try again later.");
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
    if ($(this).val() == $(this).data("value")) {
        $($(this).data("target")).removeClass("hidden");
        $($(this).data("target")).find(".form-control").attr("required", "required");
    } else {
        $($(this).data("target")).addClass("hidden");
        $($(this).data("target")).find(".form-control").removeAttr("required");
    }
});

$("body").on('click', ".repeater", function(event) {
    $($(this).data("container")).slideDown(200).append($($(this).data('content')).html());
    Logger.info('show');
    $(".hide-on-data").fadeOut(100);
    initRangeSlider();
    var id=$(".category-select").val();
    var type=$("#sub_"+id).data("type");
    if(type == 0)
    {
        $(".fixed").removeClass("hidden");
        $(".range").parent().addClass("hidden");
        $(".fixed").attr("required", "required");
        $(".fixed").attr("name", "inventory_items[][quantity]");
        $(".range").removeAttr("name");
    }
    if(type == 1)
    {
        $(".fixed").addClass("hidden");
        $(".range").parent().removeClass("hidden");
        $(".range").attr("required", "required");
        $(".range").attr("name", "inventory_items[][quantity]");
        $(".fixed").removeAttr("name");
    }
});

$("body").on('click', ".closer", function(event) {
    if(confirm('Are sure want to remove this? If you proceed, you may need to use the save button to save changes permanently.')) {
        $(this).closest($(this).data("parent")).fadeOut(100).remove();
    }
    return false;
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
    var id=$(this).val();

    $(this).closest(".inventory-snip").find(".material").html('<option value="">--Select--</option>');
    $(this).closest(".inventory-snip").find(".size").html('<option value="">--Select--</option>');

    var materal=$("#inventory_"+id).data("material");
    var size=$("#inventory_"+id).data("size");

    materal.map((value)=>{
        $(this).closest(".inventory-snip").find(".material").append('<option value="'+value+'">'+value+'</option>')
    });
    size.map((value)=>{
        $(this).closest(".inventory-snip").find(".size").append('<option value="'+value+'">'+value+'</option>')
    });
    return false;
});

$("body").on('change', ".notification", function(event) {
    Logger.info("change");
    var id=$(this).val();
    Logger.info(id);
    if(id == "user")
    {
        $(this).closest(".d-flex").find(".vendor").addClass("hidden");
        $(this).closest(".d-flex").find(".user").removeClass("hidden");
        $(this).closest(".d-flex").find(".userselect").attr("required", "required");
        $(this).closest(".d-flex").find(".vendorselect").removeAttr("required", "required");
    }
    if(id == "vendor")
    {
        $(this).closest(".d-flex").find(".user").addClass("hidden");
        $(this).closest(".d-flex").find(".vendor").removeClass("hidden");
        $(this).closest(".d-flex").find(".vendorselect").attr("required", "required");
        $(this).closest(".d-flex").find(".userselect").removeAttr("required", "required");
    }
    if(id == 3 || id == 4)
    {
        $(this).closest(".d-flex").find(".vendor").addClass("hidden");
        $(this).closest(".d-flex").find(".user").addClass("hidden");
        $(this).closest(".d-flex").find(".vendorselect").removeAttr("required", "required");
        $(this).closest(".d-flex").find(".userselect").removeAttr("required", "required");
    }

    return false;
});

$("body").on('change', ".category-select", function(event) {
    Logger.info("change");
    var id=$(this).val();

    $(this).closest(".d-flex").find(".subservices").html('<option value="">--Select--</option>');

    var materal=$("#sub_"+id).data("subcategory");

    materal.map((value)=>{
        $(this).closest(".d-flex").find(".subservices").append('<option value="'+value['id']+'">'+value['name']+'</option>')
    });

    var type=$("#sub_"+id).data("type");
    if(type == 0)
    {
        $(this).closest(".d-flex").find(".fixed").removeClass("hidden");
        $(this).closest(".d-flex").find(".range").parent().addClass("hidden");
        $(this).closest(".d-flex").find(".fixed").attr("required", "required");
        $(this).closest(".d-flex").find(".fixed").attr("name", "inventory_items[][quantity]");
        $(this).closest(".d-flex").find(".range").removeAttr("required");
        $(this).closest(".d-flex").find(".range").removeAttr("name");
    }
    if(type == 1)
    {
        $(this).closest(".d-flex").find(".fixed").addClass("hidden");
        $(this).closest(".d-flex").find(".range").parent().removeClass("hidden");
        $(this).closest(".d-flex").find(".range").attr("required", "required");
        $(this).closest(".d-flex").find(".range").attr("name", "inventory_items[][quantity]");
        $(this).closest(".d-flex").find(".fixed").removeAttr("required");
        $(this).closest(".d-flex").find(".fixed").removeAttr("name");
    }
    return false;
});

$("body").on('click', ".delete", function(event) {
    if(confirm($(this).data('confirm'))) {
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
    return false;
});

$("body").on('click', ".sidebar-toggle td:not(:last-child)", function(event) {
    var $this = $(this);

    // if($(this).hasClass('no-toggle'))
        // return false;

    $(".side-bar-pop-up").html('<div class="pop-up-preloader">\n' +
        '                    <svg class="circular" height="50" width="50">\n' +
        '                        <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="6" stroke-miterlimit="10" />\n' +
        '                    </svg>\n' +
        '                </div>');

    $('.side-bar-pop-up').addClass('display-pop-up');
    $.get($(this).parent().data("sidebar"), {}, function(response){

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
    $.get($(this).parent().data("sidebar"), {}, function(response){

        $(".side-bar-pop-up").html(response);
    });
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
    $.get($(this).data("sidebar"), {}, function(response){

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
    $.get($(this).parent().data("sidebar"), {}, function(response){

        $(".side-bar-pop-up").html(response);
    });

});

$("body").on('change', ".vendor-select", function(event) {
    var id=$(this).val();
    var commision=$("#org_"+id).data("comission");
    if(commision > 0)
    {
        document.getElementById("commission").value = commision;
    }
    return false;
});

$("body").on('keyup', "#amount", function(event) {
    var id=$(this).val();

    var org_id = document.getElementById("orgnizations").value;
    var commision=$("#org_"+org_id).data("comission");
    var discount = (id * commision)/ 100;
    var afterDiscount =id - discount;
    document.getElementById("payout_amount").value = afterDiscount;
    document.getElementById("commission_amount").value = discount;
    return false;
});

$("body").on('change', ".change_status", function(event) {
    var target = $(this).closest($(this).data("parent"));
    if(confirm('Are you sure want to change status?')) {
        $.update($(this).data("url"), {}, function (response) {
            Logger.info(response);
            if (response.status == "success") {
                tinySuccessAlert("Status changed Successfully", response.message);
                target.hide();
            } else {
                tinyAlert("Failed", response.message);
            }

        });
    }
    return false;
});

$("body").on('change', ".reply_status", function(event) {
    var data = $(this).val();
    if(confirm('Are you sure want to change status?')) {
        $.update($(this).data("url"), {data}, function (response) {
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

$("body").on('change', ".reschedule", function(event) {
    var data = document.getElementById("movement_dates").value;
    if(confirm('Are you sure want to reschedule this order?')) {
        $.update($(this).data("url"), {data}, function (response) {
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

$("body").on('change', ".cancel-booking", function(event) {
    if(confirm('Are you sure want to Cancel this order?')) {
        $.update($(this).data("url"), {data}, function (response) {
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
    if(event.keyCode == 13){
        var query = $(this).val();
        if (query.length >= 3) {
            redirectTo(window.location.href + "?search=" + query);
        }
    }
});

$("body").on('keydown', ".table-search1", function(event) {
    if(event.keyCode == 13){
        var query = $(this).val();
        if (query.length >= 15) {
            redirectTo(window.location.href + "?search=" + query);
        }
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
    if(confirm($(this).data('confirm'))) {
        $.update($(this).data("url"), {}, function (response) {
            Logger.info(response);
            if (response.status == "success") {
                tinySuccessAlert($(this).data('success'), response.message);
                target.hide();
            } else {
                tinyAlert("Failed", response.message);
            }

        });
    }
    return false;
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
            $.update($(this).data("url"), {}, function (response) {
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
    redirectTo($(this).data('url')+"?item="+query);
});

$("body").on('click', ".next-btn-1-admin", function(event) {

    let isValid = true;
    $($(this).closest('form').find('input.validate-input')).each( function() {
        Logger.info(isValid);
        if ($(this).parsley().validate() !== true)
            isValid = false;
    });
    Logger.info(isValid);
    if (isValid) {
        $(this).hide();
        $(this).closest('form').find('.bid-amount-admin').hide();
        $(this).closest('form').find('.bid-amount-2-admin').show();
        $(this).closest('form').find('.submitbtn-admin').show();
    }
});

$("body").on('click', ".next-btn-1", function(event) {

    /*let isValid = true;
    $($(this).closest('form').find('input.validate-input')).each( function() {
        Logger.info(isValid);
        if ($(this).parsley().validate() !== true)
            isValid = false;
    });
    Logger.info(isValid);
    if (isValid) {*/
        $(this).hide();
        $(this).closest('form').find('.bid-amount').hide();
        $(this).closest('form').find('.bid-amount-2').show();
        $(this).closest('form').find('.next-btn-2').show();
    // }

});

$("body").on('click', ".next-btn-2", function(event) {

    /*let isValid = true;
    $($(this).closest('form').find('input.validate-input')).each( function() {
        Logger.info(isValid);
        if ($(this).parsley().validate() !== true)
            isValid = false;
    });
    Logger.info(isValid);
    if (isValid) {*/
        $(this).hide();
        $(this).closest('form').find('.bid-amount').hide();
        $(this).closest('form').find('.bid-amount-2').hide();
        $(this).closest('form').find('.submitbtn').show();
        $(this).closest('form').find('.enter-pin').show();
    // }
});

$("body").on('keyup', ".calc-total", function(event) {
    let total=0.00;

   $(this).find('.calc-total-input').each(function(){

        total += parseInt($(this).val());
   });

   // $($(this).data("result")).val(total);
   $(this).closest("form").find($(this).data("result")).val(parseFloat(total).toFixed(2));
});

$('.filterdate').datepicker({
    // multidateSeparator:",",
    format: 'yyyy-mm-dd',

});

/* Website js code start */

$("body").on('click', ".next1", function(event) {
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

$("body").on('click', ".back2", function(event) {

        $('.step-1').css('display', 'block');
        $('.step-2').css('display', 'none');
        $(".completed-step-1").addClass("turntheme");
        $(".completed-step-2").removeClass("turntheme");
        $(".steps-step-1").addClass("color-purple");
        $(".steps-step-2").removeClass("color-purple");

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

$("body").on('click', ".back3", function(event) {
    $('.step-2').css('display', 'block');
    $('.step-3').css('display', 'none');
    $(".completed-step-2").addClass("turntheme");
    $(".completed-step-3").removeClass("turntheme");
    $(".steps-step-2").addClass("color-purple");
    $(".steps-step-3").removeClass("color-purple");
});

$("body").on('click', ".next3", function(event) {
    $(".step-3").wrap("<form id='parsley-form'></form>");
    let isValid = $('#parsley-form').parsley().validate();
    $(".step-3").unwrap();

    if (isValid) {
        $('.step-3').css('display', 'none');
        $('.step-4').css('display', 'block');
        $(".completed-step-4").addClass("turntheme");
        $(".completed-step-3").removeClass("turntheme");
        $(".steps-step-4").addClass("color-purple");
        $(".steps-step-3").removeClass("color-purple");
    }
});

$("body").on('click', ".back4", function(event) {
    $('.step-3').css('display', 'block');
    $('.step-4').css('display', 'none');
    $(".completed-step-3").addClass("turntheme");
    $(".completed-step-4").removeClass("turntheme");
    $(".steps-step-3").addClass("color-purple");
    $(".steps-step-4").removeClass("color-purple");
});

var selectedDates=[];
var dp = $('.bookdate').datepicker({
    multidate: true,
    format: 'd M yy',
    todayHighlight: true,
    'startDate': '+2d',
    'endDate':'+20d',
});
dp.on('changeDate', function(e) {

    if(e.dates.length < 6){
        selectedDates = e.dates
    }else{
        dp.data('datepicker').setDates(selectedDates);
        megaAlert('PLease note','Can only select upto 5 dates', 'info')
    }

});

$("body").on('change', ".switch", function(event) {
    let phone=$(this).data('phone');
    let name=$(this).data('name');
    let email=$(this).data('email');
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
    $('.rejection-message ').toggleClass("diplay-none");
    $('.order-cards ').toggleClass("diplay-none");
    $('.reject-btn ').html('Submit ');
});

$("body").on('click', "#backbtn", function(event) {
    $('.rejection-message ').addClass("diplay-none");
    $('.order-cards ').removeClass("diplay-none");
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
        $.add($(this).data("url"), {data}, function (response){
            if(response.status == "success")
            {
                tinySuccessAlert("Ticket Raised Successfully", response.message);
                // window.location.href = href;
            }
            else
            {
                tinyAlert("Failed", response.message);
            }

        });
    return false;
});

$("body").on('click', ".reshcedule", function(event) {
        // $(this).closest($(this).data("parent")).fadeOut(100).remove();
        var public_booking_id = $(this).data("id");
        var href = $(this).data("next-url");
        $.add($(this).data("url"), {public_booking_id}, function (response){
            if(response.status == "success")
            {
                tinySuccessAlert("Ticket Raised Successfully", response.message);
                // window.location.href = href;
                redirectTo(href);
            }
            else
            {
                tinyAlert("Failed", response.message);
            }

        });
    return false;
});

$("body").on('click', ".reject-booking", function(event) {
        // $(this).closest($(this).data("parent")).fadeOut(100).remove();
        var public_booking_id = $(this).data("id");
        var href = $(this).data("next-url");
        $.add($(this).data("url"), {public_booking_id}, function (response){
            if(response.status == "success")
            {
                tinySuccessAlert("Ticket Raised Successfully", response.message);
                // window.location.href = href;
                redirectTo(href);
            }
            else
            {
                tinyAlert("Failed", response.message);
            }

        });
    return false;
});

$("body").on('click', ".copy", function(event) {
        var code = $(this).data("code");
        document.getElementById("coupon").value = code;
    return false;
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
        var moving_date = $(this).data("moving-date");



    $.ajax({
        url: url_payment,
        type: 'post',
        dataType: 'json',
        data: {
            id:booking_id ,code : coupon_code,
        },
        success: function (response) {
            // options.order_id=response.data.payment.rzp_order_id;
            var options = {
                "key": RZP_KEY, // secret key id
                "order_id":response.data.payment.rzp_order_id,
                "amount": (amount *100), // 2000 paise = INR 20
                "name": "Bidnest",
                "description": "Movement on"+ moving_date,
                "image": "https://dashboard-biddnest.dev.diginnovators.com/static/images/favicon.svg",
                "handler": function (resp){
                    Logger.info({
                        booking_id:booking_id ,payment_id : resp.razorpay_payment_id,
                    });
                    $.ajax({
                        url: url_status,
                        type: 'post',
                        dataType: 'json',
                        data: {
                            booking_id:booking_id ,payment_id : resp.razorpay_payment_id,
                        },
                        success: function (msg) {
                            // redirectTo(url);
                            window.location.href = url;
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
    $.add($(this).data("url"), {data}, function (response){
        if(response.status == "success")
        {
            tinySuccessAlert("Request Raised Successfully", response.message);
        }
        else
        {
            tinyAlert("Failed", response.message);
        }

    });
    return false;
});

$("body").on('click', ".verify-coupon", function(event) {
    var public_booking_id = document.getElementById("public_booking_id").value;
    var coupon = document.getElementById("coupon").value;
    $.add($(this).data("url"), {public_booking_id, coupon}, function (response){
        if(response.status == "success")
        {
            Logger.info(response);
            tinySuccessAlert("Coupon Verified", response.message);
            $('.discount').html(response.data.discount);
            $('.grand-total').html(response.data.grand_total);
            $('.payment').attr("data-amount",response.data.grand_total);
            $(".verify-coupon").addClass("remove");
            $(".verify-coupon").text("Remove");
            $(".verify-coupon").removeClass("verify-coupon");
        }
        else
        {
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
  var url=$(this).data("url");

    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        success: function (response) {
           Logger.info(response);
            var source = $("#entry-template").html();
            var template = Handlebars.compile(source);
            var html = template(response.data);
            $('.subservices').html(html);
            $('.inventory').html('<div class="col-md-4" data-toggle="modal" data-target="#addItemModal" style="min-height: 40vh !important;">' +
                '                                        <div class="item-single-wrapper add-more" style="height: 100% !important;">' +
                '                                            <i class="icon dripicons-plus" ></i>' +
                '                                        </div>' +
                '                                    </div>');
        }
    });
    return false;
});

$("body").on('click', ".web-sub-category", function(event) {
  var url=$(this).data("url");
   $('#subservice_id').val($(this).val());
    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        success: function (response) {
           Logger.info(response);
            for(var i=0; i< response.data.inventories.length; i++)
            {
                response.data.inventories[i].meta.material=JSON.parse(response.data.inventories[i].meta.material);
                response.data.inventories[i].meta.size=JSON.parse(response.data.inventories[i].meta.size);

            }

            var source = $("#entry-templateinventory").html();
            var template = Handlebars.compile(source);
            var html = template(response.data);
            $('.inventory').html(html);
        }
    });
    return false;
});

$("body").on('click', ".filter-button", function(event) {
    var value = $(this).attr('data-filter');

    if(value == "all")
    {
        $('.filter').show('1000');
    }
    else
    {
        $(".filter").not('.'+value).hide('3000');
        $('.filter').filter('.'+value).show('3000');

    }

    if ($(".filter-button").removeClass("active")) {
        $(this).removeClass("active");
    }
    $(this).addClass("active");

    return false;
});

$("body").on('click', ".add-item", function(event) {
    let item = [];
    $(this).closest(".item-single-wrapper").find("input").each(function(){
            item[$(this).attr('name')] = $(this).val();
        });
    item = Object.assign({}, item);
    Logger.info(item);
    if(item.material == ''){
        megaAlert("Oops", "Please select Material");
        return false;
    }
    if(item.size == ''){
        megaAlert("Oops", "Please select Size");
        return false;
    }
    let class_name=item.meta_name+"-"+item.material+"-"+item.size+"-"+item.meta_id;
    class_name=class_name.replace(' ', '-');
    Logger.info(class_name);
    if($("."+class_name).length > 0)
    {
        megaAlert("Oops", "This item has been already added");
        return false;
    }
    item.meta_material=JSON.parse(item.meta_material);
    item.meta_size=JSON.parse(item.meta_size);

    var source = $("#entry-templateinventory_append").html();
    var template = Handlebars.compile(source);
    var html = template(item);
    $('.inventory .col-md-4:last').before(html);
});

$("body").on('click', ".add-search-item", function(event) {
    let item = [];
    $(this).closest(".item-single-wrapper").find("input").each(function(){
            item[$(this).attr('name')] = $(this).val();
        });
    item = Object.assign({}, item);
    Logger.info(item);
    if(item.material == ''){
        megaAlert("Oops", "Please select Material");
        return false;
    }
    if(item.size == ''){
        megaAlert("Oops", "Please select Size");
        return false;
    }
    item.meta_material=item.meta_material.split(',');
    item.meta_size=item.meta_size.split(',');

    var source = $("#entry-templateinventory_append").html();
    var template = Handlebars.compile(source);
    var html = template(item);
    $('.inventory .col-md-4:last').before(html);

    tinyAlert("Added", "Item has been added.")
});

$("body").on('keyup', ".search-item", function(event) {
        var query = $(this).val();
        var url = $(this).data('url');
        if (query.length >= 3) {
            $.ajax({
                url: url+ "?search=" + query,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    $('.items-display').html('');
                    for(var i=0; i< response.data.inventories.length; i++)
                    {
                        response.data.inventories[i].material=JSON.parse(response.data.inventories[i].material);
                        response.data.inventories[i].size=JSON.parse(response.data.inventories[i].size);
                    }
                    var source = $("#search_item").html();
                    var template = Handlebars.compile(source);
                    var html = template(response.data);
                    $('.items-display').html(html);

                    initRangeSlider();
                }
            });
        }
});

$("body").on('input', ".upload-image", function(event) {
    // var thiss = $(this);
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onloadend = () => {
        $(this).closest('.upload-section').find(".upload-preview").attr("src", reader.result);
        $(this).parent().find(".base-holder").val(reader.result);
        let image= {"image":reader.result};
        var source = $("#image_upload_preview").html();
        var template = Handlebars.compile(source);
        var html = template(image);
        $('.uploaded-image .col-md-2:last').before(html);
    };
    reader.readAsDataURL(file);


});

