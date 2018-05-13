@extends('Layout.app')
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
          	<select class="form-control requirments" name="job_id" id="job_id" required="required">
          		<option selected="" disabled="disabled">job tilte</option>
            	@foreach(\App\Job::all() as $job)
              	<option value="{{$job->id}}">{{$job->name}}</option>
            	@endforeach
       	   	</select>
        </div>
        <!--divwits-->
        
        <div class="divwits"> 
          <!--<label class="desired">industry</label>-->
          	<select class="form-control requirments" name="industry_id" id="industry_id" required="">
	          <option selected="" disabled="disabled">desired industry</option>
	            @foreach(\App\Industry::all() as $ind)
	              <option value="{{$ind->id}}">{{$ind->name}}</option>
	            @endforeach
	        </select>
        </div>
        <!--divwits-->
        
        <div class="divwits"> 
          <!-- <label class="desired">no.of recancies</label>-->
          <input type="number" name ="num_of_candidates" class="form-control requirments" placeholder="no.of recancies">
        </div>
        <!--divwits-->
        
        <div class="divwits"> 
          <!--<label class="desired">loacthon</label>-->
          	<select class="form-control requirments" id="country_id" name="country_id" required="">
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
          <div class="row">
            <div class="col-sm-4 airports availability"> availability</div>
            <input type="date" name="availability">
          </div>
        </div>
        
        <!--divwits-->
        
        <div class="divwits">
          <div class="row">
            <div class="col-sm-6 airports witpostslid">
              	<select class="form-control requirments" name="language_ids[]" id="language_id" multiple="multiple" required="">
                	<option selected=""> languages</option>
                	@foreach(\App\Language::all() as $lang)
                  		<option value="{{$lang->id}}">{{$lang->name}}</option>
                	@endforeach
             	</select>
            </div>
            <div class="col-sm-6 airports icon-star"> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i></div>
          </div>
        </div>
        <!--divwits-->
        
        <div class="divwits">
          <div class="row">
            <div class="col-sm-6 airports witpostslid">
              <input type="text" class="form-control requirments" name="max_salary" placeholder="salary: exampe 500,00,00">
            </div>
            <div class="col-sm-3 airports witpostslid">
              <select class="form-control requirments" name="birth_date" required="">
                <option selected="" disabled="">en</option>
                <option value="4">en</option>
              </select>
            </div>
          </div>
        </div>
        <!--divwits-->
        
        <div class="divwits"> 
          <!--<label class="desired">preferred skills </label>-->
          	<select class="form-control requirments" name="skill_ids[]" id="skill_ids" 	multiple="multiple" required="">
                <option selected=""> skills</option>
                @foreach(\App\Skills::all() as $skill)
                  <option value="{{$skill->id}}">{{$skill->name}}</option>
                @endforeach
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