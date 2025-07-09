<?php
// Include database connection
include_once "php/db.php";

// Check if the symptom ID is provided in the URL
if(isset($_GET['symptom_id']) && !empty($_GET['symptom_id'])) {
    $symptomID = $_GET['symptom_id'];

    // Fetch the details of the selected symptom
    $sql = "SELECT * FROM symptoms WHERE symptom_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $symptomID);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1) {
        $symptom = $result->fetch_assoc();

        // Fetch list of diseases from the database
        $query = "SELECT * FROM diseases";
        $result = mysqli_query($conn, $query);

        // Check if there are any diseases
        if(mysqli_num_rows($result) > 0) {
            // Diseases found, fetch and display them
            $diseases = mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            // No diseases found
            $diseases = [];
        }

        // Close database connection
        mysqli_close($conn);
    } else {
        // If no matching symptom found, redirect back to the previous page
        echo '<script>alert("no matching symptom found"); location.href="../manage-symptoms.php";</script>';
        exit;
    }
} else {
    // If symptom ID is not provided in the URL, redirect back to the previous page
    echo '<script>alert("please provide a valid symptom id"); location.href="../manage-symptoms.php";</script>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Diseases for Symptom</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Link to your CSS file for styling -->
    <link rel="stylesheet" href="css/nav.css"> <!-- Link to your CSS file for styling -->
    <link rel="stylesheet" href="css/u-s-d.css"> <!-- Link to your CSS file for styling -->
</head>
<body>
    <header>
        <h1>Select Diseases for Symptom: <?php echo htmlspecialchars($symptom['name']); ?></h1>
    </header>
    <?php include "nav.php"; ?>
    <main>
        <form action="php/process-selected-diseases.php" method="POST">
            <input type="hidden" name="symptom_id" value="<?php echo $symptomID; ?>">
            <h2>Select Diseases</h2>
            <p>Select the diseases associated with the symptom "<?php echo htmlspecialchars($symptom['name']); ?>".</p>
            <fieldset>
                <legend>Diseases</legend>
                <?php foreach ($diseases as $disease): ?>
                    <input type="checkbox" name="diseases[]" value="<?php echo $disease['disease_id']; ?>">
                    <?php echo htmlspecialchars($disease['name']); ?><br>
                <?php endforeach; ?>
            </fieldset>
            <button type="submit" class="btn">Submit</button>
        </form>
    </main>
    <footer>
        <p>&copy; Diagnogenie.</p>
    </footer>
</body>
</html>
