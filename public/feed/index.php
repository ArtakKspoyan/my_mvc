<?php
header("Content-Type: application/rss+xml; charset=UTF-8");

use App\Database;
use App\XmlGenerator;

$rssFeed = '<?xml version="1.0" encoding="utf-8"?>';
$rssFeed .= '<rss xmlns:dc="http://purl.org/dc/elements/1.1/" version="2.0">';
$rssFeed .= '<channel>';
$rssFeed .= '<title>' . TITLE . '</title>';
$rssFeed .= '<link>' . URL_ROOT . '/task/</link>';
$rssFeed .= '<language>en_US</language>';
$rssFeed .= '<generator>' . URL_ROOT . '</generator>';
$rssFeed .= '<description>' . SUBTITLE . '</description>';
$rssFeed .= '<copyright>Copyright © ' . date("Y") . ' ' . TITLE . '</copyright>';

Database::query("SELECT * FROM tasks ORDER BY id DESC LIMIT :count");
Database::bind(':count', RSS_COUNTS);
$tasks = Database::fetchAll();
foreach ($tasks as $task) {
    $rssFeed .= '<item>';
    $rssFeed .= '<title>' . XmlGenerator::rss($task['user_name']) . '</title>';
    $rssFeed .= '<category>' . XmlGenerator::rss($task['email']) . '</category>';
    $rssFeed .= '<description>' . XmlGenerator::rss($task['body']) . '</description>';
    $rssFeed .= '<link>' . URL_ROOT . '/task/' . $task['slug'] . '</link>';
    $rssFeed .= '<pubDate>' . $task['updated_at'] . '</pubDate>';
    $rssFeed .= '<dc:creator>' . TITLE . '</dc:creator>';
    $rssFeed .= '</item>';
}

$rssFeed .= '</channel>';
$rssFeed .= '</rss>';

file_put_contents("feed/rss.xml", $rssFeed);
header("refresh:0;url=rss.xml");
