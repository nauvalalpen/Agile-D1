<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Security Alert - oneVision</title>
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
            background: linear-gradient(135deg, #dc3545, #c82333);
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

        .security-icon {
            background: white;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: #dc3545;
            font-size: 24px;
        }

        .alert-box {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-left: 4px solid #ffc107;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .info-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #007bff;
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
            background: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            margin: 10px 0;
        }

        .btn-secondary {
            background: #6c757d;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="security-icon">
            🔒
        </div>
        <h1>Security Alert</h1>
        <p>Important changes to your account</p>
    </div>

    <div class="content">
        <p>Hello {{ $user->name }},</p>

        <div class="alert-box">
            <h3>🚨 Security Action Detected</h3>
            <p><strong>{{ $action }}</strong> was performed on your oneVision account.</p>
        </div>

        <div class="info-box">
            <h3>📋 Action Details:</h3>
            <ul>
                <li><strong>Account:</strong> {{ $user->email }}</li>
                <li><strong>Action:</strong> {{ $action }}</li>
                <li><strong>Date & Time:</strong> {{ now()->format('F j, Y \a\t g:i A T') }}</li>
                <li><strong>IP Address:</strong> {{ request()->ip() ?? 'Unknown' }}</li>
                <li><strong>Location:</strong> {{ request()->header('CF-IPCountry') ?? 'Unknown' }}</li>
            </ul>
        </div>

        @if (str_contains(strtolower($action), 'password'))
            <h3>🔐 Password Security Tips:</h3>
            <ul>
                <li>Use a unique password that you don't use elsewhere</li>
                <li>Make it at least 12 characters long</li>
                <li>Include a mix of letters, numbers, and symbols</li>
                <li>Consider using a password manager</li>
            </ul>
        @endif

        @if (str_contains(strtolower($action), '2fa') || str_contains(strtolower($action), 'two-factor'))
            <div class="info-box">
                <h3>🛡️ Two-Factor Authentication</h3>
                @if (str_contains(strtolower($action), 'enabled'))
                    <p>Great job! Two-factor authentication adds an extra layer of security to your account. Keep your
                        authenticator app safe and backed up.</p>
                @else
                    <p>Two-factor authentication has been disabled. Your account is now less secure. Consider
                        re-enabling it for better protection.</p>
                @endif
            </div>
        @endif

        <div class="alert-box">
            <h3>⚠️ Didn't make this change?</h3>
            <p>If you didn't perform this action, your account may be compromised. Take immediate action:</p>
            <ol>
                <li>Change your password immediately</li>
                <li>Enable two-factor authentication</li>
                <li>Review your recent account activity</li>
                <li>Contact our support team</li>
            </ol>
        </div>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('settings.index') }}" class="btn">
                Review Account Settings
            </a>
            <a href="{{ route('settings.index') }}#security" class="btn btn-secondary">
                Security Settings
            </a>
        </div>

        <div class="info-box">
            <h3>📞 Need Help?</h3>
            <p>If you have any concerns about your account security or need assistance:</p>
            <ul>
                <li>Email: <a href="mailto:security@onevision.com">security@onevision.com</a></li>
                <li>Phone: +1 (555) 123-4567</li>
                <li>Live Chat: Available 24/7 on our website</li>
            </ul>
        </div>

        <p>Stay safe and secure!</p>

        <p>Best regards,<br>
            The oneVision Security Team</p>
    </div>

    <div class="footer">
        <p>This is an automated security notification. Please do not reply to this email.</p>
        <p>If you believe this email was sent in error, please contact us immediately.</p>
        <hr style="border: none; border-top: 1px solid #eee; margin: 20px 0;">
        <p>&copy; {{ date('Y') }} oneVision. All rights reserved.</p>
        <p>This email was sent to {{ $user->email }} because it's associated with a oneVision account.</p>
    </div>
</body>

</html>
