@extends('layouts.admin.admin-master')

@section('title')
    User Task
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
                            <li class="breadcrumb-item active"><a href="{{route('admin.user.task')}}"> Tasks</a>
                            </li>
                        </ol>
                    </div>
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
                            <h4 class="card-title">User Tasks Form</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="feather icon-minus"></i></a></li>
                                    <li><a data-action="reload" onclick="clearForm('FactoryAdd'); changeButtonText(' Save', 'submit_button', 3);"><i class="feather icon-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                    {{-- <li><a data-action="close"><i class="feather icon-x"></i></a></li>--}}
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <form class="form" id="FactoryAdd" method="post" action="#">
                                    @csrf
                                    <input type="hidden" id="HiddenFactoryID" name="id">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-3 no-padding"></div>
                                            <div class="col-md-2 no-padding">
                                                <div class="form-group">
                                                    <label for="RoleID" class="text-bold-700">Select Role Group</label>
                                                    <select class="form-control select2" name="role_name"  id="RoleID" required>
                                                        <option value="" >- - - Select Role - - -</option>
                                                        @if(!empty($roles))
                                                            @foreach($roles as $type)
                                                                <option value="{{ $type->id }}">{{ $type->view_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2 no-padding">
                                                <div class="form-group">
                                                    <label for="FactoryName" class="control-label">Task Name</label>
                                                    <input type="text" class="form-control" name="name" id="FactoryName" placeholder="Enter factory name" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-2 no-padding">
                                                <div class="form-group">
                                                    <label for="ShortName" class="control-label">Task View Name</label>
                                                    <input type="text" class="form-control" name="view_name" id="ShortName" placeholder="Enter short name" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-3 no-padding"></div>
                                        </div>
                                    </div>
                                    <div class="form-actions right">
                                        <button type="submit" id="submit_button" class="btn btn-outline-primary">
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
                            <h4 class="card-title">Tasls  List</h4>
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
                                <table id="advanced-usage" class="table table-striped table-bordered table-condensed social-media table-info">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Sl No.</th>
                                            <th class="text-center">Role Name</th>
                                            <th class="text-center">Task</th>
                                            <th class="text-center">Task View Name</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php($i = 1)
                                    @foreach($tasks as $item)
                                        <tr>
                                            <td class="text-center">{{$i++}}</td>
                                            <td class="text-center">{{$item->role_name}}</td>
                                            <td class="text-center">{{$item->name}}</td>
                                            <td class="text-center">{!! $item->view_name !!}</td>
                                            <td class="text-center">
                                                <a onclick="iconChange()" data-id = "{{ $item->id }}" class="EditFactory btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th class="text-center">Sl No.</th>
                                        <th class="text-center">Role Name</th>
                                        <th class="text-center">Task</th>
                                        <th class="text-center">Task View Name</th>
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

@endsection

@section('pageVendorScripts')

@endsection
@section('pageScripts')
    {{--    <script src="{{ asset('back-end/assets/MyJS/jquery.min.js') }}"></script>--}}
    <script src="{{ asset('/js/custom/common.js') }}"></script>
    <script>
        $(document).ready(function () {
            /* CKEDITOR.replace( 'description',{
                 uiColor: '#CCEAEE'
             });*/
            resetSelect2();
        });
        function resetSelect2() {
            $(".select2").select2({
                dropdownAutoWidth: true,
                width: '100%'
            });
        }
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

        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#FactoryAdd').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var id = $('#HiddenFactoryID').val();
                var url = '{{ route('admin.user.task.save') }}';
                //console.log(data);
                $.ajax({
                    url: url,
                    method:'POST',
                    data:data,
                    success:function(data){
                        //console.log(data);
                        if(id)
                        {
                            swal({
                                title: "Data Updated Successfully!",
                                icon: "success",
                                button: "Ok!",
                            }).then(function (value) {
                                if(value){
                                    refresh();
                                }
                            });
                        }
                        else
                        {
                            swal({
                                title: "Data Inserted Successfully!",
                                icon: "success",
                                button: "Ok!",
                            }).then(function (value) {
                                refresh();
                            });
                        }
                    },
                    error:function(error){
                        console.log(error);
                        swal({
                            title: "Data Not Saved!",
                            text: "Please Check Your Data!",
                            icon: "error",
                            button: "Ok!",
                            className: "myClass",

                        });
                    }
                })

            })
        });
        $('#advanced-usage').on('click',".EditFactory", function(){
            var button = $(this);

            var FactoryID = button.attr("data-id");


            var url = '{{ route('admin.user.task.edit') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: FactoryID},
                success:function(data){
                    $('input[name=name]').val(data.name);
                    $('input[name=view_name]').val(data.view_name);
                    $('input[name=id]').val(data.id);
                    $('select[name=id]').val(data.role_id).change();
                    moveToTop();
                    changeButtonText(' Update', 'submit_button', 3);
                },
                error:function(error){
                    moveToTop();
                    swalError(error);
                    clearForm('FactoryAdd');
                    changeButtonText(' Save', 'submit_button', 3);
                }
            })

        });

    </script>
@endsection()



