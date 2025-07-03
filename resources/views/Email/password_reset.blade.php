<!DOCTYPE html>
<html>
<head>
    <title>Password Reset Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #0C8C85;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 0 0 5px 5px;
        }
        .button {
            display: inline-block;
            background-color: #0C8C85;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Surplus Food Platform</h2>
        <p>Password Reset Request</p>
    </div>
    
    <div class="content">
        <h3>Hello!</h3>
        
        <p>You are receiving this email because we received a password reset request for your account.</p>
        
        <p>Please click the button below to reset your password:</p>
        
        <a href="{{ url('/reset_password/' . $token) }}" class="button">Reset Password</a>
        
        <p>This password reset link will expire in 1 hour.</p>
        
        <p>If you did not request a password reset, no further action is required.</p>
        
        <p>If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:</p>
        
        <p style="word-break: break-all; background-color: #f0f0f0; padding: 10px; border-radius: 3px;">
            {{ url('/reset_password/' . $token) }}
        </p>
    </div>
    
    <div class="footer">
        <p>Thank you,<br>Surplus Food Team</p>
        <p>If you did not create an account, no further action is required.</p>
    </div>
</body>
</html> 