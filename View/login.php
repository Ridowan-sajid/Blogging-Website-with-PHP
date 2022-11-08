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
<form action="" method="post">
  <div class="container">
    <label for="name"><b>name</b></label>
    <input type="text" placeholder="Enter Username" name="name" value="<?php 
    if(isset($_COOKIE['name'])){
      echo $_COOKIE['name'];
    }
    else{
      echo "";
    }
     
    ?>" >
    <br>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" value="<?php 
    if(isset($_COOKIE['password'])){
      echo $_COOKIE['password'];
    }
    else{
      echo "";
    }

    ?>" >
    <br>
    
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
<br>
    <button type="submit">Login</button>
  </div>
</form>

<?php
$name=$password="";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
      $nameErr = "Name is required";
    } else if(!empty($_POST["name"])) {
    $name = htmlspecialchars($_POST["name"]);
    $wcount = str_word_count($name);
    if($wcount<2){
          $nameErr="Minimum 2 words required";
    }
    if (!preg_match("/[a-zA-Z]/",$name))
    {
        $nameErr = "Must start with a letter";
    }
    
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
        $nameErr = "Only letters and white space allowed";
    }
    }

    if(empty($_POST["password"]))  
    {  
         echo "Enter a password";  
    } 
    if (strlen($_POST["password"]) <= '8') {
      echo  "Your Password Must Contain At Least 8 Characters!";
    }
    elseif(!preg_match("#[0-9]+#",$_POST["password"])) {
        echo "Your Password Must Contain At Least 1 Number!";
    }
    elseif(!preg_match("#[A-Z]+#",$_POST["password"])) {
        echo "Your Password Must Contain At Least 1 Capital Letter!";
    }
    elseif(!preg_match("#[a-z]+#",$_POST["password"])) {
        echo "Your Password Must Contain At Least 1 Lowercase Letter!";
    }else if(!empty($_POST["password"])){
      $password = htmlspecialchars($_POST["password"]);
    }

      if(!empty($_POST['remember'])){
    
        $cookie_name="name";
        $cookie_value=$name;
        $cookie_name2="password";
        $cookie_value2=$password;
    
        setcookie($cookie_name, $cookie_value, time() + (60*60*24* 30), "/"); 
        setcookie($cookie_name2, $cookie_value2, time() + (60*60*24* 30), "/"); 
    
      }
    
  }

  

  if(!empty($name) && !empty($password)){

    $_SESSION['user']=$name;
    $_SESSION['pass']=$password;

    $file = file_get_contents(dirname(__FILE__).'/../json/data.json');
    $assoc = json_decode($file, true);
    //var_dump($assoc);

    foreach($assoc as $file){
        if($file["name"]==$name && $file["password"]==$password){
            echo "Successfully Logged In";
            header('location:profile.php');
        }
    }
  }else{
    echo "Enter a wrong name or password!";
  }


include "footer.php"
?>
</body>
</html>