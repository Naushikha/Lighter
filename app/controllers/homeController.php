<?php

class homeController extends Controller
{
    public function view()
    {
        // $this->load->view('', 'home_view', 'home_view');

        // load news from db with news Model
        // $news = new NewsModel();
        // $data = $news->view_latest_news();

        // pass data array to news
        $this->load->view('', 'home_view', 'home_view');
    }
}
