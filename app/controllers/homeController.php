<?php

class homeController extends Controller
{
    public function __view()
    {
        $this->TcheckModals();
        $this->TcheckFrags();
        $this->TcheckResponses();

        $this->Tview('', 'home', 'home.css');
    }

    protected function __view_modal_delete()
    {
        $this->Tmodal('Delete Shit', 'delete', 'test.css');
    }

    protected function __view_frag_yeshome()
    {
        $this->Tfrag('home', 'test2.css');
    }

    protected function __view_resp_sample()
    {
        $this->Talert('You sent the message: '.$_POST['msg']);
        $this->Talert('You sent the message: '.$_POST['msg'], 'red');
        $this->Talert('You sent the message: '.$_POST['msg'], 'green');
        lighterRedirect();
    }
}
