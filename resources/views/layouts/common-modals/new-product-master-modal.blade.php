{{--new department modal--}}
<div class="modal fade text-left" id="NewProductMaster" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title" id="myModalLabel16">Add New Product Master</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="NewProductMasterForm" method="post" action="#">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="HiddenNewProductMasterID" class="form-control" name="id" >
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label for="ProductCategorySubModal2" class="text-bold-700">Select Product Category</label>
                                    <select id="ProductCategorySubModal2" class="select2 form-control" name="product_category" required onchange="javescript:getProductSubCategoryByCategory(this)">
                                        <option value="">- - - Select Product Category - - -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ProductSubCategorySubModal" class="text-bold-700">Select Product Sub-Category
                                    </label>
                                    <select id="ProductSubCategorySubModal" class="select2 form-control" name="product_sub_category" required>
                                        <option value="">- - - Select Product Sub-Category - - -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Manufacturer" class=""><a class="text-info text-bold-700" onclick=" $('#NewManufacturer').modal({backdrop: 'static', keyboard: false});" data-toggle="modal" {{--data-target="#NewFactory"--}} title="Add New Manufacturer">Select Manufacturer</a>
                                    </label>
                                    <select id="Manufacturer" class="select2 form-control" name="manufacturer" required>
                                        <option value="">- - - Select Manufacturer - - -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group" style="margin-top: 30px; margin-left: 20px; !important;">
                                    <label class="checkbox-container" for="HasWarranty">Has Warranty?
                                        <input type="checkbox" id="HasWarranty" name="has_warranty">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group" style="margin-top: 30px; margin-left: 20px; !important;">
                                    <label class="checkbox-container" for="HasSlNo">Has Serial no?
                                        <input type="checkbox" id="HasSlNo" name="has_sl_no">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label for="ProductName" class="text-bold-700">Product Name</label>
                                    <input type="text" id="ProductName" maxlength="255" class="form-control" placeholder="Enter Product Name" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-2 ">
                                <div class="form-group">
                                    <label for="Warranty" class="text-bold-700">Warranty In Months</label>
                                    <input type="number" min="0" id="Warranty" value="0" class="form-control" name="warranty_in_months" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="clearFormWithoutDelay('NewProductMasterForm');" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <div {{--class="form-actions right"--}}>
                        <button type="submit" id="submit_button_new_product_sub_category" class="btn btn-outline-primary">
                            <i class="fa fa-check"></i> Save Product Master
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end new department modal--}}

