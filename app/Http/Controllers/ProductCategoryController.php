<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    public static function list_()
    {
        $productCategories = ProductCategory::all();
        return view('product_category.list', compact('productCategories'));
    }

    public function edit($id, $argument = null)
    {
        if($id == 0){
            $productCategory = new ProductCategory();
        } else {
            $productCategory = ProductCategory::find($id);
            if(!isset($productCategory)){
                return redirect()->route('product_category.list')->with('error','No product category found');
            }
        }
        if(isset($argument) && $argument == 'html'){
            $productCategory->attributes = json_decode($productCategory->attributes, true);
            echo json_encode(array(
                'data' => $productCategory,
            ));
            exit();
        }
        if(isset($_POST['name'])){
            $productCategory->name = $_POST['name'];
            $productCategory->attributes = isset($_POST['attributes']) && !empty($_POST['attributes']) ? json_encode(array_filter($_POST['attributes'])) : null;
            if($productCategory->save()){
                return redirect()->route('product_category.list')->with('success','Modifications successfully made');
            }
        }
        return redirect()->route('product_category.list')->with('error','No modifications were made');
    }

    public function delete($id)
    {
        $productCategory = ProductCategory::find($id);
        if(!isset($productCategory)){
            return redirect()->route('product_category.list')->with('error','No product category found');
        }
        if(!$productCategory->products->isEmpty()){
            return redirect()->route('product_category.list')->with('error','Product category has active products and cannot be deleted');
        }
        if($productCategory->delete()){
            return redirect()->route('product_category.list')->with('success','Product category successfully deleted');
        }
    }
}
