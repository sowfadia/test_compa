<?php

require './factory/SearchFactory.php';
$searchFactory = SearchFactory::getInstance();
$searchFactory->setConnection($connection);

if(isset($_GET['token']) AND $_GET['token'] == 'ascft'){
  $alerts = $searchFactory->getAlertsToday();

  foreach ($alerts as $value) {
      $firstname = $value['firstname'];
      $lastname = $value['lastname'];
      $email = $value['email'];
      $url = $value['url'];

      sendEmail($email, $firstname, $lastname, $url);
  }
}

function sendEmail($email, $firstname, $lastname, $url) {
    $headers = 'From: Comparofone <no-reply@comparofone.com>' . "\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";

    $message = '<html><body>';
    $message .= "
            Hello $firstname $lastname, 
            <br> <br> 
            Avez-vous trouvé le smartphone que vous cherchiez? 
            <br> 
            <a href='http://comparofonedev.zdro.fr/$url'>http://comparofonedev.zdro.fr/$url</a>
            <br><br>
            Comparofone team
            </html></body>
        ";

    mail($email, 'Comparofone | Alertes', $message, $headers);
}
?>