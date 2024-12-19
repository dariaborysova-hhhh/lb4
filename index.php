<?php

$usersFile = 'users.txt';


function checkLogin($login, $password, $usersFile) {
    if (!file_exists($usersFile)) {
        return false;
    }

    
    $users = file($usersFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($users as $user) {
        
        list($storedLogin, $storedPassword) = explode(":", $user);

        
        if ($login === $storedLogin && $password === $storedPassword) {
            return true;
        }
    }

    return false;
}


$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    
    if (checkLogin($login, $password, $usersFile)) {
        echo "<p class='success'>Ви залогінені!</p>";
    } else {
        $error = 'Невірний логін або пароль';
    }
}
?>




<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Логін</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f4f7; 
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .container {
            background-color: #ffffff; 
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            color: #2575fc; 
            font-size: 14px;
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            background-color: #f7f7f7;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #2575fc;
            outline: none;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #2575fc; 
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #4C8DFF;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 15px;
        }

        .success {
            color: green;
            font-size: 16px;
            margin-top: 15px;
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Вхід до системи</h2>
        <form action="index.php" method="POST">
            <label for="login">Логін:</label>
            <input type="text" name="login" id="login" required><br>
            <label for="password">Пароль:</label>
            <input type="password" name="password" id="password" required><br>
            <input type="submit" value="Вхід">
        </form>

        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
    </div>
    
    <?php if (isset($error) && !$error && isset($login)): ?>
        <p class="success">Ви залогінені!</p>
    <?php endif; ?>
</body>
</html>
