<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once 'config.php';
if(isset($_GET['q'])){
    $q = $_GET['q'];
    $client_type = $_GET['client_type'];

    if(isset($q) || !empty($q)) {
        $query = "SELECT * FROM product WHERE p_name LIKE '$q%'";
        $result = mysqli_query($con, $query);
        $res = array();
        while($resultSet = mysqli_fetch_assoc($result)) {   
            $res[$resultSet['id']]['id'] =  $resultSet['id'];  
            $res[$resultSet['id']]['value'] = $resultSet['p_name'];
            $res[$resultSet['id']]['label'] = $resultSet['p_name'];
            $res[$resultSet['id']]['qty'] = $resultSet['qty'];
            if($client_type == 1)
                $res[$resultSet['id']]['rate'] = $resultSet['p_rate'];
            else
                $res[$resultSet['id']]['rate'] = $resultSet['p_rate1'];
            $res[$resultSet['id']]['gst'] = $resultSet['p_gst'];
            $res[$resultSet['id']]['cgst'] = $resultSet['p_cgst'];
            $res[$resultSet['id']]['sgst'] = $resultSet['p_sgst'];
            $res[$resultSet['id']]['igst'] = $resultSet['p_igst'];
            $res[$resultSet['id']]['bp'] = $resultSet['p_bp'];
            $res[$resultSet['id']]['hsn'] = $resultSet['p_hsn'];
        }
        if(!$res) {
            $res[0] = 'Not found!';
        }
        echo json_encode($res);
    } 
}

if(isset($_GET['qr'])){
    $q = $_GET['qr'];
    if(isset($q) || !empty($q)) {
        $query = "SELECT * FROM company_client WHERE name LIKE '$q%'";
        $result = mysqli_query($con, $query);
        $res = array();
        while($resultSet = mysqli_fetch_assoc($result)) {   
            $res[$resultSet['id']]['id'] =  $resultSet['id'];  
            $res[$resultSet['id']]['value'] = $resultSet['name'];
            $res[$resultSet['id']]['label'] = $resultSet['name'];
            $res[$resultSet['id']]['add'] = $resultSet['address'];
            $res[$resultSet['id']]['gstorpan'] = $resultSet['gstorpan'];
            $res[$resultSet['id']]['phone'] = $resultSet['phone'];
            $res[$resultSet['id']]['code'] = $resultSet['code'];
            $res[$resultSet['id']]['due'] = $resultSet['due_amt'];
        }
        if(!$res) {
            $res[0] = 'Not found!';
        }
        echo json_encode($res);
    } 
}


?>
