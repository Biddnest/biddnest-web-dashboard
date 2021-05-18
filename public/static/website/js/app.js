/* AJAX Universal */
$("body").on('submit', "form", function() {
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

            // console.log("Response ",response);
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
                        if (form.data('redirect-type') == "hard")
                            redirectHard(form.data("url")); // data-url="google.com"
                        else
                            redirectTo(form.data("url"));
                    } else if (form.data("next") == "refresh") {
                        location.reload();
                    }
                }
            } else if (response.status == "fail") {

                if (form.data("alert") == "tiny")
                    tinyAlert("Oops", response.message);
                else if (form.data("alert") == "inline")
                    inlineAlert(form, response.message);
                else
                    megaAlert("Oops", response.message);

                revertFormAnim(button, buttonPretext);
            } else {
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