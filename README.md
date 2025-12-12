# IP Solutions - Innovation & Patent Collaboration Platform

[![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

A modern web platform connecting innovators with partners and funding opportunities. Built with Laravel 12 and featuring a clean, responsive design optimized for both desktop and mobile devices.

## 🚀 Live Demo

**Production:** [https://ipsolutions.in](https://ipsolutions.in)

## ✨ Features

### 🔐 Authentication & Security
- **Email OTP Verification** - Secure registration with 6-digit OTP sent via email
- **Role-based Access Control** - Admin and user roles with protected routes
- **Email Verification Middleware** - Ensures all users verify their email before platform access

### 💡 Idea Management
- **Post Ideas** - Users can submit detailed innovation projects
- **Idea Approval System** - Admin moderation with approve/reject functionality
- **Featured Ideas** - Highlight promising projects on homepage
- **Visibility Controls** - Admin can show/hide ideas from public view
- **Advanced Filtering** - Search by stage, domain, funding requirements

### 🤝 Collaboration Features
- **Express Interest** - Users can show interest in ideas with custom messages
- **Unlimited Submissions** - Multiple interest expressions per user per idea
- **Interest Management** - Comprehensive admin panel for managing all interests
- **Contact System** - Built-in contact form with admin dashboard

### 📱 Mobile-First Design
- **Fully Responsive** - Optimized for all screen sizes
- **Mobile Navigation** - Hamburger menu for mobile devices
- **Touch-Friendly UI** - Large buttons and easy navigation on mobile
- **Card-Based Layout** - Clean, modern design with glass-effect styling

### 🛠️ Admin Dashboard
- **Comprehensive Analytics** - User stats, idea metrics, engagement data
- **User Management** - Promote/demote admins, user activity tracking
- **Content Moderation** - Approve/reject ideas, manage visibility
- **Interest Tracking** - Detailed view of all user interests and messages
- **Dynamic Settings** - Update contact info and homepage stats without code changes

### 🔍 SEO Optimized
- **Dynamic Meta Tags** - Title, description, keywords for each page
- **XML Sitemap** - Auto-generated sitemap for search engines
- **Open Graph Tags** - Social media sharing optimization
- **Structured Data** - Schema.org markup for better search visibility
- **Robots.txt** - Proper search engine crawling instructions

## 🛠️ Technology Stack

- **Backend:** Laravel 12.x, PHP 8.2+
- **Frontend:** Tailwind CSS, Alpine.js, Vite
- **Database:** MySQL
- **Email:** SMTP (Gmail configured)
- **Authentication:** Laravel Breeze with custom OTP system
- **Timezone:** Asia/Kolkata (Indian Standard Time)

## 📦 Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL

### Setup Instructions

1. **Clone the repository**
```bash
git clone https://github.com/yourusername/ip-solutions.git
cd ip-solutions
```

2. **Install PHP dependencies**
```bash
composer install
```

3. **Install Node.js dependencies**
```bash
npm install
```

4. **Environment configuration**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configure your `.env` file**
```env
APP_NAME="IP Solutions"
APP_URL=http://localhost:8000
APP_TIMEZONE=Asia/Kolkata

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ip_solutions
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@ipsolutions.com"
MAIL_FROM_NAME="${APP_NAME}"
```

6. **Database setup**
```bash
php artisan migrate
php artisan db:seed
```

7. **Build assets**
```bash
npm run build
```

8. **Start the development server**
```bash
php artisan serve
```

## 👤 Default Admin Account

After running the seeder:
- **Email:** admin@example.com
- **Password:** password

## 📁 Project Structure

```
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/AdminController.php
│   │   ├── Auth/RegisteredUserController.php
│   │   ├── HomeController.php
│   │   ├── IdeaController.php
│   │   └── InterestController.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Idea.php
│   │   ├── Interest.php
│   │   ├── Contact.php
│   │   └── Setting.php
│   ├── Mail/OtpMail.php
│   └── Middleware/
├── resources/
│   ├── views/
│   │   ├── admin/
│   │   ├── auth/
│   │   ├── ideas/
│   │   └── layouts/
│   └── css/app.css
├── database/
│   ├── migrations/
│   └── seeders/
└── routes/web.php
```

## 🎨 Key Features Showcase

### Homepage
- Hero section with animated counters
- Featured ideas carousel
- How it works section
- Dynamic stats from database

### Ideas Platform
- Browse all approved ideas
- Advanced search and filtering
- Detailed idea pages with sharing options
- Interest expression system

### Admin Panel
- Dashboard with comprehensive analytics
- User management with role controls
- Idea moderation system
- Interest tracking and management
- Dynamic settings configuration

### Mobile Experience
- Responsive navigation with hamburger menu
- Card-based layouts for mobile
- Touch-optimized buttons and forms
- Mobile-first admin interface

## 🔧 Configuration

### Email Settings
Configure SMTP settings in `.env` for OTP functionality:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
```

### Timezone
The application is configured for Indian timezone:
```env
APP_TIMEZONE=Asia/Kolkata
```

## 🚀 Deployment

### Production Checklist
1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false`
3. Configure production database
4. Set up proper SMTP credentials
5. Run `php artisan config:cache`
6. Run `php artisan route:cache`
7. Run `php artisan view:cache`
8. Upload built assets from `public/build/`

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 📞 Support

For support and queries:
- **Email:** support@ipsolutions.com
- **Website:** [https://ipsolutions.com](https://ipsolutions.com)

## 🙏 Acknowledgments

- Laravel Framework
- Tailwind CSS
- Inter Font Family
- All contributors and users

---

**Built with ❤️ for the innovation community**