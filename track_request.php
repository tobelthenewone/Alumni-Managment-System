<?php
include 'db_connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the search term from the form field
    $searchTerm = $_POST["id_number"];

    // Escape special characters to prevent SQL injection
    $searchTerm = $conn->real_escape_string($searchTerm);

    // Construct the SQL statement
    $sql = "SELECT * FROM notify_user WHERE id_number LIKE '%" . $searchTerm . "%'";
    $result = $conn->query($sql);

    // Close the database connection
}
?>
<style>
    .form_style {
        position: relative;
        top: 13%;
        max-height: ;
    }

    .masthead {
        min-height: 23vh !important;
        height: 23vh !important;
    }

    .masthead:before {
        min-height: 23vh !important;
        height: 23vh !important;
    }
</style>
<header class="masthead">
    <div class="container-fluid h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end mb-4 page-title">
                <h3 style="font-size: 30px;" class="text-blue">Track your Request</h3>
                <hr class="mx-auto divider my-2" />

                <div class="col-md-12 mb-2 justify-content-center">
                </div>
            </div>

        </div>
    </div>
</header>

<div class="container my-4 card">
    <div class="card-body">
        <form method="POST">
            <div class="form-group">
                <label for="fullName">ID Number</label>
                <input type="text" name="id_number" class="form-control" required id=""
                    placeholder="Please enter your ID Number">
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Submit</button><br><br>
        </form>
        <?php
        if (isset($result) && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Display the desired data from the row
                echo "Status Result: " . $row['admin_msg'];
                echo "<br>";
                echo "<hr>"; 
            }
        } else {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo "No results found.";
            }
        }
        ?>
    </div>
</div>