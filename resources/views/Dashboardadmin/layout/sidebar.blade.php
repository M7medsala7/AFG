 <div class="col-md-3 left_col">
          <div class="left_col scroll-view" style="background-color:#dbc65d;">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title">   <img src="/assets/img/lo1.png" class="img-responsive" alt="" style="margin-left: 35px; margin-top: 8px;"></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{Session::get('Logo')}}" alt="" class="img-circle profile_img" style="    width: 50px; height: 50px;">
              </div>
              <div class="profile_info">
               
                <h2>{{Session::get('username')}}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <br/>

 <!-- sidebar menu -->
          <div > 
          <li class=" treeview" style="font: normal normal normal 17px/1 FontAwesome;display:inline;">
          <a href="#">
            <i class="fa fa-users pull-left"></i> <span>Emplyer control</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{url('/adminpanel/employer')}}"><i class="fa fa-circle-o"></i> all employers</a></li>
            <li><a href="{{url('add/employer')}}"><i class="fa fa-circle-o"></i>add employers</a></li>
          </ul>
        </li>
        <br>
        <li class=" treeview" style="font: normal normal normal 17px/1 FontAwesome;display:inline;">
          <a href="#">
            <i class="fa fa-users pull-left"></i> <span>Candidates control</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{url('/adminpanel/candidate')}}"><i class="fa fa-circle-o"></i> all candidtes</a></li>
            <li><a href="{{url('/f_add/candidate')}}"><i class="fa fa-circle-o"></i>add candidate</a></li>
          </ul>
        </li>
</div>
         
            <!-- /sidebar menu -->

            