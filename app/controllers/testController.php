<?php

class testController extends Controller
{
    public function __view()
    {
        $this->Talert('You sent the message: ');
        $this->Talert('You sent the message: You sent the message: You sent the message: ', 'red');
        $this->Talert('You sent the message: You sent the message: You sent the message: You sent the message: You sent the message: You sent the message: You sent the message: You sent the message: ', 'green');
        $this->Tview('Test', 'home');
    }

    public function view()
    {
        $this->TcheckModals();
        echo 'You reached the test controller view method!';
    }
}
