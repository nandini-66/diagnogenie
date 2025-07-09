<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/process-symptoms.css">
</head>
<body>
    <header>
        <h1> Diagnogenie</h1>
    </header>
    <main>
        <div class="contaner">
            <?php
                // Include the navigation bar
                include "nav.php"; 

                // Check if the form is submitted
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Check if symptoms are selected
                    if (isset($_POST["symptoms"]) && !empty($_POST["symptoms"])) {
                        // Process the selected symptoms
                        $selectedSymptoms = $_POST["symptoms"];

                        // Connect to your database (replace placeholders with actual database credentials)
                        include_once "php/db.php";

                        // Prepare a SQL query to retrieve diseases based on selected symptoms
                        $sql = "SELECT d.name AS disease_name, d.description AS disease_description , d.treatment_options AS treatment
                                FROM diseases d
                                JOIN disease_symptoms ds ON d.disease_id = ds.disease_id
                                JOIN symptoms s ON ds.symptom_id = s.symptom_id
                                WHERE s.name IN ('" . implode("','", $selectedSymptoms) . "')
                                GROUP BY d.disease_id
                                HAVING COUNT(DISTINCT s.symptom_id) = " . count($selectedSymptoms);

                        $result = $conn->query($sql);

                        // Display the results
                        if ($result->num_rows > 0) {
                            echo "<h2>Possible Diseases:</h2>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<h3>Disease Name :" . $row["disease_name"] . "</h3>";
                                echo "<p><b>Disease Description :</b>" . $row["disease_description"] . "</p>";
                                echo "<p><b>Disease Treatment Options :</b>" . $row["treatment"] . "</p>";
                            }
                        } else {
                            echo "<p>No matching diseases found based on the selected symptoms.</p>";
                        }

                        // Close the database connection
                        $conn->close();
                    } else {
                        echo "<p>No symptoms selected. Please go back and select at least one symptom.</p>";
                    }
                } else {
                    // Redirect to the homepage if accessed directly without form submission
                    header("Location: index.php");
                    exit;
                }
                ?>
        </div>
    </main>
    <footer>
        <p>&copy; Diagnogenie.</p>
    </footer>
</body>
</html>