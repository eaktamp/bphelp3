<?php
include "pg_con.class.php";

$sql_rt = "SELECT  opds.vn,opds.hn,concat(pt.pname,pt.fname,' ',pt.lname,' (',extract(year FROM age(pt.birthday)),'ปี)')as patient,ROUND(opds.rr,0)as rr,ov.vsttime,
        opds.vstdate,ROUND(bps,0)as bps,ROUND(bpd,0)as bpd ,ROUND(pulse,0)as pulse,ROUND(temperature,1)as temperature,oqueue,sp.name as spname
        FROM opdscreen opds
        LEFT OUTER JOIN patient pt on pt.hn = opds.hn
        LEFT OUTER JOIN ovst ov on ov.vn = opds.vn
	LEFT OUTER JOIN spclty sp on ov.spclty = sp.spclty
        WHERE -- bps >'150' 
        bps is not null
        AND cc IS NULL
        AND opds.vstdate = CURRENT_DATE";

$result_rt = pg_query($sql_rt);


$dhc_rt .= '<div id="page-inner">';
$dhc_rt .= '<div class="dashboard-cards">';
$dhc_rt .= '<div class="row">';


$index = 0;
$arrayOderby = [];

while ($row_result = pg_fetch_assoc($result_rt)) {

        $hn = $row_result["hn"];
        $bps =   $row_result["bps"];
        $bpd = $row_result["bpd"];
        $pulse =  $row_result["pulse"];
        $rr = $row_result["rr"];
        $patient = $row_result["patient"];
        $temperature = $row_result["temperature"];
        $queue = $row_result["oqueue"];
        $time = $row_result["vsttime"];
        $spname = $row_result["spname"];

        // bps
        if ($bps <= 80 && $bps > 0) {
                $scorebps = 3;
        } else if ($bps >= 81 &&  $bps <= 90) {
                $scorebps = 2;
        } else if ($bps >= 91 &&  $bps <= 100) {
                $scorebps = 1;
        } else if ($bps >= 101 &&  $bps <= 180) {
                $scorebps = 0;
        } else if ($bps >= 181 &&  $bps <= 199) {
                $scorebps = 1;
        } else if ($bps >= 200) {
                $scorebps = 2;
        } else {
                $scorebps = 0;
        }

        // PR pulse
        if ($pulse <= 40 && $pulse > 0) {
                $scorepulse = 3;
        } else if ($pulse >= 41 &&  $pulse <= 50) {
                $scorepulse = 1;
        } else if ($pulse >= 51 &&  $pulse <= 100) {
                $scorepulse = 0;
        } else if ($pulse >= 101 &&  $pulse <= 120) {
                $scorepulse = 1;
        } else if ($pulse >= 121 &&  $pulse <= 130) {
                $scorepulse = 2;
        } else if ($pulse >= 140) {
                $scorepulse = 3;
        } else {
                $scorepulse = 0;
        }

        //BT temperature
        if ($temperature <= 35 && $temperature  > 0) {
                $scoretemperature = 2;
        } else if ($temperature >= 35.1 &&  $temperature <= 36) {
                $scoretemperature = 1;
        } else if ($temperature >= 36.1 &&  $temperature <= 38) {
                $scoretemperature = 0;
        } else if ($temperature >= 38.1 &&  $temperature <= 38.4) {
                $scoretemperature = 1;
        } else if ($temperature >= 38.5) {
                $scoretemperature = 2;
        } else {
                $scoretemperature = 0;
        }

        //RR

        if ($rr <= 8 && ($rr  > 0 || $rr != '')) {
                $scorerr = 3;
        } else if ($rr >= 9 &&  $rr <= 20 || $rr == '') {
                $scorerr = 0;
        } else if ($rr >= 21 &&  $rr <= 25) {
                $scorerr = 1;
        } else if ($rr >= 26 &&  $rr <= 35) {
                $scorerr = 2;
        } else if ($rr >= 35) {
                $scorerr = 3;
        }



        //เก็บค่าของคนที่ score มากกว่าที่กำหนด ลง array เพื่อเอาไปแสดงผล
        $sumscore = intval($scorebps) + intval($scorepulse) + intval($scorerr) + intval($scoretemperature);
        if ($sumscore >= '1') {
                $arrayOderby[$index][0]  = $sumscore < 5 ? $sumscore : 5;
                $arrayOderby[$index][1]  = $patient;
                $arrayOderby[$index][2]  = $hn;
                $arrayOderby[$index][3]  = $queue;
                $arrayOderby[$index][4]  = $bps;
                $arrayOderby[$index][5]  = $bpd;
                $arrayOderby[$index][6]  = $pulse  > 0 ? $pulse : 0;
                $arrayOderby[$index][7]  = $temperature  > 0 ? $temperature : 0;
                $arrayOderby[$index][8]  = $rr != '' ? $rr : '?? ';;
                $arrayOderby[$index][9]  = $scorebps;
                $arrayOderby[$index][10] = $scorepulse;
                $arrayOderby[$index][11] = $scorerr;
                $arrayOderby[$index][12] = $scoretemperature;
                $arrayOderby[$index][13] = $time;
                $arrayOderby[$index][14] = $spname;

                $index++;
        }
}





