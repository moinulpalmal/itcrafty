<script>
    $(document).ready(function () {
       // getFactoryList();
        resetSelect2();
    });
    $(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $('#NewCustomerForm').submit(function(e){
            e.preventDefault();
            /* for ( instance in CKEDITOR.instances ) {
                 CKEDITOR.instances[instance].updateElement();
             }*/
            var data = $(this).serialize();
            var id = $('#HiddenFactoryID').val();
            var url = '{{ route('settings.employee.save') }}';
            //console.log(data);
            $.ajax({
                url: url,
                method:'POST',
                data:data,
                success:function(data){
                    if(data === '2')
                    {
                        swalUpdateSuccessfulWithRefresh();
                    }
                    else if(data === '1')
                    {
                        swalInsertSuccessFullWithClearModalForm('NewCustomerForm', '#NewCustomer');
                        getCustomerList();
                        //clearNewFactoryCheckBox();
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

