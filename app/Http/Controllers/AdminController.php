<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
use Validator;
use Hash;
use Session;
use DB;
class AdminController extends Controller
{
function login(){
return view('admin.login');
}
public function login_post(Request $request)
{
$validator = Validator::make($request->all(),[
'email' => 'required|email|max:60|min:3',
'password' => 'required|min:8|max:16'
]);
if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}
$credentials = $request->only('email','password');
if(Auth::attempt($credentials)){
if(Auth::user()->role_id == 1){
$useLoginId=User::where(['email'=>$request->email])->get();

session()->put('admin-login-id',$useLoginId[0]->id);
if($request->has('remember'))
{
$hour = time() + 3600 * 24 * 30;
Cookie::queue('email',$request->email, $hour);
Cookie::queue('password',$request->password, $hour);
Cookie::queue('remember',1, $hour);
}
return redirect(url('admin-dashboard'));
}else{
Session::flush();
Auth::logout();

return redirect(url('admin-login'));
}
}else{

return redirect(url('admin-login'));
}
}
public function admin_dashboard(){
    return view('admin.index');
}
/*-------------- user management -----------*/
public function index(){
$data['allUser']=User::where('role_id','2')->orderBy('id','DESC')->get();
return view('admin.user.index',$data);
}
public function add_user(){
return view('admin.user.view');
}
public function post_add_user(Request $request){

$validator = Validator::make($request->all(), [
'name'=>'required|max:30|min:2',
'email'=>'required|email|max:60|min:3|unique:users',
'gender'=>'required',
'mobile_no' => 'required|string|unique:users|min:10|max:15',
'relationship_to_child'=>'required|max:20|min:2',
'file' => 'required|mimes:jpg,jpeg,png,svg|max:2048',
'password' => 'required|min:8|max:16',
]);

if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}

$imageName = time().'.'.$request->file->extension();
$request->file->move(public_path('uploads/user'),$imageName);
$userprofile=new User;
$userprofile->name=$request->name;
$userprofile->email=$request->email;
$userprofile->mobile_no=$request->mobile_no;
$userprofile->gender=$request->gender;
$userprofile->image = url('public/uploads/user').'/'.$imageName;
$userprofile->relationship_to_child=$request->relationship_to_child;
$userprofile->password=$request->password;
$userprofile->role_id=2;
if($userprofile->save()){

return redirect()->route('user');
}else{
}
}
public function update_user($id){
$data['editData']=User::find($id);
return view('admin.user.edit',$data);
}
public function post_update(Request $request){
// return $request->input();
$validator = Validator::make($request->all(), [
'name'=>'required|max:30|min:2',
'email'=>'required|email|max:60|min:3',
'gender'=>'required',
'mobile_no' => 'required|string|min:10|max:15',
'relationship_to_child'=>'required|max:20|min:2',
'file' => 'mimes:jpg,jpeg,png,svg|max:2048',
'password' => 'required|min:8|max:16',
]);

if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}

$userprofile=User::find($request->editId);
if($request->file('file')){

$imageName = time().'.'.$request->file->extension();
$user_img=url('public/uploads/user').'/'.$imageName;
$request->file->move(public_path('uploads/user'), $imageName);
}else{
$user_img=$request->input('OldImg');
}
$userprofile->name=$request->name;
$userprofile->email=$request->email;
$userprofile->mobile_no=$request->mobile_no;
$userprofile->gender=$request->gender;
$userprofile->image = $user_img;
$userprofile->relationship_to_child=$request->relationship_to_child;
$userprofile->password=$request->password;
$userprofile->role_id=2;
if($userprofile->update()){
\Session::put('success','Data Update Successfully.');
return redirect()->route('user');
}else{
\Session::put('warning','Something went wrong.');
}
}
public function delete_user($id){
if(User::where('id',$id)->delete()){
return redirect()->route('user');
\Session::put('success','Data Remove Successfully.');
}else{
return redirect()->route('user');
\Session::put('warning','Something went wrong.');
}
}
/*--------------end user management -----------*/
/*-------------- child management -----------*/
public function index_child(){

$data['allUser']=DB::table('tbl_child')->select('tbl_child.id','tbl_child.name','tbl_child.nick_name','tbl_child.gender','tbl_child.dob','tbl_child.photos','users.name as user_name')->join('users','tbl_child.user_id','=','users.id')->orderBy('id','DESC')->get();
return view('admin.child.index',$data);
}
public function add_child(){
$data['user_list']=User::where('role_id','2')->orderBy('id','DESC')->get();
return view('admin.child.view',$data);
}
public function post_add_child(Request $request){

$validator = Validator::make($request->all(), [
'user_id'=>'required|exists:users,id',
'name'=>'required|max:30|min:2',
'nick_name'=>'required|max:30|min:2',
'gender'=>'required',
'dob'=>'required',
'file' => 'required|mimes:jpg,jpeg,png,svg|max:2048',
]);

if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}

$imageName = time().'.'.$request->file->extension();
$request->file->move(public_path('uploads/child'),$imageName);
$userprofile=new Child;

$userprofile->user_id=$request->user_id;

$userprofile->name=$request->name;
$userprofile->nick_name=$request->nick_name;

$userprofile->gender=$request->gender;
$userprofile->dob=$request->dob;
$userprofile->photos=url('public/uploads/child').'/'.$imageName;
$userprofile->save();
if($userprofile->save()){

return redirect()->route('child');
}else{
}
}
public function update_child($id){
$data['user_list']=User::where('role_id','2')->orderBy('id','DESC')->get();
$data['editData']=Child::find($id);
return view('admin.child.edit',$data);
}
public function post_update_child(Request $request){
// return $request->input();
$validator = Validator::make($request->all(), [
'user_id'=>'required|exists:users,id',
'name'=>'required|max:30|min:2',
'nick_name'=>'required|max:30|min:2',
'gender'=>'required',
'dob'=>'required',
'file' => 'mimes:jpg,jpeg,png,svg|max:2048',
]);

if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}
$userprofile=Child::find($request->editId);
if($request->file('file')){

$imageName = time().'.'.$request->file->extension();
$user_img=url('public/uploads/child').'/'.$imageName;
$request->file->move(public_path('uploads/child'), $imageName);
}else{
$user_img=$request->input('OldImg');
}
$userprofile->user_id=$request->user_id;

$userprofile->name=$request->name;
$userprofile->nick_name=$request->nick_name;

$userprofile->gender=$request->gender;
$userprofile->dob=$request->dob;
$userprofile->photos=$user_img;
if($userprofile->update()){
\Session::put('success','Data Update Successfully.');
return redirect()->route('child');
}else{
\Session::put('warning','Something went wrong.');
}
}
public function delete_child($id){
if(Child::where('id',$id)->delete()){
return redirect()->route('child');
\Session::put('success','Data Remove Successfully.');
}else{
return redirect()->route('child');
\Session::put('warning','Something went wrong.');
}
}
/*--------------end child management -----------*/
/*-------------- parent management -----------*/
public function index_parent(){
$data['allUser']=DB::table('tbl_parent')->select('tbl_parent.id','tbl_parent.name','tbl_parent.gender','tbl_parent.email','tbl_parent.profile_img','tbl_parent.phone_no','tbl_child.name as child_name','tbl_parent.relationship_to_child','users.name as user_name')->join('tbl_child','tbl_parent.child_id','=','tbl_child.id')->join('users','tbl_parent.user_id','=','users.id')->orderBy('id','DESC')->get();
return view('admin.parent.index',$data);
}
public function add_parent(){
$data['user_list']=User::where('role_id','2')->orderBy('id','DESC')->get();
return view('admin.parent.view',$data);
}
public function getChild(Request $req){
$child_list=Child::where('id',$req->id)->orderBy('id','DESC')->get();
$output='';
$output.='<select name="child_id" class="form-control">';
    $output.='<option>-- select child --</option>';
    foreach($child_list as $activityData){
    $output.='<option value="'.$activityData->id.'">'.$activityData->name.'</option>';
    }
$output.='</select>';
return $output;
}
public function post_add_parent(Request $request){

$validator = Validator::make($request->all(), [
'user_id'=>'required|exists:users,id',
'child_id'=>'required|exists:tbl_child,id',
'name'=>'required|min:2|max:30',
'phone_no'=>'required|string|min:10|max:15',
'address'=>'required|min:5|max:120',
'email'=>'required|email|max:60|min:3',
'gender'=>'required',
'relationship_to_child'=>'required|max:20|min:2',
'file' => 'required|mimes:jpg,jpeg,png,svg|max:2048',

]);

if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}

