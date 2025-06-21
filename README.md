# Blood Bank Management System

A comprehensive web-based Blood Bank Management System built with PHP and MySQL. This system allows for efficient management of blood donations, inventory tracking, and user management.

## 🚀 Features

- **User Management**: Registration, login, and profile management
- **Admin Dashboard**: Complete administrative control panel
- **Blood Donation Management**: Track donations and donors
- **Inventory Management**: Real-time blood inventory tracking
- **Medical Records**: Store and manage donor medical information
- **Search Functionality**: Find blood types and donors
- **Location Services**: Track donation centers
- **Reporting**: Generate medical reports and analytics

## 📁 Project Structure

```
Blood-bank/
├── src/
│   ├── pages/          # HTML pages
│   ├── includes/       # PHP includes and functions
│   ├── config/         # Configuration files
│   ├── admin/          # Admin-specific files
│   └── user/           # User-specific files
├── public/
│   ├── css/           # Stylesheets
│   ├── js/            # JavaScript files
│   └── images/        # Images and assets
├── docs/
│   └── database/      # Database schema and documentation
└── README.md
```

## 🛠️ Installation

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/shadow-112/blood-bank.git
   cd blood-bank
   ```

2. **Database Setup**
   - Create a MySQL database
   - Import the schema from `docs/database/bloodbank.sql`
   - Update database credentials in `src/config/database.php`

3. **Web Server Configuration**
   - Point your web server to the project root
   - Ensure PHP has write permissions for session management

4. **Access the Application**
   - Navigate to `http://localhost/blood-bank/src/pages/`
   - Default admin credentials: (check database for default values)

## 🔧 Configuration

### Database Configuration
Edit `src/config/database.php`:
```php
$host = 'localhost';
$dbname = 'bloodbank';
$username = 'your_username';
$password = 'your_password';
```

## 📋 Usage

### For Users
1. Register an account
2. Login to access user dashboard
3. View blood inventory
4. Schedule donations
5. Access medical reports

### For Administrators
1. Login with admin credentials
2. Access admin dashboard
3. Manage blood inventory
4. View donation reports
5. Manage user accounts

## 🗄️ Database Schema

The database includes the following main tables:
- `users` - User account information
- `donations` - Blood donation records
- `inventory` - Blood inventory tracking
- `medical_records` - Donor medical information
- `locations` - Donation center locations


## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👥 Authors

- **Saad Shafqat** - [GitHub](https://github.com/shadow-112)

## 🙏 Acknowledgments

- PHP community for excellent documentation
- MySQL for robust database management
- Open source contributors

## 📞 Support

For support, create an issue in this repository.

---

**Note**: This is a development version. For production use, ensure proper security measures and testing. 