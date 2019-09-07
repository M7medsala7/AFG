<div >
   <div class="jobStatstics">
              <div class="col-sm-8 leftprofile">
                <div class="tidivbotom"> <span>{{$jobStatstics->created_at}}</span></div>
                <!--tidivbotom-->
                
                <ul class="lastviws">
                  <li>
                    <h3>{{$jobStatstics->seen|0}}</h3>
                    <i class="fas fa-eye"></i>
                    <p>views</p>
                  </li>
                  <li class="stars_job" job-id ="{{$jobStatstics->id}}" >
                    <h3>{{count($jobStatstics->starred)}}</h3>
                    <i class="far fa-star"></i>
                    <p>starred</p>
                  </li>
                  <li>
                    <h3>0</h3>
                    <i class="fas fa-video"></i>
                    <p>interviewed</p>
                  </li>
                  <li class="applicants_job" job-id ="{{$jobStatstics->id}}" >
                    <h3>{{count($jobStatstics->applicants)}}</h3>
                    <i class="far fa-hand-point-up"></i>
                    <p>applied</p>
                  </li>
                  <li class="liked_candidates" job-id = "{{$jobStatstics->id}}" >
                    <h3>{{count(\Auth::user()->likes)}}</h3>
                    <i class="far fa-thumbs-up"></i>
                    <p>likes</p>
                  </li>
                </ul>

              </div>
  <div class="col-sm-4 leftprofile">
                <div style="width: 200px; height: 256px"id="chartContainerTest" ></div>
              </div>

             <div class="inner-aboutus topmergline">
         
            <div class="currencytext resultstext">
              <h2> {{trans('app.top_Candidate')}}</h2>
            </div>
            <!--resultstext-->
            
            <div class="row topCanDiv_{{$jobStatstics->id}}" >
              @if($jobStatstics->getTopCandidatesAttribute()->first())
                @foreach($jobStatstics->getTopCandidatesAttribute() as $candidate)
                  <div class="col-sm-4 company com-dashboard ">
                    <div class="ineercompany nonepad">
                      <a   class="imgbox" onclick="ShowVideo('/{{$candidate->vedio_path}}','{{File::extension($candidate->vedio_path)}}')"> 
<img src="{{($candidate->user->logo)?$candidate->user->logo:'images/4.jpg'}}"> <i class="fas fa-play"></i>  </a>
  

                      <div class="padboxs">
                       <span class="eyeicons"><i class="fas fa-eye"></i> 20,215</span> <span class="eyeicons"><i class="fas fa-flag"></i> 20,215</span>
<div class="heart"  value="{{$candidate->user->id}}" id="heart"></div>
                        <h4 class="innertitltext">{{$candidate->user->name}}</h4>
                        <p class="officer">{{$candidate->job->name}}</p>
                        <ul class="hassle salary">
                          
                          <li>{{$candidate->country->name}}</li>
                        </ul>
                        <div class="tidivbotom"> 
                          <a href="/candidate/{{$candidate->user->id}}">View Profile</a> 
                         
                        </div>
                        <!--tidiv--> 
                        
                      </div>
                      <!--padboxs--> 
                      
                    </div>
                    <!--inernews--> 
                    
                  </div>
                @endforeach
                <div class="top-can-div_{{$jobStatstics->id}}"></div>
              <!--com-dashboard-->
              @else
              <h3 class="cenbottom" style="text-align: center;"> No Candidates</h3>
              @endif
            </div>
            <div class="can_links" style="text-align: center; margin-top: 5px;"></div>
            <!--row-->
            @if($jobStatstics->getTopCandidatesAttribute()->first())
              <div class="cenbottom nomergbotm" > <button type="button"  class="largeredbtn loadmoreCandidates" job-id="{{$jobStatstics->id}}" last-candidate-id = "{{($jobStatstics->topCandidates->last()->id)?$jobStatstics->getTopCandidatesAttribute()->last()->id:0}}" id ="{{$jobStatstics->id}}_loadmore"  >load more candidates</button> 
              </div>
            @else
              No found data
            @endif
          </div>
            <!--row--> 


                   <div class="inner-aboutus topmergline">
          <div class="currencytext resultstext">
            <h2>jobs & candidates</h2>
          </div>
          <!--resultstext-->
          
          <div class="row ">
          @if($jobStatstics->getSimilarJobsAttribute()->first())
        
            @foreach($jobStatstics->getSimilarJobsAttribute() as $sJob)
              <div class="col-sm-4 company com-dashboard">
                <div class="ineercompany">
                  <div class="tidiv"> <img src="images/car1.jpg"> <span> {{$sJob->job_for}}</span>
                  </div>
                  <!--tidiv-->
                  
                  <h4 class="innertitltext"> {{$sJob['user']['name']}} </h4>
                  <p class="officer">{{$sJob->job->name}}</p>
                  <ul class="hassle salary">
                    <li> <strong>loc.</strong> {{$sJob->country->name}}</li>
                    <li> <strong>salary.</strong> {{number_format($sJob->min_salary)}}-{{number_format($sJob->max_salary)}} {{($jobStatstics->Currency)?$jobStatstics->Currency->name:""}}</li>
                  </ul>
                  <div class="tidivbotom"> <a href="/ViewJob/{{$sJob->id}}">apply now</a> <span>{{$sJob->created_at}}</span>
                  </div>
                  <!--tidiv--> 
                  
                </div>
                <!--inernews-->
                
                <div class="row rowphoto">
                  @foreach($sJob->getTopCandidatesAttribute() as $key => $candidate)
                    @if($key < 4)
                    <div class="col-sm-2 photcarcal">
                   <a href="/candidate/{{$candidate->user->id}}"> <img src="/{{($candidate->user->logo)?($candidate->user->logo):'images/callto-action.png'}}"></a></div>
                    @else
                     @break
                    @endif
                  @endforeach
                    <div class="col-sm-2 photcarcal"> <a href="#" class="btnlinks fas fa-ellipsis-h"> </a> </div>
                </div>
                <!--row--> 
                
              </div>
              <!--com-dashboard-->
              <!--com-dashboard--> 
              @endforeach
              <div class="jobs-can-div_{{$jobStatstics->id}}">
                <button type="button" post-job-id="{{$jobStatstics->getSimilarJobsAttribute()->last()['id']}}" job-id = "{{($jobStatstics->id)?$jobStatstics->id:0}}" id ="{{$jobStatstics->id}}_loadmoreJobs" class="largeredbtn loadmoreCanJobs">load more jobs</button>
              </div>
            @else
              <h2 class="cenbottom nomergbotm " id ="{{$jobStatstics->id}}_nomoreJobs">No More...</h2>
            @endif
          </div>
          <!--row-->
          @if($jobStatstics->getSimilarJobsAttribute()->first())
            
            <div class="cenbottom  nomergbotm">  </div>
            <h2 class="cenbottom nomergbotm " style="display: none;" id ="{{$jobStatstics->id}}_nomoreJobs">No More...</h2>
          @else
             <h2 class="cenbottom nomergbotm " id ="{{$jobStatstics->id}}_nomoreJobs">No More...</h2>
          @endif
        </div>
          </div>
        </div>


        <script type="text/javascript">


 
  $(".heart").on('click touchstart', function(){

var candidateid = document.getElementById('heart').getAttribute('value');
   
  $(this).toggleClass('animating');
  $('#LikedModal').modal('show');
  
 $(this).addClass('red');
  
});


$(".heart").on('animationend', function(){
  $(this).toggleClass('animating');
  

});





</script>
