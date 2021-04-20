<?php

function lighterUploadExists($name)
{
    if (file_exists(UPLOAD_PATH.$name)) {
        return true;
    }

    return false;
}

function lighterTempUploadExists($post_name)
{
    if (isset($_FILES[$post_name])) {
        // If a file is temporarily uploaded it should have a temp name
        if ('' == $_FILES[$post_name]['tmp_name']) {
            return false;
        }

        return true;
    }

    return false;
}

function lighterStoreUpload($form_field_name)
{
    $extension = pathinfo($_FILES[$form_field_name]['name'], PATHINFO_EXTENSION);
    $random_hash = md5(uniqid(rand(), true));
    $file_name = $random_hash.'.'.$extension;
    // By rare chance if the file names are similar, generate a new name
    while (lighterUploadExists($file_name)) {
        $random_hash = md5(uniqid(rand(), true));
        $file_name = $random_hash.'.'.$extension;
    }
    move_uploaded_file($_FILES[$form_field_name]['tmp_name'], UPLOAD_PATH.$file_name);

    return $file_name;
}

function lighterRemoveUpload($name)
{
    if (file_exists(UPLOAD_PATH.$name)) {
        unlink(UPLOAD_PATH.$name);
    }
}
