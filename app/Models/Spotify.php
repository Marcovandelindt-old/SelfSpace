<?php

namespace App\Models;

use CodeIgniter\Model;

class Spotify extends Model 
{
    # Image scopes
    const SCOPE_IMAGE_UPLOAD = 'ugc-image-upload';
    
    # Spotify Connect Scopes
    const SCOPE_USER_READ_PLAYBACK_STATE    = 'user-read-playback-state';
    const SCOPE_USER_MODIFY_PLAYBACK_STATE  = 'user-modify-playback-state';
    const SCOPE_USER_READ_CURRENTLY_PLAYING = 'user-read-currently-playing';
    
    # Playback Scopes
    const SCOPE_STREAMING          = 'streaming';
    const SCOPE_APP_REMOTE_CONTROL = 'app-remote-control';
    
    # User Scopes
    const SCOPE_USER_READ_EMAIL   = 'user-read-email';
    const SCOPE_USER_READ_PRIVATE = 'user-read-private';
    
    # Playlist Scopes
    const SCOPE_PLAYLIST_READ_COLLABORATIVE = 'playlist-read-collaborative';
    const SCOPE_PLAYLIST_MODIFY_PULIBC      = 'playlist-modify-public';
    const SCOPE_PLAYLIST_READ_PRIVATE       = 'playlist-read-private';
    const SCOPE_PLAYLIST_MODIFY_PRIVATE     = 'playlist-modify-private';
    
    # Library Scopes
    const SCOPE_LIBRARY_MODIFY = 'user-library-modify';
    const SCOPE_LIBRARY_READ   = 'user-library-read';
    
    # Listening History Scopes
    const SCOPE_USER_TOP_READ               = 'user-top-read';
    const SCOPE_USER_READ_PLAYBACK_POSITION = 'user-read-playback-position';
    const SCOPE_USER_READ_RECENTLY_PLAYED   = 'user-read-recently-played';
    
    # Follow Scopes
    const SCOPE_USER_FOLLOW_READ   = 'user-follow-read';
    const SCOPE_USER_FOLLOW_MODIFY = 'user-follow-modify';
}