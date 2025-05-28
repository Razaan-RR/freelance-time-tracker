<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            width: 350px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px 14px;
            margin-bottom: 18px;
            border: 1.8px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }
        input[type="email"]:focus, input[type="password"]:focus {
            border-color: #3490dc;
            outline: none;
        }
        .button-group {
            display: flex;
            justify-content: space-between;
        }
        button, .register-link {
            padding: 10px 20px;
            font-weight: 600;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
            font-size: 15px;
            flex: 1;
            margin: 0 5px;
        }
        button {
            background-color: #3490dc;
            color: white;
        }
        button:hover {
            background-color: #2779bd;
        }
        .register-link {
            background-color: #6c757d;
            color: white;
            line-height: 38px;
            display: inline-block;
        }
        .register-link:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form method="POST" action="/loginPage">
            @csrf
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <div class="button-group">
                <button type="submit">Login</button>
                <a href="/registrationPage" class="register-link">Register</a>
            </div>
        </form>
    </div>
</body>
</html>
