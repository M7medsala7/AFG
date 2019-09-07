@extends('Layout.app')
@section('content')
<style>
.dataTables_filter input{
  background: lightblue;
}
.select2-selection__rendered{
    background: #ccc;
    border: 1px solid rgba(115, 115, 115, 0.48)!important;
    float: left;
    width: 120%;
    height: 40px;
    border-radius: 5px;
    /* border: 0; */
    box-shadow: none;
    border: 2px solid #d7d7d7;
    margin-top: 10px;
    color: rgba(0,0,0,0.7)!important;;
  }
  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 57px!important;}
  .select2-container .select2-selection--single
  {
    height: 0px!important;
  }
  .select2-container--default .select2-selection--single{    background-color: 0!important;border: 0!important}
  .watchvideo img{
    height: 20%!important;
  }

@keyframes load {
100% {
    opacity: 0;
    transform: scale(1);
}
}
@keyframes load {
100% {
    opacity: 0;
    transform: scale(1);
}
}
  #step-2{
    display:none;
  }
   #step-3{
    display:none;
  }
.marginclass{
    margin-top:15px;
}
.mm{
  -webkit-appearance: checkbox;
}
.dataTables_wrapper {
    margin-top: 2%;
    zoom:0
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    color: #004d9a !important;
    border-radius: 100%;
    border: 1px solid #004d9a;
}

.footer{
    right: 0;
    bottom: 0;
    left: 0;
    position: fixed;
}
</style>
<section class="dashboard">
<h6 style="    text-align: center;
    color: #043d77;
    margin-top: 11px;margin-bottom: 11px;font-size: x-large;">your client</h6>
    <div class="row">
      <div class="col-sm-12">
      <div class="inner-aboutus" style="min-height:800px;margin-top:1px"  >
      <div style="padding-bottom:30px;">
  
 </div>
 
                <div class="col-xs-12 no-padding border-top border-bottom">
                    <div class="padding-v-20">
                        <div class="heading-elements-menu">
                            <ul class="breadcrumb commandBar">
                                <li><a href="#" data-toggle="modal" data-target="#myModal1"><i class="fa fa-plus position-left fa-1x" style="color:#009df4"></i> New</a></li>

                                <li><button href="#" id="delete-all" style="background: transparent;
    border: 0;"> <i class="fa fa-trash position-left fa-1x "  style="color:red"></i> Delete</button></li>
<li><a href="#"> </a></li>
                               
                            </ul>
                        </div>
                        <div class="heading-elements">
                            
                        </div>
                    </div>
                </div>




         <table  id= "bootstrap-data-table" class="table table-striped table-bordered dt-responsive Jobs" width="100%">
                    <thead>
                      <tr>

                      <th><input type="checkbox" id="check_all" style="right:inherit;;margin-top: -11px;"></th>
                        <th>Client Name</th>
                        <th>Country</th>
                        <th>City</th>
                        <th>image</th>
                        <th>Candidate shortlisted</th>
                        <th>Candidate accepted</th>
                       <th>Candidate rejected</th>
                       

                      <th>Reference Check</th>
                      <th>Salary Finalization</th>
                       <th>Send to Itegration</th>
                       <th>Process</th>
                       <!-- <th>VIP</th> -->
                       <!-- <th>Stop Work</th> -->
                      </tr>
                    </thead>
                    <tbody>
                     
                      @foreach($data as $value)
                     
                      
                      <tr  style="text-align: center;" id="tr_{{$value['user_id']}}">
                      <td >
                      <input type="checkbox" class="checkbox" style="right:auto;"  data-id="{{$value['user_id']}}"></td>
                        <td>{{$value['name']}}</td>
                        <td>{{$value['country']}}</td>
                        <td>{{$value['city']}}</td>
                        <td>
                         
                            <img src="/{{($value['image'])?$value['image']:'images/4.jpg'}}" style="width: 60px; height: 50px;margin-top:-20%" >
                             
                          
                        </td>

                        <td>{{$value['Shortlisted']}}</td>
                        <td>{{$value['Interview']}}</td>
                        <td>{{$value['Rejected']}}</td>

                        <td>{{$value['ReferenceCheck']}}</td> 
                        <td>{{$value['SalaryFinalization']}}</td>
                        <td>{{$value['SendItegration']}}</td>
                       
                        <td><a class="largeredbtn" style="float: none;" href="/clientcontroll/{{$value['user_id']}}" > Details </a></td>
                        
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>
        </div>
      <!--dashboardleft--> 
      
    </div>
    <!--row--> 
    

  
