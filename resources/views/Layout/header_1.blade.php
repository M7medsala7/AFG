<header class="header {{(\Auth::user())?' header-in':''}}">
  <div class="container">
    <div class="logoinner"> <a href="/"> <img src="/images/logoinner.png" title="Maid & Helper"> </a> </div>
     <form action="/search" method="get"  class="input-search searchinner">
       <select name="type" class="selectpicker" id="search_type">
     
        <option> {{trans('app.IamCandidate')}}</option>
        <option>{{trans('app.IAmEmployer')}}</option>
        
      </select>
      <input type="text" class="form-control" name ="words"  id="myInput" placeholder="search for jobs, candidates keywords...">
      <button type="submit" class="fas fa-search btn-slide"> </button>
    </form>
    
    @if(\Auth::user())
    <div class="dropdownlink">
      <div class="dropdown">
        <p class="award"><i class="fas fa-trophy"></i> <br/>
            @if(Auth::user()->type=='candidate')
          <span>{{\Auth::user()->CanInfo()->first()->coins}}</span>
         @else
          
         @endif
        </p>
         <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
         <img src="{{(\Auth::user()->logo)?(\Auth::user()->logo):'images/callto-action.png'}}">  <i class="fa fa-angle-down" aria-hidden="true"></i>
        </button>
        <ul class="dropdown-menu">
          <li><a href="/home"><i class="far fa-user"></i>{{trans('app.Account')}}  </a></li>
          <li><a href="{{ url('/logout') }}"><i class="fas fa-sign-out-alt"></i> Log out </a></li>
        </ul>
      </div>
      <!--dropdown--> 
      
      <!--      <nav class="linktop"> <a href="#"> login</a> <a href="#"> Register</a> </nav>--> 
    </div>
     @if(Auth::user()->type=='candidate')

        <div class="dropdownlink">
        <div class="dropdown">
         <span class="glyphicon glyphicon-bell"><span  id="clicks" class="dot" style=" height: 15px;
    width: 20px;
    background-color:red;
    border-radius: 50%;
    display: inline-block;text-align: center;">{{count(\Auth::user()->getMatchingjobs())}}</span>
          </span>
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" onClick="onClick()"> 
         <i class="fa fa-angle-down" aria-hidden="true"></i>

        </button>
   
        <ul class="dropdown-menu" style=" height:300px;overflow:auto;width:300px;">
        

          @foreach(\Auth::user()->getMatchingjobs() as $j)

          <li style="background-color:#f0f0f0;" >
            <a href="/ViewJob/{{$j['id']}}" id="demo" onmouseover="myFunction(this, 'white')">{{$j['user']['name']}} added job for {{$j['job_for']}}  </a></li>
            
          @endforeach
        
          <li><a href="/MatchingJobs" > {{trans('app.more')}} </a></li>
         
        </ul>

      </div>
      <!--dropdown--> 
      
      <!--      <nav class="linktop"> <a href="#"> login</a> <a href="#"> Register</a> </nav>--> 
    </div>
    @else
    
        <div class="dropdownlink">
        <div class="dropdown">
         <span class="glyphicon glyphicon-bell" ><span id="clicks" class="dot" style=" height: 15px;
    width: 20px;
    background-color:red;
    border-radius: 50%;
    display: inline-block;text-align: center;">{{\Auth::user()->getMatchingcandidates()->count()}}
          </span></span>
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" onClick="onClick()"> 
         <i class="fa fa-angle-down" aria-hidden="true"></i>

        </button>
   
        <ul class="dropdown-menu" style=" height: 300px;
  overflow:auto;">
         
          @foreach(\Auth::user()->getMatchingcandidates() as $j)
          <li style="background-color:#f0f0f0;" >
            <a href="/candidate/{{$j['user']['id']}}" id="demo" onmouseover="myFunction(this, 'white')">{{$j['user']['name']}}  added new candidate </a></li>
           @endforeach

          <li><a href="/MatchingCandidates" > {{trans('app.more')}}  </a></li>
         
        </ul>
       
         
      </div>
      <!--dropdown--> 
      
      <!--      <nav class="linktop"> <a href="#"> login</a> <a href="#"> Register</a> </nav>--> 
    </div>
    @endif
  

    <nav id='cssmenu'>
      <div id="head-mobile"></div>
      <div class="button"></div>
      <ul>
             

        <li><a href="/" class="active"> {{trans('app.Home')}}</a></li>
        <li><a href="/search?type=I+am+Candidate&words=">{{trans('app.jobs')}}  </a> </li>
       
        <!-- <li> <a href="#"> Candidates </a>
          <ul>
            <li><a href="#" class="active">Home </a></li>
            <li><a href="#">jobs </a> </li>
            <li> <a href="#"> Candidates </a></li>
            <li> <a href="#">Employers </a></li>
            <li> <a href="#"> Pricing</a> </li>
