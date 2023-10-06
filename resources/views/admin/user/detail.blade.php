@extends('layouts.admin.admin-master')
@section('title')
    {{$user->name}}
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
                            <li class="breadcrumb-item"><a href="{{route('admin.user.active')}}"> Active Users</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.user.detail', ['id' => $user->id])}}"> {{$user->name}}</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-md-12">&nbsp;</div>
        </div>
        <div class="content-body">
            <section class="users-view" >
                <div class="row">
                    <div class="col-12 col-sm-7">
                        <div class="media mb-2">
                             <a class="mr-1" href="#">
                                 @if(Auth::user()->gender == "M")
                                 <img src="{{ asset('/') }}back-end/assets/images/male_profile.png" alt="users view avatar" class="users-avatar-shadow rounded-circle" height="64" width="64">
                                     @elseif(Auth::user()->gender == "F")
                                     <img src="{{ asset('/') }}back-end/assets/images/female_profile.png" alt="users view avatar" class="users-avatar-shadow rounded-circle" height="64" width="64">
                                 @else
                                     <img src="{{ asset('/') }}back-end/assets/images/female_profile.png" alt="users view avatar" class="users-avatar-shadow rounded-circle" height="64" width="64">
                                 @endif
                             </a>
                            <div class="media-body pt-25">
                                <h4 class="media-heading"><span class="users-view-name">{{$user->name}}</span>{{--<span class="text-muted font-medium-1"> @</span><span class="users-view-username text-muted font-medium-1 ">candy007</span>--}}</h4>
                                <span>Employee ID:</span>
                                <span class="users-view-id">{{$user->employee_id}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
                        @if(Auth::user()->id != $user->id)
                            @if(Auth::user()->hasTaskPermission('approveuser', Auth::user()->id))
                                @if(!$user->approved)
                                    <button title="Approve User" onclick="approveUser(this)" class="btn btn-sm btn-success fa fa-check" data-id = "{{ $user->id }}"></button>
                                @else
                                    <button title="Dis-Approve User" onclick="disApproveUser(this)"  class=" btn btn-sm btn-danger fa fa-times" data-id = "{{ $user->id }}"></button>
                                @endif
                            @endif
                        @endif
                        @if(Auth::user()->hasTaskPermission('resetpassword', Auth::user()->id))
                            @if(Auth::user()->id != $user->id)

                            @endif
                                <a title="Reset User Password" href="{{ route('admin.user.password.reset',['id'=>$user->id]) }}" class ="fa fa-key btn btn-sm btn-info" >

                                </a>
                        @endif
                        @if(Auth::user()->hasTaskPermission('updateuser', Auth::user()->id))
                           <a href="{{route('admin.user.edit', ['id' => $user->id])}}" class="btn btn-sm btn-warning fa fa-edit" title="Edit User"></a>
                        @endif
                       {{-- @if(Auth::user()->hasTaskPermission('removeuser', Auth::user()->id))
                            @if(Auth::user()->id != $user->id)

                            @endif
                                <a title="Delete User" class="fa fa-trash btn btn-sm btn-danger" data-id = "{{ $user->id }}"></a>
                        @endif--}}
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <table class="table table-borderless table-info table-striped">
                                        <tbody>
                                            <tr>
                                                <td>Full Name:</td>
                                                <td>{{$user->name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Designation:</td>
                                                <td>
                                                    @if($user->designation_id)
                                                    {{\App\Helpers\Helper::IDwiseData('designations', 'id', $user->designation_id)->name}}
                                                        @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Factory:</td>
                                                <td>
                                                    @if($user->factory_id)
                                                    {{\App\Helpers\Helper::IDwiseData('factories', 'id', $user->factory_id)->factory_name}}
                                                        @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Department:</td>
                                                <td>
                                                    @if($user->department_id)
                                                    {{\App\Helpers\Helper::IDwiseData('departments', 'id', $user->department_id)->name}}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Status:</td>
                                                @if($user->approved == 1)
                                                    <td><span class="badge badge-success users-view-status">Active</span></td>
                                                @else
                                                    <td><span class="badge badge-danger users-view-status">In-Active</span></td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td>Has Approval Access:</td>
                                                @if($user->approval_authority == 1)
                                                    <td><span class="badge badge-success users-view-status">Yes</span></td>
                                                @else
                                                    <td><span class="badge badge-danger users-view-status">No</span></td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-12 col-md-6">
                                    <table class="table table-borderless table-primary table-striped">
                                        <tbody>
                                            <tr>
                                                <td>Email:</td>
                                                <td>{{$user->email}}</td>
                                            </tr>
                                            <tr>
                                                <td>Personal Mobile:</td>
                                                <td>{{$user->personal_mobile_no}}</td>
                                            </tr>
                                            <tr>
                                                <td>Official Mobile:</td>
                                                <td>{{$user->official_mobile_no}}</td>
                                            </tr>
                                            <tr>
                                                <td>Official Extension:</td>
                                                <td>{{$user->official_extension_no}}</td>
                                            </tr>
                                            <tr>
                                                <td>Gender:</td>
                                                @if($user->gender == "M")
                                                    <td>Male</td>
                                                @elseif($user->gender == "F")
                                                    <td>Female</td>
                                                    @else
                                                    <td>Other</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-title">
                            <br>
                            <h4>User Access Form</h4>
                        </div>
                        <div class="card-body">
                            <form id="ItemAdd" name="ItemAddForm">
                                {{ csrf_field() }}
                                <div class="form-body">
                                    <input type="hidden" id="UserID" name="user_id" {{--onsubmit="submitRole(this)"--}} value="{{old('user', $user->id)}}">
                                    @foreach($roleList as $role)
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group" style="margin-top: 30px; margin-left: 20px; !important;">
                                                    <label class="checkbox-container text-bold-700" for="{{$role->name}}C">{{$role->view_name}}
                                                        <input type="checkbox" onclick="checkChange('#{{$role->name}}C', '.{{$role->name}}')" id="{{$role->name}}C" name="r_{{$role->name}}" @if(Auth::user()->hasPermission($role->name,$user->id )) checked = "checked" @endif>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            @foreach($taskList as $task)
                                                @if($task->role_id == $role->id)
                                                    <div class="col-md-3">
                                                        <div class="form-group" style="margin-top: 30px; margin-left: 20px; !important;">
                                                            <label class="checkbox-container" for="{{$task->name}}t">{{$task->view_name}}
                                                                <input type="checkbox" class="{{$role->name}}" id="{{$task->name}}t" name="t_{{$task->name}}" @if(!(Auth::user()->hasPermission($role->name,$user->id ))) disabled @endif @if(Auth::user()->hasTaskPermission($task->name, $user->id ))  checked = "checked" @endif>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <hr>
                                    @endforeach
                                    </div>
                                    {{--<a><button id="iconChange" class="btn btn-info text-right" type="submit"><i class="fa fa-check"></i> Save</button></a>
                                   --}} <div class="form-actions right">
                                        <button type="submit" class="btn btn-outline-primary">
                                            <i class="feather icon-check"></i> Save
                                        </button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- users view card data ends -->
            </section>
        </div>
    </div>
@endsection

@section('page-modals')

@endsection

@section('pageScripts')
    <script src="{{ asset('/stack-admin/app-assets/js/scripts/forms/custom-file-input.js') }}"></script>
    <script src="{{ asset('/js/custom/common.js') }}"></script>
    <script>

        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#ItemAdd').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var id = $('#UserID').val();
                //console.log(data);
               // return;
                var url = '{{ route('admin.user.apply-role') }}';
                //console.log(data);
                $.ajax({
                    url: url,
                    method:'POST',
                    data:data,
                    success:function(data){
                        //console.log(data);
                        //return;
                        if(id)
                        {
                            swal({
                                title: "Data Updated Successfully!",
                                icon: "success",
                                button: "Ok!",
                            }).then(function (value) {
                                if(value){
                                    window.location.href = window.location.href.replace(/#.*$/, '');
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
                                if(value){
                                    window.location.href = window.location.href.replace(/#.*$/, '');
                                }
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
        function checkChange(id, target_class) {
            //console.log(id);
            //console.log(target_class);
            $(id).click(function () {
                if ($(id).is(":checked")) {
                    $(target_class).prop('checked', true);
                    $(target_class).prop('disabled', false);
                } else {
                    $(target_class).prop('checked', false);
                    $(target_class).prop('disabled', true);
                }
                //$(".check").attr('checked', this.checked);
            });

        }


       {{--@foreach($roleList as $role)
            $(document).ready(function () {
                $("#{{$role->name}}C").click(function () {
                    if ($("#{{$role->name}}C").is(":checked")) {
                        $(".{{$role->name}}").prop('checked', true);
                        $(".{{$role->name}}").prop('disabled', false);
                    } else {
                        $(".{{$role->name}}").prop('checked', false);
                        $(".{{$role->name}}").prop('disabled', true);
                    }
                    //$(".check").attr('checked', this.checked);
                });
            });
        @endforeach--}}

        function approveUser(_this){
            var id = _this.getAttribute("data-id");
            swal({
                title: 'Are you sure?',
                text: 'This user access will be approved!',
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
                            if(data){
                                //console.log(data);
                                swal({
                                    title: "Operation Successful!",
                                    icon: "success",
                                    button: "Ok!",
                                }).then(function (value) {
                                    if(value){
                                        refresh();
                                    }
                                });
                            }
                        },
                        error:function(error){
                            console.log(error);
                            swal({
                                title: "Operation Unsuccessful!",
                                text: "Somthing wrong happend please check!",
                                icon: "error",
                                button: "Ok!",
                                className: "myClass",
                            });
                        }
                    })
                }
            });
        }

        function disApproveUser(_this){
            var id = _this.getAttribute("data-id");
            var url = '{{ route('admin.user.access.block') }}';
            swal({
                title: 'Are you sure?',
                text: 'This user access will be blocked!',
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
                            if(data){
                                //console.log(data);
                                swal({
                                    title: "Operation Successful!",
                                    icon: "success",
                                    button: "Ok!",
                                }).then(function (value) {
                                    if(value){
                                        //console.log(value);
                                        window.location.href = window.location.href.replace(/#.*$/, '');
                                    }
                                });
                            }
                        },
                        error:function(error){
                            console.log(error);
                            swal({
                                title: "Operation Unsuccessful!",
                                text: "Somthing wrong happend please check!",
                                icon: "error",
                                button: "Ok!",
                                className: "myClass",
                            });
                        }
                    })
                }
            });
        }


    </script>
@endsection()


