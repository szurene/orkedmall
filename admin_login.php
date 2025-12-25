<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Orked Mall</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand-sand: #e5dcd6;
            --brand-rose: #e19bb1;
            --text-dark: #333333;
            --border-light: #e0e0e0;
            --white: #ffffff;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--brand-sand); /* Sandstone background for the whole page */
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: var(--text-dark);
        }

        .login-container {
            background: var(--white);
            padding: 60px 40px;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.05);
            text-align: center;
            width: 100%;
            max-width: 380px;
            box-sizing: border-box;
        }

        .login-container img {
            width: 100px;
            height: auto;
            margin-bottom: 20px;
        }

        .login-container h1 {
            font-size: 20px;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 40px;
            color: var(--text-dark);
        }

        .login-container input {
            width: 100%;
            padding: 14px;
            margin-bottom: 15px;
            border: 1px solid var(--border-light);
            border-radius: 4px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
            background-color: #f9f9f9;
            transition: border-color 0.3s;
        }

        .login-container input:focus {
            outline: none;
            border-color: var(--brand-rose);
        }

        .login-container button {
            width: 100%;
            padding: 14px;
            font-size: 13px;
            letter-spacing: 2px;
            text-transform: uppercase;
            background: var(--text-dark);
            color: var(--white);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        .login-container button:hover {
            background: var(--brand-rose);
            transform: translateY(-2px);
        }

        .back-home {
            display: block;
            margin-top: 25px;
            font-size: 12px;
            text-decoration: none;
            color: #999;
            letter-spacing: 1px;
            transition: 0.3s;
        }

        .back-home:hover {
            color: var(--brand-rose);
        }
    </style>
</head>
<body>

<div class="login-container">
    <a href="index.html">
        <img src="images/logo.png" alt="Orked Mall Logo">
    </a>

    <h1>Admin Portal</h1>

    <form action="admin-dashboard.html" method="POST">
        <input type="text" name="username" placeholder="Admin Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Secure Login</button>
    </form>

    <a href="index.html" class="back-home">← Back to Main Site</a>
</div>

</body>
</html>