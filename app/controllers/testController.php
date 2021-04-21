<?php

class testController extends Controller
{
    public function __view()
    {
        $this->load->helper('lighterTemplate');
        lighterAlert('You sent the message: ');
        lighterAlert('You sent the message: You sent the message: You sent the message: ', 'red');
        lighterAlert('You sent the message: You sent the message: You sent the message: You sent the message: You sent the message: You sent the message: You sent the message: You sent the message: ', 'green');
        $this->load->viewTemplate('Test', 'home');
    }

    public function view()
    {
        $this->checkModalRequests();
        echo 'You reached the test controller view method!';
    }
}
