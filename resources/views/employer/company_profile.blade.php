@extends('Layout.app')
<style>
  .select2-selection__rendered{
    border: 1px solid rgba(115, 115, 115, 0.48)!important;
    /* color: #fff; */
    float: left;
    width: 100%;
    height: 40px;
    border-radius: 5px;
    /* border: 0; */
    box-shadow: none;
    border: 2px solid #d7d7d7;
    margin-top: 10px;
        
  }
  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 57px!important;}
  .select2-container .select2-selection--single
  {
    height: 0px!important;
  }
  .select2-container--default .select2-selection--single{   border: 0!important}
  .watchvideo img{
    height: 20%!important;
  }
</style>
@section('content')
<section class="candidate-profile">
  <h1>company profile </h1>
</section>
<section class="dashboard candidate-pro">
  <div class="container">
    <div class="row">
      <div class="col-sm-8   col-sm-offset-2">
        <div class="inner-aboutus topmergline">
          <div class="currencytext resultstext">
            <h2>Maid & Helper</h2>
            <div class="logoright"><img src="/images/logoinner.png"></div>
          </div>
          <!--resultstext-->
           @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
                </ul>
             </div>
            @endif
          <form action="/company_store" method="post" class="formlogin" enctype="multipart/form-data">
             {{ csrf_field() }}
            <div class="row">
              <div class="col-sm-6 formcompany">
                <label class="desired">industry</label>
                <select class="form-control" name="industry_id" id="industry_id" required="">
                  <option selected="" disabled="disabled">desired industry</option>
                    @foreach(\App\Industry::all() as $ind)
                      <option value="{{$ind->id}}" {{($company['industry_id'] == $ind['id'])?'selected':''}}>{{$ind['name']}}</option>
                    @endforeach
                </select>
              </div>
              <!--formcompany-->
              
              <div class="col-sm-6 formcompany">
                <label class="desired">company size</label>
                <input type="number" name="size" value={{$company['size']}} class="form-control" placeholder="10000">
              </div>
              <!--formcompany-->
              
              <div class="col-sm-6 formcompany">
                <label class="desired">location</label>
                <select class="form-control" name="country_id" id="country_id" required="">
                  <option selected="" disabled="">desired location</option>
                   @foreach(\App\Country::all() as $country)
                      <option value="{{$country->id}}" {{($company['country_id'] == $country['id'])?'selected':''}}>{{$country['name']}}</option>
                    @endforeach
                </select>
              </div>
              <!--formcompany-->
              
              <div class="col-sm-6 formcompany">
                <div class="map-iframe">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3455.569680525106!2d31.429343215113878!3d29.991794581901466!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjnCsDU5JzMwLjUiTiAzMcKwMjUnNTMuNSJF!5e0!3m2!1sen!2s!4v1464808219991" frameborder="0" style="border:0" allowfullscreen=""></iframe>
                </div>
              </div>
              <!--formcompany-->
              
              <div class="col-sm-12 formcompany">
                <label class="desired">company description</label>
                <textarea name="description" value="{{$company['description']}}" class="form-control" placeholder=""></textarea>
              </div>
              <!--formcompany-->
              
              <div class="col-sm-12 formcompany">
                <label class="desired">company website url</label>
                <input type="text" name="website" value="{{$company['website']}}" class="form-control" placeholder="www.site.com">
              </div>
              <!--formcompany-->
              
              <div class="col-sm-12 formcompany">
                <label class="desired">company social links</label>
                <div class="row">
                  <div class="col-sm-2 sociallinks">
                    <input name="company_linkedin" type="text" class="form-control" placeholder="linknedin" value="{{$company['company_linkedin']}}">
                  </div>
                  <!--sociallinks-->
                  
                  <div class="col-sm-2 sociallinks">
                    <input name="company_twitter" type="text" value="{{$company['company_twitter']}}" class="form-control" placeholder="twitter">
                  </div>
                  <!--sociallinks-->
                  
                  <div class="col-sm-2 sociallinks">
                    <input name="company_youtube" value="{{$company['company_youtube']}}" type="text" class="form-control" placeholder="youtube">
                  </div>
                  <!--sociallinks-->
                  
                  <div class="col-sm-2 sociallinks">
                    <input name="company_facebook" type="text" value="{{$company['company_facebook']}}" class="form-control" placeholder="facebook">
                  </div>
                  <!--sociallinks-->
                  
                  <div class="col-sm-2 sociallinks">
                    <input name="company_googleplus" value="{{$company['company_googleplus']}}" type="text" class="form-control" placeholder="google plus">
                  </div>
                  <!--sociallinks--> 
                  
                </div>
                <!--row--> 
                
              </div>
              <!--formcompany-->
              
              <div class="col-sm-12 formcompany">
                <label class="desired">company video</label>
                <div class="coverphoto"> <img class="img_prev" src="images/coverphoto.jpg">
                  <label class="largeredbtn record"> <i class="fas fa-upload"></i> drop it heare or click to upload one
                    <input type="file" name="video_path"   onchange="readURL(this);" style="display: none;">
                  </label>
                </div>
              </div>
              
              <!--formcompany-->
              
              <div class="col-sm-12 formcompany">
                <label class="desired">vedio</label>
                <input type="file" name="photos[]" class="form-control" placeholder="drop it heare or click to upload one" multiple />
             
              </div>
              <!--formcompany-->
              
              <div class="col-sm-4 formcompany col-sm-offset-4">
                <button type="submit" class="largeredbtn botseve"> Save now </button>
              </div>
            </div>
            <!--row-->
            
          </form>
        </div>
        
        <!--inner-aboutus--> 
        
      </div>
      
      <!--dashboardleft--> 
      
    </div>
    <!--row--> 
    
  </div>
  
  <!--container--> 
  
</section>
<!--section-->

<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> watch demo video
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="textbox">
        <iframe  src="https://www.youtube.com/embed/BFrLL5w9UGQ?autoplay=0" frameborder="0" allowfullscreen></iframe>
      </div>
      <!--textbox--> 
      
    </div>
  </div>
</div>
<!--myModal-->
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
  $(document).ready(function(){
    $('#job_id').select2();
    $('#industry_id').select2();
    $('#country_id').select2();
  });

  </script>
@endsection