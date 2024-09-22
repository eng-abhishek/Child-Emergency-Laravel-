<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;  
use App\Models\User;
use App\Models\Parent_model;
use App\Models\Child;
use App\Models\Medical_detail_level_one;
use App\Models\Medical_detail_level_two;
use App\Models\Child_care_provider_details;
use App\Models\Child_school_details_level_one;
use App\Models\Child_school_details_lever_two;
use App\Models\Medical_immulization;

use App\Models\Extra_curriculam_activity;
use App\Models\Child_about_details;
use App\Models\Child_insurance_detail;
use App\Models\Child_support_details;
use App\Models\Document_details;
use App\Models\Legal_details;
use App\Models\Immulization;
use Illuminate\Support\Facades\Auth; 
use Validator,Redirect,Response,File;
use Twilio\Rest\Client;
use App\Models\Otp; 
use DB;
use App\Http\Controllers\Controller as Controller;
error_reporting(1);

class UserController extends Controller
{


public $successStatus = 200;
/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(Request $request){
      
      // return $request->input();

        $validator = Validator::make($request->all(), [ 
            'mobile_no' => 'required|min:10|max:15', 
        ]);

         if ($validator->fails()){
            return response()->json(
                [
                    'response_code' => 401,
                    'response_result' => $validator->errors()->first()
                ],
                200
            );
        }else{

        $userInfo=User::where('mobile_no',$request->mobile_no)->get()->first();

        if($userInfo->id){

        $six_digit_random_number = random_int(100000, 999999);


        $otp = new Otp;
        $otp->otp=$six_digit_random_number;
        $otp->mobile_no=$request->mobile_no;
        $otp->save();
        $success['mobile_no'] =  $request->mobile_no;
        $success['otp']  =  $six_digit_random_number;
        return response()->json(['success'=>$success,'response_code' => 200]); 
        }else{

        return response()->json(['response_code' => 401]);

        }
        }
        } 


        public function check_otp(Request $request){  
         $mobileno=$request->mobile_no;
         $checkotp=Otp::where(['mobile_no'=>$mobileno])->orderBy('id','DESC')->take(1)->get();
         if($checkotp[0]->otp==$request->otp){
        
         $checkmobileNo=User::where('mobile_no',$mobileno)->get();
        if($checkmobileNo[0]->id){
        $findUser=User::find($checkmobileNo[0]->id);
        $success['token'] =  $findUser->createToken('MyApp')->accessToken;
        $success['user_id']=$checkmobileNo[0]->id;
        }else{

        } 

        $success['mobile_no']=$mobileno;
     

        Otp::where('mobile_no',$mobileno)->delete();
        return response()->json(['success'=>$success,'response_code'=>200]); 
      
         }else{
         return response()->json(['result'=>'Please enter valide otp','response_code'=>401]); 
         }
         }

        public function getOTPForSignUPProcess(Request $request){

        $six_digit_random_number = random_int(100000, 999999);
        $otp = new Otp;
        $otp->otp=$six_digit_random_number;
        $otp->mobile_no=$request->mobile_no;
        $otp->save();
        $userContactNo=$request->mobile_no;

        $receiverNumber = $userContactNo;
        $message = 'your six digit otp is '.$six_digit_random_number;
  
        $success['mobile_no'] =  $request->mobile_no;
        $success['otp']  =  $six_digit_random_number;
        return response()->json(['success'=>$success,'response_code' => 200]); 
        }

     /** 
     * create user profile api 
     * 
     * @return \Illuminate\Http\Response 
     */
     
    public function create_user_profile(Request $request) 
    {


        if($request->editId){
         $checkParent=User::where('id',$request->editId)->first();
         if(empty($checkParent->id)){
         return response()->json(['response_message' =>'Please enter valide editId','response_code'=>200]);
         }
         }else{


     $validator = Validator::make($request->all(), [
            'name'=>'required|max:20|min:2',
            'email'=>'required|email|max:60|min:3|unique:users',
            // 'gender'=>'required',
            'mobile_no' => 'required|string|unique:users|min:10|max:15',
            // 'relationship_to_child'=>'required|max:20|min:2',
            // 'file' => 'required|mimes:jpg,jpeg,png,svg|max:2048',
        ]);    
    
        if($validator->fails()){
 
               return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        }

         }


        $imageName = time().'.'.$request->file->extension();
        $request->file->move(public_path('uploads/user'),$imageName);


       if($request->editId){
       $userprofile=User::find($request->editId);

       }else{

        $six_digit_random_number = random_int(100000, 999999);

        $otp = new Otp;
        $otp->otp=$six_digit_random_number;
        $otp->mobile_no=$request->mobile_no;
        $otp->save();
        $userprofile=new User;
        }

         $userprofile->name=$request->name;
         $userprofile->email=$request->email;
         $userprofile->mobile_no=$request->mobile_no;
         $userprofile->gender=$request->gender;
         $userprofile->image = url('public/uploads/user').'/'.$imageName;
         $userprofile->relationship_to_child=$request->relationship_to_child;
         $userprofile->role=$request->role;
         $userprofile->role_id=2;
         $userprofile->save();
         $insertId=$userprofile->id;
         $findUser=User::find($insertId);

         $success['token'] =  $findUser->createToken('MyApp')->accessToken;
         $success['result']['name']=$request->name;
         $success['result']['email']=$request->email;
       
         $success['result']['gender']=$request->gender;
         $success['result']['relationship_to_child']=$request->relationship_to_child;
         $success['result']['role_id']=2;
         $success['result']['user_id']=$insertId;
         $success['result']['user_image']=url('public/uploads/user').'/'.$imageName;
         $success['result']['otp']=$six_digit_random_number;

         return response()->json(['success' => $success,'response_code'=>200]);
    } 

    function getUserInformation(Request $req){
    
    $validator=Validator::make($req->all(),[
     'user_id'=>'required|exists:users,id',
    ]); 
            if($validator->fails()){
 
               return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        }

    $userInfo['result']=User::where('id',$req->user_id)->first()->toArray();
     return response()->json(['success' => $userInfo,'response_code'=>200]);
     } 
     /** 
     * create child profile api 
     * 
     * @return \Illuminate\Http\Response 
     */ 