<li> <a href="/showBlogsuser">Blogs </a>
          </ul>
        </li>-->
         @if(Auth::user()->type=='candidate')

        <li> <a href="{{url('/SuccessStory/'.\Auth::user()->CanInfo()->first()->id.'/CreateSuccessStory')}}">Success stories </a> </li>
        @else
        
        <li> <a href="{{url('/EmployerSuccessStory/'.\Auth::user()->EmpInfo()->first()->id.'/CreateSuccessStory')}}"> {{trans('app.Successstories')}} </a> </li>
       @endif
        <li> <a href="#"> {{trans('app.messages')}} </a> </li>
        <li> <a href="#">  {{trans('app.interviews')}} </a> </li>
     
      </ul>

    </nav>
    
    <!--//cssmenu--> 
    
    @else
      <div class="dropdownlink"> 
        <nav class="linktop"> 
        
        <a href="/login">{{trans('app.login')}} </a> <a href="/signup">{{trans('app.Register')}} </a> </nav>
      </div>
      <nav id='cssmenu'>
        <div id="head-mobile"></div>
        <div class="button"></div>
      <ul>
        <li><a href="/" class="active">{{trans('app.Home')}} </a></li>
        <li><a href="/search?type=I+am+Candidate&words="> {{trans('app.jobs')}}  </a> </li>
        <li> <a href="/search?type=I+Am+Employer&words=">{{trans('app.allcan')}}  </a>
        <!--   <ul>
            <li><a href="#" class="active">Home </a></li>
            <li><a href="#">jobs </a> </li>
            <li> <a href="#"> Candidates </a></li>
            <li> <a href="#">Employers </a></li>
           <li> <a href="/Payment"> Pricing</a> </li>
<li> <a href="/showBlogsuser">Blogs </a>
          </ul> -->
        </li>
        <li> <a href="/Requests">{{trans('app.Request')}}  </a>

        <!--   <ul>
            <li><a href="#" class="active">Home </a></li>
            <li><a href="#">jobs </a> </li>
            <li> <a href="#"> Candidates </a></li>
            <li> <a href="#">Employers </a></li>
            <li> <a href="/Payment"> Pricing</a> </li>
<li> <a href="/showBlogsuser">Blogs </a>
          </ul> -->
        </li>
       <!--<li> <a href="/Payment"> Pricing</a> </li>-->
<li> <a href="/showBlogsuser">{{trans('app.Blogs')}}  </a></li>
  @if(Session::get('locale')=="Ar" || Session::get('locale')=="ar" )
  {{App::setLocale('ar')}}
<li> <a href="#" id="trans2" class="trans2" >English</a></li>
@else
{{App::setLocale('en')}}
<li> <a href="#" id="trans1"  class="trans1" >عربي</a></li>
@endif
      </ul>
      </nav>
      
      <!--//cssmenu--> 
      
    @endif
    </div>
  <!--container--> 

</header>
<!--header-->

<script>
function myFunction(elmnt,clr) {
    elmnt.style.background = clr;
}
</script>

 <script type="text/javascript">
    var clicks = 0;
    function onClick() {
        clicks =0;
        document.getElementById("clicks").innerHTML = clicks;
    };
    </script>