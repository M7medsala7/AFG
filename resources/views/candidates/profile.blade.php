@extends('Layout.app')


<style>
.checked {
    color: orange;
}
</style>

@section('content')

<style type="text/css">
.namesprof li {

    width: 100%;

}
</style>

<section class="candidate-profile">
  <h1>candidate profile </h1>
</section>
<section class="dashboard candidate-pro">
  <div class="container">
    <div class="row">
      <div class="col-sm-4 dashboardleft">
        <div class="inner-aboutus topmergline padbotnm">
          <div class="detalsprofile ecome">
            <h4 class="textcandidate">watch {{$candidate->name}} video</h4>
          </div>
          <!--detalsprofile-->
          <div class="videoprofy"> 
            <a href="#" data-toggle="modal" data-target="#myModal" class="watchvideo wipopups"> 
        

               @if($candidate->CanInfo->vedio_path != null)
              <video  src="/{{($candidate->CanInfo->vedio_path)}}" type="video/{{File::extension($candidate->CanInfo->vedio_path)}}">  </a> 
                @else


<img src="/{{($candidate->logo)?$candidate->logo :'/images/blue-pass-onw.jpg'}}" > <i class="fas fa-play"></i> </a>
                
                @endif


           

          </a>
          <input type="hidden" value="{{$candidate->id}}" id="CanID">
          <div>
            @if($color=='black')
            <button class="like like_button" user-id="{{$candidate->id}}" > <i class="fas fa-heart"></i> </button> <span>like</span>
            @endif
            @if($color=='red')
            <button class="like like_button" user-id="{{$candidate->id}}" > <i class="fas fa-heart" style="color: red"></i> </button> <span>like</span>
            @endif

            
          </div>
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
                                
                                <div class="blue-pass-onw"> <img src="/images/blue-pass-onw.jpg"> </div>
                                <!--blue-pass--> 
                                
                              </div>--}}
          <!--blue-pass-->
          
          <div class="profilelink">
            <h4 class="textcandidate">profile</h4>
            <div class="navlink">
              <div  class="form-control">{{('maidandhelper.com/candidate/'.$candidate->id)}}</div>
              <a href="#" class="btn-slide"> copy link</a> </div>
            <!--navlink--> 
            
          </div>
          <!--profilelink-->
          
          <div class="namecandidates">
            <h4 class="textcandidate">Similar candidates</h4>
            @if($simialr_candidates)
              @foreach($simialr_candidates as $cand)
                <div class="itmonw"> <img src="/{{($cand->user->logo)?$cand->user->logo :'/images/blue-pass-onw.jpg'}}" >
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
            <div class="com-proftow companychool imgprof"> <img src="/{{($candidate->logo)?$candidate->logo :'/images/blue-pass-onw.jpg'}}" >
              <div class="comitm">
                <h5 class="textcandidate">{{$candidate->name}} {{($candidate->CanInfo->last_name)?$candidate->CanInfo->last_name:""}}</h5>
                <ul class="namesprof">
                  <li> {{$candidate->CanInfo->job->name}} </li>
                  <li> <strong>

                    @if($candidate->CanInfo->gender==0)
                    Male
                     @endif
                     @if($candidate->CanInfo->gender==1)
                    Female
                    @endif
                     :
                   </strong>
                   {{$age}} 
                  
                   </li>
                  <li> <strong>current loaction : </strong>{{($candidate->CanInfo->country)?$candidate->CanInfo->country->name:"No Country"}}
                  </li>
                  <li> <strong>visa status : </strong>{{($candidate->CanInfo->visa_type)?$candidate->CanInfo->visa_type:"No Visa type"}}</li>
                 
                  <li> <strong> Nationality: </strong> {{($candidate->CanInfo->Nationality)?$candidate->CanInfo->Nationality->name:"Nationality is not set"}}</li>
                </ul>
              </div>
              <!--comitm--> 
              
            </div>
          </div>
          <!--divboxs-->
          
          <div class="col-sm-3 divboxs">
            <nav class="pholeft"> 
            
            <a href="#" onclick="Checkpaymentauth(1)"> 
            <i class="fas fa-phone" ></i> call</a> 
       
            <a href="#" onclick="Checkpaymentauth(2)">
            <i class="far fa-envelope"></i> message</a> 
            
            <a href="#" onclick="Checkpaymentauth(3)">
            <i class="far fa-address-card"></i>View Cv</a> 
            </nav>
          </div>
          <!--divboxs-->
      
          
          <div class="row botboxs" >
            <h2>{{($candidate->CanInfo->descripe_yourself)?$candidate->CanInfo->descripe_yourself:"No Description"}}</h2>
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

             
                  <i class="fa fa-star checked"></i>
                  <i class="fa fa-star checked"></i>
                  <i class="fa fa-star checked"></i>

            
                </span></p>
              @endforeach
            @else
             <p> No Languages Selected</p>
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
                <img src="/images/titlewebs.png">
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
      <div class="modal-header"> watch {{$candidate->name}} video
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
 
     @if($candidate->CanInfo->vedio_path != null)

  <video style="
    text-align: center;
    width: 100%;"  controls>
        <source src="/{{($candidate->CanInfo->vedio_path)}}" type="video/{{File::extension($candidate->CanInfo->vedio_path)}}">
      </video>



              
                @else
                <p style="    text-align: center;
    font-size: x-large;
    padding-top: 30px;
    padding-bottom: 30px;">Sorry,No video </p>
                
                @endif
      
      
       </a> 
       
      </video>
      <!--textbox--> 
      
    </div>
  </div>
