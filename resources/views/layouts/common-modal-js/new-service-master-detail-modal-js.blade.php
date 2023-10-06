<script>
    let product_category = parseInt({{$service_master->product_category_id}});
    let product_sub_category = parseInt({{$service_master->product_sub_category_id}});
    let product_master_id = parseInt({{$service_master->product_master_id}});


    $(document).ready(function () {
        getProductCategoryList();
        resetSelect2();
        var dataTable = $('.PSHTable').DataTable({

        });

        var dataTable = $('.CSHTable').DataTable({

        });

        var dataTable = $('.AITable').DataTable({

        });

        resetSelect2();
         CKEDITOR.replace( 'AssignmentDescription',{
                uiColor: '#CCEAEE'
            });

        CKEDITOR.replace( 'ClosingDescription',{
            uiColor: '#CCEAEE'
        });

        CKEDITOR.replace( 'SolutionDescription',{
            uiColor: '#CCEAEE'
        });

        CKEDITOR.replace( 'ReqEmailDescription',{
            uiColor: '#CCEAEE'
        });

        CKEDITOR.replace( 'ServiceComEmailDescription',{
            uiColor: '#CCEAEE'
        });

        CKEDITOR.replace( 'ServiceComment',{
            uiColor: '#CCEAEE'
        });

        CKEDITOR.replace( 'MacEmailDescription',{
            uiColor: '#CCEAEE'
        });

        CKEDITOR.replace( 'WarrantyDescription',{
            uiColor: '#CCEAEE'
        });

        resetSelect2();
    });

    function resetSelect2() {
        $(".select2").select2({
            dropdownAutoWidth: true,
            width: '100%'
        });
    }

    $(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $('#NewAssignServicePersonForm').submit(function(e){
            e.preventDefault();
            for ( instance in CKEDITOR.instances ) {
                CKEDITOR.instances[instance].updateElement();
            }
            var data = $(this).serialize();
            var id = $('#HiddenAssignmentMasterId').val();
            var url = '{{ route('services.master.assign') }}';
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
                        //resetCkeditor('AssignmentDescription');
                       // resetCkeditor('ClosingDescription');
                        swalInsertSuccessfulWithRefresh();
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

    $(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $('#AddRequisitionInfoForm').submit(function(e){
            e.preventDefault();
            for ( instance in CKEDITOR.instances ) {
                CKEDITOR.instances[instance].updateElement();
            }
            var data = $(this).serialize();
           // var id = $('#HiddenFactoryID').val();
            var url = '{{ route('services.master.requisition.save') }}';
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
                        swalInsertSuccessfulWithRefresh();
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

    $(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $('#RejectRequisitionInfoForm').submit(function(e){
            e.preventDefault();
            var data = $(this).serialize();
            // var id = $('#HiddenFactoryID').val();
            var url = '{{ route('services.master.requisition.reject-product') }}';
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
                        swalInsertSuccessfulWithRefresh();
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

    $(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $('#ServiceCompleteForm').submit(function(e){
            e.preventDefault();
            for ( instance in CKEDITOR.instances ) {
                CKEDITOR.instances[instance].updateElement();
            }
            var data = $(this).serialize();
            // var id = $('#HiddenFactoryID').val();
            var url = '{{ route('services.master.solution.save') }}';
            //console.log(data);
            $.ajax({
                url: url,
                method:'POST',
                data:data,
                success:function(data){
                   // console.log(data);
                   // return;
                    if(data === '2')
                    {
                        swalUpdateSuccessfulWithRefresh();
                    }
                    else if(data === '1')
                    {
                        swalInsertSuccessfulWithRefresh();
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

    $(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $('#ServiceCompleteMailForm').submit(function(e){
            e.preventDefault();
            for ( instance in CKEDITOR.instances ) {
                CKEDITOR.instances[instance].updateElement();
            }
            var data = $(this).serialize();
            // var id = $('#HiddenFactoryID').val();
            var url = '{{ route('services.master.solution.send') }}';
            //console.log(data);
            $.ajax({
                url: url,
                method:'POST',
                data:data,
                success:function(data){
                   // console.log(data);
                   // return;
                    if(data === '1')
                    {
                        swal({
                            title: "Successful!",
                            text: "Service Complete Mail Send Successful!",
                            icon: "success",
                            button: "Ok!",
                            className: "myClass",
                        }).then(function (value) {
                            if(value){
                                refresh();
                            }
                        });

                    }
                    else {
                        swal({
                            title: "Un-Successful!",
                            text: "Service Complete Mail Send Un-Successful!",
                            icon: "error",
                            button: "Ok!",
                            className: "myClass",
                        });
                    }
                },
                error:function(error){
                    swalError(error);
                }
            })

        })
    });

    $(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $('#MacBindingRequestEmailForm').submit(function(e){
            e.preventDefault();
            for ( instance in CKEDITOR.instances ) {
                CKEDITOR.instances[instance].updateElement();
            }
            var data = $(this).serialize();
            // var id = $('#HiddenFactoryID').val();
            var url = '{{ route('services.master.mac-binding.send') }}';
            //console.log(data);
            $.ajax({
                url: url,
                method:'POST',
                data:data,
                success:function(data){
                    // console.log(data);
                    // return;
                    if(data === '1')
                    {
                        swal({
                            title: "Successful!",
                            text: "MAC Binding Mail Send Successful!",
                            icon: "success",
                            button: "Ok!",
                            className: "myClass",
                        }).then(function (value) {
                            if(value){
                                refresh();
                            }
                        });

                    }
                    else {
                        swal({
                            title: "Un-Successful!",
                            text: "MAC Binding Mail Send Un-Successful!",
                            icon: "error",
                            button: "Ok!",
                            className: "myClass",
                        });
                    }
                },
                error:function(error){
                    swalError(error);
                }
            })

        })
    });

    $(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $('#NeRequisitionRequestEmailForm').submit(function(e){
            e.preventDefault();
            for ( instance in CKEDITOR.instances ) {
                CKEDITOR.instances[instance].updateElement();
            }
            var data = $(this).serialize();
            var id = $('#HiddenFactoryID').val();
            var url = '{{ route('services.master.requisition-request.send') }}';
            //console.log(data);
            $.ajax({
                url: url,
                method:'POST',
                data:data,
                success:function(data){
                     //console.log(data);
                     //return;
                    if(data === '1')
                    {
                        swal({
                            title: "Successful!",
                            text: "Requisition Request Send Successful!",
                            icon: "success",
                            button: "Ok!",
                            className: "myClass",
                        }).then(function (value) {
                            if(value){
                                refresh();
                            }
                        });

                    }
                    else
                    {
                        swal({
                            title: "Un-Successful!",
                            text: "Requisition Request Send Un-Successful!",
                            icon: "error",
                            button: "Ok!",
                            className: "myClass",
                        });
                    }
                },
                error:function(error){
                    swalError(error);
                }
            })

        })
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
                        if(product_category > 0){
                            $('select[name=product_category]').val(product_category).change();
                        }


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
                if(product_category > 0){
                    $('select[name=product_category]').val(product_category).change();
                }
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
                            if(product_sub_category>0){
                                $('select[name=product_sub_category]').val(product_sub_category).change();
                            }


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
                    if(product_sub_category>0){
                        $('select[name=product_sub_category]').val(product_sub_category).change();
                    }
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
                        if(product_master_id > 0){
                            //console.log(product_master_id);
                            $('select[name=product_master]').val(product_master_id).change();
                        }
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
        if(product_master_id  >0){
            $('select[name=product_master]').val(product_master_id).change();
        }
    }

   /* $(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $('#CheckWarrantyForm').submit(function(e){
            e.preventDefault();
            var data = $(this).serialize();
            var url = '{{ route('settings.product.detail.get-warrant-detail') }}';
            //console.log(data);
            $.ajax({
                url: url,
                method:'POST',
                data:data,
                success:function(data){
                   // console.log(data);
                   // return;
                    if(data.has_data === true){
                        if(data.has_product_missed === true){
                            swal({
                                title: "Product Found!",
                                text: "Received product not matched with database!",
                                icon: "error",
                                button: "Ok!",
                                className: "myClass",
                            });
                        }
                        else{
                            if(data.has_warranty === true){
                                swal({
                                    title: "Product Information Found!",
                                    text: "The product has warranty; you can generate warranty request now!",
                                    icon: "success",
                                    button: "Ok!",
                                }).then(function (value) {
                                    if(value){
                                        refresh();
                                    }
                                });
                            }
                            else{
                                swal({
                                    title: "Product Information Found!",
                                    text: "The product has no warranty; you cannot generate warranty request now!",
                                    icon: "success",
                                    button: "Ok!",
                                }).then(function (value) {
                                    if(value){
                                        refresh();
                                    }
                                });
                            }
                        }

                    }
                    else{
                        swal({
                            title: "No Product Found!",
                            text: "Please Contact With Purchase Desk For Manual Check!",
                            icon: "error",
                            button: "Ok!",
                            className: "myClass",
                        });
                    }
                },
                error:function(error){
                    swalError(error);
                }
            })

        })
    });*/


    $(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $('#CheckWarrantyForm').submit(function(e){
            e.preventDefault();
            for ( instance in CKEDITOR.instances ) {
                CKEDITOR.instances[instance].updateElement();
            }
            var data = $(this).serialize();
            var url = '{{ route('services.master.warranty.check.send') }}';
            //console.log(data);
            $.ajax({
                url: url,
                method:'POST',
                data:data,
                success:function(data){
                    //console.log(data);
                    //return;
                    if(data === '1')
                    {
                        swal({
                            title: "Successful!",
                            text: "Warranty Request Send Successful!",
                            icon: "success",
                            button: "Ok!",
                            className: "myClass",
                        }).then(function (value) {
                            if(value){
                                refresh();
                            }
                        });

                    }
                    else
                    {
                        swal({
                            title: "Un-Successful!",
                            text: "Warranty Request Send Un-Successful!",
                            icon: "error",
                            button: "Ok!",
                            className: "myClass",
                        });
                    }
                },
                error:function(error){
                    swalError(error);
                }
            })

        })
    });

    $('#ServiceMasterTable').on('click',".MakeUnderProcess", function(){
        var button = $(this);
        var id = button.attr("data-id");
        var url = '{{ route('services.master.make-under-process') }}';
        swal({
            title: 'Are you sure?',
            text: 'This service record will be moved to under-process state permanently!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                //window.location.href = url;
                //console.log(id);
                $.ajax({
                    method:'DELETE',
                    url: url,
                    data:{id: id, _token: '{{csrf_token()}}'},
                    success:function(data){
                        if(data === '1'){
                            //console.log(data);
                            swalUpdateSuccessfulWithRefresh();
                        }
                        else if(data === '0'){
                            swalUnSuccessFull();
                        }
                    },
                    error:function(error){
                        //console.log(error);
                        swalError(error);
                    }
                })
            }
        });
    });

    $('#ServiceMasterTable').on('click',".SendForWarranty", function(){
        var button = $(this);
        var id = button.attr("data-id");
        var url = '{{ route('services.master.generate-warranty-request') }}';
        swal({
            title: 'Are you sure?',
            text: 'This service record will be moved to warranty request section!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                //window.location.href = url;
                //console.log(id);
                $.ajax({
                    method:'DELETE',
                    url: url,
                    data:{id: id, _token: '{{csrf_token()}}'},
                    success:function(data){
                        if(data === '1'){
                            //console.log(data);
                            swalUpdateSuccessfulWithRefresh();
                        }
                        else if(data === '0'){
                            swalUnSuccessFull();
                        }
                    },
                    error:function(error){
                        //console.log(error);
                        swalError(error);
                    }
                })
            }
        });
    });

    $('#ServiceMasterTable').on('click',".ProceedWithoutWarranty", function(){
        var button = $(this);
        var id = button.attr("data-id");
        var url = '{{ route('services.master.proceed-without-warranty') }}';
        swal({
            title: 'Are you sure?',
            text: 'This service record can be proceeded without warranty check!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                //window.location.href = url;
                //console.log(id);
                $.ajax({
                    method:'DELETE',
                    url: url,
                    data:{id: id, _token: '{{csrf_token()}}'},
                    success:function(data){
                        console.log(data);
                        if(data === '1'){
                            //console.log(data);
                            swalUpdateSuccessfulWithRefresh();
                        }
                        else if(data === '0'){
                            swalUnSuccessFull();
                        }
                    },
                    error:function(error){
                        console.log(error);
                        swalError(error);
                    }
                })
            }
        });
    });


    $('#ServiceMasterTable').on('click',".DeliveryComplete", function(){
        var button = $(this);
        var id = button.attr("data-id");
        var url = '{{ route('services.master.make-delivery') }}';
        swal({
            title: 'Are you sure?',
            text: 'This service record will be moved to delivery complete state permanently!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                //window.location.href = url;
                //console.log(id);
                $.ajax({
                    method:'DELETE',
                    url: url,
                    data:{id: id, _token: '{{csrf_token()}}'},
                    success:function(data){
                        if(data === '1'){
                            //console.log(data);
                            swalUpdateSuccessfulWithRefresh();
                        }
                        else if(data === '0'){
                            swalUnSuccessFull();
                        }
                    },
                    error:function(error){
                        //console.log(error);
                        swalError(error);
                    }
                })
            }
        });
    });

    $('#ServiceMasterTable').on('click',".ApproveComplete", function(){
        var button = $(this);
        var id = button.attr("data-id");
        var url = '{{ route('services.master.solution.approve') }}';
        swal({
            title: 'Are you sure?',
            text: 'This service complete record will be approved permanently!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                //window.location.href = url;
                //console.log(id);
                $.ajax({
                    method:'DELETE',
                    url: url,
                    data:{id: id, _token: '{{csrf_token()}}'},
                    success:function(data){
                        if(data === '1'){
                            //console.log(data);
                            swalUpdateSuccessfulWithRefresh();
                        }
                        else if(data === '0'){
                            swalUnSuccessFull();
                        }
                    },
                    error:function(error){
                        //console.log(error);
                        swalError(error);
                    }
                })
            }
        });
    });

    $('#UpdateMenus').on('click',".DeleteService", function(){
        var button = $(this);
        var id = button.attr("data-id");
        var url = '{{ route('services.master.delete') }}';
        swal({
            title: 'Are you sure?',
            text: 'This service record will be removed permanently!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                //window.location.href = url;
                //console.log(id);
                $.ajax({
                    method:'DELETE',
                    url: url,
                    data:{id: id, _token: '{{csrf_token()}}'},
                    success:function(data){
                        if(data === '1'){
                            //console.log(data);
                            swalUpdateSuccessfulWithRefresh();
                        }
                        else if(data === '0'){
                            swalUnSuccessFull();
                        }
                    },
                    error:function(error){
                        //console.log(error);
                        swalError(error);
                    }
                })
            }
        });
    });



    function clearServiceMasterForm() {
        clearForm('NewAssignServicePersonForm');
        resetCkeditor('AssignmentDescription');
        resetCkeditor('ClosingDescription');
        resetSelect2();
    }

</script>

