
# Personal Portfolio Website

A personal portfolio website developed to showcase my
software engineering projects, technical skills,
certifications, and professional development.

## Technologies Used

- HTML5
- CSS3
- JavaScript
- PHP
- MySQL

## Key Features

- Responsive web design
- Dynamic project and skills management
- Certificates and achievements gallery
- Contact form with database integration
- Automatically updated portfolio statistics

## Security Practices

- Prepared Statements
- CSRF Protection
- Honeypot Protection
- Session-Based Rate Limiting
- Least Privilege Database Access
- Secure Database Configuration

## Development Status

Currently under development and improvement.

## Local Setup

### Requirements
- XAMPP (Apache and MySQL/MariaDB)
- PHP with MySQLi support
- A web browser

### Installation

1. Clone or download this repository.
2. Place the project inside `C:\xampp\htdocs\fweb`.
3. Start Apache and MySQL using XAMPP.
4. Open phpMyAdmin and create a database named `db_portfolio`.
5. Import `database.sql` into the database.
6. Create a dedicated MySQL user with:
   - SELECT access to info, skills, projects, and certificates.
   - INSERT access to messages.
7. Create the private configuration file at:
   `C:\xampp\portfolio_private\db_config.php`
8. Configure the database connection credentials.
9. Add your portfolio content to the database.
10. Open `http://localhost/fweb/` in your browser.

### Important Notes

- The SQL file contains database structure only.
- Portfolio content must be added separately.
- Never commit database passwords or private configuration files.
- The private configuration file must remain outside `htdocs`.
