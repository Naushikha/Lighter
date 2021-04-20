<?php

class testController extends Controller
{
    public function __view()
    {
        lighterAlert('This is a message');
        $this->load->viewTemplate('Test', 'home');
    }

    public function view()
    {
        $this->checkModalRequests();
        echo 'You reached the test controller view method!';
    }
}
