@extends('Layout.app')

@section('content')
<section class="candidate-profile">
  <h1>candidate profile </h1>
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
          <div>
            <button class="like like_button" user-id="{{$candidate->id}}"> <i class="fas fa-heart"></i> </button> <span>like</span></div>
          </div>
          <!--videoprofy-->
          
          {{--<div class="blue-pass">
                                <div class="blue-pass-onw">
                                  <h4 class="textcandidate">blue passport</h4>
                                  <label>
                                    <input type="checkbox" name="check" checked>
                                    <span class="label-text">available</span> </label>
                                </div>
                                <!--blue-pass-->
                                
                                <div class="blue-pass-onw"> <img src="images/blue-pass-onw.jpg"> </div>
                                <!--blue-pass--> 
                                
                              </div>--}}
          <!--blue-pass-->
          
          <div class="profilelink">
            <h4 class="textcandidate">profile</h4>
            <div class="navlink">
              <div  class="form-control">{{url('/candidate/'.$candidate->id)}}</div>
              <a href="#" class="btn-slide"> copy link</a> </div>
            <!--navlink--> 
            
          </div>
          <!--profilelink-->
          
          <div class="namecandidates">
            <h4 class="textcandidate">Similar candidates</h4>
            @if($simialr_candidates)
              @foreach($simialr_candidates as $cand)
                <div class="itmonw"> <img src="{{($cand->user->logo)?$cand->user->logo :'/images/blue-pass-onw.jpg'}}">
                  <h5>{{$cand->user->name}}</h5>
                  <p>{{$cand->job->name}}</p>
                  <a href="/candidate/{{$cand->user->id}}" class="largeredbtn">view profile </a> 
                </div>
              @endforeach
            @endif
            <!--itmonw-->
            <!--itmonw--> 
            
          </div>
          <!--namecandidates--> 
          
        </div>
        <!--inner-aboutus--> 
        
      </div>
      <!--dashboardleft-->
      
      <div class="col-sm-8 dashboardleft"> 
        
        <!--headtext-->
        
        <div class="inner-aboutus massandphone">
          <div class="col-sm-10 divboxs">
            <div class="com-proftow companychool imgprof"> <img src="{{($candidate->logo)?$candidate->logo :'/images/blue-pass-onw.jpg'}}">
              <div class="comitm">
                <h5 class="textcandidate">{{$candidate->name}} {{($candidate->CanInfo->last_name)?$candidate->CanInfo->last_name:""}}</h5>
                <ul class="namesprof">
                  <li> {{$candidate->CanInfo->job->name}} </li>
                  <li> <strong>male : </strong> 30 </li>
                  <li> <strong>current loaction : </strong>{{($candidate->CanInfo->country)?$candidate->CanInfo->country->name:""}}</li>
                  <li> <strong>visa status : </strong>avaliable</li>
                </ul>
              </div>
              <!--comitm--> 
              
            </div>
          </div>
          <!--divboxs-->
          
          <div class="col-sm-3 divboxs">
            <nav class="pholeft"> <a href="#"> <i class="fas fa-phone"></i> call</a> <a href="#"><i class="far fa-envelope"></i> message</a> </nav>
          </div>
          <!--divboxs-->
          
          <div class="row botboxs" >
            <h2>{{$candidate->descripe_yourself}}</h2>
          </div>
          <!--resultstext--> 
          
        </div>
        <!--inner-aboutus--> 
        
        <!--    <div class="inner-aboutus topmergline successwork">
       
          
          <h4 class="textcandidate information">personal information</h4>
          <ul class="informationname">
            <li> <strong>age :</strong> 30 y.o</li>
            <li> <strong>nationality :</strong> egyptian</li>
            <li> <strong>gender :</strong> male</li>
            <li> <strong>visa status :</strong> avaliable</li>
          </ul>
           
        </div>--> 
        
        <!--inner-aboutus-->
        
        <div class="inner-aboutus topmergline">
          <div class="currencytext resultstext">
            <h2>skills</h2>
          </div>
          <!--resultstext-->
          
          <nav class="driver">
 @if($candidate->skills)
            @foreach($candidate->skills as $skill)
            <a>{{$skill->name}}</a>
            @endforeach
          @else
            No skills selected
          @endif


         </nav>
          <!--driver-->
          
          <div class="language">
            <h4 class="textcandidate information">language</h4>
            <div class="languagelink">
              @if($candidate->languages)
              @foreach($candidate->languages as $lang)

              <p>{{$lang->name}} <span>

              @for($i = 0; $i < $lang->pivot->degree ; $i++)
                  <i class="fas fa-star"></i>

                @endfor
                </span></p>
              @endforeach
            @else
              No Languages Selected
            @endif
            </div>
            <!--languagelink--> 
            
          </div>
          <!--language-->
          
          <div class="language">
            <div class="row">
              <div class="col-sm-2 education">
                <h4 class="textcandidate information">education :</h4>
              </div>
              <div class="col-sm-10 education">
                <p> <p>{{$candidate->CanInfo->Eductionlevel}}</p></p>
              </div>
            </div>
            <!--row--> 
            
          </div>
          <!--language-->
          
          <div class="language">
            <div class="row">
              <div class="col-sm-3 education">
                <h4 class="textcandidate information">work experience : </h4>
              </div>
                @if($candidate->experience)
                  @foreach($candidate->experience as $experience)
              <div class="col-sm-9 education educationimg">
                <h5 class="titlewebs">
               {{$experience->role}}
                </h4>
                <img src="images/titlewebs.png">
                <div class="languagelink">
                  <p>from <span>{{$experience->start_date}}</span></p>
                  <p>to <span>{{$experience->end_date}}</span></p>
                </div>
                <!--languagelink-->
                
                <p class="witthtext">{{$experience->working_in}} </p>
              </div>
                @endforeach
              @endif
            </div>

            <!--row--> 
            
          </div>
          <!--language--> 
          
        </div>
        
        <!--inner-aboutus--> 
        
      </div>
      
      <!--dashboardleft--> 
      
    </div>
    <!--row--> 
    
  </div>
  
  <!--container--> 
  <div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> watch demo video
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <video style="text-align: center;" width="auto" height="auto" controls>
        <source src="{{$candidate->CanInfo->vedio_path}}" type="video/{{File::extension($candidate->CanInfo->vedio_path)}}">
      </video>
      <!--textbox--> 
      
    </div>
  </div>
</div>
<!--myModal-->
</section>
<!--section-->
@endsection

@section('scripts')
<script>
   $(function(){
    $('header').addClass('header-in');
  });
</script>
<script>
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
  $('.like_button').on('click',function(){
     var user_id = $(this).attr('user-id');
  $.ajax(
      {
        type:"POST",
        url:'/likeCandidate',
        data:"user_id="+user_id,
        success: function(data){
          console.log(data);
          if(data=='true')
            $('.like_button').css('color','red');
          else
            $('.like_button').css('color','');       
        }
      });
  });
</script>
@endsection