$imageName = time().'.'.$request->file->extension();
$request->file->move(public_path('uploads/parent'),$imageName);
$userprofile=new Parent_model;

$userprofile->user_id=$request->user_id;
$userprofile->child_id=$request->child_id;
$userprofile->name=$request->name;
$userprofile->email=$request->email;

$userprofile->gender=$request->gender;
$userprofile->relationship_to_child=$request->relationship_to_child;
$userprofile->phone_no=$request->phone_no;
$userprofile->address=$request->address;
$userprofile->profile_img=url('public/uploads/parent').'/'.$imageName;
if($userprofile->save()){

\Session::put('success','Data Update Successfully.');
return redirect()->route('parent');
}else{
\Session::put('warning','Something went wrong.');
return redirect()->route('parent');
}
}
public function update_parent($id){
$data['user_list']=User::where('role_id','2')->orderBy('id','DESC')->get();
$data['child_list']=Child::orderBy('id','DESC')->get();
$data['editData']=Parent_model::where('id',$id)->first();
return view('admin.parent.edit',$data);
}
public function post_update_parent(Request $request){
// return $request->input();
$validator = Validator::make($request->all(), [
'user_id'=>'required|exists:users,id',
'child_id'=>'required|exists:tbl_child,id',
'name'=>'required|min:2|max:30',
'phone_no'=>'required|string|min:10|max:15',
'address'=>'required|min:5|max:120',
'email'=>'required|email|max:60|min:3',
'gender'=>'required',
'relationship_to_child'=>'required|max:20|min:2',
'file' => 'mimes:jpg,jpeg,png,svg|max:2048',

]);

if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}

$userprofile=Parent_model::find($request->editId);
if($request->file('file')){

$imageName = time().'.'.$request->file->extension();
$user_img=url('public/uploads/parent').'/'.$imageName;
$request->file->move(public_path('uploads/parent'), $imageName);
}else{
$user_img=$request->input('OldImg');
}
$userprofile->user_id=$request->user_id;
$userprofile->child_id=$request->child_id;
$userprofile->name=$request->name;
$userprofile->email=$request->email;

$userprofile->gender=$request->gender;
$userprofile->relationship_to_child=$request->relationship_to_child;
$userprofile->phone_no=$request->phone_no;
$userprofile->address=$request->address;
$userprofile->profile_img=$user_img;
if($userprofile->update()){
\Session::put('success','Data Update Successfully.');
return redirect()->route('parent');
}else{
\Session::put('warning','Something went wrong.');
}
}
public function delete_parent($id){
if(Parent_model::where('id',$id)->delete()){
return redirect()->route('parent');
\Session::put('success','Data Remove Successfully.');
}else{
return redirect()->route('parent');
\Session::put('warning','Something went wrong.');
}
}

public function parent_detail($id){

}

/*--------------end parent management -----------*/
/*-------------- medical level one management -----------*/
public function index_medical_level_one(){

$data['allUser']=DB::table('tbl_medical_detail_level_one')->select('tbl_medical_detail_level_one.id','tbl_child.name','tbl_medical_detail_level_one.allergic_to','tbl_medical_detail_level_one.standard_reaction','tbl_medical_detail_level_one.medical_prescribed','tbl_medical_detail_level_one.pr_occupation','tbl_medical_detail_level_one.pr_name','tbl_medical_detail_level_one.pr_contact_no','tbl_medical_detail_level_one.pr_website','tbl_medical_detail_level_one.pr_notes','tbl_medical_detail_level_one.immunization_notes')->join('tbl_child','tbl_child.id','=','tbl_medical_detail_level_one.child_id')->orderBy('id','DESC')->get();
return view('admin.medical_level_one.index',$data);
}
public function add_medical_level_one(){
$data['child_list']=Child::orderBy('id','DESC')->get();
$data['immu_list']=Immulization::all();
return view('admin.medical_level_one.view',$data);
}
public function post_add_medical_level_one(Request $request){

$validator = Validator::make($request->all(), [
'child_id'=>'required|exists:tbl_child,id',
'allergic_to'=>'required|max:50|min:2',
'standard_reaction'=>'required|max:50|min:2',
// 'medication_prescribed'=>'required|max:50|min:2',
'pr_occupation'=>'required|max:50|min:2',
'pr_name'=>'required|max:50|min:2',
'pr_contact_no'=>'required|max:15|min:10',
'pr_website'=>'required|max:50|min:5|url',
'pr_notes'=>'required|max:50|min:2',
'immunization_notes'=>'max:350|min:2',
]);

if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}
$userprofile=new Medical_detail_level_one;
$userprofile->child_id=$request->child_id;
$userprofile->allergic_to=$request->allergic_to;
$userprofile->standard_reaction=$request->standard_reaction;
$userprofile->medical_prescribed=$request->medication_prescribed;
$userprofile->pr_occupation=$request->pr_occupation;
$userprofile->pr_name=$request->pr_name;
$userprofile->pr_contact_no=$request->pr_contact_no;
$userprofile->pr_website=$request->pr_website;
$userprofile->pr_notes=$request->pr_notes;
$userprofile->immunization_notes=$request->immunization_notes;
$userprofile->save();
for($i=0;$i<count($request->immu);$i++){

$meImmulization=new Medical_immulization;
$meImmulization->child_medical_id=$userprofile->id;
$meImmulization->immulization_id=$request->immu[$i];
$meImmulization->date=$request->date[$i];
$meImmulization->save();
}
\Session::put('success','Data Add Successfully.');
return redirect()->route('medical-level-one');

}
public function update_medical_level_one($id){
$data['child_list']=Child::orderBy('id','DESC')->get();
$data['immu_list']=Immulization::all();
$data['editData']=DB::table('tbl_medical_detail_level_one')->select('tbl_medical_detail_level_one.id','tbl_medical_detail_level_one.child_id','tbl_child.name','tbl_medical_detail_level_one.allergic_to','tbl_medical_detail_level_one.standard_reaction','tbl_medical_detail_level_one.medical_prescribed','tbl_medical_detail_level_one.pr_occupation','tbl_medical_detail_level_one.pr_name','tbl_medical_detail_level_one.pr_contact_no','tbl_medical_detail_level_one.pr_website','tbl_medical_detail_level_one.pr_notes','tbl_medical_detail_level_one.immunization_notes')->join('tbl_child','tbl_child.id','=','tbl_medical_detail_level_one.child_id')->where('tbl_medical_detail_level_one.id',$id)->orderBy('id','DESC')->first();
$data['child_immu']=Medical_immulization::where('child_medical_id',$data['editData']->id)->pluck('immulization_id')->toArray();
$data['child_immu_arr']=Medical_immulization::where('child_medical_id',$data['editData']->id)->get()->toArray();
return view('admin.medical_level_one.edit',$data);
}
public function post_update_medical_level_one(Request $request){
$validator = Validator::make($request->all(), [
'child_id'=>'required|exists:tbl_child,id',
'allergic_to'=>'required|max:50|min:2',
'standard_reaction'=>'required|max:50|min:2',
// 'medication_prescribed'=>'required|max:50|min:2',
'pr_occupation'=>'required|max:50|min:2',
'pr_name'=>'required|max:50|min:2',
'pr_contact_no'=>'required|max:15|min:10',
'pr_website'=>'required|max:50|min:5|url',
'pr_notes'=>'required|max:50|min:2',
'immunization_notes'=>'max:350|min:2',
]);

if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}
$userprofile=Medical_detail_level_one::where('id',$request->editId)->first();
$userprofile->child_id=$request->child_id;
$userprofile->allergic_to=$request->allergic_to;
$userprofile->standard_reaction=$request->standard_reaction;
$userprofile->medical_prescribed=$request->medication_prescribed;
$userprofile->pr_occupation=$request->pr_occupation;
$userprofile->pr_name=$request->pr_name;
$userprofile->pr_contact_no=$request->pr_contact_no;
$userprofile->pr_website=$request->pr_website;
$userprofile->pr_notes=$request->pr_notes;
$userprofile->immunization_notes=$request->immunization_notes;
$userprofile->save();
Medical_immulization::where('child_medical_id',$request->editId)->delete();
for($i=0;$i<count($request->immu);$i++){

$meImmulization=new Medical_immulization;
$meImmulization->child_medical_id=$userprofile->id;
$meImmulization->immulization_id=$request->immu[$i];
$meImmulization->date=$request->date[$i];
$meImmulization->save();
}
\Session::put('success','Data Update Successfully.');
return redirect()->route('medical-level-one');

}
public function delete_medical_level_one($id){

Medical_immulization::where('child_medical_id',$id)->delete();
if(Medical_detail_level_one::where('id',$id)->delete()){
return redirect()->route('medical-level-one');
\Session::put('success','Data Remove Successfully.');
}else{
return redirect()->route('medical-level-one');
\Session::put('warning','Something went wrong.');
}
}
public function medical_level_one_detail($id){
$data['order']=DB::table('tbl_medical_detail_level_one')->select('tbl_medical_detail_level_one.id','tbl_child.name','tbl_medical_detail_level_one.allergic_to','tbl_medical_detail_level_one.standard_reaction','tbl_medical_detail_level_one.medical_prescribed','tbl_medical_detail_level_one.pr_occupation','tbl_medical_detail_level_one.pr_name','tbl_medical_detail_level_one.pr_contact_no','tbl_medical_detail_level_one.pr_website','tbl_medical_detail_level_one.pr_notes','tbl_medical_detail_level_one.immunization_notes')->join('tbl_child','tbl_child.id','=','tbl_medical_detail_level_one.child_id')->where('tbl_medical_detail_level_one.id',$id)->first();
$data['child_immu_arr']=DB::table('tbl_medical_immulization')->select('*')->join('tbl_medical_detail_level_one','tbl_medical_detail_level_one.id','=','tbl_medical_immulization.child_medical_id')->join('tbl_immulization','tbl_immulization.id','=','tbl_medical_immulization.immulization_id')->where('child_medical_id',$data['order']->id)->get()->toArray();

return view('admin.medical_level_one.detail',$data);
}
/*--------------end child management -----------*/
/*-------------- child medical level two management -----------*/
public function index_medical_level_two(){

$data['allUser']=DB::table('tbl_medical_detail_level_two')->select('tbl_medical_detail_level_two.id','tbl_child.name','tbl_medical_detail_level_two.medication_name','tbl_medical_detail_level_two.me_reason_for_taking','tbl_medical_detail_level_two.me_dose','tbl_medical_detail_level_two.me_frequency','tbl_medical_detail_level_two.me_start_date','tbl_medical_detail_level_two.me_end_date','tbl_medical_detail_level_two.me_doctor_name','tbl_medical_detail_level_two.me_note','tbl_medical_detail_level_two.surgery_or_procedure','tbl_medical_detail_level_two.sr_date','tbl_medical_detail_level_two.sr_physician','tbl_medical_detail_level_two.sr_hospital','tbl_medical_detail_level_two.sr_note','tbl_medical_detail_level_two.illness','tbl_medical_detail_level_two.illness_start','tbl_medical_detail_level_two.illness_end_date','tbl_medical_detail_level_two.illness_treatment_note')->join('tbl_child','tbl_child.id','=','tbl_medical_detail_level_two.child_id')->orderBy('id','DESC')->get();
return view('admin.medical_level_two.index',$data);
}
public function add_medical_level_two(){
$data['child_list']=Child::orderBy('id','DESC')->get();
return view('admin.medical_level_two.view',$data);
}
public function post_add_medical_level_two(Request $request){

$validator = Validator::make($request->all(), [
'child_id'=>'required|exists:tbl_child,id',
'medication_name'=>'max:100|min:2',
'me_reason_for_taking'=>'max:100|min:2',
'me_dose'=>'max:50|min:2',
'me_frequency'=>'max:50|min:2',
'me_start_date'=>'max:30|min:2',
'me_end_date'=>'max:30|min:2',
'me_doctor_name'=>'max:50|min:2',
'me_note'=>'max:50|min:2',
'surgery_or_procedure'=>'max:50|min:2',
'sr_date'=>'max:50|min:2',
'sr_physician'=>'max:100|min:2',
'sr_hospital'=>'max:100|min:2',
'sr_note'=>'max:50|min:2',
'illness'=>'max:50|min:2',
'illness_start'=>'max:30|min:2',
'illness_end_date'=>'max:30|min:2',
'illness_treatment_note'=>'max:30|min:2',

]);
if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}

