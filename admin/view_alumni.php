<?php include 'db_connect.php' ?>
<?php
if (isset($_GET['id'])) {
	$qry = $conn->query("SELECT a.*,c.course,Concat(a.firstname,' ',a.lastname) as name from alumnus_bio a inner join courses c on c.id = a.course_id where a.id= " . $_GET['id']);
	foreach ($qry->fetch_array() as $k => $val) {
		$$k = $val;
	}
}
?>
<style type="text/css">
	.image-container {
		position: relative;
		cursor: pointer;
	}

	.fullscreen-overlay {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(0, 0, 0, 0.9);
		display: flex;
		justify-content: center;
		align-items: center;
		opacity: 0;
		visibility: hidden;
		transition: opacity 0.3s, visibility 0.3s;
		z-index: 999;
	}

	.fullscreen-image {
		max-width: 90%;
		max-height: 90%;
		object-fit: contain;
	}

	.fullscreen-overlay.show {
		opacity: 1;
		visibility: visible;
	}

	.avatar {
		display: flex;
		border-radius: 100%;
		width: 100px;
		height: 100px;
		align-items: center;
		justify-content: center;
		border: 3px solid;
		padding: 5px;
	}

	.avatar img {
		max-width: calc(100%);
		max-height: calc(100%);
		border-radius: 100%;
	}

	p {
		margin: unset;
	}

	#uni_modal .modal-footer {
		display: none
	}

	#uni_modal .modal-footer.display {
		display: block
	}
</style>
<div class="container-field">
	<div class="col-lg-12">
		<div>

			<center>
				<div class="image-container">
					<div class="avatar">
						<img src="assets/uploads/<?php echo $avatar ?>" class="image" alt="">
					</div>
					<div class="fullscreen-overlay">
						<img src="assets/uploads/<?php echo $avatar ?>" class="fullscreen-image" alt="">
					</div>
				</div>
			</center>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-6">
				<p>Name: <b><?php echo $name ?></b></p>
				<p>Email: <b><?php echo $email ?></b></p>
				<p>Batch: <b><?php echo $batch ?></b></p>
				<p>Course: <b><?php echo $course ?></b></p>
			</div>
			<div class="col-md-6">
				<p>Gender: <b><?php echo $gender ?></b></p>
				<p>Account Status:
					<b><?php echo $status == 1 ? '<span class="badge badge-primary">Verified</span>' : '<span class="badge badge-secondary">Unverified</span>' ?></b>
				</p>
			</div>
		</div>
	</div>
</div>
<div class="modal-footer display">
	<div class="row">
		<div class="col-lg-12">
			<button class="btn float-right btn-secondary" type="button" data-dismiss="modal">Close</button>
			<?php if ($status == 1): ?>
				<button class="btn float-right btn-primary update mr-2" data-status='0' type="button"
					data-dismiss="modal">Unverify Account</button>
			<?php else: ?>
				<button class="btn float-right btn-primary update mr-2" data-status='1' type="button"
					data-dismiss="modal">Verify Account</button>
			<?php endif; ?>
		</div>
	</div>
</div>
<script>
	$('.update').click(function () {
		start_load()
		$.ajax({
			url: 'ajax.php?action=update_alumni_acc',
			method: "POST",
			data: { id: <?php echo $id ?>,status:$(this).attr('data-status')},
			success: function (resp) {
				if (resp == 1) {
					alert_toast("Alumnus/Alumna account status successfully updated.")
					setTimeout(function () {
						location.reload()
					}, 1000)
				}
			}
		})
	})
	document.querySelectorAll('.image-container').forEach((container) => {
		const image = container.querySelector('.image');
		const fullscreenOverlay = container.querySelector('.fullscreen-overlay');
		const fullscreenImage = fullscreenOverlay.querySelector('.fullscreen-image');

		image.addEventListener('click', () => {
			fullscreenOverlay.classList.add('show');
		});

		fullscreenOverlay.addEventListener('click', () => {
			fullscreenOverlay.classList.remove('show');
		});
	});
</script>