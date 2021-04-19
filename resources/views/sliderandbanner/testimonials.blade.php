@extends('layouts.app')
@section('title') Testimonials @endsection
@section('content')

 <div class="main-content grey-bg" data-barba="container" data-barba-namespace="testimonials">
     <div class="d-flex  flex-row justify-content-between">
         <h3 class="page-head theme-text text-left p-4 f-20">Testimonials</h3>
         <div class="mr-20">
             <a href="{{route('create-testimonials')}}">
                 <button class="btn f-12 theme-bg white-text"><i class="fa fa-plus p-1" aria-hidden="true"></i> Create Testimonials
                 </button>
             </a>
         </div>
     </div>
     <div class="d-flex  flex-row justify-content-between">
         <div class="page-head text-left p-2 pt-0 pb-0">
             <nav aria-label="breadcrumb">
                 <ol class="breadcrumb">
                     <li class="breadcrumb-item active" aria-current="page">Sliders & Banners</li>
                     <li class="breadcrumb-item"><a href="{{route('testimonials')}}"> Testimonials</a></li>
                 </ol>
             </nav>
         </div>
     </div>
     <!-- Dashboard cards -->
     <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
         <div class="col-lg-12">
             <div class="card h-auto p-0 pt-10">
                 <div class="row p-3 no-gutters d-flex">
                     @foreach($testimonials as $testimonial)
                        <div class="col-lg-6 test_{{$testimonial->id}}">
                             <div class="card testimonials-card">
                                 <div class="card-horizontal">
                                     <figure class="mt-4 w-80">
                                         <img class="w-80" src="{{$testimonial->image}}" alt="">
                                     </figure>
                                     <div class="card-body pl-2">
                                         <div class="d-flex justify-content-between">
                                             <h4 class="card-title f-18 theme-text">“{{$testimonial->heading}}”</h4>
                                             <div class="theme-text">
                                                 <a href="{{route('edit-testimonials', ['id'=>$testimonial->id])}}">
                                                     <i class="fa fa-pencil p-1 mr-2" aria-hidden="true"></i>
                                                 </a>
                                                 <a href="#" class="delete" data-parent=".test_{{$testimonial->id}}" data-confirm="Are you sure, you want delete this Testimonial permenently? You won't be able to undo this." data-url="{{route('testimonial_delete',['id'=>$testimonial->id])}}">
                                                     <i class="fa fa-trash p-1" aria-hidden="true"></i>
                                                 </a>
                                             </div>
                                         </div>
                                         <p class="card-text theme-text f-12">
                                             {{$testimonial->desc}}
                                         </p>
                                         <small class="theme-text end  f-14">- {{$testimonial->name}}, </small>
                                         <small class="theme-text"><span class="end f-12">S{{$testimonial->designation}}</span></small>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 </div>
                 <div class="pagination mb-2 mt-0">
                     <ul>
                         <li class="p-1">Page</li>
                         <li class="digit">{{$testimonials->currentPage()}}</li>
                         <li class="label">of</li>
                         <li class="digit">{{$testimonials->lastPage()}}</li>
                         @if(!$testimonials->onFirstPage())
                             <li class="button"><a href="{{$testimonials->previousPageUrl()}}"><img src="{{asset('static/images/Backward.svg')}}"></a>
                             </li>
                         @endif
                         @if($testimonials->currentPage() != $testimonials->lastPage())
                             <li class="button"><a href="{{$testimonials->nextPageUrl()}}"><img src="{{asset('static/images/forward.svg')}}"></a>
                             </li>
                         @endif
                     </ul>
                 </div>
             </div>
         </div>
     </div>
</div>

@endsection