$userprofile=new Medical_detail_level_two;

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
if($userprofile->save()){

return redirect()->route('medical-level-two');
}else{
}
}
public function update_medical_level_two($id){
$data['child_list']=Child::orderBy('id','DESC')->get();
$data['editId']=Medical_detail_level_two::find($id);
return view('admin.medical_level_two.edit',$data);
}
public function post_update_medical_level_two(Request $request){
$validator = Validator::make($request->all(), [
'child_id'=>'required|exists:tbl_child,id',
'medication_name'=>'max:100|min:2',
'me_reason_for_taking'=>'max:100|min:2',
'me_dose'=>'max:50|min:2',
'me_frequency'=>'max:50|min:2',
'me_start_date'=>'max:30|min:2',
'me_end_date'=>'max:30|min:2',
'me_doctor_name'=>'max:50|min:2',
'me_note'=>'max:50|min:2',
'surgery_or_procedure'=>'max:50|min:2',
'sr_date'=>'max:50|min:2',
'sr_physician'=>'max:100|min:2',
'sr_hospital'=>'max:100|min:2',
'sr_note'=>'max:50|min:2',
'illness'=>'max:50|min:2',
'illness_start'=>'max:30|min:2',
'illness_end_date'=>'max:30|min:2',
'illness_treatment_note'=>'max:30|min:2',
]);

if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}
$userprofile=Medical_detail_level_two::find($request->editId);

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
if($userprofile->update()){
\Session::put('success','Data Update Successfully.');
return redirect()->route('medical-level-two');
}else{
\Session::put('warning','Something went wrong.');
}
}
public function delete_medical_level_two($id){
if(Medical_detail_level_two::where('id',$id)->delete()){
return redirect()->route('medical-level-two');
\Session::put('success','Data Remove Successfully.');
}else{
return redirect()->route('medical-level-two');
\Session::put('warning','Something went wrong.');
}
}
public function medical_level_two_detail($id){
$data['order']=DB::table('tbl_medical_detail_level_two')->select('tbl_medical_detail_level_two.id','tbl_child.name','tbl_medical_detail_level_two.medication_name','tbl_medical_detail_level_two.me_reason_for_taking','tbl_medical_detail_level_two.me_dose','tbl_medical_detail_level_two.me_frequency','tbl_medical_detail_level_two.me_start_date','tbl_medical_detail_level_two.me_end_date','tbl_medical_detail_level_two.me_doctor_name','tbl_medical_detail_level_two.me_note','tbl_medical_detail_level_two.surgery_or_procedure','tbl_medical_detail_level_two.sr_date','tbl_medical_detail_level_two.sr_physician','tbl_medical_detail_level_two.sr_hospital','tbl_medical_detail_level_two.sr_note','tbl_medical_detail_level_two.illness','tbl_medical_detail_level_two.illness_start','tbl_medical_detail_level_two.illness_end_date','tbl_medical_detail_level_two.illness_treatment_note')->join('tbl_child','tbl_child.id','=','tbl_medical_detail_level_two.child_id')->where('tbl_medical_detail_level_two.id',$id)->first();
return view('admin.medical_level_two.detail',$data);
}
/*--------------end medical level two management -----------*/
/*-------------- child management -----------*/
public function index_care_provider(){

$data['allUser']=DB::table('tbl_child_care_provider_details as care_tbl')->select('care_tbl.id as id','tbl_child.name','care_tbl.child_care_provider_name','care_tbl.name_of_child_care_center','care_tbl.phone_no','care_tbl.notes','care_tbl.address')->join('tbl_child','care_tbl.child_id','=','tbl_child.id')->orderBy('care_tbl.id','DESC')->get();
return view('admin.careprovider.index',$data);
}
public function add_care_provider(){
$data['child_list']=Child::orderBy('id','DESC')->get();
return view('admin.careprovider.view',$data);
}
public function post_add_care_provider(Request $request){

$validator = Validator::make($request->all(), [
'child_id'=>'required|exists:tbl_child,id',
'child_care_provider_name'=>'min:2|max:50',
'name_of_child_care_center'=>'max:50|min:2',
'phone_no'=>'min:10|max:15',
'notes'=>'max:200|min:2',
'address'=>'required|min:2|max:50',
]);

if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}
$userprofile=new Child_care_provider_details;

