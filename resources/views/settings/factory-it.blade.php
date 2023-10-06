@extends('layouts.admin.admin-master')
@section('title')
    Factory IT
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
                            <li class="breadcrumb-item active"><a href="{{route('settings.factory.it-setup')}}">Factory IT List</a>
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
                                <h4 class="card-title">Factory IT Insert/Update Form</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="feather icon-minus"></i></a></li>
                                        <li><a data-action="reload" onclick="clearForm('WorkExperienceForm'); changeButtonText(' Save', 'submit_button_factory_it', 3); clearNewFactoryCheckBox();"><i class="feather icon-rotate-cw"></i></a></li>
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
                                                <div class="col-md-6 no-padding">
                                                    <div class="form-group">
                                                        <label for="Factory" class=""><a class="text-info text-bold-700" onclick=" $('#NewFactory').modal({backdrop: 'static', keyboard: false});" data-toggle="modal" {{--data-target="#NewFactory"--}} title="Add New Factory">Select Factory</a>
                                                        </label>
                                                        <select id="Factory" class="select2 form-control" name="factory" required>
                                                            <option value="">- - - Select  Factory - - -</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 no-padding">
                                                    <div class="form-group">
                                                        <label for="Designation" class=""><a class="text-info text-bold-700" onclick="$('#NewDesignation').modal({backdrop: 'static', keyboard: false});" data-toggle="modal" {{--data-target="#NewDesignation"--}} title="Add New Designation">Select Designation</a>
                                                        </label>
                                                        <select id="Designation" class="select2 form-control" name="designation" required>
                                                            <option value="">- - - Select  Designation - - -</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 no-padding" >
                                                    <div class="form-group">
                                                        <label for="FactoryITName" class="text-bold-700">Factory IT Name</label>
                                                        <input type="text" id="FactoryITName" maxlength="255" class="form-control" placeholder="Enter Factory IT Name" name="name" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 no-padding" >
                                                    <div class="form-group">
                                                        <label for="EmailAddress" class="text-bold-700">Email Address</label>
                                                        <input type="email" id="EmailAddress" maxlength="150" class="form-control" placeholder="xyz@palmalgarments.com" name="email" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 no-padding" >
                                                    <div class="form-group">
                                                        <label for="Mobile" class="text-bold-700">Mobile No</label>
                                                        <input type="text" id="Mobile" maxlength="11" class="form-control" placeholder="018********" name="mobile_no" required onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions right">
                                            <button type="submit" id="submit_button_factory_it" class="btn btn-outline-primary">
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
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Factory IT  List</h4>
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
                                            <th class="text-center">Factory Name</th>
                                            <th class="text-center">IT Name</th>
                                            <th class="text-center">Designation</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Mobile No</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($factories))
                                            @foreach($factories as $media)
                                                <tr @if($media->status == 'I') class="bg-warning" @endif>
                                                    <td class="text-left">
                                                        {{$media->factory}}
                                                    </td>
                                                    <td class="text-left">
                                                        {{$media->name}}
                                                    </td>
                                                    <td class="text-left">
                                                        {{$media->designation}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$media->email}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$media->mobile_no}}
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="btn btn-danger btn-sm btn-round fa fa-trash DeleteWorkExp" data-id="{{$media->id}}" title="Delete Factory"></a>
                                                        <a class="btn btn-info btn-sm btn-round fa fa-edit EditWorkExp" data-id="{{$media->id}}" title="Edit Factory"></a>
                                                        @if($media->status == 'A')
                                                            <a class="btn btn-warning btn-sm btn-round fa fa-times DeActivateWorkExp" data-id="{{$media->id}}" title="De-Activate Factory"></a>
                                                        @elseif($media->status == 'I')
                                                            <a class="btn btn-cyan btn-sm btn-round fa fa-check ActivateWorkExp" data-id="{{$media->id}}" title="Activate Factory"></a>
                                                        @else
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th class="text-center">Factory Name</th>
                                            <th class="text-center">IT Name</th>
                                            <th class="text-center">Designation</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Mobile No</th>
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
@endsection

@section('pageScripts')
   {{-- <script src="{{ asset('/stack-admin/app-assets/js/scripts/modal/components-modal.js') }}"></script>--}}
    <script src="{{ asset('/js/custom/common.js') }}"></script>
    <script src="{{ asset('/js/custom/back-end/submit-forms.js') }}"></script>
   @include('layouts.common-modal-js.new-factory-modal-js')
   @include('layouts.common-modal-js.new-designation-modal-js')
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
                var url = '{{ route('settings.factory.it-setup.save') }}';
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
            var url = '{{ route('settings.factory.it-setup.delete') }}';
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
            var url = '{{ route('settings.factory.it-setup.de-activate') }}';
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
            var url = '{{ route('settings.factory.it-setup.activate') }}';
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
            var url = '{{ route('settings.factory.it-setup.edit') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: id, _token: '{{csrf_token()}}'},
                success:function(data){
                    $('input[name=name]').val(data.name);
                    $('input[name=mobile_no]').val(data.mobile_no);
                    $('input[name=email]').val(data.email);
                    $('select[name=designation]').val(data.designation).change();
                    $('select[name=factory]').val(data.factory).change();
                    $('input[name=id]').val(data.id);
                    moveToTop();
                    changeButtonText(' Update', 'submit_button_factory_it', 3);
                },
                error:function(error){
                    moveToTop();
                    swalError(error);
                    clearForm('WorkExperienceForm');
                    changeButtonText(' Save', 'submit_button_factory_it', 3);
                }
            })
        });

        function clearNewFactoryCheckBox() {
            //console.log('hit');
           $('input[name=department_applicable]').prop('checked', false);
        }
    </script>
@endsection


