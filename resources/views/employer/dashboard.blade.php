@extends('Layout.app')
<style type="text/css">
  .header{
    position: relative!important;
  }

 
input[type="file"] {
    display: none;
}
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
}


.checkboxallJob {
position: unset !important;
     left: 100px !important;
}
.checkboxthJob {
position: unset !important;
     left: 100px !important;
}

.checkboxallClient {
position: unset !important;
     left: 100px !important;
}

.checkboxthclient {
position: unset !important;
     left: 100px !important;
}
.heart {
  cursor: pointer;
  height: 50px;
  width: 50px;
  margin-left: 130px;
  background-image:url(  'https://abs.twimg.com/a/1446542199/img/t1/web_heart_animation.png');
  background-position: left;
  background-repeat:no-repeat;
  background-size:2900%;
 }

 .heart:hover {
  background-position:right;
 }
 .red {
  background-position:right;
 }


 .animating {
  animation: heart-burst .8s steps(28) 1;
 }

 @keyframes heart-burst {
 from {background-position:left;}
 to { background-position:right;}
 }




</style>
@section('content')

 @if(Session::get('locale')=="Ar"|| Session::get('locale')=="ar")
{{App::setLocale('ar')}}
@else
{{App::setLocale('en')}}
@endif


<section class="dashboard">
  <div class="container">
    <div class="row">
      <div class="col-sm-3 dashboardleft">
        <div class="inner-aboutus">
            <form id="form1" runat="server">
          <div class="linksing viewprofile"> 
           <img id="image_upload_preview" src="{{(\Auth::user()->logo)?(\Auth::user()->logo):'images/callto-action.png'}}" alt=" your image"> 


         



  <label for="file-upload" class="custom-file-upload">
    <a  class="fas fa-pencil-alt" ></a> 
</label>
<input  name="imageProfile" style="display: none"  id="file-upload" type="file"/>
 <input name='userId' type='hidden' id ="canid" value=" {{(\Auth::user()->id)}}" />



 



            </div> 
            </form> 
          <!--viewprofile-->
          <div class="row addicta">
            <div class="detalsprofile">
              <h4 class="textcandidate">{{$employerJobsfor->type}}</h4>
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
             @if($employerJobsShow['job_for'] =='company' || $employerJobsShow['job_for'] =='agency' )
              <h4 class="textcandidate">{{$employerJobsfor->user->company->size}}</h4>
              <span>employees</span>
            <!--detalsprofile-->
            @endif
          @if($employerJobsfor->type == "Agency" || $employerJobsfor->type == "agency")
           
          @endif
             </div>

            <div class="detalsprofile">
              <h4 class="textcandidate">{{count($employerJobs)}}</h4>
              <span> {{trans('app.jobs_posted')}}</span> </div>
            <!--detalsprofile-->
            
            <div class="col-sm-12 cenbottom  edit-pro"> <a href="/company_profile/edit/{{\Auth::user()->company->id}}" class="largeredbtn"> {{trans('app.edit_profile')}}<i class="fas fa-pencil-alt"></i></a> </div>
            <div class="row addicta">
            <div class="detalsprofile">
            <h6 class="textcandidate"> {{trans('app.your_Curent_Package')}}</h6>
            <br>
            <br>
            <h6 class="">PackageName :{{($PackagesUser)?($PackagesUser->name):''}}  </h6><br>
            <h6 class="">DueDate :{{($PackagesUser)?($PackagesUser->EndDate):''}}</h6><br>
            <h6 class="">Call Ramain :{{$Packageattr1}} / {{$Remain1}}</h6><br>
            <h6 class="">Video Remain : {{$Packageattr2}} / {{$Remain2}}</h6><br>
            <h6 class="">CV Remain : {{$Packageattr3}} / {{$Remain3}}</h6><br>
            <a class="textcandidate" href="/Payment">  {{trans('app.More_details_on_packages')}}</a><br>
           </div>
           </div>

          </div>
          <!--addicta--> 
          
        </div>
        <!--inner-aboutus--> 
        
      </div>
      <!--dashboardleft-->
     
      <div class="col-sm-9 dashboardleft">
        <div class="headtext">
          <h3 class="title-con"> {{trans('app.jobs_statstics')}}</h3>
          <a href="/addPostJob" style="margin-right: 5px;" class="largeredbtn"> {{trans('app.add_new_job')}} <i class="fas fa-plus"></i></a>
          <a href="/favouritecan" class="largeredbtn" style="margin-right: 15px;"> {{trans('app.Candidate')}}<i class="fas fa-heart"></i></a>

         
         
          @if($employerJobsfor->type == "Agency" || $employerJobsfor->type == "agency")
          <a href="/owncandidate"  class="largeredbtn" style="margin-right: 15px;"> {{trans('app.your_Candidate')}}<i class="fas fa-plus"></i></a> 

          @endif
