<!DOCTYPE html>
@include('Dashboardadmin.layout.header')
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

@include('Dashboardadmin.layout.sidebar')
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{url('/admin/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
      @include('/Dashboardadmin.layout.nav')
        </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <section class="content-header"  style="background-color:; ">
      <h1 class="fa fa-dashboard">
     Add Candidates
      
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('adminpanel')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class=""><a href="{{url('/adminpanel/candidate')}}"> Candidates controlling </a></li>
        
      </ol>
    </section>


      <section class="content" style="background-color:; ">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">

   @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

   <form  role="form" method="POST" action="{{ url('/adminpanel/candidates/update/').'/'.$data->id }}" enctype="multipart/form-data">

                     {{csrf_field()}}





           
<table  id="customers">
<tr>

                        <td style="width:50%;">
                           
                          
                            <div class="divwits" >
                                  <input  type="text" name="first_name" 
                                  class="form-control" placeholder="first name" type="text" 
                                class="text2{{ $errors->has(' first_name') ? ' is-invalid' : '' }}" 
                                name="  first_name" value="first_name:{{$data->user->name}}"
                                  onblur="processForm(this.form)">
                            </div>
                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                               
                       
                            </td>
                            <td style="width:50%;">
                         
                          
                          <div class="divwits">
                                <input  type="text" name="last_name" 
                                class="form-control" placeholder="last_name" type="text" 
                              class="text2{{ $errors->has(' last_name') ? ' is-invalid' : '' }}" 
                              name="  last_name" value="last_name:{{$data->last_name}}">
                          </div>
                              @if ($errors->has('last_name'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('last_name') }}</strong>
                                  </span>
                              @endif
                             
                     </td>
                     
                        </tr>

                          
                      
                   <tr>
                   <td style="width:50%;">
                            <div class="divwits">
                            <select 
                           
                             class="form-control requirments" name="nationality_id" id="nation_id"  style="width: 90%;" >
                          <option selected="" >Nationality</option>
                              @foreach(\App\Nationality::all() as $nation)
                          <option value="{{$nation->id}}" >{{$nation->name}}</option>
                              @endforeach
                            </select>
                            </div>
                                @if ($errors->has('nationality_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('nationality_id') }}</strong>
                                    </span>
                                @endif
                                </td>
                                <td style="width:50%;">
                      
                            <select  class="form-control "
                          
                            name="country_id" id="country_id">
                            <option selected="" disabled="disabled"> Current Location</option>
                                @foreach(\App\Country::all() as $country)
                          <option value="{{$country->id}}">{{$country->name}}</option>
                               @endforeach
                           
                           </select>
                           
                                @if ($errors->has(' country_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first(' country_id') }}</strong>
                                    </span>
                                @endif
                                </td>
                                </tr>
<tr>                        
                          <td style="width:50%;">
                          
                            <div class="divwits">
                                  <input  type="text" name="phone_number" 
                                  class="form-control" placeholder="phone_number" type="text" 
                                class="text2{{ $errors->has(' phone_number') ? ' is-invalid' : '' }}" 
                                name="  phone_number" value="phone:{{$data->phone_number}}"
                                >
                            </div>
                                @if ($errors->has('phone_number'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                                </td>
                                <td style="width:50%;">
                    
                            <input  type="email" name="email" class="form-control" placeholder="email address" 
                            class="text2{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                            value="E-mail:{{$data->user->email}}"
                           >
                               
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                               
                                </td>
                                </tr>

                      <tr>
                      <td style="width:50%;">
                            <input  value="Password:{{$data->user->password}}"  type="password" name="password" class="form-control" placeholder=" password" 
                            class="text2{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                          
                            onblur="processForm(this.form)">
                               
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                               
                                </td>
                                <td style="width:50%;">
                       
                            <select  class="form-control "
                            value="{{$data->gender}}" 
                            name="gender" id="gender">
                            <option selected="" disabled="disabled"> gender</option>
                            <option value="0">Male</option>
                            <option value="1" >female</option>
                           
                           </select>
                           
                                @if ($errors->has(' gender'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first(' gender') }}</strong>
                                    </span>
                                @endif
                                </td>
                                </tr>

                        <tr>
                        <td style="width:50%;">
                            <select  class="form-control " 
                            value="{{$data->martial_status}}" 
                            name="martial_status" id="martial_status">
                              <option selected="" > marital status</option>

                    
                             <option value="single" >single</option>
                             <option value="married" >married</option>
                             <option value="devorced" >devorced</option>
                           
                           </select>
                           
                                @if ($errors->has(' martial_status'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first(' martial_status') }}</strong>
                                    </span>
                                @endif
                               
                                </td> <td style="width:50%;">
                        
                            <select class="form-control " 
                          
                            name="religion_id" id="religion_id">
                            <option selected=""  > Religion</option>
                              @foreach(\App\Religion::all() as $religion)
                            <option value="{{$religion->id}}" >{{$religion->name}}</option>
                            @endforeach
                           
                           </select>
                           
                                @if ($errors->has(' religion_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first(' religion_id') }}</strong>
                                    </span>
                                @endif
                               
                                </td> </tr>
<tr>
<td style="width:50%;">                       
<div "col-sm-6 binputs"> 
<input  type="text" style="background-color: transparent;" 
 class="form-control requirments calendar" 
 name="birthdate" placeholder="birth date" 
 value="Birthdate:{{$data->birthdate}}"
 onfocus="(this.type='date')" >                           

</div>
</td>


                   

                   
                   <td style="width:50%;">
               
                  <div  class="input-group input-file" name="logo">
                    <input  value="photo:{{$data->user->logo}}" type="text" class="form-control requirments"  placeholder='image...'  />
                    <span class="input-group-btn">
                    <button class="btn btn-default btn-choose largeredbtn brows" type="button" onblur="processForm(this.form)">brows</button>
                    </span> </div>
                 </td>
                </tr>

                   <tr>
                   <td style="width:50%;">
                    <div  class="input-group input-file" name="cv_path">
                    <input  
                    class="text2{{ $errors->has(' cv_path') ? ' is-invalid' : '' }}" 
                                name="  cv_path" value="cv:{{$data->cv_path}}"
                    type="text" class="form-control requirments"  placeholder='cv...' > 
                    <span class="input-group-btn">
                    <button class="btn btn-default btn-choose largeredbtn brows" type="button" >upload</button>
                    </span> </div>
                   
                                @if ($errors->has('cv_path'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('cv_path') }}</strong>
                                    </span>
                                @endif
                               
                                </td>
                                <td style="width:50%;">

                     <select  class="form-control " value="{{$data->visa_type}}" 
                     name="visa_type" id="visa_type">
                    <option selected=""> Emploer-type of visa</option>
                    <option  value="None" >None</option>
                    <option  value="Employed" >Employed</option>
                    <option value="Visit">Visit</option>
                    <option value="Cancelled" >Cancelled</option>
                           
                           </select>
                           
                                @if ($errors->has(' visa_type'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first(' visa_type') }}</strong>
                                    </span>
                                @endif
                               
                                </td> </tr>

                    <tr>
                    <td style="width:50%;">
                          
          
                  <input  type="text" style="background-color: transparent;" 
                  value="visa-date:{{$data->visa_expire_date}}"
                  class="form-control requirments calendar" 
                  name="visa_expire_date" placeholder="expired date visa" 
                  onfocus="(this.type='date')" />
               
             
             
              
                               
                </td>
                <td style="width:50%;">

                            <select class="form-control chosen-select types" 
                            value="{{$data->language_id}}" multiple="multiple"
                            name="language_ids[]" id="language_id"   multiple="multiple" >
                            <option value="" disabled selected>Choose your languages</option>
                             @foreach(\App\Language::all() as $lang)
                           <option value="{{$lang->id}}">{{$lang->name}}</option>
                             @endforeach
                           
                           </select>
                           
                                @if ($errors->has(' language_ids[]'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first(' language_ids[]') }}</strong>
                                    </span>
                                @endif
                                </td> </tr>
                       <tr>
                       <td style="width:50%;">
                            <select   value="{{$data->Eductionlevel}}" class="form-control requirments" id="eductional_level" name="Eductionlevel"  >
                <option selected="">Eduction</option>
                <option >High school</option>
                <option >Undergraduate </option>
                <option >University Graduate </option>
                <option >Masters</option>
                           
                           </select>
                           
                                @if ($errors->has('	Eductionlevel'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('	Eductionlevel') }}</strong>
                                    </span>
                                @endif
                                </td> <td style="width:50%;">
                         
                            <select multiple="multiple"  class="form-control chosen-select types" 
                            name="skill_ids[]" id="skill_ids"    multiple="multiple" >
                            <option value="" disabled selected>Choose your Skills</option>
                             @foreach(\App\Skills::all() as $skill)
                            <option value="{{$skill->id}}">{{$skill->name}}</option>
                             @endforeach
                           
                           </select>
                           
                                @if ($errors->has(' skill_ids[]'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first(' skill_ids[]') }}</strong>
                                    </span>
                                @endif
                               
                                </td> </tr>
                     <tr>
                     <td style="width:50%;">
                          
                                  <input  type="text" 
                                  class="form-control requirments" 
                                 
                                  placeholder="other skills">
                            
                                  </td>
                                  <td style="width:50%;">
                        
                            <textarea  class="form-control requirments" 
                            value="Description:{{$data->descripe_yourself}}" 
                            name="descripe_yourself" 
                            placeholder="describe your self in one sentence"></textarea>
            
                            </td></tr>

                   <tr>
                   <td style="width:50%;">
                            <label class="col-sm-3 airports cololabox">
                <input value="{{$data->looking_for_job}}"  type="radio" value="1" name="looking_for_job" 
                class="text2{{ $errors->has(' looking_for_job') ? ' is-invalid' : '' }}" 
                                name="  looking_for_job" >
                <span class="label-text" >yes</span> </label>
              <label class="col-sm-3 airports cololabox">
                <input value="{{$data->looking_for_job}}" type="radio" value="0" name="looking_for_job" 
                class="text2{{ $errors->has(' looking_for_job') ? ' is-invalid' : '' }}" 
                                name="  looking_for_job" >
                <span class="label-text">no</span> </label>
                                
                        
                                @if ($errors->has('looking_for_job'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('looking_for_job') }}</strong>
                                    </span>
                                @endif
                               
                                </td> <td style="width:50%;">

                            <select  class="form-control requirments" 
                            name="job_id" id="job_id"   >
                            <option selected="" disabled="disabled">desired job</option>
                           @foreach(\App\Job::all() as $job)
                           <option value="{{$job->id}}">{{$job->name}}</option>
                           @endforeach
                           
                           </select>
                           
                                @if ($errors->has(' job_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first(' job_id') }}</strong>
                                    </span>
                                @endif
                                </td> </tr>
                                <tr> <td style="width:50%;">
            <input type="number" 
            value="Min_salary:{{$data->salary}}" 
            class="form-control requirments" name="min_salary" 
            placeholder="what is your Expected salary?" onblur="processForm(this.form)">
            </td>
            <td style="width:50%;">      
                            <select  class="form-control requirments" 
                            name="CurrencyId" id="currency_id"   >
                            <option selected=""> currency</option>
                            @foreach(\App\Currency::all() as $currency)
                           <option value="{{$currency->id}}">{{$currency->name}}</option>
                           @endforeach
                           
                           </select>
                           
                                @if ($errors->has(' CurrencyId'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first(' CurrencyId') }}</strong>
                                    </span>
                                @endif
                                </td>
                                </tr>

                      <tr>
                      <td style="width:50%;">
                            <select  class="form-control requirments" 
                            name="prefered_location_id" id="prefered_location_id"   >
                            <option selected="">where do you wish to work at ?</option>
                             @foreach(\App\Country::all() as $country)
                             <option value="{{$country->id}}">{{$country->name}}</option>
                             @endforeach
                           
                           </select>
                           
                                @if ($errors->has(' prefered_location_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first(' prefered_location_id') }}</strong>
                                    </span>
                                @endif
                                </td> <td style="width:50%;">
         
            <select    multiple="multiple" class="form-control chosen-select types" name="prefered_location_ids[]"  style="width: 90%;" onblur="processForm(this.form)">
              
                <option value="" disabled selected>you can select multicountries you wish to work at</option>
                    @foreach(\App\Country::all() as $country)
                      <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                  </select>
            </select>
            </td> </tr>


     <tr> <td style="width:50%;">
            <select    class="form-control requirments" name="keywords[]"  onblur="processForm(this.form)">
              <option selected="" style="width: 90%;" > keywords</option>
              <option value="4" > type of position</option>
            </select>
           </td>
           <td style="width:50%;">
       
            
           <input  type="text" class="form-control requirments" 
           name="company_name" placeholder="   company/family name" 
           value="Company_name:{{$data->company_name}}" 
           onblur="processForm(this.form)">
    
 </td> </tr>
<tr><td style="width:50%;">
             <input   
             value="Start_date:{{$data->start_date}}"
              type="text" style="background-color: transparent;" 
              class="form-control requirments calendar" 
              name="start_date" placeholder="Experince from" 
              onfocus="(this.type='date')"/>
              </td> 
              <td style="width:50%;"> 
             <input   type="text" 
             value="End_date:{{$data->end_date}}"
             style="background-color: transparent;"
              class="form-control requirments calendar" name="end_date" placeholder="to" onfocus="(this.type='date')"/>
             </td>
             </tr>
          
             

       <tr>
       <td style="width:50%;">
           <select  class="form-control requirments" id="work_country_id" name="work_country_id"  style="width: 90%;" onblur="processForm(this.form)">
             
              <option selected=""> Countries</option>
                    @foreach(\App\Country::all() as $country)
                      <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                  </select>
            </select>
            </td><td style="width:50%;">

          <select    class="form-control requirments" name="employer_nationality_id" id="emp_nation_id" >
              <option selected="">Employer Nationality</option>
                  @foreach(\App\Nationality::all() as $nation)
                    <option value="{{$nation->id}}">{{$nation->name}}</option>
                  @endforeach
                </select>
            </select>
            </td></tr>
            
            <tr>
            <td style="width:50%;">
            <input  
            value="Salary:{{$data->salary}}" 
            type="text" class="form-control requirments" 
            name="salary" placeholder="salary may be" >
            </td><td style="width:50%;">
          <!--divwits-->
     
          <textarea   class="form-control requirments" 
          value="Role:{{$data->role}}" 
          name="role" 
          placeholder=" what is your tasks in company" 
          onblur="processForm(this.form)"></textarea>
 
          </td></tr>
           </table>
           
      
       

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('add') }}
                                </button>
                            </div>
                        </div>
                       
              </form>


            </div>
            </div>
          </div>
         </div>
         </form>
    
 </section>


        
</div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->

<!-- AdminLTE for demo purposes -->
<script src="/admin/cust/sweetalert.js"></script>

<script src="/admin/cust/sweetalert.min.js"></script>
  @include('Dashboardadmin.layout.flashMessage')
  @include('Dashboardadmin.layout.footer')
     </body>
   

</html>

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
      
 
 
  
 
 


 $(".types").chosen({ 
                  
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
 </script>

