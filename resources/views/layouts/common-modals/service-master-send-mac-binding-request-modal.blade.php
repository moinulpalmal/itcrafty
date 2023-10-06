{{--new factory modal--}}
<div class="modal fade text-left" id="MacBindingRequestEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title" id="myModalLabel16">Send Mac Binding Request Email</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="MacBindingRequestEmailForm" method="post" action="#">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="HiddenRequisitionRequestID" class="form-control" name="service_master" value="{{old('service_master', $service_master->id)}}">
                    <input type="hidden" id="ReqEmailTag" class="form-control" name="email_tag" value="MB">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="MacFromPerson" class="text-bold-700">From Person</label>
                                    <input type="email" id="MacFromPerson" class="form-control" name="from_person" value="{{old('from_person', Auth::user()->email)}}" readonly required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="MacToPerson" class="text-bold-700">Select To Person</label>
                                    <select id="MacToPerson" class="select2 form-control" multiple="multiple" name="to_email[]" required>
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
                                    <label for="MacToCCPerson" class="text-bold-700">Select To CC Person</label>
                                    <select id="MacToCCPerson" class="select2 form-control" multiple="multiple" name="to_cc_email[]" required>
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
                                    <label for="MacEmailDescription" class="text-bold-700">Email Description</label>
                                    <textarea id="MacEmailDescription" rows="15" class="form-control" name="mac_binding_email_description" placeholder="Write Description....">
                                        <p>
                                           Dear Sir,
                                        </p>
                                        <p>
                                            <strong>Employee Id:</strong> {{$service_master->employee_id}}<br>
                                            <strong>Name:</strong> {{$service_master->customer}}<br>
                                            <strong>Designation:</strong> {{$service_master->designation}}<br>
                                            <strong>Email Address:</strong> {{$service_master->customer_email}}<br>
                                            <strong>Mac Address:</strong> <br>
                                            <strong>IP Address:</strong> <br>
                                        </p>
                                    </textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="clearFormWithoutDelayHidden('MacBindingRequestEmailForm');" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <div {{--class="form-actions right"--}}>
                        <button type="submit" id="submit_button_mac_email" class="btn btn-outline-primary">
                            <i class="fa fa-check"></i> Send
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end new factory modal--}}