@if($employerJobsfor->type == "Agency" || $employerJobsfor->type == "agency")
          <a href="/clients"  class="largeredbtn" style="margin-right: 20px;">  {{trans('app.your_Clients')}}<i class="fas fa-plus"></i></a> 
          @endif
 @if(\Auth::user()->type == "client")
          <a href="/sharedClient"  class="largeredbtn" style="margin-right: 15px;"> {{trans('app.Shared_Client')}}<i class="fas fa-eye"></i></a> 
          @endif
  
          </div>
        <!--headtext-->

      @if($count==0)

    
<div class="inner-aboutus topmergline">

       
         @endif
        <ul class="nav nav-tabs tebprofile">
             <?php  $i=0; ?>
          @foreach($employerJobs as $job)
            <li class=" selecttab tab" value="{{$job->job->id}}"><a data-toggle="tab" href="#{{$job->job->name}}_{{$job->id}}">{{$job->job->name}}</a></li>

            <?php $i++;?>
                      @if($i==3) 
                      @break;
                      @endif


          @endforeach
           <li class="  tab active" ><a  href="/ShowAllJob/{{\Auth::user()->id}}}"> {{trans('app.Show_All_Jobs')}}</a></li>
        </ul>
        <div class="tab-content">
    
    
        @foreach($employerJobs as $job)
          <div id="{{$job->job->name}}_{{$job->id}}" class="tab-pane fade in {{($job->id == $employerJobs->first()->id)?'active':''}}">
            @include('employer.JobsStatstics')

          <!--inner-aboutus-->
      
   

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
      <div class="modal-header">   {{trans('app.watch_demo_video')}}
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
<div id="myModal1" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> watch video
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
     
      <div class="modal-body" id="v1">
       
        </div>
    
      <!--textbox--> 
      
    </div>
  </div>
</div>
<!--myModal-->

<div id="LikedModal" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header"> 
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel" style="font-size: 18pt">Take Acation</h4>
      </div>
      <div class="row">

 
<div class="col-md-12" style="margin-bottom: 25px;">

   <button type="button" class="largeredbtn col-sm-6  " onclick="toggleVisibility('jobdiv');" >Assign To Job</button>
    <button type="button" class="largeredbtn col-sm-6" onclick="toggleVisibility('clientdiv');">Share To Client</button>
  

 
         </div>


         <div  id="jobdiv" style="width: 80%; margin-left:50px;">
            <label> Assign  to Job</label>
          <table  id= "bootstrap-data-table" class="table table-striped table-bordered dt-responsive jobshare" style="width: 80%">

         

       
                    <thead>
                      <tr>
                          <th><input type="checkbox" id="check_allJob" class="checkboxthJob"></th>
                        <th>Name</th>
                    
                      </tr>
                    </thead>
                    <tbody>
                      @foreach( $employerJobs as $all)
       <tr id="tr_{{$all->id}}">
                    <td><input type="checkbox" class="checkboxallJob" data-id="{{$all->job->id}}"></td>
          <td><a class="tiptext">{{$all->job->name}}</td>

    

     


               




                      </tr>
                      @endforeach
                      
                   
                    
                    
                    </tbody>
                  </table>

                  <button style=" margin: 5px; margin-left: 300px" class="btn btn-success btn-lg share">Share </button>
         </div>

         <div id="clientdiv"  style="width: 80%; margin-left:50px; display: none;">
           <label> Share to Client</label>
                  <table  id= "bootstrap-data-table" class="table table-striped table-bordered dt-responsive Client" style="width: 80%">

         

       
                    <thead>
                      <tr>
                          <th><input type="checkbox" id="check_allClient" class="checkboxthclient"></th>
                        <th>Name</th>
                    
                      </tr>
                    </thead>
                    <tbody>
                      @foreach( $allClients as $all)
       <tr id="tr_{{$all->id}}">
                    <td><input type="checkbox" class="checkboxallClient" data-id="{{$all->id}}"></td>
          <td><a class="tiptext">{{$all->name}}</td>

    

     


               




                      </tr>
                      @endforeach
                      
                   
                    
                    
                    </tbody>
                  </table>
 <textarea  placeholder="Add Comment... " id="agencycomment" style="  border-style: inset;
    border-width: 2px; width: 400px"></textarea>
                  <button style=" margin: 5px; margin-left: 300px" class="btn btn-success btn-lg sharecan">Share </button>
         </div>



         </div>         
       </div>
    </div>
  </div>
</div>
<!--section-->

@endsection
@section('scripts')
<script>

function ShowVideo($id,$type)
{
$typeM='video/'+$type;
var int="";
$("#v1").html('');


$("#v1").html('<video style="text-align:center;margin:5% 5% 5% 5%;width:85%;" controls><source src="'+$id+'" ></source></video>' );

$('#myModal1').modal('show');
}
</script>
     <script>

