@extends('Dashboardadmin.layout.layout')



@section('head')

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
  }
  .select2-container--default .select2-selection--single{    background-color: 0!important;border: 0!important}
</style>
@endsection







@section('content')
      <section class="content-header"  style="background-color:; ">
      <h1 class="fa fa-dashboard">
     Edit PostJob 
      
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('adminpanel')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class=""><a href="{{url('/adminpanel/postjob')}}"> postjob controlling </a></li>
        
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

   <form  role="form" method="POST" action="{{ url('/adminpanel/postjob/update/').'/'.$data->id }}"" enctype="multipart/form-data">

                     {{csrf_field()}}



  <div role="tabpanel" class="tab-pane tabs-inner" id="step-3">
            <div class="divwits">
              <div class="row" style="width:50%;">
                <div class="col-sm-3 airports availability"> company</div>
                <label class="col-sm-3 airports">
                  <input type="radio" value="family" name="job_for" checked="" onblur="processForm(this.form)">
                  <span class="label-text">family</span> </label>
                <label class="col-sm-3 airports">
                  <input type="radio" value="company" name="job_for" onblur="processForm(this.form)">
                  <span class="label-text">company</span> </label>
                <label class="col-sm-3 airports">
                  <input type="radio" value="agency" name="job_for" onblur="processForm(this.form)">
                  <span class="label-text">agency</span> </label>
              </div>
            </div>
            <br>
              
            <div class="divwits" > 
              <!--<label class="desired">company name</label>-->
              <input style="width:50%;"  type="text" name="name" 
              class="form-control requirments" placeholder="company name" onblur="processForm(this.form)">
            </div>
<br>
              <div class="divwits"> 
              <!--<label class="desired"> user name</label>-->
              <input style="width:50%;" 
              type="text" name="name" class="form-control requirments" placeholder="user name" 
>
            </div>
            <!--divwits-->
            <br>
            <div class="divwits"> 
              <!--<label class="desired">phone</label>-->
              <input style="width:50%;" value="Phone:{{$data->phone}}"  type="text" name="phone" class="form-control requirments" placeholder="phone no." onblur="processForm(this.form)">
            </div>
            <!--divwits-->
            <br>
            <div class="divwits"> 
              <!--<label class="desired">email</label>-->
              <input style="width:50%;"  type="text" name="email" class="form-control requirments" placeholder="email" onblur="processForm(this.form)">
            </div>
            <!--divwits-->
            <br>
            <div class="divwits"> 
              <!--<label class="desired">password</label>-->
              <input style="width:50%;" type="password"   name="password" class="form-control requirments" placeholder="password" onblur="processForm(this.form)">
            </div>
<div class="divwits"> 
          <!--<label class="desired">job title </label>-->
          	<select style="width:50%;"  class="form-control requirments" name="job_id" id="job_id" required="required" style="width: 90%;">
          		<option selected="" disabled="disabled">job tilte</option>
            	@foreach(\App\Job::all() as $job)
              	<option value="{{$job->id}}">{{$job->name}}</option>
            	@endforeach
       	   	</select>
        </div>
        <br>

          
       
           
        <div class="divwits"> 
          <!--<label class="desired">industry</label>-->
          	<select style="width:50%;"  class="form-control requirments" name="industry_id" id="industry_id" required="" style="width: 90%;">
	          <option selected="" disabled="disabled">desired industry</option>
	            @foreach(\App\Industry::all() as $ind)
	              <option value="{{$ind->id}}">{{$ind->name}}</option>
	            @endforeach
	        </select>
        </div>
  <br>
          <div class="divwits"> 
          <!-- <label class="desired">no.of recancies</label>-->
          <input style="width:50%;" value="mun_of.c:{{$data->num_of_candidates}}"   type="number" name ="num_of_candidates" class="form-control requirments" placeholder="no.of recancies" style="width: 90%;">
        </div>
<br>
            <div class="divwits"> 
          <!--<label class="desired">loacthon</label>-->
          	<select style="width:50%;" class="form-control requirments" id="country_id" name="country_id" required="" style="width: 90%;">
              <option selected="" disabled="disabled">job location</option>
                @foreach(\App\Country::all() as $country)
                  <option value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
            </select>
        </div>
