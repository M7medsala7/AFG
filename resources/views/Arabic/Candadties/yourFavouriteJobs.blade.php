@extends('Layout.app')


@section('content')

<style>
.footer{
    right: 0;
    bottom: 0;
    left: 0;
    position: fixed;
}
</style>

 <div class="col-sm-12 dashboardleft">
        <div class="inner-aboutus">
          <div class="currencytext resultstext">
            <h2>Your Favourite jobs</h2>





</div>


     <div class="row">
            @foreach($data  as $val)
            <div class="col-sm-3 company com-dashboard">
              <div class="ineercompany">
                <div class="tidiv"> <img src="images/car1.jpg"> <span> {{$val->job_for}}</span></div>
                <!--tidiv-->
                
                <h4 class="innertitltext">{{$val['user']['name']}}</h4>
                <p class="officer">{{$val['job']['name']}}</p>


  <a class="like like_button" href="/likejob/{{$val->job_id}}">

<i class="fas fa-heart" style="font-size: 1.5em;color:red"></i> 

</a>
                <ul class="hassle salary">
                   <li> <strong>loc.</strong>{{$val['country']['name']}} </li>
                   @if($val->min_salary !=null && $val->max_salary !=null)
                    
                    <li> <strong>salary.</strong>{{number_format($val->min_salary)}}-{{number_format($val->max_salary)}} {{($val->Currency)?$val->Currency->name:"Currency is not set"}}</li> 
                    @elseif($val->min_salary !=null)
                      
                    <li> <strong>salary.</strong>{{number_format($val->min_salary)}} {{($val->Currency)?$val->Currency->name:"Currency is not set"}}</li> 
                    @else
                    <li> <strong>salary.</strong>{{number_format($val->max_salary)}} {{($val->Currency)?$val->Currency->name:"Currency is not set"}}</li> 
                    @endif
                  
                </ul>
                <div class="tidivbotom"> <a href="/ViewJob/{{$val->job_id}}">apply now</a> <span>{{$val->created_at}}</span></div>
                <!--tidiv--> 
                
              </div>
              <!--inernews--> 
              
            </div>
            <!--com-dashboard-->
            
       @endforeach



</div>
</div>



@endsection
@section('scripts')




  

@endsection
