<?php 
include('db_connect.php');
session_start();
if(isset($_GET['id'])){
$user = $conn->query("SELECT * FROM users where id =".$_GET['id']);
foreach($user->fetch_array() as $k =>$v){
	$meta[$k] = $v;
}
}
?>
<div class="container-fluid">
	<div id="msg"></div>
	
	<form action="" id="manage-user" class="has-custom-buttons" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="firstname">First Name</label>
					<input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo isset($meta['firstname']) ? $meta['firstname']: '' ?>" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="lastname">Last Name</label>
					<input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo isset($meta['lastname']) ? $meta['lastname']: '' ?>" required>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="sex">Gender</label>
			<select name="sex" id="sex" class="custom-select" required>
				<option value="">Select Gender</option>
				<option value="Male" <?php echo isset($meta['sex']) && $meta['sex'] == 'Male' ? 'selected': '' ?>>Male</option>
				<option value="Female" <?php echo isset($meta['sex']) && $meta['sex'] == 'Female' ? 'selected': '' ?>>Female</option>
			</select>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" name="username" id="username" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username']: '' ?>" required autocomplete="off">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" class="form-control" value="" autocomplete="off" <?php echo !isset($meta['id']) ? 'required' : '' ?>>
					<?php if(isset($meta['id'])): ?>
					<small><i>Leave this blank if you dont want to change the password.</i></small>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" name="email" id="email" class="form-control" value="<?php echo isset($meta['email']) ? $meta['email']: '' ?>" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="phone">Phone</label>
					<input type="text" name="phone" id="phone" class="form-control" value="<?php echo isset($meta['phone']) ? $meta['phone']: '' ?>" required>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="profile_pic">Profile Picture</label>
			<input type="file" name="profile_pic" id="profile_pic" class="form-control-file" accept="image/*" <?php echo !isset($meta['id']) ? 'required' : '' ?>>
			<?php if(isset($meta['profile_pic'])): ?>
			<small><i>Leave this blank if you dont want to change the profile picture.</i></small>
			<?php endif; ?>
		</div>
		<div class="row">
			<div class="col-md-6">
				<?php if(isset($meta['type']) && $meta['type'] == 3): ?>
					<input type="hidden" name="type" value="3">
				<?php else: ?>
				<?php if(!isset($_GET['mtype'])): ?>
				<div class="form-group">
					<label for="type">User Type</label>
					<select name="type" id="type" class="custom-select" required>
						<option value="">Select Type</option>
						<option value="2" <?php echo isset($meta['type']) && $meta['type'] == 2 ? 'selected': '' ?>>Staff</option>
						<option value="1" <?php echo isset($meta['type']) && $meta['type'] == 1 ? 'selected': '' ?>>Admin</option>
					</select>
				</div>
				<?php endif; ?>
				<?php endif; ?>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="status">Status</label>
					<select name="status" id="status" class="custom-select" required>
						<option value="">Select Status</option>
						<option value="1" <?php echo isset($meta['status']) && $meta['status'] == 1 ? 'selected': '' ?>>Active</option>
						<option value="0" <?php echo isset($meta['status']) && $meta['status'] == 0 ? 'selected': '' ?>>Not Active</option>
					</select>
				</div>
			</div>
		</div>
		<div class="form-group text-center mt-3">
			<button type="submit" class="btn btn-primary">Save</button>
			<button type="reset" class="btn btn-secondary">Reset</button>
			<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
		</div>
	</form>
</div>
<script>
	
	$('#manage-user').submit(function(e){
		e.preventDefault();
		start_load()
		var formData = new FormData(this);
		$.ajax({
			url:'ajax.php?action=save_user',
			method:'POST',
			data: formData,
			processData: false,
			contentType: false,
			success:function(resp){
				if(resp ==1){
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}else{
					$('#msg').html('<div class="alert alert-danger">Username already exist</div>')
					end_load()
				}
			}
		})
	})

</script>