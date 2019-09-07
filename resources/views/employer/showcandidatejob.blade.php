@extends('Layout.app')
@section('content')
<section class="aboutus">
  <div class="container-fluid minhitbox">
    <div class="inner-aboutus inner-ab">
      <nav class="menu-tab"> <a  onclick="reloadtable('All',1,'{{$id}}','{{$userid}}')" id="div1" style="background:#043d77"><span>{{$allCan}}</span>All</a> <a onclick="reloadtable('Shortlisted',2,'{{$id}}','{{$userid}}')" id="div2"><span>{{$shortlist}}</span> Shortlisted</a> <a onclick="reloadtable('Rejected',3,'{{$id}}','{{$userid}}')" id="div3"><span>{{$rejected}}</span> Rejected</a> <a onclick="reloadtable('Interview',4,'{{$id}}','{{$userid}}')" id="div4"><span>{{$interview}}</span> Interview</a> <a onclick="reloadtable('Reference Check',5,'{{$id}}','{{$userid}}')" id="div5"><span>{{$referencecheck}}</span> Reference Check</a> <a onclick="reloadtable('Salary Finalization',6,'{{$id}}','{{$userid}}')" id="div6"><span>{{$salaryfinalization}}</span> Salary Finalization</a> <a onclick="reloadtable('Send to Itegration',7,'{{$id}}','{{$userid}}')" id="div7"><span>{{$sendtoitegration}}</span> Send to Itegration</a> </nav>
      <div class="padding-v-20">
        <div class="heading-elements-menu">
          <ul class="breadcrumb commandBar">
            <!-- <li><a href="#" data-toggle="modal" data-target="#myModal1"><i class="fa fa-plus position-left fa-1x" style="color:#009df4"></i> New</a></li> -->
            
            <li>
              <button href="#"  style="background: transparent;
    border: 0;" class="share-all"> <i class="fa fa-comments position-left fa-1x "  style="color:red"></i> Share all</button>
            </li>
            <li><a href="#"> </a></li>
          </ul>
        </div>
        <div class="heading-elements"> </div>
      </div>
      <!--padding-v-20-->
      <div class="table-responsive"> @include('employer.patshowcan') </div>
      <!--table-responsive--> 
    </div>
    <!--inner-aboutus--> 
    
  </div>
  <!--container-fluid--> 
  
</section>
<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> Watch Video
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="textbox" id="v1"> </div>
      <!--textbox--> 
      
    </div>
  </div>
</div>
<div class="modal fade" id="updatestatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel" style="font-size: 18pt">Update Status</h4>
      </div>
      <div class="modal-body" >
        <form  action="/updatestatus" method="POST" class="formlogin" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div id="data" style="display:none;"></div>
          <div class="row">
            <div class="col-md-6">
              <label >
                <input type="checkbox" value="Shortlisted" name="status">
                <span class="label-text"> Shortlisted </span> </label>
            </div>
            <div class="col-md-6">
              <label >
                <input type="checkbox" value="Reference Check" name="status">
                <span class="label-text"> Reference Check </span> </label>
            </div>
            <div class="col-md-6">
              <label >
                <input type="checkbox" value="Rejected" name="status">
                <span class="label-text"> Rejected </span> </label>
            </div>
            <div class="col-md-6">
              <label >
                <input type="checkbox" value="Salary Finalization" name="status">
                <span class="label-text"> Salary Finalization </span> </label>
            </div>
            <div class="col-md-6">
              <label >
                <input type="checkbox" value="Interview" name="status">
                <span class="label-text"> Interview </span> </label>
            </div>
            <div class="col-md-6">
              <label >
                <input type="checkbox" value="Send to Itegration" name="status">
                <span class="label-text"> Send to Itegration </span> </label>
            </div>
          </div>
          <!--row-->
          
          <div class="modal-footer fotpop">
            <button type="button" class="btn btn-basic" data-dismiss="modal">Close</button>
            <button  class="btn btn-info" type="submit" >Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!--     /////clientmodal//// -->

<div id="ClientModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel" style="font-size: 18pt">Share Clients</h4>
      </div>
      <div style="display: block;
  margin-left: auto;
  margin-right: auto;
  width: 70%;">
        <div class="">
          <table  id= "bootstrap-data-table" class="table table-striped table-bordered dt-responsive Client" width="100%">
            <thead>
              <tr>
                <th><label class="airports personal-in">
                    <input type="checkbox" name="checkbox" id="check_allClient" class="checkboxthclient">
                    <span class="label-text"> </span> </label></th>
                <th >Name</th>
              </tr>
            </thead>
            <tbody>
            
            @foreach( $allClients as $all)
            <tr id="tr_{{$all->id}}">
              <td><input type="checkbox" class="checkboxallClient" data-id="{{$all->id}}"></td>
              <td><a class="tiptext">{{$all->name}}</td>
            </tr>
            @endforeach
              </tbody>
            
          </table>
        </div>
        <textarea  placeholder="Add Comment... " id="agencycomment" style="  border-style: inset;
    border-width: 2px; width: 400px"></textarea>
        <button style=" margin: 5px; margin-left: 300px" class="btn btn-success btn-lg share" id="{{$userid}}">Share </button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts') 
