@extends('admin.layout.layout')
@section('title','Edit Care Provider')
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
            <small>Edit Care Provider</small>
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
                  <h3 class="box-title">Edit Care Provider</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 <form role="form" method="post" id="salse-man-store" action="{{url('post-update-care-provider')}}" enctype="multipart/form-data">
                  <div class="box-body">

                    <div class="form-group">
                    <label for="user_id">Select Child</label>
                    <select class="form-control" name="child_id" onchange="getChild(this.value)" required="">
                    <option value="">--select child--</option>  
                    @foreach($child_list as $all_user)
                    <option value="{{$all_user->id}}" @if($all_user->id==$editData->child_id) selected @else @endif >{{$all_user->name}}</option>
                    @endforeach
                    </select>   
                    @error('user_name')
                    <div class="validate_err">{{ $message }}</div>
                    @enderror
                    </div>

                     <div class="form-group">
                      <label for="child_care_provider_name">Provider Name</label>
                      <input type="text" class="form-control" name="child_care_provider_name" value="{{$editData->child_care_provider_name}}" id="child_care_provider_name" required="">
                      @error('child_care_provider_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     </div>

                      <div class="form-group">
                      <label for="name_of_child_care_center">Name Child Care Provider Center</label>
                      <input type="text" class="form-control" name="name_of_child_care_center" value="{{$editData->name_of_child_care_center}}" id="name_of_child_care_center" required="">
                      @error('name_of_child_care_center')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      @csrf



  <div class="form-group">
                      <label for="address">Address</label>
                      <input type="text" class="form-control" value="{{$editData->address}}" name="address" id="address" required="">
                      @error('address')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="phone_no">Phone No</label>
                      <input type="text" class="form-control" name="phone_no" id="phone_no" value="{{$editData->phone_no}}" required="">
                      @error('phone_no')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="notes">Note</label>
                      <textarea type="text" class="form-control" name="notes" id="notes" required="">{{$editData->notes}}</textarea>
                      @error('notes')
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

function getChild(id){

//alert(id);
$.ajax({
url:'{{url("getChild")}}',
method:'POST',
data:{id:id,'_token':"{{csrf_token()}}"},
success:function(data){
console.log(data);
$('#child_id').html(data);
}
});

}

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



      