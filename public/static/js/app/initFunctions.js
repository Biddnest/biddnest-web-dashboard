/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

import { redirectTo } from "./helpers.js";

export function initMapPicker() {
    var lat = $('#source-lat').val();
    var lng = $('#source-lng').val();
    if (lat == "" && lng == "") {
        lat = 12.930621;
        lng = 80.111410;
    }
    var dlat = $('#dest-lat').val();
    var dlng = $('#dest-lng').val();
    if (dlat == "" && dlng == "") {
        dlat = 12.930621;
        dlng = 80.111410;
    }
    $('.source-map-picker').locationpicker({
        location: {
            latitude: lat,
            longitude: lng
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
            locationNameInput: $(".source-autocomplete")
        },
        enableAutocomplete: true,
        enableAutocompleteBlur: false,
        autocompleteOptions: null,
        addressFormat: 'street_address',
        enableReverseGeocode: true,
        draggable: true,
        onchanged: function(currentLocation, radius, isMarkerDropped) {

            var url = "https://maps.googleapis.com/maps/api/geocode/json?address=" + currentLocation.latitude + "," + currentLocation.longitude + "&key=" + API_google_key;
            $.get(url, function(response) {
                console.log(response);
                let street = [];
                let city, state, pincode = null;
                for (let i = 0; i <= response.results[0].address_components.length; i++) {
                    let addr = response.results[0].address_components[i];
                    if (typeof addr != "undefined") {

                        if ((addr.types.includes('locality') && addr.types.includes('political')) || addr.types.includes('administrative_area_level_2')) {
                            console.log(addr.long_name);
                            if (!city)
                                city = addr.long_name;
                        }
                        if (addr.types.includes('administrative_area_level_1') && addr.types.includes('political')) {
                            if (!state)
                                state = addr.long_name;
                        }
                        if (addr.types.includes('postal_code')) {
                            if (!pincode)
                                pincode = addr.long_name;
                        }
                    }

                    $('.source-autocomplete').eq(1).val(response.results[0].formatted_address);
                }
                $("#source-city").val(city);
                $("#source-state").val(state);
                $("#source-pin").val(pincode);
                console.log(city, state, pincode);
            });


        },
        onlocationnotfound: function(locationName) {},
        oninitialized: function(component) {},
        // must be undefined to use the default gMaps marker
        markerIcon: undefined,
        markerDraggable: true,
        markerVisible: true,

    });

    $('.dest-map-picker').locationpicker({
        location: {
            latitude: dlat,
            longitude: dlng
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
            locationNameInput: $(".dest-autocomplete")
        },
        enableAutocomplete: true,
        enableAutocompleteBlur: false,
        autocompleteOptions: null,
        addressFormat: 'street_address',
        enableReverseGeocode: true,
        draggable: true,
        onchanged: function(currentLocation, radius, isMarkerDropped) {
            var url = "https://maps.googleapis.com/maps/api/geocode/json?address=" + currentLocation.latitude + "," + currentLocation.longitude + "&key=" + API_google_key;
            $.get(url, function(response) {
                console.log(response);
                let street = [];
                let city, state, pincode = null;
                for (let i = 0; i <= response.results[0].address_components.length; i++) {
                    let addr = response.results[0].address_components[i];
                    if (typeof addr != "undefined") {
                        if ((addr.types.includes('locality') && addr.types.includes('political')) || addr.types.includes('administrative_area_level_2')) {
                            console.log(addr.long_name);
                            if (!city)
                                city = addr.long_name;
                        }
                        if (addr.types.includes('administrative_area_level_1') && addr.types.includes('political')) {
                            if (!state)
                                state = addr.long_name;
                        }
                        if (addr.types.includes('postal_code')) {
                            if (!pincode)
                                pincode = addr.long_name;
                        }
                    }

                    $('.dest-autocomplete').eq(1).val(response.results[0].formatted_address);

                }
                $("#dest-city").val(city);
                $("#dest-state").val(state);
                $("#dest-pin").val(pincode);

            });
        },
        onlocationnotfound: function(locationName) {},
        oninitialized: function(component) {},
        // must be undefined to use the default gMaps marker
        markerIcon: undefined,
        markerDraggable: true,
        markerVisible: true
    });
}

