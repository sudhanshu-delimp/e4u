<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New User Registration - Admin Notification</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 30px;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <tr>
            <td style="padding: 24px 32px;">
                <h2 style="color: #333;">New User Registration</h2>
                <p>Hello Admin,</p>
                <p>A new user has registered on the platform. Here are the details:</p>
                <table cellpadding="6" cellspacing="0" style="background: #f2f2f2; border-radius: 4px;">
                    <tr>
                        <td><strong>Name:</strong></td>
                        <td>{{ $user->name ?? 'Test User' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td>{{ $user->email ?? 'test@example.com' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Registered At:</strong></td>
                        <td>{{ $user->created_at ?? now() }}</td>
                    </tr>
                </table>
                <p style="margin-top: 24px;">Please review the new registration in the admin panel.</p>
                <p>Thank you,<br>The E4U Team</p>
            </td>
        </tr>
    </table>
</body>
</html>