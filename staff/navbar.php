
<style>
	.collapse a{
		text-indent:10px;
	}
	nav#sidebar{
		background: url(assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>) !important
	}
</style>

<nav id="sidebar" class='mx-lt-5 bg-dark' >
		
		<div class="sidebar-list">
				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>
				<a href="index.php?page=students_request" class="nav-item"><span class='icon-field'><i class="fa fa-briefcase"></i></span> Tempo Requests</a>
				<a href="index.php?page=transcript_requests" class="nav-item"><span class='icon-field'><i class="fa fa-briefcase"></i></span> Transcript Requests</a>
				<a href="index.php?page=degree_requests" class="nav-item"><span class='icon-field'><i class="fa fa-briefcase"></i></span> Degree Requests</a>
				<a href="index.php?page=courses" class="nav-item nav-courses"><span class='icon-field'><i class="fa fa-list"></i></span> Course List</a>
				<a href="index.php?page=alumni" class="nav-item nav-alumni"><span class='icon-field'><i class="fa fa-users"></i></span> Alumni List</a>
				<?php if($_SESSION['login_type'] == 1): ?>
			<?php endif; ?>
		</div>

</nav>
<script>
	$('.nav_collapse').click(function(){
		console.log($(this).attr('href'))
		$($(this).attr('href')).collapse()
	})
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
