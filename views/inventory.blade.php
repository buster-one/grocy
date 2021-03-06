@extends('layout.default')

@section('title', $L('Inventory'))
@section('activeNav', 'inventory')
@section('viewJsName', 'inventory')

@section('content')
<div class="col-lg-4 col-xs-12">
	<h1 class="page-header">@yield('title')</h1>

	<form id="inventory-form">

		<div class="form-group">
			<label for="product_id">{{ $L('Product') }}&nbsp;&nbsp;<i class="fa fa-barcode"></i><span id="barcode-lookup-disabled-hint" class="small text-muted hide">&nbsp;&nbsp;{{ $L('Barcode lookup is disabled') }}</span></label>
			<select class="form-control combobox" id="product_id" name="product_id" required>
				<option value=""></option>
				@foreach($products as $product)
					<option data-additional-searchdata="{{ $product->barcode }}" value="{{ $product->id }}">{{ $product->name }}</option>
				@endforeach
			</select>
			<div class="help-block with-errors"></div>
			<div id="flow-info-addbarcodetoselection" class="text-muted small hide"><strong><span id="addbarcodetoselection"></span></strong> {{ $L('will be added to the list of barcodes for the selected product on submit') }}</div>
		</div>

		<div class="form-group">
			<label for="new_amount">{{ $L('New amount') }}&nbsp;&nbsp;<span id="new_amount_qu_unit" class="small text-muted"></span></label>
			<input type="number" data-notequal="notequal" class="form-control" id="new_amount" name="new_amount" min="0" not-equal="-1" required>
			<div class="help-block with-errors"></div>
			<div id="inventory-change-info" class="help-block text-muted"></div>
		</div>

		@include('components.datepicker', array(
			'id' => 'best_before_date',
			'label' => 'Best before',
			'hint' => 'This will apply to added products'
		))

		<button id="save-inventory-button" type="submit" class="btn btn-default">{{ $L('OK') }}</button>

	</form>
</div>

<div class="col-lg-4 col-xs-12">
	@include('components.productcard')
</div>
@stop
