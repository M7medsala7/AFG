

@extends('DashbordAdminPanel.layout.master')

@section('content')
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>

<script>
    tinymce.init({
        selector: "textarea",
        theme: "modern",
        width: 700,
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
  <style type="text/css">
    
  </style>	
    

   

  <div class="content mt-3">


<div class="modal fade bd-example-modal-lg" id="myModalblog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
    
      
    <div class="modal-body">
  
<form  action="/addblog" method="POST" id="profileForm" class="formlogin" enctype="multipart/form-data">
	{{ csrf_field() }}
  
   <fieldset style="padding: .35em .625em .75em; margin: 0 2px; border: 1px solid silver;">
      <legend style="width: fit-content;border: 0px;">Data :</legend>
      <div class="col-lg-12">
					 <div class="row form-group">
                      </div>
                    <div class="row form-group">
                    <div class="col col-md-3"><label for="hf-password" class=" form-control-label">title</label></div>
                  <input type="text" id="hf-name" name="title" placeholder="Enter title..." class="form-control">
                    </div>
                    <div class="row form-group">
            <label >Image</label>
            <input type="file" name="filename">    
       </div>

                    <div class="row form-group">
                            <div class="col col-md-3"><label for="hf-password" class=" form-control-label">Body</label></div>
                            <div class="col-12 col-md-12" >
                            <textarea class="form-control col-md-7 col-xs-12" rows="15"  name="body"></textarea>
                            </textarea>
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








 <div class=" fadeIn">

                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Blog</strong>
                        </div>
                             
                                	     <!-- model -->
                        <div class="card-body">


                        	<div class="modal fade bd-example-modal-lg" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 
</div><!-- end myModal1 -->

 
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalblog">
Add New Blog
</button>

   <br>
   <br>
 <button style="margin: 5px;" class="btn btn-danger btn-xs delete-all" data-url="">Delete All</button>
                  <table id="bootstrap-data-table" class="table table-striped table-bordered Jobs">
                    <thead>
                    <tr>
                    <th><input type="checkbox" id="check_all"></th>
                    <th> title</th>
                  
                <th>process</th>
                </tr>

                    </thead>
                    <tbody>
                 
                    @foreach($blog as $item)
                <tr id="tr_{{$item->id}}">
                <td><input type="checkbox" class="checkbox" data-id="{{$item->id}}"></td>
                  <td>{{$item->name}}</td>
               
             
                <td> 
                 <a href="{{url('/EditBlog/'.$item->id)}}" class="btn btn-default btn-sm"> <span class="fa fa-edit"></span>  </a>
                
                </td>
               
                </tr>
                @endforeach
                   
                    
                    
                    </tbody>
                  </table>
                        </div>
                    </div>
                </div>


                </div>
            </div>
            </div>
@endsection



@section('scripts')
<script type="text/javascript" src="/vendor/jsvalidation/js/jsvalidation.js"></script>
<script src="/dist/jquery.validate.js"></script>
<script type="text/javascript">

 $(document).ready(function () {
   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
 
  
    $('.delete-all').on('click', function(e) {


var idsArr = [];  
$(".checkbox:checked").each(function() {  
    idsArr.push($(this).attr('data-id'));
});  


if(idsArr.length <=0)  
{  
    alert("Please select atleast one record to delete.");  
}  else {  

    if(confirm("Are you sure, you want to delete the selected Blog?")){  

        var strIds = idsArr.join(","); 

        $.ajax({
            url: '/delmulblog',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: 'POST',
            data: {"_token": "{{ csrf_token() }}",
           ids:strIds },
            success: function (data) {
                if (data['status']==true) {
                    $(".checkbox:checked").each(function() {  
                        $(this).parents("tr").remove();
                    });
                     $(document).ajaxStop(function() { location.reload(true); });
                    alert(data['message']);
                } else {
                    alert('Whoops Something went wrong!!');
                }
            },
            error: function (data) {
                alert(data.responseText);
            }
        });


    }  
}  
});



});

</script>
<script>

function Approval(e,id){
var act;
if(e.value==1)
 act=0;
 else act=1;
 $.ajax({
   url:"/approvalStories",
   data:{id:id,active:act},
   type:"get",
   success:function(data){}

 });

}
</script>
<script type="text/javascript" src="/vendor/jsvalidation/js/jsvalidation.js"></script>
<script src="/dist/jquery.validate.js"></script>


@endsection