<?php

    include __DIR__.'/../vendor/autoload.php';
    include 'common.php';

    suppressErrors();

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
        $searchUrl = "$base/search?part=snippet,id&fields=items%2Fid%2FvideoId,items%2Fsnippet%2Fdescription&order=date&channelId=$channelId&maxResult=$max_videos&key=$key";

        $res['videos'] = [];

        // Get videos
        $videos = json_decode(file_get_contents($searchUrl));

        if (!(array) $videos) {
            $res['error'] = "Couldn't get anything with this channel id";
        } else {
            foreach ($videos->items as $video) {
                $videoData = ['id' => $video->id->videoId, 'description' => $video->snippet->description];
                array_push($res['videos'], $videoData);
            }
        }
    } else {
        $res['error'] = "You haven't specified channel id in url";
    }

    // Output them
    echo json_encode($res);
