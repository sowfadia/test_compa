<?php
  function nvl($var){
    if (is_null($var)) return '-';
    return $var;
  }

  function generateHTMLDevice($device){
    $id = nvl($device->getId());
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
    $provider = nvl($device->getProvider());
    
 
    return '<div class="smartphone-prop-container">
          <div class="card">
            <div class="card-image">
              <img src="https://placeholdit.imgix.net/~text?txtsize=33&txt=...&w=350&h=500">
              <p class="card-title">'.$brand.'<br>'.$model.'</p>
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

  function generateHTMLSlider($label, $name){
    $result = '';
    $result .= '<div class="input-wrapper">';
    $result .= '<div class="input-field col s12">';
    $result .= '<div class="sliders" id="'. $name . '-slider"></div>';
    $result .= '<label>' . $label . '</label>';
    $result .= '<p style="margin-bottom:1.5em"></p>';
    $result .= '</div>';
    $result .= '</div>'; 

    return $result;
  }

  function generateJSMinMax($field, $values){

    $result = '';
    $result .= 'var slider_' . $field . ' = document.getElementById("' . $field . '-slider");' ;
    $result .= 'noUiSlider.create(slider_' . $field . ', {';
    $result .= 'start: [' . $values['minvalue'] . ', ' . $values['maxvalue'] . '],';
    $result .= 'connect: true,';
    $result .= 'step: 1,';
    $result .= 'range: {';
    $result .= '\'min\': ' . $values['minvalue'] . ',';
    $result .= '\'max\': ' . $values['maxvalue'];
    $result .= '},';
    $result .= 'format: wNumb({decimals: 0})';
    $result .= '});';

    $result .= 'slider_' . $field . '.noUiSlider.on("slide", function(event, values) {';
    $result .= 'addSliderCriteria("' . $field . 'min", slider_' . $field . '.noUiSlider.get()[0]);';
    $result .= 'addSliderCriteria("' . $field . 'max", slider_' . $field . '.noUiSlider.get()[1]);';
    
    $result .= '});';


    return $result;
  }
?>

  <html>

  <head>
    <title>Comparofone des familles</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link type="text/css" rel="stylesheet" href="./view/app/bower_components/Materialize/bin/materialize.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="./view/app/bower_components/Materialize/extras/noUiSlider/nouislider.css">
    <link type="text/css" rel="stylesheet" href="./view/app/assets/css/style.css">
    <link type="text/css" rel="stylesheet" href="./view/app/assets/css/lib/perfect-scrollbar.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>

  <body>
    <header>
      <nav class="grey">
        <a href="#" data-activates="slide-out" class="button-collapse">
          <i class="medium material-icons">search</i>
        </a>
        <div class="nav-wrapper">
          <ul class="right hide-on-med-and-down">
            <li>
              <?php 
                if (!isset($_SESSION['id'])){
                  echo '<a href="/src/?page=login" data-activates="chat-out" class="waves-effect waves-block waves-light chat-collapse">Sign In</a>';
                }
                else {
                  echo '<a href="/src/?page=logout" data-activates="chat-out" class="waves-effect waves-block waves-light chat-collapse">Sign Out</a>';
                }
              ?>
            </li>
          </ul>
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
            <?php echo generateHTMLSlider('Price', 'price'); ?>
          </li>
          <li class="input">
            <?php echo generateHTMLSlider('Screen Resolution', 'screenresolution'); ?>
          </li>
          <li class="input">
            <?php echo generateHTMLSlider('Screen Size', 'screensize'); ?>
          </li>
          <li class="input">
            <?php echo generateHTMLSlider('CPU Frequency', 'cpufrequency'); ?>
          </li>
          <li class="input">
            <?php echo generateHTMLSlider('CPU Core', 'cpucore'); ?>
          </li>
          <li class="input">
            <?php echo generateHTMLSlider('Ram', 'ram'); ?>
          </li>
          <li class="input">
            <?php echo generateHTMLSlider('Camera Resolution', 'cameraresolution'); ?>
          </li>
          <li class="input">
            <?php echo generateHTMLSlider('Front Camera Resolution', 'frontcameraresolution'); ?>
          </li>
          <li class="input">
            <?php echo generateHTMLSlider('Heigh', 'sizeheigh'); ?>
          </li>
          <li class="input">
            <?php echo generateHTMLSlider('Width', 'sizewidth'); ?>
          </li>
          <li class="input">
            <?php echo generateHTMLSlider('Thickness', 'sizethickness'); ?>
          </li>
          <li class="input">
            <?php echo generateHTMLSlider('Weith', 'weight'); ?>
          </li>
          <li class="input">
            <?php echo generateHTMLSlider('Battery Capacity', 'batterycapacity'); ?>
          </li>
          <li class="input">
            <?php echo generateHTMLSlider('Storage', 'storage'); ?>
          </li>


          <li class="input">
            <?php echo generateHTMLSelect('Brand',               'brand',            $allBrand);?>
          </li>
          <li class="input">
            <?php echo generateHTMLSelect('Waterproof',          'waterproof',       $allWaterproofs);?>
          </li>
          <li class="input">
            <?php echo generateHTMLSelect('Screen Definition',   'screendefinition', $allScreenDefinitions);?>
          </li>
          <!--li class="input"><?php echo generateHTMLSelect('ScreenPanels',     'screenpanel',      $allScreenPanels);?></li-->
          <li class="input">
            <?php echo generateHTMLSelect('CPU Model',           'cpumodel',         $allCPUModels);?>
          </li>
          <li class="input">
            <?php echo generateHTMLSelect('OS',                  'software',         $allSoftwares);?>
          </li>
        </ul>

      </form>

    </header>
    <main>
      <div class="smartphone-container">
        <div class="criteria-prop-container">
          <div class="card" style="width:320px;">
            <div class="card-content" style="padding:0px">
              <form action=".">
                <ul class="collection with-header collapsible" style="margin:0px;">
                  <li class="collection-header grey lighten-3">Your search</li>
                  <li class="collection-item">
                    <button class="btn waves-effect waves-light" style="width:100%" type="submit" name="search">Submit
                       <i class="material-icons right">search</i>
                     </button>
                  </li>
                  <li>
                    <div class="collapsible-header"><i class="material-icons">reorder</i>Criterias</div>
                    <div class="collapsible-body" id="criterias">
                      <p>
                        There is no critera selected yet.
                      </p>
                    </div>
                  </li>
                  <li>
                    <div class="collapsible-header"><i class="material-icons">swap_vert</i>Sorting</div>
                    <div class="collapsible-body">
                      <p>No sorting filter added yet.</p>
                    </div>
                  </li>
                </ul>
              </form>
            </div>
          </div>
        </div>
        <div class="vertical-scroll-container">



          <?php 
          if ($resultResearchDevices != NULL){
            foreach ($resultResearchDevices as $device) {
              echo generateHTMLDevice($device);
            }
           }
        ?>
        </div>
    </main>

    <!-- jQuery is required by Materialize to function -->
    <script type="text/javascript" src="./view/app/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="./view/app/bower_components/Materialize/bin/materialize.js"></script>
    <script type="text/javascript" src="./view/app/bower_components/Materialize/extras/noUiSlider/nouislider.min.js"></script>
    <script type="text/javascript" src="./view/app/assets/js/lib/perfect-scrollbar.min.js"></script>
    <script type="text/javascript" src="./view/app/assets/js/main.js"></script>
    <script type="text/javascript">
      $(".button-collapse").sideNav();
      $(document).ready(function() {
        $('select').material_select();
      });
      <?php 
      echo generateJSMinMax('price', $minMaxPrice);
      echo generateJSMinMax('screenresolution', $minMaxScreenResolution);
      echo generateJSMinMax('screensize', $minMaxScreenSize);
      echo generateJSMinMax('cpufrequency', $minMaxCPUFrequency);
      echo generateJSMinMax('cpucore', $minMaxCPUCore);
      echo generateJSMinMax('ram', $minMaxRAM);
      echo generateJSMinMax('cameraresolution', $minMaxCameraResolution);
      echo generateJSMinMax('frontcameraresolution', $minMaxFrontCameraResolution);
      echo generateJSMinMax('sizeheigh', $minMaxSizeHeigh);
      echo generateJSMinMax('sizewidth', $minMaxSizeWidth);
      echo generateJSMinMax('sizethickness', $minMaxSizeThickness);
      echo generateJSMinMax('weight', $minMaxWeight);
      echo generateJSMinMax('batterycapacity', $minMaxBatteryCapacity);
      echo generateJSMinMax('storage', $minMaxStorage);
      ?>
    </script>
  </body>

  </html>