@extends('Dashboardadmin.layout.layout')

@section('content')

 <section class="content-header" style="background-color: ">
      <form  role="form" method="POST" action="{{url('/adminpanel/employer/search')}}" enctype="multipart/form-data">
    
    {{csrf_field()}}

           <div style="margin-left:67%;">
           <input type="text" placeholder="Search.." name="s">
          <button type="submit" style="background-color:#dbc65d;"><i class="fa fa-search" ></i></button>
          </div>
      </form>


     
      <ol class="breadcrumb">
        <li><a href="{{url('adminpanel')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{url('/adminpanel/employer/create')}}"> Add Epmloyer
      </ol>
     
    </section>

    <!-- Main content -->
    <section class="content" style="background-color:; ">
      <div class="row">
        <div class="col-xs-12">
         
            <!-- /.box-header -->
            <div class="box-body">
              <!-- search form -->
     
      <!-- /.search form -->
      <form action="{{url('/adminpanel/deleteid')}}" method="post">
      {{csrf_field()}}
         <table id="example2" class="table table-bordered table-striped dataTable">

                <thead>
                <tr>
                  <th>   <button type="submit" class="btn btn-primary" >  <i class="fa fa-trash"></i></button>
               </th>
                  <th>ID</th>
                  <th>User Id</th>
                  <th>User Name</th>
                  <th>Type</th>
                  <th>Address</th>
                  <th>Created_at</th>
                   <th>Controlling</th>
                 
                </tr>
                </thead>
                <tbody>
           
               
                @foreach($employers as $userinfo)
                <tr>
                <td> <input type="checkbox" name=delid[] value="{{$userinfo->id}}"></td>
                	<td>{{$userinfo->id}}</td>
                  <td>{{$userinfo->user_id}}</td>
                  <td>{{$userinfo->first_name}} {{$userinfo->last_name}}</td>
                  <td>{{$userinfo->type}}</td>
                  <td>{{$userinfo->address}}</td>
                  <td>{{$userinfo->created_at}}</td>
               
                <td>
                	<a href="{{url('/adminpanel/employer/'.$userinfo->id.'/edit')}}" class="btn btn-primary"> Edit </a>
               
                </td>
               
                    </tr>
                    @endforeach
           
                </tbody>
                <tfoot>
                {{ $employers->links() }}
     
             
                </tfoot>

              </table>
            
              </form>
           
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

         
          <!-- /.box -->
        </div>
        <!-- /.col -->

      <!-- /.row -->
    </section>
    
     @endsection