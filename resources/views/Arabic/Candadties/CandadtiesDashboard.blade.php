@extends('Layout.app')
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>  
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm3O5N1fP52tnpdSqPt71joqjd9xOkcek"></script>

<script type="text/javascript">  
 
</script>

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
<input  name="imageProfile"  id="file-upload" type="file"/> <input name='userId' type='hidden' id ="canid" value="{{$CandidateInfo->id}}" />




 <a href="#" class="skiplink">view profile </a>
            </div> 
            </form> 

     
          <!--viewprofile-->
          
          <div class="row addicta">
            <div class="detalsprofile">
              <h4 class="textcandidate">{{(\Auth::user()->name)?(\Auth::user()->name):'No Name'}} , {{$age}}</h4>
              <span>{{$jobName->name}}</span> </div>
            <!--detalsprofile-->
            
            <div class="col-sm-12">
              <div class="text-only">profile strength: <span>{{$CandidateInfo->coins*2}}%</span></div>
              <!--text-only-->
              <div class="progress">
                <div class="progress-bar" style="width: {{$CandidateInfo->coins*2}}%;"></div>
              </div>
              <!--progress-->
              
              <div class="pointsnamber"> <i class="fas fa-trophy"></i>
                <p>you have <span>{{$CandidateInfo->coins}}</span> points</p>
              </div>
              <!--pointsnamber--> 
            </div>
            <!--col-sm-12-->
            
        
            <div class="videoprofy"> <a href="#" data-toggle="modal" data-target="#myModal" class="watchvideo"> 
   @if($CandidateInfo->vedio_path != null)
              <video src="{{($CandidateInfo->vedio_path)}}" type="video/{{File::extension($CandidateInfo->vedio_path)}}"> <i class="fas fa-play"></i> </a> 
                @else
                <img src="images/slide5.jpg"> <i class="fas fa-play"></i> </a>
                @endif

                </div>
            <!--videoprofy-->
            <div  class="col-sm-12 cenbottom  edit-pro"><input type="file" id="my_file"> <a id="get_file" value="Grab file" class="file_input largeredbtn">Upload Video  <i class="fas fa-pencil-alt"></i></a> </div>
            <div class="col-sm-12 cenbottom  edit-pro"> <a href="#"  data-toggle="modal" data-target="#myModa2" class="largeredbtn">record video  <i class="fas fa-pencil-alt"></i></a> </div>
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
          <div class="videoprofy"> <a href="#" data-toggle="modal" data-target="#myModal" class="watchvideo"> <img src="images/slide5.jpg"> <i class="fas fa-play"></i>
            <p>watch demo video</p>
            </a>
            <div class="centbotmm"> <a href="#" class="skiplink">view more tips and articles </a> </div>
          </div>
          <!--videoprofy--> 
          
        </div>
        <!--inner-aboutus--> 
        
      </div>
      <!--dashboardleft-->
      
      <div class="col-sm-9 dashboardleft">
        <div class="inner-aboutus">
          <div class="currencytext resultstext">
            <h2>recommended jobs</h2>
            <a href="#" class="prefrnces">edit job prefrnces <i class="fas fa-pencil-alt"></i></a> </div>
          <!--resultstext-->
          
          <div class="row">
            <div class="col-sm-8 leftdshbord">
              <div class="row">
                 @foreach($RecommandJobs  as $val)
                <div class="col-sm-6 company com-dashboard">
                  <div class="ineercompany">
                    <div class="tidiv"> <img src="images/car1.jpg"> <span> {{$val->job_for}}</span></div>
                    <!--tidiv-->
                    
                    <h4 class="innertitltext">{{$val->user->name}} </h4>
                    <p class="officer">{{$val->job->name}}</p>
                    <ul class="hassle salary">
                      <li> <strong>loc.</strong> oman</li>
                       <li> <strong>loc.</strong>{{$val->country->name}} </li>
                <li> <strong>salary.</strong>{{$val->min_salary}}-{{$val->max_salary}} {{($val->Currency)?$val->Currency->name:"Currency is not set"}}</li> 
                    </ul>
                    <div class="tidivbotom"> <a href="#">apply now</a> <span>{{$val->created_at}}</span></div>
                    <!--tidiv--> 
                    
                  </div>
                  <!--inernews--> 
                  
                </div>

                       @endforeach
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
          
          <div class="cenbottom nomergbotm"> <a href="#" class="largeredbtn">view more jobs</a> </div>
        </div>
        <!--inner-aboutus-->
        
        <div class="inner-aboutus topmergline">
          <div class="currencytext resultstext">
            <h2>your progress</h2>
          </div>
          <!--resultstext-->
          @if($CandidateInfo->coins == 50)
          <div class="row">
            <div class="col-sm-3 profiledeta">
              <div class="innersprof"> <i class="fas fa-user"></i> </div>
              <h3>profile</h3>
              <p>great,add more info
                top increase <a href="#">profile</a> strenght</p>
            </div>
             @else
   <div class="row">
            <div class="col-sm-3 profiledeta">
              <div class="innersprof nnersp"> <i class="fas fa-user"></i> </div>
              <h3>profile</h3>
              <p>great,add more info
                top increase <a href="#">profile</a> strenght</p>
            </div>
            @endif


            <!--profiledeta-->
            @if($CandidateInfo->vedio_path != null)
            <div class="col-sm-3 profiledeta">
              <div class="innersprof"> <i class="fas fa-cloud-upload-alt"></i> </div>
              <h3>upload a video</h3>
              <p>great,add more info
                top increase <a href="#">profile</a> strenght</p>
            </div>
           
           @else
             <div class="col-sm-3 profiledeta">
              <div class="innersprof nnersp"> <i class="fas fa-cloud-upload-alt"></i> </div>
              <h3>upload a video</h3>
              <p>great,add more info
                top increase <a href="#">profile</a> strenght</p>
            </div>
            <!--profiledeta-->
             @endif
            <div class="col-sm-3 profiledeta">
              <div class="innersprof nnersp"> <i class="fas fa-plug"></i> </div>
              <h3>online interview</h3>
              <p>great,add more info
                top increase <a href="#">profile</a> strenght</p>
            </div>
            <!--profiledeta-->
            
            <div class="col-sm-3 profiledeta">
              <div class="innersprof nnersp"> <i class="fas fa-users"></i> </div>
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
                
                <h4 class="innertitltext">{{$val->user->name}}</h4>
                <p class="officer">{{$val->job->name}}</p>
                <ul class="hassle salary">
                   <li> <strong>loc.</strong>{{$val->country->name}} </li>
                  <li> <strong>salary.</strong>{{$val->min_salary}}-{{$val->max_salary}} {{($val->Currency)?$val->Currency->name:"Currency is not set"}}</li> 
                </ul>
                <div class="tidivbotom"> <a href="#">apply now</a> <span>{{$val->created_at}}</span></div>
                <!--tidiv--> 
                
              </div>
              <!--inernews--> 
              
            </div>
            <!--com-dashboard-->
            
       @endforeach
     
            
          </div>
          <!--row-->
          
          <div class="cenbottom nomergbotm"> <a href="#" class="largeredbtn">view more jobs</a> </div>
        </div>
        
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
          
          <div class="cenbottom nomergbotm"> <a href="#" class="largeredbtn">view more candidates</a> </div>
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
      <video style="text-align: center;" width="auto" height="auto" controls>
        <source src="{{$CandidateInfo->vedio_path}}" type="video/{{File::extension($CandidateInfo->vedio_path)}}">
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
        <button type="button" class="close" data-dismiss="modal">أ—</button>
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

