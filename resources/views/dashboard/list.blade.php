@extends('layouts.master')
@section('content')
@include('dashboard.sidebar')
<?php

use App\Models\Product;
use App\Models\ProductCategory;

$productCategories = ProductCategory::count();
$products = Product::count();
  
?>
<link rel="stylesheet" href="{{URL::to('assets/css/style.css')}}">
<main class="col bg-faded py-3 flex-grow-1">
    <h3>Dashboard</h3>
    <br>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    <h2 class="card-title">{{$productCategories}}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Products</div>
                <div class="card-body">
                    <h2 class="card-title">{{$products}}</h2>
                </div>
            </div>
        </div>
    </div>
    
</main>
@endsection