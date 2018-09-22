@extends('Layout/Master')
@section('content')
<style type="text/css">
  .ineercompany {
    min-height: 300px;
  }
.resp-sharing-button__link,
.resp-sharing-button__icon {
  display: inline-block
}

.resp-sharing-button__link {
  text-decoration: none;
  color: #fff;
  margin: 0.5em
}

.resp-sharing-button {
  border-radius: 5px;
  transition: 25ms ease-out;
  padding: 0.5em 0.5em;
  font-family: Helvetica Neue,Helvetica,Arial,sans-serif
}

.resp-sharing-button__icon svg {
  width: 1em;
  height: 1em;
  margin-right: 0.4em;
  vertical-align: top
}

.resp-sharing-button--small svg {
  margin: 0;
  vertical-align: middle
}

/* Non solid icons get a stroke */
.resp-sharing-button__icon {
  stroke: #fff;
  fill: none
}

/* Solid icons get a fill */
.resp-sharing-button__icon--solid,
.resp-sharing-button__icon--solidcircle {
  fill: #fff;
  stroke: none
}

.resp-sharing-button--twitter {
  background-color: #55acee
}

.resp-sharing-button--twitter:hover {
  background-color: #2795e9
}




.resp-sharing-button--facebook {
  background-color: #3b5998
}

.resp-sharing-button--facebook:hover {
  background-color: #2d4373
}


.resp-sharing-button--google {
  background-color: #dd4b39
}

.resp-sharing-button--google:hover {
  background-color: #c23321
}

.resp-sharing-button--linkedin {
  background-color: #0077b5
}

.resp-sharing-button--linkedin:hover {
  background-color: #046293
}

.resp-sharing-button--email {
  background-color: #777
}

.resp-sharing-button--email:hover {
  background-color: #5e5e5e
}



.resp-sharing-button--whatsapp {
  background-color: #25D366
}

.resp-sharing-button--whatsapp:hover {
  background-color: #1da851
}



.resp-sharing-button--facebook:hover,
.resp-sharing-button--facebook:active {
  background-color: #2d4373;
  border-color: #2d4373;
}

.resp-sharing-button--twitter {
  background-color: #55acee;
  border-color: #55acee;
}

.resp-sharing-button--twitter:hover,
.resp-sharing-button--twitter:active {
  background-color: #2795e9;
  border-color: #2795e9;
}

.resp-sharing-button--google {
  background-color: #dd4b39;
  border-color: #dd4b39;
}

