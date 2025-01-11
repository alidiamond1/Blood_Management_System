<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
ob_start();
if(!isset($_SESSION['system'])){
    $system = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
    foreach($system as $k => $v){
        $_SESSION['system'][$k] = $v;
    }
}
ob_end_flush();
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo $_SESSION['system']['name'] ?></title>
<?php include('./header.php'); ?>
<?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");
?>
<style>
    body {
        width: 100%;
        height: 100vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: Arial, sans-serif;
        background: linear-gradient(to bottom right, #ff5e57, #ff3030);
        overflow: hidden;
    }
    main#main {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
    }
    #login-right {
        width: 400px;
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        border: 2px solid #ff3030;
        animation: fadeIn 1.5s ease-in-out;
    }
    .card h4 {
        font-size: 1.5rem;
        font-weight: bold;
        color: #ff3030;
        text-align: center;
        margin-bottom: 20px;
    }
    .form-group label {
        font-weight: bold;
        color: #555;
    }
    .form-control {
        border-radius: 10px;
        border: 1px solid #ddd;
        padding: 10px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }
    .form-control:focus {
        border-color: #ff5e57;
        box-shadow: 0 0 5px rgba(255, 94, 87, 0.5);
    }
    .btn-primary {
        background: linear-gradient(to right, #ff5e57, #ff3030);
        border: none;
        border-radius: 10px;
        color: white;
        font-size: 1rem;
        padding: 10px 20px;
        cursor: pointer;
        transition: transform 0.2s ease, background 0.3s ease;
    }
    .btn-primary:hover {
        background: linear-gradient(to right, #ff3030, #ff5e57);
        transform: scale(1.05);
    }
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
</head>
<body>
<main id="main">
    <div id="login-right">
        <div class="card">
            <h4><?php echo $_SESSION['system']['name'] ?></h4>
            <form id="login-form">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                </div>
                <center>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn-primary">Login</button>
                </center>
            </form>
        </div>
    </div>
</main>

</body>

<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='index.php?page=home';
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>
</html>
