<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include "header.php";
?>
<h1>Hello User</h1>
    <?php
    //session_start();
    
    
    if(!empty($_SESSION['user']) && !empty($_SESSION['pass'])){
        $name= $_SESSION['user'];
        $password=$_SESSION['pass'];
        $file = file_get_contents('editor.json');
        $assoc = json_decode($file, true);
        //var_dump($assoc);
    
        foreach($assoc as $file){
            if($file["name"]==$name && $file["password"]==$password){
               
                echo "Name: ".$name."<br>";
                echo "Email: ".$file['email']."<br>";
                echo "Gendr: ".$file['gender']."<br>";
                echo "Date of Birth: ".$file['dob']."<br>";
                //header('Location:profile.php');
            }
        }
      }
      else{
        echo "<h2>First Logged In</h2>";
      }
?>

<form action="EditorLogout.php" method="post">
<button type="submit">Log Out</button>
</form>

<?php     
include "footer.php"
?>
</body>
</html>