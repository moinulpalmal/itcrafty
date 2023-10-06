@extends('layouts.admin.admin-master')
@section('title')
    Update User
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
                            <li class="breadcrumb-item active"><a href="{{route('admin.user.edit', ['id' => $user->id])}}"> Update {{$user->name}}</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-primary">
                        <div class="card-header">
                            <h4 class="card-title">Info Update Form</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse" title="minimize"><i class="feather icon-minus"></i></a></li>
                                    <li><a data-action="reload" title="clear form" onclick="clearForm('ProfileForm')"><i class="feather icon-rotate-cw"></i></a></li>
                                    <li><a data-action="expand" class="maximize"><i class="feather icon-maximize"></i></a></li>
                                    {{--<li><a data-action="close"><i class="feather icon-x"></i></a></li>--}}
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <div class="card-text">
                                    <p class="card-text text-bold-700 text-danger">Please provide valid information.
                                    </p>
                                </div>
                                <form class="form" id="ProfileForm" method="post"  enctype="multipart/form-data" action="{{route('admin.user.update')}}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{old('id', $user->id)}}">
                                    <div class="form-body">
                                        @if (count($errors) > 0)
                                            <div class="row" style="padding: 0px 15px;">
                                                <div class="col-md-12">
                                                    <div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert">
                                                        {{-- <span class="alert-icon"><i class="fa fa-info"></i></span>--}}
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <h4 class="form-section"><i class="feather icon-eye"></i> Factory, Department & Designation</h4>
                                        <div class="row">
                                            <div class="col-md-4 no-padding">
                                                <div class="form-group">
                                                    <label for="Factory" class="text-bold-700">Factory</label>
                                                    <select id="Factory" class="select2 form-control" name="factory" required>
                                                        <option value="">- - - Select Factory - - -</option>
                                                        @if(!empty($factories))
                                                            @foreach($factories AS $media)
                                                                <option value="{{$media->id}}" @if($user->factory_id == $media->id) selected="selected" @endif>{{$media->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 no-padding">
                                                <div class="form-group">
                                                    <label for="Department" class="text-bold-700">Department</label>
                                                    <select id="Department" class="select2 form-control" name="department" required>
                                                        <option value="" >- - - Select Department - - -</option>
                                                        @if(!empty($departments))
                                                            @foreach($departments AS $media)
                                                                <option value="{{$media->id}}"  @if($user->department_id == $media->id) selected="selected" @endif>{{$media->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 no-padding">
                                                <div class="form-group">
                                                    <label for="Designation" class="text-bold-700">Designation</label>
                                                    <select id="Designation" class="select2 form-control" name="designation" required>
                                                        <option value="" >- - - Select Designation - - -</option>
                                                        @if(!empty($designations))
                                                            @foreach($designations AS $media)
                                                                <option value="{{$media->id}}"  @if($user->designation_id == $media->id) selected="selected" @endif>{{$media->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="form-section"><i class="feather icon-eye"></i> About User</h4>
                                        <div class="row">
                                            <div class="col-md-3 no-padding" >
                                                <div class="form-group">
                                                    <label for="EMPID" class="text-bold-700">Employee ID</label>
                                                    <input type="text" id="EMPID" maxlength="4" class="form-control" placeholder="****" name="employee_id" required value="{{ old('employee_id', $user->employee_id)}}" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                                </div>
                                            </div>
                                            <div class="col-md-6 no-padding">
                                                <div class="form-group">
                                                    <label for="FullName" class="text-bold-700">User Full Name</label>
                                                    <input type="text" id="FullName" maxlength="250" class="form-control" placeholder="User Name" name="full_name" required value="{{ old('name', $user->name)}}">
                                                </div>
                                            </div>
                                            <div class="col-md-3 no-padding">
                                                <div class="form-group">
                                                    <label for="ProjectCategory" class="">Gender</label>
                                                    <select id="ProjectCategory" class="select2 form-control" name="gender" required>
                                                        <option value="" >- - -  Select Gender - - -</option>
                                                        <option value="M"  @if($user->gender == "M") selected="selected" @endif>Male</option>
                                                        <option value="F"  @if($user->gender == "F") selected="selected" @endif>Female</option>
                                                        <option value="O"  @if($user->gender == "O") selected="selected" @endif>Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="form-section"><i class="feather icon-eye"></i> Contact Info</h4>
                                        <div class="row">
                                            <div class="col-md-3 no-padding">
                                                <div class="form-group">
                                                    <label for="Email" class="text-bold-700">Email</label>
                                                    <input type="email" id="Email" maxlength="150" class="form-control" placeholder="xyz@gmail.com" name="email" required value="{{ old('email', $user->email)}}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-3 no-padding" >
                                                <div class="form-group">
                                                    <label for="PMobile" class="text-bold-700">Personal Mobile No</label>
                                                    <input type="text" id="PMobile" maxlength="11" class="form-control" placeholder="018********" name="personal_mobile_number" required value="{{ old('personal_mobile_number', $user->personal_mobile_no)}}" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                                </div>
                                            </div>
                                            <div class="col-md-3 no-padding" >
                                                <div class="form-group">
                                                    <label for="OMobile" class="text-bold-700">Official Mobile No</label>
                                                    <input type="text" id="OMobile" maxlength="11" class="form-control" placeholder="018********" name="official_mobile_number" required value="{{ old('official_mobile_number', $user->official_mobile_no)}}" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                                </div>
                                            </div>
                                            <div class="col-md-3 no-padding" >
                                                <div class="form-group">
                                                    <label for="OExt" class="text-bold-700">Official Extension No</label>
                                                    <input type="text" id="OExt" maxlength="4" class="form-control" placeholder="****" name="official_extension_number" required value="{{ old('official_extension_number', $user->official_extension_no)}}" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="form-section"><i class="fa fa-key"></i> Passwords & Authority</h4>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group" style="margin-top: 30px; margin-left: 20px; !important;">
                                                    <label class="checkbox-container text-bold-700" for="HasSlNo">Has Approval Authority?
                                                        <input type="checkbox" id="HasSlNo" name="approval_authority" @if($user->approval_authority == 1) checked @endif>
                                                        <span class="checkmark" ></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="form-section"><i class="feather icon-eye"></i> Profile Picture</h4>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="PPN" class="text-bold-700">Profile Picture</label>
                                                    <div class="custom-file">
                                                        <input type="file" accept="image/png, image/jpg, image/jpeg" class="custom-file-input" id="PPN" name="profile_picture" onchange="return previewPrimaryImage(event);">
                                                        <label class="custom-file-label" for="PPN">Choose Profile Picture</label>
                                                    </div>
                                                    <hr>
                                                    <img id="OPrimaryImage" @if($user->profile_picture == "user.png") src="" @else src="{{route($user->profile_picture)}}"  @endif class="img-border img-thumbnail text-center">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions right">
                                        <a class="btn btn-outline-warning mr-1" href="{{route('admin.user.active')}}">
                                            <i class="feather icon-x"></i> Go To User List
                                        </a>
                                        <button type="submit" class="btn btn-outline-primary">
                                            <i class="feather icon-check"></i> Update User
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('pageScripts')
    <script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
    <script src="{{ asset('/stack-admin/app-assets/js/scripts/forms/custom-file-input.js') }}"></script>
    <script>
        $(document).ready(function () {
            CKEDITOR.replace( 'description',{
                uiColor: '#CCEAEE'
            });

            $(".select2").select2({
                dropdownAutoWidth: true,
                width: '100%'
            });
        });
        function previewPrimaryImage(event){
            var output = document.getElementById('OPrimaryImage');
            output.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
    <!-- BEGIN: Page JS-->

    <!-- END: Page JS-->
@endsection

