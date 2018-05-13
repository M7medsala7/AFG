@extends('Layout/Master')
@section('content')

<div class="sliderphoto" style="background:url(/images/slide5.jpg) fixed center center no-repeat; background-size:cover;">
  <div class="container textslider">
    <h1 class="titltop"><span>Candidates & employers</span><br/>
      well connected here </h1>
    <form action="/search" method="get" class="input-search">
      <input type="text" name="type" id="search_type" style="display: none;">
      <input type="text" name="words" id="myInput" class="form-control" placeholder="search for jobs, candidates keywords...">
      <ul class="select_search_type" style="width:95%; display: none;">
        <li class="form-control select_type" type_val="candidate"  style="height: 32px !important;">Candidate</li>
        <li class="form-control select_type" type_val="employer" style="height: 32px !important;">employer</li>
      </ul>
      <button type="submit" class="fas fa-search btn-slide"> </button>
    </form>
    
    <!--input-search-->
    
    <div class="centerboxs">
      <div class="innertetxr">
        <h2 class="textcandidate">i‘m candidate</h2>
        <ul class="hassle">
          <li>find a job easily</li>
          <li>reach your employer directly</li>
          <li>forget about agencies hassle,...</li>
        </ul>
        <a href="/register/candidates" class="largeredbtn">Find a job</a> </div>
      <!--innertetxr-->
      <div class="innertetxr">
        <h2 class="textcandidate">i‘m employer</h2>
        <ul class="hassle">
          <li>Post job you want easily</li>
          <li>Find the most suitable Maid/Helper</li>
          <li>forget about costly agencies,...</li>
        </ul>
        <a href="/register/employer" class="largeredbtn">post a job </a> </div>
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
          <div class="tidivbotom"> <a href="#">apply now</a> <span>{{ \Carbon\Carbon::parse($AddJobs->Jobdate)->format('d/M/Y')}}</span></div>
          <!--tidiv--> 
           <div class="tidivbotom"> <a href="#" onclick="ShowJobDetails($AddJobs->id)" data-toggle="modal" data-target="#myModa2" class="largeredbtn back">  View job</a> </div>
          
        </div>
        <!--inernews--> 
        
      </div>
      @endforeach
      <!--bocprod-->
      
      
      
     
      <!--bocprod-->
      
  
      <!--bocprod--> 
      
    </div>
    <!--row-->
    
    <div class="cenbottom"> <a href="#" class="largeredbtn">view more jobs <i class="fas fa-long-arrow-alt-right"></i></a> </div>
    <!--cenbottom--> 
    
  </div>
  <!--//container--> 
  
</section>
<!--sacboxcars-->

<section class="top-candidates">
  <div class="container">
    <h3 class="title-con entea"> top Candidates</h3>
    <div class="row">
      <div class="col-sm-3 company">
        <div class="ineercompany nonepad"> <a  href="#" class="imgbox"> <img src="images/4.jpg"> <i class="fas fa-play"></i></a>
          <div class="padboxs"> <span class="eyeicons"><i class="fas fa-eye"></i> 20,215</span> <span class="eyeicons"><i class="fas fa-flag"></i> 20,215</span>
            <h4 class="innertitltext">mohamed ahmed</h4>
            <p class="officer">nanny</p>
            <ul class="hassle salary">
              <li> 28 years</li>
              <li>india</li>
            </ul>
            <div class="tidivbotom"> <a href="#">know more</a> <span>12 march 2018</span></div>
            <!--tidiv--> 
            
          </div>
          <!--padboxs--> 
          
        </div>
        <!--inernews--> 
        
      </div>
      <!--bocprod-->
      
      <div class="col-sm-3 company">
        <div class="ineercompany nonepad"> <a  href="#" class="imgbox"> <img src="/images/4.jpg"> <i class="fas fa-play"></i></a>
          <div class="padboxs"> <span class="eyeicons"><i class="fas fa-eye"></i> 20,215</span> <span class="eyeicons"><i class="fas fa-flag"></i> 20,215</span>
            <h4 class="innertitltext">mohamed ahmed</h4>
            <p class="officer">nanny</p>
            <ul class="hassle salary">
              <li> 28 years</li>
              <li>india</li>
            </ul>
            <div class="tidivbotom"> <a href="#">know more</a> <span>12 march 2018</span></div>
            <!--tidiv--> 
            
          </div>
          <!--padboxs--> 
          
        </div>
        <!--inernews--> 
        
      </div>
      <!--bocprod-->
      
      <div class="col-sm-3 company">
        <div class="ineercompany nonepad"> <a  href="#" class="imgbox"> <img src="/images/4.jpg"> <i class="fas fa-play"></i></a>
          <div class="padboxs"> <span class="eyeicons"><i class="fas fa-eye"></i> 20,215</span> <span class="eyeicons"><i class="fas fa-flag"></i> 20,215</span>
            <h4 class="innertitltext">mohamed ahmed</h4>
            <p class="officer">nanny</p>
            <ul class="hassle salary">
              <li> 28 years</li>
              <li>india</li>
            </ul>
            <div class="tidivbotom"> <a href="#">know more</a> <span>12 march 2018</span></div>
            <!--tidiv--> 
            
          </div>
          <!--padboxs--> 
          
        </div>
        <!--inernews--> 
        
      </div>
      <!--bocprod-->
      
      <div class="col-sm-3 company">
        <div class="ineercompany nonepad"> <a  href="#" class="imgbox"> <img src="images/4.jpg"> <i class="fas fa-play"></i></a>
          <div class="padboxs"> <span class="eyeicons"><i class="fas fa-eye"></i> 20,215</span> <span class="eyeicons"><i class="fas fa-flag"></i> 20,215</span>
            <h4 class="innertitltext">mohamed ahmed</h4>
            <p class="officer">nanny</p>
            <ul class="hassle salary">
              <li> 28 years</li>
              <li>india</li>
            </ul>
            <div class="tidivbotom"> <a href="#">know more</a> <span>12 march 2018</span></div>
            <!--tidiv--> 
            
          </div>
          <!--padboxs--> 
          
        </div>
        <!--inernews--> 
        
      </div>
      <!--bocprod--> 
      
    </div>
    <!--row-->
    
    <div class="cenbottom nbottom"> <a href="#" class="largeredbtn">view more Candidates <i class="fas fa-long-arrow-alt-right"></i></a> </div>
    <!--cenbottom--> 
    
  </div>
  <!--//container--> 
</section>
<!--sacbox-->

<div class="container">
  <h3 class="title-con enteacolor"> how it works</h3>
  <div class="works"><img src="images/works.jpg"> </div>
  <!--works-->
  <div class="cenbottom"> <a href="#" class="largeredbtn">start now <i class="fas fa-long-arrow-alt-right"></i></a> </div>
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
      <h2 class="timer count-title count-number" data-to="{{$TotalEmpolyer}}" data-speed="1500"></h2>
      <p class="count-text ">employers</p>
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
@endsection