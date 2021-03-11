/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

// const helper = import("./helpers.js");
import { redirectTo, inlineAlert, megaAlert, tinyAlert, revertFormAnim, triggerFormAnim } from "./helpers.js";
// require("./helpers");
const env = "development";

/* Initializations */
const logger = $.Logger();

if(env == "production")
    logger.enable();
else
    logger.disable();



/* AJAX Universal */
$("body").on('submit',"form",function() {
    // var valid = $(this).parsley().validate();


    if(true){
        let form = $(this);
        let requestData = form.serializeJSON();
        let button = form.find("button[type=submit]");
        let buttonPretext = button.html();
        logger.log(requestData);

        $.ajax({
            url:form.attr("action"),
            method: form.attr("method"),
            data: JSON.stringify(requestData),
            contentType: "application/json",
            beforeSend: () => {
                triggerFormAnim(button);
            },
            success: (response) =>{
                console.log(response);
                logger.log(response);
                if(response.status == "success"){
                    if(form.data("next") == "redirect"){
                        redirectTo(form.data("url"));
                    }
                    if(form.data("next") == "refresh"){
                        redirectTo($(location).attr("href"));
                    }
                }
                else if(response.status == "fail"){

                    if(form.data("alert") == "tiny")
                       tinyAlert("Oops",response.message);
                    else if(form.data("alert") == "inline")
                        inlineAlert(form, response.message);
                    else
                        megaAlert("Oops",response.message);

                }
                else{
                    logger.log(response.message);
                }
            },
            error: (error, b, c) =>{
                logger.log(error.responseText, b, c);
            },
        });
        revertFormAnim(button, buttonPretext);
        return false;
    }
    else{
        //Do something here
    }
});
