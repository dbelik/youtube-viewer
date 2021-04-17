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

    // Construct full urls that will be used to query data.
    $searchUrl = "$base/search?part=snippet,id&fields=items%2Fid%2FvideoId&order=date&channelId=$channelId&maxResult=$max_videos&key=$key";
    $channelUrl = "$base/channels?part=snippet&id=$channelId&key=$key";

    // Get videos
    $videos = json_decode(file_get_contents($searchUrl));
    $channel = json_decode(file_get_contents($channelUrl));

    // Store video ids
    $res = ["ids" => [], "channel" => []];

    foreach ($videos->items as $video) {
        array_push($res["ids"], $video->id->videoId);
    }

    $res["channel"] = $channel;

    // Output them
    header("Content-Type: application/json");
    echo json_encode($res);

    echo "<pre>";
    print_r($channel);