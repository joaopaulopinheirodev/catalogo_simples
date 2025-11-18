<?php
$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_NAME = "catalogo_db";

$con = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($con->connect_errno) {
    die("Falha na conexão com o banco de dados: (" . $con->connect_errno . ") " . $con->connect_error);
}
$con->set_charset("utf8mb4");
?>
