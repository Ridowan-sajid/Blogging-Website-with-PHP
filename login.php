<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="" method="post">
  <div class="container">
    <label for="name"><b>name</b></label>
    <input type="text" placeholder="Enter Username" name="name" value="<?php echo $_COOKIE['name'] ?>" required>
    <br>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" value="<?php echo $_COOKIE['password'] ?>" required>
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
           $passErr = "Enter a password";  
      } 
      else if(strlen($_POST["password"])<8){

        $passErr = "password should be grether then 8";
      }else if(!empty($_POST["password"])){
        $password = htmlspecialchars($_POST["password"]);
      }
 


  }

  if(!empty($_POST['remember'])){
    
    $cookie_name="name";
    $cookie_value=$name;
    $cookie_name2="password";
    $cookie_value2=$password;

    setcookie($cookie_name, $cookie_value, time() + (60*60*24* 30), "/"); 
    setcookie($cookie_name2, $cookie_value2, time() + (60*60*24* 30), "/"); 

    //print_r($_COOKIE['name']);

  }


  if(!empty($name) && !empty($password)){
    // if($_COOKIE['name']==$name && $_COOKIE['password']==$password){
    //   echo "Successfully Logged In by cookie";
    // }

    $file = file_get_contents('data.json');
    $assoc = json_decode($file, true);
    //var_dump($assoc);

    foreach($assoc as $file){
        if($file["name"]==$name && $file["password"]==$password){
            echo "Successfully Logged In";
            header('Location:profile.php');
        }
    }
  }

    ?>
</body>
</html>