</div>
<!--myModal-->

 


<div id="myModa3" class="modal fade" aria-hidden="false">
  <div class="modal-dialog popvad">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal">×</button>
      <div class="linksing" >
        <h2 class="callnow">candidates cv </h2>
         <div id="Frame">
         </div>
         </div>
    </div>
  </div>
</div>
</section>
<section>
<div id="myModa2" class="modal fade" aria-hidden="false">
  <div class="modal-dialog popvad">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal">×</button>
      <div class="linksing">
        <h2 class="callnow">call now </h2>
        {{($candidate->CanInfo->phone_number)?$candidate->CanInfo->phone_number:"No phone number"}}</div>
    </div>
  </div>
</div>
</section>
<section >
  <!-- Modal -->
  <div class="modal fade" id="MyloginModal" aria-hidden="false">
  <div class="modal-dialog popvad">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">login to Maidandhelper</h4>
        </div>
        <div class="modal-body">
          <p>Please login!!!!!!</p>
        </div>
        <div class="modal-footer">
       
          <a href="/loginEmployer" style="float: right;" class="largeredbtn" >login</a>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

@stop

@section('scripts')
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
         if(data=='true')
            $('.like_button').css('color','red');
          else 
            $('.like_button').css('color','');  
               
        },
                    error: function(response)
                    {
                      
                       window.location = '/login'; 
                    }


      });
  });
</script>
<script>
   $(function(){
    $('header').addClass('header-in');
  });
</script>

<script type="text/javascript">

function Checkpaymentauth($type)
{
 $id= $('#CanID').val();
  $.ajax(
      {
        type:"GET",
        url:'/Checkpaymentauth/'+$id+'/'+$type,
       
        success: function(data){
        console.log(data);
         if(data==1)
         {
         $('#myModa2').modal('show');
         }
         else if(data==2)
         {
        alert("you Finishe e1 3adad");
         }
        else if(data==3)
         {
           //append to I Frame
$('#Frame').append('<iframe width="90%" height="60%"src="/{{$candidate->CanInfo->cv_path}}"></iframe>')
          $('#myModa3').modal('show');
         }
          else 
          {
            $('#MyloginModal').modal('show');
            
           
          }
           },
          error: function(response)
            {
            
              $('#MyloginModal').modal('show');
              
            }
      });
}




</script>
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