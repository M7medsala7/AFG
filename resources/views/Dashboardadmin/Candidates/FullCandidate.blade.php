@extends('Layout.app')

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
  .select2 select2-container select2-container 
  {
width:300px;
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
  .select2 select2-container select2-container--default
  {
    width: 300px;
  }
  .select2 select2-container select2-container--default select2-container--below
  {
    width:300px;
  }
</style>
@section('content')
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
    
    <form  action="/fregcand" method="post" id="full_cand_reg" class="formlogin mergform" enctype="multipart/form-data">
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
          <!--innertabs--> 
          
        </div>
        <!--tab-pane-->
        
        <div role="tabpanel" class="tab-pane nonebac witsteptow" id="step-2">
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
                  <input type="text" class="form-control requirments" name="first_name" placeholder="full name">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <input type="text" class="form-control requirments" name="last_name" placeholder="last name">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                <select class="form-control requirments" name="nationality_id" id="nation_id" required="" style="width: 90%;" >
                  <option selected="" >Nationality</option>
                  @foreach(\App\Nationality::all() as $nation)
                    <option value="{{$nation->id}}">{{$nation->name}}</option>
                  @endforeach
                </select>
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <select class="form-control requirments" name="country_id" id="country_id" required="" style="width: 90%;">
                    <option selected=""> Countries</option>
                    @foreach(\App\Country::all() as $country)
                      <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                  </select>
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <input type="text" class="form-control requirments" name="phone_number" placeholder=" phone no">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <input type="email" class="form-control requirments" name="email" placeholder="email">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <input type="password" class="form-control requirments" name="password"  placeholder="password">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <select class="form-control requirments" name="gender" required="">
                    <option selected="" style="width: 90%;"> gender</option>
                    <option value="0">Male</option>
                    <option value="1">female</option>
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
                  <select class="form-control requirments" name="martial_status" required="" style="width: 90%;">
                    <option selected=""> marital status</option>
                    <option value="single">single</option>
                    <option value="married">married</option>
                    <option value="devorced">devorced</option>
                  </select>
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                <select class="form-control requirments" id="religion_id" name="religion_id" required="" style="width: 90%;">
                  <option selected=""> Religion</option>
                    @foreach(\App\Religion::all() as $religion)
                      <option value="{{$religion->id}}">{{$religion->name}}</option>
                    @endforeach
                </select>
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid"> 
                  
                  <!--             <label class="desired">birth date</label>
-->
                  <input type="date" class="form-control requirments calendar" name="birthdate"  placeholder="birth date">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <div class="input-group input-file" name="logo">
                    <input type="text" class="form-control requirments"  placeholder='image...' />
                    <span class="input-group-btn">
                    <button class="btn btn-default btn-choose largeredbtn brows" type="button">brows</button>
                    </span> </div>
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <div class="input-group input-file" name="cv_path">
                    <input type="text" class="form-control requirments"  placeholder='cv...' />
                    <span class="input-group-btn">
                    <button class="btn btn-default btn-choose largeredbtn brows" type="button">upload</button>
                    </span> </div>
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <select class="form-control requirments" name="visa_type" required="" style="width: 90%;">
                    <option selected=""> Emploer-type of visa</option>
                    
                    <option  value="Employed">Employed</option>
                    <option value="Visit">Visit</option>
                    <option value="Cancelled">Cancelled</option>
                  </select>
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid"> 
                  <!--      <label class="desired">expired date visa</label>-->
                  
                  <input type="date" class="form-control requirments calendar" name="visa_expire_date" placeholder="expired date visa">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <div class="row">
                    <div class="col-sm-6  stepotw">
                      <div class="linksing textcand-1">
                        <p>10</p>
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
              <select class="form-control requirments" name="language_ids[]" id="language_id" multiple="multiple" required="" style="width: 90%;">
                <option selected=""> languages</option>
                @foreach(\App\Language::all() as $lang)
                  <option value="{{$lang->id}}">{{$lang->name}}</option>
                @endforeach
              </select>
            </div>
            <!--witpostslid-->
            
            <div class="col-sm-12 airports witpostslid">
              <select class="form-control requirments" name="eductional_level" required="" style="width: 90%;">
                <option selected=""> eduction level</option>
                <option value="4">eduction level</option>
                <option value="4">eduction level</option>
              </select>
            </div>
            <!--witpostslid-->
            
            <div class="col-sm-12 airports witpostslid">
              <input type="text" class="form-control requirments" placeholder="note:other">
            </div>
            <!--witpostslid-->
            
            <div class="col-sm-12 airports witpostslid">    
              <select class="form-control chosen-select " name="skill_ids[]" id="skill_ids" multiple="multiple" required="" style="width: 90%;">
                <option selected=""> skills</option>
                @foreach(\App\Skills::all() as $skill)
                  <option value="{{$skill->id}}">{{$skill->name}}</option>
                @endforeach
              </select>
            </div>
            <!--witpostslid-->
            
            <div class="col-sm-12 airports witpostslid">
              <input type="text" class="form-control requirments" name="descripe_yourself" placeholder="describe your self in one sentence">
            </div>
            <!--witpostslid-->
            
            <div class="col-sm-12 airports witpostslid">
              <div class="row">
                <div class="col-sm-6  stepotw">
                  <div class="linksing textcand-1">
                    <p>20</p>
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
                <input type="radio" value="1" name="looking_for_job">
                <span class="label-text">yes</span> </label>
              <label class="col-sm-3 airports cololabox">
                <input type="radio" value="0" name="looking_for_job">
                <span class="label-text">no</span> </label>
            </div>
            <!--row--> 
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <select class="form-control requirments" name="job_id" id="job_id" required="" style="width: 90%;">
              <option selected="" disabled="disabled">desired job</option>
                @foreach(\App\Job::all() as $job)
                  <option value="{{$job->id}}">{{$job->name}}</option>
                @endforeach
            </select>
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <input type="number" class="form-control requirments" name="min_salary" placeholder="what is your minimum salary?">
          </div>
          <!--divwits-->
          
          
          <div class="divwits">
            <select class="form-control requirments" name="prefered_location_id" required="" style="width: 90%;">
              <option selected=""> preferred locations top work at</option>
              <option selected=""> Countries</option>
                  @foreach(\App\Country::all() as $country)
                    <option value="{{$country->id}}">{{$country->name}}</option>
                  @endforeach
                </select>
            </select>
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <select class="form-control requirments" name="prefered_location_ids[]" multiple="multiple" required="" style="width: 90%;">
              <option selected=""> preferred locations top work at</option>
              <option selected=""> Countries</option>
                    @foreach(\App\Country::all() as $country)
                      <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                  </select>
            </select>
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <input type="text" disabled="disabled" class="form-control requirments" placeholder=" uou can select mulicountries you wish to work at">
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <select class="form-control requirments" name="keywords[]" required="">
              <option selected="" style="width: 90%;"> keywords</option>
              <option value="4"> type of position</option>
            </select>
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <div class="row">
              <div class="col-sm-6  stepotw">
                <div class="linksing textcand-1">
                  <p>30</p>
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
                <input type="text" class="form-control requirments" name="working_in" placeholder="wrking in">
              </div>
              <div class="col-sm-3 binputs">
                <input type="date" class="form-control requirments" name="start_date" placeholder="from">
              </div>
              <div class="col-sm-3 binputs">
                <input type="date" class="form-control requirments" name="end_date" placeholder="to">
              </div>
            </div>
            <!--row--> 
          </div>
          <!--divwits-->
          
          <div class="divwits">
          <select class="form-control requirments" name="employer_nationality_id" id="emp_nation_id" required="" style="width: 90%;">
              <option selected=""> Nationality</option>
                  @foreach(\App\Nationality::all() as $nation)
                    <option value="{{$nation->id}}">{{$nation->name}}</option>
                  @endforeach
                </select>
            </select>
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <input type="text" class="form-control requirments" name="company_name" placeholder="   company name">
          </div>
          <!--divwits-->
          
          <div class="divwits">
           <select class="form-control requirments" name="work_country_id" required="">
              <option selected="" style="width: 90%;"> preferred locations top work at</option>
              <option selected=""> Countries</option>
                    @foreach(\App\Country::all() as $country)
                      <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                  </select>
            </select>
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <input type="text" class="form-control requirments" name="salary" placeholder="slary may be">
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <input type="text" class="form-control requirments" name="role" placeholder=" what is your tasks in company">
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <div class="row">
              <div class="col-sm-6  stepotw">
                <div class="linksing textcand-1">
                  <p>40</p>
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
            <h4 class="title-con entea ">broadcst your talent</h4>
            <h5 class="title-con entea">upload/record video gallary of your work</h5>
          </div>
          <!--nonmegtext-->
          
          <div class="innertabs">
            <div class="row">
              <div class="col-sm-4 prerare"> <i class="iconnamer">1</i>
                <div class="padtext">
                  <h4>prerare it beforehand</h4>
                  <p>prerare it beforehand prerare it beforehand prerare it beforehand</p>
                </div>
                <!--padtext--> 
              </div>
              <!--prerare-->
              
              <div class="col-sm-4 prerare"> <i class="iconnamer">2</i>
                <div class="padtext">
                  <h4>record the vedio</h4>
                  <p>prerare it beforehand prerare it beforehand prerare it beforehand</p>
                </div>
                <!--padtext--> 
                
              </div>
              <!--prerare-->
              
              <div class="col-sm-4 prerare"> <i class="iconnamer">3</i>
                <div class="padtext">
                  <h4>double chech before upload</h4>
                  <p>prerare it beforehand prerare it beforehand prerare it beforehand</p>
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
              <div class="col-sm-6 clickupload"><input type="file" id="video_file" style="display: none;" name="video_file"> <a href="#" data-toggle="modal" data-target="#myMo" class="file_input largeredbtn">click here to upload</a> </div>
              <div class="col-sm-6 clickupload"> <a href="#" data-toggle="modal" data-target="#myModa2" class="largeredbtn">click here to upload</a> </div>
            </div>
            <!--row--> 
            
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <div class="row">
              <div class="col-sm-8  stepotw">
                <div class="linksing textcand-1">
                  <p>50</p>
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
        <iframe  src="https://www.youtube.com/embed/BFrLL5w9UGQ?autoplay=0" frameborder="0" allowfullscreen></iframe>
      </div>
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

<div id="myModa3" class="modal fade">
  <div class="modal-content dal-conte dal-conte2"> <i class="fas fa-check-circle"></i>
    <h2 class="textcandidate">congratulations</h2>
    <p class="viewsdriver"> truck driver congratulations truck driver congratulations truck driver congratulations truck driver congratulations</p>
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
<!--myModa3-->
@endsection
@section('scripts')
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

 $(".types").chosen({ 
                   width: '100%',
                   no_results_text: "No Results",
                   allow_single_deselect: true, 
                   search_contains:true, });
 $(".types").trigger("chosen:updated");

 
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
    $.ajax({
        type: 'POST',
        url: '/StoreVideo',
        data: fd
    }).done(function(data) {
     document.getElementById("Sucessrecord").innerHTML = "Video record Sucessfully";
      
        //console.log('data');
    });





});


 });


</script>
@endsection