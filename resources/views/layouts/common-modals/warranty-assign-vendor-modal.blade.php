{{--new department modal--}}
<div class="modal fade text-left" id="AssignVendor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title" id="myModalLabel16">Assign Vendor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="AssignVendorForm" method="post" action="#">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="Hidden" class="form-control" name="id" value="{{old('id', $service_warranty->id)}}">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ProductCategorySubModal" class="text-bold-700">Select Vendor</label>
                                    <select id="ProductCategorySubModal" class="select2 form-control" name="vendor" required>
                                        <option value="">- - - Select Vendor - - -</option>
                                        @if(!empty($vendors))
                                            @foreach($vendors AS $media)
                                                <option value="{{$media->id}}">{{$media->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="clearFormWithoutDelay('AssignVendorForm');" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <div {{--class="form-actions right"--}}>
                        <button type="submit" id="submit_button_assign_vendor" class="btn btn-outline-primary">
                            <i class="fa fa-check"></i> Assign Vendor
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end new department modal--}}

