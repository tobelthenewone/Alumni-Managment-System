<?php
require 'connection.php';
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $phone = $_POST["phone-number"];
    $email = $_POST["email"];
    $id_no = $_POST["id-no"];
    $graduationdate = $_POST["graduationdate"];
    $degree_type = $_POST["degree-type"];
    $department = $_POST["department"];
    $name_of_institution = $_POST["name_of_institution"];
    $addr_of_institution = $_POST["addr_of_institution"];
    $program_type = $_POST["program_type"];
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
            $query = "INSERT INTO transcript_form VALUES('', '$name', '$phone', '$email', '$id_no', '$graduationdate', '$degree_type', '$department', '$name_of_institution', '$addr_of_institution', '$program_type', '$newImageName')";
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
                <h3 style="font-size: 30px; color:white;" class="text-blue">Original Transcript Request Form</h3>
                <hr class="mx-auto divider my-2" />

                <div class="col-md-12 mb-2 justify-content-center">
                </div>
            </div>

        </div>
    </div>
</header>

<div class="container my-4 card">
    <div class="card-body">
        <form method="POST" class="row" autocomplete="off" enctype="multipart/form-data">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="first-name" class="font-weight-bold">Full Name</label>
                    <input type="text" name="name" required class="form-control" id="name" pattern="[a-zA-Z\s]*" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="last-name" class="font-weight-bold">Phone Number</label>
                    <input type="text" name="phone-number" class="form-control" id="phone-number" pattern="[\+\(\)\d]*"
                        title="Please enter a valid phone number" required />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="id-no" class="font-weight-bold">ID No.</label>
                    <input type="text" name="id-no" class="form-control" id="id-no" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email" class="font-weight-bold">Email Address</label>
                    <input type="email" name="email" class="form-control" id="email" />
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="" class="font-weight-bold">Program Type</label>
                <select id="program_type" name="program_type" class="form-control" required>
                    <option value="">-- Choose your enrollment program type --</option>
                    <option value="regular">Regular</option>
                    <option value="extension">Extension</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="graduationDate" class="font-weight-bold">Graduation Date</label>
                <input type="date" required name="graduationdate" class="form-control" id="graduationDate">
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label for="" class="font-weight-bold">Degree type</label>
                    <div class="d-flex align-items-center">
                        <div class="form-check mr-4">
                            <input class="form-check-input" type="radio" name="degree-type" required value="Bachlor"
                                id="bachlor">
                            <label class="form-check-label" for="bachlor">
                                Bachlor
                            </label>
                        </div>
                        <div class="form-check mr-4">
                            <input class="form-check-input" type="radio" name="degree-type" required value="Master"
                                id="master">
                            <label class="form-check-label" for="master">
                                Master
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="degree-type" required value="Ph.D"
                                id="phd">
                            <label class="form-check-label" for="phd">
                                Ph.D
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6">
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
            <div class="col-md-6">
                <div class="form-group">
                    <label for="document" name="costsharing_letter" class="font-weight-bold">Cost sharing letter</label>
                    <input type="file" class="form-control-file" name="image" id="image" accept=".jpg, .jpeg, .png" />
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="font-weight-bold">Name of Institution</label>
                    <input type="text" name="name_of_institution" class="form-control" id="name_of_institution" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="font-weight-bold">Address of Institution</label>
                    <textarea type="text" name="addr_of_institution" class="form-control" id="addr_of_institution"
                        placeholder="address of institution"></textarea>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="" class="font-weight-bold">Mailing Agent</label>
                <select id="" name="" class="form-control">
                    <option value="">Normal Postal</option>
                    <option value="regular">DHL</option>
                    <option value="extension">EMS</option>
                </select>

            </div>
            <div class="form-group col-md-6">
                    <label for="" class="font-weight-bold">P.O Box</label>
                    <input type="text" name="" required pattern="[\+\(\)\d]*" class="form-control" id=""
                        placeholder="Enter P.O Box">
                </div>

            <div class="col-12 d-flex justify-content-end">
                <button type="submit" name="submit" style="float:right" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>
</div>