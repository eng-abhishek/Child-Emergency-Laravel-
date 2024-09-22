@extends('admin.layout.layout')
@section('title','Edit School Detail Level One')
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
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li class="active">Edit</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
    <!--       <div class="col-md-1"></div> -->
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Edit User</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 <form role="form" method="post" id="salse-man-store" action="{{url('post-update-user')}}" enctype="multipart/form-data">
                  <div class="box-body">

                      <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" name="name" value="{{$editData->name}}" id="name" required="">
                      @error('name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     </div>
                      @csrf
                      <div class="form-group">
                      <label for="email">Email</label>
                      <input type="text" class="form-control" value="{{$editData->email}}" name="email" id="email" required="">
                      @error('email')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="mobile_no">Contact No</label>
                      <input type="text" class="form-control" value="{{$editData->mobile_no}}" name="mobile_no" id="mobile_no" required="">
                      @error('mobile_no')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="img">Image</label>
                      <input type="file" class="form-control" name="file" id="file">
                      @error('image')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <?php 
                      if($editData->image){
                      ?>
                      <img src="{{$editData->image}}" width="50px" style="border-radius:50%">
                      <input type="text" hidden name="OldImg" value="{{$editData->image}}"> 
                      <?php
                      }else{
                      ?>
                      <?php
                      }
                      ?>

                      <div class="form-group">
                      <label for="country">Gender</label>
                      <select class="form-control" name="gender" required="">
                      <option @if($editData->gender=="male") selected @else @endif value="male"> Male </option>   
                      <option @if($editData->gender=="female") selected @else @endif value="female"> Female </option>   
                      </select>
                      @error('gender')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="relationship_to_child">Relationship To Child</label>
                      <input type="text" class="form-control" value="{{$editData->relationship_to_child}}" name="relationship_to_child" id="relationship_to_child">
                      @error('relationship_to_child')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="country">Generate Password</label>
                      <input type="password" value="{{$editData->password}}" class="form-control" name="password" id="password" required="">
                      @error('password')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                     
                  </div><!-- /.box-body -->
                  <input type="text" hidden name="editId" value="{{$editData->id}}"> 
          
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary edit-btn-foodCat">Submit</button>
                  </div>
                </form>
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



      