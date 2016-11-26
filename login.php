<?php
require_once "define.php";
require_once "database.php";
require_once "session.php";
global $ss;
$ss->set_title("پرتال دانشجو - ورود");
require_once "header.php";
?>

<div class="container">
	
<div class="col-xs-12 col-md-12 col-leg12" id="login">
	
	<img src="include/images/login-logo.png" class="img-responsive" alt="">
	<br>

	<div class="col-xs-0 col-md-4 col-xss-0"></div>
	<div class="col-xs-12 col-md-4 col-xss-12" id="form-login">


	<b>ورود به سیستم</b>
	<br><br>
	<form action="login.php" method="post">
		<input placeholder="کد کاربری" type="text" name="username">
		<!-- <button><i class="glyphicon glyphicon-user"></i></button> -->
		<br><br>
		<input placeholder="رمز عبور" type="password" name="password">
		<!-- <button><i class="glyphicon glyphicon-user"></i></button> -->
		<br><br>
		<input placeholder="متن تصویر" type="text" name="capth">
		<br><br>
		<center><img src="include/images/code.jpg" class="img-responsive" alt=""></center>	
		<br><br>
		<table class="table table-striped">
			<tr>
				<td><input name="type" type="radio" value="کارمند">کارمند</input></td>
				<td><input name="type" type="radio" value="استاد">استاد</input></td>
				<td><input name="type" type="radio" value="دانشجو" checked>دانشجو</input></td>
			</tr>
		</table>
		<table class="table ">
			<tr>
				<td><button class="btn btn-default btn-lg">ثبت نام دانشجو</button></td>
				<td><button class="btn btn-success btn-lg" type="submit" name="submit">ورود</button></td>
				
			</tr>
		</table>
		
		
	</form>
		<?php
		if (isset($_POST['submit'])){
			open_connection();
			$username = $_POST["username"];
			$password = $_POST["password"];
			$found_admin = attempt_login($username,$password);
			if ($found_admin) {
				// Success
//            $_SESSION["message"] = "Admin created.";
				$_SESSION["id"]=$found_admin["id"];
				$_SESSION["StudentCode"]=$found_admin["StudentCode"];
				$_SESSION["sex"]=$found_admin["sex"];
				$_SESSION["Fname"]=$found_admin["Fname"];
				$_SESSION["Lname"]=$found_admin["Lname"];
				$_SESSION["fother"]=$found_admin["fother"];
				$_SESSION["field"]=$found_admin["field"];
				$_SESSION["level"]=$found_admin["level"];
				$_SESSION["fieldcode"]=$found_admin["fieldcode"];
				redirect_to("student.php");
			} else {
				// Failure
				$_SESSION["message"] = "username/password not found!";
			}
			close_connection();
		}

		?>

	</div>
	<div class="col-xs-0 col-md-4 col-xss-0"></div>
</div>


</div>

<?php
require_once "footer.php";
?>
