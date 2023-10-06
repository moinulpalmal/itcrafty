{{--new factory modal--}}
<div class="modal fade text-left" id="ServiceComplete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title" id="myModalLabel16">Insert/Update Service Complete Info</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="ServiceCompleteForm" method="post" action="#">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="HiddenSolutionServiceMasterID" class="form-control" name="id" value="{{old('id', $service_master->id)}}">
                    <div class="form-body">
                        <div class="row">
                           {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="SolvedAtDate" class="text-bold-700">Solved At</label>
                                    <input type="datetime-local" id="SolvedAtDate" class="form-control" name="solved_at"  required>
                                </div>
                            </div>--}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="SolutionSolvedBy" class="text-bold-700">Solved By</label>
                                    <select id="SolutionSolvedBy" class="select2 form-control" name="solved_by" required {{--@if(\App\Model\ServiceAssign::isAssigned( Auth::user()->id, $service_master->id)) disabled @endif--}}>
                                        <option value="" disabled = "disabled" >- - - Select Solved By - - -</option>
                                        @if(!empty($users))
                                            @foreach($users AS $user)
                                                <option value="{{$user->id}}"  @if(\App\Model\ServiceAssign::isAssigned( Auth::user()->id, $service_master->id))@if($user->id == Auth::user()->id) selected = "selected"  @else disabled = "disabled" @endif @endif>{{$user->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group" >
                                    <label for="SolutionDescription" class="text-bold-700">Solution Description</label>
                                    <textarea id="SolutionDescription" rows="15" class="form-control" name="solution_description">

                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="SolutionRemarks" class="text-bold-700">Remarks</label>
                                    <input type="text" id="SolutionRemarks" class="form-control" name="remarks" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="clearFormWithoutDelayHidden('AddServiceCompleteForm');" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <div {{--class="form-actions right"--}}>
                        <button type="submit" id="submit_button_solved" class="btn btn-outline-primary">
                            <i class="fa fa-check"></i> Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end new factory modal--}}

