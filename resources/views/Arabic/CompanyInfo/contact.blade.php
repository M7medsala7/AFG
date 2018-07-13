@extends('Layout.app')

@section('content')


<section class="contactus">
  <div class="container">
    <div class="inner-contacts">
      <h2 class="textcandidate conmerg">get in touch with us</h2>
      <div class="col-sm-5 contacts">
 <form  route="sendemail" method="post" id="full_cand_reg" class="formlogin mergform" enctype="multipart/form-data">
      	 
          <div class="divwits">
            <label class="desired" >full name</label>
            <input type="text" class="form-control" placeholder="full name" name="fullname">
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <label class="desired" >email address</label>
            <input type="text" class="form-control" placeholder="email address" name="email">
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <label class="desired" >phone number</label>
            <input type="text" class="form-control" placeholder="phone number" name="phone_number">
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <label class="desired" > your massage</label>
            <textarea class="form-control" placeholder="type your message or inquiry here... " name="message"></textarea>
          </div>
          <!--divwits-->
          
          <div class="divwits mergbot">
            <button type="submit" class="largeredbtn">submit </button>
          </div>
          <!--divwits-->
          
   </form>
      </div>
      <!--//contacts-->
      
      <div class="col-sm-7 contacts">
        <div class="map-iframe">
          <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA5MqCgYcuCFqzN8-2Bm6SjZwoEtYJYW98
    &q=Business+Center,+Hyundai+Show-Deira-Dubai,+UAE" frameborder="0" style="border:0" allowfullscreen>
</iframe>


        </div>
        <!--map-iframe-->
        
        <div class="linksing"> <a href="#" class="skiplink">view location on map </a> </div>
      </div>
      <!--//contacts--> 
      
    </div>
    <!--inner-contacts-->
    
    <h3 class="textcandidate conmerg">contact us</h3>
    <div class="row">
      <div class="col-sm-4 contacts">
        <div class="contacttext"> <i class="far fa-envelope"></i> <strong>email</strong><br>
          <a >social@maidandhelper.com</a> </div>
        <!--textfooter--> 
        
      </div>
      <!--//contacts-->
      
      <div class="col-sm-4 contacts">
        <div class="contacttext"> <i class="fas fa-phone"></i> <strong>phone number</strong> <br>
          <a > 00971556566883</a> </div>
        <!--textfooter--> 
        
      </div>
      <!--//contacts-->
      
      <div class="col-sm-4 contacts">
        <div class="contacttext"> <i class="fas fa-map-marker-alt"></i> <strong>Address</strong><br>
          <p>Key Business center, Hyundai Show-Deira-Dubai, UAE</p>
        </div>
        <!--textfooter--> 
        
      </div>
      <!--//contacts--> 
      
    </div>
    
    <!--row--> 
    
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