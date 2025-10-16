<?php
namespace App\Models\Databases;

use mysqli;

class NotasDB
{
    private $hostDb = "localhost";
    private $userDb = "root";
    private $pwdDb = "";
    private $nameDb = "grupo_1_avanzada";
    private $conexDb = null;

    public function __construct()
    {
        $this->conexDb = new mysqli(
            $this->hostDb,
            $this->userDb,
            $this->pwdDb,
            $this->nameDb
        );
        if ($this->conexDb->connect_error) {
            die("Error DB: " . $this->conexDb->connect_error);
        }
    }

    public function close()
    {
        $this->conexDb->close();
    }

    public function execSQL($sql, $isSelect, ...$bindParam)
    {
        $prepare = $this->conexDb->prepare($sql);
        if (!empty($bindParam)) {
            $prepare->bind_param(...$bindParam);
        }
        if ($isSelect) {
            $prepare->execute();
            return $prepare->get_result();
        } else {
            return $prepare->execute();
        }
    }
}