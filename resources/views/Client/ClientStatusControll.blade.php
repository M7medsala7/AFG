@extends('Layout.app')
@section('content')
<style>
.dataTables_filter input{
  background: lightblue;
}
.select2-selection__rendered{
    background: #ccc;
    border: 1px solid rgba(115, 115, 115, 0.48)!important;
    float: left;
    width: 100%;
    height: 40px;
    border-radius: 5px;
    /* border: 0; */
    box-shadow: none;
    border: 2px solid #d7d7d7;
    margin-top: 10px;
    color: rgba(0,0,0,0.7)!important;;
  }
  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 57px!important;}
  .select2-container .select2-selection--single
  {
    height: 0px!important;
  }
  .select2-container--default .select2-selection--single{    background-color: 0!important;border: 0!important}
  .watchvideo img{
    height: 20%!important;
  }

@keyframes load {
100% {
    opacity: 0;
    transform: scale(1);
}
}
@keyframes load {
100% {
    opacity: 0;
    transform: scale(1);
}
}
  #step-2{
    display:none;
  }
   #step-3{
    display:none;
  }
.marginclass{
    margin-top:15px;
}

.dataTables_wrapper {
    margin-top: 2%;
    zoom:0
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    color: #004d9a !important;
    border-radius: 100%;
    border: 1px solid #004d9a;
}
.footer{
    right: 0;
    bottom: 0;
    left: 0;
    position: fixed;
}
.tiptext {
    color:#069; 
    cursor:pointer;
 z-index: -1
}
.description {
    display:none;
    position:absolute;
    border:1px solid #000;
    width:1400px;
    height:500px;
     top: -300px;
}
.divtable{
font-size: inherit;
    padding: 2px;
    text-align: center;
    height: 60px;
    background: #009df4;
    color: white;
margin: 5px;
    border-radius: 10px;
}
</style>
<section class="dashboard">

    <div class="row">
      <div class="col-sm-12">
      <div class="inner-aboutus" style="margin-top:1px;min-height:800px">
      <div style="padding-bottom:30px;">
   <!-- <button style="background-color:#004d9a;margin-top: 15px;
    margin-bottom: -2%;padding: 0px 10px 0px 10px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1">
     Add New Client
   </button> -->
<h6 style="    text-align: center;
    color: #043d77;
    margin-top: 11px;font-size: x-large;">candidate for {{$client->name}}</h6>
 </div>



  <div class="col-md-12" style="margin-bottom: 25px;">

 
 
 <nav class="menu-tab">
  <a  onclick="drawtable('All',1,'{{$client->id}}')" id="div1" style="background:#043d77">
  <span>{{$all}}</span>All</a>

   <a onclick="drawtable('shortlisted',2,'{{$client->id}}')" id="div2">
  <span>{{$Shortlisted}}</span> Shortlisted</a>

  <a onclick="drawtable('Rejected',3,'{{$client->id}}')" id="div3">
  <span>{{$Rejected}}</span>Rejected</a>

    <a onclick="drawtable('Interview',4,'{{$client->id}}')" id="div4">
    <span>{{$Interview}}</span> Interview</a> 
    <a onclick="drawtable('Reference Check',5,'{{$client->id}}')" id="div5">
    <span>{{$ReferenceCheck}}</span> Reference Check</a>
     <a onclick="drawtable('Salary Finalization',6,'{{$client->id}}')" id="div6">
     <span>{{$SalaryFinalization}}</span> Salary Finalization</a>
   <a onclick="drawtable('Send to Itegration',7,'{{$client->id}}')" id="div7">
 
 <span>{{$SendItegration}}</span> Send to Itegration</a> </nav>
 
 
 </div>

 <div class="col-md-12" style="height:100%"> @include('Client.myclientpartial')</div>

 <section><div style="height:100px"></div></section>
                </div>
        </div>
      <!--dashboardleft--> 
      
    </div>
    <!--row--> 

</section>

<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> Watch Video
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="textbox" id="v1">
      
      </div>
      <!--textbox--> 
      
    </div>
  </div>
