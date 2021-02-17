<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    
    include_once '../class/Short.php';
    include_once '../class/Response.php';
    
    $delUrl = new Short();
    
    $data = json_decode(file_get_contents("php://input"));
    
    $delUrl->id = $data->id;
    
    if($delUrl->deleteUrl()){
        echo (new Response())->sendResponse('success',null , 'Url deleted.'); 
    } else{
        echo (new Response())->sendResponse('failed' ,null , 'Url could not be deleted' , 400); 
    }
?>