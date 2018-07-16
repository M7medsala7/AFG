<!doctype html>
<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1">
@yield('share')


 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="/css/bootstrap.min.css" />
<link rel="stylesheet" href="/css/style.css" />
<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
<link rel="icon" href="/images/favicon.png" type="image/png">
<link href="/node_modules/video.js/dist/video-js.min.css" rel="stylesheet">
  <link href="/node_modules/videojs-record/dist/css/videojs.record.css" rel="stylesheet">



<link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.min.css" rel="stylesheet"/>
 
 <link rel="stylesheet" href="/css/bootstrap-select.min.css">

<title>Maid & Helper</title>
<script type="text/javascript" src="/js/jquery.js"></script>

<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/js/count-number.js"></script>
<script type="text/javascript" src="/js/jquery.canvasjs.min.js"></script>

<script type="text/javascript" src="/js/script.js"></script>
<script src="/node_modules/video.js/dist/video.min.js"></script>
  <script src="/node_modules/recordrtc/RecordRTC.js"></script>
  <script src="/node_modules/webrtc-adapter/out/adapter.js"></script>
   
<script type="text/javascript" src="/js/chosen.jquery.min.js"></script>

  <script src="/node_modules/videojs-record/dist/videojs.record.js"></script>



  <meta name="csrf-token" content="{{ csrf_token() }}">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
 
<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>

</head>
<body>

@include('Layout.header_1')

<!--//container-->
 @yield('content')
<!--//container-->

@include('Layout.footer')

</body>
@yield('scripts')
</html>