export function initZoneMap() {
    if ($(".zone-map").length) {

        function resetMap(controlDiv) {
            // Set CSS for the control border.
            const controlUI = document.createElement("div");
            controlUI.style.backgroundColor = "#fff";
            controlUI.style.border = "2px solid #fff";
            controlUI.style.borderRadius = "3px";
            controlUI.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
            controlUI.style.cursor = "pointer";
            controlUI.style.marginTop = "8px";
            controlUI.style.marginBottom = "22px";
            controlUI.style.textAlign = "center";
            controlUI.title = "Reset map";
            controlDiv.appendChild(controlUI);
            // Set CSS for the control interior.
            const controlText = document.createElement("div");
            controlText.style.color = "rgb(25,25,25)";
            controlText.style.fontFamily = "Roboto,Arial,sans-serif";
            controlText.style.fontSize = "10px";
            controlText.style.lineHeight = "16px";
            controlText.style.paddingLeft = "2px";
            controlText.style.paddingRight = "2px";
            controlText.innerHTML = "X";
            controlUI.appendChild(controlText);
            // Setup the click event listeners: simply set the map to Chicago.
            controlUI.addEventListener("click", () => {
                lastpolygon.setMap(null);
                $('#coordinates').val('');

            });
        }

        var map; // Global declaration of the map
        var drawingManager;
        var lastpolygon = null;
        var polygons = [];
        let markers = [];

        var myOptions = {
            zoom: 13,
            center: {
                lat: 12.930621,
                lng: 80.111410
            },
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById("zone-map"), myOptions);
        drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.POLYGON,
            drawingControl: true,
            drawingControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER,
                drawingModes: [google.maps.drawing.OverlayType.POLYGON]
            },
            polygonOptions: {
                editable: true
            }
        });
        drawingManager.setMap(map);
        google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
            if (lastpolygon) {
                lastpolygon.setMap(null);
            }
            $('#zone-coords').val(event.overlay.getPath().getArray());
            Logger.info(event.overlay.getPath().getArray());
            lastpolygon = event.overlay;
        });

        const resetDiv = document.createElement("div");
        resetMap(resetDiv, lastpolygon);
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(resetDiv);

        // Create the search box and link it to the UI element.
        const input = document.getElementById("zone-map-search");
        const searchBox = new google.maps.places.SearchBox(input);
        // map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener("bounds_changed", () => {
            searchBox.setBounds(map.getBounds());
        });

        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener("places_changed", () => {
            const places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }
            // Clear out the old markers.
            markers.forEach((marker) => {
                marker.setMap(null);
            });
            markers = [];
            // For each place, get the icon, name and location.
            const bounds = new google.maps.LatLngBounds();
            places.forEach((place) => {
                if (!place.geometry || !place.geometry.location) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                const icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25),
                };
                // Create a marker for each place.
                markers.push(
                    new google.maps.Marker({
                        map,
                        icon,
                        title: place.name,
                        position: place.geometry.location,
                    })
                );

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });

        $.get(API_FETCH_ZONES, function(response) {
            Logger.info(response);

            if (response.status == "success") {
                let i = 0;
                response.data.zones.map((zone) => {

                    let current_id = false;
                    if ($("#zone_id").length)
                        current_id = $("#zone_id").val();

                    let poly_bounds = new google.maps.LatLngBounds();
                    let polygonCoords = [];

                    for (let k = 0; k < zone.coordinates.length; k++) {
                        polygonCoords.push(new google.maps.LatLng(zone.coordinates[k]['lat'], zone.coordinates[k]['lng']));
                    }

                    Logger.info("Poly cord object", polygonCoords);

                    for (let j = 0; j < polygonCoords.length; j++) {
                        poly_bounds.extend(polygonCoords[j]);


                    }

                    polygons.push(new google.maps.Polygon({
                        paths: zone.coordinates,
                        strokeColor: current_id == zone.id ? "#2E0789" : "#d2ac25",
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: current_id == zone.id ? "#9266fd" : "#fdc403",
                        fillOpacity: 0.1,
                        // draggable: current_id == zone.id ? true : false,
                        editable: current_id == zone.id ? true : false,
                        zIndex: current_id == zone.id ? 9999 : 99,

                    }));
                    polygons[i].setMap(map);
                    i++;

                    let infoWindow = new google.maps.InfoWindow({});

                    // google.maps.event.addListener(polygon, 'mouseover', function (e) {
                    infoWindow.setContent(zone.name);
                    // let latLng = e.latLng;
                    infoWindow.setPosition(poly_bounds.getCenter());
                    infoWindow.open(map);

                    if (current_id == zone.id)
                        map.setCenter(poly_bounds.getCenter());
                    // });

                });
            }

        });

    }
}

