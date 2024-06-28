<?php
require 'connection.php';
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $id_number = $_POST["id_number"];
    $email = $_POST["email"];
    $program_type = $_POST["program_type"];
    $department = $_POST["department"];
    $graduation_date = $_POST["graduationdate"];
    $phone_number = $_POST["phone_number"];
    if ($_FILES["image"]["error"] == 4) {
        echo
            "<script> alert('Image Does Not Exist'); </script>"
        ;
    } else {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
        if (!in_array($imageExtension, $validImageExtension)) {
            echo
                "
      <script>
        alert('Invalid Image Extension');
      </script>
      ";
        } else if ($fileSize > 1000000) {
            echo
                "
      <script>
        alert('Image Size Is Too Large');
      </script>
      ";
        } else {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;

            move_uploaded_file($tmpName, './staff/img/' . $newImageName);
            $query = "INSERT INTO original_degree VALUES('', '$name', '$gender', '$id_number', '$email', '$program_type', '$department', '$graduation_date', '$phone_number', '$newImageName')";
            mysqli_query($conn, $query);
            echo
                "
      <script>
        alert('Request Submitted Successfully You can Track Your Request In Our Website');
      </script>
      ";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">


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
                <h3 style="font-size: 30px; color: white;" class="text-blue">Original Degree Request Form</h3>
                <hr class="mx-auto divider my-2" />

                <div class="col-md-12 mb-2 justify-content-center">
                </div>
            </div>

        </div>
    </div>
</header>

<body>
    <div class="container my-4 card">
        <div class="card-body">
            <form class="row" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fullName" class="font-weight-bold">Full Name</label>
                        <input type="text" name="name" class="form-control" required id="name"
                            pattern="[a-zA-Z\s]*" placeholder="Enter full name">
                    </div>
                    <div class="form-group">
                        <label for="" class="font-weight-bold">Gender</label>
                        <div class="d-flex align-items-center">
                            <div class="form-check mr-4">
                                <input class="form-check-input" type="radio" name="gender" required value="male"
                                    id="male">
                                <label class="form-check-label" for="male">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" required value="female"
                                    id="female">
                                <label class="form-check-label" for="female">
                                    Female
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="font-weight-bold">ID Number</label>
                        <input type="text" required name="id_number" class="form-control" id=""
                            placeholder="Enter ID number">
                    </div>
                    <div class="form-group">
                        <label for="email" class="font-weight-bold">Email</label>
                        <input type="email" required name="email" class="form-control" id=""
                            placeholder="Enter Email number">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="font-weight-bold">Program Type</label>
                        <select id="program_type" name="program_type" class="form-control" required>
                            <option value="">-- Choose your enrollment program type --</option>
                            <option value="regular">Regular</option>
                            <option value="extension">Extension</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="font-weight-bold">Department</label>
                        <select class="form-control select2" name="department" required>
                            <option value="">Choose your Department</option>
                            <?php
                            $course = $conn->query("SELECT * FROM courses order by course asc");
                            while ($row = $course->fetch_assoc()):
                                ?>
                                <option value="<?php echo $row['course'] ?>"><?php echo $row['course'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="graduationDate" class="font-weight-bold">Graduation Date</label>
                        <input type="date" required name="graduationdate" class="form-control" id="graduationDate">
                    </div>
                    <div class="form-group">
                        <label for="" class="font-weight-bold">Phone Number</label>
                        <input type="text" name="phone_number" required pattern="[\+\(\)\d]*" class="form-control" id=""
                            placeholder="Enter Phone Number">
                    </div>

                    <div class="form-group">
                        <label for="image" class="font-weight-bold">Cost Sharing Letter</label>
                        <input type="file" name="image" class="form-control" id="image" accept=".jpg, .jpeg, .png"
                            value="">
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>


            </form>
        </div>
    </div>
    <br>
</body>

</html>