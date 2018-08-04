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
  }
  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 57px!important;}
  .select2-container .select2-selection--single
  {
    height: 0px!important;
  }
  .select2-container--default .select2-selection--single{    background-color: 0!important;border: 0!important}
</style>
@section('content')
<section class="sliderphoto innerphoto" style="background:url(/images/slide5.jpg) fixed center center no-repeat; background-size:cover;">
  <div class="container">
    <div class="nonebac candobxs">
      <ul class="nav nav-tabs tabscand">
        <li rel-index="0" class="active"> <a href="#step-1" class="btn" aria-controls="step-1" role="tab" data-toggle="tab"> <span> 1</span> <strong>Job Info</strong><i></i></a> </li>
        <li rel-index="1"> <a href="#step-2" class="btn disabled" aria-controls="step-2" role="tab" data-toggle="tab"> <span>2</span> <strong> Job Description</strong><i></i></a> </li>
        <li rel-index="2"> <a href="#step-3" class="btn disabled" aria-controls="step-3" role="tab" data-toggle="tab"> <span>3</span> <strong>Basic Info</strong><i></i></a> </li>
      </ul>
      <!--tabssteps-->
      
      <form  method="POST" action="/registeremployer" class="formlogin">
            {{csrf_field()}}
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane tabs-inner active" id="step-1">
            <div class="divwits"> 
              <!-- <label class="desired"> job tilte</label>-->
                <select class="form-control requirments" name="job_id" id="job_id" required="required" onblur="processForm(this.form)">
                  <option selected="" disabled="disabled">job tilte</option>
                    @foreach(\App\Job::all() as $job)
                      <option value="{{$job->id}}">{{$job->name}}</option>
                    @endforeach
                </select>
            </div>
            <!--divwits-->
            
            <div class="divwits"> 
              <!--<label class="desired">job location</label>-->
              <select class="form-control requirments" id="country_id" name="country_id" required="" onblur="processForm(this.form)">
                  <option selected="" disabled="disabled">job location</option>
                    @foreach(\App\Country::all() as $country)
                      <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                </select>
            </div>
            <!--divwits-->
            
            <div class="divwits">
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
            <!--divwits-->
            
            <div class="divwits"> 
              <!--<label class="desired">no.of candidates</label>-->
              <input type="number" name="num_of_candidates" class="form-control requirments" placeholder="no.of candidates">
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
              <!--<label class="desired"> job description</label>-->
              <textarea class="form-control requirments" name="job_descripton" placeholder="job description... " onblur="processForm(this.form)"></textarea>
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
            
            <div class="linksing textnonmer"> <a href="#" id="skip-next" class="skiplink">skip 
              <i class="fas fa-long-arrow-alt-right"></i></a> </div>
          </div>
      
          
          <div role="tabpanel" class="tab-pane tabs-inner" id="step-3">
            <div class="divwits">
              <div class="row">
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
            <!--divwits-->
            
            <div class="divwits"> 
              <!--<label class="desired">company name</label>-->
              <input type="text" name="name" class="form-control requirments" placeholder="company name" onblur="processForm(this.form)">
            </div>
            <!--divwits-->
            
            <div class="divwits"> 
              <!--<label class="desired">phone</label>-->
              <input type="text" name="phone" class="form-control requirments" placeholder="phone no." onblur="processForm(this.form)">
            </div>
            <!--divwits-->
            
            <div class="divwits"> 
              <!--<label class="desired">email</label>-->
              <input type="text" name="email" class="form-control requirments" placeholder="email" onblur="processForm(this.form)">
            </div>
            <!--divwits-->
            
            <div class="divwits"> 
              <!--<label class="desired">password</label>-->
              <input type="password" name="password" class="form-control requirments" placeholder="password" onblur="processForm(this.form)">
            </div>
            <!--divwits-->
            
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
                  <button type="submit"   class="largeredbtn">finish <i class="fas fa-check"></i></button>
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

@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>


  $(document).ready(function(){
    $('#job_id').select2();
    $('#country_id').select2();
    $('#currency_id').select2();
  });



  </script>
<script>

   $(document).on('submit','#emplyReg',function(ev) {
    // submit the form
        ev.preventDefault();

    $('#main_section').css('diplay','none');
     $.get("/congrats", function(data, status){
      $('#congrats').append(data);
     });
   </script>
    
    <script>
    // }
function processForm(form) {
  
  document.getElementById("Points").innerHTML=0;
  document.getElementById("Points2").innerHTML=0;
  document.getElementById("Points3").innerHTML=0;
  //document.getElementById("Points4").innerHTML=0;
 //document.getElementById("Points5").innerHTML=0;
  var control, controls = form.elements;
  for (var i=0, iLen=controls.length; i<iLen; i++) {
    control = controls[i];
 
if(control.value !="" && control.value !=0)
{


  document.getElementById("Points").innerHTML = 5+parseInt(document.getElementById("Points").innerHTML);
  document.getElementById("Points2").innerHTML = 5+parseInt(document.getElementById("Points").innerHTML);
  document.getElementById("Points3").innerHTML = 5+parseInt(document.getElementById("Points").innerHTML);
  //document.getElementById("Points4").innerHTML = 5+parseInt(document.getElementById("Points").innerHTML);
 //document.getElementById("Points5").innerHTML = 30+parseInt(document.getElementById("Points").innerHTML);


 }   // Do something with the control
   // console.log(control.name + ': ' + control.value);
  }
}

</script> 
    
@endsection