{{--new factory modal--}}
<div class="modal fade text-left" id="RequisitionRequestEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title" id="myModalLabel16">Send Requisition Request Email</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="NeRequisitionRequestEmailForm" method="post" action="#">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="HiddenRequisitionRequestID" class="form-control" name="service_master" value="{{old('service_master', $service_master->id)}}">
                    <input type="hidden" id="ReqEmailTag" class="form-control" name="email_tag" value="RR">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ReqFromPerson" class="text-bold-700">From Person</label>
                                    <input type="email" id="ReqFromPerson" class="form-control" name="from_person" value="{{old('from_person', Auth::user()->email)}}" readonly required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ReqToPerson" class="text-bold-700">Select To Person</label>
                                    <select id="ReqToPerson" class="select2 form-control" multiple="multiple" name="to_email[]" required>
                                        @if(!empty($email_list))
                                            @foreach($email_list AS $user)
                                                <option value="{{$user->email}}">{{$user->email}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ReqToCCPerson" class="text-bold-700">Select To CC Person</label>
                                    <select id="ReqToCCPerson" class="select2 form-control" multiple="multiple" name="to_cc_email[]" required>
                                        @if(!empty($email_list))
                                            @foreach($email_list AS $user)
                                                <option value="{{$user->email}}">{{$user->email}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group" >
                                    <label for="ReqEmailDescription" class="text-bold-700">Email Description</label>
                                    <textarea id="ReqEmailDescription" rows="15" class="form-control" name="requisition_email_description" placeholder="Write Description....">
                                        <p>
                                           Dear ,
                                        </p>
                                        <p>
                                            <strong>Service ID:</strong> {{$service_master->service_id}}<br>
                                            <strong>Product Category:</strong> {{$service_master->product_category}}<br>
                                            <strong>Product Sub-Category:</strong> {{$service_master->product_sub_category}}<br>
                                            <strong>Manufacturer:</strong> {{$service_master->manufacturer}}<br>
                                            <strong>Product Name:</strong> {{$service_master->product_name}}<br>
                                        </p>
                                    </textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="clearFormWithoutDelayHidden('NeRequisitionRequestEmailForm');" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <div {{--class="form-actions right"--}}>
                        <button type="submit" id="submit_button_req_email" class="btn btn-outline-primary">
                            <i class="fa fa-check"></i> Send
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end new factory modal--}}

