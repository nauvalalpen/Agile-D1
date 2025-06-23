<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $isNewAccount ? 'Welcome to oneVision' : 'Google Login Notification' }}</title>
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
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
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

        .google-icon {
            background: white;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .info-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #2563eb;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="google-icon">
            <svg width="24" height="24" viewBox="0 0 24 24">
                <path fill="#4285F4"
                    d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                <path fill="#34A853"
                    d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                <path fill="#FBBC05"
                    d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                <path fill="#EA4335"
                    d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
            </svg>
        </div>
        <h1>{{ $isNewAccount ? 'Welcome to oneVision!' : 'Google Login Notification' }}</h1>
    </div>

    <div class="content">
        <p>Hello {{ $user->name }},</p>

        @if ($isNewAccount)
            <p>Welcome to oneVision! Your account has been successfully created using your Google account.</p>

            <div class="info-box">
                <h3>🎉 Account Created Successfully</h3>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Login Method:</strong> Google OAuth</p>
                <p><strong>Account Status:</strong> Verified ✅</p>
            </div>

            <p>You can now enjoy all the features of oneVision:</p>
            <ul>
                <li>🗺️ Interactive maps and location services</li>
                <li>🌤️ Weather information</li>
                <li>🏢 Facility browsing</li>
                <li>📸 Photo galleries</li>
                <li>📰 Latest news and updates</li>
                <li>🍯 Honey products and UMKM services</li>
                <li>👨‍🏫 Tour guide bookings</li>
            </ul>
        @else
            <p>You have successfully signed in to your oneVision account using Google.</p>

            <div class="info-box">
                <h3>🔐 Login Details</h3>
                <p><strong>Time:</strong> {{ $loginTime }}</p>
                <p><strong>IP Address:</strong> {{ $ipAddress }}</p>
                <p><strong>Method:</strong> Google OAuth</p>
            </div>

            <p>If this wasn't you, please secure your Google account immediately and contact our support team.</p>
        @endif

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('/') }}"
                style="background: linear-gradient(135deg, #2563eb, #1d4ed8); color: white; padding: 12px 30px; text-decoration: none; border-radius: 25px; display: inline-block;">
                {{ $isNewAccount ? 'Explore oneVision' : 'Go to Dashboard' }}
            </a>
        </div>
    </div>

    <div class="footer">
        <p>This is an automated message from oneVision.</p>
        <p>If you have any questions, please contact our support team.</p>
        <p>&copy; {{ date('Y') }} oneVision. All rights reserved.</p>
    </div>
</body>

</html>
