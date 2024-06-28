<?php
include 'db_connect.php';

if (isset($_POST["submit"])) {
	$progress_update = $_POST["progress_update"];
	$student_id = $_POST["student_id"];

	$query = "INSERT INTO notify_user VALUES('', '$progress_update', '$student_id')";
	mysqli_query($conn, $query);
	echo "
    <script> alert('Message sent successfully!');</script>
    ";
}
?>

<form method="POST">
	<p>Student's ID: <b><br>
			<large><input type="text" style="width:30%" name="student_id"></large>
			</br></p>
	<p>Progress Update: <b>
			<large><input type="text" style="width:90%" name="progress_update"></large>
		</b></p>
	<div class="modal-footer display">
		<div class="row">
			<div class="col-md-12">
				<button class="btn float-right btn-primary mx-1" name="submit" type="submit">Notify to Student
				</button>
				<a href="index.php?page=students_request"><button class="btn float-right btn-secondary mx-1"
						type="button" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</form>