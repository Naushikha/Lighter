<?php

// TODO: Move these functions to helpers

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
