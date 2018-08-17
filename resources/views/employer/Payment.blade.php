@extends('Layout.app')

<style type="text/css">
  .header{
    position: relative!important;
  }
</style>

@section('content')
<section class="dashboard">
  <div class="container">
    <div class="inner-aboutus chat-page">
      <div class="headtilte employers">
        <h2 class="textcandidate">Our Packages</h2>
      </div>
      <!--nonebordes-->
      
      <div class="tab-content">
        <ul class="nav nav-tabs tebprofile employerstebs">
          <li class="active"><a data-toggle="tab" href="#monthlyplans">monthly plans</a></li>
          <li><a data-toggle="tab" href="#annualplans"> annual plans</a></li>
        </ul>
        <!--employerstebs-->
        
        <div id="monthlyplans" class="tab-pane employerbox fade in active">
          <div class="col-sm-4 empcol">
            <div class="empcolbox">
              <h2 class="textcandidate">gold</h2>
              <h3 class="textcandidate">$50/ <span>monthly</span></h3>
              <p class="textpoint">................................................</p>
              <p class="textpoint">................................................</p>
              <p class="textpoint">................................................</p>
              <a href="#" class="largeredbtn">get started</a> </div>
          </div>
          <!--empcol-->
          
          <div class="col-sm-4 empcol">
            <div class="empcolbox">
              <h2 class="textcandidate">silver</h2>
              <h3 class="textcandidate">$30/ <span>monthly</span></h3>
              <p class="textpoint">................................................</p>
              <p class="textpoint">................................................</p>
              <p class="textpoint">................................................</p>
              <a href="#" class="largeredbtn">get started</a> </div>
          </div>
          <!--empcol-->
          
          <div class="col-sm-4 empcol">
            <div class="empcolbox">
              <h2 class="textcandidate">bronze</h2>
              <h3 class="textcandidate">$10/ <span>monthly</span></h3>
              <p class="textpoint">................................................</p>
              <p class="textpoint">................................................</p>
              <p class="textpoint">................................................</p>
              <a href="#" class="largeredbtn">get started</a> </div>
          </div>
          <!--empcol--> 
          
        </div>
        <!--tab-pane-->
        
        <div id="annualplans" class="tab-pane employerbox  fade">
          <div class="col-sm-4 empcol">
            <div class="empcolbox">
              <h2 class="textcandidate">gold</h2>
              <h3 class="textcandidate">$50/ <span>monthly</span></h3>
              <p class="textpoint">................................................</p>
              <p class="textpoint">................................................</p>
              <p class="textpoint">................................................</p>
              <a href="#" class="largeredbtn">get started</a> </div>
          </div>
          <!--empcol-->
          
          <div class="col-sm-4 empcol">
            <div class="empcolbox">
              <h2 class="textcandidate">silver</h2>
              <h3 class="textcandidate">$30/ <span>monthly</span></h3>
              <p class="textpoint">................................................</p>
              <p class="textpoint">................................................</p>
              <p class="textpoint">................................................</p>
              <a href="#" class="largeredbtn">get started</a> </div>
          </div>
          <!--empcol-->
          
          <div class="col-sm-4 empcol">
            <div class="empcolbox">
              <h2 class="textcandidate">bronze</h2>
              <h3 class="textcandidate">$10/ <span>monthly</span></h3>
              <p class="textpoint">................................................</p>
              <p class="textpoint">................................................</p>
              <p class="textpoint">................................................</p>
              <a href="#" class="largeredbtn">get started</a> </div>
          </div>
          <!--empcol--> 
          
        </div>
        <!--tab-pane--> 
        
      </div>
      <!--tab-content--> 
      
    </div>
    
    <!--inner-aboutus chat-page--> 
    
  </div>
  
  <!--container--> 
  
</section>
<!--section-->

<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> watch demo video
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="textbox">
        <iframe  src="https://www.youtube.com/embed/BFrLL5w9UGQ?autoplay=0" frameborder="0" allowfullscreen></iframe>
      </div>
      <!--textbox--> 
      
    </div>
  </div>
</div>
<!--myModal-->


@endsection