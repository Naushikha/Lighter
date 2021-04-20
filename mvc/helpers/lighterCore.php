<?php

function lighterLogging($type, $msg)
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

function lighterThrow404()
{
    header('Location: '.BASEURL.'/404'); //Redirect to 404
}

function lighterRedirect($url = '')
{
    header('Location: '.BASEURL.'/'.$url);
}

function lighterLoadConfig($filename)
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
        lighterLogging('Lighter Framework', "Configuration file '{$filename}' not found, execution aborted.");

        exit;
    }
}
