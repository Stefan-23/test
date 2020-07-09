<?php

class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $data = [
            'title' => 'Calendar App',
            'description' => 'Welcome to Calendar schedule app.',
        ];
        $this->view('pages/index', $data);
    }

    public function about()
    {
    }
}