$userprofile->child_id=$request->child_id;
$userprofile->child_care_provider_name=$request->child_care_provider_name;
$userprofile->name_of_child_care_center=$request->name_of_child_care_center;
$userprofile->phone_no=$request->phone_no;
$userprofile->notes=$request->notes;
$userprofile->address=$request->address;
if($userprofile->save()){
\Session::put('success','Data Update Successfully.');
return redirect()->route('care-provider');
}else{
\Session::put('warning','Something went wrong.');
}
}
public function update_care_provider($id){
$data['child_list']=Child::orderBy('id','DESC')->get();
$data['editData']=Child_care_provider_details::find($id);
return view('admin.careprovider.edit',$data);
}
public function post_update_care_provider(Request $request){
// return $request->input();
$validator = Validator::make($request->all(), [
'child_id'=>'required|exists:tbl_child,id',
'child_care_provider_name'=>'min:2|max:50',
'name_of_child_care_center'=>'max:50|min:2',
'phone_no'=>'min:10|max:15',
'notes'=>'max:200|min:2',
'address'=>'required|min:2|max:50',

]);

if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}
$userprofile=Child_care_provider_details::find($request->editId);

$userprofile->child_id=$request->child_id;
$userprofile->child_care_provider_name=$request->child_care_provider_name;
$userprofile->name_of_child_care_center=$request->name_of_child_care_center;
$userprofile->phone_no=$request->phone_no;
$userprofile->notes=$request->notes;
$userprofile->address=$request->address;

if($userprofile->update()){
\Session::put('success','Data Update Successfully.');
return redirect()->route('care-provider');
}else{
\Session::put('warning','Something went wrong.');
}
}
public function delete_care_provider($id){
if(Child_care_provider_details::where('id',$id)->delete()){
return redirect()->route('care-provider');
\Session::put('success','Data Remove Successfully.');
}else{
return redirect()->route('care-provider');
\Session::put('warning','Something went wrong.');
}
}

public function  detail_care_provider($id){
$data['order']=DB::table('tbl_child_care_provider_details as care_tbl')->select('care_tbl.id as id','tbl_child.name','care_tbl.child_care_provider_name','care_tbl.name_of_child_care_center','care_tbl.phone_no','care_tbl.notes','care_tbl.address')->join('tbl_child','care_tbl.child_id','=','tbl_child.id')->orderBy('care_tbl.id','DESC')->get();
return view('admin.careprovider.detail',$data);
}

/*--------------end care provider management -----------*/
/*-------------- school detail level one management -----------*/
public function index_school_detail_level_one(){

$data['allUser']=DB::table('tbl_child_school_details_level_one as sch_tbl')->select('sch_tbl.id as id','tbl_child.name','sch_tbl.school_name','sch_tbl.school_addreass','sch_tbl.office_phone','sch_tbl.start_time','sch_tbl.end_time','sch_tbl.principal_name')->join('tbl_child','sch_tbl.child_id','=','tbl_child.id')->orderBy('sch_tbl.id','DESC')->get();
return view('admin.school_detail_level_one.index',$data);
}
public function add_school_detail_level_one(){
$data['child_list']=Child::orderBy('id','DESC')->get();
return view('admin.school_detail_level_one.view',$data);
}
public function post_add_school_detail_level_one(Request $request){

$validator = Validator::make($request->all(), [

'child_id'=>'required|exists:tbl_child,id',
'school_name'=>'min:2|max:150',
'school_addreass'=>'max:150|min:2',
'office_phone'=>'min:10|max:15',
'start_time'=>'max:10|min:2',
'end_time'=>'max:10|min:2',
'website'=>'min:2|max:450',
'principal_name'=>'max:150|min:2',
'tr_bus_no'=>'min:1|max:50',
'tr_bus_stop_location'=>'max:200|min:2',
'tr_bus_pickup_time'=>'min:2|max:10',
'tr_bus_drop_time'=>'min:2|max:10',
'tr_special_trans_arrangement'=>'max:150|min:2',
'tr_transportation_phone_no'=>'min:10|max:15',
'stu_grade'=>'max:100|min:1',
'stu_id_no'=>'min:1|max:50',
'stu_lunch_pin'=>'max:150|min:1',

]);

if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}
$userprofile=new Child_school_details_level_one;

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
if($userprofile->save()){
\Session::put('success','Data Update Successfully.');
return redirect()->route('school-detail-level-one');
}else{
\Session::put('warning','Something went wrong.');
}
}
public function update_school_detail_level_one($id){
$data['child_list']=Child::orderBy('id','DESC')->get();
$data['editData']=Child_school_details_level_one::find($id);
return view('admin.school_detail_level_one.edit',$data);
}
public function post_update_school_detail_level_one(Request $request){
// return $request->input();
$validator = Validator::make($request->all(), [

'child_id'=>'required|exists:tbl_child,id',
'school_name'=>'min:2|max:150',
'school_addreass'=>'max:150|min:2',
'office_phone'=>'min:10|max:15',
'start_time'=>'max:10|min:2',
'end_time'=>'max:10|min:2',
'website'=>'min:2|max:450',
'principal_name'=>'max:150|min:2',
'tr_bus_no'=>'min:1|max:50',
'tr_bus_stop_location'=>'max:200|min:2',
'tr_bus_pickup_time'=>'min:2|max:10',
'tr_bus_drop_time'=>'min:2|max:10',
'tr_special_trans_arrangement'=>'max:150|min:2',
'tr_transportation_phone_no'=>'min:10|max:15',
'stu_grade'=>'max:100|min:2',
'stu_id_no'=>'min:1|max:50',
'stu_lunch_pin'=>'max:150|min:1',

]);

if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}
$userprofile=Child_school_details_level_one::find($request->editId);

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

if($userprofile->update()){
\Session::put('success','Data Update Successfully.');

}else{
\Session::put('warning','Something went wrong.');
}
return redirect()->route('school-detail-level-one');
}
public function delete_school_detail_level_one($id){
if(Child_school_details_level_one::where('id',$id)->delete()){
\Session::put('success','Data Remove Successfully.');
}else{
\Session::put('warning','Something went wrong.');
}
return redirect()->route('school-detail-level-one');
}
 
public function detail_school_detail_level_one($id){
$data['order']=DB::table('tbl_child_school_details_level_one as sch_tbl')->select('sch_tbl.id as id','tbl_child.name','sch_tbl.school_name','sch_tbl.school_addreass','sch_tbl.office_phone','sch_tbl.start_time','sch_tbl.end_time','sch_tbl.principal_name','sch_tbl.tr_bus_no','sch_tbl.tr_bus_stop_location','sch_tbl.tr_bus_pickup_time','sch_tbl.tr_bus_drop_time','sch_tbl.tr_special_trans_arrangement','sch_tbl.tr_transportation_phone_no','sch_tbl.stu_grade','sch_tbl.stu_id_no','sch_tbl.stu_lunch_pin','sch_tbl.website')->join('tbl_child','sch_tbl.child_id','=','tbl_child.id')->orderBy('sch_tbl.id','DESC')->get();
return view('admin.school_detail_level_one.detail',$data);
}
/*--------------end care provider management -----------*/
/*-------------- school detail level two management -----------*/
public function index_school_detail_level_two(){

$data['allUser']=DB::table('tbl_child_school_details_lever_two as sch_tbl')->select('sch_tbl.id as id','tbl_child.name','sch_tbl.tr_name','sch_tbl.classroom_no','sch_tbl.tutors_name','sch_tbl.details_about_sub_day_time','sch_tbl.ind_edu_plan_child_dev_challange','sch_tbl.ind_edu_plan_date_last_meeting')->join('tbl_child','sch_tbl.child_id','=','tbl_child.id')->orderBy('sch_tbl.id','DESC')->get();
return view('admin.school_detail_level_two.index',$data);
}
public function add_school_detail_level_two(){
$data['child_list']=Child::orderBy('id','DESC')->get();
return view('admin.school_detail_level_two.view',$data);
}
public function post_add_school_detail_level_two(Request $request){

$validator = Validator::make($request->all(), [

'child_id'=>'required|exists:tbl_child,id',
'tr_name'=>'min:2|max:150',
'classroom_no'=>'max:150|min:2',
'tutors_name'=>'min:2|max:150',
'details_about_sub_day_time'=>'max:150|min:2',
'ind_edu_plan_child_dev_challange'=>'max:150|min:2',
'ind_edu_plan_date_last_meeting'=>'min:2|max:150',
'ind_edu_plan_special_service'=>'max:150|min:2',
'ind_edu_plan_child_receive_ssi'=>'min:2|max:150',
'ind_edu_plan_ssi_amount'=>'max:150|min:2',
'ind_edu_plan_add_information'=>'min:2|max:150',
]);

if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}
$userprofile=new Child_school_details_lever_two;
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
if($userprofile->save()){
\Session::put('success','Data Update Successfully.');

}else{
\Session::put('warning','Something went wrong.');
}
return redirect()->route('school-detail-level-two');
}
public function update_school_detail_level_two($id){
$data['child_list']=Child::orderBy('id','DESC')->get();
$data['editData']=Child_school_details_lever_two::find($id);
return view('admin.school_detail_level_two.edit',$data);
}
public function post_update_school_detail_level_two(Request $request){
// return $request->input();
$validator = Validator::make($request->all(), [

'child_id'=>'required|exists:tbl_child,id',
'tr_name'=>'min:2|max:150',
'classroom_no'=>'max:150|min:2',
'tutors_name'=>'min:2|max:150',
'details_about_sub_day_time'=>'max:150|min:2',
'ind_edu_plan_child_dev_challange'=>'max:150|min:2',
'ind_edu_plan_date_last_meeting'=>'min:2|max:150',
'ind_edu_plan_special_service'=>'max:150|min:2',
'ind_edu_plan_child_receive_ssi'=>'min:2|max:150',
'ind_edu_plan_ssi_amount'=>'max:150|min:2',
'ind_edu_plan_add_information'=>'min:2|max:150',

]);

if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}
$userprofile=Child_school_details_lever_two::find($request->editId);

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

