<?php
    ob_start();session_start();
	if(isset($_POST['updateSTT']))
    {
        include("../Connect/conn.php");
        if($_POST['stt'] != "")
        {
            $mail = $_SESSION['Email'];
            
            $sql = $db->prepare("SELECT ID FROM usaccount WHERE Mail = ? or Tell = ?");
            $sql -> bindValue(1,$mail,PDO::PARAM_STR );
            $sql -> bindValue(2,$mail,PDO::PARAM_STR );
            $sql -> execute();
            $ID="";
            $data = $sql->fetchAll();
            foreach ($data as $key ) 
            {
                $ID= $key["ID"];
            }

            $status = $_POST['stt'];
            $dateSTT = date("Y-m-d H:i:s");

            $urlimgstt = "non";

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
                    move_uploaded_file($_FILES["photo"]["tmp_name"], "../imgSTT/" . $_FILES["photo"]["name"]);

                    $urlimgstt = 'imgSTT/'.$filename;
                } 
            }

            $stmt = $db->prepare('INSERT INTO status(status,timeSTT,img,usID)
                                    values (:stt, :timestt,:img, :usid)');
            $data = array('stt'=>$status,'timestt'=>$dateSTT,'img'=>$urlimgstt,'usid'=>$ID);
            $stmt->execute($data);

        }
     
        header('Location: ../mypage.php');
    }
    else
        header("Location: ../index.php");
?>