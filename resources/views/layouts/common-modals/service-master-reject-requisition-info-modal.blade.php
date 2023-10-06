{{--new factory modal--}}
<div class="modal fade text-left" id="RejectRequisitionInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title" id="myModalLabel16">Reject Requisition Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="RejectRequisitionInfoForm" method="post" action="#">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="HiddenRequisitionInfoIDReject" class="form-control" name="id" @if(!empty($requisition)) value="{{old('id', $requisition->id)}}" @endif>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ReqInfoRequisitionNo"Reject class="text-bold-700">Requisition No</label>
                                    <input type="number" min="1" id="ReqInfoRequisitionNoReject" class="form-control" name="requisition_no" readonly  required @if(!empty($requisition)) value="{{old('requisition_no', $requisition->requisition_no)}}" @endif>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ReqInfoRemarksReject" class="text-bold-700">Remarks</label>
                                    <input type="text" id="ReqInfoRemarksReject" class="form-control" name="remarks" @if(!empty($requisition)) value="{{old('remarks', $requisition->remarks)}}" @endif>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" {{--onclick="clearFormWithoutDelayHidden('RejectRequisitionInfoForm');"--}} class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <div {{--class="form-actions right"--}}>
                        <button type="submit" id="submit_button_requisition_reject" class="btn btn-outline-primary">
                            <i class="fa fa-check"></i> Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end new factory modal--}}

