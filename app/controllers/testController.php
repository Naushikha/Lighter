<?php

class testController extends Controller
{
    public function __view()
    {
        alert('This is a message');
        $this->load->viewTemplate('Test', 'home');
    }

    public function view()
    {
        echo 'You reached the test controller view method!';
    }
}
