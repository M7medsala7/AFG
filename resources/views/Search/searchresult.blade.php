@extends('Layout.app')

@section('content')

<style type="text/css">
.hidden {
  display: none;
  visibility: hidden;
}

  .ineercompany {
    min-height: 350px;
  }
</style>
 @if(Session::get('locale')=="Ar"|| Session::get('locale')=="ar")
{{App::setLocale('ar')}}
@else
{{App::setLocale('en')}}
@endif
<section class="dashboard">
  <div class="container">
    <div class="row">
            @if($jobcheck !=0)
            <div class="col-sm-3 dashboardleft">
        <div class="inner-aboutus">
<input type="hidden" name="words" value={{$words}} id="words">
          <h2 class="textcandidate colormerg"> {{trans('app.filters')}}</h2>
       <input type="hidden" name="jobcheck" class="jobcheck" value="1" id="jobcheck">
                 <div class="filterbottom">
            <h4 class="contenttype"> {{trans('app.Job_Title')}} </h4>
            <ul class="divhidslid" id="myList">
              <li class="always">
               
                <label>
                  <input type="checkbox" name="Jobtitle" value="all"  class="checkboxalltow" onchange="Doaaasd()">
                  <span class="label-text">{{trans('app.all')}} </span> </label>
                  
              </li>
                @for($i=0;$i< count($jobtitle);$i++ )
             

              @if($i >= 3)

    <li class="hidden">
             <label>

                  <input type="checkbox" name="Jobtitle" value="{{$jobtitle[$i]->job->id}}" class="disabledtow" onchange="Doaaasd()">
                  <span class="label-text">{{$jobtitle[$i]->job->name}}</span> </label>
                  
              </li>
             

              @else
                 <li class="always">
             <label>

                  <input type="checkbox" name="Jobtitle" value="{{$jobtitle[$i]->job->id}}" class="disabledtow" onchange="Doaaasd()">
                  <span class="label-text">{{$jobtitle[$i]->job->name}}</span> </label>
                  
              </li>
               @endif

               @endfor
            </ul>
 <div class="show-more">
  <a href="#"> {{trans('app.Show_more')}}</a>
