<div id ="myPartialDiv" class="rowemp">
 <div class="col-sm-9 dashboardleft" >
        <div class="inner-aboutus">
          <div class="currencytext resultstext">
            <h2>{{$count}} results {{$words}}</h2>
            <div class="rightselect">
              <p>sort by : </p>
              <select class="select-currency" name="birth_date" required="">
                <option selected="">most recent</option>
                <option value="4">most recent</option>
                <option value="4">most recent</option>
              </select>
            </div>
            <!--rightselect--> 
            
          </div>
          <!--resultstext-->
           <input type="hidden" name="words" value={{$words}} id="words">
                @if($jobcheck !=0)

          <div class="rowemp" style="min-height:360px">
           
      
        
            
           @foreach($jobs  as $job)
 <input type="hidden" name="jobcheck" class="jobcheck" value="1" id="jobcheck">
            
             <input type="hidden" name="jobs[]" class="jobs" value="{{$job->id}}" id="jobs">
            <div class="col-sm-4 company com-dashboard">
              <div class="ineercompany" style="min-height:350px">
                <div class="tidiv"> <img src="images/car1.jpg"> <span>{{$job->job_for}}</span></div>
                <!--tidiv-->
                
                <h4 class="innertitltext">{{($job->user)?$job->user->name:"No User"}}</h4>
                <p class="officer">{{$job->job->name}}</p>
                <ul class="hassle salary">
                  <li> <strong>loc.</strong> {{$job['country']['name']}}</li>
                  @if($job->min_salary !=null && $job->max_salary !=null)
                                  <li> <strong>salary.</strong>{{number_format($job->min_salary)}}-{{number_format($job->max_salary)}} {{($job->Currency)?$job->Currency->name:"Currency is not set"}}</li> 
                 @else
                 <li> <strong>salary.</strong>{{number_format($job->max_salary)}} {{($job->Currency)?$job->Currency->name:"Currency is not set"}}</li> 
               @endif
                </ul>
             
                <a href="https://www.facebook.com/dialog/share?
app_id=1112718265559949
&display=popup
&title='maid and helper'
&description='Mohamed salah'
&quote={{$job->job_descripton}}
&caption='Dody'
&href=https://www.maidandhelper.com/ViewJob/{{$job->id}}

&redirect_uri=https://www.facebook.com/"><i class="fas fa-share-alt"></i></a>
                <div class="tidivbotom"> <a href= '/ViewJob/{{$job->id}}"' >View job</a> <span>{{$job->created_at}}</span></div>
                <!--tidiv--> 
                
              </div>
              <!--inernews--> 
              
            </div>
            @endforeach
            <!--com-dashboard--> 
            <div style="margin-left:24%;">
              {!! $jobs->appends(Request::capture()->except('page'))->links() !!}





          </div>
          </div>
          <!--row-->


                     @else

   
    <div class="row">
           @foreach($candidates  as $candidate)

           <input type="hidden" name="candidate[]" class="candidate" value="{{$candidate->CanId}}" id="candidate">
               <div class="col-sm-4  company com-dashboard">
                
        
          
  <div  style="min-height:300px"> 

 @if($candidate->vedio_path !=null)
 <a   class="imgbox" onclick="ShowVideo('/{{$candidate->vedio_path}}','{{File::extension($candidate->vedio_path)}}')"> 
   
  
   <img src="{{($candidate->user->logo)?$candidate->user->logo:'images/4.jpg'}}" >
   <i class="fas fa-play"></i> 
    </a>
   
 @endif
  @if($candidate->vedio_path ==null)
  <a   class="imgbox">
    <img src="{{($candidate->user->logo)?$candidate->user->logo:'images/4.jpg'}}" >
    </a>
     @endif
          <div class="padboxs"> <span class="eyeicons"><i class="fas fa-eye"></i> 20,215</span> <span class="eyeicons"><i class="fas fa-flag"></i> 20,215</span>
            <h4 class="innertitltext">{{$candidate->user->name}}</h4>
            <p class="officer">{{$candidate->job->name}}</p>
            <ul class="hassle salary">
              
             <li>{{($candidate->nationality)?$candidate->nationality->name:"Nationality is not set"}}</li>
            </ul>
            <a href="https://www.facebook.com/dialog/share?
app_id=1112718265559949
&display=popup
&title='maid and helper'
&description='Mohamed salah'
&quote={{$candidate->user->name}}:{{$candidate->descripe_yourself}}
&caption='Dody'
&href=https://www.maidandhelper.com/candidate/{{$candidate->user->id}}

&redirect_uri=https://www.facebook.com/"><i class="fas fa-share-alt"></i></a>
            <div class="tidivbotom">  <a href="/candidate/{{$candidate->user->id}}">view profile</a> <span>{{$candidate->created_at}}</span></div>
            <!--tidiv--> 
            
            

          <!--padboxs--> 
          
        </div>
        <!--inernews--> 
        
      </div>
      </div>
             @endforeach
             <div class="cenbottom nomergbotm">  {!! $candidates->appends(Request::capture()->except('page'))->links() !!} </div>
            @endif
            </div>
        
          
         
        </div>
        <!--inner-aboutus--> 
        
      </div>
      </div>
@push('part')
          <script>

         $(function() {
    $('body').on('click', '.pagination a', function(e) { 
        e.preventDefault(); 

        var url = $(this).attr('href'); 
    
        getJobs(url);

      
    });
    function getJobs(url) {
        $.ajax({
          
            url : url
        }).done(function (data) {
         
           $('#myPartialDiv').html(data);
           location.hash;
        }).fail(function () {
            alert('Data could not be loaded.');
        });
    }
});


    </script>




    @endpush