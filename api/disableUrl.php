<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
  
    include_once '../class/Short.php';
    include_once '../class/Response.php';

    
    $action = new Short();


    $data = json_decode(file_get_contents("php://input"));


    $action->id = $data->id;


    $action->getOneUrl();

    $is_enabled = $action->is_enabled;

    if($is_enabled == 1) {
       
        if ($action->disableUrl()){
        echo (new Response())->sendResponse('success',null ,'Url data updated.');
       }else {
        echo (new Response())->sendResponse('failed',null ,'Could not disable user.', 400);
       }

    }else {
        echo (new Response())->sendResponse('failed',null ,'User is already disabled.');
    }