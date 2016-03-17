<?php

require './factory/UserFactory.php';
$userFactory = UserFactory::getInstance();
$userFactory->setConnection($connection);

if (!isset($_SESSION['id'])) {
    if (isset($_POST['connect'])) {
        if (isset($_POST['email']) && isset($_POST['password']) && $_POST['email'] != '' && $_POST['password'] != '') {
            if ($_POST['email'] == 'admin@comparofone.fr' && $_POST['password'] == 'miage') {
                $_SESSION['id'] = '0';
                $_SESSION['firstName'] = 'admin';
                $_SESSION['lastName'] = '';
                $_SESSION['email'] = 'admin@comparofone.fr';
                header('Location: /src/?page=stats');
            } else {
                $result = $userFactory->authenticateUser($_POST['email'], hash('sha256', 'selDeTable' . $_POST['password']));

                if (count($result) == 1) {
                    $_SESSION['id'] = $result[0]->getId();
                    $_SESSION['firstName'] = $result[0]->getFirstName();
                    $_SESSION['lastName'] = $result[0]->getLastName();
                    $_SESSION['email'] = $result[0]->getEmail();

                    header('Location: /src/?page=search');
                } else {
                    $errorLogin = TRUE;
                    $message = 'Wrong email or password';
                    require './view/app/login.php';
                }
            }
        }
    }
    else {
    require './view/app/login.php';
    }
} else {
    header('Location: /src/?page=logout');
}
?>