    public function create_child_profile(Request $request){

     $validator = Validator::make($request->all(), [
            'user_id'=>'required|exists:users,id',
            // 'name'=>'required|max:40|min:2',
            // 'nick_name'=>'required|max:40|min:2',
            // 'gender'=>'required',
            // 'dob'=>'required|max:20|min:2',
            // 'file' => 'required|mimes:jpg,jpeg,png,svg|max:2048',
        ]);  

           if($validator->fails()){
 
               return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200 
            );
        }

        $imageName = time().'.'.$request->file->extension();
        $request->file->move(public_path('uploads/child'),$imageName);

        if($request->editId){

         $userprofile=Child::where('id',$request->editId)->first();
         if(empty($userprofile->id)){
         return response()->json(['response_message' =>'Please enter valide editId','response_code'=>200]);
         }
         }else{
         $userprofile=new Child;
         }

         $userprofile->user_id=$request->user_id;
        
         $userprofile->name=$request->name;
         $userprofile->nick_name=$request->nick_name;
      
         $userprofile->gender=$request->gender;
         $userprofile->dob=$request->dob;
         $userprofile->photos=url('public/uploads/child').'/'.$imageName;
         $userprofile->save();

      
         $success['result']['user_id']=$request->user_id;
         $success['result']['name']=$request->name;
         $success['result']['nick_name']=$request->nick_name;
         $success['result']['gender']=$request->gender;
         $success['result']['dob']=$request->dob;
         $success['result']['profile_image']=url('public/uploads/child').'/'.$imageName;
        
