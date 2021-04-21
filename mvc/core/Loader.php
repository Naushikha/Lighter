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

    // Load a view by the template (header + footer),
    // + can set the page title, custom css for the page, and pass a data array
    public function viewTemplate($title, $page, $css = '', $data = '')
    {
        if ('' == $title) {
            $title = APP_TITLE;
        } else {
            $title = $title.': '.APP_TITLE;
        }
        define('PAGE_TITLE', $title);

        if ('' != $css) { // Include only if defined
            $css = $css.'.css';
            $cssPath = PUBLIC_PATH.'css'.DS.$css;
            if (file_exists($cssPath)) { //If the custom CSS exists, define it.
                define('CUSTOM_CSS', $css);
            } else {
                lighterLogging('Lighter Framework', "CSS not found: {$css}");
            }
        }

        // Template file paths
        $headerPath = VIEW_PATH.'template_header.php';
        $footerPath = VIEW_PATH.'template_footer.php';
        // Target view path
        $pagePath = VIEW_PATH.$page.'.php';

        if (file_exists($headerPath)) {
            require $headerPath;
        } else {
            lighterLogging('Lighter Framework', 'Template header not found', true);
        }

        if (file_exists($pagePath)) {
            require $pagePath;
        } else {
            lighterLogging('Lighter Framework', 'Template target view not found', true);
        }

        if (file_exists($footerPath)) {
            require $footerPath;
        } else {
            lighterLogging('Lighter Framework', 'Template footer not found', true);
        }
    }

    // View a Lighter modal
    public function viewModal($title, $modal, $data = '')
    {
        $modal = 'modal_'.$modal;
        $modalPath = VIEW_PATH.$modal.'.php';
        if (file_exists($modalPath)) {
            ob_start();

            include $modalPath;
            $res = ob_get_contents();
            ob_end_clean();

            echo json_encode([
                'title' => $title,
                'content' => $res,
            ]);
        } else {
            lighterLogging('Lighter Framework', "Modal not found: {$modal}", true);
        }
    }

    // View a Lighter fragment(frag)
    public function viewFrag($frag, $data = '')
    {
        $frag = 'frag_'.$frag;
        $fragPath = VIEW_PATH.$frag.'.php';
        if (file_exists($fragPath)) {
            ob_start();

            include $fragPath;
            $res = ob_get_contents();
            ob_end_clean();

            echo json_encode([
                'content' => $res,
            ]);
        } else {
            lighterLogging('Lighter Framework', "Fragment not found: {$frag}", true);
        }
    }
}
