<?php

class load
{
    public function library($lib)
    {
        $libraryPath = LIB_PATH."{$lib}.php";
        if (file_exists($libraryPath)) {
            require_once $libraryPath;
        } else {
            lighterLogging('Lighter Framework', "Library not found: {$lib}", true);
        }
    }

    public function helper($helper)
    {
        $helperPath = HELPER_PATH."{$helper}.php";
        if (file_exists($helperPath)) {
            require_once $helperPath;
        } else {
            lighterLogging('Lighter Framework', "Helper not found: {$helper}", true);
        }
    }

    // Load a view, + can pass a data array to the page
    public function view($page, $data = '')
    {
        $pagePath = VIEW_PATH.$page.'.php';
        if (file_exists($pagePath)) {
            require $pagePath;
        } else {
            lighterLogging('Lighter Framework', "View not found: {$page}", true);
        }
    }
}
