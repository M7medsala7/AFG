<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Maid and helper</title>

<!-- style -->
 <link href="/AdminStyle/assets/css/jquerysctipttop.css" rel="stylesheet" type="text/css"> 

<!-- formvalidation -->


 <link href="/AdminStyle/assets/css/jquerysctipttop.css" rel="stylesheet" type="text/css"> 
<!-- query-builder -->

    <link rel="stylesheet" type="text/css" href="/AdminStyle/assets/css/query-builder.default.min.css">

<!-- Ionicons -->
  <link rel="stylesheet" href="/AdminStyle/assets/css/ionicons.min.css">
<!-- Chosen -->
  <link rel="stylesheet" href="/AdminStyle/assets/css/chosen.min.css" />

 <!-- datepicker --> 
<link rel="stylesheet" href="/AdminStyle/assets/css/datepicker.min.css" />
<link rel="stylesheet" href="/AdminStyle/assets/css/datepicker3.min.css"/>
<!-- buttons.jqueryui --> 
<link rel="stylesheet" type="text/css" href="/AdminStyle/assets/css/buttons.jqueryui.min.css">
<!-- bootstrap-horizon --> 

 <link rel="stylesheet" type="text/css" href="/AdminStyle/assets/css/bootstrap-horizon.css"> 

    <!-- Bootstrap -->
    <link href="/AdminStyle/bower_components/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/AdminStyle/bower_components/gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/AdminStyle/bower_components/gentelella/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="/AdminStyle/bower_components/gentelella/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  
    <!-- bootstrap-progressbar -->
    <link href="/AdminStyle/bower_components/gentelella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    {{--  <link href="/AdminStyle/bower_components/gentelella/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>  --}}
    <!-- bootstrap-daterangepicker -->
    <link href="/bower_components/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

<!-- Datatables -->
   <link href="/AdminStyle/assets/css/bootstrap-editable.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="/assets/css/datatables.min.css"/>
<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/> -->
<link rel="stylesheet" type="text/css" href="/AdminStyle/assets/css/dataTables.bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="/AdminStyle/assets/css/jquery.dataTables.min.css"/>


<link rel="stylesheet prefetch" href="/AdminStyle/assets/css/dataTables.responsive.css">
<link rel="stylesheet" type="text/css" href="/AdminStyle/assets/css/responsive.bootstrap.min.css"/>
<link rel="stylesheet" href="/AdminStyle/assets/formvalidation/css/formValidation.min.css">
   
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Candal|Alegreya+Sans">
    <link rel="stylesheet" type="text/css" href="/AdminStyle/assets/UserFiles/css/font-awesome.min.css">


 <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Candal|Alegreya+Sans">

    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="/AdminStyle/bower_components/gentelella/build/css/custom.min.css" rel="stylesheet">
    <style type="text/css">  
     input[type="file"] {
    display: none;
   }
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
}


.wizard-card .picture-container {
  position: relative;
  cursor: pointer;
  text-align: center;
}

.wizard-card .picture {
    width: 165px;
    height: 165px;
    background-color: #999999;
    border: 4px solid #CCCCCC;
    color: #FFFFFF;
    border-radius: 50%;
    /* margin: 2px auto; */
    margin-right: 0px;
    margin-top: 60px;
    overflow: hidden;
    transition: all 0.2s;
    -webkit-transition: all 0.2s;
}
.wizard-card .picture:hover {
  border-color:  #26d797;
}
.wizard-card .picture input[type="file"] {
  cursor: pointer;
  display: block;
  height: 100%;
  left: 0;
  opacity: 0 !important;
  position: absolute;
  top: 0;
  width: 100%;
}
.wizard-card .picture-src {
  width: 100%;
}
.hh6 {
    font-size: 19px;
    margin-top: 3px;
    text-align: center;
    margin-left: 230px;
}


  .the-legend {
    border-style: none;
    border-width: 0;
    font-size: 15px;
    color: white;
    line-height: 10px;
    margin-bottom: 0;
    width: auto;
   padding:12px;
    border: 1px solid #e0e0e0;
font-weight: bold;
background-color: #841851;

}
.the-fieldset {
    border: 1px solid #e0e0e0;
    padding: 10px;
    padding-right:40px
}

body {
    color: black;
   
    font-family: 'Cairo', sans-serif;
    font-size: 15px; }
        
        .sidebar-footer a {
                width: 30%;
            background: #2A3F54;
        }

        .sidebar-footer a:hover {
    background: #2A3F54;
}
        .nav.side-menu>li>a {
    color: white;
    font-weight: 500;
            text-align: right;
}
        .panel-body {
    padding: 15px;
    margin-bottom: 82px;
}
        .right_col {
            min-height: 950px;
        }
