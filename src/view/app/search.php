<?php
  function nvl($var){
    if (is_null($var)) {
        return '-';
    } else {
        return $var;
    }
  }

  function generateHTMLDevice($device){
    $brand = nvl($device->getBrand());
    $model = nvl($device->getModel());
    
    $price = nvl($device->getPrice());
    
    $batterycapacity = nvl($device->getBatteryCapacity());
    
    $storage = nvl($device->getStorage());
    $externalstorage = nvl($device->getExternalStorage());

    $software = nvl($device->getSoftware());
    
    $sizeheigh = nvl($device->getSizeHeigh());
    $sizewidth = nvl($device->getSizeWidth());
    $sizethickness = nvl($device->getSizeThickness());
    $weight = nvl($device->getWeight());
    
    $screendefinition = nvl($device->getScreenDefinition());
    $screenresolution = nvl($device->getScreenResolution());
    $screensize = nvl($device->getScreenSize());
    $screenpanel = nvl($device->getScreenPanel());
    
    $cpumodel = nvl($device->getCPUModel());
    $cpufrequency = nvl($device->getCPUFrequency());
    $cpucore = nvl($device->getCPUCore());
    $ram = nvl($device->getRAM());
    
    $cameraresolution = nvl($device->getCameraResolution());
    $frontcameraresolution = nvl($device->getFrontCameraResolution());
    $flash = nvl($device->getFlash());
        
    $warranty = nvl($device->getWarranty());
    $waterproof = nvl($device->getWaterproof());
    
 
    return '<div class="smartphone-prop-container">
          <div class="card">
            <div class="card-image">
              <img src="https://placeholdit.imgix.net/~text?txtsize=33&txt=...&w=350&h=500">
              <span class="card-title">'.$brand.' '.$model.'</span>
            </div>
            <div class="card-content" style="padding:0px">
              <ul class="collection with-header" style="margin:0px;">
                <li class="collection-header grey lighten-3">Price : '.$price.'</li>
                <li class="collection-header grey lighten-3">Battery</li>
                  <li class="collection-item">'.$batterycapacity.'</li>
                <li class="collection-header grey lighten-3">Storage and Memory</li>
                  <li class="collection-item">Storage : '.$storage.'</li>
                  <li class="collection-item">External Storage : '.$externalstorage.'</li>
                <li class="collection-header grey lighten-3">Connectivity</li>
                <li class="collection-header grey lighten-3">OS</li>
                  <li class="collection-item">'.$software.'</li>
                <li class="collection-header grey lighten-3">Size and Weight</li>
                  <li class="collection-item">Heigh : '.$sizeheigh.'</li>
                  <li class="collection-item">Width : '.$sizewidth.'</li>
                  <li class="collection-item">Thickness : '.$sizethickness.'</li>
                  <li class="collection-item">Weight : '.$weight.'</li>
                <li class="collection-header grey lighten-3">Display</li>
                  <li class="collection-item">Screen Definition : '.$screendefinition.'</li>
                  <li class="collection-item">Screen Resolution : '.$screenresolution.'</li>
                  <li class="collection-item">Screen Size : '.$screensize.'</li>
                  <li class="collection-item">Screen Panel : '.$screenpanel.'</li>
                <li class="collection-header grey lighten-3">Hardware</li>
                  <li class="collection-item">CPU Model : '.$cpumodel.'</li>
                  <li class="collection-item">CPU Frequency : '.$cpufrequency.'</li>
                  <li class="collection-item">Core : '.$cpucore.'</li>
                  <li class="collection-item">RAM : '.$ram.'</li>
                <li class="collection-header grey lighten-3">Camera</li>
                  <li class="collection-item">Resolution : '.$cameraresolution.'</li>
                  <li class="collection-item">Front Camera Resolution : '.$frontcameraresolution.'</li>
                  <li class="collection-item">Flash : '.$flash.'</li>
                <li class="collection-header grey lighten-3">Additional Informations</li>
                  <li class="collection-item">Waterproof : '.$waterproof.'</li>
                  <li class="collection-item">Warranty : '.$warranty.'</li>
              </ul>
            </div>
            <div class="card-action">
              <a class="waves-effect waves-light btn" style="width:100%" href="#">Contacter</a>
            </div>
            <div class="card-action">
              <a class="waves-effect waves-light btn" style="width:100%" href="#">Acheter</a>
            </div>
          </div>
        </div>';
  }

  function generateHTMLSelect($label, $name, $values){
    $result = '';
    $result = $result . '<div class="input-wrapper">';
    $result = $result . '<div class="input-field col s12">';
    $result = $result . '<select name="'.$name.'" onChange="addSelectCriteria(\''.$name.'\', this)">';

    foreach ($values as $value){
      $result = $result . '<option value="'.$value[0].'">'.$value[0].'</option>';
    }
    
    $result = $result . '</select>';
    $result = $result . '<label>'.$label.'</label>';
    $result = $result . '</div>';
    $result = $result . '</div>';
    
    return $result;
   }
