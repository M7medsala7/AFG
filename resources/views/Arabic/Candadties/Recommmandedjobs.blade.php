
        <div class="inner-aboutus">
          <div class="currencytext resultstext">
            <h2>recommended jobs</h2>
            <a href="/EditCandidate/{{(\Auth::user()->id)}}" class="prefrnces">edit job prefrnces <i class="fas fa-pencil-alt"></i></a> </div>
          <!--resultstext-->
          
          <div class="row">
            <div class="col-sm-8 leftdshbord">
              <div class="row">
                 @foreach($RecommandJobs  as $val)
                <div class="col-sm-6 company com-dashboard">
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

                       @endforeach
                <!--com-dashboard-->
          
              <div style="margin-left:40%;">
   
          </div> 
    
                
              </div>
              <!--row--> 
              
            </div>
            <!--leftdshbord-->
            
            <div class="col-sm-4 leftdshbord" id="map" style=" width: 30%; height: 120%;margin-top: 20px;">
           
              
            </div>
            <!--leftdshbord--> 
            
          </div>
          <!--row-->
          
         
       