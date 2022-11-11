

<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js" integrity="sha512-zT3zHcFYbQwjHdKjCu6OMmETx8fJA9S7E6W7kBeFxultf75OPTYUJigEKX58qgyQMi1m1EgenfjMXlRZG8BXaw==" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.1.0/masonry.pkgd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@barba/core"></script>
{{--<script src="{{ asset('static/website/js/select.js')}}"></script>--}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>--}}
<script src="https://unpkg.com/js-logger/src/logger.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.15.5/sweetalert2.all.min.js" integrity="sha512-TxryOYMwWBRIlZoSkKW+jZvJ834vF3u8mE0jDeTLEDdPplOVNNZfWm9VFtEuW365BFPLK5CEIF/vaHqmAey8XA==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sortable/0.9.13/jquery-sortable-min.js" integrity="sha512-9pm50HHbDIEyz2RV/g2tn1ZbBdiTlgV7FwcQhIhvykX6qbQitydd6rF19iLmOqmJVUYq90VL2HiIUHjUMQA5fw==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.7.1/jquery.tinymce.min.js" integrity="sha512-0+DXihLxnogmlHWg1hVntlqMiGthwA02YWrzGnOi+yNyoD3IA4yDBzxvm+EwTCZeUM4zNy3deF9CbQqQBQx2Yg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js" integrity="sha512-lteuRD+aUENrZPTXWFRPTBcDDxIGWe5uu0apPEn+3ZKYDwDaEErIK9rvR0QzUGmUQ55KFE2RqGTVoZsKctGMVw==" crossorigin="anonymous"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js" integrity="sha512-bUg5gaqBVaXIJNuebamJ6uex//mjxPk8kljQTdM1SwkNrQD7pjS+PerntUSD+QRWPNJ0tq54/x4zRV8bLrLhZg==" crossorigin="anonymous"></script>


<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.serializeJSON/3.2.1/jquery.serializejson.min.js" integrity="sha512-SdWDXwOhhVS/wWMRlwz3wZu3O5e4lm2/vKK3oD0E5slvGFg/swCYyZmts7+6si8WeJYIUsTrT3KZWWCknSopjg==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous"></script>


<script type="text/javascript" src='https://maps.google.com/maps/api/js?&key={{json_decode(\App\Models\Settings::where('key','google_api_key')->pluck('value'),true)[0]}}&sensor=false&libraries=places'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
{{--<script src="https://cdn.jsdelivr.net/gh/l2ig/jToast@master/jToast.min.js"></script>--}}

<script src="{{ asset('static/website/js/intlTelInput.js')}}"></script>

<script src="{{ asset('static/website/js/locationpicker.jquery.js')}}"></script>
<script src="{{ asset('static/website/js/timer.js')}}"></script>
<script src="{{ asset('static/website/js/maps.js')}}"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    const RZP_KEY = '{{\App\Models\Settings::where("key", "razor_key")->pluck('value')[0]}}';
</script>

<script>
$('.card-methord').click(function() {
            $('.card-methord').removeClass('turntheme');
            $('.card-methord').removeClass('check-icon02');
            $('.card-methord').removeClass('check-blue');
            $(this).addClass('turntheme');
            $(this).addClass('check-icon02');
            $(this).addClass('check-blue');
        });
        </script>



<script  type="module" src="{{ asset('static/js/app/app.js') }}"></script>
{{--<script  type="module" src="{{ asset('static/js/barba.js') }}"></script>--}}
<script type="module" src="{{ asset('static/js/app/initFunctions.js') }}"></script>
<script>
    $(document).ready(function () {
        Handlebars.registerHelper('replace', function (find, replace, options) {
            var string = options.fn(this);
            string= string.replace(/[^a-zA-Z0-9]/g, '');
            return string.replace(find, replace);
        });
    });

    $(".timer").each(function(){
        var BID_END_TIME = $(this).data("time");


        $(this).countdown(BID_END_TIME, function (event) {
            $(this).text(
                event.strftime('%H:%M:%S')
            );
        });

    });

    $("body").on("click",".item-single-wrapper span.info",function(e){
        $(this).toggleClass("show-drop");
    });


    $("body").on("click",".item-single-wrapper span.info .dropdown-content ul li",function(e){

        $(this).closest("span.info").find("span").eq(0).html($(this).html());
        $(this).closest("span.info").find("input").eq(0).val($(this).data("value"));
    });

    $("body").on("click",".quantity-operator .minus",function(e){
        let quantity = $(this).parent().find('input').val();
        quantity--;
        if(quantity > 0)
            $(this).parent().find('input').val(quantity);
    });

    $("body").on("click",".quantity-operator .plus",function(e){
        let quantity = $(this).parent().find('input').val();
        quantity++;

        if($(this).closest(".row").hasClass("inventory")){
            console.log("Checking quantity count");
            let extra_item_count = 0;
            $(this).closest(".row").find(".custom-item").each(function() {
                console.log($(this).find(".quantity input").val());
                extra_item_count += parseInt($(this).find(".quantity input").val());
            });
            // extra_item_count += parseInt(item.quantity);

            console.log("Total Extra Items:", extra_item_count);
            console.log("Max Inv count:", $(".max-inv-count").val());
            if (extra_item_count > $(".max-inv-count").val()) {

                Swal.fire({
                    icon: "warning",
                    title: "Oops",
                    text: `You can only add upto ${$(".max-inv-count").val()}  extra items.`,
                    confirmButtonText: "close message"
                });

                return false;
            }
        }

        if(quantity > 0)
            $(this).parent().find('input').val(quantity);
    });

    $("body").on("click",".subservice-selector",function(e){
        console.log("called");
        $(".subservice-selector").removeClass("check-blue");
        $(this).addClass("check-blue");
    });

    @isset($prifill['service'])
    $(document).ready(function (){
        $('#service_{{$prifill['service']}}').click();
    });
    @endisset


