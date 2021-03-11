<?php
class Dbcon
{
    public $pgcon;
    public function __construct()
    {
        $con = pg_connect("host=172.16.0.192 port=5432 dbname=cpahdb user=iptscanview password=iptscanview");
       // if($con){ echo "success to connect";  } else echo "fail to connect database";
        $this->pgcon = $con;
    }
}


?>