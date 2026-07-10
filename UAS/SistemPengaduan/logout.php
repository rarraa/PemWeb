<?php
require_once __Dir__ . '/includes/init.php';
$_SESSION = [];
session_destroy();
redirect('login.php');