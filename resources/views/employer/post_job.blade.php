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
width:400px;
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
  }
  .select2 select2-container select2-container--default
  {
    width: 300px;
  }
  .select2 select2-container select2-container--default select2-container--below
  {
    width:300px;
  }
 .select2-container--default .select2-selection--single .select2-selection__rendered
   {
    width:100%;

  }
</style>
@section('content')
<section class="sliderphoto innerphoto" style="background:url(/images/slide5.jpg) fixed center center no-repeat; background-size:cover;">
  <div class="container">
  <ul class="nav nav-tabs  tabssteps">
    <div class="liner"></div>
    <li rel-index="0" class="active"> <a href="#step-1" class="btn" aria-controls="step-1" role="tab" data-toggle="tab"> <span><i class="glyphicon glyphicon-user"></i></span> </a> </li>
    <li rel-index="1"> <a href="#step-2" class="btn disabled" aria-controls="step-2" role="tab" data-toggle="tab"> <span><i class="glyphicon glyphicon-heart"></i></span> </a> </li>
  </ul>
  <!--tabssteps-->
  
  <form  action="/postJob/store" method="post" class="formlogin mergform">
   {{csrf_field()}}
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane  nonebac active" id="step-1">
        <div class="headtop nonbord borderbox">
          <div class="stapson active"><span>1</span>
            <h4 class="personalinfo">post job slide 1</h4>
          </div>
          <div class="rightcealr"> <span class="active"></span> <span></span> <a href="#">clear all</a> </div>
        </div>
        <!--borderbox-->
        
        <div class="divwits"> 
          <!--<label class="desired">job title </label>-->
          	<select class="form-control requirments" name="job_id" id="job_id" required="required" style="width: 90%;">
          		<option selected="" disabled="disabled">job tilte</option>
            	@foreach(\App\Job::all() as $job)
              	<option value="{{$job->id}}">{{$job->name}}</option>
            	@endforeach
       	   	</select>
        </div>
        <!--divwits-->
        
        <div class="divwits"> 
          <!--<label class="desired">industry</label>-->
          	<select class="form-control requirments" name="industry_id" id="industry_id" required="" style="width: 90%;">
	          <option selected="" disabled="disabled">desired industry</option>
	            @foreach(\App\Industry::all() as $ind)
	              <option value="{{$ind->id}}">{{$ind->name}}</option>
	            @endforeach
	        </select>
        </div>
        <!--divwits-->
        
        <div class="divwits"> 
          <!-- <label class="desired">no.of recancies</label>-->
          <input type="number" name ="num_of_candidates" class="form-control requirments" placeholder="no.of recancies" style="width: 90%;">
        </div>
        <!--divwits-->
        
        <div class="divwits"> 
          <!--<label class="desired">loacthon</label>-->
          	<select class="form-control requirments" id="country_id" name="country_id" required="" style="width: 90%;">
              <option selected="" disabled="disabled">job location</option>
                @foreach(\App\Country::all() as $country)
                  <option value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
            </select>
        </div>
        <!--divwits-->
        
        <div class="divwits">
          <label class="desired looking merlab">preferd jender</label>
          <div class="row">
            <label class="col-sm-4 airports cololabox">
              <input type="radio" value="male" name="prefered_gender">
              <span class="label-text">male</span> </label>
            <label class="col-sm-4 airports cololabox">
              <input type="radio" name="gender" value="female">
              <span class="label-text">female</span> </label>
          </div>
          <!--row--> 
        </div>
        
        <!--divwits-->
        
        <div class="divwits">
          <div class="row">
            <div class="col-sm-6 botrg">
              <div class="linksing textcand-1">
                <p>10</p>
                <span>earn points <i class="fas fa-trophy"></i><br/>
                with each step</span> </div>
            </div>
            <div class="col-sm-3 cand-2 floting"> <a href="#" id="step-1-next" class="largeredbtn">continue</a> </div>
          </div>
          <!--row--> 
          
        </div>
        <!--divwits--> 
        
      </div>
      <!--tab-pane-->
      
      <div role="tabpanel" class="tab-pane nonebac" id="step-2">
        <div class="headtop nonbord borderbox">
          <div class="stapson active"><span>2</span>
            <h4 class="personalinfo">post job slide 2</h4>
          </div>
          <div class="rightcealr"> <span class="active"></span> <span class="active"></span> <a href="#">clear all</a> </div>
        </div>
        <!--borderbox-->
        
        <div class="divwits equirment"> 
          <!--  <label class="desired"> job description</label>-->
          <textarea class="form-control requirments" name="job_descripton" placeholder="job description... " style="margin:0;"></textarea>
        </div>
        <!--divwits-->
        
        <div class="divwits"> 
          <!--<label class="desired">job requirments </label>-->
          <input type="text" class="form-control requirments" name="job_requirements" placeholder="job requirments">
        </div>
        <!--divwits-->
        
        <div class="divwits">
          <div class="row"  style="padding-top: 15px;padding-bottom: 15px">
            <div class="col-md-6 col-sm-12 airports availability"> availability</div>
            <div class="col-md-6 col-sm-12 airports availability" > <input type="date" name="availability"></div>
            
          </div>
        </div>
        
        <!--divwits-->
        
        <div class="divwits">
          <div class="row">
            <div class="col-md-12 col-sm-12 ">
              	<select class="form-control chosen-select types" name="language_ids[]" id="language_id" multiple="multiple" required="" style="width: 90%;">
                	<option selected=""> languages</option>
                	@foreach(\App\Language::all() as $lang)
                  		<option value="{{$lang->id}}">{{$lang->name}}</option>
                	@endforeach
             	</select>
            </div>
          <!--   <div class="col-sm-6 airports icon-star"> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i></div> -->
          </div>
        </div>
        <!--divwits-->
        
        <div class="divwits">
          <div class="row">
            <div class="col-sm-6 airports witpostslid">
              <input type="text" class="form-control requirments" name="max_salary" placeholder="salary: exampe 500,00,00">
            </div>
            <div class="col-sm-3 airports witpostslid">
              <select class="form-control requirments" name="currency_id" required="">
                   @foreach(\App\Currency::all() as $currency)
                    <option value="{{$currency->id}}">{{$currency->name}}</option>
                  @endforeach
              </select>
            </div>
          </div>
        </div>
        <!--divwits-->
        

    <div class="divwits" style="margin-bottom: 15px;margin-top: 20px;">
            <select class="form-control chosen-select types" name="skill_ids[]" multiple="multiple" required="" style="width: 90%;">
              <option selected=""> skills</option>
                        @foreach(\App\Skills::all() as $skill)
                      <option value="{{$skill->id}}">{{$skill->name}}</option>
                    @endforeach
                  </select>
            </select>
          </div>


      
        <div class="linksing"> <a href="#" class="skiplink">if you wwant to coutenue please click here to answer the questions if not click submit </a> </div>
        <div class="divwits">
          <div class="row">
            <div class="col-sm-6 botrg">
              <div class="linksing textcand-1">
                <p>20</p>
                <span>earn points <i class="fas fa-trophy"></i><br>
                with each step</span> </div>
            </div>
            <div class="col-sm-3 cand-2">
              <button type="button" id="step-1-back"  class="largeredbtn back"> back</button>
            </div>
            <div class="col-sm-3 cand-2">
              <button type="submit" class="largeredbtn">submit</button>
            </div>
          </div>
          <!--row--> 
          
        </div>
        <!--divwits--> 
        
      </div>
      <!--tab-pane--> 
      
    </div>
    
    <!--tab-pane-->
    
    </div>
    <!--tab-content-->
    
  </form>
  </div>
  <!--container--> 
  
</section>
<!--section-->

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
 

 });


</script>
@endsection
