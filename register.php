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

$nameErr= $nameErr2 = $emailErr = $genderErr = $dobErr = $passErr= "";
$name = $email = $gender = $dob = $password = "";
$message= $error ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
      $nameErr = "Name is required";
    } else if(!empty($_POST["name"])) {
      $name = ($_POST["name"]);
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
  
    if (empty($_POST["email"])) {
      $emailErr = "Email is required";
    } else if(!empty($_POST["email"])) {
      $email = ($_POST["email"]);
  
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";

      }
    }
    if (empty($_POST["gender"])) {
      $genderErr = "Gender is required";
    } else if (!empty($_POST["gender"])){
      $gender = ($_POST["gender"]);
    }

    if (empty($_POST["date"])) {
        $dobErr = "date is required";
      } else if(!empty($_POST["date"])){
        $dob = ($_POST["date"]);
      }
      if(empty($_POST["password"]))  
      {  
           $passErr = "Enter a password";  
      } 
      else if( strlen($_POST["password"])<8){

          $passErr = "password should be grether then 8";
      }else if(!empty($_POST["password"])){
        $password = ($_POST["password"]);
      }


      if(file_exists('data.json'))  
        {  
            if(!empty($name) && !empty($email) && !empty($gender) && !empty($dob) && !empty($password)){
              $current_data = file_get_contents('data.json');  
              $array_data = json_decode($current_data,true);
              $extra = array(  
                'name'     =>     $name,
                'email'   =>     $email,
                //'username' =>     $_POST["username"],
                'gender'   =>     $gender,
                'dob'      =>     $dob,
                'password' =>     $password,
                //'confirm_password' => $_POST["confirm_password"] 
           );  
           $array_data[] = $extra;  
           $final_data = json_encode($array_data,JSON_PRETTY_PRINT); 
           if(file_put_contents('data.json', $final_data))  
           {  
                echo "File Appended Success fully"; 
                header("location: login.php");
           }  
          }
             
        }  
        else  
        {  
             echo 'JSON File not exits';  
        }
      }
      // else if(empty($_POST["confirm_password"]))  
      // {  
      //      $error = "<label class='text-danger'>Confirm password field cannot be empty</label>";  
      // }
?>
<h2>Register Yourself Here</h2>
<p><span class="error">* Required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Date of Birth:
  <input type="date" name="date" > 

  <br /><br>
  Gender:
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male
  <input type="radio" name="gender" value="other">Other
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  Password: 
  <input type="password" name="password">
  <span class="error">* <?php echo $passErr;?></span>
  <br><br>

    
 <br><br>

 
<br><br>

<input type="submit" name="submit" value="Submit">  
</form>
<?php
include "footer.php"
?>
</body>
</html>