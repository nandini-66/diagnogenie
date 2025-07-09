<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration & Login</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Link to your CSS file for styling -->
    <link rel="stylesheet" href="css/login.css"> <!-- Link to your CSS file for styling -->
</head>
<body>
    <header>
        <h1>User Registration & Login</h1>
    </header>
    <?php include "nav.php"; ?>
    <main>
        <section id="registration" class="register-s">
            <div class="register">
                <h2>Register</h2>
                <form action="php/register.php" method="POST">
                    <label for="reg_full_name">Full Name:</label><br>
                    <input type="text" id="reg_full_name" name="reg_full_name" required><br>
                    <label for="reg_username">Username:</label><br>
                    <input type="text" id="reg_username" name="reg_username" required><br>
                    
                    <label for="reg_email">Email:</label><br>
                    <input type="email" id="reg_email" name="reg_email" required><br>
                    
                    <label for="reg_password">Password:</label><br>
                    <input type="password" id="reg_password" name="reg_password" required><br>
                    
                    <button type="submit" class="btn">Register</button> <br>
                    <button class="btn" onclick="login_show()">Click For Login</button>
                </form>
            </div>
        </section>
        <section id="login" class="login-s">
            <div class="login">
                <h2>Login</h2>
                <form action="php/login.php" method="POST">
                    <label for="login_username">Username or Email:</label><br>
                    <input type="text" id="login_username" name="login_username" required><br>
                    
                    <label for="login_password">Password:</label><br>
                    <input type="password" id="login_password" name="login_password" required><br>
                    
                    <button type="submit" class="btn">Login</button> <br>
                    <button class="btn" onclick="register_show()">Click For Register</button>
                </form>
            </div>
        </section>
    </main>
    <script>
        // Function to show the registration form
        function register_show() {
            document.querySelector('.register-s').style.display = 'block'; // Show the registration form
            document.querySelector('.login-s').style.display = 'none'; // Hide the login form
        }

        // Function to show the login form
        function login_show() {
            document.querySelector('.login-s').style.display = 'block'; // Show the login form
            document.querySelector('.register-s').style.display = 'none'; // Hide the registration form
        }

        // Initially hide both forms
        document.querySelector('.login-s').style.display = 'none';

        // Show the registration form by default
        window.onload = function() {
            register_show();
        };

    </script>
    <footer>
        <p>&copy; Diagnogenie.</p>
    </footer>
</body>
</html>