         return response()->json(['success' => $success,'response_code'=>200]);
     }
     
        public function getChildInformation(Request $req){
        
        $validator=Validator::make($req->all(),[
        'user_id'=>'required|exists:users,id',
        ]); 
        if($validator->fails()){
        
        return response()->json(
        [
        'response_code' => 401,
        'response_message' => $validator->errors()->first()
        ],
        200
        );
        }
        $childInfo=Child::where('user_id',$req->user_id)->get()->toArray();
        foreach ($childInfo as $key => $chvalue) {
        $success['result'][]=$chvalue;
        }
        return response()->json(['success' => $success,'response_code'=>200]);
        }

     

    /** 
     * create parent profile api 
     * 
     * @return \Illuminate\Http\Response 
     */ 


    public function create_parent_profile(Request $request) 
    {

     $validator = Validator::make($request->all(), [ 
            'user_id'=>'required|exists:users,id',
            'child_id'=>'required|exists:tbl_child,id',
            // 'name'=>'required|min:2|max:15',
            // 'phone_no' => 'required|min:10|max:15',
            // 'address'=>'required|min:2|max:225',
            // 'email'=>'required|email|max:60|min:3',
            // 'gender'=>'required',
            // 'relationship_to_child'=>'max:20|min:2',
            // 'file' => 'mimes:jpg,jpeg,png,svg|max:2048',
            
        ]);    
    
        if($validator->fails()){
 
               return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        }


         if($request->editId){
         $checkParent=Parent_model::where('id',$request->editId)->first();
         if(empty($checkParent->id)){
         return response()->json(['response_message' =>'Please enter valide editId','response_code'=>200]);
         }
         }
        

         if($checkParent->id){
         $userprofile=$checkParent;
          }else{
         $userprofile=new Parent_model;   
          }
         
        if($request->file('file')){

        $imageName = time().'.'.$request->file->extension();
        $request->file->move(public_path('uploads/parent'),$imageName);
        $userprofile->profile_img=url('public/uploads/parent').'/'.$imageName;
         }else{


        }

         $userprofile->user_id=$request->user_id;
         $userprofile->child_id=$request->child_id;

         $userprofile->name=$request->name;
         $userprofile->email=$request->email;
      
         $userprofile->gender=$request->gender;
         $userprofile->relationship_to_child=$request->relationship_to_child;

         $userprofile->phone_no=$request->phone_no;
         $userprofile->address=$request->address;
         $userprofile->role=$request->role;

         $userprofile->save();
    
         $success['result']['user_id']=$request->user_id;
         $success['result']['child_id']=$request->child_id;
         $success['result']['gender']=$request->gender;
         $success['result']['relationship_to_child']=$request->relationship_to_child;
         $success['result']['name']=$request->name;
         $success['result']['email']=$request->email;
         $success['result']['profile_image']=url('public/uploads/parent').'/'.$imageName;
                
         return response()->json(['success' => $success,'response_code'=>200]);
    } 

    public function getParentProfile(Request $req){

    $validator=Validator::make($req->all(),[
     'child_id'=>'required|exists:tbl_child,id',
    ]); 
            if($validator->fails()){
 
               return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        }
    $childInfo=Parent_model::where('child_id',$req->child_id)->get()->toArray();
    foreach ($childInfo as $key => $chvalue) {
    $success['result'][]=$chvalue;
    }
     return response()->json(['success' => $success,'response_code'=>200]);
      }
      
     /** 
     * create medical detail level one api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
     
        public function get_immulization(){
        $childImm=Immulization::all();
        $childInfo=$childImm->toArray();

        foreach ($childInfo as $key => $chvalue) {
        $success['result'][]=$chvalue;
        }
        return response()->json(['success' => $success,'response_code'=>200]);

        }
 
     public function Medical_detail_level_one(Request $request){

        $validator = Validator::make($request->all(), [
            'child_id'=>'required|exists:tbl_child,id',
            // 'allergic_to'=>'max:50|min:2',
            // 'standard_reaction'=>'max:50|min:2',
            // 'medical_prescribed'=>'max:50|min:2',
            // 'pr_occupation'=>'max:50|min:2',
            // 'pr_name'=>'max:50|min:2',
            // 'pr_contact_no'=>'max:15|min:10',
            // 'pr_website'=>'max:50|min:2',
            // 'pr_notes'=>'max:50|min:2',
            // 'immulization'=>'max:50|min:2',
            // 'immunization_notes'=>'max:350|min:2',
         
        ]);    
    
        if($validator->fails()){
 
               return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        }

         if($request->editId){
         $checkMed=Medical_detail_level_one::where('id',$request->editId)->first();
         if(empty($checkMed->id)){
         return response()->json(['response_message' =>'Please enter valide editId','response_code'=>200]);
         }            
         }


         if($checkMed->id){
         $userprofile=$checkMed;
         }else{
         $userprofile=new Medical_detail_level_one;            
         }

         $userprofile->child_id=$request->child_id;
         $userprofile->allergic_to=$request->allergic_to;
         $userprofile->standard_reaction=$request->standard_reaction;
         $userprofile->medical_prescribed=$request->medical_prescribed;
         $userprofile->pr_occupation=$request->pr_occupation;

         $userprofile->pr_name=$request->pr_name;
         $userprofile->pr_contact_no=$request->pr_contact_no;
         $userprofile->pr_website=$request->pr_website;
         $userprofile->pr_notes=$request->pr_notes;
         $userprofile->pr_address=$request->pr_address;
         $userprofile->immunization_notes=$request->immunization_notes;
         $userprofile->save();


        $immulizationOfChild=explode(',',$request->input('immulization'));
        $immulizationDate=explode(',',$request->input('date'));    
        
        if($checkMed->id){
        Medical_immulization::where('child_medical_id',$checkMed->id)->delete();
        }
        
        for($i=0;$i<count($immulizationOfChild);$i++){
     
        $meImmulization=new Medical_immulization;
        $meImmulization->child_medical_id=$userprofile->id;
        $meImmulization->immulization_id=$immulizationOfChild[$i];
        $meImmulization->date=$immulizationDate[$i];
        $meImmulization->save(); 
        }

         $success['result']['child_id']=$request->child_id;
         $success['result']['allergic_to']=$request->allergic_to;
         $success['result']['standard_reaction']=$request->standard_reaction;
         $success['result']['medical_prescribed']=$request->medical_prescribed;
         $success['result']['pr_occupation']=$request->pr_occupation;
        
         $success['result']['pr_name']=$request->pr_name;
         $success['result']['pr_contact_no']=$request->pr_contact_no;
         $success['result']['pr_website']=$request->pr_website;
         $success['result']['pr_notes']=$request->pr_notes;
      
         $success['result']['immunization_notes']=$request->immunization_notes;
                
         return response()->json(['success' => $success,'response_code'=>200]);
     }  



    
    public function getChildMeDetailLevelOne(Request $req){

    $validator=Validator::make($req->all(),[
     'child_id'=>'required|exists:tbl_child,id',
    ]); 
            if($validator->fails()){
 
               return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        }
    $childInfo=Medical_detail_level_one::where(['child_id'=>$req->child_id])->get()->toArray();
    
    // foreach ($childInfo as $key => $chvalue) {
    $success['result']['info'][]=$childInfo[0];
    $success['result']['immulization']=DB::table('tbl_medical_immulization')->select('tbl_immulization.id','tbl_medical_immulization.date','tbl_immulization.name')->join('tbl_immulization','tbl_immulization.id','=','tbl_medical_immulization.immulization_id')->join('tbl_medical_detail_level_one','tbl_medical_detail_level_one.id','=','tbl_medical_immulization.child_medical_id')->where('tbl_medical_detail_level_one.child_id',$req->child_id)->get();
    // }

     return response()->json(['success' => $success,'response_code'=>200]);
      }


     /** 
     * create medical detail level two api 
     * 
     * @return \Illuminate\Http\Response 
     */ 

     public function Medical_detail_level_two(Request $request){

        $validator = Validator::make($request->all(), [
            'child_id'=>'required|exists:tbl_child,id',

            // 'medication_name'=>'required|max:100|min:2',
            // 'me_reason_for_taking'=>'required|max:100|min:2',

            // 'me_dose'=>'max:50|min:2',
            // 'me_frequency'=>'max:50|min:2',

            // 'me_start_date'=>'max:30|min:2',
            // 'me_end_date'=>'max:30|min:2',
            // 'me_doctor_name'=>'max:50|min:2',
            // 'me_note'=>'max:50|min:2',
            // 'surgery_or_procedure'=>'max:50|min:2',
            // 'sr_date'=>'max:50|min:2',

            // 'sr_physician'=>'max:100|min:2',
            // 'sr_hospital'=>'max:100|min:2',
            // 'sr_note'=>'max:50|min:2',
            // 'illness'=>'max:50|min:2',

            // 'illness_start'=>'max:30|min:2',
            // 'illness_end_date'=>'max:30|min:2',
            // 'illness_treatment_note'=>'max:30|min:2',
    
        ]);    
    
        if($validator->fails()){
 
               return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        }


         $checkMed=Medical_detail_level_two::where('id',$request->editId)->first();
         if($request->editId){
         if(empty($checkMed->id)){
         return response()->json(['response_message' =>'Please enter valide editId','response_code'=>200]);
         }            
         }


         if($checkMed->id){
         $userprofile=$checkMed;
         }else{
         $userprofile=new Medical_detail_level_two;    
         }

         $userprofile->child_id=$request->child_id;
         $userprofile->medication_name=$request->medication_name;
         $userprofile->me_reason_for_taking=$request->me_reason_for_taking;
         $userprofile->me_dose=$request->me_dose;
         $userprofile->me_frequency=$request->me_frequency;
         $userprofile->me_start_date=$request->me_start_date;         
         $userprofile->me_end_date=$request->me_end_date;

         $userprofile->me_doctor_name=$request->me_doctor_name;
         $userprofile->me_note=$request->me_note;
         $userprofile->surgery_or_procedure=$request->surgery_or_procedure;
         $userprofile->sr_date=$request->sr_date;
         $userprofile->sr_physician=$request->sr_physician;
         $userprofile->sr_hospital=$request->sr_hospital;

         $userprofile->sr_note=$request->sr_note;
         $userprofile->illness=$request->illness;
         $userprofile->illness_start=$request->illness_start;
         $userprofile->illness_end_date=$request->illness_end_date;
         $userprofile->illness_treatment_note=$request->illness_treatment_note;
      
         $userprofile->save();

         $success['result']['child_id']=$request->child_id;
         $success['result']['medication_name']=$request->medication_name;
         $success['result']['me_reason_for_taking']=$request->me_reason_for_taking;
         $success['result']['me_dose']=$request->me_dose;
         $success['result']['me_frequency']=$request->me_frequency;       
         $success['result']['me_start_date']=$request->me_start_date;
         $success['result']['me_end_date']=$request->me_end_date;

         $success['result']['me_doctor_name']=$request->me_doctor_name;
         $success['result']['me_note']=$request->me_note;
         $success['result']['surgery_or_procedure']=$request->surgery_or_procedure;
         $success['result']['sr_date']=$request->sr_date;
         $success['result']['sr_physician']=$request->sr_physician;
         $success['result']['sr_hospital']=$request->sr_hospital;


         $success['result']['sr_note']=$request->sr_note;
         $success['result']['illness']=$request->illness;
         $success['result']['illness_start']=$request->illness_start;
         $success['result']['illness_end_date']=$request->illness_end_date;
         $success['result']['illness_treatment_note']=$request->illness_treatment_note;
  
         return response()->json(['success' => $success,'response_code'=>200]);
     }
     
      public function getChildMeDetailLevelTwo(Request $req){

    $validator=Validator::make($req->all(),[
     'child_id'=>'required|exists:tbl_child,id',
    ]); 
            if($validator->fails()){
 
               return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        }
    $childInfo=Medical_detail_level_two::where(['child_id'=>$req->child_id])->get()->toArray();
    foreach ($childInfo as $key => $chvalue) {
    $success['result'][]=$chvalue;
    }
     return response()->json(['success' => $success,'response_code'=>200]);
      }

     /** 
     * child care provider detail api 
     * 
     * @return \Illuminate\Http\Response 
     */ 

     function child_care_provider_details(Request $request){

        
     $validator = Validator::make($request->all(), [ 
          
            'child_id'=>'required|exists:tbl_child,id',
            // 'child_care_provider_name'=>'min:2|max:150',
            // 'name_of_child_care_center'=>'max:150|min:2',
            // 'phone_no'=>'min:10|max:15',
            // 'notes'=>'max:200|min:2',
            // 'address'=>'required|min:5|max:225',
            
        ]);    
    
        if($validator->fails()){
 
               return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        }

         $checkMed=Child_care_provider_details::where('id',$request->editId)->first();

         if($request->editId){
         if(empty($checkMed->id)){
         return response()->json(['response_message' =>'Please enter valide editId','response_code'=>200]);
         }            
         }         


         if($checkMed->id){
         $userprofile=$checkMed;
         }else{
         $userprofile=new Child_care_provider_details;
         }


         $userprofile->child_id=$request->child_id;
         $userprofile->child_care_provider_name=$request->child_care_provider_name;
         $userprofile->name_of_child_care_center=$request->name_of_child_care_center;
         $userprofile->phone_no=$request->phone_no;
         $userprofile->notes=$request->notes;
         $userprofile->address=$request->address;

         $userprofile->save();

         $success['result']['child_id']=$request->child_id;
         $success['result']['child_care_provider_name']=$request->child_care_provider_name;
         $success['result']['name_of_child_care_center']=$request->name_of_child_care_center;
         $success['result']['phone_no']=$request->phone_no;
         $success['result']['notes']=$request->notes;
  
         return response()->json(['success' => $success,'response_code'=>200]);
     }

     public function getChild_care_provider_details(Request $req){

        $validator=Validator::make($req->all(),[
        'child_id'=>'required|exists:tbl_child,id',
        ]); 
        if($validator->fails()){

        return response()->json(
        [
        'response_code' => 401,
        'response_message' => $validator->errors()->first()
        ],
        200
        );
        }
        $childInfo=Child_care_provider_details::where(['child_id'=>$req->child_id])->get()->toArray();
        foreach ($childInfo as $key => $chvalue) {
        $success['result'][]=$chvalue;
        }
        return response()->json(['success' => $success,'response_code'=>200]);
        }


     /** 
     * create child school detail level one api 
     * 
     * @return \Illuminate\Http\Response 
     */  



       function child_school_details_level_one(Request $request){

        
       $validator = Validator::make($request->all(), [ 
          
            'child_id'=>'required|exists:tbl_child,id',
            // 'school_name'=>'min:2|max:150',
            // 'school_addreass'=>'max:150|min:2',
            // 'office_phone'=>'min:10|max:15',
            // 'start_time'=>'max:10|min:2',
            // 'end_time'=>'max:10|min:2',

            // 'website'=>'min:2|max:450',
            // 'principal_name'=>'max:150|min:2',
            // 'tr_bus_no'=>'min:2|max:15',
            // 'tr_bus_stop_location'=>'max:200|min:2',

            // 'tr_bus_pickup_time'=>'min:2|max:10',
            // 'tr_bus_drop_time'=>'min:2|max:10',
            // 'tr_special_trans_arrangement'=>'max:150|min:2',
            // 'tr_transportation_phone_no'=>'min:10|max:15',
            // 'stu_grade'=>'max:100|min:2',

            // 'stu_id_no'=>'min:2|max:10',
            // 'stu_lunch_pin'=>'max:150|min:2',

            
        ]);    
    
        if($validator->fails()){
 
               return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        }

         $checkMed=Child_school_details_level_one::where('id',$request->editId)->first();
         if($request->editId){
         if(empty($checkMed->id)){
         return response()->json(['response_message' =>'Please enter valide editId','response_code'=>200]);
         }
         }

         if($checkMed->id){
         $userprofile=$checkMed;
         }else{
         $userprofile=new Child_school_details_level_one;
         }

         $userprofile->child_id=$request->child_id;

         $userprofile->school_name=$request->school_name;
         $userprofile->school_addreass=$request->school_addreass;
         $userprofile->office_phone=$request->office_phone;
         $userprofile->start_time=$request->start_time;
         $userprofile->end_time=$request->end_time;



         $userprofile->website=$request->website;
         $userprofile->principal_name=$request->principal_name;

         $userprofile->tr_bus_no=$request->tr_bus_no;
         $userprofile->tr_bus_stop_location=$request->tr_bus_stop_location;
         $userprofile->tr_bus_pickup_time=$request->tr_bus_pickup_time;

         $userprofile->tr_bus_drop_time=$request->tr_bus_drop_time;

         $userprofile->tr_special_trans_arrangement=$request->tr_special_trans_arrangement;
         $userprofile->tr_transportation_phone_no=$request->tr_transportation_phone_no;
         $userprofile->stu_grade=$request->stu_grade; 

         $userprofile->stu_id_no=$request->stu_id_no;
         $userprofile->stu_lunch_pin=$request->stu_lunch_pin;

         $userprofile->save();

         $success['result']['child_id']=$request->child_id;
         $success['result']['school_name']=$request->school_name;
         $success['result']['school_addreass']=$request->school_addreass;
         $success['result']['office_phone']=$request->office_phone;
         $success['result']['start_time']=$request->start_time;
         $success['result']['end_time']=$request->end_time;
         $success['result']['website']=$request->website;
         $success['result']['principal_name']=$request->principal_name;
         $success['result']['tr_bus_no']=$request->tr_bus_no;
         $success['result']['tr_bus_stop_location']=$request->tr_bus_stop_location;

         $success['result']['tr_special_trans_arrangement']=$request->tr_special_trans_arrangement;
         $success['result']['tr_transportation_phone_no']=$request->tr_transportation_phone_no;
         $success['result']['stu_grade']=$request->stu_grade;
         $success['result']['stu_id_no']=$request->stu_id_no;
         $success['result']['stu_lunch_pin']=$request->stu_lunch_pin;
  
         return response()->json(['success' => $success,'response_code'=>200]);
     }

        public function getchild_school_details_level_one(Request $req){
         $validator=Validator::make($req->all(),[
        'child_id'=>'required|exists:tbl_child,id',
        ]); 
        if($validator->fails()){

        return response()->json(
        [
        'response_code' => 401,
        'response_message' => $validator->errors()->first()
        ],
        200
        );
        }
        $childInfo=Child_school_details_level_one::where(['child_id'=>$req->child_id])->get()->toArray();
        foreach ($childInfo as $key => $chvalue) {
        $success['result'][]=$chvalue;
        }
        return response()->json(['success' => $success,'response_code'=>200]);
     }

     
     
       /** 
     * create child school detail level two api 
     * 
     * @return \Illuminate\Http\Response 
     */  

       function child_school_details_level_two(Request $request){
       $validator = Validator::make($request->all(), [ 
          
            'child_id'=>'required|exists:tbl_child,id',
            // 'tr_name'=>'min:2|max:150',
            // 'classroom_no'=>'max:150|min:2',

            // 'tutors_name'=>'min:2|max:150',
            // 'details_about_sub_day_time'=>'max:150|min:2',
            // 'ind_edu_plan_child_dev_challange'=>'max:150|min:2',

            // 'ind_edu_plan_date_last_meeting'=>'min:2|max:150',

            // 'ind_edu_plan_special_service'=>'max:150|min:2',

            // 'ind_edu_plan_child_receive_ssi'=>'min:2|max:150',
            // 'ind_edu_plan_ssi_amount'=>'max:150|min:2',
            // 'ind_edu_plan_add_information'=>'min:2|max:150',

        ]);    
    
        if($validator->fails()){
 
               return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        }


         $checkMed=Child_school_details_lever_two::where('id',$request->editId)->first();

         if($request->editId){
         if(empty($checkMed->id)){
         return response()->json(['response_message' =>'Please enter valide editId','response_code'=>200]);
         }
        }
         if($checkMed->id){
         $userprofile=$checkMed;
         }else{
         $userprofile=new Child_school_details_lever_two;
         }

         $userprofile->child_id=$request->child_id;

         $userprofile->tr_name=$request->tr_name;

         $userprofile->classroom_no=$request->classroom_no;

         $userprofile->tutors_name=$request->tutors_name;

         $userprofile->details_about_sub_day_time=$request->details_about_sub_day_time;

         $userprofile->ind_edu_plan_child_dev_challange=$request->ind_edu_plan_child_dev_challange;

         $userprofile->ind_edu_plan_date_last_meeting=$request->ind_edu_plan_date_last_meeting;

         $userprofile->ind_edu_plan_special_service=$request->ind_edu_plan_special_service;

         $userprofile->ind_edu_plan_child_receive_ssi=$request->ind_edu_plan_child_receive_ssi;

         $userprofile->ind_edu_plan_ssi_amount=$request->ind_edu_plan_ssi_amount;

         $userprofile->ind_edu_plan_add_information=$request->ind_edu_plan_add_information;

         $userprofile->save();

         $success['result']="Data add successfully";
        
  
         return response()->json(['success' => $success,'response_code'=>200]);
     }


 function getChild_school_details_level_two(Request $request){
       $validator = Validator::make($request->all(), [ 
          
            'child_id'=>'required|exists:tbl_child,id',
             ]);    
    
        if($validator->fails()){
 
               return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        }
       $childInfo=Child_school_details_lever_two::where(['child_id'=>$request->child_id])->get()->toArray();


        foreach ($childInfo as $key => $chvalue) {
        $success['result'][]=$chvalue;
        }
        return response()->json(['success' => $success,'response_code'=>200]);

}

