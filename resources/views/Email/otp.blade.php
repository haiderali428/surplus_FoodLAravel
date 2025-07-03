<!DOCTYPE html>
<html>
<head>
    <title>Your OTP Code</title>
</head>
<body>
    <h2>Hello!</h2>
    <p>Your One-Time Password (OTP) is: <strong>{{ $otp }}</strong></p>
    <p>Please use this code to verify your identity.</p>
    <br>
    <p>Thank you,<br>{{ config('app.name') }} Team</p>
</body>
</html>
