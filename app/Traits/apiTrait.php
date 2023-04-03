<?php
namespace App\Traits;
trait apiTrait{
    protected function responseStatus( $message = 'No Message', $data='', $status = 'success', $code = 200){
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code );
    }
}