/*------------- end child school detail level 2 -------*/


  /** 
     * create child curriculam detail api 
     * 
     * @return \Illuminate\Http\Response 
     */  

       function child_extra_curriculam_detail(Request $request){
       $validator = Validator::make($request->all(), [ 
          
            'child_id'=>'required|exists:tbl_child,id',
            // 'activity'=>'max:150|min:2',
            // 'days'=>'max:100|min:2',
            // 'start_time'=>'max:100|min:2',
            // 'end_time'=>'max:150|min:2',
           
            // 'location'=>'max:150|min:2',

            // 'take_coach_or_leader'=>'max:150|min:2',

            // 'contact_person_name'=>'max:150|min:2',

            // 'phone' => 'required|string|unique:tbl_extra_curriculam_activity|min:10|max:15',
            // 'email'=>'required|email|max:60|min:3|unique:tbl_extra_curriculam_activity',

            // 'other_information'=>'max:150|min:2',

        ]);    
    
        if($validator->fails()){
 
               return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        }


if($request->editId){
        $checkMed=Extra_curriculam_activity::where('id',$request->editId)->first();
         if(empty($checkMed->id)){
         return response()->json(['response_message' =>'Please enter valide editId','response_code'=>200]);
         }}

         if($checkMed->id){
         $userprofile=$checkMed;
         }else{
         $userprofile=new Extra_curriculam_activity;
         }

         $userprofile->child_id=$request->child_id;

         $userprofile->activity=$request->activity;

         $userprofile->days=$request->days;

         $userprofile->start_time=$request->start_time;

         $userprofile->end_time=$request->end_time;

         $userprofile->location=$request->location;

         $userprofile->take_coach_or_leader=$request->take_coach_or_leader;

         $userprofile->contact_person_name=$request->contact_person_name;

         $userprofile->phone=$request->phone;

         $userprofile->email=$request->email;

         $userprofile->other_information=$request->other_information;

         $userprofile->save();

         $success['result']="Data add successfully";
        
         return response()->json(['success' => $success,'response_code'=>200]);
     }


 function getChild_extra_curriculam_detail(Request $request){
       $validator = Validator::make($request->all(), [ 
          
            'child_id'=>'required|exists:tbl_child,id',
             ]);    
    
        if($validator->fails()){
 
               return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        }
       $childInfo=Extra_curriculam_activity::where(['child_id'=>$request->child_id])->get()->toArray();


        foreach ($childInfo as $key => $chvalue) {
        $success['result'][]=$chvalue;
        }
        return response()->json(['success' => $success,'response_code'=>200]);

}