<script type="text/javascript">
  
  $(document).ready(function() {
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


   var table = $('.Client').DataTable( {
 select:true,

    responsive: true,
    "order":[[0,"asc"]],
    'searchable':true,
    "scrollCollapse":true,
    "paging":true,

      dom: 'lBfrtip'
      });
 
} );


function updatestatus($agenid,$userid)
{

 

$("#updatestatus").find("#data").append("<input type='hidden' name='agenid' value="+$agenid+">");
$("#updatestatus").find("#data").append("<input type='hidden' name='userid' value="+$userid+">");
$('#updatestatus').modal('show');
  }

  function ShowVideo($id,$type)

{
  console.log($id);
  $typeM='video/'+$type;
var int="";
$("#v1").html('');

$("#v1").html('<video style="text-align: center;width: 100%;" controls><source src="'+$id+'" type='+$typeM+'></source></video>' );

 $('#myModal').modal('show');
}

function reloadtable($status,$divid,$jobid,$userid)
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
    url: "/reloadtable",
    data:{'status':$status,'jobid':$jobid,'userid':$userid },
    
    success:function(data) {


 $('#myPartialDiv').html(data);

}
});
}


      $(".tiptext").mouseover(function() {
    $(this).children(".description").show();
}).mouseout(function() {
    $(this).children(".description").hide();
});
 $(document).ready(function () {


   

        $('#check_all').on('click', function(e) {
         if($(this).is(':checked',true))  
         {

            $(".checkboxall").prop('checked', true);  
         } else {  
            $(".checkboxall").prop('checked',false);  
         }  
        });

         $('.checkboxall').on('click',function(){
            if($('.checkboxall:checked').length == $('.checkboxall').length){
                $('#check_all').prop('checked',true);
            }else{
                $('#check_all').prop('checked',false);
            }
         });

////clientcheckboxtable///
     $('#check_allClient').on('click', function(e) {
         if($(this).is(':checked',true))  
         {

            $(".checkboxallClient").prop('checked', true);  
         } else {  
            $(".checkboxallClient").prop('checked',false);  
         }  
        });

         $('.checkboxallClient').on('click',function(){
            if($('.checkboxallClient:checked').length == $('.checkboxallClient').length){
                $('#check_allClient').prop('checked',true);
            }else{
                $('#check_allClient').prop('checked',false);
            }
         });
        $('.delete-all').on('click', function(e) {

$userid=this.id;
            var idsArr = [];  
            $(".checkboxall:checked").each(function() {  
                idsArr.push($(this).attr('data-id'));
            });  


            if(idsArr.length <=0)  
            {  
                alert("Please select atleast one record to delete.");  
            }  else {  

                if(confirm("Are you sure, you want to delete the selected Employer?")){  

                    var strIds = idsArr.join(","); 

                    $.ajax({
                        url: '/deletappliedcan',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        type: 'POST',
                        data: {"_token": "{{ csrf_token() }}",
                       ids:strIds,agenid:$userid},
                        success: function (data) {
                            if (data['status']==true) {
                                $(".checkboxall:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                 $(document).ajaxStop(function() { location.reload(true); });
                                alert(data['message']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                           
                        }
                    });


                }  
            }  
        });

        $('.share-all').on('click', function(e) {

$userid=this.id;
            var idsArr = [];  
            $(".checkboxall:checked").each(function() {  
                idsArr.push($(this).attr('data-id'));
            });  


            if(idsArr.length <=0)  
            {  
                alert("Please select atleast one record to share.");  
            }  else {  

  $('#ClientModal').modal('show');

   $('.share').on('click', function(e) {
var userid=this.id;
     var idsclientArr = [];  
            $(".checkboxallClient:checked").each(function() { 

                idsclientArr.push($(this).attr('data-id'));
            });

               if(idsclientArr.length <=0)  
            {  
                  alert("Please select at least one record to share.");  
            }  else {

            var agencycomment = $("#agencycomment").val();

             var strIds = idsArr.join(","); 
var clientIds = idsclientArr.join(","); 
                    $.ajax({
                        url: '/shareclient',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        type: 'POST',
                        data: {"_token": "{{ csrf_token() }}",
                       canids:strIds,agencycomment:agencycomment,clientids:clientIds,agenid:userid},
                        success: function (data) {
                            if (data['status']==true) {
                                $(".checkboxallClient:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                 $(document).ajaxStop(function() { location.reload(true); });
                                alert(data['message']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                           
                        }
                    });

             }


   });
            }  
        });

        
    
    });

</script> 
@endsection