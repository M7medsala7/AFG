      <div style="margin-left:20%;" id="myPartialDiv">

 <a  class="resp-sharing-button__link" onclick="candfacebook('{{$TopCandi->user->name}}','{{$TopCandi->descripe_yourself}}','{{$TopCandi->user->id}}','{{ str_replace(' ', '%20', $TopCandi->user->logo) }}')"  target="_blank" aria-label="Share on Facebook">
  <div class="resp-sharing-button resp-sharing-button--facebook resp-sharing-button--large"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/></svg>
    </div></div>
</a>


<!-- Sharingbutton Twitter -->
<a class="resp-sharing-button__link" href="https://twitter.com/intent/tweet/?text={{$TopCandi->descripe_yourself}}.&amp;url=https://www.maidandhelper.com/candidate/{{$TopCandi->user->id}}" target="_blank" aria-label="Share on Twitter">
  <div class="resp-sharing-button resp-sharing-button--twitter resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M23.44 4.83c-.8.37-1.5.38-2.22.02.93-.56.98-.96 1.32-2.02-.88.52-1.86.9-2.9 1.1-.82-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.03.7.1 1.04-3.77-.2-7.12-2-9.36-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.74-.03-1.44-.23-2.05-.57v.06c0 2.2 1.56 4.03 3.64 4.44-.67.2-1.37.2-2.06.08.58 1.8 2.26 3.12 4.25 3.16C5.78 18.1 3.37 18.74 1 18.46c2 1.3 4.4 2.04 6.97 2.04 8.35 0 12.92-6.92 12.92-12.93 0-.2 0-.4-.02-.6.9-.63 1.96-1.22 2.56-2.14z"/></svg>
    </div></div>
</a>

<!-- Sharingbutton Google+ -->
<a class="resp-sharing-button__link" href="https://plus.google.com/share?url=https://www.maidandhelper.com/candidate/{{$TopCandi->user->id}}" target="_blank" aria-label="">
  <div class="resp-sharing-button resp-sharing-button--google resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.37 12.93c-.73-.52-1.4-1.27-1.4-1.5 0-.43.03-.63.98-1.37 1.23-.97 1.9-2.23 1.9-3.57 0-1.22-.36-2.3-1-3.05h.5c.1 0 .2-.04.28-.1l1.36-.98c.16-.12.23-.34.17-.54-.07-.2-.25-.33-.46-.33H7.6c-.66 0-1.34.12-2 .35-2.23.76-3.78 2.66-3.78 4.6 0 2.76 2.13 4.85 5 4.9-.07.23-.1.45-.1.66 0 .43.1.83.33 1.22h-.08c-2.72 0-5.17 1.34-6.1 3.32-.25.52-.37 1.04-.37 1.56 0 .5.13.98.38 1.44.6 1.04 1.84 1.86 3.55 2.28.87.23 1.82.34 2.8.34.88 0 1.7-.1 2.5-.34 2.4-.7 3.97-2.48 3.97-4.54 0-1.97-.63-3.15-2.33-4.35zm-7.7 4.5c0-1.42 1.8-2.68 3.9-2.68h.05c.45 0 .9.07 1.3.2l.42.28c.96.66 1.6 1.1 1.77 1.8.05.16.07.33.07.5 0 1.8-1.33 2.7-3.96 2.7-1.98 0-3.54-1.23-3.54-2.8zM5.54 3.9c.33-.38.75-.58 1.23-.58h.05c1.35.05 2.64 1.55 2.88 3.35.14 1.02-.08 1.97-.6 2.55-.32.37-.74.56-1.23.56h-.03c-1.32-.04-2.63-1.6-2.87-3.4-.13-1 .08-1.92.58-2.5zM23.5 9.5h-3v-3h-2v3h-3v2h3v3h2v-3h3"/></svg>
    </div>
  </div>
</a>



