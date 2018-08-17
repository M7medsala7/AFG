



        <li  style="font: normal normal normal 17px/1 FontAwesome;"><a href="/">Home</a></li>
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



    

