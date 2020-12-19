<?php
ob_start();
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
    session_start();
    $email=$_POST["femail"];
    $pass=$_POST["fpass"];
    //overeni
    if (Db_sprava::userAuthentication($email,$pass)){
        $_SESSION["loggedUserId"] = Db_sprava::setUserId($email);
        $_SESSION["isLogged"] = true;
        $_SESSION["cart"]=[];
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
        $_SESSION["cart"]=[];
}
if ($_GET["action"]=="odeslat"){
    $product=$_POST["product"];
    $count=$_POST["count"];
    $price=$_POST["price"];
    $conn = Connection::getPdoInstance();
    $stmt = $conn->prepare("INSERT INTO table_objednavky(user, product,count,price) VALUE(:user,:product,:count,:price)");
    $stmt->bindParam(':user', $_SESSION["loggedUserId"]);
    $stmt->bindParam(':product', $product);
    $stmt->bindParam(':count', $count );
    $stmt->bindParam(':price', $price);
    $stmt->execute();
    $_SESSION["cart"]=[];
}

$user = Db_sprava::getUserInformation($_SESSION["loggedUserId"]);

if ($_GET["action"] == "add" && !empty($_GET["id"])) {
    addToCart($_GET["id"]);
    header("Location: /?page=cart");
}

if ($_GET["action"] == "remove" && !empty($_GET["id"])) {
    removeFromCart($_GET["id"]);
    header("Location: /?page=cart");

}

if ($_GET["action"] == "delete" && !empty($_GET["id"])) {
    deleteFromCart($_GET["id"]);
    header("Location: /?page=cart");
}

function addToCart($productId)
{
    if (!array_key_exists($productId, $_SESSION["cart"])) {
        $_SESSION["cart"][$productId]["quantity"] = 1;
    } else {
        $_SESSION["cart"][$productId]["quantity"]++;
    }
}

function removeFromCart($productId)
{
    if (array_key_exists($productId, $_SESSION["cart"])) {
        if ($_SESSION["cart"][$productId]["quantity"] <= 1) {
            unset($_SESSION["cart"][$productId]);
        } else {
            $_SESSION["cart"][$productId]["quantity"]--;
        }
    }
}

function deleteFromCart($productId)
{
    unset($_SESSION["cart"][$productId]);
}
$dataTable = new Katalog();
$catalog = $dataTable->getCatalog();

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
    echo "<br>";
    print_r($catalog);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Správa uživatelů</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/katalog.css">
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