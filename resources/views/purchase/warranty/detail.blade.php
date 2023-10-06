@extends('layouts.admin.admin-master')
@section('title')
    Warranty Detail
@endsection
@section('content')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <!-- users view start -->
            <section class="users-view">
                <!-- users view media object start -->
                <div class="row">
                    <div class="col-12 col-sm-7">
                        <div class="media mb-2">
                           {{-- <a class="mr-1" href="#">
                                <img src="../../../app-assets/images/portrait/small/avatar-s-26.png" alt="users view avatar" class="users-avatar-shadow rounded-circle" height="64" width="64">
                            </a>--}}
                            <div class="media-body pt-25">
                                <h4 class="media-heading"><span class="users-view-name">{{$service_master->customer}} </span>{{--<span class="text-muted font-medium-1"> @</span><span class="users-view-username text-muted font-medium-1 ">candy007</span>--}}</h4>
                                <span>Service ID:</span>
                                <span class="users-view-id">{{$service_master->service_id}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
                        {{--<a href="{{route('services.master.assigned')}}" class="btn btn-sm mr-25 btn-info border">Assigned Services</a>
                        <a href="{{route('services.master.edit', ['id' => $service_master->id])}}" class="btn btn-sm btn-primary">Edit Service</a>--}}
                    </div>
                </div>
                <!-- users view media object ends -->
                <!-- users view card data start -->
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card card-inverse">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="col-12 col-md-12">
                                        <h4 class="form-section"><i class="feather icon-eye"></i> Warranty Info</h4>
                                        <table id="ServiceMasterTable" class="table table-borderless table-striped table-primary table-condensed ServiceMasterTable">
                                            <tbody>
                                            <tr>
                                                <td>Requested At:</td>
                                                <td>Date: {{\Carbon\Carbon::parse($service_warranty->generated_at)->format('j-M-Y')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Mail Sent to Vendor At:</td>
                                                <td class="users-view-latest-activity">
                                                    @if($service_warranty->mailed_at != null)
                                                        Date: {{\Carbon\Carbon::parse($service_warranty->mailed_at)->format('j-M-Y')}}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Product Sent to Vendor At:</td>
                                                <td class="users-view-latest-activity">
                                                    @if($service_warranty->sent_at != null)
                                                        Date: {{\Carbon\Carbon::parse($service_warranty->sent_at)->format('j-M-Y')}}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Product Received from Vendor At:</td>
                                                <td class="users-view-latest-activity">
                                                    @if($service_warranty->received_at != null)
                                                        Date: {{\Carbon\Carbon::parse($service_warranty->received_at)->format('j-M-Y')}}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Product Delivered to Service Desk:</td>
                                                <td class="users-view-latest-activity">
                                                    @if($service_warranty->delivered_at != null)
                                                        Date: {{\Carbon\Carbon::parse($service_warranty->delivered_at)->format('j-M-Y')}}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Problem Description:</td>
                                                <td>{!! $service_warranty->problem_description !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Requested By:</td>
                                                <td>
                                                    {{ \App\Helpers\Helper::IDwiseData('users', 'id', $service_warranty->inserted_by)->name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Current Status:</td>
                                                <td>
                                                    @if($service_warranty->status == 'G')
                                                        <span class="badge badge-info users-view-status">Warranty Request Generated</span>
                                                    @elseif($service_warranty->status == 'M')
                                                        <span class="badge badge-info users-view-status">Warranty Mail Sent To Vendor</span>
                                                    @elseif($service_warranty->status == 'S')
                                                        <span class="badge badge-info users-view-status">Product Sent to Vendor</span>
                                                    @elseif($service_warranty->status == 'R')
                                                        <span class="badge badge-info users-view-status">Product Received from Vendor after Warranty</span>
                                                    @elseif($service_warranty->status == 'DP')
                                                        <span class="badge badge-success users-view-status">Product Delivered to Service Desk after Vendor Warranty Service</span>
                                                    @elseif($service_warranty->status == 'C')
                                                        <span class="badge badge-success users-view-status">Canceled</span>
                                                    @else
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Next Step:</td>
                                                <td>
                                                    @if($service_warranty->status == 'G')
                                                        @if(!empty($service_warranty->vendor))
                                                            <button class="btn btn-sm btn-warning" onclick=" $('#WarrantyRequestEmail').modal({backdrop: 'static', keyboard: false});" data-toggle="modal">Send Warranty Service Mail To Vendor</button>
                                                        @endif
                                                    @elseif($service_warranty->status == 'M')
                                                        <a class="btn btn-cyan btn-sm SendForWarranty" data-id="{{$service_warranty->id}}">Send Product for Warranty</a>
                                                    @elseif($service_warranty->status == 'S')
                                                        <a class="btn btn-cyan btn-sm ReceiveProductFromWarranty" data-id="{{$service_warranty->id}}">Receive Product from Warranty Service</a>
                                                    @elseif($service_warranty->status == 'R')
                                                        <a class="btn btn-cyan btn-sm SendProductToService" data-id="{{$service_warranty->id}}">Send Product to Service Desk</a>
                                                    @elseif($service_warranty->status == 'DP')
                                                        <span class="badge badge-success">Product Delivered to Service Desk</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card card-inverse">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="col-12 col-md-12">
                                        <h4 class="form-section"><i class="feather icon-eye"></i>Product Info</h4>
                                        <table class="table table-borderless table-striped table-success table-condensed">
                                            <tbody>
                                            <tr>
                                                <td>Category:</td>
                                                <td>{{$service_warranty_check->product_category}}</td>
                                            </tr>
                                            <tr>
                                                <td>Sub-Category:</td>
                                                <td>{{$service_warranty_check->product_sub_category}}</td>
                                            </tr>
                                            <tr>
                                                <td>Manufacturer:</td>
                                                <td>{{$service_warranty_check->manufacturer}}</td>
                                            </tr>
                                            <tr>
                                                <td>Product Name:</td>
                                                <td>{{$service_warranty_check->product_name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Product Detail:</td>
                                                <td>{{$service_warranty_check->old_name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Product Sl No:</td>
                                                <td>{{$service_warranty_check->sl_no}}</td>
                                            </tr>
                                            <tr>
                                                <td>Has Warranty:</td>
                                                <td>
                                                    <span class="badge badge-success users-view-status">Yes</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Vendor Name:</td>
                                                <td>{{$service_warranty_check->vendor_name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Problem Description:</td>
                                                <td>
                                                    {!! $service_warranty_check->description !!}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- users view card data start -->
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="card card-inverse">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="col-12 col-md-12">
                                        <h4 class="form-section"><i class="feather icon-eye"></i> Employee Info</h4>
                                        <table class="table table-borderless table-striped table-info table-condensed">
                                            <tbody>
                                            <tr>
                                                <td>Employee Name:</td>
                                                <td>{{$service_master->customer}}</td>
                                            </tr>
                                            <tr>
                                                <td>Contact No:</td>
                                                <td>{{$service_master->contact_no}}</td>
                                            </tr>
                                            <tr>
                                                <td>Contact Email:</td>
                                                <td>{{$service_master->contact_email}}</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- users view card data ends -->
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="card card-inverse">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="col-12 col-md-12">
                                        <h4 class="form-section"><i class="feather icon-eye"></i> Assignment Info</h4>
                                        <table class="table table-bordered table-striped table-info table-condensed AITable">
                                            <thead>
                                            <tr>
                                                <th class="text-center">Assignment Date</th>
                                                <th class="text-center">Assignment To</th>
                                                <th class="text-center">Assignment Description</th>
                                                <th class="text-center">Close Date</th>
                                                <th class="text-center">Close Description</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(!empty($service_assigns))
                                                @foreach($service_assigns AS $media)
                                                    <tr>
                                                        <td class="text-center">{{\Carbon\Carbon::parse($media->assign_date)->format('j-M-Y')}}</td>
                                                        <td class="text-center">{!! $media->name !!}</td>
                                                        <td class="text-left">{!! $media->assignment_description !!}</td>
                                                        <td class="text-center">
                                                            @if($media->clearance_date)
                                                                {{\Carbon\Carbon::parse($media->clearance_date)->format('j-M-Y')}}
                                                            @else
                                                                &nbsp;
                                                            @endif
                                                        </td>
                                                        <td class="text-left">
                                                            @if($media->clearance_description)
                                                                {!! $media->clearance_description !!}
                                                            @else
                                                                &nbsp;
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="card card-inverse">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="col-12 col-md-12">
                                        <h4 class="form-section"><i class="feather icon-eye"></i> Request Emails Info</h4>
                                        <table class="table table-bordered table-striped table-info table-condensed AITable">
                                            <thead>
                                            <tr>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">From</th>
                                                <th class="text-center">To</th>
                                                <th class="text-center">CC</th>
                                                <th class="text-center">BCC</th>
                                                <th class="text-center">Email Description</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(!empty($service_request_emails))
                                                @foreach($service_request_emails AS $media)
                                                    <tr>
                                                        <td class="text-center">{{\Carbon\Carbon::parse($media->created_at)->format('j-M-Y')}}</td>
                                                        <td class="text-left">
                                                            @if(!empty(\App\Model\ServiceRequestEmailFrom::emailFrom($service_master->id, $media->counter)))
                                                                @foreach(\App\Model\ServiceRequestEmailFrom::emailFrom($service_master->id, $media->counter) AS $from)
                                                                    {!! $from->email !!};&nbsp;
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                        <td class="text-left">
                                                            @if(!empty(\App\Model\ServiceRequestEmailTo::emailTo($service_master->id, $media->counter, "to")))
                                                                @foreach(\App\Model\ServiceRequestEmailTo::emailTo($service_master->id, $media->counter, "to") AS $from)
                                                                    {!! $from->email !!};&nbsp;
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                        <td class="text-left">
                                                            @if(!empty(\App\Model\ServiceRequestEmailTo::emailTo($service_master->id, $media->counter, "cc")))
                                                                @foreach(\App\Model\ServiceRequestEmailTo::emailTo($service_master->id, $media->counter, "cc") AS $from)
                                                                    {!! $from->email !!};&nbsp;
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                        <td class="text-left">
                                                            @if(!empty(\App\Model\ServiceRequestEmailTo::emailTo($service_master->id, $media->counter, "bcc")))
                                                                @foreach(\App\Model\ServiceRequestEmailTo::emailTo($service_master->id, $media->counter, "bcc") AS $from)
                                                                    {!! $from->email !!};&nbsp;
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                        <td class="text-left">{!! $media->email_description !!}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card card-inverse">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="col-12 col-md-12">
                                        <h4 class="form-section"><i class="feather icon-eye"></i> Current Service History</h4>
                                        <table class="table table-bordered table-striped table-info table-condensed CSHTable">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Sl</th>
                                                    <th class="text-center">Date</th>
                                                    <th class="text-center">User</th>
                                                    <th class="text-center">Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(!empty('service_histories'))
                                                    @foreach($service_histories AS $history)
                                                    <tr>
                                                        <td class="text-center">{!! $history->counter !!}</td>
                                                        <td class="text-center">{{\Carbon\Carbon::parse($history->created_at)->format('j-M-Y')}}</td>
                                                        <td class="text-left">{!! $history->name !!}</td>
                                                        <td class="text-left">{!! $history->description !!}</td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card card-inverse">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="col-12 col-md-12">
                                        <h4 class="form-section"><i class="feather icon-eye"></i> Previous Service Histories</h4>
                                        <table class="table table-bordered table-striped table-info table-condensed PSHTable">
                                            <thead>
                                            <tr>
                                                <th class="text-center">Service Id</th>
                                                <th class="text-center">Received At</th>
                                                <th class="text-center">Solved At</th>
                                                <th class="text-center">Delivered At</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @if(!empty($service_master_histories))
                                                    @foreach($service_master_histories AS $media)
                                                        <tr @if($media->id == $service_master->id) class="bg-gradient-directional-amber" @endif>
                                                            <td class="text-left"><a href="{{route('services.master.detail' , ['id' => $media->id])}}">{!! $media->service_id !!}</a></td>
                                                            <td class="text-center">{{\Carbon\Carbon::parse($media->received_at)->format('j-M-Y')}}</td>
                                                            <td class="text-center">@if($media->solved_at != null) {{\Carbon\Carbon::parse($media->solved_at)->format('j-M-Y')}} @endif</td>
                                                            <td class="text-center">@if($media->delivered_at != null) {{\Carbon\Carbon::parse($media->delivered_at)->format('j-M-Y')}} @endif</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- users view card details ends -->
            </section>
            <!-- users view ends -->
        </div>
    </div>
@endsection
@section('page-modals')
    @include('layouts.common-modals.warranty-assign-vendor-modal', compact('vendors', 'service_warranty'))
    @include('layouts.common-modals.warranty-master-send-warranty-request-modal', compact('service_master', 'service_warranty'))
@endsection

@section('pageScripts')
    {{--<script src="{{ asset('/stack-admin/app-assets/js/scripts/modal/components-modal.js') }}"></script>--}}
    <script src="{{ asset('/js/custom/common.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
    <script src="{{ asset('/stack-admin/app-assets/js/scripts/forms/custom-file-input.js') }}"></script>
    @include('layouts.common-modal-js.new-warranty-master-detail-modal-js')
@endsection


