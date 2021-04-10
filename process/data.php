<?php
require_once 'config.php';
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if(isset($_POST['type'])){
    $type = $_POST['type'];
    // Search result
    if($type == 1){
        $searchText = $_POST['search'];
        $sql = "SELECT id,p_name FROM product where p_name like '%".$searchText."%' order by p_name asc limit 10";
        $result = mysqli_query($con,$sql);
        if(mysqli_num_rows($result) > 0){
            $search_arr = array();
            while($fetch = mysqli_fetch_assoc($result)){
                $id = $fetch['id'];
                $name = $fetch['p_name'];
                $search_arr[] = array("id" => $id, "name" => $name);
            }
        }else{
            $search_arr[] = array("id" => 0, "name" => "No Product Name Found");
        }
        echo json_encode($search_arr);
    }

    if($type == 2){
        $id = $_POST['search'];
        $sql = "SELECT p_rate, qty FROM product where id = '".$id."'";
        $result = mysqli_query($con,$sql);
        if(mysqli_num_rows($result) > 0){
            $search_arr = array();
            while($fetch = mysqli_fetch_assoc($result)){
                $rate = $fetch['p_rate'];
                $qty = $fetch['qty'];
                $search_arr[] = array("rate" => $rate, "qty" => $qty);
            }
        }else{
            $search_arr[] = array("rate" => 0, "qty" => "Error");
        }
        echo json_encode($search_arr);
    }

    if($type == 3){
        $id = $_POST['search'];
        $sql = "SELECT * FROM product_rec_history where product_id = '".$id ."' ORDER BY date DESC";
        $result = mysqli_query($con,$sql);
        if(mysqli_num_rows($result) > 0){
            while($fetch = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>".$fetch['invoice_number']."</td>";
                echo "<td>".$fetch['ref_no']."</td>";
                echo "<td>".$fetch['qty']."</td>";
                echo "<td>".$fetch['date']."</td>";
                echo "</tr>";
            }
        }else{
            echo "<tr>";
            echo "<td colspan='4'>No Previous Record is Recorded...</td>";
            echo "</tr>";
        }
    }
}

if(isset($_POST['purpose']) && $_POST['purpose'] == "product insertion"){

    $pro_id = $_POST['id'];
    $inputInvoice = $_POST['inputInvoice'];
    $inputRefe = $_POST['inputRefe'];

    $inputQTY = $_POST['inputQTY'];

    $prev_qty = $_POST['prev_qty'];

    $date = $_POST['date'];

    $ori_qty  = $inputQTY + $prev_qty;

    $sql = "INSERT INTO `product_rec_history` (`product_id`, `qty`, `invoice_number`, `ref_no`, `date`) VALUES ('".$pro_id."', '".$inputQTY."', '".$inputInvoice."', '".$inputRefe."', '".$date."')";

    if (mysqli_query($con, $sql)) {
        $sql1 = "UPDATE `product` SET `qty` = '".$ori_qty."' WHERE `product`.`id` = '".$pro_id."'";
        if(mysqli_query($con, $sql1))
            echo "Data Successfully Inserted";
    } else {

    }
}



if(isset($_POST['myData2'])){
    $obj = json_decode($_POST["myData2"]);

    $order_no = test_input($obj->order_no);

    $date = test_input($obj->date);
    $date = date('Y-m-d', strtotime($date)); 

    $client_id = test_input($obj->client_details->client_id);

    $item_details = $obj->item_details;

    $total_amount = $obj->total_amount;
    $paid = $obj->paid;

    $prev_due = $obj->client_details->prev_due;
    $due = $obj->due;

    $new_due = 0;
    if($prev_due > 0)   $new_due = $prev_due + $due;
    else $new_due = $due;

    $last_order_no = $obj->last_order_no;
    $new_last_order_no = $last_order_no + 1;

    $error = 1;

    $sql0 = "INSERT INTO `product_out_master` (`order_id`, `total_amount`, `paid_amount`,`due`, `date`) VALUES ('$order_no', '$total_amount', '$paid', '$due', '$date')";

    $sql001 = "UPDATE `order_id_seq` SET `o_number` = '".$new_last_order_no."' WHERE `order_id_seq`.`o_number` = ".$last_order_no.";";

    

    $sql002 = "UPDATE `company_client` SET `due_amt` = '$new_due' WHERE `company_client`.`id` = $client_id";

    if(mysqli_query($con, $sql0)){
        if(mysqli_query($con, $sql001)){
            if(mysqli_query($con, $sql002)){
                $last_id = mysqli_insert_id($con);
                for($i = 0 ; $i < count($item_details) ; $i++){
                    $item_id = $item_details[$i]->item_id;
                    $qnty = $item_details[$i]->qnty;
                    $rate = $item_details[$i]->rate;
                    $prev_qty = $item_details[$i]->prev_qty;

                    $remaining_qty = $prev_qty - $qnty;

                    $sql = "INSERT INTO `product_out_history` (`product_out_master_id`, `product_id`, `customer_id`, `qty`, `product_price`) VALUES ('".$last_id."', '".$item_id."', '".$client_id."', '".$qnty."', '".$rate."')";
                    if(mysqli_query($con, $sql)){
                        $sql1 = "UPDATE `product` SET `qty` = '".$remaining_qty."' WHERE `product`.`id` = '". $item_id."'";
                        if(mysqli_query($con, $sql1)) $error = 0;
                    }
                }
            }
        }        
    }
    echo($error == 0)?"Data Successfully Recorded":"Something Went Wrong";
    
}


if(isset($_POST['fetch1']) && $_POST['fetch1'] == "fetch_order_seq"){
    $search_arr = array();
    $sql = "SELECT * FROM `order_id_seq`";
    $result = mysqli_query($con,$sql);    
    $fetch = mysqli_fetch_assoc($result);
    $first_chars = $fetch['first_chars'];
    $financial_year = $fetch['financial_year'];
    $o_number = $fetch['o_number'];
    $search_arr[] = array("first_chars" => $first_chars,"financial_year" => $financial_year, "o_number" => $o_number);    
    echo json_encode($search_arr);
}
?>