if($userprofile->update()){
\Session::put('success','Data Update Successfully.');

}else{
\Session::put('warning','Something went wrong.');
}
return redirect()->route('school-detail-level-two');
}
public function delete_school_detail_level_two($id){
if(Child_school_details_lever_two::where('id',$id)->delete()){
\Session::put('success','Data Remove Successfully.');
}else{
\Session::put('warning','Something went wrong.');
}
return redirect()->route('school-detail-level-two');
}

public function detail_school_detail_level_two($id){
$data['order']=DB::table('tbl_child_school_details_lever_two as sch_tbl')->select('sch_tbl.id as id','tbl_child.name','sch_tbl.tr_name','sch_tbl.classroom_no','sch_tbl.tutors_name','sch_tbl.details_about_sub_day_time','sch_tbl.ind_edu_plan_child_dev_challange','sch_tbl.ind_edu_plan_date_last_meeting','sch_tbl.ind_edu_plan_special_service','sch_tbl.ind_edu_plan_child_receive_ssi','sch_tbl.ind_edu_plan_ssi_amount','sch_tbl.ind_edu_plan_add_information')->join('tbl_child','sch_tbl.child_id','=','tbl_child.id')->orderBy('sch_tbl.id','DESC')->get();
return view('admin.school_detail_level_two.detail',$data);
}
/*--------------end school detail level 2 management -----------*/
/*-------------- school detail level two management -----------*/
public function index_extra_curricular(){

$data['allUser']=DB::table('tbl_extra_curriculam_activity as sch_tbl')->select('sch_tbl.id as id','tbl_child.name','sch_tbl.activity','sch_tbl.days','sch_tbl.start_time','sch_tbl.end_time','sch_tbl.location','sch_tbl.take_coach_or_leader')->join('tbl_child','sch_tbl.child_id','=','tbl_child.id')->orderBy('sch_tbl.id','DESC')->get();
return view('admin.extra_curriculam.index',$data);
}

public function add_extra_curricular(){
$data['child_list']=Child::orderBy('id','DESC')->get();
return view('admin.extra_curriculam.view',$data);
}
public function post_add_extra_curricular(Request $request){

$validator = Validator::make($request->all(), [

'child_id'=>'required|exists:tbl_child,id',
'activity'=>'max:150|min:2',
'days'=>'max:100|min:2',
'start_time'=>'max:100|min:2',
'end_time'=>'max:150|min:2',

'location'=>'max:150|min:2',
'take_coach_or_leader'=>'max:150|min:2',
'contact_person_name'=>'max:150|min:2',
'phone' => 'min:10|max:15',
'email'=>'email|max:60|min:3',
'other_information'=>'max:150|min:2',
]);

if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}
$userprofile=new Extra_curriculam_activity;

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
if($userprofile->save()){
\Session::put('success','Data Update Successfully.');

}else{
\Session::put('warning','Something went wrong.');
}
return redirect()->route('extra-curricular');
}
public function update_extra_curricular($id){
$data['child_list']=Child::orderBy('id','DESC')->get();
$data['editData']=Extra_curriculam_activity::find($id);
return view('admin.extra_curriculam.edit',$data);
}
public function post_update_extra_curricular(Request $request){
// return $request->input();
$validator = Validator::make($request->all(), [

'child_id'=>'required|exists:tbl_child,id',
'activity'=>'max:150|min:2',
'days'=>'max:100|min:2',
'start_time'=>'max:100|min:2',
'end_time'=>'max:150|min:2',

'location'=>'max:150|min:2',
'take_coach_or_leader'=>'max:150|min:2',
'contact_person_name'=>'max:150|min:2',
'phone' => 'min:10|max:15',
'email'=>'email|max:60|min:3',
'other_information'=>'max:150|min:2',

]);

if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}
$userprofile=Extra_curriculam_activity::find($request->editId);

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

if($userprofile->update()){
\Session::put('success','Data Update Successfully.');

}else{
\Session::put('warning','Something went wrong.');
}
return redirect()->route('extra-curricular');
}


public function delete_extra_curricular($id){
if(Extra_curriculam_activity::where('id',$id)->delete()){
\Session::put('success','Data Remove Successfully.');
}else{
\Session::put('warning','Something went wrong.');
}
return redirect()->route('extra-curricular');
}

public function detail_extra_curricular(){
$data['order']=DB::table('tbl_extra_curriculam_activity as sch_tbl')->select('sch_tbl.id as id','tbl_child.name','sch_tbl.activity','sch_tbl.days','sch_tbl.start_time','sch_tbl.end_time','sch_tbl.location','sch_tbl.take_coach_or_leader','sch_tbl.phone','sch_tbl.email','sch_tbl.other_information','sch_tbl.contact_person_name')->join('tbl_child','sch_tbl.child_id','=','tbl_child.id')->orderBy('sch_tbl.id','DESC')->get();
return view('admin.extra_curriculam.detail',$data);
}
/*--------------end school detail level 2 management -----------*/
/*-------------- school detail level two management -----------*/
public function index_about_details(){

$data['allUser']=DB::table('tbl_child_about_details as sch_tbl')->select('sch_tbl.id as id','tbl_child.name','sch_tbl.likes_to_be_called','sch_tbl.personality','sch_tbl.likes','sch_tbl.dislikes','sch_tbl.favorite_food','sch_tbl.good_at')->join('tbl_child','sch_tbl.child_id','=','tbl_child.id')->orderBy('sch_tbl.id','DESC')->get();
return view('admin.about_detail.index',$data);
}
public function add_about_details(){
$data['child_list']=Child::orderBy('id','DESC')->get();
return view('admin.about_detail.view',$data);
}
public function post_add_about_details(Request $request){

$validator = Validator::make($request->all(), [

'child_id'=>'required|exists:tbl_child,id',
'likes_to_be_called'=>'max:150|min:2',
'personality'=>'max:150|min:2',
'likes'=>'max:150|min:2',
'dislikes'=>'max:150|min:2',
'favorite_food'=>'max:150|min:2',
'good_at'=>'max:150|min:2',
'learns_best_by'=>'max:150|min:2',
'bedtime_routine' => 'max:150|min:2',
'frightened_by'=>'max:150|min:2',
]);

if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}
$userprofile=new Child_about_details;

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
if($userprofile->save()){
\Session::put('success','Data Update Successfully.');

}else{
\Session::put('warning','Something went wrong.');
}
return redirect()->route('about-details');
}
public function update_about_details($id){
$data['child_list']=Child::orderBy('id','DESC')->get();
$data['editData']=Child_about_details::find($id);
return view('admin.about_detail.edit',$data);
}
public function post_update_about_details(Request $request){
// return $request->input();
$validator = Validator::make($request->all(), [

'child_id'=>'required|exists:tbl_child,id',
'likes_to_be_called'=>'max:150|min:2',
'personality'=>'max:150|min:2',
'likes'=>'max:150|min:2',
'dislikes'=>'max:150|min:2',
'favorite_food'=>'max:150|min:2',
'good_at'=>'max:150|min:2',
'learns_best_by'=>'max:150|min:2',
'bedtime_routine' => 'max:150|min:2',
'frightened_by'=>'max:150|min:2',

]);

if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}
$userprofile=Child_about_details::find($request->editId);

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

