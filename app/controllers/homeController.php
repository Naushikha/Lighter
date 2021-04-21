<?php

class homeController extends Controller
{
    public function __view()
    {
        $this->checkModalRequests();
        $this->checkFragRequests();
        $this->checkResponses();

        $this->load->viewTemplate('', 'home', 'home');
    }

    protected function __view_modal_delete()
    {
        $this->load->viewModal('Delete Shit', 'delete');
    }

    protected function __view_frag_yeshome()
    {
        $this->load->viewFrag('home');
    }

    protected function __view_resp_sample()
    {
        $this->load->helper('lighterTemplate');
        lighterAlert('You sent the message: '.$_POST['msg']);
        lighterAlert('You sent the message: '.$_POST['msg'], 'red');
        lighterAlert('You sent the message: '.$_POST['msg'], 'green');
        lighterRedirect();
    }
}
