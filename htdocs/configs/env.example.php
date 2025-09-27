<?php
// Environment configuration example for Plesk deployment
// Copy this file to env.php and configure your settings

// Database Configuration
$_ENV['DB_HOST'] = 'localhost';
$_ENV['DB_USER'] = 'your_db_username';
$_ENV['DB_PASS'] = 'your_db_password';
$_ENV['DB_NAME'] = 'your_db_name';

// Optional: Load this file in your main configuration if environment variables are not set in Plesk
// include_once('env.php');
?>