<div class="row" >
          @foreach($MatchingJos  as $val)
                <div class="col-sm-4 company com-dashboard">
                  <div class="ineercompany">
                    <div class="tidiv"> <img src="images/car1.jpg"> <span> {{$val->job_for}}</span></div>
                    <!--tidiv-->
                    
                    <h4 class="innertitltext">{{$val->user->name}} </h4>
                    <p class="officer">{{$val->job->name}}</p>
                    <ul class="hassle salary">
                       <li> <strong>loc.</strong>{{$val->country->name}} </li>
                <li> <strong>salary.</strong>{{$val->min_salary}}-{{$val->max_salary}} {{($val->Currency)?$val->Currency->name:"Currency is not set"}}</li> 
                    </ul>
                    <div class="tidivbotom"> <a href="#">apply now</a> <span>{{$val->created_at}}</span></div>
                    <!--tidiv--> 
                    
                  </div>
                  <!--inernews--> 
                  
                </div>

                       @endforeach
                       {{$MatchingJos->links()}}
          </div>