<?php

class Response {

    //standardizing Responses
    public function sendResponse ($status, $payload = null, $msg = '', $status_code = 200 ) {
        http_response_code($status_code);
        return json_encode(['status'=>$status,'payload'=>$payload ,'message'=>$msg]);
    }
}


