<?php
    $pageTitles = array(
        'home' => "Home",
        'login' => "Login",
        "profile" => "My Profile",
        "register" => "Regiser",
        "change_password" => "Change Password"

    );

    $pageTitle = $pageTitles[$module] ? $pageTitles[$module] : false;

    $userId = isset($_SESSION['login_user_id']) ? $_SESSION['login_user_id'] : false;
   
    $user = false;
    if ($userId) {
        $sql = "SELECT id, username, email, fullname 
            FROM users 
            WHERE id = $userId
            LIMIT 0,1";

        $result = $mysql->query($sql);
        $user = $result->fetch_array() ?? false;
    }

    $fullname = $user ? $user['fullname'] : 'Guest';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="normalize.css">
        <meta charset="utf-8">
        <title><?php echo $pageTitle; ?></title>
        <link rel="stylesheet" href="./assets/css/index.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <script src="./assets/js/index.js"></script>
    </head>
    <body>
        <header>
        <div>
            <h4>The logo <?php echo isset($_SESSION['login_user_id']) ? $_SESSION['login_user_id'] : null; ?></h4>
        </div>
        <div>
                <h2 class="slogan">The header slogan</h2>
        </div>
        <div id="form">
            <ul>
                <li>Hi <span><?php echo $fullname; ?></span></li>
                <?php if (!$user) { ?>
                    <li><a href="javascript:void(0)" onclick="showLoginForm()">Login</a></li>
                    <?php } else { ?>
                    <li><a href="./index.php?m=logout">Logout</a></li>
                <?php } ?>
            </ul>

            <form id="login" action="index.php?m=login" method="post">
                <input type="text" name="username" placeholder="User name" />
                <input type="password" name="password" placeholder="Password"/>
                <label><input type="checkbox" name="rememberUsername" />Remember user name </label>
                <button type="submit" name="Login">Login</button>
            </form>
            <form method="GET" id="search">
                <input type="text" name="keyword" />
                <i class="material-icons">search</i>
            </form>
        </div>
        </header>

        <nav>
            <ul>
                <!-- <li><a href="./index.php">Home</a></li>
                <li><a href="./index.php?m=register">Register</a></li>
                <li><a href="./index.php?m=profile">My Profile</a></li> -->
                <li><a href="./index.php">Home</a></li>
                <?php if ($user == false) { ?>
                <li><a href="./index.php?m=register">Register</a></li>
                <?php } else { ?>
                <li><a href="./index.php?m=profile">My Profile</a></li>
                <li><a href="./index.php?m=change_password">Change Password</a></li>
                <?php } ?>

            </ul>
        </nav>
