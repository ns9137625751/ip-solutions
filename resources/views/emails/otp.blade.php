<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Email Verification</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <div style="text-align: center; margin-bottom: 30px;">
            <h1 style="color: #1f2937; margin: 0;">IP Solutions</h1>
            <p style="color: #6b7280; margin: 5px 0;">Innovation Platform</p>
        </div>
        
        <h2 style="color: #1f2937; margin-bottom: 20px;">Email Verification</h2>
        
        <p style="color: #374151; line-height: 1.6;">Hello {{ $name }},</p>
        
        <p style="color: #374151; line-height: 1.6;">Thank you for registering with IP Solutions. To complete your registration, please use the following OTP:</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <div style="background-color: #f3f4f6; padding: 20px; border-radius: 8px; display: inline-block;">
                <h1 style="color: #1f2937; margin: 0; font-size: 32px; letter-spacing: 5px;">{{ $otp }}</h1>
            </div>
        </div>
        
        <p style="color: #374151; line-height: 1.6;">This OTP will expire in 10 minutes. If you didn't request this verification, please ignore this email.</p>
        
        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb; text-align: center;">
            <p style="color: #6b7280; font-size: 14px; margin: 0;">© {{ date('Y') }} IP Solutions. All rights reserved.</p>
        </div>
    </div>
</body>
</html>