/*------------- end child Extra Curriculam  activity detail -------*/


  /** 
     * create child about detail api 
     * 
     * @return \Illuminate\Http\Response 
     */  

       function child_about_detail(Request $request){
       $validator = Validator::make($request->all(), [ 
          
            'child_id'=>'required|exists:tbl_child,id',
            // 'likes_to_be_called'=>'max:150|min:2',
            // 'personality'=>'max:150|min:2',
            // 'likes'=>'max:150|min:2',
            // 'dislikes'=>'max:150|min:2',
            // 'favorite_food'=>'max:150|min:2',
            // 'good_at'=>'max:150|min:2',
            // 'learns_best_by'=>'max:150|min:2',
            //  'bedtime_routine' => 'max:150|min:2',
            // 'frightened_by'=>'max:150|min:2',

        ]);    
    
        if($validator->fails()){
 
               return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        }
if($request->editId){
         $checkMed=Child_about_details::where('id',$request->editId)->first();
         if(empty($checkMed->id)){
         return response()->json(['response_message' =>'Please enter valide editId','response_code'=>200]);
         }}

         if($checkMed->id){
         $userprofile=$checkMed;
         }else{
         $userprofile=new Child_about_details;
         }

         $userprofile->child_id=$request->child_id;
         $userprofile->likes_to_be_called=$request->likes_to_be_called;
         $userprofile->personality=$request->personality;
         $userprofile->likes=$request->likes;
         $userprofile->dislikes=$request->dislikes;
         $userprofile->favorite_food=$request->favorite_food;
         $userprofile->good_at=$request->good_at;
         $userprofile->learns_best_by=$request->learns_best_by;
         $userprofile->bedtime_routine=$request->bedtime_routine;
         $userprofile->frightened_by=$request->frightened_by;
         $userprofile->save();

         $success['result']="Data add successfully";
        
         return response()->json(['success' => $success,'response_code'=>200]);
     }


 function getChild_about_detail(Request $request){
       $validator = Validator::make($request->all(), [ 
          
            'child_id'=>'required|exists:tbl_child,id',
             ]);    
    
        if($validator->fails()){
 
               return response()->json(
                [
                    'response_code' => 401,
                    'response_message' => $validator->errors()->first()
                ],
                200
            );
        }
       $childInfo=Child_about_details::where(['child_id'=>$request->child_id])->get()->toArray();


        foreach ($childInfo as $key => $chvalue) {
        $success['result'][]=$chvalue;
        }
        return response()->json(['success' => $success,'response_code'=>200]);
}

