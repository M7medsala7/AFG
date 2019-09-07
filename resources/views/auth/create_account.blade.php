@extends('Layout.app')
<style>
  .select2-selection__rendered{
    background: #f4f4f4;
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
  .select2-container--default .select2-selection--single{background-color: white!important;border: white!important}
</style>
@section('content')

<section id="main_section" class="sliderphoto innerphoto" style="background:url(/images/slide5.jpg) fixed center center no-repeat; background-size:cover;">
  <div class="container">
    <div class="loginbok cand-1">
      <h4 class="createtitle"> create account</h4>
    
      <form  action="/f_reg/employer" method="post" id="f_reg_emp" class="formlogin" enctype="multipart/form-data"  >
        {{csrf_field()}}
        <div class="divwits">
           <input type="text" name="first_name" class="form-control requirments" placeholder="  {{$type}} name" onblur="processForm(this.form)">
        </div>
        <div class="divwits">
           <input type="hidden" name="type" value="{{$type}}" class="form-control" placeholder="first name" onblur="processForm(this.form)">
        </div>
        <!--divwits-->
        
        <div class="divwits">
           <input type="text" name="last_name" class="form-control requirments" placeholder="last name" onblur="processForm(this.form)">
        </div>
        <!--divwits-->
        
        <div class="divwits">
           <input type="text" name="address" class="form-control" placeholder="address" onblur="processForm(this.form)">
        </div>

         <div class="divwits">
           <input type="number" name="phone" class="form-control requirments" placeholder="phone" onblur="processForm(this.form)">
        </div>
        <!--divwits-->
        
        <div class="divwits">
          <select class="form-control " name="country_id" id="country_id" required onblur="processForm(this.form)">
          
          </select>
        </div>
        <!--divwits-->
        
        <div class="divwits iconfont">
           <select class="form-control" id="city_id" name="city_id"  onblur="processForm(this.form)">
             <option selected="" disabled="disabled">Select City</option>
           
          </select>
        </div>
        <!--divwits-->
        
        <div class="divwits">
           <input type="email" name="email" class="form-control" placeholder="email address" required="required" onblur="processForm(this.form)">
        </div>
        <!--divwits-->
        
       
        <!--divwits-->
        
        <div class="divwits iconfont">
           <input type="password" name="password" class="form-control" placeholder="password" onblur="processForm(this.form)">
        </div>

         <div  class="divwits ">
                  <div class="input-group input-file" name="logo">
                    <input type="text" class="form-control requirments"  placeholder='image...'  />
                    <span class="input-group-btn">
                    <button class="btn btn-default btn-choose largeredbtn brows" type="button" onblur="processForm(this.form)">brows</button>
                    </span> </div>
                </div>
        <div class="col-sm-8  stepotw">
                <div class="linksing textcand-1">
                  <p id="Points">0</p>
                  <span>earn points <i class="fas fa-trophy"></i><br>
                  with each step</span> </div>
              </div><!--divwits-->
        
        <div class="divwits">
          <div class="row">
            <div class="col-sm-4 createbot">
              <button type="submit"   class="largeredbtn"> create now </button>
            </div>
          </div>
          <!--row--> 
          
        </div>
        <!--divwits-->
        
      </form>
    </div>
    <!--witstapon-->
 
    <div class="col-sm-4 inputbox margmadia">
      <h3 class="title-con entea"> welcome to</h3>
      <h4 class="title-con entea">Maid & Helper</h4>
      <p class="textprgraf">you are just <span>3</span> steps away from <br/>
        having the mostmodern profile</p>
    </div>
    <!--inputbox--> 
     {!! JsValidator::formRequest('App\Http\Requests\EmpRegisterFormRequest', '.formlogin'); !!}
    
  </div>
  <!--container--> 
  
</section>
<div class="modal fade" id="overlay">
  <div class="modal-dialog">
      <div class="modal-content dal-conte"> <i class="fas fa-check-circle"></i>


      <h2 class="textcandidate">congratulations</h2>
 
  
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
  
<!--section-->


      
    </div>
  </div>
</div>

<!--section-->
@endsection
@section('scripts')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
 <script type="text/javascript" src="/vendor/jsvalidation/js/jsvalidation.js"></script>
<script src="/dist/jquery.validate.js"></script>
<script>
  populateCountries("country_id", "city_id"); // first parameter is id of country drop-down and second parameter is id of state drop-down
</script>
<script>


$(document).ready(function(){
  $('#job_id').select2();
  $('#country_id').select2();
  $('#city_id').select2();
});



</script>
<script >

  $.ajaxSetup({
        headers:{
             'X-CSRF-Token': $('input[name="_token"]').val()
        }
    });
   $(document).on('submit','#f_reg_emp',function(ev) {
    // submit the form
        ev.preventDefault();

    $('#overlay').modal('show');

setTimeout(function() {
 
     $('#overlay').modal('hide');

          document.getElementById('f_reg_emp').submit();

}, 7000);

var timeleft = 10;
var downloadTimer = setInterval(function(){
  
  if(timeleft <= 0)
    clearInterval(downloadTimer);
},1000);

     });
</script>
<script >
  
function processForm(form) {
  
  document.getElementById("Points").innerHTML=0;

 //document.getElementById("Points5").innerHTML=0;
  var control, controls = form.elements;
  for (var i=0, iLen=controls.length; i<iLen; i++) {
    control = controls[i];
 
if(control.value !="" && control.value !=0)
{

  document.getElementById("Points").innerHTML = 5+parseInt(document.getElementById("Points").innerHTML);
 


 }   // Do something with the control
   
  }
}

</script>
@endsection