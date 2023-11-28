<?php
session_start();
session_unset();
session_destroy();
header("REFRESH:0; URL=login.php");
