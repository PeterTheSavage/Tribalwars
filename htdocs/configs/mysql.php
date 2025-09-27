<?php
// Plesk-compatible database configuration using environment variables
$conf['db_host'] = $_ENV['DB_HOST'] ?? $_SERVER['DB_HOST'] ?? 'localhost';
$conf['db_user'] = $_ENV['DB_USER'] ?? $_SERVER['DB_USER'] ?? 'root';
$conf['db_pass'] = $_ENV['DB_PASS'] ?? $_SERVER['DB_PASS'] ?? 'plemionka';
$conf['db_name'] = $_ENV['DB_NAME'] ?? $_SERVER['DB_NAME'] ?? 'index_tw';
?>