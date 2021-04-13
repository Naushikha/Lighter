<?php

function alert($msg, $type = '')
{
    $_SESSION['alert_type'] = $type;
    $_SESSION['alert_msg'] = $msg;
}

function throw404()
{
    header('Location: '.BASEURL.'/404'); //Redirect to 404
}

function redirect($url = '')
{
    header('Location: '.BASEURL.'/'.$url);
}

function loadFrag($page, $data = '')
{
    $page = 'frag_'.$page;
    if (file_exists(VIEW_PATH.$page.'.php')) {
        require VIEW_PATH.$page.'.php';
    }
}

function getFragResult($page, $data = '')
{
    $page = 'frag_'.$page;
    if (file_exists(VIEW_PATH.$page.'.php')) {
        ob_start();

        include VIEW_PATH.$page.'.php';
        $res = ob_get_contents();
        ob_end_clean();

        return $res;
    }
}

function mustBeLoggedIn($types = '')
{
    if (!isset($_SESSION['user'])) {
        redirect();

        exit;
    }
    if (!isset($_SESSION['user_type'])) {
        alert('Finish setting up your account to gain access');
        redirect('account/setup/select'); //Redirect if the user hasn't setup his role yet

        exit;
    }

    // Replace spaces with nothing
    $type_list = str_replace(' ', '', $types);
    // Split string into array
    $type_list = explode(',', $types);

    if ('' != $types && !in_array($_SESSION['user_type'], $type_list)) { // Is it not the authorized user?
        redirect();

        exit;
    }
}

function isUser($types = '')
{
    // Multi-purpose function, can be called without arguements to check if the request is by a user
    if ('' == $types) {
        if (isset($_SESSION['user'])) {
            return true;
        }

        return false;
    }

    // Replace spaces with nothing
    $types = str_replace(' ', '', $types);
    // Split string into array
    $types = explode(',', $types);
    if (in_array($_SESSION['user_type'], $types)) {
        return true;
    }

    return false;
}

function checkPrivilege($number, $type)
{
    // Type 1 - Add, 2 - Edit, 3 - Remove
    $binaryString = sprintf('%03d', decbin($number));

    if ('1' == $binaryString[$type - 1]) {
        return true;
    }

    return false;
}

function uploadExists($name)
{
    if (file_exists(UPLOAD_PATH.$name)) {
        return true;
    }

    return false;
}
function tempUploadExists($post_name)
{
    if (isset($_FILES[$post_name])) {
        // If a file is temporarily uploaded it should have a temp name
        if ('' == $_FILES[$post_name]['tmp_name']) {
            return false;
        }

        return true;
    }
}

function storeUpload($form_field_name)
{
    $extension = pathinfo($_FILES[$form_field_name]['name'], PATHINFO_EXTENSION);
    $random_hash = md5(uniqid(rand(), true));
    $file_name = $random_hash.'.'.$extension;
    // By rare chance if the file names are similar, generate a new name
    while (uploadExists($file_name)) {
        $random_hash = md5(uniqid(rand(), true));
        $file_name = $random_hash.'.'.$extension;
    }
    move_uploaded_file($_FILES[$form_field_name]['tmp_name'], UPLOAD_PATH.$file_name);

    return $file_name;
}

function removeUpload($name)
{
    if (file_exists(UPLOAD_PATH.$name)) {
        unlink(UPLOAD_PATH.$name);
    }
}

function downloadExists($name)
{
    if (file_exists(DOWNLOAD_PATH.$name)) {
        return true;
    }

    return false;
}

function cleanDownloads()
{
    // Cleans downloads that are older than 2 days
    $fileSystemIterator = new FilesystemIterator(DOWNLOAD_PATH);
    $now = time();
    foreach ($fileSystemIterator as $file) {
        if ($now - $file->getCTime() >= 60 * 60 * 24 * 2) {
            if ('.gitkeep' == $file->getFilename()) {
                return;
            } // Save the gitkeep :3
            unlink(DOWNLOAD_PATH.$file->getFilename());
        }
    }
}

function storeDownload($extension)
{
    cleanDownloads();
    $random_hash = md5(uniqid(rand(), true));
    $file_name = $random_hash.'.'.$extension;
    // By rare chance if the file names are similar, generate a new name
    while (downloadExists($file_name)) {
        $random_hash = md5(uniqid(rand(), true));
        $file_name = $random_hash.'.'.$extension;
    }

    return $file_name;
}

// https://stackoverflow.com/questions/654363/how-many-days-until-x-y-z-date
function getDaysUntil($date)
{
    return (isset($date)) ? ceil((strtotime($date) - time()) / 60 / 60 / 24) : false;
}

// https://alvinalexander.com/php/php-string-strip-characters-whitespace-numbers/
function getAlphaNumeric($string)
{
    return preg_replace('/[^a-zA-Z0-9\\s]/', '', $string);
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
    $logging = new LoggingModel();
    $logging->insert($type, $msg);
}
