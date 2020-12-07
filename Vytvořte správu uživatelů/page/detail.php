<?php
if ($_SESSION["isLogged"]){

$conn = Connection::getPdoInstance();
$stmt = $conn->prepare("SELECT id, email FROM db_sprava.table_name");
$stmt->execute();
$dataset = $stmt->fetchAll();

if ($_POST["action"]=="update"){
    Db_sprava::updateUser($_POST["fid"],$_POST["femail"],$_POST["fpass"],$_POST["fselect"]);
}

if ($_POST["action"]=="select"){
    $selUser = Db_sprava::getUserInformation($_POST["fselect"]);
}else{
    $selUser = $user;
}

?>

<section class="kontent">
    <div class="formular">
        <form method="post" id="formId" action="index.php?page=detail" enctype="multipart/form-data">
            <input type="hidden" name="action" value="select">
            <?php
            if ($user[0][3]==1){
            ?>
            <div class="form">
                <label for="fId">Uživatel:</label><br>
                <select id="fselect" name="fselect" form="formId">
                    <?php
                    for ($i = 0; $i < count($dataset); $i++) {
                        echo '<option value='.$dataset[$i][0].'> '.$dataset[$i][1].'</option>';
                    }
                    ?>
                </select><br>
            </div>
            <div class="form">
                <input type="submit" value="Provést">
            </div>
                <?php
                }
                ?>
        </form>
    </div>
    <div class="formular">
        <form method="post" id="formEdit" action="index.php?page=detail" enctype="multipart/form-data">
            <input type="hidden" name="action" value="update">
            <?php
            echo '<input type="hidden" name="fid" value='.$selUser[0][0].'>';
            ?>
            <div class="form">
                <label for="femail">Email :</label><br>
                <?php
                echo '<input type="email" id="femail" name="femail" value='.$selUser[0][1].'><br>';
                ?>
            </div>
            <div class="form">
                <label for="fpass">Heslo :</label><br>
                <input type="password" id="fpass" name="fpass"><br>
            </div>
            <div class="form">
                <label for="frole">Role :</label><br>
                <select id="fselect" name="fselect" form="formEdit">
                    <?php
                    echo '<option value="0"';
                    if ($selUser[0][3]==0){
                        echo 'selected="selected"';
                    }
                    echo '>Uživatel</option>';

                    echo '<option value="1" ';
                    if ($selUser[0][3]==1){
                        echo 'selected="selected"';
                    }
                    echo '>Administrátor</option>';
                    ?>
                </select><br>
            </div>
            <div class="form">
                <input type="submit" value="Upravit">
            </div>
        </form>
    </div>
</section>

<?php
}