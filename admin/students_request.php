<?php include('db_connect.php');?>

<div class="container-fluid">
<style>
	input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.5); /* IE */
  -moz-transform: scale(1.5); /* FF */
  -webkit-transform: scale(1.5); /* Safari and Chrome */
  -o-transform: scale(1.5); /* Opera */
  transform: scale(1.5);
  padding: 10px;
}
</style>
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>Request List</b>

					</div>
					<div class="card-body">
						
						<table class="table table-bordered table-condensed table-hover">
							<thead>
								<r>
									<th class="text-center">#</th>
									<th class="">Student Name</th>
									<th class="">Gender</th>
									<th class="">ID Number</th>
									<th class="text-center">Action</th>
								</r>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$jobs =  $conn->query("SELECT * from tempo_request  order by id desc");
								while($row=$jobs->fetch_assoc()):
									
								?>
								<tr>
									
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										 <p><b><?php echo ucwords($row['name']) ?></b></p>
										 
									</td>
									<td class="">
										 <p><b><?php echo ucwords($row['gender']) ?></b></p>
										 
									</td>
									<td class="">
										 <p><b><?php echo ucwords($row['id_number']) ?></b></p>
										 
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-outline-primary view_request" type="button" data-id="<?php echo $row['id'] ?>" >View</button>
										<button class="btn btn-sm btn-outline-danger delete_career" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height: :150px;
	}
</style>
<script>
	$(document).ready(function(){
		$('table').dataTable()
	})
	$('#new_career').click(function(){
		uni_modal("New Entry","manage_career.php",'mid-large')
	})
	
	$('.edit_career').click(function(){
		uni_modal("Manage Job Post","manage_career.php?id="+$(this).attr('data-id'),'mid-large')
		
	})
	$('.view_request').click(function(){
		uni_modal("Request Details","view_request.php?id="+$(this).attr('data-id'),'mid-large')
		
	})
	$('.delete_career').click(function(){
		_conf("Are you sure to delete this post?","delete_career",[$(this).attr('data-id')],'mid-large')
	})

	function delete_career($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_career',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>