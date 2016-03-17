<?php

$content = generateHTMLStat('users', $lastStats->getNbusers(), $difStats->getNbusers());
$content .= generateHTMLStat('providers', $lastStats->getNbproviders(), $difStats->getNbproviders());
$content .= generateHTMLStat('searches', $lastStats->getNbsearch(), $difStats->getNbsearch());
$content .= generateHTMLStat('devices', $lastStats->getNbdevices(), $difStats->getNbdevices());
$content .= generateHTMLStat('links', $lastStats->getNblinks(), $difStats->getNblinks());
?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=0.7, user-scalable=no">
  <link type="text/css" rel="stylesheet" href="./view/app/bower_components/Materialize/bin/materialize.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="./view/app/bower_components/Materialize/extras/noUiSlider/nouislider.css">
  <link type="text/css" rel="stylesheet" href="./view/app/assets/css/style.css">
  <link type="text/css" rel="stylesheet" href="./view/app/assets/css/login.css">
  <link type="text/css" rel="stylesheet" href="./view/app/assets/css/stats.css">
  <!--link type="text/css" rel="stylesheet" href="./view/app/assets/css/page-center.css"-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style rel="./assets/css/login.css"></style>
  <style>
    html {
    height: 100%;
    }
    html {
      display: table;
      margin: auto;
    }
  
  </style>
</head>

<body>
  <header style="padding-left:0px">
      <?php require './view/app/navbar.php' ?>

  </header>
  <main style="padding-left:0px" class="valign-wrapper">
  <div class="container">
    <div class="row">
        <?php echo $content ?>
    </div>
  </div>
  </main>
  <script type="text/javascript" src="./view/app/bower_components/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript" src="./view/app/assets/js/lib/jquery.sparkline.min.js"></script>
</body>

</html>

<?php

function generateHTMLStat($title, $now, $diff){
    $color = 'redChange';
  if($diff>0) {
    $diff = '+'.$diff;
    $color = 'greenChange';
  }
  return "<div class='col s12 m6'>
            <div class='card-panel stat'>
            <h1>$title</h1>
            <h2>$now</h2>
            <span>$title</span>
            <h3 class='$color'>$diff</h3>
            <span class='change'>new $title for last week</span>
            </div>
          </div>
          ";
}


?>