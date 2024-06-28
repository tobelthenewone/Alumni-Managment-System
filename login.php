<?php session_start() ?>
<div data-aos="fade-down" style="width: 40%" class="container-fluid">
	<form action="" id="login-frm" class="my-5 py-5 px-4 rounded shadow-sm bg-white">
		<div class="form-group">
			<label for="username" class="control-label font-weight-bold">Email</label>
			<input type="email" name="username" required class="form-control form-control-lg rounded-pill">
		</div>
		<div class="form-group">
			<label for="password" class="control-label font-weight-bold">Password</label>
			<input type="password" name="password" required class="form-control form-control-lg rounded-pill">
			<small class="form-text text-muted"><a href="index.php?page=signup" id="new_account"
					class="text-primary">Create New Account</a></small>
		</div>
		<button class="btn btn-primary btn-lg btn-block rounded-pill">Login</button>
	</form>
</div>

<style>
	#uni_modal .modal-footer {
		display: none;
	}
</style>

<script>
	$('#login-frm').submit(function (e) {
		e.preventDefault()
		$('#login-frm button[type="submit"]').attr('disabled', true).html('Logging in...');
		if ($(this).find('.alert-danger').length > 0)
			$(this).find('.alert-danger').remove();
		$.ajax({
			url: 'admin/ajax.php?action=login2',
			method: 'POST',
			data: $(this).serialize(),
			error: err => {
				console.log(err)
				$('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');

			},
			success: function (resp) {
				if (resp == 1) {
					location.href = '<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php?page=logged_in_user' ?>';
				} else if (resp == 2) {
					$('#login-frm').prepend('<div class="alert alert-danger">Your account is not yet verified.</div>')
					$('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');
				} else {
					$('#login-frm').prepend('<div class="alert alert-danger">Email or password is incorrect.</div>')
					$('#login-frm button[type="submit"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>