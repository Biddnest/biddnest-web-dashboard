@extends('layouts.app')
@section('title') Testimonials @endsection
@section('content')

 <!-- Main Content -->
 <div class="main-content grey-bg" data-barba="container" data-barba-namespace="createtestimonial">
     <div class="d-flex flex-row justify-content-between">
         <h3 class="page-head text-left p-4 f-18">Testimonials</h3>
     </div>
     <div class="d-flex  flex-row justify-content-between">
         <div class="page-head text-left  pt-0 pb-0 mt-1">
             <nav aria-label="breadcrumb">
                 <ol class="breadcrumb">
                     <li class="breadcrumb-item active" aria-current="page">Sliders & Banners</li>
                     <li class="breadcrumb-item"><a href="testimonials.html"> Testimonials</a></li>
                     <li class="breadcrumb-item"><a href="#"> @if(!$testimonials) Create @else Edit @endif Testimonials</a></li>
                 </ol>
             </nav>
         </div>
     </div>
     <!-- Dashboard cards -->
     <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
         <div class="col-lg-10">
             <div class="card h-auto p-0 pt-10">
                 <div class="card-head right text-left border-bottom-2 p-10 pt-20 pb-0">
                     <h3 class="f-18 mb-4 pl-2 theme-text">
                         @if(!$testimonials) Create @else Edit @endif Testimonials
                     </h3>
                 </div>
                 <form action="@if(!$testimonials){{route('testimonial_add')}}@else{{route('testimonial_edit')}}@endif" method="@if(isset($testimonials)){{"PUT"}}@else{{"POST"}}@endif" data-next="redirect" data-redirect-type="hard" data-url="{{route('testimonials')}}" data-alert="tiny" class="form-new-order pt-4 mt-3 input-text-blue" data-parsley-validate >
                     <div class="d-flex row">
                         @if($testimonials)
                             <input type="hidden" name="id" value="{{$testimonials->id}}">
                         @endif
                         <div class="col-lg-6">
                             <p class="img-label">Image</p>
                             <div class="upload-section p-20 pt-0">
                                 <img class="upload-preview" src="@if(!$testimonials){{asset('static/images/upload-image.svg')}}@else{{$testimonials->image}}@endif" alt=""/>
                                 <div class="ml-1">
                                     <div class="file-upload">
                                         <input type="file" />
                                         <input type="hidden" class="base-holder" name="image" value="@if($testimonials){{$testimonials->image}}@endif" required />
                                         <button type="button" class="btn theme-bg white-text my-0" data-action="upload">
                                             UPLOAD IMAGE
                                         </button>
                                     </div>
                                     <p>Max File size: 1MB</p>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="d-flex row p-20">
                         <div class="col-lg-6">
                             <div class="form-input">
                                 <label class="customer-name">Constomer Name</label>
                                 <input type="text" placeholder="Manoj" id="constomer-name" class="form-control br-5" value="@if($testimonials){{$testimonials->name}}@endif" name="name" required/>
                                 <span class="error-message">please enter valid name</span>
                             </div>
                         </div>
                         <div class="col-lg-6">
                             <div class="form-input">
                                 <label class="full-name">Customer Designation</label>
                                 <input type="text" placeholder="Manager" id="customer-desig" class="form-control br-5" value="@if($testimonials){{$testimonials->designation}}@endif" name="designation" required/>
                                 <span class="error-message">please enter valid Designation</span>
                             </div>
                         </div>
                         <div class="col-lg-6">

                             {{-- <label class="full-name theme-text bold f-14 pt-4">Ratings</label>
                                                          <div class="rating">
                                                            <input type="radio" name="rating" id="rating-5">
                                                            <label for="rating-5"></label>
                                                            <input type="radio" name="rating" id="rating-4">
                                                            <label for="rating-4"></label>
                                                            <input type="radio" name="rating" id="rating-3">
                                                            <label for="rating-3"></label>
                                                            <input type="radio" name="rating" id="rating-2">
                                                            <label for="rating-2"></label>
                                                            <input type="radio" name="rating" id="rating-1">
                                                            <label for="rating-1"></label>
                                                       </div>--}}
                             <label class="full-name theme-text bold f-14 pt-4">Heading</label>
                             <input type="text" name="heading" placeholder="Awesome Service" name="heading" value="@if($testimonials){{$testimonials->heading}}@endif" class="form-control br-5" required>
                         </div>
                         <div class="col-lg-12">
                             <div class="form-group theme-text">
                                 <label class="pt-4 f-14 bold">Description</label>
                                 <textarea class ="form-control" rows = "3" name="desc" placeholder = "Player Details" required>@if($testimonials){{$testimonials->desc}}@endif</textarea>
                                 <span class="error-message">Please enter valid Description</span>
                             </div>
                         </div>
                     </div>
                     <div class="" id="comments">
                         <div class="d-flex justify-content-between flex-row p-10 py-0" style="border-top: 1px solid #70707040">
                             <div class="w-50">
                                 <a class="white-text p-10" href="#">
                                     <button type="button" class="btn br-5 theme-br theme-text w-30 white-bg">
                                         Cancel
                                     </button>
                                 </a>
                             </div>
                             <div class="w-50 text-right">
                                 <a class="white-text p-10">
                                     <button class="btn br-5 theme-bg white-text w-30">
                                         Save
                                     </button>
                                 </a>
                             </div>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>
</div>

@endsection
