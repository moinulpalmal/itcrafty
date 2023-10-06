@extends('layouts.admin.admin-master')
@section('title')
    Employee
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
                            <li class="breadcrumb-item active"><a href="{{route('settings.employee')}}">Employee List</a>
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
                                <h4 class="card-title">Employee Insert/Update Form</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="feather icon-minus"></i></a></li>
                                        <li><a data-action="reload" onclick="clearForm('WorkExperienceForm'); changeButtonText(' Save Employee', 'submit_button_customer', 3); clearNewFactoryCheckBox();"><i class="feather icon-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <form class="form" id="WorkExperienceForm" method="post" action="#">
                                        @csrf
                                        <input type="hidden" id="HiddenFactoryID" class="form-control" name="id">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-3 no-padding">
                                                    <div class="form-group">
                                                        <label for="Factory" class=""><a class="text-info text-bold-700" onclick=" $('#NewFactory').modal({backdrop: 'static', keyboard: false});" data-toggle="modal" {{--data-target="#NewFactory"--}} title="Add New Factory">Select Factory</a>
                                                        </label>
                                                        <select id="Factory" class="select2 form-control" name="factory" required>
                                                            <option value="">- - - Select  Factory - - -</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 no-padding">
                                                    <div class="form-group">
                                                        <label for="Designation" class=""><a class="text-info text-bold-700" onclick="$('#NewDesignation').modal({backdrop: 'static', keyboard: false});" data-toggle="modal" {{--data-target="#NewDesignation"--}} title="Add New Designation">Select Designation</a>
                                                        </label>
                                                        <select id="Designation" class="select2 form-control" name="designation" required>
                                                            <option value="">- - - Select  Designation - - -</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 no-padding">
                                                    <div class="form-group">
                                                        <label for="Department" class=""><a class="text-info text-bold-700" onclick="$('#NewDepartment').modal({backdrop: 'static', keyboard: false});" data-toggle="modal" {{--data-target="#NewDepartment"--}} title="Add New Designation">Select Department</a>
                                                        </label>
                                                        <select id="Department" class="select2 form-control" name="department">
                                                            <option value="">- - - Select  Department - - -</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 no-padding" >
                                                    <div class="form-group">
                                                        <label for="JobLocation" class="text-bold-700">Job Location</label>
                                                        <input type="text" id="JobLocation" maxlength="150" class="form-control" placeholder="Enter Job Location" name="job_location" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 no-padding" >
                                                    <div class="form-group">
                                                        <label for="CustomerID" class="text-bold-700">Employee ID</label>
                                                        <input type="text" id="CustomerID" maxlength="20" class="form-control" placeholder="Enter Employee ID" name="employee_id" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 no-padding" >
                                                    <div class="form-group">
                                                        <label for="CustomerName" class="text-bold-700">Employee Name</label>
                                                        <input type="text" id="CustomerName" maxlength="255" class="form-control" placeholder="Enter Customer Name" name="name" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 no-padding" >
                                                    <div class="form-group">
                                                        <label for="EmailAddress" class="text-bold-700">Email Address</label>
                                                        <input type="email" id="EmailAddress" maxlength="150" class="form-control" placeholder="xyz@palmalgarments.com" name="email">
                                                    </div>
                                                </div>
                                                <div class="col-md-2 no-padding" >
                                                    <div class="form-group">
                                                        <label for="ExtNo" class="text-bold-700">Extension No</label>
                                                        <input type="text" id="ExtNo" maxlength="4" class="form-control" placeholder="xxxx" name="ext_no" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                                    </div>
                                                </div>
                                                <div class="col-md-2 no-padding" >
                                                    <div class="form-group">
                                                        <label for="Mobile" class="text-bold-700">Mobile No</label>
                                                        <input type="text" id="Mobile" maxlength="11" class="form-control" placeholder="018********" name="mobile_no" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions right">
                                            <button type="submit" id="submit_button_customer" class="btn btn-outline-primary">
                                                <i class="feather icon-check"></i> Save Employee
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
                                <h4 class="card-title">Employee  List</h4>
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
                                    <table id="social-media-table" class="table table-striped table-bordered table-condensed social-media table-info">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Factory</th>
                                            <th class="text-center">Department</th>
                                            <th class="text-center">Designation</th>
                                            <th class="text-center">ID No.</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Mobile No</th>
                                            <th class="text-center">Extension No</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($customers))
                                            @foreach($customers as $media)
                                                <tr @if($media->status == 'I') class="bg-warning" @endif>
                                                    <td class="text-left">
                                                        {{$media->factory}}
                                                    </td>
                                                    <td class="text-left">
                                                        {{$media->department}}
                                                    </td>
                                                    <td class="text-left">
                                                        {{$media->designation}}
                                                    </td>
                                                    <td class="text-left">
                                                        {{$media->employee_id}}
                                                    </td>
                                                    <td class="text-left">
                                                        {{$media->name}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$media->email}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$media->mobile_no}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$media->ext_no}}
                                                    </td>
                                                    <td class="text-center">
                                                        @if( Auth::user()->has_approval_authority == 1)
                                                            <a class="btn btn-danger btn-sm btn-round fa fa-trash DeleteWorkExp" data-id="{{$media->id}}" title="Delete Factory"></a>
                                                            <a class="btn btn-info btn-sm btn-round fa fa-edit EditWorkExp" data-id="{{$media->id}}" title="Edit Factory"></a>
                                                            @if($media->status == 'A')
                                                                <a class="btn btn-warning btn-sm btn-round fa fa-times DeActivateWorkExp" data-id="{{$media->id}}" title="De-Activate Factory"></a>
                                                            @elseif($media->status == 'I')
                                                                <a class="btn btn-cyan btn-sm btn-round fa fa-check ActivateWorkExp" data-id="{{$media->id}}" title="Activate Factory"></a>
                                                            @else
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th class="text-center">Factory</th>
                                            <th class="text-center">Department</th>
                                            <th class="text-center">Designation</th>
                                            <th class="text-center">ID No.</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Mobile No</th>
                                            <th class="text-center">Extension No</th>
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
@include('layouts.common-modals.new-factory-modal')
@include('layouts.common-modals.new-designation-modal')
@include('layouts.common-modals.new-department-modal')
@endsection

