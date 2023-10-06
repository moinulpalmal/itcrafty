@extends('layouts.admin.admin-master')
@section('title')
    Service Under Process
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
                            <li class="breadcrumb-item active"><a href="{{route('services.master.under-process')}}">Service Under Process</a>
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
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if(Auth::user()->hasTaskPermission('service_team_leader', Auth::user()->id))
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
                                                        Date: {{\Carbon\Carbon::parse($media->received_at)->format('j-M-Y')}};<br>Time: {{\Carbon\Carbon::parse($media->received_at)->format('g:i A')}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{--<a class="btn btn-danger btn-sm btn-round fa fa-trash DeleteWorkExp" data-id="{{$media->id}}" title="Delete Service"></a>
                                                      --}}  <a class="btn btn-info btn-sm btn-round fa fa-eye" href="{{route('services.master.detail', ['id' => $media->id])}}" title="Service Detail"></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        @else
                                            @if(!empty($products))
                                                @foreach($products as $media)
                                                    @if(\App\Model\ServiceAssign::isAssigned(Auth::user()->id, $media->id) == 1)
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
                                                            Date: {{\Carbon\Carbon::parse($media->received_at)->format('j-M-Y')}};<br>Time: {{\Carbon\Carbon::parse($media->received_at)->format('g:i A')}}
                                                        </td>
                                                        <td class="text-center">
                                                            {{--<a class="btn btn-danger btn-sm btn-round fa fa-trash DeleteWorkExp" data-id="{{$media->id}}" title="Delete Service"></a>
                                                          --}}  <a class="btn btn-info btn-sm btn-round fa fa-eye" href="{{route('services.master.detail', ['id' => $media->id])}}" title="Service Detail"></a>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endif
                                        </tbody>
                                        <tfoot>
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
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </tfoot>
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

        $('#social-media-table').on('click',".DeleteWorkExp", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('services.master.delete') }}';
            swal({
                title: 'Are you sure?',
                text: 'This record will be removed permanently!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    //window.location.href = url;
                    //console.log(id);
                    $.ajax({
                        method:'DELETE',
                        url: url,
                        data:{id: id, _token: '{{csrf_token()}}'},
                        success:function(data){
                            if(data === '1'){
                                //console.log(data);
                                swalSuccessFullWithRefresh();
                            }
                            else if(data === '0'){
                                swalUnSuccessFull();
                            }
                        },
                        error:function(error){
                            //console.log(error);
                            swalError(error);
                        }
                    })
                }
            });
        });
    </script>
@endsection


