<nav>
    <ul>
        <li><a href="admin-dashboard.php">Home</a></li>
        <li><a href="manage-symptoms.php">Manage Symptoms</a></li>
        <li><a href="manage-diseases.php">Manage Diseases</a></li>
        <li><a href="manage-user-feedback.php">Manage User Feedback</a></li>
        <li><a href="manage-user.php">Manage User Accounts</a></li>
        <?php
         if(isset($_SESSION['username'])){
            echo '<li><a href="php/logout.php">Log Out</a></li>';
         }
         ?>
    </ul>
</nav>