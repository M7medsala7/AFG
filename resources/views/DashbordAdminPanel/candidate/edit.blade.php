@extends('DashbordAdminPanel.layout.master')

@section('content')

<div class="row">

 <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Canidate</strong>
                        </div>
                        <div class="card-body">
                          <!-- Credit Card -->
                          <div id="pay-invoice">
                              <div class="card-body">
                                  <div class="card-title">
                                      <h3 class="text-center">Edit Candidate</h3>
                                  </div>
                                   <hr>
  <form  action="/candidateadminedit" method="post"  class="formlogin mergform"  novalidate enctype="multipart/form-data">
                    
  <input type="hidden" name="_token" value="{{ csrf_token() }}">



       <input type="hidden" id="id" name="id" value="{{ $candidateadmin['id'] }}">
       <fieldset style="    padding: .35em .625em .75em; margin: 0 2px; border: 1px solid silver;">
        
  <legend style="width: fit-content;border: 0px;">Personal Data:</legend>



  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault01"> Name</label>
     <input type="text" class="form-control "  id="Name" value="{{ $candidateadmin['name'] }}" name="Name">
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Last name</label>
      <input type="text" class="form-control" id="validationDefault02" placeholder="Last name" value="{{ $candidateadmin->CanInfo['last_name'] }}" name="LastName">
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefaultUsername">Nationality</label>
      <div class="input-group">
        
          <select data-placeholder="Choose a Nationality..." class="standardSelect" tabindex="1" name="Nationality" >
              <option value=""></option>

              @if(is_null($candidateadmin->CanInfo))
              @foreach(\App\Nationality::all() as $Nationality)
                            <option value="{{$Nationality->id}}" >{{$Nationality->name}}</option>

              @endforeach
              
@Elseif( !is_null($candidateadmin->CanInfo->nationality ))
              @foreach(\App\Nationality::all() as $Nationality)
                             <option value="{{ $Nationality->id }}" {{ $Nationality->id == $candidateadmin->CanInfo->nationality->id ? 'selected' : '' }}>{{ $Nationality->name }}</option>

              @endforeach

              @else
              @foreach(\App\Nationality::all() as $Nationality)
                            <option value="{{$Nationality->id}}" >{{$Nationality->name}}</option>

              @endforeach
              @endif

              </select>
      </div>
    </div>
  </div>


  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault01"> Email</label>
     <input type="text" class="form-control "  id="Name" value="{{ $candidateadmin['email'] }}" name="email">
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Password</label>
      <input type="password" class="form-control" id="validationDefault02" placeholder="Password" value="{{ $candidateadmin['password'] }}" name="password">
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefaultUsername">Location</label>
      <div class="input-group">
        
          <select data-placeholder="Choose a Country..." class="standardSelect" tabindex="1" name="Nationality" >
              <option value=""></option>
@if(is_null($candidateadmin->CanInfo))

                 @foreach(\App\Country::all() as $Country)
              <option value="{{ $Country->id }}">{{ $Country->name }}</option>

              @endforeach
@elseif(is_null($candidateadmin->CanInfo->country))

    @foreach(\App\Country::all() as $Country)
              <option value="{{ $Country->id }}">{{ $Country->name }}</option>

              @endforeach
              @else
                @foreach(\App\Country::all() as $Country)
                             <option value="{{ $Country->id }}" {{ $Country->id == $candidateadmin->CanInfo->country->id ? 'selected' : '' }}>{{ $Country->name }}</option>

              @endforeach

              @endif
              </select>
      </div>
    </div>
  </div>


    <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault01"> Phone Number</label>
     <input type="text" class="form-control "  id="phone_number" value="{{ $candidateadmin->CanInfo['phone_number'] }}" name="phone_number">
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Gender</label>
        <select data-placeholder="Choose a Gender..." class="standardSelect" tabindex="1" name="gender" >
              <option value=""> </option>

              @if(is_null($candidateadmin->CanInfo))

               <option value="0"> Male</option>

  <option value="1"> Female</option>
  @else
                           
 <option value="0" {{ $candidateadmin->CanInfo->gender ==0  ? 'selected' : '' }}> Male</option>

  <option value="1" {{ $candidateadmin->CanInfo->gender ==1  ? 'selected' : '' }}> Female</option>
  @endif
              
              </select>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefaultUsername">Martial Status</label>
      <div class="input-group">
        
                        <select data-placeholder="Choose a Martial Status..." class="standardSelect" tabindex="1" name="martial_status" >
              <option value=""> </option>
  @if(is_null($candidateadmin->CanInfo))
              
    
    <option value="single" > Single</option>

  <option value="married"> Married</option>

    <option value="devorced"> Devorced</option>
    @else                      
 <option value="single" {{ $candidateadmin->CanInfo->martial_status =='single'  ? 'selected' : '' }}> Single</option>

  <option value="married" {{ $candidateadmin->CanInfo->martial_status =='married' ? 'selected' : '' }}> Married</option>
  <option value="devorced" {{ $candidateadmin->CanInfo->martial_status =='devorced'  ? 'selected' : '' }}> Devorced</option>

  @endif

    
              
              </select>
         
      </div>
    </div>
  </div>


   <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationDefault01">Birtdate</label>
     <input type="Date" class="form-control has-feedback"  value="{{ $candidateadmin->CanInfo['birthdate'] }}" name="Birtdate"  placeholder="Password">
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationDefault02">Religion</label>
     
                <select data-placeholder="Choose a Religion..." class="standardSelect" tabindex="1" name="religion_id" >
              <option value=""></option>

              @if(is_null($candidateadmin->CanInfo))
          @foreach(\App\Religion::all() as $Religion)
               <option value="{{ $Religion->id }}"> {{ $Religion->name }}</option>
