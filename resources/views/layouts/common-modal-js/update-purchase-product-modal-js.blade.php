<script>
    let scanned = "";
    $(document).ready(function () {
        //getFactoryList();
        //getDepartmentList();
       // getVendorList();
        @if(empty($product_categories))
            getProductCategoryList();
        @endif
        resetSelect2();
        onScan.attachTo(document, {
            suffixKeyCodes: [2], // enter-key expected at the end of a scan
            reactToPaste: false, // Compatibility to built-in scanners in paste-mode (as opposed to keyboard-mode)
            ignoreIfFocusOn: true,
            onScan: function(sCode, iQty) { // Alternative to document.addEventListener('scan')

            },
            /*onKeyDetect: function(iKeyCode){ // output all potentially relevant key events - great for debugging!
                console.log('Pressed: ' + iKeyCode);
            }*/
        });

    });

    function resetSelect2() {
        $(".select2").select2({
            dropdownAutoWidth: true,
            width: '100%'
        });
    }

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
            resetSelect2();
        }
    }
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
                        getProductMasterList();
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
    function getProductMasterList() {
        let category = $('select[name=product_category]').val();
        let sub_category = $('select[name=product_sub_category]').val();

        if(category){
            if(sub_category){
                var url = '{{ route('settings.product.master.drop-down-list') }}';
                $.ajax({
                    url: url,
                    data: {category: category, sub_category: sub_category},
                    type: "POST",
                    dataType: "json",
                    success: function (data) {
                        //console.log(data);
                        //return;
                        defaultKey = "";
                        defaultValue = "- - - Select Product - - -";
                        $('select[id= "ProductMaster"]').empty();

                        $('select[id= "ProductMaster"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
                        $.each(data, function(key,value){
                            //console.log(data);
                            $('select[id= "ProductMaster"]').append('<option value="'+ value +'">'+ key +'</option>');
                        });
                        //$('#YarnCountName').trigger('chosen:updated');
                        resetSelect2();
                    }
                });
            }
            defaultKey = "";
            defaultValue = "- - - Select Product - - -";
            $('select[id= "ProductMaster"]').empty();
            $('select[id= "ProductMaster"]').empty();
            $('select[id= "ProductMaster"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
            resetSelect2();
        }
        defaultKey = "";
        defaultValue = "- - - Select Product - - -";
        $('select[id= "ProductMaster"]').empty();
        $('select[id= "ProductMaster"]').empty();
        $('select[id= "ProductMaster"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
        resetSelect2();
    }

    function getVendorList(){
        var check = 1;
        var url = '{{ route('settings.product.vendor.drop-down-list') }}';
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
                    defaultValue = "- - - Select Vendor - - -";
                    $('select[id= "Vendor"]').empty();

                    $('select[id= "Vendor"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
                    $.each(data, function(key,value){
                        //console.log(data);
                        $('select[id= "Vendor"]').append('<option value="'+ value +'">'+ key +'</option>');
                    });

                    resetSelect2();
                }
            });
        }
        else{
            defaultKey = "";
            defaultValue = "- - - Select Product Category - - -";
            $('select[id= "Vendor"]').empty();
            $('select[id= "Vendor"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
            resetSelect2();
        }
    }


    $(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $('#WorkExperienceForm').submit(function(e){
            e.preventDefault();
            for ( instance in CKEDITOR.instances ) {
                CKEDITOR.instances[instance].updateElement();
            }
            var data = $(this).serialize();
            var id = $('#HiddenFactoryID').val();
            var url = '{{ route('purchase.product.update') }}';
            //console.log(data);

            $.ajax({
                url: url,
                method:'POST',
                data:data,
                success:function(data){
                   // console.log(data);
                    //return;
                    if(data === '2')
                    {
                        swalUpdateSuccessfulWithRefresh();
                    }
                    else if(data === '1')
                    {
                        swalInsertSuccessFullWithClearModalForm('WorkExperienceForm', '');
                    }
                    else if(data === '4'){
                        swal({
                            title: "Serial No. Error!",
                            text: "Serial No Exists in The Database!",
                            icon: "error",
                            button: "Ok!",
                            className: "myClass",
                        }).then(function (value) {
                            if(value){
                                return;
                            }
                        });
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

    function clearServiceMasterForm() {
        clearForm('WorkExperienceForm');
        //getFactoryList();
        //getDepartmentList();
        getProductCategoryList();
        resetCkeditor('Description');
        resetSelect2();
    }



</script>