<!-- Sharingbutton WhatsApp -->
<a class="resp-sharing-button__link" href="whatsapp://send?text={{$TopCandi->descripe_yourself}}https://www.maidandhelper.com/candidate/{{$TopCandi->user->id}}" target="_blank" aria-label="Share on WhatsApp">
  <div class="resp-sharing-button resp-sharing-button--whatsapp resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20.1 3.9C17.9 1.7 15 .5 12 .5 5.8.5.7 5.6.7 11.9c0 2 .5 3.9 1.5 5.6L.6 23.4l6-1.6c1.6.9 3.5 1.3 5.4 1.3 6.3 0 11.4-5.1 11.4-11.4-.1-2.8-1.2-5.7-3.3-7.8zM12 21.4c-1.7 0-3.3-.5-4.8-1.3l-.4-.2-3.5 1 1-3.4L4 17c-1-1.5-1.4-3.2-1.4-5.1 0-5.2 4.2-9.4 9.4-9.4 2.5 0 4.9 1 6.7 2.8 1.8 1.8 2.8 4.2 2.8 6.7-.1 5.2-4.3 9.4-9.5 9.4zm5.1-7.1c-.3-.1-1.7-.9-1.9-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.1-.2.2-.3.2-.6.1s-1.2-.5-2.3-1.4c-.9-.8-1.4-1.7-1.6-2-.2-.3 0-.5.1-.6s.3-.3.4-.5c.2-.1.3-.3.4-.5.1-.2 0-.4 0-.5C10 9 9.3 7.6 9 7c-.1-.4-.4-.3-.5-.3h-.6s-.4.1-.7.3c-.3.3-1 1-1 2.4s1 2.8 1.1 3c.1.2 2 3.1 4.9 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.6-.1 1.7-.7 1.9-1.3.2-.7.2-1.2.2-1.3-.1-.3-.3-.4-.6-.5z"/></svg>
    </div></div>
</a>

<!-- Sharingbutton LinkedIn -->
<a class="resp-sharing-button__link" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://www.maidandhelper.com/candidate/{{$TopCandi->user->id}}&amp;title={{$TopCandi->user->name}}.&amp;summary={{$TopCandi->descripe_yourself}}.&amp;source=https://www.maidandhelper.com" target="_blank" aria-label="Share on LinkedIn">
  <div class="resp-sharing-button resp-sharing-button--linkedin resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M6.5 21.5h-5v-13h5v13zM4 6.5C2.5 6.5 1.5 5.3 1.5 4s1-2.4 2.5-2.4c1.6 0 2.5 1 2.6 2.5 0 1.4-1 2.5-2.6 2.5zm11.5 6c-1 0-2 1-2 2v7h-5v-13h5V10s1.6-1.5 4-1.5c3 0 5 2.2 5 6.3v6.7h-5v-7c0-1-1-2-2-2z"/></svg>
    </div></div>
</a>






<a onclick="email()" 
   title="Share by Email">
  <img src="/images/email.jpg" style="width: 30px; height: 40px;">
</a>
<div style="margin-right: 80px; display: none;" id="emaildiv">
<form  action="/sendemailcan" method="POST" id="profileForm" class="formlogin" enctype="multipart/form-data">
  {{ csrf_field()}}
  
  
      <legend style="width: fit-content;border: 0px;">Send Email :</legend>
 


      <div class="col-lg-12">
                   
                      
                     
           <div class="row form-group">
                           
                           
                            </div>
                   
                 

    <div class="form-group col-xs-12">
             
                    <div class="col-xs-10" >
                      <input type="hidden" name="candidate" value="{{$TopCandi->user->id}}">
                            <input class="form-control inventorytexbox" type="email" name="Value[]" id="Value[]" placeholder="Enter Email" />
                          </div>
                         
                    <div class="col-xs-2" >
                        <button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
                    </div>
        </div>

                        <!-- The template containing an email field and a Remove button -->
        <div class="form-group hide col-xs-12" id="emailTemplate" >
                         
                          <div class="col-xs-10" >
                            <input class="form-control inventorytexbox" type="email" name="Value[]" id="Value[]" placeholder="Enter Email" />
                          </div>
                         
                          <div class="col-xs-2" >
                             <button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
                          </div>          
        </div>



               
   


            <div class="ln_solid" style="margin-top:20px"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="button" class="btn btn-primary " data-dismiss="modal">Cancel</button>
                         <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit"  name="login_form_submit" class="btn btn-success" value="Save">Submit</button>
            </div>
            </div>


    
      </form>

</div>



</div>


<script type="text/javascript">
    // We can watch for our custom `fileselect` event like this
  $(document).ready( function() {


   $('#profileForm').on('click', '.addButton', function() {
            var $template = $('#emailTemplate'),
                $clone    = $template
                                .clone()
                                .removeClass('hide')
                                .removeAttr('id')
                                .insertBefore($template),
               
                $Valueyear    = $clone.find('[name="Valueyear[]"]'),
                $Value    = $clone.find('[name="Value[]"]');

            // Add new field
          
        })

        // Remove button click handler
        .on('click', '.removeButton', function() {
            var $row   = $(this).closest('.form-group'),
               
                $Valueyear    = $row.find('[name="Valueyear[]"]'),
                $Value    = $row.find('[name="Value[]"]');
            // Remove element containing the email
            $row.remove();

            // Remove field
        });

  
  });
  

</script>