<?php
$title = "Accounts | Resume Builder";
require './assets/includes/header.php';
require './assets/includes/navbar.php';
// $fn->authPage();

$auth = $fn->Auth();
if (!$auth || !isset($auth['id'])) {
    die("Authentication failed. Please log in again.");
}

// Ensure query success
$query = $db->query("SELECT full_name, email_id FROM users WHERE id='".$fn->Auth()['id']."'");

if ($query) {
    $user = $query->fetch_assoc();
} else {
    // Handle query error
    die("Database query failed: " . $db->error);
}
?>

<div class="container">
    <div class="bg-white rounded shadow p-2 mt-4">
        <div class="d-flex justify-content-between border-bottom">
            <h5>Accounts</h5>
            <div>
                <a class="text-decoration-none" onclick='history.back()'><i class="bi bi-arrow-left-circle"></i> Back</a>
            </div>
        </div>
        <div>
            <form action="register.php" method="post" class="row g-3 p-3">
                <div class="col-md-6">
                    <label class="form-label">Full Name</label>
                    <input name="full_name" type="text" placeholder="Dev Ninja" value="<?= htmlspecialchars(@$user['full_name']) ?>" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input name="email_id" type="email" placeholder="dev@abc.com" value="<?= htmlspecialchars(@$user['email_id']) ?>" class="form-control" required>
                </div>
                <div class="col-12">
                    <label class="form-label">New Password</label>
                    <input type="text" name="password" class="form-control">
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Update Profile</button>
                </div>  
            </form>
        </div>
    </div>
</div>
<?php
require './assets/includes/footer.php';
?>
