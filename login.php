<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/GEL.png" type="image/x-icon"/>
    <title>Login PT.GEL</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #e8f0fe;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url(img/GEDUNG.jpeg)
        }
        .login-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.1);
            width: 360px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        h1 {
            margin-bottom: 24px;
            font-size: 28px;
            color: #34495e;
        }

        input[type="text"], input[type="password"] {
            padding: 12px;
            font-size: 16px;
            border: 1px solid #dfe6e9;
            border-radius: 8px;
            width: 100%;
            margin-bottom: 20px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #3498db;
            outline: none;
        }

        button {
            padding: 12px 0;
            font-size: 18px;
            cursor: pointer;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 8px;
            width: 100%;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        button:hover {
            background-color: #2980b9;
            transform: scale(1.05);
        }

        button:active {
            transform: scale(0.98);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive Design */
        @media (max-width: 400px) {
            .login-container {
                width: 90%;
                padding: 20px;
            }

            h1 {
                font-size: 24px;
            }

            button {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

<body>

<div class="login-container">
    <h1>Login Nomer Surat</h1>
    <form method="POST">
        <input type="text" name="divisi" placeholder="Divisi" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>

<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $divisi = $_POST['divisi'];
    $password = $_POST['password'];

    // Prepare and execute SQL statement
    $stmt = $connect->prepare("SELECT * FROM user WHERE divisi = ? AND password = ?");
    $stmt->bind_param("ss", $divisi, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 1) {
        // Start session and redirect to another page
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['divisi'] = $divisi;
        header('Location: index.php'); // Redirect to the main page after successful login
    } else {
        echo "<script>alert('Divisi atau Password salah'); window.location.href='login.php';</script>";
    }

    // Close statement and connection
    $stmt->close();
    $connect->close();
}
?>

