<?php 
require_once 'init.php';
require_once 'functions.php';
  // Xử lý logic ở đây
$page = "home";
if(isset($_GET['load']))
{
  $postImages = findAllPost($currentUser['id'],$_GET['load']);
}
else
{
  $postImages = findAllPost($currentUser['id'],1);
}
$friends = findAllFriend($currentUser['id']);
$sotrang = sumPost($currentUser['id']);
if(isset($_POST['post'])||isset($_FILES['fileToUpload']))
   {
      $content = $_POST['post'];
      $image = $_FILES['fileToUpload'];
      $nameImage = $image['name'];
      $sizeImage = $image['size'];
      $tempImage = $image['tmp_name'];
      $strSql = "INSERT INTO post_images (name_image,content,userid,uploarequested onded_on) VALUES('".$nameImage."','".$content."','".$currentUser['id']."',NOW())";
      $check = uploadPost($nameImage,$sizeImage,$tempImage,$content,$currentUser['id'],$currentUser['email']."/Uploads/",$strSql);
      header("Location: home.php");
  }
?>
<?php include 'header.php'; ?>
<?php if($currentUser):?>
<div id="middle" >
        <div id="ds_mon_hoc" style="left: 110px;top : 50px;" class="shadow-none p-3 mb-5 bg-light rounded border">
        <div>
         <form action="home.php" method="post" enctype="multipart/form-data" name="frm3">
            <input type="file"  name="fileToUpload" id="fileToUpload" style="display: none;">
            <div id="sharePost">
                <div id="selectImage" onclick="document.getElementById('fileToUpload').click();">
                    <span>Ảnh</span>
                    <img src="./icon/picture.png"style="height: 25px;width: 25px;">
                </div>
                <textarea  placeholder="Bạn đang nghĩ gì vậy <?php echo $currentUser['fullname'];?> ?" rows = "6" cols = "50" style="overflow: hidden;" name="post" id="textbox"></textarea>
                <div id="submitShare">
                    <input  style = "width: 75px;"type="submit" value="Share" name="submit" class="btn btn-primary">
                </div>
            </div>
         </form><br>
         <label>Trang:</label>
         <select id="gender" onchange="genderChanged(this)">
            <option value=""> ... </option>
            <?php
              for ($i = 1; $i <= $sotrang+1; $i++)
              {
                echo '<option value="'.$i.'"> '.$i.' </option>';
              }
            ?>
        </select>
        <p style="color: red" id="show_message"></p>
        <script language="javascript">

            function genderChanged(obj)
            {
              window.location = "home.php?load="+obj.value;
            } 
 
        </script>

         <div id="lien_lac" class="background_sector alert alert-dark shadow-none p-3 mb-5 bg-light rounded border ">
            <p id="lh_header" class="lien_he list-group-item list-group-item-action active " style="font-size: 15px">Bạn Bè</p>
            <?php foreach($friends as $fr):?>
            <p class="lien_he ">
                <a href="Users/<?php echo $fr['email']?>/?ID=<?php echo $currentUser['id'];?> " class="list-group-item list-group-item-action" target="_blank" onclick="">
                    <?php echo $fr['fullname'];?>
                </a>
            </p>
          <?php endforeach;?>
        </div>
         </div>
            <?php foreach($postImages as $image):?>
                <?php if($image['content']!=NULL&&$image['name_image']!=NULL):?>
                    <div id="post" class="dsmh_mon_hoc" style="line-height:8px;margin: 15px 15px;">
                      <p>
                        <?php $profile = findProfileById($image['userid']); ?>
                        <img id="nameUser" src="Users/<?php echo $image['email']; ?>/Profile/<?php echo $profile['profile_cover']; ?>" alt="avatar" style = "width: 35px; height:35px;" />
                        <strong id="nameUser"><?php echo $image['fullname'];?></strong>
                      </p>
                      <p id="timeUpload" class="ten_truong glyphicon glyphicon-briefcase can_le_icon"><?php echo $image['uploaded_on'];?></p>
                      <p style="top: 76px;" class="dsmh_detail"><?php echo $image['content'];?></p>
                      <img id="imageShow"src="Users/<?php echo $image['email']; ?>/Uploads/<?php echo $image['name_image']; ?>"/>

                      <div class="dsmh_detail" style="float: "><br><br><br><br>

                      <?php if (isLike($image['id'],$currentUser['id'])==1) { 
                        echo '<a href="likeOrunlike.hm.php?like=1&postid='.$image['id'].'" style="font-size: 25px; color: red;"><i class="fas fa-heart"></i></a><br>';
                        } else {
                        echo '<a href="likeOrunlike.hm.php?like=0&postid='.$image['id'].'" style="font-size: 25px; color: red;"><i class="far fa-heart"></i></a><br>';
                      }?>
                      <?php echo sumLike($image['id'])." lượt thích";?>

                      <?PHP echo '<form action="createComment.inc.php?postid='.$image['id'].'" method="POST">' ?>
                      <textarea placeholder="Viết bình luận ..." rows="6" cols="50" style="overflow: hidden; width: 430px; height: 50px; float:  left;" name="comment" id="textbox"></textarea>
                      <button  type="submit" name="AddComment"  style="width: 60px;height: 50px; float:  right; background-color: #4267b2;box-sizing: border-box; font-size: 14px;font-family: inherit; color: white;">Đăng</button>
                      </form><br>

                      <?php
                        $commentPost = GetCommentByID($image['id']);

                        foreach ($commentPost  as $cmt) {?>
                          <div class="dsmh_mon_hoc" style="line-height:15px;margin: 15px 15px;height: auto;">

                          <p style="position:relative;left:0px;top:0px;" class="dsmh_detail"><?php echo $cmt['comment']." - ".$cmt['commentTime']; ?></p>
                        </div>
                          <?php
                        }
                      ?>
                      </div>
                      
                  </div>

                <?php else: ?>
                  <?php if($image['name_image']==NULL&&$image['content']!=NULL): ?>
                    <div class="dsmh_mon_hoc" style="line-height:15px;margin: 15px 15px;height: 600px;">
                      <p>
                        <?php $profile = findProfileById($image['userid']); ?>
                        <img id="nameUser" src="Users/<?php echo $image['email']; ?>/Profile/<?php echo $profile['profile_cover']; ?>" alt="avatar" style = "width: 35px; height:35px;" />
                        <strong id="nameUser"><?php echo $image['fullname'];?></strong>
                      </p>
                      <p id="timeUpload" class="ten_truong glyphicon glyphicon-briefcase can_le_icon"><?php echo $image['uploaded_on'];?></p><br/>
                      <div style="width: inherit;">
                      <p style="position:relative;left:0px;top:0px;" class="dsmh_detail"><?php echo $image['content'];?></p>
                    </div>
                    <div class="dsmh_detail" style="float: "><br><br><br><br>

                      <?php if (isLike($image['id'],$currentUser['id'])==1) { 
                        echo '<a href="likeOrunlike.hm.php?like=1&postid='.$image['id'].'" style="font-size: 25px; color: red;"><i class="fas fa-heart"></i></a><br>';
                        } else {
                        echo '<a href="likeOrunlike.hm.php?like=0&postid='.$image['id'].'" style="font-size: 25px; color: red;"><i class="far fa-heart"></i></a><br>';
                      }?>
                      <?php echo sumLike($image['id'])." lượt thích";?>

                      <?PHP echo '<form action="createComment.inc.php?postid='.$image['id'].'" method="POST">' ?>
                      <textarea placeholder="Viết bình luận ..." rows="6" cols="50" style="overflow: hidden; width: 430px; height: 50px; float:  left;" name="comment" id="textbox"></textarea>
                      <button  type="submit" name="AddComment"  style="width: 60px;height: 50px; float:  right; background-color: #4267b2;box-sizing: border-box; font-size: 14px;font-family: inherit; color: white;">Đăng</button>
                      </form><br>

                      <?php
                        $commentPost = GetCommentByID($image['id']);

                        foreach ($commentPost  as $cmt) {?>
                          <div class="dsmh_mon_hoc" style="line-height:15px;margin: 15px 15px;height: auto;">

                          <p style="position:relative;left:0px;top:0px;" class="dsmh_detail"><?php echo $cmt['comment']." - ".$cmt['commentTime']; ?></p>
                        </div>
                          <?php
                        }
                      ?>
                      </div>
                    </div>
                    <?php else:?>
                      <div id="post" class="dsmh_mon_hoc" style="line-height:8px;margin: 15px 15px;">
                        <p>
                        <?php $profile = findProfileById($image['userid']); ?>
                        <img id="nameUser" src="Users/<?php echo $image['email']; ?>/Profile/<?php echo $profile['profile_cover']; ?>" alt="avatar" style = "width: 35px; height:35px;" />
                        <strong id="nameUser"><?php echo $image['fullname'];?></strong>
                      </p>
                        <p id="timeUpload" class="ten_truong glyphicon glyphicon-briefcase can_le_icon"><?php echo $image['uploaded_on'];?></p>
                        <img id="imageShow"src="Users/<?php echo $image['email']; ?>/Uploads/<?php echo $image['name_image']; ?>"/>

                        <div class="dsmh_detail" style="float: "><br><br><br><br>

                      <?php if (isLike($image['id'],$currentUser['id'])==1) { 
                        echo '<a href="likeOrunlike.hm.php?like=1&postid='.$image['id'].'" style="font-size: 25px; color: red;"><i class="fas fa-heart"></i></a><br>';
                        } else {
                        echo '<a href="likeOrunlike.hm.php?like=0&postid='.$image['id'].'" style="font-size: 25px; color: red;"><i class="far fa-heart"></i></a><br>';
                      }?>
                      <?php echo sumLike($image['id'])." lượt thích";?>

                      <?PHP echo '<form action="createComment.inc.php?postid='.$image['id'].'" method="POST">' ?>
                      <textarea placeholder="Viết bình luận ..." rows="6" cols="50" style="overflow: hidden; width: 430px; height: 50px; float:  left;" name="comment" id="textbox"></textarea>
                      <button  type="submit" name="AddComment"  style="width: 60px;height: 50px; float:  right; background-color: #4267b2;box-sizing: border-box; font-size: 14px;font-family: inherit; color: white;">Đăng</button>
                      </form><br>

                      <?php
                        $commentPost = GetCommentByID($image['id']);

                        foreach ($commentPost  as $cmt) {?>
                          <div class="dsmh_mon_hoc" style="line-height:15px;margin: 15px 15px;height: auto;">

                          <p style="position:relative;left:0px;top:0px;" class="dsmh_detail"><?php echo $cmt['comment']." - ".$cmt['commentTime']; ?></p>
                        </div>
                          <?php
                        }
                      ?>
                      </div>
                      </div>
                    <?php endif;?>      
                <?php endif;?>
              <?php endforeach;?>
              </div>
              </div>  <?php else:?>
 	<?php header('Location:index.php');?>
 <?php endif;?>
<?php include 'footer.php'; ?>