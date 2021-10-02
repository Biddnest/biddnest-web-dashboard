@extends('layouts.app')
@section('title') General Pages Settings @endsection
@section('content')

    <!-- Main Content -->
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="faq">
        <div class="d-flex flex-row justify-content-between">
            <h3 class="page-head text-left p-4 f-20">FAQ</h3>
            <div class="mr-20">
                <a href="{{route('admin.addfaq')}}">
                    <button class="btn theme-bg white-text"><i class="fa fa-plus p-1"
                                                               aria-hidden="true"></i> CREATE FAQ
                    </button>
                </a>
            </div>
        </div>
        <!-- Dashboard cards -->
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left  pt-0 pb-0 p-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">General Settings
                        </li>
                        <li class="breadcrumb-item"><a href="#">FAQ</a></li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="d-flex flex-row justify-content-center Dashboard-lcards">
            <div class="col-lg-10">
                <div class="card h-auto p-0 p-10">
                    <div  class="card-head right text-left border-bottom-2 p-8">
                        <h3 class="f-18 mb-4 theme-text">
                            FAQ
                        </h3>
                    </div>
                    <ul class="nav nav-tabs p-15 secondg-bg pt-0 pb-0 f-16" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link p-15" id="live-tab" href="{{route('admin.faq')}}">All</a>
                        </li>
                        @foreach(\App\Enums\FaqEnums::$TYPE as $type_faq)
                            <li class="nav-item">
                                <a class="nav-link @if($type == $type_faq) active @endif p-15" id="past-tab"  href="{{route('admin.type.faq', ['type'=>$type_faq])}}">{{ucfirst(trans($type_faq))}}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="live" role="tabpanel" aria-labelledby="live-tab">
                            <div class="d-flex  row p-20 justify-content-start" style="margin-left: -2px; margin-right: -90px;">
                                @foreach($faqs as $faq)
                                    <div class="simple-card category-cards col-sm-12">
                                        {{$faq}}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
