@extends('layouts.master')
@section('content')
@include('product.sidebar')
@include('product.modal.edit')
<?php

use App\Models\ExchangeRate;
use Carbon\Carbon;

$errorForFetchingExchangeRate = false;
$exchangeRate = ExchangeRate::where('currency', ExchangeRate::CURRENCY_EUR)->where('date', Carbon::now()->format('Y-m-d'))->first();
if(!isset($exchangeRate)){
	$errorForFetchingExchangeRate = true;
}
  
?>
<main class="col bg-faded py-3 flex-grow-1">
    <h3><a href="#" class="addEditProductBtn" data-target="#editProduct" data-toggle="modal" data-id="0"><i class="fa fa-plus-square"></i></a> Products</h3>
    <br>
	

	{{-- <table> --}}
	<div>
        {{-- success --}}
        @if(\Session::has('success'))
        <div id="insert" class=" alert alert-success">
            {!! \Session::get('success') !!}
        </div>
        @endif

        {{-- error --}}
        @if(\Session::has('error'))
            <div id="error" class=" alert alert-danger">
                {!! \Session::get('error') !!}
            </div>
        @endif

		{{-- search --}}
		
		<div class="container-fluid">
			<div class="card text-white bg-success" style="margin-bottom: 10px;">
				@if($errorForFetchingExchangeRate)
					<h6 class="card-header">No exchange rate found !</h6>
				@else
					<h6 class="card-header">Exchange rate from ({{$exchangeRate->date}}) has value {{$exchangeRate->value}} for {{$exchangeRate->currency}}</h6>
				@endif
			</div>
			<table id="productTable" class="table table-striped table-bordered nowrap" style="width:100%">
				<thead>
					
					<tr>
						<th>Code</th>
						<th>Name</th>
						<th>Category name</th>
						<th>Value in EUR</th>
						<th>Gross value in EUR</th>
						<th>Value in RON</th>
						<th>Gross value in RON</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($products as $value)
					<tr>
						<td class="code">{{ $value->code }}</td>
						<td class="name" title="{{ implode(', ', $value->attributes) }}">{{ $value->name }}</td>
						<td class="category_name">{{ $value->category->name }}</td>
						<td class="value">{{ !$errorForFetchingExchangeRate ? $value->base_currency_value * $exchangeRate->value : ''}}</td>
						<td class="gross_value">{{ !$errorForFetchingExchangeRate ? ($value->base_currency_value * $exchangeRate->value) + ($value->base_currency_tax_value * $exchangeRate->value) : ''}}</td>
						<td class="base_value">{{ $value->base_currency_value }}</td>
						<td class="gross_base_value">{{ $value->base_currency_value + $value->base_currency_tax_value }}</td>
						<td class=" text-center">
							<a class="m-r-15 text-muted addEditProductBtn" data-target="#editProduct" data-toggle="modal" data-id="{{ $value->id }}">
								<i class="fa fa-edit fa-lg"></i>
							</a>
							<a href="{{route('product.delete', ['id' => $value->id])}}" onclick="return confirm('Are you sure to want to delete it?')">
								<i class="fa fa-trash fa-lg"></i>
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	{{-- </table> --}}   
</main>
@endsection
@push('scripts')
      @include('product.script')
@endpush