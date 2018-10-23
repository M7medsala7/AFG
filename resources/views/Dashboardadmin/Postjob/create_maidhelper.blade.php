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
      Add PostJob
      
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('adminpanel')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class=""><a href="{{url('/adminpanel/postjob')}}"> PostJob controlling </a></li>
        
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

   <form  role="form" method="POST" action="{{ url('/adminpanel/postjob/maidhelper/stor') }}" enctype="multipart/form-data">

                     {{csrf_field()}}



  
        
            <!--divwits-->
          
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
          <input style="width:50%;"  type="number" name ="num_of_candidates" class="form-control requirments" placeholder="no.of recancies" style="width: 90%;">
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
          <textarea style="width:50%;" class="form-control requirments" name="job_descripton" placeholder="job description... " style="margin:0;"></textarea>
        </div>
        <!--divwits-->
        <br>
        <div class="divwits"> 
          <!--<label class="desired">job requirments </label>-->
          <input type="text" style="width:50%;"  class="form-control requirments" name="job_requirements" placeholder="job requirments">
        </div>
      
        <br>
            <div class="divwits"> 
              <!--<label class="desired">phone</label>-->
              <input style="width:50%;" type="text" name="phone" class="form-control requirments" placeholder="phone no." onblur="processForm(this.form)">
            </div>
            <!--divwits-->
        <br>
        <div class="divwits" style="width:50%;" >
          <div class="row"  style="padding-top: 15px;padding-bottom: 15px">
            <div class="col-md-6 col-sm-12 airports availability"> availability</div>
            <div class="col-md-6 col-sm-12 airports availability" > <input type="date" name="availability"></div>
            
          </div>
        </div>
        
        <!--divwits-->
        
        <div class="divwits">
          <div class="row">
            <div class="col-md-12 col-sm-12 ">
              	<select style="width:50%;"   multiple="multiple" class="form-control chosen-select types" name="language_ids[]" id="language_id"  required="" style="width: 90%;">
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
                    <input type="number" name="min_salary" class="form-control requirments" placeholder="from " onblur="processForm(this.form)">
                  </div>
                  <div class="col-sm-4 binputs">
                    <input type="number" name="max_salary" class="form-control requirments" placeholder="to" onblur="processForm(this.form)">
                  </div>
                  <div class="col-sm-4 binputs">
                    <select class="form-control requirments" name="currency_id" id="currency_id" required="" onblur="processForm(this.form)">
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
                       
        <div class="divwits" style="margin-bottom: 15px;margin-top: 20px;">
            <select style="width:50%;"  multiple="multiple" class="form-control chosen-select types" name="skill_ids[]"   required="" style="width: 90%;" id="skill_ids">
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


 


