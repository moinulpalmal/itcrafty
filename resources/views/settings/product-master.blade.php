@extends('layouts.admin.admin-master')
@section('title')
    Product Master
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
                            <li class="breadcrumb-item active"><a href="{{route('settings.product.master')}}">Product List</a>
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
                                <h4 class="card-title">Product Insert/Update Form</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="feather icon-minus"></i></a></li>
                                        <li><a data-action="reload" onclick="clearForm('WorkExperienceForm'); changeButtonText(' Save', 'submit_button', 3); clearCheckBox(); resetCkeditor('Description');"><i class="feather icon-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                        {{-- <li><a data-action="close"><i class="feather icon-x"></i></a></li>--}}
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <form class="form" id="WorkExperienceForm" method="post" action="#">
                                        @csrf
                                        <input type="hidden" id="HiddenFactoryID" class="form-control" name="id" >
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4 no-padding">
                                                    <div class="form-group">
                                                        <label for="ProductCategory" class=""><a class="text-info text-bold-700" onclick=" $('#NewProductCategory').modal({backdrop: 'static', keyboard: false});" data-toggle="modal" {{--data-target="#NewFactory"--}} title="Add New Product Category">Select Product Category</a>
                                                        </label>
                                                        <select id="ProductCategory" class="select2 form-control" name="product_category" required onchange="javascript:getProductSubCategoryByCategory(this)">
                                                            <option value="">- - - Select Product Category - - -</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 no-padding">
                                                    <div class="form-group">
                                                        <label for="ProductSubCategory" class=""><a class="text-info text-bold-700" onclick=" $('#NewProductSubCategory').modal({backdrop: 'static', keyboard: false});" data-toggle="modal" {{--data-target="#NewFactory"--}} title="Add New Product Sub-Category">Select Product Sub-Category</a>
                                                        </label>
                                                        <select id="ProductSubCategory" class="select2 form-control" name="product_sub_category" required>
                                                            <option value="">- - - Select Product Sub-Category - - -</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 no-padding">
                                                    <div class="form-group">
                                                        <label for="Manufacturer" class=""><a class="text-info text-bold-700" onclick=" $('#NewManufacturer').modal({backdrop: 'static', keyboard: false});" data-toggle="modal" {{--data-target="#NewFactory"--}} title="Add New Manufacturer">Select Manufacturer</a>
                                                        </label>
                                                        <select id="Manufacturer" class="select2 form-control" name="manufacturer" required>
                                                            <option value="">- - - Select Manufacturer - - -</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group" style="margin-top: 30px; margin-left: 20px; !important;">
                                                        <label class="checkbox-container" for="HasWarranty">Has Warranty?
                                                            <input type="checkbox" id="HasWarranty" name="has_warranty">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group" style="margin-top: 30px; margin-left: 20px; !important;">
                                                        <label class="checkbox-container" for="HasSlNo">Has Serial no?
                                                            <input type="checkbox" id="HasSlNo" name="has_sl_no">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 no-padding">
                                                    <div class="form-group">
                                                        <label for="ProductName" class="text-bold-700">Product Name</label>
                                                        <input type="text" id="ProductName" maxlength="255" class="form-control" placeholder="Enter Product Name" name="name" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 no-padding">
                                                    <div class="form-group">
                                                        <label for="Warranty" class="text-bold-700">Warranty In Months</label>
                                                        <input type="number" min="0" id="Warranty" value="0" class="form-control" name="warranty_in_months" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 no-padding">
                                                    <div class="form-group" >
                                                        <label for="Description" class="text-bold-700">Description</label>
                                                        <textarea id="Description" rows="15" class="form-control" name="description" placeholder="Write Description...."></textarea>
                                                    </div>
                                                </div>
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
                                <h4 class="card-title">Product List</h4>
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
                                    <table id="social-media-table" class="table table-striped table-bordered table-condensed social-media table-info">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Category</th>
                                                <th class="text-center">Sub-Category</th>
                                                <th class="text-center">Manufacturer</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Description</th>
                                                <th class="text-center">Has Warranty</th>
                                                <th class="text-center">Has Sl. No.</th>
                                                <th class="text-center">Warranty (Months)</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($products))
                                            @foreach($products as $media)
                                                <tr @if($media->status == 'I') class="bg-warning" @endif>
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
                                                        {{$media->name}}
                                                    </td>
                                                    <td class="text-left">
                                                        {!! $media->description !!}
                                                    </td>
                                                    <td class="text-center">
                                                        <p>
                                                            @if($media->has_warranty == true)
                                                                <span class="badge badge-success ml-1">Yes</span>
                                                            @else
                                                                <span class="badge badge-danger ml-1">No</span>
                                                            @endif

                                                        </p>

                                                    </td>
                                                    <td class="text-center">
                                                        <p>
                                                            @if($media->has_sl_no == true)
                                                                <span class="badge badge-success ml-1">Yes</span>
                                                            @else
                                                                <span class="badge badge-danger ml-1">No</span>
                                                            @endif

                                                        </p>

                                                    </td>
                                                    <td class="text-center">
                                                        {{$media->warranty_in_months}}
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
                                                <th class="text-center">Category</th>
                                                <th class="text-center">Sub-Category</th>
                                                <th class="text-center">Manufacturer</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Description</th>
                                                <th class="text-center">Has Warranty</th>
                                                <th class="text-center">Has Sl. No.</th>
                                                <th class="text-center">Warranty (Months)</th>
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
@include('layouts.common-modals.new-product-category-modal')
@include('layouts.common-modals.new-product-sub-category-modal')
@include('layouts.common-modals.new-manufacturer-modal')
@endsection