@endforeach

@elseif( !is_null($candidateadmin->CanInfo->religion ))
              @foreach(\App\Religion::all() as $Religion)
                             <option value="{{ $Religion->id }}" {{ $Religion->id == $candidateadmin->CanInfo->religion->id ? 'selected' : '' }}>{{ $Religion->name }}</option>

              @endforeach
              @else
              @foreach(\App\Religion::all() as $Religion)
               <option value="{{ $Religion->id }}"> {{ $Religion->name }}</option>
@endforeach
@endif
            </select>
    </div>
    
  </div>


    


   <div class="form-row">
       <div class="col-md-6 mb-3">
          
            <div class="input-group">
                <label class="input-group-btn">
                    <span class="btn btn-primary">
                       Upload CV <input type="file" name="cv_path" style="display: none;" >
                    </span>
                </label>
                <input type="text" class="form-control" readonly>
            </div>
           
        </div>
    <div class="col-md-6 mb-3">
     
       <div class="input-group">
                <label class="input-group-btn">
                    <span class="btn btn-primary">
                       Upload Video <input type="file" name="video_file" style="display: none;" >
                    </span>
                </label>
                <input type="text" class="form-control" readonly>
            </div>
              
    
  </div>
</div>


   <div class="form-row">
    
    <div class="col-md-6 mb-3">
      <label for="validationDefault02">Visa type</label>
     
    <select data-placeholder="Choose a Visa Type..." class="standardSelect" tabindex="1" name="visa_type" >
               @if(is_null($candidateadmin->CanInfo))
             <option value="None" > None</option>

  <option value="Employed" > Employed</option>

    <option value="Visit"> Visit</option>

     <option value="Cancelled" > Cancelled</option>
               @else


              <option value="None" {{ $candidateadmin->CanInfo->visa_type =='None'  ? 'selected' : '' }}> None</option>

  <option value="Employed" {{ $candidateadmin->CanInfo->visa_type =='Employed' ? 'Employed' : '' }}> Employed</option>

    <option value="Visit" {{ $candidateadmin->CanInfo->visa_type =='Visit'  ? 'selected' : '' }}> Visit</option>

     <option value="Cancelled" {{ $candidateadmin->CanInfo->visa_type =='Cancelled'  ? 'selected' : '' }}> Cancelled</option>

     @endif
            </select>
    </div>


  
    <div class="col-md-6 mb-3">
      <label for="validationDefault02">Expired Date</label>
     @if(is_null($candidateadmin->CanInfo))
     <input type="date" class="form-control " name="visa_expire_date" placeholder="expired date visa" value="">
     @else

              <input type="date" class="form-control " name="visa_expire_date" placeholder="expired date visa" value="{{$candidateadmin->CanInfo->visa_expire_date}}">
              @endif
         
    </div>
  </div>
    
  
    

</fieldset>


       <fieldset style="    padding: .35em .625em .75em; margin: 0 2px; border: 1px solid silver;">
        
  <legend style="width: fit-content;border: 0px;">Your profile:</legend>



  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationDefault01"> Language</label>
           <select data-placeholder="Choose a Language..." class="standardSelect" tabindex="1" name="Language[]" multiple="" >
              <option value=""></option>
