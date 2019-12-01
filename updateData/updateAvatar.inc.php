<?php
	ob_start();session_start();
	if(isset($_POST['updateAva']))
	{
		include("../Connect/conn.php");
		// Kiểm tra phương thức gửi form đi có phải là POST hay ko ?
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
		    // Kiểm tra quá trình upload file có bị lỗi gì không ?
		    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0)
		    {
		    	// Mảng chưa định dạng file cho phép
		        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
		        // Lấy thông tin file bao gồm tên file, loại file, kích cỡ file
		        $filename = $_FILES["photo"]["name"];
		        $filetype = $_FILES["photo"]["type"];
		        $filesize = $_FILES["photo"]["size"];
		    
		        // Kiểm tra định dạng file .jpg, png,...
		        $ext = pathinfo($filename, PATHINFO_EXTENSION);
		        // Nếu không đúng định dạng file thì báo lỗi
		        if(!array_key_exists($ext, $allowed)) die("Lỗi : Vui lòng chọn đúng định dang file.");
		    
		        // Cho phép kích thước tối đa của file là 5MB
		        $maxsize = 5 * 1024 * 1024;
		        // Nếu kích thước lớn hơn 5MB thì báo lỗi
		        if($filesize > $maxsize) die("Lỗi : Kích thước file lớn hơn giới hạn cho phép");
		    
		        // Kiểm tra file ok hết chưa
		        if(in_array($filetype, $allowed))
		        {
		          
		            	// Hàm move_uploaded_file sẽ tiến hành upload file lên thư mục avatar
		                move_uploaded_file($_FILES["photo"]["tmp_name"], "../imgAvatar/" . $_FILES["photo"]["name"]);
		                // Thông báo thành công
		                $mail = $_SESSION['Email'];

		                $avatar = 'imgAvatar/'.$filename;

		                $stmt = $db->prepare("UPDATE usaccount SET urlavatar = :url WHERE Mail = :mail or Tell = :sdt ");

		                $data = array('url'=>$avatar, 'mail'=>$mail, 'sdt' => $mail);

						$stmt->execute($data);
		                header('Location: ../mypage.php');
		             
		        } 
		        else
		        {
		            echo "Lỗi : Có vấn đề xảy ra khi upload file"; 
		        }
		    } 
		}
	}
	else
		header("Location: ../index.php");
?>