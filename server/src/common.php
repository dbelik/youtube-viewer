<?php
    function channelIsSet() {
        return isset($_GET["channelId"]) && !empty($_GET["channelId"]);
    }

    function loadEnv() {
        $dotenv = new Symfony\Component\Dotenv\Dotenv();
        $dotenv->load(__DIR__.'/../.env');
    }