@endsection

<script type="text/javascript"> 



var map;
 $(document).ready(function(){


     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

document.getElementById('get_file').onclick = function() {
    document.getElementById('my_file').click();
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
   


   var player = videojs("myVideo", {
    controls: true,
    width: 580,
    height: 240,
    fluid: false,
    plugins: {
        record: {
            audio: true,
            video: true,
            maxLength: 120,
            debug: true
        }
    }
}, function(){
    // print version information at startup
    videojs.log('Using video.js', videojs.VERSION,
        'with videojs-record', videojs.getPluginVersion('record'),
        'and recordrtc', RecordRTC.version);
});
// error handling
player.on('deviceError', function() {
    console.log('device error:', player.deviceErrorCode);
});
player.on('error', function(error) {
    console.log('error:', error);
});
// user clicked the record button and started recording
player.on('startRecord', function() {
    console.log('started recording!');
});
// user completed recording and stream is available
player.on('finishRecord', function() {
    // the blob object contains the recorded data that
    // can be downloaded by the user, stored on server etc.
console.log( player.recordedData);

     var fd = new FormData();
    fd.append('name', player.recordedData.video.name);
    fd.append('data', player.recordedData.video);
     fd.append('id', $("#canid").val());
    $.ajax({
        type: 'POST',
        url: '/EditStoreVideo',
            processData: false,
          contentType: false,
        data: fd
    }).done(function(data) {
     document.getElementById("Sucessrecord").innerHTML = "Video record Sucessfully";
      
        //console.log('data');
    });





});
        map = new google.maps.Map(document.getElementById('map'), {
          center:new google.maps.LatLng({{$CandidateInfo->country->Lnag}},{{$CandidateInfo->country->Lat}}),
           mapTypeId: google.maps.MapTypeId.ROADMAP,
          zoom: 8
        });

         ajaxCall();








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
                      position: new google.maps.LatLng(jArray.jobs[i].Lat, jArray.jobs[i].Lnag),
                      map: map
                  });
            
           
       var geocoder = new google.maps.Geocoder();
        var latitude = jArray.jobs[i].Lat;
        var longitude = jArray.jobs[i].Lnag;
        var address_arr = new Array();
        var latLng = new google.maps.LatLng(latitude,longitude);
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
            infowindow.setContent('job title '+jArray.jobs[i].name+' <br/> Salary '+ jArray.jobs[i].min_salary + ':' + jArray.jobs[i].max_salary +'<br/> Job for' + jArray.jobs[i].job_for);
            infowindow.open(map, marker);
          }
        })(marker, i));


    markerArr[i]=marker;
    }
  }});
}

     


</script>
