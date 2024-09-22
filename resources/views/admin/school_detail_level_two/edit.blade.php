@extends('admin.layout.layout')
@section('title','Edit School Detail Level Two')
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
                 <form role="form" method="post" id="salse-man-store" action="{{url('post-update-school-detail-level-two')}}" enctype="multipart/form-data">
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
                     <label for="al_to"><b>Child`s Teacher</b></label>
                     </div>

                     <div class="form-group">
                      <label for="tr_name">Teacher Name</label>
                      <input type="text" class="form-control" name="tr_name" id="tr_name" required="" value="{{$editData->tr_name}}">
                      @error('tr_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     </div>

                     <div class="form-group">
                      <label for="classroom_no">Class Room No</label>
                      <input type="text" class="form-control" name="classroom_no" id="classroom_no" value="{{$editData->classroom_no}}" required="">
                      @error('classroom_no')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     </div>

                     @csrf
                     <br>
                     <div class="form-group">
                     <label for="al_to"><b>Child`s Tutors</b></label>
                     </div>

                      <div class="form-group">
                      <label for="tutors_name">Tutor`s Name</label>
                      <input type="text" value="{{$editData->tutors_name}}" class="form-control" name="tutors_name" id="tutors_name" >
                      @error('tutors_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     </div>


                      <div class="form-group">
                      <label for="details_about_sub_day_time">Details about subject, days, and time for tutoring </label>
                      <input type="text" class="form-control" name="details_about_sub_day_time" value="{{$editData->details_about_sub_day_time}}" id="details_about_sub_day_time" >
                      @error('details_about_sub_day_time')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     </div>

                     <br>
                     <div class="form-group">
                     <label for="al_to"><b>Individual Education Plan</b></label>
                     </div>

                      <div class="form-group">
                      <label for="ind_edu_plan_child_dev_challange">Explane Child`s Developement Challenges</label>
                      <input type="text" class="form-control" name="ind_edu_plan_child_dev_challange" id="ind_edu_plan_child_dev_challange" value="{{$editData->ind_edu_plan_child_dev_challange}}">
                      @error('ind_edu_plan_child_dev_challange')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="ind_edu_plan_date_last_meeting">Date of last meeting</label>
                      <input type="text" class="form-control" name="ind_edu_plan_date_last_meeting" value="{{$editData->ind_edu_plan_date_last_meeting}}" id="ind_edu_plan_date_last_meeting" >
                      @error('ind_edu_plan_date_last_meeting')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="ind_edu_plan_special_service">Special services or accommodation provided at school</label>
                      <input type="text" class="form-control" name="ind_edu_plan_special_service" id="ind_edu_plan_special_service" value="{{$editData->ind_edu_plan_special_service}}">
                      @error('ind_edu_plan_special_service')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="ind_edu_plan_child_receive_ssi">Does the child receive SSI ?</label>
                      <input type="text" class="form-control" name="ind_edu_plan_child_receive_ssi" id="ind_edu_plan_child_receive_ssi" value="{{$editData->ind_edu_plan_child_receive_ssi}}">
                      @error('ind_edu_plan_child_receive_ssi')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

 
                     <div class="form-group">
                      <label for="ind_edu_plan_ssi_amount">SSI Amount</label>
                      <input type="text" class="form-control" name="ind_edu_plan_ssi_amount" id="ind_edu_plan_ssi_amount" value="{{$editData->ind_edu_plan_ssi_amount}}">
                      @error('ind_edu_plan_ssi_amount')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="ind_edu_plan_add_information">Add Information or Instructions</label>
                      <input type="text" class="form-control" name="ind_edu_plan_add_information" id="ind_edu_plan_add_information" value="{{$editData->ind_edu_plan_add_information}}">
                      @error('ind_edu_plan_add_information')
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



      