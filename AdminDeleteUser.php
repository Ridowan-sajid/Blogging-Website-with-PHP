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
    Delete User Name:
    <input type="text" name="del" placeholder="Enter User Name"><br>
    <button type="submit">Delete</button>
</form>
<?php
$nameErr="";
$del="";
    if (empty($_POST["del"])) {
        $nameErr = "title is required";
        } else if(!empty($_POST["del"])) {
            $del = ($_POST["del"]);
        if (!preg_match("/[a-zA-Z]/",$del))
        {
        $nameErr = "Must start with a letter";
        }
        if (!preg_match("/^[a-zA-Z-' ]*$/",$del)) {
        $nameErr = "Only letters and white space allowed";
        }
    }

    $data = file_get_contents('data.json');
    $json = json_decode($data);
    //$array = (array) $json[0];

    for($i=0;$i<count($json);$i++){
        $array = (array) $json[$i];
            //echo $array['title'];
            if($array['name']==$del){
                unset($json[$i]);
            }
    }
    $json = json_encode($json, JSON_PRETTY_PRINT);
    file_put_contents('data.json', $json);
    

?>


</body>
</html>