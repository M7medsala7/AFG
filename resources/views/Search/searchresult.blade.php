@extends('Layout.Master')

@section('content')
<section class="dashboard">
  <div class="container">
    <div class="row">
      <div class="col-sm-3 dashboardleft">
        <div class="inner-aboutus">
          <h2 class="textcandidate colormerg">filters</h2>
          <div class="filterbottom">
            <h4 class="contenttype">content type </h4>
            <ul class="divhidslid">
              <li>
                <label>
                  <input type="checkbox" name="check">
                  <span class="label-text">all</span> </label>
              </li>
              <li>
                <label>
                  <input type="checkbox" name="check">
                  <span class="label-text"> jobs</span> </label>
              </li>
              <li>
                <label>
                  <input type="checkbox" name="check">
                  <span class="label-text"> Candidates </span> </label>
              </li>
              <li>
                <label>
                  <input type="checkbox" name="check">
                  <span class="label-text"> Employers </span> </label>
              </li>
            </ul>
          </div>
          <!--filterbottom-->
          
          <div class="filterbottom">
            <h4 class="contenttype">employer type </h4>
            <ul class="divhidslid">
              <li>
                <label>
                  <input type="checkbox" name="check">
                  <span class="label-text">all</span> </label>
              </li>
              <li>
                <label>
                  <input type="checkbox" name="check">
                  <span class="label-text"> family</span> </label>
              </li>
              <li>
                <label>
                  <input type="checkbox" name="check">
                  <span class="label-text"> company </span> </label>
              </li>
              <li>
                <label>
                  <input type="checkbox" name="check">
                  <span class="label-text"> agency </span> </label>
              </li>
            </ul>
          </div>
          <!--filterbottom-->
          
          <div class="filterbottom">
            <h4 class="contenttype">cuntry </h4>
            <ul class="divhidslid">
              <li>
                <label>
                  <input type="checkbox" name="check">
                  <span class="label-text">all</span> </label>
              </li>
              <li>
                <label>
                  <input type="checkbox" name="check">
                  <span class="label-text"> uae</span> </label>
              </li>
              <li>
                <label>
                  <input type="checkbox" name="check">
                  <span class="label-text"> saudi arabia </span> </label>
              </li>
              <li>
                <label>
                  <input type="checkbox" name="check">
                  <span class="label-text"> oman</span> </label>
              </li>
            </ul>
            <div class="hidebox-coun"> <span class="skiplink"> more countries</span>
              <ul class="divhidslid hidecountries">
                <li>
                  <label>
                    <input type="checkbox" name="check">
                    <span class="label-text">all</span> </label>
                </li>
                <li>
                  <label>
                    <input type="checkbox" name="check">
                    <span class="label-text"> uae</span> </label>
                </li>
                <li>
                  <label>
                    <input type="checkbox" name="check">
                    <span class="label-text"> saudi arabia </span> </label>
                </li>
                <li>
                  <label>
                    <input type="checkbox" name="check">
                    <span class="label-text"> oman</span> </label>
                </li>
              </ul>
            </div>
            <!--hidebox-coun--> 
            
          </div>
          <!--filterbottom-->
          
          <div class="filterbottom">
            <h4 class="contenttype">industry </h4>
            <ul class="divhidslid">
              <li>
                <label>
                  <input type="checkbox" name="check">
                  <span class="label-text">all</span> </label>
              </li>
              <li>
                <label>
                  <input type="checkbox" name="check">
                  <span class="label-text"> manufacturing</span> </label>
              </li>
              <li>
                <label>
                  <input type="checkbox" name="check">
                  <span class="label-text"> production </span> </label>
              </li>
              <li>
                <label>
                  <input type="checkbox" name="check">
                  <span class="label-text"> transportaion</span> </label>
              </li>
            </ul>
            <div class="hidebox-coun"> <span class="skiplink"> more countries</span>
              <ul class="divhidslid hidecountries">
                <li>
                  <label>
                    <input type="checkbox" name="check">
                    <span class="label-text">all</span> </label>
                </li>
                <li>
                  <label>
                    <input type="checkbox" name="check">
                    <span class="label-text"> manufacturing</span> </label>
                </li>
                <li>
                  <label>
                    <input type="checkbox" name="check">
                    <span class="label-text"> production </span> </label>
                </li>
                <li>
                  <label>
                    <input type="checkbox" name="check">
                    <span class="label-text"> transportaion</span> </label>
                </li>
              </ul>
            </div>
            <!--hidebox-coun--> 
            
          </div>
          <!--filterbottom-->
          
          <div class="filterbottom">
            <h4 class="contenttype">salary</h4>
            <div class="currencytext">
              <h5>currency</h5>
              <select class="select-currency" name="birth_date" required="">
                <option selected="">aed</option>
                <option value="4">le</option>
                <option value="4">ar</option>
              </select>
            </div>
            <!--currencytext-->
            
            <ul class="divhidslid">
              <li>
                <label>
                  <input type="checkbox" name="check">
                  <span class="label-text">all</span> </label>
              </li>
              <li>
                <label>
                  <input type="checkbox" name="check">
                  <span class="label-text"> 500-1000</span> </label>
              </li>
              <li>
                <label>
                  <input type="checkbox" name="check">
                  <span class="label-text"> 1000-5000 </span> </label>
              </li>
              <li>
                <label>
                  <input type="checkbox" name="check">
                  <span class="label-text"> 5000-10000 </span> </label>
              </li>
              <li>
                <label>
                  <input type="checkbox" name="check">
                  <span class="label-text">
                  <input type="text" class="from-salary" placeholder="from">
                  <input type="text" class="from-salary" placeholder="to">
                  </span> </label>
              </li>
            </ul>
          </div>
          <!--filterbottom--> 
          
        </div>
        <!--inner-aboutus--> 
        
      </div>
      <!--dashboardleft-->
      
      <div class="col-sm-9 dashboardleft">
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
          
          <div class="row">
          	@if($jobcheck !=0)
          	@foreach($jobs  as $job)
            <div class="col-sm-4 company com-dashboard">
              <div class="ineercompany">
                <div class="tidiv"> <img src="images/car1.jpg"> <span>{{$job->job_for}}</span></div>
                <!--tidiv-->
                
                <h4 class="innertitltext">{{$job->user->name}} </h4>
                <p class="officer">{{$job->job->name}}</p>
                <ul class="hassle salary">
                  <li> <strong>loc.</strong> {{$job->country->name}}</li>
                  <li> <strong>salary.</strong>{{$job->max_salary}}</li>
              
                </ul>
                <div class="tidivbotom"> <a href= 'https://www.indeed.com/viewjob.{{$job->link}}' >apply now</a> <span>{{$job->created_at}}</span></div>
                <!--tidiv--> 
                
              </div>
              <!--inernews--> 
              
            </div>
            @endforeach
            <!--com-dashboard-->
            
           @else
           @foreach($candidates  as $candidate)
              <div class="col-sm-4 company com-dashboard">
              <div class="ineercompany">
                <div class="tidiv"> <img src="images/car1.jpg"> <span>{{$candidate['0']['job_for']}}</span></div>
                <!--tidiv-->
                
                <h4 class="innertitltext"> {{$candidate['0']['UserName']}}</h4>
                <p class="officer">{{$candidate['0']['JobName']}} </p>
                <ul class="hassle salary">
                  <li> <strong>loc.</strong>{{$candidate['0']['CountryName']}} </li>
                  <li> <strong>salary.</strong>{{$candidate['0']['max_salary']}}</li>
                   
                </ul>
                <div class="tidivbotom"> <a href= 'https://www.indeed.com/viewjob/' >apply now</a> <span></span></div>
                <!--tidiv--> 
                
              </div>
              <!--inernews--> 
              
            </div>
             @endforeach
            @endif
            
   
       
            
          </div>
          <!--row-->
          
          <div class="cenbottom nomergbotm"> <a href="#" class="largeredbtn">load more</a> </div>
        </div>
        <!--inner-aboutus--> 
        
      </div>
      
      <!--dashboardleft--> 
      
    </div>
    <!--row--> 
    
  </div>
  
  <!--container--> 
  
</section>
<!--section-->

<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> watch demo video
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="textbox">
        <iframe  src="https://www.youtube.com/embed/BFrLL5w9UGQ?autoplay=0" frameborder="0" allowfullscreen></iframe>
      </div>
      <!--textbox--> 
      
    </div>
  </div>
</div>
<!--myModal-->

@endsection


