@extends('DashbordAdminPanel.layout.master')

@section('content')

  	
    

   

  <div class="content mt-3">


  
 <div class=" fadeIn">

                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Candidate</strong>
                        </div>
                             
                                	     <!-- model -->
 

                        <div class="card-body">

<div style="padding-bottom:30px;">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1">
     Add New Canidate
   </button>
   </div>
                        	<div class="modal fade bd-example-modal-lg" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
    
      
    <div class="modal-body">
  
                    <br />
<form  action="/candidateadminstore" method="POST" class="formlogin" enctype="multipart/form-data">
	{{ csrf_field() }}
    <fieldset style="padding: .35em .625em .75em; margin: 0 2px; border: 1px solid silver;">
      <legend style="width: fit-content;border: 0px;">Desired Job:</legend>
 


      <div class="col-lg-12">
                   
                      
                     
								<div class="form-group">
								<select data-placeholder="Choose a job..." class="standardSelect" tabindex="1" name="job">
								<option value=""></option>

								@foreach(\App\Job::all() as $job)
								<option value="{{$job->id}}">{{$job->name}}</option>
								@endforeach
								</select>
								</div>


								<div class="form-group">
								<select data-placeholder="Choose a Industry..." class="standardSelect" name="industry" >
							

								@foreach(\App\Industry::all() as $ind)
								<option value=""></option>
							<option value="{{$ind->id}}">{{$ind->name}}</option>
								@endforeach
								</select>
								</div>

							<div class="form-group">
							<select data-placeholder="Choose a Country..." class="standardSelect" tabindex="1" name="country">
							<option value=""></option>

							@foreach(\App\Country::all() as $country)
							<option value="{{$country->id}}" >{{$country->name}}</option>
							@endforeach
							</select>

							</div>
                    
                       
                     
                    
                  </div>
</fieldset>  <!-- end Desired Job -->

   <fieldset style="padding: .35em .625em .75em; margin: 0 2px; border: 1px solid silver;">
      <legend style="width: fit-content;border: 0px;">Basic Info:</legend>
 


      <div class="col-lg-12">
                   
                      
                     
					 <div class="row form-group">
                            <div class="col col-md-3"><label class=" form-control-label">Gender</label></div>
                            <div class="col col-md-9">
                              <div class="form-check-inline form-check">
                                <label for="inline-radio1" class="form-check-label ">
                                  <input type="radio" id="inline-radio1" name="gender" value="0" class="form-check-input">Male
                                </label>


                                <label for="inline-radio2" class="form-check-label " >
                                  <input type="radio" id="inline-radio2" name="inline-radios" value="1" class="form-check-input " >Female
                                </label>
                               
                              </div>
                            </div>
                            </div>

                               <div class="row form-group">

                             <div class="col col-md-3"><label for="hf-name" class=" form-control-label">Name</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="hf-name" name="hf-name" placeholder="Enter Name..." class="form-control"></div>
                        </div>
                     <div class="row form-group">

                             <div class="col col-md-3"><label for="hf-email" class=" form-control-label">Email</label></div>
                            <div class="col-12 col-md-9"><input type="email" id="hf-email" name="email" placeholder="Enter Email..." class="form-control"></div>
                        </div>

                       <div class="row form-group">
                            <div class="col col-md-3"><label for="hf-password" class=" form-control-label">Password</label></div>
                            <div class="col-12 col-md-9"><input type="password" id="hf-password" name="hf-password" placeholder="Enter Password..." class="form-control"></div>
                          </div>


                           <div class="row form-group">
                            <div class="col col-md-3"><label for="file-input" class=" form-control-label">Upload Video</label></div>
                            <div class="col-12 col-md-9"><input type="file" id="file-input" name="file-input" class="form-control-file"></div>
                          </div>
                        
                        


								

						
                    
                       
                     
                    
                  
</fieldset> 
   
</br>

   <div class="ln_solid"></div>
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
    <button style="margin: 5px;" class="btn btn-danger btn-xs delete-all" data-url="">Delete All</button>

                  <table id="bootstrap-data-table" class="table table-striped table-bordered Canidate">
                    <thead>
                      <tr>
                      	<th><input type="checkbox" id="check_all"></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Job</th>
                        <th>Gender</th>
                        <th>Country</th>
                        <th>Industry</th>
                        <th>Process</th>

                      </tr>
                    </thead>
                    <tbody>
                    	@foreach($allCandidate as $all)
                      <tr id="tr_{{$all->id}}">
                    <td><input type="checkbox" class="checkbox" data-id="{{$all->id}}"></td>
					<td>{{ $all->name}}</td>
					<td>{{ $all->email}}</td>
					@if(is_null($all->CanInfo)) 
					<td>NoData</td>
					@else

					@if(is_null($all->CanInfo->job)) 
					<td>No Data</td>
					@else
					<td>{{ $all->CanInfo->job->name}}</td>
					@endif
					@endif
					@if(is_null($all->CanInfo)) 
					<td>NoData</td>

					@else

					@if($all->CanInfo->gender==0)
					<td>Male</td>
					@else
					<td>Female</td>
					@endif
					@endif

					@if(is_null($all->CanInfo)) 
					<td>NoData</td>
					@else

					@if(is_null($all->CanInfo->country)) 
					<td>No Data</td>
					@else
					<td>{{ $all->CanInfo->country->name}}</td>
					@endif
					@endif
					@if(is_null($all->CanInfo)) 
					<td>NoData</td>
					@else

					@if(is_null($all->CanInfo->industry)) 
					<td>No Data</td>
					@else
					<td>{{ $all->CanInfo->industry->name}}</td>
					@endif
					@endif
			<td>
	 
<a  href="/Candidate/{{$all->id}}/edit" class="btn btn-default btn-sm" ><span class="fa fa-edit"></span>  </a>
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