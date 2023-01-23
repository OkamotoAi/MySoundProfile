<?php
require __DIR__ . '/vendor/autoload.php';
require "class.php";

Dotenv\Dotenv::createImmutable(__DIR__)->load();

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


?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>><?=APPNAME?></title>
    <link rel ="stylesheet" href="../bootstrap-4.5.0-dist/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>

    お気に入りした曲一覧
    <?php 
    addSavedTracksToDB($api);
    $all = disp_savedSongs();
    
    ?>
    <table class="table table-sm w-75 table-striped">
    <tr>
    <td class="mx-auto" width=10%> </td>
    <td class="mx-auto" width=10%>id</td>
    <td class="mx-auto" width=40%>曲名</td>
    <td class="mx-auto" width=40%>アーティスト</td>
    </tr>
    <?php foreach($all as $row){ ?>
    <tr>
    <td>
        <table class="table w-75 table-striped">
        <tr>
        <form method="POST" action="<?=$_SERVER["SCRIPT_NAME"]?>">
        <td><input type="submit"  class="btn btn-primary btn-sm" value="編集"></td>
        <!--管理-->
        <input type="hidden" name="act" value="upd">
        <!--キー-->
        <input type="hidden" name="id" value="<?=$row["id"]?>">
        </form>
        <form method="POST" action="<?=$_SERVER["SCRIPT_NAME"]?>">
        <td><input type="submit" class="btn btn-danger btn-sm" value="削除"></td>
        <!--管理-->
        <input type="hidden" name="act" value="delconf">
        <!--キー-->
        <input type="hidden" name="id" value="<?=$row["id"]?>">
        </form>
        </tr>
        </table>
    </td>
    <td style="word-break:breal-all;"><?=$row["id"]?></td>
    <td style="word-break:breal-all;"><?=$row["name"]?></td>
    <td style="word-break:breal-all;"><?=$row["artist"]?></td>
    </tr>
    <?php } ?>
    </table>


</body>