<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '..\class\short.php';
include_once '..\class\Response.php';

$urls = new Short();

$stmt = $urls->getDisabledOrExpired();
$disabledUrlCount = $stmt->rowCount();

if ($disabledUrlCount > 0) {
    $disabledUrl = array(['disabledCount'=>$disabledUrlCount ]);
    echo (new Response())->sendResponse('success',$disabledUrlCount); 
}else {
    echo (new Response())->sendResponse('failed',null ,'No disabled urls.'); 
}

?>