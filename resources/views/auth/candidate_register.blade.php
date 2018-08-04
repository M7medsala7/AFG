
@extends('Layout.app')
<style>
  .select2-selection__rendered{
    background: rgb(0, 1, 1);
    border: 1px solid rgba(115, 115, 115, 0.48)!important;
    /* color: #fff; */
    float: left;
    width: 100%;
    height: 40px;
    border-radius: 5px;
    /* border: 0; */
    box-shadow: none;
    border: 2px solid #d7d7d7;
    margin-top: 10px;
        color: white!important;
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
</style>
@section('content')
<section class="sliderphoto innerphoto" style="background:url(/images/slide5.jpg) fixed center center no-repeat; background-size:cover;">
  <div class="container">
    <div class="nonebac candobxs">
      <ul class="nav nav-tabs tabscand">
        <li rel-index="0" class="active"> <a href="#step-1" class="btn" aria-controls="step-1" role="tab" data-toggle="tab"> <span> 1</span> <strong>Desired Job</strong><i></i></a> </li>
        <li rel-index="1"> <a href="#step-2" class="btn disabled" aria-controls="step-2" role="tab" data-toggle="tab"> <span>2</span> <strong> Basic Info</strong><i></i></a> </li>
        <li rel-index="2"> <a href="#step-3" class="btn disabled" aria-controls="step-3" role="tab" data-toggle="tab"> <span>3</span> <strong>Your Skills</strong><i></i></a> </li>
      </ul>
      <!--tabssteps-->
      
      <form  action="/registercandidate" method="POST" class="formlogin" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane tabs-inner active" id="step-1">
            <div class="divwits"> 
              <!--          <label class="desired">desired job</label>-->
              <select class="form-control requirments" name="job_id" id="job_id" required="" onblur="processForm(this.form)">
                  <option >desired job</option>
                    @foreach(\App\Job::all() as $job)
                      <option value="{{$job->id}}">{{$job->name}}</option>
                    @endforeach
                </select>
            </div>
            <!--divwits-->
            
            <div class="divwits"> 
              <!--<label class="desired">desired industry</label>-->
             <select class="form-control requirments" name="industry_id" id="industry_id" required="" onblur="processForm(this.form)">
                  <option selected="" disabled="disabled" >desired industry</option>
                    @foreach(\App\Industry::all() as $ind)
                      <option value="{{$ind->id}}" >{{$ind->name}}</option>
                    @endforeach
                </select>
            </div>
            <!--divwits-->
            
            <div class="divwits"> 
              <!--<label class="desired">desired location</label>-->
             <select class="form-control requirments" name="country_id" id="country_id" required="" onblur="processForm(this.form)">
                  <option selected="" disabled="" >desired location</option>
                   @foreach(\App\Country::all() as $country)
                      <option value="{{$country->id}}" >{{$country->name}}</option>
                    @endforeach
                </select>
            </div>
            <!--divwits-->
            
            <div class="divwits">
              <div class="row">
                <div class="col-sm-8  stepotw">
                  <div class="linksing textcand-1">
                    <p id="Points">0</p>
                    <span>earn points <i class="fas fa-trophy"></i><br>
                    with each step</span> </div>
                </div>
                <div class="col-sm-4  stepotw"> <a href="#" id="step-1-next" class="largeredbtn">Next <i class="fas fa-long-arrow-alt-right"></i></a> </div>
              </div>
              <!--row--> 
              
            </div>
            
            <!--divwits--> 
            
          </div>
          <!--tab-pane-->
          
          <div role="tabpanel" class="tab-pane tabs-inner" id="step-2">
            <div class="divwits">
              <div class="row">
                <div class="col-sm-4 airports availability"> gender</div>
                <label class="col-sm-4 airports">
                  <input type="radio" name="gender" value="0" checked="">
                  <span class="label-text" onblur="processForm(this.form)">male</span> </label>
                <label class="col-sm-4 airports">
                  <input type="radio" name="gender" value="1">
                  <span class="label-text" onblur="processForm(this.form)">female</span> </label>
              </div>
            </div>
            <!--divwits-->
            
            <div class="divwits"> 
              <!-- <label class="desired">full name</label>-->
              <input type="text" class="form-control requirments" name="name" placeholder="full name" onblur="processForm(this.form)">
            </div>
            <!--divwits-->
            
            <div class="divwits"> 
              <!--<label class="desired">email address</label>-->
              <input type="text" class="form-control requirments" name="email" placeholder="email address" onblur="processForm(this.form)">
            </div>
            <!--divwits-->
            
            <div class="divwits iconfont"> 
              <!--<label class="desired">password</label>-->
              <input type="password" class="form-control requirments" name="password" placeholder="password" onblur="processForm(this.form)">
            </div>
            <!--divwits-->
            
            <div class="divwits">
              <div class="row">
                <div class="col-sm-6  stepotw">
                  <div class="linksing textcand-1">
                    <p id="Points2">0</p>
                    <span>earn points <i class="fas fa-trophy"></i><br>
                    with each step</span> </div>
                </div>
                <div class="col-sm-3  stepotw"> <a href="#" id="step-1-back" class="largeredbtn back"> <i class="fas fa-long-arrow-alt-left"></i> back</a> </div>
                <div class="col-sm-3  stepotw"> <a href="#" id="step-2-next" class="largeredbtn">Next <i class="fas fa-long-arrow-alt-right"></i></a> </div>
              </div>
              <!--row--> 
              
            </div>
            <!--divwits-->
            
            <div class="registerwith"> <span>or</span>
              <p>Register With</p>
              <nav class="iconrgest"> <a href="#" class="fab fa-facebook-f" title="facebook"></a> <a href="#" class="fab fa-twitter" title="twitter"></a> <a href="#" class="fab fa-instagram" title="instagram"></a> <a href="#" class="fab fa-google-plus-g" title="google-plus"></a> </nav>
            </div>
          </div>
          <!--tab-pane-->
          
          <div role="tabpanel" class="tab-pane tabs-inner" id="step-3">
            <h3 class="airports cotext"> inrtodce yourself through video , and raise your
              chances of getting hired fast</h3>
            <div class="row">
              <div class="col-sm-6 instructionsleft">
                <h4 class="title-con instructions"> instructions</h4>
                <ol class="hassle prepare">
                  <li> prepare the script first  it</li>
                  <li>record the video ( 2 mins)</li>
                  <li>double check  before uploading</li>
                </ol>
                <a href="#" data-toggle="modal" data-target="#myModal" class="watchvideo"> <img src="/images/slide5.jpg"> <i class="fas fa-play"></i>
                <p>watch demo video</p>
                </a> </div>
              <!--instructionsleft-->
              
              <div class="col-sm-6 instructionsleft">
                <div class="iconsoch">
                  <h3 class="airports inrtodce colorste"> if you have an available camera</h3>
                  <div class="witboots"> <a href="#" data-toggle="modal" data-target="#myModa2" class="largeredbtn back" onblur="processForm(this.form)"> <i class="fas fa-video" ></i> record a video</a> </div>
                  <!--botrg-->
                  
                  <h3 class="airports inrtodce colorste"> in case camera is not available</h3>
                  <div class="witboots"> <input type="file" id="video_file" style="display: none;" name="video_file" onblur="processForm(this.form)"> <a href="#" data-toggle="modal" data-target="#myModa3" class="largeredbtn back file_input" onblur="processForm(this.form)"> <i class="fas fa-cloud-upload-alt"></i> upload a video</a> </div>
                  <!--botrg--> 
                  
                </div>
              </div>
              <!--instructionsleft--> 
              
            </div>
            <!--row-->
            
            <div class="divwits">
              <div class="row">
                <div class="col-sm-6  stepotw">
                  <div class="linksing textcand-1">
                    <p id="Points3">0</p>
                    <span>earn points <i class="fas fa-trophy"></i><br>
                    with each step</span> </div>
                </div>
                <div class="col-sm-3  stepotw"> <a href="#" id="step-2-back" class="largeredbtn back"> <i class="fas fa-long-arrow-alt-left"></i> back</a> </div>
                <div class="col-sm-3  stepotw">
                  <button type="submit" data-toggle="modal" data-target="#myModa3" class="largeredbtn"> finish <i class="fas fa-check"></i></button></button>
                </div>
              </div>
              <!--row--> 
              
            </div>
            <!--divwits--> 
            
            <!--divwits--> 
            
          </div>
          
          <!--tab-pane--> 
          
        </div>
        <!--tab-content-->
        
      </form>
    </div>
    <!--nonebac-->
    
    <div class="col-sm-4 inputbox margmadia">
      <h3 class="title-con entea"> welcome to</h3>
      <h4 class="title-con entea">Maid &amp; Helper</h4>
      <p class="textprgraf">you are just <span>3</span> steps away from <br>
        having the mostmodern profile</p>
    </div>
    <!--margmadia--> 
    <div class="col-sm-4">
       @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
            </ul>
         </div>
        @endif
    </div>
  </div>
  <!--container--> 
  
</section>
<!--section-->

<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> watch demo video
        <button type="button" class="close" data-dismiss="modal">أ—</button>
      </div>
      <div class="textbox">
         <iframe width="560" height="315" src="https://www.youtube.com/embed/whMCdOkI2CU" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
      </div>
      <!--textbox--> 
      
    </div>
  </div>
</div>
<!--myModal-->

<div id="myModa3" class="modal fade">
  <div class="modal-content dal-conte dal-conte2"> <i class="fas fa-check-circle"></i>
  <h2 class="textcandidate">congratulations</h2>
      <p class="viewsdriver">we found a match jobs  </p> 2
    
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
          <!--divwits-->
          
          <div class="divwits">
           <!--  <div class="row">
              <div class="col-sm-3 record-ve">
                <button type="submit" class="largeredbtn"> <i class="fas fa-video"></i> record </button>
              </div>
              <div class="col-sm-3 record-ve">
                <button type="submit" class="largeredbtn"> <i class="fas fa-play"></i> play</button>
              </div>
              <div class="col-sm-3 record-ve">
                <button type="submit" class="largeredbtn"> <i class="fas fa-stop-circle"></i> stop</button>
              </div>
              <div class="col-sm-3 record-ve">
                <button type="submit" class="largeredbtn"> <i class="fas fa-upload"></i> upload</button>
              </div>
            </div> -->
            <!--row--> 
            
          </div>
          <!--divwits-->
          
        </form>
      </div>
      <!--textbox--> 
      
    </div>
  </div>
</div>



@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
  $('.file_input').on('click',function(){
    $('#video_file').click();
  });
</script>
<script>
  $(document).ready(function(){
    $('#job_id').select2();
    $('#industry_id').select2();
    $('#country_id').select2();
  });

  </script>

<script>
  $('.file_input').on('click',function(){
    $('#video_file').click();
  });
</script>
<script>

$(document).ready(function () {
       $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
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
console.log(player.recordedData.video);

     var fd = new FormData();
    fd.append('name', player.recordedData.video.name);
    fd.append('data', player.recordedData.video);

    $.ajax({
        type: 'POST',
        url: '/StoreVideo',
        processData: false,  // tell jQuery not to process the data
         contentType: false,
          data: fd
    }).done(function(data) {
        console.log('data');
    });





});


 });





function processForm(form) {
  
  document.getElementById("Points").innerHTML=0;
  document.getElementById("Points2").innerHTML=0;
  //document.getElementById("Points3").innerHTML=0;

  var control, controls = form.elements;
  for (var i=0, iLen=controls.length; i<iLen; i++) {
    control = controls[i];
 
if(control.value !="" && control.value !=0)
{

 
 document.getElementById("Points").innerHTML = 5+parseInt(document.getElementById("Points").innerHTML);
  document.getElementById("Points2").innerHTML = 5+parseInt(document.getElementById("Points").innerHTML);
  document.getElementById("Points3").innerHTML = 5+parseInt(document.getElementById("Points").innerHTML);
 

 }   // Do something with the control
   // console.log(control.name + ': ' + control.value);
  }

}
</script>

@endsection