<!doctype html>
<html>
<head>
	  


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">




<link rel="stylesheet" href="/css/bootstrap.min.css" />
<!--<link rel="stylesheet" href="css/bootstrap-rtl.css" />-->
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">




<link href="/css/bootstrap-formhelpers-countries.flags.css" rel="stylesheet">
<link rel="stylesheet" href="/css/chosen.min.css" />
<link rel="stylesheet" href="/css/bootstrap-select.min.css">
<link rel="icon" href="images/favicon.png" type="image/png">
<link href="http://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.min.css" rel="stylesheet"/>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>

<script type="text/javascript" src="/js/count-number.js"></script>
<script type="text/javascript" src="/js/jquery.canvasjs.min.js"></script>
<script type="text/javascript" src="/js/moment.js"></script>

<script type="text/javascript" src="/js/bootstrap-select.min.js"></script>
<script src="/js/bootstrap-formhelpers-countries.en_US.js"></script>
<script src="/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="/js/script.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>

<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.min.js" type="text/javascript"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>

<title>Maid & Helper</title>




</head>
<body>

@include('Layout.header')

@yield('content')


@include('Layout.footer')

</body>
@yield('scripts')
</html>