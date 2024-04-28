<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script type="text/javascript">
    function removeElement(element){
        element.closest(".input-group").remove();
    }
    function appendElement(value = '', allowRemove = true){
        var removeEl = '';
        if(allowRemove){
            removeEl = $('<span></span>').attr('class', 'input-group-btn')
            .append(
                $('<button></button>')
                    .attr('class', 'btn btn-flat btn-default removeAttr')
                    .attr('type', 'button')
                    .on('click', function(){
                        removeElement($(this));
                    })
                    .append(
                        $('<i></i>')
                            .attr('class', 'fa fa-remove')
                    )
            );
        }
        $('.attribute_area').append(
            $('<div></div>').attr('class', 'input-group')
            .append(
                $('<input>')
                    .attr('type','text')
                    .attr('name', 'attributes[]')
                    .attr('placeholder', 'Attribute name')
                    .attr('class', 'form-control')
                    .attr('value', value)
                    .attr('style', 'margin-bottom: 10px;')
            ).append(removeEl)
        );
    }
    var id;
    $(document).ready(function(){
        var productCategoryTbl = $('#productCategoryTable').DataTable({
            "responsive": true,
            "lengthMenu": [[25, 50, 100, 500, -1], [25, 50, 100, 500, "All"]],
            "pageLength": 100,
            "columnDefs": [  { targets: 'no-sort', orderable: false }],
            "order": [0, 'asc'],
        });

        $('#editProductCategory').on('shown.bs.modal', function (e) {
            id = $(e.relatedTarget).attr('data-id');
            var currentHref = $('form[name="product_category_form"]').attr('action')
            var newHref = currentHref.replace(":id", id);
            $('form[name="product_category_form"]').attr('action', newHref)
            var requestDataHref = $('form[name="product_category_form"]').attr('action').replace("edit/"+id, "edit/"+id+'/html')
            $.get(requestDataHref, function(data){
                response = JSON.parse(data);
                if(response.data){
                    $('#editProductCategory input[name="name"]').val(response.data.name)
                    $('#editProductCategory input[name="attributes[]"]').remove();
                    $('#editProductCategory .input-group').remove();
                    if(response.data.attributes && response.data.attributes.length > 0){
                        $.each(response.data.attributes, function (key, entry) {
                            if(key == 0){
                                appendElement(entry, false);
                            } else {
                                appendElement(entry);
                            }
                        })
                    } else{
                        appendElement('', false);
                    }
                }
            })
        });

        $('#editProductCategory').on('hidden.bs.modal', function (e) {
            var resetHref = $('form[name="product_category_form"]').attr('action').replace('edit/'+id, "edit/:id")
            $('form[name="product_category_form"]').attr('action', resetHref)
        })

        $('#addMultipleAttributes').on('click', function(){
            appendElement();
        })
    })
</script>