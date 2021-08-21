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
            locationNameInput: $(".source-autocomplete")
        },
        enableAutocomplete: true,
        enableAutocompleteBlur: false,
        autocompleteOptions: null,
        addressFormat: 'street_address',
        enableReverseGeocode: true,
        draggable: true,
        onchanged: function(currentLocation, radius, isMarkerDropped) {
           /* $.get(`{{route('admin.zone.check-serviceability')}}?latitude=${currentLocation.latitude}&longitude=${currentLocation.longitude}`,function(response){
                console.log(response);
                if(response.status == "success" && response.data.serviceable === true){

                    var url="https://maps.googleapis.com/maps/api/geocode/json?address="+currentLocation.latitude+","+currentLocation.longitude+"&key={{json_decode(\App\Models\Settings::where('key','google_api_key')->pluck('value'),true)[0]}}";
                    $.get(url, function (response){
                        console.log(response);
                        let street = [];
                        let city, state, pincode =null;
                        for(let i=0; i<= response.results[0].address_components.length; i++)
                        {
                            let addr = response.results[0].address_components[i];
                            if(typeof addr != "undefined") {

                                if (addr.types.includes('locality') && addr.types.includes('political')) {
                                    console.log(addr.long_name);
                                    if(!city)
                                        city=addr.long_name;
                                }
                                if (addr.types.includes('administrative_area_level_1') && addr.types.includes('political')) {
                                    if(!state)
                                        state=addr.long_name;
                                }
                                if (addr.types.includes('postal_code')) {
                                    if(!pincode)
                                        pincode=addr.long_name;
                                }
                            }
                        }
                        $("#source-city").val(city);
                        $("#source-state").val(state);
                        $("#source-pin").val(pincode);
                        console.log(city, state, pincode);
                    });

                }
                else{
                    Swal.fire({
                        icon: "warning",
                        title: "Sorry",
                        text: "We are currently not serviceable in selected area.",
                    });
                }
            });*/
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
            locationNameInput: $(".dest-autocomplete")
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
    if ($(".searchuser").length) {

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

    if ($(".searchvendor").length) {

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
        //
        // $('textarea').not(".select2-search__field").tinymce({
        //     height: 300
        // });

    }

}

export function initTooltip(){
        $('[data-toggle="tooltip"]').tooltip({ trigger: "hover" });
        $('[data-toggle="tooltip').on('click', function () {
            $(this).tooltip('hide');
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
                        label: 'This Week',
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
                var fontSize = (height / 90).toFixed(2);
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
    if($("#my-legend-con").length) {

        var chartData = JSON.parse($("#vendor_dist_dataset").val())
        let chartConfig = {
            shapes: [
                {
                    type: 'circle',
                    id: '1950',
                    backgroundColor: '#141c75',
                    borderColor: '#141c75',
                    borderWidth: '1px',
                    cursor: 'pointer',
                    label:
                        {
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
                   borderColor:  '#251055',
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

export function initDateBookPicker(){
    if($(".date").length) {

        $('.date').datepicker({
            // multidateSeparator:",",
            multidate: true,
            format: 'yyyy-mm-dd',
            'startDate': '+1d',

        });
    }

    if($(".singledate").length) {

        $('.singledate').datepicker({
            multidate: false,
            format: 'dd-mm-yyyy'
        });
    }
}

export function initDatePicker(){
    if($(".filterdate").length) {

        $('.filterdate').datepicker({
            // multidateSeparator:",",
            format: 'yyyy-mm-dd',

        });
    }
}

export function initPopUp(){
    $(document).ready(function(){
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

export function initPopUpAdmin(){
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

export function initSortable() {
    if($(".sortable-list").length){
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
