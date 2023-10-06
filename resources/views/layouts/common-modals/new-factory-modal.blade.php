{{--new factory modal--}}
<div class="modal fade text-left" id="NewFactory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title" id="myModalLabel16">Add New Factory</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="NewFactoryForm" method="post" action="#">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="HiddenNewFactoryID" class="form-control" name="id" >
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-3 ">
                                <div class="form-group">
                                    <label for="FactoryName" class="text-bold-700">Factory Name</label>
                                    <input type="text" id="FactoryName" maxlength="255" class="form-control" placeholder="Enter Factory Name" name="factory_name" required>
                                </div>
                            </div>
                            <div class="col-md-2 ">
                                <div class="form-group">
                                    <label for="FactShortName" class="text-bold-700">Factory Short Name</label>
                                    <input type="text" id="FactShortName" maxlength="50" class="form-control" placeholder="Short Name" name="factory_short_name" required>
                                </div>
                            </div>
                            <div class="col-md-2 ">
                                <div class="form-group">
                                    <label for="FactoryUintName" class="text-bold-700">Factory Unit Name</label>
                                    <input type="text" id="FactoryUintName" maxlength="255" class="form-control" placeholder="Enter Unit Name if Exits" name="unit_name">
                                </div>
                            </div>
                            <div class="col-md-2 ">
                                <div class="form-group">
                                    <label for="FactoryUintShortName" class="text-bold-700">Unit Short Name</label>
                                    <input type="text" id="FactoryUintShortName" maxlength="50" class="form-control" placeholder="Short Unit name" name="unit_short_name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" style="margin-top: 30px; margin-left: 20px; !important;">
                                    <label class="checkbox-container text-bold-700" for="DepartmentApplicable">Is Department Applicable?
                                        <input type="checkbox" id="DepartmentApplicable" name="department_applicable">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="clearFormWithoutDelay('NewFactoryForm'); clearNewFactoryCheckBox(); /*getFactoryList();*/" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <div {{--class="form-actions right"--}}>
                        <button type="submit" id="submit_button_factory" class="btn btn-outline-primary">
                            <i class="fa fa-check"></i> Save Factory
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end new factory modal--}}
