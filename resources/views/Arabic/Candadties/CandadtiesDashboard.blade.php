@extends('Layout.app')

<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script> 

<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm3O5N1fP52tnpdSqPt71joqjd9xOkcek"></script> 

<script src="https://cdn.webrtc-experiment.com/RecordRTC.js"></script>
    <script src="https://cdn.webrtc-experiment.com/gif-recorder.js"></script>
    <script src="https://cdn.webrtc-experiment.com/getScreenId.js"></script>
    <script src="https://cdn.webrtc-experiment.com/gumadapter.js"></script>
@section('content')
<style type="text/css">
  
  input[type="file"] {
    display: none;
}
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
}


#loader {
    bottom: 0;
    height: 175px;
    left: 0;
    margin: auto;
    position: absolute;
    right: 0;
    top: 0;
    width: 175px;
}
#loader {
    bottom: 0;
    height: 175px;
    left: 0;
    margin: auto;
    position: absolute;
    right: 0;
    top: 0;
    width: 175px;
}
#loader .dot {
    bottom: 0;
    height: 100%;
    left: 0;
    margin: auto;
    position: absolute;
    right: 0;
    top: 0;
    width: 87.5px;
}
#loader .dot::before {
    border-radius: 100%;
    content: "";
    height: 87.5px;
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
    transform: scale(0);
    width: 87.5px;
}
#loader .dot:nth-child(7n+1) {
    transform: rotate(45deg);
}
#loader .dot:nth-child(7n+1)::before {
    animation: 0.8s linear 0.1s normal none infinite running load;
    background: #00ff80 none repeat scroll 0 0;
}
#loader .dot:nth-child(7n+2) {
    transform: rotate(90deg);
}
#loader .dot:nth-child(7n+2)::before {
    animation: 0.8s linear 0.2s normal none infinite running load;
    background: #00ffea none repeat scroll 0 0;
}
#loader .dot:nth-child(7n+3) {
    transform: rotate(135deg);
}
#loader .dot:nth-child(7n+3)::before {
    animation: 0.8s linear 0.3s normal none infinite running load;
    background: #00aaff none repeat scroll 0 0;
}
#loader .dot:nth-child(7n+4) {
    transform: rotate(180deg);
}
#loader .dot:nth-child(7n+4)::before {
    animation: 0.8s linear 0.4s normal none infinite running load;
    background: #0040ff none repeat scroll 0 0;
}
#loader .dot:nth-child(7n+5) {
    transform: rotate(225deg);
}
#loader .dot:nth-child(7n+5)::before {
    animation: 0.8s linear 0.5s normal none infinite running load;
    background: #2a00ff none repeat scroll 0 0;
}
#loader .dot:nth-child(7n+6) {
    transform: rotate(270deg);
}
#loader .dot:nth-child(7n+6)::before {
    animation: 0.8s linear 0.6s normal none infinite running load;
    background: #9500ff none repeat scroll 0 0;
}
#loader .dot:nth-child(7n+7) {
    transform: rotate(315deg);
}
#loader .dot:nth-child(7n+7)::before {
    animation: 0.8s linear 0.7s normal none infinite running load;
    background: magenta none repeat scroll 0 0;
}
#loader .dot:nth-child(7n+8) {
    transform: rotate(360deg);
}
#loader .dot:nth-child(7n+8)::before {
    animation: 0.8s linear 0.8s normal none infinite running load;
    background: #ff0095 none repeat scroll 0 0;
}
#loader .lading {
    background-image: url("../images/loading.gif");
    background-position: 50% 50%;
    background-repeat: no-repeat;
    bottom: -40px;
    height: 20px;
    left: 0;
    position: absolute;
    right: 0;
    width: 180px;
}
@keyframes load {
100% {
    opacity: 0;
    transform: scale(1);
}
}
@keyframes load {
100% {
    opacity: 0;
    transform: scale(1);
}
}
</style>
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
<input  name="imageProfile"  id="file-upload" type="file"/> <input name='userId' type='hidden' id ="canid" value="{{\Auth::user()->id}}" />



 
 <a href="/candidate/{{(\Auth::user()->id)}}" class="skiplink">view profile </a>


            </div> 
            </form> 

     
          <!--viewprofile-->
          
          <div class="row addicta">
            <div class="detalsprofile">
              <h4 class="textcandidate">{{(\Auth::user()->name)?(\Auth::user()->name):'No Name'}} , {{$age}}</h4>
              <span>{{$jobName->name}}</span> </div>
            <!--detalsprofile-->
            
            <div class="col-sm-12">
              <div class="text-only">profile strength: <span>{{$CandidateInfo->coins/2*100/100}}%</span></div>
              <!--text-only-->
              <div class="progress">
                <div class="progress-bar" style="width: {{$CandidateInfo->coins/2*100/100}}%;"></div>
              </div>
              <!--progress-->
              
              <div class="pointsnamber"> <i class="fas fa-trophy"></i>
                <p>you have <span>{{$CandidateInfo->coins}}</span> points</p>
              </div>
              
              
              
                   <div class="pointsnamber"> 
                <p>your keyword<br> <span>{{$CandidateInfo->keyword}}</span></p>
              </div>
              
              
              
              <!--pointsnamber--> 
            </div>
            <!--col-sm-12-->
            
        
            <div class="videoprofy"> <a href="#" data-toggle="modal" data-target="#myModal" class="watchvideo"> 
   @if($CandidateInfo->vedio_path != null)
              <video src="{{($CandidateInfo->vedio_path)}}" style="margin: 5% 5% 5% 5%;width: 90%;">< <i class="fas fa-play"></i> </a> 
                @else
               
                <div class="videoprofy"> <a href="#" data-toggle="modal" data-target="#myModal4" class="watchvideo"> <img src="images/slide5.jpg"> <i class="fas fa-play"></i>
           
            </a>

          </div>
                @endif

                </div>
            <!--videoprofy-->
         

           <div  class="col-sm-12 cenbottom  edit-pro"><input type="file" id="my_file"> <a id="get_file" value="Grab file" class="file_input largeredbtn">Upload Video  <i class="fas fa-pencil-alt"></i></a> </div>
            <div class="col-sm-12 cenbottom  edit-pro"> <a href="#"  data-toggle="modal" data-target="#record_video" class="largeredbtn">record video  <i class="fas fa-pencil-alt"></i></a> </div>

          </div>

          <!--addicta--> 
          
        </div>
        <!--inner-aboutus-->
        
        <div class="inner-aboutus topmergline padbotnm">
          <div class="detalsprofile ecome">
            <h4 class="textcandidate">4 tips to become a top candidate</h4>
          </div>
          <!--detalsprofile-->
          
          <ul class="hassle palrft">
            <li>Complete all your profile info.</li>
            <li>Broadcast your skills in a high quality video.</li>
            <li>Add your job preference.</li>
              <li>Upload A high quilaty formal picture in your profile.</li>
          </ul>
          <div class="videoprofy"> <a href="#" data-toggle="modal" data-target="#myModal4" class="watchvideo"> <img src="images/slide5.jpg"> <i class="fas fa-play"></i>
            <p>watch demo video</p>
            </a>
            <div class="centbotmm"> <a href="#" class="skiplink">view more tips and articles </a> </div>
          </div>
          <!--videoprofy--> 
          
        </div>
        <!--inner-aboutus--> 
        
      </div>
      <!--dashboardleft-->
      
     <!--dashboardleft-->
      
     <div class="col-sm-9 dashboardleft">
        <div class="inner-aboutus">
          <div class="currencytext resultstext">
            <h2>recommended jobs</h2>
