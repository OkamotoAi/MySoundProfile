<?php
require __DIR__ . '/vendor/autoload.php';
Dotenv\Dotenv::createImmutable(__DIR__)->load();

$session = new SpotifyWebAPI\Session(
  $_ENV['SPOTIFY_CLIENT_ID'],
  $_ENV['SPOTIFY_CLIENT_SECRET'],
  $_ENV['REDIRECT_URI']
);

$storedState = $session->generateState();
$options = [
  'scope' => [
    'playlist-read-private',
    'playlist-read-collaborative',
    'user-library-read'
  ],
  'state' => $storedState,
];

header('Location: ' . $session->getAuthorizeUrl($options));
die();
?>