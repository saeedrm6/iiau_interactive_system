<?php
require_once "session.php";
require_once "database.php";
require_once "define.php";
confirm_logged_in();
open_connection();
global $ss;
$ss->set_title("پرتال دانشجو - صفحه اصلی");
if (isset($_GET['page'])){
switch ($_GET['page']){
	case 'choice':
		$ss->set_title("پرتال دانشجو - انتخاب واحد");
		break;
	case 'program':
		$ss->set_title("پرتال دانشجو - برنامه هفتگی");
		break;
	case 'karname':
		$ss->set_title("پرتال دانشجو - کارنامه");
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
	<button class="btn btn-danger text-danger" type="button">
  	پیام دریافتی <span class="badge text-danger"><i class="glyphicon glyphicon-inbox"></i> 4</span>
	</button></li></ul></div>
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
	    <p>نام پدر : <b><?php echo $_SESSION["fother"];?></b> &nbsp&nbsp&nbsp کد دانشجویی : <b><?php echo $_SESSION["StudentCode"];?></b> &nbsp&nbsp&nbsp رشته تحصیلی : <b><?php echo $_SESSION["field"];?></b> &nbsp&nbsp&nbsp مقطع تحصیلی : <b><?php echo $_SESSION["level"];?></b></p>
	  </div>
	</div>
	<br>
	<?php
	if (!isset($_GET['page']) || $_GET['page']=="home") {
		?>
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
		<?php
	}
	elseif ($_GET['page']=="choice") {
		?>

		<div class="col-md-7"></div>
		<div class="col-md-5">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">ثبت مشخصه</h3>
				</div>
				<form action="student.php?page=choice" method="post">
				<div class="panel-body">
					<p>لطفا مشخصه خود را به درستی در کادر زیر وارد و سپس بر روی دکمه ثبت نهایی کلیک کنید</p>
					<?php
					if (isset($_POST['choice'])) {
						global $local_term;
						$id = $_POST['id_select'];
						$check_exist = check_id_course_not_copy($_SESSION["StudentCode"],$local_term,$id);
//						echo var_dump($check_exist);
						if(!$check_exist->num_rows == 0) {
							?>
							<p class="text-danger text-center">خطا در انتخاب مشخصه</p>
							<?php
						}else{
							select_course($_SESSION["StudentCode"],$local_term,$_SESSION["fieldcode"],$id);
						}
					}
					?>
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="sizing-addon1">مشخصه : </span>
						<input type="text" class="form-control" placeholder="کد مشخصه" aria-describedby="sizing-addon1" name="id_select">
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
			<div class="panel-heading">وضعیت انتخاب واحد در  نيمسال اول سال 96-95</div>

			<!-- Table -->
			<table class="table table-striped table-hover" style="background:#ccc;">
				<thead class="active" style="text-align: right;">
				<th style="text-align: right">مشخصه</th>
				<th style="text-align: right">کد درس</th>
				<th style="text-align: right">نام درس</th>
				<th style="text-align: right">واحد</th>
				<th style="text-align: right">ساعت کلاس</th>
				<th style="text-align: right">تاریخ امتحان</th>
				<th style="text-align: right">نام استاد</th>
				</thead>
				<tbody>
				<?php
				global $local_term;
				create_student_choice_units($_SESSION["StudentCode"],$local_term);
				$result = select_from_units($_SESSION["StudentCode"],$local_term);
//				$sql = "SELECT * FROM {$_SESSION["StudentCode"]}_{$local_term}";
//				$result = query($sql);
				while ($choice = fetch_array($result)) {
					?>
									<tr>
										<td><?php echo $choice['id']; ?></td>
										<td><?php echo $choice['code']; ?></td>
										<td><?php echo $choice['name']; ?></td>
										<td><?php echo $choice['unit']; ?></td>
										<td><?php echo $choice['description']; ?></td>
										<td><?php echo $choice['exam_time']; ?></td>
										<td><?php echo $choice['teacher']; ?></td>
									</tr>
					<?php
				}
				?>
				</tbody>
			</table>
			<?php
			if (!$result->num_rows) {
				?>
				<br>
				<p class="text-center text-info">شما هیچ درسی را تاکنون انتخاب نکرده اید</p>
				<?php
			}
			?>
		</div>
		<div class="clearfix"></div>

		<div class="panel panel-primary">
		<!-- Default panel contents -->
		<div class="panel-heading">ليست دروس ارائه شده در  نيمسال اول سال 96-95</div>

		<!-- Table -->
		<table class="table table-striped table-hover" style="background:#ccc;">
			<thead class="active" style="text-align: right;">
			<th style="text-align: right">مشخصه</th>
			<th style="text-align: right">کد درس</th>
			<th style="text-align: right">نام درس</th>
			<th style="text-align: right">واحد</th>
			<th style="text-align: right">ساعت کلاس</th>
			<th style="text-align: right">تاریخ امتحان</th>
			<th style="text-align: right">نام استاد</th>
			</thead>
			<tbody>
			<?php
				global $local_term;
				$fieldcode=$_SESSION["fieldcode"];
				$sql = "SELECT * FROM ";
				$sql .= $fieldcode . '_' .$local_term;
				$sql .= " ORDER BY id";
				$result = query($sql);
				while ($list = fetch_array($result)) {
					?>
					<tr>
						<td><?php echo $list['id']; ?></td>
						<td><?php echo $list['code']; ?></td>
						<td><?php echo $list['name']; ?></td>
						<td><?php echo $list['unit']; ?></td>
						<td><?php echo $list['description']; ?></td>
						<td><?php echo $list['exam_time']; ?></td>
						<td><?php echo $list['teacher']; ?></td>
					</tr>
					<?php
				}
				mysqli_free_result($result);
			?>

			</tbody>
		</table>
		</div>
		<br><br>
		<?php
	}
	elseif ($_GET['page']=="program") {
		?>

		<div class="col-md-8"></div>
		<div class="col-md-4">
			<div class="list-group">
				<a href="#" class="list-group-item active">
					نیم سال تحصیلی
				</a>
				<a href="#" class="list-group-item">تابستان 95-94</a>
				<a href="#" class="list-group-item">نیم سال اول 96-95</a>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="panel panel-primary">
			<!-- Default panel contents -->
			<div class="panel-heading">برنامه هفتگی  نيمسال اول سال 96-95</div>

			<!-- Table -->
			<table class="table table-striped table-hover" style="background:#ccc;">
				<thead class="active" style="text-align: right;">
				<th style="text-align: right">مشخصه</th>
				<th style="text-align: right">کد درس</th>
				<th style="text-align: right">نام درس</th>
				<th style="text-align: right">واحد</th>
				<th style="text-align: right">ساعت کلاس</th>
				<th style="text-align: right">تاریخ امتحان</th>
				<th style="text-align: right">نام استاد</th>
				</thead>
				<tbody>
				<?php
				$result = select_from_units($_SESSION["StudentCode"],$local_term);
				while ($choice = fetch_array($result)) {
					?>
					<tr>
						<td><?php echo $choice['id']; ?></td>
						<td><?php echo $choice['code']; ?></td>
						<td><?php echo $choice['name']; ?></td>
						<td><?php echo $choice['unit']; ?></td>
						<td><?php echo $choice['description']; ?></td>
						<td><?php echo $choice['exam_time']; ?></td>
						<td><?php echo $choice['teacher']; ?></td>
					</tr>
					<?php
				}
				?>

				</tbody>
			</table>
			<?php
			if (!$result->num_rows) {
				?>
				<br>
				<p class="text-center text-info">شما هیچ درسی را تاکنون انتخاب نکرده اید</p>
				<?php
			}
			?>

		</div>

		<?php
	}
	elseif ($_GET['page']=="karname") {
		?>

		<div class="col-md-8"></div>
		<div class="col-md-4">
			<div class="list-group">
				<a href="#" class="list-group-item active">
					نیم سال تحصیلی
				</a>
				<a href="#" class="list-group-item">تابستان 95-94</a>
				<a href="#" class="list-group-item">نیم سال اول 96-95</a>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="panel panel-success custom1">
			<!-- Default panel contents -->
			<div class="panel-heading">کارنامه نيمسال اول سال 96-95</div>

			<!-- Table -->
			<table class="table table-striped table-hover" style="background:#ccc;">
				<thead class="active" style="text-align: right;">
				<th style="text-align: right">مشخصه</th>
				<th style="text-align: right">نام درس</th>
				<th style="text-align: right">نام استاد</th>
				<th style="text-align: right">واحد</th>
				<th style="text-align: right">نمره</th>
				<th style="text-align: right">اعتراض</th>
				<th style="text-align: right">نمره تجدید نظر</th>
				<th style="text-align: right">توضیحات در خصوص اعتراض</th>
				</thead>
				<tbody>
				<?php
								$result = select_from_units($_SESSION["StudentCode"],$local_term);
								while ($choice = fetch_array($result)) {
									?>
									<tr>
										<form action="student.php?page=karname" method="post">
										<td><input name="id" type="hidden" value="<?php echo $choice['id']; ?>"><?php echo $choice['id']; ?></td>
										<td><?php echo $choice['name']; ?></td>
										<td><?php echo $choice['teacher']; ?></td>
										<td><?php echo $choice['unit']; ?></td>
										<td><?php echo $choice['exam_point']; ?></td>
										<td>
											<?php
											if($choice['eteraz']==0 || $choice['eteraz']==null) {
												?>

<!--												<button class="btn btn-primary">ثبت اعتراض</button>-->
													<input type="submit" name="eteraz_sabt" class="btn btn-primary" value="ثبت اعتراض">
												<?php
											}
											elseif($choice['eteraz']==1){
											?>
											<p class="text-center text-danger">اعتراض ثبت شد</p></td>
										<?php
										}
										?>
										<td><?php echo $choice['reexam_point']; ?></td>
										<td><textarea class="form-control" name="description"><?php echo $choice['eteraz_desc']; ?></textarea></form></td>
									</tr>
									<?php
								}
								if (isset($_POST['eteraz_sabt'])){

									$username=$_SESSION["StudentCode"];
									global $local_term;
									$id =$_POST['id'];
									$eteraz_desc = $_POST['description'];
									sabte_eteraz($username,$local_term,$id,$eteraz_desc);

								}
				?>

				</tbody>
			</table>

		</div>

		<?php
	}
	elseif ($_GET['page']=="takalif"){
	?>
		<div class="col-md-7"></div>
		<div class="col-md-5">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">انتخاب درس</h3>
				</div>
				<div class="panel-body">
					<p>لطفا درس مورد نظر را انتخاب نمایید : </p>
					<?php
					global $local_term;
					$studentcode = $_SESSION["StudentCode"];
					$result=esme_darsha($studentcode,$local_term);
					?>
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="sizing-addon1">درس : </span>
						<select class="form-control">
							<?php
								global $local_term;
								$studentcode = $_SESSION["StudentCode"];
								$result=esme_darsha($studentcode,$local_term);
							$i=0;
							while ($choice = fetch_array($result)) {
										?>
										<option value="<?php echo $i; ?>"><?php echo $choice['name'];?></option>
										<?php
									++$i;
								}
							?>
						</select>
						<a href="" class="input-group-addon btn btn-success btn-lg" id="sizing-addon1">تایید</a>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="com-md-12">
			<div class="panel panel-success custom1">
				<!-- Default panel contents -->
				<div class="panel-heading">تکالیف درس : مهندسی نرم افزار 1</div>

				<!-- Table -->
				<table class="table table-striped table-hover" style="background:#ccc;">
					<thead class="active" style="text-align: right;">
					<th style="text-align: right">تاریخ ثبت</th>
					<th style="text-align: right">تاریخ مجاز تحویل تمرین ها</th>
					<th style="text-align: right">جلسه</th>
					<th style="text-align: right">نمره</th>
					<th style="text-align: right">وضعیت بررسی</th>
					</thead>
					<tbody>
					<tr>
						<td>17/07/95</td>
						<td><p class="text-success">22/07/95</p></td>
						<td>سوم</td>
						<td>-</td>
						<td><p class="text-danger">بررسی نشده</p></td>
						<td><a href=""><button class="btn btn-primary">ارسال تکالیف</button></a></td>
					</tr>

					</tbody>
				</table>

			</div>
		</div>


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
						<select class="form-control">
							<option value="one">مهندسی نرم افزار 1</option>
							<option value="two">ریاضی 2</option>
							<option value="three">طراحی الگوریتم</option>
							<option value="four">هوش مصنوعی</option>
							<option value="five">پایگاه داده ها</option>
						</select>
						<a href="" class="input-group-addon btn btn-success btn-lg" id="sizing-addon1">تایید</a>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="com-md-12">
			<div class="panel panel-success custom1">
				<!-- Default panel contents -->
				<div class="panel-heading">جزوات درس : مهندسی نرم افزار 1</div>

				<!-- Table -->
				<table class="table table-striped table-hover" style="background:#ccc;">
					<thead class="active" style="text-align: right;">
					<th style="text-align: right"><i class="glyphicon glyphicon-list-alt"></i> جلسه</th>
					<th style="text-align: right"><i class="glyphicon glyphicon-calendar"></i> تاریخ ثبت</th>
					<th style="text-align: right"><i class="glyphicon glyphicon-save-file"></i> PDF</th>
					<th style="text-align: right"><i class="glyphicon glyphicon-music"></i> صدا</th>
					</thead>
					<tbody>
					<tr>
						<td>اول</td>
						<td><p class="text-success">22/07/95</p></td>
						<td><button class="btn btn-default"><i class="glyphicon glyphicon-cloud-download"></i> دانلود</button></td>
						<td><button class="btn btn-default"><i class="glyphicon glyphicon-cloud-download"></i> دانلود</button></td>
					</tr>

					</tbody>
				</table>

			</div>
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
					<div class="col-md-6 col-xs-6" style="position: relative;"><button style="position:absolute; top: -16px; left: 0;" class="btn btn-success pull-left"><i class=" glyphicon glyphicon-plus"></i> پیام جدید</button></div>
					<div class="col-md-6 col-xs-6"><p style="line-height: 3px !important;">پیام ها</p></div>
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
			<div class="col-md-6">
				<form class="form-control" style="height: auto !important;">
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-user text-danger"></i> از :</span>
						<input type="text" class="form-control" placeholder="فرستنده" aria-describedby="sizing-addon1" value="سعید رحیمی منش" disabled>
					</div>
					<br>
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-user text-success"></i> به :</span>
						<select class="form-control">
							<option value="one">سعید حق گو</option>
							<option value="two">کریم حیدری</option>
							<option value="three">آیدا امینی مطلق</option>
							<option value="four">پژمان حسینیون</option>
						</select>
<!--						<input type="text" class="form-control" placeholder="گیرنده" aria-describedby="sizing-addon1" value="استاد حق گو">-->
					</div>
					<br>
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-bullhorn"></i> عنوان :</span>
						<input type="text" class="form-control" placeholder="عنوان" aria-describedby="sizing-addon1">
					</div>
					<br>
					<div class="input-group input-group-lg">
						<span class="input-group-addon" id="sizing-addon10"><i class="glyphicon glyphicon-pencil"></i> متن پیام :</span>
						<textarea class="form-control" style="height: auto !important; font-size: 15px;"  rows="4"></textarea>
					</div>
					<br>
					<center><button class="btn btn-success btn-lg" type="submit"><i class="glyphicon glyphicon-send"></i> ارسال</button></center>
				</form>
			</div>
			<div class="col-md-3"></div>
			<div class="clearfix"></div>
			<br><br><br>
		</div>

		<?php
	}
	elseif ($_GET['page']=="edit_profile") {
		?>
		hi
		<?php
	}
	?>
</div>





<div id="collapse" class="col-md-2 page-sidebar navbar-collapse collapse sidebar col-xss-12 col-xs-12">
	<br>
	<ul>
		<li><a href="<?php echo Site."/student.php";?>"><i class="glyphicon glyphicon-home"></i>&nbspصفحه اصلی</a></li>
		<li><a href="<?php echo Site."/student.php?page=choice";?>"><i class="glyphicon glyphicon-plus"></i>&nbspانتخاب واحد</a></li>
		<li><a href="<?php echo Site."/student.php?page=program";?>"><i class="glyphicon glyphicon-calendar"></i>&nbspبرنامه هفتگی</a></li>
		<li><a href="<?php echo Site."/student.php?page=karname";?>"><i class="glyphicon glyphicon-education"></i>&nbspکارنامه</a></li>
		<li><a href="<?php echo Site."/student.php?page=takalif";?>"><i class="glyphicon glyphicon-edit"></i>&nbspمدیریت تکالیف</a></li>
		<li><a href="<?php echo Site."/student.php?page=jozve";?>"><i class="glyphicon glyphicon-folder-open"></i>&nbspجزوه</a></li>
		<li><a href="<?php echo Site."/student.php?page=message";?>"><i class="glyphicon glyphicon-envelope"></i>&nbspمدیریت پیام ها</a></li>
		<li><a href="<?php echo Site."/student.php?page=edit_profile";?>"><i class="glyphicon glyphicon-cog"></i>&nbspویرایش پروفایل</a></li>
	</ul>
</div>

<?php
require_once "footer.php";
?>
