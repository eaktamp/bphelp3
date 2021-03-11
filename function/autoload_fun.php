<?php
require "./config/db.php";

class searchBp extends Dbcon
{
    public function selectAllbp(){
        $sql = " SELECT  vn,hn,vstdate,ROUND(bps,0)as bps,ROUND(bpd,0)as bpd 
        FROM opdscreen 
        WHERE bps >'150' 
        AND cc IS NULL
        AND vstdate = CURRENT_DATE ";
        $query = pg_query($this->pgcon,$sql);
        return ( $query );
    }
}
?>
