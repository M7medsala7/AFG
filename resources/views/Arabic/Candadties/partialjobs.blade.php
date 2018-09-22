<div class="row" style="margin-left:3%;" > 
        @foreach($MatchingJobs  as $val)
        <div class="col-sm-4 company com-dashboard" style="width:325px;">
          <div class="ineercompany">
            <div class="tidiv"> <img src="images/car1.jpg"> <span> {{$val->job_for}}</span></div>
            <!--tidiv-->
           
            <p class="officer">{{$val->job->name}}</p>
            <ul class="hassle salary">
               <li> <strong>loc.</strong>{{$val->country->name}} </li>
              <li> <strong>salary.</strong>{{number_format($val->min_salary)}}-{{number_format($val->max_salary)}} {{($val->Currency)?$val->Currency->name:"Currency is not set"}}</li> 
            </ul>
            <div class="tidivbotom"> <a href="/ViewJob/{{$val->id}}">apply now</a> <span>{{$val->created_at}}</span></div>
            <!--tidiv--> 
            
          </div>
          <!--inernews--> 
          
        </div>
        <!--com-dashboard-->
     
   @endforeach
   <div style="margin-left:40%;">
      {{$MatchingJobs->links()}} 
      </div> 
  </div>