@foreach (\App\Language::all() as $lang)

    


    <option value="{{ $lang->id }}"
            {{ isset($candidateadmin->CanInfo->getCandidateLang) && in_array( $lang->id, $candidateadmin->CanInfo->getCandidateLang->pluck('id')->toArray()) ? 'selected' : '' }}>
        {{ $lang->name }}</option>
@endforeach 


            
            </select>    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Education</label>

     
         <select data-placeholder="Choose a Education level..." class="standardSelect" tabindex="1" name="educational_level" >
        
               @if(is_null($candidateadmin->CanInfo))
                 <option value=""></option>
             <option value="High school">High school</option>
                <option value="Undergraduate">Undergraduate </option>
                <option  value="University Graduate">University Graduate </option>
                <option value="Masters">Masters</option>>
               @else

 <option value="" ></option>
              <option value="High school" {{ $candidateadmin->CanInfo->Eductionlevel =='High school'  ? 'selected' : '' }}> High school</option>

  <option value="High school" {{ $candidateadmin->CanInfo->Eductionlevel =='Employed' ? 'High school<' : '' }}> High school</option>

    <option value="University Graduate" {{ $candidateadmin->CanInfo->Eductionlevel =='University Graduate'  ? 'selected' : '' }}> University Graduate</option>

     <option value="Masters" {{ $candidateadmin->CanInfo->Eductionlevel =='Masters'  ? 'selected' : '' }}> Masters</option>

     @endif
            </select>  

    </div>
    
  </div>







   <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationDefault01"> Skills</label>
           <select data-placeholder="Choose a Skills..." class="standardSelect" tabindex="1" name="Skills[]" multiple="" >
             
@foreach (\App\Skills::all() as $Skills)

      <option value=""></option>


    <option value="{{ $Skills->id }}"
            {{ isset($candidateadmin->CanInfo->getCandidateSkill) && in_array( $Skills->id, $candidateadmin->CanInfo->getCandidateSkill->pluck('id')->toArray()) ? 'selected' : '' }}>
        {{ $Skills->name }}</option>
@endforeach 


            
            </select> 
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationDefault02">Other Skills</label>
     
               <input type="text" class="form-control " name="Other_Skills" placeholder="Other Skills" >

          
            
    </div>
    
  </div>


    


   <div class="form-row">
       <div class="col-md-6 mb-3">
          <label for="validationDefault02">Description</label>
        @if(is_null($candidateadmin->CanInfo))
   <textarea class="form-control " name="descripe_yourself" placeholder="describe your self in one sentence" value=""> </textarea>
     @else

              <textarea  class="form-control " name="descripe_yourself" placeholder="describe your self in one sentence" value="{{$candidateadmin->CanInfo->descripe_yourself}}"></textarea>
              @endif
           
        </div>

</div>
</fieldset>


<fieldset style="    padding: .35em .625em .75em; margin: 0 2px; border: 1px solid silver;">
        
  <legend style="width: fit-content;border: 0px;">Job Expectations:</legend>



  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationDefault01"> Actively Looking For A Job
</label>

@if(is_null($candidateadmin->CanInfo))
    <div class="form-check-inline form-check">
                                <label for="inline-radio1" class="form-check-label ">
                                  <input type="radio" id="inline-radio1" name="gender" value="0" class="form-check-input">Yes
                                </label>


                                <label for="inline-radio2" class="form-check-label " >
                                  <input type="radio" id="inline-radio2" name="inline-radios" value="1" class="form-check-input " >No
                                </label>
                               
                              </div>

                              @else

                               <div class="form-check-inline form-check">
                                <label for="inline-radio1" class="form-check-label ">
                                  <input type="radio" id="inline-radio1" name="looking_for_job" value="0" {{ $candidateadmin->CanInfo->looking_for_job == '0' ? 'checked' : ''}}" class="form-check-input"> Yes
                                </label>


                                <label for="inline-radio2" class="form-check-label " >
                                  <input type="radio" id="inline-radio1" name="looking_for_job" value="1" {{ $candidateadmin->CanInfo->looking_for_job == '1' ? 'checked' : ''}}" class="form-check-input"> No
                                </label>
                               
                              </div>
                              @endif


           </div>

    
  </div>

