{{--new factory modal--}}
<div class="modal fade text-left" id="AssignServicePerson" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title" id="myModalLabel16">Assign Service Person</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="NewAssignServicePersonForm" method="post" action="#">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="HiddenAssignmentMasterId" class="form-control" name="service_master" value="{{old('service_master', $service_master->id)}}">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="AssignmentServicePersonList" class="text-bold-700">Select Service Person</label>
                                    <select id="AssignmentServicePersonList" class="select2 form-control" name="assigned_to" required>
                                        <option value="">- - - Select Service Person - - -</option>
                                        @if(!empty($users))
                                            @foreach($users AS $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            @if($service_master->has_assigned == 1)
                                <div class="col-md-12" >
                                    <div class="form-group" >
                                        <label for="ClosingDescription" class="text-bold-700">Closing Description</label>
                                        <textarea id="ClosingDescription" rows="15" class="form-control" name="clearance_description" placeholder="Write Description...."></textarea>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-12" >
                                <div class="form-group" >
                                    <label for="AssignmentDescription" class="text-bold-700">Assignment Description</label>
                                    <textarea id="AssignmentDescription" rows="15" class="form-control" name="assignment_description" placeholder="Write Description...."></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="clearFormWithoutDelayHidden('NewAssignServicePersonForm');" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <div {{--class="form-actions right"--}}>
                        <button type="submit" id="submit_button_assignment" class="btn btn-outline-primary">
                            <i class="fa fa-check"></i> Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end new factory modal--}}

