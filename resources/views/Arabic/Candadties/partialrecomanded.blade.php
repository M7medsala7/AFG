@extends('Layout.app')
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>  
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm3O5N1fP52tnpdSqPt71joqjd9xOkcek"></script>
<script type="text/javascript">  
 
</script>

@section('content')
        <!--inner-aboutus-->
      
          <!--resultstext-->
          
          <div class="row" style="margin-left:2%;">
          @foreach($RecommandJobs  as $val)
                <div class="col-sm-4 company com-dashboard" style="width:325px;">
                  <div class="ineercompany" >
                    <div class="tidiv"> <img src="images/car1.jpg"> <span> {{$val->job_for}}</span></div>
                    <!--tidiv-->
                    
                    <h4 class="innertitltext">{{$val['user']['name']}} </h4>
                    <p class="officer">{{$val->job->name}}</p>
                    <ul class="hassle salary">
                      
                       <li> <strong>loc.</strong>{{$val['country']['name']}} </li>
                <li> <strong>salary.</strong>{{$val->min_salary}}-{{$val->max_salary}} {{($val->Currency)?$val->Currency->name:"Currency is not set"}}</li> 
                    </ul>
                    <div class="tidivbotom"> <a href="/ViewJob/{{$val->id}}">apply now</a> <span>{{$val->created_at}}</span></div>
                    <!--tidiv--> 
                    
                  </div>
                  <!--inernews--> 
                  
                </div>

                       @endforeach
                       <div class="cenbottom nomergbotm">  {!! $RecommandJobs->appends(Request::capture()->except('page'))->links() !!}
                       </div>
          </div>
 @endsection 
 @section('scripts')


    @endsection
 
          <!--row-->
          
  
    