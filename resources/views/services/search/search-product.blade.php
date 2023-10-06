@extends('layouts.admin.admin-master')
@section('title')
    Service Search
@endsection
@section('content')
    <style>
        td {
            font-size: x-small;
        }

        th{
            font-size: x-small;
        }

    </style>
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12">
                <h2 class="content-header-title mb-0">Dashboard</h2>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="{{route('services.search.product')}}">Service Search Product</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="form-section">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Search Parameter Form</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="feather icon-minus"></i></a></li>
                                        <li><a data-action="reload" onclick="clearServiceMasterForm(); changeButtonText(' Save', 'submit_button', 3);"><i class="feather icon-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <form class="form" id="WorkExperienceForm" method="post" action="#">
                                        @csrf
                                        <input type="hidden" id="HiddenFactoryID" class="form-control" name="id" >
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-2 no-padding">
                                                    <div class="form-group">
                                                        <label for="ProductCategory" class="text-info text-bold-700"><a onclick="getProductCategoryList()" title="Refresh Product Category List">Select Category</a></label>
                                                        <select id="ProductCategory" class="select2 form-control" name="product_category" onchange="javascript:getProductSubCategoryByCategory(this)">
                                                            <option value="">- - - Select Category - - -</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 no-padding">
                                                    <div class="form-group">
                                                        <label for="ProductSubCategory" class="text-bold-700">Select Sub-Category</label>
                                                        <select id="ProductSubCategory" class="select2 form-control" name="product_sub_category" onchange="javascript:getProductMasterList()">
                                                            <option value="">- - - Select Sub-Category - - -</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 no-padding">
                                                    <div class="form-group">
                                                        <label for="ProductMaster" class="text-bold-700">Select Product</label>
                                                        <select id="ProductMaster" class="select2 form-control" multiple="multiple" name="product_master[]">

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 no-padding">
                                                    <div class="form-group">
                                                        <label for="Factory" class="text-bold-700">Select Factory</label>
                                                        <select id="Factory" class="select2 form-control" multiple="multiple" name="factory[]">

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 no-padding">
                                                    <div class="form-group">
                                                        <label for="Department" class="text-bold-700">Select Department</label>
                                                        <select id="Department" class="select2 form-control" multiple="multiple" name="department[]">

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 no-padding">
                                                    <div class="form-group">
                                                        <label for="Status" class="text-bold-700">Select Status</label>
                                                        <select id="Status" class="select2 form-control" multiple="multiple" name="status[]">
                                                            <option value="I">In Queue</option>
                                                            <option value="SA">Assigned</option>
                                                            <option value="UP">Under Process</option>
                                                            <option value="RW">Requested for Warranty</option>
                                                            <option value="WR">Received from Warranty</option>
                                                            <option value="SC">Service Complete</option>
                                                            <option value="CA">Service Complete Approved</option>
                                                            <option value="SD">Delivered</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 no-padding">
                                                    <div class="form-group " >
                                                        <label for="SLNo" class="text-bold-700">Search Count</label>
                                                        <input id="SLNo" type="text" class="form-control" name="count" required>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-actions right">
                                            <button type="submit" id="submit_button" class="btn btn-outline-primary">
                                                <i class="feather icon-check"></i> Search
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Service List</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse" title="minimize"><i class="feather icon-minus"></i></a></li>
                                        {{--<li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>--}}
                                        <li><a data-action="expand" title="maximize"><i class="feather icon-maximize"></i></a></li>
                                        {{--<li><a data-action="close"><i class="feather icon-x"></i></a></li>--}}
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <table id="social-media-table" class="table table-striped table-responsive-lg table-bordered table-condensed social-media table-info">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Service ID</th>
                                                <th class="text-center">Category</th>
                                                <th class="text-center">Sub-Category</th>
                                                <th class="text-center">Manufacturer</th>
                                                <th class="text-center">Product</th>

                                                <th class="text-center">Factory</th>
                                                <th class="text-center">Department</th>

                                                <th class="text-center">Employee Name</th>
                                                <th class="text-center">Designation</th>
                                                <th class="text-center">Contact Info</th>
                                                <th class="text-center">Contact Email</th>

                                                <th class="text-center">Received At</th>
                                                <th class="text-center">Age (Days)</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('page-modals')

@endsection

@section('pageScripts')
    {{--<script src="{{ asset('/stack-admin/app-assets/js/scripts/modal/components-modal.js') }}"></script>--}}
    <script src="{{ asset('/js/custom/common.js') }}"></script>
    <script src="{{ asset('/stack-admin/app-assets/js/scripts/forms/custom-file-input.js') }}"></script>
    {{--<script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>--}}
    @include('layouts.common-modal-js.search-service-master-product-modal-js')
@endsection