<div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationDefault01"> Job</label>
            <select data-placeholder="Choose a Job..." class="standardSelect" tabindex="1" name="job_id" >
              <option value=""></option>

              @if(is_null($candidateadmin->CanInfo))
          @foreach(\App\Job::all() as $job)
               <option value="{{ $job->id }}"> {{ $job->name }}</option>
@endforeach

@elseif( !is_null($candidateadmin->CanInfo->job ))
              @foreach(\App\job::all() as $job)
                             <option value="{{ $job->id }}" {{ $job->id == $candidateadmin->CanInfo->job->id ? 'selected' : '' }}>{{ $job->name }}</option>

              @endforeach
              @else
              @foreach(\App\job::all() as $job)
               <option value="{{ $job->id }}"> {{ $job->name }}</option>
@endforeach
@endif
            </select> 
    </div>

</div>


   <div class="form-row">
@if( is_null($candidateadmin->CanInfo ))
     <div class="col-md-4 mb-3">
      <label for="validationDefault02">From</label>
     
                <input type="Number" class="form-control "  id="salary" value="" name="salay">

          
            
    </div>

     <div class="col-md-4 mb-3">
      <label for="validationDefault02">to</label>
     
              <input type="Number" class="form-control "  id="MaxSalary" value="" name="MaxSalary">

          
            
    </div>

    @else

         <div class="col-md-4 mb-3">
      <label for="validationDefault02">From</label>
     
                <input type="Number" class="form-control "  id="salary" value="{{$candidateadmin->CanInfo['salary']}}" name="salary">

          
            
    </div>

     <div class="col-md-4 mb-3">
      <label for="validationDefault02">To</label>
     
              <input type="Number" class="form-control "  id="MaxSalary" value="{{$candidateadmin->CanInfo['MaxSalary']}}" name="MaxSalary">

          
            
    </div>

    @endif
    <div class="col-md-4 mb-3">
      <label for="validationDefault01"> Currency</label>
            <select data-placeholder="Choose a Currency..." class="standardSelect" tabindex="1" name="CurrencyId" >
              <option value=""></option>

              @if(is_null($candidateadmin->CanInfo))
          @foreach(\App\Currency::all() as $Currency)
               <option value="{{ $Currency->id }}"> {{ $Currency->name }}</option>
@endforeach


@elseif( !is_null($candidateadmin->CanInfo->currency ))
  
              @foreach(\App\Currency::all() as $Currency)
                <option value=""></option>
                             <option value="{{ $Currency->id }}" {{ $Currency->id == $candidateadmin->CanInfo->currency->id ? 'selected' : '' }}>{{ $Currency->name }}</option>

              @endforeach
              @else
              @foreach(\App\Currency::all() as $Currency)
              <option value=""></option>
               <option value="{{ $Currency->id }}"> {{ $Currency->name }}</option>
@endforeach
@endif
            </select> 
    </div>
   
    
  </div>


    


   <div class="form-row">


    
    <div class="col-md-6 mb-3">
      <label for="validationDefault02">where do you wish to work at ?</label>
     
                <select data-placeholder="Choose a Country..." class="standardSelect" tabindex="1" name="prefered_location_id" >
              <option value=""></option>

              @if(is_null($candidateadmin->CanInfo))
          @foreach(\App\Country::all() as $Country)
               <option value="{{ $Country->id }}"> {{ $Country->name }}</option>
@endforeach

@elseif( !is_null($candidateadmin->CanInfo->country ))
              @foreach(\App\Country::all() as $Country)
                             <option value="{{ $Country->id }}" {{ $Country->id == $candidateadmin->CanInfo->country->id ? 'selected' : '' }}>{{ $Country->name }}</option>

              @endforeach
              @else
              @foreach(\App\Country::all() as $Country)
               <option value="{{ $Country->id }}"> {{ $Country->name }}</option>
@endforeach
@endif
            </select>
    </div>
       <div class="col-md-6 mb-3">
          <label for="validationDefault01">you can select multicountries you wish to work at ?</label>
           <select data-placeholder="you can select multicountries you wish to work at." class="standardSelect" tabindex="1" name="prefered_location_ids[]" multiple="" >
              <option value=""></option>
@foreach (\App\Country::all() as $Country)

    


    <option value="{{ $Country->id }}"
            {{ isset($candidateadmin->CanInfo->getCandidatePreferedLoc) && in_array( $Country->id, $candidateadmin->CanInfo->getCandidatePreferedLoc->pluck('id')->toArray()) ? 'selected' : '' }}>
        {{ $Country->name }}</option>
