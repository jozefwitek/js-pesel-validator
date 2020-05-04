<?php
include "polacz.php";
$pesel = $_GET['pesel'];
$sql = $baza->prepare("INSERT INTO pesele VALUES ('', ?);");
if ($sql)
{
    $sql->bind_param("s", $pesel);
    $sql->execute();
    $sql->close();
}
else
    die( 'Błąd: '. $baza->error);
$baza->close();
header ("Location: http://localhost/kpesel/");
?>