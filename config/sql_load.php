<?php 
include "pg_con.class.php";


$sql_rt = " SELECT  vn,hn,vstdate,ROUND(bps,0)as bps,ROUND(bpd,0)as bpd 
        FROM opdscreen 
        WHERE bps >'150' 
        AND cc IS NULL
        AND vstdate = CURRENT_DATE ";

$result_rt = pg_query($sql_rt);


$dhc_rt .= '<div id="page-inner">';
$dhc_rt .= '<div class="dashboard-cards">';
$dhc_rt .= '<div class="row">';
     
 while ($row_result = pg_fetch_assoc($result_rt)) {

$dhc_rt .= '<div class="col-xs-12 col-sm-6 col-md-3">';
$dhc_rt .= '<div class="card horizontal cardIcon waves-effect waves-dark">';
$dhc_rt .= '<div class="card-image red">';
$dhc_rt .= '<i class="material-icons dp48">supervisor_account</i>';
$dhc_rt .= '</div>';
$dhc_rt .= '<div class="card-stacked red">';
$dhc_rt .= '<div class="card-content">';
$dhc_rt .= '<h3>HN'.$row_result["hn"].'</h3>';
$dhc_rt .= '</div>';
$dhc_rt .= '<div class="card-action">';
$dhc_rt .= '<strong>'.$row_result["bps"].' / '.$row_result["bpd"].'</strong>';
$dhc_rt .= '</div>';
$dhc_rt .= '</div>';
$dhc_rt .= '</div>';
$dhc_rt .= '</div>';

 }

 $dhc_rt .= '</div>';

 echo json_encode($dhc_rt);

?>
