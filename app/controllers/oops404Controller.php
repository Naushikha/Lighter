<?php

class oops404Controller extends Controller
{
    public function view()
    {
        $this->load->viewTemplate('Oops!', 'template_404');
        // logging('404', 'Accessed an unavailable resource.');
    }
}
