<?php
session_start();

if (session_status() === PHP_SESSION_ACTIVE) {
    session_destroy();
    session_write_close();
}

header("Location: http://localhost/artG/login.html");
exit();
?>
