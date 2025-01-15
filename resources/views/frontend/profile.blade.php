<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dixtron Computers Login</title>
  <style>
    /* Basic reset for the body */
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }

    /* Centered container styling */
    .login-container {
      background-color: #ffffff;
      padding: 40px;
      width: 350px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      text-align: center;
    }

    /* Logo styling */
    .logo {
      font-size: 24px;
      font-weight: bold;
      color: #333;
    }
    .logo span {
      color: #e74c3c;
    }

    /* Form styling */
    .login-form {
      margin-top: 20px;
    }
    .login-form h2 {
      font-size: 20px;
      margin-bottom: 10px;
      color: #333;
    }
    .login-form p {
      color: #666;
      font-size: 14px;
    }
    .login-form input[type="email"] {
      width: 100%;
      padding: 12px;
      margin: 12px 0;
      border: 1px solid #e74c3c;
      border-radius: 4px;
      font-size: 14px;
    }
    .login-form button {
      width: 100%;
      padding: 12px;
      background-color: #ccc;
      border: none;
      color: #666;
      font-size: 14px;
      cursor: not-allowed;
      border-radius: 4px;
    }

    /* Privacy link styling */
    .privacy {
      margin-top: 10px;
      font-size: 12px;
      color: #666;
    }
    .privacy a {
      color: #e74c3c;
      text-decoration: none;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <!-- Logo -->
    <div class="logo">Dixtron<span>computers</span>.co.uk</div>

    <!-- Login form -->
    <form class="login-form">
      <h2>Log in</h2>
      <p>Enter your email and we'll send you a login code</p>
      <input type="email" id="email" placeholder="Email" required>
      <button type="button" disabled>Continue</button>
      <div class="privacy">
        <a href="#">Privacy</a>
      </div>
    </form>
  </div>

</body>
</html>
