<?php
include "pg_con.class.php";

$sql_rt = "SELECT  opds.vn,opds.hn,concat(pt.pname,' ',pt.fname,' ',pt.lname)as patient,ROUND(opds.rr,1)as rr,
        opds.vstdate,ROUND(bps,0)as bps,ROUND(bpd,0)as bpd ,ROUND(pulse,0)as pulse,ROUND(temperature,1)as temperature,oqueue
        FROM opdscreen opds
        LEFT OUTER JOIN patient pt on pt.hn = opds.hn
        LEFT OUTER JOIN ovst ov on ov.vn = opds.vn
        WHERE -- bps >'150' 
        bps is not null
        AND cc IS NULL
        AND opds.vstdate = CURRENT_DATE  ";

$result_rt = pg_query($sql_rt);


$dhc_rt .= '<div id="page-inner">';
$dhc_rt .= '<div class="dashboard-cards">';
$dhc_rt .= '<div class="row">';



while ($row_result = pg_fetch_assoc($result_rt)) {
        $hn = $row_result["hn"];
        $bps =   $row_result["bps"];
        $bpd = $row_result["bpd"];
        $pulse =  $row_result["pulse"];
        $rr = $row_result["rr"];
        $patient = $row_result["patient"];
        $temperature = $row_result["temperature"];
        $queue = $row_result["oqueue"];

        $sumscore = 0; $scorebps = 0; $scorepulse = 0;$scorerr = 0; $scoretemperature = 0;
        // bps
        if ($bps <= 80 && $bps >0) {
                $scorebps = 3;
        }
        else if ($bps >= 81 &&  $bps <= 90) {
                $scorebps = 2;
        }
        else if ($bps >= 91 &&  $bps <= 100) {
                $scorebps = 1;
        }
        else if ($bps >= 101 &&  $bps <= 180) {
                $scorebps = 0;
        }
        else if ($bps >= 181 &&  $bps <= 199) {
                $scorebps = 1;
        }
        else if ($bps >= 200) {
                $scorebps = 2;
        }

        // PR pulse
        if ($pulse <= 40 && $pulse >0) {
                $scorepulse = 3;
        }
        else if ($pulse >= 41 &&  $pulse <= 50) {
                $scorepulse = 1;
        }
        else if ($pulse >= 51 &&  $pulse <= 100) {
                $scorepulse = 0;
        }
        else if ($pulse >= 101 &&  $pulse <= 120) {
                $scorepulse = 1;
        }
        else if ($pulse >= 121 &&  $pulse <= 130) {
                $scorepulse = 2;
        }
        else if ($pulse >= 140 ) {
                $scorepulse = 3;
        }

        //BT temperature
        if ($temperature <= 35 && $temperature  > 0 ) {
                $scoretemperature = 2;
        }
        else if ($temperature >= 35.1 &&  $temperature <= 36) {
                $scoretemperature = 1;
        }
        else if ($temperature >= 36.1 &&  $temperature <= 38) {
                $scoretemperature = 0;
        }
        else if ($temperature >= 38.1 &&  $temperature <= 38.4) {
                $scoretemperature = 1;
        }
        else if ($temperature >= 38.5 ) {
                $scoretemperature = 2;
        }

         //RR
        if ($rr <= 8 && $rr  > 0 ) {
                $scorerr = 3;
        }
        else if ($rr >= 9 &&  $rr <= 20) {
                $scorerr = 0;
        }
        else if ($rr >= 21 &&  $rr <= 25) {
                $scorerr = 1;
        }
        else if ($rr >= 26 &&  $rr <= 35 ) {
                $scorerr = 2;
        }
        else if ($rr >= 35 ) {
                $scorerr = 3;
        }


        $sumscore =  $scorebps + $scorepulse + $scorerr + $scoretemperature;



        if(  $sumscore == '3'){
                $dhc_rt .= '<div class="col-xs-12 col-sm-6 col-md-3">';
                $dhc_rt .= '<div class="card horizontal cardIcon waves-effect waves-dark">';
                $dhc_rt .= '<div class="card-image red">';
                $dhc_rt .= '<h1 style="padding-top:60%">';
                $dhc_rt .=   $sumscore.'</h1></div>';
                $dhc_rt .= '<div class="card-stacked red">';
                $dhc_rt .= '<div class="card-content">';
                $dhc_rt .= '<h2 style="color:white;">' .  $patient .'</h2>';
                $dhc_rt .= '<h5> HN : ' .  $hn . '  หมายเลข : ' . $queue . '</h5>';
                $dhc_rt .= '</div>';
                $dhc_rt .= '<div class="card-action">';
                $dhc_rt .= '<strong>' . $bps . ' / ' . $bpd . ' pulse : ' . $pulse . '  temperature : ' .   $temperature . ' rr :' . $rr . '</strong>';
                $dhc_rt .= '</div>';
                $dhc_rt .= '</div>';
                $dhc_rt .= '</div>';
                $dhc_rt .= '</div>';
        }


 
}

$dhc_rt .= '</div>';

echo json_encode($dhc_rt);