if($userprofile->update()){
\Session::put('success','Data Update Successfully.');

}else{
\Session::put('warning','Something went wrong.');
}
return redirect()->route('about-details');
}
public function delete_about_details($id){
if(Child_about_details::where('id',$id)->delete()){
\Session::put('success','Data Remove Successfully.');
}else{
\Session::put('warning','Something went wrong.');
}
return redirect()->route('about-details');
}


public function detail_about_details($id){
$data['order']=DB::table('tbl_child_about_details as sch_tbl')->select('sch_tbl.id as id','tbl_child.name','sch_tbl.likes_to_be_called','sch_tbl.personality','sch_tbl.likes','sch_tbl.dislikes','sch_tbl.favorite_food','sch_tbl.good_at','sch_tbl.learns_best_by','sch_tbl.bedtime_routine','sch_tbl.frightened_by')->join('tbl_child','sch_tbl.child_id','=','tbl_child.id')->orderBy('sch_tbl.id','DESC')->get();
return view('admin.about_detail.detail',$data);
}
/*--------------end school detail level 2 management -----------*/

/*-------------- school detail level two management -----------*/
public function index_insurance_details(){

$data['allUser']=DB::table('tbl_child_insurance_detail as sch_tbl')->select('sch_tbl.id as id','tbl_child.name','sch_tbl.type_of_insurance','sch_tbl.insurance_cmp_name','sch_tbl.plan_type','sch_tbl.subscribe','sch_tbl.member_no','sch_tbl.group_no')->join('tbl_child','sch_tbl.child_id','=','tbl_child.id')->orderBy('sch_tbl.id','DESC')->get();
return view('admin.insurance_detail.index',$data);
}
public function add_insurance_details(){
$data['child_list']=Child::orderBy('id','DESC')->get();
return view('admin.insurance_detail.view',$data);
}
public function post_add_insurance_details(Request $request){

$validator = Validator::make($request->all(), [

'child_id'=>'required|exists:tbl_child,id',
'type_of_insurance'=>'max:150|min:2',
'insurance_cmp_name'=>'max:150|min:2',
'plan_type'=>'max:150|min:2',
'subscribe'=>'max:150|min:2',
'dislikes'=>'max:150|min:2',
'group_no'=>'max:150|min:2',
'agent'=>'max:150|min:2',
'phone_no' => 'required|min:10|max:15',
'website' => 'max:150|min:2',
'co_pay_deductible'=>'max:150|min:2',
'notes'=>'max:350|min:2',
]);

if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}
$userprofile=new Child_insurance_detail;

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
if($userprofile->save()){
\Session::put('success','Data Update Successfully.');

}else{
\Session::put('warning','Something went wrong.');
}
return redirect()->route('insurance-details');
}
public function update_insurance_details($id){
$data['child_list']=Child::orderBy('id','DESC')->get();
$data['editData']=Child_insurance_detail::find($id);
return view('admin.insurance_detail.edit',$data);
}
public function post_update_insurance_details(Request $request){
// return $request->input();
$validator = Validator::make($request->all(), [

'child_id'=>'required|exists:tbl_child,id',
'type_of_insurance'=>'max:150|min:2',
'insurance_cmp_name'=>'max:150|min:2',
'plan_type'=>'max:150|min:2',
'subscribe'=>'max:150|min:2',
'dislikes'=>'max:150|min:2',
'group_no'=>'max:150|min:2',
'agent'=>'max:150|min:2',
'phone_no' => 'required|min:10|max:15',
'website' => 'max:150|min:2',
'co_pay_deductible'=>'max:150|min:2',
'notes'=>'max:350|min:2',

]);

if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}
$userprofile=Child_insurance_detail::find($request->editId);

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

if($userprofile->update()){
\Session::put('success','Data Update Successfully.');

}else{
\Session::put('warning','Something went wrong.');
}
return redirect()->route('insurance-details');
}
public function delete_insurance_details($id){
if(Child_insurance_detail::where('id',$id)->delete()){
\Session::put('success','Data Remove Successfully.');
}else{
\Session::put('warning','Something went wrong.');
}
return redirect()->route('insurance-details');
}

public function detail_insurance_details($id){
$data['order']=DB::table('tbl_child_insurance_detail as sch_tbl')->select('sch_tbl.id as id','tbl_child.name','sch_tbl.type_of_insurance','sch_tbl.insurance_cmp_name','sch_tbl.plan_type','sch_tbl.subscribe','sch_tbl.member_no','sch_tbl.group_no','sch_tbl.agent','sch_tbl.phone_no','sch_tbl.website','sch_tbl.co_pay_deductible','sch_tbl.notes')->join('tbl_child','sch_tbl.child_id','=','tbl_child.id')->where('sch_tbl.id',$id)->get();
return view('admin.insurance_detail.detail',$data);
}
/*--------------end school detail level 2 management -----------*/
/*-------------- school detail level two management -----------*/
public function index_support_details(){

$data['allUser']=DB::table('tbl_child_support_details as sch_tbl')->select('sch_tbl.id as id','tbl_child.name','sch_tbl.person','sch_tbl.relation_to_child','sch_tbl.address','sch_tbl.phone_no','sch_tbl.email','sch_tbl.notes')->join('tbl_child','sch_tbl.child_id','=','tbl_child.id')->orderBy('sch_tbl.id','DESC')->get();
return view('admin.support_detail.index',$data);
}
public function add_support_details(){
$data['child_list']=Child::orderBy('id','DESC')->get();
return view('admin.support_detail.view',$data);
}
public function post_add_support_details(Request $request){
$validator = Validator::make($request->all(), [

'child_id'=>'required|exists:tbl_child,id',
'person'=>'required|max:150|min:2',
'relation_to_child'=>'max:150|min:2',
'address'=>'max:150|min:2',

'email'=>'required|max:150|min:2|email',
'notes'=>'max:350|min:2',
'phone_no' => 'required|min:10|max:15',
]);

if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}
$userprofile=new Child_support_details;

$userprofile->child_id=$request->child_id;
$userprofile->person=$request->person;
$userprofile->relation_to_child=$request->relation_to_child;
$userprofile->address=$request->address;
$userprofile->email=$request->email;
$userprofile->notes=$request->notes;
$userprofile->phone_no=$request->phone_no;
if($userprofile->save()){
\Session::put('success','Data Update Successfully.');

}else{
\Session::put('warning','Something went wrong.');
}
return redirect()->route('support-details');
}
public function update_support_details($id){
$data['child_list']=Child::orderBy('id','DESC')->get();
$data['editData']=Child_support_details::find($id);
return view('admin.support_detail.edit',$data);
}
public function post_update_support_details(Request $request){
// return $request->input();
$validator = Validator::make($request->all(), [

'child_id'=>'required|exists:tbl_child,id',
'person'=>'required|max:150|min:2',
'relation_to_child'=>'max:150|min:2',
'address'=>'max:150|min:2',
'email'=>'required|max:150|min:2|email',
'notes'=>'max:350|min:2',
'phone_no' => 'required|min:10|max:15',

]);

if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}
$userprofile=Child_support_details::find($request->editId);

$userprofile->child_id=$request->child_id;
$userprofile->person=$request->person;
$userprofile->relation_to_child=$request->relation_to_child;
$userprofile->address=$request->address;
$userprofile->email=$request->email;
$userprofile->notes=$request->notes;
$userprofile->phone_no=$request->phone_no;

if($userprofile->update()){
\Session::put('success','Data Update Successfully.');

}else{
\Session::put('warning','Something went wrong.');
}
return redirect()->route('support-details');
}
public function delete_support_details($id){
if(Child_support_details::where('id',$id)->delete()){
\Session::put('success','Data Remove Successfully.');
}else{
\Session::put('warning','Something went wrong.');
}
return redirect()->route('support-details');
}

