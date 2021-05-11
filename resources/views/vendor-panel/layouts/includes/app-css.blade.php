<title>@yield('title')</title>
<meta charset="utf-8">
<link rel="icon" type="image/svg+xml" href="{{ asset('static/images/favicon.svg')}}">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!-- Font -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap"
      rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dripicons/2.0.0/webfont.min.css" integrity="sha512-pi7KSLdGMxSE62WWJ62B1R5/H7WNnIsj2f51MikplRt31K0uCZ1lfPSw/0Jb1flSz6Ed2YLSlox6Uulf7CaFiA==" crossorigin="anonymous" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" integrity="sha512-42kB9yDlYiCEfx2xVwq0q7hT4uf26FUgSIZBK8uiaEnTdShXjwr8Ip1V4xGJMg3mHkUt9nNuTDxunHF0/EgxLQ==" crossorigin="anonymous" />

<link href="https://fonts.googleapis.com/css2?family=Mukta:wght@200;300;400;500;600;700;800&display=swap"
      rel="stylesheet">

<!-- Toggle btn -->
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
      rel="stylesheet">
<!-- sortable -->
<link href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" rel="stylesheet">
<!-- SLick -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"/>

<!-- telephone input plugin -->
<link rel="stylesheet" href="{{ asset('static/css/intlTelInput.css')}}">

<!-- date-time picker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" />
<!-- Custom css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css" />
<!-- <link rel="stylesheet" href="{{ asset('static/css/tagify.css')}}" /> -->
<link rel="stylesheet" href="{{ asset('static/css/components/select2.css')}}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
<!-- text area editor -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">
<link rel="stylesheet" href="{{ asset('static/css/code_view.min.css')}}">
<link rel="stylesheet" href="{{ asset('static/css/font_awesome.min.css')}}">
<link rel="stylesheet" href="{{ asset('static/css/froala_editor.pkgd.min.css')}}">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.15.5/sweetalert2.min.css" integrity="sha512-gX6K9e/4ewXjtn8Q/oePzgIxs2KPrksR4S2NNMYLxenvF7n7eNon9XbqQxb+5jcqYBVCcncIxqF6fXJYgQtoAg==" crossorigin="anonymous" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

<link rel="stylesheet" href="{{ asset('static/vendor/css/master.css') }}">
<link rel="stylesheet" href="{{ asset('static/css/chat.css')}}" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>

    .nav-collapse .li{
        list-style-type: none !important;
    }

    select.form-control:not([size]):not([multiple]) {
        height: auto;
    }

    .fullscreen-modal-body .modal-header::before{
        display: none;
    }
    .fullscreen-modal-body .modal-header .modal-title{
        font-weight: bold;
        font-size: 18px;
        text-align: left !important;
    }
    .fullscreen-modal-body .modal-header .close{
        position: absolute;
        right: 20px;
        top:10px;
    }
    .fullscreen-modal-body{
        background-color: #FFFFFF;
        border-radius:5px;
        position: relative;
        margin-top: 20px;
    }
    .fullscreen-modal{
        z-index: 999;
        display: none;
        position: absolute;
        top: 10px;
        left: 0;
        margin-left: 0%;
        width: 100%;
        /*min-height: auto;*/
        background-color: rgba(0,0,0,0.4);
        padding: 5% 10%;
        overflow-y: scroll;
        /*background-color: #000000;*/
    }

    .irs--round .irs-handle {
        top: 31px !important;
        width: 12px !important;
        height: 12px !important;
        border: none !important;
        cursor: pointer;
        border: 2px solid #2e0789 !important;
    }

    .irs--round .irs-bar {
        background-color: #2e0789 !important;
    }

    .irs--round .irs-from, .irs--round .irs-to, .irs--round .irs-single {
        background-color: #2e0789 !important;
    }

    .irs--round .irs-from:before, .irs--round .irs-to:before, .irs--round .irs-single:before {
        border-top-color: #2e0789 !important;
    }

    .status-3 {
        font-size: 12px;
        font-weight: 300;
        background-color: #fff;
        min-width: 120px;
        display: inline-block;
        text-align: center;
        color: #2E0789;
        font-weight: 700;
        font-family: "Gilroy";
        letter-spacing: 1px;
        border: 1px solid #2E0789;
        border-radius: 5px !important;
        margin-bottom: 10px;
        margin-top: -5px;
    }
    .page-head {
        margin-bottom: 25px !important;
    }


</style>
