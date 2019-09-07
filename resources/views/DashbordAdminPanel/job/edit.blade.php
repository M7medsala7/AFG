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
  <form  action="{{route('jobadminedit', $postjobadmin->id)}}" method="post"  class="formlogin "   enctype="multipart/form-data">
                    
  <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <fieldset style="    padding: .35em .625em .75em; margin: 0 2px; border: 1px solid silver;">
        
  <legend style="width: fit-content;border: 0px;">Company Info:</legend>


<div class="col-lg-12">


@if($postjobadmin->job_for !='family' && $postjobadmin->job_for !='agency' && $postjobadmin->job_for !='company' )

           <div class="row form-group">
                            <div class="col-sm-3 airports availability"> Company</div>
                             <label class="col-sm-2 airports">
                  <input type="radio" name="job_for" value="family" >
                  <span class="label-text" >Family</span> </label>

                <label class="col-sm-2 airports">
                  <input type="radio" name="job_for" value="company" >
                  <span class="label-text" >Company</span> </label>
                <label class="col-sm-2 airports">
                  <input type="radio" name="job_for" value="agency">
                  <span class="label-text" >Agency</span> </label>
<label class="col-sm-2 airports">
                 <input type="radio" name="job_for" value="{{$postjobadmin->job_for}}" checked="">
                  <span class="label-text" >Other</span> </label>
                </div>

@else
	 <div class="row form-group">
                            <div class="col-sm-3 airports availability"> Company</div>

                             <label class="col-sm-2 airports">
                  <input type="radio" name="job_for" value="family" {{ $postjobadmin->job_for == 'family' ? 'checked' : ''}}>
                  <span class="label-text" >Family</span> </label>

                <label class="col-sm-2 airports">
                  <input type="radio" name="job_for" value="company" {{ $postjobadmin->job_for == 'company' ? 'checked' : ''}}>
                  <span class="label-text" >Company</span> </label>
                <label class="col-sm-2 airports">
                  <input type="radio" name="job_for" value="agency" {{ $postjobadmin->job_for == 'agency' ? 'checked' : ''}}>
                  <span class="label-text" >Agency</span> </label>

                 <label class="col-sm-2 airports">
                  <input type="radio" name="job_for" value="{{$postjobadmin->job_for}}" >
                  <span class="label-text" >Other</span> </label>
                </div>
@endif


                 <div class="form-row">
    <div class="col-md-12 ">
      <label > Company Name*</label>
      @if(is_null($postjobadmin->user->company))
     <input type="text" class="form-control "  id="company_name" value="" name="company_name">

     @else
     <input type="text" class="form-control "  id="company_name" value="{{$postjobadmin->user->company->name}}" name="company_name">
@endif
    </div>
</div>


                <div class="form-row">
    <div class="col-md-6 ">
      <label >Name*</label>
    
     <input type="text" class="form-control "  id="Name" value="{{$postjobadmin->user->name}}" name="Name">

    </div>

     <div class="col-md-6 ">
      <label >Phone</label>
       @if(is_null($postjobadmin->user->EmpInfo))
     <input type="Number" class="form-control "  id="phone" value="" name="phone">

     @else
     <input type="Number" class="form-control "  id="phone" value="{{$postjobadmin->user->EmpInfo->phone}}" name="phone">
@endif
    </div>
</div>


               <div class="form-row">
    <div class="col-md-6 ">
      <label >Email*</label>
    
     <input type="email" class="form-control "  id="email" value="{{$postjobadmin->user->email}}" name="email">

    </div>

     <div class="col-md-6 ">
      <label >Password*</label>
    
     <input type="password" class="form-control "  id="password" value="{{$postjobadmin->user->password}}" name="password">

    </div>
</div>
</div>
</fieldset>
 <fieldset style="    padding: .35em .625em .75em; margin: 0 2px; border: 1px solid silver;">
        
  <legend style="width: fit-content;border: 0px;">Job Info:</legend>
<div class="col-lg-12">
               <div class="form-row">
					<div class="col-md-12 ">
					<label rname">Desired Job*</label>
					<div class="input-group">

					<select  name="job" class="job" style="width: 100%">

					<option selected="" disabled="disabled" >Choose a Desired Job... </option>




					@foreach(\App\Job::all() as $job)
					         <option value="{{ $job->id }}" {{ $job->id == $postjobadmin->job->id ? 'selected' : '' }}>{{ $job->name }}</option>

					@endforeach



					</select>
					</div>
					</div>


</div>


            <div class="form-row">
					<div class="col-md-12 ">
					<label rname">Industry</label>
					<div class="input-group">

					<select  name="Industry" class="Industry" style="width: 100%">

					<option selected="" disabled="disabled" >Choose a Industry... </option>


 @if(is_null($postjobadmin->Industry))
              @foreach(\App\Industry::all() as $Industry)
                            <option value="{{$Industry->id}}" >{{$Industry->name}}</option>

              @endforeach
@else
					@foreach(\App\Industry::all() as $Industry)
					         <option value="{{ $Industry->id }}" {{ $Industry->id == $postjobadmin->Industry->id ? 'selected' : '' }}>{{ $Industry->name }}</option>

					@endforeach
