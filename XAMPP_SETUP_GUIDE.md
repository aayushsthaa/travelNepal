# travelNepal - XAMPP Setup Guide

## Prerequisites
- XAMPP installed with Apache, MySQL, and PHP
- Web browser

## Installation Steps

### 1. Database Setup
1. Start XAMPP Control Panel
2. Start **Apache** and **MySQL** services
3. Open **phpMyAdmin** (http://localhost/phpmyadmin)
4. Create a new database named `travelnepal`
5. Import the `database.sql` file into the `travelnepal` database

### 2. File Setup
1. Copy the entire project folder to `C:\xampp\htdocs\travelNepal\`
2. Ensure the folder structure looks like:
   ```
   C:\xampp\htdocs\travelNepal\
   ├── assets/
   ├── config/
   ├── includes/
   ├── templates/
   ├── uploads/
   ├── .htaccess
   ├── index.php
   ├── database.sql
   └── XAMPP_SETUP_GUIDE.md
   ```

### 3. Configuration (Optional)
Create a `.env` file in the root directory if you want to customize settings:
```
# Database Configuration
DATABASE_URL=mysql://root:@localhost:3306/travelnepal

# Admin Credentials (change these!)
ADMIN_USERNAME=admin
ADMIN_PASSWORD=your_secure_password_here

# Environment
ENVIRONMENT=development
```

### 4. Access the Website
- Homepage: http://localhost/travelNepal/
- Admin Login: http://localhost/travelNepal/admin/login
- Default admin credentials:
  - Username: `admin`
  - Password: `travelnepal2024`

### 5. Important Notes
- **Change the admin password** immediately after first login
- The website will work with the default MySQL root user (no password)
- All uploads go to the `uploads/` directory
- The `.htaccess` file handles URL routing - don't delete it

### 6. Troubleshooting

#### "Internal Server Error"
- Check that Apache and MySQL are running in XAMPP
- Verify the `travelnepal` database exists and contains the tables
- Check Apache error logs in XAMPP

#### "Database Connection Failed"
- Ensure MySQL is running
- Check database name is `travelnepal`
- Verify the database contains the imported tables

#### "Page Not Found"
- Ensure the `.htaccess` file is in the root directory
- Check that mod_rewrite is enabled in Apache

### 7. Default Database Structure
The `database.sql` file creates these tables:
- `posts` - Blog posts and articles
- `categories` - Content categories
- `post_images` - Gallery images for posts

## Security Notes
- Change default admin credentials
- Keep XAMPP updated
- Don't use this configuration for production without additional security measures

## Support
All CRUD operations (Create, Read, Update, Delete) work with MySQL:
- ✅ Create new blog posts
- ✅ Edit existing posts
- ✅ Delete posts
- ✅ Manage categories
- ✅ Upload images
- ✅ Admin authentication