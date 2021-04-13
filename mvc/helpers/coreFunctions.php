<?php

function throw404()
{
    header('Location: '.BASEURL.'/404'); //Redirect to 404
}

function redirect($url = '')
{
    header('Location: '.BASEURL.'/'.$url);
}

function logging($type, $msg)
{
    // Following the standard log format
    // https://en.wikipedia.org/wiki/Common_Log_Format
    // Log user ID if user is logged in!
    $logfile = fopen(FRAMEWORK_PATH.'logs'.DS.'logs.txt', 'a');
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $datetime = date('Y/m/d h:i:sa');
    $txt = "[!] {$datetime} - {$user_ip} - {$type} - {$msg}\n";
    fwrite($logfile, $txt);
    fclose($logfile);

    // Add to database as well
    // $logging = new LoggingModel();
    // $logging->insert($type, $msg);
}

// Show a Lighter alert on next template load
function alert($msg, $type = '')
{
    $_SESSION['alert_type'] = $type;
    $_SESSION['alert_msg'] = $msg;
}
