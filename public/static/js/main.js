/*
var input = document.querySelector("#phone");
window.intlTelInput(input, {
    initialCountry: "in",
    separateDialCode: true,
    autoPlaceholder: "9739912345",

    // iti.setCountry("");

    // any initialisation options go here
});

var input = document.querySelector("#phone1");
window.intlTelInput(input, {
    initialCountry: "in",
    separateDialCode: true,
    autoPlaceholder: "9739912345",

    // iti.setCountry("");

    // any initialisation options go here
});

var input = document.querySelector("#phonefriend");
window.intlTelInput(input, {
    initialCountry: "in",
    separateDialCode: true,
    autoPlaceholder: "9739912345",

    // iti.setCountry("");

    // any initialisation options go here
});

var input = document.querySelector("#phone-pop-up");
window.intlTelInput(input, {
    initialCountry: "in",
    separateDialCode: true,
    autoPlaceholder: "9739912345",

    // iti.setCountry("");

    // any initialisation options go here
});
*/

/*


//create vendor onboard ===============
var input = document.querySelector("#input-blue");
window.intlTelInput(input, {
    initialCountry: "in",
    separateDialCode: true,
    autoPlaceholder: "9739912345",

    // iti.setCountry("");

    // any initialisation options go here
});

var input = document.querySelector("#Employee");
window.intlTelInput(input, {
    initialCountry: "in",
    separateDialCode: true,
    autoPlaceholder: "9739912345",

    // iti.setCountry("");

    // any initialisation options go here
});

*/

$("div.sortable").sortable({
    handle: '.dragger',
});

