<?php
include "../classes/Database.class.php";
include "../classes/Page.class.php";

if($_SERVER["REQUEST_METHOD"]==="POST"){
    $api_key_value = "tPmAT5Ab3j7F9";
    if(isset($_POST['api_key'])){
        $api_key = $_POST['api_key'];
        if($api_key_value === $api_key){
            try{
                $pdo = Database::connection();
                $today = date('Y-m-d H:i:s', mktime(0,0,0));
                $stmt = $pdo->query("SELECT * FROM lgt_sensordata WHERE created_at > '$today' ORDER BY created_at DESC LIMIT 10");
                // $stmt = $pdo->query("SELECT * FROM sensordata ORDER BY created_at ASC LIMIT 10");
                $stmt->execute();
                $datas = $stmt->fetchAll();
                $value = [];
                // foreach($datas as $data){        
                //     array_push($value, [$data['created_at'], $data['temperature']]);
                // }
                echo json_encode($datas);
            }catch(PDOException $e){
                echo $e;
                Page::route("/chart.php?err=" . $e);
            }catch(Exception $er){
                echo $er;    
            }
        }
    }
}