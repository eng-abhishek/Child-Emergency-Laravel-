@extends('admin.layout.layout')
@section('title','Add Child')
@section('content')
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
         @if ($errors->any())
            <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            </ul>
            </div>
            @endif
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Admin 
            <small>Child Emergency Plan</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Add</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            @if ($errors->any())
            <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            </ul>
            </div>
            @endif
    <!--       <div class="col-md-1"></div> -->
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Add New Child</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" id="salse-man-store" action="{{url('post-add-child')}}" enctype="multipart/form-data">                 
                  <div class="box-body">
                    

                    <div class="form-group">
                    <label for="user_id">Select User</label>
                    <select class="form-control" name="user_id" required="">
                    <option value="">--select user--</option>  
                    @foreach($user_list as $all_user)
                    <option value="{{$all_user->id}}">{{$all_user->name}}</option>
                    @endforeach
                    </select>   
                    @error('user_name')
                    <div class="validate_err">{{ $message }}</div>
                    @enderror
                    </div>

                     <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" name="name" id="name" required="">
                      @error('name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     </div>
                     @csrf

                     <div class="form-group">
                      <label for="name">Nick Name</label>
                      <input type="text" class="form-control" name="nick_name" id="nick_name" required="">
                      @error('nick_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     </div>

                      <div class="form-group">
                      <label for="country">Gender</label>
                      <select class="form-control" name="gender" required="">
                      <option value="male"> Male </option>   
                      <option value="female"> Female </option>   
                      </select>
                      @error('gender')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="dob">DOB</label>
                     <input type="text" id="dob" name="dob" class="form-control" required="">
                      @error('dob')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>
                      
                      <div class="form-group">
                      <label for="file">Image</label>
                      <input type="file" class="form-control" name="file" id="file" required="">
                      @error('file')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>
                     </div>                  
                     <div class="box-footer">
                     <button type="submit" class="btn btn-primary btn-proCat">Submit</button>
                     </div>
                </form>
               </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!--/.col (left) -->
            <!-- right column -->
          <!--   <div class="col-md-1"></div> -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection
@section('script')
<script>
$(function(){

$("#dob").flatpickr({
    dateFormat: "d/m/Y",
    maxDate: new Date(),
});

$('salse-man-store').validate({
 rules:{
  name:{
   required:true,
   minlength:3,
   maxlength:20,   
  },
  email:{
  required:true,
  email:true,  
  },
 contact_no:{
  required:true,
  number:true, 
  maxlength:10,
  minlength:10,  
 },
 img:{
  required:true,
 },
 address:{
  required:true, 
  maxlength:80,
  minlength:10, 
 },
 zip_code:{
 required:true,
 maxlength:30,
 minlength:3, 
          },
 country:{
 required:true,
 maxlength:30,
 minlength:3, 
  },
 password:{
 required:true,
 maxlength:15,
 minlength:8,
  }        
 },
 messages:{
   name:{
   required:'*Please Enter Name', 
   },
  email:{
  required:'Please Enter Email Id',
  email:'Please Enter validate Email Id',  
  },
  contact_no:{
  required:'Please Enter Contact No',  
 },
  img:{
  required:'Please Enter Image',
 },
 address:{
  required:'Please Enter Address', 
 },
 zip_code:{
 required:'Please Enter Zip Code',
 },
 country:{
 required:'Please Enter Country',
  },
 password:{
 required:'Please Enter Password', 
 } 
 } 
});
});
</script>
@stop


      