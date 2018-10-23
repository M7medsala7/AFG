<div >
   <div class="row jobStatstics">
              <div class="col-sm-8 leftprofile">
                <div class="tidivbotom"> <span>{{$jobStatstics->created_at}}</span></div>
                <!--tidivbotom-->
                
                <ul class="lastviws">
                  <li>
                    <h3>{{$jobStatstics->seen|0}}</h3>
                    <i class="fas fa-eye"></i>
                    <p>views</p>
                  </li>
                  <li class="stars_job" job-id ="{{$jobStatstics->id}}" onclick="stars()">
                    <h3>{{count($jobStatstics->starred)}}</h3>
                    <i class="far fa-star"></i>
                    <p>starred</p>
                  </li>
                  <li>
                    <h3>0</h3>
                    <i class="fas fa-video"></i>
                    <p>interviewed</p>
                  </li>
                  <li class="applicants_job" job-id = "{{$jobStatstics->id}}" onclick="applicants()">
                    <h3>{{count($jobStatstics->applicants)}}</h3>
                    <i class="far fa-hand-point-up"></i>
                    <p>applied</p>
                  </li>
                  <li class="liked_candidates" job-id = "{{$jobStatstics->id}}" onclick="liked()">
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
             @if($employerJobsfor->type == "Agency")
           <div class="currencytext resultstext"> 
           <h2>your own candidates</h2>
           </div>
           <div class="row">
          @foreach($ownCan as $candidate)
                  <div class="col-sm-4 company com-dashboard ">
                    <div class="ineercompany nonepad"> <a href="#" class="imgbox"> <img src="images/4.jpg"> <i class="fas fa-play"></i></a>
                      <div class="padboxs">
                       <span class="eyeicons"><i class="fas fa-eye"></i> 20,215</span> <span class="eyeicons"><i class="fas fa-flag"></i> 20,215</span>
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



           </div>
         @endif
            <div class="currencytext resultstext">
              <h2>top candidates</h2>
            </div>
            <!--resultstext-->
            
            <div class="row topCanDiv_{{$jobStatstics->id}}" >
              @if($jobStatstics->getTopCandidatesAttribute()->first())
                @foreach($jobStatstics->getTopCandidatesAttribute() as $candidate)
                  <div class="col-sm-4 company com-dashboard ">
                    <div class="ineercompany nonepad"> <a href="#" class="imgbox"> <img src="images/4.jpg"> <i class="fas fa-play"></i></a>
                      <div class="padboxs">
                       <span class="eyeicons"><i class="fas fa-eye"></i> 20,215</span> <span class="eyeicons"><i class="fas fa-flag"></i> 20,215</span>
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
              <div class="cenbottom nomergbotm" > <button type="button"  class="largeredbtn loadmoreCandidates" job-id="{{$jobStatstics->id}}" last-candidate-id = "{{($jobStatstics->topCandidates->last()['id'])?$jobStatstics->getTopCandidatesAttribute()->last()['id']:0}}" id ="{{$jobStatstics->id}}_loadmore" >load more candidates</button> 
              </div>
            @else
              
            @endif
          </div>
            <!--row--> 
          </div>
        </div>
