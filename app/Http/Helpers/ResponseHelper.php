<?php
namespace App\Http\Helpers;

class ResponseHelper{
    /**
     * send response success
     * @param array $data
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function sendResponseSuccess(array $data , string $message , int $code=200 ){
        $response = [
            'status' => true,
            'data'    => $data,
            'message' => $message,
        ];


        return response()->json($response, $code);
    }

    public static function sendResponseError(array $data , $message , $code=404 ){
        $response = [
            'status' => false,
            'data'    => $data,
            'message' => $message,
        ];


        return response()->json($response, $code);
    }
}
