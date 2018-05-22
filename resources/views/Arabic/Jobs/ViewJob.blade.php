@extends('Layout.app')

@section('content')

<section class="dashboard" style="padding-top: 50px">
  <div class="container">
    <div class="row">
      <div class="col-sm-4 dashboardleft">
        <div class="inner-aboutus topmergline padbotnm">
          <div class="com-proftow aboutcompany">
            <h5 class="textcandidate">about company</h5>
            <p class="textabout">{{($job->user->company)?$Job->user->company->description:""}}</p>
          </div>
          
          <!--aboutcompany-->
          
          <div class="paboxs">
            <h5 class="textcandidate">similar jobs:</h5>
            @if($job->getSimilarJobsAttribute())
            @foreach($job->getSimilarJobsAttribute() as $sJob)
            <div class="ineercompany nonbordimg">
              <div class="tidiv"> <img src="images/callto-action.png"> <span> {{$sJob->job_for}} </span></div>
              <!--tidiv-->
              
              <h4 class="innertitltext nameviwjobs">{{$sJob->user->name}} <span>{{$sJob->job->name}}</span> </h4>
              <p class="officer">{{($sJob->job)?$sJob->job->name:""}}</p>
              <ul class="hassle salary">
                <li> <strong>loc.</strong> {{$sJob->country->name}}</li>
                <li> <strong>salary.</strong>{{$sJob->min_salary}}-{{$sJob->max_salary}} {{($job->Currency)?$job->Currency->name:""}}</li>
              </ul>
              <div class="tidivbotom"> <a href="#">apply now</a> <span>{{$sJob->created_at}}</span></div>

            </div>

             @endforeach
               @endif

            
          </div>
         
          <!--paboxs--> 
          
        </div>
        <!--inner-aboutus--> 
        
      </div>
      <!--dashboardleft-->
      
      <div class="col-sm-8 comprofleft">
        <div class="inner-aboutus">
          <div class="com-proftow companychool imgprof"> <img src="images/callto-action.png">
            <div class="comitm">
              <h5 class="textcandidate">{{($job->job)?$job->job->name:""}}</h5>
              <ul class="hassle salary">
                <li> <strong>{{($job->country)?$job->country->name:""}}</strong> </li>
                <li> <strong>posted</strong> <span class="timetext"><i class="far fa-clock"></i> posted</span> <span class="timetext"><i class="far fa-eye"></i> 10 views</span></li>
                <li> <strong>salary.</strong>{{$job->max_salary}}:{{$job->min_salary}} {{($job->Currency)?$job->Currency->name:""}}</li>
              </ul>
              <div class="cenbottom seejobs linkappley"> <a href="#" data-toggle="modal" data-target="#myModal" class="largeredbtn">apply</a> <a href="#" class="largeredbtn">apply without regestration</a> </div>
            </div>
            <!--comitm--> 
            
          </div>
          <!--com-proftow--> 
          
        </div>
        <!--inner-aboutus-->
        
        <div class="inner-aboutus secshbox">
          <div class="com-proftow aboutcompany discription">
            <h5 class="textcandidate">job discription :</h5>
            <p class="textabout">{{$job->job_descripton}}</p>
          </div>
          <!--aboutcompany-->
          
          <div class="com-proftow aboutcompany discription">
            <h5 class="textcandidate">job recuirment : </h5>
            <p class="textabout">{{$job->job_requirements}} </p>
          </div>
          <!--aboutcompany-->
          
          <div class="com-proftow aboutcompany discription">
            <h5 class="textcandidate">industry : </h5>
            <p class="textabout">{{($job->Industry)?$job->Industry->name:"Industry is not set"}}</p>
          </div>
          <!--aboutcompany-->
          
          <div class="com-proftow aboutcompany discription">
            <h5 class="textcandidate">skills :</h5>
            <p class="textabout">

          @if($job->skills)
            @foreach($job->skills as $skill)
            <a>{{$skill->name}}</a>
            @endforeach
          @else
            No skills selected
          @endif


            </p>
          </div>
          <!--aboutcompany-->
          
          <div class="com-proftow aboutcompany discription">
            <h5 class="textcandidate">sallary : </h5>
            <p class="textabout">{{$job->max_salary}}:{{$job->min_salary}}</p>
          </div>
          <!--aboutcompany-->
          
          <div class="cenbottom seejobs linkappley flotingbot"> <a href="#" class="largeredbtn">apply without Regestration</a> <a href="#" data-toggle="modal" data-target="#myModal" class="largeredbtn">apply</a> </div>
          <div class="com-proftow aboutcompany discription">
            <h5 class="textcandidate">About Company :</h5>
            <p class="textabout"></p>
          </div>
          <!--aboutcompany-->
          
          <div class="aboutcompany discription">
            <h5 class="textcandidate">more jobs from company :</h5>
            <div class="row">
                   @foreach($jobforcompany as $Compjob)
             
              <div class="col-sm-4 morecompany">
                <div class="ineercompany nonbordimg">
                  <div class="tidiv"> <img src="images/callto-action.png"> <span> {{$Compjob->job_for}} </span></div>
                  <!--tidiv-->
                  
                  <h4 class="innertitltext nameviwjobs">{{$Compjob->user->name}} </h4>
                  <p class="officer">{{($Compjob->job)?$Compjob->job->name:""}}</p>
                  <ul class="hassle salary">
                    <li> <strong>{{($Compjob->country)?$Compjob->country->name:""}}.</strong> </li>
                    <li> <strong>salary.</strong>{{$Compjob->max_salary}}:{{$Compjob->min_salary}} {{($Compjob->Currency)?$Compjob->Currency->name:""}}</li>
                  </ul>
                  <div class="tidivbotom"> <a href="#">apply now</a> <span>{{$Compjob->created_at}}</span></div>
                  <!--tidiv--> 
                  
                </div>
                <!--inernews--> 
                
              </div>
             @endforeach
            </div>
            <!--row-->
            
          <!--   <div class="cenbottom seejobs linkappley viewjobs"> <a href="#" class="largeredbtn">view more jobs</a> </div> -->
          </div>
          <!--aboutcompany-->
          
          <div class="aboutcompany discription">
           @if($jobCan !=null)
            <h5 class="textcandidate">{{(\Auth::user()->name)?'(\Auth::user()->name)':''}}</h5>
            <div class="row">
             
         @foreach($jobCan as $Conjob)
              <div class="col-sm-4 morecompany">
                <div class="ineercompany nonbordimg">
                  <div class="tidiv"> <img src="images/callto-action.png"> <span> {{$Conjob->job_for}} </span></div>
                  <!--tidiv-->
                  
                  <h4 class="innertitltext nameviwjobs">{{$Conjob->user->name}} </h4>
                  <p class="officer">{{($Conjob->job)?$Conjob->job->name:""}}</p>
                  <ul class="hassle salary">
                    <li> <strong>{{($Conjob->country)?$Conjob->country->name:""}}.</strong> </li>
                    <li> <strong>salary.</strong>{{$Conjob->max_salary}}:{{$Conjob->min_salary}} {{($Conjob->Currency)?$Conjob->Currency->name:""}}</li>
                  </ul>
                  <div class="tidivbotom"> <a href="#">apply now</a> <span>{{$Conjob->created_at}}</span></div>
                  <!--tidiv--> 
                  
                </div>
                <!--inernews--> 
                
              </div>
         @endforeach
         @endif
            </div>
            <!--row--> 
            
          </div>
          <!--aboutcompany--> 
          
        </div>
        <!--inner-aboutus--> 
        
      </div>
      
      <!--dashboardleft--> 
      
    </div>
    <!--row--> 
    
  </div>
  
  <!--container--> 
  
</section>
<!--section-->


@endsection
