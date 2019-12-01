<?php session_start(); include 'header.php'; 
if (!isset($_SESSION['Email'])){ 
	header("Location: index.php");
}
else
{
	include("Connect/conn.php");

    $mail = $_SESSION['Email'];
              
    $sql = $db->prepare("SELECT ID,HoTen,urlavatar FROM usaccount WHERE Mail = ? or Tell = ?");
    $sql -> bindValue(1,$mail,PDO::PARAM_STR );
    $sql -> bindValue(2,$mail,PDO::PARAM_STR );
   	$sql -> execute();
	$name = "";
    $urlavatar = "";
    $ID = "";
    $data = $sql->fetchAll();
    foreach ($data as $key ) 
    {
        $name = $key["HoTen"];
        $urlavatar = $key["urlavatar"];
        $ID =$key["ID"];
    }

}
?>
<html lang="en" dir="ltr">
  <header>
      <meta  charset="utf-8">
      <link rel="stylesheet" type="text/css" href="css/mypage.css">
      <title> WIN </title>
  </header>
  <body>
  	<div class="status" >
  		<div style="border: 2px solid black; width: 1150px; height: 350px; background-image: url(imgBackgroud/bia001.jpg); background-size: 1150px auto;">
  		<table >
  		<div style="margin-top: 190px;">
  			<tr>
   			<td style="padding: 5px;">
   			<?php echo' <h2><img src="'.$urlavatar.'" align="center" ></h2>'?>
   			</td>
      		<td style="padding: 5px;">
      			<?php echo '<h1>'.$name.'</h1>'; ?>

      			<form action="updateData/updateAvatar.inc.php" method="post" enctype="multipart/form-data">
      			
        		<input type="file" name="photo"  style="color:transparent; content: 'Chọn Avatar';" onchange="this.style.color = 'black'; "><br>

       			<input type="submit" name="updateAva" value="Cập Nhật avatar">
    			</form>
      		</td>
   		</tr>
  		</div>
   		
   		</table>
   		</div>
   		<br>
    	<form  action="updateData/updateStt.inc.php" method="post" enctype="multipart/form-data">
    			<textarea style="overflow:auto; resize:none; font-size:20px; color: black; width: 60%;" rows="5"  name="stt" id = "stt" placeholder="Bạn đang nghĩ gì?"></textarea><br>
    			<input type="file" name="photo" id="fileSelect" class="custom-file-input"  style="color:transparent; content: 'Thêm Ảnh'; width: 100px; height: 25px; " onchange="this.style.color = 'black';"><br>
    			<input type="submit" name="updateSTT" value="Đăng" class="BUTTON">
    	</form>


    <!-- Hiển thị status -->
	<?php
		
        $sql = $db->prepare("SELECT * FROM status WHERE usID = ? ORDER BY  timeSTT DESC");
        $sql -> bindValue(1,$ID,PDO::PARAM_INT );
        $sql -> execute();
        $stt= $sql->fetchAll();
        	
        foreach ($stt as $k )
        {
        	$st = $k["status"];
        	$tm = $k["timeSTT"];
        	$imgstt = $k["img"];
        	echo '<br><table style="width:60%;">
        			<tr> 
        				<td ><img src="'.$urlavatar.'" style=" width: 60px; height: 60px;"  border = 2></td>
        				<td style="width:60%px">'.
        				$st
        				.'</td>
        				<td width:200px"> - Ngày đăng: '.
        				$tm
        				.'</td>
        			</tr>';
        	if($imgstt != "non")
        	{
        		echo '<tr>
        				<td></td>
        				<td><img src="'.$imgstt.'" style=" width: 600px; height: auto;"  border = 2></td>
        				<td></td>
        			  </tr>';
        	}	

        	echo '
        		 </table><br><br>';
        		         	
        }
	?>
    </div>
  </body>
</html>