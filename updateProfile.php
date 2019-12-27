<?php 
require_once 'init.php';
require_once 'functions.php';
  // Xử lý logic ở đây
$page = 'profile';

$success = false;
if(!isset($_POST['UpdatePro']))
{
	header('Location: index.php');
}
if(isset($_POST['CapNhat']))
{
if(isset($_POST['university'])&&isset($_POST['majors'])&&
   isset($_POST['highschool'])&&isset($_POST['birthday'])&&
   isset($_POST['placeofbirth'])&&isset($_POST['currentresidence'])&&
   isset($_POST['nickname']))
{
	$university = $_POST['university'];
	$highschool = $_POST['highschool'];
	$majors = $_POST['highschool'];
	$birthday = $_POST['birthday'];
	$placeofbirth = $_POST['placeofbirth'];
	$currentresidence = $_POST['currentresidence'];
	$nickname = $_POST['nickname'];

	$strSql = "UPDATE profile SET university = '".$university."', majors = '".$majors."',highschool = '".$highschool."',birthday = '".$birthday."',placeofbirth = '".$placeofbirth."',currentresidence = '".$currentresidence."',nickname = '".$nickname."',uploaded_on = NOW() WHERE userid = '".$currentUser['id']."'";



	$success = updateProfile($strSql);
	if($success)
	{
		header('Location: index.php');
		exit();
	}
}	
}
?>

<?php include 'header.php'; ?>
<div class="user">
<h2 class="user_title">Cập nhật thông tin cá nhân</h2>
<?php if(!$success):?>
	<form action="#" method="post">
		<div class="form-group">
			<label for="university">Bạn học trường nào?</label>
			<input type="text" class="form-control" id="university" name="university">
		</div>
		<div class="form-group">
			<label for="majors">Nghành của bạn là gì</label>
			<input type="text" class="form-control" id="majors" name="majors">
		</div>
		<div class="form-group">
			<label for="highschool">Trường trung học bạn đã từng học là trường nào?</label>
			<input type="text" class="form-control" id="highschool" name ="highschool">
		</div>
		<div class="form-group">
			<label for="birthday">Ngày sinh của bạn?</label>
			<input type="date" class="form-control" id="birthday" name="birthday" >		
		</div>
		<div class="form-group">
			<label for="placeofbirth">Bạn đến từ đâu?</label>
			<input type="text" class="form-control" id="placeofbirth" name ="placeofbirth">	
		</div>
		<div class="form-group">
			<label for="currentresidence">Hiện tại bạn đang sinh sống ở đâu?</label>
			<input type="text" class="form-control" id="currentresidence" name ="currentresidence">	
		</div>
		<div class="form-group">
			<label for="nickname">Nick name của bạn là gì?</label>
			<input type="text" class="form-control" id="nickname" name ="nickname">	
		</div>
		<input type="submit" name="CapNhat" class="btn btn-primary" value="Cập Nhật"></input>
	</form>
<?php endif;?>
</div>
<?php include 'footer.php'; ?>