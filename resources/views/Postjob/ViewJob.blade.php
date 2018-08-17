@extends('Layout.app')
@section('content')

<style type="text/css">
  .cenbottom.seejobs.linkappley a.largeredbtn {
    border-radius: 60px;
    width: 215px;
    background: #009df4;
    color: #fff;
    padding: 10px 15px;
    font-size: 12px;
}
</style>
@if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
@endif
@if(Session::has('flash'))
    <div class="alert alert-success">

    you employer,you must register as candidate<a href="/logoutandregister">  Register Now</a>
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
@endif



<section class="dashboard" >
  <div class="container">
    <div class="row">
      <div class="col-sm-4 dashboardleft">
        <div class="inner-aboutus topmergline padbotnm">
          <div class="com-proftow aboutcompany">
            <h5 class="textcandidate">about company</h5>
            <p class="textabout">{{($job->user->company)?$job->user->company->description:"No Description"}}</p>
          </div>
          
          <!--aboutcompany-->
          
          <div class="paboxs">
            <h5 class="textcandidate">similar jobs:</h5>
            @if($job->getSimilarJobsAttribute())
            @foreach($job->getSimilarJobsAttribute() as $sJob)
            <div class="ineercompany nonbordimg">
              <div class="tidiv"> <img src="/images/callto-action.png"> <span> {{$sJob->job_for}} </span></div>
              <!--tidiv-->
              
              <h4 class="innertitltext nameviwjobs">{{$sJob->user->name}} <span>{{$sJob->job->name}}</span> </h4>
              <p class="officer">{{($sJob->job)?$sJob->job->name:""}}</p>
              <ul class="hassle salary">
                <li> <strong>loc.</strong> {{$sJob->country->name}}</li>
                <li> <strong>salary.</strong>{{number_format(($sJob->min_salary))?number_format($sJob->min_salary):"0"}}:{{number_format(($sJob->max_salary))?number_format($sJob->max_salary):"0"}} {{($job->Currency)?$job->Currency->name:""}}</li>
              </ul>
              <div class="tidivbotom"> <a href="" data-toggle="modal" data-target="#myModal">apply now</a> <span>{{$sJob->created_at}}</span></div>



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
          <div class="com-proftow companychool imgprof"> <img src="/images/callto-action.png">
            <div class="comitm">
              <h5 class="textcandidate">{{($job->job)?$job->job->name:""}}


              </h5>



            <a class="like like_button" href="/likejob/{{$job->id}}">
