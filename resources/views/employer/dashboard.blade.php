@extends('Layout.app')

<style type="text/css">
  .header{
    position: relative!important;
  }
</style>

@section('content')

<section class="dashboard">
  <div class="container">
    <div class="row">
      <div class="col-sm-3 dashboardleft">
        <div class="inner-aboutus">
          <div class="linksing viewprofile"> <img src="{{(\Auth::user()->logo)?'(\Auth::user()->logo)':'images/callto-action.png'}}"> <a href="#" class="skiplink">view profile </a> </div>
          <!--viewprofile-->
          
          <div class="row addicta">
            <div class="detalsprofile">
              <h4 class="textcandidate">addicta</h4>
              <p>{{(\Auth::user()->name)?(\Auth::user()->name):'No Name'}}</p>
              <span>new cairo,egypt</span> </div>
            <!--detalsprofile-->
            
            <div class="detalsprofile">
              <h4 class="textcandidate">5-20</h4>
              <span>employees</span> </div>
            <!--detalsprofile-->
            
            <div class="detalsprofile">
              <h4 class="textcandidate">{{count($employerJobs)}}</h4>
              <span>jobs posted</span> </div>
            <!--detalsprofile-->
            
            <div class="col-sm-12 cenbottom  edit-pro"> <a href="#" class="largeredbtn">edit profile <i class="fas fa-pencil-alt"></i></a> </div>
          </div>
          <!--addicta--> 
          
        </div>
        <!--inner-aboutus--> 
        
      </div>
      <!--dashboardleft-->
      
      <div class="col-sm-9 dashboardleft">
        <div class="headtext">
          <h3 class="title-con"> jobs statstics </h3>
          <a href="#" class="largeredbtn">add new job <i class="fas fa-plus"></i></a> </div>
        <!--headtext-->
        
        <ul class="nav nav-tabs tebprofile">
          @foreach($employerJobs as $job)
            <li class="{{($job->id == $employerJobs->first()->id)?'active':''}}"><a data-toggle="tab" href="#{{$job->job->name}}_{{$job->id}}">{{$job->job->name}}</a></li>
          @endforeach
        </ul>
        <div class="tab-content">
        @foreach($employerJobs as $job)
          <div id="{{$job->job->name}}_{{$job->id}}" class="tab-pane fade in {{($job->id == $employerJobs->first()->id)?'active':''}}">
            <div class="row">
              <div class="col-sm-8 leftprofile">
                <div class="tidivbotom"> <span>{{$job->created_at}}</span></div>
                <!--tidivbotom-->
                
                <ul class="lastviws">
                  <li>
                    <h3>{{$job->seen}}</h3>
                    <i class="fas fa-eye"></i>
                    <p>views</p>
                  </li>
                  <li>
                    <h3>50</h3>
                    <i class="far fa-star"></i>
                    <p>starred</p>
                  </li>
                  <li>
                    <h3>2</h3>
                    <i class="fas fa-video"></i>
                    <p>interviewed</p>
                  </li>
                  <li>
                    <h3>70</h3>
                    <i class="far fa-hand-point-up"></i>
                    <p>applied</p>
                  </li>
                  <li>
                    <h3>200</h3>
                    <i class="far fa-thumbs-up"></i>
                    <p>recommended</p>
                  </li>
                </ul>
              </div>
              <!--leftprofile-->
              
              <div class="col-sm-4 leftprofile">
                <div id="chartContainer"></div>
              </div>
              <!--leftprofile--> 
              
            </div>
            <!--row--> 
          <div class="inner-aboutus topmergline">
            <div class="currencytext resultstext">
              <h2>top candidates</h2>
            </div>
            <!--resultstext-->
            
            <div class="row ">
              @if($job->getTopCandidatesAttribute()->first())
                @foreach($job->getTopCandidatesAttribute() as $candidate)
                  <div class="col-sm-4 company com-dashboard">
                    <div class="ineercompany nonepad"> <a href="#" class="imgbox"> <img src="images/4.jpg"> <i class="fas fa-play"></i></a>
                      <div class="padboxs">
                       <span class="eyeicons"><i class="fas fa-eye"></i> 20,215</span> <span class="eyeicons"><i class="fas fa-flag"></i> 20,215</span>
                        <h4 class="innertitltext">{{$candidate->user->name}}</h4>
                        <p class="officer">nanny</p>
                        <ul class="hassle salary">
                          <li> 28 years</li>
                          <li>{{$candidate->country->name}}</li>
                        </ul>
                        <div class="tidivbotom"> 
                          <a href="#">know more</a> 
                          <span>{{$candidate->created_at}}</span>
                        </div>
                        <!--tidiv--> 
                        
                      </div>
                      <!--padboxs--> 
                      
                    </div>
                    <!--inernews--> 
                    
                  </div>
                @endforeach
                <div class="top-can-div_{{$job->id}}"></div>
              <!--com-dashboard-->
              @else
              <h3 class="cenbottom" style="text-align: center;"> No Candidates</h3>
              @endif
            </div>
            <!--row-->
            @if($job->getTopCandidatesAttribute()->first())
              <div class="cenbottom nomergbotm" > <button type="button"  class="largeredbtn loadmoreCandidates" job-id="{{$job->id}}" last-candidate-id = "{{($job->topCandidates->last()['id'])?$job->getTopCandidatesAttribute()->last()['id']:0}}" id ="{{$job->id}}_loadmore" >load more candidates</button> 
              </div>
            @else
              
            @endif
          </div>
          <!--inner-aboutus-->

          <div class="inner-aboutus topmergline">
          <div class="currencytext resultstext">
            <h2>jobs & candidates</h2>
          </div>
          <!--resultstext-->
          
          <div class="row ">
          @if($job->getSimilarJobsAttribute()->first())
            @foreach($job->getSimilarJobsAttribute() as $sJob)
              <div class="col-sm-4 company com-dashboard">
                <div class="ineercompany">
                  <div class="tidiv"> <img src="images/car1.jpg"> <span> {{$sJob->job_for}}</span>
                  </div>
                  <!--tidiv-->
                  
                  <h4 class="innertitltext"> {{$sJob->user->name}} </h4>
                  <p class="officer">safely officer</p>
                  <ul class="hassle salary">
                    <li> <strong>loc.</strong> {{$sJob->country->name}}</li>
                    <li> <strong>salary.</strong> {{$sJob->min_salary}}-{{$sJob->max_salary}} omr</li>
                  </ul>
                  <div class="tidivbotom"> <a href="#">apply now</a> <span>{{$sJob->created_at}}</span>
                  </div>
                  <!--tidiv--> 
                  
                </div>
                <!--inernews-->
                
                <div class="row rowphoto">
                  @foreach($sJob->getTopCandidatesAttribute() as $key => $candidate)
                    @if($key < 4)
                    <div class="col-sm-2 photcarcal"><img src="{{($candidate->user->logo)?'($candidate->user->logo)':'images/callto-action.png'}}"></div>
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
              <div class="jobs-can-div_{{$job->id}}"></div>
            @else
              <h2 class="cenbottom nomergbotm " id ="{{$job->id}}_nomoreJobs">No More...</h2>
            @endif
          </div>
          <!--row-->
          @if($job->getSimilarJobsAttribute()->first())
            
            <div class="cenbottom  nomergbotm"> <button type="button" post-job-id="{{$job->getSimilarJobsAttribute()->last()['id']}}" job-id = "{{($job->id)?$job->id:0}}" id ="{{$job->id}}_loadmoreJobs" class="largeredbtn loadmoreCanJobs">load more jobs</a> </div>
            <h2 class="cenbottom nomergbotm " style="display: none;" id ="{{$job->id}}_nomoreJobs">No More...</h2>'
          @else
             <h2 class="cenbottom nomergbotm " id ="{{$job->id}}_nomoreJobs">No More...</h2>
          @endif
        </div>

          </div>
          <!--tab-pane-->


        @endforeach  

        </div>
        <!--tab-content-->
        
                
        
        
        <!--inner-aboutus--> 
        
      </div>
      
      <!--dashboardleft--> 
      
    </div>
    <!--row--> 
    
  </div>
  
  <!--container--> 
  