.resp-sharing-button--google:hover,
.resp-sharing-button--google:active {
  background-color: #c23321;
  border-color: #c23321;
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

       @foreach($RecentlyAddedJobsCompany as $AddJobs)
      <div class="col-sm-3 company">
        <div class="ineercompany">
          <div class="tidiv"> <img src="/images/car1.jpg"> <span>{{$AddJobs->job_for}}</span></div>
          <!--tidiv-->
          
          <h4 class="innertitltext">{{$AddJobs->CompanyName}} </h4>
          <p class="officer">{{$AddJobs->JobName}}</p>
          <ul class="hassle salary">
            <li> <strong>loc.</strong> {{$AddJobs->CountryName}}</li>
            <li> <strong>salary.</strong> {{number_format($AddJobs->max_salary)}}</li>
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



         @foreach($RecentlyAddedJobsFamily as $AddJobs)
      <div class="col-sm-3 company">
        <div class="ineercompany">
          <div class="tidiv"> <img src="/images/car1.jpg"> <span>{{$AddJobs->job_for}}</span></div>
          <!--tidiv-->
          
          <h4 class="innertitltext">{{$AddJobs->CompanyName}} </h4>
          <p class="officer">{{$AddJobs->JobName}}</p>
          <ul class="hassle salary">
            <li> <strong>loc.</strong> {{$AddJobs->CountryName}}</li>
            <li> <strong>salary.</strong> {{number_format($AddJobs->max_salary)}}</li>
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
    







<a class="resp-sharing-button__link" href="https://facebook.com/sharer/sharer.php?u=https://www.maidandhelper.com/candidate/{{$TopCandi->user->id}}" target="_blank" aria-label="Share on Facebook">
  <div class="resp-sharing-button resp-sharing-button--facebook resp-sharing-button--large"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/></svg>
    </div></div>
</a>


<!-- Sharingbutton Twitter -->
<a class="resp-sharing-button__link" href="https://twitter.com/intent/tweet/?text={{$TopCandi->descripe_yourself}}.&amp;url=https://www.maidandhelper.com/candidate/{{$TopCandi->user->id}}" target="_blank" aria-label="Share on Twitter">
  <div class="resp-sharing-button resp-sharing-button--twitter resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M23.44 4.83c-.8.37-1.5.38-2.22.02.93-.56.98-.96 1.32-2.02-.88.52-1.86.9-2.9 1.1-.82-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.03.7.1 1.04-3.77-.2-7.12-2-9.36-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.74-.03-1.44-.23-2.05-.57v.06c0 2.2 1.56 4.03 3.64 4.44-.67.2-1.37.2-2.06.08.58 1.8 2.26 3.12 4.25 3.16C5.78 18.1 3.37 18.74 1 18.46c2 1.3 4.4 2.04 6.97 2.04 8.35 0 12.92-6.92 12.92-12.93 0-.2 0-.4-.02-.6.9-.63 1.96-1.22 2.56-2.14z"/></svg>
    </div></div>
</a>

<!-- Sharingbutton Google+ -->
<a class="resp-sharing-button__link" href="https://plus.google.com/share?url=https://www.maidandhelper.com/candidate/{{$TopCandi->user->id}}" target="_blank" aria-label="">
  <div class="resp-sharing-button resp-sharing-button--google resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.37 12.93c-.73-.52-1.4-1.27-1.4-1.5 0-.43.03-.63.98-1.37 1.23-.97 1.9-2.23 1.9-3.57 0-1.22-.36-2.3-1-3.05h.5c.1 0 .2-.04.28-.1l1.36-.98c.16-.12.23-.34.17-.54-.07-.2-.25-.33-.46-.33H7.6c-.66 0-1.34.12-2 .35-2.23.76-3.78 2.66-3.78 4.6 0 2.76 2.13 4.85 5 4.9-.07.23-.1.45-.1.66 0 .43.1.83.33 1.22h-.08c-2.72 0-5.17 1.34-6.1 3.32-.25.52-.37 1.04-.37 1.56 0 .5.13.98.38 1.44.6 1.04 1.84 1.86 3.55 2.28.87.23 1.82.34 2.8.34.88 0 1.7-.1 2.5-.34 2.4-.7 3.97-2.48 3.97-4.54 0-1.97-.63-3.15-2.33-4.35zm-7.7 4.5c0-1.42 1.8-2.68 3.9-2.68h.05c.45 0 .9.07 1.3.2l.42.28c.96.66 1.6 1.1 1.77 1.8.05.16.07.33.07.5 0 1.8-1.33 2.7-3.96 2.7-1.98 0-3.54-1.23-3.54-2.8zM5.54 3.9c.33-.38.75-.58 1.23-.58h.05c1.35.05 2.64 1.55 2.88 3.35.14 1.02-.08 1.97-.6 2.55-.32.37-.74.56-1.23.56h-.03c-1.32-.04-2.63-1.6-2.87-3.4-.13-1 .08-1.92.58-2.5zM23.5 9.5h-3v-3h-2v3h-3v2h3v3h2v-3h3"/></svg>
    </div>
  </div>
</a>



<!-- Sharingbutton WhatsApp -->
<a class="resp-sharing-button__link" href="whatsapp://send?text={{$TopCandi->descripe_yourself}}https://www.maidandhelper.com/candidate/{{$TopCandi->user->id}}" target="_blank" aria-label="Share on WhatsApp">
  <div class="resp-sharing-button resp-sharing-button--whatsapp resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20.1 3.9C17.9 1.7 15 .5 12 .5 5.8.5.7 5.6.7 11.9c0 2 .5 3.9 1.5 5.6L.6 23.4l6-1.6c1.6.9 3.5 1.3 5.4 1.3 6.3 0 11.4-5.1 11.4-11.4-.1-2.8-1.2-5.7-3.3-7.8zM12 21.4c-1.7 0-3.3-.5-4.8-1.3l-.4-.2-3.5 1 1-3.4L4 17c-1-1.5-1.4-3.2-1.4-5.1 0-5.2 4.2-9.4 9.4-9.4 2.5 0 4.9 1 6.7 2.8 1.8 1.8 2.8 4.2 2.8 6.7-.1 5.2-4.3 9.4-9.5 9.4zm5.1-7.1c-.3-.1-1.7-.9-1.9-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.1-.2.2-.3.2-.6.1s-1.2-.5-2.3-1.4c-.9-.8-1.4-1.7-1.6-2-.2-.3 0-.5.1-.6s.3-.3.4-.5c.2-.1.3-.3.4-.5.1-.2 0-.4 0-.5C10 9 9.3 7.6 9 7c-.1-.4-.4-.3-.5-.3h-.6s-.4.1-.7.3c-.3.3-1 1-1 2.4s1 2.8 1.1 3c.1.2 2 3.1 4.9 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.6-.1 1.7-.7 1.9-1.3.2-.7.2-1.2.2-1.3-.1-.3-.3-.4-.6-.5z"/></svg>
    </div></div>
</a>

<!-- Sharingbutton LinkedIn -->
<a class="resp-sharing-button__link" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://www.maidandhelper.com/candidate/{{$TopCandi->user->id}}&amp;title={{$TopCandi->user->name}}.&amp;summary={{$TopCandi->descripe_yourself}}.&amp;source=https://www.maidandhelper.com" target="_blank" aria-label="Share on LinkedIn">
  <div class="resp-sharing-button resp-sharing-button--linkedin resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M6.5 21.5h-5v-13h5v13zM4 6.5C2.5 6.5 1.5 5.3 1.5 4s1-2.4 2.5-2.4c1.6 0 2.5 1 2.6 2.5 0 1.4-1 2.5-2.6 2.5zm11.5 6c-1 0-2 1-2 2v7h-5v-13h5V10s1.6-1.5 4-1.5c3 0 5 2.2 5 6.3v6.7h-5v-7c0-1-1-2-2-2z"/></svg>
    </div></div>
</a>


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
<br>





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



      

      
      <div>
        <h4 class="titltop"><span>finding a maid was never that easy and less expensive,thanks</span><br>
          maid and helper</h4>
        <img src="images/callto-action.png">
        <h5 class="gebox-tit">mohamed ahmed</h5>
        <p class="viewsdriver"> Office boy</p>
      </div>
      <!--div-->
      
      
      <!--div--> 
      
    </div>
    <!--your-stud-->
    
    <div class="cenbottom nbottom"> <a href="#" class="largeredbtn">view more testimonials <i class="fas fa-long-arrow-alt-right"></i></a> </div>
  </div>
  <!--container--> 
</section>

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
 <div class="modal fade" id="myModalVideo" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Watch Video</h4>
        </div>
        <div class="modal-body">
             <iframe width="560" height="315" src="https://www.youtube.com/embed/_I4AxpE5byE" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </div>
       
      </div>
      
    </div>
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


<!--myModal-->

 @stop
@section('scripts')

<script type="text/javascript" src="/js/slick.min.js"></script>




<script>
$(window).load(function()
{
    $('#myModalVideo').modal('show');
   
});


$('.your-stud').slick({
dots: true,
infinite: true,
speed: 2000,
slidesToShow:1,
slidesToScroll: 1,
autoplay: true,
autoplaySpeed: 3000,
responsive: [
{
breakpoint: 550,
settings: {
slidesToShow: 1,
slidesToScroll: 1
}
},

]
});


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
<script>

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