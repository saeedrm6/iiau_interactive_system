<?php
require_once "define.php";
require_once "database.php";
require_once "session.php";
global $ss;
$ss->set_title("پرتال دانشجو - ورود به سیستم");
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
				<td><input name="accesstype" type="radio" value="کارمند">کارمند</input></td>
				<td><input name="accesstype" type="radio" value="استاد">استاد</input></td>
				<td><input name="accesstype" type="radio" value="دانشجو" checked>دانشجو</input></td>
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
			if (isset($_POST['accesstype'])){
				if ($_POST['accesstype']=='دانشجو'){
								$username = $_POST["username"];
								$password = $_POST["password"];
								$found_student = attempt_login($username,$password);
								if ($found_student) {
									// Success
					//            $_SESSION["message"] = "Admin created.";
									$_SESSION["id"]=$found_student["id"];
									$_SESSION["StudentCode"]=$found_student["StudentCode"];
									$_SESSION["sex"]=$found_student["sex"];
									$_SESSION["Fname"]=$found_student["Fname"];
									$_SESSION["Lname"]=$found_student["Lname"];
									$_SESSION["fother"]=$found_student["fother"];
									$_SESSION["field"]=$found_student["field"];
									$_SESSION["level"]=$found_student["level"];
									$_SESSION["fieldcode"]=$found_student["fieldcode"];
									redirect_to("student.php");
								} else {
									// Failure
									$_SESSION["message"] = "username/password not found!";
								}
				}elseif ($_POST['accesstype']=='کارمند'){
									$username = $_POST["username"];
									$password = $_POST["password"];
									$found_admin = attempt_login_admin($username,$password);
									if ($found_admin){
										$_SESSION["id"]=$found_admin["id"];
										$_SESSION["AdminCode"]=$found_admin["AdminCode"];
										$_SESSION["sex"]=$found_admin["sex"];
										$_SESSION["Fname"]=$found_admin["Fname"];
										$_SESSION["Lname"]=$found_admin["Lname"];
										$_SESSION["fother"]=$found_admin["fother"];
										redirect_to("administrator.php");
									}else{
										$_SESSION["message"] = "username/password not found!";
									}
				}
			}


//			close_connection();
		}

		?>

	</div>
	<div class="col-xs-0 col-md-4 col-xss-0"></div>
</div>


</div>

<?php
require_once "footer.php";
?>
