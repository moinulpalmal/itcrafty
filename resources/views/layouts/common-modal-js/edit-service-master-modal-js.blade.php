<script>
    $(document).ready(function () {
        //getFactoryList();
        //getDepartmentList();
        //getProductCategoryList();
        resetSelect2();
         CKEDITOR.replace( 'problem_description',{
                uiColor: '#CCEAEE'
            });
    });

    function resetSelect2() {
        $(".select2").select2({
            dropdownAutoWidth: true,
            width: '100%'
        });
    }


    function getFactoryList(){
        var check = 1;

        var url = '{{ route('settings.factory.setup.drop-down-list') }}';
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
                    defaultValue = "- - - Select Factory - - -";
                    $('select[id= "Factory"]').empty();

                    $('select[id= "Factory"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
                    $.each(data, function(key,value){
                        //console.log(data);
                        $('select[id= "Factory"]').append('<option value="'+ value +'">'+ key +'</option>');
                    });
                    //$('#YarnCountName').trigger('chosen:updated');
                    resetSelect2();
                }
            });
        }
        else{
            defaultKey = "";
            defaultValue = "- - - Select Factory - - -";

            $('select[id= "Factory"]').empty();
            $('select[id= "Factory"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
            resetSelect2();
        }
    }
    function getDepartmentList(){
        var check = 1;
        var url = '{{ route('settings.factory.department-setup.drop-down-list') }}';
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
                    defaultValue = "- - - Select Department - - -";
                    $('select[id= "Department"]').empty();

                    $('select[id= "Department"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
                    $.each(data, function(key,value){
                        //console.log(data);
                        $('select[id= "Department"]').append('<option value="'+ value +'">'+ key +'</option>');
                    });
                    //$('#YarnCountName').trigger('chosen:updated');
                    resetSelect2();
                }
            });
        }
        else{
            defaultKey = "";
            defaultValue = "- - - Select Department - - -";

            $('select[id= "Department"]').empty();
            $('select[id= "Department"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
            resetSelect2();
        }
    }
    function getCustomerList() {
        let factory = $('select[name=factory]').val();
        let department = $('select[name=department]').val();

        var url = '{{ route('settings.employee.drop-down-list') }}';
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
        });
        if(factory){
            $.ajax({
                url: url,
                data: {factory: factory, department: department},
                type: "POST",
                dataType: "json",
                success: function (data) {
                    //console.log(data);
                    //return;
                    defaultKey = "";
                    defaultValue = "- - - Select Employee - - -";
                    $('select[id= "Customer"]').empty();

                    $('select[id= "Customer"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
                    $.each(data, function(key,value){
                        //console.log(data);
                        $('select[id= "Customer"]').append('<option value="'+ value +'">'+ key +'</option>');
                    });
                    //$('#YarnCountName').trigger('chosen:updated');
                    resetSelect2();
                    getCustomerInfo('');
                }
            });
        }
        else{
            defaultKey = "";
            defaultValue = "- - - Select Department - - -";

            $('select[id= "Customer"]').empty();
            $('select[id= "Customer"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
            resetSelect2();
        }

        //console.log(factory);
        //console.log(department);
    }
    function getCustomerInfo(_value) {
        if(_value.value){
            var url = '{{ route('settings.employee.edit') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: _value.value, _token: '{{csrf_token()}}'},
                success:function(data){
                    $('input[name=job_location]').val(data.job_location);
                    $('input[name=email]').val(data.email);
                    $('input[name=mobile_no]').val(data.mobile_no);
                    $('input[name=ext_no]').val(data.ext_no);
                },
                error:function(error){
                    $('input[name=job_location]').val('');
                    $('input[name=email]').val('');
                    $('input[name=mobile_no]').val('');
                    $('input[name=ext_no]').val('');
                }
            })
        }
        else{
            $('input[name=job_location]').val('');
            $('input[name=email]').val('');
            $('input[name=mobile_no]').val('');
            $('input[name=ext_no]').val('');
        }
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

    $(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $('#ServiceMasterForm').submit(function(e){
            e.preventDefault();
             for ( instance in CKEDITOR.instances ) {
                 CKEDITOR.instances[instance].updateElement();
             }
            var data = $(this).serialize();
            var id = $('#HiddenFactoryID').val();
            let re_url = '{{route('services.master.detail', ['id' => $service_master->id])}}';
            //console.log
            var url = '{{ route('services.master.update') }}';
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
                        swal({
                            title: "Data Updated Successfully!",
                            icon: "success",
                            button: "Ok!",
                        }).then(function (value) {
                            if(value){

                                //refresh();
                                window.location.href = re_url;
                            }
                        });
                    }
                    else if(data === '1')
                    {
                        //swalInsertSuccessFullWithClearModalForm('ServiceMasterForm', '');
                        //clearServiceMasterForm();
                       // resetCkeditor('ProblemDescription');

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
        getFactoryList();
        getDepartmentList();
        getProductCategoryList();
        resetCkeditor('ProblemDescription');
        resetSelect2();
    }



</script>