</div>
             </div>
          <!--filterbottom-->
          
          <div class="filterbottom">
            <h4 class="contenttype"> {{trans('app.employer_type')}}</h4>
            <ul class="divhidslid">
              <li class="always">
                <label>
                  <input type="checkbox" name="employertype" value="all" class="checkboxallthree"
                  onchange="Doaaasd()">
                  <span class="label-text"> {{trans('app.all')}}</span> </label>
              </li>
              @foreach($jobfor as $jobfo)
              <li class="always">
                <label>
                  <input type="checkbox" name="employertype" value ="{{$jobfo->job_for}}" class="disabledthree" onchange="Doaaasd()">
                  <span class="label-text"> {{$jobfo->job_for}}</span> </label>
              </li>

              @endforeach
             
             
            </ul>
          </div>
          <!--filterbottom-->



          
          <div class="filterbottom">
            <h4 class="contenttype"> {{trans('app.Desired_Location')}}</h4>
          <select class="form-control chosen-select types" name="country_id" id="country_id"  required=""  onchange="Doaaasd()">
                  <option selected=""  value="0"> {{trans('app.None')}}</option>
                   @foreach(\App\Country::all() as $country)
                      <option value="{{$country->id}}" name="country" id="country">{{$country->name}}</option>
                    @endforeach
                </select>
            <!--bfh-selectbox--> 
            
          </div>
          <!--filterbottom-->
          
          <div class="filterbottom">
            <h4 class="contenttype"> {{trans('app.experince')}}</h4>
            <ul class="divhidslid">
              <li class="always">
                <label>
                  <input type="checkbox"  name="experince" value="all" class="checkboxallfive" onchange="Doaaasd()">
                  <span class="label-text"> {{trans('app.all')}}</span> </label>
              </li>
              <li class="always">
                <label>
                  <input type="checkbox"  name="experince" value="1-2" class="disabledfive" onchange="Doaaasd()">
                  <span class="label-text"> 1-2</span> </label>
              </li>
              <li class="always">
                <label>
                  <input type="checkbox"  name="experince" value="2-3" class="disabledfive" onchange="Doaaasd()">
                  <span class="label-text"> 2-3 </span> </label>
              </li>
              <li class="always">
                <label>
                  <input type="checkbox"  name="experince" value="3-4" class="disabledfive" onchange="Doaaasd()">
                  <span class="label-text"> 3-4 </span> </label>
              </li>
              <li class="always">
                <label>
                  <input type="checkbox" name="experince" class="disabledfive">
                  <span class="label-text">
                  <input type="text" class="from-salary disabledfive" placeholder="from" name="fromexperince" id="fromexperince"  onchange="Doaaasd()" >
                  <input type="text" class="from-salary disabledfive" placeholder="to" name="toexperince" id="toexperince"  onchange="Doaaasd()">
                  </span> </label>
              </li>
            </ul>
           
            <!--hidebox-coun--> 
            
          </div>
          <!--filterbottom-->
          
          <div class="filterbottom">
            <h4 class="contenttype"> {{trans('app.salary')}}</h4>
        
            <!--currencytext-->
            
            <ul class="divhidslid">
              <li class="always">
                <label>
                  <input type="checkbox"  name="salary" value="all" class="checkboxallsix" onchange="Doaaasd()">
                  <span class="label-text"> {{trans('app.all')}}</span> </label>
              </li>
              <li class="always">
                <label>
                  <input type="checkbox"  name="salary" value="500-1000" class="disabledsix" onchange="Doaaasd()">
                  <span class="label-text"> 500-1000</span> </label>
              </li>
              <li class="always">
                <label>
                  <input type="checkbox"  name="salary" value="1000-5000" class="disabledsix" onchange="Doaaasd()">
                  <span class="label-text"> 1000-5000 </span> </label>
              </li>
              <li class="always">
                <label>
                  <input type="checkbox"  name="salary" value="5000-10000" class="disabledsix" onchange="Doaaasd()">
                  <span class="label-text"> 5000-10000 </span> </label>
              </li>
              <li class="always">
                <label>
                  <input type="checkbox" name="salary" class="disabledsix">
                  <span class="label-text">
                  <input type="text" class="from-salary disabledsix" placeholder="from" name="fromsalary" id="fromsalary" onchange="Doaaasd()">
                  <input type="text" class="from-salary disabledsix" placeholder="to" name="tosalary" id="tosalary" onchange="Doaaasd()">
                  </span> </label>
              </li>
            </ul>



                <div class="currencytext">
              <h5>currency</h5>

               <select class="form-control chosen-select types" name="currencyID" id="currencyID"  required=""  onchange="Doaaasd()">
                
                   @foreach(\App\Currency::all() as $Curren)
                      <option value="{{$Curren->id}}" name="currency" id="currency">{{$Curren->name}}</option>
                    @endforeach
                </select>



              
            </div>
          </div>
          <!--filterbottom--> 
          
        </div>
        <!--inner-aboutus--> 
        
      </div>
      <!--dashboardleft-->
     @else




      <div class="col-sm-3 dashboardleft">
        <div class="inner-aboutus">

          <h2 class="textcandidate colormerg"> {{trans('app.filters')}}</h2>

          <div class="filterbottom">
            <h4 class="contenttype">  {{trans('app.Job_Title')}}</h4>
            <ul class="divhidslid" id="myList">
              <li class="always">
               
                <label>
                  <input type="checkbox" name="Jobtitle" value="all" onchange="Doaaasd()"  class="checkboxall">
                  <span class="label-text"> {{trans('app.all')}}</span> </label>
                  
              </li>
                @for($i=0;$i< count($jobtitle);$i++ )
             

              @if($i >= 3)

    <li class="hidden">
             <label>

                  <input type="checkbox" name="Jobtitle" value="{{$jobtitle[$i]}}" onchange="Doaaasd()" class="disabled">
                  <span class="label-text">{{$jobtitle[$i]->job->name}}</span> </label>
                  
              </li>
             

              @else
                 <li class="always">
             <label>

                  <input type="checkbox" name="Jobtitle" value="{{$jobtitle[$i]->job->id}}" onchange="Doaaasd()" class="disabled">
                  <span class="label-text">{{$jobtitle[$i]->job->name}}</span> </label>
                  
              </li>
               @endif

               @endfor
            </ul>
 <div class="show-more">
  <a href="#">Show more</a>
