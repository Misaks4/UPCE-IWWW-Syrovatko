<?php


class Katalog
{
    private $dataSet;
    private $catalog;
    /**
     * Katalog constructor.
     */
    public function __construct()
    {
        $conn = Connection::getPdoInstance();
        $stmt = $conn->prepare("SELECT id,img,name,price FROM table_katalog ORDER BY id DESC");
        $stmt->execute();
     //   $stmt->setFetchMode( PDO::FETCH_ASSOC);
        $this->catalog = $stmt->fetchAll();


    }
    public function getCatalog()
    {
        return $this->catalog;
    }

}