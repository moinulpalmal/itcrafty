@extends('layouts.admin.admin-master')
@section('title')
   Edit Product
@endsection
@section('content')
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
                            <li class="breadcrumb-item active"><a href="{{route('purchase.product.edit', ['id', $product_detail->id])}}">Update Product Detail</a>
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
                                <h4 class="card-title">Product Detail Update Form</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="feather icon-minus"></i></a></li>
                                        <li><a data-action="reload" onclick="clearForm('WorkExperienceForm'); changeButtonText(' Save', 'submit_button', 3);"><i class="feather icon-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <h4 class="form-section"><i class="feather icon-eye"></i> Product Previous Info</h4>
                                    <table id="social-media-table" class="table table-striped table-bordered table-condensed social-media table-info">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Category</th>
                                            <th class="text-center">Sub-Category</th>
                                            <th class="text-center">Manufacturer</th>

                                            <th class="text-center">Master Name</th>
                                            <th class="text-center">Master Vendor</th>
                                            <th class="text-center">Purchase Date</th>

                                            <th class="text-center">Old Name</th>
                                            <th class="text-center">Old Vendor</th>
                                            {{--<th class="text-center">Old P. Date</th>--}}

                                            <th class="text-center">Sl. No.</th>
                                            <th class="text-center">Warranty (Months)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                                <tr @if($product_detail->status == 'I') class="bg-warning" @endif>
                                                    <td class="text-left">
                                                        @if($product_detail->product_master)
                                                            {{\App\Model\ProductMaster::getCategoryName($product_detail->product_master)}}
                                                            @endif
                                                    </td>
                                                    <td class="text-left">
                                                        @if($product_detail->product_master)
                                                            {{\App\Model\ProductMaster::getSubCategoryName($product_detail->product_master)}}
                                                        @endif
                                                    </td>
                                                    <td class="text-left">
                                                        @if($product_detail->product_master)
                                                            {{\App\Model\ProductMaster::getManufacturerName($product_detail->product_master)}}
                                                        @endif
                                                    </td>

                                                    <td class="text-left">
                                                        @if($product_detail->product_master)
                                                            {{\App\Model\ProductMaster::getProductMasterName($product_detail->product_master)}}
                                                        @endif
                                                    </td>
                                                    <td class="text-left">
                                                        @if($product_detail->vendor)
                                                            {{\App\Model\Vendor::getVendorName($product_detail->vendor)}}
                                                        @endif
                                                    </td>
                                                    <td class="text-left">
                                                        {{$product_detail->purchase_date}}
                                                    </td>

                                                    <td class="text-left">
                                                        {{$product_detail->old_name}}
                                                    </td>
                                                    <td class="text-left">
                                                        {{$product_detail->old_vendor}}
                                                    </td>
                                                    {{--<td class="text-left">
                                                        {{$product_detail->old_purchase_date}}
                                                    </td>--}}

                                                    <td class="text-center">
                                                        {{$product_detail->sl_no}}
                                                    </td>
                                                    <td class="text-center">
                                                        {!! \Carbon\Carbon::parse($product_detail->purchase_date)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days'); !!}
                                                        {{--{{$product_detail->warranty_in_months}}--}}
                                                    </td>
                                                </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th class="text-center">Category</th>
                                            <th class="text-center">Sub-Category</th>
                                            <th class="text-center">Manufacturer</th>

                                            <th class="text-center">Master Name</th>
                                            <th class="text-center">Master Vendor</th>
                                            <th class="text-center">Purchase Date</th>

                                            <th class="text-center">Old Name</th>
                                            <th class="text-center">Old Vendor</th>
                                            {{--<th class="text-center">Old P. Date</th>--}}

                                            <th class="text-center">Sl. No.</th>
                                            <th class="text-center">Warranty (Months)</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <form class="form" id="WorkExperienceForm" method="post" action="#">
                                        @csrf
                                        <input type="hidden" id="HiddenFactoryID" class="form-control" name="id" value="{{old('id', $product_detail->id)}}">
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="feather icon-eye"></i> Product Common Info</h4>
                                            <div class="row">
                                                <div class="col-md-6 no-padding">
                                                    <div class="form-group">
                                                        <label for="Vendor" class="text-info text-bold-700"><a {{--onclick="getVendorList()"--}} title="Refresh Vendor List">Select Vendor</a></label>
                                                        <select id="Vendor" class="select2 form-control" name="vendor" required>
                                                            <option value="">- - - Select Vendor - - -</option>
                                                            @if(!empty($vendors))
                                                                @foreach($vendors as $vendor)
                                                                    <option value="{{$vendor->id}}" @if($vendor->id == $product_detail->vendor) selected = "selected" @endif>
                                                                        {{$vendor->name}}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 no-padding">
                                                    <div class="form-group">
                                                        <label for="PurchaseDate" class="text-info text-bold-700">Purchase Date</label>
                                                        <input id="PurchaseDate" type="date" class="form-control" name="purchase_date" required value="{{old('purchase_date', $product_detail->purchase_date)}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 no-padding">
                                                    <div class="form-group">
                                                        <label for="ProductCategory" class="text-info text-bold-700"><a onclick="getProductCategoryList()" title="Refresh Product Category List">Select Product Category</a></label>
                                                        <select id="ProductCategory" class="select2 form-control" name="product_category" required onchange="javascript:getProductSubCategoryByCategory(this)">
                                                            <option value="">- - - Select Product Category - - -</option>
                                                            @if(!empty($product_categories))
                                                                @foreach($product_categories as $vendor)
                                                                    <option value="{{$vendor->id}}" @if($vendor->id == $product_master->product_category) selected = "selected" @endif>
                                                                        {{$vendor->name}}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 no-padding">
                                                    <div class="form-group">
                                                        <label for="ProductSubCategory" class="text-bold-700">Select Product Sub-Category</label>
                                                        <select id="ProductSubCategory" class="select2 form-control" name="product_sub_category" required onchange="javascript:getProductMasterList()">
                                                            <option value="">- - - Select Product Sub-Category - - -</option>
                                                            @if(!empty($product_sub_categories))
                                                                @foreach($product_sub_categories as $vendor)
                                                                    <option value="{{$vendor->id}}" @if($vendor->id == $product_master->product_sub_category) selected = "selected" @endif>
                                                                        {{$vendor->name}}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 no-padding">
                                                    <div class="form-group">
                                                        <label for="ProductMaster" class="text-bold-700">Select Product</label>
                                                        <select id="ProductMaster" class="select2 form-control" name="product_master" required>
                                                            <option value="">- - - Select Product - - -</option>
                                                            @if(!empty($product_masters))
                                                                @foreach($product_masters as $vendor)
                                                                    <option value="{{$vendor->id}}" @if($vendor->id == $product_detail->product_master) selected = "selected" @endif>
                                                                        {{$vendor->name}}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 no-padding">
                                                    <label for="SLNo" class="text-bold-700">Serial No</label>
                                                    <div class="form-group input-group control-group increment" >
                                                        <input id="SLNo" type="text" class="form-control secure" name="serial_no" required value="{{old('serial_no', $product_detail->sl_no)}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions right" id="form_actions">
                                            {{--<button onclick="javascript:clearSerialNo()" class="btn btn-outline-danger">Clear Serial No's</button>--}}
                                            <button type="submit" id="submit_button" class="btn btn-outline-primary">
                                                <i class="feather icon-check"></i> Update
                                            </button>
                                        </div>
                                    </form>
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
    {{--@include('layouts.common-modals.new-product-category-modal')
    @include('layouts.common-modals.new-product-sub-category-modal')
    @include('layouts.common-modals.new-manufacturer-modal')--}}
@endsection

@section('pageScripts')
    {{--<script src="{{ asset('/stack-admin/app-assets/js/scripts/modal/components-modal.js') }}"></script>--}}
    <script src="{{ asset('/js/custom/common.js') }}"></script>
    <script src="{{ asset('/js/barcode-scanner/on-scan.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
    @include('layouts.common-modal-js.update-purchase-product-modal-js')
@endsection



