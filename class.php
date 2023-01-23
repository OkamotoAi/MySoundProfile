<?php
require __DIR__ . '/vendor/autoload.php';
require "config.php";

// https://developer.spotify.com/console/get-current-user-saved-tracks/?market=JP&limit=&offset=
//  これでお気にいりした曲がとれる
// market:JP
// https://developer.spotify.com/documentation/web-api/reference/#/operations/get-users-top-artists-and-tracks
// これもつかえるかも 



// お気に入りした曲を取得，DBに登録する
function addSavedTracksToDB($api){
  $conn = db_conn();

  $tracks = $api->getMySavedTracks([
    'limit' => 5,
    'offset' => 0
  ]);

  // $features = $api->getMultipleAudioFeatures($tracks);

  foreach ($tracks->items as $track) {
    $track = $track->track;
    $features = $api->getAudioFeatures($track->id);

    $sql = "INSERT INTO music VALUES (";
    $sql .= "'" . cnv_sqlstr($track->id) . "',";
    $sql .= "'" . cnv_sqlstr($track->name) . "',";
    $sql .=  "'" . cnv_sqlstr($track->artists[0]->name) . "',";
    $sql .=  "'" . cnv_sqlstr($track->popularity) . "',";
    $sql .=  "'" . cnv_sqlstr($features->danceability) . "',";
    $sql .=  "'" . cnv_sqlstr($features->energy) . "',";
    $sql .=  "'" . cnv_sqlstr($features->key) . "',";
    $sql .=  "'" . cnv_sqlstr($features->loudness) . "',";
    $sql .=  "'" . cnv_sqlstr($features->mode) . "',";
    $sql .=  "'" . cnv_sqlstr($features->speechiness) . "',";
    $sql .=  "'" . cnv_sqlstr($features->acousticness) . "',";
    $sql .=  "'" . cnv_sqlstr($features->instrumentalness) . "',";
    $sql .=  "'" . cnv_sqlstr($features->liveness) . "',";
    $sql .=  "'" . cnv_sqlstr($features->valence) . "',";
    $sql .=  "'" . cnv_sqlstr($features->tempo) . "',";
    $sql .=  "'" . cnv_sqlstr($features->time_signature) . "'";
    $sql .= ")";

    $res =db_query($sql,$conn);
  }

}

// お気に入りした曲を表示する
function disp_savedSongs(){
  $conn = db_conn();

  $sql = "SELECT * FROM music";

  $res =db_query($sql,$conn);
  if($res == false){
      echo "<p>データは登録されていません";
      return;
  }else{
      $all = $res->fetch_all(MYSQLI_ASSOC);
  }
  return $all;
}

// 文字コード変換
function cnv_sqlstr($string) {
  // 文字コードを変換する
  $det_enc = mb_detect_encoding($string, "UTF-8, EUC-JP, SJIS");
  if ($det_enc and $det_enc != ENCDB) {
  $string = mb_convert_encoding($string,ENCDB,$det_enc);
  }
  //
  $string = addslashes($string);
  return $string;
}

//db接続
function db_conn(){
  $conn = new mysqli(DBSV,DBUSER,DBPASS,DBNAME);
  if($conn->connect_error){
      error_log($conn->connect_error);
      exit;
  }
  $conn->set_charset("utf8mb4");
  return $conn;
}

//SQL実行
function db_query($sql,$conn){
  $res = $conn->query($sql);
  return $res;
}