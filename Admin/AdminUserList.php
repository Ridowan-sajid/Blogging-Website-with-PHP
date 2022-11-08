<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        table, th, td {
            border:1px solid black;
        }
    </style>
<?php
include "header.php";
?>
<h1>Admin Panel</h1>
    <?php
    
        $file = file_get_contents('data.json');
        $assoc = json_decode($file, true);
        //var_dump($assoc);
        echo '
        <table style="width:100%">
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Gender</th>
          <th>Date Of Birth</th>
        </tr>';
        foreach($assoc as $file){
                echo "<tr>";
                echo "<td> ".$file['name']."</td>";
                echo "<td> ".$file['email']."</td>";
                echo "<td> ".$file['gender']."</td>";
                echo "<td> ".$file['dob']."</td>";
                echo "</tr>";
                
        }
        echo '<table style="width:100%">';

        echo "<br><br>";
        include "AdminDeleteUser.php";
        echo "<br>";
        
?>

<form action="" method="post">
  <div class="container">
    Update User Name:
    <input type="text" placeholder="Enter Username" name="name" >
    <br>
    <input type="submit" name="submit">
  </div>
</form>

<?php


    if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $_SESSION['del']=$name;

        header('location:AdminUpdateUser.php');

    }

    
    include "footer.php";
?>


</body>
</html>