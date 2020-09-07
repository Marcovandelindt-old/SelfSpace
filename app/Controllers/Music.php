<?php

namespace App\Controllers;

use App\Libraries\SpotifyWebAPI\Request as SpotifyRequest;
use App\Libraries\SpotifyWebAPI\Session as SpotifySession;
use App\Libraries\SpotifyWebAPI\SpotifyWebAPI as SpotifyWebAPI;
use App\Libraries\SpotifyWebAPI\SpotifyWebAPIAuthException as SpotifyWebAPIAuthException;
use App\Libraries\SpotifyWebAPI\SpotifyWebAPIException as SpotifyWebAPIException;

use App\Models\Spotify as Spotify;
use App\Models\Track as Track;
use App\Models\PlayedTrack as PlayedTrack;
use App\Models\Artist as Artist;

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
        $todaysTracks = [];
        foreach (PlayedTrack::getTodaysTracks() as $todaysTrack) {
            $track           = Track::getById($todaysTrack['trackId']);
            $track->playedAt = $todaysTrack['playedAt'];
            $todaysTracks[]  = $track;
        }
        
        $data = [
            'title'        => 'Music',
            'name'         => 'music',
            'todaysTracks' => $todaysTracks,
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
        $settingModel = new \App\Models\Setting();
        
        $this->spotifySession->requestAccessToken($this->request->getGet('code'));
        
        $accessToken  = $this->spotifySession->getAccessToken();
        $refreshToken = $this->spotifySession->getRefreshToken();
        
        $updateData = [];
        if (!empty($accessToken) && !empty($refreshToken)) {
            $updateData['spotifyAccessToken']  = $accessToken;
            $updateData['spotifyRefreshToken'] = $refreshToken;
            
            $settingModel->updateData($updateData);
        }
    }
    
    /**
     * Get recent tracks
     */
    public function getRecentTracks()
    {
        $settingModel       = new \App\Models\Setting();
        $trackModel         = new \App\Models\Track();
        $spotifyAccessToken = $settingModel->getByName('spotifyAccessToken')->value;
        
        $this->spotifyApi->setAccessToken($spotifyAccessToken);
        
        $recentTracks = $this->spotifyApi->getMyRecentTracks(['limit' => 50]);
        if (!empty($recentTracks)) {
            foreach ($recentTracks->items as $recentTrack) {
                $track      = $recentTrack->track; 
                $systemName = Track::generateSystemName($track->name);
               
                # If the track does not exists, add to database
                if (!Track::exists($systemName)) {                    
                    $data = [
                        'spotifyId'  => $track->id,
                        'name'       => $track->name,
                        'systemName' => $systemName,
                        'image'      => $track->album->images[0]->url,
                        'discNumber' => $track->disc_number,
                        'durationMs' => $track->duration_ms,
                        'popularity' => $track->popularity,
                    ];
                    
                    Track::add($data);
                }
                
                $savedTrack = Track::getBySystemName($systemName);
                
                # Save played track if not exists
                $correctTimezone  = new \DateTimeZone('Europe/Amsterdam');
                $adjustedDateTime = new \DateTime($recentTrack->played_at, $correctTimezone);
                $offset           = $correctTimezone->getOffset($adjustedDateTime);
                $interval         = \DateInterval::createFromDateString((string) $offset . 'seconds');
                $adjustedDateTime->add($interval);
                $playedAtTime     = $adjustedDateTime->format('Y-m-d H:i:s');
                $timestamp        = strtotime($playedAtTime);
                $date             = date('Y-m-d', $timestamp);
                
                if (!PlayedTrack::exists($timestamp, $savedTrack->trackId)) {
                   $data = [
                       'trackId'  => $savedTrack->trackId,
                       'playedAt' => $timestamp,
                       'date'     => $date
                   ];
                   
                   PlayedTrack::add($data);
                   
                }
                
                # Save the artist(s) if needed
                foreach ($track->artists as $artist) {
                    $spotifyArtist = $this->spotifyApi->getArtist($artist->id);
                    if (!Artist::exists($spotifyArtist->id)) {
                       $data = [
                           'name'       => $spotifyArtist->name,
                           'spotifyId'  => $spotifyArtist->id,
                           'image'      => $spotifyArtist->images[0]->url,
                           'popularity' => $spotifyArtist->popularity,
                           'followers'  => $spotifyArtist->followers->total,
                       ];
                       
                       Artist::add($data);
                    }
                }
            }
        }
    }
}