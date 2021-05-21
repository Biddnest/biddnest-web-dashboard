<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.15.5/sweetalert2.all.min.js" integrity="sha512-TxryOYMwWBRIlZoSkKW+jZvJ834vF3u8mE0jDeTLEDdPplOVNNZfWm9VFtEuW365BFPLK5CEIF/vaHqmAey8XA==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script src="https://unpkg.com/js-logger/src/logger.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@barba/core"></script>


<script src="https://unpkg.com/js-logger/src/logger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.serializeJSON/3.2.1/jquery.serializejson.min.js" integrity="sha512-SdWDXwOhhVS/wWMRlwz3wZu3O5e4lm2/vKK3oD0E5slvGFg/swCYyZmts7+6si8WeJYIUsTrT3KZWWCknSopjg==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous"></script>

<script type="text/javascript" src='https://maps.google.com/maps/api/js?&key={{json_decode(\App\Models\Settings::where('key','google_api_key')->pluck('value'),true)[0]}}&sensor=false&libraries=places'></script>

<script src="{{ asset('static/website/js/locationpicker.jquery.js')}}"></script>
<script src="{{ asset('static/website/js/intlTelInput.js')}}"></script>
<script src="{{ asset('static/website/js/maps.js')}}"></script>
<script src="{{ asset('static/website/js/curosel.js')}}"></script>
<script src="{{ asset('static/website/js/helperfunction.js')}}"></script>

<script  type="module" src="{{ asset('static/js/barba.js') }}"></script>
