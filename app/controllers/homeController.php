<?php

class homeController extends Controller
{
    public function view()
    {
        $this->load->viewTemplate('', 'home_view', 'home_view');
    }
}
