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
    <!-- Content Header (Page head
      <section class="content-header"  style="background-color:; ">
      <h1 class="fa fa-dashboard">
     Add Employer
      
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('adminpanel')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class=""><a href="{{url('/adminpanel/candidate')}}"> Candidates controlling </a></li>
        
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

   <form  role="form" method="POST" action="{{ url('/adminpanel/candidate/story') }}" enctype="multipart/form-data">

                     {{csrf_field()}}






                        <div class="form-group row">

                            <div class="col-md-10">
                          
                            <div class="divwits">
                                  <input style="width:50%;" type="text" name="first_name" 
                                  class="form-control" placeholder="first name" type="text" 
                                class="text2{{ $errors->has(' first_name') ? ' is-invalid' : '' }}" 
                                name="  first_name" value="{{ old(' first_name') }}"
                                  onblur="processForm(this.form)">
                            </div>
                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                               
                            </div>
                        </div>

                            <div class="form-group row">

                            <div class="col-md-10">
                          
                            <div class="divwits">
                                  <input style="width:50%;" type="text" name="last_name" 
                                  class="form-control" placeholder="last_name" type="text" 
                                class="text2{{ $errors->has(' last_name') ? ' is-invalid' : '' }}" 
                                name="  last_name" value="{{ old(' last_name') }}"
                                  onblur="processForm(this.form)">
                            </div>
                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                               
                            </div>
                        </div>
                      
                       <div class="form-group row">

                            <div class="col-md-10">
                          
                            <div class="divwits">
                         
               
                            <div   style="width:50%;" class="input-group input-file" name="logo">
                                <input type="text" class="form-control requirments"  placeholder='image...'  />
                                <span class="input-group-btn">
                                <button class="btn btn-default btn-choose largeredbtn brows" type="button" onblur="processForm(this.form)">brows</button>
                                </span> 
                         </div>
          
                               
                            </div>
                        </div>
                        <br>
                        <br>
                   

                       

                  
                       
                            <div class="col-md-10">
                            <select style="width:50%;"  class="form-control requirments" 
                            name="job_id" id="job_id"  required="" >
                            <option selected="" disabled="disabled">desired job</option>
                           @foreach(\App\Job::all() as $job)
                           <option value="{{$job->id}}">{{$job->name}}</option>
                           @endforeach
                           
                           </select>
                           
                                @if ($errors->has(' job_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first(' job_id') }}</strong>
                                    </span>
                                @endif
                               
                            </div>
                   
                            <br>
                            <br>
                          
                            <div class="col-md-10">

                            <div class="divwits">
                                <textarea style="width:50%;" type="text" name="description" 
                                class="form-control" placeholder="talk about your experiences" type="text" 
                                class="text2{{ $errors->has(' description') ? ' is-invalid' : '' }}" 
                                name="  description" value="{{ old(' description') }}"
                                onblur="processForm(this.form)"></textarea>
                            </div>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            
                           
                            </div>

                         

                       
                       <br> 
                           

                         
                            <br> 
                            <br>                         

                            <div class="col-md-10">
                            <input style="width:50%;" type="email" name="email" class="form-control" placeholder="email address" 
                            class="text2{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                            required="required" onblur="processForm(this.form)">
                            
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            
                            </div>
                            <br> 
                            <br> 
                           
                            <div class="col-md-10">
                            <input style="width:50%;" type="password" name="password" class="form-control" placeholder=" password" 
                            class="text2{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}"
                            required="required" onblur="processForm(this.form)">
                            
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            
                            </div>
                        <br>
                        <br>
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('add') }}
                                </button>
                            </div>
                    
              </form>


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
     @yield('scripts')

</html>