<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two-Factor Authentication Code</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; text-align: center;">

    <div style="max-width: 500px; margin: auto; background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <h2 style="color: #333;">Two-Factor Authentication</h2>

        Hello {{ $user->name }},

        <p style="font-size: 18px; color: #555;">Your authentication code is:</p>
        
        <div style="font-size: 24px; font-weight: bold; color: #007bff; padding: 10px; border: 1px dashed #007bff; display: inline-block; margin: 10px 0;">
            {{ $code }}
        </div>

        <p style="color: #777;">This code will expire in 3 minutes. Do not share it with anyone.</p>

        <p style="font-size: 14px; color: #888;">If you did not request this, please ignore this email.</p>

        <hr style="margin: 20px 0; border: none; border-top: 1px solid #ddd;">
        <p style="font-size: 12px; color: #aaa;">New Ground Generation Church. &copy; {{ date('Y') }}  All rights reserved.</p>
    </div>

</body>
</html>