</style>

     <!-- validator -->
   
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
      

            <!-- sidebar menu -->
           @include('Dashboardadmin.layout.sidebar')

            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
          @include('Dashboardadmin.layout.menu_footer')
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
    @include('Dashboardadmin.layout.header')

        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" style="border: 2px solid white; min-height: 950px;" >
        @yield('content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
    @include('Dashboardadmin.layout.footer')
        <!-- /footer content -->

      </div>
    </div>

    <!-- jQuery -->
    <script src="/AdminStyle/bower_components/gentelella/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="/AdminStyle/bower_components/gentelella/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="/AdminStyle/bower_components/gentelella/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <!-- gauge.js -->
    <script src="/AdminStyle/bower_components/gentelella/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="/AdminStyle/bower_components/gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="/AdminStyle/bower_components/gentelella/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="/bower_components/gentelella/vendors/skycons/skycons.js"></script>
    {{--  <!-- Flot -->
    <script src="/AdminStyle/bower_components/gentelella/vendors/Flot/jquery.flot.js"></script>
    <script src="/AdminStyle/bower_components/gentelella/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="/AdminStyle/bower_components/gentelella/vendors/Flot/jquery.flot.time.js"></script>
    <script src="/AdminStyle/bower_components/gentelella/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="/bower_components/gentelella/vendors/Flot/jquery.flot.resize.js"></script>  --}}
    <!-- Flot plugins -->
    {{--  <script src="/AdminStyle/bower_components/gentelella/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="/AdminStyle/bower_components/gentelella/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="/bower_components/gentelella/vendors/flot.curvedlines/curvedLines.js"></script>  --}}
    <!-- DateJS -->
    <script src="/AdminStyle/bower_components/gentelella/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="/AdminStyle/bower_components/gentelella/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="/AdminStyle/bower_components/gentelella/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="/AdminStyle/bower_components/gentelella/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="/AdminStyle/bower_components/gentelella/vendors/moment/min/moment.min.js"></script>
    <script src="/AdminStyle/bower_components/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- Datatables -->


<script type="text/javascript" src="/AdminStyle/assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/AdminStyle/assets/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="/AdminStyle/assets/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="/AdminStyle/assets/js/responsive.bootstrap.min.js"></script>
<script type="text/javascript" src="/AdminStyle/assets/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="/AdminStyle/assets/js/buttons.print.min.js"></script>
<script type="text/javascript" src="/AdminStyle/assets/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="/AdminStyle/assets/js/buttons.jqueryui.min.js"></script>
<script type="text/javascript" src="/AdminStyle/assets/js/jszip.min.js"></script>
<script type="text/javascript" src="/AdminStyle/assets/js/pdfmake.min.js"></script> 
  <script type="text/javascript" src="/bower_components/js/fnReloadAjax.js"></script>
<script src="/AdminStyle/assets/js/bootstrap-editable.min.js"></script>
    {{--  <script type="text/javascript" src="/AdminStyle/bower_components/gentelella/vendors/datatables.net/js/buttons.jqueryui.min.js"></script>  --}}
<script src="/AdminStyle/assets/formvalidation/js/formValidation.min.js"></script>
<script src="/AdminStyle/assets/formvalidation/js/framework/bootstrap.min.js"></script>
 
    <!-- Custom Theme Scripts -->
    <script src="/AdminStyle/bower_components/gentelella/build/js/custom.js"></script>
   <!--  Validator -->
   <script src="/AdminStyle/bower_components/gentelella/vendors/validator/validator.js"></script>
<!-- canvasjs -->

     <script type="text/javascript" src="/AdminStyle/assets/js/canvasjs.min.js"></script>

   <!-- datepicker -->

     <script src="/AdminStyle/assets/js/bootstrap-datepicker.min.js"></script>
   <!-- extendext -->

     <script src="/AdminStyle/assets/js/jQuery.extendext.js"></script>
        <!-- doT -->

<script src="/AdminStyle/assets/js/doT.min.js"></script>
   <!-- query-builder -->

<script src="/AdminStyle/assets/js/query-builder.min.js"></script>
   <!-- javascript links -->

<script type="text/javascript" src="/AdminStyle/assets/js/jquery.validate.js"></script>
<script type="text/javascript" src="/AdminStyle/assets/js/additional-methods.js"></script>
<script type="text/javascript" src="/AdminStyle/assets/js/fnReloadAjax.js"></script>
<script type="text/javascript" src="/AdminStyle/assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="/assets/js/additional-methods.min.js"></script>
   <!-- formvalidation -->

<script src="/AdminStyle/assets/formvalidation/js/formValidation.min.js"></script>
<script src="/AdminStyle/assets/formvalidation/js/framework/bootstrap.min.js"></script>
   <!-- tabletoexcel -->

 <script src="/AdminStyle/assets/js/jquery.table2excel.js"></script>
   <!-- chosen -->

      <script src="/AdminStyle/assets/js/chosen.jquery.min.js"></script>


        @yield('other_scripts')
  </body>
</html>
