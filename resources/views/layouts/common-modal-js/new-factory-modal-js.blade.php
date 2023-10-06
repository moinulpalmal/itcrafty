<script>
    $(document).ready(function () {
        getFactoryList();
        resetSelect2();
    });
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
    $(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $('#NewFactoryForm').submit(function(e){
            e.preventDefault();
            var data = $(this).serialize();
            var id = $('#HiddenNewDesignationID').val();
            var url = '{{ route('settings.factory.setup.save') }}';
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
                        swalInsertSuccessFullWithClearModalForm('NewFactoryForm', '#NewFactory');
                        getFactoryList();
                        clearNewFactoryCheckBox();
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

