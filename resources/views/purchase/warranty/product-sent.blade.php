@extends('layouts.admin.admin-master')
@section('title')
    Warranty Product Sent
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
                            <li class="breadcrumb-item active"><a href="{{route('purchase.warranty.product-sent')}}">Warranty Product Sent</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Warranty Product Sent</h4>
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

                                                <th class="text-center">Product Sent At</th>
                                                <th class="text-center">Age (Days)</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($products))

                                            @foreach($products as $media)
                                                <tr>
                                                    <td class="text-left">
                                                       {{$media->service_id}}
                                                    </td>
                                                    <td class="text-left">
                                                        {{$media->product_category}}
                                                    </td>
                                                    <td class="text-left">
                                                        {{$media->product_sub_category}}
                                                    </td>
                                                    <td class="text-left">
                                                        {{$media->manufacturer}}
                                                    </td>
                                                    <td class="text-left">
                                                        {{$media->product_name}}
                                                    </td>
                                                    <td class="text-left">
                                                        {{$media->factory}}
                                                    </td>
                                                    <td class="text-left">
                                                        {{$media->department}}
                                                    </td>
                                                    <td class="text-left">
                                                        {{$media->customer}}
                                                    </td>
                                                    <td class="text-left">
                                                        {{$media->designation}}
                                                    </td>
                                                    <td class="text-left">
                                                        {{$media->contact_no}}
                                                    </td>
                                                    <td class="text-left">
                                                        {{$media->contact_email}}
                                                    </td>
                                                    <td class="text-left">
                                                        {{\Carbon\Carbon::parse($media->sent_at)->format('j-M-Y')}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{\App\View_Model\EmailList::ageInDays($media->sent_at)}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{--<a class="btn btn-danger btn-sm btn-round fa fa-trash DeleteWorkExp" data-id="{{$media->id}}" title="Delete Service"></a>
                                                        --}}<a class="btn btn-info btn-sm btn-round fa fa-eye" href="{{route('purchase.warranty.detail', ['id' => $media->id])}}" title="Warranty Detail"></a>
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
            </section>
        </div>
    </div>
@endsection
@section('page-modals')

@endsection

@section('pageScripts')
    {{--<script src="{{ asset('/stack-admin/app-assets/js/scripts/modal/components-modal.js') }}"></script>--}}
    <script src="{{ asset('/js/custom/common.js') }}"></script>
    {{--<script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>--}}

    <script>
        var dataTable = $('.social-media').DataTable({
            dom: 'Bfrtip',
            pagingType: 'full_numbers',
            className: 'my-1',
            lengthMenu: [
                [ 10, 25, 50, 100, -1 ],
                [ '10 rows', '25 rows', '50 rows', '100 rows', 'Show all' ]
            ],
            buttons: [
                {
                    extend: 'copyHtml5',
                    fieldSeparator: '\t',
                    extension: '.tsv',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    orientation: 'portrait',
                    pageSize: 'A4',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    },
                    customize: function(win)
                    {
                        var css = '@page { size: landscape; }',
                            head = win.document.head || win.document.getElementsByTagName('head')[0],
                            style = win.document.createElement('style');

                        style.type = 'text/css';
                        style.media = 'print';

                        if (style.styleSheet)
                        {
                            style.styleSheet.cssText = css;
                        }
                        else
                        {
                            style.appendChild(win.document.createTextNode(css));
                        }

                        head.appendChild(style);
                    }
                },
                'colvis',
                'pageLength'
            ]
        });
    </script>
@endsection


