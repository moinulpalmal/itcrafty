<script>
    $(document).ready(function () {
        getProductCategoryList();
        resetSelect2();
    });
    function getProductCategoryList(){
        var check = 1;
        var url = '{{ route('settings.product.category.drop-down-list') }}';
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
        });
        if(check){
            $.ajax({
                url: url,
                data: {check: check},
                type: "POST",
                dataType: "json",
                success: function (data) {
                    //console.log(data);
                    //return;
                    defaultKey = "";
                    defaultValue = "- - - Select Product Category - - -";
                    $('select[id= "ProductCategory"]').empty();

                    $('select[id= "ProductCategory"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
                    $.each(data, function(key,value){
                        //console.log(data);
                        $('select[id= "ProductCategory"]').append('<option value="'+ value +'">'+ key +'</option>');
                    });
                    //$('#YarnCountName').trigger('chosen:updated');

                    if($("#ProductCategorySubModal").length){
                        $('select[id= "ProductCategorySubModal"]').empty();
                        $('select[id= "ProductCategorySubModal"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
                        $.each(data, function(key,value){
                            //console.log(data);
                            $('select[id= "ProductCategorySubModal"]').append('<option value="'+ value +'">'+ key +'</option>');
                        });
                    }

                    if($("#ProductCategorySubModal2").length){
                        $('select[id= "ProductCategorySubModal2"]').empty();
                        $('select[id= "ProductCategorySubModal2"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
                        $.each(data, function(key,value){
                            //console.log(data);
                            $('select[id= "ProductCategorySubModal2"]').append('<option value="'+ value +'">'+ key +'</option>');
                        });
                    }
                    resetSelect2();
                }
            });
        }
        else{
            defaultKey = "";
            defaultValue = "- - - Select Product Category - - -";
            $('select[id= "ProductCategory"]').empty();
            $('select[id= "ProductCategory"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
            if($("#ProductCategorySubModal").length){
                $('select[id= "ProductCategorySubModal"]').empty();
                $('select[id= "ProductCategorySubModal"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
            }
            if($("#ProductCategorySubModal2").length){
                $('select[id= "ProductCategorySubModal2"]').empty();
                $('select[id= "ProductCategorySubModal2"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
            }
            resetSelect2();
        }
    }
    $(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $('#NewProductCategoryForm').submit(function(e){
            e.preventDefault();
            var data = $(this).serialize();
            var id = $('#HiddenNewDepartmentID').val();
            var url = '{{ route('settings.product.category.save') }}';
            //console.log(data);
            $.ajax({
                url: url,
                method:'POST',
                data:data,
                success:function(data){
                    //  console.log(data);
                    // return;
                    if(data === '2')
                    {
                        swalUpdateSuccessfulWithRefresh();
                    }
                    else if(data === '1')
                    {
                        swalInsertSuccessFullWithClearModalForm('NewProductCategoryForm', '#NewProductCategory');
                        getProductCategoryList();
                    }
                    else if(data === '0'){
                        swalDataNotSaved();
                    }
                    else{
                        swalDataNotSaved();
                    }
                },
                error:function(error){
                    swalError(error);
                }
            })

        })
    });

    function getProductSubCategoryByCategory(_category) {
        if($("#ProductSubCategory").length){
            let category_id = _category.value;
            var url = '{{ route('settings.product.sub-category.drop-down-list-category') }}';
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
            });
            if(category_id){
                $.ajax({
                    url: url,
                    data: {category_id: category_id},
                    type: "POST",
                    dataType: "json",
                    success: function (data) {
                        //console.log(data);
                        //return;
                        defaultKey = "";
                        defaultValue = "- - - Select Product Sub-Category - - -";
                        $('select[id= "ProductSubCategory"]').empty();

                        $('select[id= "ProductSubCategory"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
                        $.each(data, function(key,value){
                            //console.log(data);
                            $('select[id= "ProductSubCategory"]').append('<option value="'+ value +'">'+ key +'</option>');
                        });
                        //$('#YarnCountName').trigger('chosen:updated');
                        resetSelect2();
                        if(sub_category_id){
                            $('select[name=product_sub_category]').val(sub_category_id).change();
                        }
                    }
                });
            }
            else{
                defaultKey = "";
                defaultValue = "- - - Select Product Sub-Category - - -";
                $('select[id= "ProductSubCategory"]').empty();
                $('select[id= "ProductSubCategory"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
                resetSelect2();
            }
        }
    }
</script>

