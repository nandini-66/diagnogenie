
<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        
        <li><a href="symptom-selection.php">Check Symptoms</a></li>
        <li><a href="feedback.php">Feedback</a></li>
        <?php
         session_start();
         if(isset($_SESSION['username'])){
            echo '<li><a href="php/logout.php">Log Out</a></li>';
         }else{
            echo '<li><a href="register.php">Log In</a></li>';
         }
        ?>
    </ul>
</nav>