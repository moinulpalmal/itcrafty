<script>
    $(document).ready(function () {
        getFactoryList();
        getDepartmentList();
        getProductCategoryList();
        resetSelect2();

    });

    function resetSelect2() {
        $(".select2").select2({
            dropdownAutoWidth: true,
            width: '100%'
        });
    }

    let has_data_table = true;
    var dataTable = $('.social-media').DataTable({
        dom: 'Bfrtip',
        pagingType: 'full_numbers',
        className: 'my-1',
        lengthMenu: [
            [ 10, 25, 50, 100, -1 ],
            [ '10 rows', '25 rows', '50 rows', '100 rows', 'Show all' ]
        ],
        order: [[1, "desc"]],
        buttons: [
            {
                extend: 'copyHtml5',
                fieldSeparator: '\t',
                extension: '.tsv',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'pdfHtml5',
                orientation: 'portrait',
                pageSize: 'A4',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                },
                customize: function(win)
                {
                    var css = '@page { size: landscape; }',
                        head = win.document.head || win.document.getElementsByTagName('head')[0],
                        style = win.document.createElement('style');

                    style.type = 'text/css';
                    style.media = 'print';

                    if (style.styleSheet)
                    {
                        style.styleSheet.cssText = css;
                    }
                    else
                    {
                        style.appendChild(win.document.createTextNode(css));
                    }

                    head.appendChild(style);
                }
            },
            'colvis',
            'pageLength'
        ]
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

                       /* $('select[id= "ProductMaster"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');*/
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
            /*$('select[id= "ProductMaster"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');*/
            resetSelect2();
        }
        defaultKey = "";
        defaultValue = "- - - Select Product - - -";
        $('select[id= "ProductMaster"]').empty();
       /* $('select[id= "ProductMaster"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');*/
        resetSelect2();
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

                   /* $('select[id= "Factory"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');*/
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
           /* $('select[id= "Factory"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');*/
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

                    /*$('select[id= "Department"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');*/
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
           /* $('select[id= "Department"]').append('<option value="'+ defaultKey +'">'+ defaultValue +'</option>');*/
            resetSelect2();
        }
    }


    $(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $('#WorkExperienceForm').submit(function(e){
            e.preventDefault();
            //console.log('Hit');
            var data = $(this).serialize();
            if(has_data_table){
                dataTable.destroy();
            }
            var free_table = '<tr><td class="text-center" colspan="15">--- Please Wait... Loading Data  ---</td></tr>';
            $('tbody').html(free_table);

            var url = '{{ route('services.search.product.result') }}';
            //console.log(data);
            $.ajax({
                url: url,
                method:'POST',
                data:data,
                dataType: "json",
                success:function(data){
                    if(data === '0'){
                        //dataTable.destroy();
                        //console.log('0');
                        free_table = '<tr><td class="text-center" colspan="15">--- No Data Found ---</td></tr>';
                        $('tbody').html(free_table);
                        has_data_table = false;

                    }
                    else{
                        //console.log('has data');
                        $('tbody').html(data.table_data);
                        dataTable = $('.social-media').DataTable({
                            dom: 'Bfrtip',
                            pagingType: 'full_numbers',
                            className: 'my-1',
                            lengthMenu: [
                                [ 10, 25, 50, 100, -1 ],
                                [ '10 rows', '25 rows', '50 rows', '100 rows', 'Show all' ]
                            ],
                            order: [[1, "desc"]],
                            buttons: [
                                {
                                    extend: 'copyHtml5',
                                    fieldSeparator: '\t',
                                    extension: '.tsv',
                                    exportOptions: {
                                        columns: [ 0, ':visible' ]
                                    }
                                },
                                {
                                    extend: 'excelHtml5',
                                    exportOptions: {
                                        columns: [ 0, ':visible' ]
                                    }
                                },
                                {
                                    extend: 'csvHtml5',
                                    exportOptions: {
                                        columns: [ 0, ':visible' ]
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    orientation: 'portrait',
                                    pageSize: 'A4',
                                    exportOptions: {
                                        columns: [ 0, ':visible' ]
                                    }
                                },
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: [ 0, ':visible' ]
                                    },
                                    customize: function(win)
                                    {
                                        var css = '@page { size: landscape; }',
                                            head = win.document.head || win.document.getElementsByTagName('head')[0],
                                            style = win.document.createElement('style');

                                        style.type = 'text/css';
                                        style.media = 'print';

                                        if (style.styleSheet)
                                        {
                                            style.styleSheet.cssText = css;
                                        }
                                        else
                                        {
                                            style.appendChild(win.document.createTextNode(css));
                                        }

                                        head.appendChild(style);
                                    }
                                },
                                'colvis',
                                'pageLength'
                            ]
                        });
                        has_data_table = true;
                    }
                },
                error:function(error){
                    //console.log('error');
                    free_table = '<tr><td class="text-center" colspan="15">--- No Data Found ---</td></tr>';
                    $('tbody').html(free_table);
                    has_data_table = false;
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
        resetSelect2();
        dataTable.destroy();
        var free_table = '<tr><td class="text-center" colspan="15">--- No Data ----</td></tr>';
        $('tbody').html(free_table);
        has_data_table = false;
        resetSelect2();
    }

    $('#social-media-table').on('click',".PrintView", function(){
        var button = $(this);
        var FactoryID = button.attr("data-id");

        var url = '{{ route('services.master.detail', ['id' =>  'pid']) }}';
        url = url.replace('pid', FactoryID);
        window.open(url, "_blank");
        //document.location.href = url;

    });

</script>

