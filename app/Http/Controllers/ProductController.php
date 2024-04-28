<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    //
    public function list_()
    {
        $products = Product::all();
        foreach($products as $product){
            $product->attributes = json_decode($product->attributes, true);
        }
        return view('product.list', compact('products'));
    }

    public function edit($id, $argument = null, $productCategoryId = null)
    {
        if($id == 0){
            $product = new Product();
        } else {
            $product = Product::find($id);
            if(!isset($product)){
                return redirect()->route('product.list')->with('error','No product found');
            }
        }
        switch($argument){
            case 'html':
                $product->attributes = json_decode($product->attributes, true);
                echo json_encode(array(
                    'data' => $product,
                ));
                exit();
            break;
            case 'getAttributes':
                $attributes = [];
                if(isset($productCategoryId)){
                    $productCategory = ProductCategory::find($productCategoryId);
                    $attributes = isset($productCategory, $productCategory->attributes) ? json_decode($productCategory->attributes, true) : [];
                }
                echo json_encode(array(
                    'data' => $attributes,
                ));
                exit;
            break;
        }
        if(isset($_POST['name'], $_POST['code'], $_POST['base_currency_value'], $_POST['base_currency_tax_value'], $_POST['product_category_id'])){
            $productCategory = ProductCategory::find($_POST['product_category_id']);
            if(!isset($productCategory)){
                return redirect()->route('product.list')->with('error','Product category not found');
            }
            $product->name = $_POST['name'];
            $product->product_category_id = $productCategory->id;
            $product->code = $_POST['code'];
            $product->base_currency_value = $_POST['base_currency_value'];
            $product->base_currency_tax_value = $_POST['base_currency_tax_value'];
            $attributes = [];
            foreach(json_decode($productCategory->attributes, true) as $attribute){
                if(isset($_POST[str_replace('','_', strtolower($attribute))])){
                    $attributes[$attribute] = $_POST[str_replace('','_', strtolower($attribute))];
                }
            }
            $product->attributes = json_encode($attributes);
            if($product->save()){
                return redirect()->route('product.list')->with('success','Modifications successfully made');
            }
        }
        return redirect()->route('product.list')->with('error','No modifications were made');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if(!isset($product)){
            return redirect()->route('product.list')->with('error','No product found');
        }
        if($product->delete()){
            return redirect()->route('product.list')->with('success','Product successfully deleted');
        }
    }
}
