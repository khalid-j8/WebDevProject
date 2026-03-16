<?php
require_once __DIR__ . '/includes/auth.php';

logoutUser();
redirectTo('index.php');
