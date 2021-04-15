<?php

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

function throw404()
{
    header('Location: '.BASEURL.'/404'); //Redirect to 404
}

function redirect($url = '')
{
    header('Location: '.BASEURL.'/'.$url);
}

function loadConfig($filename)
{
    $prodConfigFile = CONFIG_PATH.'prod_config_'.$filename.'.php';
    $configFile = CONFIG_PATH.'config_'.$filename.'.php';

    if (defined('LIGHTER_PROD_ENV')) {
        if (file_exists($prodConfigFile)) {
            require $prodConfigFile;

            return;
        }
    }
    // Fallback to development configuration if production not found
    if (file_exists($configFile)) {
        require $configFile;
    } else {
        logging('Lighter Framework', "Configuration file '{$filename}' not found, execution aborted.");

        exit;
    }
}

// Show a Lighter alert on next template load
function alert($msg, $type = '')
{
    $_SESSION['alert_type'] = $type;
    $_SESSION['alert_msg'] = $msg;
}
