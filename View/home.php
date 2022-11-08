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
<h1>Start Your Blogging Here</h1>

<img src="./home.png" alt="">
<h3>Post:</h3>
    <?php
    

        $file = file_get_contents(dirname(__FILE__).'/../json/post.json');
        $assoc = json_decode($file, true);
        //var_dump($assoc);
    
        foreach($assoc as $file){
                echo "<hr>";
                echo "Title: ".$file['title']."<br>";
                echo "Details: ".$file['details']."<br>";
                echo "Date: ".$file['date']."<br>";
                echo "Author: ".$file['author']."<br>";
                //header('Location:profile.php');
                echo "<hr>";
        }
?>


 <?php     
include "footer.php"
?>
</body>
</html>