@section('pageScripts')
    {{--<script src="{{ asset('/stack-admin/app-assets/js/scripts/modal/components-modal.js') }}"></script>--}}
    <script src="{{ asset('/js/custom/common.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
    @include('layouts.common-modal-js.new-product-category-modal-js')
    @include('layouts.common-modal-js.new-manufacturer-modal-js')
    <script>
        let sub_category_id = '';
        var checkExist = setInterval(function() {
            if ($("#ProductSubCategory option[value= sub_category_id]").length > 0) {
                console.log("Exists!");
                clearInterval(checkExist);
            }
        }, 100);
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
        /*$(".select2").select2({
            dropdownAutoWidth: true,
            width: '100%'
        });*/
        $(document).ready(function () {
            CKEDITOR.replace( 'description',{
                uiColor: '#CCEAEE'
            });
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
                for ( instance in CKEDITOR.instances ) {
                    CKEDITOR.instances[instance].updateElement();
                }
                var data = $(this).serialize();
                var id = $('#HiddenFactoryID').val();
                var url = '{{ route('settings.product.master.save') }}';
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
            var url = '{{ route('settings.product.master.delete') }}';
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
            var url = '{{ route('settings.product.master.de-activate') }}';
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
            var url = '{{ route('settings.product.master.activate') }}';
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
            var url = '{{ route('settings.product.master.edit') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: id, _token: '{{csrf_token()}}'},
                success:function(data){
                    $('input[name=name]').val(data.name);
                    $('select[name=product_category]').val(data.product_category).change();
                    $('select[name=product_sub_category]').val(data.sub_product_category).change();
                    $('select[name=manufacturer]').val(data.manufacturer).change();

                    sub_category_id = data.sub_product_category;
                    fillCkeditorWithValue('Description', 'Description', data.description);
                    $('input[name=warranty_in_months]').val(data.warranty_in_months);

                    if (data.has_warranty === 1)
                    {
                        $('input[name=has_warranty]').prop('checked', true);
                    }
                    else if (data.department_applicable === 0)
                    {
                        $('input[name=has_warranty]').prop('checked', false);
                    }

                    if (data.has_sl_no === 1)
                    {
                        $('input[name=has_sl_no]').prop('checked', true);
                    }
                    else if (data.department_applicable === 0)
                    {
                        $('input[name=has_sl_no]').prop('checked', false);
                    }


                    $('input[name=id]').val(data.id);
                    moveToTop();
                    changeButtonText(' Update', 'submit_button', 3);
                },
                error:function(error){
                    moveToTop();
                    swalError(error);
                    clearForm('WorkExperienceForm');
                    changeButtonText(' Save', 'submit_button', 3);
                }
            })
        });

        function clearCheckBox() {
            //console.log('hit');
            $('input[name=has_warranty]').prop('checked', false);
            $('input[name=has_sl_no]').prop('checked', false);
        }
    </script>
@endsection