export function initAllSelectBoxes() {


    if ($(".select-box").length) {
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
    if ($(".select-box-model").length) {
        $(".select-box-model").each(function() {
            let model = $(this);
            $(this).select2({
                tags: false,
                multiple: true,
                closeOnSelect: false,
                // debug: true,
                // allowClear: true,
                placeholder: 'Type here',
                minimumResultsForSearch: 1,
                dropdownParent: model.closest(".form-input"),
                // minimumInputLength: 3,
            });
        });
    }

    if ($(".select-box2").length) {
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

    if ($(".searchuser").length) {

        let multiple = true;
        if ($(".searchuser").hasClass('single'))
            multiple = false;

        $(".searchuser").select2({
            multiple: multiple,
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
    }

    if ($(".searchvendor").length) {

        let multiple = true;
        if ($(".searchvendor").hasClass('single'))
            multiple = false;

        $(".searchvendor").select2({
            multiple: multiple,
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
    }

    if ($(".selectadmin").length) {
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
    }

    if ($(".searchitem").length) {

        $(".searchitem").select2({
            multiple: true,
            tags: false,
            minimumResultsForSearch: 3,
            minimumInputLength: 3,
            closeOnSelect: false,
            debug: true,
            placeholder: 'Search for items',
            // allowClear: true,
            ajax: {
                url: API_SEARCH_ITEM,
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
                    for (var i = 0; i < data.data.items.length; i++) {
                        output.push({
                            id: data.data.items[i].id,
                            text: data.data.items[i].name
                        })
                    }

                    return {
                        results: output
                    };
                }

            }
        });
    }

    if ($(".searchorder").length) {

        let multiple = true;
        if ($(".searchorder").hasClass('single'))
            multiple = false;

        $(".searchorder").select2({
            multiple: multiple,
            tags: false,
            minimumResultsForSearch: 3,
            minimumInputLength: 3,
            closeOnSelect: false,
            debug: true,
            placeholder: 'Search for order id',
            // allowClear: true,
            ajax: {
                url: API_SEARCH_ORDER,
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
                    for (var i = 0; i < data.data.order.length; i++) {
                        output.push({
                            id: data.data.order[i].public_booking_id,
                            text: data.data.order[i].public_booking_id + "-" + data.data.order[i].user.fname + " " + data.data.order[i].user.lname
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

export function initSlick() {
    $('.slick-container').slick({
        arrows: false
    });
}

export function initTextAreaEditor() {
    // $("textarea").addClass('editor');
    if ($('textarea').length) {
        // var editor = new FroalaEditor('.editor');
        $('textarea').not(".select2-search__field").richText();

    }

}

export function initTooltip() {
    $('[data-toggle="tooltip"]').tooltip({ trigger: "hover" });
    $('[data-toggle="tooltip').on('click', function() {
        $(this).tooltip('hide');
    });
}

export function initequalheights() {
    $("form").find("input").attr("autcomplete", "false");
    $(".match-item").eq(1).find("div").each(function(index) {
        $(".match-item").eq(0).find("div").eq(index).height($(this).height());
    });
}

/*Charts*/
export function initRevenueChart() {
    // console.log("icam called");
    if ($("#revenue_dataset").length) {
        var dataset = JSON.parse($("#revenue_dataset").val());

        var myChart = new Chart(document.getElementById("myRevenueChart"), {
            type: 'line',
            data: {
                labels: dataset.revenue.this_week.dates,
                datasets: [{
                        label: 'Most Recent',
                        data: dataset.revenue.last_week.sales,

                        backgroundColor: [
                            'rgba(231,230,241,0.7)',

                        ],
                        borderColor: [
                            'rgba(45,43,135,1)',
                            'rgba(45,43,135,1)',
                            'rgba(45,43,135,1)',
                            'rgba(45,43,135,1)',
                            'rgba(45,43,135,1)',
                            'rgba(45,43,135,1)',
                            'rgba(45,43,135,1)',
                        ],
                        borderWidth: 1
                    },
                    /*{
                        label: 'This Week',
                        data: dataset.revenue.this_week.sales,
                        borderDash: [10, 5],

                        backgroundColor: [
                            'rgba(255,252,242,0.7)',

                        ],
                        borderColor: [
                            'rgba(248,204,72,1)',
                            'rgba(248,204,72,1)',
                            'rgba(248,204,72,1)',
                            'rgba(248,204,72,1)',
                            'rgba(248,204,72,1)',
                            'rgba(248,204,72,1)',


                        ],
                        borderWidth: 1
                    }*/
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                responsive: true, // Instruct chart js to respond nicely.
                maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
            }
        });
        // return false;
    }
}

export function initOrderDistributionChart() {
    // console.log("icam called");
    if ($("#my-legend-con").length) {
        Chart.pluginService.register({
            beforeDraw: function(chart) {
                var width = chart.chart.width,
                    height = chart.chart.height,
                    ctx = chart.chart.ctx;
                ctx.restore();
                var fontSize = (height / 114).toFixed(2);
                ctx.font = fontSize + "em sans-serif";
                ctx.textBaseline = "middle";
                var text = chart.config.options.elements.center ? text : '',
                    textX = Math.round((width - ctx.measureText(text).width) / 2),
                    textY = height / 2;
                ctx.fillText(text, textX, textY);
                ctx.save();
            }
        });
        if ($("#order_dist_dataset").length) {
            var chartData = JSON.parse($("#order_dist_dataset").val());
            var sum = chartData.map((item) => item.value).reduce((a, b) => a + b);
            var textInside = sum.toString();
            var myChart = new Chart(document.getElementById('mychart'), {
                type: 'doughnut',
                animation: {
                    animateScale: true
                },
                data: {
                    labels: chartData.map((item) => item.label),
                    datasets: [{

                        label: 'Visitor',
                        data: chartData.map((item) => item.value),
                        backgroundColor: [
                            "#f8c446",
                            "#fbd64e",
                            "#fcdf75",
                            "#fdeaa7",
                            "#fef6d9",
                        ]
                    }]
                },
                options: {
                    cutoutPercentage: 75,

                    elements: {
                        center: {
                            text: textInside
                        }
                    },
                    responsive: true,
                    legend: false,
                    legendCallback: function(chart) {

                        var legendHtml = [];
                        legendHtml.push('<ul>');
                        var item = chart.data.datasets[0];
                        for (var i = 0; i < item.data.length; i++) {

                            legendHtml.push('<li>');
                            legendHtml.push('<span class="chart-legend" style=" background-color:' + item.backgroundColor[i] + '"></span>');
                            legendHtml.push(`<div class="legend-text"><span class="chart-legend-label-text">${chart.data.labels[i]} (${chart.data.datasets[0].data[i]})</span></span> </div>`);
                            legendHtml.push('</li>');
                        }

                        legendHtml.push('</ul>');
                        return legendHtml.join("");

                    },
                    tooltips: {
                        enabled: true,
                        mode: 'label',
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var indice = tooltipItem.index;
                                return data.labels[indice];
                            }
                        }
                    },
                }
            });
        }

        $('#my-legend-con').html(myChart.generateLegend());
    }
}

export function initOrderDistributionChartVendor() {
    // console.log("icam called");
    if ($("#my-legend-con_vendor").length) {
        Chart.pluginService.register({
            beforeDraw: function(chart) {
                var width = chart.chart.width,
                    height = chart.chart.height,
                    ctx = chart.chart.ctx;
                ctx.restore();
                var fontSize = (height / 90).toFixed(2);
                ctx.font = fontSize + "em sans-serif";
                ctx.textBaseline = "middle";
                var text = chart.config.options.elements.center ? text : '',
                    textX = Math.round((width - ctx.measureText(text).width) / 2),
                    textY = height / 2;
                ctx.fillText(text, textX, textY);
                ctx.save();
            }
        });
        if ($("#order_dist_dataset_vendor").length) {
            var chartData = JSON.parse($("#order_dist_dataset_vendor").val());
            console.log(chartData);
            var sum = chartData.map((item) => item.value).reduce((a, b) => a + b);
            var textInside = sum.toString() + " " +
                "Orders";
            var myChart = new Chart(document.getElementById('mychart'), {
                type: 'doughnut',
                animation: {
                    animateScale: true
                },
                data: {
                    labels: chartData.map((item) => item.label),
                    datasets: [{

                        label: 'Visitor',
                        data: chartData.map((item) => item.value),
                        backgroundColor: [
                            "#83E8B5",
                            "#FFADB4",
                            "#B9BDFC",
                            "#FEA7D0",
                            "#EAD6FF",
                        ]
                    }]
                },
                options: {
                    cutoutPercentage: 75,

                    elements: {
                        center: {
                            text: textInside

                        }
                    },
                    responsive: true,
                    legend: false,
                    legendCallback: function(chart) {

                        var legendHtml = [];
                        legendHtml.push('<ul>');
                        var item = chart.data.datasets[0];
                        for (var i = 0; i < item.data.length; i++) {

                            legendHtml.push('<li>');
                            legendHtml.push('<span class="chart-legend" style=" background-color:' + item.backgroundColor[i] + '"></span>');
                            legendHtml.push(`<div class="legend-text"><span class="chart-legend-label-text">${chart.data.labels[i]} (${chart.data.datasets[0].data[i]})</span></span> </div`);
                            legendHtml.push('</li>');
                        }

                        legendHtml.push('</ul>');
                        return legendHtml.join("");

                    },
                    tooltips: {
                        enabled: true,
                        mode: 'label',
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var indice = tooltipItem.index;
                                return data.labels[indice];
                            }
                        }
                    },
                    /*tooltips: {
                        enabled: true,
                        mode: 'label',
                        yAlign: 'bottom',


                        callbacks: {
                            label: function(tooltipItem, data) {
                                var indice = tooltipItem.index;
                                return  data.labels[indice] ;
                            }
                        }
                    },*/
                }
            });
        }

        $('#my-legend-con_vendor').html(myChart.generateLegend());
    }
}

export function InitUserZoneChart() {
    if ($("#my-legend-con").length) {

        var chartData = JSON.parse($("#vendor_dist_dataset").val())
        let chartConfig = {
            shapes: [{
                    type: 'circle',
                    id: '1950',
                    backgroundColor: '#141c75',
                    borderColor: '#141c75',
                    borderWidth: '1px',
                    cursor: 'pointer',
                    label: {
                        text: 'Karnataka 65%',

                        fontColor: '#666666',
                        fontFamily: 'Roboto',
                        offsetX: '55px'
                    },
                    size: '8px',
                    x: '65%',
                    y: '60%'
                },
                {
                    type: 'circle',
                    id: '1990',
                    backgroundColor: '#6f6dac',
                    borderColor: '#6f6dac',
                    borderWidth: '1px',
                    cursor: 'pointer',
                    label: {
                        text: 'Maharashtra 25%',
                        fontColor: '#666666',
                        fontFamily: 'Roboto',
                        offsetX: '60px'
                    },
                    size: '8px',
                    x: '65%',
                    y: '70%'
                },
                {
                    type: 'circle',
                    id: '2000',
                    backgroundColor: '#b7b6d5',
                    borderColor: '#b7b6d5',
                    borderWidth: '1px',
                    cursor: 'pointer',
                    label: {
                        text: 'Others 15%',
                        fontColor: '#666666',
                        fontFamily: 'Roboto',
                        offsetX: '45px'
                    },
                    size: '8px',
                    x: '65%',
                    y: '80%'
                },
                {
                    type: 'zingchart.maps',
                    options: {
                        name: 'ind',
                        panning: false, // turn of zooming. Doesn't work with bounding box
                        scrolling: false,
                        style: {
                            tooltip: {
                                borderColor: '#fff',
                                borderWidth: '1px',
                                fontSize: '18px'
                            },
                            borderColor: '#fff',
                            borderWidth: '1px',
                            controls: {
                                visible: false, // turn of zooming. Doesn't work with bounding box

                            },
                            hoverState: {
                                alpha: .28
                            },
                            //Northern California:
                            group: 1,
                            backgroundColor: '#b7b6d5',

                            //  group :2 ,
                            //  backgroundColor :"#000",


                            items: {

                                KA: {
                                    group: 2,

                                    tooltip: {
                                        text: 'Karnataka has 30 users',
                                        backgroundColor: '#9391c1'
                                    },
                                    backgroundColor: '#141c75',
                                    label: {
                                        visible: false
                                    }
                                },
                                MH: {
                                    group: 2,

                                    tooltip: {
                                        text: 'Maharashtra has 30 users',
                                        backgroundColor: '#9391c1'
                                    },
                                    backgroundColor: '#6f6dac',
                                    label: {
                                        visible: false
                                    }
                                },
                                UP: {
                                    group: 3,
                                    backgroundColor: '#9391c1',
                                    label: {
                                        visible: false
                                    }
                                },
                                PB: {
                                    group: 3,
                                    backgroundColor: '#9391c1',
                                    label: {
                                        visible: false
                                    }
                                },
                                HR: {
                                    group: 3,

                                    backgroundColor: '#9391c1',
                                    label: {
                                        visible: false
                                    }
                                },
                                CT: {
                                    group: 3,

                                    backgroundColor: '#9391c1',
                                    label: {
                                        visible: false
                                    }
                                },


                            },


                            label: { // text displaying. Like valueBox
                                fontSize: '15px',
                                visible: false
                            }
                        },
                        zooming: false // turn of zooming. Doesn't work with bounding box
                    }
                }
            ]
        }

        zingchart.loadModules('maps,maps-ind,');
        zingchart.render({
            id: 'myzonechart',
            data: chartConfig,
            height: '100%',
            width: '100%',
        });
    }

}

export function initBarChart() {
    console.log('barchart');
    if ($("#bar_dataset").length) {
        var dataset = JSON.parse($("#bar_dataset").val());
        console.log(dataset.revenue.this_week.dates);
        console.log(dataset.revenue.this_week.sales);

        var ctx = document.getElementById('myBarChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dataset.revenue.this_week.dates,
                datasets: [{
                    label: 'Reports',
                    data: dataset.revenue.this_week.sales,
                    backgroundColor: '#5a27cead',
                    borderColor: '#251055',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
}

export function initCountdown() {

    if ($(".timer").length) {

        $(".timer").each(function() {
            var BID_END_TIME = $(this).data("time");
            // if (typeof BID_END_TIME !== undefined) {

            $(this).countdown(BID_END_TIME, function(event) {
                $(this).text(
                    event.strftime('%H:%M:%S')
                );
            });
            // }
        });



    }
}

export function initDateBookPicker() {
    if ($(".date").length) {

        $('.date').datepicker({
            // multidateSeparator:",",
            multidate: true,
            format: 'yyyy-mm-dd',
            'startDate': '+1d',

        });
    }

    if ($(".singledate").length) {
        $('.singledate').datepicker({
            multidate: false,
            format: 'yyyy-mm-dd'
        });
    }

    if ($(".birthdate").length) {
        $('.birthdate').datepicker({
            // multidateSeparator:",",
            format: 'yyyy-mm-dd',
            endDate: '-18y'

        });
    }
}

export function initDatePicker() {
    if ($(".filterdate").length) {

        $('.filterdate').datepicker({
            // multidateSeparator:",",
            format: 'yyyy-mm-dd',

        });
    }
}

export function initPopUp() {
    $(document).ready(function() {
        $('.enter-pin').hide();
        $('.submitbtn').hide();
        $('.next-btn-2').hide();
        $(".enter-pin").hide();
        $('.bid-amount-2').hide();

        /*$('#submitbtn').click(function(){
            $('.bid-amount').hide();
            $('.bid-amount-2').hide();
            $(".enter-pin").hide();
            $(".modal-footer").hide();
        });*/
    });
}

export function initPopUpAdmin() {
    $('.submitbtn-admin').hide();
    $('.next-btn-2-admin').hide();
    $('.bid-amount-2-admin').hide();

    /*if($(".bid-modal").length) {
        $(".bid-modal").each(function (){
            var step= $(this).steps({
                headerTag: "h3",
                buttonSelector:'button',
                bodyTag: ".bid-modal-step",
                transitionEffect: "slideLeft",
                autoFocus: true
            });
        });
        var steps= window['step_api_' + $(this).data('org') ];
        window['step_api_' + $(this).data('org') ] = steps.data('plugin_Steps');
    }*/
}

export function initRangeSlider() {
    if ($(".custom_slider").length) {
        console.log("slider");
        $(".custom_slider").ionRangeSlider({
            type: $(this).data("type"),
            min: $(this).data("min"),
            max: $(this).data("max"),
            from: $(this).data("from"),
            to: $(this).data("to"),
            skin: "round",
            decorate_both: true,
            grid: false,
            values_separator: " - ",
            step: $(this).data("step"),
            keyboard: true,
            hide_min_max: true,
            // hide_from_to: true,

            // force_edges: true,

        });
    }
}

export function initToggles() {
    Logger.info("init toggles");
    $("input[type=checkbox]").each(function(index) {
        Logger.info("init " + index);

        $(this).attr("id", "checkbox_" + index);
        $(this).after(`<label class="custom-check" for="checkbox_${index}">Toggle</label>`);
    });
}

export function initSortable() {
    if ($(".sortable-list").length) {
        console.log("Sortable");
        $(".sortable-list").sortable({
            handle: '.dragger',
        });
    }
}

export function initSelect() {


    /* $('select:not(.select-box2, .select-box)').each(function(){
         var $this = $(this), numberOfOptions = $(this).children('option').length;

         $this.addClass('select-hidden');
         $this.wrap('<div class="select"></div>');
         $this.after('<div class="select-styled"></div>');

         var $styledSelect = $this.next('div.select-styled');
         $styledSelect.text($this.children('option').eq(0).text());

         var $list = $('<ul />', {
             'class': 'select-options'
         }).insertAfter($styledSelect);

         for (var i = 0; i < numberOfOptions; i++) {
             $('<li />', {
                 text: $this.children('option').eq(i).text(),
                 rel: $this.children('option').eq(i).val()
             }).appendTo($list);
         }

         var $listItems = $list.children('li');

         $styledSelect.click(function(e) {
             e.stopPropagation();
             $('div.select-styled.active').not(this).each(function(){
                 $(this).removeClass('active').next('ul.select-options').hide();
             });
             $(this).toggleClass('active').next('ul.select-options').toggle();
         });

         $listItems.click(function(e) {
             e.stopPropagation();
             $styledSelect.text($(this).text()).removeClass('active');
             $this.val($(this).attr('rel'));
             $list.hide();
             //console.log($this.val());
         });

         $(document).click(function() {
             $styledSelect.removeClass('active');
             $list.hide();
         });

     });*/
    // table-select

}

export function initInventoryDropzone() {
    if ($(".dropzone-import").length) {
        console.log("init dropzone");
        let url = $(".dropzone-import").attr('action');
        $('.dropzone-import').dropzone({
            url: url,
            paramName: "file",
            acceptedFiles: ".csv,.xls, .xlsx",
            complete: function(response) {
                console.log(response);
            },
            cancelled: function(response) {
                console.log(response);
            }
        });
    }
}

export function initSocket(){
  if ($(".main-content").data("barba-namespace") == "vendor-orderdetail") {

    socket.emit("booking.listen.start", {
      data:{
        public_booking_id : $("#current-booking-id").val(),
        organization_id : $("#current-org-id").val(),
        watcher_id : $("#current-watcher-id").val(),
      },
      bypass_auth: true
    });

if($("#is_watched").length && $("#is_watched").val() == "false")
  socket.emit("booking.watch.start", {
    data:{
      public_booking_id : $("#current-booking-id").val(),
      organization_id : $("#current-org-id").val(),
      watcher_id : $("#current-watcher-id").val(),
    },
    bypass_auth: true
  });

    console.log("Initing socket");

    socket.on("booking.watch.stop", (data)=>{
      console.log("Listened watch end");
      $(".bidding-actions").removeClass("hidden");
      $("#is-watched-label").addClass("hidden");

      socket.emit("booking.listen.start", {
        data:{
          public_booking_id : $("#current-booking-id").val(),
          organization_id : $("#current-org-id").val(),
          watcher_id : $("#current-watcher-id").val(),
        },
        bypass_auth: true
      });

    });

    socket.on("booking.watch.start", (data)=>{
      console.log("Listened watch end");
      $(".bidding-actions").addClass("hidden");
      $("#is-watched-label").removeClass("hidden");
    });



      socket.on("booking.rejected", (data)=>{
        console.log("Listened booking rejected");
        $(".bidding-actions").addClass("hidden");
        $("#is-watched-label").html("This booking has been rejected by a person from your organization. You won't be able to do any further actions.");
        $("#is-watched-label").removeClass("hidden");
          // if(confirm("A user from your organization has rejected this booking. You are been taken to live orders."))
          //   location.assign(ROUTE_LIVE_ORDERS);
      });

  }
  else{

  }
}
