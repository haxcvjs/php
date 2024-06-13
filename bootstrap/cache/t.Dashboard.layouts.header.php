<?php

return function ($var) {

    foreach ($var as $key => $value) {
        $$key = $value;
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        li{
            display: inline-block;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li>Home</li>
            <li>Login</li>
            <li>Logout</li>
        </ul>
    </nav>
    
<?php
}
?>