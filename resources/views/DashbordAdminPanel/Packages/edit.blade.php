@extends('DashbordAdminPanel.layout.master')

@section('content')
	
<style>
    .hide{
        display:none
    }
    </style>
<div class="row">
@if(Session::has('flash'))
    <div class="alert alert-danger">
        {{ Session::get('flash') }}<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
@endif

<div class="modal fade bd-example-modal-lg" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
    
      
    <div class="modal-body">
  
<form  action="/addNewattribute" method="POST" id="profileForm" class="formlogin" enctype="multipart/form-data">
	{{ csrf_field()}}
  
   <fieldset style="padding: .35em .625em .75em; margin: 0 2px; border: 1px solid silver;">
      <legend style="width: fit-content;border: 0px;">Data :</legend>
 


      <div class="col-lg-12">
                   
                      
                     
					 <div class="row form-group">
                           
                           
                            </div>
                   
                 

    <div class="form-group col-xs-12">
                    <div class="col-xs-4" >
<input type="hidden" name="packid" id="packid" value="{{ $Packages['id'] }}">
   <select class="form-control requirments" name="name[]" id="name[]"  required=""  >
                   <option selected="" disabled="disabled" >attribute</option>
                    @foreach($attribute as $all)
                      <option value="{{$all->id}}">{{$all->name}}</option>
                    @endforeach
    </select>


                       
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
                          <select class="form-control requirments" name="name[]" id="name[]"  required=""  >
                   <option selected="" disabled="disabled" >attribute</option>
                    @foreach($attribute as $all)
                      <option value="{{$all->id}}">{{$all->name}}</option>
                    @endforeach
    </select>

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



 <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Packages</strong>
                        </div>
                        <div class="card-body">
                          <!-- Credit Card -->
                          <div id="pay-invoice">
                              <div class="card-body">
                                  <div class="card-title">
                                      <h3 class="text-center">Edit Packages</h3>
                                  </div>
                                   <hr>
  <form  action="/packagesedit" method="post"  class="formlogin mergform"  novalidate enctype="multipart/form-data">
                    
  <input type="hidden" name="_token" value="{{ csrf_token() }}">



       <input type="hidden" id="id" name="id" value="{{ $Packages['id'] }}">
       <fieldset style="    padding: .35em .625em .75em; margin: 0 2px; border: 1px solid silver;">
        
  <legend style="width: fit-content;border: 0px;">Package Data:</legend>



  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault01"> Name</label>
     <input type="text" class="form-control "  id="Name" value="{{ $Packages['name'] }}" name="name">
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Price/Month</label>
      <input type="text" class="form-control" id="validationDefault02" placeholder="Price/Month" value="{{ $Packages['price'] }}" name="price">
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Price/Month</label>
      <input type="text" class="form-control" id="validationDefault02" placeholder="Price/Month" value="{{ $Packages['Priceyear'] }}" name="Priceyear">
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">description</label>
      <input type="text" class="form-control" id="validationDefault02" placeholder=" description" value="{{ $Packages['description'] }}" name="description">
    </div>
  </div>


 


</fieldset>
<br>
<fieldset>
       
<legend style="width: fit-content;border: 0px;">Attributes Data:</legend>

<div style="padding-bottom:30px;">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1">
     Add New attribute
   </button>
   </div>
                  <table id="bootstrap-data-table" class="table table-striped table-bordered Packages">
                    <thead>
                      <tr>
                      	<!-- <th><input type="checkbox" id="check_all"></th> -->
                        <th>Name</th>
                        <th>Value/Month</th>
                        <th>Value/Year</th>
                        <th>Process</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($Packages->getpackattribute as $all)
                    <tr id="tr_{{$all->id}}">
                    <!-- <td><input type="checkbox" class="checkbox" data-id="{{$all->id}}"></td> -->
					<td>{{ $all->name}}</td>
				
          <td><input type="number" id="val" value="{{ $all->pivot->Value}}" onchange="saveval($( this ).val(),'{{$all->id}}')"> </td> 
          <td><input type="number" value="{{ $all->pivot->Valueyear}}" onchange="savevalyear($( this ).val(),'{{$all->id}}')"></td>
			
			
			<td>
	 
<a  href="/Delattribute/{{$all->id}}/{{$Packages['id'] }}" class="btn btn-default btn-sm" ><span class="fa fa-trash"></span>  </a>
			</td>
				
                      </tr>
                      @endforeach
                      
                   
                    
                    
                    </tbody>
                  </table>
</fieldset>




<br>
       <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
          <!-- <a  class="btn btn-primary " href="/offlineneew/public/users">Cancel</a> -->
                         <!-- <button class="btn btn-primary" type="reset">Reset</button> -->
                          <button type="submit"  name="login_form_submit" class="btn btn-success"  >Save</button>
                        </div>
                      </div>
</form>






 {!! JsValidator::formRequest('App\Http\Requests\AddCandidateAdminFormRequest', '.formlogin'); !!} 


                    

           

               

                  
        </div>
                          </div>

                        </div>
                    </div> <!-- .card -->

                  </div>
              </div>

@endsection



@section('scripts')
<script type="text/javascript" src="/vendor/jsvalidation/js/jsvalidation.js"></script>
<script src="/dist/jquery.validate.js"></script>
<script type="text/javascript">
  $(function() {

 

  // We can watch for our custom `fileselect` event like this
  $(document).ready( function() {


   $('#profileForm').on('click', '.addButton', function() {
            var $template = $('#emailTemplate'),
                $clone    = $template
                                .clone()
                                .removeClass('hide')
                                .removeAttr('id')
                                .insertBefore($template),
                $name    = $clone.find('[name="name[]"]'),
                $Valueyear    = $clone.find('[name="Valueyear[]"]'),
                $Value    = $clone.find('[name="Value[]"]');

            // Add new field
          
        })

        // Remove button click handler
        .on('click', '.removeButton', function() {
            var $row   = $(this).closest('.form-group'),
                $name = $row.find('[name="name[]"]'),
                $Valueyear    = $row.find('[name="Valueyear[]"]'),
                $Value    = $row.find('[name="Value[]"]');
            // Remove element containing the email
            $row.remove();

            // Remove field
        });

  
  });
  
});
</script>
<script>
  
  function saveval($val,$id)
  {
    console.log($val);
    $packId=$('#id').val();
    $.ajax({
      url: '/updateattrval',
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'POST',
      data: {"_token": "{{ csrf_token() }}",
      val:$val,id:$id,packId:$packId },
    });

  }
  function savevalyear($val,$id)
  {
    $packId=$('#id').val();
    $.ajax({
      url: '/updateattrvalyear',
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'POST',
      data: {"_token": "{{ csrf_token() }}",
      val:$val,id:$id,packId:$packId },
    });

  }
</script>
@endsection

