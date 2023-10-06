<script>
    $(document).ready(function () {
        getDesignationList();
        resetSelect2();
    });

    function getDesignationList(){
        var check = 1;

        var url = '{{ route('settings.designation.drop-down-list') }}';
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
                    defaultValue = "- - - Select Designation - - -";
                    $('select[id= "Designation"]').empty();

                    $('select[id= "Designation"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
                    $.each(data, function(key,value){
                        //console.log(data);
                        $('select[id= "Designation"]').append('<option value="'+ value +'">'+ key +'</option>');
                    });
                    //$('#YarnCountName').trigger('chosen:updated');
                    resetSelect2();
                }
            });
        }
        else{
            defaultKey = "";
            defaultValue = "- - - Select Designation - - -";

            $('select[id= "Designation"]').empty();
            $('select[id= "Designation"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');
            resetSelect2();
        }
    }
    $(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $('#NewDesignationForm').submit(function(e){
            e.preventDefault();
            var data = $(this).serialize();
            var id = $('#HiddenNewFactoryID').val();
            var url = '{{ route('settings.designation.save') }}';
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
                        swalInsertSuccessFullWithClearModalForm('NewDesignationForm', '#NewDesignation');
                        getDesignationList();
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

