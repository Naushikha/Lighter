<?php

// TODO: Move these functions to helpers

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
