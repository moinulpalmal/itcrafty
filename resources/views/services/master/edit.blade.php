@extends('layouts.admin.admin-master')
@section('title')
    Edit Service
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
                            <li class="breadcrumb-item active"><a href="{{route('services.master.edit', ['id' => $service_master->id])}}">Edit Service Entry</a>
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
                                <h4 class="card-title">Service Update Form</h4>
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
                                        <input type="hidden" id="HiddenFactoryID" class="form-control" name="id" value="{{old('id', $service_master->id)}}">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4 class="form-section"><i class="feather icon-eye"></i> About User</h4>
                                                    <div class="row">
                                                        <div class="col-md-6 no-padding">
                                                            <div class="form-group">
                                                                <label for="Factory" class="text-info text-bold-700"><a onclick="getFactoryList()" this="Refresh Factory List">Select Factory</a></label>
                                                                <select id="Factory" class="select2 form-control" name="factory" required onchange="javascript:getCustomerList()">
                                                                    <option value="">- - - Select  Factory - - -</option>
                                                                    @if(!empty($factories))
                                                                        @foreach($factories AS $media)
                                                                            <option value="{{$media->id}}" @if($media->id == $customer->factory) selected="selected" @endif>{{$media->name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 no-padding">
                                                            <div class="form-group">
                                                                <label for="Department" class="text-info text-bold-700"><a onclick="getDepartmentList()" title="Refresh Department">Select Department</a></label>
                                                                <select id="Department" class="select2 form-control" name="department" required onchange="javascript:getCustomerList()">
                                                                    <option value="">- - - Select  Department - - -</option>
                                                                    @if(!empty($departments))
                                                                        @foreach($departments AS $media)
                                                                            <option value="{{$media->id}}" @if($media->id == $customer->department) selected="selected" @endif>{{$media->name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 no-padding">
                                                            <div class="form-group">
                                                                <label for="Customer" class="text-info text-bold-700"><a onclick="getCustomerList()" title="Refresh Employee List">Select Employee</a></label>
                                                                <select id="Customer" class="select2 form-control" name="customer" required onchange="javascript:getCustomerInfo(this)">
                                                                    <option value="">- - - Select  Employee - - -</option>
                                                                    @if(!empty($customer_list))
                                                                        @foreach($customer_list AS $media)
                                                                            <option value="{{$media->id}}" @if($media->id == $customer->id) selected="selected" @endif>{{$media->name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h4 class="form-section"><i class="feather icon-eye"></i> Contact Info</h4>
                                                    <div class="row">
                                                        <div class="col-md-6 no-padding" >
                                                            <div class="form-group">
                                                                <label for="JobLocation" class="text-bold-700">Job Location</label>
                                                                <input type="text" id="JobLocation" maxlength="150" class="form-control" placeholder="Enter Job Location" name="job_location" required value="{{old('job_location', $customer->job_location)}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 no-padding" >
                                                            <div class="form-group">
                                                                <label for="EmailAddress" class="text-bold-700">Contact Email Address</label>
                                                                <input type="email" id="EmailAddress" maxlength="150" class="form-control" placeholder="xyz@palmalgarments.com" name="email" required value="{{old('email', $service_master->contact_email)}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 no-padding" >
                                                            <div class="form-group">
                                                                <label for="ExtNo" class="text-bold-700">Extension No</label>
                                                                <input type="text" id="ExtNo" maxlength="4" class="form-control" placeholder="xxxx" name="ext_no" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" required value="{{old('ext_no', $customer->ext_no)}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 no-padding" >
                                                            <div class="form-group">
                                                                <label for="Mobile" class="text-bold-700">Mobile No</label>
                                                                <input type="text" id="Mobile" maxlength="11" class="form-control" placeholder="018********" name="mobile_no" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" required value="{{old('mobile_no', $customer->mobile_no)}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h4 class="form-section"><i class="feather icon-eye"></i> Product Info</h4>
                                                    <div class="row">
                                                        <div class="col-md-6 no-padding">
                                                            <div class="form-group">
                                                                <label for="ProductCategory" class="text-info text-bold-700"><a onclick="getProductCategoryList()" title="Refresh Product Category List">Select Product Category</a></label>
                                                                <select id="ProductCategory" class="select2 form-control" name="product_category" required onchange="javascript:getProductSubCategoryByCategory(this)">
                                                                    <option value="">- - - Select Product Category - - -</option>
                                                                    @if(!empty($product_categories))
                                                                        @foreach($product_categories AS $media)
                                                                            <option value="{{$media->id}}" @if($media->id == $product_master->product_category) selected="selected" @endif>{{$media->name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 no-padding">
                                                            <div class="form-group">
                                                                <label for="ProductSubCategory" class="text-bold-700">Select Product Sub-Category</label>
                                                                <select id="ProductSubCategory" class="select2 form-control" name="product_sub_category" required onchange="javascript:getProductMasterList()">
                                                                    <option value="">- - - Select Product Sub-Category - - -</option>
                                                                    @if(!empty($product_sub_categories))
                                                                        @foreach($product_sub_categories AS $media)
                                                                            <option value="{{$media->id}}" @if($media->id == $product_master->product_sub_category) selected="selected" @endif>{{$media->name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 no-padding">
                                                            <div class="form-group">
                                                                <label for="ProductMaster" class="text-bold-700">Select Product</label>
                                                                <select id="ProductMaster" class="select2 form-control" name="product_master" required>
                                                                    <option value="">- - - Select Product - - -</option>
                                                                    @if(!empty($product_master_list))
                                                                        @foreach($product_master_list AS $media)
                                                                            <option value="{{$media->id}}" @if($media->id == $service_master->product_master) selected="selected" @endif>{{$media->name}}</option>
                                                                        @endforeach
                                                                    @endif
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
                                                                            <option value="{{$user->id}}" @if($user->id == $service_master->received_by) selected = "selected" @endif>{{$user->name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 no-padding" >
                                                            <div class="form-group">
                                                                <label for="ReceivedAt" class="text-bold-700">Receive Date & Time</label>
                                                                <input type="datetime-local" id="ReceivedAt" class="form-control" name="received_at" required value="{{old('received_at', $service_master->received_at)}}">
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
                                                                <textarea id="ProblemDescription" rows="40" class="form-control" name="problem_description" placeholder="Write Problem....">
                                                                    {!! $service_master->problem_description !!}
                                                                </textarea>
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

@endsection

@section('pageScripts')
    {{-- <script src="{{ asset('/stack-admin/app-assets/js/scripts/modal/components-modal.js') }}"></script>--}}
    <script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
    <script src="{{ asset('/js/custom/common.js') }}"></script>
    <script src="{{ asset('/js/custom/back-end/submit-forms.js') }}"></script>
    @include('layouts.common-modal-js.edit-service-master-modal-js')
@endsection



