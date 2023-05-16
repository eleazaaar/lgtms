<?php
include "../classes/Database.class.php";
include "../classes/Page.class.php";

if($_SERVER["REQUEST_METHOD"]==="POST"){
    if (isset($_POST['ip_address'])) {
        $ip_address = $_POST['ip_address'];
        
        try {
            $pdo = Database::connection();
            $sql = "UPDATE `lgt_ip_address` SET `ip`='$ip_address'";
            $stmt = $pdo->prepare($sql);                
            $stmt->execute();
        }catch(PDOException $e){
            throw $e;
        }catch(Exception $er){
            throw $er;
        }
    }
}