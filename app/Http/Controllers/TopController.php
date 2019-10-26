<?php

namespace App\Http\Controllers;

use App\Reception;
use Illuminate\Http\Request;

class TopController extends Controller
{
    //
    public function getIndex()
    {
        return view('front/top');
    }

    public function getWaitingMin($count)
    {   
        $reception_data_min = $count * 10;
        return $reception_data_min;
    }
}