public function detail_support_details($id){
$data['order']=DB::table('tbl_child_support_details as sch_tbl')->select('sch_tbl.id as id','tbl_child.name','sch_tbl.person','sch_tbl.relation_to_child','sch_tbl.address','sch_tbl.phone_no','sch_tbl.email','sch_tbl.notes')->join('tbl_child','sch_tbl.child_id','=','tbl_child.id')->orderBy('sch_tbl.id','DESC')->get();
return view('admin.support_detail.detail',$data);
}
/*--------------end school detail level 2 management -----------*/
/*-------------- school detail level two management -----------*/
public function index_document_details(){

$data['allUser']=DB::table('tbl_child_document_details as sch_tbl')->select('sch_tbl.id as id','tbl_child.name','sch_tbl.employee_name','sch_tbl.address','sch_tbl.phone_no','sch_tbl.supervisor_name','sch_tbl.birth_certificate_loc','sch_tbl.social_security_card_loc','sch_tbl.passport_loc','sch_tbl.naturalization_papers_loc','sch_tbl.will_and_ancillary_doc','sch_tbl.power_of_attorney_loc','sch_tbl.guardian','sch_tbl.life_insurance_policy_loc','sch_tbl.children_life_insu_policies_loc','sch_tbl.other_loc')->join('tbl_child','sch_tbl.child_id','=','tbl_child.id')->orderBy('sch_tbl.id','DESC')->get();

return view('admin.document_details.index',$data);
}
public function add_document_details(){
$data['child_list']=Child::orderBy('id','DESC')->get();
return view('admin.document_details.view',$data);
}
public function post_add_document_details(Request $request){
// return $request->birth_certificate_loc;
//return $request->input();
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
return redirect()->back()
->withErrors($validator)
->withInput();
}
$userprofile=new Document_details;

$userprofile->child_id=$request->child_id;
$userprofile->employee_name=$request->employee_name;
$userprofile->address=$request->address;
$userprofile->phone_no=$request->phone_no;
$userprofile->supervisor_name=$request->supervisor_name;
if($request->file('birth_certificate_loc')){
$brimage = time().'.'.$request->birth_certificate_loc->extension();
$request->birth_certificate_loc->move(public_path('uploads/bitrhCr'),$brimage);
$userprofile->birth_certificate_loc=url('public/uploads/bitrhCr').'/'.$brimage;
}
if($request->file('social_security_card_loc')){
$SSCimage = time().'.'.$request->social_security_card_loc->extension();
$request->social_security_card_loc->move(public_path('uploads/SSCimage'),$SSCimage);
$userprofile->social_security_card_loc=url('public/uploads/SSCimage').'/'.$SSCimage;
}

if($request->file('passport_loc')){
$PassPortimage = time().'.'.$request->passport_loc->extension();
$request->passport_loc->move(public_path('uploads/PassPortimage'),$PassPortimage);
$userprofile->passport_loc=url('public/uploads/PassPortimage').'/'.$PassPortimage;
}
if($request->file('naturalization_papers_loc')){
$naturalizationPapersImg = time().'.'.$request->naturalization_papers_loc->extension();
$request->naturalization_papers_loc->move(public_path('uploads/naturalizationPapersImg'),$naturalizationPapersImg);
$userprofile->naturalization_papers_loc=url('public/uploads/naturalizationPapersImg').'/'.$naturalizationPapersImg;
}
if($request->file('will_and_ancillary_doc')){
$willImg = time().'.'.$request->will_and_ancillary_doc->extension();
$request->will_and_ancillary_doc->move(public_path('uploads/willImg'),$willImg);
$userprofile->will_and_ancillary_doc=url('public/uploads/willImg').'/'.$willImg;
}
if($request->file('power_of_attorney_loc')){
$powerAtt = time().'.'.$request->power_of_attorney_loc->extension();
$request->power_of_attorney_loc->move(public_path('uploads/powerAtt'),$powerAtt);
$userprofile->power_of_attorney_loc=url('public/uploads/powerAtt').'/'.$powerAtt;
}
if($request->file('guardian')){
$guardian = time().'.'.$request->guardian->extension();
$request->guardian->move(public_path('uploads/guardian'),$guardian);
$userprofile->guardian=url('public/uploads/guardian').'/'.$guardian;
}
if($request->file('life_insurance_policy_loc')){
$lifeInsu = time().'.'.$request->life_insurance_policy_loc->extension();
$request->life_insurance_policy_loc->move(public_path('uploads/lifeInsu'),$lifeInsu);
$userprofile->life_insurance_policy_loc=url('public/uploads/lifeInsu').'/'.$lifeInsu;
}
if($request->file('children_life_insu_policies_loc')){
$childlifeInsu = time().'.'.$request->children_life_insu_policies_loc->extension();
$request->children_life_insu_policies_loc->move(public_path('uploads/childlifeInsu'),$childlifeInsu);
$userprofile->children_life_insu_policies_loc=url('public/uploads/childlifeInsu').'/'.$childlifeInsu;
}
if($request->file('other_loc')){
$otherDoc = time().'.'.$request->other_loc->extension();
$request->other_loc->move(public_path('uploads/otherDoc'),$otherDoc);
$userprofile->other_loc=url('public/uploads/otherDoc').'/'.$otherDoc;
}
if($userprofile->save()){
\Session::put('success','Data Update Successfully.');

}else{
\Session::put('warning','Something went wrong.');
}
return redirect()->route('document-details');
}
public function update_document_details($id){
$data['child_list']=Child::orderBy('id','DESC')->get();
$data['editData']=Document_details::find($id);
return view('admin.document_details.edit',$data);
}
public function post_update_document_details(Request $request){
// return $request->input();
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
return redirect()->back()
->withErrors($validator)
->withInput();
}
$userprofile=Document_details::find($request->editId);
$userprofile->child_id=$request->child_id;
$userprofile->employee_name=$request->employee_name;
$userprofile->address=$request->address;
$userprofile->phone_no=$request->phone_no;
$userprofile->supervisor_name=$request->supervisor_name;
if($request->file('birth_certificate_loc')){
if($request->OLDbirth_certificate_loc){
$userprofile->birth_certificate_loc=$request->OLDbirth_certificate_loc;
}else{
$brimage = time().'.'.$request->birth_certificate_loc->extension();
$request->birth_certificate_loc->move(public_path('uploads/bitrhCr'),$brimage);
$userprofile->birth_certificate_loc=url('public/uploads/bitrhCr').'/'.$brimage;
}
}
if($request->file('social_security_card_loc')){

if($request->OLDsocial_security_card_loc){
$userprofile->social_security_card_loc=$request->OLDsocial_security_card_loc;
}else{
$SSCimage = time().'.'.$request->social_security_card_loc->extension();
$request->social_security_card_loc->move(public_path('uploads/SSCimage'),$SSCimage);
$userprofile->social_security_card_loc=url('public/uploads/SSCimage').'/'.$SSCimage;
}
}

