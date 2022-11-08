<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <hr>


    <?php
    session_start();
    
    if(!empty($_SESSION['user']) && !empty($_SESSION['pass'])){
        $name= $_SESSION['user'];
        $password=$_SESSION['pass'];
        $file = file_get_contents(dirname(__FILE__).'/../json/admin.json');
        $assoc = json_decode($file, true);
    
        foreach($assoc as $file){
            if($file["name"]==$name && $file["password"]==$password){
               echo '
               <h3>
                <button><a href="/Blogging/Admin/AdminLogin.php">Log In</a></button>   
                <button><a href="/Blogging/Admin/AdminLogout.php">Log Out</a></button> 
                <button><a href="home.php">Home</a></button>           
                <button><a href="/Blogging/Admin/AdminProfile.php">View Profile</a></button>
                <button><a href="register.php">Registration</a></button>
                <button><a href="mypost.php">My Post</a></button>
                <button><a href="/Blogging/Admin/AdminUserList.php">View User List</a></button>
                <button><a href="createpost.php">Create Post</a></button>
                <span style="text-align:center;">Welcome To Our Website</span>
                </h3>
               
               ';
            }
        }
        $file = file_get_contents(dirname(__FILE__).'/../json/data.json');
        $assoc = json_decode($file, true);
        foreach($assoc as $file){
            if($file["name"]==$name && $file["password"]==$password){
               echo '
                <h3>
                <button><a href="login.php">Log In</a></button>
                <button><a href="logout.php">Log Out</a></button>
                <button><a href="profile.php">View Profile</a></button>
                <button><a href="createpost.php">Create Post</a></button>
                <button><a href="home.php">Home</a></button>
                <button><a href="mypost.php">My Post</a></button>
                <button><a href="updateprofile.php">Update My Profile</a></button>
                <span style="">Welcome To Our Website</span>
                </h3>
               
               ';
            }
      }

      $file = file_get_contents(dirname(__FILE__).'/../json/editor.json');
      $assoc = json_decode($file, true);
      foreach($assoc as $file){
          if($file["name"]==$name && $file["password"]==$password){
             echo '
              <h3>
              <button><a href="/Blogging/Editor/EditorLogin.php">Log In</a></button>
              <button><a href="/Blogging/Editor/EditorLogout.php">Log Out</a></button>
              <button><a href="/Blogging/Editor/EditorProfile.php">View Profile</a></button>
              <button><a href="createpost.php">Create Post</a></button>
              <button><a href="home.php">Home</a></button>
              <button><a href="mypost.php">My Post</a></button>
              <button><a href="/Blogging/Editor/EditorAllPost.php">Control Post</a></button>
              <span style="">Welcome To Our Website</span>
              </h3>
             
             ';
          }
    }

    }

  
      else{
        echo '<h3>
            <button><a href="login.php">Log In as User</a></button>
            <button><a href="/Blogging/Admin/AdminLogin.php">Log In as Admin</a></button>
            <button><a href="/Blogging/Editor/EditorLogin.php">Log In as Editor</a></button>
            <button><a href="register.php">Registration</a></button>
            <button><a href="home.php">Home</a></button>
            <span style="text-align:center;">Welcome To Our Website</span>
            </h3>';
      }
?>

    <hr>
</body>
</html>