@extends('Layout.app')

<script src="//cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/12.1.0/classic/ckeditor.js"></script>

<script>
    tinymce.init({
        selector: "textarea",
        theme: "modern",
        width: 400,
        height: 250,
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
  .select2-selection__rendered{
    background: #f4f4f4;;
    border: 1px solid rgba(115, 115, 115, 0.48)!important;
    color: #000;
    float: left;
    width: 350px;
    height: 40px;
    border-radius: 5px;
    /* border: 0; */
    box-shadow: none;
    border: 2px solid #d7d7d7;
    margin-top: 10px;
        color: black!important;
  }
  .select2 select2-container select2-container 
  {
width:400px;
  }

  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 57px!important;

  }
  .select2-container .select2-selection--single
  {
    height: 0px!important;
  }
  .select2-container--default .select2-selection--single{    background-color: 0!important;border: 0!important}
  .watchvideo img{
    height: 20%!important;
  }
  .select2 select2-container select2-container--default
  {
    width: 300px;
  }
  .select2 select2-container select2-container--default select2-container--below
  {
    width:300px;
  }
 .select2-container--default .select2-selection--single .select2-selection__rendered
   {
    width:100%;

  }

   #step-2{
    display:none;
  }
</style>
@section('content')
<section class="sliderphoto innerphoto" style="background:url(/images/slide5.jpg) fixed center center no-repeat; background-size:cover;">
  <div class="container">
  <ul class="nav nav-tabs  tabssteps">
    <div class="liner"></div>
    <li rel-index="0" class="active"> <a href="#step-1" class="btn" aria-controls="step-1" role="tab" data-toggle="tab"> <span><i class="glyphicon glyphicon-user"></i></span> </a> </li>
    <li rel-index="1"> <a href="#step-2" class="btn disabled" aria-controls="step-2" role="tab" data-toggle="tab"> <span><i class="glyphicon glyphicon-heart"></i></span> </a> </li>
  </ul>
  <!--tabssteps-->
  
  <form  action="/postJob/store" method="post"  novalidate class="formlogin mergform" id="formjob">
   {{csrf_field()}}
    <div class="tab-content">
      <div id="step-1">
      <div role="tabpanel" class="tab-pane  nonebac active" >
        <div class="headtop nonbord borderbox">
          <div class="stapson active"><span>1</span>
            <h4 class="personalinfo">post job step 1</h4>
          </div>
          <div class="rightcealr"> <span class="active"></span> <span></span> <a href="#">clear all</a> </div>
        </div>
        <!--borderbox-->
        
        <div class="divwits"> 
          <!--<label class="desired">job title </label>-->
            <select class="form-control requirments" name="job_id" id="job_id" required="required" style="width: 90%;">
              <option selected="" disabled="disabled">job tilte</option>
              @foreach(\App\Job::all() as $job)
                <option value="{{$job->id}}">{{$job->name}}</option>
              @endforeach
            </select>
        </div>
        <!--divwits-->
        
        <div class="divwits"> 
          <!--<label class="desired">industry</label>-->
            <select class="form-control requirments" name="industry_id" id="industry_id" required="" style="width: 90%;">
            <option selected="" disabled="disabled">desired industry</option>
              @foreach(\App\Industry::all() as $ind)
                <option value="{{$ind->id}}">{{$ind->name}}</option>
              @endforeach
          </select>
        </div>
        <!--divwits-->
        
        <div class="divwits"> 
          <!-- <label class="desired">no.of recancies</label>-->
          <input type="number" name ="num_of_candidates" class="form-control requirments" placeholder="no.of recancies" style="width: 90%;">
        </div>
        <!--divwits-->
        
        <div class="divwits"> 
          <!--<label class="desired">loacthon</label>-->
            <select class="form-control requirments" id="country_id" name="country_id" required="" style="width: 90%;">
              <option selected="" disabled="disabled">job location</option>
                @foreach(\App\Country::all() as $country)
                  <option value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
            </select>
        </div>
        <!--divwits-->
        
        <div class="divwits">
          <label class="desired looking merlab">preferd jender</label>
         <div class="row">
                  <div class="col-sm-4 airports availability"> gender</div>
                      <label class="col-sm-4 airports">
                      <input type="radio" name="prefered_gender" value="0" checked="">
                      <span class="label-text" >male</span> </label>
                      <label class="col-sm-4 airports">
                      <input type="radio" name="prefered_gender" value="1">
                      <span class="label-text" >female</span> </label>
                  </div>
          <!--row--> 
        </div>
        
        <!--divwits-->
        
        <div class="divwits">
          <div class="row">
          <!--   <div class="col-sm-6 botrg">
              <div class="linksing textcand-1">
                <p>10</p>
                <span>earn points <i class="fas fa-trophy"></i><br/>
                with each step</span> </div>
            </div> -->
            <div class="col-sm-3 cand-2 floting"> <a href="#" id="step-1-next" class="largeredbtn">continue</a> </div>
          </div>
          <!--row--> 
          
        </div>
        <!--divwits--> 
        
      </div>
      <!--tab-pane-->
      </div>
      <div id="step-2">
      <div role="tabpanel" class="tab-pane nonebac" >
        <div class="headtop nonbord borderbox">
          <div class="stapson active"><span>2</span>
            <h4 class="personalinfo">post job step 2</h4>
          </div>
          <div class="rightcealr"> <span class="active"></span> <span class="active"></span> <a href="#">clear all</a> </div>
        </div>
        <!--borderbox-->
