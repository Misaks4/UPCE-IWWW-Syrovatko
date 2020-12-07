<?php
error_reporting(1);
spl_autoload_register(function ($class) {
    include 'class/' . $class . '.php';
});
session_start();
session_status();
if ($_GET["page"]=="logout"){
    $_SESSION = [];
    session_destroy();
}

if ($_POST["action"]=="login"){
    $email=$_POST["femail"];
    $pass=$_POST["fpass"];
    //overeni
    if (Db_sprava::userAuthentication($email,$pass)){
        $_SESSION["loggedUserId"] = Db_sprava::setUserId($email);
        $_SESSION["isLogged"] = true;
    }else{
        echo "Špatné přihlašovací údaje.";
    }
}else if ($_POST["action"]=="register"){
        $email=$_POST["femail"];
        $pass=$_POST["fpass"];
        $select=$_POST["fselect"];

        Db_sprava::registerUser($email,$pass,$select);

        $_SESSION["loggedUserId"] = Db_sprava::setUserId($email);
        $_SESSION["isLogged"] = true;
}

$user = Db_sprava::getUserInformation($_SESSION["loggedUserId"]);

if (false){
    print_r($_SESSION);
    echo "<br>";
    print_r($_GET);
    echo "<br>";
    print_r($_POST);
    echo "<br>";
    if ($_SESSION["isLogged"]==1){
        print_r(Db_sprava::getUserRights($_SESSION["loggedUserId"]));
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Správa uživatelů</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<section class="kontent">
<?php
include "./header.php";
try {
    $pathToFile = "./page/" . $_GET["page"] . ".php";
    if (file_exists($pathToFile)) {
        include $pathToFile;
    } else {
        include "./page/main.php";
    }
}catch (PDOException $e){

}


?>
</section>
</body>
</html>

<?php
?>