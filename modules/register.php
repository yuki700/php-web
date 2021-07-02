<?php

if ($user != false) {
    
    header('Location: index.php');
}

$isSuccess= isset($_GET['success']) ? $_GET['success'] : null;

if (!empty($_POST)) {
    $fullname = addslashes($_POST['fullname']);
    $username = addslashes($_POST['username']);
    $email = addslashes($_POST['email']);
    $password = md5($_POST['password']); 
    
    $sql = "INSERT INTO users(fullname, username, email, password)
        VALUE('$fullname', '$username', '$email', '$password')";

    $errors = [];
    try {
        $result = $mysql->query($sql);
        header('Location: index.php?m=register&success=true');
        exit;
    } catch (Exception $e) {
        array_push($errors, $e->getMessage());
    }

}
?>

<div id="main">
    <div id="main-content">
        <h3>Register User</h3>
        <?php
        if (isset($errors) && !empty($errors)) {
            foreach ($errors as $error) {
                echo '<p>'. $error . '</p>';
            }
        }
        ?>
        <?php
        if (!$isSuccess) { ?>
            <form method="post" class="form-register">
                <p>
                    <label>Username: </label>
                    <input type="text" name="username" />
                </p>
                <p>
                    <label>Email: </label>
                    <input type="text" name="email" />
                </p>
                <p>
                    <label>Full Name: </label>
                    <input type="text" name="fullname" />
                </p>
                <p>
                    <label>Password: </label>
                    <input type="password" name="password" />
                </p>
                <p><input type="submit" value="Register" /></p>
            </form>
        <?php  
        } else {
            echo "<p>Welcome to our website!</p>";
        } ?>
    </div>
    
    <?php require __DIR__. '/partials/sidebar.php'; ?>
</div>

