<?php
	require_once 'db_connect.php';

	$sql = "SELECT name, address, phone, tin FROM company_self";
	$result = $connect->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$c_name = $row["name"];
			$c_add = $row["address"];
			$c_phone = $row["phone"];
			$c_tin = $row["tin"];
		}
	}
?>