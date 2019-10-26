<?php

namespace App\Http\Controllers\Api;

use App\Reception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReceptionController extends Controller
{   
    public function getReceptionCount()
    {
        $payload = array();
        $payload['reception_data_count'] = Reception::get()->count();
        // $payload['reception_data_min']   = $this->getWaitingMin($payload['reception_data_count']);
        return $payload;

    }

    public function getReceptionNumber()
    {
        $payload = array();
        $payload['reception_number_object'] = Reception::orderBy('id', 'desc')->first();
        return $payload;
    }

    public function postReceptionForm(Request $request)
    {
        $payload = array();
        $reception_object = new Reception();

            $con = \DB::connection();
            try{
                $con->beginTransaction();
                $reception_object->peoples     = $request->peoples;
                $reception_object->seat_id     = $request->seat_id;
                $reception_object->smoke_id    = $request->smoke_id;
                $reception_object->tell_number = $request->tell_number;
                $reception_object->save();
                $con->commit();
                $payload['success']            = 'success';

            } catch (\Exception $e){
                $con->rollback();
                throw $e;
            }
        return $payload;
    }
}
