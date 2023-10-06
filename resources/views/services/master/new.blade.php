@extends('layouts.admin.admin-master')
@section('title')
    New Service
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
                            <li class="breadcrumb-item active"><a href="{{route('services.master.new')}}">New Service Entry</a>
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
                                <h4 class="card-title">Service Entry Form</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="feather icon-minus"></i></a></li>
                                        <li><a data-action="reload" onclick="clearServiceMasterForm();"><i class="feather icon-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <form class="form" id="ServiceMasterForm" method="post" action="#">
                                        @csrf
                                        <input type="hidden" id="HiddenFactoryID" class="form-control" name="id">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4 class="form-section"><i class="feather icon-eye"></i> About User</h4>
                                                    <div class="row">
                                                        <div class="col-md-6 no-padding">
                                                            <div class="form-group">
                                                                <label for="Factory" class=""><a class="text-info text-bold-700" onclick=" $('#NewFactory').modal({backdrop: 'static', keyboard: false});" data-toggle="modal" {{--data-target="#NewFactory"--}} title="Add New Factory">Select Factory</a>
                                                                </label><select id="Factory" class="select2 form-control" name="factory" required onchange="javascript:getCustomerList()">
                                                                    <option value="">- - - Select  Factory - - -</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 no-padding">
                                                            <div class="form-group">
                                                                <label for="Department" class=""><a class="text-info text-bold-700" onclick=" $('#NewDepartment').modal({backdrop: 'static', keyboard: false});" data-toggle="modal" {{--data-target="#NewFactory"--}} title="Add New Department">Select Department</a></label>
                                                                    <select id="Department" class="select2 form-control" name="department" required onchange="javascript:getCustomerList()">
                                                                    <option value="">- - - Select  Department - - -</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 no-padding">
                                                            <div class="form-group">
                                                                <label for="Customer" class=""><a class="text-info text-bold-700" onclick=" $('#NewCustomer').modal({backdrop: 'static', keyboard: false});" data-toggle="modal" {{--data-target="#NewFactory"--}} title="Add New Employee">Select Employee</a></label>
                                                                <select id="Customer" class="select2 form-control" name="customer" required onchange="javascript:getCustomerInfo(this)">
                                                                    <option value="">- - - Select  Employee - - -</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h4 class="form-section"><i class="feather icon-eye"></i> Contact Info</h4>
                                                    <div class="row">
                                                        <div class="col-md-6 no-padding" >
                                                            <div class="form-group">
                                                                <label for="JobLocation" class="text-bold-700">Job Location</label>
                                                                <input type="text" id="JobLocation" maxlength="150" class="form-control" placeholder="Enter Job Location" name="job_location">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 no-padding" >
                                                            <div class="form-group">
                                                                <label for="EmailAddress" class="text-bold-700">Contact Email Address</label>
                                                                <input type="email" id="EmailAddress" maxlength="150" class="form-control" placeholder="xyz@palmalgarments.com" name="email">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 no-padding" >
                                                            <div class="form-group">
                                                                <label for="ExtNo" class="text-bold-700">Extension No</label>
                                                                <input type="text" id="ExtNo" maxlength="4" class="form-control" placeholder="xxxx" name="ext_no" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 no-padding" >
                                                            <div class="form-group">
                                                                <label for="Mobile" class="text-bold-700">Mobile No</label>
                                                                <input type="text" id="Mobile" maxlength="11" class="form-control" placeholder="018********" name="mobile_no" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h4 class="form-section"><i class="feather icon-eye"></i> Product Info</h4>
                                                    <div class="row">
                                                        <div class="col-md-6 no-padding">
                                                            <div class="form-group">
                                                                <label for="ProductCategory" class=""><a class="text-info text-bold-700" onclick=" $('#NewProductCategory').modal({backdrop: 'static', keyboard: false});" data-toggle="modal" {{--data-target="#NewFactory"--}} title="Add New Product Category">Select Product Category</a>
                                                                </label>
                                                                <select id="ProductCategory" class="select2 form-control" name="product_category" required onchange="javascript:getProductSubCategoryByCategory(this)">
                                                                    <option value="">- - - Select Product Category - - -</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 no-padding">
                                                            <div class="form-group">
                                                                <label for="ProductCategory" class=""><a class="text-info text-bold-700" onclick=" $('#NewProductSubCategory').modal({backdrop: 'static', keyboard: false});" data-toggle="modal" {{--data-target="#NewFactory"--}} title="Add New Product Category">Select Product Sub-Category</a>
                                                                </label>
                                                                <select id="ProductSubCategory" class="select2 form-control" name="product_sub_category" required onchange="javascript:getProductMasterList()">
                                                                    <option value="">- - - Select Product Sub-Category - - -</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 no-padding">
                                                            <div class="form-group">
                                                                <label for="ProductMaster" class=""><a class="text-info text-bold-700" onclick=" $('#NewProductMaster').modal({backdrop: 'static', keyboard: false});" data-toggle="modal" {{--data-target="#NewFactory"--}} title="Add New Product">Select Product</a>
                                                                </label>
                                                                <select id="ProductMaster" class="select2 form-control" name="product_master" required>
                                                                    <option value="">- - - Select Product - - -</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h4 class="form-section"><i class="feather icon-eye"></i> Receive Info</h4>
                                                    <div class="row">
                                                        <div class="col-md-6 no-padding" >
                                                            <div class="form-group">
                                                                <label for="MReceivedBy" class="text-bold-700">Received By</label>
                                                                <select id="MReceivedBy" class="select2 form-control" name="received_by" required>
                                                                    <option value="">- - - Select Receiver - - -</option>
                                                                    @if(!empty($users))
                                                                        @foreach($users as $user)
                                                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 no-padding" >
                                                            <div class="form-group">
                                                                <label for="ReceivedAt" class="text-bold-700">Receive Date & Time</label>
                                                                <input type="datetime-local" id="ReceivedAt" class="form-control" name="received_at" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <h4 class="form-section"><i class="feather icon-eye"></i> Problem Info</h4>
                                                    <div class="row">
                                                        <div class="col-md-12 no-padding" >
                                                            <div class="form-group" >
                                                                <label for="ProblemDescription" class="text-bold-700">Problem Description</label>
                                                                <textarea id="ProblemDescription" rows="40" class="form-control" name="problem_description" placeholder="Write Problem...."></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 no-padding" >
                                                            <div class="form-group">
                                                                <label for="Remarks" class="text-bold-700">Remarks</label>
                                                                <input type="text" id="Remarks" maxlength="200" class="form-control" name="remarks">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions right">
                                            <button type="submit" id="submit_button_service" class="btn btn-outline-primary">
                                                <i class="feather icon-check"></i> Save
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
    @include('layouts.common-modals.new-product-category-modal')
    @include('layouts.common-modals.new-product-sub-category-modal')
    @include('layouts.common-modals.new-manufacturer-modal')
    @include('layouts.common-modals.new-product-master-modal')
    @include('layouts.common-modals.new-factory-modal')
    @include('layouts.common-modals.new-designation-modal')
    @include('layouts.common-modals.new-department-modal')
    @include('layouts.common-modals.new-customer-modal')
@endsection

@section('pageScripts')
    {{-- <script src="{{ asset('/stack-admin/app-assets/js/scripts/modal/components-modal.js') }}"></script>--}}
    <script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
    <script src="{{ asset('/js/custom/common.js') }}"></script>
    <script src="{{ asset('/js/custom/back-end/submit-forms.js') }}"></script>
    @include('layouts.common-modal-js.new-product-category-modal-js')
    @include('layouts.common-modal-js.new-product-sub-category-modal-js')
    @include('layouts.common-modal-js.new-manufacturer-modal-js')
    @include('layouts.common-modal-js.new-product-master-modal-js')
    @include('layouts.common-modal-js.new-factory-modal-js')
    @include('layouts.common-modal-js.new-designation-modal-js')
    @include('layouts.common-modal-js.new-department-modal-js')
    @include('layouts.common-modal-js.new-service-master-modal-js')
    @include('layouts.common-modal-js.new-customer-modal-js')
@endsection