<br>
         <div class="divwits" style="width:50%;">
          <label class="desired looking merlab">preferd jender</label>
          <div class="row" >
            <label class="col-sm-4 airports cololabox">
              <input type="radio" value="male" name="prefered_gender">
              <span class="label-text">male</span> </label>
            <label class="col-sm-4 airports cololabox">
              <input type="radio" name="gender" value="female">
              <span class="label-text">female</span> </label>
          </div>
          <!--row--> 
        </div>
        <br>

         <div class="divwits equirment"> 
          <!--  <label class="desired"> job description</label>-->
          <textarea style="width:50%;" value="Description:{{$data->	job_descripton}}"   class="form-control requirments" name="	job_descripton" placeholder="job description... " style="margin:0;"></textarea>
        </div>
        <!--divwits-->
        <br>
        <div class="divwits"> 
          <!--<label class="desired">job requirments </label>-->
          <input type="text" style="width:50%;"  value="Job_Requirments:{{$data->job_requirements}}"   class="form-control requirments" name="job_requirements" placeholder="job requirments">
        </div>
        <br>
        <div class="divwits" style="width:50%;" >
          <div class="row"  style="padding-top: 15px;padding-bottom: 15px">
            <div class="col-md-6 col-sm-12 airports availability"> availability</div>
            <div class="col-md-6 col-sm-12 airports availability" > <input type="date" value="Availabl:{{$data->availability}}" name="availability"></div>
            
          </div>
        </div>
        
        <!--divwits-->
        
        <div class="divwits">
          <div class="row">
            <div class="col-md-12 col-sm-12 ">
              	<select style="width:50%;" multiple="multiple" class="form-control chosen-select types" name="language_ids[]" id="language_id"  required="" style="width: 90%;">
                	<option selected=""> languages</option>
                	@foreach(\App\Language::all() as $lang)
                  		<option value="{{$lang->id}}">{{$lang->name}}</option>
                	@endforeach
             	</select>
            </div>
          <!--   <div class="col-sm-6 airports icon-star"> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i></div> -->
          </div>
        </div>
<br>
<div class="divwits" style="width:50%;">
              <label class="desired looking">salary</label>
              <div class="divwits">
                <div class="row">
                  <div class="col-sm-4 binputs">
                    <input type="number" value="Min_salary:{{$data->min_salary}}"  name="min_salary" class="form-control requirments" placeholder="from " onblur="processForm(this.form)">
                  </div>
                  <div class="col-sm-4 binputs">
                    <input type="number" value="Max_salary:{{$data->max_salary}}" name="max_salary" class="form-control requirments" placeholder="to" onblur="processForm(this.form)">
                  </div>
                  <div class="col-sm-4 binputs">
                    <select class="form-control requirments" value="{{$data->currency_id}}" name="currency_id" id="currency_id" required="" onblur="processForm(this.form)">
                        <option selected="" disabled="disabled">currency</option>
                         @foreach(\App\Currency::all() as $currency)
                            <option value="{{$currency->id}}">{{$currency->name}}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
                <!--row--> 
              </div>
              <!--divwits--> 
              
            </div>
                       
        <div class="divwits"   style="margin-bottom: 15px;margin-top: 20px;">
            <select style="width:50%;" multiple="multiple" class="form-control chosen-select types" name="skill_ids[]"   required="" id="skill_ids">
              <option selected=""> skills</option>
                        @foreach(\App\Skills::all() as $skill)
                      <option value="{{$skill->id}}">{{$skill->name}}</option>
                    @endforeach
                  </select>

            </select>
          </div>
           



                      

                       

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
       
 </section>

@endsection

  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script >
  populateCountries("country_id", "city_id"); // first parameter is id of country drop-down and second parameter is id of state drop-down

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>


  $(document).ready(function(){
    $('#job_id').select2();
    $('#country_id').select2();
    $('#currency_id').select2();
  });



  </script>
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
@endsection

  