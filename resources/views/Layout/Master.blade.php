<!doctype html>
<html prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# video: http://ogp.me/ns/video#">
<meta property="og:type" content="website" />

     <title>Maid and helper</title>


     <meta name="keywords" content="app, name" />


     <meta name="description" content="Page Description" />


     <!-- FACEBOOK -->


     <meta property="fb:app_id"   content="482712415572430"/>


     <meta property="og:site_name" content="Maid & Helper">


     <meta property="og:url" content="https://www.maidandhelper.com" />


     <meta property="og:title" content="Maid & Helper" />


     <meta property="og:image" content="https://www.maidandhelper.com/images/slide5.jpg" />


   
     <meta property="og:description" content="CANDIDATES & EMPLOYERS WELL CONNECTED HERE" />



     


    <meta property="og:video" content="https://dih1l34ei3029.cloudfront.net/56275703/audiogram.mp4">

<meta property="og:video:secure_url" content="https://dih1l34ei3029.cloudfront.net/56275703/audiogram.mp4">


   
<meta property="og:video:type" content="video">
<meta property="og:video:width" content="300">
<meta property="og:video:height" content="300">


    <!-- FACEBOOK -->


 @if(Session::get('locale')=="Ar"|| Session::get('locale')=="ar")
{{App::setLocale('ar')}}
<link rel="stylesheet" href="/ar/css/bootstrap.min.css" />
<link rel="stylesheet" href="/ar/css/bootstrap-rtl.css" />
<link rel="stylesheet" href="/ar/css/style.css" />
<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" media="all" href="ar/css/daterangepicker.css" />
<link href="/ar/css/bootstrap-formhelpers-countries.flags.css" rel="stylesheet">
<link rel="stylesheet" href="/ar/css/bootstrap-select.min.css">
@else
{{App::setLocale('en')}}
<link rel="stylesheet" href="/css/bootstrap.min.css" />
<link rel="stylesheet" href="/css/style.css" />
<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
<link rel="icon" href="/images/favicon.png" type="image/png">
<link href="/node_modules/video.js/dist/video-js.min.css" rel="stylesheet">
  <link href="/node_modules/videojs-record/dist/css/videojs.record.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.min.css" rel="stylesheet"/>
 
 <link rel="stylesheet" href="/css/bootstrap-select.min.css">

  <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
 @endif







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
<script type="text/javascript" src="/js/main.js"></script>
<script type="text/javascript" src="/js/script.js"></script>


<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>

<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.min.js" type="text/javascript"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>

<title>Maid & Helper</title>




</head>
<body >

@include('Layout.header')
@yield('content')
@include('Layout.footer')
</body>
@yield('scripts')
</html>