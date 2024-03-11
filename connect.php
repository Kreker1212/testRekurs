<?php

$host = 'ваш_хост';
$username = 'имя_пользователя';
$pass = 'пароль';
$dbname = 'название_бд';

$pdo = new PDO("mysql:host=$host;dbname=$dbname;",  $username, $pass);