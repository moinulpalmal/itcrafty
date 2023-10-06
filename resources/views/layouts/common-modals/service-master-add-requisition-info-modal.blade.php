{{--new factory modal--}}
<div class="modal fade text-left" id="AddRequisitionInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title" id="myModalLabel16">Insert/Update Requisition Info</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="AddRequisitionInfoForm" method="post" action="#">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="HiddenReqServiceMasterID" class="form-control" name="service_master" value="{{old('service_master', $service_master->id)}}">
                    <input type="hidden" id="HiddenRequisitionInfoID" class="form-control" name="id" @if(!empty($requisition)) value="{{old('id', $requisition->id)}}" @endif>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="ReqInfoRequisitionNo" class="text-bold-700">Requisition No</label>
                                    <input type="number" min="1" id="ReqInfoRequisitionNo" class="form-control" name="requisition_no"  required @if(!empty($requisition)) value="{{old('requisition_no', $requisition->requisition_no)}}" @endif>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="ReqInfoRequisitionDate" class="text-bold-700">Received At</label>
                                    <input type="datetime-local" id="ReqInfoRequisitionDate" class="form-control" name="received_at"  required @if(!empty($requisition)) value="{{old('received_at', \Carbon\Carbon::parse($requisition->received_at)->format('yyy-MM-ddThh:mm:ss.SSS'))}}" @endif>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="ReqReceivedBy" class="text-bold-700">Received By</label>
                                    <select id="ReqReceivedBy" class="select2 form-control" name="received_by" required>
                                        <option value="">- - - Select Received By - - -</option>
                                        @if(!empty($users))
                                            @foreach($users AS $user)
                                                <option value="{{$user->id}}" @if(!empty($requisition)) @if($user->id == $requisition->received_by) selected = "selected" @endif @endif>{{$user->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" style="margin-top: 30px; margin-left: 20px; !important;">
                                    <label class="checkbox-container" for="HasSlNo">Is Product Out of Order?
                                        <input type="checkbox" id="HasSlNo" name="is_out_of_order" @if(!empty($requisition)) @if($requisition->is_out_of_order == 1) checked  @endif @endif>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            {{--<div class="col-md-12" >
                                <div class="form-group" >
                                    <label for="ReasonOfPurchase" class="text-bold-700">Reason of Purchase</label>
                                    <textarea id="ReasonOfPurchase" rows="15" class="form-control" name="reason_of_purchase">
                                        @if(!empty($requisition)) {!! $requisition->reason_of_purchase !!} @endif
                                    </textarea>
                                </div>
                            </div>--}}
                            <div class="col-md-12" >
                                <div class="form-group" >
                                    <label for="ServiceComment" class="text-bold-700">Service Comment</label>
                                    <textarea id="ServiceComment" rows="15" class="form-control" name="service_comment">
                                         @if(!empty($requisition)) {!! $requisition->service_comment !!} @endif
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ReqInfoRemarks" class="text-bold-700">Remarks</label>
                                    <input type="text" id="ReqInfoRemarks" class="form-control" name="remarks" @if(!empty($requisition)) value="{{old('remarks', $requisition->remarks)}}" @endif>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" {{--onclick="clearFormWithoutDelayHidden('AddRequisitionInfoForm');"--}} class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <div {{--class="form-actions right"--}}>
                        <button type="submit" id="submit_button_requisition" class="btn btn-outline-primary">
                            <i class="fa fa-check"></i> Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end new factory modal--}}

