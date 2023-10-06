{{--new factory modal--}}
<div class="modal fade text-left" id="NewDesignation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title" id="myModalLabel16">Add New Designation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="NewDesignationForm" method="post" action="#">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="HiddenNewDesignationID" class="form-control" name="id" >
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-8 ">
                                <div class="form-group">
                                    <label for="DesignationName" class="text-bold-700">Designation Name</label>
                                    <input type="text" id="DesignationName" maxlength="100" class="form-control" placeholder="Enter Designation Name" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label for="DShortName" class="text-bold-700">Short Form</label>
                                    <input type="text" id="DShortName" maxlength="50" class="form-control" placeholder="Short Form" name="short_form" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="clearFormWithoutDelay('NewDesignationForm');" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <div {{--class="form-actions right"--}}>
                        <button type="submit" id="submit_button_designation" class="btn btn-outline-primary">
                            <i class="fa fa-check"></i> Save Designation
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end new factory modal--}}

