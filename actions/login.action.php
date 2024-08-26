<?php
// session_start();
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';


if ($_POST) {

    $post = $_POST;

    if ($post['email_id'] && $post['password']) {



        // For security encryption
        $email_id = $db->real_escape_string($post['email_id']);
        $password = md5($db->real_escape_string($post['password'])); // Encrypted form of password

        // Check if the user already exists
        $result = $db->query("SELECT id,full_name FROM users WHERE (email_id = '$email_id' && password='$password')");

        $result = $result->fetch_assoc();
        

            if ($result) {

              $fn->setAuth($result);
              $fn->setAlert('Logged in! ');
              $fn->redirect('../myresumes.php');

               
            } else{
               $fn->setError('Incorrect Email or Password');
                $fn->redirect('../login.php');
            }

    } else {
        $fn->setError('Please fill the form!');
        $fn->redirect('../login.php');
    }
} else {
    $fn->redirect('../login.php');
}

?>