/*------------- end child Extra Curriculam  activity detail -------*/

     /** 
     * create child insurance detail api 
     * 
     * @return \Illuminate\Http\Response 
     */  

            function child_insurance_detail(Request $request){
            $validator = Validator::make($request->all(), [ 

            'child_id'=>'required|exists:tbl_child,id',
            // 'type_of_insurance'=>'max:150|min:2',
            // 'insurance_cmp_name'=>'max:150|min:2',
            // 'plan_type'=>'max:150|min:2',
            // 'subscribe'=>'max:150|min:2',
            // 'dislikes'=>'max:150|min:2',
            // 'group_no'=>'max:150|min:2',
            // 'agent'=>'max:150|min:2',
            // 'phone_no' => 'required|min:10|max:15',
            // 'website' => 'max:150|min:2',
            // 'co_pay_deductible'=>'max:150|min:2',
            // 'notes'=>'max:350|min:2',
            ]);    

            if($validator->fails()){

            return response()->json(
            [
            'response_code' => 401,
            'response_message' => $validator->errors()->first()
            ],
            200
            );
            }

            $checkMed=Child_insurance_detail::where('id',$request->editId)->first();
            if($request->editId){
            if(empty($checkMed->id)){
            return response()->json(['response_message' =>'Please enter valide editId','response_code'=>200]);
            }}

            if($checkMed->id){
            $userprofile=$checkMed;
            }else{
            $userprofile=new Child_insurance_detail;
            }

            $userprofile->child_id=$request->child_id;
            $userprofile->type_of_insurance=$request->type_of_insurance;
            $userprofile->insurance_cmp_name=$request->insurance_cmp_name;
            
            $userprofile->plan_type=$request->plan_type;

            $userprofile->subscribe=$request->subscribe;

            $userprofile->member_no=$request->member_no;

            $userprofile->group_no=$request->group_no;

            $userprofile->agent=$request->agent;

            $userprofile->phone_no=$request->phone_no;

            $userprofile->website=$request->website;

            $userprofile->co_pay_deductible=$request->co_pay_deductible;

            $userprofile->notes=$request->notes;

            $userprofile->save();

            $success['result']="Data add successfully";

            return response()->json(['success' => $success,'response_code'=>200]);
            }


            function getChild_insurance_detail(Request $request){
            $validator = Validator::make($request->all(), [ 

            'child_id'=>'required|exists:tbl_child,id',
            ]);    

            if($validator->fails()){

            return response()->json(
            [
            'response_code' => 401,
            'response_message' => $validator->errors()->first()
            ],
            200
            );
            }
            $childInfo=Child_insurance_detail::where(['child_id'=>$request->child_id])->get()->toArray();


            foreach ($childInfo as $key => $chvalue) {
            $success['result'][]=$chvalue;
            }
            return response()->json(['success' => $success,'response_code'=>200]);
            }

