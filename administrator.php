<?php
require_once "session.php";
require_once "database.php";
require_once "define.php";
$access = basename($_SERVER["PHP_SELF"],'.php');
confirm_logged_in($access);
open_connection();
global $ss;
$ss->set_title("پرتال کارمند - صفحه اصلی");
if (isset($_GET['page'])){
switch ($_GET['page']){
	case 'add_admin':
		$ss->set_title("پرتال کارمند - افزودن کارمند");
		break;
	case 'add_teacher':
		$ss->set_title("پرتال کارمند - افزودن استاد");
		break;
	case 'add_student':
		$ss->set_title("پرتال کارمند - افزودن دانشجو");
		break;
	case 'takalif':
		$ss->set_title("پرتال دانشجو - تکالیف");
		break;
	case 'jozve':
		$ss->set_title("پرتال دانشجو - جزوه");
		break;
	case 'message':
		$ss->set_title("پرتال دانشجو - پیام ها");
		break;
	default:
		$ss->set_title("پرتال دانشجو");
}
}
require_once "header.php";
?>
<script >
	var ww = $( document ).height();
</script>
<div class="page-header navbar navbar-fixed-top">
	<div class="col-md-1 col-xss-0 col-xs-0 visible-md">
	<br>
	آنلاین : 401</div>
	<div class="col-md-5 col-xss-12 col-xs-12">
	<br>
		<?php
		global $sex;
			if ($_SESSION["sex"] == 0){
			$sex = "آقای ";
			}else{
				$sex = "خانم ";
			}
		?>
	<?php echo $sex . $_SESSION["Fname"].' '. $_SESSION["Lname"]; ?>   &nbsp&nbsp&nbsp&nbsp&nbsp <ul><li>
                <button class="btn btn-info text-info" type="button">
                    پیام دریافتی <span class="badge text-danger"><i class="glyphicon glyphicon-inbox"></i> 4</span>
                </button></li><li><a href="signout.php"><button class="btn btn-danger text-danger" type="button">
                        خروج از سیستم <span class="badge text-danger"><i class="glyphicon glyphicon-export"></i></span>
                    </button></li></a></ul></div>
	<div class="col-md-6 col-xss-0 col-xs-0"></div>
	</div>
