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
                            <a class="nav-link active p-15" id="live-tab" href="{{route('admin.faq')}}">All</a>
                        </li>
                        @foreach(\App\Enums\FaqEnums::$TYPE as $type_faq)
                            <li class="nav-item">
                                <a class="nav-link p-15" id="past-tab"  href="{{route('admin.type.faq', ['type'=>$type_faq])}}">{{ucfirst(trans($type_faq))}}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="myTabContent">
                            <table class="table  p-0 theme-text mb-0 f-14">
                                <thead class="secondg-bg p-0">
                                <tr>
                                    <th scope="col" >Qusetions</th>
                                    <th scope="col">Answers</th>
                                    <th scope="col">Operations</th>
                                </tr>
                                </thead>
                                <tbody class="mtop-20 f-13">
                                    @foreach($faqs as $faq)
                                        <tr class="tb-border faq_{{$faq->id}}">
                                            <td>{{$faq->title}}</td>
                                            <td style="width: 60%">@php $word = explode(" ", $faq->desc);@endphp
                                                {{implode(" ", array_splice($word, 0, 50))}}
                                                @if(count($word) >= 50)
                                                    ...
                                                @endif
                                            </td>
                                            <td class="cursor-pointer">
                                                <a class ="inline-icon-button mr-4" href="{{route('admin.editfaq', ['id'=>$faq->id])}}"><i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i></a>
                                                <a href="#" class="delete inline-icon-button" data-parent=".faq_{{$faq->id}}" data-confirm="Are you sure, you want delete this FAQ permenently? You won't be able to undo this." data-url="{{route('faq_delete',['id'=>$faq->id])}}"><i class="icon dripicons-trash p-1" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if(count($faqs)== 0)
                                <div class="row hide-on-data">
                                    <div class="col-md-12 text-center p-20">
                                        <p class="font14"><i>. No Any FAQ added here.</i></p>
                                    </div>
                                </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
