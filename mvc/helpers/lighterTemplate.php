<?php

// Show a Lighter alert on next template load
function lighterAlert($msg, $type = '')
{
    $_SESSION['alert_type'] = $type;
    $_SESSION['alert_msg'] = $msg;
}
