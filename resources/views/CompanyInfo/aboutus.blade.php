@extends('Layout.app')
@section('content')
<!--header-->
@if(Session::get('locale')=="Ar"|| Session::get('locale')=="ar")
{{App::setLocale('ar')}}
@else
{{App::setLocale('en')}}
@endif
<section class="aboutus">
  <div class="container">
    <div class="inner-aboutus">
      <div class="row">
        <div class="col-sm-9 aboutusbox">
          <div class="textabut">
            <h2 class="textcandidate">about Maid & Helper</h2>
            <p>Maid & Helper - The World`s First Online Career Mega Mall- is providing a
             one-stop-shop to all career services for job-seekers and professionals to
              aspire to a better life. If you are looking for a building a professional 
              network, an outstanding CV, a job, a training course, an educational certificate,

              a self-assessment tools, or even a career consolation, advice and information,

               then you are in the right place.
Maid  & Helper  is a digital world where you search and have free access not only for
 millions of jobs from thousands of company websites and job boards, 
 but also thousands of  other career service  and opportunities.
</p>
          </div>
          <!--textabut-->
          
          <div class="textabut">
            <h2 class="textcandidate"> {{trans('app.looking_for_a_job')}}</h2>
            <p>If you are searching for a new career opportunity, 
            you can <a href="#" style="text-decoration:none">search open vacancies and jobs.</a> 
            you can also <a href="#" style="text-decoration:none"> signup here</a> to be alerted of new jobs by email.
 </p>
          </div>
          <!--textabut-->
          
          <div class="textabut">
            <h2 class="textcandidate">are you a recruiter or employer?</h2>
            <p>If you are currently hiring, and  would like to advertise 
            your jobs on Wuzzuf.net, please <a href="#" style="text-decoration:none"> {{trans('app.signup')}}</a> for an employer account 
            and post your jobs right away. </p>
          </div>
          <!--textabut-->
          
          <div class="textabut">
            <h2 class="textcandidate">other inquiries?</h2>
            <p>if you have any other inquiries please contacts us <a href="/contact">  {{trans('app.here')}}</a> </p>
          </div>
          <!--textabut--> 
          
        </div>
        
        <!--//aboutusbox-->
        
        <div class="col-sm-3 aboutusbox"> <img src="images/callto-action.png"> </div>
        <!--//aboutusbox--> 
        
      </div>
      
      <!--row--> 
      
    </div>
    <!--inner-contacts--> 
    
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

@stop


