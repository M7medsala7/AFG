<div class="candidaterow">
@foreach($Candidates as $val)
<div class="col-sm-4 company com-dashboard" style="width:325px;">
 <div class="ineercompany nonepad"> 
   <a  class="imgbox" onclick="ShowVideo('/{{$val->vedio_path}}','{{File::extension($val->vedio_path)}}')">

     <img src="{{($val->user->logo)?$val->user->logo:'images/4.jpg'}}"> <i class="fas fa-play"></i></a>
   <div class="padboxs"> <span class="eyeicons"><i class="fas fa-eye"></i> 20,215</span> <span class="eyeicons"><i class="fas fa-flag"></i> 20,215</span>
      <h4 class="innertitltext">{{$val->user->name}}</h4>
<p class="officer">{{$val->job->name}}</p>
     <ul class="hassle salary">
       <li> 28 years</li>
       <li>{{($val->nationality)?$val->nationality->name:"Nationality is not set"}}</li>
     </ul>
<div class="tidivbotom"> <a href="/candidate/{{$val->user->id}}">View Profile</a> <span>{{$val->created_at}}</span></div>
     <!--tidiv--> 
     
   </div>
   <!--padboxs--> 
   
 </div>
 <!--inernews--> 
 
</div>

 @endforeach
<!--com-dashboard-->

 <div style="margin-left:40%;">
       {{$Candidates->links()}}
          </div> 
<!--com-dashboard-->




</div>