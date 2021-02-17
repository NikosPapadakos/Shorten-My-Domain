<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers,Access-Control-Allow-Methods, Authorization, X-Requested-With");
    date_default_timezone_set('Europe/Athens');
    
    include_once '../class/Short.php';
    include_once '../class/Response.php';


    $renew = new Short();

    

    $result = json_decode(file_get_contents("php://input"));
    $renew->shortened = $result->shortened;
    $renew->getOneUrlByShort();
    
    $minutes_to_add = $renew->active_period;

    $time = new DateTime($renew->expiry_date);
    $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));

    $renew_expiry = $time->format('Y-m-d H:i:s');    

   


    if($renew->shortened != null){
        
        if($renew->renewable == 1 && $renew->is_enabled == 1 && ($renew_expiry > date('Y-m-d H:i:s'))) {
            
            $newExpiration = strtotime('+'.$renew->active_period.' minutes');
        
            $formattedExpi = date('Y-m-d H:i:s', $newExpiration);
          
            $renew->renewable = 0;
            
            $renew->renewUrl($renew->shortened, $formattedExpi,'0');
            http_response_code(200);
            $arr = array(
                "shortened" => $renew->shortened,
                "expiry_date" => $formattedExpi,
                "renewable" => $renew->renewable,
                "active_period" => $renew->active_period
            );
            echo (new Response())->sendResponse('success',$arr); 
        };

    } else{
        echo (new Response())->sendResponse('failed',null ,'Url cannot be renewed.', 404); 
    }