@extends('Layout.app')
@section('content')
<style>
.dataTables_filter input{
  background: lightblue;
}
.tiptext {
    color:#069; 
    cursor:pointer;
}
.description {
 position: absolute;
  left: 30px;
    display:none;
    border:1px solid #000;
    width:400px;
    height:600px;
     bottom: -100px;
}
.select2-selection__rendered{
    background: #ccc;
    border: 1px solid rgba(115, 115, 115, 0.48)!important;
    float: left;
    width: 120%;
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
.mm{
  -webkit-appearance: checkbox;
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
.checkboxallJob {
position: unset !important;
     left: 100px !important;
}
.checkboxthJob {
position: unset !important;
     left: 100px !important;
}

.checkboxallClient {
position: unset !important;
     left: 100px !important;
}

.checkboxthclient {
position: unset !important;
     left: 100px !important;
}
</style>
<section class="dashboard">
<h6 style="    text-align: center;
    color: #043d77;
    margin-top: 11px;margin-bottom: 11px;font-size: x-large;">your Own Candidate</h6>
    <div class="row">
      <div class="col-sm-12">
      <div class="inner-aboutus" style="min-height:800px;margin-top:1px"  >
      <div style="padding-bottom:30px;">
  
 </div>
 
                <div class="col-xs-12 no-padding border-top border-bottom">
                    <div class="padding-v-20">
                        <div class="heading-elements-menu">
                            <ul class="breadcrumb commandBar">
                                <li><a href="/RegisterWithAgency"><i class="fa fa-plus position-left fa-1x" style="color:#009df4"></i> New</a></li>

                              
                            <li><button href="#"  style="background: transparent;
    border: 0;" class="share-all"> <i class="fa fa-comments position-left fa-1x "  style="color:#009df4"></i> Share Job</button></li>
                   <li><button href="#"  style="background: transparent;
    border: 0;" class="share-can"> <i class="fa fa-comments position-left fa-1x "  style="color:#009df4"></i> Share to Client</button></li>
                                 <li><button href="#" id="delete-all" style="background: transparent;
    border: 0;"> <i class="fa fa-trash position-left fa-1x "  style="color:red"></i> Delete</button></li>
                            </ul>
                        </div>
                        <div class="heading-elements">
                            
                        </div>
                    </div>
                </div>




         <table  id= "bootstrap-data-table" class="table table-striped table-bordered dt-responsive Jobs" width="100%">
                         <thead>
                      <tr>
                      <th><input type="checkbox" id="check_all" style="right:inherit;;margin-top: -11px;"></th>
                        <th>Name</th>
                        <th>Video</th>
                        <th>CV</th>
                        <th>Nationality</th>
                        <th>Country</th>
                        <th>Gender</th>
                        <th>Job</th>
<td>Phone number</td>
<td>Email</td>
                       
                      </tr>
                    </thead>
                    <tbody>
                     
                      @foreach($data as $value)

                      <tr  style="text-align: center;" id="tr_{{$value->user_id}}">
                      <td >
                      <input type="checkbox" class="checkbox" style="right:auto;"  data-id="{{$value->user_id}}"></td>
                  


  <td><a class="tiptext">{{$value->last_name}}
  <iframe class="description" src="/candidate/{{$value->user_id}}"> </iframe>
</a> </td>

                        <td>
                          <a   class="imgbox" onclick="ShowVideo('/{{$value->vedio_path}}','{{File::extension($value->vedio_path)}}')"> 
                            <img src="/{{($value->user)?$value->user->logo:'images/4.jpg'}}" style="width: 50px; height: 50px;margin-top:-20%" >
                             <i class="fas fa-play"></i> 
                          </a>
                        </td>
                        <td> <a href="/{{$value->cv_path }}">CV</a></td>
                        @if(is_null($value->nationality))
                        <td>No Nationality</td>
                        @else
                        <td> {{$value->nationality->name}}</td>
                        @endif
                        <td>{{$value->country->name}}</td>
                        @if($value->gender==0)
                        <td>Male</td>
                        @else
                        <td>Female</td>
                        @endif
                        <td>{{$value->job->name}}</td>
           
                     <td>{{$value->phone_number}}</td>
                     <td>{{$value->user->email}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>
        </div>
      <!--dashboardleft--> 
      
    </div>
    <!--row--> 
    

  
</section>


<section>
<div class="modal fade bd-example-modal-lg" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
    
      
    <div class="modal-body">
    <div class="col-md-12" style="    text-align: center;"><h3>Add New Client</h3></div>
    
    <form  action="/addNewclient" method="POST" class="formlogin" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="divwits">
                <input type="text"  class="form-control requirments" name="name" placeholder="Company/Family Name" style="background: #ccc;color:rgba(0,0,0,0.7)!important">
            </div>
            <div class="divwits">
                <input type="text" class="form-control requirments" name="email" placeholder="Email" style="background: #ccc;color:rgba(0,0,0,0.7)!important">
            </div>
            <div class="divwits">
                <input type="password" class="form-control requirments" name="password" placeholder="password" style="background: #ccc;color:rgba(0,0,0,0.7)!important">
            </div>
        
        




   <div class="col-md-12 airports witpostslid" style="width:95%">
                  <select class="form-control requirments" name="country_id" id="country_id" required="" style="width: 90%;" onblur="processForm(this.form)" >
                    <option selected="" > Current Location</option>
                    @foreach(\App\Country::all() as $country)
                      <option value="{{$country->id}}" >{{$country->name}}</option>
                    @endforeach
                  </select>
                </div>




        <!--divwits-->
        
        <div class="col-md-12 airports witpostslid" style="width:95%">
           <select class="form-control " id="city_id" name="city_id" style="width: 90%;"  onblur="processForm(this.form)">
             <option selected="" disabled="disabled">Select City</option>
          </select>
        </div>









            <div class="divwits marginclass">
                <div class="input-group input-file" name="logo">
                <input type="text" style="background: #ccc;color:rgba(0,0,0,0.7)!important" class="form-control requirments"  placeholder='image...'  />
                <span class="input-group-btn">
                <button class="btn btn-default btn-choose largeredbtn brows" type="button" onblur="processForm(this.form)">brows</button>
                </span> </div>
            </div>
        
         
            <div class="divwits mergbot" style="margin-left: 85%;margin-bottom:20px">
                <button type="submit"  class="largeredbtn">save <i class="fas fa-check"></i></button>
            
            </div>
       </form>     

</div> <!-- end modal-body -->
</div><!-- end modal-content -->
</div><!-- end modal-dialog -->
</div><!-- end myModal1 -->
</section>

<!--myModal-->
<div id="myModal2" class="modal fade">
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

<!--     /////Jobtmodal//// -->


<div id="JobModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> 
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel" style="font-size: 18pt">Share Job</h4>
      </div>
     
     <div style="display: block;
  margin-left: auto;
  margin-right: auto;
  width: 70%;">
       <table  id= "bootstrap-data-table" class="table table-striped table-bordered dt-responsive jobshare" style="width: 100%">

         

       
                    <thead>
                      <tr>
                          <th><input type="checkbox" id="check_allJob" class="checkboxthJob"></th>
                        <th>Name</th>
                    
                      </tr>
                    </thead>
                    <tbody>
                      @foreach( $jobs as $all)
       <tr id="tr_{{$all->id}}">
                    <td><input type="checkbox" class="checkboxallJob" data-id="{{$all->job->id}}"></td>
          <td><a class="tiptext">{{$all->job->name}}</td>

    

     


               




                      </tr>
                      @endforeach
                      
                   
                    
                    
                    </tbody>
                  </table>

                  <button style=" margin: 5px; margin-left: 300px" class="btn btn-success btn-lg share">Share </button>
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
       <table  id= "bootstrap-data-table" class="table table-striped table-bordered dt-responsive Client" style="width: 100%">

         

       
                    <thead>
                      <tr>
                          <th><input type="checkbox" id="check_allClient" class="checkboxthclient"></th>
                        <th>Name</th>
                    
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
 <textarea  placeholder="Add Comment... " id="agencycomment" style="  border-style: inset;
    border-width: 2px; width: 400px"></textarea>
                  <button style=" margin: 5px; margin-left: 300px" class="btn btn-success btn-lg sharecan">Share </button>
       </div>
    </div>
  </div>
</div>
@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
 <script type="text/javascript" src="/vendor/jsvalidation/js/jsvalidation.js"></script>
<script src="/dist/jquery.validate.js"></script>
<script>
  populateCountries("country_id", "city_id"); 
  // first parameter is id of country drop-down and second parameter is id of state drop-down
</script>
<script>

function ShowVideo($id,$type)
{
$typeM='video/'+$type;
var int="";
$("#v1").html('');




if($id=='/' || $id==null || $id=='')
{
  $("#v1").html('sorry there is no video' );
$('#myModal2').modal('show');

}
else
{
  $("#v1").html('<video style="text-align: center;width: 100%;" controls><source src="'+$id+'" type='+$typeM+'></source></video>' );
$('#myModal2').modal('show');
}


}
</script>
<script type="text/javascript">
function asd()
{
  $("#candiv").show();
}
   $(".tiptext").mouseover(function() {
    $(this).children(".description").show();
}).mouseout(function() {
    $(this).children(".description").hide();
});
  $(document).ready(function() {
 
  var table = $('.jobshare').DataTable( {
 select:true,

    responsive: true,
    "order":[[0,"asc"]],
    'searchable':true,
    "scrollCollapse":true,
    "paging":true,

      dom: 'lBfrtip'
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
$('#country_id').select2();
  $('#city_id').select2();

/////checkboxtosharejob////
     $('#check_all').on('click', function(e) {
         if($(this).is(':checked',true))  
         {

            $(".checkbox").prop('checked', true);  
         } else {  
            $(".checkbox").prop('checked',false);  
         }  
        });

         $('.checkbox').on('click',function(){
            if($('.checkbox:checked').length == $('.checkbox').length){
                $('#check_all').prop('checked',true);
            }else{
                $('#check_all').prop('checked',false);
            }
         });

////jobcheckboxtable///
     $('#check_allJob').on('click', function(e) {
         if($(this).is(':checked',true))  
         {

            $(".checkboxallJob").prop('checked', true);  
         } else {  
            $(".checkboxallJob").prop('checked',false);  
         }  
        });

         $('.checkboxallJob').on('click',function(){
            if($('.checkboxallJob:checked').length == $('.checkboxallJob').length){
                $('#check_allJob').prop('checked',true);
            }else{
                $('#check_allJob').prop('checked',false);
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


        $('.share-all').on('click', function(e) {


            var idsArr = [];  
            $(".checkbox:checked").each(function() {  
                idsArr.push($(this).attr('data-id'));
            });  


            if(idsArr.length <=0)  
            {  
                alert("Please select atleast one record to share.");  
            }  else {  

  $('#JobModal').modal('show');

   $('.share').on('click', function(e) {

     var idsjobArr = [];  
            $(".checkboxallJob:checked").each(function() { 

                idsjobArr.push($(this).attr('data-id'));
            });

               if(idsjobArr.length <=0)  
            {  
                  alert("Please select at least one record to share.");  
            }  else {

           

             var strIds = idsArr.join(","); 
var jobIds = idsjobArr.join(","); 
                    $.ajax({
                        url: '/sharejobtocandidate',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        type: 'POST',
                        data: {"_token": "{{ csrf_token() }}",
                       canids:strIds,jobIds:jobIds},
                        success: function (data) {
                            if (data['status']==true) {
                                $(".checkboxallJob:checked").each(function() {  
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

///////shareclient/////////////////

                $('.share-can').on('click', function(e) {


            var idsArr = [];  
            $(".checkbox:checked").each(function() {  
                idsArr.push($(this).attr('data-id'));
            });  


            if(idsArr.length <=0)  
            {  
                alert("Please select atleast one record to share.");  
            }  else {  

  $('#ClientModal').modal('show');

   $('.sharecan').on('click', function(e) {
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
                       canids:strIds,agencycomment:agencycomment,clientids:clientIds},
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
 $('#delete-all').on('click', function(e) {


var idsArr = [];  
$(".checkbox:checked").each(function() {  
    idsArr.push($(this).attr('data-id'));
});  


if(idsArr.length <=0)  
{  
    alert("Please select atleast one record to delete.");  
}  else {  

    if(confirm("Are you sure, you want to delete the selected Candidate?")){  

        var strIds = idsArr.join(","); 

        $.ajax({
            url: '/deletemultipleCandidatebyagency',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: 'POST',
            data: {"_token": "{{ csrf_token() }}",
           ids:strIds },
            success: function (data) {
                if (data['status']==true) {
                    $(".checkbox:checked").each(function() {  
                        $(this).parents("tr").remove();
                    });
                     $(document).ajaxStop(function() { location.reload(true); });
                    alert(data['message']);
                } else {
                    alert('Whoops Something went wrong!!');
                }
            },
            error: function (data) {
                alert(data.responseText);
            }
        });


    }  
}  
});

  
} );
</script>
@stop