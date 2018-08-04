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
      
        <!--inner-aboutus-->
        
    
        <!--inner-aboutus--> 
        
      </div>
      <!--dashboardleft-->
    
        
        <!--inner-aboutus-->
      
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
                  <li> <strong>salary.</strong>{{number_format($val->min_salary)}}-{{number_format($val->max_salary)}} {{($val->Currency)?$val->Currency->name:"Currency is not set"}}</li> 
                </ul>
                <div class="tidivbotom"> <a href="/ViewJob/{{$val->id}}">aplay now </a> <span>{{$val->created_at}}</span></div>
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