$(document).ready(function() {

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

$('.stars_job').on('click',function(){
 var job_id = $('.stars_job').attr('job-id');

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
$('.liked_candidates').on('click',function(){
  var job_id =  $('.liked_candidates').attr('job-id');
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



$('.applicants_job').on('click',function(){
  var job_id =$('.applicants_job').attr('job-id');
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });




    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image_upload_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
            console.log(input.files[0]);
        }
    }

    $("#file-upload").change(function () {
      
        readURL(this);
 var id=  $("#canid").val();
 var images= this.files[0]; 
  
       var fd = new FormData();
    fd.append('id', id);
    fd.append('images',images);
var dataString = "id="+id+"&images="+images;
            $.ajax({
            url: '/updateimage',
             type: "POST",
                    contentType: false, // Not to set any content header
                    processData: false, // Not to process data
                    data: fd,
     
            
       
    });





    });


$(".tab").click(function () {
    $(".tab").removeClass("active");
    // $(".tab").addClass("active"); // instead of this do the below 
    $(this).addClass("active");  
  var selected= this.value;
$.ajax({

type: "POST",
    url: "/jobStatstics",
    data:{'selected':selected },
    
    success:function(data) {


 $('.jobStatstics').html(data);

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


   $('.stars_job').on('click',function(){
 var job_id = $('.stars_job').attr('job-id');

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
$('.liked_candidates').on('click',function(){
  var job_id =  $('.liked_candidates').attr('job-id');
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



$('.applicants_job').on('click',function(){
  var job_id =$('.applicants_job').attr('job-id');
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

}
});




   

console.log(selected);

});

});
</script>
<script type="text/javascript">
  
$(document).ready(function() {
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
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



    });
</script>
<script type="text/javascript">

  var divs = ["jobdiv", "clientdiv"];
var visibleDivId = null;
function toggleVisibility(divId) {
  if(visibleDivId === divId) {
    //visibleDivId = null;
  } else {
    visibleDivId = divId;
  }
  hideNonVisibleDivs();
}
function hideNonVisibleDivs() {
  var i, divId, div;
  for(i = 0; i < divs.length; i++) {
    divId = divs[i];
    div = document.getElementById(divId);
    if(visibleDivId === divId) {
      div.style.display = "block";
    } else {
      div.style.display = "none";
    }
  }
}

 
  $(".heart").on('click touchstart', function(){

var candidateid = document.getElementById('heart').getAttribute('value');
   
  $(this).toggleClass('animating');
  $('#LikedModal').modal('show');
  
 $(this).addClass('red');
  
});


$(".heart").on('animationend', function(){
  $(this).toggleClass('animating');
  

});


$(document).ready(function() {

 var table = $('.jobshare').DataTable( {
 select:true,

    responsive: true,
    "order":[[0,"asc"]],
    'searchable':true,
    "scrollCollapse":true,
    "paging":true,

      dom: 'lBfrtip'
      });

    var table = $('.Client').DataTable( {
 select:true,

    responsive: true,
    "order":[[0,"asc"]],
    'searchable':true,
    "scrollCollapse":true,
    "paging":true,

      dom: 'lBfrtip'
      });
   $('.share').on('click', function(e) {

     var idsjobArr = [];  
            $(".checkboxallJob:checked").each(function() { 

                idsjobArr.push($(this).attr('data-id'));
            });

               if(idsjobArr.length <=0)  
            {  
                  alert("Please select at least one record to share.");  
            }  else {

           
var candidateid = document.getElementById('heart').getAttribute('value');
            
var jobIds = idsjobArr.join(","); 
                    $.ajax({
                        url: '/sharejobtocandidate',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        type: 'POST',
                        data: {"_token": "{{ csrf_token() }}",
                       canids:candidateid,jobIds:jobIds},
                        success: function (data) {
                            if (data['status']==true) {
                                $(".checkboxallJob:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                 $(document).ajaxStop(function() { location.reload(true); });
                                alert(data['message']);

                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                           
                        }
                    });

             }


   });


      $('.sharecan').on('click', function(e) {

     var idsclientArr = [];  
            $(".checkboxallClient:checked").each(function() { 

                idsclientArr.push($(this).attr('data-id'));
            });

               if(idsclientArr.length <=0)  
            {  
                  alert("Please select at least one record to share.");  
            }  else {

            var agencycomment = $("#agencycomment").val();

             var candidateid = document.getElementById('heart').getAttribute('value');
var clientIds = idsclientArr.join(","); 
                    $.ajax({
                        url: '/shareclient',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        type: 'POST',
                        data: {"_token": "{{ csrf_token() }}",
                       canids:candidateid,agencycomment:agencycomment,clientids:clientIds},
                        success: function (data) {
                            if (data['status']==true) {
                                $(".checkboxallClient:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                 $(document).ajaxStop(function() { location.reload(true); });
                                alert(data['message']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                           
                        }
                    });

             }


   });

  });

</script>
@stop