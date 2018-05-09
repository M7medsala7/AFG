@extends('Layout.app')
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
          
          <form action="#" method="" class="formlogin">
            <div class="row">
              <div class="col-sm-6 formcompany">
                <label class="desired">industry</label>
                <input type="text" class="form-control" placeholder="industry">
              </div>
              <!--formcompany-->
              
              <div class="col-sm-6 formcompany">
                <label class="desired">company size</label>
                <input type="text" class="form-control" placeholder="10000">
              </div>
              <!--formcompany-->
              
              <div class="col-sm-6 formcompany">
                <label class="desired">location</label>
                <input type="text" class="form-control" placeholder="location">
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
                <textarea class="form-control" placeholder=""></textarea>
              </div>
              <!--formcompany-->
              
              <div class="col-sm-12 formcompany">
                <label class="desired">company website url</label>
                <input type="text" class="form-control" placeholder="www.site.com">
              </div>
              <!--formcompany-->
              
              <div class="col-sm-12 formcompany">
                <label class="desired">company social links</label>
                <div class="row">
                  <div class="col-sm-2 sociallinks">
                    <input type="text" class="form-control" placeholder="linknedin">
                  </div>
                  <!--sociallinks-->
                  
                  <div class="col-sm-2 sociallinks">
                    <input type="text" class="form-control" placeholder="twitter">
                  </div>
                  <!--sociallinks-->
                  
                  <div class="col-sm-2 sociallinks">
                    <input type="text" class="form-control" placeholder="addition information">
                  </div>
                  <!--sociallinks-->
                  
                  <div class="col-sm-2 sociallinks">
                    <input type="text" class="form-control" placeholder="facebook">
                  </div>
                  <!--sociallinks-->
                  
                  <div class="col-sm-2 sociallinks">
                    <input type="text" class="form-control" placeholder="google plus">
                  </div>
                  <!--sociallinks--> 
                  
                </div>
                <!--row--> 
                
              </div>
              <!--formcompany-->
              
              <div class="col-sm-12 formcompany">
                <label class="desired">company social links</label>
                <div class="coverphoto"> <img class="img_prev" src="images/coverphoto.jpg">
                  <label class="largeredbtn record"> <i class="fas fa-upload"></i> drop it heare or click to upload one
                    <input type="file"   onchange="readURL(this);" style="display: none;">
                  </label>
                </div>
              </div>
              
              <!--formcompany-->
              
              <div class="col-sm-12 formcompany">
                <label class="desired">vedio</label>
                <input type="text" class="form-control" placeholder="drop it heare or click to upload one">
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
