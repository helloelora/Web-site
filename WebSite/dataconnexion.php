<?php 
    try {
    $access=new pdo("mysql:host=localhost;dbname=monshop;charset=utf8","root","root"); /*localhost indique que mon site n'est pas hébergé en ligne*/
    $access->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    } catch (Exception $e) {
        $e->getMessage();
    }
?>