$(document).ready(function() {
    // $('#coupon-source').tagsInput();



    $(".select-box").select2({
        tags: false,
        multiple: true,
        closeOnSelect: false,
        // debug: true,
        // allowClear: true,
        placeholder: 'Type here',
        minimumResultsForSearch: 1,
        // minimumInputLength: 3,
    });

    $(".select-box2").select2({
        tags: true,
        multiple: true,
        closeOnSelect: false,
        // debug: true,
        // allowClear: true,
        placeholder: 'Search here',
        minimumResultsForSearch: 1,
        // minimumInputLength: 3,
    });

    $(".searchuser").select2({
        multiple: true,
        tags: false,
        minimumResultsForSearch: 3,
        minimumInputLength: 3,
        closeOnSelect: false,
        debug: true,
        placeholder: 'Search for users',
        // allowClear: true,
        ajax: {
            url: API_SEARCH_USERS,
            method: "GET",
            data: function(params) {

                var query = {
                    q: params.term,
                    page: params.page || 1
                }

                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            error: (a, b, c) => {
                Logger.error(a.responseText, b, c);
            },

            processResults: function(data) {

                // Transforms the top-level key of the response object from 'items' to 'results'
                var output = [];
                for (var i = 0; i < data.data.users.length; i++) {
                    output.push({
                        id: data.data.users[i].id,
                        text: data.data.users[i].fname + " " + data.data.users[i].lname + " - " + data.data.users[i].email
                    })
                }


                return {
                    results: output
                };
            }

        }
    });

    $(".searchvendor").select2({
        multiple: true,
        tags: false,
        minimumResultsForSearch: 3,
        minimumInputLength: 3,
        closeOnSelect: false,
        debug: true,
        placeholder: 'Search for users',
        // allowClear: true,
        ajax: {
            url: API_SEARCH_VENDOR,
            method: "GET",
            data: function(params) {

                var query = {
                    q: params.term,
                    page: params.page || 1
                }

                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            error: (a, b, c) => {
                Logger.error(a.responseText, b, c);
            },

            processResults: function(data) {

                // Transforms the top-level key of the response object from 'items' to 'results'
                var output = [];
                for (var i = 0; i < data.data.users.length; i++) {
                    output.push({
                        id: data.data.users[i].id,
                        text: data.data.users[i].org_name + " " + data.data.users[i].org_type + " - " + data.data.users[i].email
                    })
                }


                return {
                    results: output
                };
            }

        }
    });

    $(".searchadmin").select2({
        multiple: true,
        tags: false,
        minimumResultsForSearch: 3,
        minimumInputLength: 3,
        closeOnSelect: false,
        debug: true,
        placeholder: 'Search for users',
        // allowClear: true,
        ajax: {
            url: API_SEARCH_ADMIN,
            method: "GET",
            data: function(params) {

                var query = {
                    q: params.term,
                    page: params.page || 1
                }

                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            error: (a, b, c) => {
                Logger.error(a.responseText, b, c);
            },

            processResults: function(data) {

                // Transforms the top-level key of the response object from 'items' to 'results'
                var output = [];
                for (var i = 0; i < data.data.users.length; i++) {
                    output.push({
                        id: data.data.users[i].id,
                        text: data.data.users[i].fname + " " + data.data.users[i].lname + " - " + data.data.users[i].email
                    })
                }


                return {
                    results: output
                };
            }

        }
    });

    /*

        $('.searchuser').selectize({
            valueField: 'id',
            labelField: 'fname',
            // searchField: 'sname',
            create: false,
            render: {
                option: function(user, escape) {

                    return '<div class="profile-section">\n' +
                        '                                    <figure>\n' +
                        '                                        <img src="'+escape(user.image)+'" alt="" width="80%">\n' +
                        '                                    </figure>\n' +
                        '                                    <div class="profile-details-side-pop">\n' +
                        '                                        <ul>\n' +
                        '                                            <li>\n' +
                        '                                                <h1>'+escape(user.fname)+' '+escape(user.lname)+'</h1>\n' +
                        '                                                <i class="fa fa-pencil pr-1 mr-1 " style="color: #3BA3FB;" aria-hidden="true"></i>\n' +
                        '                                            </li>\n' +
                        '                                            <li>\n' +
                        '                                                <h2>'+escape(user.email)+'</h2>\n' +
                        '                                                <a href="#">\n' +
                        '                                                    <i class="fa fa-star-o pr-1 mr-1" aria-hidden="true"></i>\n' +
                        '                                                </a>\n' +
                        '                                            </li>\n' +
                        '                                            <li>\n' +
                        '                                                <p>'+escape(user.phone)+'</p>\n' +
                        '\n' +
                        '                                            </li>\n' +
                        '                                        </ul>\n' +
                        '                                    </div>\n' +
                        '                                </div>';
                }
            },

            load: function(query, callback) {
                if (!query.length || query.length <= 3) return callback();
                $.ajax({
                    url: API_SEARCH_USERS + '?query=' + encodeURIComponent(query),
                    type: 'GET',
                    beforeSend: function(){console.log("calling");},
                    error: function() {
                        callback();
                    },
                    success: function(res) {
                        console.log(res.data.users);
                        callback(res.data.users);
                    }
                });
            }
        });

    */





    return false;
    // $(function() {
    //     $('ul.menu li').on('click', function() {
    //         $(this).parent().find('li.active-menu-item').addClass('b-purple').removeClass('active-menu-item');
    //         $(this).removeClass(' li.b-purple');
    //         $(this).addClass('li.active-menu-item');
    //     });
    // });

    // const loader = document.querySelector('.loader');
    // $('[name=email]').keyup(function() {

    //     if ($('form').valid()) {
    //         $(this).parent().removeClass().addClass('isvalid');
    //     } else {
    //         $(this).parent().removeClass().addClass('notvalid');
    //     }

    // });

    // $("#switch").click(function() {
    //     if ($("#switch").prop('checked')) {
    //         $(".phone-num-lable").html("Friend's Phone Number");
    //         $('.full-name').html("Friend's Full Name");
    //         $('.email-label').html("Friend's Email")

    //     } else {
    //         $(".phone-num-lable").html("Phone Number")
    //         $('.full-name').html("Full Name");
    //         $('.email-label').html("Email")
    //     }
    // });

    // // Toggle divs
    // $(".reject").click(function() {
    //     // alert('wle')
    //     $('.rejection-message').toggle();
    //     $('.order-cards').toggle();
    //     $('.reject-btn').html('Submit')
    // });

    // $(".card-price").click(function() {
    //     $('.order-cards').toggle();
    //     $('.reject-btn').toggle();
    //     $('.Order-sucess').toggleClass('diplay-none')
    // });

    // $(".step-1").click(function() {
    //     $('.sub-total').removeClass('diplay-none');
    //     $('.payment-status').addClass('diplay-none');
    //     $('.paid-status').addClass('diplay-none')
    //     $('.payment-suscessful').addClass('diplay-none');
    // });

    // $(".step-2").click(function() {
    //     $('.sub-total').addClass('diplay-none');
    //     $('.payment-status').removeClass('diplay-none');
    //     $('.payment-suscessful').addClass('diplay-none');
    // });

    // $(".step-3").click(function() {
    //     $('.payment-suscessful').removeClass('diplay-none');
    //     $('.payment-status').addClass('diplay-none');
    // });

    // $(".q-viewmore").click(function() {
    //     $('.quotation-main').toggleClass('diplay-none');
    //     $('.view-more').toggleClass('diplay-none');
    // });

    // $(".assign-btn").click(function() {
    //     $('.bidlist-table').toggleClass('diplay-none');
    //     $('.assign-manul-table').toggleClass('diplay-none');
    // });

    // $(".back-btn").click(function() {
    //     $('.assign-manul-table').toggleClass('diplay-none');
    //     $('.bidlist-table').toggleClass('diplay-none');
    // });


    // $("#switch").change(function() {
    //     $(".toggle-input").toggleClass('diplay-none');

    // });

    // $("#backbtn").click(function() {

    //     $('.rejection-message').addClass("diplay-none");
    //     $('.order-cards').removeClass("diplay-none");


    // });

    // $("#economy").change(function() {
    //     if ($("#economy").is(":checked")) {
    //         $(".eco").addClass("blue-bg")
    //         $(".pre").removeClass("blue-bg")
    //         $('.eco-card').addClass("border-white")
    //         $('.pre-card').removeClass("border-white")
    //     } else {
    //         $(".eco").removeClass("blue-bg")
    //         $('.eco-card').removeClass("border-white")
    //     }
    // });
    // $("#premium").change(function() {
    //     if ($("#premium").is(":checked")) {
    //         $(".pre").addClass("blue-bg");
    //         $(".eco").removeClass("blue-bg")
    //         $('.eco-card').removeClass("border-white")
    //         $('.pre-card').addClass("border-white")
    //     } else {
    //         $(".pre").removeClass("blue-bg")
    //         $('.pre-card').removeClass("border-white")
    //     }
    // })


    // var i = 1;
    // $("#addnew-btn").click(function() {

    //     $('#addr' + i).html(`<th scope='row'>
    //    <div class="select">
    //      <select class="form-control" id="table-select">
    //    <option>sku123456</option>
    //    <option>sku123456</option>
    //    <option>sku123456</option>
    //    <option>sku123456</option>
    //    </select>
    //      </div>




    //    </th><td class='text-center'> <div class="select">
    //      <select class="form-control">
    //    <option>2</option>
    //    <option>4</option>
    //    <option>8</option>
    //    <option>24</option>
    //    </select>
    //      </div></td> <td class=""> <div class="select">
    //      <select class="form-control" id="table-select">
    //    <option>Small</option>
    //    <option>Large</option>
    //    <option>Medium</option>

    //    </select>
    //      </div></td> <td> <button class=" btn btn-1 theme-bg white-text " >
    //         Add </button> </td>`);

    //     $('#items').append('<tr id="addr' + (i + 1) + '"></tr>');
    //     i++;
    // });


    // $(".eco").click(function() {

    //     $("#economy").prop("checked", true);
    //     $(".eco").addClass("blue-bg")
    //     $(".pre").removeClass("blue-bg")
    //     $('.eco-card').addClass("border-white")
    //     $('.pre-card').removeClass("border-white")


    // });
    // $(".pre").click(function() {

    //     $("#premium").prop("checked", true);
    //     $(".pre").addClass("blue-bg");
    //     $(".eco").removeClass("blue-bg")
    //     $('.eco-card').removeClass("border-white")
    //     $('.pre-card').addClass("border-white")
    // });


    // $(".reject").click(function() {
    //     $(".rejection-message").toggle();
    //     $(".order-cards").toggle();
    //     $(".reject-btn").html("Submit");
    // });

    // $(".collapse-form").click(function() {
    //     $(this).toggleClass("form-open");
    //     $(this).toggleClass("form-close");
    // });

    // $('.js-example-basic-multiple').select2();

    // $('.slick-container').slick({
    //     arrows: false
    // });
    // $('.slick-container-2').slick({
    //     arrows: false
    // });
    // $('.slick-container-3').slick({
    //     arrows: false
    // });
    // $('.slick-container-4').slick({
    //     arrows: false
    // });
    // $('.slick-container-5').slick({
    //     arrows: false
    // });
    // $('.slick-container-6').slick({
    //     arrows: false
    // });


    // var acc = document.getElementsByClassName("accordion");
    // var i;
    // console.log(acc.length);
    // for (i = 0; i <= acc.length; i++) {
    //     acc[i].addEventListener("click", function() {
    //         this.classList.toggle("active");
    //         var panel = this.nextElementSibling;
    //         if (panel.style.display === "block") {
    //             panel.style.display = "none";
    //         } else {
    //             panel.style.display = "block";
    //         }
    //     });
    // }


});

// $('#tomap').locationpicker();
// $('#frommap').locationpicker();

// ('.dateselect').datepicker({
//     format: 'mm/dd/yyyy',
// });


// // create vendor onboard====
// function getBase64(file) {
//     var reader = new FileReader();
//     reader.readAsDataURL(file);
//     reader.onload = function() {
//         console.log(reader.result);
//     };
//     reader.onerror = function(error) {
//         console.log('Error: ', error);
//     };
// }
// const MAX_2_MB = 2000000;
// $(function() {
//     $("#aadhar-upload").change(function(e) {
//         var selectedFile = e.target.files[0]
//         console.log('hello megha', getBase64(selectedFile))
//         var reader = new FileReader();
//         reader.readAsDataURL(selectedFile);

//         reader.onload = function(e) {
//             $('#aadhar-preview').attr('src', e.target.result);
//             $('#upload-btn').html('Remove Image')
//             $('#upload-btn').css('background-color', 'red')

//         }

//         if (selectedFile.size > MAX_2_MB) {
//             $("#file-aadhar").html('Invalid file or File size has exceeded');
//         } else {
//             $("#file-aadhar").html(selectedFile.name.substr(0, 10) + "...");
//         }
//     });
// });


// $(function() {
//     $("table tbody").sortable();
// });
// var div = $('.cursor-pointer');
// div.mousedown(function() {
//     $(this).css("background-color", "#F1F9FF;");
// });
// div.mouseup(function() {
//     $(this).css("background-color", "#FFFFFF");
// });

// tinymce.init({
//     selector: '#mytextarea'
// });
