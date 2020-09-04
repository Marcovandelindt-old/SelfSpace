<?php

namespace App\Controllers;

use App\Libraries\SpotifyWebAPI\Request as SpotifyRequest;
use App\Libraries\SpotifyWebAPI\Session as SpotifySession;
use App\Libraries\SpotifyWebAPI\SpotifyWebAPI as SpotifyWebAPI;
use App\Libraries\SpotifyWebAPI\SpotifyWebAPIAuthException as SpotifyWebAPIAuthException;
use App\Libraries\SpotifyWebAPI\SpotifyWebAPIException as SpotifyWebAPIException;

use App\Models\Spotify as Spotify;

class Music extends BaseController 
{   
    public function __construct()
    {
        $settingModel = new \App\Models\Setting();
        $this->spotifySession = new SpotifySession(
            $settingModel->getByName('spotifyClientId')->value,
            $settingModel->getByName('spotifyClientSecret')->value,
            $settingModel->getByName('spotifyRedirectURI')->value
        );
        
        $this->spotifyApi = new SpotifyWebAPI();
    }
    
    /**
     * @index action
     */
    public function index()
    {   
        $data = [
            'title' => 'Music',
            'name'  => 'music'
        ];
        
        if (!empty($this->request->getGet('code'))) {
            $this->setSpotifyCode();
            return redirect()->to('/music');
        }
        
        echo view('layouts/header', $data);
        echo view('music/index', $data);
        echo view('layouts/footer', $data);
    }
    
    /**
     * Authorize at Spotify
     */
    public function authorize()
    {       
        # Set Scopes
        $options = [
            'scope' => [
                Spotify::SCOPE_IMAGE_UPLOAD,
                Spotify::SCOPE_USER_READ_PLAYBACK_STATE,
                Spotify::SCOPE_USER_MODIFY_PLAYBACK_STATE,
                Spotify::SCOPE_USER_READ_CURRENTLY_PLAYING,
                Spotify::SCOPE_STREAMING,
                Spotify::SCOPE_APP_REMOTE_CONTROL,
                Spotify::SCOPE_USER_READ_EMAIL,
                Spotify::SCOPE_USER_READ_PRIVATE,
                Spotify::SCOPE_PLAYLIST_READ_COLLABORATIVE,
                Spotify::SCOPE_PLAYLIST_MODIFY_PULIBC,
                Spotify::SCOPE_PLAYLIST_READ_PRIVATE,
                Spotify::SCOPE_PLAYLIST_MODIFY_PRIVATE,
                Spotify::SCOPE_LIBRARY_MODIFY,
                Spotify::SCOPE_LIBRARY_READ,
                Spotify::SCOPE_USER_TOP_READ,
                Spotify::SCOPE_USER_READ_PLAYBACK_STATE,
                Spotify::SCOPE_USER_READ_PLAYBACK_POSITION,
                Spotify::SCOPE_USER_READ_RECENTLY_PLAYED,
                Spotify::SCOPE_USER_FOLLOW_READ,
                Spotify::SCOPE_USER_FOLLOW_MODIFY
            ],
        ];

        # Redirect to Spotify
        return redirect()->to($this->spotifySession->getAuthorizeUrl($options));
    }
    
    /**
     * Set the Spotify Code
     */
    public function setSpotifyCode()
    {
        $this->spotifySession->requestAccessToken($this->request->getGet('code'));
        $this->spotifyApi->setAccessToken($this->spotifySession->getAccessToken());        
    }
    
    /**
     * Get recent Spotify tracks
     */
    public function getRecentTracks()
    {
        
    }
}