for ($i = 0; $i < sizeof($arrayOderby); $i++) {
        for ($j = $i + 1; $j < sizeof($arrayOderby); $j++) {
                if ($arrayOderby[$i][0] < $arrayOderby[$j][0]) {
                        $temp = $arrayOderby[$i];
                        $arrayOderby[$i] = $arrayOderby[$j];
                        $arrayOderby[$j] = $temp;
                }
        }
}

$dhc_rt .= '
                <style>
			h1 {
				font-size: 70px;
			}
                        h2 {
				font-size: 50px;
			}
                        h3 {
				font-size: 50px;
			}
		</style>';


$sound = 1;
foreach ($arrayOderby as $key => $array) {
        $color = "";
        $time = time();
        if ($arrayOderby[$key][0] >= 4) {
                $color = "red";
                $sound++;
        } else if ($arrayOderby[$key][0] == 3) {
                $color = "orange";
        } else if ($arrayOderby[$key][0] == 2) {
                $color = "yellow";
        } else {
                $color = "green";
        }

        $dhc_rt .=
                '
                <div class="col-xs-12 col-sm-6 col-md-6" >
                        <div class="card horizontal cardIcon waves-effect waves-dark" >
                                <div class="card-image ' . $color . '">
                                        <h1 style="padding-top:60% ;color:black;font-weight:bold;">' . $arrayOderby[$key][0] . '</h1>
                                </div>
                                <div class="card-stacked black"> 
                                        <div class="card-content "> 
                                        <h1 style="color:white;height: 100px;">' .  $arrayOderby[$key][1]  . '</h1> 
                                <h3 style="float:right;font-weight:bold;"> HN : ' .  $arrayOderby[$key][2] . '</h3>
                                </div>
                                <div class="card-action" style="padding-top: 0px;" >
                                        <h2 style="color:#FFFFFF;">' . $arrayOderby[$key][14] . '</h2>
                                        <h1 style="font-weight:bold;background-color: #FFFFFF; color:#000000;padding:20px;"> Q : <spen style="color:#710a0a;">&nbsp; ' . $arrayOderby[$key][3] . '  </spen>  &nbsp;' .  substr(date($arrayOderby[$key][13]), 0, 5)  .  ' น.</h1> 
                                </div>
                                <div class="card-action">' .
                (intval($arrayOderby[$key][9])  == 0 ? '<strong style="font-size: 22px;">' : '<strong style="background-color: yellow; color:#000000;font-size: 30px;">') . '&nbspBP ' . $arrayOderby[$key][4] . ' / ' . $arrayOderby[$key][5] . '&nbsp</strong>' .
                (intval($arrayOderby[$key][10]) == 0 ? '<strong style="font-size: 22px;">' : '<strong style="background-color: yellow; color:#000000;font-size: 30px;">') . '&nbspP : ' . $arrayOderby[$key][6] . '&nbsp</strong> ' .
                (intval($arrayOderby[$key][11]) == 0 ? '<strong style="font-size: 22px;">' : '<strong style="background-color: yellow; color:#000000;font-size: 30px;">') . '&nbspRR : ' . $arrayOderby[$key][8] . '&nbsp</strong>' .
                (intval($arrayOderby[$key][12]) == 0 ? '<strong style="font-size: 22px;">' : '<strong style="background-color: yellow; color:#000000;font-size: 30px;">') . '&nbspT : ' .   $arrayOderby[$key][7] . '&nbsp</strong>' .
                '</div> 
                                </div>
                        </div>
                </div>';
}



$dhc_rt .= '</div>';
if ($sound > 0) {
        if (date("s") < 10 || (date("s") > 30 && date("s") < 40)) {
                $dhc_rt .=
                        '<audio controls autoplay id="myaudio" style="display:none">
                <source src="audio/Nakom.mp3" type="audio/mpeg">
                </audio>
                ';
                // Emergency
                // Nakom
        }
}

echo json_encode($dhc_rt);