@endforeach 


            
            </select>
    
           
        </div>

</div>
</fieldset>

<fieldset style="    padding: .35em .625em .75em; margin: 0 2px; border: 1px solid silver;">
        
  <legend style="width: fit-content;border: 0px;">Experience:</legend>
@if(is_null($candidateadmin->CanInfo))


  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationDefault01"> From
</label>


        <input type="Date" class="form-control has-feedback" value="" name="start_date"  placeholder="start date">

                              


           </div>

               <div class="col-md-6 mb-3">
      <label for="validationDefault01"> To
</label>


        <input type="Date" class="form-control has-feedback" value="" name="end_date"  placeholder="end date">

                              


           </div>

    
  </div>



 <div class="form-row">
    <div class="col-md-9 mb-3">
      <label for="validationDefault01"> Company
</label>


        <input type="text" class="form-control has-feedback" value="" name="company_name"  placeholder="company/family name">

                              


           </div>

  

    
  </div>



   <div class="form-row"> 
    <div class="col-md-9 mb-3">
      <label for="validationDefault01"> Country</label>
            <select data-placeholder="Choose a Country..." class="standardSelect" tabindex="1" name="work_country_id" >
              <option value=""></option>

    


             
              @foreach(\App\Country::all() as $Country)
               <option value="{{ $Country->id }}"> {{ $Country->name }}</option>

@endforeach
            </select> 
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-9 mb-3">
      <label for="validationDefault01"> Employer Nationality</label>
            <select data-placeholder="Choose a Country..." class="standardSelect" tabindex="1" name="employer_nationality_id" >
              <option value=""></option>

    


             
              @foreach(\App\Nationality::all() as $Nationality)
               <option value="{{ $Nationality->id }}"> {{ $Nationality->name }}</option>

@endforeach
            </select> 
    </div>
  </div>
  <div class="form-row">
  <div class="col-md-9 mb-3">
      <label for="validationDefault01"> Salary May Be</label>
              <input type="text" class="form-control " name="salary" placeholder="Salary May Be" >
    </div>
  </div>
<div class="form-row">

 <div class="col-md-9 mb-3">
      <label for="validationDefault01"> what is your tasks in company</label>
       <textarea class="form-control " name="role" placeholder=" what is your tasks in company"></textarea>
          
    </div>
  </div>

    
@elseif(is_null($candidateadmin->CanInfo->CanExperince))

     <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationDefault01"> From
</label>


        <input type="Date" class="form-control has-feedback" value="" name="start_date"  placeholder="start date">

                              


           </div>

               <div class="col-md-6 mb-3">
      <label for="validationDefault01"> To
</label>


        <input type="Date" class="form-control has-feedback" value="" name="end_date"  placeholder="end date">

                              


           </div>

    
  </div>



 <div class="form-row">
    <div class="col-md-9 mb-3">
      <label for="validationDefault01"> Company
</label>


        <input type="text" class="form-control has-feedback" value="" name="company_name"  placeholder="company/family name">

                              


           </div>

  

    
  </div>


<div class="form-row">
    
    <div class="col-md-9 mb-3">
      <label for="validationDefault01"> Country</label>
            <select data-placeholder="Choose a Country..." class="standardSelect" tabindex="1" name="work_country_id" >
              <option value=""></option>

    


             
              @foreach(\App\Country::all() as $Country)
               <option value="{{ $Country->id }}"> {{ $Country->name }}</option>
@endforeach

            </select> 
    </div>
  </div>
    <div class="form-row">
    <div class="col-md-9 mb-3">
      <label for="validationDefault01"> Employer Nationality</label>
            <select data-placeholder="Choose a Country..." class="standardSelect" tabindex="1" name="employer_nationality_id" >
              <option value=""></option>

    


             
              @foreach(\App\Nationality::all() as $Nationality)
               <option value="{{ $Nationality->id }}"> {{ $Nationality->name }}</option>

@endforeach
            </select> 
    </div>
  </div>
    <div class="form-row">
  <div class="col-md-9 mb-3">
      <label for="validationDefault01"> Salary May Be</label>
              <input type="text" class="form-control " name="exsalary" placeholder="Salary May Be" >
    </div>
  </div>

    <div class="form-row">
 <div class="col-md-9 mb-3">
      <label for="validationDefault01"> what is your tasks in company</label>
       <textarea class="form-control " name="role" placeholder=" what is your tasks in company"></textarea>
          
    </div> 
  </div>
    @else
     <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationDefault01"> From