?>

<html>

<head>
  <title>Materialize CSS Framework Demo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link type="text/css" rel="stylesheet" href="./view/app/bower_components/Materialize/bin/materialize.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="./view/app/bower_components/Materialize/extras/noUiSlider/nouislider.css">
  <link type="text/css" rel="stylesheet" href="./view/app/assets/css/style.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
  <header>
    <nav class="grey">
      <a href="#" data-activates="slide-out" class="button-collapse">
        <i class="medium material-icons">search</i>
      </a>
      <div class="nav-wrapper right" style="padding-right:16px">
        <!--
          <a class="btn-floating waves-effect waves-light red" href="#"></a>
          <a class="btn-floating waves-effect waves-light red" href="#"></a>
        -->
        <button data-target="login" class="btn modal-trigger" style="margin-top:6px">Login</button>
      </div>
    </nav>
    <form action="/comparofone/src/?page=search" method="GET">
    <input type="hidden" name="search">
    <ul id="slide-out" class="side-nav fixed">
      <li class="logo">
        <a href="#" title="logo" id="logo-container">
          <img src="./view/app/assets/img/logo.png" alt="">
        </a>
      </li>

      <li class="input">
        <div class="input-wrapper">
          <div class="input-field col s12">
            <div class="sliders" id="price-slider"></div>
            <label>Price</label>
            <p style="margin-bottom:1.5em"></p>
          </div>
        </div>
      </li>
      <li class="input"><?php echo generateHTMLSelect('Brand',                'brand',            $allBrand);?></li>
      <li class="input"><?php echo generateHTMLSelect('Waterproofs',          'waterproof',       $allWaterproofs);?></li>
      <li class="input"><?php echo generateHTMLSelect('ScreenDefinitions',    'screenDefinition', $allScreenDefinitions);?></li>
      <li class="input"><?php echo generateHTMLSelect('ScreenPanels',         'screenPanel',      $allScreenPanels);?></li>
      <li class="input"><?php echo generateHTMLSelect('CPUModels',            'CPUModel',         $allCPUModels);?></li>
      <li class="input"><?php echo generateHTMLSelect('Softwares',            'software',         $allSoftwares);?></li>
      <li class="input"><?php echo generateHTMLSelect('Softwares',            'software',         $allSoftwares);?></li>
      <li class="input"><?php echo generateHTMLSelect('Softwares',            'software',         $allSoftwares);?></li>
    </ul>
      
    </form>
    
  </header>
  <main>
    <div class="smartphone-container">
      <div class="vertical-scroll-container">
        <div class="smartphone-prop-container">
          <div class="card" style="width:320px;">
            <div class="card-content" style="padding:0px">
              <ul class="collection with-header" style="margin:0px;">
                <li class="collection-header grey lighten-3">Your search</li>
                <li class="collection-item">
                  <a class="waves-effect waves-light btn" style="width:100%" href="#">Valider</a>
                </li>
                <ul class="collapsible" data-collapsible="accordion">
                  <li>
                    <div class="collapsible-header"><i class="material-icons">filter_drama</i>First</div>
                    <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
                  </li>
                  <li>
                    <div class="collapsible-header"><i class="material-icons">place</i>Second</div>
                    <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
                  </li>
                  <li>
                    <div class="collapsible-header"><i class="material-icons">whatshot</i>Third</div>
                    <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
                  </li>
                </ul>
                <div id="criterias">
                  
                </div>
              </ul>
            </div>
          </div>
        </div>
        
        
        <?php 
          if ($resultResearchDevices != NULL){
            foreach ($resultResearchDevices as $device) {
              echo generateHTMLDevice($device);
            }
           }
        ?>
      </div>
  </main>
    
 <?php require './view/app/login-modal.php'; ?>
    
<!-- jQuery is required by Materialize to function -->
  <script type="text/javascript" src="./view/app/bower_components/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript" src="./view/app/bower_components/Materialize/bin/materialize.js"></script>
  <script type="text/javascript" src="./view/app/bower_components/Materialize/extras/noUiSlider/nouislider.min.js"></script>

    
  <script type="text/javascript" src="http://localhost:8080/test.js"></script>
  <script type="text/javascript">
  $(".button-collapse").sideNav();
  $(document).ready(function() {
      $('select').material_select();
  });
  var slider = document.getElementById('price-slider');
  noUiSlider.create(slider, {
      start: [0, 100],
      connect: true,
      step: 1,
      range: {
          'min': 0,
          'max': 100
      },
      format: wNumb({
          decimals: 0
      })
  });

  $('.modal-trigger').leanModal({
      dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: .5, // Opacity of modal background
      in_duration: 300, // Transition in duration
      out_duration: 200, // Transition out duration
      ready: function() {}, // Callback for Modal open
      complete: function() {} // Callback for Modal close
  });
  </script>
</body>

</html>