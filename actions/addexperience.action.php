<?php
// session_start();
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if ($_POST) {
    $post = $_POST;

    
    // echo "<pre>";
    // print_r($post);

    if (
        $post['resume_id'] && $post['position'] && $post['company'] && 
        $post['started'] && $post['ended'] && $post['job_desc']
    ) {

        $resumeid = array_shift($post);
        $post2=$post;
        unset($post['slug']);
        $columns = '';
        $values = '';

        foreach($post as $index => $value) {
            $$index = $db->real_escape_string($value);
            $columns .= $index . ',';
            $values .= "'$value',";
        }

        $columns.='resume_id';
        $values.=$resumeid;


        $query = "INSERT INTO `experiences` ($columns) VALUES ($values)";

        // echo $query;
        // die();

        try {
            if (!$db->query($query)) {
                throw new Exception($db->error);

            }
            $fn->setAlert('Experience Added Successfully');
            $fn->redirect('../updateresume.php?resume='.$post2['slug']);
        } catch(Exception $error) {
            $fn->setError('An error occurred: ' . $error->getMessage());
            $fn->redirect('../updateresume.php?resume='.$post2['slug']);
        }
    } else {
        $fn->setError('Please fill the form!');
        $fn->redirect('../updateresume.php?resume='.$post2['slug']);
    }
} else {
    $fn->redirect('../updateresume.php?resume='.$post2['slug']);
}
?>