<br><br><br>
<div class="clearfix"></div>
<div class="col-md-10 content">
	<br>
	<div class="panel panel-default">
	  <!-- Default panel contents -->
	  <div class="panel-heading"><?php echo $sex;?> <b><?php echo $_SESSION["Fname"].' '. $_SESSION["Lname"]; ?></b> خوش آمدید</div>
	  <div class="panel-body">
	    <p>ترم جاری : <b>نیم سال اول سال 96-95</b></p><br>
	    <p>نام پدر : <b><?php echo $_SESSION["fother"];?></b> &nbsp&nbsp&nbsp کد کارمندی : <b><?php echo $_SESSION["AdminCode"];?></b></p>
	  </div>
	</div>
	<br>
	<?php
	if (!isset($_GET['page']) || $_GET['page']=="home") {
		?>
		<h3 id="gnrlmsg">پیام های عمومی</h3>
		<table class="table table-striped table-hover" id="tablemsg" style="background:#ccc;">
			<thead class="active" style="text-align: right;">
			<th style="text-align: right">#</th>
			<th style="text-align: right">شرح</th>
			<th style="text-align: right">تاریخ</th>
			<th style="text-align: right">فرستنده</th>
			</thead>
			<tbody>
			<?php
			$sql = "SELECT * FROM general_message ORDER BY time";
			$result = query($sql);
			$i=1;
			while ($messages = fetch_array($result)) {
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $messages["message"]; ?></td>
					<td><?php echo $messages["time"]; ?></td>
					<td>مرکز</td>
				</tr>
				<?php
				$i++;
			}
			?>
			</tbody>
		</table>
		<?php
	}
	elseif ($_GET['page']=="add_admin") {
		?>

		<div class="col-md-7"></div>
		<div class="col-md-5">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">ثبت مشخصه کارمند جدید</h3>
				</div>
				<form action="administrator.php?page=add_admin" method="post">
				<div class="panel-body">
					<p>لطفا اطلاعات را با دقت وارد نمایید. در حفظ و نگهداری رمزعبور و کد کارمندی کوشا باشید</p>
					<?php
					if (isset($_POST['choice'])) {
						$admin_sex = $_POST['admin_sex'];
						$admin_fname = $_POST['admin_fname'];
						$admin_lname = $_POST['admin_lname'];
						$admin_fother = $_POST['admin_fother'];
						$admin_code = $_POST['admin_code'];
						$admin_pass = $_POST['admin_pass'];
						$admin_pass = password_encrypt($admin_pass);
						add_admin($admin_sex,$admin_fname,$admin_lname,$admin_fother,$admin_code,$admin_pass);
					}
					?>
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="sizing-addon1">مشخصه : </span>
						<input type="text" class="form-control" placeholder="جنسیت (0 : آقا    -   1: خانم " aria-describedby="sizing-addon1" name="admin_sex" required>
						<input type="text" class="form-control" placeholder="نام" aria-describedby="sizing-addon1" name="admin_fname" required>
						<input type="text" class="form-control" placeholder="نام خانوادگی" aria-describedby="sizing-addon1" name="admin_lname" required>
						<input type="text" class="form-control" placeholder="نام پدر" aria-describedby="sizing-addon1" name="admin_fother" required>
						<input type="text" class="form-control" placeholder="کد کارمندی" aria-describedby="sizing-addon1" name="admin_code" required>
						<input type="password" class="form-control" placeholder="رمز عبور" aria-describedby="sizing-addon1" name="admin_pass" required>
<!--						<span class="input-group-addon" id="sizing-addon1"><button class="btn btn-default btn-lg">ثبت</button></span>-->
<!--						<a  type="submit" class="input-group-addon btn btn-success btn-lg" id="sizing-addon1">ثی</aحایی</a>-->
						<input type="submit" class="input-group-addon btn btn-success btn-lg custombig" id="sizing-addon1" name="choice" value="ثبت" width="100%">
					</div>
				</div>
				</form>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="panel panel-success custom1">
			<!-- Default panel contents -->
			<div class="panel-heading">لیست کارمندان</div>

			<!-- Table -->
			<table class="table table-striped table-hover" style="background:#ccc;">
				<thead class="active" style="text-align: right;">
				<th style="text-align: right">نام و نام خانوادگی</th>
				<th style="text-align: right">نام پدر</th>
				<th style="text-align: right">کد کارمندی</th>
				</thead>
				<tbody>
				<?php
				$admins_name =admins_list();
				while ($admins = fetch_array($admins_name)) {
					?>
									<tr>
										<td><?php echo $admins['Fname'].' '.$admins['Lname']; ?></td>
										<td><?php echo $admins['fother']; ?></td>
										<td><?php echo $admins['AdminCode']; ?></td>
									</tr>
					<?php
				}
				?>
				</tbody>
			</table>

		</div>
		<div class="clearfix"></div>

		<?php
	}
	elseif ($_GET['page']=="add_teacher") {
		?>


        <div class="col-md-7"></div>
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">ثبت مشخصه استاد جدید</h3>
                </div>
                <form action="administrator.php?page=add_teacher" method="post">
                    <div class="panel-body">
                        <p>لطفا اطلاعات را با دقت وارد نمایید. در حفظ و نگهداری رمزعبور و کد استادی کوشا باشید</p>
                        <?php
                        if (isset($_POST['choice'])) {
                            $teacher_sex = $_POST['teacher_sex'];
                            $teacher_fname = $_POST['teacher_fname'];
                            $teacher_lname = $_POST['teacher_lname'];
                            $teacher_fother = $_POST['teacher_fother'];
                            $teacher_code = $_POST['teacher_code'];
                            $teacher_field = $_POST['teacher_field'];
                            $teacher_level = $_POST['teacher_level'];
                            $teacher_fieldcode = $_POST['teacher_fieldcode'];
                            $teacher_pass = $_POST['teacher_pass'];
                            $teacher_pass = password_encrypt($teacher_pass);
                            add_teacher($teacher_sex,$teacher_fname,$teacher_lname,$teacher_fother,$teacher_code,$teacher_field,$teacher_level,$teacher_pass,$teacher_fieldcode);
                        }
                        ?>
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon" id="sizing-addon1">مشخصه : </span>
                            <input type="text" class="form-control" placeholder="جنسیت (0 : آقا    -   1: خانم " aria-describedby="sizing-addon1" name="teacher_sex" required>
                            <input type="text" class="form-control" placeholder="نام" aria-describedby="sizing-addon1" name="teacher_fname" required>
                            <input type="text" class="form-control" placeholder="نام خانوادگی" aria-describedby="sizing-addon1" name="teacher_lname" required>
                            <input type="text" class="form-control" placeholder="نام پدر" aria-describedby="sizing-addon1" name="teacher_fother" required>
                            <input type="text" class="form-control" placeholder="کد استادی" aria-describedby="sizing-addon1" name="teacher_code" required>
                            <input type="text" class="form-control" placeholder="رشته" aria-describedby="sizing-addon1" name="teacher_field" required>
                            <input type="text" class="form-control" placeholder="آخرین مدرک" aria-describedby="sizing-addon1" name="teacher_level" required>
                            <input type="password" class="form-control" placeholder="رمز عبور" aria-describedby="sizing-addon1" name="teacher_pass" required>
                            <input type="password" class="form-control" placeholder="کد رشته" aria-describedby="sizing-addon1" name="teacher_fieldcode" required>
                            <!--						<span class="input-group-addon" id="sizing-addon1"><button class="btn btn-default btn-lg">ثبت</button></span>-->
                            <!--						<a  type="submit" class="input-group-addon btn btn-success btn-lg" id="sizing-addon1">ثی</aحایی</a>-->
                            <input type="submit" class="input-group-addon btn btn-success btn-lg custombig" id="sizing-addon1" name="choice" value="ثبت" width="100%">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="panel panel-success custom1">
            <!-- Default panel contents -->
            <div class="panel-heading">لیست اساتید</div>

            <!-- Table -->
            <table class="table table-striped table-hover" style="background:#ccc;">
                <thead class="active" style="text-align: right;">
                <th style="text-align: right">نام و نام خانوادگی</th>
                <th style="text-align: right">نام پدر</th>
                <th style="text-align: right">کد استادی</th>
                <th style="text-align: right">کد رشته</th>
                </thead>
                <tbody>
                <?php
                $teachers_name =teachers_list();
                while ($teachers = fetch_array($teachers_name)) {
                    ?>
                    <tr>
                        <td><?php echo $teachers['Fname'].' '. $teachers['Lname']; ?></td>
                        <td><?php echo $teachers['fother']; ?></td>
                        <td><?php echo $teachers['TeacherCode']; ?></td>
                        <td><?php echo $teachers['fieldcode']; ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>

        </div>
        <div class="clearfix"></div>
        <br><br><br><br>
		<?php
	}
	elseif ($_GET['page']=="add_student") {
		?>

        <div class="col-md-7"></div>
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">ثبت مشخصه دانشجو جدید</h3>
                </div>
                <form action="administrator.php?page=add_student" method="post">
                    <div class="panel-body">
                        <p>لطفا اطلاعات را با دقت وارد نمایید. در حفظ و نگهداری رمزعبور و کد دانشجویی کوشا باشید</p>
                        <?php
                        if (isset($_POST['choice'])) {
                            $student_sex = $_POST['student_sex'];
                            $student_fname = $_POST['student_fname'];
                            $student_lname = $_POST['student_lname'];
                            $student_fother = $_POST['student_fother'];
                            $student_code = $_POST['student_code'];
                            $student_field = $_POST['student_field'];
                            $student_level = $_POST['student_level'];
                            $student_fieldcode = $_POST['student_fieldcode'];
                            $student_pass = $_POST['student_pass'];
                            $student_pass = password_encrypt($student_pass);
                            add_student($student_sex,$student_fname,$student_lname,$student_fother,$student_code,$student_field,$student_level,$student_pass,$student_fieldcode);
                        }
                        ?>
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon" id="sizing-addon1">مشخصه : </span>
                            <input type="text" class="form-control" placeholder="جنسیت (0 : آقا    -   1: خانم " aria-describedby="sizing-addon1" name="student_sex" required>
                            <input type="text" class="form-control" placeholder="نام" aria-describedby="sizing-addon1" name="student_fname" required>
                            <input type="text" class="form-control" placeholder="نام خانوادگی" aria-describedby="sizing-addon1" name="student_lname" required>
                            <input type="text" class="form-control" placeholder="نام پدر" aria-describedby="sizing-addon1" name="student_fother" required>
                            <input type="text" class="form-control" placeholder="کد دانشجو" aria-describedby="sizing-addon1" name="student_code" required>
                            <input type="text" class="form-control" placeholder="رشته" aria-describedby="sizing-addon1" name="student_field" required>
                            <input type="text" class="form-control" placeholder="مقطع تحصیلی" aria-describedby="sizing-addon1" name="student_level" required>
                            <input type="password" class="form-control" placeholder="رمز عبور" aria-describedby="sizing-addon1" name="student_pass" required>
                            <input type="password" class="form-control" placeholder="کد رشته" aria-describedby="sizing-addon1" name="student_fieldcode" required>
                            <!--						<span class="input-group-addon" id="sizing-addon1"><button class="btn btn-default btn-lg">ثبت</button></span>-->
                            <!--						<a  type="submit" class="input-group-addon btn btn-success btn-lg" id="sizing-addon1">ثی</aحایی</a>-->
                            <input type="submit" class="input-group-addon btn btn-success btn-lg custombig" id="sizing-addon1" name="choice" value="ثبت" width="100%">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="panel panel-success custom1">
            <!-- Default panel contents -->
            <div class="panel-heading">لیست دانشجویان</div>

            <!-- Table -->
            <table class="table table-striped table-hover" style="background:#ccc;">
                <thead class="active" style="text-align: right;">
                <th style="text-align: right">نام و نام خانوادگی</th>
                <th style="text-align: right">نام پدر</th>
                <th style="text-align: right">کد دانشجویی</th>
                <th style="text-align: right">مقطع تحصیلی</th>
                <th style="text-align: right">رشته</th>
                <th style="text-align: right">کد رشته</th>
                </thead>
                <tbody>
                <?php
                $student_name =student_list();
                while ($students = fetch_array($student_name)) {
                    ?>
                    <tr>
                        <td><?php echo $students['Fname'].' '. $students['Lname']; ?></td>
                        <td><?php echo $students['fother']; ?></td>
                        <td><?php echo $students['StudentCode']; ?></td>
                        <td><?php echo $students['level']; ?></td>
                        <td><?php echo $students['field']; ?></td>
                        <td><?php echo $students['fieldcode']; ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>

        </div>
        <div class="clearfix"></div>
        <br><br><br><br>

		<?php
	}
	elseif ($_GET['page']=="add_course"){
	?>
        <div class="col-md-7">
            <div class="panel panel-success custom1">
                <!-- Default panel contents -->
                <div class="panel-heading">لیست کد رشته ها</div>

                <!-- Table -->
                <table class="table table-striped table-hover" style="background:#ccc;">
                    <thead class="active" style="text-align: right;">
                    <th style="text-align: right">کد رشته</th>
                    <th style="text-align: right">نام رشته</th>
                    </thead>
                    <tbody>
                    <?php
                    $field_list =fieldcode_list();
                    while ($field = fetch_array($field_list)) {
                        ?>
                        <tr>
                            <td><?php echo $field['code'];?></td>
                            <td><?php echo $field['name']; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>

            </div>
        </div>
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">ثبت مشخصه کد رشته جدید</h3>
                </div>
                <form action="administrator.php?page=add_course" method="post">
                    <div class="panel-body">
                        <p>لطفا کد رشته جدید را همراه با اطلاعات تکمیلی وارد نمایید</p>
                        <?php
                        if (isset($_POST['choice'])) {
                            $field_code = $_POST['fieldcode'];
                            $field_name = $_POST['fieldname'];
                            add_fieldcode($field_code,$field_name);
                        }
                        ?>
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon" id="sizing-addon1">مشخصه : </span>
                            <input type="text" class="form-control" placeholder="کد رشته" aria-describedby="sizing-addon1" name="fieldcode" required>
                            <input type="text" class="form-control" placeholder="نام رشته" aria-describedby="sizing-addon1" name="fieldname" required>
                            <!--						<span class="input-group-addon" id="sizing-addon1"><button class="btn btn-default btn-lg">ثبت</button></span>-->
                            <!--						<a  type="submit" class="input-group-addon btn btn-success btn-lg" id="sizing-addon1">ثی</aحایی</a>-->
                            <input type="submit" class="input-group-addon btn btn-success btn-lg custombig" id="sizing-addon1" name="choice" value="ثبت" width="100%">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">انتخاب رشته</h3>
                </div>
                <form action="administrator.php?page=add_course" method="get">
                    <div class="panel-body">
                        <p>از بین رشته ها انتخاب نمایید</p>

                        <div class="input-group input-group-lg">
                            <span class="input-group-addon" id="sizing-addon1">مشخصه : </span>
                            <select class="form-control" name="fieldcodes[]" id="testt">
                                <?php
                                global $local_term;
                                $result = fieldcode_list();
                                while($fields = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <option value="<?php echo $fields['code']; ?>" <?php if ($_POST && in_array($fields['code'],$_POST['fieldcodes'])){echo 'selected';}  ?>><?php echo $fields['name']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>

                            <!--						<span class="input-group-addon" id="sizing-addon1"><button class="btn btn-default btn-lg">ثبت</button></span>-->
                            <!--						<a  type="submit" class="input-group-addon btn btn-success btn-lg" id="sizing-addon1">ثی</aحایی</a>-->
                            <input type="submit" class="input-group-addon btn btn-success btn-lg custombig" id="sizing-addon1" name="choice" value="تایید" width="100%">
                        </div>
                    </div>
                </form>
            </div>


        </div>
        <br><br><br>

	<?php
	}
	elseif ($_GET['page']=="jozve") {
		?>
		<div class="col-md-7"></div>
		<div class="col-md-5">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">انتخاب درس</h3>
				</div>
				<div class="panel-body">
					<p>لطفا درس مورد نظر را انتخاب نمایید : </p>
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="sizing-addon1">درس : </span>
						<form action="student.php?page=jozve" method="post">
							<select class="form-control" name="coursename[]">
								<?php
								global $local_term;
								$studentcode = $_SESSION["StudentCode"];
								$result=esme_darsha($studentcode,$local_term);
								$i=0;
								while ($choice = fetch_array($result)) {
									?>
									<option value="<?php echo $choice['code']; ?>" <?php if ($_POST && in_array($choice['code'],$_POST['coursename'])){echo 'selected';}  ?> ><?php echo $choice['name'];?></option>
									<?php
									++$i;
								}
								?>
							</select>
							<!--						<a href="" class="input-group-addon btn btn-success btn-lg" id="sizing-addon1">تایید</a>-->
							<input type="submit" value="تایید" class="input-group-addon btn btn-success btn-lg" id="sizing-addon1" style="width: 100%;">
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="com-md-12">

			<?php
				if (isset($_POST['coursename'])){
					$coursecode = $_POST['coursename'][0];
					$studentcode = $_SESSION["StudentCode"];
					global $local_term;
					$jozve = select_jozve($coursecode,$local_term);
                    $field_code=$_SESSION["fieldcode"];
                    global $local_term;
                    $ttt=get_course_name($field_code,$local_term,$coursecode);
                    ?>

					<div class="panel panel-success custom1">
						<!-- Default panel contents -->
                        <?php
                        while ($coursename=mysqli_fetch_assoc($ttt)) {
                            ?>
                            <div class="panel-heading"><?php echo $coursename['name']; ?></div>
                            <?php
                        }
                        ?>
						<!-- Table -->
						<table class="table table-striped table-hover" style="background:#ccc;">
							<thead class="active" style="text-align: right;">
							<th style="text-align: right"><i class="glyphicon glyphicon-list-alt"></i> جلسه</th>
							<th style="text-align: right"><i class="glyphicon glyphicon-calendar"></i> تاریخ ثبت</th>
							<th style="text-align: right"><i class="glyphicon glyphicon-save-file"></i> PDF</th>
							<th style="text-align: right"><i class="glyphicon glyphicon-music"></i> صدا</th>
							</thead>
							<tbody>
                            <?php
                            while ($jozve_status = mysqli_fetch_assoc($jozve)) {
                                ?>
                                <tr>
                                    <td><?php echo $jozve_status['jalase'];  ?></td>
                                    <td><p class="text-success"><?php echo $jozve_status['date'];  ?></p></td>
                                    <td>
                                        <a href="<?php echo $jozve_status['PDF'];  ?>"><button class="btn btn-default"><i
                                                class="glyphicon glyphicon-cloud-download"></i> دانلود
                                        </button></a>
                                    </td>
                                    <td>
                                        <a href="<?php echo $jozve_status['voice'];  ?>"><button class="btn btn-default"><i
                                                class="glyphicon glyphicon-cloud-download"></i> دانلود
                                        </button></a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>

							</tbody>
						</table>

					</div>

					<?php

				}
			?>


		</div>
		<?php
	}
	elseif ($_GET['page']=="message") {
		?>
		<div class="col-md-12">
			<div class="panel panel-success custom1">
				<!-- Default panel contents -->
				<div class="panel-heading custom3">
				<div class="col-md-12 col-xs-12">
					<div class="col-md-6 col-xs-6" style="position: relative;"><button style="position:absolute; top: -16px; left: 0;" class="btn btn-success pull-left" onclick="showmsgform()"><i class=" glyphicon glyphicon-plus"></i> پیام جدید</button></div>
					<div class="col-md-6 col-xs-6"><p style="line-height: 3px !important;">پیام ها</p></div>
                    <script>
                        function showmsgform() {
                            document.getElementById("formmsg").style.display = "block";
                        }
                    </script>
				</div>
				</div>

				<!-- Table -->
				<table class="table table-striped table-hover" style="background:#ccc;">
					<thead class="active" style="text-align: right;">
					<th style="text-align: right"><i class="glyphicon glyphicon-user"></i> فرستنده</th>
					<th style="text-align: right"><i class="glyphicon glyphicon-flash"></i> موضوع</th>
					<th style="text-align: right"><i class="glyphicon glyphicon-calendar"></i> تاریخ</th>
					<th style="text-align: right"><i class="glyphicon glyphicon-envelope"></i> متن پیام</th>
					</thead>
					<tbody>
					<tr>
						<td>استاد سعید حق گو</td>
						<td><p class="text-success">اعتراض به نمره</p></td>
						<td><p class="text-danger">1395/07/25</p></td>
						<td><p class="text-info">با بررسی سوابق و اوراق ، اعتراض به نمره شما رد گردید. در صورتی که مایل به تصحیح اوراق به صورت حضوری میباشید، روز سه شنبه نسبت به حضور در دفتر اساتید افدام نمایید</p></td>
					</tr>

					</tbody>
				</table>

			</div>
		</div>
		<br>
		<div class="col-md-12 col-xs-12">
			<div class="col-md-3"></div>
			<div class="col-md-6" id="formmsg" style="display: none;">
				<form class="form-control" style="height: auto !important;">
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-user text-danger"></i> از :</span>
						<input type="text" class="form-control" placeholder="فرستنده" aria-describedby="sizing-addon1" value="<?php echo $_SESSION["Fname"].' '.$_SESSION["Lname"];  ?>" disabled>
					</div>
					<br>
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-user text-success"></i> به :</span>
						<select class="form-control" name="teachername[]">
                            <?php
                            global $local_term;
                            $studentcode = $_SESSION["StudentCode"];
                            $result = select_from_units($studentcode,$local_term);
                            while($teachers = mysqli_fetch_assoc($result)) {
                                ?>
                                <option value="<?php echo $teachers['teacher']; ?>" <?php if ($_POST && in_array($teachers['teacher'],$_POST['teachername'])){echo 'selected';}  ?>><?php echo $teachers['teacher']; ?></option>
                                <?php
                            }
                            ?>
						</select>
<!--						<input type="text" class="form-control" placeholder="گیرنده" aria-describedby="sizing-addon1" value="استاد حق گو">-->
					</div>
					<br>
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-bullhorn"></i> عنوان :</span>
						<input type="text" class="form-control" placeholder="عنوان" aria-describedby="sizing-addon1" required>
					</div>
					<br>
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="sizing-addon10"><i class="glyphicon glyphicon-pencil"></i> متن پیام :</span>
						<textarea class="form-control" style="height: auto !important; font-size: 15px;"  rows="4" required></textarea>
					</div>
					<br>
					<center><input class="btn btn-success btn-lg" type="submit" value="ارسال"></input></center>
				</form>
			</div>
			<div class="col-md-3"></div>
			<div class="clearfix"></div>
			<br><br><br>
		</div>

		<?php
	}
	elseif ($_GET['page']=="public_messages") {
		?>
        <div class="col-md-5"></div>
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">ثبت پیام عمومی جدید</h3>
                </div>
                <form action="administrator.php?page=public_messages" method="post">
                    <div class="panel-body">
                        <p>پیام عمومی خود را وارد نمایید. پیام شما برای تمامی دانشجویان ، اساتید و کارمندان قابل مشاهده خواهد بود</p>
                        <?php
                        if (isset($_POST['choice'])) {
                            $new_message = $_POST['newmsg'];
                            $time=time_stamp();
                            general_message($new_message,$time);
                        }
                        ?>
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon" id="sizing-addon1">اطلاعات پیام : </span>
                            <textarea style="min-height: 250px;" class="form-control" placeholder="متن پیام" name="newmsg" id="" cols="30" rows="40" required></textarea>
                            <!--						<span class="input-group-addon" id="sizing-addon1"><button class="btn btn-default btn-lg">ثبت</button></span>-->
                            <!--						<a  type="submit" class="input-group-addon btn btn-success btn-lg" id="sizing-addon1">ثی</aحایی</a>-->
                            <input type="submit" class="input-group-addon btn btn-success btn-lg custombig" id="sizing-addon1" name="choice" value="ثبت" width="100%">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
        <h3>پیام های عمومی</h3>
        <table class="table table-striped table-hover" style="background:#ccc;">
            <thead class="active" style="text-align: right;">
            <th style="text-align: right">#</th>
            <th style="text-align: right">شرح</th>
            <th style="text-align: right">تاریخ</th>
            <th style="text-align: right">فرستنده</th>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM general_message ORDER BY time";
            $result = query($sql);
            $i=1;
            while ($messages = fetch_array($result)) {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $messages["message"]; ?></td>
                    <td><?php echo $messages["time"]; ?></td>
                    <td>مرکز</td>
                </tr>
                <?php
                $i++;
            }
            ?>
            </tbody>
        </table>
        <div class="clearfix"></div>
        <br><br><br><br>
		<?php
	}
	elseif ($_GET['page']=="select_term"){?>
        <div class="alert alert-info fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <?php
            $ttt=get_term();
            while ($term = mysqli_fetch_assoc($ttt)) { ?>
                <ul id="cstul">
                    <li>نیم سال :  <?php echo $term['term_name']; ?></li>
                    <li>کد نیم سال : <?php echo $term['term']; ?></li>
                </ul>
                <?php
            }
            ?>
        </div>
        <div class="clearfix"></div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">ثبت مشخصه نیم سال جاری</h3>
            </div>
            <form action="administrator.php?page=select_term" method="post">
                <div class="panel-body">
                    <p>لطفا کد رشته جدید را همراه با اطلاعات تکمیلی وارد نمایید</p>
                    <?php
                    if (isset($_POST['choice'])) {
                        $term_name = $_POST['term_name'];
                        $term_code = $_POST['term_code'];
                        set_term($term_code,$term_name);
                    }
                    ?>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon" id="sizing-addon1">مشخصه : </span>
                        <input type="text" class="form-control" placeholder="نام نیم سال" aria-describedby="sizing-addon1" name="term_name" required>
                        <input type="text" class="form-control" placeholder="کد نیم سال" aria-describedby="sizing-addon1" name="term_code" required>
                        <!--						<span class="input-group-addon" id="sizing-addon1"><button class="btn btn-default btn-lg">ثبت</button></span>-->
                        <!--						<a  type="submit" class="input-group-addon btn btn-success btn-lg" id="sizing-addon1">ثی</aحایی</a>-->
                        <input type="submit" class="input-group-addon btn btn-success btn-lg custombig" id="sizing-addon1" name="choice" value="ثبت" width="100%">
                    </div>
                </div>
            </form>
        </div>
    <?php
	}
	if (isset($_GET['fieldcodes'])){
	    $idd= $_GET['fieldcodes'][0]; ?>
    <script>
        document.getElementById("tablemsg").style.display = "none";
        document.getElementById("gnrlmsg").style.display="none";
    </script>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">ثبت درس جدید</h3>
            </div>
            <form action="administrator.php?fieldcodes[]=<?php echo $idd; ?>&choice=تایید" method="post">
                <div class="panel-body">
                    <p>لطفا اطلاعات درس مورد نظر را به صورت کامل وارد نمایید</p>
                    <?php
                    if (isset($_POST['choice'])) {
                        $course_id=$_POST['course_id'];
                        $course_code=$_POST['course_code'];
                        $course_name=$_POST['course_name'];
                        $course_unit=$_POST['course_unit'];
                        $course_desc=$_POST['course_desc'];
                        $course_date=$_POST['course_date'];
                        $course_teacher=$_POST['course_teacher'];
                        $course_teacher_id=$_POST['course_teacher_id'];
                        global $local_term;
                        insert_course($course_id,$course_code,$course_name,$course_unit,$course_desc,$course_date,$course_teacher,$course_teacher_id,$idd,$local_term);
//                        add_admin($admin_sex,$admin_fname,$admin_lname,$admin_fother,$admin_code,$admin_pass);
                    }
                    ?>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon" id="sizing-addon1">مشخصه : </span>
                        <input type="text" class="form-control" placeholder="شناسه درس" aria-describedby="sizing-addon1" name="course_id" required>
                        <input type="text" class="form-control" placeholder="کد درس" aria-describedby="sizing-addon1" name="course_code" required>
                        <input type="text" class="form-control" placeholder="نام درس" aria-describedby="sizing-addon1" name="course_name" required>
                        <input type="text" class="form-control" placeholder="تعداد واحد" aria-describedby="sizing-addon1" name="course_unit" required>
                        <input type="text" class="form-control" placeholder="توضیحات درس" aria-describedby="sizing-addon1" name="course_desc" required>
                        <input type="text" class="form-control" placeholder="تاریخ امتحان" aria-describedby="sizing-addon1" name="course_date" required>
                        <input type="text" class="form-control" placeholder="نام استاد" aria-describedby="sizing-addon1" name="course_teacher" required>
                        <input type="text" class="form-control" placeholder="کد استاد" aria-describedby="sizing-addon1" name="course_teacher_id" required>
                        <!--						<span class="input-group-addon" id="sizing-addon1"><button class="btn btn-default btn-lg">ثبت</button></span>-->
                        <!--						<a  type="submit" class="input-group-addon btn btn-success btn-lg" id="sizing-addon1">ثی</aحایی</a>-->
                        <input type="submit" class="input-group-addon btn btn-success btn-lg custombig" id="sizing-addon1" name="choice" value="ثبت" width="100%">
                    </div>
                </div>
            </form>
        </div>
    <?php
    }
	?>
</div>





<div id="collapse" class="col-md-2 page-sidebar navbar-collapse collapse sidebar col-xss-12 col-xs-12">
	<br>
	<ul>
		<li><a href="<?php echo Site."/administrator.php";?>"><i class="glyphicon glyphicon-home"></i>&nbspصفحه اصلی</a></li>
		<li><a href="<?php echo Site."/administrator.php?page=add_admin";?>"><i class="glyphicon glyphicon-plus"></i>&nbspافزودن کارمند</a></li>
		<li><a href="<?php echo Site."/administrator.php?page=add_teacher";?>"><i class="glyphicon glyphicon-plus"></i>&nbspافزودن استاد</a></li>
		<li><a href="<?php echo Site."/administrator.php?page=add_student";?>"><i class="glyphicon glyphicon-plus"></i>&nbspافزودن دانشجو</a></li>
		<li><a href="<?php echo Site."/administrator.php?page=select_term";?>"><i class="glyphicon glyphicon-education"></i>&nbspتعیین ترم جاری</a></li>
		<li><a href="<?php echo Site."/administrator.php?page=add_course";?>"><i class="glyphicon glyphicon-edit"></i>&nbspافزودن درس</a></li>
		<li><a href="<?php echo Site."/administrator.php?page=public_messages";?>"><i class="glyphicon glyphicon-folder-open"></i>&nbspپیام های عمومی</a></li>
		<li><a href="<?php echo Site."/student.php?page=message";?>"><i class="glyphicon glyphicon-envelope"></i>&nbspمدیریت پیام ها</a></li>
	</ul>
</div>

<?php
require_once "footer.php";
?>
