@extends('Layout/Master')
@section('content')
<style type="text/css">
  .ineercompany {
    min-height: 400px;
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


 @if(Session::get('locale')=="Ar"|| Session::get('locale')=="ar")
{{App::setLocale('ar')}}
@else
{{App::setLocale('en')}}
@endif

<div class="sliderphoto" style="background:url(/images/slide5.jpg) fixed center center no-repeat; background-size:cover;">
  <div class="container textslider">
    <h1 class="titltop"><span>Candidates & employers</span><br/>
      well connected here </h1>
    
     <form action="/search" method="get" class="input-search">
      <select name="type" class="selectpicker" id="search_type">
     
        <option> {{trans('app.IamCandidate')}}</option>
        <option>{{trans('app.IAmEmployer')}}</option>
        
      </select>
      <input type="text" class="form-control" name ="words"  id="myInput" placeholder="search for jobs, candidates keywords...">
      <button type="submit" class="fas fa-search btn-slide"> </button>
    </form>
  
    
    
    
    
    
    <!--input-search-->
 
    <div class="centerboxs">
      <div class="innertetxr">
        <h2 class="textcandidate">{{trans('app.IamCandidate')}}</h2>
        <ul class="hassle">
          <li>{{trans('app.find_a_job_easily')}} </li>
          <li>{{trans('app.reach_your_employer_directly')}}</li>
          <li>{{trans('app.forget_about_agencies_hassle')}} ,...</li>
        </ul>
        <a href="/register/candidates" class="largeredbtn">{{trans('app.Find_a_job')}} </a> </div>
      <!--innertetxr-->
      <div class="innertetxr">
        <h2 class="textcandidate"> {{trans('app.IAmEmployer')}}</h2>
        <ul class="hassle">
          <li>{{trans('app.post_job_you_want_easily')}} </li>
          <li>{{trans('app.find_the_most_suitable')}} Maid/Helper</li>
          <li>{{trans('app.forget_about_costly_agencie')}} ,...</li>
        </ul>
        <a href="/register/employer" class="largeredbtn"> {{trans('app.post_a_job')}}</a> </div>
      <!--innertetxr--> 
      
    </div>
    <!--centerboxs--> 
    
  </div>
  <!--container--> 
  
</div>

<!--//siderdiv-->

<section class="recently-job">
  <div class="container">
    <h3 class="title-con"> {{trans('app.recently_added_jobs')}} </h3>
    <div class="row">


       @foreach($RecentlyAddedJobsAgg as $AddJobs)
      <div class="col-sm-3 company">
        <div class="ineercompany">
          <div class="tidiv"> <img src="/images/car1.jpg"> <span>{{$AddJobs->job_for}}</span></div>
          <!--tidiv-->
         
          <h4 class="innertitltext">{{$AddJobs->CompanyName}} </h4>
          <p class="officer">{{$AddJobs->JobName}}</p>
          <ul class="hassle salary">
            <li> <strong>loc.</strong> {{$AddJobs->CountryName}}</li>
            <li> <strong>salary.</strong>{{number_format(($AddJobs->min_salary))?number_format($AddJobs->min_salary):"0"}}:{{number_format(($AddJobs->max_salary))?number_format($AddJobs->max_salary):"0"}} {{($AddJobs->Currency)?$AddJobs->Currency->name:""}}</li>
          </ul>
          <div class="tidivbotom"> <a href="/ViewJob/{{$AddJobs->id}}">{{trans('app.view_job')}}</a> <span>{{ \Carbon\Carbon::parse($AddJobs->Jobdate)->format('d/M/Y')}}</span></div>
          <!--tidiv--> 
           <a  onclick="shareJob('{{$AddJobs->id}}');" ><i class="fas fa-share"></i></a>




        </div>
        <!--inernews--> 
    

      </div>
      @endforeach

       @foreach($RecentlyAddedJobsCompany as $AddJobs)
      <div class="col-sm-3 company">
        <div class="ineercompany">
          <div class="tidiv"> <img src="/images/car1.jpg"> <span>{{$AddJobs->job_for}}</span></div>
          <!--tidiv-->
          
          <h4 class="innertitltext">{{$AddJobs->CompanyName}} </h4>
          <p class="officer">{{$AddJobs->JobName}}</p>
          <ul class="hassle salary">
            <li> <strong>loc.</strong> {{$AddJobs->CountryName}}</li>
            <li> <strong>salary.</strong>{{number_format(($AddJobs->min_salary))?number_format($AddJobs->min_salary):"0"}}:{{number_format(($AddJobs->max_salary))?number_format($AddJobs->max_salary):"0"}} {{($AddJobs->Currency)?$AddJobs->Currency->name:""}}</li>
          </ul>
          <div class="tidivbotom"> <a href="/ViewJob/{{$AddJobs->id}}">{{trans('app.view_job')}}</a> <span>{{ \Carbon\Carbon::parse($AddJobs->Jobdate)->format('d/M/Y')}}</span></div>
          <!--tidiv--> 
   




    <a  onclick="shareJob('{{$AddJobs->id}}');" ><i class="fas fa-share"></i></a>


     

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
           
            <li> <strong>salary.</strong>{{number_format(($AddJobs->min_salary))?number_format($AddJobs->min_salary):"0"}}:{{number_format(($AddJobs->max_salary))?number_format($AddJobs->max_salary):"0"}} {{($AddJobs->Currency)?$AddJobs->Currency->name:""}}</li>
          </ul>
          <div class="tidivbotom"> <a href="/ViewJob/{{$AddJobs->id}}">{{trans('app.view_job')}}</a> <span>{{ \Carbon\Carbon::parse($AddJobs->Jobdate)->format('d/M/Y')}}</span></div>
          <!--tidiv--> 
   


 <a  onclick="shareJob('{{$AddJobs->id}}');" ><i class="fas fa-share"></i></a>

        


        </div>
        <!--inernews--> 
    

      </div>
      @endforeach
      <!--bocprod-->
      
      
      
     
      <!--bocprod-->
      
  
      <!--bocprod--> 
      
    </div>
    
    <div class="cenbottom"> <a href="/search?type=I+am+Candidate&words=" class="largeredbtn"> {{trans('app.view_more_jobs')}}<i class="fas fa-long-arrow-alt-right"></i></a> </div>
    <!--cenbottom--> 
    
  </div>
  <!--//container--> 
  
</section>
<!--sacboxcars-->

<section class="top-candidates">
  <div class="container">
    <h3 class="title-con entea">{{trans('app.top_Candidate')}}</h3>
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
            <div class="tidivbotom"> <a href="/candidate/{{$TopCandi->user->id}}"> {{trans('app.View_Profile')}}</a> <span>{{$TopCandi->created_at}}</span></div>
            <!--tidiv--> 
     </div>
          <!--padboxs--> 
      
    
 <a  onclick="share('{{$TopCandi->id}}');" ><i class="fas fa-share"></i></a>








        </div>
        <!--inernews--> 
    
      </div>
      <!--bocprod-->
  
     @endforeach
      

      
     
      
      
    </div>
    <!--row-->
    
    <div class="cenbottom nbottom"> <a href="/search?type=I+Am+Employer&words=" class="largeredbtn">{{trans('app.view_more_Candidates')}}  <i class="fas fa-long-arrow-alt-right"></i></a> </div>
    <!--cenbottom--> 
    
  </div>
  <!--//container--> 
</section>
<!--sacbox-->

<div class="container">
  <h3 class="title-con enteacolor">{{trans('app.how_it_works')}} </h3>
  <div class="works"><img src="images/works.jpg"> </div>
  <!--works-->
  <div class="cenbottom"> <a href="/signup" class="largeredbtn">{{trans('app.start_now')}} <i class="fas fa-long-arrow-alt-right"></i></a> </div>
  <!--cenbottom--> 
  
</div>

<!--//container-->
<br>





<section class="success" style="background:url(images/slide5.jpg) fixed center center no-repeat; background-size:cover;">
  <div class="container">
    <h3 class="title-con entea">{{trans('app.Successstories')}}</h3>
    



<div class="your-stud">
@foreach($allSuccessStories as $SuccessStor)
      <div>
        <h4 class="titltop"><span>{{$SuccessStor['description']}}</h4>
          @if($SuccessStor['logo']==null)
          <img src="images/callto-action.png">
          @else
        <img src="{{$SuccessStor['logo']}}">
        @endif
        <h5 class="gebox-tit">{{$SuccessStor['name']}}</h5>
        <p class="viewsdriver">{{$SuccessStor['type']}}</p>
      </div>
      <!--div-->
      @endforeach



      

  
      <!--div-->
      
      
      <!--div--> 
      
    </div>
    <!--your-stud-->
    
    <div class="cenbottom nbottom"> <a href="#" class="largeredbtn">{{trans('app.view_more_testimonials')}} <i class="fas fa-long-arrow-alt-right"></i></a> </div>
  </div>
  <!--container--> 
</section>

<!-- <div class="container">
  <h3 class="title-con enteacolor mergtext"> insights</h3> -->
  <!-- <div class="row">
    <div class="col-sm-3 crcals">
      <div class="centers"><i class="fas fa-user"></i></div>
      <h2 class="timer count-title count-number" data-to="{{$TotalJob}}" data-speed="1500"></h2>
      <p class="count-text ">jobs</p>
    </div> -->
    <!--crcals-->
    
    <!-- <div class="col-sm-3 crcals">
      <div class="centers"><i class="fas fa-users"></i></div>
      <h2 class="timer count-title count-number" data-to={{$TotalCandidate}} data-speed="1500"></h2>
      <p class="count-text ">Candidates</p>
    </div> -->
    <!--crcals-->
    
    <!-- <div class="col-sm-3 crcals">
      <div class="centers"><i class="fas fa-file-alt"></i></div>
      <h2 class="timer count-title count-number" data-to={{$TotalVideoCvs}} data-speed="1500"></h2>
      <p class="count-text ">video cvs</p>
    </div> -->
    <!--crcals-->
    
    <!-- <div class="col-sm-3 crcals">
      <div class="centers"><i class="fas fa-female"></i></div>
      <h2 class="timer count-title count-number" data-to={{$TotalAnsweredQuestions}} data-speed="1500"></h2>
      <p class="count-text ">answered questions</p>
    </div> -->
    <!--crcals--> 
    
  <!-- </div> -->
  <!--row--> 
<!--   
</div> -->
 <div class="modal fade" id="myModalVideo" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Watch Video</h4>
        </div>
        <div class="modal-body">
             <iframe width="560" height="400" src="https://www.youtube.com/embed/_I4AxpE5byE" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
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
     
      <div class="modal-body" id="v1">
       
        </div>
    
      <!--textbox--> 
      
    </div>
  </div>
</div>
<!--myModal-->


<!--myModal-->
<!--myModal-->

<div id="ShareModal" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header"> 
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel" style="font-size: 18pt">Share</h4>
      </div>

   @include('share.share')


         </div>         
       </div>
    </div>
  </div>
</div>

<div id="ShareJobModal" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header"> 
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel" style="font-size: 18pt">Share</h4>
      </div>

   @include('share.sharejob')


         </div>         
       </div>
    </div>
  </div>
</div>
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

$("#v1").html('<video style="text-align: center;width="560" ;height="315";" controls><source src="'+$id+'" type='+$typeM+'></source></video>' );

 $('#myModal').modal('show');
}


    // this loads the Facebook API
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) { return; }
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    window.fbAsyncInit = function () {
        var appId = '1112718265559949';
        FB.init({
            appId: appId,
            xfbml: true,
            version: 'v2.9'
        });
    };

        // FB Share with custom OG data.
         function candfacebook ($title,$description,$link,$image) {
                // Dynamically gather and set the FB share data. 
                var FBDesc      = $description;
                var FBTitle     = $title;
                var FBLink      = 'https://www.maidandhelper.com/ViewJob/'+$link;
                var FBPic       = 'https://www.maidandhelper.com/'+$image;

                // Open FB share popup
                FB.ui({
                    method: 'share_open_graph',
                    action_type: 'og.shares',
                    action_properties: JSON.stringify({
                        object: {

                            'og:url': FBLink,
                            'og:title': FBTitle,
                            'og:description': FBDesc,
                          'og:image':FBPic,

                        }
                    })
                },
                function (response) {
                // Action after response
                })
     
    };

    // FB Share with custom OG data.
         function asd ($title,$description,$image,$link) {
                // Dynamically gather and set the FB share data. 
                var FBDesc      = $description;
                var FBTitle     = $title;
                var FBLink      = 'https://www.maidandhelper.com/ViewJob/'+$link;
                var FBPic       = 'https://www.maidandhelper.com/images/car1.jpg';

                // Open FB share popup
                FB.ui({
                    method: 'share_open_graph',
                    action_type: 'og.shares',
                    action_properties: JSON.stringify({
                        object: {

                            'og:url': FBLink,
                            'og:title': FBTitle,
                            'og:description': FBDesc,
                          'og:image':FBPic,

       'og:video': 'https://www.maidandhelper.com/videos/330/video1529582854video-1525861985.mp4',

'og:video:type':'video/mp4',

'og:video:width':'400',
'og:video:height':'400'  
                        }
                    })
                },
                function (response) {
                // Action after response
                })
     
    };
</script>
<script type="text/javascript">


  function shareJob($job){


var job=$job;

   $.ajax({
      url: '/sharejob',
        type: 'POST',
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
          data:{'job':job},

  
           success:function(response)
            {

            
               
                      $('#myPartialDivJob').html(response);

     
          
            

             
        }
   });
  

    $('#ShareJobModal').modal('show');

  }
  function share($topcand){


var topcand=$topcand;
console.log(topcand);
   $.ajax({
      url: '/share',
        type: 'POST',
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
          data:{'topcand':topcand},

  
           success:function(response)
            {

            
               
                      $('#myPartialDiv').html(response);

     
          
            

             
        }
   });
  

    $('#ShareModal').modal('show');

  }
 
 function email() {
  var x = document.getElementById("emaildiv");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

 function emailjob() {

  var x = document.getElementById("emailjobdiv");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

</script>




@endsection