
<section class="menu">

<?php
echo  '<div><a class="menuA" href="index.php">Úvod</a></div>';
if ($_SESSION["isLogged"]!=1 || $user[0][3]==1){
    echo  '<div><a class="menuA" href="index.php?page=register">Registrace uživatele</a></div>';
}
if ($user[0][3]==1){
    echo  '<div><a class="menuA" href="index.php?page=listOfUsers">Výpis uživatelů</a></div>';
}
if ($_SESSION["isLogged"]==1){
    echo  '<div><a class="menuA" href="index.php?page=detail">Detail uživatele</a></div>';
}
if ($_SESSION["isLogged"]==1){
    echo  '<div><a class="menuA" href="index.php?page=logout">Odhlásit se</a></div>';
}
?>

</section>
