# Project Structure

This document provides a detailed overview of the Blood Bank Management System project structure.

## Directory Layout

```
Blood-bank/
├── .git/                    # Git version control
├── .gitignore              # Git ignore rules
├── .htaccess               # Apache configuration
├── CONTRIBUTING.md         # Contributing guidelines
├── LICENSE                 # MIT License
├── README.md              # Project documentation
├── docs/                  # Documentation
│   ├── database/          # Database files
│   │   └── bloodbank.sql  # Database schema
│   ├── CHANGELOG.md       # Version history
│   ├── INSTALLATION.md    # Installation guide
│   └── PROJECT_STRUCTURE.md # This file
├── public/                # Public assets
│   ├── css/              # Stylesheets
│   │   ├── styles.css    # Main stylesheet
│   │   └── styles2.css   # Secondary stylesheet
│   ├── js/               # JavaScript files
│   └── images/           # Images and assets
│       └── favicon.ico   # Website favicon
└── src/                  # Source code
    ├── admin/            # Admin-specific files
    │   └── admin_dashboard.php
    ├── config/           # Configuration files
    │   ├── database.php  # Database configuration
    │   └── database.php.example # Template
    ├── includes/         # PHP includes and functions
    │   ├── UseDonation.php
    │   ├── Inventory.php
    │   ├── add_medical_record.php
    │   ├── donate.php
    │   ├── info.php
    │   ├── locationtest.php
    │   ├── loginprocess.php
    │   ├── logout.php
    │   ├── myreport.php
    │   ├── register.php
    │   └── search.php
    ├── pages/            # HTML pages
    │   ├── about.html
    │   ├── adminlogin.html
    │   ├── applications.html
    │   ├── donate.html
    │   ├── index.html
    │   ├── locationtest.html
    │   ├── medicalreport.html
    │   ├── register.html
    │   ├── search.html
    │   └── userlogin.html
    └── user/             # User-specific files
        ├── user_dashboard.php
        └── user_info.php
```

## File Descriptions

### Root Files
- **`.gitignore`**: Specifies which files Git should ignore
- **`.htaccess`**: Apache web server configuration for security and optimization
- **`CONTRIBUTING.md`**: Guidelines for contributors
- **`LICENSE`**: MIT License for the project
- **`README.md`**: Main project documentation

### Documentation (`docs/`)
- **`database/`**: Contains database schema and related files
- **`CHANGELOG.md`**: Records all version changes and updates
- **`INSTALLATION.md`**: Detailed installation instructions
- **`PROJECT_STRUCTURE.md`**: This file

### Public Assets (`public/`)
- **`css/`**: All stylesheet files
- **`js/`**: JavaScript files (currently empty, ready for future use)
- **`images/`**: Image files and favicon

### Source Code (`src/`)

#### Admin Files (`admin/`)
- **`admin_dashboard.php`**: Main admin interface

#### Configuration (`config/`)
- **`database.php`**: Database connection configuration
- **`database.php.example`**: Template for database configuration

#### Includes (`includes/`)
- **`UseDonation.php`**: Handles blood donation processing
- **`Inventory.php`**: Manages blood inventory
- **`add_medical_record.php`**: Adds medical records
- **`donate.php`**: Donation form processing
- **`info.php`**: Information display
- **`locationtest.php`**: Location-based functionality
- **`loginprocess.php`**: User authentication
- **`logout.php`**: Session termination
- **`myreport.php`**: Report generation
- **`register.php`**: User registration
- **`search.php`**: Search functionality

#### Pages (`pages/`)
- **`about.html`**: About page
- **`adminlogin.html`**: Admin login page
- **`applications.html`**: Applications page
- **`donate.html`**: Donation page
- **`index.html`**: Homepage
- **`locationtest.html`**: Location testing page
- **`medicalreport.html`**: Medical reports page
- **`register.html`**: Registration page
- **`search.html`**: Search page
- **`userlogin.html`**: User login page

#### User Files (`user/`)
- **`user_dashboard.php`**: Main user interface
- **`user_info.php`**: User information management

## Security Considerations

1. **Configuration Protection**: Database configuration is in `src/config/` and protected by `.htaccess`
2. **File Permissions**: Sensitive files have restricted access
3. **Input Validation**: All user inputs are validated
4. **SQL Injection Prevention**: Uses prepared statements
5. **XSS Protection**: Output is properly escaped

## Development Guidelines

1. **File Organization**: Keep related files in appropriate directories
2. **Naming Conventions**: Use descriptive names for files and functions
3. **Documentation**: Update documentation when making changes
4. **Security**: Always validate and sanitize user inputs
5. **Testing**: Test thoroughly before committing changes

## Deployment Notes

1. **Web Server**: Configure to point to the project root
2. **Database**: Import schema and configure credentials
3. **Permissions**: Set appropriate file permissions
4. **HTTPS**: Enable SSL for production environments
5. **Backup**: Regular database and file backups

## Future Enhancements

- Add JavaScript files to `public/js/`
- Implement API endpoints
- Add unit tests
- Create deployment scripts
- Add monitoring and logging 