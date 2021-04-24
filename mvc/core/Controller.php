<?php

class Controller
{
    protected $load;

    public function __construct()
    {
        $this->load = new load();
    }

    ///////////////////////////////////////////////////////////////////////////////////////
    // Lighter template support: Gives ability to call modals, frags, responses & alerts

    // Load a view by the template (header + footer),
    // + can set the page title, custom css for the page, and pass a data array
    protected function Tview($title, $page, $css = '', $data = '')
    {
        if ('' == $title) {
            $title = APP_TITLE;
        } else {
            $title = $title.': '.APP_TITLE;
        }
        define('PAGE_TITLE', $title);

        if ('' != $css) { // Include only if defined
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

    // Show a Lighter alert on next template load
    protected function Talert($msg, $type = '')
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

    // View a Lighter modal
    protected function Tmodal($title, $modal, $css = '', $data = '')
    {
        $modal = 'modal_'.$modal;
        $modalPath = VIEW_PATH.$modal.'.php';
        if (file_exists($modalPath)) {
            ob_start();

            include $modalPath;
            $res = ob_get_contents();
            ob_end_clean();

            $jsonArray = [
                'title' => $title,
                'content' => $res,
            ];
            if ('' != $css) {
                $cssPath = PUBLIC_PATH.'css'.DS.$css;
                $cssURL = BASEURL.'/public/css/'.$css;
                if (file_exists($cssPath)) { //If the custom CSS exists, add it to response.
                    $jsonArray['css'] = $cssURL;
                } else {
                    lighterLogging('Lighter Framework', "CSS not found: {$css}");
                }
            }
            echo json_encode($jsonArray);
        } else {
            lighterLogging('Lighter Framework', "Modal not found: {$modal}", true);
        }
    }

    // View a Lighter fragment(frag)
    protected function Tfrag($frag, $css = '', $data = '')
    {
        $frag = 'frag_'.$frag;
        $fragPath = VIEW_PATH.$frag.'.php';
        if (file_exists($fragPath)) {
            ob_start();

            include $fragPath;
            $res = ob_get_contents();
            ob_end_clean();

            $jsonArray = [
                'content' => $res,
            ];
            if ('' != $css) {
                $cssPath = PUBLIC_PATH.'css'.DS.$css;
                $cssURL = BASEURL.'/public/css/'.$css;
                if (file_exists($cssPath)) { //If the custom CSS exists, add it to response.
                    $jsonArray['css'] = $cssURL;
                } else {
                    lighterLogging('Lighter Framework', "CSS not found: {$css}");
                }
            }
            echo json_encode($jsonArray);
        } else {
            lighterLogging('Lighter Framework', "Fragment not found: {$frag}", true);
        }
    }

    protected function TcheckModals()
    {
        // Modal request functions should be of the form "protected callingFunction_modal_modalRequestID()"
        if (isset($_POST['getModal'])) {
            $modalRequestID = $_POST['getModal'];
            $callingFunction = debug_backtrace()[1]['function']; // Hack to get the calling function
            $modalFunction = "{$callingFunction}_modal_{$modalRequestID}";

            if (method_exists($this, $modalFunction)) {
                $this->{$modalFunction}();

                exit;
            }
        }
    }

    protected function TcheckFrags()
    {
        // Frag request functions should be of the form "protected callingFunction_frag_fragRequestID()"
        if (isset($_POST['getFrag'])) {
            $fragRequestID = $_POST['getFrag'];
            $callingFunction = debug_backtrace()[1]['function']; // Hack to get the calling function
            $fragFunction = "{$callingFunction}_frag_{$fragRequestID}";

            if (method_exists($this, $fragFunction)) {
                $this->{$fragFunction}();

                exit;
            }
        }
    }

    protected function TcheckResponses()
    {
        // Response request functions should be of the form "protected callingFunction_resp_responseRequestID()"
        if (isset($_POST['sendResponse'])) {
            $responseRequestID = $_POST['sendResponse'];
            $callingFunction = debug_backtrace()[1]['function']; // Hack to get the calling function
            $responseFunction = "{$callingFunction}_resp_{$responseRequestID}";

            if (method_exists($this, $responseFunction)) {
                $this->{$responseFunction}();

                exit;
            }
        }
    }
}