if($request->file('passport_loc')){
if($request->OLDpassport_loc){
$userprofile->passport_loc=$request->OLDpassport_loc;
}else{
$PassPortimage = time().'.'.$request->passport_loc->extension();
$request->passport_loc->move(public_path('uploads/PassPortimage'),$PassPortimage);
$userprofile->passport_loc=url('public/uploads/PassPortimage').'/'.$PassPortimage;
}

}
if($request->file('naturalization_papers_loc')){
if($request->OLDnaturalization_papers_loc){
$userprofile->naturalization_papers_loc=$request->OLDnaturalization_papers_loc;
}else{
$naturalizationPapersImg = time().'.'.$request->naturalization_papers_loc->extension();
$request->naturalization_papers_loc->move(public_path('uploads/naturalizationPapersImg'),$naturalizationPapersImg);
$userprofile->naturalization_papers_loc=url('public/uploads/naturalizationPapersImg').'/'.$naturalizationPapersImg;
}
}
if($request->file('will_and_ancillary_doc')){
if($request->OLDwill_and_ancillary_doc){
$userprofile->will_and_ancillary_doc=$request->OLDwill_and_ancillary_doc;
}else{
$willImg = time().'.'.$request->will_and_ancillary_doc->extension();
$request->will_and_ancillary_doc->move(public_path('uploads/willImg'),$willImg);
$userprofile->will_and_ancillary_doc=url('public/uploads/willImg').'/'.$willImg;
}

}
if($request->file('power_of_attorney_loc')){
if($request->OLDpower_of_attorney_loc){
$userprofile->power_of_attorney_loc=$request->OLDpower_of_attorney_loc;
}else{
$powerAtt = time().'.'.$request->power_of_attorney_loc->extension();
$request->power_of_attorney_loc->move(public_path('uploads/powerAtt'),$powerAtt);
$userprofile->power_of_attorney_loc=url('public/uploads/powerAtt').'/'.$powerAtt;
}
}
if($request->file('guardian')){
if($request->OLDguardian){
$userprofile->guardian=$request->OLDguardian;
}else{
$guardian = time().'.'.$request->guardian->extension();
$request->guardian->move(public_path('uploads/guardian'),$guardian);
$userprofile->guardian=url('public/uploads/guardian').'/'.$guardian;
}
}
if($request->file('life_insurance_policy_loc')){
if($request->OLDlife_insurance_policy_loc){
$userprofile->life_insurance_policy_loc=$request->OLDlife_insurance_policy_loc;
}else{
$lifeInsu = time().'.'.$request->life_insurance_policy_loc->extension();
$request->life_insurance_policy_loc->move(public_path('uploads/lifeInsu'),$lifeInsu);
$userprofile->life_insurance_policy_loc=url('public/uploads/lifeInsu').'/'.$lifeInsu;
}
}
if($request->file('children_life_insu_policies_loc')){
if($request->OLDchildren_life_insu_policies_loc){
$userprofile->children_life_insu_policies_loc=$request->OLDchildren_life_insu_policies_loc;
}else{
$childlifeInsu = time().'.'.$request->children_life_insu_policies_loc->extension();
$request->children_life_insu_policies_loc->move(public_path('uploads/childlifeInsu'),$childlifeInsu);
$userprofile->children_life_insu_policies_loc=url('public/uploads/childlifeInsu').'/'.$childlifeInsu;
}
}
if($request->file('other_loc')){
if($request->OLDother_loc){
$userprofile->other_loc=$request->OLDother_loc;
}else{
$otherDoc = time().'.'.$request->other_loc->extension();
$request->other_loc->move(public_path('uploads/otherDoc'),$otherDoc);
$userprofile->other_loc=url('public/uploads/otherDoc').'/'.$otherDoc;
}
}

if($userprofile->update()){
\Session::put('success','Data Update Successfully.');

}else{
\Session::put('warning','Something went wrong.');
}
return redirect()->route('document-details');
}
public function delete_document_details($id){
if(Document_details::where('id',$id)->delete()){
\Session::put('success','Data Remove Successfully.');
}else{
\Session::put('warning','Something went wrong.');
}
return redirect()->route('document-details');
}

public function detail_document_details($id){
$data['order']=DB::table('tbl_child_document_details as sch_tbl')->select('sch_tbl.id as id','tbl_child.name','sch_tbl.employee_name','sch_tbl.address','sch_tbl.phone_no','sch_tbl.supervisor_name','sch_tbl.birth_certificate_loc','sch_tbl.social_security_card_loc','sch_tbl.passport_loc','sch_tbl.naturalization_papers_loc','sch_tbl.will_and_ancillary_doc','sch_tbl.power_of_attorney_loc','sch_tbl.guardian','sch_tbl.life_insurance_policy_loc','sch_tbl.children_life_insu_policies_loc','sch_tbl.other_loc')->join('tbl_child','sch_tbl.child_id','=','tbl_child.id')->where('sch_tbl.id',$id)->get();

return view('admin.document_details.detail',$data);
}
/*--------------end school detail level 2 management -----------*/



/*-------------- legal detail level two management -----------*/
public function index_legal_details(){

$data['allUser']=DB::table('tbl_child_legal_details as sch_tbl')->select('sch_tbl.id as id','tbl_child.name','sch_tbl.poa_representative_name','sch_tbl.for_which_child','sch_tbl.attach_poa_file','sch_tbl.standby_guardian_name','sch_tbl.standby_alternet_guardian_name','sch_tbl.standby_for_which_child')->join('tbl_child','sch_tbl.child_id','=','tbl_child.id')->orderBy('sch_tbl.id','DESC')->get();
return view('admin.legal_detail.index',$data);
}

public function add_legal_details(){
$data['child_list']=Child::orderBy('id','DESC')->get();
return view('admin.legal_detail.view',$data);
}

public function post_add_legal_details(Request $request){

$validator = Validator::make($request->all(), [

'child_id'=>'required|exists:tbl_child,id',
// 'likes_to_be_called'=>'max:150|min:2',
// 'personality'=>'max:150|min:2',
// 'likes'=>'max:150|min:2',
// 'dislikes'=>'max:150|min:2',
// 'favorite_food'=>'max:150|min:2',
// 'good_at'=>'max:150|min:2',
// 'learns_best_by'=>'max:150|min:2',
// 'bedtime_routine' => 'max:150|min:2',
// 'frightened_by'=>'max:150|min:2',
]);

if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}
$userprofile=new Legal_details;

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

if($userprofile->save()){
\Session::put('success','Data Update Successfully.');

}else{
\Session::put('warning','Something went wrong.');
}
return redirect()->route('legal-details');
}
public function update_legal_details($id){
$data['child_list']=Child::orderBy('id','DESC')->get();
$data['editData']=Legal_details::find($id);
return view('admin.legal_detail.edit',$data);
}
public function post_update_legal_details(Request $request){
// return $request->input();
$validator = Validator::make($request->all(), [

'child_id'=>'required|exists:tbl_child,id',
// 'likes_to_be_called'=>'max:150|min:2',
// 'personality'=>'max:150|min:2',
// 'likes'=>'max:150|min:2',
// 'dislikes'=>'max:150|min:2',
// 'favorite_food'=>'max:150|min:2',
// 'good_at'=>'max:150|min:2',
// 'learns_best_by'=>'max:150|min:2',
// 'bedtime_routine' => 'max:150|min:2',
// 'frightened_by'=>'max:150|min:2',

]);

if($validator->fails()){
return redirect()->back()
->withErrors($validator)
->withInput();
}
            $userprofile=Legal_details::find($request->editId);

            $userprofile->child_id=$request->child_id;

            $userprofile->poa_representative_name=$request->poa_representative_name;
            
            $userprofile->for_which_child=$request->for_which_child;
            

           if($request->attach_poa_file){

            $arfileimage = time().'.'.$request->attach_poa_file->extension();
            $request->attach_poa_file->move(public_path('uploads/arfileimage'),$arfileimage);
            $userprofile->attach_poa_file=url('public/uploads/arfileimage').'/'.$arfileimage; 

            }else{

           $userprofile->attach_poa_file=$request->OLDattach_poa_file;
            
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
            }else{
            $userprofile->standby_attach_gua_file=$request->standby_attach_gua_file;
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

if($userprofile->update()){
\Session::put('success','Data Update Successfully.');

}else{
\Session::put('warning','Something went wrong.');
}
return redirect()->route('legal-details');
}
public function delete_legal_details($id){
if(Legal_details::where('id',$id)->delete()){
\Session::put('success','Data Remove Successfully.');
}else{
\Session::put('warning','Something went wrong.');
}
return redirect()->route('legal-details');
}

public function detail_legal_details($id){
$data['order']=DB::table('tbl_child_legal_details as sch_tbl')->select('sch_tbl.id as id','tbl_child.name','sch_tbl.poa_representative_name','sch_tbl.for_which_child','sch_tbl.attach_poa_file','sch_tbl.standby_guardian_name','sch_tbl.standby_alternet_guardian_name','sch_tbl.standby_for_which_child','sch_tbl.standby_attach_gua_file','sch_tbl.standby_has_paternity_been_established','sch_tbl.is_there_currently_a_custody_order_in_place','sch_tbl.what_are_the_current_custody_arrangements','sch_tbl.is_there_a_current_active_custody_case','sch_tbl.case_or_docket_number','sch_tbl.notes')->join('tbl_child','sch_tbl.child_id','=','tbl_child.id')->where('sch_tbl.id',$id)->get();
return view('admin.legal_detail.detail',$data);
}

/*--------------end school detail level 2 management -----------*/



public function logout()
{
Auth::logout();
Session::flush();
return redirect(url('admin-login'));
}
}