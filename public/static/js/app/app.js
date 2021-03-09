/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

const helper = import("helpers");

const env = "development";

/* Initializations */
const logger = $.Logger();

if(env === "production")
    logger.enable();
else
    logger.disable();

/* AJAX Universal */
$("body").on('submit',"form",() => {
    var valid = $(this).parsley.validate();

    if(valid){
        let form = $(this);
        let requestData = form.serializeJSON();
        let button = form.find("button[type=text]");
        let buttonPretext = button.html();

        $.ajax({
            url:form.attr("action"),
            method: form.attr("method"),
            data:JSON.stringify(requestData),
            beforeSend: () => {
                helper.triggerFormAnim(button);
            },
            success: (response) =>{
                logger.debug(response);
                if(response.status == "success"){
                    if(form.data("next") == "redirect"){
                        helper.redirectTo(form.data("url"));
                    }
                    if(form.data("next") == "refresh"){
                        helper.redirectTo($(location).attr("href"));
                    }
                }
                else if(response.status == "fail"){

                    if(form.data("alert") == "tiny")
                        helper.tinyAlert("Oops",response.message);
                    else
                        helper.megaAlert("Oops",response.message);

                }
                else{
                    logger.debug(response.message);
                }
            },
            error: (error) =>{
                logger.debug(error.responseText);
            },
        });
        helper.triggerFormAnim(button, buttonPretext);
        return false;
    }
    else{
        //Do something here
    }
});
