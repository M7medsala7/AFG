@extends('Dashboardadmin.layout.layout')
@section('content')

 <section class="content-header" style="background-color: ">
 <form  role="form" method="POST" action="{{url('/adminpanel/question/search')}}" enctype="multipart/form-data">
    
    {{csrf_field()}}

           <div style="margin-left:67%;">
           <input type="text" placeholder="Search.." name="s">
          <button type="submit" style="background-color:#dbc65d;;"><i class="fa fa-search" ></i></button>
          </div>
</form>

      <ol class="breadcrumb">
        <li><a href="{{url('adminpanel')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{url('/adminpanel/postjob')}}"> Add question
      </ol>
 </section>

    <!-- Main content -->
    <section class="content" style="background-color:; ">
      <div class="row">
        <div class="col-xs-12">
         
            <!-- /.box-header -->
            <div class="box-body">
      <form action="{{url('/adminpanel/deleteid/question')}}" method="post">
      {{csrf_field()}}
       
            <table id="example2" class="table table-bordered table-striped dataTable">

                <thead>
                <tr>
                  <th> <button type="submit" class="btn btn-primary"><i class="fa fa-trash"></i></button>
                  </th>
                  <th>ID</th>
                  <th > Question</th>
                  <th> Weight</th>
                  <th>PostJob Id</th>
                  <th>Created_at</th>
                   <th>Controlling</th>
                </tr>
                </thead>
                <tbody>
           
               
                @foreach($question as $userinfo)
                <tr>
                <td><input type="checkbox" name=delid[] value="{{$userinfo->id}}"></td>
                	<td>{{$userinfo->id}}</td>
                  <td>{{$userinfo->question}}</td>
                  <td>{{$userinfo->weight}}</td>
                  <td>{{$userinfo->post_job_id}}</td>
                  <td>{{$userinfo->created_at}}</td>
               
                <td>
               
                	<a href="{{url('/adminpanel/question/'.$userinfo->id.'/edit')}}" class="btn btn-primary"> Edit </a>
                
                </td>
                </tr>
                @endforeach
           
                </tbody>
                <tfoot>
                {{ $question->links() }}
              
           
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