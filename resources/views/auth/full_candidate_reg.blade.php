@extends('Layout.app')

<script src="https://cdn.webrtc-experiment.com/RecordRTC.js"></script>
    <script src="https://cdn.webrtc-experiment.com/gif-recorder.js"></script>
    <script src="https://cdn.webrtc-experiment.com/getScreenId.js"></script>

    <!-- for Edige/FF/Chrome/Opera/etc. getUserMedia support -->
    <script src="https://cdn.webrtc-experiment.com/gumadapter.js"></script>


@section('content')
<style>
  .select2-selection__rendered{
    background: rgb(0, 1, 1);
    border: 1px solid rgba(115, 115, 115, 0.48)!important;
    /* color: #fff; */
    float: left;
    width: 350px;
    height: 40px;
    border-radius: 5px;
    /* border: 0; */
    box-shadow: none;
    border: 2px solid #d7d7d7;
    margin-top: 10px;
        color: white!important;
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
 .pass{
           -webkit-text-security:disc;
       }

 button.vjs-device-button.vjs-control.vjs-icon-av-perm:before, button.vjs-device-button.vjs-control.vjs-icon-audio-perm:before, button.vjs-device-button.vjs-control.vjs-icon-video-perm:before {
   
    background-color: #3c763d
}
    .video-js .vjs-control
{

}
  .select2 select2-container select2-container 
  {
width:300px;
  }
 

  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 57px!important;
   }
  .select2-container .select2-selection--single
  {
    height: 0px!important;
  }
  .select2-container--default .select2-selection--single{    background-color: 0!important;border: 0!important}
  .watchvideo img{
    height: 20%!important;
    width:100%
  }
  .select2 select2-container select2-container--default
  {
    width: 300px;
  }
  .select2 select2-container select2-container--default select2-container--below
  {
    width:300px;
  }

 #step-2{
    display:none;
  }
   #step-3{
    display:none;
  }
    #step-4{
    display:none;
  }
    #step-5{
    display:none;
  }
     #step-6{
    display:none;
  }
     #step-7{
    display:none;
  }
   .pass{
           -webkit-text-security:disc;
       }

       .chosen-container-multi .chosen-choices li.search-field input, .chosen-container-multi .chosen-choices li.search-field input[type=text] {
padding: 0!important;
 width: 100% !important;
}
</style>

