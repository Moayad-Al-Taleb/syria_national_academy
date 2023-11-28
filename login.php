<?php

session_start();
// ________________________________________
$userName = $pass = "";
$userName_err = $pass_err = "";
$login_state = "";
function data($word)
{
    $word = trim($word);
    $word = htmlspecialchars($word);

    return $word;
}

// ________________________________________
if (isset($_POST['BTN_LOGIN'])) {
    // userName
    if (empty($_POST['userName'])) {
        $userName_err = " *The field is required";
    } else {
        $userName = data($_POST['userName']);
    }

    // pass
    if (empty($_POST['pass'])) {
        $pass_err = " *The field is required";
    } else {
        $pass = sha1(data($_POST['pass']));
    }

    // ________________________________________
    if (!empty($userName) and !empty($pass)) {
        require 'connect.php';

        $sql = "SELECT * FROM admins WHERE userName = '$userName' AND pass = '$pass'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $_SESSION['admin_ID'] = $row['admin_ID'];
            $_SESSION['userName'] = $row['userName'];
            $_SESSION['pass'] = $row['pass'];

            $login_state = "valid login";
            header("REFRESH:2; URL=check.php");
        } else {
            $login_state = "Login Error";
            header("REFRESH:2; URL=login.php");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
    <style>
        body {
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left-side">
            <div class="logo">s.n.a</div>
        </div>
        <div class="right-side">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="input-field">
                    <input class="input" name="userName" type="text" placeholder="enter your name"><?php echo $userName_err; ?>
                </div>
                <div class="input-field">
                    <input class="input" name="pass" type="password" placeholder="enter your password"><?php echo $pass_err; ?>
                </div>
                <div class="input-field">
                    <input class="input-btn" type="submit" name="BTN_LOGIN" value="connect">
                </div>
                <?php echo $login_state; ?>
            </form>
        </div>
    </div>
</body>

</html>