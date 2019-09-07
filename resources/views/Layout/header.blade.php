<header class="header {{(\Auth::user())?' header-in':''}}">
  <div class="container">
    <div class="logo"> <a href="/"> <img src="/images/logo.png" title="Maid & Helper"> </a> </div>
    <div class="logo scroldis"> <a href="#"> <img src="/images/logologin.png" title="Maid & Helper"> </a> </div>
    @if(!\Auth::user())
    <div class="dropdownlink"> 
      
     <!--<div class="dropdown">
        <p class="award"><i class="fas fa-trophy"></i> <br/>
          <span>10</span></p>
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> <img src="images/callto-action.png"> <i class="fa fa-angle-down" aria-hidden="true"></i> </button>
        <ul class="dropdown-menu">
          <li><a href="#"><i class="far fa-user"></i> Account </a></li>
          <li><a href="#"><i class="far fa-edit"></i> Edit </a></li>
          <li><a href="#"><i class="fas fa-sign-out-alt"></i> Log out </a></li>
        </ul>
      </div>-->
      <!--dropdown-->
      
     <nav class="linktop"> 
    
     <a href="/login"> {{trans('app.login')}}</a> <a href="/signup">{{trans('app.Register')}} </a> </nav>
    </div>
    <nav id='cssmenu'>
      <div id="head-mobile"></div>
      <div class="button"></div>
      <ul>

        <li><a href="/" class="active">{{trans('app.Home')}} </a></li>
        <li><a href="/search?type=I+am+Candidate&words="> {{trans('app.jobs')}} </a> </li>
        <li> <a href="/search?type=I+Am+Employer&words=">{{trans('app.allcan')}} </a>
        <!--   <ul>
            <li><a href="#" class="active">Home </a></li>
            <li><a href="#">jobs </a> </li>
            <li> <a href="#"> Candidates </a></li>
            <li> <a href="#">Employers </a></li>
            <li> <a href="/Payment"> Pricing</a> </li>
<li> <a href="/showBlogsuser"> Blogs</a> </li>
          </ul> -->
        </li>
        <li> <a href="/Requests">{{trans('app.Request')}}   </a>
        <!--   <ul>
            <li><a href="#" class="active">Home </a></li>
            <li><a href="#">jobs </a> </li>
            <li> <a href="#"> Candidates </a></li>
            <li> <a href="#">Employers </a></li>
            <li> <a href="#"> Pricing</a> </li>
          </ul> -->
        </li>
        <li> <a href="/Payment">{{trans('app.Pricing')}} </a> </li>
<li> <a href="/showBlogsuser">  {{trans('app.Blogs')}}</a></li>

  @if(Session::get('locale')=="Ar" || Session::get('locale')=="ar" )
  {{App::setLocale('ar')}}
<li> <a href="#" id="trans2" class="trans2" >English</a></li>
@else
{{App::setLocale('en')}}
<li> <a href="#" id="trans1"  class="trans1" >عربي</a></li>
@endif
      </ul>
    </nav>
    @else
    <!--//cssmenu--> 
    <div class="dropdownlink">
      <div class="dropdown">
        <p class="award"><i class="fas fa-trophy"></i> <br/>
          <span>10</span>
        </p>
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> <img src="{{(\Auth::user()->logo)?(\Auth::user()->logo):'images/callto-action.png'}}"> <i class="fa fa-angle-down" aria-hidden="true"></i>
        </button>
        <ul class="dropdown-menu">
          <li><a href="/home"><i class="far fa-user"></i> {{trans('app.Account')}}  </a></li>
          <li><a href="/logout"><i class="fas fa-sign-out-alt"></i>{{trans('app.Logout')}}  </a></li>
        </ul>
      </div>
      <!--dropdown--> 
      
      <!--      <nav class="linktop"> <a href="#"> login</a> <a href="#"> Register</a> </nav>--> 
    </div>
    <nav id='cssmenu'>
      <div id="head-mobile"></div>
      <div class="button"></div>
      <ul>
        <li><a href="/" class="active">{{trans('app.Home')}} </a></li>
         <li><a href="/search?type=I+am+Candidate&words=">{{trans('app.jobs')}}</a> </li>
      
        <!-- <li> <a href="#"> Candidates </a>
          <ul>
            <li><a href="#" class="active">Home </a></li>
            <li><a href="#">jobs </a> </li>
            <li> <a href="#"> Candidates </a></li>
            <li> <a href="#">Employers </a></li>
            <li> <a href="#"> Pricing</a> </li>
          </ul>
        </li>-->
        <li> <a href="#">{{trans('app.messages')}}  </a> </li>
        <li> <a href="#">{{trans('app.interviews')}} </a> </li>
      </ul>
    </nav>
  @endif
    <!--//cssmenu--> 
    
  </div>

  <!--container--> 

  
</header>