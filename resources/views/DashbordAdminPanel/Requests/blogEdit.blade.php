@extends('DashbordAdminPanel.layout.master')

@section('content')
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>

<script>
    tinymce.init({
        selector: "textarea",
        theme: "modern",
        width: 900,
        height: 300,
        plugins: [
             "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
             "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
             "save table contextmenu directionality emoticons template paste textcolor"
       ],
       content_css: "css/content.css",
       toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons", 
       style_formats: [
            {title: 'Bold text', inline: 'b'},
            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
            {title: 'Example 1', inline: 'span', classes: 'example1'},
            {title: 'Example 2', inline: 'span', classes: 'example2'},
            {title: 'Table styles'},
            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ]
    }); 
</script>	
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
                            <strong class="card-title">Blog</strong>
                        </div>
                        <div class="card-body">
                          <!-- Credit Card -->
                          <div id="pay-invoice">
                              <div class="card-body">
                                  <div class="card-title">
                                      <h3 class="text-center">Edit {{$blog->name }} Blog</h3>
                                  </div>
                                   <hr>
  <form  action="/updateblog" method="post"  class="formlogin mergform"  novalidate enctype="multipart/form-data">
                    
  <input type="hidden" name="_token" value="{{ csrf_token() }}">



       <input type="hidden" id="id" name="id" value="{{ $blog['id'] }}">
       <fieldset style="    padding: .35em .625em .75em; margin: 0 2px; border: 1px solid silver;">
        
  <legend style="width: fit-content;border: 0px;">blog Data:</legend>



  <div class="form-row">
  <div class="col-md-4 mb-3">
      <label for="validationDefault01"> Title</label>
     <input  type="text" class="form-control "  id="Name" value="{{$blog->name }}" name="name">
    </div>
    <br>

   

</div>
<br>
<div class="form-row">
    <div class="col-md-12 ">
 <input type='file' name="filename"onchange="readURL(this);" />
    <img id="blah" src="/{{$blog->image}}" alt="your image" style="    max-width: 40%;" />
    </div>

    </div>
    <div class="col-md-12 mb-3">
    <br>
      <label for="validationDefault02">Body</label>
   
    <textarea class="form-control col-md-7 col-xs-12" rows="15" name="body">
                    {{$blog->body}}
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
                          <button type="submit"  name="login_form_submit" class="btn btn-success"  >Edit blog</button>
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

   function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

  $(function() {

 

  // We can watch for our custom `fileselect` event like this
  $(document).ready( function() {



  
  });
  
});
</script>

@endsection