</script>
<script>
    $('.source-map-picker_booking').locationpicker({
        location: {
            latitude: $("#source-lat").val(),
            longitude: $("#source-lng").val()
        },
        locationName: "",
        radius: 0,
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
        onchanged: function (currentLocation, radius, isMarkerDropped) {

            console.log(currentLocation);
            $.get(`{{route('website.api.zone.check-serviceability')}}?latitude=${currentLocation.latitude}&longitude=${currentLocation.longitude}`,function(response){
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
            });

        },
        onlocationnotfound: function(locationName) {},
        oninitialized: function(component) {},
        // must be undefined to use the default gMaps marker
        markerIcon: undefined,
        markerDraggable: true,
        markerVisible: true,

    });

    $('.dest-map-picker_booking').locationpicker({
        location: {
            latitude: $("#dest-lat").val(),
            longitude: $("#dest-lng").val()
        },
        locationName: "",
        radius: 0,
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
        onchanged: function (currentLocation, radius, isMarkerDropped) {
            var url="https://maps.googleapis.com/maps/api/geocode/json?address="+currentLocation.latitude+","+currentLocation.longitude+"&key={{json_decode(\App\Models\Settings::where('key','google_api_key')->pluck('value'),true)[0]}}";
            $.get(url, function (response){
                console.log(response);
                let street=[];
                let city, state, pincode =null;
                for(let i=0; i<= response.results[0].address_components.length; i++)
                {
                    let addr = response.results[0].address_components[i];
                    if(typeof addr != "undefined") {
                        if ((addr.types.includes('locality') && addr.types.includes('political')) || addr.types.includes('administrative_area_level_2')) {
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

    $(".custom_slider").ionRangeSlider({
        type: $(this).data("type"),
        min: $(this).data("min"),
        max: $(this).data("max"),
        from: $(this).data("from"),
        to: $(this).data("to"),
        skin: "round",
        // grid: false,
        force_edges: true,
        step: $(this).data("step"),
        keyboard: true,
        hide_min_max: true,
    });

    $(document).ready(function(){
        $.get(`{{route('website.api.zone.check-serviceability')}}?latitude=${$("#source-lat").val()}&longitude=${$("#source-lng").val()}`,function(response){
            if(response.status == "success" && response.data.serviceable === true){

                var url="https://maps.googleapis.com/maps/api/geocode/json?address="+$("#source-lat").val()+","+$("#source-lng").val()+"&key={{json_decode(\App\Models\Settings::where('key','google_api_key')->pluck('value'),true)[0]}}";
                $.get(url, function (response){
                    console.log(response);
                    let street = [];
                    let city, state, pincode =null;
                    for(let i=0; i<= response.results[0].address_components.length; i++)
                    {
                        let addr = response.results[0].address_components[i];
                        if(typeof addr != "undefined") {

                            if ((addr.types.includes('locality') && addr.types.includes('political')) || addr.types.includes('administrative_area_level_2')) {
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
        });

        var url="https://maps.googleapis.com/maps/api/geocode/json?address="+$("#dest-lat").val()+","+$("#dest-lng").val()+"&key={{json_decode(\App\Models\Settings::where('key','google_api_key')->pluck('value'),true)[0]}}";
        $.get(url, function (response){
            console.log(response);
            let street=[];
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
            $("#dest-city").val(city);
            $("#dest-state").val(state);
            $("#dest-pin").val(pincode);

        });
    });

</script>





