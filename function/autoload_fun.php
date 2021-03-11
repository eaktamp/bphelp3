<?php
require "./config/db.php";

class searchBp extends Dbcon
{
    public function selectAllbp(){
        $sql = "SELECT  vn,hn,vstdate,ROUND(bps,0)as bps,ROUND(bpd,0)as bpd FROM opdscreen where bps >'150' and vstdate = CURRENT_DATE ";
        $query = pg_query($this->pgcon,$sql);
        return ( $query );
    }
}
?>
