@extends('admin.layout.layout')
@section('title','Add Legal Detail')
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
                  <h3 class="box-title">Add New Legal Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" id="salse-man-store" action="{{url('post-add-legal-details')}}" enctype="multipart/form-data">                 
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
                      <label for="likes_to_be_called">Power of Attorney</label>
                     </div>


                     <div class="form-group">
                      <label for="poa_representative_name">POA Representative`s Name</label>
                      <input type="text" class="form-control" name="poa_representative_name" id="poa_representative_name">
                      @error('poa_representative_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     </div>

                      @csrf
                      <div class="form-group">
                      <label for="for_which_child">For Which Child</label>
                      <input type="text" class="form-control" name="for_which_child" id="for_which_child">
                      @error('for_which_child')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>
                  
                      <div class="form-group">
                      <label for="attach_poa_file">Attach POA File</label>
                      <input type="file" class="form-control" name="attach_poa_file" id="attach_poa_file">
                      @error('likes')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="dislikes">Standby Guardian </label>
                      
                      </div>

                  
                      <div class="form-group">
                      <label for="standby_guardian_name">Standby Gurdian`s Name</label>
                      <input type="text" class="form-control" name="standby_guardian_name" id="standby_guardian_name">
                      @error('standby_guardian_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="standby_alternet_guardian_name">Alternate Standby Gurdian`s Name</label>
                      <input type="text" class="form-control" name="standby_alternet_guardian_name" id="standby_alternet_guardian_name">
                      @error('standby_alternet_guardian_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="standby_for_which_child">For which Child(ren)</label>
                      <input type="text" class="form-control" name="standby_for_which_child" id="standby_for_which_child">
                      @error('standby_for_which_child')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="standby_attach_gua_file">Attach GUA File</label>
                      <input type="file" class="form-control" name="standby_attach_gua_file" id="standby_attach_gua_file">
                      @error('standby_attach_gua_file')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="phone_no">Standby Gurdian</label>
                   
                      </div>


                      <div class="form-group">
                      <label for="standby_has_paternity_been_established">Has paternity been established ?</label>
                      <input type="text" class="form-control" name="standby_has_paternity_been_established" id="standby_has_paternity_been_established">
                      @error('standby_has_paternity_been_established')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="is_there_currently_a_custody_order_in_place">Is there currently a custody order in place ?</label>
                      <input type="text" class="form-control" name="is_there_currently_a_custody_order_in_place" id="is_there_currently_a_custody_order_in_place">
                      @error('is_there_currently_a_custody_order_in_place')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                    <div class="form-group">
                      <label for="what_are_the_current_custody_arrangements">What are the current custody arrangements ?</label>
                      <input type="text" class="form-control" name="what_are_the_current_custody_arrangements" id="what_are_the_current_custody_arrangements">
                      @error('what_are_the_current_custody_arrangements')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                                          <div class="form-group">
                      <label for="is_there_a_current_active_custody_case">Is there a current or active custody case ?</label>
                      <input type="text" class="form-control" name="is_there_a_current_active_custody_case" id="is_there_a_current_active_custody_case">
                      @error('is_there_a_current_active_custody_case')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="case_or_docket_number">Case or docket number ?</label>
                      <input type="text" class="form-control" name="case_or_docket_number" id="case_or_docket_number">
                      @error('case_or_docket_number')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="notes">Notes </label>
                      <textarea type="text" class="form-control" name="notes" id="notes"></textarea>
                      @error('notes')
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


      