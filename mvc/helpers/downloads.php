<?php

function downloadExists($name)
{
    if (file_exists(DOWNLOAD_PATH.$name)) {
        return true;
    }

    return false;
}

// Cleans downloads that are older than specified days
function cleanDownloads()
{
    $days = 2; // Modify according to need
    $fileSystemIterator = new FilesystemIterator(DOWNLOAD_PATH);
    $now = time();
    foreach ($fileSystemIterator as $file) {
        if ($now - $file->getCTime() >= 60 * 60 * 24 * $days) {
            if ('.gitkeep' == $file->getFilename()) {
                return;
            } // Save the gitkeep xD
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
