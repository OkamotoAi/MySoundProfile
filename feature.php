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
  <link rel="stylesheet" href="./css/feature.css">
  <meta name="viewport"
    content="width=device-width, initial-scale=1">
</head>

<body>
  <nav class="navbar" role="navigation"
    aria-label="main navigation">
    <div class="navbar-brand">
      <a class="navbar-item" href="https://bulma.io">
        <img src="https://bulma.io/images/bulma-logo.png"
          width="112" height="28">
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
        <th class="v">人気</th>
        <th class="v">キー</th>
        <th class="v">調</th>
        <th class="v">踊りやすさ</th>
        <th class="v">アコースティック</th>
        <th class="v">エネルギー</th>
        <th class="v">インスト</th>
        <th class="v">ライブ感</th>
        <th class="v">音圧</th>
        <th class="v">スピーチ感</th>
        <th class="v">テンポ</th>
        <th class="v">拍子</th>
        <th class="v">ポジティブ</th>
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