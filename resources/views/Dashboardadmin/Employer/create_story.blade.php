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
    Success Story
      
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('adminpanel')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class=""><a href="{{url('/adminpanel/employer')}}"> Employer Controlling </a></li>
        
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

   <form  role="form" method="POST" action="{{ url('/adminpanel/employerstory/stor/').'/'.$data2->id }}" enctype="multipart/form-data">

                     {{csrf_field()}}

      

                    
                            
                         <div class="col-md-10">
                           <div class="divwits">
                                <textarea style="width:50%;" type="text" name="description" 
                                class="form-control" placeholder="talk about your experiences" type="text" 
                                class="text2{{ $errors->has(' description') ? ' is-invalid' : '' }}" 
                                name="  description" value="{{ old(' description') }}"
                                onblur="processForm(this.form)"></textarea>
                            </div>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            
                           
                            </div>

                         
          <br>

    <br>
                        <br>
                        <div class="col-md-10">

                        <div class="divwits">


                        <div   style="width:50%;" class="input-group input-file" name="logo">
                            <input type="text" class="form-control requirments"  placeholder='image...'  />
                            <span class="input-group-btn">
                            <button class="btn btn-default btn-choose largeredbtn brows" type="button" onblur="processForm(this.form)">brows</button>
                            </span> 
                        </div>

                        
                        </div>
                     
                    
<br>
                <div class="form-group">
                    <button type="submit" class="btn-primary" >Post Story </button>
                </div>

              </form>
             
             
            </div>
            </div>
          </div>
         </div>
       
 </section>

@endsection
