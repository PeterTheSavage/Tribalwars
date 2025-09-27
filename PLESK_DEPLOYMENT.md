# Tribalwars Plesk Deployment Guide

## Prerequisites

- Plesk hosting account with PHP support (PHP 7.4+ recommended)
- MySQL database
- SSH/FTP access to your hosting account

## Deployment Steps

### 1. Database Setup

1. Create a MySQL database in Plesk
2. Note down the database credentials:
   - Database host (usually localhost)
   - Database name
   - Database username
   - Database password

3. Import the database:
   ```sql
   -- Import the provided SQL files in this order:
   -- 1. index_tw.sql (main structure)
   -- 2. lan_1.sql (game data)
   -- 3. news_db.sql (news system)
   ```

### 2. Environment Variables Setup

In Plesk, set the following environment variables (or configure them in your hosting control panel):

```
DB_HOST=localhost
DB_USER=your_db_username
DB_PASS=your_db_password
DB_NAME=your_db_name
```

Alternatively, you can directly edit the configuration files:
- `htdocs/configs/mysql.php`
- `htdocs/modelo/lib/config.php`
- `htdocs/mundo1/lib/config.php`

### 3. File Upload

1. Upload only the `htdocs` folder contents to your domain's document root
2. Do NOT upload the following Windows-specific files:
   - `.exe` files
   - `.bat` files
   - `/apache/` directory
   - `/mysql/` directory
   - `/php/` directory
   - `/install/` directory (contains Windows-specific installers)

### 4. Permissions

Set the following folder permissions:
- `configs/` - 755 (readable/writable by web server)
- `ds_graphic/` - 755
- `modelo/` - 755

### 5. Installation

1. Navigate to `https://yourdomain.com/install.php`
2. Select "Hospedagem Web (Plesk, cPanel)" option
3. Enter your database credentials
4. Follow the installation wizard

### 6. Post-Installation Security

After successful installation:

1. Delete or restrict access to `install.php`
2. In `.htaccess`, uncomment the install directory restriction:
   ```apache
   <Directory "install">
       Order allow,deny
       Deny from all
   </Directory>
   ```

### 7. Configuration

- Main configuration is in `configs/config.php`
- Server-specific settings are in `modelo/lib/config.php`
- Additional worlds can be configured by copying `mundo1/` folder

## Troubleshooting

### Common Issues:

1. **Database Connection Errors**
   - Verify database credentials in `configs/mysql.php`
   - Check if database server allows connections from web server

2. **Permission Errors**
   - Ensure web server has write permissions to `configs/` directory
   - Check PHP error logs in Plesk

3. **Missing Extensions**
   - Ensure PHP has MySQLi extension enabled
   - Verify Smarty template engine is working

### Support

For issues specific to this Plesk deployment:
- Check PHP error logs in Plesk control panel
- Verify database connection in Plesk database tools
- Ensure all environment variables are set correctly

## Notes

- This version has been optimized for web hosting environments
- Windows-specific components have been removed
- Database configuration uses environment variables for better security
- Clean URLs are supported via `.htaccess`