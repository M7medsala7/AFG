<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/css/bootstrap.min.css" />
<!--<link rel="stylesheet" href="css/bootstrap-rtl.css" />-->
<link rel="stylesheet" href="/css/style.css" />
<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
<link rel="icon" href="/images/favicon.png" type="image/png">

<title>Maid & Helper</title>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/slick.min.js"></script>
<script type="text/javascript" src="/js/count-number.js"></script>
<script type="text/javascript" src="/js/jquery.canvasjs.min.js"></script>
<script type="text/javascript" src="/js/script.js"></script>

</head>
<body>

@include('Layout.header')

@yield('content')


@include('Layout.footer')

</body>
@yield('scripts')
</html>
