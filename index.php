<?php
session_start();
include('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journeys in Ink</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // JavaScript function to toggle between Login and Sign Up forms
        function toggleForms(formType) {
            const loginForm = document.getElementById('login-form');
            const signupForm = document.getElementById('signup-form');
            if (formType === 'login') {
                loginForm.style.display = 'block';
                signupForm.style.display = 'none';
            } else {
                signupForm.style.display = 'block';
                loginForm.style.display = 'none';
            }
        }
    </script>
</head>
<body>
    <header>
        <h1>Journeys in Ink</h1>
        <nav>
            <ul>
                <li><a href="javascript:void(0);" onclick="toggleForms('login')">Login</a></li>
                <li><a href="javascript:void(0);" onclick="toggleForms('signup')">Sign Up</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <h2>Welcome</h2>
        <p>Make your day better</p>
    </section>

    <section id="login-form" style="display: block;">
        <h2>Login</h2>
        <form method="POST" action="login.php">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Login</button>
        </form>

        <p>Don't have an account? <a href="javascript:void(0);" onclick="toggleForms('signup')">Sign Up</a></p>
    </section>

    <section id="signup-form" style="display: none;">
        <h2>Sign Up</h2>
        <form method="POST" action="signup.php">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Sign Up</button>
        </form>

        <p>Already have an account? <a href="javascript:void(0);" onclick="toggleForms('login')">Login</a></p>
    </section>

    <footer>
        <p>&copy; 2024 J.i.K Diary</p>
    </footer>
</body>
</html>