<!--        <div id="editor">-->
<!--    <p>This is the editor content.</p>-->
<!--</div>-->
        <div class="divwits equirment"> 
          <!--  <label class="desired"> job description</label>-->
      
          
          
          <textarea name="job_descripton" class="ckeditor" id="test"  required>job description... </textarea>
          
        </div>
        <!--divwits-->
        
        <div class="divwits"> 
          <!--<label class="desired">job requirments </label>-->
          <input type="text" class="form-control requirments" name="job_requirements" placeholder="job requirments">
        </div>
        <!--divwits-->
        
        <div class="divwits">
          <div class="row"  style="padding-top: 15px;padding-bottom: 15px">
            <div class="col-md-6 col-sm-12 airports availability"> availability</div>
            <div class="col-md-6 col-sm-12 airports availability" > <input type="date" name="availability"></div>
            
          </div>
        </div>
        
        <!--divwits-->
        
        <div class="divwits">
          <div class="row">
            <div class="col-md-12 col-sm-12 ">
        <select class="form-control chosen-select types" data-placeholder=" Language..." name="language_ids[]" id="language_id" multiple="multiple" required="" style="width: 100%;" >
               @foreach(\App\Language::all() as $lang)
                 <option value="{{$lang->id}}">{{$lang->name}}</option>
               @endforeach
             </select>
            </div>
          <!--   <div class="col-sm-6 airports icon-star"> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i></div> -->
          </div>
        </div>
        <!--divwits-->
        
        <div class="divwits">
          <div class="row">
            <div class="col-sm-6 airports witpostslid">
              <input type="text" class="form-control requirments" name="max_salary" placeholder="salary: exampe 500,00,00">
            </div>
            <div class="col-sm-3 airports witpostslid">
              <select class="form-control requirments" name="currency_id" required="">
                   @foreach(\App\Currency::all() as $currency)
                    <option value="{{$currency->id}}">{{$currency->name}}</option>
                  @endforeach
              </select>
            </div>
          </div>
        </div>
        <!--divwits-->
        

    <div class="divwits" style="margin-bottom: 15px;margin-top: 20px;">
            <select class="form-control requirments chosen-select types" data-placeholder="a Skill.." name="skill_ids[]" id="skill_ids" multiple="multiple" required="" style="width: 90%;" >
                    @foreach(\App\Skills::all() as $skill)
                    <option value="{{$skill->id}}">{{$skill->name}}</option>
                    @endforeach
                </select>
          </div>


      
        <div class="linksing"> <a href="#" class="skiplink">if you want to coutenue please click here to answer the questions if not click submit </a> </div>
        <div class="divwits">
          <div class="row">
          <!--   <div class="col-sm-6 botrg">
              <div class="linksing textcand-1">
                <p>20</p>
                <span>earn points <i class="fas fa-trophy"></i><br>
                with each step</span> </div>
            </div> -->
            <div class="col-sm-3 cand-2">
              <button type="button" id="step-1-back"  class="largeredbtn back"> back</button>
            </div>
            <div class="col-sm-3 cand-2">
              <button type="submit" class="largeredbtn">submit</button>
            </div>
          </div>
          <!--row--> 
          
        </div>
        <!--divwits--> 
        </div>
      </div>
      <!--tab-pane--> 
      
    </div>
    
    <!--tab-pane-->
    
    

    <!--tab-content-->
     {!! JsValidator::formRequest('App\Http\Requests\AddPostJobFormRequest', '.formlogin'); !!}
  </form>
  </div>
  <!--container--> 
 
</section>
<!--section-->

@endsection

@section('scripts')
<script>CKEDITOR.replace('#test');

CKEDITOR.stylesSet.add('my_styles',
    [
// Block-level styles
        {name: 'Blue Title', element: 'h2', styles: { 'color': 'Blue'} },
        { name: 'Red Title', element: 'h3', styles: { 'color': 'Red'} },

// Inline styles
        {name: 'CSS Style', element: 'span', attributes: { 'class': 'my_style'} },
        { name: 'Marker: Yellow', element: 'span', styles: { 'background-color': 'Yellow'} }
    ]);

CKEDITOR.editorConfig = function (config) 
{
    config.toolbar = 'MyToolbar';

    config.toolbar_MyToolbar =
   [
      { name: 'document', items: ['NewPage', 'Preview'] },
      { name: 'clipboard', items: ['Cut', 'Copy', 'PasteText', '-', 'Undo', 'Redo'] },
      { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll'] },
      { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar']
      },
                '/',
      { name: 'styles', items: ['Styles', 'Format'] },
      { name: 'basicstyles', items: ['Bold', 'Italic', '-', 'RemoveFormat'] },
      { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
      { name: 'links', items: ['Link', 'Unlink', 'Anchor'] }
   ];

  
    config.stylesSet = 'my_styles';
}; 

</script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript" src="/vendor/jsvalidation/js/jsvalidation.js"></script>
<script type="text/javascript" src="/dist/jquery.validate.js"></script>



    <script>

$(document).ready(function () {
       $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
         
  $('#job_id').select2();
  $('#industry_id').select2();
  $('#country_id').select2();
  $('#emp_nation_id').select2();
  $('#nation_id').select2();
  $('#religion_id').select2();
 $(".types").chosen({ 
                   width: '100%',
                   no_results_text: "No Results",
                   allow_single_deselect: true, 
                   search_contains:true, });
 $(".types").trigger("chosen:updated");
 

 });


</script>


<script type="text/javascript">
    $(document).ready(function(){

 $("#step-1-next").click(function(){


 var form = $("#formjob");
 console.log(form.valid());
    if (form.valid() == true){
      
      current_fs = $('#step-1');
      next_fs = $('#step-2');
      next_fs.show(); 
      current_fs.hide();
    }
  });


 
        $('#step-1-back').click(function(){
            current_fs = $('#step-2');
            next_fs = $('#step-1');
            next_fs.show(); 
            current_fs.hide();
        });

       
    });
</script>
@endsection
