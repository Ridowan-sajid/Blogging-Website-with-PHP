<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  
<?php
include "header.php";

$nameErr= $emailErr = "";
$title = $details = $dob = $user = "";
$message= $error ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["title"])) {
      $nameErr = "title is required";
    } else if(!empty($_POST["title"])) {
      $title = ($_POST["title"]);
     if (!preg_match("/[a-zA-Z]/",$title))
      {
        $nameErr = "Must start with a letter";
      }
    
      if (!preg_match("/^[a-zA-Z-' ]*$/",$title)) {
        $nameErr = "Only letters and white space allowed";
      }
    }
  
    if (empty($_POST["details"])) {
      $emailErr = "details is required";
    } else if(!empty($_POST["details"])) {
      $details = ($_POST["details"]);
    }
    if(file_exists('post.json'))  
        {  
            if(!empty($title) && !empty($details)){
              $current_data = file_get_contents('post.json');  
              $array_data = json_decode($current_data,true);
              $extra = array(  
                'title'     =>     $title,
                'details'   =>     $details,
                'date'   =>     $_POST['date'],
                'author'   =>     $_POST['author'],
           );  
           $array_data[] = $extra;
           $final_data = json_encode($array_data);
           if(file_put_contents('post.json', $final_data))
           {  
                echo "Post Appended Successfully"; 
                header("location: mypost.php");
           }  
          }
             
        }  
        else  
        {  
             echo 'JSON File not exits';  
        }
    }
?>
<h2>Create Post</h2>
<?php //session_start(); ?>
<!-- <p><span class="error">* Required field</span></p> -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Title: <input type="text" name="title">
  <!-- <span class="error">* <?php echo $nameErr;?></span> -->
  <br><br>
  <label for="details">Post Details:</label>
    <br> 
  <textarea id="details" name="details" rows="4" cols="50"></textarea>

  <!-- <span class="error">* <?php echo $emailErr;?></span> -->
   
  <br><br>
  Date of Post:
  <input readonly="readonly"  value="<?php echo date("Y/m/d") ?>" name="date" > 
  <br><br>
  Author: <input readonly="readonly" value="<?php 
  if(isset($_SESSION['user'])){
    echo $_SESSION['user'];
  }else{
    echo "";
  }
  ?>" name="author">


<br><br>

<input type="submit" name="submit" value="Submit">  
</form>
<?php
include "footer.php"
?>
</body>
</html>