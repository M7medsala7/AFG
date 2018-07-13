@extends('Layout/Master')
@section('content')
<style type="text/css">
  .ineercompany {
    min-height: 300px;
  }

</style>
<div class="sliderphoto" style="background:url(/images/slide5.jpg) fixed center center no-repeat; background-size:cover;">
  <div class="container textslider">
    <h1 class="titltop"><span>Candidates & employers</span><br/>
      well connected here </h1>
    
     <form action="/search" method="get" class="input-search">
      <select name="type" class="selectpicker" id="search_type">
     
        <option>I am Candidate</option>
        <option>I Am Employer</option>
        
      </select>
      <input type="text" class="form-control" name ="words"  id="myInput" placeholder="search for jobs, candidates keywords...">
      <button type="submit" class="fas fa-search btn-slide"> </button>
    </form>
  
    
    
    
    
    
    <!--input-search-->
    
    <div class="centerboxs">
      <div class="innertetxr">
        <h2 class="textcandidate">i‘m candidate</h2>
        <ul class="hassle">
          <li>find a job easily</li>
          <li>reach your employer directly</li>
          <li>forget about agencies hassle</li>
        </ul>
        <a href="/register/candidates" class="largeredbtn">Find a job</a> </div>
      <!--innertetxr-->
      <div class="innertetxr">
        <h2 class="textcandidate">i‘m employer</h2>
        <ul class="hassle">
          <li>find a job easily</li>
          <li>reach your employer directly</li>
          <li>forget about agencies hassle</li>
        </ul>
        <a href="/register/employer" class="largeredbtn">post a job</a> </div>
      <!--innertetxr--> 
      
    </div>
    <!--centerboxs--> 
    
  </div>
  <!--container--> 
  
</div>

<!--//siderdiv-->

<section class="recently-job">
  <div class="container">
    <h3 class="title-con">recently added jobs</h3>
    <div class="row">

       @foreach($RecentlyAddedJobs as $AddJobs)
      <div class="col-sm-3 company">
        <div class="ineercompany">
          <div class="tidiv"> <img src="/images/car1.jpg"> <span>{{$AddJobs->type}}</span></div>
          <!--tidiv-->
          
          <h4 class="innertitltext">{{$AddJobs->CompanyName}} </h4>
          <p class="officer">{{$AddJobs->JobName}}</p>
          <ul class="hassle salary">
            <li> <strong>loc.</strong> {{$AddJobs->CountryName}}</li>
            <li> <strong>salary.</strong> {{$AddJobs->max_salary}}</li>
          </ul>
          <div class="tidivbotom"> <a href="/ViewJob/{{$AddJobs->id}}">View Job</a> <span>{{ \Carbon\Carbon::parse($AddJobs->Jobdate)->format('d/M/Y')}}</span></div>
          <!--tidiv--> 
   




         <a href="https://www.facebook.com/dialog/share?
app_id=1112718265559949
&display=popup
&title='maid and helper'

&description='Mohamed salah'
&quote={{$AddJobs->job_descripton}}
&caption='Dody'
&href=https://www.maidandhelper.com/ViewJob/{{$AddJobs->id}}
&redirect_uri=https://www.facebook.com/" onclick="" ><i class="fas fa-share-alt"></i></a>

     

        </div>
        <!--inernews--> 
    

      </div>
      @endforeach
      <!--bocprod-->
      
      
      
     
      <!--bocprod-->
      
  
      <!--bocprod--> 
      
    </div>
    <!--row-->
    
    <div class="cenbottom"> <a href="/search?type=I+am+Candidate&words=" class="largeredbtn">view more jobs <i class="fas fa-long-arrow-alt-right"></i></a> </div>
    <!--cenbottom--> 
    
  </div>
  <!--//container--> 
  
</section>
<!--sacboxcars-->

<section class="top-candidates">
  <div class="container">
    <h3 class="title-con entea"> top Candidates</h3>
    <div class="row">
      @foreach($TopCandidate as $TopCandi)
     
      <div class="col-sm-3 company">
        <div class="ineercompany nonepad">
          <a   class="imgbox" onclick="ShowVideo('/{{$TopCandi->vedio_path}}','{{File::extension($TopCandi->vedio_path)}}')"> 

        <img src="{{($TopCandi->user->logo)?$TopCandi->user->logo:'images/4.jpg'}}"> <i class="fas fa-play"></i>  </a>
          <div class="padboxs"> <span class="eyeicons"><i class="fas fa-eye"></i> 20,215</span> <span class="eyeicons"><i class="fas fa-flag"></i> 20,215</span>
            <h4 class="innertitltext">{{$TopCandi->user->name}}</h4>
            <p class="officer">{{$TopCandi->job->name}}</p>
            <ul class="hassle salary">
              
             <li>{{($TopCandi->nationality)?$TopCandi->nationality->name:"Nationality is not set"}}</li>
            </ul>
            <div class="tidivbotom"> <a href="/candidate/{{$TopCandi->user->id}}">View Profile</a> <span>{{$TopCandi->created_at}}</span></div>
            <!--tidiv--> 
     </div>
          <!--padboxs--> 
          <i class="fa fa-facebook-square"></i>
    