</div>
             </div>
          <!--filterbottom-->
          
       <div class="filterbottom">
            <h4 class="contenttype"> {{trans('app.Nationality')}}</h4>
          <select class="form-control chosen" name="nationality_id" id="nationality_id"  required=""  onchange="Doaaasd()">
                  <option selected=""  value="0">None</option>
                   @foreach(\App\Nationality::all() as $nationality)
                      <option value="{{$nationality->id}}" name="nationality" id="nationality">{{$nationality->name}}</option>
                    @endforeach
                </select>
            <!--bfh-selectbox--> 
            
          </div>
          <!--filterbottom-->



          
          <div class="filterbottom">
            <h4 class="contenttype"> {{trans('app.Candidate_Location')}}</h4>
          <select class="form-control chosen" name="country_id" id="country_id"  required=""  onchange="Doaaasd()">
                  <option selected=""  value="0">None</option>
                   @foreach(\App\Country::all() as $country)
                      <option value="{{$country->id}}" name="country" id="country">{{$country->name}}</option>
                    @endforeach
                </select>
            <!--bfh-selectbox--> 
            
          </div>
          <!--filterbottom-->
          

          <!--filterbottom-->
          
          <div class="filterbottom">
            <h4 class="contenttype"> {{trans('app.salary')}}</h4>
            <div class="currencytext">
        
            <!--currencytext-->
            
            <ul class="divhidslid">
              <li class="always">
                <label>
                  <input type="checkbox"  name="salary" value="all"  class="checkboxallfor" onchange="Doaaasd()">
                  <span class="label-text"> {{trans('app.all')}}</span> </label>
              </li>
              <li class="always">
                <label>
                  <input type="checkbox"  name="salary" value="500-1000" class="disabledfor" onchange="Doaaasd()">
                  <span class="label-text"> 500-1000</span> </label>
              </li>
              <li class="always">
                <label>
                  <input type="checkbox"  name="salary" value="1000-5000" class="disabledfor" onchange="Doaaasd()">
                  <span class="label-text"> 1000-5000 </span> </label>
              </li>
              <li class="always">
                <label>
                  <input type="checkbox"  name="salary" value="5000-10000" class="disabledfor" onchange="Doaaasd()">
                  <span class="label-text"> 5000-10000 </span> </label>
              </li>
              <li class="always">
                <label>
                  <input type="checkbox" name="salary" class="disabledfor">
                  <span class="label-text">
                  <input type="text" class="from-salary disabledfor" placeholder="from" name="fromsalary" id="fromsalary"  onchange="Doaaasd()">
                  <input type="text" class="from-salary disabledfor" placeholder="to" name="tosalary" id="tosalary" onchange="Doaaasd()">
                  </span> </label>
              </li>
            </ul>

                  <h5>  {{trans('app.currency')}}</h5>

               <select class="form-control chosen" name="currencyID" id="currencyID"  required=""  onchange="Doaaasd()">
              
                   @foreach(\App\Currency::all() as $Curren)
                      <option value="{{$Curren->id}}" name="currency" id="currency">{{$Curren->name}}</option>
                    @endforeach
                </select>



              
            </div>
          </div>
          <!--filterbottom--> 




            <div class="filterbottom">
            <h4 class="contenttype"> {{trans('app.Skills')}}</h4>
          <select class="form-control chosen" name="skills_id" id="skills_id"  required=""  onchange="Doaaasd()">
                  <option selected=""  value="0">None</option>
                   @foreach(\App\Skills::all() as $skills)
                      <option value="{{$skills->id}}" name="skills" id="skills">{{$skills->name}}</option>
                    @endforeach
                </select>
            <!--bfh-selectbox--> 
            
          </div>


               <div class="filterbottom">
            <h4 class="contenttype"> {{trans('app.Video')}}</h4>
     
             <select class="form-control chosen" name="video" id="video"  required=""  onchange="Doaaasd()">
                <option selected=""  value="all"> {{trans('app.all')}}</option>
                  <option   value="0">None </option>
                     <option value="1">With Video</option>
                </select>
            
          </div>
          
        </div>
        <!--inner-aboutus--> 
        
      </div>
      <!--dashboardleft-->


      @endif
       <div class="rowemp">
          @include('Search.searchpartial')
      
        </div>
        <!--inner-aboutus--> 
        
      </div>

      
      <!--dashboardleft--> 
      
  
  
  <!--container--> 
  
