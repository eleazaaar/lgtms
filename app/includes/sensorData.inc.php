<?php
include "../classes/Database.class.php";
include "../classes/Page.class.php";

if($_SERVER["REQUEST_METHOD"]==="POST"){
    $api_key_value = "tPmAT5Ab3j7F9";
    if(isset($_POST['api_key'])){
        $api_key = $_POST['api_key'];
        if($api_key_value === $api_key){
            $data = [
                ':name' => $_POST['name'], 
                ':location' => $_POST['loc'], 
                ':light' => $_POST['light'], 
                ':smoke' => $_POST['smoke'],
                ':temperature' => $_POST['temp']
            ];
            try{
                $pdo = Database::connection();
                $sql = 'INSERT INTO lgt_sensordata (name, location, light, smoke, temperature, created_at) VALUES(:name, :location, :light, :smoke, :temperature, NOW())';
                $stmt = $pdo->prepare($sql);                
                $stmt->execute($data);
            }catch(PDOException $e){
                throw $e;
            }catch(Exception $er){
                throw $er;
            }
        }
    }
}