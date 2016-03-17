<?php

require './factory/UserFactory.php';
$userFactory = UserFactory::getInstance();
$userFactory->setConnection($connection);

if (isset($_POST['register'])) {
    if (isset($_POST['firstname']) && 
        isset($_POST['lastname']) && 
        isset($_POST['email']) && 
        isset($_POST['password']) && 
        isset($_POST['password2']) && 
        $_POST['firstname'] != '' && 
        $_POST['lastname'] != '' && 
        $_POST['email'] != '' && 
        $_POST['password'] != '' && 
        $_POST['password2'] != '') {
        
        if($_POST['password'] == $_POST['password2']){
          $userToAdd = new User(null, $_POST['firstname'], $_POST['lastname'], $_POST['email'], hash('sha256', 'selDeTable'.$_POST['password']), null);
      
          try{
            $result = $userFactory->createUser($userToAdd);
            if($result == 1){
                header('Location: /src/?page=login&co');
            }
          } catch(Exception $e){
              $errorRegister = true;
              $message = 'User already exist';
          }
        }
        else{
              $errorRegister = true;
              $message = 'The second password is not the same';
        }
    }
    else{
              $errorRegister = true;
              $message = 'You have to fill all imput';
    }
}

require './view/app/register.php';
?>