<section class="sliderphoto innerphoto" style="background:url(/images/slide5.jpg) fixed center center no-repeat; background-size:cover;">
  <div class="container"> 
    <ul class="nav nav-tabs  tabssteps">
      <li rel-index="0" class="active"> <a href="#step-1" class="btn" aria-controls="step-1" role="tab" data-toggle="tab"> <span><i class="glyphicon glyphicon-user"></i></span> </a> </li>
      <li rel-index="1"> <a href="#step-2" class="btn disabled" aria-controls="step-2" role="tab" data-toggle="tab"> <span><i class="glyphicon glyphicon-heart"></i></span> </a> </li>
      <li rel-index="2"> <a href="#step-3" class="btn disabled" aria-controls="step-3" role="tab" data-toggle="tab"> <span><i class="glyphicon glyphicon-plus"></i></span> </a> </li>
      <li rel-index="3"> <a href="#step-4" class="btn disabled" aria-controls="step-4" role="tab" data-toggle="tab"> <span><i class="glyphicon glyphicon-ok"></i></span> </a> </li>
      <li rel-index="4"> <a href="#step-5" class="btn disabled" aria-controls="step-5" role="tab" data-toggle="tab"> <span><i class="glyphicon glyphicon-ok"></i></span> </a> </li>
      <li rel-index="5"> <a href="#step-6" class="btn disabled" aria-controls="step-6" role="tab" data-toggle="tab"> <span><i class="glyphicon glyphicon-ok"></i></span> </a> </li>
      <li rel-index="6"> <a href="#step-7" class="btn disabled" aria-controls="step-7" role="tab" data-toggle="tab"> <span><i class="glyphicon glyphicon-ok"></i></span> </a> </li>
    </ul>
    <!--tabssteps-->
    
    <form  action="/f_reg/candidate" method="post" id="full_cand_reg" class="formlogin mergform"  novalidate enctype="multipart/form-data">
            {{csrf_field()}}
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane  nonebac active" id="step-1">
          <div class="inputbox margmadia nonmegtext nonmerg">
            <h4 class="title-con entea ">welcome to </h4>
            <h5 class="title-con entea"> the future of applications</h5>
            <p class="textprgraf"> be prepared to provide your details
              and make<br>
              sure <span> webcam</span> is on </p>
          </div>
          <!--nonmegtext-->
          
          <div class="innertabs">
            <div class="row">
              <div class="col-sm-6 instructionsleft">
                <h3 class="airports inrtodce"> how does it work?</h3>
                <div class="witboots"> <a href="#" data-toggle="modal" data-target="#myModal" class="largeredbtn "> watch demo video</a> </div>
                <!--botrg-->
                
                <h3 class="airports inrtodce"> ready to start?</h3>
                <a href="#" id="step-1-next" class="largeredbtn"> go <i class="fas fa-long-arrow-alt-right"></i></a> </div>
              <!--instructionsleft-->
              
              <div class="col-sm-6 instructionsleft"> <a href="#" data-toggle="modal" data-target="#myModal" class="watchvideo"> <img src="/images/slide5.jpg"> <i class="fas fa-play"></i>
                <p>watch demo video</p>
                </a> </div>
              <!--instructionsleft--> 
            </div>
            <!--row--> 
             
          </div>
          <!--innertabs--> 
          
        </div>
        <!--tab-pane-->
        <div id="step-2">
        <div role="tabpanel" class="tab-pane nonebac witsteptow" >
          <div class="headtop nonbord borderbox">
            <div class="stapson active"><span>1</span>
              <h4 class="personalinfo">personal info</h4>
            </div>
            <div class="rightcealr"> <span class="active"></span> <span></span> <span></span> <span></span><button type="button" style="float: right;padding: 5px 10px;background: #444551;color: #fff;border-radius: 5px; border: 0 solid;margin-left: 10px;" class="clear_all">clear all</button> </div>
          </div>
          <!--borderbox-->
          
          <div class="row">
            <div class="col-sm-6 leftinput">
              <div class="row">
                <div class="col-sm-12 airports witpostslid">
                  <input type="text" class="form-control requirments" id="first_name"  name="first_name" placeholder="full name" onblur="processForm(this.form)">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <input type="text" class="form-control requirments" name="last_name" placeholder="last name" onblur="processForm(this.form)">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                <select class="form-control requirments" name="nationality_id" id="nation_id" required="" style="width: 90%;"  onblur="processForm(this.form)">
                  <option selected="" disabled="disabled">Nationality</option>
                  @foreach(\App\Nationality::all() as $nation)
                    <option value="{{$nation->id}}" >{{$nation->name}}</option>
                  @endforeach
                </select>
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <select class="form-control requirments" name="country_id" id="country_id" required="" style="width: 90%;" onblur="processForm(this.form)" >
                    <option selected="" > Current Location</option>
                    @foreach(\App\Country::all() as $country)
                      <option value="{{$country->id}}" >{{$country->name}}</option>
                    @endforeach
                  </select>
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <input type="text" class="form-control requirments" name="phone_number" placeholder=" phone no" onblur="processForm(this.form)">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <input type="text" class="form-control requirments" name="email" placeholder="email" onblur="processForm(this.form)">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <input type="text" class="form-control requirments pass" name="password"  placeholder="password" autocomplete="off"  onblur="processForm(this.form)">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid" style"width:100%">
                
                  <select class="form-control requirments" name="gender" id="gender" required="" style="width: 90%;" onblur="processForm(this.form)">
                    <option selected="" style="width: 90%;"  disabled="disabled"> gender</option>
                    <option value="0">Male</option>
                    <option value="1" >female</option>
                  </select>
                </div>
                <!--witpostslid--> 
                
              </div>
              <!--row--> 
              
            </div>
            <!--leftinput-->
            
            <div class="col-sm-6 leftinput">
              <div class="row">
                <div class="col-sm-12 airports witpostslid">
                  <select class="form-control requirments" id ="martial_status" name="martial_status" required="" style="width: 90%;" >
                    <option selected=""  disabled="disabled" > marital status</option>

                    
                    <option value="single" >single</option>
                    <option value="married" >married</option>
                    <option value="devorced" >devorced</option>
                  </select>
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                <select class="form-control requirments" id="religion_id" name="religion_id" required="" style="width: 90%;" onblur="processForm(this.form)" >
                  <option selected=""  > Religion</option>
                    @foreach(\App\Religion::all() as $religion)
                      <option value="{{$religion->id}}" >{{$religion->name}}</option>
                    @endforeach
                </select>
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid"> 
                  
                  <!--             <label class="desired">birth date</label>
