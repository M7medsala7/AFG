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
      
     <nav class="linktop"> <a href="/login"> login</a> <a href="/signup"> Register</a> </nav>
    </div>
    <nav id='cssmenu'>
      <div id="head-mobile"></div>
      <div class="button"></div>
      <ul>
        <li><a href="/" class="active">Home </a></li>
        <li><a href="/search?type=I+am+Candidate&words=">All jobs </a> </li>
        <li> <a href="/search?type=I+Am+Employer&words=">All Candidates </a>
        <!--   <ul>
            <li><a href="#" class="active">Home </a></li>
            <li><a href="#">jobs </a> </li>
            <li> <a href="#"> Candidates </a></li>
            <li> <a href="#">Employers </a></li>
            <li> <a href="/Payment"> Pricing</a> </li>
          </ul> -->
        </li>
        <li> <a href="/Requests">Submit your request </a>
        <!--   <ul>
            <li><a href="#" class="active">Home </a></li>
            <li><a href="#">jobs </a> </li>
            <li> <a href="#"> Candidates </a></li>
            <li> <a href="#">Employers </a></li>
            <li> <a href="#"> Pricing</a> </li>
          </ul> -->
        </li>
        <li> <a href="/Payment"> Pricing</a> </li>
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
          <li><a href="/home"><i class="far fa-user"></i> Account </a></li>
          <li><a href="/logout"><i class="fas fa-sign-out-alt"></i> Log out </a></li>
        </ul>
      </div>
      <!--dropdown--> 
      
      <!--      <nav class="linktop"> <a href="#"> login</a> <a href="#"> Register</a> </nav>--> 
    </div>
    <nav id='cssmenu'>
      <div id="head-mobile"></div>
      <div class="button"></div>
      <ul>
        <li><a href="/" class="active">Home </a></li>
         <li><a href="/search?type=I+am+Candidate&words=">All jobs </a> </li>
      
        <!-- <li> <a href="#"> Candidates </a>
          <ul>
            <li><a href="#" class="active">Home </a></li>
            <li><a href="#">jobs </a> </li>
            <li> <a href="#"> Candidates </a></li>
            <li> <a href="#">Employers </a></li>
            <li> <a href="#"> Pricing</a> </li>
          </ul>
        </li>-->
        <li> <a href="#">messages </a> </li>
        <li> <a href="#"> interviews</a> </li>
      </ul>
    </nav>
  @endif
    <!--//cssmenu--> 
    
  </div>

  <!--container--> 
  
</header>