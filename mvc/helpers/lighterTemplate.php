<?php

// Show a Lighter alert on next template load
function lighterAlert($msg, $type = '')
{
    if (!isset($_SESSION['LIGHTER_ALERTS'])) {
        $_SESSION['LIGHTER_ALERTS'] = [];
    }
    $alert = [
        'type' => $type,
        'msg' => $msg,
    ];
    array_push($_SESSION['LIGHTER_ALERTS'], $alert);
}
