<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Symptoms</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Link to your CSS file for styling -->
    <link rel="stylesheet" href="css/select-symptoms.css"> <!-- Link to your CSS file for styling -->
</head>
<body>
    <header>
        <h1>Select Symptoms</h1>
        <p>Please select any symptoms you are experiencing:</p>
    </header>
    <?php include "nav.php"; 
    if(!isset($_SESSION['username'])){
        echo '<script> alert("Login OR Register First !"); location.href="register.php" </script>';
    }
    ?>
    <main>
        <form action="process-symptoms.php" method="POST">
            <fieldset>
                <legend>Symptoms</legend>
                <?php
                    include "php/db.php";
                    $sql = "SELECT * FROM symptoms";
                    $result = mysqli_query($conn, $sql) or die("Query Failed");
                    if(mysqli_num_rows($result)> 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<input type='checkbox' name='symptoms[]' value='".$row['name']."'>".$row['name']."<br>";
                            document.addEventListener('DOMContentLoaded', (event) => {
                                const maxSelection = 5;
                                const checkboxes = document.querySelectorAll('input[type="checkbox"][name="symptom"]');
                            
                                checkboxes.forEach((checkbox) => {
                                    checkbox.addEventListener('change', () => {
                                        const checkedCheckboxes = document.querySelectorAll('input[type="checkbox"][name="symptom"]:checked');
                                        if (checkedCheckboxes.length > maxSelection) {
                                            checkbox.checked = false;
                                            alert(Aap sirf ${maxSelection} symptoms hi select kar sakte hain.);
                                        }
                                    });
                                });
                            });
                        }
                }
                ?>
                <button type="submit" class="btn">Submit</button>
            </fieldset>
        </form>
    </main>
    <div class="image-container">
                <img src="https://img.freepik.com/free-vector/online-doctor-concept_23-2148529536.jpg" alt="your-Image"/>
            </div>
    <footer>
        <p>&copy; Diagnogenie.</p>
    </footer>
</body>
</html>