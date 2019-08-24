<?php

namespace App\Http\Controllers;

use App\Reception;
use Illuminate\Http\Request;


class ManageController extends Controller
{
    //
    public function index()
    {
        $payload = array();

        $payload['reception_objects'] = Reception::get()->toArray();

        return view('/front/manage/top')->with($payload);
    }
}
