<?php

function getRealIpAddr() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip; //needed to exclude abusers who submit multiple pledges
}

$pledge_amount = $_POST['pledge_amount'];

if (is_numeric($pledge_amount)) {
    $pledge_double = bcadd($pledge_amount,'0',2);;

    if ((0 < $pledge_double) && ($pledge_double <= 2000)) {
        $ip = getRealIpAddr();

        // $db = new mysqli(DETAILS);
        if($db->connect_errno > 0){
            die('Unable to connect to database');
        }

        if(!$db->query("INSERT INTO pledge (pledge_ip, pledge_amount) VALUES ('$ip', '$pledge_double')")){
            die('There was an error running the query');
        }

        $db->close();
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Give It Back</title>
    <link href="http://fonts.googleapis.com/css?family=Muli:400,400italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="static/css/pledge.css">
    <link rel="shortcut icon" href="static/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="static/images/favicon.ico" type="image/x-icon">
</head>
<body>
    <div>
        <h1>Thank you!</h1>
    </div>
</body>
</html>
