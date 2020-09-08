<?php

/**
 * Calculate the total listening time for a day
 * 
 * @param array $todaysTracks
 * 
 * @return string
 * 
 */
function calculateTotalListeningTimeToday($todaysTracks)
{
    $totalMilliseconds = 0;
    if (!empty($todaysTracks)) {
        foreach ($todaysTracks as $todaysTrack) {
            $totalMilliseconds += $todaysTrack->durationMs;
        }
    }
    
    $totalSeconds = $totalMilliseconds / 1000;
    $totalTime    = gmdate('H:i:s', $totalSeconds);
    
    return $totalTime;
}

/**
 * Calculate the differen artists
 * 
 * @param array $todaysTracks
 * 
 * @return array
 */
function calculateTodaysDifferentArtists($todaysTracks) 
{
    if (!empty($todaysTracks)) {
        $todaysArtists = [];
        foreach ($todaysTracks as $todaysTrack) {
            $trackArtists     = \App\Models\Track::getArtists($todaysTrack->trackId);
            foreach ($trackArtists as $trackArtist) {
                $artist          = \App\Models\Artist::getById($trackArtist['artistId']);
                $todaysArtists[] = $artist->artistId;
            }
        }
        
        $uniqueArtists = array_unique($todaysArtists);
        return count($uniqueArtists);
    }
}