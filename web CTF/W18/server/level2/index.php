<?php
require('config.php');

// table schema
// user -> id, username, password, is_admin

if(!empty($_GET['show_source']))
{
    if($_GET['show_source'] === '1') {
        highlight_file(__FILE__);
        exit;
    }
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

$_POST = array_map("safe_filter", $_POST);

$user = null;

// connect to database

if(!empty($_POST['username']) && !empty($_POST['password'])) {
    $connection_string = sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4', $DB_HOST, $DB_NAME);
    $db = new PDO($connection_string, $DB_USER, $DB_PASS);
    $sql = sprintf("SELECT * FROM `user` WHERE `username` = '%s' AND `password` = '%s'",
        $_POST['username'],
        $_POST['password']
    );
    try {
        $query = $db->query($sql);
        if($query) {
            $user = $query->fetchObject();
        } else {
            $user = false;
        }
    } catch(Exception $e) {
        $user = false;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login As Admin 2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css" media="all">
</head>
<body>
    <div class="jumbotron">
        <div class="container">
            <h1>Login as Admin 2</h1>
        </div>
    </div>

    <div class="container">
        <div class="navbar">
            <a href="?show_source=1" target="_blank">Source Code</a>
        </div>
    </div>

    <div class="container">
        <div class="col-md-6 col-md-offset-3">
<?php if(!$user): ?>
<?php if($user === false): ?>
            <div class="alert alert-danger">Login failed</div>
            <div class="alert alert-danger">debug:<br> <?=htmlentities($sql)?></div>
<?php endif; ?>
            <form action="." method="POST">
                <div class="form-group">
                    <label for="username">User:</label>
                    <input id="username" class="form-control" type="text" name="username" placeholder="User">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input id="password" class="form-control" type="text" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <input class="form-control btn btn-primary" type="submit" value="Login">
                </div>
            </form>

            <div>
                <p>
                    You can login with <code>guest</code> / <code>guest</code>.
                </p>
            </div>
<?php else: ?>
            <h3>Hi, <?=htmlentities($user->username)?></h3>

            <h4><?=sprintf("You %s admin!", $user->is_admin ? "are" : "are not")?></h4>

            <?php if($user->is_admin) printf("<code>%s</code>", htmlentities($flag)); ?>
            <div class="alert alert-danger">SELECT SQL:<br> <?=htmlentities($sql)?></div>
<?php endif; ?>
        </div>
    </div>
</body>
</html>

