@extends('layout.default')

@if($mode == 'edit')
	@section('title', $L('Edit habit'))
@else
	@section('title', $L('Create habit'))
@endif

@section('viewJsName', 'habitform')

@section('content')
<div class="col-lg-4 col-xs-12">
	<h1 class="page-header">@yield('title')</h1>

	<script>Grocy.EditMode = '{{ $mode }}';</script>

	@if($mode == 'edit')
		<script>Grocy.EditObjectId = {{ $habit->id }};</script>
	@endif

	<form id="habit-form">

		<div class="form-group">
			<label for="name">{{ $L('Name') }}</label>
			<input type="text" class="form-control" required id="name" name="name" value="@if($mode == 'edit'){{ $habit->name }}@endif">
			<div class="help-block with-errors"></div>
		</div>

		<div class="form-group">
			<label for="description">{{ $L('Description') }}</label>
			<textarea class="form-control" rows="2" id="description" name="description">@if($mode == 'edit'){{ $habit->description }}@endif</textarea>
		</div>

		<div class="form-group">
			<label for="period_type">{{ $L('Period type') }}</label>
			<select required class="form-control input-group-habit-period-type" id="period_type" name="period_type">
				@foreach($periodTypes as $periodType)
					<option @if($mode == 'edit' && $periodType == $habit->period_type) selected="selected" @endif value="{{ $periodType }}">{{ $L($periodType) }}</option>
				@endforeach
			</select>
			<div class="help-block with-errors"></div>
		</div>

		<div class="form-group">
			<label for="period_days">{{ $L('Period days') }}</label>
			<input type="number" class="form-control input-group-habit-period-type" id="period_days" name="period_days" value="@if($mode == 'edit'){{ $habit->period_days }}@endif">
			<div class="help-block with-errors"></div>
		</div>

		<p id="habit-period-type-info" class="help-block text-muted"></p>

		<button id="save-habit-button" type="submit" class="btn btn-default">{{ $L('Save') }}</button>

	</form>
</div>
@stop
