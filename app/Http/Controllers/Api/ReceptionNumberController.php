<?php

namespace App\Http\Controllers\Api;

use App\Reception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReceptionNumberController extends Controller
{
    public function getReceptionNumber()
    {
        $payload = array();
        $payload['reception_number_object'] = Reception::orderBy('id', 'desc')->first();
        return $payload;
    }
}
