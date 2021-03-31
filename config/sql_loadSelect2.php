<?php
include "pg_con.class.php";

$sql_rt = "SELECT spclty,name FROM spclty";

$result_rt = pg_query($sql_rt);

$index = 0;
$arrayOderby = [];

while ($row_result = pg_fetch_assoc($result_rt)) {

        $arrayOderby[$index][0]  = $row_result["spclty"];
        $arrayOderby[$index][1]  = $row_result["name"];
        $index++;
}

$dhc_rt = '<select class="js-example-basic-single js-states form-control" style="font-size: 22px;" name="spclty_post" id="spclty_post"">
                <option value="9999"></option>';
foreach ($arrayOderby as $key => $array) {

        $dhc_rt .= '<option value="' . $arrayOderby[$key][0] . '">' . $arrayOderby[$key][1] . '</option>';
}
$dhc_rt .= '</select>';

echo json_encode($dhc_rt);
