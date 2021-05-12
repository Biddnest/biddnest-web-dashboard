/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

export function initMapPicker() {
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
        oninitialized: function(component) {},
        // must be undefined to use the default gMaps marker
        markerIcon: undefined,
        markerDraggable: true,
        markerVisible: true
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
        oninitialized: function(component) {},
        // must be undefined to use the default gMaps marker
        markerIcon: undefined,
        markerDraggable: true,
        markerVisible: true
    });
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
    if ($(".selectuser").length) {
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
    }

    if ($(".selectvendor").length) {
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

}

export function initSlick(){
    $('.slick-container').slick({
        arrows: false
    });
}

export function initTextAreaEditor() {
    // $("textarea").addClass('editor');
    if ($('textarea').length) {
        // var editor = new FroalaEditor('.editor');

        $('textarea').not(".select2-search__field").tinymce({
            height: 300
        });

    }

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
                        label: 'Last Week',
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
                    {
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
                    }
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

export function initOrderDistributionChart(){
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
                var text = chart.config.options.elements.center ?.text || '',
                    textX = Math.round((width - ctx.measureText(text).width) / 2),
                    textY = height / 2;
                ctx.fillText(text, textX, textY);
                ctx.save();
            }
        });
        if($("#order_dist_dataset").length){
            var chartData = JSON.parse($("#order_dist_dataset").val());
            var sum = chartData.map((item) => item.value ).reduce((a, b ) => a+b );
            var textInside = sum.toString();
            var myChart = new Chart(document.getElementById('mychart'), {
                type: 'doughnut',
                animation:{
                    animateScale:true
                },
                data: {
                    labels: chartData.map((item) => item.label ),
                    datasets: [{

                        label: 'Visitor',
                        data: chartData.map((item) => item.value ),
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
                        for (var i=0; i < item.data.length; i++) {

                            legendHtml.push('<li>');
                            legendHtml.push('<span class="chart-legend" style=" background-color:' + item.backgroundColor[i] +'"></span>');
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
                                return  data.labels[indice] ;
                            }
                        }
                    },
                }
            });
        }

        $('#my-legend-con').html(myChart.generateLegend());
    }
}

export function initOrderDistributionChartVendor(){
    // console.log("icam called");
    if($("#my-legend-con_vendor").length){
        Chart.pluginService.register({
            beforeDraw: function (chart) {
                var width = chart.chart.width,
                    height = chart.chart.height,
                    ctx = chart.chart.ctx;
                ctx.restore();
                var fontSize = (height / 114).toFixed(2);
                ctx.font = fontSize + "em sans-serif";
                ctx.textBaseline = "middle";
                var text = chart.config.options.elements.center?.text || '',
                    textX = Math.round((width - ctx.measureText(text).width) / 2),
                    textY = height / 2;
                ctx.fillText(text, textX, textY);
                ctx.save();
            }
        });
        if($("#order_dist_dataset_vendor").length){
            var chartData = JSON.parse($("#order_dist_dataset_vendor").val());
            var sum = chartData.map((item) => item.value ).reduce((a, b ) => a+b );
            var textInside = sum.toString();
            var myChart = new Chart(document.getElementById('mychart'), {
                type: 'doughnut',
                animation:{
                    animateScale:true
                },
                data: {
                    labels: chartData.map((item) => item.label ),
                    datasets: [{

                        label: 'Visitor',
                        data: chartData.map((item) => item.value ),
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
                        for (var i=0; i < item.data.length; i++) {

                            legendHtml.push('<li>');
                            legendHtml.push('<span class="chart-legend" style=" background-color:' + item.backgroundColor[i] +'"></span>');
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
                                return  data.labels[indice] ;
                            }
                        }
                    },
                }
            });
        }

        $('#my-legend-con_vendor').html(myChart.generateLegend());
    }
}

export function initCountdown() {

    if ($(".timer").length) {

        $(".timer").each(function(){
            var BID_END_TIME = $(this).data("time");
            // if (typeof BID_END_TIME !== undefined) {

                $(this).countdown(BID_END_TIME, function (event) {
                    $(this).text(
                        event.strftime('%H:%M:%S')
                    );
                });
            // }
        });



    }
}

export function initDatePicker(){
    if($(".date").length) {
        $('.date').datepicker({
            // multidateSeparator:",",
            multidate: true,
            format: 'yyyy-mm-dd',
            'startDate': '+1d'
        });
    }
}

export function initPopUp(){
    $(document).ready(function(){
        $('.enter-pin').hide();
        $("#submitbtn").hide();
        $("#next-btn-2").hide();
        $(".enter-pin").hide();
        $('.bid-amount-2').hide();
        $('#next-btn-1').click(function(){
            $(this).hide();
            $('.bid-amount').hide();
            $('.bid-amount-2').show();
            $("#next-btn-2").show();
        });
        $('#next-btn-2').click(function(){
            $(this).hide();
            $('.bid-amount').hide();
            $('.bid-amount-2').hide();
            $("#submitbtn").show();
            $(".enter-pin").show();
        });
        /*$('#submitbtn').click(function(){
            $('.bid-amount').hide();
            $('.bid-amount-2').hide();
            $(".enter-pin").hide();
            $(".modal-footer").hide();
        });*/
    });
}

export function initTogglePopUp(){
    $("body").on('click', ".modal-toggle", function(event) {
        console.log("sda");
        $($(this).data("target")).fadeIn(100).show();
        return false;
    });
}
export function initRangeSlider(){
    if($(".custom_slider").length) {
        $(".custom_slider").ionRangeSlider({
            type: $(this).data("type"),
            min: $(this).data("min"),
            max: $(this).data("max"),
            from: $(this).data("from"),
            to: $(this).data("to"),
            skin: "round",
            step: $(this).data("step"),
            keyboard: true,
            hide_min_max: true,

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
