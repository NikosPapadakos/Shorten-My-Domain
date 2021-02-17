<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '..\class\short.php';
include_once '..\class\Response.php';

$urls = new Short();

$stmt = $urls->getAllActive();
$activeUrlCount = $stmt->rowCount();

if ($activeUrlCount > 0) {
    $activeUrl = array(['activeCount'=>$activeUrlCount ]);
    echo (new Response())->sendResponse('success',$activeUrlCount); 
}else {
    echo (new Response())->sendResponse('failed',null ,'No active urls.'); 
}

?>