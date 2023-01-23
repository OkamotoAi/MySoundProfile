<?php
require __DIR__ . '/vendor/autoload.php';
require "class.php";
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>><?= APPNAME ?></title>
  <link rel="stylesheet" href="../bulma/css/bulma.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <a class="navbar-item" href="https://bulma.io">
        <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
      </a>

      <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
      <div class="navbar-start">
        <a class="navbar-item">
          Home
        </a>

        <a class="navbar-item" href="feature.php">
          Feature
        </a>

        <div class="navbar-item has-dropdown is-hoverable">
          <a class="navbar-link">
            More
          </a>

          <div class="navbar-dropdown">
            <a class="navbar-item">
              About
            </a>
            <a class="navbar-item">
              Jobs
            </a>
            <a class="navbar-item">
              Contact
            </a>
            <hr class="navbar-divider">
            <a class="navbar-item">
              Report an issue
            </a>
          </div>
        </div>
      </div>

      <div class="navbar-end">
        <div class="navbar-item">
          <div class="buttons">
            <a class="button is-primary">
              <strong>Sign up</strong>
            </a>
            <a class="button is-light">
              Log in
            </a>
          </div>
        </div>
      </div>
    </div>
  </nav>


  <h3 class="title m-5">お気に入りした曲一覧</h3>

  <?php
  $all = disp_savedSongs();
  ?>
  <div class="table-container">
    <table class="table is-narrow is-hoverable m-5">
      <tr>
        <th>曲名</th>
        <th>アーティスト</th>
        <th>人気</th>
        <th>キー</th>
        <th>調</th>
        <th>踊りやすさ</th>
        <th>アコースティック</th>
        <th>Energy</th>
        <th>インスト</th>
        <th>ライブ感</th>
        <th>音圧</th>
        <th>スピーチ感</th>
        <th>テンポ</th>
        <th>拍子</th>
        <th>ポジティブ</th>
      </tr>
      <?php foreach ($all as $row) { ?>
        <tr>
          <td><?= $row["name"] ?></td>
          <td><?= $row["artist"] ?></td>
          <td><?= $row["popularity"] ?></td>
          <td><?= $row["scale"] ?></td>
          <td><?= $row["mode"] ?></td>
          <td><?= $row["danceability"] ?></td>
          <td><?= $row["acousticness"] ?></td>
          <td><?= $row["energy"] ?></td>
          <td><?= $row["instrumentalness"] ?></td>
          <td><?= $row["liveness"] ?></td>
          <td><?= $row["loudness"] ?></td>
          <td><?= $row["speechiness"] ?></td>
          <td><?= $row["tempo"] ?></td>
          <td><?= $row["time_signature"] ?></td>
          <td><?= $row["valence"] ?></td>
        </tr>
      <?php } ?>
    </table>


</body>