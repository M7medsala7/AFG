<html>
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

 
   
   <link rel="stylesheet" href="/admin/cust/sweetalert.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->

 
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
</head>

@yield('head')

<body class="hold-transition skin-blue sidebar-mini">
<div class="content-wrapper">

   <header class="main-header" >
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
       
          <!-- Notifications: style can be found in dropdown.less -->
         
          <li class="dropdown notifications-menu" id="markAsRead" onclick="markNotificationAsRead()">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">{{count(Auth::user()->unreadNotifications)}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have {{count(Auth::user()->unreadNotifications)}}  notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
              
                @foreach(Auth::user()->unreadNotifications as $notification)
              
                  @if($notification['type']=='App\Notifications\PostJobs')
                  <li>
                    <a href="{{url('/adminpanel/postjob')}}">
                    <i class="fa fa-users text-aqua">
                    </i> you have new  job is added
                    </a>
                  </li>

                 @elseif($notification['type']=='App\Notifications\Employer')
                 <li>
                    <a href="{{url('/adminpanel/employer')}}">
                    <i class="fa fa-users text-aqua">
                    </i>new  employer is added
                    </a>
                  </li>

                   @elseif($notification['type']=='App\Notifications\Candidate_notification')
                 <li>
                    <a href="{{url('/adminpanel/candidate')}}">
                    <i class="fa fa-users text-aqua">
                    </i>new  candidate is added
                    </a>
                  </li>
                  @elseif($notification['type']=='App\Notifications\Request')
                 <li>
                    <a href="{{url('/adminpanel/request')}}">
                    <i class="fa fa-users text-aqua">
                    </i>new  candidate is added
                    </a>
                  </li>
                  @endif
                  @endforeach
         
                 
               
              
                </ul>
              </li>
            </ul>
          </li>
        
          <!-- Tasks: style can be found in dropdown.less -->
         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="admin/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Alexander Pierce</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar" style="background-color:;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
         <h4> <p style=" color:;margin-top:-10%;font: normal normal normal 17px/1 FontAwesome;">Alexander Pierce

</p></h4>

        </div>
      </div>
      <!-- search form -->
       <!-- search form -->
       <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header" style="color:#3c8dbc;"><h3></h3></li>
         @include('/Dashboardadmin.layout.nav')
       </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <div class="control-sidebar-bg"></div>

<!-- ./wrapper -->
  






    @yield('content')
    </div>
     <footer class="main-footer" style="background-color:">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.

  </footer>


<!-- jQuery 3 -->


 <script src="/admin/bower_components/jquery/dist/jquery.min.js"></script>

<!-- jQuery UI 1.11.4 -->

<script src="/admin/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{asset('/js/main.js')}}"></script>

<!-- Bootstrap 3.3.7 -->

<script src="/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->


<script src="/admin/bower_components/raphael/raphael.min.js"></script>

<!-- Sparkline -->

<script src="/admin/bower_components/morris.js/morris.min.js"></script>

<script src="/admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>

<script src="/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>

<!-- jQuery Knob Chart -->
<script src="/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<!-- daterangepicker -->
<script src="/admin/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>

<script src="/admin/bower_components/moment/min/moment.min.js"></script>

<!-- datepicker -->
<script src="/admin/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="/admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script src="/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>


<script src="/admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<script src="/admin/bower_components/fastclick/lib/fastclick.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/admin/dist/js/adminlte.min.js"></script>

<script src="/admin/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->

<script src="/admin/dist/js/demo.js"></script>
<!-- for sweet alert -->



<script type="text/javascript" src="/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/js/count-number.js"></script>
<script type="text/javascript" src="/js/jquery.canvasjs.min.js"></script>
<script type= "text/javascript" src = "/images/js/countries.js"></script>
<script type="text/javascript" src="/js/script.js"></script>
<script src="/node_modules/video.js/dist/video.min.js"></script>
  <script src="/node_modules/recordrtc/RecordRTC.js"></script>
  <script src="/node_modules/webrtc-adapter/out/adapter.js"></script>
   
<script type="text/javascript" src="/js/chosen.jquery.min.js"></script>

  <script src="/node_modules/videojs-record/dist/videojs.record.js"></script>





<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>

<script src="/admin/cust/sweetalert.js"></script>

<script src="/admin/cust/sweetalert.min.js"></script>
<script src="{{asset('/js/main.js')}}"></script>
  @include('Dashboardadmin.layout.flashMessage')
     @yield('footer')
     </body>
     @yield('scripts')
     </html>
