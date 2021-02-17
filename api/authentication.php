<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-phoneNum: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers,Access-Control-Allow-Methods, Authorization, X-Requested-With");

   
    include_once '..\class\Admin.php';
    include_once '..\class\Response.php';

    $login = new Admin();

    $creds = json_decode(file_get_contents("php://input"));
    $username = htmlspecialchars($creds->username);
    $password = htmlspecialchars(md5($creds->password));
    
    if(empty($username) || empty($password)) {
        echo (new Response())->sendResponse('failed',null , 'Inputs cannot be empty.' , 400); 
        return ;
    }

    if($login->isAdmin($username, $password)){
        echo (new Response())->sendResponse('success','true','User authentication successfull.'); 
    }else {
        echo (new Response())->sendResponse('failed' , 'User not found.'); 
    }