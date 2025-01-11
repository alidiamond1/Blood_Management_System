<?php 

?>
<style>
    .password-container {
        position: relative;
        display: inline-block;
    }
    .password-field {
        border: none;
        background: transparent;
        text-align: center;
        width: 120px;
        transition: all 0.3s ease;
        font-family: monospace;
        padding: 2px 5px;
        cursor: default;
    }
    .password-field[type="text"] {
        width: 250px;
        background: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 3px;
    }
    .password-toggle {
        position: absolute;
        right: -25px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #666;
    }
    .password-toggle:hover {
        color: #333;
    }
    .password-field-container {
        position: relative;
        display: inline-flex;
        align-items: center;
    }
    .password-input {
        width: 150px;
        text-align: center;
        margin-right: 5px;
    }
    .toggle-password {
        padding: 0;
        color: #007bff;
    }
    .toggle-password:hover {
        color: #0056b3;
    }
</style>

<div class="container-fluid">
	
	<div class="row">
	<div class="col-lg-12">
			<button class="btn btn-primary float-right btn-sm" id="new_user"><i class="fa fa-plus"></i> New user</button>
	</div>
	</div>
	<br>
	<div class="row">
		<div class="card col-lg-12">
			<div class="card-body">
				<table class="table-striped table-bordered col-md-12">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">Profile</th>
					<th class="text-center">Name</th>
					<th class="text-center">Contact Info</th>
					<th class="text-center">Password</th>
					<th class="text-center">Type</th>
					<th class="text-center">Status</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
 					include 'db_connect.php';
 					$type = array("","Admin","Staff","Alumnus/Alumna");
 					$users = $conn->query("SELECT * FROM users order by firstname, lastname asc");
 					$i = 1;
 					while($row= $users->fetch_assoc()):
				 ?>
				 <tr>
				 	<td class="text-center"><?php echo $i++ ?></td>
				 	<td class="text-center">
				 		<img src="<?php echo isset($row['profile_pic']) && !empty($row['profile_pic']) ? 'assets/uploads/'.$row['profile_pic'] : 'assets/uploads/default_avatar.png' ?>" 
				 			alt="Profile Picture" class="img-thumbnail" style="width: 75px; height: 75px; object-fit: cover;">
				 	</td>
				 	<td>
				 		<?php echo ucwords($row['firstname'].' '.$row['lastname']) ?><br>
				 		<small>Gender: <?php echo $row['sex'] ?></small>
				 	</td>
				 	<td>
				 		<i class="fa fa-user"></i> <?php echo $row['username'] ?><br>
				 		<i class="fa fa-envelope"></i> <?php echo $row['email'] ?><br>
				 		<i class="fa fa-phone"></i> <?php echo $row['phone'] ?>
				 	</td>
					<td class="text-center">
						<?php if($_SESSION['login_type'] == 1): ?>
							<div class="password-field-container">
								<input type="password" class="form-control password-input" value="<?php echo $row['original_password'] ?? '********' ?>" readonly>
								<button type="button" class="btn btn-sm btn-link toggle-password">
									<i class="fa fa-eye"></i>
								</button>
							</div>
						<?php else: ?>
							<span>********</span>
						<?php endif; ?>
					</td>
				 	<td class="text-center">
				 		<?php echo $type[$row['type']] ?>
				 	</td>
				 	<td class="text-center">
				 		<?php if($row['status'] == 1): ?>
				 			<span class="badge badge-success">Active</span>
				 		<?php else: ?>
				 			<span class="badge badge-danger">Not Active</span>
				 		<?php endif; ?>
				 	</td>
				 	<td>
				 		<center>
								<div class="btn-group">
								  <button type="button" class="btn btn-primary">Action</button>
								  <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <span class="sr-only">Toggle Dropdown</span>
								  </button>
								  <div class="dropdown-menu">
								    <a class="dropdown-item edit_user" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Edit</a>
								    <div class="dropdown-divider"></div>
								    <a class="dropdown-item delete_user" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Delete</a>
								  </div>
								</div>
								</center>
				 	</td>
				 </tr>
				<?php endwhile; ?>
			</tbody>
		</table>
			</div>
		</div>
	</div>

</div>
<script>
	$('table').dataTable();

    $(document).ready(function() {
        $('.toggle-password').click(function(e) {
            e.preventDefault();
            const input = $(this).siblings('input');
            const icon = $(this).find('i');
            
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                input.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
$('#new_user').click(function(){
	uni_modal('New User','manage_user.php')
})
$('.edit_user').click(function(){
	uni_modal('Edit User','manage_user.php?id='+$(this).attr('data-id'))
})
$('.delete_user').click(function(){
		_conf("Are you sure to delete this user?","delete_user",[$(this).attr('data-id')])
	})
	function delete_user($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_user',
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