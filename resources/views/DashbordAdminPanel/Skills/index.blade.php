@extends('DashbordAdminPanel.layout.master')

@section('content')

  <style type="text/css">
    
  </style>	
    

   
<div class="modal fade bd-example-modal-lg" id="myModalblog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
    
      
    <div class="modal-body">
  
<form  action="/addskill" method="POST" id="profileForm" class="formlogin" enctype="multipart/form-data">
	{{ csrf_field() }}
  
   <fieldset style="padding: .35em .625em .75em; margin: 0 2px; border: 1px solid silver;">
      <legend style="width: fit-content;border: 0px;">Data :</legend>
      <div class="col-lg-12">
					 <div class="row form-group">
                      </div>
                    <div class="row form-group">
                    <div class="col col-md-3"><label for="hf-password" class=" form-control-label">name</label></div>
                  <input type="text" id="hf-name" name="name" placeholder="Enter skill name..." class="form-control">
                    </div>
                    <div class="row form-group">
                            <!-- <div class="col col-md-3"><label for="hf-password" class=" form-control-label">Body</label></div> -->
                            <div class="col-12 col-md-12" >
                            
                            </div>
                    </div> 
                 </fieldset> 
            <div class="ln_solid" style="margin-top:20px"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="button" class="btn btn-primary " data-dismiss="modal">Cancel</button>
                         <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit"  name="login_form_submit" class="btn btn-success" value="Save">Submit</button>
            </div>
            </div>
      </form>
</div> <!-- end modal-body -->
</div><!-- end modal-content -->
</div><!-- end modal-dialog -->
</div><!-- end myModal1 -->



  <div class="content mt-3">


  
 <div class=" fadeIn">

                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Skills</strong>
                        </div>
                             
                                	     <!-- model -->
 

                        <div class="card-body">


                        	<div class="modal fade bd-example-modal-lg" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 
</div><!-- end myModal1 -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalblog">
Add New Skill
</button>

   <br>
   <br>
 <button style="margin: 5px;" class="btn btn-danger btn-xs delete-all" data-url="">Delete All</button>
   

                  <table id="bootstrap-data-table" class="table table-striped table-bordered Jobs">
                    <thead>
                    <tr>
                    <th><input type="checkbox" id="check_all"></th>
                 
                  <th > Name</th>
                
                  <th> process</th>
                
                </tr>

                    </thead>
                    <tbody>
                    @foreach($skills as $value)
                <tr id="tr_{{$value->id}}"">
                <td><input type="checkbox" class="checkbox" data-id="{{$value->id}}"></td>
                  <td>{{$value->name}}</td>
                  <td>
                  <a href="{{url('/ShowEditSkill/'.$value->id)}}" class="btn btn-default btn-sm"> <span class="fa fa-edit"></span>  </a>
                
                  </td>
                </tr>

                      @endforeach
                      
                   
                    
                    
                    </tbody>
                  </table>
                        </div>
                    </div>
                </div>


                </div>
            </div>
            </div>
@endsection



@section('scripts')
<script type="text/javascript" src="/vendor/jsvalidation/js/jsvalidation.js"></script>
<script src="/dist/jquery.validate.js"></script>
<script type="text/javascript">

 $(document).ready(function () {
   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
 
      
    $('.delete-all').on('click', function(e) {


var idsArr = [];  
$(".checkbox:checked").each(function() {  
    idsArr.push($(this).attr('data-id'));
});  


if(idsArr.length <=0)  
{  
    alert("Please select atleast one record to delete.");  
}  else {  

    if(confirm("Are you sure, you want to delete the selected Skill?")){  

        var strIds = idsArr.join(","); 

        $.ajax({
            url: '/deleteMultipleSkill',
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





});


</script>
<script type="text/javascript" src="/vendor/jsvalidation/js/jsvalidation.js"></script>
<script src="/dist/jquery.validate.js"></script>


@endsection