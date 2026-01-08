<?php
session_start();

/* UNSET ALL SESSION VARIABLES */
$_SESSION = [];

/* DESTROY SESSION */
session_destroy();

/* REDIRECT TO HOMEPAGE */
header("Location: index.php");
exit();
