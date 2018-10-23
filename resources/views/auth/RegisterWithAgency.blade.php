@extends('Layout.app')
<script src="https://cdn.webrtc-experiment.com/RecordRTC.js"></script>
    <script src="https://cdn.webrtc-experiment.com/gif-recorder.js"></script>
    <script src="https://cdn.webrtc-experiment.com/getScreenId.js"></script>

    <!-- for Edige/FF/Chrome/Opera/etc. getUserMedia support -->
    <script src="https://cdn.webrtc-experiment.com/gumadapter.js"></script>

<style>
  .select2-selection__rendered{

    background: #ccc;
    border: 1px solid rgba(115, 115, 115, 0.48)!important;
    float: left;
    width: 100%;
    height: 40px;
    border-radius: 5px;
    /* border: 0; */
    box-shadow: none;
    border: 2px solid #d7d7d7;
    margin-top: 10px;
    color: rgba(0,0,0,0.7)!important;;
  }
  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 57px!important;}
  .select2-container .select2-selection--single
  {
    height: 0px!important;
  }
  .select2-container--default .select2-selection--single{    background-color: 0!important;border: 0!important}
  .watchvideo img{
    height: 20%!important;
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
  #step-2{
    display:none;
  }
   #step-3{
    display:none;
  }
.marginclass{
    margin-top:15px;
}


