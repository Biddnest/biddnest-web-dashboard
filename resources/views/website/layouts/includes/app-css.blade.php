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
        margin-right: 0rem !important;
    }

    select::-ms-expand {
        display: none !important;
    }

    .answer {
        display: none;
    }

    .custom-check {
        display: none;
    }

    .spcae {
        margin-bottom: 130px !important;

        height: 650px !important;

    }

    .card-img-top {
        width: 107% !important;
        margin-left: -8px !important;


    }

    .input-group-append {
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

    .card-input-element:checked+.card-input {
        box-shadow: 0 0 1px 1px #fdc403;
        background: #2c136c !important;
    }


    .card-input-element01:checked+.card-input {
        color: #2c136c !important;
    }


    .card-input-element01 {
        display: none;

    }



    .drop-list:hover {
        background: #e6e9eb;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;


    }

    .f-row {
        display: flex;
        flex-direction: row;
    }






    .border-add {
        border: 4px solid #fdc403;
        width: 197px;
        margin-left: 16px;
        margin-top: 16px;
        border-radius: 5px;
    }

    .step-text.text-right{
        white-space: nowrap !important;
    }
    .add-item-icon {
        bottom: 216px !important;
        right: 104px !important;
    }

    .dropdown-content {
        top: 31px !important;

    }

    .hor-center {
        display: flex !important;
        justify-content: center !important;
        flex-direction: column !important;
        align-items: center !important;
    }


    .img-location {
        transform: translate(2px, -9px) !important;

    }


    p.f-16 {
        font-size: 16px !important;
    }


    .quote p {
        white-space: nowrap !important;

    }

    .para-head {
        white-space: normal !important;

    }


    .para {
        white-space: normal !important;

    }


    .close .text-white {
        outline: none !important;
        border: none !important;

    }

    .img-width {
        width: 76px;
    }


    button:focus {
        outline: none;
    }




    .marg-faq {
        margin-top: 240px;
        margin-bottom: 240px;
    }


    @media (max-width:480px) {
        .heading-view {
            transform: translate(-24px, 10px);

        }

        .heading2-view {
            transform: translate(-10px, 10px);


        }

        .img-width {
            width: 36px;
        }

        .card-width {
            width: 90px !important;
            padding: 10px !important;
        }

        .marg-faq {
            margin-top: 140px;


        }

        .upload-image-container i.fa.fa-close.fa-2x {
            right: -2px !important;
            padding: 2px 5px !important;


        }

        .upload-image-container {
            width: 88px !important;
            /* height: 160px !important; */
        }

        .nav-link.p-15 {
            padding-left: 8px !important;
            padding-right: 8px !important;
        }

        .flow__item__circle:after {
            top: 1062px !important;

        }

        div#filter {
            margin: -5px -6px 0px -12px;
            width: 133%;
            margin-left: -45px;

        }

        .add-photos i.fa.fa-plus.fa-2x {
            left: 42% !important;
            top: 22% !important;
        }

        img.image-upload-by-customer {
            height: auto !important;

        }

        .mar-card {
            margin: 10px 22px 10px 16px;

        }


        .card-input {
            margin: 2px;
            padding: 0px;
        }

        .col-mobile {
            flex-direction: column !important;

        }

        .padding-view {
            padding-left: 0 !important;

        }

        .top-aliments {
            width: 100% !important;
            display: flex !important;
            justify-content: center !important;
            flex-wrap: wrap !important;

        }

        .bg-blur {
            width: fit-content !important;
        }

        .f-30 {
            margin-left: 0 !important;
        }

        .m-20 {
            margin: 0 !important;
        }

        .details-card {
            width: auto !important;
        }

        .w-84 {
            width: 84% !important;
        }

        .custom-file {
            height: calc(3.25rem + 8px);

        }

        .mar-vendor {
            margin-left: 10px !important;

        }

        .img-res {
            width: 100%;
            height: auto;

        }

        img.req-search-image {
            height: 100% !important;
            max-width: 100%
        }

        .card-method {
            /* width: max-content !important; */
            width: 34% !important;


        }

        button.nextBtn-3 {
            width: 116px;
        }

        .ml-20 {
            margin-left: 20px !important;
        }

        .row-horizonal {
            display: flex !important;
            justify-content: flex-start !important;
            flex-direction: row !important;
            flex-wrap: inherit !important;
        }

        .col-paddingnon {
            padding-right: 0px !important;
            padding-left: 0px !important;


        }

        .margin-view {
            margin-left: 1rem !important;
        }

        .modal-dialog.addItemModal {
            max-width: 100%;
        }


        .view-flex {
            display: flex;
            justify-content: space-between;
        }

        .required-item {
            width: 140px !important;

        }

        .container-image-item img {
            width: 87% !important;
            margin: 0 auto !important;
            margin-top: -10px !important;

        }

        .row.modal-item-inner-container {
            width: 86%;
            margin: 0 auto;
        }

        .req-search-image {
            width: 100%;
        }

        .select-material {
            width: 90px !important;
        }

        .col-md-6.modal-first-inner-column {
            margin: 0 auto ! important;
        }

        .border-add {
            width: 136px;
            margin-left: 10px;
            margin-top: 16px;
            border-radius: 5px;
            height: 220px;
            position: absolute;
            bottom: 133px;
            right: 28px;
        }

        .add-item-icon {
            bottom: 222px !important;
            right: 68px !important;
        }

        .choose-your-material.pt-3 {
            padding-top: 0px !important;
        }


        select {

            padding-right: 0rem !important;
        }

        .move-btn {
            display: flex;
            justify-content: space-between;
            flex-direction: row-reverse;
        }

        .bview-btn {
            width: 114px;

        }

        #next2 {
            margin-right: 23px !important;

        }

    }

    .border-l-radius {
        border-top-left-radius: 5px !important;
    }
    .space {
        height: 300px !important;
        margin-bottom: 100px !important;
    }
    @media (max-width: 1200px) {

    }


@media (min-width:320px)  {




 }
@media (min-width:481px)  {  }
@media (min-width:641px)  { }
@media (min-width:961px)  {
    .full-width{
        padding: 5px 86px !important;

    }
 }
@media (min-width:1025px) {
    .full-width{
        padding: 5px 95px !important;

    }
 }
@media (min-width:1281px) {
    .full-width{
        padding: 5px 147px !important;

    }

 }

 @media (min-width:1481px) {
    .full-width{
        padding: 5px 120px !important;

    }

 }

.hidden{
    display: none;
}










</style>
