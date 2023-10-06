@extends('layouts.admin.admin-master')
@section('title')
    Users
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
                            <li class="breadcrumb-item active"><a href="{{route('admin.user.historical')}}">Historical User</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Historical User List</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse" title="minimize"><i class="feather icon-minus" ></i></a></li>
                                    {{--<li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>--}}
                                    <li><a data-action="expand" title="maximize"><i class="feather icon-maximize" ></i></a></li>
                                    {{--<li><a data-action="close"><i class="feather icon-x"></i></a></li>--}}
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <table id="social-media-table" class="table table-striped table-bordered table-condensed social-media">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Sl#</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Gender</th>
                                        <th class="text-center">Image</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($users))
                                        @php($i = 1)
                                        @foreach($users as $media)
                                            <tr>
                                                <td class="text-center">{{$i++}}</td>
                                                <td class="text-left">
                                                    {{$media->name}}
                                                </td>
                                                <td class="text-left">{{$media->email}}</td>
                                                <td class="text-center">
                                                    @if($media->gender == 'M')
                                                        Male
                                                    @elseif($media->gender == 'F')
                                                        Female
                                                    @else
                                                        Other
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($media->profile_picture == "user.png")
                                                        @if(Auth::user()->gender == "M")
                                                            <img src="{{asset('/images/user/male_profile.png')}}" class="img-border img-thumbnail text-center" height="80" width="80">
                                                        @elseif(Auth::user()->gender == "F")
                                                            <img src="{{asset('/images/user/female_profile.png')}}" class="img-border img-thumbnail text-center" height="80" width="80">
                                                        @else
                                                            <img src="{{ asset('/stack-admin') }}/app-assets/images/portrait/small/avatar-s-1.png" class="img-border img-thumbnail text-center" height="80" width="80">
                                                        @endif
                                                    @else
                                                        <img src="{{asset($media->profile_picture)}}" class="img-border img-thumbnail text-center" height="80" width="80">
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    {{--<button type="button" class="btn btn-outline-success block btn-lg" data-toggle="modal" data-target="#xlarge">
                                                        Launch Modal
                                                    </button>--}}
                                                    <a class="btn btn-info btn-sm btn-round fa fa-eye" data-toggle="modal" data-target="#view{{$media->id}}" title="View Detail"></a>
                                                    <a class="btn btn-success btn-sm btn-round fa fa-check RestoreWorkExp" data-id="{{$media->id}}" title="Restore User"></a>
                                                    <a class="btn btn-danger btn-sm btn-round fa fa-trash DeleteWorkExp" data-id="{{$media->id}}" title="Remove User"></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th class="text-center">Sl#</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Gender</th>
                                        <th class="text-center">Image</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-modals')
    @if(!empty($users))
        @foreach($users as $media)
            <div class="modal fade text-left" id="view{{$media->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-info white">
                            <h4 class="modal-title" id="myModalLabel16">{{$media->name}}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8 col-sm-6 col-xs-12">
                                    <h4 class="form-section text-left"><i class="feather icon-eye"></i> About User</h4>
                                    <table class="table table-striped table-condensed table-bordered">
                                        <tr>
                                            <td class="text-left text-bold-700">Full Name</td>
                                            <td class="text-left">{{$media->name}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-left text-bold-700">Email</td>
                                            <td class="text-left">{{$media->email}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-left text-bold-700">Gender</td>
                                            <td class="text-left">
                                                @if($media->gender == 'M')
                                                    Male
                                                @elseif($media->gender == 'F')
                                                    Female
                                                @else
                                                    Other
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <h4 class="form-section text-left"><i class="feather icon-eye"></i> Profile Picture</h4>
                                    @if($media->profile_picture != "user.png")
                                        <img src="{{asset($media->profile_picture)}}" class="img-border img-thumbnail text-center">
                                    @else
                                        @if($media->gender == 'M')
                                            <img src="{{asset('images/user/male_profile.png')}}" class="img-border img-thumbnail text-center">
                                        @elseif($media->gender == 'F')
                                            <img src="{{asset('images/user/female_profile.png')}}" class="img-border img-thumbnail text-center">
                                        @else
                                            <img src="{{asset('images/user/male_profile.png')}}" class="img-border img-thumbnail text-center">
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                            {{-- <button type="button" class="btn btn-outline-info">Save changes</button>--}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @php($i = 1)
    @endif
@endsection

@section('pageScripts')
    <script src="{{ asset('/stack-admin/app-assets/js/scripts/modal/components-modal.js') }}"></script>
    <script src="{{ asset('/js/custom/common.js') }}"></script>
    <script>
        let dataTable = $('.social-media').DataTable();

        $('#social-media-table').on('click',".DeleteWorkExp", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.user.remove') }}';
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
                                swalSuccessFullWithDatatableRemove(button, dataTable);
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


        $('#social-media-table').on('click',".RestoreWorkExp", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('admin.user.restore') }}';
            swal({
                title: 'Are you sure?',
                text: 'This record will be restored permanently!',
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
                               swalSuccessFullWithDatatableRemove(button, dataTable);
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
    <!-- BEGIN: Page JS-->

    <!-- END: Page JS-->
@endsection

