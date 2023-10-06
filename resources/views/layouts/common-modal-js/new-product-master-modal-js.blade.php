<script>
    $(document).ready(function () {
       // getDesignationList();
        resetSelect2();
    });


    $(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $('#NewProductMasterForm').submit(function(e){
            e.preventDefault();
            var data = $(this).serialize();
            var id = $('#HiddenNewFactoryID').val();
            var url = '{{ route('settings.product.master.save') }}';
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
                        swalInsertSuccessFullWithClearModalForm('NewProductMasterForm', '#NewProductMaster');
                        $('input[name=has_warranty]').prop('checked', false);
                        $('input[name=has_sl_no]').prop('checked', false);
                        getProductMasterList();
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
</script>

