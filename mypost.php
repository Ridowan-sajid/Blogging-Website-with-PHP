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
include "header.php"
?>
<h1>Hello User</h1>
<?php

    //session_start();
        if(!empty($_SESSION['user'])){
        $name= $_SESSION['user'];
        $file = file_get_contents('post.json');
        $assoc = json_decode($file, true);
        //var_dump($assoc);
    
        foreach($assoc as $file){
            if($file['author']==$name){
                echo "<hr>";
                echo "Title: ".$file['title']."<br>";
                echo "Details: ".$file['details']."<br>";
                echo "Date: ".$file['date']."<br>";
                echo "Author: ".$file['author']."<br>";
                //header('Location:profile.php');
                echo "<hr>";
            }    
        }
    }
    include 'deletePost.php';

?>

<!-- <form action="" method="post">
<button type="submit">Delete</button>
</form> -->

 <?php     
include "footer.php"
?>
</body>
</html>