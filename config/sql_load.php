<?php
include "pg_con.class.php";


$sql_rt = " SELECT  vn,opds.hn,concat(pt.pname,pt.fname,' ',pt.lname)as patient,vstdate,ROUND(bps,0)as bps,ROUND(bpd,0)as bpd ,ROUND(pulse,0)as pulse,ROUND(temperature,1)as temperature
        FROM opdscreen opds
        LEFT OUTER JOIN patient pt on pt.hn = opds.hn
        WHERE -- bps >'150' 
        bps is not null
        AND cc IS NULL
        AND vstdate = CURRENT_DATE limit 10 ";

$result_rt = pg_query($sql_rt);


$dhc_rt .= '<div id="page-inner">';
$dhc_rt .= '<div class="dashboard-cards">';
$dhc_rt .= '<div class="row">';

while ($row_result = pg_fetch_assoc($result_rt)) {
        $hn = $row_result["hn"];
        $bps =   $row_result["bps"];
        $bpd = $row_result["bpd"];
        $pulse =  $row_result["pulse"];
        $patient = $row_result["patient"];
        $temperature = $row_result["temperature"];

        //  sbp <=80 3 pr <= 40 rr<=8 

        $dhc_rt .= '<div class="col-xs-12 col-sm-6 col-md-3">';
        $dhc_rt .= '<div class="card horizontal cardIcon waves-effect waves-dark">';
        $dhc_rt .= '<div class="card-image red">';
        $dhc_rt .= '<i class="material-icons dp48">supervisor_account</i>';
        $dhc_rt .= '</div>';
        $dhc_rt .= '<div class="card-stacked red">';
        $dhc_rt .= '<div class="card-content">';
        $dhc_rt .= '<h3>' .  $patient . '</h3>';
        $dhc_rt .= '</div>';
        $dhc_rt .= '<div class="card-action">';
        $dhc_rt .= '<strong>' . $bps . ' / ' . $bpd. ' pulse :' .$pulse . '  temperature : ' .   $temperature .'</strong>';
        $dhc_rt .= '</div>';
        $dhc_rt .= '</div>';
        $dhc_rt .= '</div>';
        $dhc_rt .= '</div>';
}

$dhc_rt .= '</div>';

echo json_encode($dhc_rt);
