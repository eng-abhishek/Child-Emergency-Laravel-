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
            <small>Edit Medical Level One</small>
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
                  <h3 class="box-title">Edit Medical Level One</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 <form role="form" method="post" id="salse-man-store" action="{{url('post-update-medical-level-one')}}" enctype="multipart/form-data">
                  <div class="box-body">

                    <div class="form-group">
                    <label for="child_id">Select User</label>
                    <select class="form-control" name="child_id" onchange="getChild(this.value)" required="">
                    <option value="">--select user--</option>  
                    @foreach($child_list as $all_user)
                    <option value="{{$all_user->id}}" @if($all_user->id==$editData->child_id) selected @else @endif >{{$all_user->name}}</option>
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
                        <input type="text" class="form-control" name="allergic_to" value="{{$editData->allergic_to}}" id="allergic_to" required="">
                        @error('allergic_to')
                        <div class="validate_err">{{ $message }}</div>
                        @enderror
                        </div>

                        <div class="form-group">
                        <label for="standard_reaction">Standard Reaction</label>
                        <input type="text" class="form-control" name="standard_reaction" id="standard_reaction" value="{{$editData->standard_reaction}}" required="">
                        @error('standard_reaction')
                        <div class="validate_err">{{ $message }}</div>
                        @enderror
                        </div>

                        <div class="form-group">
                        <label for="medication_prescribed">Medical Prescribed</label>
                        <input type="text" class="form-control" name="medication_prescribed" id="medication_prescribed" value="{{$editData->medical_prescribed}}" required="">
                        @error('medication_prescribed')
                        <div class="validate_err">{{ $message }}</div>
                        @enderror
                        </div>
                      @csrf
                 
                  <br>
                     <div class="form-group">
                     <label for="al_to"><b>Medical Providers</b></label>
                     </div>

                      <div class="form-group">
                      <label for="pr_occupation">Type/Occupation</label>
                      <input type="text" class="form-control" value="{{$editData->pr_occupation}}" name="pr_occupation" id="pr_occupation" required="">
                      @error('pr_occupation')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="pr_name">Name</label>
                      <input type="text" value="{{$editData->pr_name}}" class="form-control" name="pr_name" id="pr_name">
                      @error('pr_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="pr_contact_no">Contact No</label>
                      <input type="text" class="form-control" name="pr_contact_no" id="pr_contact_no" value="{{$editData->pr_contact_no}}" required="">
                      @error('pr_contact_no')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="pr_website">Website</label>
                      <input type="text" value="{{$editData->pr_website}}" class="form-control" name="pr_website" id="pr_website">
                      @error('pr_website')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="pr_name">Notes</label>
                      <input type="text" class="form-control" value="{{$editData->pr_notes}}" name="pr_notes" id="pr_notes">
                      @error('pr_notes')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                     <div class="form-group">
@foreach($immu_list as $key=>$dataImmu)
                     <div class="row">
                     <div class="col-sm-2"></div>  
                     <div class="col-sm-4">
                      <input type="checkbox" @if(in_array($dataImmu->id,$child_immu)) checked @else @endif   name="immu[]" value="{{$dataImmu->id}}">
                      <label for="pr_name">{{$dataImmu->name}}</label>
                     </div>
                     <div class="col-sm-4">

@if(in_array($dataImmu->id,$child_immu)) 

                     <input type="date" name="date[]" value="{{$child_immu_arr[$key]['date']}}" class="form-control">  

 @else 
 <input type="date" name="date[]"  class="form-control">    
 @endif             

                     </div>
                     <div class="col-sm-2"></div>  
                     </div><br>
@endforeach                    

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



      