</section>
<!--section-->

<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> watch demo video
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="textbox">
        <iframe  src="https://www.youtube.com/embed/BFrLL5w9UGQ?autoplay=0" frameborder="0" allowfullscreen></iframe>
      </div>
      <!--textbox--> 
      
    </div>
  </div>
</div>
<!--myModal-->

<!--section-->
@endsection
@section('scripts')
<script>
  $('.loadmoreCandidates').on('click',function(){
    var job_id = $(this).attr('job-id');
    var candidate_info_id = $(this).attr('last-candidate-id');
    var new_last_id =candidate_info_id;
    var html="";
      $.ajax(
      {
        type:'GET',
        url:'/getNextTopCandidates',
        data:"jobId="+job_id+"&last_candidate_id="+candidate_info_id,
        success: function(data){
          
          console.log(job_id+'_more');
          $('.top-can-div_'+job_id).append(data.html);
          if(data.new_last_id == candidate_info_id)
          {
            $('#'+job_id+'_loadmore').css('display','none');
            $('#'+job_id+'_loadmore').text('No more');
            $('#'+job_id+'_loadmore').prop('disabled', true);
            $('.top-can-div_'+job_id).append('<h2 class="cenbottom nomergbotm">No More...</h2>');
          }
          $('#'+job_id+'_loadmore').attr('last-candidate-id',data.new_last_id);
        },
        error:function()
        {
          $('#'+job_id+'_loadmore').css('display','none');
            $('#'+job_id+'_loadmore').text('No more');
            $('#'+job_id+'_loadmore').prop('disabled', true);
            $('.top-can-div_'+job_id).append('<h2 class="cenbottom nomergbotm">No More...</h2>');
        }  
      });
  
  });

  /** jobs& candidates*/
  $('.loadmoreCanJobs').on('click',function(){
    var post_job_id = $(this).attr('post-job-id');
    var job_id = $(this).attr('job-id');
    console.log($(this).attr('id'));
    var new_last_id =post_job_id;
    var html="";
      $.ajax(
      {
        type:'GET',
        url:'/getNextJobCandidates',
        data:"jobId="+job_id+"&post_job_id="+post_job_id,
        success: function(data){
          console.log(data);
          $('.jobs-can-div_'+job_id).append(data.html);

          if(data.new_last_id == post_job_id)
          {
            $('#'+job_id+'_loadmoreJobs').css('display','none');
            $('#'+job_id+'_loadmoreJobs').text('No more');
            $('#'+job_id+'_loadmoreJobs').prop('disabled', true);
            $('#'+job_id+'_nomoreJobs').css('display','block');
          }
          $('#'+job_id+'_loadmoreJobs').attr('post-job-id',data.new_last_id);
        },
        error: function()
        {
           $('#'+job_id+'_loadmoreJobs').css('display','none');
            $('#'+job_id+'_loadmoreJobs').text('No more');
            $('#'+job_id+'_loadmoreJobs').prop('disabled', true);
            $('#'+job_id+'_nomoreJobs').css('display','block');
        }

      });
  
  });
</script>
@endsection