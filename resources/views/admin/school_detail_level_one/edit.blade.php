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
                 <form role="form" method="post" id="salse-man-store" action="{{url('post-update-school-detail-level-one')}}" enctype="multipart/form-data">
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

                     <br>
                     <div class="form-group">
                     <label for="al_to"><b>Child`s School</b></label>
                     </div>

                     <div class="form-group">
                      <label for="school_name">School Name</label>
                      <input type="text" class="form-control" name="school_name" id="school_name" value="{{$editData->school_name}}" required="">
                      @error('school_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     </div>


                     <div class="form-group">
                      <label for="school_addreass">School Address</label>
                      <input type="text" class="form-control" name="school_addreass" id="school_addreass" value="{{$editData->school_addreass}}" required="">
                      @error('school_addreass')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     </div>


                     <div class="form-group">
                      <label for="office_phone">Offic Contact No</label>
                      <input type="text" class="form-control" name="office_phone" id="office_phone" value="{{$editData->office_phone}}" required="">
                      @error('office_phone')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     </div>

                     <div class="form-group">
                      <label for="start_time">Start Time</label>
                      <input type="text" class="form-control" name="start_time" id="start_time" value="{{$editData->start_time}}">
                      @error('start_time')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     </div>

                     <div class="form-group">
                      <label for="end_time">End Time</label>
                      <input type="text" class="form-control" name="end_time" id="end_time" value="{{$editData->end_time}}">
                      @error('end_time')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     </div>


                      <div class="form-group">
                      <label for="website">Website</label>
                      <input type="url" class="form-control" name="website" id="website" value="{{$editData->website}}">
                      @error('website')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="principal_name">Principal`s Name</label>
                      <input type="text" class="form-control" name="principal_name" id="principal_name" value="{{$editData->principal_name}}" required="">
                      @error('principal_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     </div>

                    @csrf

                     <br>
                     <div class="form-group">
                     <label for="al_to"><b>Child`s Transportation</b></label>
                     </div>


                      <div class="form-group">
                      <label for="tr_bus_no">Bus No</label>
                      <input type="text" class="form-control" name="tr_bus_no" id="tr_bus_no" value="{{$editData->principal_name}}">
                      @error('name_of_child_care_center')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>
                  
                      <div class="form-group">
                      <label for="tr_bus_stop_location">Bus Stop Location</label>
                      <input type="text" class="form-control" name="tr_bus_stop_location" id="tr_bus_stop_location" value="{{$editData->tr_bus_stop_location}}">
                      @error('tr_bus_stop_location')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="tr_bus_pickup_time">Bus Pickup Time</label>
                      <input type="text" class="form-control" name="tr_bus_pickup_time" id="tr_bus_pickup_time" value="{{$editData->tr_bus_pickup_time}}">
                      @error('tr_bus_pickup_time')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="tr_bus_drop_time">Bus Drop-off Time</label>
                      <input type="text" class="form-control" name="tr_bus_drop_time" id="tr_bus_drop_time" value="{{$editData->tr_bus_drop_time}}">
                      @error('tr_bus_drop_time')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="tr_special_trans_arrangement">Special Transportations Arrangement</label>
                      <input type="text" class="form-control" name="tr_special_trans_arrangement" id="tr_special_trans_arrangement" value="{{$editData->tr_special_trans_arrangement}}">
                      @error('tr_special_trans_arrangement')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="tr_transportation_phone_no">Transportations Phone No</label>
                      <input type="text" class="form-control" name="tr_transportation_phone_no" id="tr_transportation_phone_no" value="{{$editData->tr_transportation_phone_no}}">
                      @error('tr_transportation_phone_no')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <br>
                      <div class="form-group">
                      <label for="al_to"><b>Student Information</b></label>
                      </div>

                      <div class="form-group">
                      <label for="stu_grade">Grade</label>
                      <input type="text" class="form-control" name="stu_grade" id="stu_grade" value="{{$editData->stu_grade}}">
                      @error('stu_grade')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="stu_id_no">Student ID No</label>
                      <input type="text" class="form-control" name="stu_id_no" id="stu_id_no" value="{{$editData->stu_id_no}}">
                      @error('stu_id_no')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="stu_lunch_pin">Lunch Pin</label>
                      <input type="text" class="form-control" name="stu_lunch_pin" id="stu_lunch_pin" value="{{$editData->stu_lunch_pin}}">
                      @error('stu_lunch_pin')
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



      