/*------------- end child insurance detail -------*/




            /** 
            * create child support detail api 
            * 
            * @return \Illuminate\Http\Response 
            */  

            function child_support_detail(Request $request){
            $validator = Validator::make($request->all(), [ 

            'child_id'=>'required|exists:tbl_child,id',
            // 'person'=>'required|max:150|min:2',
            // 'relation_to_child'=>'max:150|min:2',
            // 'address'=>'max:150|min:2',
           
            // 'email'=>'required|max:150|min:2|email',
            // 'notes'=>'max:350|min:2',
            // 'phone_no' => 'required|min:10|max:15',
        
            ]);    

            if($validator->fails()){

            return response()->json(
            [
            'response_code' => 401,
            'response_message' => $validator->errors()->first()
            ],
            200
            );
            }

            $checkMed=Child_support_details::where('id',$request->editId)->first();
            if($request->editId){
            if(empty($checkMed->id)){
            return response()->json(['response_message' =>'Please enter valide editId','response_code'=>200]);
            }}

            if($checkMed->id){
            $userprofile=$checkMed;
            }else{
            $userprofile=new Child_support_details;
            }

            $userprofile->child_id=$request->child_id;
            $userprofile->person=$request->person;

            $userprofile->relation_to_child=$request->relation_to_child;

            $userprofile->address=$request->address;

            $userprofile->email=$request->email;

            $userprofile->notes=$request->notes;

            $userprofile->phone_no=$request->phone_no;

            $userprofile->save();

            $success['result']="Data add successfully";

            return response()->json(['success' => $success,'response_code'=>200]);
            }


            function getChild_support_detail(Request $request){
            $validator = Validator::make($request->all(), [ 

            'child_id'=>'required|exists:tbl_child,id',
            ]);    

            if($validator->fails()){

            return response()->json(
            [
            'response_code' => 401,
            'response_message' => $validator->errors()->first()
            ],
            200
            );
            }
            $childInfo=Child_support_details::where(['child_id'=>$request->child_id])->get()->toArray();


            foreach ($childInfo as $key => $chvalue) {
            $success['result'][]=$chvalue;
            }
            return response()->json(['success' => $success,'response_code'=>200]);
            }

/*------------- end child support detail -------*/


