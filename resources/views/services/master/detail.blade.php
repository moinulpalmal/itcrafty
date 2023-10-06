@extends('layouts.admin.admin-master')
@section('title')
    Service Detail
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
                    <div id="UpdateMenus" class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
                        <a href="{{route('services.master.assigned')}}" class="btn btn-sm mr-25 btn-info border">Assigned Services</a>
                        @if($service_master->has_edit_access == 1)
                            @if(Auth::user()->hasTaskPermission('service_person', Auth::user()->id))
                            <a href="{{route('services.master.edit', ['id' => $service_master->id])}}" class="btn btn-sm mr-25 border btn-primary">Edit Service</a>
                                <a class="btn btn-danger btn-sm mr-25 border DeleteService" data-id="{{$service_master->id}}" >Delete Service</a>
                            @endif
                        @endif
                    </div>
                </div>
                <!-- users view media object ends -->
                <!-- users view card data start -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-inverse">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <h4 class="form-section"><i class="feather icon-eye"></i> Service Info</h4>
                                        <table id="ServiceMasterTable" class="table table-borderless table-striped table-primary table-condensed ServiceMasterTable">
                                            <tbody>
                                            <tr>
                                                <td>Received At:</td>
                                                <td>Date: {{\Carbon\Carbon::parse($service_master->received_at)->format('j-M-Y')}}; Time: {{\Carbon\Carbon::parse($service_master->received_at)->format('g:i A')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Solved At:</td>
                                                <td class="users-view-latest-activity">
                                                    @if($service_master->solved_at != null)
                                                        Date: {{\Carbon\Carbon::parse($service_master->solved_at)->format('j-M-Y')}}; Time: {{\Carbon\Carbon::parse($service_master->solved_at)->format('g:i A')}}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Delivered:</td>
                                                <td class="users-view-verified">
                                                    @if($service_master->delivered_at != null)
                                                        Date: {{\Carbon\Carbon::parse($service_master->delivered_at)->format('j-M-Y')}}; Time: {{\Carbon\Carbon::parse($service_master->delivered_at)->format('g:i A')}}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Problem Description:</td>
                                                <td>{!! $service_master->problem_description !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Solution Description:</td>
                                                <td>{!! $service_master->solution_description !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Solved By:</td>
                                                <td>
                                                    @if($service_master->status == 'SC')
                                                        {{ \App\Model\ServiceSolver::getSolverInfo($service_master->id) }}
                                                        @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Current Status:</td>
                                                <td>
                                                    @if($service_master->status == 'I')
                                                        <span class="badge badge-warning users-view-status">In Pending Queue</span>
                                                    @elseif($service_master->status == 'SA')
                                                        <span class="badge badge-primary users-view-status">Assigned</span>
                                                    @elseif($service_master->status == 'UP')
                                                        <span class="badge badge-info users-view-status">Under Process</span>
                                                    @elseif($service_master->status == 'RW')
                                                        <span class="badge badge-warning users-view-status">Requested for Warranty</span>
                                                    @elseif($service_master->status == 'SW')
                                                        <span class="badge badge-success users-view-status">Sent for Warranty</span>
                                                    @elseif($service_master->status == 'WR')
                                                        <span class="badge badge-success users-view-status">Received from Warranty</span>
                                                    @elseif($service_master->status == 'SC')
                                                        <span class="badge badge-warning users-view-status">Service Completed</span>
                                                    @elseif($service_master->status == 'SD')
                                                        <span class="badge badge-success users-view-status">Delivered</span>
                                                    @elseif($service_master->status == 'PR')
                                                        <span class="badge badge-info users-view-status">Purchase Requisition Sent</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Next Step:</td>
                                                <td>
                                                    @if($service_master->access == 'S')
                                                       @if($service_master->status == 'I')
                                                        @if(Auth::user()->hasTaskPermission('service_team_leader', Auth::user()->id))
                                                            <button class="btn btn-sm btn-warning" onclick=" $('#AssignServicePerson').modal({backdrop: 'static', keyboard: false});" data-toggle="modal">Assign Service Person</button>
                                                        @endif
                                                            <a class="btn btn-cyan btn-sm MakeUnderProcess" data-id="{{$service_master->id}}" >Make Under Process</a>
                                                        @elseif($service_master->status == 'SA')
                                                        @if(Auth::user()->hasTaskPermission('service_team_leader', Auth::user()->id))
                                                            <button class="btn btn-sm btn-warning" onclick=" $('#AssignServicePerson').modal({backdrop: 'static', keyboard: false});" data-toggle="modal">@if($service_master->has_assigned == 1) Re-Assign Service Person @else Assign Service Person @endif </button>
                                                        @endif
                                                            <a class="btn btn-cyan btn-sm MakeUnderProcess" data-id="{{$service_master->id}}" >Make Under Process</a>
                                                        @elseif($service_master->status == 'UP')
                                                           {{-- i need to reconfigure this section based of warranty check--}}
                                                            @if($service_master->has_warranty == 1)
                                                                <a class="btn btn-cyan btn-sm SendForWarranty" data-id="{{$service_master->id}}">Generate Warranty Request</a>
                                                            @else
                                                                @if(Auth::user()->hasTaskPermission('service_team_leader', Auth::user()->id))
                                                                    @if($service_master->product_detail != 0)
                                                                        <a class="btn btn-warning btn-sm ProceedWithoutWarranty" data-id="{{$service_master->id}}">Proceed Without Warranty Check</a>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                                @if($service_master->product_detail >= 0)
                                                                    <button class="btn btn-sm btn-success" onclick=" $('#ServiceComplete').modal({backdrop: 'static', keyboard: false});" data-toggle="modal">Service Complete</button>
                                                                   @if($service_master->has_requisition_request == 0)
                                                                    <button class="btn btn-sm btn-cyan" onclick=" $('#RequisitionRequestEmail').modal({backdrop: 'static', keyboard: false});" data-toggle="modal">Send Requisition Request</button>
                                                                    @endif
                                                                @endif

                                                                @if($service_master->is_mac_binding_mail_sent == 0)
                                                                <button class="btn btn-sm btn-info" onclick=" $('#MacBindingRequestEmail').modal({backdrop: 'static', keyboard: false});" data-toggle="modal">Send MAC Binding Request</button>
                                                            @endif

                                                    @elseif($service_master->status == 'RW')
                                                    @elseif($service_master->status == 'SW')
                                                        <button class="btn btn-sm btn-success" onclick=" $('#ReceiveFromWarranty').modal({backdrop: 'static', keyboard: false});" data-toggle="modal">Receive From Warranty</button>
                                                    @elseif($service_master->status == 'WR')
                                                        <button class="btn btn-sm btn-success" onclick=" $('#ServiceComplete').modal({backdrop: 'static', keyboard: false});" data-toggle="modal">Service Complete</button>
                                                        @if($service_master->has_requisition_request == 0)
                                                            <button class="btn btn-sm btn-cyan" onclick=" $('#RequisitionRequestEmail').modal({backdrop: 'static', keyboard: false});" data-toggle="modal">Send Requisition Request</button>
                                                        @endif
                                                    @elseif($service_master->status == 'SC')
                                                        @if(Auth::user()->hasTaskPermission('service_team_leader', Auth::user()->id))
                                                                <a class="btn btn-cyan btn-sm ApproveComplete" data-id="{{$service_master->id}}">Approve Service Complete</a>
                                                                <button class="btn btn-sm btn-warning" onclick=" $('#AssignServicePerson').modal({backdrop: 'static', keyboard: false});" data-toggle="modal">@if($service_master->has_assigned == 1) Re-Assign Service Person @else Assign Service Person @endif </button>
                                                            @endif
                                                        @elseif($service_master->status == 'CA')
                                                            @if(Auth::user()->hasTaskPermission('service_delivery_desk', Auth::user()->id))
                                                                <a class="btn btn-cyan btn-sm DeliveryComplete" data-id="{{$service_master->id}}">Delivery Complete</a>
                                                                <button class="btn btn-sm btn-info" onclick=" $('#ServiceCompleteEmail').modal({backdrop: 'static', keyboard: false});" data-toggle="modal">Service Complete Email</button>
                                                            @endif
                                                    @elseif($service_master->status == 'SD')
                                                        <span class="badge badge-success">Product Delivered</span>
                                                    @endif
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
                    <div class="col-md-12">
                        <div class="card card-inverse">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row no-padding">
                                        <div class="col-md-4 col-sm-12">
                                            <h4 class="form-section"><i class="feather icon-eye"></i>Product Info</h4>
                                            <table class="table table-borderless table-striped table-success table-condensed">
                                                <tbody>
                                                <tr>
                                                    <td>Category:</td>
                                                    <td>{{$service_master->product_category}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Sub-Category:</td>
                                                    <td>{{$service_master->product_sub_category}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Manufacturer:</td>
                                                    <td>{{$service_master->manufacturer}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Product Name:</td>
                                                    <td>{{$service_master->product_name}}</td>
                                                </tr>
                                                {{--<tr>
                                                    <td>Product Detail:</td>
                                                    <td>{{$service_master->old_name}}</td>
                                                </tr>--}}
                                                <tr>
                                                    <td>Product Sl No:</td>
                                                    <td>{{$service_master->sl_no}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Has Warranty:</td>
                                                    <td>
                                                        @if($service_master->has_edit_access == 1)
                                                            @if($service_master->access == 'S')
                                                                <button class="btn btn-sm btn-info" onclick=" $('#CheckWarranty').modal({backdrop: 'static', keyboard: false});" data-toggle="modal">Check Warranty</button>
                                                            @endif
                                                        @endif
                                                    </td>
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
                                        <div class="col-md-8 col-sm-12">
                                            <h4 class="form-section"><i class="feather icon-eye"></i>Warranty Check List</h4>
                                            <table class="table table-borderless table-responsive table-striped table-info table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Create Date</th>
                                                        <th class="text-center">Last Update Date</th>
                                                        <th class="text-center">Product Category</th>
                                                        <th class="text-center">Product Sub-Category</th>
                                                        <th class="text-center">Product Model</th>
                                                        <th class="text-center">Sl No</th>
                                                        <th class="text-center">Description</th>
                                                        <th class="text-center">Warranty Status</th>
                                                        {{--<th class="text-center">Remarks</th>
                                                        <th class="text-center">Action</th>--}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @if(!empty($service_warranty_checks))
                                                    @foreach($service_warranty_checks AS $item)
                                                        <tr>
                                                            <td class="text-center">{{\Carbon\Carbon::parse($item->created_at)->format('j-M-Y')}}</td>
                                                            <td class="text-center">{{\Carbon\Carbon::parse($item->updated_at)->format('j-M-Y')}}</td>
                                                            <td class="text-left">{{$item->product_category}}</td>
                                                            <td class="text-left">{{$item->product_sub_category}}</td>
                                                            <td class="text-left">{{$item->manufacturer.'-'.$item->product_master}}</td>
                                                            <td class="text-center">{{$item->serial_no}}</td>
                                                            <td class="text-left">{!! $item->description !!}</td>
                                                            <td class="text-center">
                                                                @if($item->warranty_status == 'I')
                                                                    <span class="badge badge-warning users-view-status">Not Checked Yet</span>
                                                                @elseif($item->warranty_status == 'IR')
                                                                    <span class="badge badge-danger users-view-status">Invalid Request</span>
                                                                @elseif($item->warranty_status == 'NW')
                                                                    <span class="badge badge-info users-view-status">No Warranty</span>
                                                                @elseif($item->warranty_status == 'HR')
                                                                    <span class="badge badge-success users-view-status">Has Warranty</span>
                                                                @elseif($item->warranty_status == 'WV')
                                                                    <span class="badge badge-danger users-view-status">Warranty Void</span>
                                                                @else

                                                                @endif
                                                            </td>
                                                            {{--<td class="text-right">{!! $item->remarks !!}</td>
                                                            <td class="text-center">

                                                            </td>--}}
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
                </div>

                <!-- users view card data start -->
                <div class="row">
                    <div class="col-12 col-md-6">
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
                    <div class="col-12 col-md-6">
                        <div class="card card-inverse">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="col-12 col-md-12">
                                        <h4 class="form-section"><i class="feather icon-eye"></i>
                                            Requisition Info
                                            @if($service_master->has_edit_access == 1)
                                               @if($service_master->access == 'S')
                                                    @if($service_master->requisition_received == 0)
                                                        <button class="btn btn-sm btn-info" onclick=" $('#AddRequisitionInfo').modal({backdrop: 'static', keyboard: false});" data-toggle="modal">Add Requisition Info</button>
                                                    @else
                                                        @if($requisition->status == 'I')
                                                            <button class="btn btn-sm btn-warning" onclick=" $('#AddRequisitionInfo').modal({backdrop: 'static', keyboard: false});" data-toggle="modal">Update Requisition Info</button>
                                                        @elseif($requisition->status == 'R')
                                                            <button class="btn btn-sm btn-warning" onclick=" $('#RejectRequisitionInfo').modal({backdrop: 'static', keyboard: false});" data-toggle="modal">Reject Requisition Product</button>
                                                        @elseif($requisition->status == 'C')
                                                            <button class="btn btn-sm btn-warning" onclick=" $('#AddRequisitionInfo').modal({backdrop: 'static', keyboard: false});" data-toggle="modal">Update Requisition Info</button>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        </h4>
                                        <table class="table table-borderless table-striped table-info table-condensed">
                                            <tbody>
                                            <tr>
                                                <td>Requisition No:</td>
                                                <td>
                                                    @if($service_master->requisition_received == 1)
                                                        @if(!empty($requisition))
                                                       {{$requisition->requisition_no}}
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Reason of Purchase:</td>
                                                <td>
                                                    @if($service_master->requisition_received == 1)
                                                        @if(!empty($requisition))
                                                            {!! $requisition->reason_of_purchase !!}
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Service Comment:</td>
                                                <td>
                                                    @if($service_master->requisition_received == 1)
                                                        @if(!empty($requisition))
                                                            {!! $requisition->service_comment !!}
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Receive Date:</td>
                                                <td>
                                                    @if($service_master->requisition_received == 1)
                                                        @if(!empty($requisition))
                                                            Date: {{\Carbon\Carbon::parse($requisition->received_at)->format('j-M-Y')}}; Time: {{\Carbon\Carbon::parse($requisition->received_at)->format('g:i A')}}
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Last Update Date:</td>
                                                <td>
                                                    @if($service_master->requisition_received == 1)
                                                        @if(!empty($requisition))
                                                            @if(!empty($requisition->updated_at))
                                                            Date: {{\Carbon\Carbon::parse($requisition->updated_at)->format('j-M-Y')}}; Time: {{\Carbon\Carbon::parse($requisition->updated_at)->addHours(6)->format('g:i A')}}
                                                            @endif
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                            {{--<tr>
                                                <<td>Purchase Comment:</td>
                                                <td>
                                                    @if($service_master->has_requisition_request == 1)
                                                        {{\App\Helpers\Helper::IDwiseData('requisitions', 'service_master', $service_master->id)->purchase_comment}}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <<td>Remarks:</td>
                                                <td>
                                                    @if($service_master->has_requisition_request == 1)
                                                        {{\App\Helpers\Helper::IDwiseData('requisitions', 'service_master', $service_master->id)->remarks}}
                                                    @endif
                                                </td>
                                            </tr>--}}
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
                                                <th class="text-center">Sl</th>
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
                                                        <td class="text-center">{{$media->counter}}</td>
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

    @include('layouts.common-modals.service-master-new-assignment-modal', compact('service_master', 'users'))
    @include('layouts.common-modals.service-master-warranty-modal', compact('service_master'))
    @include('layouts.common-modals.service-master-send-requisition-request-modal', compact('service_master'))
    @include('layouts.common-modals.service-master-add-requisition-info-modal', compact('service_master', 'users'))
    @include('layouts.common-modals.service-master-reject-requisition-info-modal', compact('service_master', 'users'))
    @include('layouts.common-modals.service-master-service-complete-modal', compact('service_master', 'users'))
    @include('layouts.common-modals.service-master-send-service-complete-mail-modal', compact('service_master', 'users'))
    @include('layouts.common-modals.service-master-send-mac-binding-request-modal', compact('service_master'))
@endsection

@section('pageScripts')
    {{--<script src="{{ asset('/stack-admin/app-assets/js/scripts/modal/components-modal.js') }}"></script>--}}
    <script src="{{ asset('/js/custom/common.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
    <script src="{{ asset('/stack-admin/app-assets/js/scripts/forms/custom-file-input.js') }}"></script>
    @include('layouts.common-modal-js.new-service-master-detail-modal-js')
@endsection


