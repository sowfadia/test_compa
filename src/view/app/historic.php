<?php
if (isset($_SESSION['id'])) {
    $historics = '';
    foreach ($searchHistoric as $value) {
        $id = $value['id'];
        $date = date_create($value['dateinsert']);
        $url = $value['url'];
        $frec = $value['frequency'];

        $historics .= generateHTMLSearch($id, $date, $url, $frec);
    }
}

function generateHTMLSearch($id, $date, $url, $frec) {
    $f = isset($frec) ? $frec . " days" : "&nbsp;";
  
    return "
        <tr>
          <form action='/src/?page=historic' method='POST'>
              <td>
              <a href='$url'>".date_format($date,'Y-m-d H:i')."</a>
              </td>
              <td>
              $f
              <input type='hidden' value='$id' name='idSearch' />
              </td>
              <td>
              <select required='required' onchange='$(\"#hid-$id\").val(this.value)'>
                  <option value='null'>None</option>
                  <option value='1'>1</option>
                  <option value='3'>3</option>
                  <option value='7'>7</option>
                  <option value='5'>5</option>
                  <option value='30'>30</option>
              </select>
              <input id='hid-$id' type='hidden' name='frequency'>
              </td>
              <td>
              <input class='btn wave' type='submit' name='alert' value='alert me!'>
          </form>
        </tr>
    ";
}
?>

<!DOCTYPE html>
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
      </ul>
    </header>
    <main>
      <div class="container">
        <table class="responsive-table">
          <tr>
            <th>Search</th>
            <th>Remind me every</th>
            <th>Set an alert</th>
            <th></th>
            
          </tr>
          <?php echo $historics; ?>
        </table>
      </div>
    </main>
    <!-- jQuery is required by Materialize to function -->
    <script type="text/javascript" src="./view/app/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="./view/app/bower_components/Materialize/bin/materialize.js"></script>
    <script type="text/javascript" src="./view/app/assets/js/lib/perfect-scrollbar.min.js"></script>
    <script type="text/javascript">
      $(".button-collapse").sideNav();
      $(document).ready(function() {
        $('select').material_select();
      });
    </script>
  </body>

</html>