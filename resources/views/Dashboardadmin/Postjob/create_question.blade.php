@extends('Dashboardadmin.layout.layout')



@section('head')

<style>
  .select2-selection__rendered{
    background: rgb(0, 1, 1);
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
  .select2-container--default .select2-selection--single{    background-color: 0!important;border: 0!important}
</style>
@endsection







@section('content')
      <section class="content-header"  style="background-color:; ">
      <h1 class="fa fa-dashboard">
    Post Questions
      
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('adminpanel')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class=""><a href="{{url('/adminpanel/questions')}}"> Questions controlling </a></li>
        
      </ol>
    </section>


      <section class="content" style="background-color:; ">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">

   @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

   <form  role="form" method="POST" action="{{ url('/adminpanel/postjob/stor/').'/'.$data2->id }}" enctype="multipart/form-data">

                     {{csrf_field()}}
<table style="width:60%; border-collapse: collapse; border: 3px solid #ddd;
    padding: 8px;"  id="mytable">
 <tr >
 <td style="width:47%;" >
                  
        
                    <input type="text" placeholder="Write question:" name="question" id="question" class="form-control">
                 
                 
                   <div >
                   </td>
                   <td style="width:10%;" id="mylist">
                   <select  class="form-control requirments" name="weight" id="weight" >
	                 <option selected="" >Weight</option>
	           
	                  <option >10%</option>
                    <option >30%</option>
                    <option >50%</option>
                    <option >70%</option>
                    <option >90%</option>
                    <option >100%</option>
	           
	        </select>
          </div>
          </td>
        
          </tr>
  
          </table>
      
          <br>


                <div class="form-group">
                    <button type="submit" class="btn-primary" >Post Question </button>
                </div>

              </form>
             
              <button id="btn1" onclick="myFunction()">+</button>
              <button onclick="myDeleteFunction()">-</button>


            </div>
            </div>
          </div>
         </div>
       
 </section>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

function myFunction() {
    var table = document.getElementById("mytable");
    var row = table.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    cell1.innerHTML = '<td><input name="question"></td>';
    cell2.innerHTML = '<td><select></td>';
}

function myDeleteFunction() {
    document.getElementById("mytable").deleteRow(0);
}
</script>