</style>
@section('content')
<section class=""  fixed center center no-repeat; background-size:cover;">
  <div class="container">
  <div class="inner-contacts">
      <h2 class="textcandidate conmerg">Register your own Candidate</h2>
      <div class="col-md-12 col-sm-12 contacts">
      <form  action="/registercandidateagency" method="POST" class="formlogin" enctype="multipart/form-data">
        {{csrf_field()}}
            <div class="divwits">
                <input type="text" class="form-control requirments" name="name" placeholder="full name" style="background: #ccc;color:rgba(0,0,0,0.7)!important">
            </div>
            <div class="divwits marginclass">
                <select class="form-control requirments" name="job_id" id="job_id" required=""  >
                   <option selected="" disabled="disabled" >desired job</option>
                    @foreach(\App\Job::all() as $job)
                      <option value="{{$job->id}}">{{$job->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="divwits marginclass">
                <select class="form-control requirments" name="industry_id" id="industry_id" required="" >
                  <option selected="" disabled="disabled" >desired industry</option>
                    @foreach(\App\Industry::all() as $ind)
                      <option value="{{$ind->id}}" >{{$ind->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="divwits marginclass"> 
                <select class="form-control requirments" name="country_id" id="country_id" required="" >
                  <option selected="" disabled="" >desired location</option>
                   @foreach(\App\Country::all() as $country)
                      <option value="{{$country->id}}" >{{$country->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="divwits marginclass">
                <select class="form-control requirments chosen-select types" data-placeholder="Choose a Skill.." name="skill_ids[]" id="skill_ids" multiple="multiple" required="" style="width: 90%;" >
                    @foreach(\App\Skills::all() as $skill)
                    <option value="{{$skill->id}}">{{$skill->name}}</option>
                    @endforeach
                </select>
            </div>
             <div class="divwits marginclass">
                <div class="row">
                  <div class="col-sm-4 airports availability"> gender</div>
                      <label class="col-sm-4 airports">
                      <input type="radio" name="gender" value="0" checked="">
                      <span class="label-text" >male</span> </label>
                      <label class="col-sm-4 airports">
                      <input type="radio" name="gender" value="1">
                      <span class="label-text" >female</span> </label>
                  </div>
                </div>
            </div>
            <div class="divwits marginclass" style="margin-left: 30%;">
               <input type="file" id="video_file" style="display: none;" name="video_file" > 
               <a href="#"  class="largeredbtn  file_input"  style="margin-right: 20px;">
                <i class="fas fa-cloud-upload-alt"></i>
                 upload a video
                </a>
               <a href="#" data-toggle="modal" data-target="#record_video" class="largeredbtn" > <i class="fas fa-video" ></i> record a video</a>
            </div>
            <div class="divwits mergbot" style="margin-left: 85%;">
                <button type="submit"  class="largeredbtn">Finish <i class="fas fa-check"></i></button>
              
            </div>
       </form>     
      </div>
   </div>   

  <!--container--> 
  {!! JsValidator::formRequest('App\Http\Requests\CanRegisterFormRequest', '.formlogin'); !!}
</section>
<!--section-->


<div id="myModalcongratulation" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> 
       
      </div>
      <div class="textbox">
      
     Congratulation,your video uploaded sucessfuly please enter finsh to submit your profile
    </div>
  </div>
      </div>
      <!--textbox--> 
      
    </div>
  </div>
</div>


<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> watch demo video
        <button type="button" class="close" data-dismiss="modal">أ—</button>
      </div>
      <div class="textbox">
         <iframe width="560" height="315" src="https://www.youtube.com/embed/Hp_HySkpTa8" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
      </div>
      <!--textbox--> 
      
    </div>
  </div>
</div>
<!--myModal-->

<div id="myModa3" class="modal fade">
  <div class="modal-content dal-conte dal-conte2"> <i class="fas fa-check-circle"></i>
  <h2 class="textcandidate">congratulations</h2>
      <p class="viewsdriver">we found a match jobs  </p> 15
    
   <div class="sk-circle">
        <div class="sk-circle1 sk-child"></div>
        <div class="sk-circle2 sk-child"></div>
        <div class="sk-circle3 sk-child"></div>
        <div class="sk-circle4 sk-child"></div>
        <div class="sk-circle5 sk-child"></div>
        <div class="sk-circle6 sk-child"></div>
        <div class="sk-circle7 sk-child"></div>
        <div class="sk-circle8 sk-child"></div>
        <div class="sk-circle9 sk-child"></div>
        <div class="sk-circle10 sk-child"></div>
        <div class="sk-circle11 sk-child"></div>
        <div class="sk-circle12 sk-child"></div>
      </div>
       <div class="linksing"> rediricling you to the profile page in <span class="nambers">7</span> seconds</div>
   
  </div>
</div>
<div id="myModa2" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> record a video
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="textbox">
        <form action="#" method="" class="formlogin video-rc">

          <video id="myVideo" class="video-js vjs-default-skin"></video>
          <div class="divwits iconfont">
            <label style="color: red" id="Sucessrecord"></label>
           
          </div>
        
        </form>
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
@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript" src="/vendor/jsvalidation/js/jsvalidation.js"></script>
<script src="/dist/jquery.validate.js"></script>
<script>
  $('.file_input').on('click',function(){
    $('#video_file').click();
  });
</script>
<script type="text/javascript">
    $(document).ready(function(){

 $("#step-1-next").click(function(){


 var form = $(".formlogin");
    if (form.valid() == true){
      current_fs = $('#step-1');
      next_fs = $('#step-2');
      next_fs.show(); 
      current_fs.hide();
    }
  });

    });
</script>

<script>
  $('.file_input').on('click',function(){
    $('#video_file').click();
  });
</script>


<script>
 'use strict';


       $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });
    $('#job_id').select2();
    $('#industry_id').select2();
    $('#country_id').select2();
    $(".types").chosen({ 
                   width: '100%',
                   color:'red',
                   no_results_text: "No Results",
                   allow_single_deselect: true, 
                   search_contains:true, });
 $(".types").trigger("chosen:updated");
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
        //uploadfiles.addEventListener('change', function () {

        //v/ar files = this.files;

        // for(var i=0; i<files.length; i++){

        //    uploadFile(this.files[i]); // call the function to upload the file

        //  }

        //}, false);


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

            var surl = '/StoreVideo';

            var xhr = new XMLHttpRequest();

            var fd = new FormData();

            xhr.open("POST", surl, true);

            xhr.onreadystatechange = function() {

                if (xhr.readyState == 4 && xhr.status == 200) {
                  $('#myModalcongratulation').modal('show');
                  
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

      

</script>
@endsection