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
        $channelUrl = "$base/channels?part=snippet,statistics&id=$channelId&key=$key&fields=items%2Fsnippet%2Ftitle,items%2Fsnippet%2Fthumbnails%2Fdefault%2Furl,items%2Fstatistics%2FsubscriberCount";
        
        // Get channel info
        $channel = json_decode(file_get_contents($channelUrl));
        if (isset($videos->error)) {
            $res['error'] = "Couldn't get anything with this channel id";
        } else {
            $res["channel"] = $channel;
        }
    } else {
        $res['error'] = "You haven't specified channel id in url";
    }

    // Output them
    echo json_encode($res);