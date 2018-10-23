<li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="/showEmpolyerChart"><i class="fa fa-circle-o"></i> Empolyer Dashboard </a></li>
            <li><a href="/showCandidateChart"><i class="fa fa-circle-o"></i> Candidate Dashboard </a></li>
          </ul>
        </li>

       
        {{-- employer--}}
     
         <li class=" treeview" style="font: normal normal normal 17px/1 FontAwesome;">
          <a href="#">
            <i class="fa fa-users pull-right"></i> <span>Employer control</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{url('/adminpanel/employer/create')}}"><i class="fa fa-circle-o"></i> add Employer</a></li>
            <li><a href="{{url('/adminpanel/employer')}}"><i class="fa fa-circle-o"></i> all Employers</a></li>
            
     
           </ul>
        </li>

        {{-- candidates--}}
          <li class=" treeview" style="font: normal normal normal 17px/1 FontAwesome;">
          <a href="#">
            <i class="fa fa-users pull-right"></i> <span>Candidates control</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{url('/adminpanel/candidates/create')}}"><i class="fa fa-circle-o"></i> add Candidate</a></li>
            <li><a href="{{url('/adminpanel/candidate')}}"><i class="fa fa-circle-o"></i> all Candidates</a></li>
            
          </ul>

        </li>
         {{-- postjob--}}
          <li class=" treeview" style="font: normal normal normal 17px/1 FontAwesome;">
          <a href="#">
            <i class="fa fa-users pull-right"></i> <span>PostJob control</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{url('/adminpanel/postjob/create')}}"><i class="fa fa-circle-o"></i> add Jobs</a></li>
            <li><a href="{{url('/adminpanel/postjob')}}"><i class="fa fa-circle-o"></i> all Jobs</a></li>
            <li><a href="{{url('/adminpanel/postjob/maidhelper/create')}}"><i class="fa fa-circle-o"></i> maidhelper add post</a></li>
         
          </ul>
          {{-- postjob--}}
          <li class=" treeview" style="font: normal normal normal 17px/1 FontAwesome;">
          <a href="#">
            <i class="fa fa-users pull-right"></i> <span>Questions control</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{url('/adminpanel/questions/')}}"><i class="fa fa-circle-o"></i> All Questions</a></li>
            <li><a href="{{url('/adminpanel/postjob')}}"><i class="fa fa-circle-o"></i> Add Question</a></li>
            
          </ul>
          {{-- employer--}}
     
     <li class=" treeview" style="font: normal normal normal 17px/1 FontAwesome;">
      <a href="#">
        <i class="fa fa-users pull-right"></i> <span>Stories control</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
       
        <li><a href="{{url('/adminpanel/stories')}}"><i class="fa fa-circle-o"></i> all Stories</a></li>
        <li><a href="{{url('/adminpanel/employer/creates')}}"><i class="fa fa-circle-o"></i> Add Employe Story</a></li>
        <li><a href="{{url('/adminpanel/candidate/create')}}"><i class="fa fa-circle-o"></i> Add Candidae Story</a></li>
 
       </ul>
    </li>
    <li class=" treeview" style="font: normal normal normal 17px/1 FontAwesome;">
      <a href="#">
        <i class="fa fa-users pull-right"></i> <span>Requests</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
       
        <li><a href="{{url('/adminpanel/Requests')}}"><i class="fa fa-circle-o"></i> All Requests</a></li>
        
 
       </ul>
    </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Layout Options</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/admin/pages/layout/top-nav.html')}}"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
            <li><a href="{{url('/admin/pages/layout/boxed.html')}}"><i class="fa fa-circle-o"></i> Boxed</a></li>
            <li><a href="{{url('/admin/pages/layout/fixed.html')}}"><i class="fa fa-circle-o"></i> Fixed</a></li>
            <li><a href="{{url('/admin/pages/layout/collapsed-sidebar.html')}}"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
          </ul>
        </li>
        <li>
          <a href="pages/widgets.html">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Charts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/admin/pages/charts/chartjs.html')}}"><i class="fa fa-circle-o"></i> ChartJS</a></li>
            <li><a href="{{url('/admin/pages/charts/morris.html')}}"><i class="fa fa-circle-o"></i> Morris</a></li>
            <li><a href="{{url('/admin/pages/charts/flot.html')}}"><i class="fa fa-circle-o"></i> Flot</a></li>
            <li><a href="{{url('/admin/pages/charts/inline.html')}}"><i class="fa fa-circle-o"></i> Inline charts</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>UI Elements</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/admin/pages/UI/general.html')}}"><i class="fa fa-circle-o"></i> General</a></li>
            <li><a href="{{url('/admin/pages/UI/icons.html')}}"><i class="fa fa-circle-o"></i> Icons</a></li>
            <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
            <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
            <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
            <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Forms</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/admin/pages/forms/general.html')}}"><i class="fa fa-circle-o"></i> General Elements</a></li>
            <li><a href="{{url('/admin/pages/forms/advanced.html')}}"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
            <li><a href="{{url('/admin/pages/forms/editors.html')}}"><i class="fa fa-circle-o"></i> Editors</a></li>
          </ul>
        </li>
      

       
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Examples</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/admin/pages/examples/invoice.html')}}"><i class="fa fa-circle-o"></i> Invoice</a></li>
            <li><a href="{{url('/admin/pages/examples/profile.html')}}"><i class="fa fa-circle-o"></i> Profile</a></li>
            <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
            <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
            <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
            <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
            <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
            <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
            <li><a href="pages/examples/pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
          </ul>
        </li>
        