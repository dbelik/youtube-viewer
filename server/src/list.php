<?php

    include __DIR__.'/../vendor/autoload.php';

    // Read .env file.
    $dotenv = new Symfony\Component\Dotenv\Dotenv();
    $dotenv->load(__DIR__.'/../.env');

    // Set variables from .env
    $key = $_ENV['API_KEY'];
    $base = $_ENV['URL_BASE'];
    $max_videos = $_ENV['MAX_VIDEOS'];

    // Etc
    $channelId = 'UCqecwG03N62mRGzbrVkz3LQ';

    // Construct full url that will be used to query videos.
    $url = "$base/search?part=snippet&channelId=$channelId&maxResult=$max_videos&key=$key";

    // Get videos
    $content = json_decode(file_get_contents($url));

    // Store video ids
    $ids = [];

    foreach ($content->items as $video) {
        array_push($ids, $video->id->videoId);
    }

    // Output them
    echo json_encode($ids);
