<?php
require_once "./config/pg_con.class.php";

$sql = " SELECT patient_image.hn,patient_image.image_name, patient_image.image as imgg FROM patient_image where hn = '009020001' ";
$result = pg_query($conn, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>");
$row = pg_fetch_array($result);
//header("Content-type: image/jpg");
//echo $row["image"];

// $b64 = base64_encode($blob);
// echo "<img src='data:image/jpeg;base64,$b64'/>";

echo base64_encode($row['imgg']);
//echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"';
?>
<!-- <img src="data:image/jpg;charset=utf8;base64,<?php//echo base64_encode($row['imgg']); ?>" />  -->

<?


// $connstring = "host=172.16.0.192 dbname=cpahdb user=iptscanview password=iptscanview";
// $conn = pg_connect($connstring);
// pg_set_client_encoding($conn, "utf8");

// $sql_rt = " SELECT patient_image.hn,patient_image.image_name, patient_image.image FROM patient_image where hn = '009020001' ";

// $result_rt = pg_query($sql_rt);
// $row_result = pg_fetch_assoc($result_rt);

// echo '<img src="data:image/jpeg;base64,'.base64_encode( $row_result['image'] ).'"/>';
// echo $row_result['image'];
// echo '<img height="250px" width="250px" src=data:image;base64,'.$row['image'].'/>';

?>


