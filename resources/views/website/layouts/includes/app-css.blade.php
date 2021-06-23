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
<!-- fonts -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dripicons/2.0.0/webfont.min.css" integrity="sha512-pi7KSLdGMxSE62WWJ62B1R5/H7WNnIsj2f51MikplRt31K0uCZ1lfPSw/0Jb1flSz6Ed2YLSlox6Uulf7CaFiA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css" />
<!-- custom css -->
<link rel="stylesheet" href="{{ asset('static/website/css/intlTelInput.css')}}">
<link rel="stylesheet" href="{{ asset('static/website/css/master.css')}}" />

<style>
    body {
        font-family: 'Source Sans Pro', sans-serif !important;
    }

    body * {
        font-family: 'Source Sans Pro', sans-serif;
    }

    select {
        -webkit-appearance: none !important;
        -moz-appearance: none !important;
        background: transparent !important;
        background-image: url("data:image/svg+xml;utf8,<svg fill='black' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>") !important;
        background-repeat: no-repeat !important;
        background-position-x: 100% !important;
        background-position-y: 2px !important;
        border: 1px solid #dfdfdf !important;
        border-radius: 3px !important;
        margin-right: 0rem !important;
    }


    .ontop {
        position: absolute;
        top: 300px;
        width: 80%;
        left: 10%;

    }

    select::-ms-expand {
        display: none !important;
    }

    .answer {
        display: none;
    }

    .nav-menu-link:hover {
        color: #fdc403 !important;

    }

    .custom-check {
        display: none;
    }

    .spcae {
        margin-bottom: 130px !important;

        height: 650px !important;

    }

    .card-img-top {
        width: 109% !important;
        margin-left: -11px !important;


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
        padding: 0px;
    }

    .card-input:hover {
        cursor: pointer;
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
        margin-top: 16px;
        border-radius: 5px;
        height: 92%;
        margin-left: 4px;

    }

    .step-text.text-right {
        white-space: nowrap !important;
    }

    .add-item-icon {
        bottom: 190px !important;
        right: 130px !important;
    }

    .add-photos {
        height: 80px;

    }

    .add-photos i.fa.fa-plus.fa-2x {
        transform: translate(34px, -15px);

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
        width: 38px;
        margin: 0 auto;
        margin-bottom: 10px;
        margin-bottom: 10px;

    }


    button:focus {
        outline: none;
    }

    a.menu {
        color: #3d4751 !important;
        font-size: 14px !important;
    }



    .marg-faq {
        margin-top: 240px;
        margin-bottom: 240px;
    }

    /* .ontop-book {
        width: 80% !important;

    } */


    .mar-card {
        border-radius: 10px;
        margin-top: 2rem;
    }


    .item-modal-width {
        max-width: 70%!important;
        }

    @media (max-width:480px) {
        .item-modal-width {
            max-width: 100% !important;

        }


        .btn-proceed {
            width: 100%;
            width: -moz-available;
            width: -webkit-fill-available;
            width: fill-available;
        }

        .modal-content.w-80.m-0-auto.w-1000.mt-20.right-25 {
            width: 96% !important;

        }

        .img-mar {
            margin-left: 57px !important;

        }

        .f-40 {
            font-size: 20px
        }


        .desktop-popup {
            display: none !important;
        }



        .card.f-row.pl-0.pr-2.mar-card {
            width: 140px !important;
            margin: 0 auto;

        }

        .flex-view {
            display: flex !important;
        }

        .f-row {
            flex-direction: column;

        }

        .view-bottom {
            margin-bottom: 38px;

        }

        .para.ml-2 {
            white-space: normal !important;

        }

        .between {
            justify-content: space-between;
        }

        .row.d-flex.uploaded-image {
            margin-left: 0px !important;
            padding-left: 0px !important;

        }

        .comments.ml-2 {
            margin-left: 0px !important;
            padding-left: 0px !important;
        }

        .ontop {
            left: 0%;
        }

        .heading-view {
            transform: translate(-24px, 10px);

        }

        /* .ontop-book {
            width: 100% !important;
            transform: translate(0px, 0px) !important;


        } */

        .heading2-view {
            transform: translate(-10px, 10px);


        }

        .img-width {
            width: 36px;
            margin: 0 auto;

        }

        .card-width {
            width: 90px !important;
            padding: 10px !important;
        }

        .marg-faq {
            margin-top: 140px;


        }

        .upload-image-container i.fa.fa-close.fa-2x {
            right: 6px !important;
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
            top: 926px !important;

        }

        .ontop-book {
            display: block !important;
        }

        div#filter {
            margin: -5px -6px 0px -12px;
            /* margin-left: -45px; */

        }

        .add-photos i.fa.fa-plus.fa-2x {

            transform: translate(24px, -23px);

        }

        img.image-upload-by-customer {
            height: auto !important;

        }

        .mar-card {
            margin: 10px 22px 10px 16px;

        }

        .fw-500.f-20 {
            font-size: 18px;
        }

        .mt-2.mb-0.l-cap {
            font-size: 14px;
        }


        .card-input {
            padding: 0px;
        }

        .col-mobile {
            flex-direction: column !important;

        }

        .row-mobile {
            flex-direction: row !important;

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
            width: 44% !important;


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

        .required-item {
            width: 140px !important;
            margin: 0 auto;
            margin-top: 28px;

        }

        .row.mb-4.mt-3 {
            margin-top: 0px !important;
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
            width: 120px !important;
        }

        .col-md-6.modal-first-inner-column {
            margin: 0 auto ! important;
        }

        .card-align {
            display: flex !important;
            margin-left: -78px;
            margin-top: 10px !important;

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
            transform: translate(133px, 190px) !important;

            /* bottom: 222px !important;
            right: 68px !important; */
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


    @media only screen and (max-width: 1680px) and (min-width: 1300px) {
        .header-controls.ml-30.navbar-collapse.collapse {
            display: flex !important;
            justify-content: flex-end;
        }

        .mobile-popup {
            display: none !important;

        }
    }

    .f-40 {
        font-size: 40px
    }
    @media only screen and (max-width: 1280px) and (min-width: 800px) {

        .header-controls.ml-30.navbar-collapse.collapse {
            display: flex !important;
            justify-content: flex-end;
        }

        .mobile-popup {
            display: none !important;

        }

        .mb-0.f-14.l-cap {
            font-size: 12px;

        }

        .f-18 {
            font-size: 14px;

        }

        .f-40 {
            font-size: 30px
        }

        .modal-background {
            background-color: rgba(0, 0, 0, .75);
        }



        .modal-backdrop {
            position: inherit !important;
        }

        .required-item-name {
            font-size: 18px !important;
        }

        .add-photos {
            height: 68px;


        }

        .add-photos i.fa.fa-plus.fa-2x {
            transform: translate(33px, -20px);

        }

        .card-img-top {
            width: 110% !important;
            margin-top: -14px;
            margin: 0 auto;
        }

        /* .ontop-book {
            width: 84% !important;
            transform: translate(41px, -9px) !important;
        } */

        .card.required-item {
            width: max-content !important;
        }

        .container-image-item {
            /* width: 170px; */
        }

        .img-width {
            width: 39px;
            margin: 0 auto;
            margin-bottom: 10px;
            margin-bottom: 10px;


        }

        .screen-fix {
            display: flex;
            justify-content: space-between;
            flex-direction: column;

        }

        .add-item-icon {
            transform: translate(72px, 125px) !important;

        }

    }


    .hidden {
        display: none;
    }

    /* .ontop-book {
        width: 80%;
        transform: translate(52px, -9px) !important;
    } */

    .add-item-icon {
        transform: translate(37px, 125px);
    }

    .f-24 {
        font-size: 24px;
        color: #3B4B58 !important;

    }

    .parsley-errors-list {
        color: red !important;
        padding-left: 0px !important;
    }


    .account-settings.dropdown.theme-text.mt-1 {
        padding-top: 2px;

    }

    .btn-max {
        width: 100%;
        width: -moz-available;
        width: -webkit-fill-available;
        width: fill-available;
    }

    .item-single-wrapper:hover {
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
        border-color: rgba(0, 0, 0, 0);
        z-index: 10;
    }

    .item-single-wrapper * {
        font-family: 'Source Sans Pro', sans-serif !important;
    }

    .item-single-wrapper {
        margin-bottom: 10px;
        transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
        border: 1px solid #f2f2f2;
        /*border-inline: none;*/

        /*overflow-x: visible;*/
        position: relative;
        padding: 0;
        border-top-right-radius: 10px;
        border-top-left-radius: 10px;
    }

    .item-single-wrapper .item-image img {
        max-width: 100%;
        display: block;
    }

    .item-single-wrapper .item-image {
        height: auto;
        /*background-color : #000;*/
        /*background-size: contain !important;*/
        /*background-repeat: no-repeat !important;*/
    }

    .item-single-wrapper h5 {
        padding: 10px;
        padding-bottom: 5px;

        margin: 0 !important;
        color: #000;
        font-size: 18px;
    }

    .item-single-wrapper .info-wrapper {
        border-top: 1px solid #c0c0c0;
        margin: 0 10px;
    }

    .item-single-wrapper select.info:focus {
        outline: none !important;
    }

    .item-single-wrapper select.info option {
        font-style: italic !important;
    }

    .item-single-wrapper select.info {
        margin: 4px 0;
        cursor: pointer;
        border: none !important;
        text-align: left !important;
        /*margin-bottom: 5px;*/
        display: block;
        font-weight: 500;
        font-size: 14px;

        /*padding: 10px 0px;*/
        /*margin-bottom: 8px;*/

        appearance: none !important;
        -moz-appearance: none !important;
    }

    .item-single-wrapper span.info {

        margin: 10px 0;
        /*margin-bottom: 5px;*/
        display: block;
        font-weight: 500;
        font-size: 14px;
        position: relative;
        /*padding: 10px 0px;*/
        cursor: pointer;
        border-bottom: 1px dotted #4a2b9a;
        text-align: left;
    }

    .item-single-wrapper .quantity {
        display: block;
        border-top: 1px solid #f2f2f2;
        padding: 0;
        user-select: none;
    }

    .item-single-wrapper .quantity span:hover {
        background: #f1f1f1;
    }

    .item-single-wrapper .quantity input:focus {
        outline: none;
        appearance: none;
    }

    .item-single-wrapper .quantity input {
        border: none;
        font-size: 16px;
        font-weight: 600;
    }

    .item-single-wrapper .quantity span {
        font-size: 18px;
        cursor: pointer;
        background: #f2f2f2;
        position: relative;
    }

    .item-single-wrapper .quantity * {
        height: 5vh;
        width: 32.4%;
        display: inline-block;
        margin: 0;
        text-align: center;
    }

    .item-single-wrapper .add-btn {
        background: #fdc403;
        border-radius: 0;
        width: 100%;
        font-size: 13px;
        letter-spacing: 1px;
        font-weight: 600;
        text-transform: uppercase;
        margin: 0;

    }

    .item-single-wrapper .closer:hover {
        background: #4a2b9a;
        border-radius: 50%;
    }

    .item-single-wrapper .closer {
        position: absolute;
        left: 10px;
        top: 10px;
        cursor: pointer;
    }

    .item-single-wrapper .info-wrapper span.info.show-drop .dropdown-content {
        display: block;
    }

    .item-single-wrapper .info-wrapper span.info .dropdown-content ul li {
        cursor: pointer;
    }

    .item-single-wrapper .info-wrapper span.info i {
        background: 0;
        padding: 0;
        display: inline-block;
        margin: 0;
        color: #000;
        font-size: 10px;
    }

    .item-single-wrapper .info-wrapper span.info .dropdown-content {
        top: -100% !important;
        width: auto !important;
        min-width: auto !important;
        max-width: auto !important;
    }

    .item-single-wrapper.add-more i {

        position: absolute;
        left: 50%;
        top: 50%;
        transform: scale(2) translate(-25%, -50%);
    }

    .item-single-wrapper.add-more {
        border: 2px dashed #c0c0c0;
        cursor: pointer;
    }




    .check-blue {
        position: relative;
    }

    .check-blue:before {
        content: "";
        font-family: FontAwesome;
        position: absolute;
        top: -18px;
        right: 1px;
        background-color: #fdc403;
        border-radius: 50%;
        padding: 3px 7px;
        font-size: 17px;
        font-weight: bolder;
    }



    .ontop-book{
        transform: translate(0px, -76px);

    }

    .unstyled-button {
        border: none;
        padding: 0;
        background: none;
    }

    .switch2 {
        position: relative;
        display: inline-block;
        width: 70px;
        height: 34px;
    }

    .switch2 input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider2 {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #fee799;
        -webkit-transition: .4s;
        transition: .4s;
        border-radius: 34px;
    }

    .slider2:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .slider2 {
        background-color: #fdc403;
    }

    input:focus + .slider2 {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider2:before {
        -webkit-transform: translateX(35px);
        -ms-transform: translateX(35px);
        transform: translateX(35px);
    }

    .modal-open .modal{
        background: rgba(0,0,0, 0.5) !important;
    }
    .modal.show .modal-dialog{
        top: -15vh;
    }

    .fc-widget-normal{
        right:  10px !important;
    }
</style>
