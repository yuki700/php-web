<?php
if ($user == false) {
    header('Location: index.php?m=login');
    exit;
}

$messages = [];

if (!empty($_POST)) {
    $currentPassword = md5($_POST['current_password']);
    $newPassword = md5($_POST['new_password']);
    $confirmPassword = md5($_POST['confirm_password']);

    if ($currentPassword != $user['password']) {
        array_push($messages, "Current password is incorrect");
    }

    
    if ($newPassword != $confirmPassword) {
        array_push($messages, "Confirm password is not matched with New Password");
    }

    
    if (empty($messages)) {
        $sql = "UPDATE users
        SET password = '$newPassword'
        WHERE id = " . $user['id'];

        try {
            $result = $mysql->query($sql);
            array_push($messages,"Your password is changed");
        } catch (Exception $e) {
            
            array_push($messages, $e->getMessage());
        }
    }
}
?>
<div id="main">
    <div id="main-content">
        <h3>Change Password</h3>
        <?php foreach($messages as $message) {
            echo "<p>$message</p>";
        } 
        ?>
        <form method="post" class="form-register">
            <p>
                <label>Current Password: </label>
                <input type="password" name="current_password" />
            </p>
            <p>
                <label>New Password: </label>
                <input type="password" name="new_password" />
            </p>
            <p>
                <label>Confirm Password: </label>
                <input type="password" name="confirm_password" />
            </p>
            <p><input type="submit" value="Change Password" /></p>
        </form>
    </div>
    
    <?php require __DIR__. '/partials/sidebar.php'; ?>
</div>
