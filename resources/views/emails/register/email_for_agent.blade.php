<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Agent Registration Confirmation</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f7f7f7; margin: 0; padding: 0; }
        .container { background: #fff; max-width: 600px; margin: 40px auto; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);}
        h2 { color: #2c3e50; }
        p { color: #444; }
        .footer { margin-top: 30px; font-size: 12px; color: #888; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, {{ $agentName ?? 'Agent' }}!</h2>
        <p>
            Thank you for registering as an agent with us. Your account has been successfully created.
        </p>
        <p>
            Please verify your email address to activate your account:
        </p>
        <p>
            <a href="{{ $verificationLink ?? '#' }}" style="background: #3498db; color: #fff; padding: 10px 20px; border-radius: 4px; text-decoration: none;">Verify Email</a>
        </p>
        <p>
            If you did not register for this account, please ignore this email.
        </p>
        <div class="footer">
            &copy; {{ date('Y') }} E4U. All rights reserved.
        </div>
    </div>
</body>
</html>