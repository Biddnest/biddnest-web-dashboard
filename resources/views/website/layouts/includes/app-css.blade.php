<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>@yield('title')</title>

<link rel="icon" type="image/svg+xml" href="{{ asset('static/images/favicon.svg')}}">
<!-- Latest compiled and minified CSS -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dripicons/2.0.0/webfont.min.css" integrity="sha512-pi7KSLdGMxSE62WWJ62B1R5/H7WNnIsj2f51MikplRt31K0uCZ1lfPSw/0Jb1flSz6Ed2YLSlox6Uulf7CaFiA==" crossorigin="anonymous" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<link href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" rel="stylesheet">

<!-- custom css -->
<link rel="stylesheet" href="{{ asset('static/website/css/intlTelInput.css')}}">
<link rel="stylesheet" href="{{ asset('static/website/css/master.css')}}" />

<style>
    select {
        -webkit-appearance: none !important;
        -moz-appearance: none !important;
        background: transparent !important;
        background-image: url("data:image/svg+xml;utf8,<svg fill='black' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>") !important;
        background-repeat: no-repeat !important;
        background-position-x: 100% !important;
        background-position-y: 5px !important;
        border: 1px solid #dfdfdf !important;
        border-radius: 3px !important;
        margin-right: 2rem !important;
        padding-right: 2rem !important;
    }
    select::-ms-expand {
        display: none !important;
    }

     .answer {
         display: none;
     }
     a.menu{
         color: #0f0c75 !important;
         font-size: 14px !important;
     }
     .custom-check{
         display: none;
     }

     .spcae{
        margin-bottom: 130px !important;

        height: 650px !important;

    }

    .card-img-top {
        width: 107% !important;
        margin-left: -8px !important;


    }
    .input-group-append{
        margin-left: -35px !important;

    }



label {
    width: 100%;
}

.card-input-element {
    display: none;
}

.card-input {
    margin: 10px;
    padding: 00px;
}

.card-input:hover {
    cursor: pointer;
}

.card-input-element:checked + .card-input {
     box-shadow: 0 0 1px 1px #2ecc71;
 }



 .card .required-item {
     width: fit-content !important;

 }
</style>
