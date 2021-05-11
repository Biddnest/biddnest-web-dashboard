@extends('vendor-panel.layouts.frame')
@section('title') Manage Inventory @endsection
@section('body')

    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="addinventory">
        <div class="d-flex  flex-row justify-content-between vertical-center">
            <h3 class="page-head text-left p-4 f-20 theme-text">Inventory Management</h3>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left  pt-0 pb-0 p-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('vendor.inventorymgt')}}">Inventory Management</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Item</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Dashboard cards -->
        <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
            <div class="col-lg-12">
                <div class="card h-auto p-0 pt-20 pb-0">
                    <form>
                        <input type="hidden" value="{{$service_id}}" name="service_id">
                        <div class="header-wrap toal-header pb-0 " >
                            <div class="col-lg-6 toggle-input">
                                <div class="form-input">
                                    <label class="">Item Name</label>
                                        <select  id="" class="form-control js-example-basic-single inventory-item-select">
                                            <option >--Select--</option>
                                            @foreach($inventories as $inventory)
                                                <option value="{{$inventory->id}}" data-material="{{$inventory->material}}" data-size="{{$inventory->size}}">{{ucwords($inventory->name)}}</option>
                                            @endforeach
                                        </select>
                                        <span class="error-message">Please enter valid
                                                        Phone number</span>
                                </div>
                            </div>
                            {{--<div class="header-wrap p-0  mtop-20">
                                <a href="#" class="mr-2 filter-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="filter-dropdown "><img src="{{asset('static/vendor/images/filter.svg')}}" alt="" srcset=""></i>
                                </a>
                            </div>--}}
                        </div>
                        {{--<div class="row header-wraps pt-0 pb-0 filter-menu">
                            <div class="col-lg-6 toggle-input">
                                <div class="form-input">
                                    <span class="">
                                                    <select  id="" class="form-control js-example-basic-hide-search select-hidden">
                                                        <option >Size</option>
                                                        <option>Small </option>
                                                        <option>Medium</option>
                                                        <option>Large</option>
                                                        </select>
                                                    <span class="error-message">Please enter valid
                                                        Phone number</span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6 toggle-input ">
                                <div class="form-input">

                                                <span class="">
                                                    <select  id="" class="form-control js-example-basic-hide-search select-hidden">
                                                        <option > Material</option>
                                                        <option>Male </option>
                                                        <option>Female</option>
                                                        </select>
                                                    <span class="error-message">Please enter valid
                                                        Phone number</span>
                                                </span>
                                </div>
                            </div>
                        </div>--}}


                        <div class="header-wraps" >

                            <table class="table  text-left p-0 theme-text mb-0 primary-table p-15">
                                <thead class="secondg-bg p-0">
                                <tr>
                                    <th scope="col" style="width: 132px;">Item</th>
                                    <th scope="col">Size</th>
                                    <th scope="col" class="text-center">Material</th>
                                    <th scope="col" class="text-center">Economic Price</th>
                                    <th scope="col" class="text-center">Premium Price</th>
                                </tr>
                                </thead>
                                <tbody class="mtop-20">
                                    <tr class="tb-border">
                                        <td scope="row">
                                            <span></span>
                                            <input>
                                        </td>
                                        <td>
                                            <span></span>
                                            <input>
                                        </td>
                                        <td class="text-center">
                                            <span></span>
                                            <input>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center inventroy-price">
                                                <div class="currancy">₹</div>
                                                <div class="form-input table-input"><input type="text" class="form-control" id="" placeholder="400"></div>
                                                <div class="currancy distance">/km</div>
                                            </div>

                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center inventroy-price">
                                                <div class="currancy">₹</div>
                                                <div class="form-input table-input"><input type="text" class="form-control" id="" placeholder="500"></div>
                                                <div class="currancy distance">/km</div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>

                        </div>
                        <div class="d-flex  justify-content-between flex-row  p-20 border-top pt-0 pb-0">
                        <div class="w-50"><a class="white-text p-10" href="#"><button class="btn theme-br theme-text w-30 white-bg">Cancel</button></a>
                        </div>
                        <div class="w-50 text-right"><a class="white-text p-10"><button class="btn theme-bg white-text w-30">Save</button></a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>




    </div>

@endsection
