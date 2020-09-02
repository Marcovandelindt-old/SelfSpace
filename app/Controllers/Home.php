<?php namespace App\Controllers;

class Home extends BaseController
{
    /**
     * @index action
     * 
     */
    public function index()
    {
        $data = [
            'title' => 'Home',
            'page'  => 'home',
        ];
        
        echo view('layouts/header', $data);
        echo view('home/index', $data);
        echo view('layouts/footer', $data);
    }

}
