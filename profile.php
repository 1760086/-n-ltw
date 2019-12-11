<?php session_start(); include 'header.php'; 
if (!isset($_SESSION['Email']) || !isset($_GET['idus'])){ 
	header("Location: index.php");
}
else
{
	  include("Connect/conn.php");

    $ID = $_GET['idus'];
    $Mail = $_SESSION['Email'];

    $sql = $db->prepare("SELECT ID FROM usaccount WHERE Mail = ? or Tell = ?");
    $sql -> bindValue(1,$Mail,PDO::PARAM_STR );
    $sql -> bindValue(2,$Mail ,PDO::PARAM_STR );
    $sql -> execute();
    $idus =0;
    $data = $sql->fetchAll();
    foreach ($data as $key ) 
    {
        $idus = $key["ID"];
    }

    if($idus == $ID)
    {
      header("Location: mypage.php");
    }

    $sql = $db->prepare("SELECT HoTen,urlavatar FROM usaccount WHERE ID = ?");
    $sql -> bindValue(1,$ID ,PDO::PARAM_STR );
   	$sql -> execute();
	  $name = "";
    $urlavatar = "";
    $data = $sql->fetchAll();
    foreach ($data as $key ) 
    {
        $name = $key["HoTen"];
        $urlavatar = $key["urlavatar"];
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

      			<form action="#" method="post" enctype="multipart/form-data">
       			<input type="submit" name="ketban" value="Kết Bạn">

    			</form>
      		</td>
   		</tr>
  		</div>
   		
   		</table>
   		</div>
   		<br>



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
      
    }

	?>
    </div>
  </body>
</html>