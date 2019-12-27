 <?php
 require_once 'functions.php';
   require_once 'init.php';
  if(isset($_POST['AddComment']))
  {
    $comment = $_POST['comment'];
    if(isset($comment)  && isset($_GET['postid']))
    {
      insertComment($_GET['postid'],$comment);
      header('Location:home.php');
    }                                                        
  }
  else
  {
  	header('Location:index.php');
  }
?>