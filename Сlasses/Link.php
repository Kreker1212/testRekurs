<?php

namespace TestLink;

use PDO;

class Link
{
    private Database $database;

    private string $shortUrl;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getShortUrl(): string
    {
        return $this->shortUrl;
    }

    public function fetchShortUrl(string $url): void
    {
        $sql = 'SELECT short_url FROM url_shortenings WHERE url = :url';

        $stmt = $this->database->execute($sql, ['url' => $url]);
        $shortUrl = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->shortUrl = $shortUrl ? $shortUrl['short_url'] : '';
    }

    public function addLink(string $url): void
    {
        $sql = 'INSERT INTO url_shortenings (url, short_url) VALUES (:url, :short_url)';
        $this->database->execute($sql, ['url' => $url, 'short_url' => $this->shortUrl]);
    }

    public function randomShortUrl(): void
    {
        $this->shortUrl = substr(md5(uniqid(rand(), true)), 0, 6);
    }

    public function getLink($shortUrl): string
    {
        $sql = 'SELECT url FROM url_shortenings WHERE short_url = :shortUrl';

        $stmt = $this->database->execute($sql, ['shortUrl' => $shortUrl]);
        $url = $stmt->fetch(PDO::FETCH_ASSOC);

        return $url['url'];
    }

    public function json($url): string
    {
        return json_encode(['shortUrl' => "http://localhost:80/testLink/code/?shortUrl=$this->shortUrl", 'fullUrl' => $url]);
    }
}