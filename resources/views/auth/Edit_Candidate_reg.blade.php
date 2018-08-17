@extends('Layout.app')
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
    
    <form  action="{{ url('/update_register/candidate/').'/'.$data->id }}" method="post" id="full_cand_reg" class="formlogin mergform"  novalidate enctype="multipart/form-data">
            {{csrf_field()}}
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane  nonebac active" id="step-1">
        
          <!--nonmegtext-->
          
          <div class="innertabs">
            <div class="row">
              <div class="col-sm-6 instructionsleft">
             
                <div class="witboots"> <a href="#" data-toggle="modal" data-target="#myModal" class="largeredbtn "> Here you can Edit your profile .</a> </div>
                <!--botrg-->
                
           
                <a href="#" id="step-1-next" class="largeredbtn"> go <i class="fas fa-long-arrow-alt-right"></i></a> </div>
              <!--instructionsleft-->
              
            
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
                  <input type="text" class="form-control requirments" value="{{$data->user->name}}" id="first_name"  name="first_name" placeholder="full name" onblur="processForm(this.form)">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <input type="text" value="{{$data->last_name}}" class="form-control requirments" name="last_name" placeholder="last name" onblur="processForm(this.form)">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                <select class="form-control requirments" name="nationality_id" id="nation_id" required="" style="width: 90%;"  onblur="processForm(this.form)">
                  <option selected="" >Nationality</option>
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
                  <input type="text" value="{{$data->phone_number}}" class="form-control requirments" name="phone_number" placeholder=" phone no" onblur="processForm(this.form)">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <input type="email" value="{{$data->user->email}}" class="form-control requirments" name="email" placeholder="email" onblur="processForm(this.form)">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <input type="password" value="{{$data->user->password}}" class="form-control requirments" name="password"  placeholder="password" onblur="processForm(this.form)">
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid" style"width:100%">
                
                  <select value="{{$data->gender}}" class="form-control requirments" name="gender" id="gender" required="" style="width: 90%;" onblur="processForm(this.form)">
                    <option selected="" style="width: 90%;"> gender</option>
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
                    <option selected="" > marital status</option>

                    
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
<input required="" type="text" style="background-color: transparent;" 
class="form-control requirments calendar" name="birthdate"  value="{{$data->birthdate}}" placeholder="birth date" onfocus="(this.type='date')" />
                             
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <div class="input-group input-file" value="{{$data->user->logo}}" name="logo">
                    <input type="text" class="form-control requirments"  placeholder='image...'  />
                    <span class="input-group-btn">
                    <button class="btn btn-default btn-choose largeredbtn brows" type="button" onblur="processForm(this.form)">brows</button>
                    </span> </div>
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <div class="input-group input-file" name="cv_path" value="{{$data->cv_path}}">
                    <input type="text" class="form-control requirments"  placeholder='cv...' onblur="processForm(this.form)" /> 
                    <span class="input-group-btn">
                    <button class="btn btn-default btn-choose largeredbtn brows" type="button" onblur="processForm(this.form)">upload</button>
                    </span> </div>
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid">
                  <select class="form-control requirments" id="visa_type"  name="visa_type" required="" style="width: 90%;" onblur="processForm(this.form)">
                     <option selected=""> Emploer-type of visa</option>
                    <option  value="None" >None</option>
                    <option  value="Employed" >Employed</option>
                    <option value="Visit">Visit</option>
                    <option value="Cancelled" >Cancelled</option>
                  </select>
                </div>
                <!--witpostslid-->
                
                <div class="col-sm-12 airports witpostslid"> 
                  <!--      <label class="desired">expired date visa</label>-->
                  

                  <input required="" type="text" style="background-color: transparent;" 
                  class="form-control requirments calendar" name="visa_expire_date" 
                  placeholder="expired date visa" value="{{$data->visa_expire_date}}" onfocus="(this.type='date')" />
               
             
             
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
              <select class="form-control chosen-select types" name="language_ids[]" id="language_id" multiple="multiple" required="" style="width: 90%;" onblur="processForm(this.form)">
                <option value="" disabled selected>Choose your languages</option>
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
              <select class="form-control chosen-select types" name="skill_ids[]" id="skill_ids" multiple="multiple" required="" style="width: 90%;" onblur="processForm(this.form)">
              <option value="" disabled selected>Choose your Skills</option>
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

            <textarea class="form-control requirments"  name="descripe_yourself" 
            placeholder="describe your self in one sentence" value="{{$data->descripe_yourself}}" onblur="processForm(this.form)"></textarea>
              
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
                <input type="radio" value="1" name="looking_for_job" onblur="processForm(this.form)">
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
          <label>Salary</label>
                    <input type="number"  value="{{$data->salary}}"   name="salary" class="form-control requirments" placeholder="from " onblur="processForm(this.form)">
                 
                    <input type="number"  value="{{$data->MaxSalary}}"   name="MaxSalary" class="form-control requirments" placeholder="to" onblur="processForm(this.form)">
                  
                  </div>
          <!--divwits-->
          
          <div class="divwits">
            <select class="form-control requirments" id="currency_id" name="currency_id" required="" style="width: 90%;" onblur="processForm(this.form)">
              <option selected=""> currency</option>
                  @foreach(\App\Currency::all() as $currency)
                    <option value="{{$currency->id}}">{{$currency->name}}</option>
                  @endforeach
                </select>
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
            </select>
          </div>
          <!--divwits-->
          
          <div class="divwits" style="margin-bottom: 15px;">
            <select class="form-control chosen-select types" name="prefered_location_ids[]" multiple="multiple" required="" style="width: 90%;" onblur="processForm(this.form)">
              
                <option value="" disabled selected>you can select multicountries you wish to work at</option>
                    @foreach(\App\Country::all() as $country)
                      <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                  </select>
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
              <input required="" type="text" style="background-color: transparent;" 
              class="form-control requirments calendar" name="start_date"
               placeholder="from" value="{{$data->start_date}}"  onfocus="(this.type='date')"/>
 
               
              </div>
            
                <div class="col-sm-6 binputs">
              <input required="" type="text" style="background-color: transparent;" 
              class="form-control requirments calendar" name="end_date" 
              placeholder="to" value="{{$data->end_date}}"  onfocus="(this.type='date')"/>
 
             
             
              </div>



            </div>
            <!--row--> 
          </div>
          <!--divwits-->
          
       
          <!--divwits-->
          
          <div class="divwits">
            <input type="text" class="form-control requirments" 
            name="company_name"  value="{{$data->company_name}}" placeholder="   company/family name" onblur="processForm(this.form)">
          </div>
          <!--divwits-->
          
          <div class="divwits">
           <select class="form-control requirments" id="work_country_id" name="work_country_id" required="" style="width: 90%;" onblur="processForm(this.form)">
             
              <option selected=""> Countries</option>
                    @foreach(\App\Country::all() as $country)
                      <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                  </select>
            </select>
          </div>

             <div class="divwits">
          <select class="form-control requirments" name="employer_nationality_id" id="emp_nation_id" required="" style="width: 90%;" onblur="processForm(this.form)">
              <option selected="">Employer Nationality</option>
                  @foreach(\App\Nationality::all() as $nation)
                    <option value="{{$nation->id}}">{{$nation->name}}</option>
                  @endforeach
                </select>
            </select>
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <input type="text" class="form-control requirments" name="salary"
            value="{{$data->salary}}"  placeholder="salary may be" onblur="processForm(this.form)">
          </div>
          <!--divwits-->
          
          <div class="divwits">
          <textarea class="form-control requirments" name="role" 
          placeholder=" what is your tasks in company"    value="{{$data->role}}" onblur="processForm(this.form)"></textarea>
 
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <div class="row">
              <div class="col-sm-6  stepotw">
               
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
              <div class="col-sm-6 clickupload"> <a href="#" data-toggle="modal" data-target="#myModa2" class="largeredbtn" onblur="processForm(this.form)">Record Video</a> </div>
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
 <iframe width="560" height="315" src="https://www.youtube.com/embed/whMCdOkI2CU" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
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
        <button type="button" class="close" data-dismiss="modal">X</button>
      </div>
      <div class="textbox">
        <form action="#" method="" class="formlogin video-rc" id="MyFormInput">
         
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
// function default_value($m)
// {
//  //var N=document.getElementById($m).innerHTML;
//  var check = $("#"+$m).val();

//     if(check !="")
//     {
//       alert("dddd");
//       document.getElementById("Points").innerHTML = 5+parseInt(document.getElementById("Points").innerHTML);
//     }
    
 

// }
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