@endif


					</select>
					</div>
					</div>
                   </div>



            <div class="form-row">
					<div class="col-md-12 ">
					<label rname">Job Location*</label>
					<div class="input-group">

					<select  name="country" class="country" style="width: 100%">

					<option selected="" disabled="disabled" >Choose a Job Location... </option>




					@foreach(\App\Country::all() as $country)
					         <option value="{{ $country->id }}" {{ $country->id == $postjobadmin->country->id ? 'selected' : '' }}>{{ $country->name }}</option>

					@endforeach



					</select>
					</div>
					</div>
                   </div>


                                  <div class="form-row">
    <div class="col-md-12 ">
      <label >No.of candidates</label>
    
     <input type="number" class="form-control "  id="num_of_candidates" value="{{$postjobadmin->num_of_candidates}}" name="num_of_candidates">

    </div>
</div>
</div>

</fieldset>

 <fieldset style="    padding: .35em .625em .75em; margin: 0 2px; border: 1px solid silver;">
        
  <legend style="width: fit-content;border: 0px;">More Info:</legend>

<div class="col-lg-12">
<div class="row form-group">
                            <div class="col-sm-4 airports availability"> Gender</div>

                             <label class="col-sm-4 airports">
                  <input type="radio" name="gender" value="male" {{ $postjobadmin->prefered_gender == 'male' ? 'checked' : ''}}>
                  <span class="label-text" >Male</span> </label>

                <label class="col-sm-4 airports">
                  <input type="radio" name="gender" value="female" {{ $postjobadmin->prefered_gender == 'female' ? 'checked' : ''}}>
                  <span class="label-text" >Femal</span> </label>
               

               
                </div>


		<div class="form-row">
		<div class="col-md-12 ">
		<label >Job descripton</label>

		<textarea type="text" class="form-control "  id="job_descripton"  name="job_descripton">{{$postjobadmin->job_descripton}}</textarea>

		</div>
		</div>


					<div class="form-row">
				<div class="col-md-12 ">
				<label >Job requirements</label>

				<textarea type="text" class="form-control "  id="job_requirements" name="job_requirements">{{$postjobadmin->job_requirements}}</textarea>

				</div>
				</div>

								<div class="form-row">
				<div class="col-md-12 ">
				<label >Availability</label>

				<input type="date" class="form-control "  id="Availability" value="{{$postjobadmin->availability}}" name="availability">

				</div>
				</div>


				  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label > Language</label>
           <select data-placeholder="Choose a Language..." class="standardSelect" tabindex="1" name="Language[]" multiple="" >
              <option value=""></option>
@foreach (\App\Language::all() as $lang)

    <option value="{{ $lang->id }}"
            {{ isset($postjobadmin->job->getJobLanguage) && in_array( $lang->id, $postjobadmin->job->getJobLanguage->pluck('id')->toArray()) ? 'selected' : '' }}>
        {{ $lang->name }}</option>
@endforeach 


            
            </select>    
        </div>

            <div class="col-md-6 mb-3">
      <label > Skills</label>
           <select data-placeholder="Choose a Skills..." class="standardSelect" tabindex="1" name="Skills[]" multiple="" >
              <option value=""></option>
@foreach (\App\Skills::all() as $Skills)

    <option value="{{ $Skills->id }}"
            {{ isset($postjobadmin->job->getJobSkill) && in_array( $Skills->id, $postjobadmin->job->getJobSkill->pluck('id')->toArray()) ? 'selected' : '' }}>
        {{ $Skills->name }}</option>
@endforeach 


            
            </select>    
        </div>
        </div>

        <div class="form-group">  
                     <div class="col-md-4 mb-3">
      <label >From</label>
     
                <input type="Number" class="form-control "  id="min_salary" value="{{$postjobadmin->min_salary}}" name="min_salary">

          
            
    </div>

     <div class="col-md-4 mb-3">
      <label >to</label>
     
              <input type="Number" class="form-control "  id="maxsalary" value="{{$postjobadmin->max_salary}}" name="maxsalary">

          
            
    </div>

        <div class="col-md-4 mb-3">

      <label > Currency</label>

        <select  tabindex="1" name="Currency" class="Currency" style="width: 100%">

             <option selected="" disabled="disabled" >Choose A Currency ... </option>

              @if(is_null($postjobadmin->Currency))
              @foreach(\App\Currency::all() as $Currency)
              
              <option value="{{$Currency->id}}" >{{$Currency->name}}</option>
              @endforeach

              @else


            			@foreach(\App\Currency::all() as $Currency)
					         <option value="{{ $Currency->id }}" {{ $Currency->id == $postjobadmin->Currency->id ? 'selected' : '' }}>{{ $Currency->name }}</option>

					@endforeach
@endif

              
              </select>

          
            
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
   $('.country').select2();
   $('.Industry').select2();
   $('.job').select2();
$('.Currency').select2();


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

<script type="text/javascript" src="/vendor/jsvalidation/js/jsvalidation.js"></script>
<script src="/dist/jquery.validate.js"></script>

 {!! JsValidator::formRequest('App\Http\Requests\EditJobAdminFromRequests', '.formlogin'); !!} 
@endsection

