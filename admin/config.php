<?php
try{
    $pdo = Database::connection();
    $stmt = $pdo->query("SELECT * FROM `lgt_ip_address`");
    $stmt->execute();
    $datas = $stmt->fetchAll();
}catch(Exception $er){
    echo $er;
}
?>