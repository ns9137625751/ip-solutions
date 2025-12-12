# Admin Dashboard Guide

## Setup Admin User

### Run Migration
```bash
php artisan migrate
```

### Seed Admin User
```bash
php artisan db:seed
```

This creates:
- **Admin User**: admin@example.com / password
- **Regular User**: demo@example.com / password

### Manual Admin Creation
```bash
php artisan tinker
```
```php
$user = User::find(1);
$user->is_admin = true;
$user->save();
```

## Admin Features

### Access Admin Panel
- URL: http://localhost:8000/admin
- Only accessible to users with `is_admin = true`

### Dashboard Overview
- Total users count
- Total ideas count
- Pending ideas count
- Approved ideas count
- Total interests count
- Recent ideas list
- Recent users list

### Manage Ideas (/admin/ideas)
- View all ideas with pagination
- Approve/Reject pending ideas
- Feature/Unfeature ideas
- Delete ideas
- View idea details
- Filter by status

### Manage Users (/admin/users)
- View all users with pagination
- See user statistics (ideas count, interests count)
- Make user admin / Remove admin
- Delete users (except yourself)
- View user join date

### Manage Interests (/admin/interests)
- View all interests with pagination
- See user and idea details
- View interest messages
- Delete interests
- View related idea

## Admin Permissions

### Protected Routes
All admin routes require:
1. User must be logged in
2. User must have `is_admin = true`

### Security
- Admin middleware prevents unauthorized access
- Returns 403 error for non-admin users
- Admins cannot delete themselves

## Database Schema

### Users Table
- `is_admin` (boolean) - Admin flag

### Ideas Table
- `status` - pending/approved/rejected
- `is_featured` - Featured flag

### Interests Table
- `status` - pending/accepted/rejected

## Quick Actions

### Approve Idea
POST /admin/ideas/{id}/approve

### Reject Idea
POST /admin/ideas/{id}/reject

### Toggle Featured
POST /admin/ideas/{id}/toggle-featured

### Delete Idea
DELETE /admin/ideas/{id}

### Toggle Admin Status
POST /admin/users/{id}/toggle-admin

### Delete User
DELETE /admin/users/{id}

### Delete Interest
DELETE /admin/interests/{id}

## Navigation

Admin link appears in navigation bar only for admin users.

## Best Practices

1. Always have at least one admin user
2. Don't delete your own admin account
3. Review pending ideas regularly
4. Monitor user activity
5. Feature quality ideas to promote engagement