-->
<input required="" type="text" style="background-color: transparent;" class="form-control requirments calendar" name="birthdate" placeholder="birth date" onfocus="(this.type='date')" />
                             
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <div class="input-group input-file" name="logo">
                    <input type="text" class="form-control requirments"  placeholder='image...'  />
                    <span class="input-group-btn">
                    <button class="btn btn-default btn-choose largeredbtn brows" type="button" onblur="processForm(this.form)">brows</button>
                    </span> </div>
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <div class="input-group input-file" name="cv_path">
                    <input type="text" class="form-control requirments"  placeholder='cv...' onblur="processForm(this.form)" /> 
                    <span class="input-group-btn">
                    <button class="btn btn-default btn-choose largeredbtn brows" type="button" onblur="processForm(this.form)">upload</button>
                    </span> </div>
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <select class="form-control requirments" id="visa_type"  name="visa_type" required="" style="width: 90%;" onblur="processForm(this.form)">
                     <option selected="" disabled="disabled"> Emploer-type of visa</option>
                    <option  value="None" >None</option>
                    <option  value="Employed" >Employed</option>
                    <option value="Visit">Visit</option>
                    <option value="Cancelled" >Cancelled</option>
                  </select>
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid"> 
                  <!--      <label class="desired">expired date visa</label>-->
                  

                  <input required="" type="text" style="background-color: transparent;" class="form-control requirments calendar" name="visa_expire_date" placeholder="expired date visa" onfocus="(this.type='date')" />
               
             
             
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <div class="row">
                    <div class="col-sm-6  stepotw">
                      <div class="linksing textcand-1">
                        <p  id="Points"></p>
                        <span>earn points <i class="fas fa-trophy"></i><br>
                        with each step</span> </div>
                    </div>
                    <div class="col-sm-3  stepotw"> <a href="#" id="step-1-back" class="largeredbtn back"> back</a> </div>
                    <div class="col-sm-3  stepotw"> <a href="#" id="step-2-next" class="largeredbtn">Next </a> </div>
                  </div>
                  <!--row--> 
                  
                </div>
              </div>
              <!--row--> 
              
            </div>
            <!--leftinput--> 
            
          </div>
          <!--row--> 
          
        </div>
        <!--tab-pane-->
        </div>
        <div role="tabpanel" class="tab-pane nonebac" id="step-3">
          <div class="headtop nonbord borderbox">
            <div class="stapson active"><span>2</span>
              <h4 class="personalinfo">your profile</h4>
            </div>
            <div class="rightcealr"> <span class="active"></span> <span class="active"></span> <span></span> <span></span><button type="button" style="float: right;padding: 5px 10px;background: #444551;color: #fff;border-radius: 5px; border: 0 solid;margin-left: 10px;" class="clear_all">clear all</button> </div>
          </div>
          <!--borderbox-->
          
          <div class="row">
            <div class="col-sm-12 airports witpostslid">
              <select class="form-control chosen-select types" data-placeholder="Choose a Language..." name="language_ids[]" id="language_id" multiple="multiple" required="" style="width: 100%;" onblur="processForm(this.form)">
               
                @foreach(\App\Language::all() as $lang)
                  <option value="{{$lang->id}}">{{$lang->name}}</option>
                @endforeach
              </select>
            </div>
            <!--witpostslid-->
           
            <div class="col-sm-12 airports witpostslid" style="padding-bottom: 13px;padding-top: 13px:width:100%">
              <select class="form-control requirments" id="eductional_level" name="eductional_level" required="" style="width: 90%;" onblur="processForm(this.form)">
               <option selected="">Eduction</option>
                <option >High school</option>
                <option >Undergraduate </option>
                <option >University Graduate </option>
                <option >Masters</option>
              </select>
            </div>
           
            <!--witpostslid-->
            
          
            <!--witpostslid-->
            
            <div class="col-sm-12 airports witpostslid">
              <select class="form-control chosen-select types" data-placeholder="Choose a Skill.." name="skill_ids[]" id="skill_ids" multiple="multiple" required="" style="width: 90%;" onblur="processForm(this.form)">
            
                @foreach(\App\Skills::all() as $skill)
                  <option value="{{$skill->id}}">{{$skill->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="col-sm-12 airports witpostslid">
              <input type="text" class="form-control requirments" placeholder="other skills">
            </div>

            <!--witpostslid-->
            
            <div class="col-sm-12 airports witpostslid">

            <textarea class="form-control requirments"  name="descripe_yourself" placeholder="describe your self in one sentence" onblur="processForm(this.form)"></textarea>
              
            </div>
            <!--witpostslid-->
            
            <div class="col-sm-12 airports witpostslid">
              <div class="row">
                <div class="col-sm-6  stepotw">
                  <div class="linksing textcand-1">
                    <p id="Points2"></p>
                    <span>earn points <i class="fas fa-trophy"></i><br>
                    with each step</span> </div>
                </div>
                <div class="col-sm-3  stepotw"> <a href="#" id="step-2-back" class="largeredbtn back"> back</a> </div>
                <div class="col-sm-3 stepotw"> <a href="#" id="step-3-next" class="largeredbtn">Next </a> </div>
              </div>
              <!--row--> 
              
            </div>
          </div>
          <!--row--> 
          
        </div>
        
        <!--tab-pane-->
        
        <div role="tabpanel" class="tab-pane nonebac" id="step-4">
          <div class="headtop nonbord borderbox">
            <div class="stapson active"><span>3</span>
              <h4 class="personalinfo">job expectations</h4>
            </div>
            <div class="rightcealr"> <span class="active"></span> <span class="active"></span> <span class="active"></span> <span></span><button type="button" style="float: right;padding: 5px 10px;background: #444551;color: #fff;border-radius: 5px; border: 0 solid;margin-left: 10px;" class="clear_all">clear all</button> </div>
          </div>
          <!--borderbox-->
          
          <div class="divwits">
            <label class="desired looking">actively looking for a job</label>
            <div class="row">
              
              <label class="col-sm-3 airports cololabox">
                <input type="radio" value="1" name="looking_for_job" onblur="processForm(this.form)" checked>
                <span class="label-text" >yes</span> </label>
              <label class="col-sm-3 airports cololabox">
                <input type="radio" value="0" name="looking_for_job" onblur="processForm(this.form)">
                <span class="label-text">no</span> </label>
            </div>
            <!--row--> 
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <select class="form-control requirments" name="job_id" id="job_id" required="" style="width: 90%;" onblur="processForm(this.form)">
              <option selected="" disabled="disabled">desired job</option>
                @foreach(\App\Job::all() as $job)
                  <option value="{{$job->id}}">{{$job->name}}</option>
                @endforeach
            </select>
          </div>
          <!--divwits-->
          <div class="divwits">
          <label style="color:white;">Salary</label>
                    <input type="number"   name="salary" class="form-control requirments" placeholder="from " onblur="processForm(this.form)">
                 
                    <input type="number"     name="MaxSalary" class="form-control requirments" placeholder="to" onblur="processForm(this.form)">
                  
                  </div>
          <!--divwits-->
          
          <div class="divwits">
            <select class="form-control requirments" id="currency_id" name="currency_id" required="" style="width: 90%;" onblur="processForm(this.form)">
              <option selected=""> currency</option>
                  @foreach(\App\Currency::all() as $currency)
                    <option value="{{$currency->id}}">{{$currency->name}}</option>
                  @endforeach
                </select>
        
          </div>
          <!--divwits-->
          <div class="divwits" style="margin-bottom: 15px;">
            <select class="form-control requirments" id="prefered_location_id" name="prefered_location_id" required="" style="width: 90%;" onblur="processForm(this.form)">
              <option selected="">where do you wish to work at ?</option>
                  @foreach(\App\Country::all() as $country)
                    <option value="{{$country->id}}">{{$country->name}}</option>
                  @endforeach
                </select>
          
          </div>
          <!--divwits-->
          
          <div class="divwits" style="margin-bottom: 15px;">
            <select class="form-control chosen-select types" name="prefered_location_ids[]" multiple="multiple" data-placeholder="you can select multicountries you wish to work at" required="" style="width: 90%;" onblur="processForm(this.form)">
              
               
                    @foreach(\App\Country::all() as $country)
                      <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                  </select>
           
          </div>
          <!--divwits-->
          
        
          <!--divwits-->
          
          <div class="divwits">
            <select class="form-control requirments" name="keywords[]" required="" onblur="processForm(this.form)">
              <option selected="" style="width: 90%;" > keywords</option>
              <option value="4" > type of position</option>
            </select>
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <div class="row">
              <div class="col-sm-6  stepotw">
                <div class="linksing textcand-1">
                  <p id="Points3"></p>
                  <span>earn points <i class="fas fa-trophy"></i><br>
                  with each step</span> </div>
              </div>
              <div class="col-sm-3  stepotw"> <a href="#" id="step-3-back" class="largeredbtn back"> back</a> </div>
              <div class="col-sm-3  stepotw"> <a href="#" id="step-4-next" class="largeredbtn">Next </a> </div>
            </div>
            <!--row--> 
            
          </div>
          <!--divwits--> 
          
        </div>
        <!--tab-pane-->
        
        <div role="tabpanel" class="tab-pane nonebac" id="step-5">
          <div class="headtop nonbord borderbox">
            <div class="stapson active"><span>4</span>
              <h4 class="personalinfo">Experience</h4>
            </div>
            <div class="rightcealr"> <span class="active"></span> <span class="active"></span> <span class="active"></span> <span class="active"></span><button type="button" style="float: right;padding: 5px 10px;background: #444551;color: #fff;border-radius: 5px; border: 0 solid;margin-left: 10px;" class="clear_all">clear all</button> </div>
          </div>
          <!--borderbox-->
          
          <div class="divwits">
            <div class="row">
             
              <div class="col-sm-6 binputs">
              <input required="" type="text" style="background-color: transparent;" class="form-control requirments calendar" name="start_date" placeholder="from" onfocus="(this.type='date')"/>
 
               
              </div>
            
                <div class="col-sm-6 binputs">
              <input required="" type="text" style="background-color: transparent;" class="form-control requirments calendar" name="end_date" placeholder="to" onfocus="(this.type='date')"/>
 
             
             
              </div>



            </div>
            <!--row--> 
          </div>
          <!--divwits-->
          
       
          <!--divwits-->
          
          <div class="divwits">
            <input type="text" class="form-control requirments" name="company_name" placeholder="   company/family name" onblur="processForm(this.form)">
          </div>
          <!--divwits-->
          
          <div class="divwits">
           <select class="form-control requirments" id="work_country_id" name="work_country_id" required="" style="width: 90%;" onblur="processForm(this.form)">
             
              <option selected=""> Countries</option>
                    @foreach(\App\Country::all() as $country)
                      <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                  </select>
         
          </div>

             <div class="divwits">
          <select class="form-control requirments" name="employer_nationality_id" id="emp_nation_id" required="" style="width: 90%;" onblur="processForm(this.form)">
              <option selected=""  disabled="disabled">Employer Nationality</option>
                  @foreach(\App\Nationality::all() as $nation)
                    <option value="{{$nation->id}}">{{$nation->name}}</option>
                  @endforeach
                </select>
      
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <input type="text" class="form-control requirments" name="salary" placeholder="salary may be" onblur="processForm(this.form)">
          </div>
          <!--divwits-->
          
          <div class="divwits">
          <textarea class="form-control requirments" name="role" placeholder=" what is your tasks in company" onblur="processForm(this.form)"></textarea>
 
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <div class="row">
              <div class="col-sm-6  stepotw">
                <div class="linksing textcand-1">
                  <p id="Points4"></p>
                  <span>earn points <i class="fas fa-trophy"></i><br>
                  with each step</span> </div>
              </div>
              <div class="col-sm-3  stepotw"> <a href="#" id="step-4-back" class="largeredbtn back"> back</a> </div>
              <div class="col-sm-3  stepotw"> <a href="#" id="step-5-next" class="largeredbtn">Next </a> </div>
            </div>
            <!--row--> 
            
          </div>
          <!--divwits--> 
          
        </div>
        
        <!--tab-pane-->
        
        <div role="tabpanel" class="tab-pane nonebac witsteptow" id="step-6">
          <div class="inputbox margmadia nonmegtext nonmerg">
            <h4 class="title-con entea ">Broadcast your talent</h4>
            <h5 class="title-con entea">Introduce yourself through a video,raise your chance of getting hired fast </h5>
          </div>
          <!--nonmegtext-->
          
          <div class="innertabs">
            <div class="row">
              <div class="col-sm-4 prerare"> <i class="iconnamer">1</i>
                <div class="padtext">
                  <h4>prerare it beforehand</h4>
                  <p>Prepare the script first and practice it, try to choose clear background and isolated from the  other sounds</p>
                </div>
                <!--padtext--> 
              </div>
              <!--prerare-->
              
              <div class="col-sm-4 prerare"> <i class="iconnamer">2</i>
                <div class="padtext">
                  <h4>Record the vedio</h4>
                  <p>Record the vedio (don't exceed 2 mins)</p>
                </div>
                <!--padtext--> 
                
              </div>
              <!--prerare-->
              
              <div class="col-sm-4 prerare"> <i class="iconnamer">3</i>
                <div class="padtext">
                  <h4>Double check before upload</h4>
                  <p>Double check the quality before uploading</p>
                </div>
                <!--padtext--> 
                
              </div>
              <!--prerare--> 
              
            </div>
            <!--sendvad--> 
            
          </div>
          <!--row-->
          
          <div class="divwits">
            <div class="row">
              <div class="col-sm-6 clickupload"><input type="file" id="video_file" style="display: none;" name="video_file"> <a href="#" data-toggle="modal" data-target="#myMo" class="file_input largeredbtn" onblur="processForm(this.form)">Upload Video</a> </div>
              <div class="col-sm-6 clickupload"> <a href="#" data-toggle="modal" data-target="#record_video" class="largeredbtn" onblur="processForm(this.form)">Record Video</a> </div>
            </div>
            <!--row--> 
            
          </div>
          <!--divwits--> 
          
          <div class="divwits">
            <div class="row">
              <div class="col-sm-8  stepotw">
                <div class="linksing textcand-1">
                  <p id="Points5"></p>
                  <span>earn points <i class="fas fa-trophy"></i><br>
                  with each step</span> </div>
              </div>
              <div class="col-sm-2  stepotw"> <a href="#" id="step-5-back" class="largeredbtn back"> back</a> </div>
              <div class="col-sm-2  stepotw"> <a href="#" id="step-6-next" class="largeredbtn">finish </a> </div>
            </div>
            <!--row--> 
            
          </div>
          <!--witpostslid--> 
          
        </div>
        <!--tab-pane-->
        
        <div role="tabpanel" class="tab-pane nonebac" id="step-7">
          <div class="inputbox margmadia nonmegtext nonmerg">
            <h4 class="title-con entea ">almost done !</h4>
            <h5 class="title-con entea">reveiw your application</h5>
          </div>
          <!--nonmegtext-->
          
          <div class="row">
            <div class="col-sm-8 sendvad">
              <div class="innertabs">
                <div class="divwits">
                  <label class="airports cololabox personal-in">
                    <input type="checkbox" name="checkbox">
                    <span class="label-text">personal information</span> </label>
                </div>
                <!--divwits-->
                
                <div class="divwits">
                  <label class="airports cololabox personal-in">
                    <input type="checkbox" name="checkbox">
                    <span class="label-text"> job expectations</span> </label>
                </div>
                <!--divwits-->
                
                <div class="divwits">
                  <label class="airports cololabox personal-in">
                    <input type="checkbox" name="checkbox">
                    <span class="label-text"> work  expectations</span> </label>
                </div>
                <!--divwits-->
                
                <div class="divwits">
                  <label class="airports cololabox personal-in">
                    <input type="checkbox" name="checkbox">
                    <span class="label-text"> upload / record video</span> </label>
                </div>
                <!--divwits-->
                
                <div class="divwits">
                  <label class="airports cololabox personal-in">
                    <input type="checkbox" value="true" name="agreeBox">
                    <span class="label-text"> iagree with the <a href="#" class="termsagreements">terms & agreements</a></span> </label>
                </div>
                <!--divwits--> 
                
              </div>
              <!--innertabs--> 
              
            </div>
            <!--sendvad-->
            
            <div class="col-sm-4 sendvad imgwith"> <img src="/images/sendvad.png">
              <button type="submit" data-toggle="modal" data-target="#myModa3"  class="largeredbtn"> send</button>
            </div>
            <!--sendvad--> 
            
          </div>
          <!--row--> 
          
        </div>
        
        <!--tab-pane--> 
        
      </div>
      
      <!--tab-content-->
      
    </form>
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
 <iframe width="560" height="315" src="https://www.youtube.com/embed/Hp_HySkpTa8" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
      </div>
      <!--textbox--> 
      
    </div>
  </div>
</div>
<!--myModal-->
<div id="myModalcongratulation" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> Uploading you voide 
       
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
<!--myModa2-->
{!! JsValidator::formRequest('App\Http\Requests\FullCanRegisterFormRequest', '.formlogin'); !!}

<!--myModa3-->

@endsection
@section('scripts')
<script type="text/javascript" src="/vendor/jsvalidation/js/jsvalidation.js"></script>
<script src="/dist/jquery.validate.js"></script>
<script>
  $('.clear_all').on('click',function(){
    document.getElementById('full_cand_reg').reset();
  });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
  $('.file_input').on('click',function(){
    $('#video_file').click();
  });
</script>

<script type="text/javascript">
    $(document).ready(function(){

   $("#step-1-next").click(function(){

 var form = $("#full_cand_reg");
 console.log(form.valid());
    if (form.valid() == true){
      current_fs = $('#step-1');
      next_fs = $('#step-2');
      next_fs.show(); 
      current_fs.hide();
    }
  });
 $('#step-1-back').click(function(){
            current_fs = $('#step-2');
            next_fs = $('#step-1');
            next_fs.show(); 
            current_fs.hide();
        });
  $("#step-2-next").click(function(){

 var form = $("#full_cand_reg");
 console.log(form.valid());
    if (form.valid() == true){
      current_fs = $('#step-2');
      next_fs = $('#step-3');
      next_fs.show(); 
      current_fs.hide();
    }
  });
 
       

         $('#step-2-back').click(function(){
            current_fs = $('#step-3');
            next_fs = $('#step-2');
            next_fs.show(); 
            current_fs.hide();
        });

           $("#step-3-next").click(function(){

 var form = $("#full_cand_reg");
 console.log(form.valid());
    if (form.valid() == true){
      current_fs = $('#step-3');
      next_fs = $('#step-4');
      next_fs.show(); 
      current_fs.hide();
    }
  });
 
       

         $('#step-3-back').click(function(){
            current_fs = $('#step-4');
            next_fs = $('#step-3');
            next_fs.show(); 
            current_fs.hide();
        });
    

               $("#step-4-next").click(function(){

 var form = $("#full_cand_reg");
 console.log(form.valid());
    if (form.valid() == true){
      current_fs = $('#step-4');
      next_fs = $('#step-5');
      next_fs.show(); 
      current_fs.hide();
    }
  });
 
       

         $('#step-4-back').click(function(){
            current_fs = $('#step-5');
            next_fs = $('#step-4');
            next_fs.show(); 
            current_fs.hide();
        });


                       $("#step-5-next").click(function(){

 var form = $("#full_cand_reg");
 console.log(form.valid());
    if (form.valid() == true){
      current_fs = $('#step-5');
      next_fs = $('#step-6');
      next_fs.show(); 
      current_fs.hide();
    }
  });
 
       

         $('#step-5-back').click(function(){
            current_fs = $('#step-6');
            next_fs = $('#step-5');
            next_fs.show(); 
            current_fs.hide();
        });

                            $("#step-6-next").click(function(){

 var form = $("#full_cand_reg");
 console.log(form.valid());
    if (form.valid() == true){
      current_fs = $('#step-6');
      next_fs = $('#step-7');
      next_fs.show(); 
      current_fs.hide();
    }
  });
 
    });
</script>

    <script>

$(document).ready(function () {
       $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      
  $('#job_id').select2();
  $('#industry_id').select2();
  $('#country_id').select2();
  $('#emp_nation_id').select2();
  $('#nation_id').select2();
  $('#religion_id').select2();
  $("#gender").select2({
  });
  $("#currency_id").select2({
  });
  $("#work_country_id").select2({
  });
  
  $("#prefered_location_id").select2({
  });
$("#martial_status").select2({
});
$("#visa_type").select2({
});
$("#eductional_level").select2({
});



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





 });

function processForm(form) {
  
  document.getElementById("Points").innerHTML=0;
  document.getElementById("Points2").innerHTML=0;
  document.getElementById("Points3").innerHTML=0;
  document.getElementById("Points4").innerHTML=0;
 //document.getElementById("Points5").innerHTML=0;
  var control, controls = form.elements;
  for (var i=0, iLen=controls.length; i<iLen; i++) {
    control = controls[i];
 
if(control.value !="" && control.value !=0)
{
if(control.name=="logo" || control.name=="cv_path" )
{
  document.getElementById("Points").innerHTML = 10+parseInt(document.getElementById("Points").innerHTML);
  document.getElementById("Points2").innerHTML = 10+parseInt(document.getElementById("Points").innerHTML);
  document.getElementById("Points3").innerHTML = 10+parseInt(document.getElementById("Points").innerHTML);
  document.getElementById("Points4").innerHTML = 10+parseInt(document.getElementById("Points").innerHTML);
  document.getElementById("Points5").innerHTML = 30+parseInt(document.getElementById("Points").innerHTML);
}
else
{

  document.getElementById("Points").innerHTML = 5+parseInt(document.getElementById("Points").innerHTML);
  document.getElementById("Points2").innerHTML = 5+parseInt(document.getElementById("Points").innerHTML);
  document.getElementById("Points3").innerHTML = 5+parseInt(document.getElementById("Points").innerHTML);
  document.getElementById("Points4").innerHTML = 5+parseInt(document.getElementById("Points").innerHTML);
 document.getElementById("Points5").innerHTML = 30+parseInt(document.getElementById("Points").innerHTML);
}

 }   // Do something with the control
   // console.log(control.name + ': ' + control.value);
  }
}

</script>
@endsection