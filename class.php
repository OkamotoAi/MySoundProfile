<?php
require __DIR__ . '/vendor/autoload.php';
require "config.php";

// お気に入りした曲を表示する
function disp_savedSongs()
{
  $conn = db_conn();

  $sql = "SELECT * FROM music";

  $res = db_query($sql, $conn);
  if ($res == false) {
    // echo "<p>データは登録されていません";
    return;
  } else {
    $all = $res->fetch_all(MYSQLI_ASSOC);
    //小数点第2位まで．0はとる
    foreach ($all as &$row) {
      $row["name"] =  $row["name"];
      $row["artist"] = $row["artist"];
      $row["popularity"] = $row["popularity"];
      $row["scale"] = $row["scale"];
      $row["mode"] = $row["mode"];
      $row["danceability"] = preg_replace("/\.?0+$/", "", number_format($row["danceability"], 2));
      $row["acousticness"] = preg_replace("/\.?0+$/", "", number_format($row["acousticness"], 2));
      $row["energy"] = preg_replace("/\.?0+$/", "", number_format($row["energy"], 2));
      $row["instrumentalness"] = preg_replace("/\.?0+$/", "", number_format($row["instrumentalness"], 2));
      $row["liveness"] = preg_replace("/\.?0+$/", "", number_format($row["liveness"], 2));
      $row["loudness"] = preg_replace("/\.?0+$/", "", number_format($row["loudness"], 2));
      $row["speechiness"] = preg_replace("/\.?0+$/", "", number_format($row["speechiness"], 2));
      $row["tempo"] = preg_replace("/\.?0+$/", "", number_format($row["tempo"]));
      $row["time_signature"] = $row["time_signature"];
      $row["valence"] = preg_replace("/\.?0+$/", "", number_format($row["valence"], 2));
    }

  return $all;
  }
}

function calc_feature_average()
{
  $conn = db_conn();
  $sql = "SELECT AVG(`popularity`),AVG(`danceability`),AVG(`energy`),AVG(`scale`),AVG(`loudness`),AVG(`mode`),AVG(`speechiness`),AVG(`acousticness`),AVG(`instrumentalness`),AVG(`liveness`),AVG(`valence`),AVG(`tempo`),AVG(`time_signature`) FROM `music`";

  $res = db_query($sql, $conn);

  if ($res == false) {
    // echo "<p>データは登録されていません";
    return;
  } else {
    $ave = $res->fetch_all(MYSQLI_ASSOC);
    foreach ($ave as &$row) {
      $row["AVG(`popularity`)"] = preg_replace("/\.?0+$/", "", number_format($row["AVG(`popularity`)"]));
      $row["AVG(`scale`)"] = preg_replace("/\.?0+$/", "", number_format($row["AVG(`scale`)"]));
      $row["AVG(`mode`)"] = preg_replace("/\.?0+$/", "", number_format($row["AVG(`mode`)"]));
      $row["AVG(`danceability`)"] = preg_replace("/\.?0+$/", "", number_format($row["AVG(`danceability`)"], 2));
      $row["AVG(`acousticness`)"] = preg_replace("/\.?0+$/", "", number_format($row["AVG(`acousticness`)"], 2));
      $row["AVG(`energy`)"] = preg_replace("/\.?0+$/", "", number_format($row["AVG(`energy`)"], 2));
      $row["AVG(`instrumentalness`)"] = preg_replace("/\.?0+$/", "", number_format($row["AVG(`instrumentalness`)"], 2));
      $row["AVG(`liveness`)"] = preg_replace("/\.?0+$/", "", number_format($row["AVG(`liveness`)"], 2));
      $row["AVG(`loudness`)"] = preg_replace("/\.?0+$/", "", number_format($row["AVG(`loudness`)"], 2));
      $row["AVG(`speechiness`)"] = preg_replace("/\.?0+$/", "", number_format($row["AVG(`speechiness`)"], 2));
      $row["AVG(`tempo`)"] = preg_replace("/\.?0+$/", "", number_format($row["AVG(`tempo`)"]));
      $row["AVG(`time_signature`)"] = preg_replace("/\.?0+$/", "", number_format($row["AVG(`time_signature`)"]));
      $row["AVG(`valence`)"] = preg_replace("/\.?0+$/", "", number_format($row["AVG(`valence`)"], 2));
    }
  }
  return $ave;
}

// 文字コード変換
function cnv_sqlstr($string)
{
  // 文字コードを変換する
  $det_enc = mb_detect_encoding($string, "UTF-8, EUC-JP, SJIS");
  if ($det_enc and $det_enc != ENCDB) {
    $string = mb_convert_encoding($string, ENCDB, $det_enc);
  }
  //
  $string = addslashes($string);
  return $string;
}

//db接続
function db_conn()
{
  $conn = new mysqli(DBSV, DBUSER, DBPASS, DBNAME);
  if ($conn->connect_error) {
    error_log($conn->connect_error);
    exit;
  }
  $conn->set_charset("utf8mb4");
  return $conn;
}

//SQL実行
function db_query($sql, $conn)
{
  $res = $conn->query($sql);
  return $res;
}