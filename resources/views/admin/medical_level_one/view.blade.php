@extends('admin.layout.layout')
@section('title','Medical')
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
                  <h3 class="box-title">Add Medical Level One</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" id="salse-man-store" action="{{url('post-add-medical-level-one')}}" enctype="multipart/form-data">                 
                  <div class="box-body">
                    
                    <div class="form-group">
                    <label for="child_id">Select Child</label>
                    <select class="form-control" name="child_id" required="">
                    <option value="">--select child--</option>  
                    @foreach($child_list as $all_user)
                    <option value="{{$all_user->id}}">{{$all_user->name}}</option>
                    @endforeach
                    </select>   
                    @error('child_id')
                    <div class="validate_err">{{ $message }}</div>
                    @enderror
                    </div>

                      <br>
                     <div class="form-group">
                     <label for="al_to"><b>Medical Allergic</b></label>
                     </div>

                      <div class="form-group">
                      <label for="name">Allergic To</label>
                      <input type="text" class="form-control" name="allergic_to" id="allergic_to" required="">
                      @error('allergic_to')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      @csrf
                      <div class="form-group">
                      <label for="standard_reaction">Standard Reaction</label>
                      <input type="text" class="form-control" name="standard_reaction" id="standard_reaction" required="">
                      @error('standard_reaction')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>
                  
                      <div class="form-group">
                      <label for="medication_prescribed">Medication Prescribed</label>
                      <input type="text" class="form-control" name="medication_prescribed" id="medication_prescribed" required="">
                      @error('medication_prescribed')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>
                      
                     <br>
                     <div class="form-group">
                     <label for="al_to"><b>Medical Providers</b></label>
                     </div>

                      <div class="form-group">
                      <label for="address">Type/Occupation</label>
                      <input type="text" class="form-control" name="pr_occupation" id="pr_occupation" required="">
                      @error('address')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="pr_name">Name</label>
                      <input type="text" class="form-control" name="pr_name" id="pr_name">
                      @error('pr_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="pr_contact_no">Contact No</label>
                      <input type="text" class="form-control" name="pr_contact_no" id="pr_contact_no" required="">
                      @error('pr_contact_no')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="pr_website">Website</label>
                      <input type="text" class="form-control" name="pr_website" id="pr_website">
                      @error('pr_website')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="pr_name">Notes</label>
                      <input type="text" class="form-control" name="pr_notes" id="pr_notes">
                      @error('pr_notes')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <br>
                     <div class="form-group">
                     <label for="al_to"><b>Immunization</b></label>
                     </div>

                    <div class="form-group">
@foreach($immu_list as $dataImmu)
                     <div class="row">
                     <div class="col-sm-2"></div>  
                     <div class="col-sm-4">
                      <input type="checkbox" name="immu[]" value="{{$dataImmu->id}}">
                      <label for="pr_name">{{$dataImmu->name}}</label>
                     </div>
                     <div class="col-sm-4">
                     <input type="date" name="date[]" class="form-control">  
                     </div>
                     <div class="col-sm-2"></div>  
                     </div><br>
@endforeach                    

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

$("#immuDate").flatpickr({
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


      