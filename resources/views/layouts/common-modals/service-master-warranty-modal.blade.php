{{--new factory modal--}}
<div class="modal fade text-left" id="CheckWarranty" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title" id="myModalLabel16">Check Warranty</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="CheckWarrantyForm" method="post" action="#">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="HiddenWarrantServiceMasterID" class="form-control" name="service_master" value="{{old('service_master', $service_master->id)}}">
                   {{-- <input type="hidden" id="HiddenWarrantyProductMasterID" class="form-control" name="product_master" value="{{old('product_master', $service_master->product_master)}}">--}}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-3 ">
                                <div class="form-group">
                                    <label for="ProductCategory" class="text-bold-700">Select Product Category
                                    </label>
                                    <select id="ProductCategory" class="select2 form-control" name="product_category" required onchange="javascript:getProductSubCategoryByCategory(this)">
                                        <option value="">- - - Select Product Category - - -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="form-group">
                                    <label for="ProductCategory" class="text-bold-700">Select Product Sub-Category
                                    </label>
                                    <select id="ProductSubCategory" class="select2 form-control" name="product_sub_category" required onchange="javascript:getProductMasterList()">
                                        <option value="">- - - Select Product Sub-Category - - -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="form-group">
                                    <label for="ProductMaster" class="text-bold-700">Select Product
                                    </label>
                                    <select id="ProductMaster" class="select2 form-control" name="product_master" required>
                                        <option value="">- - - Select Product - - -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="SLNo" class="text-bold-700">Product Serial No.</label>
                                    <input type="text" maxlength="" id="SLNo" class="form-control" name="serial_no" required>
                                </div>
                            </div>
                            <div class="col-md-12 " >
                                <div class="form-group" >
                                    <label for="WarrantyDescription" class="text-bold-700">Warranty Description</label>
                                    <textarea id="WarrantyDescription" rows="40" class="form-control" name="description" placeholder="Write Problem...."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" {{--onclick="clearFormWithoutDelayHidden('CheckWarrantyForm');"--}} class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <div {{--class="form-actions right"--}}>
                        <button type="submit" id="submit_button_warranty" class="btn btn-outline-primary">
                            <i class="fa fa-check"></i> Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end new factory modal--}}

