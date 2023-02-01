<?php
require __DIR__ . '/vendor/autoload.php';
require_once "class.php";
require_once "config.php";
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>><?= APPNAME ?></title>
  <link rel="stylesheet" href="../bulma/css/bulma.min.css">
  <meta name="viewport"
    content="width=device-width, initial-scale=1">
</head>

<body>
  <nav class="navbar" role="navigation"
    aria-label="main navigation">
    <div class="navbar-brand">
      <a class="navbar-item" href="main.php">
        <img src="./css/logo.png" width="200">
      </a>

      <a role="button" class="navbar-burger"
        aria-label="menu" aria-expanded="false"
        data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
      <div class="navbar-start">
        <a class="navbar-item" href="main.php">
          Home
        </a>

        <a class="navbar-item" href="feature.php">
          Feature
        </a>

      </div>

    </div>
  </nav>


  <h3 class="title m-5">お気に入りした曲一覧</h3>
  <a href="auth.php" class="button is-primary m-5">
    楽曲を取得する</a>

  <?php
  $all = disp_savedSongs();
  ?>
  <div class="columns">
    <table
      class="table is-narrow is-hoverable m-5 column is-11">
      <tr>
        <th width=10%>ID</th>
        <th width=45%>曲名</th>
        <th width=45%>アーティスト</th>
      </tr>
      <?php foreach ($all as $row) { ?>
      <tr>
        <td><?= $row["music_id"] ?></td>
        <td><?= $row["name"] ?></td>
        <td><?= $row["artist"] ?></td>
      </tr>
      <?php } ?>
    </table>


</body>