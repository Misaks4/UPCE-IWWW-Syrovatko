<?php
if ($_SESSION["isLogged"]==0){
?>
<section class="kontent">
    <div class="formular">
        <form method="post" id="formLogin" action="index.php" enctype="multipart/form-data">
            <input type="hidden" name="action" value="login">
            <div class="form">
                <label for="femail">Email :</label><br>
                <input type="email" id="femail" name="femail"><br>
            </div>
            <div class="form">
                <label for="fpass">Heslo :</label><br>
                <input type="password" id="fpass" name="fpass"><br>
            </div>
            <div class="form">
                <input type="submit" value="Přihlásit">
            </div>
        </form>
    </div>
</section>
<?php
}else{
    $dataset=Db_sprava::getUserInformation($_SESSION["loggedUserId"]);

    echo "<p>Vítejte ". $dataset[0][1] .  "</p>";
}
?>


