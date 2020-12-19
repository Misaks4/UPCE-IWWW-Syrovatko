
<section class="kontent">
    <div class="formular">
        <form method="post" id="formRegister" action="index.php" enctype="multipart/form-data">
            <input type="hidden" name="action" value="register">
            <div class="form">
                <label for="femail">Email :</label><br>
                <input type="email" id="femail" name="femail"><br>
            </div>
            <div class="form">
                <label for="fpass">Heslo :</label><br>
                <input type="password" id="fpass" name="fpass"><br>
            </div>
            <div class="form">
                <label for="frole">Role :</label><br>
                <select id="fselect" name="fselect" form="formRegister">
                    <option value="0">Uživatel</option>
                    <option value="1">Administrátor</option>
                </select><br>
            </div>
            <div class="form">
                <input type="submit" value="Registrovat">
            </div>
        </form>
    </div>
</section>

<?php
?>