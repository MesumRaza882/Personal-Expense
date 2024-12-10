<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests,DispatchesJobs, ValidatesRequests;

    public function success($data, $msg = 'Successfully', $status = 2, $statusCode = 200)
    {
        return response()->json([
            'status' => $status,
            'message' => $msg,
            'data' => $data,
        ], $statusCode);
    }

     // error message
     public function error($data, $msg = 'Fail', $status = 0, $statusCode = 400)
     {
         return response()->json([
             'status' => $status,
             'message' => $msg,
             'error' => $data,
         ], $statusCode);
     }

    public function formatNumberInMillionsAndBillions($number)
    {
        if ($number >= 1000000000) {
            return number_format($number / 1000000000, 6) . '-B';
        } elseif ($number >= 1000000) {
            return number_format($number / 1000000, 6) . '-M';
        } elseif ($number >= 100000) {
            return number_format($number / 100000, 6) . '-LC';
        } else {
            return number_format($number);
        }
    }
}
