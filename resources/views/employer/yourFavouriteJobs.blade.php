@extends('Layout.app')


@section('content')

<style type="text/css">
.footer{
    right: 0;
    bottom: 0;
    left: 0;
    position: fixed;
}


  .ineercompany {
    min-height: 300px;
  }
.resp-sharing-button__link,
.resp-sharing-button__icon {
  display: inline-block
}

.resp-sharing-button__link {
  text-decoration: none;
  color: #fff;
  margin: 0.5em
}

.resp-sharing-button {
  border-radius: 5px;
  transition: 25ms ease-out;
  padding: 0.5em 0.5em;
  font-family: Helvetica Neue,Helvetica,Arial,sans-serif
}

.resp-sharing-button__icon svg {
  width: 1em;
  height: 1em;
  margin-right: 0.4em;
  vertical-align: top
}

.resp-sharing-button--small svg {
  margin: 0;
  vertical-align: middle
}

/* Non solid icons get a stroke */
.resp-sharing-button__icon {
  stroke: #fff;
  fill: none
}

/* Solid icons get a fill */
.resp-sharing-button__icon--solid,
.resp-sharing-button__icon--solidcircle {
  fill: #fff;
  stroke: none
}

.resp-sharing-button--twitter {
  background-color: #55acee
}

.resp-sharing-button--twitter:hover {
  background-color: #2795e9
}




.resp-sharing-button--facebook {
  background-color: #3b5998
}

.resp-sharing-button--facebook:hover {
  background-color: #2d4373
}


.resp-sharing-button--google {
  background-color: #dd4b39
}

.resp-sharing-button--google:hover {
  background-color: #c23321
}

.resp-sharing-button--linkedin {
  background-color: #0077b5
}

.resp-sharing-button--linkedin:hover {
  background-color: #046293
}

.resp-sharing-button--email {
  background-color: #777
}

.resp-sharing-button--email:hover {
  background-color: #5e5e5e
}



.resp-sharing-button--whatsapp {
  background-color: #25D366
}

.resp-sharing-button--whatsapp:hover {
  background-color: #1da851
}



.resp-sharing-button--facebook:hover,
.resp-sharing-button--facebook:active {
  background-color: #2d4373;
  border-color: #2d4373;
}

.resp-sharing-button--twitter {
  background-color: #55acee;
  border-color: #55acee;
}

.resp-sharing-button--twitter:hover,
.resp-sharing-button--twitter:active {
  background-color: #2795e9;
  border-color: #2795e9;
}

.resp-sharing-button--google {
  background-color: #dd4b39;
  border-color: #dd4b39;
}

.resp-sharing-button--google:hover,
.resp-sharing-button--google:active {
  background-color: #c23321;
  border-color: #c23321;
}





</style>

 <div class="col-sm-12 dashboardleft">
        <div class="inner-aboutus">
          <div class="currencytext resultstext">
            <h2>Your Favourite Candidate</h2>





</div>


     <div class="row">
        @foreach($favouritecan as $TopCandi)
     
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

<!-- Sharingbutton Twitter -->


        </div>
        <!--inernews--> 
    
      </div>
      <!--bocprod-->
  
     @endforeach




</div>
</div>

<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> watch video
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
     
      <div class="modal-body" id="v1">
       
        </div>
    
      <!--textbox--> 
      
    </div>
  </div>
</div>
<!--myModal-->

@endsection
@section('scripts')


<script>
    function ShowVideo($id,$type)
{
  
 $typeM='video/'+$type;
var int="";
$("#v1").html('');


if($id=='/' || $id==null || $id=='')
{
  $("#v1").html('sorry there is no video' );

}
else
{
  $("#v1").html('<video style="text-align: center;width="560" ;height="315";" controls><source src="'+$id+'" type='+$typeM+'></source></video>' );

}




 $('#myModal').modal('show');
}
</script>

  

@endsection
