<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>

<body>
<div>
    <h1>Email Verification</h1>
    <p>
        Thank you for registering! To complete the registration process, please verify your email address by clicking
        the button below:
    </p>
    <a href="{{ route('email.verify', ['token' => $user->email_verification_token]) }}" style="padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">Verify Email</a>
    <p>
        If you did not create an account on our platform, you can safely ignore this email.
    </p>
</div>
</body>

</html>
