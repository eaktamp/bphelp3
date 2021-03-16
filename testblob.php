<?php
require_once "./config/pg_con.class.php";

$sql = " SELECT patient_image.hn,patient_image.image_name, patient_image.image FROM patient_image where hn = '009020001' ";
$result = pg_query($conn, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>");
$row = pg_fetch_array($result);
//header("Content-type: image/jpg");
echo $row["image"];


?>


