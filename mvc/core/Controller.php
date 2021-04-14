<?php

class Controller
{
    protected $load;

    public function __construct()
    {
        $this->load = new load();
    }

    protected function checkModalRequests()
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

    protected function checkFragRequests()
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

    protected function checkResponses()
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