<a href="https://www.facebook.com/dialog/share?
app_id=1112718265559949
&display=popup
&title='maid and helper'
&description='Mohamed salah'
&quote={{$TopCandi->descripe_yourself}}
&caption='Dody'
&href=https://www.maidandhelper.com/candidate/{{$TopCandi->user->id}}+'?og_img='+{{($TopCandi->user->logo)?$TopCandi->user->logo:'images/4.jpg'}}

&redirect_uri=https://www.facebook.com/"><i class="fas fa-share-alt"></i></a>


        </div>
        <!--inernews--> 
    
      </div>
      <!--bocprod-->
  
     @endforeach
      

      
     
      
      
    </div>
    <!--row-->
    
    <div class="cenbottom nbottom"> <a href="/search?type=I+Am+Employer&words=" class="largeredbtn">view more Candidates <i class="fas fa-long-arrow-alt-right"></i></a> </div>
    <!--cenbottom--> 
    
  </div>
  <!--//container--> 
</section>
<!--sacbox-->

<div class="container">
  <h3 class="title-con enteacolor"> how it works</h3>
  <div class="works"><img src="images/works.jpg"> </div>
  <!--works-->
  <div class="cenbottom"> <a href="/signup" class="largeredbtn">start now <i class="fas fa-long-arrow-alt-right"></i></a> </div>
  <!--cenbottom--> 
  
</div>

<!--//container-->

<section class="success" style="background:url(images/slide5.jpg) fixed center center no-repeat; background-size:cover;">
  <div class="container">
    <h3 class="title-con entea"> success stories</h3>
    <div class="your-stud">
@foreach($SuccessStories as $SuccessStor)
      <div>
        <h4 class="titltop"><span>finding a maid was never that easy and less expensive,thanks</span><br>
          maid and helper</h4>
          @if($SuccessStor->logo==null)
          <img src="images/callto-action.png">
          @else
        <img src="{{$SuccessStor->logo}}">
        @endif
        <h5 class="gebox-tit">{{$SuccessStor->name}}</h5>
        <p class="viewsdriver">{{$SuccessStor->description}}</p>
      </div>
      <!--div-->
      @endforeach
    
      <!--div-->
      
    
      <!--div-->
      
     
      <!--div--> 
      
    </div>
    <!--your-stud-->
    
    <div class="cenbottom nbottom"> <a href="#" class="largeredbtn">view more testimonials <i class="fas fa-long-arrow-alt-right"></i></a> </div>
  </div>
  <!--container--> 
</section>
<!--slidevnt-->
<div class="container">
  <h3 class="title-con enteacolor mergtext"> insights</h3>
  <div class="row">
    <div class="col-sm-3 crcals">
      <div class="centers"><i class="fas fa-user"></i></div>
      <h2 class="timer count-title count-number" data-to="{{$TotalJob}}" data-speed="1500"></h2>
      <p class="count-text ">jobs</p>
    </div>
    <!--crcals-->
    
    <div class="col-sm-3 crcals">
      <div class="centers"><i class="fas fa-users"></i></div>
      <h2 class="timer count-title count-number" data-to={{$TotalCandidate}} data-speed="1500"></h2>
      <p class="count-text ">Candidates</p>
    </div>
    <!--crcals-->
    
    <div class="col-sm-3 crcals">
      <div class="centers"><i class="fas fa-file-alt"></i></div>
      <h2 class="timer count-title count-number" data-to={{$TotalVideoCvs}} data-speed="1500"></h2>
      <p class="count-text ">video cvs</p>
    </div>
    <!--crcals-->
    
    <div class="col-sm-3 crcals">
      <div class="centers"><i class="fas fa-female"></i></div>
      <h2 class="timer count-title count-number" data-to={{$TotalAnsweredQuestions}} data-speed="1500"></h2>
      <p class="count-text ">answered questions</p>
    </div>
    <!--crcals--> 
    
  </div>
  <!--row--> 
  
</div>

<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> watch video
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="textbox" id="v1">
      
      </div>
      <!--textbox--> 
      
    </div>
  </div>
</div>
<!--myModal-->

 @stop
@section('scripts')
<script>
  var searchtype = $('#search_type').val();
  if(searchtype == "")
  {
    $('.input-search').on('click',function(){
      $('.select_search_type').css('display','block');
      console.log(searchtype);
    });
  }
  else
  {

  }
$('.select_type').on('click',function(){
    $('.select_search_type').remove();
    searchtype=$(this).attr('type_val');
    $('#search_type').val(searchtype);
  });
</script>
<Script>
function ShowVideo($id,$type)
{
  
 $typeM='video/'+$type;
var int="";
$("#v1").html('');

$("#v1").html('<video style="text-align: center;width: 100%;" controls><source src="'+$id+'" type='+$typeM+'></source></video>' );

 $('#myModal').modal('show');
}

</script>
@endsection