</label>

@if(is_null($candidateadmin->CanInfo->CanExperince->start_date))

      <input type="Date" class="form-control has-feedback" value="" name="start_date"  placeholder="start date">
@else
        <input type="Date" class="form-control has-feedback" value="{{ $candidateadmin->CanInfo->CanExperince->start_date}}" name="start_date"  placeholder="start date">

                              
@endif

           </div>

               <div class="col-md-6 mb-3">
      <label for="validationDefault01"> To
</label>
@if( !is_null($candidateadmin->CanInfo->CanExperince->start_date))

        <input type="Date" class="form-control has-feedback" value="{{$candidateadmin->CanInfo->CanExperince->end_date}}" name="end_date"  placeholder="end date">
@else
<input type="Date" class="form-control has-feedback" value="" name="end_date"  placeholder="end date">
@endif
                              


           </div>

    
  </div>


       <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationDefault01"> company name
</label>

@if(is_null($candidateadmin->CanInfo->CanExperince->company_name))

      <input type="text" class="form-control has-feedback" value="" name="company_name"  placeholder="company/family name">
@else

<input type="text" class="form-control has-feedback" value="{{ $candidateadmin->CanInfo->CanExperince->company_name}}" name="company_name"  placeholder="company/family name">
        

                              
@endif

           </div>


    
  </div>




   <div class="form-row">
    
    <div class="col-md-6 mb-3">
      <label for="validationDefault02">Country</label>
     
                <select data-placeholder="Choose a Country..." class="standardSelect" tabindex="1" name="country_id" >
              <option value=""></option>

              @if(is_null($candidateadmin->CanInfo->CanExperince->experincecountry))
          @foreach(\App\Country::all() as $Country)
               <option value="{{ $Country->id }}"> {{ $Country->name }}</option>
@endforeach

@else
              @foreach(\App\Country::all() as $Country)
                             <option value="{{ $Country->id }}" {{ $Country->id == $candidateadmin->CanInfo->CanExperince->experincecountry->id ? 'selected' : '' }}>{{ $Country->name }}</option>

              @endforeach
   
@endif
            </select>
    </div>
    
  </div>


     <div class="form-row">
    
    <div class="col-md-6 mb-3">
      <label for="validationDefault02">Employer Nationality</label>
     
                <select data-placeholder="Choose a Employer Nationality..." class="standardSelect" tabindex="1" name="employer_nationality_id" >
              <option value=""></option>

              @if(is_null($candidateadmin->CanInfo->CanExperince->Empnationality))
          @foreach(\App\Nationality::all() as $Nationality)
               <option value="{{ $Nationality->id }}"> {{ $Nationality->name }}</option>
@endforeach

@else
              @foreach(\App\Nationality::all() as $Nationality)
                             <option value="{{ $Nationality->id }}" {{ $Nationality->id == $candidateadmin->CanInfo->CanExperince->Empnationality->id ? 'selected' : '' }}>{{ $Nationality->name }}</option>

              @endforeach
   
@endif
            </select>
    </div>
    
  </div>

           <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationDefault01"> Salary May Be
</label>

@if(is_null($candidateadmin->CanInfo->CanExperince->salary))

      <input type="text" class="form-control has-feedback" value="" name="salary"  placeholder="Salary May be">
@else

<input type="text" class="form-control has-feedback" value="{{ $candidateadmin->CanInfo->CanExperince->salary}}" name="exsalary"  placeholder="salary">
        

                              
@endif

           </div>


    
  </div>


           <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationDefault01"> what is your tasks in company
</label>

@if(is_null($candidateadmin->CanInfo->CanExperince->role))

      <input type="text" class="form-control has-feedback" value="" name="role"  placeholder="what is your tasks in company">
@else

<input type="text" class="form-control has-feedback" value="{{ $candidateadmin->CanInfo->CanExperince->role}}" name="role"  placeholder="what is your tasks in company">
        

                              
@endif

           </div>


    
  </div>
@endif
</fieldset>
<br></br>
       <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
          <a  class="btn btn-primary " href="/offlineneew/public/users">Cancel</a>
                         <button class="btn btn-primary" type="reset">Reset</button>
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
@endsection

