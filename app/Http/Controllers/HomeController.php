<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Usermeta;
use App\Designation;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {

        //$userDetail = User::find(Auth::user()->id);
        //$userDetail = json_decode($userDetail->designationMeta[0]->designation);
        return view('index');
    }

    public function index() {

        $userDetails = array();

        $userDetail = User::with(['designationMeta' => function($q) {
                                $q->where('status', '=', '1');
                            }])
                            ->where('id',Auth::user()->id)->where('status','1')->first();


        if(isset($userDetail) && !empty($userDetail)){

            $designationMeta = $userDetail->designationMeta;
        
            foreach (json_decode($designationMeta) as $key => $value) {
                json_decode($userDetail->designationMeta[$key]->designation);
            }
            $userDetails = json_decode($userDetail);
        }
        else {
            $userDetails = array();
        }

        $data['userDetails'] = $userDetails;
        return view('admin/index',$data);
    }
}
