<?php
session_start();

if (isset($_SESSION['admin_ID'])) {
    if (
        ($_SESSION['userName'] == "Sulaiman" and $_SESSION['pass'] == "430833075a312085784b04e43dbdc5e996e83f76")
        or
        ($_SESSION['userName'] == "Rana" and $_SESSION['pass'] == "c8f998efe3f4741eb7a5c4835d6a54f716c1764c")
    ) {
        header("REFRESH:0; URL=admin/index.php");
    } else {
        echo "403 Forbidden";
    }
} else {
    echo "403 Forbidden";
}