/*-------------  child document  detail -------*/

 
           public function document_details(Request $request){

           $validator = Validator::make($request->all(), [

            'child_id'=>'required|exists:tbl_child,id',
           
            ]);    

            if($validator->fails()){

            return response()->json(
            [
            'response_code' => 401,
            'response_message' => $validator->errors()->first()
            ],
            200
            );
            }

            $checkMed=Document_details::where('id',$request->editId)->first();
            if($request->editId){
            if(empty($checkMed->id)){
            return response()->json(['response_message' =>'Please enter valide editId','response_code'=>200]);
            }}

            if($checkMed->id){
            $userprofile=$checkMed;
            }else{
            $userprofile=new Document_details;
            }

            $userprofile->child_id=$request->child_id;

            $userprofile->employee_name=$request->employee_name;
            $userprofile->address=$request->address;
            $userprofile->phone_no=$request->phone_no;
            $userprofile->supervisor_name=$request->supervisor_name;


if($request->birth_certificate_loc){
            $brimage = time().'.'.$request->birth_certificate_loc->extension();
            $request->birth_certificate_loc->move(public_path('uploads/bitrhCr'),$brimage);

           $userprofile->birth_certificate_loc=url('public/uploads/bitrhCr').'/'.$brimage;    
}

            if($request->social_security_card_loc){
            $SSCimage = time().'.'.$request->social_security_card_loc->extension();
            $request->social_security_card_loc->move(public_path('uploads/SSCimage'),$SSCimage);

           $userprofile->social_security_card_loc=url('public/uploads/SSCimage').'/'.$SSCimage;
            }
           



if($request->passport_loc){
            $PassPortimage = time().'.'.$request->passport_loc->extension();
            $request->passport_loc->move(public_path('uploads/PassPortimage'),$PassPortimage);

           $userprofile->passport_loc=url('public/uploads/PassPortimage').'/'.$PassPortimage;    
}




if($request->naturalization_papers_loc){
            $naturalizationPapersImg = time().'.'.$request->naturalization_papers_loc->extension();
            $request->naturalization_papers_loc->move(public_path('uploads/naturalizationPapersImg'),$naturalizationPapersImg);

           $userprofile->naturalization_papers_loc=url('public/uploads/naturalizationPapersImg').'/'.$naturalizationPapersImg;    
}




if($request->will_and_ancillary_doc){

            $willImg = time().'.'.$request->will_and_ancillary_doc->extension();
            $request->will_and_ancillary_doc->move(public_path('uploads/willImg'),$willImg);

           $userprofile->will_and_ancillary_doc=url('public/uploads/willImg').'/'.$willImg;    
}



if($request->power_of_attorney_loc){
            $powerAtt = time().'.'.$request->power_of_attorney_loc->extension();
            $request->power_of_attorney_loc->move(public_path('uploads/powerAtt'),$powerAtt);

           $userprofile->power_of_attorney_loc=url('public/uploads/powerAtt').'/'.$powerAtt;    
}




if($request->guardian){
            $guardian = time().'.'.$request->guardian->extension();
            $request->guardian->move(public_path('uploads/guardian'),$guardian);

           $userprofile->guardian=url('public/uploads/guardian').'/'.$guardian;    
}


if($request->life_insurance_policy_loc){
            $lifeInsu = time().'.'.$request->life_insurance_policy_loc->extension();
            $request->life_insurance_policy_loc->move(public_path('uploads/lifeInsu'),$lifeInsu);

           $userprofile->life_insurance_policy_loc=url('public/uploads/lifeInsu').'/'.$lifeInsu;    
}


if($request->children_life_insu_policies_loc){
            $childlifeInsu = time().'.'.$request->children_life_insu_policies_loc->extension();
            $request->children_life_insu_policies_loc->move(public_path('uploads/childlifeInsu'),$childlifeInsu);

           $userprofile->children_life_insu_policies_loc=url('public/uploads/childlifeInsu').'/'.$childlifeInsu;
}


if($request->other_loc){
           $otherDoc = time().'.'.$request->other_loc->extension();
            $request->other_loc->move(public_path('uploads/otherDoc'),$otherDoc);

           $userprofile->other_loc=url('public/uploads/otherDoc').'/'.$otherDoc;


}


           $userprofile->save();

           $success['result']="Data add successfully";
        

         return response()->json(['success' => $success,'response_code'=>200]);
}

            function getChild_document_detail(Request $request){
            $validator = Validator::make($request->all(), [ 

            'child_id'=>'required|exists:tbl_child,id',
            ]);    

            if($validator->fails()){

            return response()->json(
            [
            'response_code' => 401,
            'response_message' => $validator->errors()->first()
            ],
            200
            );
            }
            $childInfo=Document_details::where(['child_id'=>$request->child_id])->get()->toArray();


            foreach ($childInfo as $key => $chvalue) {
            $success['result'][]=$chvalue;
            }
            return response()->json(['success' => $success,'response_code'=>200]);
            }

 /*-------------  end child document  detail -------*/    

            function child_legal_detail(Request $request){
            $validator = Validator::make($request->all(), [ 
            'child_id'=>'required|exists:tbl_child,id',
       
            ]);    

            if($validator->fails()){

            return response()->json(
            [
            'response_code' => 401,
            'response_message' => $validator->errors()->first()
            ],
            200
            );
            }

            $checkMed=Legal_details::where('id',$request->editId)->first();
            if($request->editId){
            if(empty($checkMed->id)){
            return response()->json(['response_message' =>'Please enter valide editId','response_code'=>200]);
            }}

            if($checkMed->id){
            $userprofile=$checkMed;
            }else{
            $userprofile=new Legal_details;
            }

            $userprofile->child_id=$request->child_id;

            $userprofile->poa_representative_name=$request->poa_representative_name;
            
            $userprofile->for_which_child=$request->for_which_child;
            

            if($request->attach_poa_file){
            $arfileimage = time().'.'.$request->attach_poa_file->extension();
            $request->attach_poa_file->move(public_path('uploads/arfileimage'),$arfileimage);

            $userprofile->attach_poa_file=url('public/uploads/arfileimage').'/'.$arfileimage;    
            }

            // /*---------- Attachment file ------*/
            // $userprofile->attach_poa_file=$request->attach_poa_file;
            // /*---------- Attachment file ------*/


            $userprofile->standby_guardian_name=$request->standby_guardian_name;

            $userprofile->standby_alternet_guardian_name=$request->standby_alternet_guardian_name;

            $userprofile->standby_for_which_child=$request->standby_for_which_child;


            if($request->standby_attach_gua_file){
            $arfileGUAimage = time().'.'.$request->standby_attach_gua_file->extension();
            $request->standby_attach_gua_file->move(public_path('uploads/arfileGUAimage'),$arfileGUAimage);

            $userprofile->standby_attach_gua_file=url('public/uploads/arfileGUAimage').'/'.$arfileGUAimage;    
            }

            // /*---------- Attachment file ------*/
            // $userprofile->=$request->standby_attach_gua_file;
            // /*---------- Attachment file ------*/


            $userprofile->standby_has_paternity_been_established=$request->standby_has_paternity_been_established;


            $userprofile->is_there_currently_a_custody_order_in_place=$request->is_there_currently_a_custody_order_in_place;


            $userprofile->what_are_the_current_custody_arrangements=$request->what_are_the_current_custody_arrangements;


            $userprofile->is_there_a_current_active_custody_case=$request->is_there_a_current_active_custody_case;


            $userprofile->case_or_docket_number=$request->case_or_docket_number;

            $userprofile->notes=$request->notes;

            $userprofile->save();

            $success['result']="Data add successfully";

            return response()->json(['success' => $success,'response_code'=>200]);
            }


            function getChild_legal_detail(Request $request){
            $validator = Validator::make($request->all(), [ 

            'child_id'=>'required|exists:tbl_child,id',
            ]);    

            if($validator->fails()){

            return response()->json(
            [
            'response_code' => 401,
            'response_message' => $validator->errors()->first()
            ],
            200
            );
            }
            $childInfo=Legal_details::where(['child_id'=>$request->child_id])->get()->toArray();


            foreach ($childInfo as $key => $chvalue) {
            $success['result'][]=$chvalue;
            }
            return response()->json(['success' => $success,'response_code'=>200]);
            }


    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this->successStatus); 
    } 

}
