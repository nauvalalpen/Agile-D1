<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Account Deleted - oneVision</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(135deg, #6c757d, #495057);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .content {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }

        .farewell-icon {
            background: white;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: #6c757d;
            font-size: 24px;
        }

        .info-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #6c757d;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="farewell-icon">
            👋
        </div>
        <h1>Goodbye from oneVision</h1>
    </div>

    <div class="content">
        <p>Hello {{ $user->name }},</p>

        <p>We're writing to confirm that your oneVision account has been successfully deleted as requested.</p>

        <div class="info-box">
            <h3>📋 What was deleted:</h3>
            <ul>
                <li>Your profile information and personal data</li>
                <li>All active orders and bookings (cancelled)</li>
                <li>Your order history and preferences</li>
                <li>Account settings and notifications</li>
            </ul>
        </div>

        <div class="info-box">
            <h3>💾 Data retention:</h3>
            <p>Some data may be retained for legal and business purposes as outlined in our Privacy Policy:</p>
            <ul>
                <li>Transaction records (for accounting purposes)</li>
                <li>Support tickets and communications</li>
                <li>Anonymized usage analytics</li>
            </ul>
            <p>This data will be permanently deleted according to our retention schedule.</p>
        </div>

        <h3>🔄 Want to come back?</h3>
        <p>You're always welcome to create a new account with us. However, please note that:</p>
        <ul>
            <li>Your previous order history won't be restored</li>
            <li>You'll need to set up your preferences again</li>
            <li>Any loyalty points or credits are permanently lost</li>
        </ul>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('/') }}" class="btn">
                Visit oneVision
            </a>
        </div>

        <div class="info-box">
            <h3>📞 Need help?</h3>
            <p>If you have any questions about the deletion process or need assistance, please contact our support team
                within 30 days.</p>
        </div>

        <p>Thank you for being part of the oneVision community. We're sorry to see you go and hope you had a positive
            experience with our services.</p>

        <p>We wish you all the best in your future adventures!</p>

        <p>Best regards,<br>
            The oneVision Team</p>
    </div>

    <div class="footer">
        <p>This is an automated message confirming your account deletion.</p>
        <p>If you did not request this deletion, please contact us immediately at <a
                href="mailto:support@onevision.com">support@onevision.com</a></p>
        <hr style="border: none; border-top: 1px solid #eee; margin: 20px 0;">
        <p>&copy; {{ date('Y') }} oneVision. All rights reserved.</p>
    </div>
</body>

</html>
