<script>
    $(document).ready(function () {
        getManufacturerList();
        resetSelect2();
    });
    function getManufacturerList(){
        var check = 1;
        var url = '{{ route('settings.product.manufacturer.drop-down-list') }}';
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
                    defaultValue = "- - - Select Manufacturer - - -";
                    $('select[id= "Manufacturer"]').empty();

                    $('select[id= "Manufacturer"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
                    $.each(data, function(key,value){
                        //console.log(data);
                        $('select[id= "Manufacturer"]').append('<option value="'+ value +'">'+ key +'</option>');
                    });
                    //$('#YarnCountName').trigger('chosen:updated');
                    resetSelect2();
                }
            });
        }
        else{
            defaultKey = "";
            defaultValue = "- - - Select Manufacturer - - -";

            $('select[id= "Manufacturer"]').empty();
            $('select[id= "Manufacturer"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
            resetSelect2();
        }
    }
    $(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $('#NewManufacturerForm').submit(function(e){
            e.preventDefault();
            var data = $(this).serialize();
            var id = $('#HiddenNewManufacturerID').val();
            var url = '{{ route('settings.product.manufacturer.save') }}';
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
                        swalInsertSuccessFullWithClearModalForm('NewManufacturerForm', '#NewManufacturer');
                        getManufacturerList();
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

