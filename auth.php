<?php
require __DIR__ . '/vendor/autoload.php';
Dotenv\Dotenv::createImmutable(__DIR__)->load();

function getSpotifyToken(){
  $session = new SpotifyWebAPI\Session(
      $_ENV['SPOTIFY_CLIENT_ID'],
      $_ENV['SPOTIFY_CLIENT_SECRET'],
      $_ENV['REDIRECT_URI']
  );

  $api = new SpotifyWebAPI\SpotifyWebAPI();

  if (isset($_GET['code'])) {
      $session->requestAccessToken($_GET['code']);
      $api->setAccessToken($session->getAccessToken());

  } else {
      header('Location: ' . $session->getAuthorizeUrl(array(
          'scope' => array(
              'playlist-read-private', 
              'playlist-read-collaborative',
              'user-library-read'
          )
      )));
      die();
  }
  return $api;
}