        <title>@yield('title')</title>
        <meta charset="utf-8">
        <link rel="icon" type="image/svg+xml" href="{{ asset('static/images/favicon.svg')}}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Font -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dripicons/2.0.0/webfont.min.css" integrity="sha512-pi7KSLdGMxSE62WWJ62B1R5/H7WNnIsj2f51MikplRt31K0uCZ1lfPSw/0Jb1flSz6Ed2YLSlox6Uulf7CaFiA==" crossorigin="anonymous" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" integrity="sha512-42kB9yDlYiCEfx2xVwq0q7hT4uf26FUgSIZBK8uiaEnTdShXjwr8Ip1V4xGJMg3mHkUt9nNuTDxunHF0/EgxLQ==" crossorigin="anonymous" />

        <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Toggle btn -->
        <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
        <!-- sortable -->
        <link href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" rel="stylesheet">
        <!-- SLick -->
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />

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

        <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

        <link rel="stylesheet" href="{{ asset('static/css/master.css')}}" />
        <link rel="stylesheet" href="{{ asset('static/css/multidatepicker.css')}}" />
        <link rel="stylesheet" href="{{ asset('static/css/chat.css')}}" />

        <link rel="stylesheet" type="text/css" href="{{ asset('static/css/jquery.tagsinput.min.css')}}" />

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.7.1/skins/content/default/content.min.css" integrity="sha512-KYlPDsJE6wqDev6smrRzaH8VwjoFV9Xj4VzyoUok3vzkVZe0g32WFiVawEiAD77EI2tSoruKNJCedUSCrk5E/Q==" crossorigin="anonymous" />--}}

        <style>
            .nav-collapse .li {
                list-style-type: none !important;
            }

            .modal-body {
                margin-left: 6.5px;
            }

            .btn-1 {
                width: 100%;
            }

            #myTab {
                /* margin-left: -4px; */
            }

            main .menu-sidebar {
                margin-top: 70px;
            }

            main .menu-sidebar .Brand-logo {
                height: 70px;
            }

            .ml-48 {
                margin-left: 48px;
            }

            .vendor-switch2.toggle-group.toggle-on.btn-xs {
                background-color: #2E0789 !important;
                padding: 12px !important;
            }

            .ml-15 {
                margin-left: -15px !important;
            }

            .pl-10 {
                padding-left: 10px;
            }

            .default-image {
                width: 85px;
                height: 65px;
            }

            .h-35 {
                height: 35px !important;
            }

            .tagify {
                padding: 0px !important;
                /* height: 38px !important; */
                /* background-color: #f1f9ff !important; */
                border: 2px solid #DFE6EC !important;
                border-radius: 5px !important;
            }

            .form-input textarea.form-control:focus {
                border-color: #bcbcbc;
                box-shadow: none;
            }

            select {
                -webkit-appearance: none;
                -moz-appearance: none;
                -o-appearance: none;
            }

            select+i.fa {
                float: right;
                margin-top: -26px;
                margin-right: 5px;
                pointer-events: none;
                color: #2699fb;

                padding-right: 8px;
            }

            .table td,
            .table th {
                padding: 1.75rem !important;
                vertical-align: top;
                border-top: none;
                text-align: center;
            }

            .btn-xs {
                font-size: 8px !important;
            }

            .slick-list {
                width: 85px !important;
            }

            .slick-image {
                width: 85px !important;
            }

            .w-25 {
                width: 25% !important;
            }

            table .w-10 {
                width: 10%;
            }

            table .w-30 {
                width: 30%;
            }

            .f-l {
                font-size: large;
            }

            .p-8 {
                padding: 8px 16px !important;
            }

            .w-38 {
                width: 38%;

            }

            /* error bredcrum */
            .breadcrumb {
                margin-top: -20px !important;
            }

            .toggle-handle {
                position: absolute;
                top: 10%;
                left: 40px !important;
            }

            .toggle.btn-outline-secondary .toggle-handle {
                left: 73px !important;
            }

            .toggle-off.btn-xs {
                padding-left: 30px !important;
            }

            .btn-outline-primary:hover {
                color: #fff;
                background-color: #2E0789 !important;
                border-color: #2E0789 !important;
            }

            .Dashboard-lcards .table tbody tr:hover {
                border: none !important;
            }

            select.form-control:not([size]):not([multiple]) {
                height: calc(2.25rem + 14px);
            }


            .Dashboard-lcards .table td,
            .Dashboard-lcards .table th {
                padding: 0.75rem;
                border-top: none;
                vertical-align: baseline;
                text-align: left !important;
            }

            .Dashboard-lcards .table th {
                /*padding: 1.75rem !important;*/
                border-top: none;
            }

            .select-styled {
                border-bottom-left-radius: 0px !important;
                border-bottom-right-radius: 0px !important;
            }

            .order-status {
                width: 85%;
                align-self: center;
                margin: 20px 80px;
            }

            .dash-line {
                position: absolute;
                border: none;
                border-top: 2px dashed #C0E2FD;
                height: 0px;
                margin-left: 52px;
                margin-top: 20px;
                width: 88%;
            }

            .steps-container {
                width: 100%;
                align-self: center;
                display: flex;
                flex-direction: row;
                justify-content: space-between;
            }

            .step {
                z-index: 1;
                display: flex;
                align-items: center;
                flex-direction: column;
            }

            .step-dot {
                width: 38px;
                height: 38px;
                z-index: 1;
                background-color: #2E0789;
                border-radius: 19px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .step-title {
                margin: 0 auto;
                color: #2E0789;
            }

            .child-dot {
                width: 28px;
                height: 28px;
                border-radius: 14px;
                z-index: 1;
                border: 3px solid white;
            }

            .background-color-lightblue {
                background-color: #EFF7FF;
            }

            .table-width {
                width: 95%;
                margin: 0 auto;

            }


            .toggle-group .toggle-on.btn-xs {
                background-color: #2E0789 !important;
                padding: 15px;
                font-size: 12px !important;
            }

            .toggle-group .toggle-off.btn-xs {
                background-color: #2E0789 !important;
                border-color: #2E0789 !important;
                padding: 15px;
                font-size: 12px !important;
            }

            .header {
                padding-top: 10px !important;
                padding-left: 17px !important;
                padding-right: 17px !important;
                padding-bottom: 10px !important;
            }


            input[type=checkbox],
            input[type=radio] {
                margin: 4px -20px 0;
            }

            .title {
                margin-top: 5px !important;
                margin-bottom: 10px !important;
                padding-left: 20px !important;
            }


            .spinner-wrapper {

                /*text-align: ;*/
            }

            .btn {
                position: relative;
            }

            .spinner {
                stroke: #fff;
                -webkit-animation: rotation 1.35s linear infinite;
                animation: rotation 1.35s linear infinite;
            }

            @-webkit-keyframes rotation {
                0% {
                    -webkit-transform: rotate(0deg);
                    transform: rotate(0deg);
                }

                100% {
                    -webkit-transform: rotate(270deg);
                    transform: rotate(270deg);
                }
            }

            @keyframes rotation {
                0% {
                    -webkit-transform: rotate(0deg);
                    transform: rotate(0deg);
                }

                100% {
                    -webkit-transform: rotate(270deg);
                    transform: rotate(270deg);
                }
            }

            .circle {
                stroke-dasharray: 180;
                stroke-dashoffset: 0;
                -webkit-transform-origin: center;
                -ms-transform-origin: center;
                transform-origin: center;
                -webkit-animation: turn 1.35s ease-in-out infinite;
                animation: turn 1.35s ease-in-out infinite;
            }

            @-webkit-keyframes turn {
                0% {
                    stroke-dashoffset: 180;
                }

                50% {
                    stroke-dashoffset: 45;
                    -webkit-transform: rotate(135deg);
                    transform: rotate(135deg);
                }

                100% {
                    stroke-dashoffset: 180;
                    -webkit-transform: rotate(450deg);
                    transform: rotate(450deg);
                }
            }

            @keyframes turn {
                0% {
                    stroke-dashoffset: 180;
                }

                50% {
                    stroke-dashoffset: 45;
                    -webkit-transform: rotate(135deg);
                    transform: rotate(135deg);
                }

                100% {
                    stroke-dashoffset: 180;
                    -webkit-transform: rotate(450deg);
                    transform: rotate(450deg);
                }
            }

            .parsley-errors-list {
                text-align: right;
            }

            .parsley-errors-list li {
                list-style: none;
                color: red;
                /*padding: 3px 0;*/
                font-family: "Gilroy";
                font-weight: 600;
            }

            .pagination .label {
                color: #000 !important;
            }

            .header-wrap {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0px !important;
            }

            .upload-preview {
                max-width: 70px;
            }

            .accordion {
                background-color: #f2e6ff;
                color: #444;
                cursor: pointer;
                padding: 18px;
                width: 100%;
                border: none;
                text-align: left;
                outline: none;
                font-size: 15px;
                transition: 0.4s;
            }

            .accordion:hover {
                background-color: #ad8cf9;
            }

            .panel {
                padding: 0 18px;
                display: none;
                background-color: white;
                overflow: hidden;
            }

            #addr1 .btn-1 {
                border-radius: 5px;
                padding: 4px 10px;
                text-transform: uppercase;
                font-weight: 500;
                letter-spacing: 1px;
                background-color: #FDC403;
                margin: 0px 0px !important;
                font-size: 12px;
            }

            .Dashboard-lcards .table tr :first-child {
                /* padding-left: 10px !important; */
                text-align: left;
            }

            .hidden {
                display: none;
            }

            .input-suggestion-wrapper {
                background: #fff;
                position: absolute;
                width: 90%;
                height: auto;
                bottom: -92%;
                left: 5%;
                padding: 10px;
                z-index: 999;
                /*border: 1px solid;*/
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
            }

            .input-suggestion-wrapper:hover {
                box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            }

            .select2-container {
                width: 100% !important;
            }

            .select2-search__field {
                width: 100% !important;
                /*width: 0.75em !important;*/
            }

            .select2-container--default .select2-selection--multiple {
                border: 2px solid #DFE6EC;
                font-size: 14px;
                min-height: 34px;
                border-radius: 5px;
            }

            body.dragging,
            body.dragging * {
                cursor: move !important;
            }

            .dragger {
                cursor: move !important;
            }

            .dragged {
                position: absolute;
                opacity: 0.5;
                z-index: 2000;
            }

            .ui-sortable-placeholder {
                border-radius: 5px;
                border: 3px dashed #c0c0c0;
                visibility: visible !important;
            }

            /*.modal-backdrop{*/
            /*    display: none !important;*/
            /*}*/
            /*.modal{*/
            /*    z-index: 999;*/
            /*    margin-top: 15%;*/
            /*}*/
            .fullscreen-modal-body .modal-header::before {
                display: none;
            }

            .fullscreen-modal-body .modal-header .modal-title {
                font-weight: bold;
                font-size: 18px;
                text-align: left !important;
            }

            .fullscreen-modal-body .modal-header .close {
                position: absolute;
                right: 20px;
                top: 10px;
            }

            .fullscreen-modal-body {
                background-color: #FFFFFF;
                border-radius: 5px;
                position: relative;
            }

            .fullscreen-modal {
                z-index: 999;
                display: none;
                position: absolute;
                top: 30px;
                left: 0px;
                margin-left: 0%;
                width: 100%;
                min-height: 100%;
                background-color: rgba(0, 0, 0, 0.4);
                padding: 5% 10%;
                overflow-y: scroll;
                /*background-color: #000000;*/
            }

            .branch-wrapper .branch-snip .data-group>div {
                margin-top: 30%;
            }

            .branch-wrapper .branch-snip .data-group a {
                /*display: inline-block;*/
                margin: 5px;
                /* padding: 10px 11px; */
                padding: 10px 16px;
                border-radius: 50%;
                background: #f2f2f2;
            }

            .branch-wrapper .branch-snip .data-group h6 {
                text-transform: uppercase;
                font-weight: 700;
                font-size: 10px;
                letter-spacing: 1px;
            }

            .branch-wrapper .branch-snip .data-group p {
                font-size: 14px;
                /*font-family: "Gilroy", sans-serif;*/
                /*font-weight: 600;*/
            }

            .branch-wrapper .branch-snip .data-group {
                /*border-right: 1px solid #f2f2f2;*/
                padding: 0 10px;
                margin: 0;
                position: relative;
                max-width: 20%;
            }

            .branch-wrapper .branch-snip .data-group:last-child::after {
                display: none;
            }

            /* .branch-wrapper .branch-snip .data-group::after{
                width: 1px;
                position: absolute;
                height: 70%;
                right: -15px;
                top: 15%;
                content: "";
                display: block;
                background: #c0c0c0;

            } */
            .branch-wrapper .branch-snip {
                position: relative;
                border-radius: 2px;
                border: 2px solid #f2f2f2;
                margin: 0 20px 0 20px;
                padding: 10px 0px 15px 0px;
            }

            .branch-wrapper * {
                /*border: 1px solid #000;*/
            }

            .branch-wrapper {
                margin: 2% 0 2% 0;
            }

            .user-profile-snip .profile-meta {
                background: #f8f8f8;
                padding: 10px 0;
                padding-top: 30px;
                margin-top: -30px;
                font-size: 14px;
            }

            .user-profile-snip .profile-img {
                border-radius: 50%;
                max-width: 100px;
                max-height: 100px;
            }

            .user-profile-snip:last-child {
                /*margin-right: 20px;*/
            }

            .user-profile-snip:first-child {
                /*margin-left: 20px;*/
            }

            .user-profile-snip {
                margin: 10px !important;
                /*padding: 0 !important;*/
                text-align: center;
                font-family: "Gilroy", sans-serif;
            }

            .user-profile-snip .action {
                padding: 10px 0;
            }

            .user-profile-snip h5 {
                font-weight: 700;
                font-size: 16px;
            }

            .user-profile-snip span {
                font-family: "Roboto", sans-serif;
                /*font-weight: 500;*/
                display: block;
                padding: 3px 0;
            }

            .inline-icon-button i {
                position: absolute;
                left: 50%;
                top: 50%;
                margin-right: 1.5rem !important;
                transform: translate(-50%, -40%) !important;

            }

            /*table .inline-icon-button{
                display: inline !important;
                padding: 10px 15px;
                margin: 2px;
            }*/

            .inline-icon-button {
                cursor: pointer;
                margin: 10px;
                height: 30px;
                width: 30px;
                position: relative;
                /*padding: 10px 10px;*/
                /*display: table-cell;*/
                border-radius: 50%;
                background: #f2f2f2;
            }

            .inventory-snip:first-child .closer {
                display: none;
            }

            .pop-up-preloader {
                background: rgba(255, 255, 255, 0.3);
                position: absolute;
                left: 0;
                top: 0;
                height: 100%;
                width: 100%;
                text-align: center;
            }

            .circular {
                -webkit-animation: rotate 2s linear infinite;
                animation: rotate 2s linear infinite;
                height: 50px;
                left: 45%;
                position: absolute;
                top: 25%;
                /*transform: translate(-50%,-50%);*/
                width: 50px;
            }

            .path {
                stroke-dasharray: 1, 200;
                stroke-dashoffset: 0;
                -webkit-animation: dash 1.5s ease-in-out infinite, color 6s ease-in-out infinite;
                animation: dash 1.5s ease-in-out infinite, color 6s ease-in-out infinite;
                stroke-linecap: round;
                stroke: #2E0789;
            }

            @-webkit-keyframes rotate {
                100% {
                    transform: rotate(360deg);
                }
            }

            @keyframes rotate {
                100% {
                    transform: rotate(360deg);
                }
            }

            @-webkit-keyframes dash {
                0% {
                    stroke-dasharray: 1, 200;
                    stroke-dashoffset: 0;
                }

                50% {
                    stroke-dasharray: 89, 200;
                    stroke-dashoffset: -35;
                }

                100% {
                    stroke-dasharray: 89, 200;
                    stroke-dashoffset: -124;
                }
            }

            @keyframes dash {
                0% {
                    stroke-dasharray: 1, 200;
                    stroke-dashoffset: 0;
                }

                50% {
                    stroke-dasharray: 89, 200;
                    stroke-dashoffset: -35;
                }

                100% {
                    stroke-dasharray: 89, 200;
                    stroke-dashoffset: -124;
                }
            }

            .modal-header {
                padding: 15px 10px;
            }

            .modal-header h3.f-14 {
                margin-top: 0;
                margin-bottom: 8px;
            }

            .Dashboard-lcards .table td,
            .Dashboard-lcards .table th {
                vertical-align: middle;
            }

            .modal-header .close {
                padding: 15px 10px;
                margin: -1rem 0rem -1rem auto;
            }

            .modal-body {
                margin-bottom: 50px;
            }

            .edit {
                padding-right: 25px;
            }

            .thead {
                font-weight: revert;
                font-size: 16px;
            }

            label.custom-check {
                cursor: pointer;
                text-indent: -9999px;
                width: 60px;
                height: 30px;
                background: grey;
                display: block;
                border-radius: 15px;
                position: relative;
            }

            label.custom-check:after {
                content: '';
                position: absolute;
                top: 3px;
                left: 3px;
                width: 24px;
                height: 24px;
                background: #fff;
                border-radius: 90px;
                transition: 0.3s;
            }

            input[type=checkbox] {
                display: none;
            }

            input[type=checkbox]:checked+label.custom-check {
                background: #f8c446;
            }

            input[type=checkbox]:checked+label.custom-check:after {
                left: calc(100% - 5px);
                transform: translateX(-100%);
            }

            label.custom-check:active:after {
                /*width: 50px;*/
            }

            .link-regular {
                color: #2E0789 !important;
                text-decoration: none !important;
            }

            .Weekly {
                display: none;
            }

            .fr-box.fr-basic .fr-element {

                height: 105px;
            }

            .margin-left-10 {
                margin-left: -10px !important;
            }

            .irs--round .irs-handle {
                top: 31px !important;
                width: 12px !important;
                height: 12px !important;
                border: none !important;
                cursor: pointer;
            }

            .irs--round .irs-bar {
                background-color: #2e0789 !important;
            }

            .irs--round .irs-from,
            .irs--round .irs-to,
            .irs--round .irs-single {
                background-color: #2e0789 !important;
            }

            .irs--round .irs-from:before,
            .irs--round .irs-to:before,
            .irs--round .irs-single:before {
                border-top-color: #2e0789 !important;
            }

            select {
                -webkit-appearance: listbox !important;
            }

            .pagination ul li {
                font-size: 14px !important;
            }


            .a-underline {
                text-decoration: underline !important;
                text-decoration-color: #f8c446;

            }
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


            .select2-container--default .select2-selection--multiple .select2-selection__choice{
                background-color: #F2E6FF !important;
            }
            .select2-container--default .select2-selection--multiple .select2-selection__choice__remove{
                color: #312489 !important;
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
        </style>
