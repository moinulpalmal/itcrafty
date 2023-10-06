<script>
    $(document).ready(function () {
        getProductSubCategoryByCategoryValue(0);
        resetSelect2();
    });
    $(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $('#NewProductSubCategoryForm').submit(function(e){
            e.preventDefault();
            var data = $(this).serialize();
            //var id = $('#HiddenNewDepartmentID').val();
            var url = '{{ route('settings.product.sub-category.save') }}';
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
                        swalInsertSuccessFullWithClearModalForm('NewProductSubCategoryForm', '#NewProductSubCategory');
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

    function getProductSubCategoryByCategoryValue(_category) {
        if($("#ProductSubCategory").length){
            let category_id = _category;
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
                        if($("#ProductSubCategorySubModal").length){
                            $('select[id= "ProductSubCategorySubModal"]').empty();
                            $('select[id= "ProductSubCategorySubModal"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
                            $.each(data, function(key,value){
                                //console.log(data);
                                $('select[id= "ProductSubCategorySubModal"]').append('<option value="'+ value +'">'+ key +'</option>');
                            });
                        }
                        resetSelect2();
                        getProductMasterList();
                    }
                });
            }
            else{
                defaultKey = "";
                defaultValue = "- - - Select Product Sub-Category - - -";
                $('select[id= "ProductSubCategory"]').empty();
                $('select[id= "ProductSubCategory"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
                if($("#ProductSubCategorySubModal").length){
                    $('select[id= "ProductSubCategorySubModal"]').empty();
                    $('select[id= "ProductSubCategorySubModal"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
                }
                resetSelect2();
            }
        }
    }
</script>

