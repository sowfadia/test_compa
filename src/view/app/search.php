<?php
  function nvl($var){
    if (is_null($var)) return '-';
    return $var;
  }

  function generateHTMLDevice($device){
    //$image = 'http://media.ldlc.com/ld/products/00/02/84/13/LD0002841308_1.jpg';
    $image = nvl($device->getImage());
    if ($image == '-') $image = 'https://placeholdit.imgix.net/~text?txtsize=33&txt=...&w=350&h=500';

    $id = nvl($device->getId());
    $brand = nvl($device->getBrand());
    $model = nvl($device->getModel());
    
    $price = nvl($device->getPrice());
    
    $batterycapacity = nvl($device->getBatteryCapacity());
    
    $storage = nvl($device->getStorage());
    $externalstorage = nvl($device->getExternalStorage());
    if($externalstorage){
      $externalstorage = "yes";
    }else{
      $externalstorage = 'no';
    }

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
    if($flash){
      $flash = "yes";
    }else{
      $flash = 'no';
    }
        
    $warranty = nvl($device->getWarranty());
    $waterproof = nvl($device->getWaterproof());
    $provider = nvl($device->getProvider());
    $link = $device->getIdFromProvider();
    $buylink = "";

    if (isset($_SESSION['id'])){
      $buylink = '/src/?page=links&idProvider='. $provider .'&redirect='. $link .'&idUser='. $_SESSION['id'];
    }
    else {
      $buylink = '/src/?page=links&idProvider='. $provider .'&redirect='. $link;
    }
    
 
    return '<div class="smartphone-prop-container">
          <div class="card">
          <div class="card-content" style="padding:0px;">
            <ul class="collection with-header" style="margin:0px; border: 0px;">
              <li class="collection-header grey lighten-3">'.$brand.'</li>
              <li class="collection-header grey lighten-3">'.$model.'</li>
            </ul>
          </div>
            <div class="card-image">
              <img src="'. $image . '">
            </div>
            <div class="card-content" style="padding:0px">
              <ul class="collection with-header" style="margin:0px;">
                <li class="collection-header grey lighten-3">Price : '.$price.' €</li>
                <li class="collection-header grey lighten-3">Battery</li>
                  <li class="collection-item">'.$batterycapacity.' maH</li>
                <li class="collection-header grey lighten-3">Storage and Memory</li>
                  <li class="collection-item">Storage : '.$storage.' GB</li>
                  <li class="collection-item">External Storage : '.$externalstorage.'</li>
                <li class="collection-header grey lighten-3">OS</li>
                  <li class="collection-item">'.$software.'</li>
                <li class="collection-header grey lighten-3">Size and Weight</li>
                  <li class="collection-item">Heigh : '.$sizeheigh.' mm</li>
                  <li class="collection-item">Width : '.$sizewidth.'  mm</li>
                  <li class="collection-item">Thickness : '.$sizethickness.' mm</li>
                  <li class="collection-item">Weight : '.$weight.' g</li>
                <li class="collection-header grey lighten-3">Display</li>
                  <li class="collection-item">Screen Definition : '.$screendefinition.'</li>
                  <li class="collection-item">Screen Resolution : '.$screenresolution.' ppi</li>
                  <li class="collection-item">Screen Size : '.$screensize.'"</li>
                  <li class="collection-item">Screen Panel : '.$screenpanel.'</li>
                <li class="collection-header grey lighten-3">Hardware</li>
                  <li class="collection-item">CPU Model : '.$cpumodel.' </li>
                  <li class="collection-item">CPU Frequency : '.$cpufrequency.' GHz</li>
                  <li class="collection-item">Core : '.$cpucore.'</li>
                  <li class="collection-item">RAM : '.$ram.' GB</li>
                <li class="collection-header grey lighten-3">Camera</li>
                  <li class="collection-item">Resolution : '.$cameraresolution.' MP</li>
                  <li class="collection-item">Front Camera Resolution : '.$frontcameraresolution.' MP</li>
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
              <a class="waves-effect waves-light btn" style="width:100%" href="'. $buylink .'">Acheter</a>
            </div>
          </div>
        </div>';
  }

  function generateHTMLSelect($label, $name, $values, $sidebar){
    $result = '';
    $result = $result . '<div class="input-wrapper">';
    if ($sidebar)
      $result = $result . '<div class="input-field col s12">';
    else
      $result = $result . '<div class="input-field col s12 m6">';

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

  function generateJSMinMax($field, $values, $id){

    $result = '';
    $result .= 'var slider_' . $id . ' = document.getElementById("' . $id . '-slider");' ;
    $result .= 'noUiSlider.create(slider_' . $id . ', {';
    $result .= 'start: [' . $values['minvalue'] . ', ' . $values['maxvalue'] . '],';
    $result .= 'connect: true,';
    $result .= 'step: 1,';
    $result .= 'range: {';
    $result .= '\'min\': ' . $values['minvalue'] . ',';
    $result .= '\'max\': ' . $values['maxvalue'];
    $result .= '},';
    $result .= 'format: wNumb({decimals: 0})';
    $result .= '});';

    $result .= 'slider_' . $id . '.noUiSlider.on("set", function(event, values) {';
    $result .= 'addSliderCriteria("' . $field . 'min", slider_' . $id . '.noUiSlider.get()[0]);';
    $result .= 'addSliderCriteria("' . $field . 'max", slider_' . $id . '.noUiSlider.get()[1]);';
    
    $result .= '});';


    return $result;
  }
?>
  <html>

  <head>
    <title>Comparofone</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link type="text/css" rel="stylesheet" href="./view/app/bower_components/Materialize/bin/materialize.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="./view/app/bower_components/Materialize/extras/noUiSlider/nouislider.css">
    <link type="text/css" rel="stylesheet" href="./view/app/assets/css/style.css">
    <link type="text/css" rel="stylesheet" href="./view/app/assets/css/lib/perfect-scrollbar.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>

  <body>
    <header>
      <?php require './view/app/navbar.php' ?>

      <ul id="slide-out" class="side-nav fixed">
        <li class="logo">
          <a href="/src/" title="logo" id="logo-container">
            <img src="./view/app/assets/img/logo.png" alt="">
          </a>
        </li>
        <li class="divider">
          <div class="divider"></div>
        </li>
        <li class="input">
          <p class="ultra-small margin" style="padding-bottom: 15px;">Search</p>
        </li>
        <li class="input">
          <?php echo generateHTMLSlider('Price', 'price_side'); ?>
        </li>
        <li class="input">
          <?php echo generateHTMLSelect('Brand', 'brand', $allBrand, true);?>
        </li>
        <li class="row input">
          <button onclick="$('#search-modal').openModal()" class="col s12 btn waves-effect waves-light modal-trigger">More Criterias</button>
        </li>
        <li class="divider">
          <div class="divider"></div>
        </li>
        <li class="input">
          <p class="ultra-small margin">Sorting</p>
        </li>
        <li class="input" style="padding-bottom: 15px;">
          <div class="switch">
            <label class="valign-wrapper" style="justify-content: center;">
                            ASC<i class="mdi-hardware-keyboard-arrow-up small icon-demo valign"></i>
                            <input id="sorting-direction-checkbox" type="checkbox">
                            <span class="lever valign"></span>
                            <i class="mdi-hardware-keyboard-arrow-down small icon-demo valign"></i>DESC
                        </label>
          </div>
        </li>
        <li class="input">
          <div class="input-wrapper">
            <div class="input-field col s12">
              <select onchange="addSorting(this, event);">
                                <option value="" selected="selected">Select criteria</option>
                                <option value="batterycapacity">Battery Capacity</option>
                                <option value="brand">Brand</option>
                                <option value="cameraresolution">Camera Resolution</option>
                                <option value="cpucore">Cpu Core</option>
                                <option value="cpufrequency">Cpu Frequency</option>
                                <option value="cpumodel">Cpu Model</option>
                                <option value="externalstorage">External Storage</option>
                                <option value="flash">Flash</option>
                                <option value="frontcameraresolution">Front Camera Resolution</option>
                                <option value="price">Price</option>
                                <option value="ram">Ram</option>
                                <option value="screendefinition">Screen Definition</option>
                                <option value="screenpanel">Screen Panel</option>
                                <option value="screenresolution">Screen Resolution</option>
                                <option value="screensize">Screen Size</option>
                                <option value="sizeheigh">Heigh</option>
                                <option value="sizethickness">Thickness</option>
                                <option value="sizewidth">Width</option>
                                <option value="software">Software</option>
                                <option value="storage">Storage</option>
                                <option value="warranty">Warranty</option>
                                <option value="waterproof">Waterproof</option>
                                <option value="weight">Weight</option>
                            </select>
              <label>Sorting by</label>
            </div>
          </div>
        </li>
      </ul>
      
    </header>
    <main>
      <div class="smartphone-container">
        <div class="criteria-prop-container">
          <div class="card" style="width:320px;">
            <div class="card-content" style="padding:0px">
              <form action=".">
                <ul class="collection with-header" style="margin:0px;">
                  <li class="collection-header grey lighten-3">Your search</li>
                  <li class="collection-item">
                    <button class="btn waves-effect waves-light" style="width:100%" type="submit" name="search">Submit<i class="material-icons right">search</i>
                                        </button>
                  </li>
                  <li class="collection-header">
                    <div class="valign-wrapper"><i class="material-icons">reorder</i>Criterias</div>
                  </li>
                  <li class="collection-item">
                    <ul class="" id="criterias">
                      <p>
                        There is no critera selected yet.
                      </p>
                    </ul>
                  </li>
                  <li class="collection-header">
                    <div class="valign-wrapper"><i class="material-icons">swap_vert</i>Sorting</div>
                  </li>
                  <li class="collection-item">
                    <ul id="sortings">
                      <p>No sorting filter added yet.</p>
                    </ul>
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
    <?php require './view/app/search-modal.php'; ?>
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

      echo generateJSMinMax('price', $minMaxPrice, 'price_side');
    
      echo generateJSMinMax('price', $minMaxPrice, 'price_modal');
      echo generateJSMinMax('screenresolution', $minMaxScreenResolution, 'screenresolution_modal');
      echo generateJSMinMax('screensize', $minMaxScreenSize, 'screensize_modal');
      echo generateJSMinMax('cpufrequency', $minMaxCPUFrequency, 'cpufrequency_modal');
      echo generateJSMinMax('cpucore', $minMaxCPUCore, 'cpucore_modal');
      echo generateJSMinMax('ram', $minMaxRAM, 'ram_modal');
      echo generateJSMinMax('cameraresolution', $minMaxCameraResolution, 'cameraresolution_modal');
      echo generateJSMinMax('frontcameraresolution', $minMaxFrontCameraResolution, 'frontcameraresolution_modal');
      echo generateJSMinMax('sizeheigh', $minMaxSizeHeigh, 'sizeheigh_modal');
      echo generateJSMinMax('sizewidth', $minMaxSizeWidth, 'sizewidth_modal');
      echo generateJSMinMax('sizethickness', $minMaxSizeThickness, 'sizethickness_modal');
      echo generateJSMinMax('weight', $minMaxWeight, 'weight_modal');
      echo generateJSMinMax('batterycapacity', $minMaxBatteryCapacity, 'batterycapacity_modal');
      echo generateJSMinMax('storage', $minMaxStorage, 'storage_modal');
      
      if (isset($arrayCriterias)){
        if (key_exists('criterias', $arrayCriterias)){
          forEach($arrayCriterias['criterias'] as $key => $value){
            echo "addSelectCriteria('$key', {'value' : '$value'});";
          }
        }
        if (key_exists('priority', $arrayCriterias)) {
          forEach($arrayCriterias['priority'] as $p){
            echo "addSortingInit('". $p['priority'] . "','".$p['order']."');";      
          }
        }

      }
      ?>
    </script>
  </body>

  </html>