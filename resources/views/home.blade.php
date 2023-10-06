@extends('layouts.admin.admin-master')
@section('title')
    Home
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
                            <li class="breadcrumb-item active"><a href="{{route('home')}}">Home</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    @if(Auth::user()->hasPermission('services', Auth::user()->id))
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Total Current Service Summary</h4>
                                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse" title="minimize"><i class="feather icon-minus"></i></a></li>
                                            <li><a data-action="expand" title="maximize"><i class="feather icon-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <table id="total-service-summary" class="table table-striped table-bordered table-condensed total-service-summary table-info">
                                            <thead>
                                            <tr>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Quantity</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(!empty($total_service_summary))
                                                @foreach($total_service_summary as $media)
                                                    <tr>
                                                        <td class="text-left">
                                                            @if($media->status == 'I')
                                                                <span class="badge badge-warning users-view-status">In Pending Queue</span>
                                                            @elseif($media->status == 'SA')
                                                                <span class="badge badge-primary users-view-status">Assigned</span>
                                                            @elseif($media->status == 'UP')
                                                                <span class="badge badge-info users-view-status">Under Process</span>
                                                            @elseif($media->status == 'RW')
                                                                <span class="badge badge-warning users-view-status">Requested for Warranty</span>
                                                            @elseif($media->status == 'SW')
                                                                <span class="badge badge-success users-view-status">Sent for Warranty</span>
                                                            @elseif($media->status == 'WR')
                                                                <span class="badge badge-success users-view-status">Received from Warranty</span>
                                                            @elseif($media->status == 'SC')
                                                                <span class="badge badge-warning users-view-status">Service Completed</span>
                                                            @elseif($media->status == 'SD')
                                                                <span class="badge badge-success users-view-status">Delivered</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            {{$media->service_count}}
                                                        </td>
                                                        {{-- <td class="text-center">
                                                             <a class="btn btn-danger btn-sm btn-round fa fa-trash DeleteWorkExp" data-id="{{$media->id}}" title="Delete Factory"></a>
                                                             <a class="btn btn-info btn-sm btn-round fa fa-edit EditWorkExp" data-id="{{$media->id}}" title="Edit Factory"></a>
                                                             @if($media->status == 'A')
                                                                 <a class="btn btn-warning btn-sm btn-round fa fa-times DeActivateWorkExp" data-id="{{$media->id}}" title="De-Activate Factory"></a>
                                                             @elseif($media->status == 'I')
                                                                 <a class="btn btn-cyan btn-sm btn-round fa fa-check ActivateWorkExp" data-id="{{$media->id}}" title="Activate Factory"></a>
                                                             @else
                                                             @endif
                                                         </td>--}}
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                            {{--<tfoot>
                                                <tr>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Quantity</th>
                                                </tr>
                                            </tfoot>--}}
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                        @if(Auth::user()->hasPermission('services', Auth::user()->id))
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">My Current Service Summary</h4>
                                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                                <li><a data-action="collapse" title="minimize"><i class="feather icon-minus"></i></a></li>
                                                <li><a data-action="expand" title="maximize"><i class="feather icon-maximize"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body card-dashboard">
                                            <table id="user-service-summary" class="table table-striped table-bordered table-condensed user-service-summary table-info">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Quantity</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(!empty($user_service_summary))
                                                    @foreach($user_service_summary as $media)
                                                        <tr>
                                                            <td class="text-left">
                                                                @if($media->status == 'I')
                                                                    <span class="badge badge-warning users-view-status">In Pending Queue</span>
                                                                @elseif($media->status == 'SA')
                                                                    <span class="badge badge-primary users-view-status">Assigned</span>
                                                                @elseif($media->status == 'UP')
                                                                    <span class="badge badge-info users-view-status">Under Process</span>
                                                                @elseif($media->status == 'RW')
                                                                    <span class="badge badge-warning users-view-status">Requested for Warranty</span>
                                                                @elseif($media->status == 'SW')
                                                                    <span class="badge badge-success users-view-status">Sent for Warranty</span>
                                                                @elseif($media->status == 'WR')
                                                                    <span class="badge badge-success users-view-status">Received from Warranty</span>
                                                                @elseif($media->status == 'SC')
                                                                    <span class="badge badge-warning users-view-status">Service Completed</span>
                                                                @elseif($media->status == 'SD')
                                                                    <span class="badge badge-success users-view-status">Delivered</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                {{$media->service_count}}
                                                            </td>
                                                            {{-- <td class="text-center">
                                                                 <a class="btn btn-danger btn-sm btn-round fa fa-trash DeleteWorkExp" data-id="{{$media->id}}" title="Delete Factory"></a>
                                                                 <a class="btn btn-info btn-sm btn-round fa fa-edit EditWorkExp" data-id="{{$media->id}}" title="Edit Factory"></a>
                                                                 @if($media->status == 'A')
                                                                     <a class="btn btn-warning btn-sm btn-round fa fa-times DeActivateWorkExp" data-id="{{$media->id}}" title="De-Activate Factory"></a>
                                                                 @elseif($media->status == 'I')
                                                                     <a class="btn btn-cyan btn-sm btn-round fa fa-check ActivateWorkExp" data-id="{{$media->id}}" title="Activate Factory"></a>
                                                                 @else
                                                                 @endif
                                                             </td>--}}
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                                {{--<tfoot>
                                                    <tr>
                                                        <th class="text-center">Status</th>
                                                        <th class="text-center">Quantity</th>
                                                    </tr>
                                                </tfoot>--}}
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(Auth::user()->hasPermission('purchase', Auth::user()->id))
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Current Warranty Summary</h4>
                                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                                <li><a data-action="collapse" title="minimize"><i class="feather icon-minus"></i></a></li>
                                                <li><a data-action="expand" title="maximize"><i class="feather icon-maximize"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body card-dashboard">
                                            <table id="total-warranty-summary" class="table table-striped table-bordered table-condensed total-warranty-summary table-info">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Quantity</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(!empty($total_warranty_summary))
                                                    @foreach($total_warranty_summary as $media)
                                                        <tr>
                                                            <td class="text-left">
                                                                @if($media->status == 'G')
                                                                    <span class="badge badge-info users-view-status">Warranty Request Generated</span>
                                                                @elseif($media->status == 'M')
                                                                    <span class="badge badge-info users-view-status">Warranty Mail Sent To Vendor</span>
                                                                @elseif($media->status == 'S')
                                                                    <span class="badge badge-info users-view-status">Product Sent to Vendor</span>
                                                                @elseif($media->status == 'R')
                                                                    <span class="badge badge-info users-view-status">Product Received from Vendor after Warranty</span>
                                                                @elseif($media->status == 'DP')
                                                                    <span class="badge badge-success users-view-status">Product Delivered to Service Desk after Vendor Warranty Service</span>
                                                                @elseif($media->status == 'C')
                                                                    <span class="badge badge-danger users-view-status">Canceled</span>
                                                                @else

                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                {{$media->warranty_count}}
                                                            </td>
                                                            {{-- <td class="text-center">
                                                                 <a class="btn btn-danger btn-sm btn-round fa fa-trash DeleteWorkExp" data-id="{{$media->id}}" title="Delete Factory"></a>
                                                                 <a class="btn btn-info btn-sm btn-round fa fa-edit EditWorkExp" data-id="{{$media->id}}" title="Edit Factory"></a>
                                                                 @if($media->status == 'A')
                                                                     <a class="btn btn-warning btn-sm btn-round fa fa-times DeActivateWorkExp" data-id="{{$media->id}}" title="De-Activate Factory"></a>
                                                                 @elseif($media->status == 'I')
                                                                     <a class="btn btn-cyan btn-sm btn-round fa fa-check ActivateWorkExp" data-id="{{$media->id}}" title="Activate Factory"></a>
                                                                 @else
                                                                 @endif
                                                             </td>--}}
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                                {{--<tfoot>
                                                    <tr>
                                                        <th class="text-center">Status</th>
                                                        <th class="text-center">Quantity</th>
                                                    </tr>
                                                </tfoot>--}}
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                </div>
            </section>
        </div>
    </div>
@endsection

