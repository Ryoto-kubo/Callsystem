<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceptionFormController extends Controller
{
    public function index()
    {
        return  view('/front/receptionform');
    }
}
