<?php
/**
 * Database Configuration Helper
 * This file provides a centralized way to configure database settings
 * for different hosting environments
 */

// Try to load environment-specific configuration
if (file_exists(__DIR__ . '/env.php')) {
    include_once __DIR__ . '/env.php';
}

/**
 * Get database configuration with multiple fallback options
 */
function getDatabaseConfig() {
    return [
        'host' => $_ENV['DB_HOST'] ?? $_SERVER['DB_HOST'] ?? getenv('DB_HOST') ?: 'localhost',
        'user' => $_ENV['DB_USER'] ?? $_SERVER['DB_USER'] ?? getenv('DB_USER') ?: 'root',
        'pass' => $_ENV['DB_PASS'] ?? $_SERVER['DB_PASS'] ?? getenv('DB_PASS') ?: '',
        'name' => $_ENV['DB_NAME'] ?? $_SERVER['DB_NAME'] ?? getenv('DB_NAME') ?: 'tribalwars'
    ];
}

/**
 * Test database connection
 */
function testDatabaseConnection($config = null) {
    if (!$config) {
        $config = getDatabaseConfig();
    }
    
    try {
        $dsn = "mysql:host={$config['host']};dbname={$config['name']};charset=utf8";
        $pdo = new PDO($dsn, $config['user'], $config['pass'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        return ['success' => true, 'message' => 'Database connection successful'];
    } catch (PDOException $e) {
        return ['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()];
    }
}

// For backward compatibility, set global variables
$dbConfig = getDatabaseConfig();
$conf['db_host'] = $dbConfig['host'];
$conf['db_user'] = $dbConfig['user'];
$conf['db_pass'] = $dbConfig['pass'];
$conf['db_name'] = $dbConfig['name'];
?>