@extends('Layout.app')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
@if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
@endif
 @if(Session::get('locale')=="Ar"|| Session::get('locale')=="ar")
{{App::setLocale('ar')}}
@else
{{App::setLocale('en')}}
@endif
@if(Session::has('flash'))
    <div class="alert alert-success">

    you employer,you must register as candidate<a href="/logoutandregister">  Register Now</a>
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
@endif

<style>
 .ineercompany {
    min-height: 350px;
  }
.select2 select2-container select2-container--default select2-container--below{
width:100%;
}
  .select2-selection__rendered{

    background: rgba(115, 115, 115, 0.48)!important;
    border: 1px solid rgba(115, 115, 115, 0.48)!important;
    float: left;
    width: 100%;
    height: 40px;
    border-radius: 5px;
    /* border: 0; */
    box-shadow: none;
    border: 2px solid #d7d7d7;
    margin-top: 10px;
    color: rgba(0,0,0,0.7)!important;;
  }

  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 57px!important;}
  .select2-container .select2-selection--single
  {
    height: 0px!important;
  }
  .select2-container--default .select2-selection--single{    background-color: 0!important;border: 0!important}
  .watchvideo img{
    height: 20%!important;
  }



.derright{ float:right;}
.derleft{ float:left;}
.select2 select2-container select2-container--default{
width: 100%;
}
 ul li {
    margin: 0;
    padding: 0;
    border: 0;
    text-decoration: none;
   list-style-position: inside;
    list-style-type: disc;
    list-style-image: none;
    font: 15px/25px 'NeoSansArabic';
    color: #494949;
    text-transform: none;
    text-transform: capitalize;
}
  ol li {
    margin: 0;
    padding: 0;
    border: 0;
    text-decoration: none;
   list-style-position: inside;
    list-style-type: decimal;
    list-style-image: none;
    font: 15px/25px 'NeoSansArabic';
    color: #494949;
    text-transform: none;
    text-transform: capitalize;
}
}
</style>
<section class="dashboard">
  <div class="container">
    <div class="row"> 
      
      <!--dashboardleft-->
      
      <div class="col-sm-8 comprofleft derright">
        <div class="inner-aboutus">
          <div class="com-proftow companychool imgprof"> <img src="/images/callto-action.png">
            <div class="comitm">
            <h5 class="textcandidate">{{($job->job)?$job->job->name:""}}</h5>



<a class="like like_button" href="/likejob/{{$job->id}}">
@if($color=='black')
<i class="fas fa-heart" style="font-size: 1.5em;"></i> 
@endif
@if($color=='red')
<i class="fas fa-heart" style="font-size: 1.5em;color:red"></i> 
@endif
</a>

               <ul class="hassle salary">
                <li> <strong>Country.</strong>{{($job->country)?$job->country->name:""}} </li>
                <li> <strong>posted</strong> <span class="timetext"><i class="far fa-clock"></i> posted</span> <span class="timetext"><i class="far fa-eye"></i> 10 views</span></li>
                @if($job->min_salary !=null && $job->max_salary !=null)
                      <li> <strong>salary.</strong>{{($job->min_salary)?number_format($job->min_salary):"0"}}:{{($job->max_salary)?number_format($job->max_salary):"0"}}{{($job->Currency)?$job->Currency->name:""}}</li>
              @else
              <li> <strong>salary.</strong>{{($job->max_salary)?number_format($job->max_salary):"0"}}{{($job->Currency)?$job->Currency->name:""}}</li>
              @endif
              
              
              <li>Powered by :{{$job->job_for}} </li>
              </ul>
              <div class="cenbottom seejobs linkappley"> 
              @if($Applied == 0)
               <a href="#" data-toggle="modal" data-target="#myModal" class="largeredbtn"> {{trans('apply_now')}}</a> 
              @else
               <a href="#"  class="largeredbtn" disable="disable">Applied</a> 
              @endif
             
              
              @if(\Auth::user()==null || \Auth::user()=="")

