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
                @foreach($employerJobs as $job)
                
              <h4 class="textcandidate">{{$job->job_for}}</h4>
              <p>{{(\Auth::user()->name)?(\Auth::user()->name):'No Name'}}</p>
             
 
         <span>  
         @foreach($countrynames as $Adobs)
         {{$Adobs->CName}}
           @endforeach ,
           @foreach($citynames as $AddJobs)
          {{$AddJobs->cityName}}
            @endforeach
          </span> 

            
               </div>
             
            <!--detalsprofile-->
            
            <div class="detalsprofile">
             @if($job->job_for =='company' || $job->job_for =='agency' )
              <h4 class="textcandidate">5-20</h4>
              <span>employees</span>
            <!--detalsprofile-->
            @endif
              @endforeach
             </div>

            <div class="detalsprofile">
              <h4 class="textcandidate">{{count($employerJobs)}}</h4>
              <span>jobs posted</span> </div>
            <!--detalsprofile-->
            
            <div class="col-sm-12 cenbottom  edit-pro"> <a href="/company_profile/edit/{{\Auth::user()->company->id}}" class="largeredbtn">edit profile <i class="fas fa-pencil-alt"></i></a> </div>
          </div>
          <!--addicta--> 
          
        </div>
        <!--inner-aboutus--> 
        
      </div>
      <!--dashboardleft-->
      
      <div class="col-sm-9 dashboardleft">
        <div class="headtext">
          <h3 class="title-con"> jobs statstics </h3>
          <a href="/addPostJob" class="largeredbtn">add new job <i class="fas fa-plus"></i></a> </div>
        <!--headtext-->
        
        <ul class="nav nav-tabs tebprofile">
          @foreach($employerJobs as $job)
            <li class=" selecttab tab" value="{{$job->job->id}}"><a data-toggle="tab" href="#{{$job->job->name}}_{{$job->id}}">{{$job->job->name}}</a></li>
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
                    <h3>{{$job->seen|0}}</h3>
                    <i class="fas fa-eye"></i>
                    <p>views</p>
                  </li>
                  <li class="stars_job" job-id = "{{$job->id}}">
                    <h3>{{count($job->starred)}}</h3>
                    <i class="far fa-star"></i>
                    <p>starred</p>
                  </li>
                  <li>
                    <h3>0</h3>
                    <i class="fas fa-video"></i>
                    <p>interviewed</p>
                  </li>
                  <li class="applicants_job" job-id = "{{$job->id}}">
                    <h3>{{count($job->applicants)}}</h3>
                    <i class="far fa-hand-point-up"></i>
                    <p>applied</p>
                  </li>
                  <li class="liked_candidates" job-id = "{{$job->id}}">
                    <h3>{{count(\Auth::user()->likes)}}</h3>
                    <i class="far fa-thumbs-up"></i>
                    <p>likes</p>
                  </li>
                </ul>
              </div>
              <!--leftprofile-->
              
              <div class="col-sm-4 leftprofile">
                <div id="chartContainerTest"></div>
              </div>
              <!--leftprofile--> 
              
            </div>
            <!--row--> 
          <div class="inner-aboutus topmergline">
            <div class="currencytext resultstext">
              <h2>top candidates</h2>
            </div>
            <!--resultstext-->
            
            <div class="row topCanDiv_{{$job->id}}" >
              @if($job->getTopCandidatesAttribute()->first())
                @foreach($job->getTopCandidatesAttribute() as $candidate)
                  <div class="col-sm-4 company com-dashboard ">
                    <div class="ineercompany nonepad"> <a href="#" class="imgbox"> <img src="images/4.jpg"> <i class="fas fa-play"></i></a>
                      <div class="padboxs">
                       <span class="eyeicons"><i class="fas fa-eye"></i> 20,215</span> <span class="eyeicons"><i class="fas fa-flag"></i> 20,215</span>
                        <h4 class="innertitltext">{{$candidate->user->name}}</h4>
                        <p class="officer">nanny</p>
                        <ul class="hassle salary">
                          <li> 28 years</li>
                        
                        </ul>
                        <div class="tidivbotom"> 
                          <a href="/ViewJob/{{$candidate->id}}">know more</a> 
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
            <div class="can_links" style="text-align: center; margin-top: 5px;"></div>
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
                  <p class="officer">{{$sJob->job->name}}</p>
                  <ul class="hassle salary">
                    <li> <strong>loc.</strong> {{$sJob->country->name}}</li>
                    <li> <strong>salary.</strong> {{number_format($sJob->min_salary)}}-{{number_format($sJob->max_salary)}} {{($job->Currency)?$job->Currency->name:""}}</li>
                  </ul>
                  <div class="tidivbotom"> <a href="/ViewJob/{{$sJob->id}}">apply now</a> <span>{{$sJob->created_at}}</span>
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
<script>
  $('.stars_job').on('click', function(){
    var job_id = $(this).attr('job-id');
    $.ajax(
      {
        type:'GET',
        url:'/getCandidatesStaredJob',
        data:"jobId="+job_id,
        success: function(data){
          console.log(data);
          $('.topCanDiv_'+job_id).empty();
          $('.top-can-div_'+job_id).empty();
          $('.topCanDiv_'+job_id).append(data[0]);
          $('.can_links').empty();
          var links="";
          for (index = 1; index <= data[2].length; ++index) {
            if(index == 1)
            {
              links+="<button type='button' class='next_can_link' job_id='"+job_id+"' b_url='/next_can/0'>"+index+"</button>";
            }
            else
              links+="<button type='button' class='next_can_link' job_id='"+job_id+"' b_url='"+data[2][index-2]+"'>"+index+"</button>";
            
          }
                    console.log(links);
          $('.loadmoreCandidates').css('display','none');
          $('.can_links').append(links);        }
      });
  });
  $(document).on('click','.next_can_link',function(){
    url = $(this).attr('b_url');
    job_id = $(this).attr('job_id');
    $.ajax(
      {
        type:'GET',
        url:url,
        data:"job_id="+job_id,
        success: function(data){
          console.log(data);
          $('.topCanDiv_'+job_id).empty();
          $('.top-can-div_'+job_id).empty();
          $('.topCanDiv_'+job_id).append(data);
        }
      });
  });

  $('.applicants_job').on('click',function(){
    var job_id = $(this).attr('job-id');
  $.ajax(
      {
        type:'GET',
        url:'/getApplicants',
        data:"jobId="+job_id,
        success: function(data){
          console.log(data);
          $('.topCanDiv_'+job_id).empty();
          $('.top-can-div_'+job_id).empty();
          $('.topCanDiv_'+job_id).append(data[0]);
          $('.can_links').empty();
          var links="";
          for (index = 1; index <= data[2].length; ++index) {
            if(index == 1)
            {
              links+="<button type='button' class='next_can_link' job_id='"+job_id+"' b_url='/next_applicants/0'>"+index+"</button>";
            }
            else
              links+="<button type='button' class='next_can_link' job_id='"+job_id+"' b_url='"+data[2][index-2]+"'>"+index+"</button>";
            
          }
                    console.log(links);
          $('.loadmoreCandidates').css('display','none');
          $('.can_links').append(links);        
        }
      });
  });

  $('.liked_candidates').on('click',function(){
    var job_id = $(this).attr('job-id');
    $.ajax(
      {
        type:'GET',
        url:'/getLikes',
        success: function(data){
          console.log(data);
          $('.topCanDiv_'+job_id).empty();
          $('.top-can-div_'+job_id).empty();
          $('.topCanDiv_'+job_id).append(data[0]);
          $('.can_links').empty();
          var links="";
          for (index = 1; index <= data[2].length; ++index) {
            if(index == 1)
            {
              links+="<button type='button' class='next_user_link' job_id='"+job_id+"' b_url='/next_likes/0'>"+index+"</button>";
            }
            else
              links+="<button type='button' class='next_user_link' job_id='"+job_id+"' b_url='"+data[2][index-2]+"'>"+index+"</button>";
            
          }
          console.log(links);
          $('.loadmoreCandidates').css('display','none');
          $('.can_links').append(links);        
        }
      });
  });

   $(document).on('click','.next_user_link',function(){
    url = $(this).attr('b_url');
    job_id = $(this).attr('job_id');
    $.ajax(
      {
        type:'GET',
        url:url,
        success: function(data){
          console.log(data);
          $('.topCanDiv_'+job_id).empty();
          $('.top-can-div_'+job_id).empty();
          $('.topCanDiv_'+job_id).append(data);
        }
      });
    });

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
 
$(".tab").click(function () {
    $(".tab").removeClass("active");
    // $(".tab").addClass("active"); // instead of this do the below 
    $(this).addClass("active");  





  var selected= this.value;
   

console.log(selected);
$.ajax({

type: "POST",
    url: "/empolyerCount",
    data:{'selected':selected },
    
    success:function(data) {

var chart = new CanvasJS.Chart("chartContainerTest",
{
  title: {
    text: "Candidate"
  },
  data: [{
      type: "pie",
      startAngle: 45,
      showInLegend: "true",
      legendText: "{label}",
      indexLabel: "{label} ({y})",
      yValueFormatString:"#,##0.#"%"",
      dataPoints:data
  }]
});
chart.render();
}
});
});
});
</script>
@endsection