<!-- resources/views/auth/reset-password-custom.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h1>Hello, <?php echo e($user->name); ?></h1>
    <p>You requested a password reset. Click the link below to reset your password:</p>

    <a href="<?php echo e($url); ?>" style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none;">
        Reset Password
    </a>

    <p>If you did not request this password reset, please ignore this email.</p>

    <p>Thank you,<br>Your Application Team</p>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Aplikasi_Manajemen_Kantor_v.1.2\resources\views/auth/reset-password-custom.blade.php ENDPATH**/ ?>