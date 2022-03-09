<?php

function register($email, $password, $first_name, $last_name, $birthday, $baseurl = 'http://localhost:80') {

    $email = urlencode($email);
    $first_name = urlencode($first_name);
    $last_name = urlencode($last_name);
    $password = urlencode($password);
    $birthday = urlencode($birthday);

    $ch = curl_init();

    $url = "$baseurl/S4486648/public_html/php/registration.php";

    $cookieFile = "cookies";
    if(!file_exists($cookieFile)) {
        $fh = fopen($cookieFile, "w");
        fwrite($fh, "");
        fclose($fh);
    }

    curl_setopt($ch, CURLOPT_URL, "$baseurl/S4486648/public_html/php/registration.php");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "email=$email&firstname=$first_name&lastname=$last_name&pass=$password&confirm=$password&birthday=$birthday");

    $headers = array();
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile); // Cookie aware
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile); // Cookie aware

    $result = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
}
