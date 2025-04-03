<?php
session_start();
session_unset();
unset($_SESSION['current_id']);
session_destroy();
header("Location: admin.php");
exit();
