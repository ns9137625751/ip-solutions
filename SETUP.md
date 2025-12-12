# IPR Connect - Innovation & Patent Collaboration Platform

## Setup Instructions

### 1. Install Dependencies
```bash
composer install
npm install
```

### 2. Environment Configuration
The `.env` file is already configured. Make sure these settings are correct:
```
DB_CONNECTION=sqlite
DB_DATABASE=new_ipr_laravel
```

### 3. Run Migrations
```bash
php artisan migrate
```

### 4. Seed Sample Data (Optional)
```bash
php artisan db:seed
```
This creates sample ideas and a demo user:
- Email: demo@example.com
- Password: password

### 5. Create Storage Link
```bash
php artisan storage:link
```

### 6. Build Assets
```bash
npm run build
```
Or for development:
```bash
npm run dev
```

### 7. Start Development Server
```bash
php artisan serve
```

Visit: http://localhost:8000

## Features Implemented

### Public Pages
- **Homepage** - Hero section with featured ideas and how it works
- **Explore Ideas** - Browse all approved ideas with filters (domain, stage, technology)
- **Idea Details** - View complete idea information
- **About Us** - Mission and platform features
- **Contact** - Contact form and information

### Authentication
- Login/Register (Laravel Breeze)
- Password reset functionality

### User Features
- **Post Ideas** - Submit new ideas for review
- **Express Interest** - Show interest in ideas with optional message
- **Dashboard** - Manage posted ideas and track interests
- **Profile Management** - Update account details

### Idea Management
- Title, summary, stage, domain, technology type
- Co-applicants needed, funding requirements
- Document upload support
- Admin approval system (status: pending/approved/rejected)
- Featured ideas highlighting

### Database Structure
- **users** - User accounts
- **ideas** - Innovation ideas
- **interests** - User interest in ideas

## Default User Credentials
After running `php artisan db:seed`:
- Email: demo@example.com
- Password: password

## Key Routes
- `/` - Homepage
- `/ideas` - Browse ideas
- `/ideas/create` - Post new idea (auth required)
- `/ideas/{id}` - View idea details
- `/dashboard` - User dashboard (auth required)
- `/about` - About page
- `/contact` - Contact page

## Admin Features (To Be Implemented)
- Approve/reject ideas
- Manage users
- View analytics
- Moderate content

## Technology Stack
- Laravel 12
- Laravel Breeze (Authentication)
- Tailwind CSS
- SQLite Database
- Blade Templates

## Color Scheme
- Primary: Blue (#2563EB)
- Secondary: White (#FFFFFF)
- Accent: Grey (#6B7280)
- Background: Light Grey (#F9FAFB)

## Next Steps
1. Implement email notifications for interests
2. Add admin panel for idea approval
3. Implement in-platform messaging
4. Add payment verification system
5. Implement advanced search and filters
6. Add user verification badges
7. Create analytics dashboard
