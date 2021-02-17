<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '..\class\short.php';
include_once '..\class\Response.php';

$urls = new Short();

$stmt = $urls->getDisabledOrExpired();
$nonActiveUrlCount = $stmt->rowCount();

if ($nonActiveUrlCount > 0) {
    $urlArr = array();
    $urlArr['data'] = array();
   
    $urlArr['urlCount']=$nonActiveUrlCount;

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $arr = array(
            "id" => $id,
            "original" => $original,
            "shortened" => $shortened,
            "creation_date" => $creation_date,
            "expiry_date" => $expiry_date,
            "renewable" => $renewable,
            "active_period" => $active_period,
            "is_enabled" => $is_enabled
        );

        array_push($urlArr['data'], $arr);
     
    }
    echo (new Response())->sendResponse('success',$urlArr); 
}else {
    echo (new Response())->sendResponse('failed',null ,'No nonactive urls.'); 
}

?>