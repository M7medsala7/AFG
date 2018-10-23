<head >
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">


  <!-- Tell the browser to be responsive to screen width -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.min.css" rel="stylesheet"/>
 

  <!-- Font Awesome -->

  <!-- Ionicons -->

   <link rel="stylesheet" href="/admin/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Theme style -->

   <link rel="stylesheet" href="/admin/bower_components/Ionicons/css/ionicons.min.css">


   <link rel="stylesheet" href="/admin/dist/css/AdminLTE.min.css">

  <!-- Morris chart -->
<link rel="stylesheet" href="/admin/dist/css/skins/_all-skins.min.css">


  <link rel="stylesheet" href="/admin/bower_components/morris.js/morris.css">

 
  <link rel="stylesheet" href="/admin/bower_components/jvectormap/jquery-jvectormap.css">

  <link rel="stylesheet" href="/admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

   
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="/admin/bower_components/bootstrap-daterangepicker/daterangepicker.css">

 
   <link rel="stylesheet" href="/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  <link rel="stylesheet" href="/admin/cust/sweetalert.css">
  <style>
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}
</style>
<style>
  .select2-selection__rendered{
    background: rgb(0, 1, 1);
    border: 1px solid rgba(115, 115, 115, 0.48)!important;
    /* color: #fff; */
    float: left;
    width: 350px;
    height: 40px;
    border-radius: 5px;
    /* border: 0; */
    box-shadow: none;
    border: 2px solid #d7d7d7;
    margin-top: 10px;
        color: white!important;
  }
 
  .select2 select2-container select2-container 
  {
width:300px;
  }
 

  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 57px!important;
   }
  .select2-container .select2-selection--single
  {
    height: 0px!important;
  }
  .select2-container--default .select2-selection--single{    background-color: 0!important;border: 0!important}
  .watchvideo img{
    height: 20%!important;
    width:100%
  }
  .select2 select2-container select2-container--default
  {
    width: 300px;
  }
  .select2 select2-container select2-container--default select2-container--below
  {
    width:300px;
  }
</style>
</head>

