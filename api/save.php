<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers,Access-Control-Allow-Methods, Authorization, X-Requested-With");
    date_default_timezone_set('Europe/Athens');
    
    include_once '../class/Short.php';
    include_once '../class/Response.php';
    


    $result = json_decode(file_get_contents("php://input"));




  
    
    if(!empty($result->original) && strlen($result->expiry_date)!=0 && strlen($result->renewable)!=0) {
       $duration = [
           0=>['strtotime'=>'+10 minutes','duration'=>10],
           1=>['strtotime'=>'+1 hour','duration'=>60],
           2=>['strtotime'=>'+1 day','duration'=>1440],
           3=>['strtotime'=>'+1 week','duration'=>10080],
           4=>['strtotime'=>'+15 days','duration'=>21600]
       ];

        $newUrl = new Short();
        if(!array_key_exists($result->expiry_date ,$duration)){
            return  (new Response())->sendResponse('failed',null , 'Key does not exist.' , 400); 
        }
        
        
        
        $newUrl->expiry_date = date('Y-m-d H:i:s', strtotime($duration[$result->expiry_date]['strtotime']));
        $newUrl->active_period = $duration[$result->expiry_date]['duration'];
        

        $trimmed = $result->original; 
        function addhttp($url) {
            if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
                $url = "http://" . $url;
            }
            return $url;
        }

        

        $newUrl->original = addhttp($trimmed);
        $newUrl->is_enabled = 1;
       
        $newUrl->renewable = $result->renewable;
        
        if($code = $newUrl->findOrCreateUrl()){
            echo (new Response())->sendResponse('success',$code); 
        } else{
            echo (new Response())->sendResponse('failed',null , 'Url could not be created.' , 400); 
        }
    }else {
        echo (new Response())->sendResponse('failed',null , 'Inputs cannot be empty', 400); 
    }
   

