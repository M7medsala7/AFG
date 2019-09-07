@extends('DashbordAdminPanel.layout.master')

@section('content')

  	
    <style>
    .hide{
        display:none
    }
    </style>
<div class="content mt-3">
 <div class=" fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Packages</strong>
                        </div>
                             
                                	     <!-- model -->
 

                        <div class="card-body">

<div style="padding-bottom:30px;">
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1">
     Add New Packages
   </button> -->
   </div>
                        	<div class="modal fade bd-example-modal-lg" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
    
      
    <div class="modal-body">
  
<form  action="/candidateadminstore" method="POST" id="profileForm" class="formlogin" enctype="multipart/form-data">
	{{ csrf_field() }}
  
   <fieldset style="padding: .35em .625em .75em; margin: 0 2px; border: 1px solid silver;">
      <legend style="width: fit-content;border: 0px;">Data :</legend>
 


      <div class="col-lg-12">
                   
                      
                     
					 <div class="row form-group">
                           
                           
                            </div>
                    <div class="row form-group">
                             <div class="col col-md-3"><label for="hf-name" class=" form-control-label">Name</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="hf-name" name="hf-name" placeholder="Enter Name..." class="form-control"></div>
                    </div>
                     <div class="row form-group">

                             <div class="col col-md-3"><label for="hf-email" class=" form-control-label">Price/Month</label></div>
                            <div class="col-12 col-md-9"><input type="number" id="hf-email" name="price" placeholder="Enter Price/Month..." class="form-control"></div>
                    </div>
                    <div class="row form-group">
                            <div class="col col-md-3"><label for="hf-password" class=" form-control-label">Price/yearly</label></div>
                            <div class="col-12 col-md-9"><input type="number" id="hf-password" name="Priceyear" placeholder="Enter Price/yearly..." class="form-control"></div>
                    </div>
                    <div class="row form-group">
                            <div class="col col-md-3"><label for="hf-password" class=" form-control-label">description</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="hf-password" name="description" placeholder="Enter description..." class="form-control"></div>
                    </div> 

    <div class="form-group col-xs-12">
                    <div class="col-xs-4" >
                        <input class="form-control inventorytexbox" type="email" name="Email[]" id="Email[]" placeholder="Enter Email"   />
                    </div>
                    <div class="col-xs-4" >
                            <input class="form-control inventorytexbox" type="number" name="Value[]" id="Value[]" placeholder="Enter Value" />
                          </div>
                          <div class="col-xs-4" >
                            <input class="form-control inventorytexbox" type="number" name="Valueyear[]" id="Valueyear[]" placeholder="Enter Valueyear" />
                          </div>
                    <div class="col-xs-2" >
                        <button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
                    </div>
        </div>

                        <!-- The template containing an email field and a Remove button -->
        <div class="form-group hide col-xs-12" id="emailTemplate" >
                          <div class="col-xs-4" >
                           <input class="form-control inventorytexbox" type="email" name="Email[]" id="Email[]" placeholder="Enter Email" />

                          </div>
                          <div class="col-xs-4" >
                            <input class="form-control inventorytexbox" type="number" name="Value[]" id="Value[]" placeholder="Enter Value" />
                          </div>
                          <div class="col-xs-4" >
                            <input class="form-control inventorytexbox" type="number" name="Valueyear[]" id="Valueyear[]" placeholder="Enter Valueyear" />
                          </div>
                          <div class="col-xs-2" >
                             <button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
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

 @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <!-- <button style="margin: 5px;" class="btn btn-danger btn-xs delete-all" data-url="">Delete All</button> -->

                  <table id="bootstrap-data-table" class="table table-striped table-bordered Canidate">
                    <thead>
                      <tr>
                      	<!-- <th><input type="checkbox" id="check_all"></th> -->
                        <th>Name</th>
                        <th>Price/Month</th>
                        <th>Price/Year</th>
                        <th>description</th>
                        <th>Process</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($Packages as $all)
                    <tr id="tr_{{$all->id}}">
                    <!-- <td><input type="checkbox" class="checkbox" data-id="{{$all->id}}"></td> -->
					<td>{{ $all->name}}</td>
					<td>{{ $all->price}}</td> 
                    <td>{{ $all->Priceyear}}</td>
					@if(is_null($all->description)) 
					<td>NoData</td>
					@else
                    <td>{{$all->description}}</td>
					@endif
			
			<td>
	 
<a  href="/Packages/{{$all->id}}/edit" class="btn btn-default btn-sm" ><span class="fa fa-edit"></span>  </a>
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
 
      



});


    $(document).ready(function () {

   $('#profileForm').on('click', '.addButton', function() {
            var $template = $('#emailTemplate'),
                $clone    = $template
                                .clone()
                                .removeClass('hide')
                                .removeAttr('id')
                                .insertBefore($template),
                $email    = $clone.find('[name="Email[]"]'),
                $Valueyear    = $clone.find('[name="Valueyear[]"]'),
                $Value    = $clone.find('[name="Value[]"]');

            // Add new field
          
        })

        // Remove button click handler
        .on('click', '.removeButton', function() {
            var $row   = $(this).closest('.form-group'),
                $email = $row.find('[name="Email[]"]'),
                $Valueyear    = $row.find('[name="Valueyear[]"]'),
                $Value    = $row.find('[name="Value[]"]');
            // Remove element containing the email
            $row.remove();

            // Remove field
          
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

        $('.delete-all').on('click', function(e) {


            var idsArr = [];  
            $(".checkbox:checked").each(function() {  
                idsArr.push($(this).attr('data-id'));
            });  


            if(idsArr.length <=0)  
            {  
                alert("Please select atleast one record to delete.");  
            }  else {  

                if(confirm("Are you sure, you want to delete the selected Canidate?")){  

                    var strIds = idsArr.join(","); 

                    $.ajax({
                        url: '/deletemultiplecandidate',
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

        $('[data-toggle=confirmation]').confirmation({

            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {

                element.closest('form').submit();
            }
        });   
    
    });
</script>

@endsection