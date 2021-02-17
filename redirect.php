
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting</title>
    <link rel="icon" href="./styles/icon.png" type="image/icon type">
    <link rel="stylesheet" href="./styles/redirection.css">
</head>
<body>
    <h1>Redirecting</h1>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
</body>
</html>

<?php
 
    include_once './class/Short.php';
    date_default_timezone_set('Europe/Athens');

    if(isset($_GET['shortened'])) {
        $short = new Short();
        $code = $_GET['shortened'];
        $short->shortened = $code;
        
        $short->getOneUrlByShort();
        
         $expire = $short->getExpiryFromShortened($code);
        
         $comp = (date('Y-m-d H:i:s')<=$expire['expiry_date']);
        $enabled = $short->is_enabled;

        $minutes_to_add = $short->active_period;

    $time = new DateTime($short->expiry_date);
    $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));

    $renew_expiry = $time->format('Y-m-d H:i:s');



        if ($url = $short->getUrl($code) And $comp And $enabled == 1) {
            $redirect = $url['original'];
            header("Refresh: 3;".$redirect);
            die();
            
        }else if($url = $short->getUrl($code) And !$comp And $short->renewable == 1 And $enabled == 1 And  ($renew_expiry > date('Y-m-d H:i:s')) ){
            session_start();
            
            $short->renewable = 0;
            $newRenewVal = $short->renewable;
            
            $newExpiration = strtotime('+'.$short->active_period.' minutes');
            $formattedExpi = date('Y-m-d H:i:s', $newExpiration);
            
            $original = $url['original'];
            $_SESSION['original'] = $original;
            $_SESSION['expiration_date'] = $formattedExpi;
            

            $short->renewUrl($code, $formattedExpi, $newRenewVal);

           
            header('Location: http://localhost/smd/expiredAndRenew.php');
        }else {
            header('Location: http://localhost/smd/urlExpired.php');
        }

    }

    
 
 ?>