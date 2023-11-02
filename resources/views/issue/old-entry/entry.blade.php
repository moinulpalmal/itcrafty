@extends('layouts.admin.admin-master')
@section('title')
    Add New Issue
@endsection
@section('content')
  {{--  <style type="text/css">
        .hide{
            display: none;
        }

        th{
            background-color: #0689bd;
            color: white;
        }
    </style>--}}
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
                            <li class="breadcrumb-item active"><a href="{{route('issue.old.entry')}}">Add New Issue</a>
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
                                <h4 class="card-title">Product Detail Insert/Update Form</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="feather icon-minus"></i></a></li>
                                        <li><a data-action="reload" onclick="refreshForm();"><i class="feather icon-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <form class="form" id="ProductIssueForm" method="post" action="#">
                                        @csrf
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="feather icon-eye"></i> Employee Info</h4>
                                            <div class="row">
                                                <div class="col-md-3 no-padding" >
                                                    <div class="form-group">
                                                        <label for="CustomerID" class="text-bold-700">Employee ID</label>
                                                        <input type="text" id="CustomerCode" maxlength="20" class="form-control" placeholder="Enter Employee ID" name="employee_id" required onkeyup="javascript: getCustomerInfo(this)">
                                                        <input type="hidden" id="CustomerID" class="form-control" name="customer_id">
                                                    </div>
                                                </div>
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
                                                        <select id="Department" class="select2 form-control" name="department" required>
                                                            <option value="">- - - Select  Department - - -</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 no-padding" >
                                                    <div class="form-group">
                                                        <label for="JobLocation" class="text-bold-700">Job Location</label>
                                                        <input type="text" id="JobLocation" maxlength="150" class="form-control" placeholder="Enter Job Location" name="job_location">
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
                                                <div class="col-md-3 no-padding" >
                                                    <div class="form-group">
                                                        <label for="ExtNo" class="text-bold-700">Extension No</label>
                                                        <input type="text" id="ExtNo" maxlength="4" class="form-control" placeholder="xxxx" name="ext_no" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 no-padding" >
                                                    <div class="form-group">
                                                        <label for="Mobile" class="text-bold-700">Mobile No</label>
                                                        <input type="text" id="Mobile" maxlength="11" class="form-control" placeholder="018********" name="mobile_no" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4 class="form-section"><i class="feather icon-eye"></i> Product Info</h4>
                                            <div class="row">
                                                <div class="col-md-3 no-padding">
                                                    <div class="form-group">
                                                        <label for="ProductCategory" class="text-info text-bold-700"><a onclick="getProductCategoryList()" title="Refresh Product Category List">Select Product Category</a></label>
                                                        <select id="ProductCategory" class="select2 form-control" name="product_category" required onchange="javascript:getProductSubCategoryByCategory(this)" required>
                                                            <option value="">- - - Select Product Category - - -</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 no-padding">
                                                    <div class="form-group">
                                                        <label for="ProductSubCategory" class="text-bold-700">Select Product Sub-Category</label>
                                                        <select id="ProductSubCategory" class="select2 form-control" name="product_sub_category" required onchange="javascript:getProductMasterList()" required>
                                                            <option value="">- - - Select Product Sub-Category - - -</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 no-padding">
                                                    <div class="form-group">
                                                        <label for="ProductMaster" class="text-bold-700">Select Product</label>
                                                        <select id="ProductMaster" class="select2 form-control" name="product_master" required>
                                                            <option value="">- - - Select Product - - -</option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-3 no-padding" >
                                                    <div class="form-group">
                                                        <label for="Serial" class="text-bold-700">Serial No</label>
                                                        <input type="text" id="Serial" maxlength="150" class="form-control" name="serial_no">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 no-padding">
                                                    <div class="form-group">
                                                        <label for="PurchaseDate" class="text-bold-700">Purchase Date</label>
                                                        <input type="date" id="PurchaseDate" class="form-control" name="purchase_date">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 no-padding">
                                                    <div class="form-group">
                                                        <label for="Warranty" class="text-bold-700">Warranty In Months</label>
                                                        <input type="number" min="0" id="Warranty" class="form-control" name="warranty_in_months" value="0">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <br>
                                                    <br>
                                                </div>
                                            </div>
                                            <h4 class="form-section"><i class="feather icon-eye"></i> Issue Info</h4>
                                            <div class="row">
                                                <div class="col-md-3 no-padding">
                                                    <div class="form-group">
                                                        <label for="IssuType" class="text-bold-700">Select Issue Types</label>
                                                        <select id="IssuType" class="select2 form-control" name="issue_type" required>
                                                            <option value="">- - - Select Product - - -</option>
                                                            @foreach($issue_types AS $issue_type)
                                                                <option value="{{$issue_type->id}}">{{$issue_type->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 no-padding">
                                                    <div class="form-group">
                                                        <label for="ReqNo" class="text-bold-700">Requisition No</label>
                                                        <input type="text" id="Serial" maxlength="150" class="form-control" name="reference_no">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 no-padding">
                                                    <div class="form-group">
                                                        <label for="IssueDate" class="text-bold-700">Issue Date</label>
                                                        <input type="date" id="Serial" class="form-control" name="issue_date">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 no-padding" >
                                                    <div class="form-group">
                                                        <label for="IssueDescription" class="text-bold-700">Issue Description</label>
                                                        <input type="text" id="IssueDescription" maxlength="150" class="form-control" name="issue_description">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 no-padding" >
                                                    <div class="form-group">
                                                        <label for="Remarks" class="text-bold-700">Remarks</label>
                                                        <input type="text" id="Remarks" maxlength="150" class="form-control" name="remarks">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <br>
                                                    <br>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-actions right" id="form_actions">
                                            {{--<button onclick="javascript:clearSerialNo()" class="btn btn-outline-danger">Clear Serial No's</button>--}}
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
                            <h4 class="card-title">Employee  List</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse" title="minimize"><i class="feather icon-minus"></i></a></li>
                                    <li><a data-action="reload" onclick="" id="DataTableButton"><i class="feather icon-rotate-cw"></i></a></li>
                                    <li><a data-action="expand" title="maximize"><i class="feather icon-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <table id="social-media-table" class="table table-striped table-bordered table-responsive table-condensed social-media table-info">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Action</th>
                                            <th class="text-center">Customer Name</th>
                                            <th class="text-center">Factory/CHO</th>
                                            <th class="text-center">Department</th>
                                            <th class="text-center">Designation</th>
                                            <th class="text-center">ID No.</th>
                                            <th class="text-center">Job Location</th>
                                            <th class="text-center">Category</th>
                                            <th class="text-center">Sub Category</th>
                                            <th class="text-center">Product Name</th>
                                            <th class="text-center">Purchase Date</th>
                                            <th class="text-center">Serial No</th>
                                            <th class="text-center">Requisition No</th>
                                            <th class="text-center">Issue Date</th>
                                            <th class="text-center">Issue Type</th>
                                            <th class="text-center">Issue Description</th>
                                            <th class="text-center">Remarks</th>
                                            <th class="text-center">Release Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center">Action</th>
                                            <th class="text-center">Customer Name</th>
                                            <th class="text-center">Factory/CHO</th>
                                            <th class="text-center">Department</th>
                                            <th class="text-center">Designation</th>
                                            <th class="text-center">ID No.</th>
                                            <th class="text-center">Job Location</th>
                                            <th class="text-center">Category</th>
                                            <th class="text-center">Sub Category</th>
                                            <th class="text-center">Product Name</th>
                                            <th class="text-center">Purchase Date</th>
                                            <th class="text-center">Serial No</th>
                                            <th class="text-center">Requisition No</th>
                                            <th class="text-center">Issue Date</th>
                                            <th class="text-center">Issue Type</th>
                                            <th class="text-center">Issue Description</th>
                                            <th class="text-center">Remarks</th>
                                            <th class="text-center">Release Date</th>
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
    {{--@include('layouts.common-modals.new-product-category-modal')
    @include('layouts.common-modals.new-product-sub-category-modal')
    @include('layouts.common-modals.new-manufacturer-modal')--}}
@endsection

@section('pageScripts')
    {{--<script src="{{ asset('/stack-admin/app-assets/js/scripts/modal/components-modal.js') }}"></script>--}}
    <script src="{{ asset('/js/custom/common.js') }}"></script>
    <script src="{{ asset('/js/custom/back-end/submit-forms.js') }}"></script>
    <script src="{{ asset('/js/barcode-scanner/on-scan.min.js') }}"></script>
{{--    <script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>--}}
    @include('layouts.common-modal-js.new-factory-modal-js')
    @include('layouts.common-modal-js.new-designation-modal-js')
    @include('layouts.common-modal-js.new-department-modal-js')
   {{-- @include('layouts.common-modal-js.new-purchase-product-modal-js')--}}
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
            getProductCategoryList();
            resetSelect2();
            loadDataTable();

        });

        function refreshForm(){
            getProductCategoryList();
            clearForm('ProductIssueForm');
            changeButtonText(' Save', 'submit_button', 3);
            resetSelect2();
        }

        function returnStringFormatDate(_date) {
            let targetDate = Date.parse(_date);
            let currentDate = new Date(targetDate);
            return currentDate.toDateString();
            //return targetDate.('en')
        }
        function numberWithCommas(num) {
            num1 = num;
            obj1 = new Intl.NumberFormat('en-US');
            output1 = obj1.format(num1);

            return output1;
        }

        function hitTableRefresh() {
            document.getElementById("DataTableButton").click();
        }

        function getProductCategoryList(){
            var check = 1;
           // console.log(check);
            var url = '{{ route('settings.product.category.drop-down-list') }}';
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
            });
            if(check){
                $.ajax({
                    url: url,
                    data: {check: check},
                    type: "POST",
                    dataType: "json",
                    success: function (data) {
                      //  console.log(data);
                     //   return;
                        defaultKey = "";
                        defaultValue = "- - - Select Product Category - - -";
                        $('select[id= "ProductCategory"]').empty();

                        $('select[id= "ProductCategory"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
                        $.each(data, function(key,value){
                            //console.log(data);
                            $('select[id= "ProductCategory"]').append('<option value="'+ value +'">'+ key +'</option>');
                        });

                        resetSelect2();
                    }
                });
            }
            else{
                defaultKey = "";
                defaultValue = "- - - Select Product Category - - -";
                $('select[id= "ProductCategory"]').empty();
                $('select[id= "ProductCategory"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');

                resetSelect2();
            }
        }
        function getProductSubCategoryByCategory(_category) {
            if($("#ProductSubCategory").length){
                let category_id = _category.value;
                var url = '{{ route('settings.product.sub-category.drop-down-list-category') }}';
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
                });
                if(category_id){
                    $.ajax({
                        url: url,
                        data: {category_id: category_id},
                        type: "POST",
                        dataType: "json",
                        success: function (data) {
                            //console.log(data);
                            //return;
                            defaultKey = "";
                            defaultValue = "- - - Select Product Sub-Category - - -";
                            $('select[id= "ProductSubCategory"]').empty();

                            $('select[id= "ProductSubCategory"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
                            $.each(data, function(key,value){
                                //console.log(data);
                                $('select[id= "ProductSubCategory"]').append('<option value="'+ value +'">'+ key +'</option>');
                            });
                            //$('#YarnCountName').trigger('chosen:updated');
                            resetSelect2();
                            getProductMasterList();
                        }
                    });
                }
                else{
                    defaultKey = "";
                    defaultValue = "- - - Select Product Sub-Category - - -";
                    $('select[id= "ProductSubCategory"]').empty();
                    $('select[id= "ProductSubCategory"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
                    resetSelect2();
                }
            }
        }
        function getProductMasterList() {
            let category = $('select[name=product_category]').val();
            let sub_category = $('select[name=product_sub_category]').val();

            if(category){
                if(sub_category){
                    var url = '{{ route('settings.product.master.drop-down-list') }}';
                    $.ajax({
                        url: url,
                        data: {category: category, sub_category: sub_category},
                        type: "POST",
                        dataType: "json",
                        success: function (data) {
                            //console.log(data);
                            //return;
                            defaultKey = "";
                            defaultValue = "- - - Select Product - - -";
                            $('select[id= "ProductMaster"]').empty();

                            $('select[id= "ProductMaster"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
                            $.each(data, function(key,value){
                                //console.log(data);
                                $('select[id= "ProductMaster"]').append('<option value="'+ value +'">'+ key +'</option>');
                            });
                            //$('#YarnCountName').trigger('chosen:updated');
                            resetSelect2();
                        }
                    });
                }
                defaultKey = "";
                defaultValue = "- - - Select Product - - -";
                $('select[id= "ProductMaster"]').empty();
                $('select[id= "ProductMaster"]').empty();
                $('select[id= "ProductMaster"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
                resetSelect2();
            }
            defaultKey = "";
            defaultValue = "- - - Select Product - - -";
            $('select[id= "ProductMaster"]').empty();
            $('select[id= "ProductMaster"]').empty();
            $('select[id= "ProductMaster"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
            resetSelect2();
        }

        function makeTableSearchAble(){
            $('.social-media tfoot th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );

            dataTable.columns().every( function () {
                var that = this;

                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }


        function loadDataTable() {
            dataTable.destroy();
            var free_table = '<tr><td class="text-center" colspan="18">--- Please Wait... Loading Data  ----</td></tr>';
            $('.social-media').find('tbody').append(free_table);

            dataTable = $('.social-media').DataTable({
                ajax: {
                    url: "/itcrafty/public/api/issue/all" ,
                    dataSrc: ""
                },
                columns: [
                    {
                        render: function(data, type, api_item) {
                            if(api_item.status === "A"){
                                return "<p class='text-center'><a title= 'Edit' class= 'EditDetail btn btn-warning btn-sm btn-round fa fa-edit' data-id = "+ api_item.id +"></a></p>";
                            }
                            else{
                                return "<p class='text-center'></p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.customer_name === null){
                                return "<p class = 'text-left'></p>";

                            }else{
                                return "<p class = 'text-left text-success text-bold-700'><strong>"+ api_item.customer_name +"</strong></p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.factory_short_name === null){
                                return "<p class = 'text-left'></p>";

                            }else{
                                return "<p class = 'text-left text-info text-bold-700'><strong>"+ api_item.factory_short_name +"</strong></p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.department === null){
                                return "<p class = 'text-left'></p>";

                            }else{
                                return "<p class = 'text-left text-info text-bold-700'><strong>"+ api_item.department +"</strong></p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.designation === null){
                                return "<p class = 'text-left'></p>";

                            }else{
                                return "<p class = 'text-left text-info text-bold-700'><strong>"+ api_item.designation +"</strong></p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.employee_id === null){
                                return "<p class = 'text-left'></p>";

                            }else{
                                return "<p class = 'text-left'><strong>"+ api_item.employee_id +"</strong></p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.job_location === null){
                                return "<p class = 'text-left'></p>";

                            }else{
                                return "<p class = 'text-left'><strong>"+ api_item.job_location +"</strong></p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.product_category === null){
                                return "<p class = 'text-left'></p>";
                            }else{
                                return "<p class = 'text-left'>"+ api_item.product_category +"</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.product_sub_category === null){
                                return "<p class = 'text-left'></p>";
                            }else{
                                return "<p class = 'text-left'>"+ api_item.product_sub_category +"</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.product_master === null){
                                return "<p class = 'text-left'></p>";
                            }else{
                                return "<p class = 'text-left'>"+ api_item.product_master +"</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.purchase_date === null){
                                return "<p class = 'text-left'></p>";
                            }else{
                                return "<p class = 'text-left'>"+ returnStringFormatDate(api_item.purchase_date) +"</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.sl_no === null){
                                return "<p class = 'text-center'></p>";
                            }else{
                                return "<p class = 'text-center'>"+ api_item.sl_no +"</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.reference_no === null){
                                return "<p class = 'text-left'></p>";
                            }else{
                                return "<p class = 'text-left'>"+ api_item.reference_no +"</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.issue_date === null){
                                return "<p class = 'text-left'></p>";
                            }else{
                                return "<p class = 'text-left'>"+ returnStringFormatDate(api_item.issue_date) +"</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.issue_type === null){

                                return "<p class = 'text-left'></p>";
                            }else{
                                return "<p class = 'text-left'>"+ api_item.issue_type +"</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.issue_description === null){
                                return "<p class = 'text-left'></p>";
                            }else{
                                return "<p class = 'text-left'>"+ api_item.issue_description +"</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.remarks === null){
                                return "<p class = 'text-left'></p>";
                            }else{
                                return "<p class = 'text-left'>"+ api_item.remarks +"</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.release_date === null){
                                return "<p class = 'text-left'></p>";
                            }else{
                                return "<p class = 'text-left'>"+ returnStringFormatDate(api_item.release_date) +"</p>";
                            }
                        }
                    }

                ],
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

            makeTableSearchAble();
        }

        $('#social-media-table').on('click',".EditDetail", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('issue.old.list.edit', ['id' =>  'pid']) }}';
            url = url.replace('pid', id);
            window.open(url, "_blank");
        });

        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#ProductIssueForm').submit(function(e){
                e.preventDefault();
                /* for ( instance in CKEDITOR.instances ) {
                     CKEDITOR.instances[instance].updateElement();
                 }*/
                var data = $(this).serialize();
                buttonDisable('submit_button');
                var url = '{{ route('issue.old.entry.save') }}';
                //console.log(data);
                $.ajax({
                    url: url,
                    method:'POST',
                    data:data,
                    success:function(data){
                     //   console.log(data);
                       // return;
                        if(data === '2')
                        {
                            swalUpdateSuccessfulWithRefresh();
                        }
                        else if(data === '1')
                        {
                            //swalInsertSuccessfulWithRefresh();
                            swal({
                                title: 'Operation Successfully!',
                                text: 'Do you want to add another product againts this user?',
                                icon: 'warning',
                                closeOnClickOutside: false,
                                closeOnEsc: false,
                                buttons: ["Cancel", "Yes!"],
                            }).then(function(value) {
                                if (value) {
                                    buttonEnable('submit_button');
                                    clearIssueInfo();
                                    clearProductSection();
                                    loadDataTable();
                                }else{
                                    clearFormWithoutDelay('ProductIssueForm');
                                    buttonEnable('submit_button');
                                    loadDataTable();
                                    moveToTop();
                                }
                            });
                        }
                        else if(data === '0'){
                            swalDataNotSaved();
                            buttonEnable('submit_button');
                        }
                        else{
                            swalDataNotSaved();
                            buttonEnable('submit_button');
                        }
                    },
                    error:function(error){
                        swalError(error);
                        buttonEnable('submit_button');
                    }
                })

            })
        });

        function getCustomerInfo(_value) {
          //  console.log(_value.value);
            //return;
            if(_value.value){
                var url = '<?php echo e(route('settings.employee.info-by-emp-id')); ?>';
                $.ajax({
                    url: url,
                    method:'POST',
                    data:{employee_id: _value.value, _token: '<?php echo e(csrf_token()); ?>'},
                    success:function(data){
                        $('input[name=job_location]').val(data.job_location);
                        $('input[name=name]').val(data.name);
                        $('input[name=email]').val(data.email);
                        $('input[name=mobile_no]').val(data.mobile_no);
                        $('input[name=ext_no]').val(data.ext_no);
                        $('input[name=customer_id]').val(data.id);
                        $('select[name=factory]').val(data.factory).change();
                        $('select[name=designation]').val(data.designation).change();
                        $('select[name=department]').val(data.department).change();
                       // console.log(data);
                        //    return;

                    },
                    error:function(error){
                        $('input[name=job_location]').val('');
                        $('input[name=name]').val('');
                        $('input[name=email]').val('');
                        $('input[name=mobile_no]').val('');
                        $('input[name=ext_no]').val('');
                        $('input[name=customer_id]').val('');
                        $('select[name=factory]').val('').change();
                        $('select[name=designation]').val('').change();
                        $('select[name=department]').val('').change();
                    }
                })
            }
            else{
                $('input[name=job_location]').val('');
                $('input[name=name]').val('');
                $('input[name=email]').val('');
                $('input[name=mobile_no]').val('');
                $('input[name=ext_no]').val('');
                $('input[name=customer_id]').val('');
                $('select[name=factory]').val('').change();
                $('select[name=designation]').val('').change();
                $('select[name=department]').val('').change();
            }
        }

        function clearProductSection(){
            $('select[name=issue_type]').val('').change();
            $('select[name=product_master]').val('').change();
            $('select[name=product_sub_category]').val('').change();
            $('select[name=product_category]').val('').change();
            $('input[name=serial_no]').val('');
            $('input[name=purchase_date]').val('');
            $('input[name=warranty_in_months]').val('');
        }

        function clearIssueInfo(){
            $('select[name=issue_type]').val('').change();
            $('input[name=reference_no]').val('').change();
            $('input[name=issue_date]').val('');
            $('input[name=issue_description]').val('');
            $('input[name=remarks]').val('');
        }

        function resetSelect2() {
            $(".select2").select2({
                dropdownAutoWidth: true,
                width: '100%'
            });
        }
    </script>
@endsection



