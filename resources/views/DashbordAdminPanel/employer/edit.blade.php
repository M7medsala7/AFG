@extends('DashbordAdminPanel.layout.master')

@section('content')

<div class="row">

 <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Job</strong>
                        </div>
                        <div class="card-body">
                          <!-- Credit Card -->
                          <div id="pay-invoice">
                              <div class="card-body">
                                  <div class="card-title">
                                      <h3 class="text-center">Edit Job</h3>
                                  </div>
                                   <hr>
  <form  action="{{route('employeradminedit', $employeradmin->id)}}" method="post"  class="formlogin "   enctype="multipart/form-data">
                    
  <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <fieldset style="    padding: .35em .625em .75em; margin: 0 2px; border: 1px solid silver;">
        
  <legend style="width: fit-content;border: 0px;">Basic Info:</legend>


<div class="col-lg-12">

@if(!is_null($employeradmin->EmpInfo))
	 <div class="row form-group">
                            <div class="col-sm-3 airports availability"> Company</div>

                             <label class="col-sm-2 airports">
                  <input type="radio" name="job_for" value="family" {{ $employeradmin->EmpInfo->type == 'family' ? 'checked' : ''}}>
                  <span class="label-text" >Family</span> </label>

                <label class="col-sm-2 airports">
                  <input type="radio" name="job_for" value="company" {{ $employeradmin->EmpInfo->type == 'company' ? 'checked' : ''}}>
                  <span class="label-text" >Company</span> </label>
                <label class="col-sm-2 airports">
                  <input type="radio" name="job_for" value="agency" {{ $employeradmin->EmpInfo->type == 'agency' ? 'checked' : ''}}>
                  <span class="label-text" >Agency</span> </label>

                
                </div>
@else
	 <div class="row form-group">
                            <div class="col-sm-3 airports availability"> Company</div>

                             <label class="col-sm-2 airports">
                  <input type="radio" name="job_for" value="family" checked="" >
                  <span class="label-text" >Family</span> </label>

                <label class="col-sm-2 airports">
                  <input type="radio" name="job_for" value="company" >
                  <span class="label-text" >Company</span> </label>
                <label class="col-sm-2 airports">
                  <input type="radio" name="job_for" value="agency" >
                  <span class="label-text" >Agency</span> </label>

                 
                </div>
                @endif


 



                <div class="form-row">
    <div class="col-md-6 ">
      <label > Name*</label>
    
     <input type="text" class="form-control "  id="Name" value="{{$employeradmin->name}}" name="Name">

    </div>

     <div class="col-md-6 ">
       <label > Last Name*</label>
    
     <input type="text" class="form-control "  id="Last_Name" value=" {{isset($employeradmin->EmpInfo) ? $employeradmin->EmpInfo->last_name: ''}}" name="Last_Name">

    </div>
</div>


               <div class="form-row">
    <div class="col-md-6 ">
      <label >Email*</label>
    
     <input type="email" class="form-control "  id="email" value="{{$employeradmin->email}}" name="email">

    </div>

     <div class="col-md-6 ">
      <label >Password*</label>
    
     <input type="password" class="form-control "  id="password" value="{{$employeradmin->password}}" name="password">

    </div>
</div>


                <div class="form-row">

                	 <div class="col-md-6 ">
      <label > Phone</label>
    
     <input type="text" class="form-control "  id="phone" value=" {{isset($employeradmin->EmpInfo) ? $employeradmin->EmpInfo->phone: ''}}" name="phone">

    </div>
    <div class="col-md-6 ">
      <label > Address</label>
    
     <input type="text" class="form-control "  id="address" value=" {{isset($employeradmin->EmpInfo) ? $employeradmin->EmpInfo->address: ''}}" name="address">

    </div>
    </div>


             <div class="form-row">
					<div class="col-md-6 ">
					<label rname">Country</label>
					<div class="input-group">

					<select  name="Country" class="Country" style="width: 100%" id="Country">

					<option selected="" disabled="disabled" >Choose a Country... </option>


 @if(is_null($employeradmin->EmpInfo))
              @foreach(\App\Country::all() as $Country)
                            <option value="{{$Country->id}}" >{{$Country->name}}</option>

              @endforeach


         @elseif(is_null($employeradmin->EmpInfo->country))
              @foreach(\App\Country::all() as $Country)
                            <option value="{{$Country->id}}" >{{$Country->name}}</option>

              @endforeach

@else
					@foreach(\App\Country::all() as $Country)
					         <option value="{{ $Country->id }}" {{ $Country->id == $employeradmin->EmpInfo->country->id ? 'selected' : '' }}>{{ $Country->name }}</option>

					@endforeach
@endif


					</select>
					</div>
					</div>

									<div class="col-md-6 ">
					<label rname">City</label>
					<div class="input-group">

					<select  name="City" class="City" style="width: 100%" id="City">

					<option selected="" disabled="disabled" >Choose a City... </option>


 @if(is_null($employeradmin->EmpInfo))
              @foreach(\App\City::all() as $City)
                            <option value="{{$City->id}}" >{{$City->name}}</option>

              @endforeach


         @elseif(is_null($employeradmin->EmpInfo->city))
              @foreach(\App\City::all() as $City)
                            <option value="{{$City->id}}" >{{$City->name}}</option>

              @endforeach

@else
					@foreach(\App\City::all() as $City)
					         <option value="{{ $City->id }}" {{ $City->id == $employeradmin->EmpInfo->city->id ? 'selected' : '' }}>{{ $City->name }}</option>

					@endforeach
@endif


					</select>
					</div>
					</div>
                   </div>


</div>
</div>
</fieldset>



<br></br>
       <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
          <a  class="btn btn-primary ">Cancel</a>
                         <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit"  name="login_form_submit" class="btn btn-success"  >Save</button>
                        </div>
                      </div>
</form>









                    

           

               

                  
        </div>
                          </div>

                        </div>
                    </div> <!-- .card -->

                  </div>
              </div>

@endsection



@section('scripts')

<script type="text/javascript">
$(document).ready(function () {
   $('.Country').select2();
 $('.City').select2();


 });
  $(function() {

  // We can attach the `fileselect` event to all file inputs on the page
  $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  // We can watch for our custom `fileselect` event like this
  $(document).ready( function() {
      $(':file').on('fileselect', function(event, numFiles, label) {

          var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;

          if( input.length ) {
              input.val(log);
          } else {
              if( log ) alert(log);
          }

      });
  });
  
});
</script>
<script type= "text/javascript" src = "/images/js/countries.js"></script>
<script>
  populateCountries("Country", "City"); // first parameter is id of country drop-down and second parameter is id of state drop-down
</script>
<script type="text/javascript" src="/vendor/jsvalidation/js/jsvalidation.js"></script>
<script src="/dist/jquery.validate.js"></script>

 {!! JsValidator::formRequest('App\Http\Requests\EditEmployerAdminFromRequests', '.formlogin'); !!} 
@endsection