<a href="/yourfavouritejobs"  class="largeredbtn" style="margin-right: 20px;float:right">Favourite Jobs <i class="fas fa-heart"></i></a>

<a href="/yourappliedjobs"  class="largeredbtn" style="margin-right: 20px;float:right">Applied Jobs <i class="fas fa-thumbs-up"></i></a> 

<a href="/EditCandidate/{{(\Auth::user()->id)}}"  class="largeredbtn" style="margin-right: 20px;float:right">Edit Profile<i class="fas fa-pencil-alt"></i></a> 


           


<div class="col-md-4">
</div>

 


          <!--resultstext-->
          
          <div class="row">
            <div class="col-sm-8 leftdshbord">
              <div class="row">
                 @for($i=0;$i < $count;$i++) 
                <div class="col-sm-6 company com-dashboard">
                  <div class="ineercompany" style=" height:40%;"> 

                    <div class="tidiv"> <img src="images/car1.jpg"> <span> {{$RecommandJobs[$i]->job_for}}</span></div>
                    <!--tidiv-->
                    
                    <h4 class="innertitltext">{{$RecommandJobs[$i]['user']['name']}} </h4>
                    <p class="officer">{{$RecommandJobs[$i]->job->name}}</p>
                    <ul class="hassle salary">
                    
                       <li> <strong>loc.</strong>{{$RecommandJobs[$i]['country']['name']}} </li>
                 @if($RecommandJobs[$i]->min_salary !=null && $RecommandJobs[$i]->max_salary !=null)
                    
                <li> <strong>salary.</strong>{{number_format($RecommandJobs[$i]->min_salary)}}-{{number_format($RecommandJobs[$i]->max_salary)}} {{($RecommandJobs[$i]->Currency)?$RecommandJobs[$i]->Currency->name:"Currency is not set"}}</li> 
                @elseif($RecommandJobs[$i]->min_salary !=null)
                  
                <li> <strong>salary.</strong>{{number_format($RecommandJobs[$i]->min_salary)}} {{($RecommandJobs[$i]->Currency)?$RecommandJobs[$i]->Currency->name:"Currency is not set"}}</li> 
                @else
                <li> <strong>salary.</strong>{{number_format($RecommandJobs[$i]->max_salary)}} {{($RecommandJobs[$i]->Currency)?$RecommandJobs[$i]->Currency->name:"Currency is not set"}}</li> 
                @endif

                    </ul>

                    <div class="tidivbotom"> <a href="/ViewJob/{{$RecommandJobs[$i]['id']}}">apply now</a> <span>{{$RecommandJobs[$i]->created_at}}</span></div>

                    <!--tidiv--> 
                    
                  </div>
                  <!--inernews--> 
                  
                </div>

                       @endfor
                <!--com-dashboard-->
          
          
    
                
              </div>
              <!--row--> 
              
            </div>
            <!--leftdshbord-->
            
            <div class="col-sm-4 leftdshbord" id="map" style=" width: 30%; height: 120%;margin-top: 20px;">
           
              
            </div>
            <!--leftdshbord--> 
            
          </div>
         
          <!--row-->
          
          <div class="cenbottom nomergbotm"> <a href="/recomanded" class="largeredbtn">view more jobs</a> </div>
        </div>
        <!--inner-aboutus-->
        
        <div class="inner-aboutus topmergline">
          <div class="currencytext resultstext">
            <h2>your progress</h2>
          </div>
          <!--resultstext-->
         
          @if(Auth::user()->logo != null)
          <div class="row">
            <div class="col-sm-3 profiledeta">
             

               <img src="{{(\Auth::user()->logo)}}" style="width:113px; "> 
              <h3>profile</h3>
              <p>great,add more info
                top increase <label for="file-upload" class="custom-file-upload">
            <a  class="fas fa-pencil-alt" ></a> 
           </label> strenght</p>
            </div>
             @else
   <div class="row">
            <div class="col-sm-3 profiledeta">
              <div class="innersprof nnersp"> <i class="fas fa-user"></i> </div>
              <h3>profile</h3>
              <p>great,add more info
                top increase <label for="file-upload" class="custom-file-upload">
            <a  class="fas fa-pencil-alt" ></a> 
           </label> strenght</p>
            </div>
            @endif


            <!--profiledeta-->
            @if($CandidateInfo->vedio_path != null)
            <div class="col-sm-3 profiledeta">
              <div class="innersprof">  <video src="{{($CandidateInfo->vedio_path)}}" style="margin: 5% 5% 5% 5%;width: 90%;"> <i class="fas fa-cloud-upload-alt"></i> </div>
              <h3>upload a video</h3>
              <p>great,add more info
                top increase <a href="#">profile</a> strenght</p>
            </div>
           </a> </div>
           @else
             <div class="col-sm-3 profiledeta">
              <div class="innersprof nnersp">   <div  class="col-sm-12 cenbottom  edit-pro"> <input type="file" id="my_file2"> <a id="get_file2" value="Grab file" class="file_input largeredbtn"> <i class="fas fa-cloud-upload-alt" ></i></a></div> </p>  </div>
              <h3>upload a video</h3>
              <p>great,add more info
                top increase<a href="#"  data-toggle="modal" data-target="#myModa2" >
                 <i class="fas fa-pencil-alt"></i></a>  strenght
                  
               
            </div>
            <!--profiledeta-->
             @endif
            <div class="col-sm-3 profiledeta"  >
              <div class="innersprof nnersp"> <i class="fas fa-plug" ></i> </div>
              <h3>online interview</h3>
              <p>great,add more info
                top increase <a href="#">profile</a> strenght</p>
            </div>
            <!--profiledeta-->
            
            <div class="col-sm-3 profiledeta" >
              <div class="innersprof nnersp"> <i class="fas fa-users" ></i> </div>
              <h3>hiring</h3>
              <p>great,add more info
                top increase <a href="#">profile</a> strenght</p>
            </div>
            <!--profiledeta--> 
            
          </div>
          <!--row--> 
          
        </div>
        
        <!--inner-aboutus-->
        
        <div class="inner-aboutus topmergline">
          <div class="currencytext resultstext">
            <h2>matching jobs</h2>
          </div>
          <!--resultstext-->
          
          <div class="row">
            @foreach($MatchingJobs  as $val)
            <div class="col-sm-4 company com-dashboard">
              <div class="ineercompany">
                <div class="tidiv"> <img src="images/car1.jpg"> <span> {{$val->job_for}}</span></div>
                <!--tidiv-->
                
                <h4 class="innertitltext">{{$val['user']['name']}}</h4>
                <p class="officer">{{$val->job->name}}</p>
                <ul class="hassle salary">
                   <li> <strong>loc.</strong>{{$val['country']['name']}} </li>
                   @if($val->min_salary !=null && $val->max_salary !=null)
                    
                    <li> <strong>salary.</strong>{{number_format($val->min_salary)}}-{{number_format($val->max_salary)}} {{($val->Currency)?$val->Currency->name:"Currency is not set"}}</li> 
                    @elseif($val->min_salary !=null)
                      
                    <li> <strong>salary.</strong>{{number_format($val->min_salary)}} {{($val->Currency)?$val->Currency->name:"Currency is not set"}}</li> 
                    @else
                    <li> <strong>salary.</strong>{{number_format($val->max_salary)}} {{($val->Currency)?$val->Currency->name:"Currency is not set"}}</li> 
                    @endif
                  
                </ul>
                <div class="tidivbotom"> <a href="/ViewJob/{{$val->id}}">apply now</a> <span>{{$val->created_at}}</span></div>
                <!--tidiv--> 
                
              </div>
              <!--inernews--> 
              
            </div>
            <!--com-dashboard-->
            
       @endforeach
     
            
          </div>
          <!--row-->
          
          <div class="cenbottom nomergbotm"> <a href="/morejobs" class="largeredbtn">view more jobs</a> </div>
        </div>
          <!--row-->
          
         
       
        
        <!--inner-aboutus-->
      
              
        <div class="inner-aboutus topmergline">
          <div class="currencytext resultstext">
            <h2>candidates looking for the same job</h2>
          </div>
          <!--resultstext-->
          
          <div class="row">

             @foreach($Candidates as $val)
            <div class="col-sm-4 company com-dashboard">
              <div class="ineercompany nonepad"> <a href="#" class="imgbox"> <img src="{{($val->user->logo)?$val->user->logo:'images/4.jpg'}}"> <i class="fas fa-play"></i></a>
                <div class="padboxs"> <span class="eyeicons"><i class="fas fa-eye"></i> 20,215</span> <span class="eyeicons"><i class="fas fa-flag"></i> 20,215</span>
                   <h4 class="innertitltext">{{$val->user->name}}</h4>
            <p class="officer">{{$val->job->name}}</p>
                  <ul class="hassle salary">
                    <li> 28 years</li>
                    <li>{{($val->nationality)?$val->nationality->name:"Nationality is not set"}}</li>
                  </ul>
           <div class="tidivbotom"> <a href="/candidate/{{$val->user->id}}">View Profile</a> <span>{{$val->created_at}}</span></div>
                  <!--tidiv--> 
                  
                </div>
                <!--padboxs--> 
                
              </div>
              <!--inernews--> 
              
            </div>

              @endforeach
            <!--com-dashboard-->
            
        
            <!--com-dashboard-->
            
        
          
            
          </div>
          <!--row-->
          
          <div class="cenbottom nomergbotm"> <a href="/candidates" class="largeredbtn">view more candidates</a> </div>
        </div>
        
        <!--inner-aboutus--> 
        
      </div>
        <!--inner-aboutus--> 
        
     
      
      <!--dashboardleft--> 
      
    </div>
    <!--row--> 
    
  </div>
  
  <!--container--> 
  