@section('pageScripts')
   {{-- <script src="{{ asset('/stack-admin/app-assets/js/scripts/modal/components-modal.js') }}"></script>--}}
    <script src="{{ asset('/js/custom/common.js') }}"></script>
    <script src="{{ asset('/js/custom/back-end/submit-forms.js') }}"></script>
   @include('layouts.common-modal-js.new-factory-modal-js')
   @include('layouts.common-modal-js.new-designation-modal-js')
   @include('layouts.common-modal-js.new-department-modal-js')
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

        $(document).ready(function () {
           /* CKEDITOR.replace( 'description',{
                uiColor: '#CCEAEE'
            });*/

           /* getDesignationList();*/
            resetSelect2();
        });
        function resetSelect2() {
            $(".select2").select2({
                dropdownAutoWidth: true,
                width: '100%'
            });
        }
        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#WorkExperienceForm').submit(function(e){
                e.preventDefault();
               /* for ( instance in CKEDITOR.instances ) {
                    CKEDITOR.instances[instance].updateElement();
                }*/
                var data = $(this).serialize();
                var id = $('#HiddenFactoryID').val();
                var url = '{{ route('settings.employee.save') }}';
                //console.log(data);
                $.ajax({
                    url: url,
                    method:'POST',
                    data:data,
                    success:function(data){
                      //  console.log(data);
                       // return;
                        if(data === '2')
                        {
                            swalUpdateSuccessfulWithRefresh();
                        }
                        else if(data === '1')
                        {
                            swalInsertSuccessfulWithRefresh();
                        }
                        else if(data === '0'){
                            swalDataNotSaved();
                        }
                        else{
                            swalDataNotSaved();
                        }
                    },
                    error:function(error){
                        swalError(error);
                    }
                })

            })
        });

        $('#social-media-table').on('click',".DeleteWorkExp", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('settings.employee.delete') }}';
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
        $('#social-media-table').on('click',".DeActivateWorkExp", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('settings.employee.de-activate') }}';
            swal({
                title: 'Are you sure?',
                text: 'This record will be de-activated temporarily!',
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
                                swalSuccessFullWithRefresh();
                            }
                            else if(data === '0'){
                                swalUnSuccessFull();
                            }
                            else{
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

        $('#social-media-table').on('click',".ActivateWorkExp", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('settings.employee.activate') }}';
            swal({
                title: 'Are you sure?',
                text: 'This record will be activated permanently!',
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
                            else{
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

        $('#social-media-table').on('click',".EditWorkExp", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('settings.employee.edit') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: id, _token: '{{csrf_token()}}'},
                success:function(data){
                    $('input[name=job_location]').val(data.job_location);
                    $('input[name=employee_id]').val(data.employee_id);
                    $('input[name=name]').val(data.name);
                    $('input[name=email]').val(data.email);
                    $('input[name=mobile_no]').val(data.mobile_no);
                    $('input[name=ext_no]').val(data.ext_no);

                    $('select[name=designation]').val(data.designation).change();
                    $('select[name=factory]').val(data.factory).change();
                    $('select[name=department]').val(data.department).change();

                    $('input[name=id]').val(data.id);
                    moveToTop();
                    changeButtonText(' Update Employee', 'submit_button_customer', 3);
                },
                error:function(error){
                    moveToTop();
                    swalError(error);
                    clearForm('WorkExperienceForm');
                    changeButtonText(' Save Employee', 'submit_button_customer', 3);
                }
            })
        });

        function clearNewFactoryCheckBox() {
            //console.log('hit');
           $('input[name=department_applicable]').prop('checked', false);
        }
    </script>
@endsection


