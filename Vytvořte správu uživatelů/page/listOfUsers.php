<?php
if ($_SESSION["isLogged"]) {
    if ($user[0][3] == 1) {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT * FROM table_name ORDER BY id DESC");
        $stmt->execute();

        $dataTable = new DataTable($stmt->fetchAll());
        $dataTable->addColumn("email", "Email");
        $dataTable->addColumn("heslo", "Heslo");
        $dataTable->addColumn("role", "Role");
        $dataTable->render();
    }
}