<!DOCTYPE html>
@include('Dashboardadmin.layout.header')
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

@include('Dashboardadmin.layout.sidebar')
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{url('/admin/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
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
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
      @include('/Dashboardadmin.layout.nav')
        </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <section class="content-header"  style="background-color:; ">
      <h1 class="fa fa-dashboard">
    Post Questions
      
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('adminpanel')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class=""><a href="{{url('/adminpanel/questions')}}"> Questions controlling </a></li>
        
      </ol>
    </section>


      <section class="content" style="background-color:; ">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">

   @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

   <form  role="form" method="POST" action="{{ url('/adminpanel/postjob/stor/').'/'.$data2->id }}" enctype="multipart/form-data">

                     {{csrf_field()}}
<table style="width:60%; border-collapse: collapse; border: 3px solid #ddd;
    padding: 8px;"  id="mytable">
 <tr >
 <td style="width:47%;" >
                  
        
                    <input type="text" placeholder="Write question:" name="question" id="question" class="form-control">
                 
                 
                   <div >
                   </td>
                   <td style="width:10%;" id="mylist">
                   <select  class="form-control requirments" name="weight" id="weight" >
	                 <option selected="" >Weight</option>
	           
	                  <option >10%</option>
                    <option >30%</option>
                    <option >50%</option>
                    <option >70%</option>
                    <option >90%</option>
                    <option >100%</option>
	           
	        </select>
          </div>
          </td>
        
          </tr>
  
          </table>
      
          <br>


                <div class="form-group">
                    <button type="submit" class="btn-primary" >Post Question </button>
                </div>

              </form>
             
              <button id="btn1" onclick="myFunction()">+</button>
              <button onclick="myDeleteFunction()">-</button>


            </div>
            </div>
          </div>
         </div>
       
 </section>

</div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->

<!-- AdminLTE for demo purposes -->
<script src="/admin/cust/sweetalert.js"></script>

<script src="/admin/cust/sweetalert.min.js"></script>
  @include('Dashboardadmin.layout.flashMessage')
  @include('Dashboardadmin.layout.footer')
     </body>


</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

function myFunction() {
    var table = document.getElementById("mytable");
    var row = table.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    cell1.innerHTML = '<td><input name="question"></td>';
    cell2.innerHTML = '<td><select></td>';
}

function myDeleteFunction() {
    document.getElementById("mytable").deleteRow(0);
}
</script>