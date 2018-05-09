@foreach($similarJobs as $sJob)
  <div class="col-sm-4 company com-dashboard">
    <div class="ineercompany">
      <div class="tidiv"> <img src="images/car1.jpg"> <span> {{$sJob->job_for}}</span></div>
      <!--tidiv-->
      
      <h4 class="innertitltext"> {{$sJob->user->name}} </h4>
      <p class="officer">safely officer</p>
      <ul class="hassle salary">
        <li> <strong>loc.</strong> {{$sJob->country->name}}</li>
        <li> <strong>salary.</strong> {{$sJob->min_salary}}-{{$sJob->max_salary}} omr</li>
      </ul>
      <div class="tidivbotom"> <a href="#">apply now</a> <span>{{$sJob->created_at}}</span></div>
      <!--tidiv--> 
      
    </div>
    <!--inernews-->
    
    <div class="row rowphoto">
      @foreach($sJob->topCandidates as $key => $candidate)
        @if($key < 4)
        <div class="col-sm-2 photcarcal"><img src="{{($candidate->user->logo)?'($candidate->user->logo)':'images/callto-action.png'}}"></div>
        @endif
      @endforeach
        <div class="col-sm-2 photcarcal"> <a href="#" class="btnlinks fas fa-ellipsis-h"> </a> </div>
    </div>
    <!--row--> 
    
  </div>

@endforeach
          