

<header class="header {{(\Auth::user())?' header-in':''}}">
  <div class="container">
    <div class="logoinner"> <a href="/"> <img src="/images/logoinner.png" title="Maid & Helper"> </a> </div>
    
    
    
    
    <form action="/search" method="get"  class="input-search searchinner">
       <select name="type" class="selectpicker" id="search_type">
     
        <option>I am Candidate</option>
        <option>I Am Employer</option>
        
      </select>
      <input type="text" class="form-control" name ="words"  id="myInput" placeholder="search for jobs, candidates keywords...">
      <button type="submit" class="fas fa-search btn-slide"> </button>
    </form>
    
    
    
    
    
    
    
    
    
    
    
    
    
    @if(\Auth::user())
    <div class="dropdownlink">
        <div class="dropdown">
        <p class="award"><i class="fas fa-trophy"></i> <br/>
          <span>10</span>
        </p>
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> <img src="images/callto-action.png"> <i class="fa fa-angle-down" aria-hidden="true"></i>
        </button>
        <ul class="dropdown-menu">
         
          <li><a href="#"><i class="far fa-edit"></i> Edit </a></li>
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
    
    <!--//cssmenu--> 
    
    @else
      <div class="dropdownlink"> 
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
            <li> <a href="#"> About Us</a> </li>
          </ul> -->
        </li>
        <li> <a href="/search?type=I+Am+Employer&words=">Our Services </a>
        <!--   <ul>
            <li><a href="#" class="active">Home </a></li>
            <li><a href="#">jobs </a> </li>
            <li> <a href="#"> Candidates </a></li>
            <li> <a href="#">Employers </a></li>
            <li> <a href="#"> Pricing</a> </li>
          </ul> -->
        </li>
        <li> <a href="/aboutus"> About Us</a> </li>
      </ul>
      </nav>
      
      <!--//cssmenu--> 
      
    @endif
    </div>
  <!--container--> 
  
</header>
<!--header-->
