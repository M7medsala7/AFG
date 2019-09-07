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
  
@endsection

@section('scripts')
<script>
   $(function(){
    $('header').addClass('header-in');
  });
</script>
<script>
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
  
</script>

<script>
  var searchtype = $('#search_type').val();
  if(searchtype == "")
  {
    $('.input-search').on('click',function(){
      $('.select_search_type').css('display','block');
      console.log(searchtype);
    });
  }
  else
  {

  }
$('.select_type').on('click',function(){
    $('.select_search_type').remove();
    searchtype=$(this).attr('type_val');
    $('#search_type').val(searchtype);
  });
</script>
@endsection