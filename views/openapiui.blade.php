<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<meta name="robots" content="noindex,nofollow">
	<meta name="format-detection" content="telephone=no">

	<meta name="author" content="Bernd Bestel (bernd@berrnd.de)">
	<link rel="icon" type="image/png" sizes="200x200" href="{{ $U('/img/grocy.png?v=', true) }}{{ $version }}">

	<title>{{ $L('REST API & data model documentation') }} | grocy</title>

	<link href="{{ $U('/bower_components/swagger-ui/dist/swagger-ui.css?v=', true) }}{{ $version }}" rel="stylesheet">

	<script>
		var Grocy = { };
		Grocy.OpenApi = { };
		Grocy.OpenApi.SpecUrl = '{{ $U('/api/get-openapi-specification') }}';
	</script>
</head>

<body>
	<div id="swagger-ui"></div>

	<script src="{{ $U('/bower_components/swagger-ui/dist/swagger-ui-bundle.js?v=', true) }}{{ $version }}"></script>
	<script src="{{ $U('/bower_components/swagger-ui/dist/swagger-ui-standalone-preset.js?v=', true) }}{{ $version }}"></script>
	<script src="{{ $U('/viewjs', true) }}/openapiui.js?v={{ $version }}"></script>

	@if(file_exists(__DIR__ . '/../../data/add_before_end_body.html'))
		@php include __DIR__ . '/../../data/add_before_end_body.html' @endphp
	@endif
</body>
</html>