</section>
<!--section-->


 <div id="myModal4" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> watch demo video
        <button type="button" class="close" data-dismiss="modal">x</button>
      </div>
      <div class="textbox">
      <iframe width="560" height="315" src="https://www.youtube.com/embed/Hp_HySkpTa8" frameborder="0"  encrypted-media="allowfullscreen"></iframe> 
      </div>
      <!--textbox--> 
      
    </div>
  </div>
</div>
<!--myModal-->
 <div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> watch demo video
        <button type="button" class="close" data-dismiss="modal">x</button>
      </div>
      <video style="text-align: center; margin: 5% 5% 5% 5%;width: 90%;" controls>
        <source src="{{$CandidateInfo->vedio_path}}" >
      </video>
      <!--textbox--> 
      
    </div>
  </div>
</div>
<!--myModal-->



<div id="myModa2" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> record a video
        <button type="button" class="close" data-dismiss="modal">x</button>
      </div>
      <div class="textbox">
        <form action="#" method="" class="formlogin video-rc">
         
          <video id="myVideo" class="video-js vjs-default-skin"></video>
          <div class="divwits iconfont">
            <label style="color: red" id="Sucessrecord"></label>
           
          </div>
          <!--divwits-->
          
        
          <!--divwits-->
          
        </form>
      </div>
      <!--textbox--> 
      
    </div>
  </div>
