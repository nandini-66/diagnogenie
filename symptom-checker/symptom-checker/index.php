<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Symptoms Checker</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Link to your CSS file for styling -->
</head>
<body>
    <header>
        <h1>Welcome to Symptoms Checker</h1>
        <p>A tool to help you identify possible diseases based on your symptoms.</p>
        <?php include "nav.php"; ?>
    </header>

    <main>
        <div class="container">
            <div class="content">
                <h2><span class="Decode">D</span>ecode Symptoms<br>
                <span class="discover">D</span>iscover Solutions.</h2>
                <p> Welcome to Diagnogenie, Your Reliable Companion for Symptom Analysis.
                <br>Explore our intuitive tool and empower yourself with informed decisions for a healthier tomorrow.
            </p>
                <div class="button-container">
                    <?php 
                        if (isset($_SESSION['username'])) {
                            echo '<a href="symptom-selection.php" class="button-container">Check Symptoms</a>';
                        }else{
                            echo '<a href="register.php" class="button-container">Get Started</a>';
                        }
                    ?>
                </div>
            </div>
            <div class="image-container">
                <img src="https://img.freepik.com/free-vector/online-doctor-concept_23-2148529536.jpg" alt="your-Image"/>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; Diagnogenie.</p>
        <?php
        if (!isset($_SESSION['username'])) {
                echo '<a href="admin/admin-login.php" class="btn">Admin Login</a>';
            }
        
        ?>
    </footer>
</body>
</html>