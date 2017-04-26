<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['lang'] === 'en' || $_POST['lang'] === 'sv') {
        session_start();
        $_SESSION['lang'] = $_POST['lang'];
        http_response_code(200);
        die;
    }
}
