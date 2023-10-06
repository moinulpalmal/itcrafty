{{--new department modal--}}
<div class="modal fade text-left" id="NewProductSubCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title" id="myModalLabel16">Add New Product Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="NewProductSubCategoryForm" method="post" action="#">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="HiddenNewProductSubCategoryID" class="form-control" name="id" >
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label for="ProductCategorySubModal" class="text-bold-700">Select Product Category</label>
                                    <select id="ProductCategorySubModal" class="select2 form-control" name="product_category" required>
                                        <option value="">- - - Select Product Category - - -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8 ">
                                <div class="form-group">
                                    <label for="ProductSubCategoryModal" class="text-bold-700">Product Sub Category Name</label>
                                    <input type="text" id="ProductSubCategoryModal" maxlength="100" class="form-control" placeholder="Enter Product Sub-Category Name" name="name" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="clearFormWithoutDelay('NewProductSubCategoryForm');" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <div {{--class="form-actions right"--}}>
                        <button type="submit" id="submit_button_new_product_sub_category" class="btn btn-outline-primary">
                            <i class="fa fa-check"></i> Save Product Sub-Category
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end new department modal--}}

