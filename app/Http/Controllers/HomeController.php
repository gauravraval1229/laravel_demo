<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;


class HomeController extends Controller
{
  
  public function __construct() {
  }

  public function getState(Request $request) {

    $country = $request->input('country');

    if($country != ""){
      if($country == "india") {
        echo "success,gujarat,rajasthan";
      }
      else {
        echo "success,florida,texas";
      }
    }
    else {
      echo "fail,Please select country";
    }
  }
}