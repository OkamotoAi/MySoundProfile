<?php
require __DIR__ . '/vendor/autoload.php';
require "class.php";
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>><?= APPNAME ?></title>
  <link rel="stylesheet" href="./bulma/css/bulma.min.css">
  <link rel="stylesheet" href="./static/feature.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="./fontawesome-free-6.2.1-web/css/fontawesome.css" rel="stylesheet">
  <link href="./fontawesome-free-6.2.1-web/css/brands.css" rel="stylesheet">
  <link href="./fontawesome-free-6.2.1-web/css/solid.css" rel="stylesheet">

</head>

<body>
  <nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <a class="navbar-item" href="main.php">
        <img src="./static/logo.png" width="200">
      </a>

      <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
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

  <?php
  $all = disp_savedSongs();
  $ave = calc_feature_average();
  ?>
  <div class="table-container">
    <table class="table is-narrow is-hoverable m-5">
      <tr>
        <th class="b">曲名</th>
        <th class="b">アーティスト</th>
        <th class="v">人気 <span class="icon has-text-info">
            <i class="fas fa-info-circle"></i>
            <p class="tooltip">アーティストの人気度を表します。値は0から100の間で、100が最も人気があります。アーティストの人気度は、そのアーティストの全楽曲の人気度から計算されます。</p>
          </span></th>
        <th class="v">キー<span class="icon has-text-info">
            <i class="fas fa-info-circle"></i>
            <p class="tooltip">トラックが置かれているキー。整数は、標準的なピッチクラス表記でピッチにマッピングされます。例：0=C、1 = C♯/D♭、2 = D、など。キーが検出されなかった場合、値は-1です。</p>
          </span></th>
        <th class="v">調<span class="icon has-text-info">
            <i class="fas fa-info-circle"></i>
            <p class="tooltip">調は、楽曲の旋律がどのような音階で構成されているかを表すモダリティ（メジャーまたはマイナー）です。メジャーは1、マイナーは0で表します。</p>
          </span></th>
        <th class="v">ダンス性<span class="icon has-text-info">
            <i class="fas fa-info-circle"></i>
            <p class="tooltip">ダンス性は、テンポ、リズムの安定性、ビートの強さ、全体的な規則性などの音楽要素の組み合わせに基づいて、トラックがダンスに適しているかを説明します。1.0が最もダンスに適しています。</p>
          </span></th>
        <th class="v">アコースティック性<span class="icon has-text-info">
            <i class="fas fa-info-circle"></i>
            <p class="tooltip">トラックがアコースティックであるかどうかの0.0から1.0までの信頼性の尺度です。1.0は、そのトラックがアコースティックであるという高い信頼性を表します。</p>
          </span></th>
        <th class="v">エネルギー<span class="icon has-text-info">
            <i class="fas fa-info-circle"></i>
            <p class="tooltip">エネルギーは0.0から1.0までの値で、強度と活動性の知覚的な尺度を表します。一般的に、エネルギーが高い曲は、速く、派手で、騒がしい感じがします。例えば、デスメタルのエネルギーは高く、バッハの前奏曲のエネルギーは低くなります。この属性に寄与する知覚的特徴には、ダイナミックレンジ、知覚的ラウドネス、音色、オンセットレート、および一般的なエントロピーが含まれます。</p>
          </span></th>
        <th class="v">楽器演奏性<span class="icon has-text-info">
            <i class="fas fa-info-circle"></i>
            <p class="tooltip">トラックにボーカルが含まれていないかどうかを予測します。"Ooh "と "aah"の音は、この文脈では楽器として扱われます。ラップや話し言葉のトラックは明らかに「ボーカル」です。楽器演奏性が1.0に近いほど、そのトラックにはボーカルコンテンツが含まれない可能性が高くなります。0.5以上の値はインスト曲を表すことを意図していますが、値が1.0に近づくほど信頼度は高くなります。</p>
          </span></th>
        <th class="v">ライブ性<span class="icon has-text-info">
            <i class="fas fa-info-circle"></i>
            <p class="tooltip">録音に聴衆が存在するかどうかを検出します。ライブ性が高いほど、そのトラックがライブで演奏された可能性が高くなることを表します。0.8以上の値は、そのトラックがライブである可能性が高いことを示します。</p>
          </span></th>
        <th class="v">音圧<span class="icon has-text-info">
            <i class="fas fa-info-circle"></i>
            <p class="tooltip">トラックの全体的なラウドネスをデシベル（dB）で表示します。ラウドネス値はトラック全体の平均であり、トラックの相対的なラウドネスを比較するのに便利です。ラウドネスとは、物理的な強さ（振幅）の主要な心理的相関関係である音の質のことです。値は通常、-60～0dbの範囲です。</p>
          </span></th>
        <th class="v">スピーチ性<span class="icon has-text-info">
            <i class="fas fa-info-circle"></i>
            <p class="tooltip">スピーチ性は、トラック内の話し言葉の存在を検出します。音声のみの録音（トークショー、オーディオブック、詩など）であればあるほど、属性値は1.0に近くなります。0.66を超える値は、おそらく完全に話し言葉で構成されているトラックを表します。0.33から0.66の間の値は、音楽と音声の両方が部分的または層状に含まれている可能性があるトラックを表し、ラップ音楽などのケースも含まれます。0.33以下の値は、音楽とその他の非音声的なトラックを表している可能性が高いです。</p>
          </span></th>
        <th class="v">テンポ<span class="icon has-text-info">
            <i class="fas fa-info-circle"></i>
            <p class="tooltip">曲の全体的な推定テンポを1分あたりの拍数（BPM）で表します。音楽用語では、テンポは楽曲の速度またはペースであり、平均的なビート持続時間から直接導き出されます。</p>
          </span></th>
        <th class="v">拍子<span class="icon has-text-info">
            <i class="fas fa-info-circle"></i>
            <p class="tooltip">拍子記号の推定値です。拍子記号（メーター）とは、各小節（またはメジャー）に何拍子あるかを指定するための表記法です。拍子記号は3から7まであり、3/4から7/4までの拍子記号があります。</p>
          </span></th>
        <th class="v">ポジティブ<span class="icon has-text-info">
            <i class="fas fa-info-circle"></i>
            <p class="tooltip">0.0から1.0までの値で、楽曲が伝える音楽的なポジティブさを表現します。値が高いトラックはよりポジティブに聞こえ（例：幸せ、陽気、多幸感）、値が低いトラックはよりネガティブに聞こえる（例：悲しい、落ち込む、怒る）。</p>
          </span></th>
      </tr>
      <tr>
        <td class="has-text-weight-semibold">平均値</td>
        <td></td>
        <td><?= $ave[0]["AVG(`popularity`)"] ?></td>
        <td><?= $ave[0]["AVG(`scale`)"] ?></td>
        <td><?= $ave[0]["AVG(`mode`)"] ?></td>
        <td><?= $ave[0]["AVG(`danceability`)"] ?></td>
        <td><?= $ave[0]["AVG(`acousticness`)"] ?></td>
        <td><?= $ave[0]["AVG(`energy`)"] ?></td>
        <td><?= $ave[0]["AVG(`instrumentalness`)"] ?></td>
        <td><?= $ave[0]["AVG(`liveness`)"] ?></td>
        <td><?= $ave[0]["AVG(`loudness`)"] ?></td>
        <td><?= $ave[0]["AVG(`speechiness`)"] ?></td>
        <td><?= $ave[0]["AVG(`tempo`)"] ?></td>
        <td><?= $ave[0]["AVG(`time_signature`)"] ?></td>
        <td><?= $ave[0]["AVG(`valence`)"] ?></td>
      </tr>
      <!-- 区切りのため -->
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
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