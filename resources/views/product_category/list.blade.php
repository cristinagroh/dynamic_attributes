@extends('layouts.master')
@section('content')
@include('product_category.sidebar')
@include('product_category.modal.edit')
<main id="main" class="col bg-faded py-3 flex-grow-1">
	<h3><a href="#" class="addEditCategoryBtn" data-target="#editProductCategory" data-toggle="modal" data-id="0"><i class="fa fa-plus-square"></i></a> Product categories</h3>
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
		<div class="container-fluid">
			<table id="productCategoryTable" class="table table-striped table-bordered nowrap" style="width:100%">
				<thead>
					
					<tr>
						<th>Name</th>
						<th>Attributes</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($productCategories as $value)
					<tr>
						<td class="name">{{ $value->name }}</td>
						<td class="attributes">{{ isset($value->attributes) ? implode(', ', json_decode($value->attributes, true)) : '' }}</td>
						<td class=" text-center">
							<a class="m-r-15 text-muted addEditCategoryBtn" data-target="#editProductCategory" data-toggle="modal" data-id="{{ $value->id }}">
								<i class="fa fa-edit fa-lg"></i>
							</a>
							<a href="{{route('product_category.delete', ['id' => $value->id])}}" onclick="return confirm('Are you sure to want to delete it?')">
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
      @include('product_category.script')
@endpush