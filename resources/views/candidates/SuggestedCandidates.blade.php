@extends('Layout.app')
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>  
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm3O5N1fP52tnpdSqPt71joqjd9xOkcek"></script>

<script type="text/javascript">  
 
</script>

@section('content')
<style type="text/css">
  
  input[type="file"] {
    display: none;
}
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
}



</style>
<section class="dashboard">
  <div class="container">
    <div class="row">
    
        <!--inner-aboutus-->
        
    
        <!--inner-aboutus--> 
   
      <!--dashboardleft-->
    
        
        <!--inner-aboutus-->
      
        <!--inner-aboutus-->
        
         <div class="inner-aboutus topmergline">
          <div class="currencytext resultstext">
            <h2>matching candidates</h2>
          </div>
          <!--resultstext-->
     <div class="row">
      @foreach($TopCandidate as $TopCandi)
     
      <div class="col-sm-3 company">
        <div class="ineercompany nonepad">
          <a   class="imgbox" onclick="ShowVideo('/{{$TopCandi->vedio_path}}','{{File::extension($TopCandi->vedio_path)}}')"> 

        <img src="{{($TopCandi->user->logo)?$TopCandi->user->logo:'images/4.jpg'}}"> <i class="fas fa-play"></i>  </a>
          <div class="padboxs"> <span class="eyeicons"><i class="fas fa-eye"></i> 20,215</span> <span class="eyeicons"><i class="fas fa-flag"></i> 20,215</span>
            <h4 class="innertitltext">{{$TopCandi->user->name}}</h4>
            <p class="officer">{{$TopCandi->job->name}}</p>
            <ul class="hassle salary">
              
             <li>{{($TopCandi->nationality)?$TopCandi->nationality->name:"Nationality is not set"}}</li>
            </ul>
            <div class="tidivbotom"> <a href="/candidate/{{$TopCandi->user->id}}">View Profile</a> <span>{{$TopCandi->created_at}}</span></div>
            <!--tidiv--> 
     </div>
          <!--padboxs--> 
          <i class="fa fa-facebook-square"></i>
    

<a href="https://www.facebook.com/dialog/share?
app_id=1112718265559949
&display=popup
&title='maid and helper'
&description='Mohamed salah'
&quote={{$TopCandi->descripe_yourself}}
&caption='Dody'
&href=https://www.maidandhelper.com/candidate/{{$TopCandi->user->id}}+'?og_img='+{{($TopCandi->user->logo)?$TopCandi->user->logo:'images/4.jpg'}}

&redirect_uri=https://www.facebook.com/"><i class="fas fa-share-alt"></i></a>


        </div>
        <!--inernews--> 
    
      </div>
      <!--bocprod-->
  
     @endforeach
      

      
     
      
      
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


<!--myModal-->




<!--myModa2-->

@endsection


<script>

 
        var markerArr = new Array();
function clearOverlays() {
    if (markerArr) {
      for (i in markerArr) {
        markerArr[i].setVisible(false)
        
      }
    // console.log("clear");
    }
}

function ajaxCall() {
  var marker,i;
   $.ajax({
        type: "GET",
        url : '{{url("/getjobsbycountry")}}',
        success: function(response) {
          var jArray = JSON.parse(response);
           console.log(jArray);
           
          var infowindow = new google.maps.InfoWindow();
          console.log(jArray.jobs.length);
                  for (i = 0; i < jArray.jobs.length; i++) {
            
                  marker = new google.maps.Marker({
                      position: new google.maps.LatLng(jArray.jobs[i].Lat, jArray.jobs[i].Lnag),
                      map: map
                  });
            
           
       var geocoder = new google.maps.Geocoder();
        var latitude = jArray.jobs[i].Lat;
        var longitude = jArray.jobs[i].Lnag;
        var address_arr = new Array();
        var latLng = new google.maps.LatLng(latitude,longitude);
        geocoder.geocode({       
            latLng: latLng     
          }, 
        function(responses) 
            {     
              if (responses && responses.length > 0) {    
                  address_arr.push(responses[0].formatted_address); 
              } 
              else{     
                  address_arr[i] = 'Not getting address for given latitude and longitude';  
              }   
            }
        );
    google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            infowindow.setContent('job title '+jArray.jobs[i].name+' <br/> Salary '+ jArray.jobs[i].min_salary + ':' + jArray.jobs[i].max_salary +'<br/> Job for' + jArray.jobs[i].job_for);
            infowindow.open(map, marker);
          }
        })(marker, i));


    markerArr[i]=marker;
    }
  }});
}

     


</script>