</div>
<!--myModa2-->
<div id="myModal3" class="modal fade">
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
<div id="myModal7" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> Update your Profile
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="col-md-12" style="margin-top:10px;text-align:center">
      <span> What you did is perfect so far!</span>
      </div>
      <div class="col-md-12" style="margin-top:10px;text-align:center">
      <span>Please let your employer know you your skills to hire you NOW! 
       </span>
      </div>
      <div class="col-md-12" style="margin-top:10px;text-align:center">
      <span>No of jobs  matched 
       </span>
       <br>
       <strong style="font-size: xx-large;color: red;">{{$popo}}</strong>
      </div>
      <div class="textbox" id="v1">
      <div class="text-only">profile strength: <span>
      {{$CandidateInfo->coins/2*100/100}}%</span></div>
              <!--text-only-->
              <div class="progress">
                <div class="progress-bar" style="width: {{$CandidateInfo->coins/2*100/100}}%;"></div>
              </div>
              
              <div class="col-md-12" style="margin-top:10px;text-align:center">
             <center>
              <a href="/EditCandidate/{{(\Auth::user()->id)}}"  class="largeredbtn" style="margin-top: 20px;
    margin-right: 20px;
    float: inherit;">Complete your Profile</a> 
<center>

      </div>

              
      </div>
      <!--textbox--> 
      
    </div>
  </div>
