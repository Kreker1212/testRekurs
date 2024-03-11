<?php

require_once __DIR__ . '/vendor/autoload.php';
/**
 * @var PDO $pdo
 */
require_once __DIR__ . '/connect.php';


use TestLink\Database;
use TestLink\Link;

header('Content-type: application/json');


$database = new Database($pdo);
$link = new Link($database);

$url = $_POST['url'];

if (filter_var($url, FILTER_VALIDATE_URL) === false) {
    die(json_encode(['error' => true]));
}

$link->fetchShortUrl($url);

if ($link->getShortUrl()) {
    echo $link->json($url);
} else {
    $link->randomShortUrl();
    $link->addLink($url);
    echo $link->json($url);
}