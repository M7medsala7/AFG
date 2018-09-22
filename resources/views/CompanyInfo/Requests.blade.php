@extends('Layout.app')

@section('content')


<section class="contactus">
  <div class="container">
    <div class="inner-contacts">

@if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
@endif

      <h2 class="textcandidate conmerg">you Can submit your request </h2>




      <div class="col-sm-12 contacts">
   <!-- <form  route="" method="post"  class="formlogin mergform" enctype="multipart/form-data"> -->
   <form  action="/sendyourrequest" method="POST" class="formlogin" enctype="multipart/form-data">
        {{csrf_field()}}	 
          <div class="divwits">
            <label class="desired" >Name</label>
            <input type="text" class="form-control" placeholder="Your Name" name="name">
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <label class="desired" >email address</label>
            <input type="text" class="form-control" placeholder="email address" name="email" required="required">
          </div>
          <!--divwits-->
          
          <div class="divwits">
            <label class="desired" >phone number</label>
            <input type="text" class="form-control" placeholder="phone number" name="phone">
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
      

        
      
      <!--//contacts--> 
      
    </div>
    <!--inner-contacts-->
    
    <h3 class="textcandidate conmerg">Our contact </h3>
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
  @section('scripts')
<script>
   $(function(){
    $('header').addClass('header-in');
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


@endsection