</div>


<div id="record_video" class="modal fade record_video stream" role="dialog">
        <div class="modal-dialog ">
            <!-- Modal content-->
          <div class="modal-content inpudata">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Record your Video</h4>
                </div>
                <div class="modal-body inpudata">
                    <div id="container">
                        <div class="col-sm-12" hidden>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-3">
                                <label class="pull-right">:<span style="color: red;">*</span> </label>
                            </div>
                            <div class="col-sm-4 inpudata"  >
                                <input type="text" name="video_title" id="video_title" class="form-control">
                            </div>
                        </div>
                        <div class="in-iframe">
                          <video id="gum" autoplay muted style="width: 100%;
                          margin:0px 0px 0px 0px;background-color:black"></video>
                          <video id="recorded" hidden style="width: 100%;
                          margin: 10px 10px 10px;"></video>
</div>
<div class="divwits">
            <div class="row" style="Background-color:#009df4">
            <div class="col-sm-3 record-ve" style="margin-bottom:-30px">
                            <button class=" largeredbtn"   id="record" ><i class="fas fa-video"></i>record</button>
                            </div>
                            <div class="col-sm-3 record-ve">
                            <button class=" largeredbtn"  id="play" disabled> <i class="fas fa-play"></i>play</button>
                            </div>
                            <div class="col-sm-3 record-ve">
                            <button class=" largeredbtn"  id="uploadv" disabled> <i class="fas fa-upload"></i>save</button>
                            </div>
                            <div class="col-sm-3 record-ve">
                            <button class=" largeredbtn"  id="download" disabled><i class="fas fa-download"></i>Download</button>
                       
                            </div>
</div>
</div>
                        <div class="row" id="progress_v" hidden>
                            <div id="loader">
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="lading"> uploading wait please ...</div>

                        </div>
                     </div>
                  </div>

     
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-default close_vedio" data-dismiss="modal"></button> -->
                </div>
  </div>
  </div>
</div>


@endsection
<script type="text/javascript" src="/js/slick.min.js"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" >
$(window).load(function()
{
    console.log("FFF",{{$CandidateInfo->coins/2*100/100}});
  if({{$CandidateInfo->coins/2*100/100}}<100)
  {
    $('#myModal7').modal('show');
  }

     
   
});
</script>
@section('scripts')

    <script>

