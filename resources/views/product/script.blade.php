<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script type="text/javascript">
    function addAttributes(name, value = '')
    {
        $('.product_attributes').append(
            $('<div></div>').attr('class', 'col-md-12')
            .append(
                $('<div></div>').attr('class', 'form-group')
                .append(
                    $('<strong></strong>').html(name)
                )
                .append(
                    $('<input>')
                        .attr('type','text')
                        .attr('name', name.toLowerCase().replace(' ', '_'))
                        .attr('class', 'form-control')
                        .attr('value', value)
                        .attr('required', 'required')
                        .attr('style', 'margin-bottom: 10px;')
                )
            )
        );
    }
    var id;
    $(document).ready(function(){
        var productTbl = $('#productTable').DataTable({
            "responsive": true,
            "lengthMenu": [[25, 50, 100, 500, -1], [25, 50, 100, 500, "All"]],
            "pageLength": 100,
            "columnDefs": [  { targets: 'no-sort', orderable: false }],
            "order": [0, 'asc'],
        });

        $('.addEditProductBtn').on('click', function(){
            id = $(this).attr('data-id');
        });

        $('#editProduct').on('shown.bs.modal', function (e) {
            var currentHref = $('form[name="product_form"]').attr('action')
            var newHref = currentHref.replace(":id", id);
            $('form[name="product_form"]').attr('action', newHref)
            var requestDataHref = $('form[name="product_form"]').attr('action').replace("edit/"+id, "edit/"+id+'/html')
            $.get(requestDataHref, function(data){
                response = JSON.parse(data);
                if(response.data){
                    $('#editProduct input[name="name"]').val(response.data.name)
                    $('#editProduct input[name="code"]').val(response.data.code)
                    $('#editProduct input[name="base_currency_value"]').val(response.data.base_currency_value)
                    $('#editProduct input[name="base_currency_tax_value"]').val(response.data.base_currency_tax_value)
                    $("#editProduct select[name='product_category_id']").val(response.data.product_category_id)
                    $('#editProduct .product_attributes').empty();
                    $.each(response.data.attributes, function (key, entry) {
                        addAttributes(key, entry);
                    })
                }
            })
        });

        $('#editProduct').on('hidden.bs.modal', function (e) {
            var resetHref = $('form[name="product_form"]').attr('action').replace('edit/'+id, "edit/:id")
            $('form[name="product_form"]').attr('action', resetHref)
        })

        $('select[name="product_category_id"]').on('change', function() {
            pcId = $('select[name="product_category_id"] option:selected').val();
            $('.product_attributes').empty();
            var requestDataHref = $('form[name="product_form"]').attr('action').replace("edit/"+id, "edit/"+id+'/getAttributes/'+pcId)
            $.getJSON(requestDataHref, function( jsonData ) {
                $.each(jsonData.data, function (key, entry) {
                    addAttributes(entry);
                })
            });   
        });
    })
</script>