@if($color=='black')
<i class="fas fa-heart" style="font-size: 1.5em;"></i> 
@endif
@if($color=='red')
<i class="fas fa-heart" style="font-size: 1.5em;color:red"></i> 
@endif
</a>




              <ul class="hassle salary">
                <li> <strong>{{($job->country)?$job->country->name:""}}</strong> </li>
                <li> <strong>posted</strong> <span class="timetext"><i class="far fa-clock"></i> posted</span> <span class="timetext"><i class="far fa-eye"></i> 10 views</span></li>
                <li> <strong>salary.</strong>{{($job->min_salary)?number_format($job->min_salary):"0"}}:{{($job->max_salary)?number_format($job->max_salary):"0"}}{{($job->Currency)?$job->Currency->name:""}}</li>
              </ul>
              @if(\Auth::user())
              <div class="cenbottom seejobs linkappley"> <a href="#" data-toggle="modal" data-target="#myModal"  class="largeredbtn" style="width: 150;">apply</a>
                @else
                <div class="cenbottom seejobs linkappley"> <a href="#" data-toggle="modal" data-target="#myModal"  class="largeredbtn" style="width: 150;">apply</a>
               <a href="" class="largeredbtn" style="width: 215;font-size: 12px;">apply without regestration</a> </div>
               @endif
            </div>
            <!--comitm--> 
            
          </div>
          <!--com-proftow--> 
          
        </div>
        <!--inner-aboutus-->
        
        <div class="inner-aboutus secshbox">
          <div class="com-proftow aboutcompany discription">
            <h5 class="textcandidate">job discription :</h5>
            <p class="textabout">{{($job->job_descripton)?$job->job_descripton:"job discription is not set"}}</p>
          </div>
          <!--aboutcompany-->
          
          <div class="com-proftow aboutcompany discription">
            <h5 class="textcandidate">job recuirment : </h5>
            <p class="textabout">{{($job->job_requirements)?$job->job_requirements:"job recuirment is not set"}}</p>
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

         <nav class="driver">
            @foreach($Skilljob as $skill)
            <a>{{$skill->name}}</a>
            @endforeach
        </nav>
       

            </p>
          </div>
          <!--aboutcompany-->
          
          <div class="com-proftow aboutcompany discription">
            <h5 class="textcandidate">salary : </h5>
            <p class="textabout">{{($job->min_salary)?number_format($job->min_salary):"0"}}:{{($job->max_salary)?number_format($job->max_salary):"0"}}</p>
          </div>




          <!--aboutcompany-->
          
          <div class="cenbottom seejobs linkappley flotingbot"> <a href="" class="largeredbtn" style="width: 215;font-size: 12px;">apply without regestration</a> <a href="#" data-toggle="modal" data-target="#myModal" class="largeredbtn" style="width: 183px;    font-size: 12px;">apply</a> </div>
          <div class="com-proftow aboutcompany discription">
            <h5 class="textcandidate">About Company : </h5>
            <p class="textabout">{{($job->user->company)?$job->user->company->description:"No Description "}}</p>
          </div>
          <!--aboutcompany-->
          
          <div class="aboutcompany discription">
            <h5 class="textcandidate">more jobs from company :</h5>
            <div class="row">
                   @foreach($jobforcompany as $Compjob)
             
              <div class="col-sm-4 morecompany">
                <div class="ineercompany nonbordimg">
                  <div class="tidiv"> <img src="/images/callto-action.png"> <span> {{$Compjob->job_for}} </span></div>
                  <!--tidiv-->
                  
                  <h4 class="innertitltext nameviwjobs">{{$Compjob->user->name}} </h4>
                  <p class="officer">{{($Compjob->job)?$Compjob->job->name:""}}</p>
                  <ul class="hassle salary">
                    <li> <strong>{{($Compjob->country)?$Compjob->country->name:""}}.</strong> </li>
                    <li> <strong>salary.</strong>{{number_format(($Compjob->min_salary))?number_format($Compjob->min_salary):"0"}}:{{number_format(($job->max_salary))
                      ?number_format($job->max_salary):"0"}}{{($Compjob->Currency)?$Compjob->Currency->name:""}}</li>
                  </ul>
                  <div class="tidivbotom"> <a href="" data-toggle="modal" data-target="#myModal">apply now</a> <span>{{$Compjob->created_at}}</span></div>
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
                  <div class="tidiv"> <img src="/images/callto-action.png"> <span> {{$Conjob->job_for}} </span></div>
                  <!--tidiv-->
                  
                  <h4 class="innertitltext nameviwjobs">{{$Conjob['user']['name']}} </h4>
                  <p class="officer">{{($Conjob->job)?$Conjob->job->name:"No Job"}}</p>
                  <ul class="hassle salary">
                    <li> <strong>{{($Conjob->country)?$Conjob->country->name:""}}.</strong> </li>
                    <li> <strong>salary.</strong> {{number_format(($Conjob->min_salary))?number_format($Conjob->min_salary):"0"}}:{{number_format(($Conjob->max_salary))?number_format($Conjob->max_salary):"0"}} {{($Conjob->Currency)?$Conjob->Currency->name:" No Currency"}}</li>
                  </ul>
                  <div class="tidivbotom"> <a href="" data-toggle="modal" data-target="#myModal">apply now</a> <span>{{$Conjob->created_at}}</span></div>
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
<div id="myModal" class="modal fade in" aria-hidden="false"  >
  <div class="modal-dialog popvad"  >
    <div class="modal-content" >
      <button type="button" class="close" data-dismiss="modal">X</button>
      <div class="col-sm-6 chancevedio">
        <div class="linksing" > did you know that your <span class="nambers">chance</span> will be increased <span class="nambers">9</span> times when
          employer watch your video </div>
        <label class="airports personal-in">
          <input type="radio" name="radio">
          <span class="label-text"> record your <a href="/ApplyOk" class="termsagreements"> video now </a> </span> </label>
        <div class="witbot"> <a href="/ApplyOk" class="largeredbtn">yes </a> <a href="/ApplyJob/{{$job->id}}" class="largeredbtn back"> later</a> </div>
      </div>
      <!--chancevedio-->
      
      <div class="col-sm-6 chancevedio">
       <iframe width="660" height="355" src="https://www.youtube.com/embed/_I4AxpE5byE" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
      </div>
      <!--chancevedio--> 
      
    </div>
  </div>
</div>
<!--modal-->

@endsection

@section('scripts')
<script>
   $(function(){
    $('header').addClass('header-in');
  });
</script>
@endsection
