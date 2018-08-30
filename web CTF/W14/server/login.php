<?php
    if( !isset($_POST['username']) || !isset($_POST['password']) || $_POST['username']=="" || $_POST['password']=="" ){
        header("Location: index.php");
    }
    function safe_filter($str)
    {
        $strl = strtolower($str);
        if (strstr($strl, 'drop') ||
            strstr($strl, 'update') ||
            strstr($strl, 'delete')
        ) {
            return '';
        }
        return $str;
    }
    $username = safe_filter($_POST['username']);
    $password = sha1($_POST['password']);
    $error_msg = "";
    require_once('config.php');
    try {
      $pdo = new PDO("mysql:host=$db_server;dbname=$db_name;charset=utf8mb4",$db_user,$db_password);
      $sql = "SELECT * FROM `users` WHERE `username` = '$username' and `password` = '$password';";
      $stmt = $pdo->query($sql);
      foreach($result as $key => $value) {
        echo $key . "-" . $value . "<br/>";
      }
$dbh = null;
    } catch(PDOException $e) {
        $error_msg =  "Connection failed: ".$e->getMessage();
    }
?>
<php
    if($_POST[user] && $_POST[pass]) {
        $conn = mysql_connect("********", "*****", "********");
        mysql_select_db("phpformysql") or die("Could not select database");
     if ($conn->connect_error) {
            die("Connection failed: " . mysql_error($conn));
    }
    $user = $_POST[user];
    $pass = md5($_POST[pass]);
    $sql = "select pw from php where user='$user'";
    $query = mysql_query($sql);
    if (!$query) {
        printf("Error: %s\n", mysql_error($conn));
     exit();
    }
    $row = mysql_fetch_array($query, MYSQL_ASSOC);
    //echo $row["pw"];
     if (($row[pw]) && (!strcasecmp($pass, $row[pw]))) {
        echo "<p>Logged in! Key:************** </p>";
    }
    else {
        echo("<p>Log in failure!</p>");
      }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Web 14: SQL Injection II</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <style>
        html, body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
            font-family: Arial, Helvetica, sans-serif;
        }

        span.hide {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
    <h1 class="text-center">
        <?php
            $text = "";
            $success ? $text = "Login Success!" : $text = "Login Failed!!";
            echo $text;
            if ($error_msg){
              echo $error_msg ;
            }
        ?>
    </h1>

    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>
