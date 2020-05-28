<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Usermeta;
use App\Designation;
use Validator;
use File;
use Session;

class AdminController extends Controller
{
    public function __construct() {

        $this->middleware('auth');
    }

    public function index() {

        $userDetails = array();

        $userDetail = User::with(['designationMeta' => function($q) {
                                $q->where('status', '=', '1');
                            }])
                            ->where('status','1')->where('is_deleted','0')->get();

        if(isset($userDetail) && !empty($userDetail)) {

            foreach ($userDetail as $key => $value) { // get userwise designation id
                $designationMeta = $userDetail[$key]->designationMeta;

                if(isset($designationMeta)) {
                    foreach (json_decode($designationMeta) as $key => $value) { // designation name using id
                        if(isset($userDetail[$key]->designationMeta[$key]->designation)) {
                            json_decode($userDetail[$key]->designationMeta[$key]->designation);
                        }
                    }
                }
            }
            $userDetails = json_decode($userDetail);
        }

        $data['userDetails'] = $userDetails;
        return view('admin/index',$data);
    }

    public function editUser($userId) {

        $userDetails = array();

        $userDetail = User::with(['designationMeta' => function($q) {
                                $q->where('status', '=', '1');
                            }])
                            ->where('id',$userId)->where('status','1')->where('is_deleted','0')->first();

        if(isset($userDetail) && !empty($userDetail)) {

            $designationMeta = $userDetail->designationMeta;

            foreach (json_decode($designationMeta) as $key => $value) { // get designation name
                json_decode($userDetail->designationMeta[$key]->designation);
            }
            
            $userDetails = json_decode($userDetail);
        }

        $data['userDetails'] = $userDetails;
        $data['allDesignations'] = json_decode(Designation::all());
        return view('admin/edit_user',$data);
    }

    public function updateUser(Request $request) {

        $rules = [
            'gender'       => 'required',
            'designation'  => 'required',
            'country'      => 'required',
        ];

        $messages = [
            'gender.required'       => 'Gender is required',
            'designation.required'  => 'Designation is required',
            'country.required'      => 'Please select country',
        ];

        $this->validate($request,$rules,$messages);

        // flush session using key
        Session::forget('error');
        Session::forget('success');

        $userId = $request->input('userId');
        $oldImageName = $request->input('oldImageName');

        if(count($request->file())>=1) {

            $rules = [
                'profileImage' => 'required|mimes:jpg,jpeg,png',
            ];

            $messages = [
                'profileImage.required' => 'Profile image is required',
                'profileImage.mimes'    => 'Please upload jpg,jpeg,png image',
            ];

            $this->validate($request,$rules,$messages);

            // create user dir if not exist
            $path1 = config('constants.publicProfile').'/'.$userId;
            if(!File::isDirectory($path1)){
                File::makeDirectory($path1, 0755, true, true);
            }

            $oldImageName = $request->input('oldImageName');

            $imageLocation = config('constants.publicProfile').'/'.$userId.'/'.$oldImageName;

            if(File::exists($imageLocation)) { //image exist in folder so delete old image
                File::delete($imageLocation);
            }

            $image = $request->file('profileImage');
            $newName = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = config('constants.publicProfile').'/'.$userId.'/';

            if($image->move($destinationPath, $newName)){ // image moved in folder successfully

                $this->updateAllData($userId,$request->input('gender'),$request->input('country'),$request->input('designation'),$newName);
                $request->session()->flash('success', 'Data updated successfully');
                return redirect('/dashboard');
            }
            else {
                $request->session()->flash('danger', 'Data updated successfully');
                return redirect('/dashboard');
            }
        }
        else {

            // function for update data
            $this->updateAllData($userId,$request->input('gender'),$request->input('country'),$request->input('designation'),$oldImageName);
            $request->session()->flash('success', 'Data updated successfully');
            return redirect('/dashboard');
        }
    }

    public function updateAllData($userId,$gender,$country,$designation,$imageName) {

        $updateData = array('gender'=>$gender,'country'=>$country,'profile_image'=>$imageName);
        User::where('id',$userId)->update($updateData);

        $userDetail = User::with(['designationMeta' => function($q) {
                            $q->where('status', '=', '1');
                        }])
                        ->where('id',$userId)->where('status','1')->where('is_deleted','0')->first();

        // get old designation id
        $designationMeta = $userDetail->designationMeta;

        if(isset($designationMeta)){
            foreach (json_decode($designationMeta) as $key => $value) { // array of user selected designation
                $oldDesignationId[] = $designationMeta[$key]->designation_id;
            }
        }

        // get designation id which are exist in olddata but not in new data
        $changeStatus = array();
        $changeStatus = array_diff($oldDesignationId,$designation);
        $changeStatus = array_values($changeStatus); // re-indexing. So array index start from 0.

        // change status of old id data which is not exist in new data
        if(isset($changeStatus) && sizeof($changeStatus)>0){
            for($j=0;$j<sizeof($changeStatus);$j++) {
                $designation_id = $changeStatus[$j];
                Usermeta::where('user_id',$userId)->where('designation_id',$designation_id)->update(['status'=>'0']);
            }
        }

        for($i=0;$i<sizeof($designation);$i++) {

            $designation_id = $designation[$i];

            $oldDesignation = Usermeta::select('id')->where('user_id',$userId)->where('designation_id',$designation_id)->first();
            $oldDesignation = json_decode($oldDesignation);

            if(isset($oldDesignation) && !empty($oldDesignation)) { // data exist so update it
                $data = array();
                $data = array('user_id'=>$userId,'designation_id'=>$designation_id,'status'=>'1');
                Usermeta::where('id',$userId)->where('designation_id',$designation_id)->update($data);
            }
            else { // data not exist so remove that
                $data = array();
                $data = array('user_id'=>$userId,'designation_id'=>$designation_id);
                Usermeta::create($data);
            }
        }
    }

    public function deleteUser($userId) {
        // flush session using key
        Session::forget('error');
        Session::forget('success');
        
        User::where('id',$userId)->update(['is_deleted'=>'1']);
        $request->session()->flash('success', 'Data deleted successfully');
        return redirect('/dashboard');
    }
}