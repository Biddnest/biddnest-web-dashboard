<div class="modal-header pb-0">
                    <h3 class=" p-2  pt-3 f-18 mt-0 "> Sub-category Details</h3>

                    <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close"
                        onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                        <i class="fa fa-times theme-text" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex  pb-4 pl-3">
                        <div class="col-lg-12 pl-0 ">
                            <div class="profile-section">
                                <figure>
                                    <img src="{{$subcategory->image}}" alt="">
                                </figure>
                                <div class="profile-details-side-pop ml-0">
                                    <ul>
                                        <li>
                                            <h1>{{ucfirst(trans($subcategory->name))}}</h1>
                                            <i class="icon dripicons-pencil pr-1 mr-1 " style="color: #3BA3FB;"
                                            aria-hidden="true"></i>
                                        </li>
                                        @if($subcategory->services)
                                            <li>
                                                    <h2>{{ucfirst(trans($subcategory->services->name))}}</h2>
                                                    <label class="switch mb-0" style="transform: scale(0.7);">
                                                        <input type="checkbox" id="switch">
                                                        <span class="slider"></span>
                                                    </label>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(isset($subcategory->inventories))
                        <div class="d-flex  row  p-10 border-top-pop">
                            <div class="col-sm-6  pl-0">
                                <div class="theme-text f-14 bold ">
                                    Inventory List
                                </div>
                            </div>
                        </div>
                        <table class="table text-left p-10 theme-text">
                            <thead class="secondg-bg  p-0">
                            <tr>
                                <th scope="col">Item Name</th>
                                <th scope="col">Material</th>
                                <th scope="col">Size</th>
                            </tr>
                            </thead>
                            <tbody class="mtop-20">
                            @foreach($subcategory->inventories as $inventory)
                                <tr class="tb-border  cursor-pointer">
                                    <th scope="row">{{$inventory->name}}</th>
                                    <td class="text-center">
                                        @foreach(json_decode($inventory->material, true) as $material)
                                            {{$material}},
                                        @endforeach
                                    </td>
                                    <td class="">
                                        @foreach(json_decode($inventory->size, true) as $size)
                                            {{$size}},
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if(count($subcategory->inventories)== 0)
                            <div class="row hide-on-data">
                                <div class="col-md-12 text-center p-20">
                                    <p class="font14"><i>.This Sub-Category don't have any Inventories here..</i></p>
                                </div>
                            </div>
                        @endif
                    @endif
                    <div class="d-flex justify-content-center p-20">
                        <div class="">
                            <a class="white-text p-10" href="{{ route('details-inventories')}}">
                                <button class="btn theme-bg white-text my-0" style="width: 127px;
                                border-radius: 6px;">View More</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
