<script>
    $(document).ready(function () {

        var dataTable = $('.PSHTable').DataTable({

        });

        var dataTable = $('.CSHTable').DataTable({

        });

        var dataTable = $('.AITable').DataTable({

        });

        resetSelect2();
         CKEDITOR.replace( 'warranty_email_description',{
                uiColor: '#CCEAEE'
            });

       /* CKEDITOR.replace( 'clearance_description',{
            uiColor: '#CCEAEE'
        });

        CKEDITOR.replace( 'solution_description',{
            uiColor: '#CCEAEE'
        });

        CKEDITOR.replace( 'requisition_email_description',{
            uiColor: '#CCEAEE'
        });

        CKEDITOR.replace( 'service_email_description',{
            uiColor: '#CCEAEE'
        });

        CKEDITOR.replace( 'ReasonOfPurchase',{
            uiColor: '#CCEAEE'
        });

        CKEDITOR.replace( 'ServiceComment',{
            uiColor: '#CCEAEE'
        });*/
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
        $('#AssignVendorForm').submit(function(e){
            e.preventDefault();
            /*for ( instance in CKEDITOR.instances ) {
                CKEDITOR.instances[instance].updateElement();
            }*/
            var data = $(this).serialize();
            //var id = $('#HiddenAssignmentMasterId').val();
            var url = '{{ route('purchase.warranty.detail.assign-vendor') }}';
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
        $('#WarrantyRequestEmailForm').submit(function(e){
            e.preventDefault();
            for ( instance in CKEDITOR.instances ) {
                CKEDITOR.instances[instance].updateElement();
            }
            var data = $(this).serialize();
           // var id = $('#HiddenFactoryID').val();
            var url = '{{ route('purchase.warranty.detail.send-warranty-mail') }}';
            //console.log(data);
            $.ajax({
                url: url,
                method:'POST',
                data:data,
                success:function(data){
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


    $('#ServiceMasterTable').on('click',".SendForWarranty", function(){
        var button = $(this);
        var id = button.attr("data-id");
        var url = '{{ route('purchase.warranty.detail.send-product-vendor') }}';
        swal({
            title: 'Are you sure?',
            text: 'This warranty record will be moved to product delivered to vendor for warranty service state permanently!',
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

    $('#ServiceMasterTable').on('click',".ReceiveProductFromWarranty", function(){
        var button = $(this);
        var id = button.attr("data-id");
        var url = '{{ route('purchase.warranty.detail.receive-product-vendor') }}';
        swal({
            title: 'Are you sure?',
            text: 'This warranty record will be moved to product received from vendor after warranty service state permanently!',
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

    $('#ServiceMasterTable').on('click',".SendProductToService", function(){
        var button = $(this);
        var id = button.attr("data-id");
        var url = '{{ route('purchase.warranty.detail.send-product-service') }}';
        swal({
            title: 'Are you sure?',
            text: 'This warranty record will be moved to product send to service desk after vendor warranty service state permanently!',
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




   /* $('#ServiceMasterTable').on('click',".MakeUnderProcess", function(){
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
    });*/

    function clearServiceMasterForm() {
        //clearForm('NewAssignServicePersonForm');
        //resetCkeditor('AssignmentDescription');
        //resetCkeditor('ClosingDescription');
        resetSelect2();
    }

</script>

