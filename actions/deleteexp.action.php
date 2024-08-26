<?php
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if ($_GET) {
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $resume_id = isset($_GET['resume_id']) ? intval($_GET['resume_id']) : 0;
    $slug = isset($_GET['slug']) ? $_GET['slug'] : '';

    if ($id > 0 && $resume_id > 0) {
        $query = "DELETE FROM `experiences` WHERE id = ? AND resume_id = ?";
        try {
            if ($stmt = $db->prepare($query)) {
                $stmt->bind_param("ii", $id, $resume_id);
                if (!$stmt->execute()) {
                    throw new Exception($stmt->error);
                }
                $stmt->close();
                $fn->setAlert('Experience Deleted');
            } else {
                throw new Exception($db->error);
            }
        } catch (Exception $error) {
            $fn->setError('An error occurred: ' . $error->getMessage());
        }
    } else {
        $fn->setError('Invalid parameters!');
    }
    $fn->redirect('../updateresume.php?resume=' . urlencode($slug));
} else {
    $fn->redirect('../updateresume.php');
}
?>
