<?php

class oops404Controller extends Controller
{
    public function view()
    {
        http_response_code(404);
        $this->Tview('Oops!', 'template_404');
        // lighterLogging('404', 'Accessed an unavailable resource.');

        exit();
    }
}
