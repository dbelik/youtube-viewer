<?php

    include __DIR__.'/../vendor/autoload.php';
    include 'common.php';

    // Store video ids
    $res = [];

    if (channelIsSet()) {
        // Extract channel id from url
        $channelId = $_GET['channelId'];

        // Read .env file.
        loadEnv();
    
        // Set variables from .env
        $key = $_ENV['API_KEY'];
        $base = $_ENV['URL_BASE'];
        $max_videos = $_ENV['MAX_VIDEOS'];
    
        // Construct full urls that will be used to query data.
        $searchUrl = "$base/search?part=snippet,id&fields=items%2Fid%2FvideoId&order=date&channelId=$channelId&maxResult=$max_videos&key=$key";

        $res["ids"] = [];

        // Get videos
        $videos = json_decode(file_get_contents($searchUrl));

        if (!(array)$videos) {
            $res['error'] = "Couldn't get anything with this channel id";
        } else {
            foreach ($videos->items as $video) {
                array_push($res["ids"], $video->id->videoId);
            }
        }
    } else {
        $res['error'] = "You haven't specified channel id in url";
    }
    
    // Output them
    echo json_encode($res);