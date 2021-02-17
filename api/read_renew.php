<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '..\class\short.php';
include_once '..\class\Response.php';

$urls = new Short();

$stmt = $urls->getAllRenewable();
$renewableUrlCount = $stmt->rowCount();

if ($renewableUrlCount > 0) {
    $renewableUrl = array(['renewableCount'=>$renewableUrlCount ]);
    echo (new Response())->sendResponse('success',$renewableUrlCount); 
}else {
    echo (new Response())->sendResponse('failed',null ,'No renewable urls.'); 
}

?>