<a href="/applyWithoutRegestration/{{$job->id}}" class="largeredbtn">{{trans('apply_without')}}</a>
 @endif
 </div>
            </div>
            <!--comitm--> 
            
          </div>
          <!--com-proftow--> 
          
        </div>
        <!--inner-aboutus-->
        
        <div class="inner-aboutus secshbox">
          <div class="com-proftow aboutcompany discription">
            <h5 class="textcandidate"> {{trans('app.job_discription')}}:</h5>
            <p class="textabout">
                {!!html_entity_decode($job->job_descripton)!!}
                
                
                <!--{{($job->job_descripton)?:"job discription is not set"}}-->
                </p>
          </div>
          <!--aboutcompany-->
          
          <div class="com-proftow aboutcompany discription">
            <h5 class="textcandidate"> {{trans('app.job_Requirements')}} : </h5>
            <p class="textabout">{{($job->job_requirements)?$job->job_requirements :"job Requirements is not set"}} </p>
          </div>
          <!--aboutcompany-->
          
          <div class="com-proftow aboutcompany discription">
            <h5 class="textcandidate"> {{trans('app.industry')}}: </h5>
            <p class="textabout">{{($job->Industry)?$job->Industry->name:"Industry is not set"}}</p>
          </div>
          <!--aboutcompany-->
          
          <div class="com-proftow aboutcompany discription">
            <h5 class="textcandidate"> {{trans('app.skills')}}:</h5>
            <p class="textabout">
            @if($Skilljob ==null || $Skilljob =="")
            <nav class="driver">
            <a>No skills yet</a>
            </nav>
            @else
            <nav class="driver">
            @foreach($Skilljob as $skill)
            <a>{{$skill->name}}</a>
            @endforeach
           </nav>
            @endif
            
        </p>
          </div>
          <!--aboutcompany-->
          
          <div class="com-proftow aboutcompany discription">
            <h5 class="textcandidate"> {{trans('app.salary')}}: </h5>
            <p class="textabout">{{($job->min_salary)?number_format($job->min_salary):"0"}}:{{($job->max_salary)?number_format($job->max_salary):"0"}}</p>
          </div>
          <!--aboutcompany-->
          
          <div class="cenbottom seejobs linkappley flotingbot"> 
         @if(\Auth::user()==null || \Auth::user()=="")

          <a href="/applyWithoutRegestration/{{$job->id}}" class="largeredbtn">{{trans('app.apply_without')}}</a> 
         @endif
          <a href="#" data-toggle="modal" data-target="#myModal" class="largeredbtn">apply</a> </div>
          <div class="com-proftow aboutcompany discription">
            <h5 class="textcandidate"> {{trans('app.About_company')}}:</h5>
            <p class="textabout">{{($job['user']['company']['description'])?$job['user']['company']['description']:"No Description"}}</p>
          </div>
          <!--aboutcompany-->
          
          <div class="aboutcompany discription">
            <h5 class="textcandidate"> {{trans('app.more_jobs_from_company')}}:</h5>
            <div class="row">
            @foreach($jobforcompany as $Compjob)
             
             <div class="col-sm-4 morecompany">
               <div class="ineercompany nonbordimg">
                 <div class="tidiv"> <img src="/images/callto-action.png"> <span> {{$Compjob->job_for}} </span></div>
                 <!--tidiv-->
                 
                 <h4 class="innertitltext nameviwjobs">{{$Compjob['user']['name']}} </h4>
                 <p class="officer">{{($Compjob->job)?$Compjob->job->name:""}}</p>
                 <ul class="hassle salary">
                   <li> <strong>{{($Compjob->country)?$Compjob->country->name:""}}.</strong> </li>
                   <li> <strong>salary.</strong>{{number_format(($Compjob->min_salary))?number_format($Compjob->min_salary):"0"}}:{{number_format(($job->max_salary))
                     ?number_format($job->max_salary):"0"}}{{($Compjob->Currency)?$Compjob->Currency->name:""}}</li
                      
                 </ul>
                 <div class="tidivbotom"> <a href="" data-toggle="modal" data-target="#myModal">{{trans('app.apply_now')}}</a> <span>{{$Compjob->created_at}}</span></div>
                 <!--tidiv--> 
                 
               </div>
               <!--inernews--> 
               
             </div>
            @endforeach
              
             
              
              
            </div>
            <!--row-->
            
   
          </div>
          <!--aboutcompany-->
          
          <div class="aboutcompany discription">
          
            <h5 class="textcandidate">{{(\Auth::user())?(\Auth::user()->name):''}}</h5>
            <div class="row">
            @if($jobCan !=null)
            @foreach($jobCan as $Conjob)
              <div class="col-sm-4 morecompany">
                <div class="ineercompany nonbordimg">
                  <div class="tidiv"> <img src="/images/titlewebs.png"> <span> {{$Conjob->job_for}} </span></div>
                  <!--tidiv-->
                  
                  <h4 class="innertitltext nameviwjobs"> <span> {{$Conjob['user']['name']}}</span> </h4>
                  <p class="officer">{{($Conjob->job)?$Conjob->job->name:"No Job"}}</p>
                  <ul class="hassle salary">
                  <li> <strong>{{($Conjob->country)?$Conjob->country->name:""}}.</strong> </li>
                    <li> <strong>salary.</strong> {{number_format(($Conjob->min_salary))?number_format($Conjob->min_salary):"0"}}:{{number_format(($Conjob->max_salary))?number_format($Conjob->max_salary):"0"}} {{($Conjob->Currency)?$Conjob->Currency->name:" No Currency"}}</li>
                 
                  </ul>
                  <div class="tidivbotom"> <a href="" data-toggle="modal" data-target="#myModal"> {{trans('app.apply_now')}}</a> <span>12 march 2018</span></div>
                  <!--tidiv--> 
                  
                </div>
                <!--inernews--> 
                
              </div>
              <!--morecompany-->
              @endforeach
              @endif
            
              
            </div>
            <!--row--> 
            
          </div>
          <!--aboutcompany--> 
          
        </div>
        <!--inner-aboutus--> 
        
      </div>
      
      <!--dashboardleft-->
      
      <div class="col-sm-4 dashboardleft derleft">
        <div class="inner-aboutus topmergline padbotnm">
          <div class="com-proftow aboutcompany">
            <h5 class="textcandidate"> {{trans('app.About_company')}}</h5>
            <p class="textabout">{{($job['user']['company']['description'])?$job['user']['company']['description']:"No Description"}}</p>
          </div>
          
          <!--aboutcompany-->
          






          <div class="paboxs">
            <h5 class="textcandidate"> {{trans('app.similar_jobs')}}:</h5>
           
            
            <!--ineercompany-->
            @if($job->getSimilarJobsAttribute())
            @foreach($job->getSimilarJobsAttribute() as $sJob)
            <div class="ineercompany nonbordimg">
              <div class="tidiv"> <img src="/images/callto-action.png"> <span> {{$sJob->job_for}} </span></div>
              <!--tidiv-->
              
              <h4 class="innertitltext nameviwjobs">{{$sJob['user']['name']}} <span>{{$sJob->job->name}}</span> </h4>
             
              <p class="officer">{{($sJob->job)?$sJob->job->name:""}}</p>
              <ul class="hassle salary">
                <li> <strong>loc.</strong> {{$sJob->country->name}}</li>
                <li> <strong>salary.</strong> {{number_format(($sJob->min_salary))?number_format($sJob->min_salary):"0"}}:{{number_format(($sJob->max_salary))?number_format($sJob->max_salary):"0"}} {{($job->Currency)?$job->Currency->name:""}}</li>
              </ul>
              <div class="tidivbotom"> <a href="" data-toggle="modal" data-target="#myModal"> {{trans('app.apply_now')}}</a> <span>{{$sJob->created_at}}</span></div>
              <!--tidiv--> 
              
            </div>
            
            @endforeach
               @endif
            
            <!--ineercompany-->
            
           
            
            <!--ineercompany--> 
            
          </div>
          <!--paboxs--> 
          
        </div>
        <!--inner-aboutus--> 
        
      </div>
    </div>
    <!--row--> 
    
  </div>
  
  <!--container--> 
  
