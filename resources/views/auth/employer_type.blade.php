@extends('Layout.app')


@section('content')

<section class="sliderphoto innerphoto" style="background:url(/images/slide5.jpg) fixed center center no-repeat; background-size:cover;">
  <div class="container">
    <div class="loginbok cand-1 register-welcome">
      <h3 class="createtitle">Welcome </h3>
    
      <h4 class="title-con enteacolor mertilte"> Register as </h4>
      <div class="row">
        <div class="col-sm-4 congratulations"> <i class="fas fa-users"></i> <a href="type?type=family" class="largeredbtn">family</a> </div>
        <!--textbotphot-->
        
        <div class="col-sm-4 congratulations"> <i class="fas fa-recycle"></i> <a href="type?type=agency" class="largeredbtn">recruiter/agency</a> </div>
        <!--textbotphot-->
        
        <div class="col-sm-4 congratulations"> <i class="fas fa-building"></i> <a href="type?type=company" class="largeredbtn">company</a> </div>
        <!--textbotphot--> 
        
      </div>
      <!--row--> 
      
    </div>
    <!--cand-1--> 
    
  </div>
  <!--container--> 
  
</section>
<!--section-->

@endsection