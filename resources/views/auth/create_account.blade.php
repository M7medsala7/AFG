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
  .select2-container--default .select2-selection--single{    background-color: 0!important;border: 0!important}
</style>
@section('content')

<section id="main_section" class="sliderphoto innerphoto" style="background:url(/images/slide5.jpg) fixed center center no-repeat; background-size:cover;">
  <div class="container">
    <div class="loginbok cand-1">
      <h4 class="createtitle"> create account</h4>
      <form  action="/f_reg/employer" method="post" id="f_reg_emp" class="formlogin">
        {{csrf_field()}}
        <div class="divwits">
           <input type="text" name="first_name" class="form-control" placeholder="first name">
        </div>
        <div class="divwits">
           <input type="hidden" name="type" value="{{$type}}" class="form-control" placeholder="first name">
        </div>
        <!--divwits-->
        
        <div class="divwits">
           <input type="text" name="last_name" class="form-control" placeholder="last name">
        </div>
        <!--divwits-->
        
        <div class="divwits">
           <input type="text" name="address" class="form-control" placeholder="address">
        </div>
        <!--divwits-->
        
        <div class="divwits">
          <select class="form-control" name="country_id" id="country_id" required="required">
            <option selected="" disabled="disabled">Current Country</option>
            @foreach(\App\Country::all() as $country)
              <option value="{{$country->id}}">{{$country->name}}</option>
            @endforeach
          </select>
        </div>
        <!--divwits-->
        
        <div class="divwits">
           <select class="form-control" id="city_id" name="city_id"  required="required">
            
          </select>
        </div>
        <!--divwits-->
        
        <div class="divwits">
           <input type="email" name="email" class="form-control" placeholder="email address" required="required">
        </div>
        <!--divwits-->
        
        <div class="divwits">
           <input type="email" name="email_confirmation" class="form-control" placeholder="confirm email" required="required">
        </div>
        <!--divwits-->
        
        <div class="divwits iconfont">
           <input type="password" name="password" class="form-control" placeholder="password">
        </div>
        <!--divwits-->
        
        <div class="divwits">
          <div class="row">
            <div class="col-sm-4 createbot">
              <button type="submit" class="largeredbtn"> create now </button>
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
    <div class='errors col-sm-4' style="color:red;"></div>
    
  </div>
  <!--container--> 
  
</section>
<div id="congrats"></div>
<!--section-->
@endsection
@section('scripts')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
  $(document).ready(function(){

    $('#country_id').select2();
  });
  $('#country_id').on('change',function(){
    var country_id = $('#country_id').val();
     $.get("/getCities/"+country_id, function(data, status){

      $.each(data, function(key, item) {   
       $('#city_id')
           .append($("<option></option>")
                      .attr("value",item.id)
                      .text(item.name)); 
        });
    });
  });
  $('#city_id').select2();
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

    $('#main_section').css('diplay','none');
     $.get("/congrats", function(data, status){
      $('#congrats').append(data);
     });
    
    // $('#congrat_section').css('diplay','block');
  
    $.ajax({
            type: $('#f_reg_emp').attr('method'),
            url: $('#f_reg_emp').attr('action'),
            data: $('#f_reg_emp').serialize(),
            success: function(data,ev)
            { 
              if(data == 'true')
              {
                window.location = "/home";

              }
            },
            error:function(data,ev)
            {
              console.log(data);
              $('#congrats').empty();
               $('#main_section').css('diplay','block');
               
               $('.errors').append('<p style="color:red">'+data.responseText+'</p>'); 
               
            }
        });
        // return false to
     });
</script>
@endsection