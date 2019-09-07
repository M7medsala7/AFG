<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<title>Maid And Helper</title>
    <!-- You can use Open Graph tags to customize link previews.
    Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
<meta property="og:title" content="Maid & Helper"/>
<meta property="og:type" content="website"/>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
<div>
   @yield('head')</div>
</head>
<body>
    <div id="app">
        

        @yield('content')
    </div>

    <!-- Scripts -->

</body>
</html>
