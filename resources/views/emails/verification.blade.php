<!DOCTYPE html>
<html>
<head>
    <title>One-Time Password (OTP) from Kojax</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }

        h2 {
            color: #2F0468;
        }

        p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('img/logo/navabar.png') }}" alt="Your Company Logo" class="logo">
        <h2>One-Time Password (OTP)</h2>
        <p>Your One-Time Password (OTP) is: <strong>{{ $otp }}</strong></p>
        <p>Please use this OTP to complete your verification process.</p>
    </div>
</body>
</html>

