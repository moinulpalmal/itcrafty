{{--new department modal--}}
<div class="modal fade text-left" id="NewCustomer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title" id="myModalLabel16">Add New Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="NewCustomerForm" method="post" action="#">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="HiddenNewEmployeeID" class="form-control" name="id">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-3 ">
                                <div class="form-group">
                                    <label for="NewCustomerFactory" class="text-bold-700">Select Factory</label>
                                    <select id="NewCustomerFactory" class="select2 form-control" name="factory" required>
                                        <option value="">- - - Select  Factory - - -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="form-group">
                                    <label for="NewCustomerDepartment" class="text-bold-700">Select Department</label>
                                    <select id="NewCustomerDepartment" class="select2 form-control" name="department">
                                        <option value="">- - - Select  Department - - -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="form-group">
                                    <label for="Designation" class=""><a class="text-info text-bold-700" onclick="$('#NewDesignation').modal({backdrop: 'static', keyboard: false});" data-toggle="modal" {{--data-target="#NewDesignation"--}} title="Add New Designation">Select Designation</a>
                                    </label>
                                    <select id="Designation" class="select2 form-control" name="designation" required>
                                        <option value="">- - - Select  Designation - - -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 " >
                                <div class="form-group">
                                    <label for="JobLocation" class="text-bold-700">Job Location</label>
                                    <input type="text" id="JobLocation" maxlength="150" class="form-control" placeholder="Enter Job Location" name="job_location" required>
                                </div>
                            </div>
                            <div class="col-md-2 " >
                                <div class="form-group">
                                    <label for="CustomerID" class="text-bold-700">Employee ID</label>
                                    <input type="text" id="CustomerID" maxlength="20" class="form-control" placeholder="Enter Employee ID" name="employee_id" required>
                                </div>
                            </div>
                            <div class="col-md-3 " >
                                <div class="form-group">
                                    <label for="CustomerName" class="text-bold-700">Employee Name</label>
                                    <input type="text" id="CustomerName" maxlength="255" class="form-control" placeholder="Enter Customer Name" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-3 " >
                                <div class="form-group">
                                    <label for="EmailAddress" class="text-bold-700">Email Address</label>
                                    <input type="email" id="EmailAddress" maxlength="150" class="form-control" placeholder="xyz@palmalgarments.com" name="email">
                                </div>
                            </div>
                            <div class="col-md-2 " >
                                <div class="form-group">
                                    <label for="ExtNo" class="text-bold-700">Extension No</label>
                                    <input type="text" id="ExtNo" maxlength="4" class="form-control" placeholder="xxxx" name="ext_no" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                </div>
                            </div>
                            <div class="col-md-2 " >
                                <div class="form-group">
                                    <label for="Mobile" class="text-bold-700">Mobile No</label>
                                    <input type="text" id="Mobile" maxlength="11" class="form-control" placeholder="018********" name="mobile_no" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="clearFormWithoutDelay('NewCustomerForm');" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <div {{--class="form-actions right"--}}>
                        <button type="submit" id="submit_button_new_department" class="btn btn-outline-primary">
                            <i class="fa fa-check"></i> Save Employee
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end new department modal--}}