</div>
<section>
<div class="modal fade" id="updatestatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel" style="font-size: 18pt">your Status</h4>
          </div>
          <div class="modal-body" >
     <form  action="/updatestatusclient" method="POST" class="formlogin" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div id="data" style="display:none;"></div>
               <div class="form-row">
    <div class="col-md-6 mb-6">
           <label >
          <input type="checkbox" value="Shortlisted" name="status">
          <span class="label-text"> Shortlisted </span> </label>
    </div> 
 <div class="col-md-6 mb-6">
           <label >
          <input type="checkbox" value="Reference Check" name="status">
          <span class="label-text"> Reference Check </span> </label>
    </div> 
  </div>

              <div class="form-row">
    <div class="col-md-6 mb-6">
           <label >
          <input type="checkbox" value="Rejected" name="status">
          <span class="label-text"> Rejected </span> </label>
    </div> 
 <div class="col-md-6 mb-6">
           <label >
          <input type="checkbox" value="Salary Finalization" name="status">
          <span class="label-text"> Salary Finalization </span> </label>
    </div> 
  </div>
                <div class="form-row" >
    <div class="col-md-6 mb-6">
           <label >
          <input type="checkbox" value="Interview" name="status">
          <span class="label-text"> Interview </span> </label>
    </div> 
 <div class="col-md-6 mb-6">
           <label >
          <input type="checkbox" value="Send to Itegration" name="status">
          <span class="label-text"> Send to Itegration </span> </label>
    </div> 
  </div>

        <div class="col-md-12">
        Add your comment:
        <div class="col-md-12">
        <textarea col="7" style="background: lightblue;width: 100%;"></textarea>
        </div>
        </div>  
          <div class="modal-footer" style="padding-bottom: 20px">
            <button type="button" class="btn btn-basic" data-dismiss="modal">Close</button>
            <button  class="btn btn-info" type="submit" >Save changes</button>
          </div>
          </form>
          </div>
        </div>
      </div>
    </div>
</section>


@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
 <script type="text/javascript" src="/vendor/jsvalidation/js/jsvalidation.js"></script>
<script src="/dist/jquery.validate.js"></script>
<script>
  populateCountries("country_id", "city_id"); 
  // first parameter is id of country drop-down and second parameter is id of state drop-down
</script>
<script type="text/javascript">





function asd()
{
  $("#candiv").show();
}
function updatestatus($agenid,$userid)
{
$("#updatestatus").find("#data").append("<input type='hidden' name='agenid' value="+$agenid+">");
$("#updatestatus").find("#data").append("<input type='hidden' name='userid' value="+$userid+">");
$('#updatestatus').modal('show');
  }
function drawtable($status,$divid,$clientid)
{


$asd="#div"+$divid;

$('#div1').css({'background':'#009df4'});
$('#div2').css({'background':'#009df4'});
$('#div3').css({'background':'#009df4'});
$('#div4').css({'background':'#009df4'});
$('#div5').css({'background':'#009df4'});
$('#div6').css({'background':'#009df4'});
$('#div7').css({'background':'#009df4'});

$($asd).css({'background':'#043d77'});

    $.ajax({
    type: "POST",
    url: "/Candiateclient",
    data:{'status':$status,'clientid':$clientid},
    success:function(data) {

    $('#myPartialDiv').html(data);
    }
    });
}

  function ShowVideo($id,$type)

{
  console.log($id);
  $typeM='video/'+$type;
var int="";
$("#v1").html('');
if($id=='/' || $id==null || $id=='')
{
  $("#v1").html('sorry there is no video' );

}
else
{
  $("#v1").html('<video style="text-align: center;width: 100%;" controls><source src="'+$id+'" type='+$typeM+'></source></video>' );

}

 $('#myModal').modal('show');
}
  $(document).ready(function() {
    $('#job_id').select2();
  $('#country_id').select2();
  $('#city_id').select2();
    $('.Jobs').DataTable({
    select:true,
    responsive: true,
    "order":[[0,"asc"]],
    'searchable':true,
    "scrollCollapse":true,
    "paging":true,
    "pagingType": "full_numbers",
      dom: 'lBfrtip'
      });
 

      $('select.changeStatus').change(function(){
      
    });
   $(".tiptext").mouseover(function() {

    $(this).children(".description").show();

}).mouseout(function() {
    $(this).children(".description").hide();
});

} );
</script>
@stop