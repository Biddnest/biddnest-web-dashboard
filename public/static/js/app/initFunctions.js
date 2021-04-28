/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

export function initMapPicker(){
    $('.source-map-picker').locationpicker({
        location: {
            latitude: 12.930621,
            longitude: 80.111410
        },
        locationName: "",
        radius: 500,
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        styles: [],
        mapOptions: {},
        scrollwheel: true,
        inputBinding: {
            latitudeInput: $("#source-lat"),
            longitudeInput: $("#source-lng"),
            radiusInput: null,
            locationNameInput: $("#source-autocomplete")
        },
        enableAutocomplete: true,
        enableAutocompleteBlur: false,
        autocompleteOptions: null,
        addressFormat: 'street_address',
        enableReverseGeocode: true,
        draggable: true,
        onchanged: function(currentLocation, radius, isMarkerDropped) {},
        onlocationnotfound: function(locationName) {},
        oninitialized: function (component) {},
        // must be undefined to use the default gMaps marker
        markerIcon: undefined,
        markerDraggable: true,
        markerVisible : true
    });

    $('.dest-map-picker').locationpicker({
        location: {
            latitude: 12.930621,
            longitude: 80.111410
        },
        locationName: "",
        radius: 500,
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        styles: [],
        mapOptions: {},
        scrollwheel: true,
        inputBinding: {
            latitudeInput: $("#dest-lat"),
            longitudeInput: $("#dest-lng"),
            radiusInput: null,
            locationNameInput: $("#dest-autocomplete")
        },
        enableAutocomplete: true,
        enableAutocompleteBlur: false,
        autocompleteOptions: null,
        addressFormat: 'street_address',
        enableReverseGeocode: true,
        draggable: true,
        onchanged: function(currentLocation, radius, isMarkerDropped) {},
        onlocationnotfound: function(locationName) {},
        oninitialized: function (component) {},
        // must be undefined to use the default gMaps marker
        markerIcon: undefined,
        markerDraggable: true,
        markerVisible : true
    });
}

export function initAllSelectBoxes() {


    if($(".select-box").length) {
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
    }

    if($(".select-box2").length) {
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
    }
if($(".selectuser").length) {
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
            data: function (params) {

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

            processResults: function (data) {

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
}

    if($(".selectvendor").length){
        $(".searchvendor").select2({
            multiple: true,
            tags: false,
            minimumResultsForSearch: 3,
            minimumInputLength: 3,
            closeOnSelect: false,
            debug: true,
            placeholder: 'Search for vendor',
            // allowClear: true,
            ajax: {
                url: API_SEARCH_VENDOR,
                method: "GET",
                data: function (params) {

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

                processResults: function (data) {

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
    }

    if($(".selectadmin").length){
        $(".searchadmin").select2({
            multiple: true,
            tags: false,
            minimumResultsForSearch: 3,
            minimumInputLength: 3,
            closeOnSelect: false,
            debug: true,
            placeholder: 'Search for admin',
            // allowClear: true,
            ajax: {
                url: API_SEARCH_ADMIN,
                method: "GET",
                data: function (params) {

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

                processResults: function (data) {

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
    }

}

export function initSlick(){
  if($(".slick-container").length) {
      $('.slick-container').slick({
          arrows: false
      });
  }
}

export function initTextAreaEditor(){
    if($('.editor').length) {
        var editor = new FroalaEditor('.editor');
    }

}

/*Charts*/
export function initRevenueChart(){
    if($("#myRevenueChart").length && typeof REVENUE_DATASET !== undefined){
        // var dataset = $("#revenue-chart-data").html();
        // console.log(dataset);

        var ctx = document.getElementById("myRevenueChart")
        var myChart = new Chart(ctx, {
            type: 'line',
            data: REVENUE_DATASET,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                },
                responsive: true, // Instruct chart js to respond nicely.
                maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
            }
        });
    }

}

export function initCountdown(){
    if($(".timer").length){
        var BID_END_TIME = $(".timer").data("time");
        $(".timer")
            .countdown(BID_END_TIME, function (event) {
                $(this).text(
                    event.strftime('%H:%M:%S')
                );
            });
    }

}
export function initDatePicker(){
    if($(".date").length) {
        $('.date').datepicker({
            multidate: true,
            format: 'yyyy-mm-dd',
            'startDate': '+1d'
        });
    }
}
