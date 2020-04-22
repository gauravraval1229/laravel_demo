<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function register(Request $request)
    {
		$rules = [
			'email'			=> 'required',
			'password'		=> 'required|min:3',
			'gender'		=> 'required',
			'designation'	=> 'required',
			'country'		=> 'required',
		];

		$messages = [
			'email.required'			=> 'Email is required',
			'password.required'			=> 'Password is required',
			'password.min'				=> 'Password must be 3 or more character',
			'gender.required'			=> 'Gender is required',
			'designation.required'		=> 'Designation is required',
			'country.required'			=> 'Please select country',
		];

    	$this->validate($request,$rules,$messages);
    }
}
