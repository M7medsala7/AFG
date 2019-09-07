@extends('Layout.app')

@section('content')
@if(Session::get('locale')=="Ar"|| Session::get('locale')=="ar")
{{App::setLocale('ar')}}
@else
{{App::setLocale('en')}}
@endif

<section class="contactus">
  <div class="container">
    <div class="inner-contacts">


      <h2 class="textcandidate conmerg"> {{trans('app.Blogs')}}</h2>

      <div class="col-sm-12 contacts">

 <div class="row">
      <div class="col-sm-12 dashboardleft">
        <div class="inner-aboutus topmergline padbotnm">
        @foreach($blog as $item)
          <div class="ineercompany nonbordimg">
          <h5 class="textcandidate">{{$item->name}}</h5>
          <div  class="col-sm-12">
          <div  class="col-sm-2">
          <div class="linksing viewprofile"> 
          <img src="/{{$item->image}}"> 
           </div>
          </div>
          <div  class="col-sm-10">
          <p class="textabout" style="margin-top: 30px;">

{!!html_entity_decode($item->body)!!}
    
</p>
          </div>
          </div>
            
   

         
          </div>

       @endforeach
        </div>  
        </div>  

        </div>    


      
   <!-- <form  route="" method="post"  class="formlogin mergform" enctype="multipart/form-data"> -->
  
      </div>
      <!--//contacts-->
      

        
      
      <!--//contacts--> 
      
    </div>
    <!--inner-contacts-->
   
    <div class="row">
      <div class="col-sm-4 contacts">
        <div class="contacttext"> <i class="far fa-envelope"></i> <strong> {{trans('app.email')}}</strong><br>
          <a >social@maidandhelper.com</a> </div>
        <!--textfooter--> 
        
      </div>
      <!--//contacts-->
      
      <div class="col-sm-4 contacts">
        <div class="contacttext"> <i class="fas fa-phone"></i> <strong>{{trans('app.phone_number')}}</strong> <br>
          <a > 00971556566883</a> </div>
        <!--textfooter--> 
        
      </div>
      <!--//contacts-->
      
      <div class="col-sm-4 contacts">
        
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