</section>
<!--section-->

<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">  {{trans('app.Watch_Video')}}
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="textbox" id="v1">
      
      </div>
      <!--textbox--> 
      
    </div>
  </div>
</div>
<!--myModal-->
@endsection


@section('scripts')

<script>
   $(function(){
    $('header').addClass('header-in');
  });
</script>
<script type="text/javascript">

  $(document).ready(function () {
   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
 
      



});
   $(".types").chosen({ 
                   width: '100%',
                   color:'red',
                   no_results_text: "No Results",
                   allow_single_deselect: true, 
                   search_contains:true, });
 $(".types").trigger("chosen:updated");
 
$(document).on("click", ".show-more a", function(e) {
    e.preventDefault();
    if($(this).text() == "Show more"){
        $(this).text("Show less")
        $('li.hidden').removeClass('hidden')
    } else {
        $(this).text("Show more")
        $('li:not(.always)').addClass('hidden')
    };

    $this.text(linkText);
});



  function Doaaasd()
  {

        $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
                getJobs(page);
            }
        }
    });
    $(document).ready(function() {
        $(document).on('click', '.pagination a', function (e) {
          getJobs($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
    });


     var jobcheck= $('#jobcheck').val();
 var words= $('#words').val();

  var jobs = $('input:hidden.jobs').serialize();







var Jobtitle = [];
   $("input:checkbox[name='Jobtitle']:checked").each(function() {

   Jobtitle.push($(this).val());

});

 var candidate = [];
   $("input:hidden.candidate").each(function() {

   candidate.push($(this).val());

});
    
 var employertype = [];
   $("input:checkbox[name='employertype']:checked").each(function() {

   
   employertype.push($(this).val());

});

 var salary = [];
   $("input:checkbox[name='salary']:checked").each(function() {


   salary.push($(this).val());

});


   var experince = [];
   $("input:checkbox[name='experince']:checked").each(function() {


   experince.push($(this).val());

});



        var fromsalary= $("#fromsalary").val();
 var tosalary= $('#tosalary').val();
 var fromexperince= $("#fromexperince").val();
 var toexperince= $('#toexperince').val();



var country=$('#country_id').find(":selected").val();   //tested in Chrome, safar, FF.

var currency=$('#currencyID').find(":selected").val(); 

var nationality=$('#nationality_id').find(":selected").val(); 

var skills=$('#skills_id').find(":selected").val(); 

var video=$('#video').find(":selected").val(); 
 console.log(country);

     Jobtitle=JSON.stringify(Jobtitle);
      candidate=JSON.stringify(candidate);
      employertype=JSON.stringify(employertype); 
      salary=JSON.stringify(salary); 
     experince=JSON.stringify(experince); 
      

var dataString = "Jobtitle="+Jobtitle+"&country="+country+"&jobcheck="+jobcheck+"&words="+words+"&employertype="+employertype+"&salary="+salary+"&fromsalary="+fromsalary+"&tosalary="+tosalary+"&currency="+currency+"&experince="+experince+"&fromsexperince="+fromexperince+"&toexperince="+toexperince+"&nationality="+nationality+"&skills="+skills+"&video="+video;

    $.ajax({
      url: '/filtersearch',
        type: 'POST',
    
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
               data:dataString,

  
           success:function(response)
            {
                            
            $('#myPartialDiv').html(response);
          


            // $('#asd').hidden=fal
         
             
        }
   });
 }

     

</script>
<Script>
function ShowVideo($id,$type)
{
  console.log($id);
  $typeM='video/'+$type;
var int="";
$("#v1").html('');

$("#v1").html('<video style="text-align: center;width: 100%;" controls><source src="'+$id+'" type='+$typeM+'></source></video>' );

 $('#myModal').modal('show');
}

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


<script type="text/javascript" src="/js/slick.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
   
@stack('part')

@endsection


