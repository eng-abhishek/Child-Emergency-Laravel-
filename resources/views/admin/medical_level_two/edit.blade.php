@extends('admin.layout.layout')
@section('title','Edit Medical')
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
            <small>Edit Parent</small>
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
                  <h3 class="box-title">Edit Medical Level Two</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 <form role="form" method="post" id="salse-man-store" action="{{url('post-update-medical-level-two')}}" enctype="multipart/form-data">
                  <div class="box-body">

                   
                    <div class="form-group">
                    <label for="child_id">Select User</label>
                    <select class="form-control" name="child_id" onchange="getChild(this.value)" required="">
                    <option value="">--select user--</option>  
                    @foreach($child_list as $all_user)
                    <option value="{{$all_user->id}}" @if($all_user->id==$editId->child_id) selected @else @endif >{{$all_user->name}}</option>
                    @endforeach
                    </select>   
                    @error('child_id')
                    <div class="validate_err">{{ $message }}</div>
                    @enderror
                    </div>

                    @csrf

                     <br>
                     <div class="form-group">
                     <label for="al_to"><b>Medication </b></label>
                     </div>
               
                      <div class="form-group">
                      <label for="medication_name">Medication Name</label>
                      <input type="text" class="form-control" value="{{$editId->medication_name}}" name="medication_name" id="medication_name" required="">
                      @error('medication_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      @csrf
                      <div class="form-group">
                      <label for="me_reason_for_taking">Reson For taking</label>
                      <input type="text" class="form-control" name="me_reason_for_taking" id="me_reason_for_taking" value="{{$editId->me_reason_for_taking}}" required="">
                      @error('me_reason_for_taking')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>
                  
                      

                      <div class="form-group">
                      <label for="me_dose">Dose</label>
                      <input type="text" class="form-control" value="{{$editId->me_dose}}" name="me_dose" id="me_dose" required="">
                      @error('me_dose')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                    
                      <div class="form-group">
                      <label for="me_frequency">Frequency</label>
                      <input type="text" class="form-control" value="{{$editId->me_frequency}}" name="me_frequency" id="me_frequency">
                      @error('me_frequency')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="me_start_date">Start Date</label>
                      <input type="text" class="form-control" value="{{$editId->me_start_date}}" name="me_start_date" id="me_start_date">
                      @error('me_start_date')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="me_end_date">End Date</label>
                      <input type="text" class="form-control" value="{{$editId->me_end_date}}" name="me_end_date" id="me_end_date">
                      @error('me_end_date')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="me_doctor_name">Doctor Name</label>
                      <input type="text" class="form-control" value="{{$editId->me_doctor_name}}" name="me_doctor_name" id="me_doctor_name">
                      @error('me_doctor_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>
                      
                      <div class="form-group">
                      <label for="me_note">Note</label>
                      <input type="text" class="form-control" value="{{$editId->me_note}}" name="me_note" id="me_note">
                      @error('me_note')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                     <br>
                     <div class="form-group">
                     <label for="al_to"><b>Surgery</b></label>
                     </div>

                      <div class="form-group">
                      <label for="surgery_or_procedure">Surgery/Procedure</label>
                      <input type="text" class="form-control" value="{{$editId->surgery_or_procedure}}" name="surgery_or_procedure" id="surgery_or_procedure">
                      @error('surgery_or_procedure')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="sr_date">Date</label>
                      <input type="text" value="{{$editId->sr_date}}" class="form-control" name="sr_date" id="sr_date">
                      @error('sr_date')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>
                      
                      <div class="form-group">
                      <label for="sr_physician">Physician</label>
                      <input type="text" class="form-control" value="{{$editId->sr_physician}}" name="sr_physician" id="sr_physician">
                      @error('sr_physician')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="sr_hospital">Hospital</label>
                      <input type="text" class="form-control" value="{{$editId->sr_hospital}}" name="sr_hospital" id="sr_hospital">
                      @error('sr_hospital')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="sr_note">Note</label>
                      <input type="text" class="form-control" value="{{$editId->sr_note}}" name="sr_note" id="sr_note">
                      @error('sr_note')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                     <br>
                     <div class="form-group">
                     <label for="al_to"><b>Major Illness</b></label>
                     </div>

                      <div class="form-group">
                      <label for="illness">Illness</label>
                      <input type="text" class="form-control" value="{{$editId->illness}}" name="illness" id="illness">
                      @error('illness')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="illness_start">Start Date</label>
                      <input type="text" value="{{$editId->illness_start}}" class="form-control" name="illness_start" id="illness_start">
                      @error('illness_start')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                         <div class="form-group">
                      <label for="illness_end_date">End Date</label>
                      <input type="text" class="form-control" value="{{$editId->illness_end_date}}" name="illness_end_date" id="illness_end_date">
                      @error('illness_end_date')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                       <div class="form-group">
                      <label for="illness_treatment_note">Treatment Note</label>
                      <input type="text" class="form-control" value="{{$editId->illness_treatment_note}}" name="illness_treatment_note" id="illness_treatment_note">
                      @error('illness_treatment_note')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


   
                  </div><!-- /.box-body -->
                  <input type="text" hidden name="editId" value="{{$editId->id}}"> 
          
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

$("#me_start_date").flatpickr({
    dateFormat: "d/m/Y",
    maxDate: new Date(),
});

$("#me_end_date").flatpickr({
    dateFormat: "d/m/Y",
    maxDate: new Date(),
});

$("#sr_date").flatpickr({
    dateFormat: "d/m/Y",
    maxDate: new Date(),
});

$("#illness_start").flatpickr({
    dateFormat: "d/m/Y",
    maxDate: new Date(),
});

$("#illness_end_date").flatpickr({
    dateFormat: "d/m/Y",
    maxDate: new Date(),
});


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



      