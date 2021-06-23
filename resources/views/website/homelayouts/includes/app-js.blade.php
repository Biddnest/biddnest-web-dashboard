<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.15.5/sweetalert2.all.min.js" integrity="sha512-TxryOYMwWBRIlZoSkKW+jZvJ834vF3u8mE0jDeTLEDdPplOVNNZfWm9VFtEuW365BFPLK5CEIF/vaHqmAey8XA==" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script src="https://unpkg.com/js-logger/src/logger.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@barba/core"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.1.0/masonry.pkgd.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sortable/0.9.13/jquery-sortable-min.js" integrity="sha512-9pm50HHbDIEyz2RV/g2tn1ZbBdiTlgV7FwcQhIhvykX6qbQitydd6rF19iLmOqmJVUYq90VL2HiIUHjUMQA5fw==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.7.1/jquery.tinymce.min.js" integrity="sha512-0+DXihLxnogmlHWg1hVntlqMiGthwA02YWrzGnOi+yNyoD3IA4yDBzxvm+EwTCZeUM4zNy3deF9CbQqQBQx2Yg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js" integrity="sha512-lteuRD+aUENrZPTXWFRPTBcDDxIGWe5uu0apPEn+3ZKYDwDaEErIK9rvR0QzUGmUQ55KFE2RqGTVoZsKctGMVw==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js" integrity="sha512-bUg5gaqBVaXIJNuebamJ6uex//mjxPk8kljQTdM1SwkNrQD7pjS+PerntUSD+QRWPNJ0tq54/x4zRV8bLrLhZg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>

<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
{{--<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

<script src="https://unpkg.com/js-logger/src/logger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.serializeJSON/3.2.1/jquery.serializejson.min.js" integrity="sha512-SdWDXwOhhVS/wWMRlwz3wZu3O5e4lm2/vKK3oD0E5slvGFg/swCYyZmts7+6si8WeJYIUsTrT3KZWWCknSopjg==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/l2ig/jToast@master/jToast.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>

<script type="text/javascript" src='https://maps.google.com/maps/api/js?&key={{json_decode(\App\Models\Settings::where('key','google_api_key')->pluck('value'),true)[0]}}&sensor=false&libraries=places'></script>

<script src="{{ asset('static/website/js/locationpicker.jquery.js')}}"></script>
<script src="{{ asset('static/website/js/intlTelInput.js')}}"></script>
{{--<script src="{{ asset('static/website/js/maps.js')}}"></script>--}}
<script src="{{ asset('static/website/js/curosel.js')}}"></script>
<script src="{{ asset('static/website/js/helperfunction.js')}}"></script>

<script  type="module" src="{{ asset('static/js/app/app.js') }}"></script>
{{--<script  type="module" src="{{ asset('static/js/barba.js') }}"></script>--}}
<script type="module" src="{{ asset('static/js/app/initFunctions.js') }}"></script>
<script>
    /*if ("geolocation" in navigator){
        navigator.geolocation.getCurrentPosition(function(position){
            let currentLocation = {
                latitude: position.coords.latitude,
                longitude: position.coords.longitude
            };

        });
    }else{
        // console.log("Browser doesn't support geolocation!");
        let currentLocation = {
            latitude: 12.930621,
            longitude: 80.111410
        }

    }*/

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
           onchanged: function (currentLocation, radius, isMarkerDropped) {
               var url="https://maps.googleapis.com/maps/api/geocode/json?address="+currentLocation.latitude+","+currentLocation.longitude+"&key=AIzaSyCvVaeoUidYMQ8cdIJ_cEvrZNJeBeMpC-4";
               $.get(url, function (response){
                   console.log(response);
                   let street="";
                   let city="";
                   for(let i=0; i<= response.results[0].address_components.length; i++)
                   {
                       let addr=response.results[0].address_components[i];
                       if(addr.types.indexOf('premise')) {
                           street +=addr.long_name;
                       }
                       if(addr.types.indexOf('sublocality_level_2')) {
                           city +=", "+addr.long_name;
                           break;
                       }
                   }
                   $(".source").attr("placeholder", street);
                   $(".source_city").attr("placeholder", response.results[0].formatted_address.replace(street, ""));
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
           onchanged: function (currentLocation, radius, isMarkerDropped) {
               var url="https://maps.googleapis.com/maps/api/geocode/json?address="+currentLocation.latitude+","+currentLocation.longitude+"&key=AIzaSyCvVaeoUidYMQ8cdIJ_cEvrZNJeBeMpC-4";
               $.get(url, function (response){
                   console.log(response);
                   let street="";
                   let city="";
                   for(let i=0; i<= response.results[0].address_components.length; i++)
                   {
                       let addr=response.results[0].address_components[i];
                       if(addr.types.indexOf('premise')) {
                           street +=addr.long_name;
                       }
                       if(addr.types.indexOf('sublocality_level_2')) {
                           city +=", "+addr.long_name;
                           break;
                       }
                   }
                   $(".dest").attr("placeholder", street);
                   $(".dest_city").attr("placeholder", response.results[0].formatted_address.replace(street, ""));

               });
           },
           onlocationnotfound: function(locationName) {},
           oninitialized: function(component) {},
           // must be undefined to use the default gMaps marker
           markerIcon: undefined,
           markerDraggable: true,
           markerVisible: true
       });



    $('.card-methord').click(function() {
            $('.card-methord').removeClass('turntheme');
            $('.card-methord').removeClass('check-icon02');
            $(this).addClass('turntheme');
            $(this).addClass('check-icon02');


        });


</script>
<script>
    function openContent(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
<script>
    const LOGGED_STATE = @if(\Illuminate\Support\Facades\Session::get('account')) true @else false @endif;
    $(document).submit(function(){
        {{-- Temporary fix - else form submti doesnt work --}}
        setTimeout($(".hero-booking-form input[type=radio]").eq(0).click(),3000)
    });
</script>
<script>
    function initFreshChat() {
        window.fcWidget.init({
            token: "859b3a74-b0c6-46ff-b582-2e42ae7f9f1b",
            host: "https://wchat.in.freshchat.com"
        });
    }
    function initialize(i,t){var e;i.getElementById(t)?initFreshChat():((e=i.createElement("script")).id=t,e.async=!0,e.src="https://wchat.in.freshchat.com/js/widget.js",e.onload=initFreshChat,i.head.appendChild(e))}function initiateCall(){initialize(document,"Freshchat-js-sdk")}window.addEventListener?window.addEventListener("load",initiateCall,!1):window.attachEvent("load",initiateCall,!1);
</script>
