@extends('Dashboardadmin.layout.master')
@section('content')

<section class="sliderphoto innerphoto" style="background-color:">
  <div class="container">
    <div class="loginbok cand-1 register-welcome">
      <h3 class="createtitle"></h3>
    
      
      <center>
      <h4 class="title-con enteacolor mertilte"> Employer As </h4>
      <div class="row" style="width:60%;margin-top:30%;border:solied 1px blue;">
      
        <div class="col-sm-4 congratulations">

         <i class="fas fa-users"></i>
         <button type="button"  style="border-radius: 20px;width:85px;background-color:white;border-color:#1E90FF;"  >
         <a href="type?type=family" class="largeredbtn">family</a> 
         </button>
         </div>
        <!--textbotphot-->
        
        <div class="col-sm-4 congratulations"> <i class="fas fa-recycle"></i> 
        <button type="button"  style="border-radius: 20px;width:115px;background-color:white;border-color:#1E90FF;"  >
        <a href="type?type=agency" class="largeredbtn">recruiter/agency</a> 
        </button>
        </div>
        <!--textbotphot-->
        
        <div class="col-sm-4 congratulations"> <i class="fas fa-building"></i>
        <button type="button"  style="border-radius: 20px;width:85px;background-color:white;border-color:#1E90FF;"  >
         <a href="type?type=company" class="largeredbtn">company</a> 
         </button>
         </div>
        <!--textbotphot--> 
        
      </div>
      <!--row--> 
      
    </div>
    </center>
    <!--cand-1--> 
    
  </div>
  <!--container--> 
  
</section>
<!--section-->

@endsection