'use strict';
    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
                getJobs(page);
            }
        }
    });
    $(document).ready(function() {




        $(document).on('click', '.pagination a', function (e) {
          getJobs($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });




var mediaSource = new MediaSource();
        mediaSource.addEventListener('sourceopen', handleSourceOpen, false);
        var mediaRecorder;
        var recordedBlobs;
        var sourceBuffer;

        var gumVideo = document.querySelector('video#gum');
        var recordedVideo = document.querySelector('video#recorded');


        var recordButton = document.querySelector('button#record');
        var playButton = document.querySelector('button#play');
        var downloadButton = document.querySelector('button#download');
        recordButton.onclick = toggleRecording;
        playButton.onclick = play;
        downloadButton.onclick = download;

        // window.isSecureContext could be used for Chrome
        var isSecureOrigin = location.protocol === 'https:' ||
                location.hostname === 'localhost';
        if (!isSecureOrigin) {

            var alert_content='';
            alert_content+='getUserMedia() must be run from a secure origin: HTTPS or localhost.' +
                    '\n\nChanging protocol to HTTPS';

            $('#alert_box').append(alert_content);
            $('#record_video').modal('hide');

            location.protocol = 'HTTPS';
        }

        var constraints = {
            audio: true,
            video: true
        };

        var uploadfiles = document.querySelector('button#uploadv');
        uploadfiles.onclick = uploadFile;

        function uploadFile(){
            $('#progress_v').show();
            var blob = new Blob(recordedBlobs, {type: 'video/webm'});
            var fileType = blob.type.split('/')[0] || 'audio';
            var fileName = (Math.random() * 1000).toString().replace('.', '');
            if (fileType === 'audio') {
                fileName += '.' + (!!navigator.mozGetUserMedia ? 'ogg' : 'wav');
            } else {
                fileName += '.webm';
            }
            

            var url = window.URL.createObjectURL(blob);
    
            var a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.upload = 'test.webm';
            document.body.appendChild(a);
            // a.click();

            var surl = '/EditStoreVideo';

            var xhr = new XMLHttpRequest();

            var fd = new FormData();

            xhr.open("POST", surl, true);

            xhr.onreadystatechange = function() {

                if (xhr.readyState == 4 && xhr.status == 200) {
                 // $('#myModalcongratulation').modal('show');
                  
                  //  var alert_content='';
                  //   alert_content+=' <div class="alert alert-success alert-dismissable fade in " id="profile_alert">';
                  //   alert_content+=' <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                  //   alert_content+='<strong>{{trans('ocs/registration::massages/message.success.video_uploaded')}}</strong>';
                  //   alert_content+=' </div>';
                  
                    $('#record_video').modal('hide');
                    $('#video_data').val("{{asset('/candidates/videos/')}}"+'/'+fileName);
                    return;
                    // Every thing ok, file uploaded
                    console.log(xhr.responseText); // handle response.


                }
                else

                {

                }

            };

            fd.append(fileType + '-filename', fileName);
            
            fd.append(fileType + '-blob', blob);
            fd.append('video_title',$('#video_title').val());
            fd.append('id',$('#canid').val());
            fd.append('_token','{{csrf_token()}}');
            xhr.send(fd);


        }

        function handleSuccess(stream) {

            recordButton.disabled = false;
            console.log('getUserMedia() got stream: ', stream);
            window.stream = stream;
            if (window.URL) {
                gumVideo.src = window.URL.createObjectURL(stream);
            }
            else {
                gumVideo.src = stream;
            }
        }

        function handleError(error) {

            console.log('navigator.getUserMedia error: ', error);
        }
        $('.record_video').on('click',function(){

            navigator.mediaDevices.getUserMedia(constraints).
                    then(handleSuccess).catch(handleError);

        });

        $('.stream').on('hidden.bs.modal', function () {

            $('#gum').hide();
            $('#recorded').hide();
            recordButton.textContent = 'record';
            if (mediaStream.getVideoTracks().length && mediaStream.getVideoTracks()[0].stop) {
    mediaStream.getVideoTracks().forEach(function(track) {
        track.stop();
    });
}


           // stream.getVideoTracks()[0].stop();
        });





        function handleSourceOpen(event) {
            console.log('MediaSource opened');
            sourceBuffer = mediaSource.addSourceBuffer('video/webm; codecs="vp8"');
            console.log('Source buffer: ', sourceBuffer);
        }

        recordedVideo.addEventListener('error', function(ev) {
            console.error('MediaRecording.recordedMedia.error()');

            var alert_content='';
            alert_content+='Your browser can not play\n\n' + recordedVideo.src
                    + '\n\n media clip. event: ' + JSON.stringify(ev);

            $('#alert_box').append(alert_content);
            $('#record_video').modal('hide');

        }, true);

        function handleDataAvailable(event) {

            if (event.data && event.data.size > 0) {
                recordedBlobs.push(event.data);
            }
        }

        function handleStop(event) {

            console.log('Recorder stopped: ', event);
        }

        function toggleRecording() {
         

            if (recordButton.textContent === 'record') {
                startRecording();
            }
            else
            {
                stopRecording();
                recordButton.textContent = 'record';
                playButton.disabled = false;
                downloadButton.disabled = false;
                uploadfiles.disabled = false;


            }
        }

        function startRecording() {


var recorder = new window.MediaRecorder(stream);
            $('#gum').show();
            recordedBlobs = [];
            var options = {mimeType: 'video/webm;'};
            if (!MediaRecorder.isTypeSupported(options.mimeType)) {

                console.log(options.mimeType + ' is not Supported');
                options = {mimeType: 'video/webm;codecs=vp8'};
                if (!MediaRecorder.isTypeSupported(options.mimeType)) {
                    console.log(options.mimeType + ' is not Supported');
                    options = {mimeType: 'video/webm'};
                    if (!MediaRecorder.isTypeSupported(options.mimeType)) {
                        console.log(options.mimeType + ' is not Supported');
                        options = {mimeType: ''};
                    }
                }
            }

            try
            {
              console.log("StartRecord");
              mediaRecorder = new MediaRecorder(window.stream, options);

            }

            catch (e)
            {
              console.log("StartRecord Wrong");
                console.error('Exception while creating MediaRecorder: ' + e);
                var alert_content='';
                alert_content+='Exception while creating MediaRecorder: '
                        + e + '. mimeType: ' + options.mimeType;
                $('#alert_box').append(alert_content);
                $('#record_video').modal('hide');

                return;
            }
            console.log('Created MediaRecorder', mediaRecorder, 'with options', options);
            recordButton.textContent = 'Stop record';
            playButton.disabled = true;
            downloadButton.disabled = true;
            uploadfiles.disabled = true;

            mediaRecorder.onstop = handleStop;
            mediaRecorder.ondataavailable = handleDataAvailable;
            mediaRecorder.start(10); // collect 10ms of data
            console.log('MediaRecorder started', mediaRecorder);
        }

        function stopRecording() {
            // $('#gum').hide();
            mediaRecorder.stop();
            console.log('Recorded Blobs: ', recordedBlobs);
            recordedVideo.controls = true;
        }

        function play() {
          $('#gum').hide();
            $('#recorded').show();
            var superBuffer = new Blob(recordedBlobs, {type: 'video/webm'});
            recordedVideo.src = window.URL.createObjectURL(superBuffer);
        }

        function download() {

            var blob = new Blob(recordedBlobs, {type: 'video/webm'});
            var url = window.URL.createObjectURL(blob);
            var a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = 'test.webm';
            document.body.appendChild(a);
            a.click();
            setTimeout(function() {
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            }, 100);
        }









    });
    function getJobs(page) {
        $.ajax({
            url : '/jobs?' ,
            dataType: 'json',
            data:{page:page,job:1}
        }).done(function (data) {
            $('.row').html(data);
            location.hash;
        }).fail(function () {
            alert('jobs could not be loaded.');
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

<script type="text/javascript"> 


var map;

 $(document).ready(function(){


    
   

     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
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
    var lat = {!!json_encode($CandidateInfo->country->Lat)!!};
   
   var lang = {!!json_encode($CandidateInfo->country->Lnag)!!};
      console.log(lat,lang);
     
          map = new google.maps.Map(document.getElementById('map'), {
          
            center:new google.maps.LatLng(lat,lang),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoom: 3
          });
     ajaxCall();
document.getElementById('get_file').onclick = function() {
    document.getElementById('my_file').click();
};
document.getElementById('get_file2').onclick = function() {
    document.getElementById('my_file2').click();
};

$('#my_file').change(function (e) {
    var myFile = $('#my_file').prop('files');
var video=myFile[0];
    var id=  $("#canid").val();
 
       var fd = new FormData();
    fd.append('id', id);
    fd.append('video',video);

            $.ajax({
            
             url: '/EditUploadVideo',
             type: "POST",
                    contentType: false, // Not to set any content header
                    processData: false, // Not to process data
                    data: fd,
            
            
      
    });

});

$('#my_file2').change(function (e) {
    var myFile = $('#my_file2').prop('files');
var video=myFile[0];
    var id=  $("#canid").val();
 
       var fd = new FormData();
    fd.append('id', id);
    fd.append('video',video);

            $.ajax({
            
             url: '/EditUploadVideo',
             type: "POST",
                    contentType: false, // Not to set any content header
                    processData: false, // Not to process data
                    data: fd,
            
            
      
    });

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


   


  });
  
 </script>


<script>

var markerArr = new Array();
function clearOverlays() {
    if (markerArr) {
      for (i in markerArr) {
        markerArr[i].setVisible(false)
        
      }
    // console.log("clear");
    }
}

function ajaxCall() {
  var marker,i;
   $.ajax({
        type: "GET",
        url : '{{url("/getjobsbycountry")}}',
        success: function(response) {
          var jArray = JSON.parse(response);
           console.log(jArray);
           
          var infowindow = new google.maps.InfoWindow();
          console.log(jArray.jobs.length);
                  for (i = 0; i < jArray.jobs.length; i++) {
                   
                  marker = new google.maps.Marker({
                      position: new google.maps.LatLng(jArray.jobs[i].country.Lat, jArray.jobs[i].country.Lnag),
                      map: map
   });
            
           
       var geocoder = new google.maps.Geocoder();
        var latitude = jArray.jobs[i].country.Lat;
        var longitude = jArray.jobs[i].country.Lnag;
        var address_arr = new Array();
        var latLng = new google.maps.LatLng(latitude,longitude);
        //console.log(jArray.jobs[i].job_for);
        if(jArray.jobs[i].job_for=='Jobs in UAE')
      {
      
        marker = new google.maps.Marker({
                      position: new google.maps.LatLng(25.276987,55.296249),
                      map: map
   });
            
           
       var geocoder = new google.maps.Geocoder();
        var latitude = 25.276987;
        var longitude =55.296249;
        var address_arr = new Array();
        var latLng = new google.maps.LatLng(latitude,longitude);
        console.log(latLng);
      }
      if(jArray.jobs[i].job_for=='Jobs in KSA')
      {
      
        marker = new google.maps.Marker({
                      position: new google.maps.LatLng(19.128445,41.924606),
                      map: map
   });
            
           
       var geocoder = new google.maps.Geocoder();
        var latitude = 19.128445;
        var longitude =41.924606;
        var address_arr = new Array();
        var latLng = new google.maps.LatLng(latitude,longitude);
        console.log(latLng);
      }
      if(jArray.jobs[i].job_for=='Jobs in USA')
      {
      
        marker = new google.maps.Marker({
                      position: new google.maps.LatLng(40.730610,-73.935242),
                      map: map
   });
            
           
       var geocoder = new google.maps.Geocoder();
        var latitude = 40.730610;
        var longitude =-73.935242;
        var address_arr = new Array();
        var latLng = new google.maps.LatLng(latitude,longitude);
        console.log(latLng);
      }
      if(jArray.jobs[i].job_for=='Jobs in Qatar')
      {
      
        marker = new google.maps.Marker({
                      position: new google.maps.LatLng(25.286106,51.534817),
                      map: map
   });
            
           
       var geocoder = new google.maps.Geocoder();
        var latitude = 25.286106;
        var longitude =51.534817;
        var address_arr = new Array();
        var latLng = new google.maps.LatLng(latitude,longitude);
        console.log(latLng);
      }

        geocoder.geocode({       
            latLng: latLng     
          }, 
        function(responses) 
            {     
              if (responses && responses.length > 0) {    
                  address_arr.push(responses[0].formatted_address); 
              } 
              else{     
                  address_arr[i] = 'Not getting address for given latitude and longitude';  
              }   
            }
        );
    google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            infowindow.setContent('job title '+jArray.jobs[i].job.name+' <br/> Salary '+ jArray.jobs[i].min_salary + ':' + jArray.jobs[i].max_salary +'<br/> Job for' + jArray.jobs[i].job_for);
            infowindow.open(map, marker);
          }
        })(marker, i));


    markerArr[i]=marker;

             
    }
  }});
}

     


</script>

<Script>

function ShowVideo($id,$type)
{
  
 $typeM='video/'+$type;
var int="";
$("#v1").html('');

$("#v1").html('<video style="text-align: center;style="margin: 5% 5% 5% 5%;width: 90%;" controls><source src="'+$id+'" ></source></video>' );

 $('#myModal3').modal('show');
}

function Gotopagation()
{

  $.ajax({
    type: "POST", 
    url:'/jobs',
    data: { asd: '2' },
    dataType: "json",
  }).done(function(data){
    $('.content').html(data);
  });






}
</script>

   

@endsection
