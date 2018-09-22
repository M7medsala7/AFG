@extends('Dashboardadmin.layout.layout')
@section('content')

 <section class="content-header" style="background-color: ">
 <form  role="form" method="POST" action="{{url('/adminpanel/story/search')}}" enctype="multipart/form-data">
    
    {{csrf_field()}}

           <div style="margin-left:67%;">
           <input type="text" placeholder="Search.." name="s">
          <button type="submit" style="background-color:#dbc65d;;"><i class="fa fa-search" ></i></button>
          </div>
</form>

      <ol class="breadcrumb">
        <li><a href="{{url('adminpanel')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{url('/adminpanel/employer/create')}}"> Requests 
      </ol>
 </section>

    <!-- Main content -->
    <section class="content" style="background-color:; ">
      <div class="row">
        <div class="col-xs-12">
         
            <!-- /.box-header -->
            <div class="box-body">
     
       
            <table id="example2" class="table table-bordered table-striped dataTable">

                <thead>
                <tr>
                  
                 
                  <th > Name</th>
                  <th> email</th>
                  <th>Phone</th>
                  <th> Message</th>
                  <th> Status</th>
                
                </tr>
                </thead>
                <tbody>
           
               
                @foreach($allrequests as $value)
                <tr>
                
                  <td>{{$value->name}}</td>
                  <td>{{$value->email}}</td>
                  <td>{{$value->phone}}</td>
                  <td>{{$value->message}}</td>
                  <td>{{$value->status}}</td>
                  
                </tr>
                @endforeach
           
                </tbody>
                <tfoot>
                
              
           
                </tfoot>

              </table>
           
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

         
          <!-- /.box -->
        </div>
        <!-- /.col -->

      <!-- /.row -->
    </section>
     @endsection

     <script>

     function Approval(e,id){
     var act;
     if(e.value==1)
      act=0;
      else act=1;
      $.ajax({
        url:"/approvalSuccessStories",
        data:{id:id,active:act},
        type:"get",
        success:function(data){}

      });

     }
     </script>