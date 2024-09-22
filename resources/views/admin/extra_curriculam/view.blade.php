@extends('admin.layout.layout')
@section('title','Add Extra Curricular Detail')
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
    <!--       <div class="col-md-1"></div> -->
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Add New Extra Curricular</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" id="salse-man-store" action="{{url('post-add-extra-curricular')}}">                 
                  <div class="box-body">
                    
                    <div class="form-group">
                    <label for="user_id">Select Child</label>
                    <select class="form-control" name="child_id" onchange="getChild(this.value)" required="">
                    <option value="">--select child--</option>  
                    @foreach($child_list as $all_user)
                    <option value="{{$all_user->id}}">{{$all_user->name}}</option>
                    @endforeach
                    </select>   
                    @error('child_id')
                    <div class="validate_err">{{ $message }}</div>
                    @enderror
                    </div>
                  
                     <div class="form-group">
                      <label for="activity">Activity</label>
                      <input type="text" class="form-control" name="activity" id="activity" required="">
                      @error('activity')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     </div>

                      @csrf
                      <div class="form-group">
                      <label for="days">Days</label>
                      <input type="date" class="form-control" name="days" id="days" required="">
                      @error('days')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>
                  
                      <div class="form-group">
                      <label for="start_time">Start Time</label>
                      <input type="text" class="form-control" name="start_time" id="start_time">
                      @error('start_time')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="end_time">End Time</label>
                      <input type="text" class="form-control" name="end_time" id="end_time">
                      @error('end_time')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="location">Location</label>
                      <input type="text" class="form-control" name="location" id="location">
                      @error('location')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="take_coach_or_leader">What the child needs to take coach or leader</label>
                      <input type="text" class="form-control" name="take_coach_or_leader" id="take_coach_or_leader">
                      @error('take_coach_or_leader')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="contact_person_name">Pontact person`s name</label>
                      <input type="text" class="form-control" name="contact_person_name" id="contact_person_name">
                      @error('contact_person_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="phone">Phone</label>
                      <input type="text" class="form-control" name="phone" id="phone">
                      @error('phone')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="email">Email</label>
                      <input type="text" class="form-control" name="email" id="email">
                      @error('email')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="other_information">Other Information</label>
                      <input type="text" class="form-control" name="other_information" id="other_information">
                      @error('other_information')
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


      