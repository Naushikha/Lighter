<?php

class homeController extends Controller
{
    public function __view()
    {
        // $this->load->library('modal');
        // Check for modal requests
        if (isset($_POST['getModal'])) {
            $this->load->viewModal('Delete Shit', 'delete');

            exit;
        }
        $this->load->viewTemplate('', 'home', 'home');
    }

    private function checkModalRequests()
    {
    }
}
