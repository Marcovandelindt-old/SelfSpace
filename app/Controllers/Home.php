<?php namespace App\Controllers;

class Home extends BaseController
{
    /**
     * @index action
     * 
     */
    public function index()
    {
        $weatherData = $this->getWeatherData();
        
        $data = [
            'title'       => 'Home',
            'page'        => 'home',
            'weatherData' => $weatherData,
        ];
        
        echo view('layouts/header', $data);
        echo view('home/index', $data);
        echo view('layouts/footer', $data);
    }
    
    /**
     * Get the weather data
     * 
     * @return $data
     */
    public function getWeatherData()
    {
        $setting  = new \App\Models\Setting();
        $apiKey   = $setting->getByName('openWeatherApiKey')->value;
        $url      = 'https://api.openweathermap.org/data/2.5/weather?q=Mijdrecht&appId=' . $apiKey . '&units=metric';
        $contents = file_get_contents($url);
        $data     = json_decode($contents);
        
        return $data;
    }

}
