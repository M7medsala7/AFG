@extends('DashbordAdminPanel.layout.master')

@section('content')
	
<style>
    .hide{
        display:none
    }
    </style>

@if(Session::has('flash'))
    <div class="alert alert-success">
        {{ Session::get('flash') }}<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
@endif

<div class="modal fade bd-example-modal-lg" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
    
      
    <div class="modal-body">
  
</div> <!-- end modal-body -->
</div><!-- end modal-content -->
</div><!-- end modal-dialog -->
</div><!-- end myModal1 -->



 <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Sucess Story</strong>
                        </div>
                        <div class="card-body">
                          <!-- Credit Card -->
                          <div id="pay-invoice">
                              <div class="card-body">
                                  <div class="card-title">
                                      <h3 class="text-center">Edit {{$data->user->name }} Story</h3>
                                  </div>
                                   <hr>
  <form  action="/editsucessstory" method="post"  class="formlogin mergform"  novalidate enctype="multipart/form-data">
                    
  <input type="hidden" name="_token" value="{{ csrf_token() }}">



       <input type="hidden" id="id" name="id" value="{{ $data['id'] }}">
       <fieldset style="    padding: .35em .625em .75em; margin: 0 2px; border: 1px solid silver;">
        
  <legend style="width: fit-content;border: 0px;">Story Data:</legend>



  <div class="form-row">
  <!-- <div class="col-md-4 mb-3">
      <label for="validationDefault01"> User Name</label>
     <input readonly="readonly" type="text" class="form-control "  id="Name" value="{{$data->user->name }}" name="name">
    </div>
    <br> -->
    <div class="col-md-12 mb-3">
      <label for="validationDefault02">Description</label>
      <textarea  class="form-control" id="validationDefault02" placeholder="talk about your experiences"  name="description">{{$data->description}}
    </textarea>
    </div>

  
  </div>


 


</fieldset>
<br>
<fieldset>
       

<div style="padding-bottom:30px;">

   </div>
             
</fieldset>




<br>
       <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
          <!-- <a  class="btn btn-primary " href="/offlineneew/public/users">Cancel</a> -->
                         <!-- <button class="btn btn-primary" type="reset">Reset</button> -->
                          <button type="submit"  name="login_form_submit" class="btn btn-success"  >Edit Story</button>
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



  
  });
  
});
</script>

@endsection

