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
                //$stmt = $pdo->query("SELECT * FROM sensordata WHERE created_at < $today ORDER BY created_at ASC LIMIT 10");
                $stmt = $pdo->query("SELECT * FROM lgt_sensordata ORDER BY created_at DESC");
                $stmt->execute();
                $datas = $stmt->fetchAll();
                $value = [];
                foreach($datas as $data){        
                    $newDate = date("M d, Y. h:i:s A", strtotime($data['created_at']));  
                    array_push($value, [$data['name'], $data['location'],$data['light'], $data['smoke'], $data['temperature'], $newDate]);
                }
                $len = count($value);
                $jsonData = [
                    "recordsTotal"=>$len,
                    "recordsFiltered"=>$len,
                    "data"=>$value];
                echo json_encode($jsonData);
            }catch(PDOException $e){
                echo $e;
                Page::route("/chart.php?err=" . $e);
            }catch(Exception $er){
                echo $er;    
            }
        }
    }
}