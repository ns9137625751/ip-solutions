# IPR Connect - Deployment Guide

## Quick Start

### 1. Run Seeder
```bash
php artisan db:seed
```

### 2. Build Frontend Assets
```bash
npm run build
```

### 3. Start Server
```bash
php artisan serve
```

### 4. Access Application
- Homepage: http://localhost:8000
- Admin Dashboard: http://localhost:8000/admin
- Login: http://localhost:8000/login

## Test Credentials
- Email: demo@example.com
- Password: password

## Project Structure

```
app/
├── Http/Controllers/
│   ├── Admin/
│   │   └── AdminController.php      # Admin panel
│   ├── DashboardController.php      # User dashboard
│   ├── HomeController.php           # Public pages
│   ├── IdeaController.php           # Idea CRUD
│   └── InterestController.php       # Express interest
├── Models/
│   ├── User.php
│   ├── Idea.php
│   └── Interest.php

resources/views/
├── layouts/
│   └── app.blade.php               # Main layout
├── ideas/
│   ├── index.blade.php             # Browse ideas
│   ├── show.blade.php              # Idea details
│   └── create.blade.php            # Post idea form
├── admin/
│   └── dashboard.blade.php         # Admin panel
├── home.blade.php                  # Homepage
├── dashboard.blade.php             # User dashboard
├── about.blade.php
└── contact.blade.php

database/migrations/
├── 2024_01_01_000003_create_ideas_table.php
└── 2024_01_01_000004_create_interests_table.php
```

## Key Features

### For Users
✓ Browse patent-ready ideas
✓ Filter by domain, stage, technology
✓ Express interest in ideas
✓ Post new ideas
✓ Track interests and submissions
✓ Secure authentication

### For Admins
✓ Review pending ideas
✓ Approve/reject submissions
✓ Toggle featured status
✓ View statistics

## Database Schema

### ideas
- user_id (creator)
- title, summary
- stage (Ideation → Commercial)
- domain, technology_type
- co_applicants_needed
- funding_requirement
- filing_date
- document_path
- status (pending/approved/rejected)
- is_featured

### interests
- idea_id
- user_id (interested person)
- message
- status (pending/accepted/rejected)
- is_verified

## Routes Overview

### Public
- GET / → Homepage
- GET /ideas → Browse ideas
- GET /ideas/{id} → Idea details
- GET /about → About page
- GET /contact → Contact page

### Authenticated
- GET /dashboard → User dashboard
- GET /post-idea → Post idea form
- POST /ideas → Submit idea
- POST /ideas/{id}/interest → Express interest

### Admin
- GET /admin → Admin dashboard
- POST /admin/ideas/{id}/approve
- POST /admin/ideas/{id}/reject
- POST /admin/ideas/{id}/toggle-featured

## Customization

### Change App Name
Edit `.env`:
```
APP_NAME="Your Platform Name"
```

### Email Configuration
Edit `.env` for email notifications:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
```

### Add Admin Role
Add `is_admin` column to users table:
```bash
php artisan make:migration add_is_admin_to_users_table
```

## Production Deployment

### 1. Environment
```bash
APP_ENV=production
APP_DEBUG=false
```

### 2. Optimize
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 3. Security
- Enable HTTPS
- Set strong APP_KEY
- Configure CORS
- Set up rate limiting

## Troubleshooting

### Issue: Routes not working
```bash
php artisan route:clear
php artisan cache:clear
```

### Issue: Assets not loading
```bash
npm run build
php artisan storage:link
```

### Issue: Database errors
```bash
php artisan migrate:fresh --seed
```

## Next Development Steps

1. Email notifications (Mailables)
2. In-platform messaging
3. Payment integration
4. User verification system
5. Advanced search with Elasticsearch
6. API for mobile app
7. Real-time notifications (Pusher/WebSockets)
8. Document preview
9. Idea analytics
10. Export functionality

## Support
For issues or questions, refer to Laravel documentation:
- https://laravel.com/docs
- https://tailwindcss.com/docs
