@extends('admin.layout.layout')
@section('title','Edit Document Detail')
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
            <small>Edit Document Detail</small>
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
                  <h3 class="box-title">Edit Document Detail</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 <form role="form" method="post" id="salse-man-store" action="{{url('post-update-document-details')}}" enctype="multipart/form-data">
                  <div class="box-body">

                    <div class="form-group">
                    <label for="user_id">Select Child</label>
                    <select class="form-control" name="child_id" onchange="getChild(this.value)" required="">
                    <option value="">--select child--</option>  
                    @foreach($child_list as $all_user)
                    <option value="{{$all_user->id}}" @if($all_user->id==$editData->child_id) selected @else @endif >{{$all_user->name}}</option>
                    @endforeach
                    </select>   
                    @error('child_id')
                    <div class="validate_err">{{ $message }}</div>
                    @enderror
                    </div>

                  
                      <div class="form-group">
                      <label for="dislikes"><b>Employer</b></label>
                  
                      </div>
                  
                     <div class="form-group">
                      <label for="employee_name">Employee Name</label>
                      <input type="text" class="form-control" name="employee_name" id="employee_name" value="{{$editData->employee_name}}">
                      @error('employee_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                     </div>

                      @csrf
                      <div class="form-group">
                      <label for="address">Add Address</label>
                      <input type="text" class="form-control" name="address" id="address" value="{{$editData->address}}">
                      @error('address')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>
                  
                      <div class="form-group">
                      <label for="phone_no">Phone No</label>
                      <input type="text" class="form-control" name="phone_no" id="phone_no" value="{{$editData->phone_no}}">
                      @error('phone_no')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="supervisor_name">Supervisor Name</label>
                      <input type="text" class="form-control" name="supervisor_name" id="supervisor_name" value="{{$editData->supervisor_name}}">
                      @error('supervisor_name')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="dislik"><b>Relevant Document</b></label>
                      </div>

                      <div class="form-group">
                      <label for="birth_certificate_loc">Birth Certificates Location</label>
                      <input type="file" class="form-control" name="birth_certificate_loc" id="birth_certificate_loc" value="{{$editData->birth_certificate_loc}}">

                      @if($editData->birth_certificate_loc)
                      <input type="text" name="OLDbirth_certificate_loc" hidden="">
                      <p><a target="_blank" href="{{$editData->birth_certificate_loc}}">Click to view</a></p>
                      @else 
                      
                      @endif

                      @error('birth_certificate_loc')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="social_security_card_loc">Social Security Cards Location</label>
                      <input type="file" class="form-control" name="social_security_card_loc" id="social_security_card_loc">
                   
                      @if($editData->social_security_card_loc)
                      <input type="text" name="OLDsocial_security_card_loc" hidden="">
                      <p><a target="_blank" href="{{$editData->social_security_card_loc}}">Click to view</a></p>
                      @else 
                      
                      @endif

                      @error('social_security_card_loc')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="passport_loc">Passports Location</label>
                      <input type="file" class="form-control" name="passport_loc" id="passport_loc">

                      @if($editData->passport_loc)
                      <input type="text" name="OLDpassport_loc" hidden="">
                      <p><a target="_blank" href="{{$editData->passport_loc}}">Click to view</a></p>
                      @else 
                      
                      @endif

                      @error('passport_loc')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="naturalization_papers_loc">Naturalization Paper Location</label>
                      <input type="file" class="form-control" name="naturalization_papers_loc" id="naturalization_papers_loc">
                    

                      @if($editData->naturalization_papers_loc)
                      <input type="text" name="OLDnaturalization_papers_loc" hidden="">
                      <p><a target="_blank" href="{{$editData->naturalization_papers_loc}}">Click to view</a></p>
                      @else 
                      
                      @endif

                      @error('naturalization_papers_loc')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="will_and_ancillary_doc">Will and Ancillary Document</label>
                      <input type="file" class="form-control" name="will_and_ancillary_doc" id="will_and_ancillary_doc">

                      @if($editData->will_and_ancillary_doc)
                      <input type="text" name="OLDwill_and_ancillary_doc" hidden="">
                      <p><a target="_blank" href="{{$editData->will_and_ancillary_doc}}">Click to view</a></p>
                      @else 
                      
                      @endif

                      @error('will_and_ancillary_doc')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="power_of_attorney_loc">Power of Attorney Location</label>
                      <input type="file" class="form-control" name="power_of_attorney_loc" id="power_of_attorney_loc">
                     
                      @if($editData->power_of_attorney_loc)
                      <input type="text" name="OLDpower_of_attorney_loc" hidden="">
                      <p><a target="_blank" href="{{$editData->power_of_attorney_loc}}">Click to view</a></p>
                      @else 
                      
                      @endif

                      @error('power_of_attorney_loc')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="guardian">Guardian</label>
                      <input type="file" class="form-control" name="guardian" id="guardian">
                     
                      @if($editData->guardian)
                      <input type="text" name="OLDguardian" hidden="">
                      <p><a target="_blank" href="{{$editData->guardian}}">Click to view</a></p>
                      @else 
                      
                      @endif

                      @error('guardian')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>

                      <div class="form-group">
                      <label for="life_insurance_policy_loc">Life Insurance Policy Location</label>
                      <input type="file" class="form-control" name="life_insurance_policy_loc" id="life_insurance_policy_loc">
                 
                      @if($editData->life_insurance_policy_loc)
                      <input type="text" name="OLDlife_insurance_policy_loc" hidden="">
                      <p><a target="_blank" href="{{$editData->life_insurance_policy_loc}}">Click to view</a></p>
                      @else 
                      
                      @endif
                      @error('life_insurance_policy_loc')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="children_life_insu_policies_loc">Children`s Life Indurance Policies Locations</label>
                      <input type="file" class="form-control" name="children_life_insu_policies_loc" id="children_life_insu_policies_loc">
                    
                      @if($editData->children_life_insu_policies_loc)
                      <input type="text" name="OLDchildren_life_insu_policies_loc" hidden="">
                      <p><a target="_blank" href="{{$editData->children_life_insu_policies_loc}}">Click to view</a></p>
                      @else 
                      
                      @endif
                      @error('children_life_insu_policies_loc')
                      <div class="validate_err">{{ $message }}</div>
                      @enderror
                      </div>


                      <div class="form-group">
                      <label for="other_loc">Other Location</label>
                      <input type="file" class="form-control" name="other_loc" id="other_loc">
                      @if($editData->other_loc)
                      <input type="text" name="OLDother_loc" hidden="">
                      <p><a target="_blank" href="{{$editData->other_loc}}">Click to view</a></p>
                      @else 
                      
                      @endif
                      @error('other_loc')
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



      