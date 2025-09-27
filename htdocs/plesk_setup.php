<?php
/**
 * Plesk Setup Helper Script
 * This script helps verify that the environment is properly configured for Plesk hosting
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tribalwars - Plesk Setup Verification</title>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { background: white; padding: 20px; border-radius: 5px; max-width: 800px; }
        .success { color: green; }
        .error { color: red; }
        .warning { color: orange; }
        .info { color: blue; }
        .test-result { margin: 10px 0; padding: 10px; border-left: 4px solid #ccc; }
        .test-result.success { border-left-color: green; background: #f0fff0; }
        .test-result.error { border-left-color: red; background: #fff0f0; }
        .test-result.warning { border-left-color: orange; background: #fff8f0; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tribalwars Plesk Setup Verification</h1>
        
        <?php
        echo "<h2>Environment Check</h2>";
        
        // Check PHP version
        $phpVersion = phpversion();
        if (version_compare($phpVersion, '7.4.0', '>=')) {
            echo "<div class='test-result success'>✓ PHP Version: $phpVersion (OK)</div>";
        } else {
            echo "<div class='test-result error'>✗ PHP Version: $phpVersion (Requires 7.4+)</div>";
        }
        
        // Check required extensions
        $requiredExtensions = ['mysqli', 'pdo', 'pdo_mysql', 'gd', 'mbstring', 'curl'];
        foreach ($requiredExtensions as $ext) {
            if (extension_loaded($ext)) {
                echo "<div class='test-result success'>✓ Extension '$ext' is loaded</div>";
            } else {
                echo "<div class='test-result error'>✗ Extension '$ext' is missing</div>";
            }
        }
        
        // Check database configuration
        echo "<h2>Database Configuration Check</h2>";
        
        $dbHost = $_ENV['DB_HOST'] ?? $_SERVER['DB_HOST'] ?? null;
        $dbUser = $_ENV['DB_USER'] ?? $_SERVER['DB_USER'] ?? null;
        $dbPass = $_ENV['DB_PASS'] ?? $_SERVER['DB_PASS'] ?? null;
        $dbName = $_ENV['DB_NAME'] ?? $_SERVER['DB_NAME'] ?? null;
        
        if ($dbHost && $dbUser && $dbPass && $dbName) {
            echo "<div class='test-result success'>✓ Database environment variables are set</div>";
            echo "<div class='test-result info'>Host: $dbHost, User: $dbUser, Database: $dbName</div>";
            
            // Test database connection
            try {
                $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
                echo "<div class='test-result success'>✓ Database connection successful</div>";
            } catch (PDOException $e) {
                echo "<div class='test-result error'>✗ Database connection failed: " . $e->getMessage() . "</div>";
            }
        } else {
            echo "<div class='test-result warning'>⚠ Database environment variables not fully configured</div>";
            echo "<div class='test-result info'>You can configure them in Plesk or create htdocs/configs/env.php</div>";
        }
        
        // Check file permissions
        echo "<h2>File Permissions Check</h2>";
        
        $checkDirs = ['configs', 'modelo', 'ds_graphic'];
        foreach ($checkDirs as $dir) {
            if (is_dir($dir)) {
                if (is_writable($dir)) {
                    echo "<div class='test-result success'>✓ Directory '$dir' is writable</div>";
                } else {
                    echo "<div class='test-result error'>✗ Directory '$dir' is not writable</div>";
                }
            } else {
                echo "<div class='test-result warning'>⚠ Directory '$dir' not found</div>";
            }
        }
        
        // Check if installation is needed
        echo "<h2>Installation Status</h2>";
        
        if (file_exists('configs/install.php')) {
            include 'configs/install.php';
            if (isset($install) && $install) {
                echo "<div class='test-result success'>✓ Installation completed</div>";
                echo "<div class='test-result info'>You can delete this file (plesk_setup.php) after verification</div>";
            } else {
                echo "<div class='test-result warning'>⚠ Installation not completed</div>";
                echo "<div class='test-result info'><a href='install.php'>Go to installation</a></div>";
            }
        } else {
            echo "<div class='test-result warning'>⚠ Installation status unknown</div>";
            echo "<div class='test-result info'><a href='install.php'>Go to installation</a></div>";
        }
        
        // Check .htaccess
        if (file_exists('.htaccess')) {
            echo "<div class='test-result success'>✓ .htaccess file exists</div>";
        } else {
            echo "<div class='test-result warning'>⚠ .htaccess file missing (URL rewriting may not work)</div>";
        }
        
        // Environment recommendations
        echo "<h2>Recommendations</h2>";
        echo "<div class='test-result info'>";
        echo "<strong>For optimal security in Plesk:</strong><br>";
        echo "1. Set database credentials as environment variables in Plesk<br>";
        echo "2. Enable 'Hide PHP errors' in production<br>";
        echo "3. Set appropriate file permissions (755 for directories, 644 for files)<br>";
        echo "4. Configure SSL certificate for HTTPS<br>";
        echo "5. Enable PHP OPcache for better performance<br>";
        echo "6. Delete this setup file after verification<br>";
        echo "</div>";
        ?>
        
        <h2>Next Steps</h2>
        <div class="test-result info">
            <p><strong>If this is your first setup:</strong></p>
            <ol>
                <li><a href="install.php">Run the installation</a></li>
                <li>Configure your database credentials</li>
                <li>Import the SQL files (index_tw.sql, lan_1.sql, news_db.sql)</li>
                <li>Test your game installation</li>
            </ol>
            
            <p><strong>If installation is complete:</strong></p>
            <ol>
                <li><a href="pl-lan.php">Go to main page</a></li>
                <li><a href="admin.php">Access admin panel</a></li>
                <li>Delete this verification file for security</li>
            </ol>
        </div>
    </div>
</body>
</html>