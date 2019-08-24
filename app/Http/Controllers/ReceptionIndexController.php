<?php

namespace App\Http\Controllers;

use App\Reception;
use Illuminate\Http\Request;


class ReceptionIndexController extends Controller
{
    public function index()
    {
        $payload = array();
        $payload['reception_data_count'] = Reception::get()->count();
        
        $payload['reception_data_min'] = $this->getWaitingMin($payload['reception_data_count']);
        
        return $payload;
    }

    public function getWaitingMin()
    {   
        $payload = array();
        
        $reception_data_count = Reception::get()->count();
        
        $payload['reception_data_min'] = $reception_data_count * 10;
        
        return $payload;
    }
}
