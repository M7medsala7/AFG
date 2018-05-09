@extends('Layout.app')


@section('content')

<section class="sliderphoto innerphoto" style="background:url(images/slide5.jpg) fixed center center no-repeat; background-size:cover;">
  <div class="container">
  <div class="loginbok">
    <h3 class="title-con enteacolor mertilte"> Welcome </h3>
    <p class="viewsdriver congrat"> truck driver   congratulations truck driver congratulations <b> Candidates </b>truck driver congratulations truck driver congratulations   truck driver congratulations<b> Employers </b></p>
    <h3 class="title-con enteacolor mertilte"> Register as </h3>
    <div class="col-sm-6 inputbox textbotphot"> <img src="images/textbotphot.jpg" >
      <div class="bowitdiv"> <a href="/f_register/candidate" class="largeredbtn">Candidates</a> </div>
      <!--bowitdiv-->
      
      <ul class="hassle">
        <li>find a job easily</li>
        <li>reach your employer directly</li>
        <li>forget about agencies hassle</li>
      </ul>
    </div>
    
    <!--inputbox-->
    <div class="col-sm-6 inputbox textbotphot"> <img src="images/textbotphot2.jpg" >
      <div class="bowitdiv"> <a href="/register/employeer" class="largeredbtn">Employers</a> </div>
      <!--bowitdiv-->
      
      <ul class="hassle">
        <li>find a job easily</li>
        <li>reach your employer directly</li>
        <li>forget about agencies hassle</li>
      </ul>
    </div>
    
    <!--inputbox--> 
    
  </div>
  <!--container--> 
  
</section>
<!--section-->

<!--section-->
@endsection
