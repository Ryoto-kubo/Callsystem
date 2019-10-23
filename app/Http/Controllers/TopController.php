<?php

namespace App\Http\Controllers;

use App\Reception;
use Illuminate\Http\Request;

class TopController extends Controller
{
    //
    public function getIndex()
    {
        $payload = array();
        $payload['reception_data_count'] = Reception::get()->count();
        $payload['reception_data_min'] = $this->getWaitingMin($payload['reception_data_count']);
        return view('front/top')->with($payload);
    }

    public function getWaitingMin($count)
    {   
        $reception_data_min = $count * 10;
        return $reception_data_min;
    }
}
