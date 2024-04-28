<form action="{{route('product_category.edit', ['id' => ':id'])}}" method="post" name="product_category_form">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="editProductCategory" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Add/edit product category') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>{{ __('Name') }}:</strong>
                            <input type="text" name="name" class="form-control" value="" placeholder="Category name" required/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group attribute_area">
                            <a href="#" id="addMultipleAttributes" title="Add multiple date"><i class="fa fa-plus-square"></i></a>
                            <strong>{{ __('Attributes') }}:</strong>
                            <input type="text" name="attributes[]" class="form-control" value="" placeholder="Attribute name" style="margin-bottom: 10px;"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>