</section>


<section>
<div class="modal fade bd-example-modal-lg" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
    
      
    <div class="modal-body">
    <div class="col-md-12" style="    text-align: center;"><h3>Add New Client</h3></div>
    
    <form  action="/addNewclient" method="POST" class="formlogin" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="divwits">
                <input type="text"  class="form-control requirments" name="name" placeholder="Company/Family Name" style="background: #ccc;color:rgba(0,0,0,0.7)!important">
            </div>
            <div class="divwits">
                <input type="text" class="form-control requirments" name="email" placeholder="Email" style="background: #ccc;color:rgba(0,0,0,0.7)!important">
            </div>
            <div class="divwits">
                <input type="password" class="form-control requirments" name="password" placeholder="password" style="background: #ccc;color:rgba(0,0,0,0.7)!important">
            </div>
        
        




   <div class="col-md-12 airports witpostslid" style="width:95%">
                  <select class="form-control requirments" name="country_id" id="country_id" required="" style="width: 90%;" onblur="processForm(this.form)" >
                    <option selected="" > Current Location</option>
                    @foreach(\App\Country::all() as $country)
                      <option value="{{$country->id}}" >{{$country->name}}</option>
                    @endforeach
                  </select>
                </div>




        <!--divwits-->
        
        <div class="col-md-12 airports witpostslid" style="width:95%">
           <select class="form-control " id="city_id" name="city_id" style="width: 90%;"  onblur="processForm(this.form)">
             <option selected="" disabled="disabled">Select City</option>
          </select>
        </div>









            <div class="divwits marginclass">
                <div class="input-group input-file" name="logo">
                <input type="text" style="background: #ccc;color:rgba(0,0,0,0.7)!important" class="form-control requirments"  placeholder='image...'  />
                <span class="input-group-btn">
                <button class="btn btn-default btn-choose largeredbtn brows" type="button" onblur="processForm(this.form)">brows</button>
                </span> </div>
            </div>
        
         
            <div class="divwits mergbot" style="margin-left: 85%;margin-bottom:20px">
                <button type="submit"  class="largeredbtn">save <i class="fas fa-check"></i></button>
            
            </div>
       </form>     

</div> <!-- end modal-body -->
</div><!-- end modal-content -->
</div><!-- end modal-dialog -->
</div><!-- end myModal1 -->
</section>




@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
 <script type="text/javascript" src="/vendor/jsvalidation/js/jsvalidation.js"></script>
<script src="/dist/jquery.validate.js"></script>
<script>
  populateCountries("country_id", "city_id"); 
  // first parameter is id of country drop-down and second parameter is id of state drop-down
</script>
<script type="text/javascript">
function asd()
{
  $("#candiv").show();
}
  $(document).ready(function() {
 
 
    $('.Jobs').DataTable({
    select:true,
    responsive: true,
    "order":[[0,"asc"]],
    'searchable':true,
    "scrollCollapse":true,
    "paging":true,
    "pagingType": "full_numbers",
      dom: 'lBfrtip'
      });
 

      $('select.changeStatus').change(function(){
      
    });
    $('#check_all').on('click', function(e) {
         if($(this).is(':checked',true))  
         {

            $(".checkbox").prop('checked', true);  
         } else {  
            $(".checkbox").prop('checked',false);  
         }  
        });

         $('.checkbox').on('click',function(){
            if($('.checkbox:checked').length == $('.checkbox').length){
                $('#check_all').prop('checked',true);
            }else{
                $('#check_all').prop('checked',false);
            }
         });
         
         $('#delete-all').on('click', function(e) {


var idsArr = [];  
$(".checkbox:checked").each(function() {  
    idsArr.push($(this).attr('data-id'));
});  


if(idsArr.length <=0)  
{  
    alert("Please select atleast one record to delete.");  
}  else {  

    if(confirm("Are you sure, you want to delete the selected Client?")){  

        var strIds = idsArr.join(","); 

        $.ajax({
            url: '/deletemultipleclient',
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
 $('#country_id').select2();


  $('#city_id').select2();
  
} );
</script>
@stop