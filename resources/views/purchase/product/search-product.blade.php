@extends('layouts.admin.admin-master')
@section('title')
    Product Search
@endsection
@section('content')
    <style>
        td {
            font-size: small;
        }

        th{
            font-size: small;
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
                            <li class="breadcrumb-item active"><a href="{{route('purchase.product.search')}}">Search Product</a>
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
                                                <div class="col-md-8 no-padding">
                                                    <div class="form-group">
                                                        <label for="Vendor" class="text-bold-700">Select Vendor</label>
                                                        <select id="Vendor" class="select2 form-control" multiple="multiple" name="vendor[]">

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 no-padding">
                                                    <div class="form-group " >
                                                        <label for="Serial" class="text-bold-700">Search Serial No</label>
                                                        <input id="Serial" type="text" class="form-control" name="serial_no" >
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
                                                <i class="feather icon-check"></i> Search Product
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
                                                <th class="text-center">Category</th>
                                                <th class="text-center">Sub-Category</th>
                                                <th class="text-center">Manufacturer</th>
                                                <th class="text-center">Vendor</th>
                                                <th class="text-center">Old Vendor</th>
                                                <th class="text-center">Product</th>
                                                <th class="text-center">Old P. Name</th>
                                                <th class="text-center">P Date</th>
                                                <th class="text-center">Sl. No.</th>
                                                <th class="text-center">Warranty in Months</th>
                                                <th class="text-center">Has Warranty</th>
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
    @include('layouts.common-modal-js.search-product-detail-search-modal-js')
@endsection


