<?php

class load
{
    public function library($lib)
    {
        include_once LIB_PATH."{$lib}.php";
    }

    public function helper($helper)
    {
        include_once HELPER_PATH."{$helper}.php";
    }

    // Load a view, + can pass a data array to the page
    public function view($page, $data = '')
    {
        if (file_exists(VIEW_PATH.$page.'.php')) {
            require VIEW_PATH.$page.'.php';
        }
    }

    // Load a view by the template (header + footer),
    // + can set the page title, custom css for the page, and pass a data array
    public function viewTemplate($title, $page, $css = 'null', $data = '')
    {
        if ('' == $title) {
            $title = APP_TITLE;
        } else {
            $title = $title.': '.APP_TITLE;
        }
        define('PAGE_TITLE', $title);

        $css = $css.'.css';
        if (file_exists(PUBLIC_PATH.'css'.DS.$css)) { //If the custom CSS exists, define it.
            define('CUSTOM_CSS', $css);
        }

        require VIEW_PATH.'template_header.php';
        if (file_exists(VIEW_PATH.$page.'.php')) {
            require VIEW_PATH.$page.'.php';
        } else {
            require VIEW_PATH.'template_404.php';
        }

        require VIEW_PATH.'template_footer.php';
    }
}
