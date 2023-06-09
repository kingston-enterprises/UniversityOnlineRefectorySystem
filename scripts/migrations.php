<?php
/** created by : kingston-5 @ 8/01/23 **/

use kingston\icarus\Application;

require_once __DIR__.'/../vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__  . '. /../');

$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ],
    'migrations' => '/../migrations/'
];

$app = new Application(__DIR__, $config);

$app->db->applyMigrations();
