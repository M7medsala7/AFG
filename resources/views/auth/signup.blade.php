@extends('Layout.app')


@section('content')

<section class="sliderphoto innerphoto" style="background:url(images/slide5.jpg) fixed center center no-repeat; background-size:cover;">
  <div class="container">
    <div class="loginbok cand-1 register-welcome">
      <h3 class="createtitle">Welcome </h3>
      <p class="textprgraf">If you want to help you find a job,register as <strong style="color:white">candidate</strong>. But if you are looking for help to get candidate for you register as <strong style="color:white">Employer</strong> </p>
      <h4 class="title-con enteacolor mertilte"> Register as </h4>
      <div class="row">
        <div class="col-sm-6 congratulations"> <i class="fas fa-users"></i> <a href="/f_register/candidate" class="largeredbtn"> Candidates </a>
          <ul class="hassl agencies">
            <li>find a job easily</li>
            <li>reach your employer directly</li>
            <li>forget about agencies hassle</li>
          </ul>
        </div>
        <!--textbotphot-->
        
        <div class="col-sm-6 congratulations"> <i class="fas fa-recycle"></i> <a href="/register/employeer" class="largeredbtn">Employers </a>
          <ul class="hassl agencies">
            <li>find a job easily</li>
            <li>reach your employer directly</li>
            <li>forget about agencies hassle</li>
          </ul>
        </div>
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
