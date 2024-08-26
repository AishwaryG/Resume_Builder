<?php
// session_start();
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if ($_POST) {
    $post = $_POST;

    if (
        $post['full_name'] && $post['email_id'] && $post['objective'] && 
        $post['mobile_no'] && $post['dob'] && $post['religion'] && 
        $post['nationality'] && $post['marital_status'] && $post['hobbies'] && 
        $post['languages'] && $post['address']
    ) {
        $columns = '';
        $values = '';

        foreach($post as $index => $value) {
            $$index = $db->real_escape_string($value);
            $columns .= $index . ',';
            $values .= "'$value',";
        }

        $authid = $fn->Auth()['id'];

        $columns .= 'slug,updated_at,user_id';
        $values .= "'" . $fn->randomstring() . "'," . time() . "," . $authid;

        $query = "INSERT INTO `resumes` ($columns) VALUES ($values)";

        try {
            if (!$db->query($query)) {
                throw new Exception($db->error);
            }
            $fn->setAlert('Resume Added Successfully');
            $fn->redirect('../myresumes.php');
        } catch(Exception $error) {
            $fn->setError('An error occurred: ' . $error->getMessage());
            $fn->redirect('../createresume.php');
        }
    } else {
        $fn->setError('Please fill the form!');
        $fn->redirect('../createresume.php');
    }
} else {
    $fn->redirect('../createresume.php');
}
?>
