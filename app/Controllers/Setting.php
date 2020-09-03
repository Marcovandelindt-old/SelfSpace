<?php

namespace App\Controllers;

class Setting extends BaseController 
{
    /**
     * @index action
     */
    public function index()
    {
        $data = [
            'title'   => 'Settings',
            'page'    => 'settings',
            'setting' => new \App\Models\Setting(),
        ];
        
        echo view('layouts/header', $data);
        echo view('settings/index', $data);
        echo view('layouts/footer', $data);
    }
    
    /**
     * Save the settings
     * 
     */
    public function save()
    {
        $settingModel = new \App\Models\Setting();
        
        if ($this->request->getMethod() == 'post') {
           $settingModel->updateData($this->request->getPost('setting'));
        }
        
        return redirect()->back()->with('message', 'Settings saved');
    }
}