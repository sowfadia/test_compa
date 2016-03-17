<?php
$notif = '';

if(isset($errorRegister)){
  $notif = "<div class='notifKo'>$message</div>";
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=0.7, user-scalable=no">
  <link type="text/css" rel="stylesheet" href="./view/app/bower_components/Materialize/bin/materialize.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="./view/app/bower_components/Materialize/extras/noUiSlider/nouislider.css">
  <link type="text/css" rel="stylesheet" href="./view/app/assets/css/style.css">
  <link type="text/css" rel="stylesheet" href="./view/app/assets/css/login.css">
  <link type="text/css" rel="stylesheet" href="./view/app/assets/css/page-center.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
  <div class="container">
    <div id="login-page" class="row">
      <div class="col m3">
        <p>&nbsp;</p>
      </div>
      <div class="col s12 m6 z-depth-4 card-panel" style="background-color : rgba(255, 255, 255, 0.8)">
        <form action='/src/?page=register' method='POST'>
          <div class="row input-row">
            <div class="input-field col s12 center">
              <h4 class="center login-form-text">Register</h4>
              <?php echo $notif; ?>
            </div>
          </div>
          <div class="row input-row">
            <div class="input-field col s12">
              <i class="mdi-action-account-circle prefix"></i>
              <input type='text' name='firstname' placeholder='First name' required='required' />
            </div>
          </div>
          <div class="row input-row">
            <div class="input-field col s12">
              <i class="mdi-action-account-circle prefix"></i>
              <input type='text' name='lastname' placeholder='Last name' required='required' />
            </div>
          </div>
          <div class="row input-row">
            <div class="input-field col s12">
              <i class="mdi-communication-email prefix"></i>
              <input type='email' name='email' placeholder='Email' required='required' />
            </div>
          </div>
          <div class="row input-row">
            <div class="input-field col s12">
              <i class="mdi-action-lock-outline prefix"></i>
              <input type='password' name='password' placeholder='Password' required='required' />
            </div>
          </div>
          <div class="row input-row">
            <div class="input-field col s12">
              <i class="mdi-action-lock-outline prefix"></i>
              <input type='password' name='password2' placeholder='Confirm password' required='required' />
            </div>
          </div>
          <div class="row input-row">
            <div class="input-field col s12">
              <input class="btn waves-effect waves-light col s12" type='submit' name='register' value='Register' />
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <p class="margin medium-small center-align">
                Already a member?
                <a href="/src/?page=login">Sign in now</a>
              </p>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>