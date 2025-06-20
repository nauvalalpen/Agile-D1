<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email Verification</title>
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
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .content {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 5px 5px;
        }

        .verification-code {
            background-color: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 3px;
            border-radius: 5px;
            margin: 20px 0;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Welcome to {{ config('app.name') }}!</h1>
    </div>

    <div class="content">
        <h2>Hello {{ $user->name }},</h2>

        <p>Thank you for registering with us! To complete your registration, please verify your email address using the
            verification code below:</p>

        <div class="verification-code">
            {{ $verificationCode }}
        </div>

        <p>Please enter this code on the verification page to activate your account.</p>

        <p><strong>Important:</strong> This verification code will expire in 24 hours for security reasons.</p>

        <p>If you didn't create an account with us, please ignore this email.</p>

        <p>Best regards,<br>{{ config('app.name') }} Team</p>
    </div>

    <div class="footer">
        <p>This is an automated email. Please do not reply to this message.</p>
    </div>
</body>

</html>
