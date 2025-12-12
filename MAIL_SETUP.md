# Email Configuration Guide

## Current Issue
Emails are not being sent because the mail driver is set to `log` which only saves emails to log files.

## Solution Options

### Option 1: Gmail SMTP (Recommended for Testing)

1. **Enable 2-Factor Authentication** on your Gmail account
2. **Generate App Password**:
   - Go to Google Account Settings
   - Security → 2-Step Verification → App passwords
   - Generate password for "Mail"
   
3. **Update .env file**:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-16-digit-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@ipsolutions.com"
MAIL_FROM_NAME="IP Solutions"
```

### Option 2: Mailtrap (Best for Development)

1. **Sign up** at https://mailtrap.io (Free)
2. **Get credentials** from inbox settings
3. **Update .env file**:
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@ipsolutions.com"
MAIL_FROM_NAME="IP Solutions"
```

### Option 3: Keep Log Driver (Development Only)

If you want to test without sending real emails:
```env
MAIL_MAILER=log
```

Emails will be saved to: `storage/logs/laravel.log`

## After Configuration

1. **Clear config cache**:
```bash
php artisan config:clear
```

2. **Test password reset**:
   - Go to forgot password page
   - Enter email
   - Check email inbox (or log file if using log driver)

## Troubleshooting

### Gmail "Less secure app" error
- Use App Password instead of regular password
- Enable 2-Factor Authentication first

### Connection timeout
- Check firewall settings
- Verify SMTP port is not blocked
- Try port 465 with SSL instead of 587 with TLS

### "Failed to authenticate"
- Double-check username and password
- Ensure no extra spaces in .env file
- Clear config cache

## Check Email Logs

View sent emails in log:
```bash
tail -f storage/logs/laravel.log
```

## Production Setup

For production, use:
- AWS SES
- SendGrid
- Mailgun
- Postmark

Update .env accordingly with service credentials.
