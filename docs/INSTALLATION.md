# Installation Guide

This guide will help you set up the Blood Bank Management System on your local machine or server.

## Prerequisites

Before you begin, ensure you have the following installed:

- **PHP 7.4 or higher**
- **MySQL 5.7 or higher** (or MariaDB 10.2+)
- **Web Server** (Apache 2.4+ or Nginx 1.18+)
- **Git** (for cloning the repository)

## Step 1: Clone the Repository

```bash
git clone https://github.com/yourusername/blood-bank.git
cd blood-bank
```

## Step 2: Database Setup

### Create Database
```sql
CREATE DATABASE bloodbank CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'bloodbank_user'@'localhost' IDENTIFIED BY 'your_secure_password';
GRANT ALL PRIVILEGES ON bloodbank.* TO 'bloodbank_user'@'localhost';
FLUSH PRIVILEGES;
```

### Import Schema
```bash
mysql -u bloodbank_user -p bloodbank < docs/database/bloodbank.sql
```

## Step 3: Configuration

### Database Configuration
1. Copy the database configuration template:
   ```bash
   cp src/config/database.php.example src/config/database.php
   ```

2. Edit `src/config/database.php` with your database credentials:
   ```php
   <?php
   $host = 'localhost';
   $dbname = 'bloodbank';
   $username = 'bloodbank_user';
   $password = 'your_secure_password';
   
   try {
       $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   } catch(PDOException $e) {
       echo "Connection failed: " . $e->getMessage();
   }
   ?>
   ```

## Step 4: Web Server Configuration

### Apache Configuration
Create a virtual host configuration:

```apache
<VirtualHost *:80>
    ServerName bloodbank.local
    DocumentRoot /path/to/blood-bank
    
    <Directory /path/to/blood-bank>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/bloodbank_error.log
    CustomLog ${APACHE_LOG_DIR}/bloodbank_access.log combined
</VirtualHost>
```

### Nginx Configuration
```nginx
server {
    listen 80;
    server_name bloodbank.local;
    root /path/to/blood-bank;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

## Step 5: File Permissions

Set appropriate permissions:
```bash
chmod 755 -R /path/to/blood-bank
chmod 644 src/config/database.php
```

## Step 6: Access the Application

1. Start your web server
2. Navigate to `http://localhost/blood-bank/src/pages/` or your configured domain
3. You should see the Blood Bank Management System homepage

## Step 7: Initial Setup

### Create Admin Account
1. Register a new user account
2. Manually update the user role in the database:
   ```sql
   UPDATE users SET role = 'admin' WHERE email = 'your_email@example.com';
   ```

### Default Credentials
- **Admin**: Check the database for default admin credentials
- **User**: Register through the application

## Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Verify database credentials in `src/config/database.php`
   - Ensure MySQL service is running
   - Check database user permissions

2. **404 Errors**
   - Verify web server configuration
   - Check file permissions
   - Ensure .htaccess is properly configured (Apache)

3. **PHP Errors**
   - Check PHP version compatibility
   - Enable error reporting for debugging
   - Verify PHP extensions are installed

### Error Logs
- **Apache**: `/var/log/apache2/bloodbank_error.log`
- **Nginx**: `/var/log/nginx/bloodbank_error.log`
- **PHP**: Check your PHP error log location

## Security Considerations

1. **Change Default Passwords**: Update all default credentials
2. **Secure Database**: Use strong passwords and limit database user permissions
3. **HTTPS**: Enable SSL/TLS for production environments
4. **File Permissions**: Ensure sensitive files are not publicly accessible
5. **Regular Updates**: Keep PHP, MySQL, and web server updated

## Production Deployment

For production deployment, consider:

1. **Environment Variables**: Use environment variables for sensitive configuration
2. **Caching**: Implement PHP OPcache and database query caching
3. **Backup Strategy**: Regular database and file backups
4. **Monitoring**: Set up application and server monitoring
5. **Load Balancing**: For high-traffic applications

## Support

If you encounter issues during installation:

1. Check the troubleshooting section above
2. Review error logs
3. Create an issue on GitHub with detailed information
4. Contact the development team

---

**Note**: This installation guide assumes a Linux/Unix environment. For Windows, some commands and paths may differ. 