</section>
<!--section-->
<div id="myModal" class="modal fade in" aria-hidden="false"  >
  <div class="modal-dialog popvad"  >
    <div class="modal-content" >
      <button type="button" class="close" data-dismiss="modal">X</button>
      <div class="col-sm-6 chancevedio">
        <div class="linksing" > did you know that your <span class="nambers">chance</span> will be increased <span class="nambers">9</span> times when
          employer watch your video </div>
        <label class="airports personal-in">
          <input type="radio" name="radio">
          <span class="label-text">   {{trans('app.record_your')}}<a href="/ApplyOk" class="termsagreements"> {{trans('app.video_now')}}</a> </span> </label>
        <div class="witbot"> <a href="/ApplyOk" class="largeredbtn">yes </a> <a href="/ApplyJob/{{$job->id}}" class="largeredbtn back"> later</a> </div>
      </div>
      <!--chancevedio-->
      
      <div class="col-sm-6 chancevedio">
       <iframe width="660" height="355" src="https://www.youtube.com/embed/_I4AxpE5byE" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
      </div>
      <!--chancevedio--> 
      
    </div>
  </div>
</div>
<!--modal-->

<div id="myModa2" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> The first form: candidate form ” without registration“
        <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
      <div class="textbox">
        <form action="#" method="" class="formlogin video-rc">
          <div class="divwits merginbot"> 
            <!--<label class="desired">Desired job</label>-->
            <select class="form-control requirments" name="job_id" style="width:100%" id="job_id" required=""  >
                   <option selected="" disabled="disabled" >desired job</option>
                    @foreach(\App\Job::all() as $job)
                      <option value="{{$job->id}}">{{$job->name}}</option>
                    @endforeach
            </select>
          </div>
          <div class="divwits merginbot"> 
            

              <select class="form-control requirments" name="industry_id" style="width:100%" id="industry_id" required="" >
                  <option selected="" disabled="disabled" >desired industry</option>
                    @foreach(\App\Industry::all() as $ind)
                      <option value="{{$ind->id}}" >{{$ind->name}}</option>
                    @endforeach
                </select>
                </div>

          <!--divwits-->
          <div class="divwits merginbot"> 
            
          <select class="form-control requirments" name="nationality_id" id="nation_id" required="" style="width:100%"  onblur="processForm(this.form)">
                  <option selected="" disabled="disabled">Nationality</option>
                  @foreach(\App\Nationality::all() as $nation)
                    <option value="{{$nation->id}}" >{{$nation->name}}</option>
                  @endforeach
                </select>
          </div>
          <!--divwits-->
          
          <div class="divwits merginbot"> 
            <!--<label class="desired">Current location</label>-->
            <select class="form-control requirments" name="country_id" id="country_id" style="width:100%" required="" onblur="processForm(this.form)">
                  <option selected="" disabled="" > {{trans('app.desired_location')}}</option>
                   @foreach(\App\Country::all() as $country)
                      <option value="{{$country->id}}" >{{$country->name}}</option>
                    @endforeach
                </select>
          </div>
          <!--divwits-->
          
          <div class="divwits merginbot"> 
           <select class="form-control " id="city_id" name="city_id" style="width:100%">
             <option selected="" disabled="disabled">Select City</option>
           </select>
          </div>
          <div class="divwits merginbot"> 
            <!--<label class="desired">Full name</label>-->
            <input type="text" class="form-control requirments" name="name" placeholder=" Full name">
          </div>
          <!--divwits-->
          
          <div class="divwits merginbot"> 
            <!--<label class="desired">Email</label>-->
            <input type="email" class="form-control requirments" name="email" placeholder=" Email">
          </div>
          <!--divwits-->
          
          <div class="divwits merginbot"> 
            <!--<label class="desired">Phone no</label>-->
            <input type="number" class="form-control requirments" name="phone" placeholder=" Phone no">
          </div>
          <!--divwits-->
          
          <div class="divwits merginbot"> 
            <!--<label class="desired">Upload picture</label>-->
            <input type="file" class="form-control requirments" placeholder="Upload picture">
          </div>
          <!--divwits-->
          
          <div class="divwits merginbot">
            <div class="row">
              <div class="col-sm-6 record-ve">
                <button type="submit" class="largeredbtn"> <i class="fas fa-video"></i> record Video</button>
              </div>
              <div class="col-sm-6 record-ve">
                <button type="submit" class="largeredbtn"> <i class="fas fa-upload"></i> upload Video</button>
              </div>
            </div>
            <!--row--> 
            
          </div>
          <!--divwits-->
          
          <div class="divwits textbot">
            <button type="submit" class="largeredbtn"> send</button>
          </div>
          <!--divwits-->
          
        </form>
      </div>
      <!--textbox--> 
      
    </div>
  </div>
</div>
<!--modal-->




@endsection

@section('scripts')

<script>
  populateCountries("country_id", "city_id"); 
  // first parameter is id of country drop-down and second parameter is id of state drop-down
</script>
<script type="text/javascript">
   $(function(){
    $('header').addClass('header-in');
  });
  
    $(document).ready(function(){
      $('#job_id').select2();
    $('#industry_id').select2();
    $('#country_id').select2();
    $('#nation_id').select2();
$('#city_id').select2();
    });
</script>
@endsection




