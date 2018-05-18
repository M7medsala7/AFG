@extends('Layout.app')
@section('content')

<section class="candidate-profile"> 
  <!--<h1>candidate profile </h1>--> 
</section>
<section class="dashboard candidate-pro">
  <div class="container">
    <div class="row">
      <div class="col-sm-4 dashboardleft">
        <div class="inner-aboutus topmergline padbotnm">
          <div class="detalsprofile ecome">
            <h4 class="textcandidate">watch demo video</h4>
          </div>
          <!--detalsprofile-->
          
          <div class="videoprofy"> <a href="#" data-toggle="modal" data-target="#myModal" class="watchvideo wipopups"> <img src="/images/slide5.jpg"> <i class="fas fa-play"></i> </a>
            <div class="racommend nontex"> <i class="fas fa-heart"></i> racommend</div>
          </div>
          <!--videoprofy-->
          
          <div class="namecandidates">
            <h4 class="textcandidate xtcandida">recommend</h4>
            <!--com-proftow-->
            @foreach($company->user->postJobs as $postjob)
            <div class="com-proftow">
              <h5 class="textcandidate">{{$postjob->job->name}}</h5>
              <img src="/images/titlewebs.png">
              <div class="comitm">
                <p class="witthtext">{{$postjob->job_descripton}}</p>
                <span class="employers-nemb">{{$postjob->num_of_candidates}} employers</span> <a  href="#" class="fas fa-ellipsis-h bot-link"></a> </div>
              <!--comitm--> 
              
            </div>
            @endforeach
            <!--com-proftow-->
            <!--com-proftow--> 
            
          </div>
          <!--namecandidates--> 
          
        </div>
        <!--inner-aboutus--> 
        
      </div>
      <!--dashboardleft-->
      
      <div class="col-sm-8 comprofleft">
        <div class="inner-aboutus mh-company">
          <div class="com-proftow companychool"> <img src="/images/company.png">
            <div class="comitm">
              <h5 class="textcandidate">{{$company->user->name}}</h5>
              <p class="witthtext">{{($company->description)?$company->description:"Not set"}}</p>
              <div class="cenbottom seejobs"> <a href="#" class="largeredbtn">see jobs</a> <a href="#" class="largeredbtn">weiw profile</a> </div>
            </div>
            <!--comitm--> 
            
          </div>
          <!--com-proftow--> 
          
        </div>
        <!--inner-aboutus-->
        
        <div class="inner-aboutus secshbox">
          <div class="row">
            <div class="col-sm-9 aboutcompany">
              <h5 class="textcandidate">about us</h5>
              <p class="witthtext">{{$company->description}}</p>
              <div class="cenbottom seejobs"> <a href="#" class="largeredbtn">read more</a> </div>
            </div>
            <!--aboutcompany-->
            
            <div class="col-sm-3 aboutcompany">
              <h5 class="textcandidate updates">recent updates:</h5>
              <div class="imgright"><img src="{{(count($company->photos)> 0)?$company->photos->last()->photo_path:'/images/company.png'}}"> </div>
              <!--imgright--> 
            </div>
            <!--aboutcompany--> 
            
          </div>
          <!--row--> 
          
        </div>
        <!--inner-aboutus-->
        
        <div class="inner-aboutus secshbox">
          <div class="row">
            <div class="col-sm-9 aboutcompany">
              <div class="com-proftow companychool wavesimg"> <img src="/images/company.png">
                <div class="comitm">
                  <h5 class="textcandidate">maid & helper</h5>
                  <p class="witthtext">igner At New Waves High School Web Designer At New igner At New Waves High School Web Designer At New</p>
                  <div class="cenbottom seejobs"> <a href="#" class="largeredbtn">see jobs</a> </div>
                </div>
                <!--comitm--> 
                
              </div>
              <!--companychool--> 
              
            </div>
            <!--aboutcompany-->
            
            <div class="col-sm-3 aboutcompany">
              <div class="imgright"><img src="{{$company->user->logo}}"> </div>
              <!--imgright--> 
              
            </div>
            <!--aboutcompany--> 
            
          </div>
          <!--row-->
          
          <div class="see-jobs">
          @if(count($company->photos)> 0)
            @foreach($company->photos as $photo)
              <div class="slidonw"> <img src="{{$photo->photo_path}}">
                <div class="cenbottom"> <a href="#" class="fas fa-link centlink"></a> </div>
              </div>
              <!--slidonw-->
            @endforeach
          @else
            <h4>No photos</h4>
          @endif
             
            
          </div>
          <!--see-jobs--> 
          
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

@endsection