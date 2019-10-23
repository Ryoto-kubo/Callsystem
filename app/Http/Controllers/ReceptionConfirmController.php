<?php

namespace App\Http\Controllers;

use App\Reception;
use Illuminate\Http\Request;

class ReceptionConfirmController extends Controller
{
    public function formPost(Request $request)
    {
        // var_dump($request);
        \Log::debug($request);
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

    public function formValidate(Request $request)
    {

        $rules = [
            'peoples'     => 'required|numeric',
            'seat_id'     => 'numeric',
            'smoke_id'    => 'numeric',
            'tell_number' => 'nullable|regex:/^(0{1}\d{1,4}-{0,1}\d{1,4}-{0,1}\d{4})$/',
        ];

        $messages = [
            'peoples.required'  => '※人数を入力してください',
            'peoples.numeric'   => '※半角数字で入力してください',
            'seat_id.numeric'   => '半角数字で入力してください',
            'smoke_id.numeric'  => '半角数字で入力してください',
            'tell_number.regex' => '※電話番号の形式で入力してください',
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);

        if(!$validator->fails())
        {
            $payload['success']  = 'success';
        }else{
            $payload['messages'] = $validator->messages();
        }

        return response()->json($payload);
    }
}
