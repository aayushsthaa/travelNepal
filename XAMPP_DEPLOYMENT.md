# travelNepal - XAMPP Deployment Guide

This guide will help you deploy the travelNepal website on XAMPP with MySQL database.

## Prerequisites

- XAMPP installed (Apache + MySQL + PHP)
- PHP 7.4 or higher
- MySQL 5.7 or higher

## Installation Steps

### 1. Database Setup

1. Start XAMPP and ensure Apache and MySQL are running
2. Open phpMyAdmin (http://localhost/phpmyadmin)
3. Create a new database named `travel_nepal`
4. Import the database schema: Go to Import tab and select `database.sql`

### 2. File Setup

1. Copy the entire `travelNepal` folder to your XAMPP `htdocs` directory
   ```
   C:/xampp/htdocs/travelNepal/  (Windows)
   /Applications/XAMPP/htdocs/travelNepal/  (macOS)
   /opt/lampp/htdocs/travelNepal/  (Linux)
   ```

### 3. Environment Configuration

1. Copy `.env.example` to `.env`
2. Edit `.env` file with your database credentials:
   ```
   ADMIN_USERNAME=admin
   ADMIN_PASSWORD=your_secure_password
   
   DB_HOST=localhost
   DB_NAME=travel_nepal
   DB_USER=root
   DB_PASS=
   DB_PORT=3306
   ```

### 4. Directory Structure Adjustment (if needed)

If your XAMPP installation is in a different directory or you want to use a different subdirectory:

1. Update the `$basePath` variable in `config/config.php` (lines 153 and 161)
2. Update the `RewriteBase` in `.htaccess` (line 6)

### 5. Permissions

Ensure the following directories are writable:
- `data/`
- `uploads/`
- `assets/images/`

On Linux/macOS:
```bash
chmod 755 data/ uploads/ assets/images/
```

### 6. Access the Website

Visit: http://localhost/travelNepal/

### 7. Admin Access

- Login URL: http://localhost/travelNepal/admin/login
- Use the credentials you set in the `.env` file

## Troubleshooting

### Database Connection Issues
- Verify MySQL is running in XAMPP
- Check database credentials in `.env`
- Ensure the `travel_nepal` database exists

### URL/Asset Issues
- Check that the `RewriteBase` in `.htaccess` matches your directory structure
- Verify the `$basePath` in `config/config.php` helper functions

### Apache mod_rewrite Issues
- Ensure Apache `mod_rewrite` is enabled in XAMPP
- Check that `.htaccess` is being read (test with intentional syntax error)

### File Permissions
- Ensure Apache has read access to all files
- Ensure write access to `data/`, `uploads/`, and `assets/images/` directories

## Important Notes

1. **Security**: Change the default admin password in the `.env` file
2. **Base Path**: If you move the site to a different directory, update the base paths in `config/config.php` and `.htaccess`
3. **Database**: The included `database.sql` contains the complete MySQL schema with sample categories

## File Structure
```
travelNepal/
├── .htaccess              # Apache URL routing
├── .env.example           # Environment configuration template
├── database.sql           # MySQL database schema
├── index.php              # Main application entry point
├── config/
│   └── config.php         # Database and site configuration
├── includes/
│   ├── functions.php      # Core application functions
│   ├── router.php         # URL routing logic
│   └── destinations-data.php
├── templates/             # HTML templates
├── assets/                # CSS, JS, images
└── uploads/               # User uploaded files
```

## Support

If you encounter issues:
1. Check XAMPP error logs
2. Enable PHP error reporting in development
3. Verify database connection using phpMyAdmin