<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message, $status_code = 200)
    {
        // $response = [
        //     'status' => "success",
        //     'data'    => $result,
        //     'message' => Config::get('customMessages.' . $message),
        //     'status_code' => $status_code
        // ];

        return ($result->additional([
            'status' => 'success',
            'message' => Config::get('customMessages.' . $message),
            'status_code' => $status_code
        ]));
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'status' => "error",
            'message' => Config::get('customMessages.' . $error),
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
