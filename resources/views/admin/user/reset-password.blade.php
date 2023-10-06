
@extends('layouts.admin.admin-master')
@section('title')
    Update Users
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
                            <li class="breadcrumb-item"><a href="{{route('admin.user.detail', ['id' => $user->id])}}"> {{$user->name}}</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.user.password.reset', ['id' => $user->id])}}"> Reset Password</a>
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
                            <h4 class="card-title">User Password Reset Form</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse" title="minimize"><i class="feather icon-minus"></i></a></li>
                                    <li><a data-action="reload" title="clear form" onclick="clearForm('UserCreatForm')"><i class="feather icon-rotate-cw"></i></a></li>
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
                                <form method="post" id="UserCreatForm" name="UserCreatForm" action="{{route('admin.user.password.update')}}" enctype="multipart/form-data" >
                                    @csrf
                                    <div class="form-body">
                                        @if (count($errors) > 0)
                                            <div class="row" style="padding: 0px 15px;">
                                                <div class="col-md-12">
                                                    <div class="alert alert-danger">
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
                                        @if (\Illuminate\Support\Facades\Session::has('reset-password-success'))
                                            <div class="row" style="padding: 0px 15px;">
                                                <div class="col-md-12">
                                                    <div class="alert alert-success">
                                                        <strong>Success!</strong><br><br>
                                                        <ul>
                                                            <li>{{ \Illuminate\Support\Facades\Session::get('reset-password-success') }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                            <h4 class="form-section"><i class="feather icon-eye"></i> Password Section</h4>
                                        <div class="row">
                                            <input id="id" type="hidden" class="form-control @error('user_id') is-invalid @enderror" name="user_id" value="{{ old('id', $user->id) }}">
                                            <input id="current_password" type="hidden" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password', $user->password) }}">

                                            <div class="col-md-2 no-padding">

                                            </div>
                                            <div class="col-md-4 no-padding">
                                                <div class="form-group">
                                                    <label for="new-password" class="control-label">New Password</label>
                                                    <input id="new-password" type="password" class="form-control @error('new-password') is-invalid @enderror" name="new-password" value="{{ old('new-password') }}">

                                                </div>
                                            </div>
                                            <div class="col-md-4 no-padding">
                                                <div class="form-group">
                                                    <label for="new-password-confirmation" class="control-label">Confirm New Password</label>
                                                    <input id="new-password-confirmation" type="password" class="form-control @error('new-password-confirmation') is-invalid @enderror" name="new-password-confirmation" value="{{ old('new-password-confirmation') }}" autocomplete="new-password">
                                                </div>
                                            </div>
                                            <div class="col-md-2 no-padding">

                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-actions right">
                                        <button type="submit" class="btn btn-outline-primary">
                                            <i class="feather icon-check"></i> Reset Password
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
    <script src="{{ asset('/js/custom/common.js') }}"></script>
@endsection()

