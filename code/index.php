<?php

require_once __DIR__ . '/../vendor/autoload.php';
/**
 * @var PDO $pdo
 */
require_once __DIR__ . '/../connect.php';

use TestLink\Database;
use TestLink\Link;

$shortUrl = $_GET['shortUrl'];

$database = new Database($pdo);
$link = new Link($database);

$url = $link->getLink($shortUrl);


if ($url) {
    header("location: $url");
} else {
    header("location: http://localhost/testLink/");
}