<?php

class Default_404Controller extends Controller{
    function view(){
        $this->load->view('Oops!', 'template_404');
        // logging('404', 'Someone accessed an unavailable resource.');
    }

}

?>