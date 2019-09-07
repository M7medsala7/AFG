<div id ="myPartialDiv" class="rowemp">
@if (\Session::has('success'))
<div style="border: hidden;">

    <div class="alert alert-success">
  <strong>Suceess</strong> {!! \Session::get('success') !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<div class="col-xs-12 no-padding border-top border-bottom">
                    <div class="padding-v-20">
                        <div class="heading-elements-menu">
                            <ul class="breadcrumb commandBar">
                                <!-- <li><a href="#" data-toggle="modal" data-target="#myModal1"><i class="fa fa-plus position-left fa-1x" style="color:#009df4"></i> New</a></li> -->

                                <li><button href="#" onclick="showstatus()" style="background: transparent;
    border: 0;"> <i class="fa fa-comments position-left fa-1x "  style="color:red"></i> Assgin status</button></li>

<li><button href="#"  style="background: transparent;
    border: 0;" id="delete-all"> <i class="fa fa-trash position-left fa-1x "  style="color:red"></i> Delete</button></li>
<li><a href="#"> </a></li>
                               
                            </ul>
                        </div>
                        <div class="heading-elements">
                            
                        </div>
                    </div>
                </div>
<table  id= "bootstrap-data-table" class="table table-striped table-bordered dt-responsive airports personal-in Candidate" width="100%">
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
                        <th>Agency status</th>
<th>client status</th>
                        <th>ClientComment</th>
                       <th>Agency Comment</th>
                       <th>Process</th>
                      </tr>
                    </thead>
                    <tbody>
                     
                      @foreach($data as $value)
                      <tr  style="text-align: center;" id="tr_{{$value->user_id}}">
                      <td >
                      <input type="checkbox" class="checkbox" style="right:auto;"  data-id="{{$value->user_id}}"></td>
                        <td>{{$value->last_name}}</td>
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
                        @if(is_null($value->AgencyStatus))
                        <td>New</td>
                        @else
                        <td>{{$value->AgencyStatus}}</td>
                        @endif

@if(is_null($value->ClientStatus))
                        <td>New</td>
                        @else
                        <td>{{$value->ClientStatus}}</td>
                        @endif
                        <td>{{$value->CommentClient}}</td>
                        <td>{{$value->CommentAgency}}</td>

                      
                      <td> <a  class="largeredbtn" style="float: none;" onclick="updatestatus('{{$value->Agency_id}}','{{$value->user_id}}')"> Status </a></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

          </div>
          <section>
<div class="modal fade" id="showstatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel" style="font-size: 18pt">your Status</h4>
          </div>
          <div class="modal-body" id="checkval" >
     
  <div id="data" style="display:none;"></div>
               <div class="form-row">
    <div class="col-md-6 mb-6">
           <label >
          <input type="checkbox" value="Shortlisted" id="Shortlisted" >
          <span class="label-text"> Shortlisted </span> </label>
    </div> 
 <div class="col-md-6 mb-6">
           <label >
          <input type="checkbox"  value="Reference Check" id="status" >
          <span class="label-text"> Reference Check </span> </label>
    </div> 
  </div>

              <div class="form-row">
    <div class="col-md-6 mb-6">
           <label >
          <input type="checkbox" value="Rejected" id="status" >
          <span class="label-text"> Rejected </span> </label>
    </div> 
 <div class="col-md-6 mb-6">
           <label >
          <input type="checkbox" value="Salary Finalization" id="status" >
          <span class="label-text"> Salary Finalization </span> </label>
    </div> 
  </div>
                <div class="form-row" >
    <div class="col-md-6 mb-6">
           <label >
          <input type="checkbox" value="Interview" id="status" >
          <span class="label-text"> Interview </span> </label>
    </div> 
 <div class="col-md-6 mb-6">
           <label >
          <input type="checkbox" value="Send to Itegration" id="status" >
          <span class="label-text"> Send to Itegration </span> </label>
    </div> 
  </div>
<input type="hidden" id="Client_id" value="1">
        <div class="col-md-12">
        Add your comment:
        <div class="col-md-12">
        <textarea col="7" style="background: lightblue;width: 100%;" id="comment" name="comment"></textarea>
        </div>
        </div>  
          <div class="modal-footer" style="padding-bottom: 20px">
            <button type="button" class="btn btn-basic" data-dismiss="modal">Close</button>
            <button  class="btn btn-info" id="save-all">Save changes</button>
          </div>
         
          </div>
        </div>
      </div>
    </div>
</section>
</div>

<script type="text/javascript">

 function showstatus()
{
// $("#showstatus").find("#data").append("<input type='hidden' name='agenid' value="+$agenid+">");
// $("#showstatus").find("#data").append("<input type='hidden' name='userid' value="+$userid+">");
$('#showstatus').modal('show');
  }

	  $(document).ready(function() {
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var table = $('.Candidate').DataTable( {
 select:true,
 
    responsive: true,
    "order":[[0,"asc"]],
    'searchable':true,
    "scrollCollapse":true,
    "paging":true,
    "pagingType": "full_numbers",
      dom: 'lBfrtip'
      });
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
 
         $('#save-all').on('click', function(e) {


var idsArr = [];  
$(".checkbox:checked").each(function() {  
    idsArr.push($(this).attr('data-id'));
});  


if(idsArr.length <=0)  
{  
    alert("Please select atleast one record to delete.");  
}  else {  

    if(confirm("Are you sure, you want to delete the selected Client?")){  

        var strIds = idsArr.join(","); 
        var comment = $('#comment').val();
        var status="";
        $("#showstatus").find('input[type="checkbox"]').each(function(){
          if (this.checked)
          {
            
           status= $(this).val();
          }
      
});
        
       
        var Client_id =$('#Client_id').val();  
        $.ajax({
            url: '/updatemultipleclientstatusshared',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: 'POST',
            data: {"_token": "{{ csrf_token() }}",
           ids:strIds,comment:comment,status:status,Client_id:Client_id },
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

         $('#delete-all').on('click', function(e) {


var idsArr = [];  
$(".checkbox:checked").each(function() {  
    idsArr.push($(this).attr('data-id'));
});  


if(idsArr.length <=0)  
{  
    alert("Please select atleast one record to delete.");  
}  else {  

    if(confirm("Are you sure, you want to delete the selected Client?")){  

        var strIds = idsArr.join(","); 

        $.ajax({
            url: '/deletemultiplesharedclient',
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