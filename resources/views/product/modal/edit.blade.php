<?php

use App\Models\ProductCategory;

$productCategories = ProductCategory::get();
?>
<form action="{{route('product.edit', ['id' => ':id'])}}" method="post" name="product_form">
    {{ csrf_field() }}
    <div class="modal fade text-left" id="editProduct" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Add/edit product') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>{{ __('Name') }}:</strong>
                                <input type="text" name="name" class="form-control" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>{{ __('Code') }}:</strong>
                                <input type="text" name="code" class="form-control" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>{{ __('Base currency value') }}:</strong>
                                <input type="text" name="base_currency_value" class="form-control" value=""/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>{{ __('Base currency tax value') }}:</strong>
                                <input type="text" name="base_currency_tax_value" class="form-control" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>{{ __('Product category') }}:</strong>
                                <select name="product_category_id" class="form-control" required>
                                    <option value="0"></option>
                                    @foreach($productCategories as $pc)
                                        <option value="{{$pc->id}}">{{$pc->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <strong><i>{{ __('Attributes') }}:</i></strong>
                        </div>
                    </div>
                    <div class="product_attributes"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>